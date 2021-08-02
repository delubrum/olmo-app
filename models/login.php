<?php
class Login {
  private $pdo;
  private $user;
  private $password;

  public function __CONSTRUCT() {
    try	{
      $this->pdo = Database::Conectar();
    }
    catch(Exception $e)	{
      die($e->getMessage());
    }
  }

  public function Login($user,$password) {
    try {
      $stm = $this->pdo->prepare("SELECT id,password FROM users WHERE email = ? and active = 1");
      $stm->execute(array($user));
      $r = $stm->fetch(PDO::FETCH_OBJ);
      if ($stm->rowCount() > 0) {
        if (password_verify($password, $r->password)) {
          session_start();
          $_SESSION["id-OLMO"] = $r->id;
          session_write_close();
          return true;
          return $stm->fetch(PDO::FETCH_OBJ);
        } else {
          return false;
        }
      } else {
        return false;
      }
    }
    catch (Exception $e) {
      die($e->getMessage());
    }
  }

}