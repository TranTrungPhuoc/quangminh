<?php
namespace App\Controllers;
session_start();
use App\Core\View;
use App\Models\Comment;
use App\Core\Verificator;

class CommentController {
    private $folder;

    public function __construct(){
        $this->folder = ucfirst(explode('/',$_SERVER['REQUEST_URI'])[2]);
    }

    function index(){
        $model = new Comment();
        $table = $model->getList();
        $view = new View($this->folder."/index", "back");
        $view->assign("table", $table);
    }

    function insert()
    {
        $title = $_POST["title"];
        $content = $_POST["content"];
        $model = new Comment();
        $model->setTitle($title);
        $model->setContent($content);
        $model->save();
        echo 'Insert Successfully!!';
    }

    function update(){
        $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]";
        $form = new FormComment();
        $model = new Comment();
        $model->setId($_GET['id']);
        $row = $model->getDetail();
        $view = new View($this->folder."/form", "back");
        $view->assign('form', $form->getConfig($row));
        if($form->isSubmit())
        {
            $title = $_POST["title"];
            $content = $_POST["content"];
            $model->setTitle($title);
            $model->setContent($content);
            $model->setId($_GET['id']);
            $model->save();
            header('Location: '.$actual_link.'/admin/'.strtolower($this->folder).'/update?id='.$model->getId());
            exit();
        }
    }

    function delete(){
        $model = new Comment();
        $model->setId($_POST["id"]);
        $result = (count($model->getDetail()) == 0) ? 'Dữ liệu không tồn tại.' : '';
        $model->delete();
        echo $result;
    }

    function status(){
        $model = new Comment();
        $model->setId($_POST["id"]);
        $result = (count($model->getDetail()) == 0) ? 'Dữ liệu không tồn tại.' : '';
        $model->setStatus(strtoupper($_POST['status']));
        $model->status();
        echo $result;
    }
}
?>