<?php

include_once('../../config/database.php');
include_once('../model/Product.php');
include_once('../model/ProductDetails.php');

$action = $_GET['action'];
$ProductDetails = new ProductDetails($conn);
$Product = new Product($conn);

if ($action == 'getTableDataExpirationStatus') 
{
    $result = $ProductDetails->getAllAlertExpired();

    $table_data = '';
    $counter = 1;
    foreach ($result as $product) {

        $expired_status = '<span class="category category--orange">Near Expiration Date</span>';
        if($product['expired_status'] == 1) 
        {
            $expired_status = '<span class="category category--red">Expired</span>';
        }

        

        $table_data .= '<tr>';
        $table_data .= '<td>' . $counter . '</td>';
        $table_data .= '<td>' . $product['product_name'] . '</td>';
        $table_data .= '<td>' . $product['batch'] . '</td>';
        $table_data .= '<td>' . $product['quantity'] . '</td>';
        $table_data .= '<td>' . $product['expiration_date'] . '</td>';
        $table_data .= '<td>' . $expired_status . '</td>';
        $table_data .= '</tr>';

        $counter++;
    }

    echo json_encode($table_data);
} 
else if ($action == 'getTableDataStockStatus') 
{
    $result = $Product->getAllByStockStatus();

    $table_data = '';
    $counter = 1;
    foreach ($result as $product) {

        $stock_status = '<span class="category category--orange">Oversupply</span>';
        if($product['total_quantity'] < $product['min_stock']) 
        {
            $stock_status = '<span class="category category--red">Insufficient</span>';
        }

        

        $table_data .= '<tr>';
        $table_data .= '<td>' . $counter . '</td>';
        $table_data .= '<td>' . $product['product_name'] . '</td>';
        $table_data .= '<td>' . $product['total_quantity'] . '</td>';
        $table_data .= '<td>' . $product['max_stock'] . '</td>';
        $table_data .= '<td>' . $product['min_stock'] . '</td>';
        $table_data .= '<td>' . $stock_status . '</td>';
        $table_data .= '</tr>';

        $counter++;
    }

    echo json_encode($table_data);
}


