<?php
session_start();
include("dbcon.php");
if (isset($_POST['job_id'])) {
    $job_id = $_POST['job_id'];
    $technician_id = $_SESSION['technician_id']; // ✅ this is 2 from your dump

    $query = "UPDATE service_request 
              SET status = 'In Progress', technician_id = '$technician_id'
              WHERE id = '$job_id'";
    $result = mysqli_query($con, $query);

    if ($result) {
        $_SESSION['status'] = "Job started successfully!";
        header("Location: technician.php?tab=schedule");
        exit();
    } else {
        echo "Error updating job: " . mysqli_error($con);
    }
}

?>