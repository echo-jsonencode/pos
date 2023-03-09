<!doctype html>
<html lang="en">

<?php include '../layouts/head.php' ?>


<?php
if (!$_SESSION['user']) {
    header("Location: login.php");
}
?>

<body>
    <?php include '../layouts/nav.php'; ?>

    <section class="section user">
        <!-- <h1 class="section__title">Admin</h1> -->
        <div class="container-fluid section__body">
            <div class="row">
                <div class="col-lg-12 col-md-12 ">
                    <div class="user__form-wrapper">
                        <h2 class="section__sub-title" id="lbl_title">Change Password</h2>
                        <form class="row g-3">
                            <div class="col-md-12">
                                <input type="hidden" id="old_password" value="<?php echo($_SESSION['user']['password']); ?>">
                                <label for="oldpassword" class="form-label">Old Password</label>
                                <input type="password" class="form-control" id="txt_oldpassword" name="txt_oldpassword" onChange = "ChangePassword.validateOldPassword()" autofill="on">
                                <!-- <i class="bi-eye-slash-fill" id="togglePassword" style="margin-left: -30px; cursor: pointer;" ></i> -->
                            </div>
                            <div class="col-md-12">
                                <label for="newpassword" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="txt_newpassword" onkeyup = validation(); required/><span id="mess"></span>
                                <!-- <i class="bi-eye-slash-fill" id="togglePassword" style="margin-left: -30px; cursor: pointer;" ></i> -->
                            </div>
                            <div class="col-md-12">
                                <label for="confirmPassword" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" id="txt_confirm_password">
                                <!-- <i class="bi-eye-slash-fill" id="togglePassword" style="margin-left: -30px; cursor: pointer;" ></i> -->
                            </div>
                            <div class="col-12">
                                <button type="submit" id="btn_save" name="btn_save" onclick="ChangePassword.confirm()" class="btn form-control btn-main">Update Password</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </section>


    <?php include '../layouts/scripts.php' ?>
</body>
<script src="../../libs/scripts/master-page/change-password.js"></script>
<script src="../../libs/scripts/pos/session_timer.js"></script>

</html>