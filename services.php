<!doctype html>
<?php
include("includes/navbar.php");

?>
<?php $backgroundImage = 'dash.jpg'; ?>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <!-- Linking CSS File -->
    <link rel="stylesheet" href="service/index.css">

    <title>Aircon Services</title>
</head>

<body>
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
    <div class="container-fluid">
        <h1 class="text-center mt-5 display-3 fw-bold" style="color:white;">Our <span class="theme-text">Aircon Services</span></h1>
        <hr class="mx-auto mb-5 w-25">
        <div class="row mb-5">
            
            <!-- Service 1 -->
            <div class="col-12 col-sm-6 col-md-3 m-auto">
                <div class="card shadow">
                    <img src="service/installation.jpg" alt="Aircon Installation" class="card-img-top">
                    <div class="card-body">
                        <h3 class="text-center">Installation</h3>
                        <hr class="mx-auto w-75">
                        <p>
                            Professional <strong>aircon installation</strong> ensuring safe setup, proper placement, and
                            maximum cooling efficiency for your home or office.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Service 2 -->
            <div class="col-12 col-sm-6 col-md-3 m-auto">
                <div class="card shadow">
                    <img src="service/cleaning.jpg" alt="Aircon Cleaning" class="card-img-top">
                    <div class="card-body">
                        <h3 class="text-center">Cleaning</h3>
                        <hr class="mx-auto w-75">
                        <p>
                            Keep your aircon fresh and efficient with our <strong>deep cleaning</strong> service that removes
                            dirt, dust, and bacteria from filters and coils.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Service 3 -->
            <div class="col-12 col-sm-6 col-md-3 m-auto">
                <div class="card shadow">
                    <img src="service/repair.jpg" alt="Aircon Repair" class="card-img-top">
                    <div class="card-body">
                        <h3 class="text-center">Repair</h3>
                        <hr class="mx-auto w-75">
                        <p>
                            Quick and reliable <strong>aircon repair services</strong> for common issues like leaks,
                            strange noises, and cooling problems.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Service 4 -->
            <div class="col-12 col-sm-6 col-md-3 m-auto">
                <div class="card shadow">
                    <img src="service/maintenance.jpg" alt="Aircon Maintenance" class="card-img-top">
                    <div class="card-body">
                        <h3 class="text-center">Maintenance</h3>
                        <hr class="mx-auto w-75">
                        <p>
                            Regular <strong>preventive maintenance</strong> to extend the lifespan of your aircon and keep it
                            running at top performance.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
        crossorigin="anonymous"></script>

</body>
</html>
