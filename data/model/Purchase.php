<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include_once('ActionLog.php');

class Purchase
{
    private $conn;
    private $ActionLog;

    private $commonSql = "SELECT p.id AS purchase_id, orders, quantity, amount, order_date, receiving_date, supplier, status, paid, delivery, received, stock, damaged, incomplete, theft FROM purchase p";

    private $orderBy = " ORDER BY p.id ";

    public function __construct($connection)
    {
        $this->conn = $connection;
        $this->ActionLog = new ActionLog($connection);
    }

    public function getAllPurchases()
    {
        $sql = $this->commonSql . $this->orderBy ;
        $result = $this->conn->query($sql);

        $this->conn->close();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function save($request)
    {
        $orders = $request['orders'];
        $quantity = $request['quantity'];
        $amount = $request['amount'];
        $order_date = $request['order_date'];
        $receiving_date = $request['receiving_date'];
        $supplier = $request['supplier'];

        $sql = "INSERT INTO purchase(orders, quantity, amount, order_date, receiving_date, supplier) VALUES (?,?,?,?,?,?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("siissi",$orders,$quantity,$amount,$order_date,$receiving_date,$supplier);

        $result = '';
        if ($stmt->execute() === TRUE) {
            $result = "Successfully Save";

        } else {
            $result = "Error: <br>" . $this->conn->error;
        }

        $this->conn->close();

        return $result;
    }

    public function update($request)
    {   
        $purchase_id = $request['purchase_id'];
        $paid = $request['paid'];
        $delivery = $request['delivery'];
        $received = $request['received'];
        $stock = $request['stock'];
        $damaged = $request['damaged'];
        $incomplete = $request['incomplete'];
        $theft = $request['theft'];

        $sql = "UPDATE purchase SET paid= ?, delivery= ?, received= ?, stock= ?, damaged= ?, incomplete= ?, theft= ? WHERE id= ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssiiii",$paid, $delivery, $received, $stock, $damaged, $incomplete, $theft, $purchase_id);

        $result = '';
        if ($stmt->execute() === TRUE) {
            $result = "Updated Successfully";
            // $this->adjustBatchNumber($product_id);
            // $this->ActionLog->saveLogs('product_details', 'updated');
        } else {
            $result = "Error updating record: " . $this->conn->error;
        }

        $this->conn->close();

        return $result;               
    }

    // public function getById($purchase_id)
    // {
    //     $sql = $this->getAllquery . " WHERE p.id = $purchase_id";
    //     $result = $this->conn->query($sql);

    //     $this->conn->close();
    //     return $result->fetch_assoc();
    // }

        // public function getAllPurchases()
        // {
        //     $sql = $this->PurchaseSql . $this->orderBy;
        //     $result = $this->conn->query($sql);
    
        //     $this->conn->close();

        //     return $result->fetch_all(MYSQLI_ASSOC);
        // }

}

?>