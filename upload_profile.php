<?php
session_start();
include("dbcon.php");

if (isset($_POST['upload_profile']) && isset($_FILES['profile_pic'])) {
    $user_id = $_SESSION['auth_user']['id'];

    // Ensure upload directory exists
    $targetDir = "uploads/profile_pics/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Generate unique file name
    $fileName = time() . "_" . basename($_FILES["profile_pic"]["name"]);
    $targetFile = $targetDir . $fileName;

    // Move file to uploads folder
    if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $targetFile)) {
        // Save path to DB
        $query = "UPDATE users SET profile_pic='$targetFile' WHERE id='$user_id'";
        mysqli_query($con, $query);

        $_SESSION['status'] = "Profile picture updated!";
    } else {
        $_SESSION['status'] = "Error uploading file.";
    }

    header("Location: dashboard.php");
    exit();
}
?>
