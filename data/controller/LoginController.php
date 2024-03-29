<?php

include_once('../../config/database.php');
include_once('../model/User.php');
include_once('../model/ProductDetails.php');
include_once('../model/ActionLog.php');

$action = $_GET['action'];
$User = new User($conn);
$ProductDetails = new ProductDetails($conn);
$ActionLog = new ActionLog($conn);

if ($action == 'verify_login')
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $request = [
        'username' => $username,
        'password' => $password
    ];

    $result = $User->verify_login($request);

    if($result == "Validated") {
        $ProductDetails->updateExpiredStatus();
    }

    echo json_encode($result);
}

else if ($action == 'logout')
{
    $ActionLog->saveLogs('logout');

    session_destroy();

    echo json_encode('Success');
}
