$(document).ready(function () {
    $('.btn').click(function (event){
        event.preventDefault()
    })
});


const Login = (() => {
    const thisLogin = {};

    thisLogin.submit = () => {
        const username = $('#txt_username').val();
        const password = $('#txt_password').val();

        const loginUrl = '../../data/controller/LoginController.php';

        $.ajax({
            type: "POST",
            url: LOGIN_CONTROLLER + '?action=verify_login',
            dataType: "json",
            data:{
                username: username,
                password: password,
            },
            success: function (response) 
            {
                if(response == "Validated") {
                    window.location.href = "home.php";
                } 
                else {
                    Swal.fire({
                        position: 'center',
                        icon: 'warning',
                        title: response,
                        showConfirmButton: false,
                        timer: 5000
                    })
                }
                
            },
            error: function () {

            }
        }); 
    }

    return thisLogin;
})();