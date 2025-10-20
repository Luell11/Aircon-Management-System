<?php include(__DIR__ . '/include/header.php'); ?>
<?php include('fetch_request.php'); ?>
<?php $backgroundImage = 'dash.jpg'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Service  History</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background: url('<?php echo $backgroundImage; ?>') no-repeat center center fixed;
      background-size: cover;
      min-height: 100vh;
      color: #fff;
      font-family: "Comic Sans MS", cursive, sans-serif;
    }
    body::before {
      content: "";
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.65);
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
    
    .card-custom {
      background: rgba(255, 255, 255, 0.12);
      border-radius: 20px;
      padding: 2rem;
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      box-shadow: 0 8px 24px rgba(0,0,0,0.5);
      color: #fff;
    }
    h2 {
      text-align: center;
      margin-bottom: 1.5rem;
      text-shadow: 0 3px 8px rgba(0,0,0,0.5);
    }
    table {
      color: #fff;
      border-collapse: collapse;
      width: 100%;
    }
    table thead {
      background: rgba(0, 0, 0, 0.4);
      border-bottom: 3px solid #00c6ff;
    }
    table th {
      text-transform: uppercase;
      font-weight: bold;
      padding: 12px;
      border-bottom: 2px solid rgba(255,255,255,0.25);
    }
    table td {
      padding: 12px;
      border-bottom: 1.5px solid rgba(255,255,255,0.15); /* underline effect */
    }
    tr:hover {
      background: rgba(255, 255, 255, 0.08);
      transition: 0.3s;
    }
    .status-pending {
      color: #ffcc00;
      font-weight: bold;
    }
    .status-inprogress {
      color: #00bcd4;
      font-weight: bold;
    }
    .status-completed {
      color: #00e676;
      font-weight: bold;
    }
  </style>
</head>
<body>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="card-custom">
        <h2>📜 Service  History</h2>

        <div class="table-responsive">
      <table class="table text-center">
        <thead>
          <tr>
            <th scope="col">Request ID</th>
            <th scope="col">Service Type</th>
            <th scope="col">Date Finished</th>
            <th scope="col">Status</th>
            <th scope="col">Technician Name</th>
            <th scope="col">Technician Contact</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = mysqli_fetch_array($completed_run)) : ?>
          <tr>
            <td><?php echo $row['service_id'] ?></td>
            <td><?php echo $row['service_type'] ?></td>
            <td><?php echo date("M d, Y",strtotime($row['date_finished'])) ?></td>
            <td><span class="status-badge status-<?php echo strtolower($row['service_status']) ?>"><?php echo $row['service_status'] ?></span></td>
            <td><?php echo $row['technician_name'] ?></td>
            <td><?php echo $row['phone'] ?></td>
          </tr>
          <?php endwhile; ?>

        </tbody>
      </table>
    </div>
  </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>