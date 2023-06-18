<?php
namespace App\Controllers;
use App\Core\View;
use App\Forms\AddUser;
use App\Models\User;
use App\Core\Verificator;

class User_Controller {
    function index(){
        $user = new User();
        $table = $user->getList();
        $view = new View("User/index_user", "back");
        $view->assign("table", $table);
    }   
    function insert(): void
    {
        $form = new FormUser();
        $view = new View("User/form_user", "back");
        $view->assign('form', $form->getConfig());
        if($form->isSubmit()){
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
            header('Location: http://localhost/admin/user/index');
            exit();
        }
    }
    function update(){
        $form = new FormUser();
        $user = new User();
        $row = $user->getDetail($_GET['id']);
        $view = new View("User/form_user", "back");
        $view->assign('form', $form->getConfig($row));
    }
    function delete(){
        echo 'delete';
        return;
    }
}
?>