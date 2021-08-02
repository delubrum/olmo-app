<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado
require_once 'models/grnte.php';

class GrnteController{
  private $model;
  public function __CONSTRUCT(){
    $this->model = new Grnte();
  }

  public function Index(){
    ini_set("session.cookie_lifetime","28800");
    ini_set("session.gc_maxlifetime","28800");
    session_start();
    $id = $_SESSION["id-OLMO"];
    $alm = $this->model->GetUser($id);
    require_once 'views/header.php';
    require_once 'views/page.php';
  }

  public function Sales(){
    ini_set("session.cookie_lifetime","28800");
    ini_set("session.gc_maxlifetime","28800");
    session_start();
    $id = $_SESSION["id-OLMO"];
    $alm = $this->model->GetUser($id);
    $url = $_REQUEST['a'];
    require_once 'views/header.php';
    require_once 'views/sales/index.php';
    require_once 'views/sales/new.php';
  }
  
  public function Products(){
    ini_set("session.cookie_lifetime","28800");
    ini_set("session.gc_maxlifetime","28800");
    session_start();
    $id = $_SESSION["id-OLMO"];
    $alm = $this->model->GetUser($id);
    $url = $_REQUEST['a'];
    require_once 'views/header.php';
    require_once 'views/products/index.php';
    require_once 'views/products/new.php';
  }

  public function ProductSave(){
    $description=$_REQUEST['description'];
    $price=preg_replace('/[^0-9]+/', '', $_REQUEST['price']);
    $this->model->ProductSave($description,$price);
    echo "<script type='text/javascript'>
    window.location='?c=Grnte&a=Products'
    </script>";
  }

  public function ProductActive(){
    $id=$_REQUEST['id'];
    $val=$_REQUEST['val'];
    $this->model->ProductActive($val,$id);
  }

  
  
   public function SaleSave(){
     session_start();
     $user = $_SESSION["id-PQB"];
     $price=$_REQUEST['amount'];
     $commission=$_REQUEST['commission'];
     $obs=$_REQUEST['obs'];
     $this->model->Save_Credit($user,$date,$city,$phone,$amount,$commission,$obs);
  }

  public function Save_Approve_All(){
  $arra = $_REQUEST['arra'];
  $arra = explode(",", substr($arra,1));
  $this->model->Save_Approve_All($arra);
  echo "<script type='text/javascript'>
  window.location='?c=Grnte&a=Approve'
  </script>";
  }

  public function Save_Approve(){
$ID = $_REQUEST['id'];
$status = $_REQUEST['status'];
$this->model->Save_Approve($ID,$status);
echo "<script type='text/javascript'>
window.location='?c=Grnte&a=Approve'
</script>";
}

}