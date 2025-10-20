<!DOCTYPE html>

<?php 
include("fetch_request.php");
include("includessss/header.php");
$openTickets = countOpenTickets();
$totalTechnician = totalTechnician();
$inprogress = inprogress();
$totalCompleted = totalCompleted();
?>

<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Admin Panel</title>
<link rel="stylesheet" href="celsoadmin/admindashboard.css?v=<?php echo time(); ?>" />
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>Dashboard</h1>
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

    <div class="cards">
      <div class="card">
        <div class="box">
          <h1><?php echo $totalTechnician; ?> </h1>
          <h3>Active Technicians</h3>
        </div>
        <div class="icon-case">
          <img src="https://img.icons8.com/ios-filled/50/2980b9/worker-male.png" alt="Technician Icon"/>
          
        </div>
      </div>
      <div class="card">
        <div class="box">
          <h1><?php echo $openTickets; ?></h1>
          <h3>Open Tickets</h3>
        </div>
        <div class="icon-case">
          <img src="https://img.icons8.com/ios-filled/50/2980b9/order-history.png" alt="Tickets Icon"/>
        </div>
      </div>
      <div class="card">
        <div class="box">
          <h1><?php echo $totalCompleted ?></h1>
          <h3>Completed Works</h3>
        </div>
        <div class="icon-case">
          <img src="https://img.icons8.com/ios-filled/50/2980b9/high-priority.png" alt="Critical Icon"/>
        </div>
      </div>
      <div class="card">
        <div class="box">
          <h1><?php echo $inprogress; ?></h1>
          <h3>In-Progress Work</h3>
        </div>
        <div class="icon-case">
          <img src="https://img.icons8.com/ios-filled/50/2980b9/task.png" alt="In-Progress Icon"/>
        </div>
      </div>
    </div>

    <div class="content-2">
      <div class="recent">
        <div class="title">
          <h2>Pending Service Tickets</h2>
        </div>
        <table>
          <thead>
            <tr>
              <th>Name</th>
              <th>Ticket</th>
              <th>Address</th>
              <th>Time</th>
              <th>Option</th>
            </tr>
          </thead>
          <tbody>
            <?php if(mysqli_num_rows($query_run) > 0): ?>
                <?php while($row = mysqli_fetch_assoc($query_run)): ?>
            <tr>              
                  <td><?php echo $row['first_name'], ' ', $row['last_name'] ?></td>
                  <td><?php echo $row['id'] ?></td>
                  <td><?php echo $row['address'] ?></td>
                  <td><?php echo date("M d, Y h:i, A", strtotime($row['preferred_date'])) ?></td>
                  <td><a href="detail.php?id=<?php echo $row['id']; ?>" class="btn" >View</a></td>          
            </tr>
                <?php endwhile; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

      <div class="technician">
        <div class="title">
          <h2>Technician Availability</h2>
        </div>
        <table>
          <thead>
            <tr>
              <th>Name</th>
              <th>Role</th>
              <th>Status</th>
              <th>Option</th>
            </tr>
          </thead>
          <tbody>
            <?php while($row = mysqli_fetch_assoc($technician_run)): ?>
            <tr>
              <td><?php echo $row['first_name'], ' ', $row['last_name'] ?> </td>
              <td>Technician</td>
              <td class="status-<?php echo strtolower($row['status']);  ?>">
                <?php echo $row['status'] ?></td>
              <td><a href="selectworker.php" class="btn">View</a></td>
            </tr>
            <?php endwhile; ?>
            
          </tbody>
        </table>
      </div>
    </div>

    <div class="content-2" style="margin-top: 30px;">
      <div class="recent" style="flex: 1 1 100%;">
        <div class="title">
          <h2>Quick Actions</h2>
        </div>
        <div class="bts">
          <a href="selectworker.php" class="btn2">Remove Worker</a>
          <a href="addtechnicians.php" class="btn2">Add Technicians</a>
          <a href="inprogresswork.php" class="btn2">Schedule</a>
        </div>
      </div>
    </div>

    <div class="content-2" style="margin-top: 30px;">
      <div class="technician" style="flex: 1 1 100%;">
        <div class="title">
          <h2>Email</h2>
        </div>
        <label for="email">Email:</label>
        <textarea id="email" placeholder="Write text here..."></textarea>
        <br/><br/><br/>
        <a href="#" class="btn2" style="max-width: 120px; margin-top: 15px;">Send</a>
      </div>
    </div>
  </div>
</body>
</html>
