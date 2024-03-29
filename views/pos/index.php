<!doctype html>
<html lang="en">

<?php include '../layouts/head.php' ?>

<?php 
if(!$_SESSION['user']) {
    header("Location: login.php"); 
}
?>

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

                    <div class="pos__body__discount">
                        <label for="">Apply Discount</label>
                        <input type="checkbox" class="pos__body__discount__input">
                    </div>

                    <div class="pos__body__customer_number">
                        <label for="OSCA ID">OSCA or PWD ID: </label>
                        <input type="text" class="pos__body__customer__number">
                    </div>
                    <div class="pos__body__customer">
                        <label for="Customer Name">Customer Name: </label>
                        <input type="text" class="pos__body__customer__input">
                    </div>
                    <span class="pos__body__customer__error">Please enter <b>OSCA or PWD ID and CUSTOMER NAME and</b> to avail the discount</span>
                </div>

                <div class="pos__body__content">
                    <form class="pos__form" action="">
                        <input type="text" placeholder="barcode" class="pos__form__barcode">
                        <input type="text" placeholder="Product" class="pos__form__product" readonly>
                        <!-- <select name="" id="" class="pos__form__batch">
                            <option disabled selected=true value="">Select...</option>
                            <option value="">Batch 1</option>
                            <option value="">Batch 2</option>
                            <option value="">Batch 3</option>
                        </select> -->
                        <input type="number" min="1" oninput="validity.valid || (value='')" placeholder="quantity" class="pos__form__quantity">
                        <button type="submit" class="pos__button pos__form__submit">Add to cart</button>
                        <button type="button" class="post__button pos__form__checkout" disabled style="background-color:gray">Check out</button>
                    </form>
                    <table class="table table-bordered pos__table" id="pos__table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Type</th>
                                <th>Expiry Date</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Amount</th>

                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>

            <div id="myModal" class="modal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                            <h4 class="modal-title">Confirmation</h4>
                        </div>
                        <div class="modal-body">
                            <ul class="pos__list">
                                <!-- <li class="pos__list__item">
                                <div class="pos__list__item__details">
                                <span class="pos__list__item__quantity">1</span>
                                <p class="pos__list__item__name"> KaboooomKaboooomKaboooomKaboooomKaboooomKaboooom</p>
                                </div>
                                <span class="pos__list__item__price">Php 10.23</span>
                            </li> -->
                                <!-- <li class="pos__list__item">
                                <p class="pos__list__item__name"><span class="pos__list__item__quantity">1</span> Kaboooom</p>
                                <span class="pos__list__item__price">Php 10.23</span>
                            </li>
                            <li class="pos__list__item">
                                <p class="pos__list__item__name"><span class="pos__list__item__quantity">1</span> Kaboooom</p>
                                <span class="pos__list__item__price">Php 10.23</span>
                            </li> -->
                            </ul>                           
                        </div>
                        <span class="pos__insufficient__error">Insufficient Payment</span>
                        <div class="modal-footer">
                            <button class="pos__confirm">Confirm</button>
                            <button type="button" class="btn btn-default pos__close" onclick="closeModal('myModal');">Close</button>
                        </div>
                    </div>

                </div>
            </div>

        </section>
    </div>

    <div class="modal modal-md" id="modal_confirmpassword">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Confirm Admin Password</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <input type="password" class="form-control admin__password__input" id="password__input">
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success admin__password__button">Confirm</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>



    <?php include '../layouts/scripts.php' ?>
    <script src="../../libs/scripts/pos/time.js"></script>
    <script src="../../libs/scripts/pos/pos.js"></script>
    <!-- <script src="../../libs/scripts/reports/invoice.js"></script> -->
</body>

</html>
