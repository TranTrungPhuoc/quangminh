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
        $table = $model->getList('', 'id');
        $view = new View($this->folder."/index", "back");
        $view->assign("table", $table);
    }

    function insert()
    {
        $title = $_POST["title"];
        $content = $_POST["content"];
        $postid = $_POST["postid"];
        $model = new Comment();
        $model->setTitle($title);
        $model->setContent($content);
        $model->setPostId($postid);
        $model->save();
        echo 'Send Successfully!!';
    }

    function update(){
        $model = new Comment();
        $model->setId($_POST['id']);
        $model->setReply($_POST['reply']);
        $model->setUserId($_SESSION["user"]['id']);
        $model->save();
        echo 'Reply Successfully!!';
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