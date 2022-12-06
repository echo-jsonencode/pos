$(document).ready(function () {
    $('.btn').click(function (event){
        event.preventDefault()
    })
});


const Login = (() => {
    const thisLogin = {};

    thisLogin.submit = () => {
        window.location.href = "home.php";
    }

    return thisLogin;
})();