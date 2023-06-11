<?php
namespace App\Controllers;
use App\Core\View;
use App\Forms\AddUser;
use App\Models\User;
use App\Core\Verificator;

class User_Controller {
    function index(){
        $user = new User();
        $pseudo = "Prof";
        $view = new View("User/index_user", "back");
        $view->assign("view", $pseudo);
    }   
    function insert(): void
    {
        $form = new AddUser();
        $view = new View("User/form_user", "back");
        $view->assign('form', $form->getConfig());

        if($form->isSubmit()){
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $email = $_POST["email"];
            $pwd = $_POST["pwd"];
            $pwdConfirm = $_POST["pwdConfirm"];

            $user = new User();
            // $user->setId(1);
            $user->setFirstname($firstname);
            $user->setLastname($lastname);
            $user->setEmail($email);
            $user->setPassword($pwd);
            $user->save();

            // header('Location: http://localhost/admin/user/index');
            // exit();
        }
    }
    function update(){
        $pseudo = "Prof";
        $view = new View("User/form", "back");
        $view->assign("pseudo", $pseudo);
    }
    function delete(){
        echo 'delete';
        return;
    }
}
?>