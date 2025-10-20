<?php 
session_start();
if(isset($_SESSION['authenticated']))
{
    $_SESSION['status'] = "You are already logged in";
    header('Location: dashboard.php');
    exit(0);
}
$page_title = "Login Form";
include('includes/header.php'); 
include('includes/navbar.php');

$backgroundImage = 'dash.jpg'; 
?>

<style>
    html, body {
      height: 100%;
      margin: 0;
      font-family: 'Comic Sans MS', 'Comic Sans', cursive !important;
      background: url('<?php echo $backgroundImage; ?>') no-repeat center center fixed;
      background-size: cover;
      overflow-x: hidden;
    }
    
</style>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <?php
                
                if (isset($_SESSION['status'])) {
                    echo '<div class="alert alert-success">' .$_SESSION['status'] . '</div>';
                    unset ($_SESSION['status']);
                }
                ?>
                



                <div class="card shadow">                    
                    <div class="card-header">
                        <h5>Login Form</h5>
                    </div>
                    <div class="card-body">

                        <form action="logincode.php" method="POST">
                            <div class="form-group mb-3">
                                <label for="">Email Address</label>
                                <input type="text" name="email" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="login_now_btn"  class="btn btn-primary">Login Now</button>
                            </div>
                            <hr>
                            <h5>
                                Did not receive your Verification Email?
                                <a href="resend-email verification.php">Resend</a>
                            </h5>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/header.php'); ?>