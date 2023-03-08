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

    let category_id = '';

    let toUpdate = false;

    thisCategory.loadTableData = () => {
        $.ajax({
            type: "GET",
            url: CATEGORY_CONTROLLER + '?action=getTableData',
            dataType: "json",
            success: function (response) {
                $('.table').DataTable().destroy();
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
            url: CATEGORY_CONTROLLER + '?action=getSelectData',
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

        if(category_name == "") {
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Category Field should have value',
                showConfirmButton: true,
            })
        }
        else {
            $.ajax({
                type: "POST",
                url: CATEGORY_CONTROLLER + '?action=save',
                dataType: "json",
                data:{
                    category_name: category_name
                },
                success: function (response) 
                {
                    $('#txt_category_name').val("")
                    thisCategory.loadTableData();
                    thisCategory.loadSelectData();
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Category successfully added',
                        showConfirmButton: true,
                    })
                },
                error: function () {
    
                }
            });
        }        
    }

    thisCategory.clickUpdate = (id) => {
        category_id = id;

        $.ajax({
            type: "POST",
            url: CATEGORY_CONTROLLER + '?action=getById',
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
            url: CATEGORY_CONTROLLER + '?action=update',
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
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Category successfully updated',
                    showConfirmButton: true,
                })
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

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                thisCategory.delete();
            }
        })
    }

    thisCategory.delete = () => {
        $.ajax({
            type: "POST",
            url: CATEGORY_CONTROLLER + '?action=delete',
            dataType: "json",
            data:{
                category_id: category_id
            },
            success: function (response) 
            {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Category Successfully Deleted',
                    showConfirmButton: false,
                    timer: 1500
                })
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
    // const sixMonthsFromNow = new Date();
    // sixMonthsFromNow.setMonth(sixMonthsFromNow.getMonth() - 6 );


    let thisProduct = {};

    let product_id;
    let product_details_id;
    let toUpdate = false;


    thisProduct.loadTableData = () => {
        $.ajax({
            type: "GET",
            url: PRODUCT_CONTROLLER + '?action=getTableDataRegister',
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

    thisProduct.clickSaveButton= () => {
        console.log('test');
        if(!toUpdate) {
            console.log('test2');
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
        const manufature_date = $('#txt_manufature_date').val();
        const expiraton_date = $('#txt_expiraton_date').val();
        const status = $('#slc_status').val();
        const quantity = $('#txt_quantity').val();
        const type = $('#slc_type').val();
        const date = new Date();
        date.setDate(date.getDate() + 180);
        var expiration = new Date(expiraton_date);
        var todayDate = Date();
        a = todayDate.toString();
        

        if(product_barcode == "" 
        || product_name == ""
        || product_category == ""
        || buying_price == ""
        || selling_price == ""
        || quantity == ""
        || status == null) {
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Please fillup all fields',
                showConfirmButton: true,
            })
            
        }

        else if (expiraton_date > todayDate){
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Expired product cannot be added',
                showConfirmButton: true,
            })
        }

        else if (expiration < date){
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Invalid expiration date',
                showConfirmButton: true,
            })
        }



        else if (buying_price > selling_price){
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Buying price must be lower than Selling price',
                showConfirmButton: true,
            })

        }
        else {
            $.ajax({
                type: "POST",
                url: PRODUCT_CONTROLLER + '?action=save',
                dataType: "json",
                data:{
                    product_barcode: product_barcode,
                    product_name: product_name,
                    product_category: product_category,
                    buying_price: buying_price,
                    selling_price: selling_price,
                    manufature_date: manufature_date,
                    expiraton_date: expiraton_date,
                    status: status,
                    quantity: quantity,
                    type: type,
                },
                success: function (response) 
                {
                    thisProduct.loadTableData();
                    thisProduct.resetFields();
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Product successfully added',
                        showConfirmButton: true,
                    })
                },
                error: function () {                }
                
                
            });
        }
    }

    thisProduct.clickUpdate = (id, product_table_id) => {
        product_details_id = id;
        product_id = product_table_id;

        $.ajax({
            type: "POST",
            url: PRODUCT_CONTROLLER + '?action=getById',
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
                $('#txt_manufature_date').val(response.manufacture_date);
                $('#txt_expiraton_date').val(response.expiration_date);
                $('#slc_status').val(response.status);
                $('#slc_status').prop( "disabled", true );
                $('#txt_quantity').val(response.quantity);
                $('#slc_type').val(response.type);
                $('#slc_type').prop( "disabled", true );
                
                toUpdate = true;

                $('#btn_save_product').html('Update Product');
            },
            error: function () {

            }
        });
    }

    thisProduct.update = () => {
        const buying_price = $('#txt_buying_price').val();
        const manufacture_date = $('#txt_manufature_date').val();
        const expiraton_date = $('#txt_expiraton_date').val();
        const quantity = $('#txt_quantity').val();

        const date = new Date();
        date.setDate(date.getDate() + 180);
        var expiration = new Date(expiraton_date);
        // var todayDate = Date();
        // a = todayDate.toString(); 

        if(buying_price == ""
        || manufacture_date == "" 
        || expiraton_date == ""
        || quantity == "") {
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Please fillup all fields',
                showConfirmButton: true,
            })
        }
        // else if (expiraton_date > todayDate){
        //     Swal.fire({
        //         position: 'center',
        //         icon: 'warning',
        //         title: 'Expired product cannot be added',
        //         showConfirmButton: true,
        //     })
        // }
        else if (expiration < date){
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Invalid expiration date',
                showConfirmButton: true,
            })
        }
        else {
            $.ajax({
                type: "POST",
                url: PRODUCT_CONTROLLER + '?action=updateProductDetails',
                dataType: "json",
                data:{
                    product_id: product_id,
                    product_details_id: product_details_id,
                    buying_price: buying_price,
                    manufacture_date: manufacture_date,
                    expiraton_date: expiraton_date,
                    quantity: quantity,  
                    date: date,
                },
                success: function () 
                {
                    thisProduct.loadTableData();
                    thisProduct.resetFields();
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Product successfully updated',
                        showConfirmButton: true,
                    })
                },
                error: function () {
    
                }
            });
        }
        
    }

    thisProduct.resetFields = () => {
        toUpdate = false;

        $('#txt_product_barcode').val("");
        $('#txt_product_name').val("");
        $('#slc_product_category').val("");
        $('#txt_buying_price').val("");
        $('#txt_selling_price').val("");
        $('#txt_manufature_date').val("");
        $('#txt_expiraton_date').val("");
        $('#slc_status').val("");
        $('#txt_quantity').val("");
        $('#slc_type').val("");

        $('.form-control').prop("disabled", false);

        $('#btn_save_product').html('Register Product');
    }

    thisProduct.onChangeBarcode = () => {
        const product_barcode = $('#txt_product_barcode').val();
        $.ajax({
            type:'GET',
            url: PRODUCT_CONTROLLER + `?action=getAvailableProductByBarcode&barcode=${product_barcode}`,
            dataType: 'json',
            cache:false,
            success: (response) => {               
                if(response.length > 0){
                    
                    $('#txt_product_name').val(response[0].product_name);
                    $('#txt_product_name').prop( "disabled", true );
                    $('#slc_product_category').val(response[0].category_id);
                    $('#slc_product_category').prop( "disabled", true );
                    $('#txt_buying_price').val(response[0].buy_price);
                    $('#txt_selling_price').val(response[0].sale_price);
                    $('#slc_status').val(response[0].status);
                    $('#slc_status').prop( "disabled", true );
                    $('#slc_type').val(response[0].type);
                    $('#slc_type').prop( "disabled", true );
                }
                else{
                    $('#txt_product_name').val("");
                    $('#slc_product_category').val("");
                    $('#txt_buying_price').val("");
                    $('#txt_selling_price').val("");
                    $('#txt_manufature_date').val("");
                    $('#txt_expiraton_date').val("");
                    $('#slc_status').val("");
                    $('#txt_quantity').val("");
                    $('#slc_type').val("");

                    $('.form-control').prop("disabled", false);
                }
            }
        })
    }



    return thisProduct;
})();