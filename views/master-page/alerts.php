<!doctype html>
<html lang="en">

<?php include '../layouts/head.php' ?>

<body>
    <?php include '../layouts/nav.php'; ?>

    <section class="section user">
        <!-- <h1 class="section__title">Admin</h1> -->
        <div class="container-fluid section__body">
            <div class="row">
                <div class="col-lg-12 col-md-12 ">
                    <div class="user__table-wrapper">
                        <h2 class="section__sub-title">Product Table</h2>

                        <div class="table-wrapper">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Message</th>
                                        <th>Product Status</th>
                                        <th>Stock Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for ($i = 1; $i <= 50; $i++) {

                                        $rand1 = rand(1, 3);

                                        if ($rand1 === 1) {
                                            $productStatus = 'Expired';
                                            $category = 'category--red';
                                        }

                                        if ($rand1 === 2) {
                                            $productStatus = 'Near Expiration Date';
                                            $category = 'category--orange';
                                        }

                                        if ($rand1 == 3) {
                                            $productStatus = 'Good Condition';
                                            $category = 'category--green';
                                        }

                                        $rand2 = rand(1, 3);
                                        if ($rand2 === 1) {
                                            $stockStatus = 'Insufficient';
                                            $category2 = 'category--red';
                                        }

                                        if ($rand2 === 2) {
                                            $stockStatus = 'Oversupply';
                                            $category2 = 'category--orange';
                                        }

                                        if ($rand2 == 3) {
                                            $stockStatus = 'Normal';
                                            $category2 = 'category--green';
                                        }
                                    ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td>Century Tuna</td>
                                            <td>Item Added</td>
                                            <td><span class="category <?php echo $category ?>"><?php echo $productStatus ?></span></td>
                                            <td><span class="category <?php echo $category2 ?>"><?php echo $stockStatus ?></span></td>

                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <!-- INACTIVE -->


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



            </div>
        </div>

    </section>
    <?php include '../layouts/scripts.php' ?>
</body>

</html>