$(document).ready(function () {
    Category.loadTableData();
    Category.loadSelectData();

    Product.loadTableData();

    $('.btn').click(function (event){
        event.preventDefault()
    })
});


const Category = (() => {
    const thisCategory = {};

    const categoryUrl = '../../data/controller/CategoryController.php';
    let category_id = '';

    let toUpdate = false;

    thisCategory.loadTableData = () => {
        $.ajax({
            type: "GET",
            url: categoryUrl + '?action=getTableData',
            dataType: "json",
            success: function (response) {

                $('#tbody_category').html(response);

                $('.table').DataTable();
            },
            error: function () {

            }
        });
    }

    thisCategory.loadSelectData = () => {
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

    thisCategory.clickSaveButton= () => {
        if(!toUpdate) {
            thisCategory.save()
        }
        else {
            thisCategory.update()
        }
    }

    thisCategory.save = () => {
        const category_name = $('#txt_category_name').val();

        $.ajax({
            type: "POST",
            url: categoryUrl + '?action=save',
            dataType: "json",
            data:{
                category_name: category_name
            },
            success: function (response) 
            {
                $('#txt_category_name').val("")
                thisCategory.loadTableData();
                thisCategory.loadSelectData();
            },
            error: function () {

            }
        });
    }

    thisCategory.clickUpdate = (id) => {
        category_id = id;

        $.ajax({
            type: "POST",
            url: categoryUrl + '?action=getById',
            dataType: "json",
            data:{
                category_id: category_id
            },
            success: function (response) 
            {
                $('#txt_category_name').val(response.name);
                toUpdate = true;

                $('#btn_save_category').html('Update Category');
            },
            error: function () {

            }
        });
    }

    thisCategory.update = () => {
        const category_name = $('#txt_category_name').val();

        $.ajax({
            type: "POST",
            url: categoryUrl + '?action=update',
            dataType: "json",
            data:{
                category_id: category_id,
                category_name: category_name
            },
            success: function (response) 
            {
                $('#txt_category_name').val("")
                thisCategory.loadTableData();
                thisCategory.loadSelectData();
                $('#btn_save_category').html('Register Category');
                toUpdate = false;
            },
            error: function () {

            }
        });
    }

    thisCategory.clickCancel = () => {
        $('#txt_category_name').val("")
        toUpdate = false;
        $('#btn_save_category').html('Register Category');
    }

    thisCategory.clickCancel = () => {
        $('#txt_category_name').val("")
        toUpdate = false;
        $('#btn_save_category').html('Register Category');
    }

    thisCategory.clickDelete = (id) => {
        category_id = id

        thisCategory.delete();
    }

    thisCategory.delete = () => {
        $.ajax({
            type: "POST",
            url: categoryUrl + '?action=delete',
            dataType: "json",
            data:{
                category_id: category_id
            },
            success: function (response) 
            {
                thisCategory.loadTableData();
                thisCategory.loadSelectData();
            },
            error: function () {

            }
        });
    }

    return thisCategory;
})()

const Product = (() => {
    let thisProduct = {};

    const productUrl = '../../data/controller/ProductController.php';

    let product_id;
    let product_details_id;
    let toUpdate = false;


    thisProduct.loadTableData = () => {
        $.ajax({
            type: "GET",
            url: productUrl + '?action=getTableDataRegister',
            dataType: "json",
            success: function (response) {
                
                $('#tbody_product').html(response);

                $('.table').DataTable();
            },
            error: function () {

            }
        });
    }


    thisProduct.clickSaveButton= () => {
        if(!toUpdate) {
            thisProduct.save()
        }
        else {
            thisProduct.update()
        }
    }

    thisProduct.save = () => {
        const product_barcode = $('#txt_product_barcode').val();
        const product_name = $('#txt_product_name').val();
        const product_category = $('#slc_product_category').val();
        const buying_price = $('#txt_buying_price').val();
        const selling_price = $('#txt_selling_price').val();
        const expiraton_date = $('#txt_expiraton_date').val();
        const status = $('#slc_status').val();
        const quantity = $('#txt_quantity').val();

        $.ajax({
            type: "POST",
            url: productUrl + '?action=save',
            dataType: "json",
            data:{
                product_barcode: product_barcode,
                product_name: product_name,
                product_category: product_category,
                buying_price: buying_price,
                selling_price: selling_price,
                expiraton_date: expiraton_date,
                status: status,
                quantity: quantity,
            },
            success: function (response) 
            {
                thisProduct.loadTableData();
                thisProduct.resetFields();
            },
            error: function () {

            }
        });
    }

    thisProduct.clickUpdate = (id, product_table_id) => {
        product_details_id = id;
        product_id = product_table_id;

        $.ajax({
            type: "POST",
            url: productUrl + '?action=getById',
            dataType: "json",
            data:{
                product_details_id: product_details_id
            },
            success: function (response) 
            {
                $('#txt_product_barcode').val(response.barcode);
                $('#txt_product_barcode').prop( "disabled", true );
                $('#txt_product_name').val(response.product_name);
                $('#txt_product_name').prop( "disabled", true );
                $('#slc_product_category').val(response.category_id);
                $('#slc_product_category').prop( "disabled", true );
                $('#txt_buying_price').val(response.buy_price);
                $('#txt_selling_price').val(response.sale_price);
                $('#txt_selling_price').prop( "disabled", true );
                $('#txt_expiraton_date').val(response.expiration_date);
                $('#slc_status').val(response.status);
                $('#slc_status').prop( "disabled", true );
                $('#txt_quantity').val(response.quantity);

                toUpdate = true;

                $('#btn_save_product').html('Update Product');
            },
            error: function () {

            }
        });
    }

    thisProduct.update = () => {
        const buying_price = $('#txt_buying_price').val();
        const expiration_date = $('#txt_expiraton_date').val();
        const quantity = $('#txt_quantity').val();
        
        $.ajax({
            type: "POST",
            url: productUrl + '?action=updateProductDetails',
            dataType: "json",
            data:{
                product_id: product_id,
                product_details_id: product_details_id,
                buying_price: buying_price,
                expiration_date: expiration_date,
                quantity: quantity,
            },
            success: function (response) 
            {
                thisProduct.loadTableData();
                thisProduct.resetFields();
            },
            error: function () {

            }
        });
    }

    thisProduct.resetFields = () => {
        toUpdate = false;

        $('#txt_product_barcode').val("");
        $('#txt_product_name').val("");
        $('#slc_product_category').val("");
        $('#txt_buying_price').val("");
        $('#txt_selling_price').val("");
        $('#txt_expiraton_date').val("");
        $('#slc_status').val("");
        $('#txt_quantity').val("");

        $('.form-control').prop("disabled", false);

        $('#btn_save_product').html('Register Product');
    }



    return thisProduct;
})();