<?php
session_start();
include('dbcon.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendemail_verify($name, $email, $verify_token)
{   
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'openaibotgoku@gmail.com';
    $mail->Password   = 'wpud scgy lmod tgcq'; // ⚠️ app password, not Gmail login
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;

    $mail->setFrom('openaibotgoku@gmail.com', 'Aircon Ayos');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Email verification from Aircon Ayos';

    $email_template = "
    <h2>You have registered with Aircon Ayos</h2>
    <h5>Verify your email address to login with the link below:</h5>
    <br/><br/>
    <a href='http://localhost/php/REGISTERLOGIN/verify-email.php?token=$verify_token'>Click Here to Verify</a>
    ";

    $mail->Body = $email_template;
    $mail->send();
}

if(isset($_POST['register_btn']))
{
    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $phone      = $_POST['phone'];
    $email      = $_POST['email'];
    $password   = $_POST['password'];
    $address    = $_POST['address'];
    $verify_token = md5(rand());

    // ✅ Hash password before saving
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    $check_email_query = "SELECT email FROM users WHERE email='$email' LIMIT 1";
    $check_email_query_run = mysqli_query($con, $check_email_query);
    
    if (mysqli_num_rows($check_email_query_run) > 0)
    {
        $_SESSION['status'] = "Email already exists!";
        header("Location: register.php");
    }
    else
    {
        // Insert user data
        $query = "INSERT INTO users (first_name, last_name, phone, password, address, email, verify_token) 
                  VALUES ('$first_name','$last_name', '$phone', '$hashed_password', '$address', '$email', '$verify_token')";
        $query_run = mysqli_query($con, $query);

        if($query_run)
        {
            // Send verification email
            sendemail_verify($name, $email, $verify_token);

            $_SESSION['status'] = "Registration successful! Please verify your email.";
            header("Location: register.php");
        }
        else
        {
            $_SESSION['status'] = "Registration failed. Please try again.";
            header("Location: register.php");
        }
    }
}
?>
