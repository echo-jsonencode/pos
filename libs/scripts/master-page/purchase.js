$(document).ready(function () {

    Purchase.loadPurchaseData();

    $('.btn').click(function (event) {
        event.preventDefault()
    })    
});

const Purchase = (() => {
    const thisPurchase = {};

    thisPurchase.loadPurchaseData = () => {
        $.ajax({
            type: "GET",
            url: PURCHASE_CONTROLLER + '?action=getPurchaseTable',
            dataType: "json",
            success: function (response) {
                // $('.table').DataTable().destroy();
                
                $('#tbody_purchases').html(response);

                $('.table').DataTable();
            },
            error: function () {

            }
        });        
    }

    thisPurchase.openPurchase = () => {
        $('#modal_view_details').modal('show')
    }

    thisPurchase.createPurchase = () => {
        const orders = $('#txt_order').val();
        const quantity = $('#txt_quantity').val();
        const amount = $('#txt_amount').val();
        const order_date = new Date();
        const receiving_date = $('#txt_receiving_date').val();
        const supplier = $('#txt_supplier').val();

        if(orders == "" 
        || quantity == ""
        || amount == ""
        || receiving_date == ""
        || supplier == "") {
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Please fillup all fields',
                showConfirmButton: true,
            })
        }
        else {
            $.ajax({
                type: "POST",
                url: PURCHASE_CONTROLLER + `?action=save`,
                dataType: "json",
                data:{
                    orders: orders,
                    quantity: quantity,
                    amount: amount,
                    order_date: order_date,
                    receiving_date: receiving_date,
                    supplier: supplier,
                },
                success: function (response) 
                {
                    thisPurchase.loadPurchaseData();
                    $('#modal_view_details').modal('hide');
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Order Successfully Added!',
                        showConfirmButton: true,
                    })
                },
                error: function () {
                }
                
            });
        }
    }

    thisPurchase.updateStatus = (id, status) => {
        purchase_id = id;
        status = status;
        // paid = paid;
        // delivery = delivery;
        // received = received;
        // stock = stock;
        // damaged = damaged;
        // incomplete = incomplete;
        // theft = theft;
        // status = status;
        $.ajax({
            type: "POST",
            url: PURCHASE_CONTROLLER + '?action=updatePurchaseStatus',
            dataType: "json",
            data:{
                purchase_id: id,
                paid: paid,
                delivery: delivery,
                received: received,
                stock: stock,
                damaged: damaged,
                incomplete: incomplete,
                theft: theft,
                status: status,

            },            
            success: function (response) {
                // $('.table').DataTable().destroy();
                $('#paid').html(response);
                $('#delivery').html(response);
                $('#received').html(response);
                $('#stock').html(response);
                $('#damaged').html(response);
                $('#incomplete').html(response);
                $('#theft').html(response);
                $('#status').html(response);


                $('.table').DataTable();
            },
            error: function () {

            }
        });        
    }        

    return thisPurchase;
})();