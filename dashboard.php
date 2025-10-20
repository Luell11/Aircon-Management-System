<?php include(__DIR__ . '/include/header.php'); ?>

<?php $backgroundImage = 'dash.jpg'; ?>
<?php include("fetch_request.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>User Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    /* --- Reset --- */
    * {
      box-sizing: border-box;
    }

    html, body {
      height: 100%;
      margin: 0;
      font-family: 'Comic Sans MS', 'Comic Sans', cursive !important;
      background: url('<?php echo $backgroundImage; ?>') no-repeat center center fixed;
      background-size: cover;
      overflow-x: hidden;
    }

    /* Overlay for dark effect */
    body::before {
      content: "";
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0, 0, 0, 0.6);
      z-index: -1;
    }

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

    /* --- Container --- */
    .dashboard-container {
      padding: 2rem 1rem;
      max-width: 1100px;
      margin: 0 auto;
    }

    /* --- Service Banner --- */
    .service-banner {
      background: rgba(255, 255, 255, 0.08);
      padding: 3rem 2rem;
      border-radius: 20px;
      text-align: center;
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      box-shadow: 0 10px 30px rgba(0,0,0,0.4);
      margin-bottom: 2rem;
      border: 1px solid rgba(255,255,255,0.2);
    }

    .service-banner h2 {
      color: #ffffff;
      font-weight: 700;
      font-size: 2.2rem;
      margin-bottom: 1rem;
      text-shadow: 0 3px 8px rgba(0,0,0,0.5);
    }

    .service-banner p {
      font-size: 1.1rem;
      color: rgba(255, 255, 255, 0.85);
      margin-bottom: 2rem;
    }

    .service-banner .btn {
      font-weight: 600;
      padding: 14px 32px;
      border-radius: 40px;
      font-size: 1rem;
      transition: all 0.3s ease;
    }

    .btn-emergency {
      background: linear-gradient(45deg, #ff4e50, #ff6b6b);
      color: #fff;
      border: none;
      box-shadow: 0 6px 15px rgba(255,75,75,0.4);
    }
    .btn-emergency:hover {
      background: linear-gradient(45deg, #e63946, #ff5252);
      transform: translateY(-4px);
    }

    .btn-schedule {
      background: linear-gradient(45deg, #3498db, #2ecc71);
      color: #fff;
      border: none;
      box-shadow: 0 6px 15px rgba(0,0,0,0.3);
    }
    .btn-schedule:hover {
      background: linear-gradient(45deg, #2e86c1, #27ae60);
      transform: translateY(-4px);
    }

    /* --- Requests Section --- */
    .requests-section {
      background: rgba(65, 60, 60, 0.6);
      padding: 2rem;
      border-radius: 20px;
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.4);
    }

    .requests-section h2 {
      font-size: 1.6rem;
      font-weight: 700;
      color: #fff;
      margin-bottom: 1.5rem;
      text-shadow: 0 2px 6px rgba(0,0,0,0.5);
    }

    .table {
      background: rgba(255,255,255,0.9);
      border-radius: 10px;
      overflow: hidden;
    }

    table thead {
      background: rgba(0, 0, 0, 0.4);
      border-bottom: 3px solid #00c6ff;
    }

    

    .table th, .table td {
      vertical-align: middle;
      border-bottom: 2px solid #ddd;
    }

    /* Status badges */
    .status-badge {
      display: inline-block;
      padding: .35em .75em;
      font-size: 0.8em;
      font-weight: 700;
      border-radius: .25rem;
      text-transform: uppercase;
    }

    .status-in-progress { background-color: #17a2b8; color: #fff; }
    .status-completed { background-color: #28a745; color: #fff; }
    .status-pending   { background-color: #ffc107; color: #212529; }
  </style>
</head>
<body>

<main class="dashboard-container">
  <!-- Banner -->
  <section class="service-banner text-center">
    <div class="banner-content">
      <h2>❄️ Need Aircon Service?</h2>
      <p>Fast, reliable, and professional repair & maintenance for your aircon unit.</p>
      <div class="d-flex justify-content-center flex-wrap gap-2 mt-3">
        <a href="new_request.php" class="btn btn-schedule">📅 Schedule Service</a>
      </div>
    </div>
  </section>


  <!-- notify user -->
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


<!-- Requests -->
<section class="requests-section">
  <h2>Current Service Requests 🛠️</h2>
  <div class="table-responsive">
    <table class="table text-center">
      <thead>
        <tr>
          <th scope="col">Request ID</th>
          <th scope="col">Service Type</th>
          <th scope="col">Aircon Type</th>
          <th scope="col">Expected Date</th>
          <th scope="col">Status</th>
          <th scope="col">Technician Name</th>
          <th scope="col">Technician Contact</th>
          <th scope="col">Price</th>
          <th scope="col">Option</th>

        </tr>
      </thead>
      <tbody>
        <?php while($row = mysqli_fetch_array($customerquery_run)): ?>
        <tr>
          <td><?php echo $row['id'] ?></td>
          <td><?php echo $row['service_type'] ?></td>
          <td><?php echo $row['ac_brand'] ?? $row['service_type'] ?></td>
          <td><?php echo date("F j, Y g:i a", strtotime($row['preferred_date'])) ?></td>
          <td><span class="status-badge status-<?php echo strtolower(str_replace(' ', '-',$row['status'])) ?>"><?php echo $row['status'] ?></span></td>
          <td><?php echo $row['technician_name'] ?? 'Not Assigned' ?></td>
          <td><?php echo $row['phone'] ?? 'Not Assigned'?></td>
          <td>₱<?php echo number_format($row['price']) ?>  </td>
          <td>
            <a href="cancel_request.php?id=<?php echo $row['id']; ?>"
            class="btn btn-secondary"
            onclick="return confirm('Are you sure you want to cancel?')">
            Cancel
            </a>
          </td>
          <?php endwhile; ?>
        </tr>
        
      </tbody>
    </table>
  </div>
</section>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>
