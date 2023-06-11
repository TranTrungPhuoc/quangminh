<?php
namespace App\Controllers;
use App\Core\View;

class Post{
    function index(){
        $pseudo = "Prof";
        $view = new View("Post/index", "back");
        $view->assign("pseudo", $pseudo);
    }   
    function insert(){
        $pseudo = "Prof";
        $view = new View("Post/form", "back");
        $view->assign("pseudo", $pseudo);
    }
    function update(){
        $pseudo = "Prof";
        $view = new View("Post/form", "back");
        $view->assign("pseudo", $pseudo);
    }
    function delete(){
        echo 'delete';
        return;
    }
}
?>