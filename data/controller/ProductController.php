<?php

include_once('../../config/database.php');
include_once('../model/Category.php');
include_once('../model/Product.php');
include_once('../model/ProductDetails.php');


$action = $_GET['action'];
$Category = new Category($conn);
$Product = new Product($conn);
$ProductDetails = new ProductDetails($conn);

if(isset($_GET['barcode'])){
    $barcode = $_GET['barcode'];
}

if ($action == 'getTableDataRegister') 
{
    $result = $ProductDetails->getAll();

    $table_data = '';
    $counter = 1;
    foreach ($result as $product) {
        $table_data .= '<tr>';
        $table_data .= '<td>' . $counter . '</td>';
        $table_data .= '<td>' . $product['product_name'] . '</td>';
        $table_data .= '<td>' . $product['barcode'] . '</td>';
        $table_data .= '<td>' . $product['batch'] . '</td>';
        $table_data .= '<td class="col-actions">';
        $table_data .= '<div class="btn-group" role="group" aria-label="Basic mixed styles example">';
        $table_data .= '<button type="button" onclick="Product.
        clickUpdate('. $product['product_details_id'] .','. $product['product_id'] .')" class="btn btn-warning btn-sm"><i class="bi bi-list-check"></i> Update </button>';
        // $table_data .= '<button type="button" onclick="Product.clickDelete('. $product['product_details_id'] .')" class="btn btn-danger btn-sm"> <i class="bi bi-trash"></i> Delete</button>';
        $table_data .= '</div>';
        $table_data .= '</td>';
        $table_data .= '</tr>';

        $counter++;
    }

    echo json_encode($table_data);
}

else if ($action == 'getProductTable') 
{
    $result = $Product->getAll();

    $table_data = '';
    $counter = 1;
    foreach ($result as $product) {
        $status = ($product['status'] == 1) ? 'Active' : 'Inactive';
        $product_name = "'" . addslashes($product['product_name']) . "'";

        $table_data .= '<tr>';
        $table_data .= '<td>' . $counter . '</td>';
        $table_data .= '<td>' . $product['product_name'] . '</td>';
        $table_data .= '<td><span class="category">' . $product['category_name'] . '</span></td>';
        $table_data .= '<td>' . $product['type'] . '</td>';
        $table_data .= '<td>' . $product['barcode'] . '</td>';
        $table_data .= '<td>' . $product['total_quantity'] . '</td>';
        $table_data .= '<td>' . $product['max_stock'] . '</td>';
        $table_data .= '<td>' . $product['min_stock'] . '</td>';
        $table_data .= '<td>' . $product['sale_price'] . '</td>';
        $table_data .= '<td>' . $status . '</td>';
        $table_data .= '<td>' . $product['expired_products'] . '</td>';
        $table_data .= '<td class="col-actions">';
        $table_data .= '<div class="btn-group" role="group" aria-label="Basic mixed styles example">';
        $table_data .= '<button type="button" onclick="Product.clickView('. $product['product_id'] .','. $product_name .')" class="btn btn-info btn-sm"><i class="bi bi-eye"></i> View </button>';
        if($_SESSION['user']['role'] != 3) {
            $table_data .= '<button type="button" onclick="Product.clickUpdate('. $product['product_id'] .','. $product_name .')" class="btn btn-warning btn-sm"><i class="bi bi-list-check"></i> Update </button>';
        // $table_data .= '<button type="button" onclick="Product.clickDelete('. $product['product_details_id'] .')" class="btn btn-danger btn-sm"> <i class="bi bi-trash"></i> Delete</button>';
        }
        $table_data .= '</div>';
        $table_data .= '</td>';
        $table_data .= '</tr>';

        $counter++;
    }

    echo json_encode($table_data);
}

else if ($action == 'getProductDetailsTableModal') 
{
    $product_id = $_POST['product_id'];
    $result = $ProductDetails->getAllByProductId($product_id);

    $table_data = '';
    foreach ($result as $productDetails) {
        $expired_status = ($productDetails['expired_status'] == 1) ? 'Yes' : 'No';

        $table_data .= '<tr>';
        $table_data .= '<td>' . $productDetails['batch'] . '</td>';
        $table_data .= '<td>' . $productDetails['quantity'] . '</td>';
        $table_data .= '<td>' . $productDetails['buy_price'] . '</td>';
        $table_data .= '<td>' . $productDetails['date_added'] . '</td>';
        $table_data .= '<td>' . $productDetails['manufacture_date'] . '</td>';
        $table_data .= '<td>' . $productDetails['expiration_date'] . '</td>';
        $table_data .= '<td>' . $expired_status . '</td>';
        // $table_data .= '<td class="col-actions">';
        // $table_data .= '<div class="btn-group" role="group" aria-label="Basic mixed styles example">';
        // // $table_data .= '<button type="button" onclick="Product.clickUpdate('. $productDetails['product_details_id'] .','. $productDetails['product_id'] .')" class="btn btn-warning btn-sm"><i class="bi bi-list-check"></i> Update </button>';
        // if($_SESSION['user']['role'] == 1) {
        // // $table_data .= '<button type="button" onclick="Product.clickDelete('. $productDetails['product_details_id'] .')" class="btn btn-danger btn-sm"> <i class="bi bi-trash"></i> Delete</button>';
        // }
        // $table_data .= '</div>';
        // $table_data .= '</td>';
        $table_data .= '</tr>';

    }

    echo json_encode($table_data);
}

else if ($action == 'getSelectData')
{
    $result = $Category->getAll();

    $options = '<option value="" selected="true" disabled>Select Category</option>';

    foreach ($result as $category) 
    {
        $options .= '<option value='. $category['id'] .'>' . $category['name'] . '</option>';
    }

    echo json_encode($options);
}

else if ($action == 'getById')
{
    $product_details_id = $_POST['product_details_id'];

    echo json_encode($ProductDetails->getById($product_details_id));
}

else if ($action == 'save')
{
    $product_barcode = $_POST['product_barcode'];
    $product_name = $_POST['product_name'];
    $product_category = $_POST['product_category'];
    $buying_price = $_POST['buying_price'];
    $selling_price = $_POST['selling_price'];
    $manufature_date = $_POST['manufature_date'];
    $expiraton_date = $_POST['expiraton_date'];
    $status = $_POST['status'];
    $quantity = $_POST['quantity'];
    $type = $_POST['type'];


    $request = [
        'product_barcode' => $product_barcode,
        'product_name' => $product_name,
        'product_category' => $product_category,
        'buying_price' => $buying_price,
        'selling_price' => $selling_price,
        'manufature_date' => $manufature_date,
        'expiraton_date' => $expiraton_date,
        'status' => $status,
        'quantity' => $quantity,
        'type' => $type,
    ];

    
    $product = $Product->getByBarcode($product_barcode);
    
    $lastInsertID = '';
    if(empty($product)) 
    {
        $lastInsertID = $Product->save($request);
        $request['product_id'] = $lastInsertID;
    }
    else 
    {
        $request['product_id'] = $product['id'];
        $Product->updateSellPrice($request);
    }
    
    $result = $ProductDetails->save($request);

    echo json_encode($result);
}

else if ($action == 'updateProductDetails')
{
    $product_id = $_POST['product_id'];
    $product_details_id = $_POST['product_details_id'];
    $buying_price = $_POST['buying_price'];
    $selling_price = $_POST['selling_price'];
    $manufature_date = $_POST['manufature_date'];
    $expiraton_date = $_POST['expiraton_date'];
    $quantity = $_POST['quantity'];

    $request = [
        'product_id' => $product_id,
        'product_details_id' => $product_details_id,
        'buying_price' => $buying_price,
        'selling_price' => $selling_price,
        'manufature_date' => $manufature_date,
        'expiraton_date' => $expiraton_date,
        'quantity' => $quantity,
    ];
    $Product->updateSellPrice($request);
    $result = $ProductDetails->update($request);

    echo json_encode($result);
}

else if ($action == 'getProductForUpdate')
{
    $product_id = $_POST['product_id'];

    $result = $Product->getById($product_id);

    echo json_encode($result);
}


else if ($action == 'updateProduct')
{
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_barcode = $_POST['product_barcode'];
    $product_category = $_POST['product_category'];
    $selling_price = $_POST['selling_price'];
    $status = $_POST['status'];
    $max_stock = $_POST['max_stock'];
    $min_stock = $_POST['min_stock'];
    $type = $_POST['type'];
    // $expired_products = $_POST['expired_products'];

    $request = [
        'product_id' => $product_id,
        'product_name' => $product_name,
        'product_barcode' => $product_barcode,
        'product_category' => $product_category,
        'selling_price' => $selling_price,
        'status' => $status,
        'max_stock' => $max_stock,
        'min_stock' => $min_stock,
        'type' => $type,
        // 'expired_products' => $expired_products,
    ];

    $result = $Product->update($request);

    echo json_encode($result);

}

else if($action === 'getAvailableProductByBarcode'){
    $result = $Product->getAvailableProductByBarcode($barcode);
    echo json_encode($result);
}

else if($action === 'getTotalProduct')
{
    $result = $Product->getTotalProduct();
    echo json_encode($result);
}


