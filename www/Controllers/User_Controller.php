<?php
namespace App\Controllers;
session_start();
use App\Core\View;
use App\Forms\FormUser;
use App\Models\User;
use App\Core\Verificator;

class User_Controller {
    private $folder;

    public function __construct(){
        $this->folder = 'User';
    }

    function index(){
        if(isset($_SESSION["user"])){
            $user = new User();
            $table = $user->getList();
            $view = new View($this->folder."/index", "back");
            $view->assign("table", $table);
        }else{
            echo 'Please login folow link <a href="/login">Login</a>';
        }
    }

    function insert(): void
    {
        if(isset($_SESSION["user"])){
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
                $pwdConfirm = $_POST["pwdConfirm"];
                $user = new User();
                $user->setFirstname($firstname);
                $user->setLastname($lastname);
                $user->setEmail($email);
                $user->setPassword($pwd);
                $user->save();
                header('Location: '.$actual_link.'/admin/'.strtolower($this->folder).'/index');
                exit();
            }
        }else{
            echo 'Please login folow link <a href="/login">Login</a>';
        }
    }

    function update(){
        if(isset($_SESSION["user"])){
            $form = new FormUser();
            $user = new User();
            $user->setId($_GET['id']);
            $row = $user->getDetail();
            $view = new View($this->folder."/form", "back");
            $view->assign('form', $form->getConfig($row));
            if($form->isSubmit())
            {
                $firstname = $_POST["firstname"];
                $lastname = $_POST["lastname"];
                $email = $_POST["email"];
                $user = new User();
                $user->setFirstname($firstname);
                $user->setLastname($lastname);
                $user->setEmail($email);
                $user->setId($_GET['id']);
                $user->save();
                header('Location: '.$actual_link.'/admin/'.strtolower($this->folder).'/update?id='.$user->getId());
                exit();
            }
        }else{
            echo 'Please login folow link <a href="/login">Login</a>';
        }
    }

    function delete(){
        if(isset($_SESSION["user"])){
            $user = new User();
            $user->setId($_POST["id"]);
            $result = (count($user->getDetail()) == 0) ? 'Dữ liệu không tồn tại.' : '';
            $user->delete();
            echo $result;
        }else{
            echo 'Please login folow link <a href="/login">Login</a>';
        }
    }

    function status(){
        if(isset($_SESSION["user"])){
            $user = new User();
            $user->setId($_POST["id"]);
            $result = (count($user->getDetail()) == 0) ? 'Dữ liệu không tồn tại.' : '';
            $user->setStatus(strtoupper($_POST['status']));
            $user->status();
            echo $result;
        }else{
            echo 'Please login folow link <a href="/login">Login</a>';
        }
    }

    function login() {
        $view = new View($this->folder."/login", "login");
    }

    function processlogin() {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = new User();
        $user->setEmail($email);
        $check_email = $user->checkEmail();
        if(count($check_email) == 0){
            echo 'Email or Password is incorrect or Account not activated';
            return false;
        }
        if (password_verify($password, trim($check_email[0]['password']))) {
            $_SESSION["user"] = [
                'id' => $check_email[0]['id'],
                'firstname' => $check_email[0]['firstname'],
                'lastname' => $check_email[0]['lastname'],
                'email' => $check_email[0]['email']
            ];
            echo 'Logged in successfully';
            return true;
        }
    }

    function logout() {
        session_destroy();
        header('Location: '.(empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]".'/login');
        exit();
    }
}
?>