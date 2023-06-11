<?php
namespace App\Controllers;
use App\Core\View;

class Layout{
    public function index(){
        $pseudo = "Prof";
        $view = new View("Layout/index", "front");
        $view->assign("pseudo", $pseudo);
    }
}