<?php
session_start();
include("dbcon.php");

if (isset($_POST["submit_request"])) {
    $user_id = $_SESSION['auth_user']['id'];
    $service_type = $_POST['service_type'];
    $issue_description = $_POST['issue_description'];
    $address = $_POST['address'];
    $location_room = $_POST['location_room'];
    $customer_notes = $_POST['customer_notes'];
    $ac_model = $_POST['ac_model'];
    $ac_brand = $_POST['ac_brand'];
    $ac_model_other = $_POST['ac_model_other'] ?? '';
    $ac_brand_other = $_POST['ac_brand_other'] ?? '';
    $preferred_date = $_POST['preferred_date'];
    $emergency = isset($_POST['emergency']) ? 1 : 0;
    $price = $_POST['price'];

    $photo = NULL;
    if (!empty($_FILES['photo']['name'])) {
        $uploadDir = __DIR__ . "/uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $fileName = time() . "_" . basename($_FILES['photo']['name']);
        $targetFile = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile)) {
            $photo = "uploads/" . $fileName;
        }
    }

    if ($ac_brand === 'Others' && !empty($ac_brand_other)) {
        $final_ac_brand = $ac_brand_other;
    } else {
        $final_ac_brand = $ac_brand;
    }

    if ($ac_model === 'Others' && !empty($ac_model_other)) {
        $final_ac_model = $ac_model_other;
    } else {
        $final_ac_model = $ac_model;
    }

    // Now use $final_ac_name for your database insert




    $query = "INSERT INTO service_request
              (user_id, service_type, issue_description, address, location_room, customer_notes, 
              ac_model, ac_brand, ac_model_other, ac_brand_other, price, preferred_date, photo)
              VALUES ('$user_id', '$service_type', '$issue_description', '$address', '$location_room', '$customer_notes', 
              '$final_ac_model', '$final_ac_brand', '$ac_model_other', '$ac_brand_other', '$price', '$preferred_date', '$photo')";
    
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['status'] = "Service request submitted successfully!";
        header("Location: dashboard.php");
        exit();
    } else {
        $_SESSION["status"] = "Failed to submit request.";
        header("Location: dashboard.php");
        exit();
    }
}
?>
