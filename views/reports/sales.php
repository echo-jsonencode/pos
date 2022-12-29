<!doctype html>
<html lang="en">

<?php include '../layouts/head.php' ?>
<?php 
if(!$_SESSION['user']) {
    header("Location: login.php"); 
}
?>

<body>
    <?php include '../layouts/nav.php'; ?>

    <section class="section user">
        <h1 class="section__title">Sales</h1>
        <div class="container-fluid section__body">
            <div class="row">
                <div class="col-lg-12 col-md-12 ">
                    <div class="user__table-wrapper">
                        <h2 class="section__sub-title">Sales Report</h2>
                        <div class="row">
                            <div class="invoice__filters">
                                <div class="invoice__filters__left">
                                    <label for="">Filter by</label>
                                    <select name="" id="" class="invoice__filters__select" onchange=" this.dataset.chosen = this.value;">
                                        <option value="0" selected="true">Daily</option>
                                        <option value="1">Monthly</option>
                                        <option value="2">Date Range</option>
                                    </select>
                                </div>
                                <div class="invoice__filters__right">
                                    <div class="invoice__filters__group invoice__filters__daily ">
                                        <label for="" class="invoice__filters__daily__label">Date</label>
                                        <input type="date" id="date_daily" class="invoice__filters__daily__input">
                                        <button class="invoice__filters__daily__button" onclick="Sales.searchClick('Daily')">Search</button>
                                    </div>
                                    <div class="invoice__filters__group invoice__filters__daily hidden">
                                        <label for="" class="invoice__filters__monthly__label">Month/Year</label>
                                        <input type="month" id="date_monthly" class="invoice__filters__monthly__input">
                                        <button class="invoice__filters__monthly__button" onclick="Sales.searchClick('Monthly')">Search</button>
                                    </div>
                                    <div class="invoice__filters__group invoice__filters__range hidden">
                                        <label for="" class="invoice__filters__range__label">Start Date</label>
                                        <input type="date" id="date_start" class="invoice__filters__monthly__input">
                                        <label for="" class="invoice__filters__range__label">End Date</label>
                                        <input type="date" id="date_end" class="invoice__filters__monthly__input">
                                        <button class="invoice__filters__range__button" onclick="Sales.searchClick('DateRange')">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <h4 id="lbl_total_sales">Total Sales</h4> 
                                <canvas id="piechart"></canvas>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <canvas id="productSalesChart"></canvas>
                            </div>
                        </div>


                    </div>
                </div>



            </div>
        </div>


    </section>


    <?php include '../layouts/scripts.php' ?>
    <script src="../../libs/scripts/reports/sales.js"></script>
</body>



</html>