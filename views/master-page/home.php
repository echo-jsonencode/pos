<!doctype html>
<html lang="en">

<?php include '../layouts/head.php' ?>

<?php
if (!$_SESSION['user']) {
    header("Location: login.php");
}

?>

<style>

</style>

<body>
    <?php include '../layouts/nav.php'; ?>

    <div class="container">

        <div class="table-grid table-grid--res">
            <div class="box box--date-time">
                <div class="box-wrapper">
                    <div class="dateholder">
                        <?php
                        $monthNum  = date('m');
                        $monthName = date('F', mktime(0, 0, 0, $monthNum, 10));
                        ?>
                        <h2><?php echo $monthName; ?></h2>
                        <h2><?php echo date('d'); ?></h2>
                        <h2><?php echo date('Y'); ?></h2>
                        <h3><?php echo date('h:i:A') ?></h3>
                    </div>
                </div>
            </div>
            <div class="box box--products">
                <div class="box-wrapper">
                    <div class="box">
                        <h1 id="lbl_total_product"></h1>
                        <h2>Total Products</h2>
                    </div>
                </div>
            </div>
            <div class="box box--sales">
                <div class="box-wrapper">
                    <div class="box">
                        <h1 id="lbl_sales_today"></h1>
                        <h2>Total Sales Today</h2>
                    </div>
                </div>
            </div>
            <div class="box box--report">
                <div class="box-wrapper">
                    <h5>Purchased Category per Month(6 Months)</h5>
                    <canvas id="home_canvas"></canvas>
                </div>
            </div>
        </div>






        <?php include '../layouts/scripts.php' ?>
</body>
<script src="../../libs/scripts/master-page/home.js"></script>

</html>