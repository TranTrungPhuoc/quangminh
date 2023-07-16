<?php
namespace App\Controllers;
session_start();
use App\Core\View;
use App\Forms\FormCategory;
use App\Models\Category;
use App\Models\Token;
use App\Core\Verificator;

class CategoryController {
    private $folder;

    public function __construct(){
        $this->folder = ucfirst(explode('/',$_SERVER['REQUEST_URI'])[2]);

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
    }

    function index(){
        $model = new Category();
        $table = $model->getList();
        $view = new View($this->folder."/index", "back");
        $view->assign("table", $table);
    }

    function insert()
    {
        if(trim($_SESSION["user"]['role']) == 'guest'){
            echo 'You are not enough role';
            die;
        }
        $form = new FormCategory();
        $view = new View($this->folder."/form", "back");
        $view->assign('form', $form->getConfig());
        $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]";
        if($form->isSubmit())
        {
            $title = $_POST["title"];
            $slug = $_POST["slug"];
            $model = new Category();
            $model->setTitle($title);
            $model->setSlug($slug);
            $lasttable = $model->getList('', 'sort', 'DESC', 1);
            $sort = (count($lasttable)==0) ? 1 : $lasttable[0]['sort'] + 1;
            $model->setSort($sort);
            $model->setUserId($_SESSION["user"]['id']);
            $model->save();
            header('Location: '.$actual_link.'/admin/'.strtolower($this->folder).'/index');
            exit();
        }
    }

    function update(){
        if(trim($_SESSION["user"]['role']) == 'guest'){
            echo 'You are not enough role';
            die;
        }
        $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]";
        $form = new FormCategory();
        $model = new Category();
        $model->setId($_GET['id']);
        $row = $model->getDetail();
        $view = new View($this->folder."/form", "back");
        $view->assign('form', $form->getConfig($row));
        if($form->isSubmit())
        {
            $title = $_POST["title"];
            $slug = $_POST["slug"];
            $model->setTitle($title);
            $model->setSlug($slug);
            $model->setId($_GET['id']);
            $model->save();
            header('Location: '.$actual_link.'/admin/'.strtolower($this->folder).'/update?id='.$model->getId());
            exit();
        }
    }

    function delete(){
        if(trim($_SESSION["user"]['role']) != 'admin'){
            echo 'You are not enough role';
            die;
        }
        $model = new Category();
        $model->setId($_POST["id"]);
        $result = (count($model->getDetail()) == 0) ? 'Dữ liệu không tồn tại.' : '';
        $model->delete();
        echo $result;
    }

    function status(){
        if(trim($_SESSION["user"]['role']) == 'guest'){
            echo 'You are not enough role';
            die;
        }
        $model = new Category();
        $model->setId($_POST["id"]);
        $result = (count($model->getDetail()) == 0) ? 'Dữ liệu không tồn tại.' : '';
        $model->setStatus(strtoupper($_POST['status']));
        $model->status();
        echo $result;
    }

    function sort(){
        if(trim($_SESSION["user"]['role']) == 'guest'){
            echo 'You are not enough role';
            die;
        }
        $model = new Category();
        $model->setId($_POST["id"]);
        $result = (count($model->getDetail()) == 0) ? 'Dữ liệu không tồn tại.' : '';
        $model->setSort($_POST['sort']);
        $model->sort();
        echo $result;
    }
}
?>