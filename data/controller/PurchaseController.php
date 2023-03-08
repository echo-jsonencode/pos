<?php 
include_once('../../config/database.php');
include_once('../model/Purchase.php');

$action = $_GET['action'];
$Purchase = new Purchase($conn);

if ($action == 'getPurchaseTable')
{
    $result = $Purchase->getAllPurchases();

    $table_data = '';
    $counter = 1;
    foreach ($result as $purchases) {
        $paid = "'" . addslashes($purchases['paid']) . "'";
        $delivery = "'" . addslashes($purchases['delivery']) . "'";
        $received = "'" . addslashes($purchases['received']) . "'";
        $stock = "'" . addslashes($purchases['stock']) . "'";
        $damaged = "'" . addslashes($purchases['damaged']) . "'";
        $incomplete = "'" . addslashes($purchases['incomplete']) . "'";
        $theft = "'" . addslashes($purchases['theft']) . "'";
        $status = $purchases['status'];
        $a = 2;
        $b = 3;
        $c = 4;

        $table_data .= '<tr>';
        $table_data .= '<td>' . $counter . '</td>';
        $table_data .= '<td>' . $purchases['orders'] . '</td>';
        $table_data .= '<td>' . $purchases['quantity'] . '</td>';
        $table_data .= '<td>' . $purchases['amount'] . '</td>';
        $table_data .= '<td>' . $purchases['order_date'] . '</td>';
        $table_data .= '<td>' . $purchases['receiving_date'] . '</td>';
        $table_data .= '<td>' . $purchases['supplier'] . '</td>';
        $table_data .= '<td>' . $purchases['status'] . '</td>';
        $table_data .= '<td class="col-actions">';
        $table_data .= '<div class="btn-group" role="group" aria-label="Basic mixed styles example">';
        if ($status == 0) {
        $table_data .= '<button type="button" id="paid" onclick="Purchase.updateStatus('. $purchases['purchase_id'] .','. $paid .')" class="btn btn-warning btn-sm"><i class="bi bi-list-check"></i> Pay </button>';
        $status ++;
        }
        else if ($status == 1) {
        $table_data .= '<button type="button" id="delivery" onclick="Purchase.updateStatus('. $purchases['purchase_id'] .','. $delivery .')" class="btn btn-warning btn-sm"><i class="bi bi-list-check"></i> On-Delivery </button>';
        $status ++;
        }
        else if ($status == 2) {
        $table_data .= '<button type="button" id="received" onclick="Purchase.updateStatus('. $purchases['purchase_id'] .','. $received .')" class="btn btn-warning btn-sm"><i class="bi bi-list-check"></i> Received </button>';
        $status ++;
        }
        else if ($status == 3) {
        $table_data .= '<button type="button" id="stock" onclick="Purchase.updateStatus('. $purchases['purchase_id'] .','. $stock .')" class="btn btn-warning btn-sm"><i class="bi bi-list-check"></i> On-Stock </button>';
            $status ++;
        $table_data .=    '<button type="button" id="damaged" onclick="Purchase.updateStatus('. $purchases['purchase_id'] .','. $damaged .')"  class="btn btn-warning btn-sm"><i class="bi bi-list-check"></i> Damaged </button>';
            $status += $a;
        $table_data .=     '<button type="button" id="incomplete" onclick="Purchase.updateStatus('. $purchases['purchase_id'] .','. $incomplete .')" class="btn btn-warning btn-sm"><i class="bi bi-list-check"></i> Incomplete </button>';
            $status += $b; 
        $table_data .=     '<button type="button" id="theft" onclick="Purchase.updateStatus('. $purchases['purchase_id'] .','. $theft .')" class="btn btn-warning btn-sm"><i class="bi bi-list-check"></i> Theft </button>';
            $status += $c;

        }
        else if ($status == 4) { 
        $table_data .= '<button type="button" id="status" class="btn btn-warning btn-sm" disabled><i class="bi bi-list-check"></i> On-Stock </button>';
        }
        else if ($status == 5) { 
        $table_data .= '<button type="button" id="status" class="btn btn-warning btn-sm" disabled><i class="bi bi-list-check"></i> Damaged </button><button type="button" onclick="" class="btn btn-warning btn-sm"><i class="bi bi-list-check"></i> Report </button>';
        }
        else if ($status == 6) { 
        $table_data .= '<button type="button" id="status" class="btn btn-warning btn-sm" disabled><i class="bi bi-list-check"></i> Incomplete </button><button type="button" onclick="" class="btn btn-warning btn-sm"><i class="bi bi-list-check"></i> Report </button>';
        }
        else if ($status == 7) { 
        $table_data .= '<button type="button" id="status" class="btn btn-warning btn-sm" disabled><i class="bi bi-list-check"></i> Theft </button><button type="button" onclick="" class="btn btn-warning btn-sm"><i class="bi bi-list-check"></i> Report </button>';
        }

        // $table_data .= '<button type="button" onclick="Product.clickDelete('. $product['product_details_id'] .')" class="btn btn-danger btn-sm"> <i class="bi bi-trash"></i> Delete</button>';
        $table_data .= '</div>';
        $table_data .= '</td>';
        $table_data .= '</tr>';

        $counter ++;
    }

    echo json_encode($table_data);
}

else if ($action == 'createPurchase')
{
    $purchase_id = $_POST['purchase_id'];

    $result = $Purchase->getById($purchase_id);

    echo json_encode($result);
}

else if ($action == 'save')
{
    $orders = $_POST['orders'];
    $quantity = $_POST['quantity'];
    $amount = $_POST['amount'];
    $order_date = $_POST['order_date'];
    $receiving_date = $_POST['receiving_date'];
    $supplier = $_POST['supplier'];



    $request = [
        'orders' => $orders,
        'quantity' => $quantity,
        'amount' => $amount,
        'order_date' => $order_date,
        'receiving_date' => $receiving_date,
        'supplier' => $supplier,
    ];
    
    $result = $Purchase->save($request);

    echo json_encode($result);
}

else if ($action == 'updatePurchaseStatus') 
{

    $purchase_id = $_POST['purchase_id'];
    $paid = $_POST['paid'];
    $delivery = $_POST['delivery'];
    $received = $_POST['received'];
    $stock = $_POST['stock'];
    $damaged = $_POST['damaged'];
    $incomplete = $_POST['incomplete'];
    $theft = $_POST['theft'];

    $request = [
        'purchase_id' => $purchase_id,
        'paid' => $paid,
        'delivery' => $delivery,
        'received' => $received,
        'stock' => $stock,
        'damaged' => $damaged,
        'incomplete' => $incomplete,
        'theft' => $theft,
    ];
    
    $result = $Purchase->update($request);

    echo json_encode($result);    


}

?>