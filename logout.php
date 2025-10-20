<?php
session_start();
include('dbcon.php');

if (isset($_SESSION['auth_user']['id'])) {
    $uid = $_SESSION['auth_user']['id'];

    // ✅ Set status = offline
    $updateStatus = "UPDATE users SET status = 'offline' WHERE id = '$uid'";
    $query_run = mysqli_query($con, $updateStatus);
    

    if($query_run) {
        $_SESSION['status'] = "Logout Successfully";
    } else {
        $_SESSION['status'] = "Error logout";
    }
}   

// Destroy session
session_unset();

// Redirect to login
header("Location: login.php");
exit(0);
?>
