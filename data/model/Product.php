<?php

class Product
{
    private $conn;

    private $commonSql = "SELECT p.id AS product_id, p.name AS product_name, barcode, sale_price, status, max_stock, min_stock,
    c.id AS category_id, c.name AS category_name,
    SUM(pd.quantity) AS total_quantity
    FROM products p 
    INNER JOIN categories c 
    ON p.category_id = c.id 
    INNER JOIN product_details pd 
    ON p.id = pd.product_id ";

    private $groupBySql = " GROUP BY p.id, p.name, barcode, sale_price, status, max_stock, min_stock,
    c.id, c.name";

    public function __construct($connection)
    {
        $this->conn = $connection;
    }

    public function getAll()
    {
        $sql = $this->commonSql . ' WHERE expired_status = 0 ' . $this->groupBySql ;
        $result = $this->conn->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getByBarcode($barcode)
    {
        $sql = "SELECT id, name from products where barcode = '$barcode'";
        $result = $this->conn->query($sql);

        return $result->fetch_assoc();
    }

    public function getById($product_id)
    {
        $sql = "SELECT id, category_id, barcode, name, sale_price, status, max_stock, min_stock from products where id = '$product_id'";
        $result = $this->conn->query($sql);

        return $result->fetch_assoc();
    }

    public function save($request)
    {
        $product_barcode = $request['product_barcode'];
        $product_name = $request['product_name'];
        $product_category = $request['product_category'];
        $selling_price = $request['selling_price'];
        $status = $request['status'];

        $sql = "INSERT INTO products (category_id,barcode,name,sale_price,status) VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("issdi",$product_category, $product_barcode, $product_name, $selling_price, $status);
        
        $result = '';
        if ($stmt->execute() === TRUE) {
            $result = "Successfully Save";
            return $this->conn->insert_id;
        } else {
            return "Error: " . $sql . "<br>" . $this->conn->error;
        }

    }

    public function update($request)
    {
        $product_id = $request['product_id'];
        $product_name = $request['product_name'];
        $product_barcode = $request['product_barcode'];
        $product_category = $request['product_category'];
        $selling_price = $request['selling_price'];
        $status = $request['status'];
        $max_stock = $request['max_stock'];
        $min_stock = $request['min_stock'];

        $sql = "UPDATE products 
        SET category_id= ?, barcode= ?, name= ?, sale_price= ?, status= ?, max_stock=?, min_stock=?
        WHERE id= ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("issdiiii",$product_category, $product_barcode, $product_name, $selling_price, $status, $max_stock, $min_stock, $product_id);
        
        $result = '';
        if ($stmt->execute() === TRUE) {
            $result = "Successfully Update";
            return $this->conn->insert_id;
        } else {
            return "Error: " . $sql . "<br>" . $this->conn->error;
        }

    }


    public function updateSellPrice($request)
    {
        $id = $request['product_id'];
        $sale_price = $request['selling_price'];

        $sql = "UPDATE products SET sale_price=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("di",$sale_price, $id);

        $result = '';
        if ($stmt->execute() === TRUE) {
            $result = "Updated Successfully";
        } else {
            $result = "Error updating record: " . $this->conn->error;
        }

        return $result;
    }

    public function delete($category_id)
    {
        $sql = "DELETE FROM categories WHERE id=$category_id";

        $result = '';
        if ($this->conn->query($sql) === TRUE) {
            $result = "Deleted Successfully";
        } else {
            $result = "Error deleting record: " . $this->conn->error;
        }

        $this->conn->close();

        return $result;


    }
}
