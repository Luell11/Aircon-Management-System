<?php include(__DIR__ . '/include/header.php'); ?>

<?php $backgroundImage = 'dash.jpg'; ?>
<?php include("fetch_request.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Customer Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    * { box-sizing: border-box; }
    html, body {
      height: 100%;
      margin: 0;
      font-family: 'Comic Sans MS', 'Comic Sans', cursive !important;
      background: url('<?php echo $backgroundImage; ?>') no-repeat center center fixed;
      background-size: cover;
      overflow-x: hidden;
    }
    body::before {
      content: "";
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0,0,0,0.6);
      z-index: -1;
    }

    /* 🔹 Navbar custom styling */
    .navbar {
      background: rgba(0, 0, 0, 0.6) !important; 
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.4);
    }
    .navbar .navbar-brand,
    .navbar .nav-link {
      color: #fff !important;
      font-weight: 500;
      transition: color 0.3s ease;
    }
    .navbar .nav-link:hover,
    .navbar .nav-link.active {
      color: #ffffffff !important;
    }

    /* 🔹 Home container & cards */
    .home-container {
      padding: 3rem 1rem;
      max-width: 900px;
      margin: 0 auto;
      text-align: center;
    }
    .home-header h1 {
      font-size: 2.5rem;
      font-weight: 700;
      color: #fff;
      margin-bottom: 1rem;
      text-shadow: 0 3px 8px rgba(0,0,0,0.6);
    }
    .home-header p {
      font-size: 1.1rem;
      color: rgba(255,255,255,0.85);
      margin-bottom: 2.5rem;
    }
    .nav-card {
      background: rgba(255,255,255,0.1);
      padding: 2rem;
      border-radius: 20px;
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.4);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      color: #fff;
      text-decoration: none;
      display: block;
    }
    .nav-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 12px 25px rgba(0,0,0,0.5);
    }
    .nav-card h3 {
      font-size: 1.5rem;
      font-weight: 600;
      margin-bottom: .5rem;
    }
    .nav-card p {
      font-size: 0.95rem;
      color: rgba(255,255,255,0.85);
    }
  </style>
</head>
<body>

<main class="home-container">
  <div class="home-header">
    <h1>🏠 Welcome to Aircon Service Portal</h1>
    <p>Select a section below to get started with your requests.</p>
  </div>
  <?php


if (isset($_SESSION['status'])) {
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['status']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
    unset($_SESSION['status']); // clear after showing
}
?>
    
  <div class="row g-4">
    <div class="col-md-6">
      <a href="dashboard.php" class="nav-card">
        <h3>📊 Dashboard</h3>
        <p>View your service summary and quick updates.</p>
      </a>
    </div>
    <div class="col-md-6">
      <a href="new_request.php" class="nav-card">
        <h3>📝 New Request</h3>
        <p>Submit a new service request for your aircon unit.</p>
      </a>
    </div>
    <div class="col-md-6">
      <a href="history.php" class="nav-card">
        <h3>📜 History</h3>
        <p>Check past and ongoing service requests with status.</p>
      </a>
    </div>
    <div class="col-md-6">
      <a href="profile.php" class="nav-card">
        <h3>👤 Profile</h3>
        <p>Manage your account details and contact information.</p>
      </a>
    </div>
  </div>
  
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
