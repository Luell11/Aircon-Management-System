<?php
$current_page = basename($_SERVER['PHP_SELF']); // gets the current file name
?>

<div class="bg-dark">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar navbar-expand-lg navbar-dark">
              <div class="container-fluid">

                <a class="navbar-brand" href="#">Aircon Ayos</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    
                    <li class="nav-item">
                      <a class="nav-link <?= ($current_page == 'index2.php') ? 'active' : '' ?>" href="index2.php">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link <?= ($current_page == 'services.php') ? 'active' : '' ?>" href="services.php">Services</a>
                    </li>

                    <?php if(!isset($_SESSION['authenticated'])) : ?>
                      <li class="nav-item">
                        <a class="nav-link <?= ($current_page == 'register.php') ? 'active' : '' ?>" href="register.php">Register</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link <?= ($current_page == 'login.php') ? 'active' : '' ?>" href="login.php">Login</a>
                      </li>
                    <?php endif ?>

                    <?php if(isset($_SESSION['authenticated'])) : ?>
                      <li class="nav-item">
                        <a class="nav-link <?= ($current_page == 'logout.php') ? 'active' : '' ?>" href="logout.php">Logout</a>
                      </li>
                    <?php endif ?>

                  </ul>
                </div>
              </div>
            </nav>
        </div>
    </div>
</div>
</div>
