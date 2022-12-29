$(document).ready(() => {
    checkSalesToday();
});
const pos_sales_today = document.querySelector('.pos__head__amount');
const inpCustomerError = document.querySelector('.pos__body__customer__error');
const inpCustomer = document.querySelector('.pos__body__customer__input');
const posCustomer = document.querySelector('.pos__body__customer');
const posForm = document.querySelector('.pos__form');
const inpBarcode = document.querySelector('.pos__form__barcode');
const inpProduct = document.querySelector('.pos__form__product');
const inpDiscount = document.querySelector('.pos__body__discount__input');
const btnConfirm = document.querySelector('.pos__confirm');
const btnCart = document.querySelector('.pos__form__submit');
const btnCheckout = document.querySelector('.pos__form__checkout');
const btnClose = document.querySelector('pos__close');
const posTable = document.querySelector('pos__table');
const posQuantity = document.querySelector('.pos__form__quantity');
let productCart = [];

const checkSalesToday = () => {
    $.ajax({
        type:'get',
        url: INVOICE_CONTROLLER + `?action=getTotalSalesToday`,
        dataType:'json',
        cache: false,
        success: (data) => {
            pos_sales_today.innerHTML = '₱'+ data.total_sales;
        }
    });
}

const removeItem = (barcode) => {

    productCart = productCart.filter((item)=>{
        if(item.barcode != barcode) return item; 
    });

    const rowClass = `.row${barcode}`;
    const table = $('.table').DataTable();
    const rows = table
        .rows( rowClass )
        .remove()
        .draw();
}

const closeModal = (modal) =>{
    $(`#${modal}`).modal('hide');
}

const calculateDiscount = (amount, discountType) => {
                let discount = 0;
                if(discountType == 'branded'){
                    discount = 0.08;
                }
                else if(discountType == 'generic'){
                    discount = 0.2;
                }
                else{
                    // not discounted
                }
                return amount - (amount * discount);
};

const checkDiscount = () => {
    const rows = document.querySelectorAll('tbody tr.rowClass');
    if(rows.length > 0){
        rows.forEach((row)=>{
            const price = row.querySelector('.p-price');
            const quantity = row.querySelector('.p-quantity');
            const amount = row.querySelector('.p-amount');
            const type = row.querySelector('.p-type');
            let amountValue = +price.innerHTML * +quantity.innerHTML;
            
            posCustomer.classList.remove('show');
            if(inpDiscount.checked){
                console.log('wew');
                posCustomer.classList.add('show');
                amountValue = calculateDiscount(amountValue, type.innerHTML);
            }
            amount.innerHTML = amountValue;
        })
    }
    else{
        posCustomer.classList.toggle('show');
    }
}

inpDiscount.addEventListener('change', checkDiscount);
posQuantity.addEventListener('click', ()=>{
    posQuantity.classList.remove('error');
});
inpBarcode.addEventListener('click', ()=>{
    inpBarcode.classList.remove('error');
});
inpBarcode.addEventListener('blur', (e)=>{
    // console.log(e.currentTarget);
    $.ajax({
        type:'GET',
        url: PRODUCT_CONTROLLER + `?action=getAvailableProductByBarcode&barcode=${inpBarcode.value}`,
        dataType: 'json',
        cache:false,
        success: (data) => {
            
            if(data.length > 0){
                inpProduct.value = data[0].product_name;
            }
            else{
                inpBarcode.classList.add('error');
                inpProduct.value = '';
                Swal.fire({
                    icon: 'error',
                    title: 'Product Not Found',
                    text: 'It seems like the product that you\'re looking for is out of stock',
                    footer: `<a class="kaboom" href="${HOST}views/master-page/products.php">You might check the list of available products here</a>`
                })
            }
        }
    })
});

btnCheckout.addEventListener('click', (e)=>{
    e.preventDefault();
    let grandTotal = 0;
    console.log(productCart);
    let list = productCart.map(item =>{
        let totalItemPrice = parseInt(item.quantity) * parseInt(item.price);

        if(inpDiscount.checked){
            totalItemPrice =  calculateDiscount(totalItemPrice, item.type);
        }
        grandTotal += totalItemPrice;
        
        
        return `<li class="pos__list__item">
        <div class="pos__list__item__details">
        <span class="pos__list__item__quantity">${item.quantity}</span>
        <p class="pos__list__item__name"> ${item.name}</p>
        </div>
        <span class="pos__list__item__price">₱ ${totalItemPrice}</span>
    </li>`;
    }).join('');
    list+=`<li class="pos__list__item total">
    <div class="pos__list__item__details">
    <span class="pos__list__item__quantity"></span>
    <p class="pos__list__item__name dark">Grand Total</p>
    </div>
    <span class="pos__list__item__price">₱ ${grandTotal}</span>
</li>`
    $('.pos__list').html(list);

    $('#myModal').modal('show');
});

btnCart.addEventListener('click', (e) => {
    e.preventDefault();
    let requiredQuantity = parseInt(posQuantity.value) || 1;
    $.ajax({
        type: 'GET',
        url: PRODUCT_CONTROLLER + `?action=getAvailableProductByBarcode&barcode=${inpBarcode.value}`,
        dataType: 'json',
        cache: false,
        success: data => {

            let totalAvailableQuantity = data.reduce((accumulator, product) => {
                return accumulator + parseInt(product.quantity);
            }, 0);


            if (data.length > 0 && totalAvailableQuantity >= requiredQuantity) {
                const exist = productCart.some(el => el.barcode === data[0].barcode);
                if(exist){
                    Swal.fire(
                                `${data[0].barcode}`,
                                'Item is already on the list',
                                'question'
                            )
                            data = [];
                }
                else{
                    const item = {
                        barcode: data[0].barcode,
                        name: data[0].product_name,
                        price: data[0].sale_price,
                        quantity: requiredQuantity,
                        type:data[0].type
                    }
                    productCart.push(item);
                }

                
                

                let row = '';
                for (const product of data) {
                    totalAvailableQuantity += product.quantity;
                    if (requiredQuantity > 0) {
                        let availableQuantity = 0;

                        if (requiredQuantity >= product.quantity) {
                            requiredQuantity = requiredQuantity - product.quantity;
                            availableQuantity = product.quantity
                        } else {
                            availableQuantity = requiredQuantity;
                            requiredQuantity = 0;
                        }

                        const amount = product.sale_price * availableQuantity;
                        const rowClass = `rowClass row${product.barcode}`;
                        row += `<tr class="${rowClass}">
                        <td>
                            <button class="btn-remove" onclick="removeItem(${product.barcode})">&#10008;</button>
                        </td>
                        <td>${product.product_name}</td>
                        <td>${product.category_name}</td>
                        <td class="p-type">${product.type}</td>
                        <td>${product.expiration_date}</td>
                        <td class="p-price">${product.sale_price}</td>
                        <td class="p-quantity">${availableQuantity}</td>
                        <td class="p-amount">${amount}</td>
                       
                        </tr>`;
                    } else {
                        break;
                    }
                }

                $('.table').DataTable().destroy();
                $('#pos__table tbody').append(row);
                $('.table').DataTable();
                checkDiscount()
                posForm.reset();

            } else if (data.length > 0 && totalAvailableQuantity < requiredQuantity) {
                posQuantity.classList.add('error');
                Swal.fire(
                    `${data[0].barcode}`,
                    `We only have ${totalAvailableQuantity} items left for this product`,
                    'info'
                )
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Product Not Found',
                    text: 'It seems like the product that you\'re looking for is out of stock',
                    footer: '<a class="kaboom" href="http://localhost/inventory-pos/views/master-page/products.php">You might check the list of available products here</a>'
                })
            }
        }
    })

});

inpCustomer.addEventListener('click',()=>{
    inpCustomerError.classList.remove('show');
});

btnConfirm.addEventListener('click',()=>{
    
    let discount = ''
    let customerName = '';
    let process = 1;
    if(inpDiscount.checked){
        discount = 'discounted';
        customerName = inpCustomer.value;

        if(customerName == ''){
            process = 0;
        }
    }
    
    if(process == 1){
        $.ajax({
            type: "POST",
            url: INVOICE_CONTROLLER + `?action=confirmedCheckout`,
            dataType: "json",
            data:{
                customerName: customerName, 
                data: productCart,
                discounted: discount
            },
            success: function (response) 
            {
                console.log('success');
                window.location.href = HOST_2 + '/views/pos/index.php';
            },
            error: function () {
                console.log('errror');
            }
        });
    }
    else{
        $('#myModal').modal('hide');
        inpCustomerError.classList.add('show');
    }

});