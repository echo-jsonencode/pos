<!doctype html>
<html lang="en">

<?php include '../layouts/head.php' ?>

<body>
    <?php include '../layouts/nav.php'; ?>

    <section class="section user">
        <!-- <h1 class="section__title">Admin</h1> -->
        <div class="container-fluid section__body">
            <div class="row">
                <div class="col-lg-8 col-md-12 ">
                    <div class="user__table-wrapper">
                        <h2 class="section__sub-title">User Table</h2>

                        <div class="table-wrapper">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Last Login</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for ($i = 1; $i <= 50; $i++) {  ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td>Juan Pablo</td>
                                            <td>Admin</td>
                                            <td><span class="badge bg-success">Active</span></td>
                                            <td>September 27, 2022 12:09:00 AM</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                    <!-- <button type="button" class="btn btn-info btn-sm"> <i class="bi bi-eye"></i> View</button> -->
                                                    <button type="button" class="btn btn-warning btn-sm"><i class="bi bi-list-check"></i> Update </button>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="Admin.clickDelete()"> <i class="bi bi-trash"></i> Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <!-- INACTIVE -->
                                    <?php
                                    for ($i = $i; $i <= 10; $i++) {  ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td>Juan Pablo</td>
                                            <td>Admin</td>
                                            <td><span class="badge bg-danger">Inactive</span></td>
                                            <td>September 27, 2022 12:09:00 AM</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                    <button type="button" class="btn btn-info btn-sm"> <i class="bi bi-eye"></i> View</button>
                                                    <button type="button" class="btn btn-warning btn-sm"><i class="bi bi-list-check"></i> Update </button>
                                                    <button type="button" class="btn btn-danger btn-sm"> <i class="bi bi-trash"></i> Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="user__form-wrapper">
                        <h2 class="section__sub-title">Create User</h2>
                        <form class="row g-3">
                            <div class="col-md-12">
                                <label for="username" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName">
                            </div>
                            <div class="col-md-12">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName">
                            </div>
                            <div class="col-md-12">
                                <label for="password" class="form-label">Password</label>
                                <input type="text" class="form-control" id="password">
                            </div>
                            <div class="col-md-12">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <input type="text" class="form-control" id="confirmPassword">
                            </div>
                            <div class="col-md-6">
                                <label for="role" class="form-label">Role</label>
                                <select id="role" class="form-select">
                                    <option selected>Choose...</option>
                                    <option>Admin</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select id="status" class="form-select">
                                    <option selected>Choose...</option>
                                    <option>Active</option>
                                    <option value="">Inactive</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn form-control btn-main">Register User</button>
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

</html>