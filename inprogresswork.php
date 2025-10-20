<!DOCTYPE html>
<?php 
include('fetch_request.php');
?>

<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>In Progress Work</title>
<link rel="stylesheet" href="celsoadmin/inprogresswork.css?v=<?php echo time() ?>" />


</head>
<body>
  <div class="container">
    <div class="header">
      <h1>Pending & In-Progress Works</h1>
    </div>

    <div class="tickets-list">
      <table>
        <thead>
          <tr>
            <th>Ticket ID</th>
            <th>Client Name</th>
            <th>Technician</th>
            <th>Date Scheduled</th>
            <th>Status</th>     
            <th>Price</th>
            <th>Option</th>
            
          </tr>
        </thead>
        <tbody>
          <?php while($row = mysqli_fetch_assoc($adminquery_run)): ?>
          <tr>
            <td><?php echo $row['service_id'] ?></td>
            <td><?php echo $row['customer_name'] ?></td>
            <td><?php echo $row['technician_name'] ?? 'N/A' ?></td>
            <td><?php echo date("F j, Y: h:i", strtotime($row['preferred_date'])) ?></td>
            <td class="status <?php echo strtolower(str_replace(' ', '-',$row['service_status']))?>"><?php echo $row['service_status'] ?></td>
            <td><?php echo $row['price'] ?></td>
            <td><a href="detail.php?id=<?php echo $row['service_id']; ?>" class="btn">View</a></td> 
             
            
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
      <br>
      <a href="viewcompleted.php" class="btn">View Completed</a>
    </div>
    <br>
    

  </div>
  <a href="admindashboard.php" class="btn" aria-label="Back to Dashboard">Back</a>
</body>
</html>