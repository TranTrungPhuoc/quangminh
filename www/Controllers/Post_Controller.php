<?php
namespace App\Controllers;
session_start();
use App\Core\View;
use App\Forms\FormPost;
use App\Models\Post;
use App\Core\Verificator;

class Post_Controller {
    private $folder;

    public function __construct(){
        $this->folder = ucfirst(explode('/',$_SERVER['REQUEST_URI'])[2]);

        if(empty($_SESSION["user"])){
            echo 'Please login folow link <a href="/login">Login</a>';
            die;
        }
    }

    function index(){
        $model = new Post();
        $table = $model->getList();
        $view = new View($this->folder."/index", "back");
        $view->assign("table", $table);
    }

    function insert()
    {
        $model = new Post();
        $form = new FormPost();
        $view = new View($this->folder."/form", "back");
        $category = $model->getList('esgi_Category');
        $view->assign('form', $form->getConfig([], $category));
        $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]";
        if($form->isSubmit())
        {
            $title = $_POST["title"];
            $slug = $_POST["slug"];
            $parents = $_POST["parents"];
            $description = $_POST["description"];
            $content = $_POST["content"];
            
            $model->setTitle($title);
            $model->setSlug($slug);
            $model->setParents($parents);
            $model->setDescription($description);
            $model->setContent($content);
            $model->setUserId($_SESSION["user"]['id']);

            $model->save();
            header('Location: '.$actual_link.'/admin/'.strtolower($this->folder).'/index');
            exit();
        }
    }

    function update(){
        $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]";
        $form = new FormPost();
        $model = new Post();
        $model->setId($_GET['id']);
        $row = $model->getDetail();
        $view = new View($this->folder."/form", "back");
        $category = $model->getList('esgi_Category');
        $view->assign('form', $form->getConfig($row, $category));
        if($form->isSubmit())
        {
            $title = $_POST["title"];
            $slug = $_POST["slug"];
            $parents = $_POST["parents"];
            $description = $_POST["description"];
            $content = $_POST["content"];
            $model->setTitle($title);
            $model->setSlug($slug);
            $model->setParents($parents);
            $model->setDescription($description);
            $model->setContent($content);
            $model->setUserId($_SESSION["user"]['id']);
            $model->setId($_GET['id']);
            $model->save();
            header('Location: '.$actual_link.'/admin/'.strtolower($this->folder).'/update?id='.$model->getId());
            exit();
        }
    }

    function delete(){
        $model = new Post();
        $model->setId($_POST["id"]);
        $result = (count($model->getDetail()) == 0) ? 'Dữ liệu không tồn tại.' : '';
        $model->delete();
        echo $result;
    }

    function status(){
        $model = new Post();
        $model->setId($_POST["id"]);
        $result = (count($model->getDetail()) == 0) ? 'Dữ liệu không tồn tại.' : '';
        $model->setStatus(strtoupper($_POST['status']));
        $model->status();
        echo $result;
    }
}
?>