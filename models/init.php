<?php
class Init {
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

    public function CashboxOpen($id,$amount) {
        try {
        $stm = $this->pdo->prepare("INSERT INTO cashbox (type,user,amount) VALUES ('1',?,?)");
        $stm->execute(array($id,$amount));
        }
        catch (Exception $e) {
        die($e->getMessage());
        }
    }

    public function UserGet($id) {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
            $stm->execute(array($id));
            return $stm->fetch(PDO::FETCH_OBJ);
        }
            catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function CashboxGet() {
        try {
            $stm = $this->pdo->prepare("SELECT * from cashbox ORDER BY id DESC LIMIT 1 ");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        }
            catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ProductsList() {
        try {
            $stm = $this->pdo->prepare("SELECT
            a.id,b.name,a.description,a.price,a.active 
            FROM products a
            LEFT JOIN products_categories b
            ON a.category_id = b.id
            ORDER BY a.id DESC
            ");
            $stm->execute(array());
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
            catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ProductsCategoriesList() {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM products_categories ORDER BY name ASC");
            $stm->execute(array());
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
            catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ProductSave($category_id,$description,$price) {
        try {
            $sql = "INSERT INTO products (category_id,description,price) VALUES (?,?,?)";
            $this->pdo->prepare($sql)->execute(array($category_id,$description,$price));
        }
            catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ProductActive($val,$id) {
        try {
            $sql = "UPDATE products set active = ? WHERE id = ?";
            $this->pdo->prepare($sql)->execute(array($val,$id));
        }
            catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function PurchasesList() {
        try {
            $stm = $this->pdo->prepare("SELECT * 
            FROM purchases a
            LEFT JOIN products b
            ON a.product_id = b.id
            LEFT JOIN products_categories c
            ON b.category_id = c.id
            ORDER BY a.id DESC
            ");
            $stm->execute(array());
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
            catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function InventoryGet($id) {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM inventory WHERE product_id = ?");
            $stm->execute(array($id));
            return $stm->fetch(PDO::FETCH_OBJ);
        }
            catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function PurchaseSave($product_id,$qty,$price,$obs) {
        try {
            $sql = "INSERT INTO purchases (product_id,qty,price,obs) VALUES (?,?,?,?)";
            $this->pdo->prepare($sql)->execute(array($product_id,$qty,$price,$obs));
        }
            catch (Exception $e) {
            die($e->getMessage());
        }
    }    

    public function InventoryUpdate($qty,$product_id) {
        try {
            $sql = "UPDATE inventory set qty = ? WHERE product_id = ?";
            $this->pdo->prepare($sql)->execute(array($qty,$product_id));
        }
            catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function InventorySave($qty,$product_id) {
        try {
            $sql = "INSERT INTO inventory (qty,product_id) VALUES (?,?)";
            $this->pdo->prepare($sql)->execute(array($qty,$product_id));
        }
            catch (Exception $e) {
            die($e->getMessage());
        }
    } 


}