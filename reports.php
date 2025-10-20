<?php 
session_start();
include("dbcon.php");

if(isset($_POST['submit_report'])) {
    $job_id = $_POST['job_id'];
    $work_performed = mysqli_real_escape_string($con, $_POST['work_performed']);
    $parts_used = mysqli_real_escape_string($con, $_POST['parts_used']);
    $labor_cost = mysqli_real_escape_string($con, $_POST['labor_cost']);
    $parts_cost = mysqli_real_escape_string($con, $_POST['parts_cost']);
    $id = $_POST['id'];
    $technician_id = $_SESSION['auth_user']['id'];

    $query = "INSERT INTO job_reports (job_id, technician_id, work_performed, parts_used, labor_cost, parts_cost)
             VALUES ('$job_id', '$technician_id', '$work_performed', '$parts_used', '$labor_cost', '$parts_cost')";

    $result = mysqli_query($con, $query);

    if($result) {
        $update = "UPDATE service_request SET status='Finished' WHERE id=$job_id";
        mysqli_query($con, $update);
        $_SESSION['status'] = "Reported Successfully!";
    }
    else {
        $_SESSION['status'] = "Error" . mysqli_error($con);
    }
    header("Location: technician.php?");
    exit();
}


?>