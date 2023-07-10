<?php
namespace App\Controllers;
session_start();
use App\Core\View;
use App\Forms\FormUser;
use App\Models\User;
use App\Core\Verificator;

class UserController {
    private $folder;

    public function __construct(){
        $this->folder = ucfirst(explode('/',$_SERVER['REQUEST_URI'])[2]);

        if(empty($_SESSION["user"])){
            echo 'Please login folow link <a href="/login">Login</a>';
            die;
        }
    }

    function index(){
        $model = new User();
        $table = $model->getList();
        $view = new View($this->folder."/index", "back");
        $view->assign("table", $table);
    }

    function insert(): void {
        if(trim($_SESSION["user"]['role']) == 'guest'){
            echo 'You are not enough role';
            die;
        }
        $form = new FormUser();
        $view = new View($this->folder."/form", "back");
        $view->assign('form', $form->getConfig());
        $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]";
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

            header('Location: '.$actual_link.'/admin/'.strtolower($this->folder).'/index');
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

    function send_email()
    {
        include('class.smtp.php');
        include('class.phpmailer.php');
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->CharSet = 'utf-8';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = '465';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Username = 'czc';
        $mail->Password = 'zczxczc';
        $mail->From = '';
        $mail->FromName = 'QuangMinh';
        $mail->AddAddress( $configs->email, $mail->FromName );
        $mail->AddReplyTo( $configs->email, $mail->FromName );
        $mail->isHTML(true);
        $mail->Subject      = $mail->FromName;
        $mail->Body         = 'Nội Dung Gửi Mail';
        echo (!$mail->Send()) ? 'Mailer Error: ' . $mail->ErrorInfo : ''; exit();
    }
}
?>