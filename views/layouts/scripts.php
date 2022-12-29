<script src="../../libs/plugins/bootstrap/bootstrap.bundle.min.js"></script>
<script src="../../libs/plugins/jquery/jquery-3.6.1.min.js"></script>
<script src="../../libs/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../libs/plugins/datatables/dataTables.bootstrap5.min.js"></script>
<script src="../../libs/plugins/chart.js/Chart.min.js"></script>
<script src="../../libs/plugins/chart.js/Chart.bundle.min.js"></script>
<script src="../../libs/plugins/select2/js/select2.full.min.js"></script>
<script src="../../libs/plugins/sweetalert/sweetalert2.all.min.js"></script>

<script src="../../config/system_name.js"></script>
<script src="../../libs/scripts/vars.js"></script>


<script>
    $('.table').DataTable();


    const logout = () => {

        $.ajax({
            type: "GET",
            url: LOGIN_CONTROLLER + '?action=logout',
            dataType: "json",
            success: function (response) 
            {
                window.location.href = "../../views/master-page/login.php";
            },
            error: function () {

            }
        }); 
    }
</script>