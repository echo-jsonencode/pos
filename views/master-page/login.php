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
                <input type="text" placeholder="Username">
                <input type="password" placeholder="Password">
                <button class="btn" onclick="Login.submit()" type="submit">Login</button>
            </form>
        </div>

    </div>



    <?php include '../layouts/scripts.php' ?>
</body>
<script src="../../libs/scripts/master-page/login.js" ></script>

</html>