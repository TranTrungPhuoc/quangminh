<?php
namespace App\Controllers;
use App\Core\View;
use App\Forms\AddUser;
use App\Models\User;
use App\Core\Verificator;

class Menu_Controller {
    public $folder = 'Menu';
    function index(){
        $user = new User();
        $table = $user->getList();
        $view = new View($folder."/index", "back");
        $view->assign("table", $table);
    }   
    function insert(): void
    {
        $form = new FormUser();
        $view = new View($folder."/form", "back");
        $view->assign('form', $form->getConfig());
        if($form->isSubmit()){
            $name = $_POST["name"];
            $link = $_POST["link"];
            $location = $_POST["location"];
            $topic = $_POST["topic"];
            $user = new User();
            $user->setName($name);
            $user->setLink($link);
            $user->setLocation($location);
            $user->setTopic($topic);
            $user->save();
            header('Location: http://localhost/admin/'.strtolower($folder).'/index');
            exit();
        }
    }
    function update(){
        $form = new FormUser();
        $user = new User();
        $row = $user->getDetail($_GET['id']);
        $view = new View($folder."/form", "back");
        $view->assign('form', $form->getConfig($row));
    }
    function delete(){
        echo 'delete';
        return;
    }
}
?>