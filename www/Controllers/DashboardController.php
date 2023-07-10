<?php
namespace App\Controllers;
session_start();
use App\Core\View;

class DashboardController{
    function index(){
        if(empty($_SESSION["user"])){
            echo 'Please login folow link <a href="/login">Login</a>';
            die;
        }
        $pseudo = "Prof";
        $view = new View("Dashboard/index", "back");
        $view->assign("pseudo", $pseudo);
    }
}
?>