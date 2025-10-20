<?php
session_start();

include "dbcon.php"; // your DB connection

if (isset($_POST['status']) && isset($_SESSION['auth_user']['id'])) {
    $status = $_POST['status'];
    $user_id = $_SESSION['auth_user']['id'];

    $sql = "UPDATE users SET status = ? WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("si", $status, $user_id);

    if ($stmt->execute()) {
        echo "Status updated to $status";
    } else {
        echo "Error updating status: " . $stmt->error;
    }
}
?>
