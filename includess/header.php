<?php

$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Aircon Ayos - <?php echo ucfirst(pathinfo($currentPage, PATHINFO_FILENAME)); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        .navbar-custom {
            background-color: #00cfff;
        }
        .navbar-brand, .nav-link {
            color: white !important;
        }
        .nav-link.active {
            background-color: #1c1a1aff;
            color: black !important;
            border-radius: 5px;
        }
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-custom sticky-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">Aircon Ayos </a>
        <span class="navbar-text text-white small d-none d-lg-inline">
            
        </span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu" aria-controls="navbarMenu" 
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarMenu">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <?php 
                $menuItems = [
                    'index.php' => 'Home',
                    'active_jobs.php' => 'Active Jobs',
                    'schedule.php' => 'Schedule',
                    'completed.php' => 'Complted',
                    'reports.php'    => 'Reports',
                    'logout.php' => 'Logout'
                    
                ];
                foreach ($menuItems as $file => $title) {
                    $active = ($currentPage == $file) ? 'active' : '';
                    echo "<li class='nav-item'><a class='nav-link $active' href='$file'>$title</a></li>";
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
