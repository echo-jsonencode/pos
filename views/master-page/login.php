
<!doctype html>
<html lang="en">

<?php include '../layouts/head.php' ?>

<style>

</style>

<body class="body__login">
    <div class="offset-md-4 col-md-4 login-wrapper">
    <img class="login-wrapper-image" src="../../libs/images/diamond.png" alt="">
        <div class="login">
            <div class="image-wrapper">
                <img src="../../libs/images/IronMedLogo.png" alt="">
            </div>
            <form class="login__form" action="">
                <input type="text" id="txt_username" placeholder="Username">
                <input type="password" name = "txt_password" id="txt_password" placeholder="Password">
                <i class="bi-eye-fill" id="togglePassword" style="margin-left: -30px; cursor: pointer;" ></i>
                <button class="btn" onclick="Login.submit()" type="submit">Login</button>
            </form>
        </div>
        <script>
        const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#txt_password');
            togglePassword.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('bi-eye-slash');
});
</script>
    </div>



    <?php include '../layouts/scripts.php' ?>
</body>
<script src="../../libs/scripts/master-page/login.js" ></script>
           
</html>