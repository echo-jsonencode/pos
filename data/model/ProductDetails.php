<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

class ProductDetails
{
    private $conn;

    private $getAllquery = "SELECT p.id AS product_id, category_id, barcode, p.name AS product_name, sale_price, status, max_stock, min_stock,
    c.name AS category_name, 
    pd.id AS product_details_id, quantity, buy_price, date_added, manufacture_date, expiration_date, batch, expired_status, type
    FROM products p
    INNER JOIN categories as c
    ON p.category_id = c.id
    INNER JOIN product_details pd
    ON p.id = pd.product_id";

    private $orderBy = " ORDER BY p.id, batch";

    public function __construct($connection)
    {
        $this->conn = $connection;
    }

    public function getAll()
    {
        $sql = $this->getAllquery . ' WHERE expired_status = 0 and quantity != 0' . $this->orderBy;

        $result = $this->conn->query($sql);
        
        $this->conn->close();

        return $result->fetch_all(MYSQLI_ASSOC);

    }

    public function getAllByProductId($product_id)
    {
        $sql = $this->getAllquery . " WHERE product_id = $product_id " . $this->orderBy;

        $result = $this->conn->query($sql);
        
        $this->conn->close();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($product_details_id)
    {
        $sql = $this->getAllquery . " WHERE pd.id = $product_details_id";
        $result = $this->conn->query($sql);

        $this->conn->close();
        return $result->fetch_assoc();
    }

    public function getAllAlertExpired()
    {
        $sql = $this->getAllquery . ' where (DATE(expiration_date) < ADDDATE(DATE(NOW()), +7) ) ' . $this->orderBy;

        $result = $this->conn->query($sql);
        
        $this->conn->close();

        return $result->fetch_all(MYSQLI_ASSOC);

    }

    public function save($request)
    {
        $product_id = $request['product_id'];
        $quantity = $request['quantity'];
        $buying_price = $request['buying_price'];
        $manufature_date = $request['manufature_date'];
        $expiraton_date = $request['expiraton_date'];
        $date_added = date("Y-m-d H:i:s");

        $sql = "INSERT INTO product_details (product_id, quantity, buy_price, date_added, manufacture_date, expiration_date) VALUES (?,?,?,?,?,?)";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iidsss",$product_id, $quantity, $buying_price, $date_added, $manufature_date, $expiraton_date);
        
        $result = '';
        if ($stmt->execute() === TRUE) {
            $result = "Successfully Save";
            $this->adjustBatchNumber($product_id);
        } else {
            $result = "Error: " . $sql . "<br>" . $this->conn->error;
        }

        $this->conn->close();

        return $result;
    }

    public function update($request)
    {
        $product_id = $request['product_id'];
        $product_details_id = $request['product_details_id'];
        $buying_price = $request['buying_price'];
        $manufacture_date = $request['manufacture_date'];
        $expiration_date = $request['expiration_date'];
        $quantity = $request['quantity'];

        $sql = "UPDATE product_details 
        SET buy_price= ?, manufacture_date= ?, expiration_date= ?, quantity= ?
        WHERE id= ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("dssii",$buying_price, $manufacture_date, $expiration_date, $quantity, $product_details_id);


        $result = '';
        if ($stmt->execute() === TRUE) {
            $result = "Updated Successfully";
            $this->adjustBatchNumber($product_id);
        } else {
            $result = "Error updating record: " . $this->conn->error;
        }

        $this->conn->close();

        return $result;
    }

    public function adjustBatchNumber($product_id)
    {
        $sql = "SELECT id, expiration_date  from product_details WHERE product_id = $product_id and expired_status = 0 ";
        $result = $this->conn->query($sql);

        $product_details = $result->fetch_all(MYSQLI_ASSOC);

        usort($product_details, 'date_compare');

        $counter = 1;
        foreach ($product_details as $product_detail) {
            $product_details_id = $product_detail['id'];
            $sql = "UPDATE product_details SET batch='$counter' WHERE id=$product_details_id";

            $this->conn->query($sql);

            $counter++;
        }
    }

    public function updateExpiredStatus()
    {
        $date_today = date("Y-m-d");

        $sql = "UPDATE product_details SET expired_status = 1 WHERE expiration_date = '$date_today'";

        $this->conn->query($sql);

        $sql = "SELECT count(*) as total_expired FROM product_details WHERE expired_status = 1 AND expiration_date = '$date_today'";

        $result = $this->conn->query($sql);
        $count = $result->fetch_assoc();

        $_SESSION['alert']['expiredToday'] = $count['total_expired'];
        
        $this->conn->close();
    }
}

function date_compare($element1, $element2) {
    $datetime1 = strtotime($element1['expiration_date']);
    $datetime2 = strtotime($element2['expiration_date']);
    return $datetime1 - $datetime2;
} 
