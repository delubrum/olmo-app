<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once 'models/login.php';

class LoginController{
  private $model;
  public function __CONSTRUCT(){
    $this->model = new Login();
  }

  public function Index(){
    ob_start();
    session_start();
    if(isset($_SESSION["id-OLMO"])){
      header('Location: ?c=Grnte&a=Index');
    } else {
      require_once 'views/login/login.php';
    }
  }

  public function Register(){
    $name=$_REQUEST['name'];
    $email=trim($_REQUEST['email']);
    $pass=$_REQUEST['pass'];
    $continue = true;
    if ($this->model->GetEmail($email)) {
      $continue = false;
      return 'email_exist';
    }
    if ($continue) {
      if ($this->model->GetPhone($phone)) {
        $continue = false;
        return 'phone_exist';
      }
    }
    if ($continue) {
      $pass = password_hash($pass, PASSWORD_DEFAULT);
      if($this->model->SaveUser($email, $name, $pass)){
      } else {
				return "error";
			}
    }
  }

  public function Login(){
    $alm = new Login();
    if (isset($_REQUEST['pass']) and $_REQUEST['pass'] <> '') {
      $password=strip_tags($_REQUEST['pass']);
      $user=strip_tags($_REQUEST['user']);
      if ($this->model->Login($user,$password)) {
        header('Location: ?c=Grnte&a=Index');
      } else {
        return 'error';
      }
    } else {
      return 'error';
    }
  }

  public function Logout() {
    session_start();
    session_unset();
    session_destroy();
    header('Location: ?c=Login&a=Index');
  }

}
