<?php 
session_start();
$page_title = "Registration Form";
include('includes/header.php'); 
include('includes/navbar.php'); 

?>

<?php $backgroundImage = 'dash.jpg'; ?>
<style>
    html, body {
      height: 100%;
      margin: 0;
      font-family: 'Comic Sans MS', 'Comic Sans', cursive !important;
      background: url('<?php echo $backgroundImage; ?>') no-repeat center center fixed;
      background-size: cover;
      overflow-x: hidden;
    }

    .alert {
        color: white !important;
        text-align: center;
        font-weight: 600;
        background: transparent;
        border: none;
        box-shadow: none;
    }
    
</style>
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="alert">
                    <?php 
                        if (isset($_SESSION['status'])) 
                        {
                            echo "<h4>". $_SESSION["status"]. "</h4>";
                            unset($_SESSION["status"] );
                        }
                    ?>
                </div>
                <div class="card shadow">                    
                    <div class="card-header">
                        <h5>Registration Form</h5>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST">
                            <div class="form-group mb-3">
                                <label for="">First Name</label>
                                <input type="text" name="first_name" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Last Name</label>
                                <input type="text" name="last_name" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Phone Number</label>
                                <input type="text" name="phone" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Address</label>
                                <input type="text" name="address" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Email Address</label>
                                <input type="text" name="email" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" name="register_btn" class="btn btn-primary">Register Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/header.php'); ?>