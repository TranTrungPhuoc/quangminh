<?php
namespace App\Controllers;
session_start();
use App\Core\View;
use App\Models\Token;

class DashboardController{
    function index(){
        if(empty($_SESSION["user"])){
            echo 'Please login folow link <a href="/login">Login</a>';
            die;
        }
        
        // check token
        $modelToken = new Token();
        $modelToken->setId($_SESSION["user"]['tokenid']);
        $row = $modelToken->getDetail();

        if($row[0]['status'] != 1){
            echo 'Token has expired. Please login folow link <a href="/login">Login</a>';
            die;
        }
        
        if($row[0]['expirationtime'] < time()){
            echo 'Token has expired. Please login folow link <a href="/login">Login</a>';
            die;
        }

        $pseudo = "Prof";
        $view = new View("Dashboard/index", "back");
        $view->assign("pseudo", $pseudo);
    }
}
?>