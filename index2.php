<?php 
$page_title = "Home Page";
include('includes/header.php'); 
include('includes/navbar.php'); 

?>
<?php $backgroundImage = 'dash.jpg'; ?>
<!DOCTYPE html>

<html lang="en">
    
<head>
    
    <title>Aircon Design</title>
    <link rel="stylesheet" href="gabhome/style.css?v=<?php echo time(); ?>">
</head>
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
<body>

    <!-- Navbar + Hero -->
    <div class="main">
        <?php include('includes/header.php'); ?>    
             

        <div class="content">
            <h1 style="color: white;">AIRCON <br><span>INSTALLATION </span> <br>DESCRIPTION</h1>
            <p class="par" style="color: white;">
                An air conditioner is a machine that cools and controls the air inside a room or building.<br>
                It works by taking warm air from indoors, removing the heat and humidity, and sending back cool air.<br>
                Most aircons also have filters that clean the air by trapping dust and dirt.  
                <br><br>
                What can we offer? Services we provide, why choose us?
            </p>
            <button class="cn"><a href="#">JOIN US</a></button>
        </div>
    </div>

    <!-- Services Section -->
    <h1 style="color: white;">SERVICES</h1>
    <div class="banner">
        <div class="slider" style="--quantity: 10">
            <div class="item" style="--position: 1"><img src="gabhome/air1.jpg" alt=""></div>
            <div class="item" style="--position: 2"><img src="gabhome/air2.jpg" alt=""></div>
            <div class="item" style="--position: 3"><img src="gabhome/air3.jpg" alt=""></div>
            <div class="item" style="--position: 4"><img src="gabhome/air4.jpg" alt=""></div>
            <div class="item" style="--position: 5"><img src="gabhome/air5.jpg" alt=""></div>
            <div class="item" style="--position: 6"><img src="gabhome/air6.webp" alt=""></div>
            <div class="item" style="--position: 7"><img src="gabhome/air7.jpg" alt=""></div>
            <div class="item" style="--position: 8"><img src="gabhome/air8.jpg" alt=""></div>
            <div class="item" style="--position: 9"><img src="gabhome/air9.jpg" alt=""></div>
            <div class="item" style="--position: 10"><img src="gabhome/air10.jpg" alt=""></div>
        </div>
    </div>

    <!-- Installation Info Section -->
    <section class="install-info">
        <h2>About Our Aircon Installation</h2>
        <p>
            Installing an air conditioning system is not just about cooling your space — it’s about comfort, 
            energy efficiency, and clean air for you and your family. Our professional team ensures that 
            every installation is done with precision and care.
        </p>
        <h3>Our Installation Process:</h3>
        <ul>
            <li>✔️ Site inspection and measurement to find the best AC placement</li>
            <li>✔️ Proper mounting of the indoor and outdoor units</li>
            <li>✔️ Safe electrical connections and testing</li>
            <li>✔️ Refrigerant charging for maximum cooling efficiency</li>
            <li>✔️ Final performance check and system demonstration</li>
        </ul>

        <h3>Why Choose Us?</h3>
        <p>
            ✅ Skilled and certified technicians <br>
            ✅ Fast and reliable service <br>
            ✅ Affordable installation packages <br>
            ✅ Post-installation support and maintenance <br>
            ✅ Commitment to customer satisfaction
        </p>
    </section>

</body>
</html>
