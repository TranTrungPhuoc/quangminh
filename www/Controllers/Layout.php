<?php
namespace App\Controllers;
use App\Core\View;
use App\Models\LayoutModel;
class Layout{
    public function index(){
        $model = new LayoutModel();
        $menu = $model->getList('esgi_Menu');
        $post = $model->getList('esgi_Post', 'id', 'DESC');
        
        $view = new View("Layout/index", "front");
        $view->assign("menu", $menu);
        $view->assign("post", $post);
    }
}