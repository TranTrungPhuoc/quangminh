<?php
namespace App\Controllers;
use App\Core\View;
use App\Forms\FormUser;
use App\Models\User;
use App\Core\Verificator;

class User_Controller {
    private $folder;

    public function __construct(){
        $this->folder = 'User';
    }

    function index(){
        $user = new User();
        $table = $user->getList();
        $view = new View($this->folder."/index", "back");
        $view->assign("table", $table);
    }

    function insert(): void
    {
        $form = new FormUser();
        $view = new View($this->folder."/form", "back");
        $view->assign('form', $form->getConfig());
        $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]";
        
        if($form->isSubmit())
        {
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $email = $_POST["email"];
            $pwd = $_POST["pwd"];
            $pwdConfirm = $_POST["pwdConfirm"];
            $country = $_POST["country"];

            $user = new User();

            $user->setFirstname($firstname);
            $user->setLastname($lastname);
            $user->setEmail($email);
            $user->setPassword($pwd);
            $user->setCountry($country);
            $user->save();

            header('Location: '.$actual_link.'/admin/'.strtolower($this->folder).'/index');
            exit();
        }
    }

    function update(){
        $form = new FormUser();
        
        $user = new User();
        $user->setId($_GET['id']);
        $row = $user->getDetail();

        $view = new View($this->folder."/form", "back");
        $view->assign('form', $form->getConfig($row));

        if($form->isSubmit())
        {
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $email = $_POST["email"];
            $country = $_POST["country"];

            $user = new User();

            $user->setFirstname($firstname);
            $user->setLastname($lastname);
            $user->setEmail($email);
            $user->setCountry($country);
            $user->setId($_GET['id']);
            $user->setDateUpdated(date("Y/m/d H:i:s").'.'.floor(microtime(true)/ 10000));
            $user->save();

            header('Location: '.$actual_link.'/admin/'.strtolower($this->folder).'/update?id='.$user->getId());
            exit();
        }
    }

    function delete(){
        $user = new User();
        $user->setId($_POST["id"]);
    
        $result = (count($user->getDetail()) == 0) ? 'Dữ liệu không tồn tại.' : '';
        $user->delete();

        echo $result;
    }

    function status(){
        $user = new User();
        $user->setId($_POST["id"]);
    
        $result = (count($user->getDetail()) == 0) ? 'Dữ liệu không tồn tại.' : '';
        
        $user->setStatus(strtoupper($_POST['status']));
        $user->status();

        echo $result;
    }
}
?>