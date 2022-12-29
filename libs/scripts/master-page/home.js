$(document).ready(function () {
    Home.getTotalProduct();
    Home.getTotalSales();
    Home.loadGraph();
});


const Home = (() => {
    const thisHome = {};

    const categoyController = 'CategoryController.php';
    const invoiceController = 'InvoiceController.php';
    const productController = 'ProductController.php';

    thisHome.getTotalProduct = () => {
        const action = '?action=getTotalProduct';
        $.ajax({
            type: "GET",
            url: `${HOST_CONTROLLER}${productController}${action}`,
            dataType: "json",
            success: function (response) {
                $('#lbl_total_product').html(`${response.total_product}`)
            },
            error: function () {

            }
        });
    }

    thisHome.getTotalSales = () => {
        const action = '?action=getTotalSalesToday';
        $.ajax({
            type: "GET",
            url: `${HOST_CONTROLLER}${invoiceController}${action}`,
            dataType: "json",
            success: function (response) {
                $('#lbl_sales_today').html(`₱${response.total_sales}`)
            },
            error: function () {

            }
        });
    }

    thisHome.loadGraph = () => {
        const action = '?action=getCategoryPerMonthReport';
        $.ajax({
            type: "GET",
            url: `${HOST_CONTROLLER}${categoyController}${action}`,
            dataType: "json",
            success: function (response) {
                let chartData = response;

                var graphCanvas = $('#home_canvas').get(0).getContext('2d')

                var barChartData = $.extend(true, {}, chartData)
                var stackedBarChartData = $.extend(true, {}, barChartData)

                var stackedBarChartOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        xAxes: [{
                            stacked: true,
                        }],
                        yAxes: [{
                            stacked: true
                        }]
                    }
                }

                new Chart(graphCanvas, {
                    type: 'bar',
                    data: stackedBarChartData,
                    options: stackedBarChartOptions
                })
            },
            error: function () {

            }
        });

    }

    return thisHome;
})();