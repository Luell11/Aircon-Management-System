<?php
session_start();
include('dbcon.php');

if(isset($_POST['login_now_btn']))
{   
    if(!empty(trim($_POST['email'])) && !empty(trim($_POST['password'])))
    {
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        // Get user by email only
        $login_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
        $login_query_run = mysqli_query($con, $login_query);

        if(mysqli_num_rows($login_query_run) > 0)
        {
            $row = mysqli_fetch_assoc($login_query_run);

            // ✅ Verify hashed password
            if(password_verify($password, $row['password']))
            {
                if($row['verify_status'] == "1")
                {
                    $_SESSION['authenticated'] = TRUE;
                    $_SESSION['auth_user'] = [
                        'username' => $row['first_name']. ' '. $row['last_name'],
                        'phone' => $row['phone'],   
                        'email' => $row['email'],
                        'role' => $row['role'],
                        'id' => $row['id']
                    ];

                    $uid = $row['id'];
                    $updateStatus = "UPDATE users SET status = 'online' WHERE id = '$uid'";
                    mysqli_query($con, $updateStatus);

                    $_SESSION['status'] = "You are logged in successfully.";

                    // Role-based redirection
                    if ($row['role'] == "user") {
                        header("Location: index.php");

                    } elseif ($row["role"] == "technician") {

                        $_SESSION['technician_id'] = $row['id'];                    
                        $first_name = $row['first_name'];
                        $last_name = $row['last_name'];
                        $phone = $row['phone'];
                        $email = $row['email'];
                        $id = $row['id'];

                        // Ensure technician is not duplicated
                        $checkTech = "SELECT * FROM users WHERE email='$email' LIMIT 1";

                        $checkTech_run = mysqli_query($con, $checkTech);

                        if(mysqli_num_rows($checkTech_run) == 0) {
                            $queryTech = "INSERT INTO users (first_name, last_name, phone, status, email)
                                          VALUES ('$first_name', '$last_name', '$phone', 'Available', '$email')";
                            mysqli_query($con, $queryTech);
                        }

                        header("Location: technician.php"); 
                        
                    } elseif ($row["role"] == "admin") {
                        header("Location: admindashboard.php");
                    } else {
                        $_SESSION['status'] = "Role not recognized";
                        header("Location: login.php");
                    }

                }
                else
                {
                    $_SESSION['status'] = "Please verify your email address.";
                    header("Location: login.php");
                    exit(0);
                }
            }
            else
            {
                $_SESSION['status'] = "Invalid password.";
                header("Location: login.php");
                exit(0);
            }
        }
        else
        {
            $_SESSION['status'] = "Email not found.";
            header("Location: login.php");
            exit(0);
        }
    }
    else
    {
        $_SESSION['status'] = "All fields are mandatory";
        header("Location: login.php");
        exit(0);
    }
}
?>
