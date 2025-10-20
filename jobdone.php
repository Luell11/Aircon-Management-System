<?php 
session_start();
include("dbcon.php");

if(isset($_POST['job_id'])) {
    $tite = $_POST['job_id'];
    $technician_note = $_POST['technician_note'];
    
    $photo = NULL;
    if (!empty($_FILES['proof_photo']['name'])) {
        $uploadDir = __DIR__ . "/uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $fileName = time() . "_" . basename($_FILES['proof_photo']['name']);
        $targetFile = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['proof_photo']['tmp_name'], $targetFile)) {
            $photo = "uploads/" . $fileName;
        }
    }

    $query = "UPDATE service_request 
             SET status='Proof', date_finished = NOW(), technician_note = '$technician_note', proof_photo = '$photo'
             WHERE id='$tite' ";
    mysqli_query($con, $query);

    $_SESSION['status'] = "Job marked as completed";
    header("Location: technician.php?");
    exit();

}

?>