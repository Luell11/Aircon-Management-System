<?php
include('dbcon.php'); // make sure dbcon.php connects to your database

if (isset($_POST['add_btn'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // secure password
    $role = $_POST['role'];

    $query = "INSERT INTO users (first_name, last_name, role, phone, password, email, verify_status)
              VALUES ('$first_name', '$last_name', '$role', '$phone', '$password', '$email', '1') ";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo "Successfully Inserted";
        header("Location: admindashboard.php");
    } else {
        echo "Not working";
    }
}