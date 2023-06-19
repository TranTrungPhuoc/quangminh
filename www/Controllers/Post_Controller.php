<?php
namespace App\Controllers;
use App\Core\View;
use App\Forms\AddUser;
use App\Models\User;
use App\Core\Verificator;

class Post_Controller {
    public $folder = 'Post';
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
            $slug = $_POST["slug"];
            $image = $_POST["image"];
            $parents = $_POST["parents"];
            $user = new User();
            $user->setName($name);
            $user->setSlug($slug);
            $user->setImage($image);
            $user->setParents($parents);
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