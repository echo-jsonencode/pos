<?php

include_once('../../config/database.php');
include_once('../model/Category.php');
include_once('../model/Product.php');
include_once('../model/ProductDetails.php');
include_once('../model/Invoice.php');
include_once('../model/Sales.php');


$action = $_GET['action'];
$Category = new Category($conn);
$Product = new Product($conn);
$ProductDetails = new ProductDetails($conn);
$Invoice = new Invoice($conn);
$Sales = new Sales($conn);


if ($action === 'getReportData') {

    $dateFrom = date('Y-m-d', strtotime($_POST['dateFrom']));
    $dateTo = date('Y-m-d', strtotime($_POST['dateTo']));

    $reports_data = $Sales->getReport($dateFrom, $dateTo);

    $chart_label = [];
    $barchart_dataset = [
        'label' => 'quantity',
        'data' => [],
        'backgroundColor' => []
    ];
    $piechart_dataset = [
        'data' => [],
        'backgroundColor' => []
    ];
    $total_sales = 0;
    foreach ($reports_data as $report_data) {
        $chart_label[] = $report_data['product_name'];

        $color = random_color();
        $color = '#'.$color;
        $piechart_dataset['data'][] = $report_data['total_price'];
        $piechart_dataset['backgroundColor'][] = $color;

        $barchart_dataset['data'][] = $report_data['total_sales'];
        $barchart_dataset['backgroundColor'][] = 'grey';

        $total_sales = $total_sales + $report_data['total_price'];
    }

    $charts_data = [
        'labels' => $chart_label,
        'barchart_dataset' => $barchart_dataset,
        'piechart_dataset' => $piechart_dataset,
        'total_sales' => $total_sales
    ];

    echo json_encode($charts_data);

} else {
    return 'Something went wrong';
}


function random_color_part() {
    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
}

function random_color() {
    return random_color_part() . random_color_part() . random_color_part();
}