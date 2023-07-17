<?php
namespace App\Controllers;
session_start();
use App\Core\View;
use App\Forms\FormUser;
use App\Models\User;
use App\Models\Token;
use App\Core\Verificator;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class UserController {
    private $folder;

    public function __construct(){
        $this->folder = ucfirst(explode('/',$_SERVER['REQUEST_URI'])[2]);

        if(empty($_SESSION["user"])){
            echo 'Please login folow link <a href="/login">Login</a>';
            die;
        }

        // check token
        $modelToken = new Token();
        $modelToken->setId($_SESSION["user"]['tokenid']);
        $row = $modelToken->getDetail();

        if($row[0]['status'] != 1){
            echo 'Token has expired. Please login folow link <a href="/login">Login</a>';
            die;
        }
        
        if($row[0]['expirationtime'] < time()){
            echo 'Token has expired. Please login folow link <a href="/login">Login</a>';
            die;
        }
    }

    function index(){
        $model = new User();
        $table = $model->getList();
        $view = new View($this->folder."/index", "back");
        $view->assign("table", $table);
    }

    function insert() {
        if(trim($_SESSION["user"]['role']) == 'guest'){
            echo 'You are not enough role';
            die;
        }
        $form = new FormUser();
        $view = new View($this->folder."/form", "back");
        $view->assign('form', $form->getConfig());
        if($form->isSubmit())
        {
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $email = $_POST["email"];
            $pwd = $_POST["pwd"];
            $role = $_POST["role"];

            $model = new User();
            $model->setFirstname($firstname);
            $model->setLastname($lastname);
            $model->setEmail($email);
            $model->setPassword($pwd);
            $model->setRole($role);
            $model->save();

            // send mail
            $newData = $model->getList('', 'id', 'DESC', 1); // Get data just add
            $idUser = $newData[0]['id'];

            $this->send_email($idUser, $email);

            header('Location: '.URL.'/admin/'.strtolower($this->folder).'/index');
            exit();
        }
    }

    function update(){
        if(trim($_SESSION["user"]['role']) == 'guest'){
            echo 'You are not enough role';
            die;
        }
        $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]";
        $form = new FormUser();
        $model = new User();
        $model->setId($_GET['id']);
        $row = $model->getDetail();
        $view = new View($this->folder."/form", "back");
        $view->assign('form', $form->getConfig($row));
        if($form->isSubmit())
        {
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $email = $_POST["email"];
            $role = $_POST["role"];

            $model->setFirstname($firstname);
            $model->setLastname($lastname);
            $model->setEmail($email);
            $model->setRole($role);
            $model->setId($_GET['id']);
            $model->save();
            
            header('Location: '.$actual_link.'/admin/'.strtolower($this->folder).'/update?id='.$model->getId());
            exit();
        }
    }

    function delete(){
        if(trim($_SESSION["user"]['role']) != 'admin'){
            echo 'You are not enough role';
            die;
        }
        $model = new User();
        $model->setId($_POST["id"]);
        $result = (count($model->getDetail()) == 0) ? 'Dữ liệu không tồn tại.' : '';
        $model->delete();
        echo $result;
    }

    function status(){
        if(trim($_SESSION["user"]['role']) == 'guest'){
            echo 'You are not enough role';
            die;
        }
        $model = new User();
        $model->setId($_POST["id"]);
        $result = (count($model->getDetail()) == 0) ? 'Dữ liệu không tồn tại.' : '';
        $model->setStatus(strtoupper($_POST['status']));
        $model->status();
        echo $result;
    }

    function changepassword():void{
        $password = $_POST['password'];
        $model = new User();
        $model->setPassword($password);
        $model->setId($_SESSION["user"]['id']);
        $model->setStatus('true');
        $model->save();
        session_destroy();
        echo 'Change Password Successfully!';
    }

    function send_email($idUser='', $email='')
    {
        include 'mail/Exception.php';
        include 'mail/PHPMailer.php';
        include 'mail/SMTP.php';

        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;// Enable verbose debug output
            $mail->isSMTP();// gửi mail SMTP
            $mail->Host = 'smtp.gmail.com';// Set the SMTP server to send through
            $mail->SMTPAuth = true;// Enable SMTP authentication
            $mail->Username = 'quangminh1575@gmail.com';// SMTP username
            $mail->Password = 'mfeihkmmspcumjbg'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;// Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port = 587; // TCP port to connect to
            //Recipients
            $mail->setFrom('quangminh1575@gmail.com', 'Quang Minh');
            $mail->addAddress($email, 'Quang Minh'); // Add a recipient
            // $mail->addAddress('ellen@example.com'); // Name is optional
            $mail->addReplyTo('quangminh1575@gmail.com', 'Reply');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
            // Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz'); // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); // Optional name
            // Content
            $mail->isHTML(true);   // Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body = 'Please click on this link <a href="'.URL.'/admin/user/active?id='.$idUser.'" target="_blank">Active Account</a> to active account.';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
?>