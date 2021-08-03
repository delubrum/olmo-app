<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado
require_once 'models/init.php';

class InitController{
  private $model;
  public function __CONSTRUCT(){
    $this->model = new Init();
  }

  public function Index(){
    ini_set("session.cookie_lifetime","28800");
    ini_set("session.gc_maxlifetime","28800");
    session_start();
    $id = $_SESSION["id-OLMO"];
    $alm = $this->model->UserGet($id);
    if (!empty($this->model->CashboxGet()->type)) {
      $type=$this->model->CashboxGet()->type;
      if ($type==1) {
        require_once 'views/header.php';
        require_once 'views/page.php';
      }
      else {
        require_once 'views/cashbox/open.php';
      }
    }
    else {
      require_once 'views/cashbox/open.php';
    }
  }

  public function CashboxOpen(){
    ini_set("session.cookie_lifetime","28800");
    ini_set("session.gc_maxlifetime","28800");
    session_start();
    $id = $_SESSION["id-OLMO"];
    $amount = preg_replace('/[^0-9]+/','',$_REQUEST['amount']);
    $this->model->CashboxOpen($id,$amount);
    echo "<script type='text/javascript'>
    window.location='?c=Init&a=Index'
    </script>";
  }

  public function Sales(){
    ini_set("session.cookie_lifetime","28800");
    ini_set("session.gc_maxlifetime","28800");
    session_start();
    $id = $_SESSION["id-OLMO"];
    $alm = $this->model->UserGet($id);
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
    $alm = $this->model->UserGet($id);
    $url = $_REQUEST['a'];
    require_once 'views/header.php';
    require_once 'views/products/index.php';
    require_once 'views/products/new.php';
  }

  public function ProductSave(){
    $category_id=$_REQUEST['category_id'];
    $description=$_REQUEST['description'];
    $price=preg_replace('/[^0-9]+/', '', $_REQUEST['price']);
    $this->model->ProductSave($category_id,$description,$price);
    echo "<script type='text/javascript'>
    window.location='?c=Init&a=Products'
    </script>";
  }

  public function ProductActive(){
    $id=$_REQUEST['id'];
    $val=$_REQUEST['val'];
    $this->model->ProductActive($val,$id);
  }

  public function Purchases(){
    ini_set("session.cookie_lifetime","28800");
    ini_set("session.gc_maxlifetime","28800");
    session_start();
    $id = $_SESSION["id-OLMO"];
    $alm = $this->model->UserGet($id);
    $url = $_REQUEST['a'];
    require_once 'views/header.php';
    require_once 'views/purchases/index.php';
    require_once 'views/purchases/new.php';
  }

  public function PurchaseSave(){
    $product_id=$_REQUEST['product_id'];
    $price=preg_replace('/[^0-9]+/', '', $_REQUEST['price']);
    $qty=$_REQUEST['qty'];
    $obs=$_REQUEST['obs'];
    if ($this->model->InventoryGet($product_id)) {
      $inventory_qty = $qty + $this->model->InventoryGet($product_id)->qty;
      $this->model->InventoryUpdate($inventory_qty,$product_id);
      $this->model->PurchaseSave($product_id,$qty,$price,$obs);
    } else {
      $this->model->PurchaseSave($product_id,$qty,$price,$obs);
      $this->model->InventorySave($qty,$product_id);
    }    
    echo "<script type='text/javascript'>
    window.location='?c=Init&a=Purchases'
    </script>";
  }

  public function ProductSearch(){
    if  (!empty($_POST["description"])) {
    foreach($this->model->ProductSearch($_POST["description"]) as $r) {
      $description = mb_convert_case($r->description, MB_CASE_TITLE, "UTF-8");
      echo "<button id='product' data-id='$r->id' data-price='$r->price' type='button' class='btn btn-block bg-gradient-info' data-toggle='modal' data-target='#qty_price'>$description</button>";
      }
    }
  }

  public function ProductByCategory(){
    if  (!empty($_POST["id"])) {
    foreach($this->model->ProductByCategory($_POST["id"]) as $r) {
      $description = mb_convert_case($r->description, MB_CASE_TITLE, "UTF-8");
      echo "<button id='product' data-id='$r->id' data-price='$r->price' type='button' class='btn btn-block bg-gradient-info' data-toggle='modal' data-target='#qty_price'>$description</button>";
      }
    }
  }

  public function SaleSave(){
    session_start();
    $user_id = $_SESSION["id-OLMO"];
    $product_id=$_REQUEST['product_id'];
    $qty=$_REQUEST['qty'];
    $obs=$_REQUEST['obs'];
    $price=$_REQUEST['price'];
    $total_price=array_sum($price);
    $this->model->SaleSave($product_id,$qty,$total_price,$price,$obs,$user_id);
  }

}