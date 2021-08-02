<?php
class Grnte {
    private $pdo;
    public function __CONSTRUCT() {
        try {
            $this->pdo = Database::Conectar();
            $pdo = null;
        }
            catch(Exception $e) {
            die($e->getMessage());
        }
    }

    public function GetUser($id) {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM users WHERE user_id = ?");
            $stm->execute(array($id));
            return $stm->fetch(PDO::FETCH_OBJ);
        }
            catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ProductsList() {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM products ORDER BY product_id DESC");
            $stm->execute(array());
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
            catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ProductSave($description,$price) {
        try {
            $sql = "INSERT INTO products (description,price) VALUES (?,?)";
            $this->pdo->prepare($sql)->execute(array($description,$price));
        }
            catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ProductActive($val,$id) {
        try {
            $sql = "UPDATE products set active = ? WHERE product_id = ?";
            $this->pdo->prepare($sql)->execute(array($val,$id));
        }
            catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function SaleSave($product_id,$price,$obs,$user_id) {
        try {
            $sql = "INSERT INTO sales (product_id,price,obs,user_id) VALUES (?,?,?,?)";
            $this->pdo->prepare($sql)->execute(array($product_id,$price,$obs,$user_id));
            return $this->pdo->lastInsertId();
        }
            catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function ListSales() {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM sales ORDER BY sales_id ASC");
            $stm->execute(array());
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
            catch (Exception $e) {
            die($e->getMessage());
        }
    }


}