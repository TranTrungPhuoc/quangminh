<?php
namespace App\Controllers;
session_start();
use App\Core\View;
use App\Forms\AddUser;
use App\Models\User;
use App\Models\Token;
use App\Core\Verificator;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class SecurityController{
    
    function login() {
        $view = new View("User/login", "login");
    }

    function register() {
        $view = new View("User/register", "register");
    }

    function generateToken() {
        $token = bin2hex(random_bytes(16));
        return $token;
    }

    function processlogin() {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $model = new User();
        $model->setEmail($email);
        
        $check_email = $model->checkEmail();
        if(count($check_email) == 0){
            echo 'Email or Password is incorrect or Account not activated';
            return false;
        }
        
        if (password_verify($password, trim($check_email[0]['password']))) {
            
            // Create Token
            $token = $this->generateToken();
            $expirationTime = time() + (30 * 60);

            $modelToken = new Token();
            
            $userid = $check_email[0]['id'];

            // update all user status = false
            $modelToken->setId($userid);
            $modelToken->setStatus('false');
            $modelToken->save('userid');

            // insert new
            $modelToken->setId(0);
            $modelToken->setToken($token);
            $modelToken->setExpirationTime($expirationTime);
            $modelToken->setUserid($userid);
            $modelToken->setStatus('true');
            $modelToken->save();
            
            // get id just add new
            $row = $modelToken->getLast();

            $_SESSION["user"] = [
                'id' => $check_email[0]['id'],
                'firstname' => $check_email[0]['firstname'],
                'lastname' => $check_email[0]['lastname'],
                'email' => $check_email[0]['email'],
                'role' => $check_email[0]['role'],
                'tokenid' => $row[0]['id']
            ];
            echo 'Logged in successfully';
            return true;
        }
    }

    function processregister() {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $model = new User();
        $model->setEmail(trim($email));
        
        $check_email = $model->checkEmail();
        if(count($check_email) != 0){
            echo 'Account had exist!';
            return false;
        }
        
        $model->setPassword(trim($password));
        $model->setRole('user');

        $model->save();

        // send mail
        $newData = $model->getList('', 'id', 'DESC', 1); // Get data just add
        $idUser = $newData[0]['id'];

        $this->send_email($idUser, $email);

        echo 'Register in successfully';
    }

    function active(){
        $idUser = $_GET['id'];
        $model = new User();
        $model->setId($idUser);
        $result = (count($model->getDetail()) == 0) ? 'Dữ liệu không tồn tại.' : '';
        $model->setStatus('true');
        $model->status();
    }

    function logout() {
        session_destroy();
        header('Location: '.(empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]".'/login');
        exit();
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
            // echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}