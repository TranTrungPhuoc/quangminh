<?php
namespace App\Controllers;
use App\Core\View;

class Dashboard{
    function index(){
        $pseudo = "Prof";
        $view = new View("Dashboard/index", "back");
        $view->assign("pseudo", $pseudo);
    }
}
?>