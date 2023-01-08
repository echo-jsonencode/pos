$(document).ready(function () {
    Alerts.loadTableDataExpiredStatus();
    Alerts.loadTableDataStockStatus();
});


const Alerts = (() => {
    const thisAlerts = {};

    thisAlerts.loadTableDataExpiredStatus = () => {
        $.ajax({
            type: "GET",
            url: ALERT_CONTROLLER + '?action=getTableDataExpirationStatus',
            dataType: "json",
            success: function (response) {
                $('.table').DataTable().destroy();
                $('#tbody_expiration_status').html(response);

                $('.table').DataTable();
            },
            error: function () {

            }
        });
    }

    thisAlerts.loadTableDataStockStatus = () => {
        $.ajax({
            type: "GET",
            url: ALERT_CONTROLLER + '?action=getTableDataStockStatus',
            dataType: "json",
            success: function (response) {
                $('.table').DataTable().destroy();
                $('#tbody_stock_status').html(response);

                $('.table').DataTable();
            },
            error: function () {

            }
        });
    }

    return thisAlerts;
})();