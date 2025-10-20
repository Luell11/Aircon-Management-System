<?php
session_start();
include('dbcon.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
function resend_email_verify($name, $email, $verify_token) 
{
     $mail = new PHPMailer(true);
    

    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'openaibotgoku@gmail.com';                     //SMTP username
    $mail->Password   = 'wpud scgy lmod tgcq';                               //SMTP password
    $mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    $mail->setFrom('openaibotgoku@gmail.com', $name);
    $mail->addAddress($email);     //Add a recipient

    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'RESEND - Email verification from Aircon Ayos';

    $email_template = "
    <h2>You have registered with Aircon Ayos </h2>
    <h5>Verify your email address to Login with the below given link </h5>
    <br/><br/>
    <a href='http://localhost/php/REGISTERLOGIN/verify-email.php?token=$verify_token'> Click Me </a>
    ";

     $mail->Body = $email_template;
     $mail->send();
}

if(isset($_POST['resend_email_verify_btn']))
{
    if(!empty(trim($_POST['email'])))
    {
        $email = mysqli_real_escape_string($con, $_POST['email']);
        
        $checkemail_query = "SELECT * FROM users WHERE email='$email' LIMIT 1 ";
        $checkemail_query_run = mysqli_query($con, $checkemail_query);

        if(mysqli_num_rows($checkemail_query_run) > 0)
        {
            $row = mysqli_fetch_array($checkemail_query_run);
            if($row['verify_status'] == "0")
            {
                $name = $row["name"];
                $email = $row["email"];
                $verify_token = $row["verify_token"];

                resend_email_verify($name, $email, $verify_token);

                $_SESSION['status'] = "Verification link has been sent to your email.";
                header("Location: login.php");
                exit(0);
            }
            else
            {
                $_SESSION['status'] = "Email already verified. Please login.";
                header("Location: resend-email-verification.php");
                exit(0);
            }
        }
        else
        {
            $_SESSION['status'] = "Email not registered. Please register now";
            header("Location: register.php");
            exit(0);
        }   
    }
    else
    {
        $_SESSION['status'] = "Please enter your email address";
        header("Location: resend-email verification.php");
        exit(0);
    }

}

?>