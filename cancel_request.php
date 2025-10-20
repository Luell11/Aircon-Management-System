<?php 
session_start();
include("dbcon.php");

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM service_request where id = '$id'";
    $query_run = mysqli_query($con, $query);

    if($query_run) {
        $_SESSION['status'] = "Service Request cancelled Successfully";
    } else {
        $_SESSION['status'] = "Failed to cancel Service Request";
    }
    header("Location: dashboard.php");
    exit(0);
}


?>