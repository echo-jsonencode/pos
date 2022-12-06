<!doctype html>
<html lang="en">

<?php include '../layouts/head.php' ?>

<style>

</style>

<body>
    <?php include '../layouts/nav.php'; ?>

    <div class="container">
        <section class="pos">
            <div class="pos__head">
                <div class="pos__head__date">
                    <span><?php echo date('l, Y-m-d'); ?></span>
                    <p class="pos__head__time"><?php echo date('h:i:s A'); ?></p>
                </div>

                <div class="pos__head__sale">
                    <p>
                        Todays Sale: <span class="pos__head__amount">₱10 000.00</span>
                    </p>
                </div>
            </div>

            <div class="pos__body">
                <div class="pos__body__header">
                    <h2 class="pos__body__title">Home - Manage Sales</h2>
                </div>

                <div class="pos__body__content">
                    <form class="pos__body__form" action="">
                        <input type="text" placeholder="barcode">
                        <input type="text" placeholder="Product">
                        <select name="" id="">
                            <option disabled selected=true value="">Select...</option>
                            <option value="">Batch 1</option>
                            <option value="">Batch 2</option>
                            <option value="">Batch 3</option>
                        </select>
                        <input type="text" placeholder="quantity">
                        <button type="submit">Add to cart</button>
                    </form>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Expiry Date</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            for ($i = 1; $i <= 50; $i++) {
                                $buyPrice = rand(10, 1000);
                                $qty = rand(1, 200);
                                $amount = $buyPrice*$qty;
                            ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td>Century Tuna</td>
                                    <td><span class="category">Gallenicals</span></td>
                                    <td><?php echo date('Y-m-d', strtotime('+5 days')) ?></td>
                                    <td><?php echo $buyPrice ?></td>
                                    <td><?php echo $qty; ?></td>
                                    <td><?php echo $amount; ?></td>

                                    <td>
                                        <!-- <button type="button" class="btn btn-warning btn-sm"><i class="bi bi-list-check"></i> Update </button> -->
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>



    <?php include '../layouts/scripts.php' ?>
    <script src="../../libs/scripts/pos/time.js"></script>
</body>

</html>