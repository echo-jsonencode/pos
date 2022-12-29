$(document).ready(function () {

    Product.loadTableData();
    Product.loadSelectData();


    $('.btn').click(function (event) {
        event.preventDefault()
    })
});


const Product = (() => {
    const thisProduct = {};
    const productUrl = '../../data/controller/ProductController.php';
    const categoryUrl = '../../data/controller/CategoryController.php';

    let product_id;

    thisProduct.loadTableData = () => {
        $.ajax({
            type: "GET",
            url: productUrl + '?action=getProductTable',
            dataType: "json",
            success: function (response) {
                $('.table').DataTable().destroy();
                $('#tbody_product').html(response);

                $('.table').DataTable();
            },
            error: function () {

            }
        });
    }

    thisProduct.loadSelectData = () => {
        $.ajax({
            type: "GET",
            url: categoryUrl + '?action=getSelectData',
            dataType: "json",
            success: function (response) {

                $('#slc_product_category').html(response);
            },
            error: function () {

            }
        });
    }

    thisProduct.clickView = (id, proudct_name) => {
        $.ajax({
            type: "POST",
            url: productUrl + '?action=getProductDetailsTableModal',
            dataType: "json",
            data:{
                product_id: id
            },
            success: function (response) {
                $('#modal_view_details').modal('show')
                $('#modal_view_deatils_header').html(proudct_name)

                $('#tbody_product_details').html(response);
            },
            error: function () {

            }
        });
    }

    thisProduct.clickUpdate = (id, product_name) => {
        product_id = id;

        $.ajax({
            type: "POST",
            url: productUrl + '?action=getProductForUpdate',
            dataType: "json",
            data:{
                product_id: id
            },
            success: function (response) {
                $('#txt_product_name').val(response.name);
                $('#txt_product_barcode').val(response.barcode);
                $('#slc_product_category').val(response.category_id);
                $('#txt_selling_price').val(response.sale_price);
                $('#slc_status').val(response.status);
                $('#txt_max_stock').val(response.max_stock);
                $('#txt_min_stock').val(response.min_stock);
                $('#slc_type').val(response.type);

                $('#modal_update_details').modal('show')
                $('#modal_update_details_header').html('Update ' + product_name)

            },
            error: function () {

            }
        });

    }

    thisProduct.update = () => {
        const product_name = $('#txt_product_name').val();
        const product_barcode = $('#txt_product_barcode').val();
        const product_category = $('#slc_product_category').val();
        const selling_price = $('#txt_selling_price').val();
        const status = $('#slc_status').val();
        const max_stock = $('#txt_max_stock').val();
        const min_stock = $('#txt_min_stock').val();
        const type = $('#slc_type').val();

        $.ajax({
            type: "POST",
            url: productUrl + '?action=updateProduct',
            dataType: "json",
            data:{
                product_id: product_id,
                product_name: product_name,
                product_barcode: product_barcode,
                product_category: product_category,
                selling_price: selling_price,
                status: status,
                max_stock: max_stock,
                min_stock: min_stock,
                type: type,
            },
            success: function (response) 
            {
                thisProduct.loadTableData();
                thisProduct.resetFields();
                $('#modal_update_details').modal('hide')
            },
            error: function () {

            }
        });

    }

    thisProduct.resetFields = () => {

        $('#txt_product_barcode').val("");
        $('#txt_product_name').val("");
        $('#slc_product_category').val("");
        $('#txt_selling_price').val("");
        $('#slc_status').val("");
        $('#txt_max_stock').val("");
        $('#txt_min_stock').val("");

        $('#btn_save_product').html('Register Product');
    }

    return thisProduct;
})();