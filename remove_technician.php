<?php 
include('dbcon.php');

if(isset($_POST['remove_btn'])) {
    $delete_id = $_POST['delete_id'];

    $stmt = $con->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $delete_id);

    if($stmt->execute()) { 
        header("Location: admindashboard.php");
        exit();
    } else {
        echo "Error Deleting Record";
    }
}

?>