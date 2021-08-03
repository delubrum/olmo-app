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

    public function ProductSearch($description) {
        try {
        $stm = $this->pdo->prepare("SELECT * 
        FROM products a
        LEFT JOIN inventory b
        ON a.id = b.product_id
        WHERE description like ? 
        AND b.qty > 0
        ORDER BY id ASC");
        $stm->execute(array("%$description%"));
        return $stm->fetchAll(PDO::FETCH_OBJ);
        }
        catch (Exception $e) {
        die($e->getMessage());
        }
    }

    public function ProductByCategory($id) {
        try {
        $stm = $this->pdo->prepare("SELECT * 
        FROM products a
        LEFT JOIN inventory b
        ON a.id = b.product_id
        WHERE category_id = ?
        AND b.qty > 0
        ORDER BY id ASC");
        $stm->execute(array($id));
        return $stm->fetchAll(PDO::FETCH_OBJ);
        }
        catch (Exception $e) {
        die($e->getMessage());
        }
    }

    public function SaleSave($product_id,$qty,$total_price,$price,$obs,$user_id) {
        try {
            $sql = "INSERT INTO sales (price,obs,user_id) VALUES (?,?,?)";
            $this->pdo->prepare($sql)->execute(array($total_price,$obs,$user_id));
        }
            catch (Exception $e) {
            die($e->getMessage());
        }

        $last_id = $this->pdo->lastInsertId();

        try {
            $sql = "INSERT INTO sales_detail (sale_id,product_id,qty,price) VALUES";
			foreach($product_id as $k => $r){
				$sql.="('$last_id','$r','$qty[$k]','$price[$k]'),";
			}
			$sql=rtrim($sql,',');
			$this->pdo->prepare($sql)->execute();
        }
            catch (Exception $e) {
            die($e->getMessage());
        }

        foreach($product_id as $k => $r){
            $inventory_qty = $qty[$k] - $this->InventoryGet($r)->qty;
            $this->InventoryUpdate($inventory_qty,$r);
        }
          
    }

    public function SalesList() {
        try {
            $stm = $this->pdo->prepare("SELECT
            a.id, a.created_at,a.price,a.obs,b.name as user
            FROM sales a
            LEFT JOIN users b
            ON a.user_id = b.id
            ORDER BY a.id DESC
            ");
            $stm->execute(array());
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
            catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function InventoryList() {
        try {
            $stm = $this->pdo->prepare("SELECT *
            FROM inventory a
            LEFT JOIN products b
            ON a.product_id = b.id
            ORDER BY b.description ASC
            ");
            $stm->execute(array());
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
            catch (Exception $e) {
            die($e->getMessage());
        }
    }

}