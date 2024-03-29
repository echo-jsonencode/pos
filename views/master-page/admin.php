<!doctype html>
<html lang="en">

<?php include '../layouts/head.php' ?>

<?php 
if(!$_SESSION['user']) {
    header("Location: login.php"); 
}

else if($_SESSION['user']['role'] === 3) {
    header("Location: home.php"); 
}
?>


<body>
    <?php include '../layouts/nav.php'; ?>

    <section class="section user">
        <!-- <h1 class="section__title">Admin</h1> -->
        <div class="container-fluid section__body">
            <div class="row">
                <div class="col-lg-8 col-md-12 ">
                    <div class="user__table-wrapper">
                        <h2 class="section__sub-title">List of Accounts</h2>

                        <div class="table-wrapper">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>username</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Last Login</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_users">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="user__form-wrapper">
                        <h2 class="section__sub-title" id="lbl_title">Create User</h2>
                        <form class="row g-3">
                            <div class="col-md-12">
                                <label for="username" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="txt_first_name">
                            </div>
                            <div class="col-md-12">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="txt_last_name">
                            </div>
                            <div class="col-md-12">
                                <label for="lastName" class="form-label">Username</label>
                                <input type="text" class="form-control" id="txt_user_name">
                            </div>
                            <div class="col-md-12">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="txt_password" onkeyup = validation(); required/><span id="mess"></span>
                            </div>
                            <div class="col-md-12">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="txt_confirm_password">
                            </div>
                            <div class="col-md-6">
                                <label for="role" class="form-label">Role</label>
                                <select id="slc_role" class="form-select">
                                    <option value="" disabled selected>Choose...</option>
                                    <option value="2">Admin</option>
                                    <option value="3">User</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select id="slc_status" class="form-select">
                                    <option value="" disabled selected>Choose...</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <button type="submit" id="btn_save" onclick="Admin.clickSaveButton()" class="btn form-control btn-main">Register User</button>
                            </div>
                            <div class="col-12">
                                <button type="submit" id="btn_save" onclick="Admin.resetFields()" class="btn form-control btn-warning">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </section>
    <?php include '../layouts/scripts.php' ?>
</body>
<script src="../../libs/scripts/master-page/admin.js" ></script>
<script src="../../libs/scripts/pos/session_timer.js"></script>

</html>