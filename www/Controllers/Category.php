<?php
namespace App\Controllers;
use App\Core\View;

class Category{
    function index(){
        $pseudo = "Prof";
        $view = new View("Category/index", "back");
        $view->assign("pseudo", $pseudo);
    }   
    function insert(){
        $pseudo = "Prof";
        $view = new View("Category/form", "back");
        $view->assign("pseudo", $pseudo);
    }
    function update(){
        $pseudo = "Prof";
        $view = new View("Category/form", "back");
        $view->assign("pseudo", $pseudo);
    }
    function delete(){
        echo 'delete';
        return;
    }
}
?>