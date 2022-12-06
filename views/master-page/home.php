<!doctype html>
<html lang="en">

<?php include '../layouts/head.php' ?>

<style>

</style>

<body>
    <?php include '../layouts/nav.php'; ?>

    <div class="container">

        <table class="table-grid">
            <tr>
                <td class="homebox" rowspan="2">
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
                </td>
                <td class="homebox">
                    <div class="box-wrapper">
                        <div class="box">
                            <h1>9</h1>
                            <h2>Products</h2>
                        </div>
                    </div>
                </td>
                <td class="homebox">
                    <div class="box-wrapper">
                        <div class="box">
                            <h1>9</h1>
                            <h2>Sales</h2>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="homebox" colspan="2">
                    <div class="tableholder">
                        <table class=" table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Date</th>
                                    <th>Total Sale</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 1; $i <= 5; $i++) { ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>


                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
        </table>




        <?php include '../layouts/scripts.php' ?>
</body>

</html>