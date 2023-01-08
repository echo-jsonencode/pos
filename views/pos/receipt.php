<?php

include_once('../../config/database.php');
include_once('../../data/model/Invoice.php');

$invoiceModel = new Invoice($conn);


$invoiceId = $_GET['invoice_id'];

$fetch = $invoiceModel->getReceipt($invoiceId);

$invoice = $fetch['details'];
$sales = $fetch['sales'];

$subTotal = 0;
$amountToPay = 0;
foreach ($sales as $product) {
    $subTotal += $product['sale_price'] * $product['qty'];
    $amountToPay += $product['price'];
}
$amountToPay = number_format($amountToPay, 2, '.', '');

$discount = $subTotal - $amountToPay;


$cashPayment = $invoice['cash_payment'];

$change = $cashPayment - $amountToPay;
?>



<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Receipt example</title>
</head>

<body>
    <div class="ticket">
        <p class="centered" style="font-size: 10;"><b>IRONMED DRUGSTORE</b>
            <span style="font-size: 6;"><br>840 F.GOMEZ ST. BRGY. MALUSAK
                <br>SANTA ROSA CITY, LAGUNA </span>
        </p>

        <p></p>
        <p class="centered" style="font-size: 10;">THIS SERVES AS YOUR OFFICIAL RECEIPT</p>

        <p>INVOICE NO: <?php echo $invoice['number']?><br>
            CASHIER NAME: <?php echo $invoice['first_name'] . ' ' .$invoice['last_name']; ?><br>
            TXN DATE: <?php echo $invoice['date_transact']?></p>
        <p class="centered">******************************</p>

        <table style="width:100%">
            <thead>
                <tr>
                    <th class="description" style="width:50%"></th>
                    <th class="centered">PRICE</th>
                    <th class="centered">AMOUNT</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sales as $product) { ?>
                    <tr>
                        <td class="description"><?php echo $product['barcode']?> x<?php echo $product['qty']?> <br><?php echo $product['name']?></td>
                        <td class="centered"><?php echo $product['sale_price']?></td>
                        <td class="centered"><?php echo $product['sale_price'] * $product['qty']?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <p class="right">**************</p>

        <?php if($invoice['discount'] == 1) { ?> 
            <p>OSCA ID: <?php echo $invoice['osca_number']?><br>
                CUSTOMER NAME: <?php echo $invoice['costumer_name']?><br></p>
        <?php } ?>

        <table style="width:100%">
            <thead>
            <tbody>
                <tr>
                    <td class="centered" style="width:50%">SUBTOTAL</td>
                    <td class="" style="width:20%"></td>
                    <td class="centered"><?php echo $subTotal?></td>
                </tr>
                <tr>
                    <td class="centered" style="width:50%">DISCOUNT</td>
                    <td class="" style="width:20%"></td>
                    <td class="centered"><?php echo $discount?></td>
                </tr>
                <tr>
                    <td class="centered" style="width:50%"><b>AMOUNT TO PAY</b></td>
                    <td class="" style="width:20%"></td>
                    <td class="centered"><?php echo $amountToPay?></td>
                </tr>
                <tr>
                    <td class="centered" style="width:50%">CASH</td>
                    <td class="" style="width:20%"></td>
                    <td class="centered"><?php echo $cashPayment?></td>
                </tr>
                <tr>
                    <td class="centered" style="width:50%">CHANGE</td>
                    <td class="" style="width:20%"></td>
                    <td class="centered"><?php echo $change?></td>
                </tr>
            </tbody>
        </table>

        


        <br><br>
        <p class="centered" style="font-size: 7;">EXCHANGE AND RETURNS CAN BE MADE WITHING
            <br>THIRTY (30) DAYS FROM DATE OF PRUCHASE AND
            <br>IS SUBJECT TO STANDARD PROVISION ON CONSUMBER
            <br>PROTECTION AND PRODUCT WARRANTY.
        </p>
    </div>
    <button id="btnPrint" class="hidden-print">Print</button>
    
</body>

</html>

<script>
    window.print();
    // window.close();
    // window.onfocus = function () { window.close(); }
    window.onfocus = function () { setTimeout(function () { window.close(); }, 500); }
    const $btnPrint = document.querySelector("#btnPrint");
    $btnPrint.addEventListener("click", () => {
        window.print();
    });
</script>