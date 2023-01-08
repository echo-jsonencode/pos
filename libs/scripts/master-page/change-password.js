$(document).ready(function () {
    $('.btn').click(function (event) {
        event.preventDefault()
    })
});

const ChangePassword = (() => {
    const thisChangePassword = {};

    thisChangePassword.confirm = () => {
        const password = $('#txt_password').val();
        const confirm_password = $('#txt_confirm_password').val();

        if(password == ""
        || confirm_password == "") {
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Please fillup all fields',
                showConfirmButton: true,
            })
        }
        else if(password != confirm_password) {
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Password Did not match',
                showConfirmButton: true,
            })
        }
        else {
            $.ajax({
                type: "POST",
                url: USER_CONTROLLER + '?action=changePassword',
                dataType: "json",
                data:{
                    password: password
                },
                success: function (response) 
                {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Password successfully Changed',
                        showConfirmButton: true,
                    }).then((result) => {
                        if(result.isConfirmed) {
                            window.location.href = `${HOST}views/master-page/home.php`;
                        }
                    });
                },
                error: function () {
    
                }
            });
        }
    }

    return thisChangePassword;
})();