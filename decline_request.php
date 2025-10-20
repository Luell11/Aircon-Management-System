<?php
include("dbcon.php");

if (isset($_GET['id'])) {
    $service_id = intval($_GET['id']); // sanitize input

    // Fetch service details
    $query = "SELECT 
                 sr.*, u.*, sr.id AS service_id,    
                 CONCAT(u.first_name, ' ', u.last_name) AS customer_name,
                 CONCAT(t.first_name, ' ', t.last_name) AS technician_name
              FROM service_request sr
              INNER JOIN users u ON sr.user_id = u.id
              LEFT JOIN users t ON sr.technician_id = t.id
              WHERE sr.id = $service_id
              LIMIT 1";

    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
}

// Handle technician assignment + price update
if (isset($_POST['assign'])) {
    $tech_id = intval($_POST['technician']);
    $price   = floatval($_POST['price']);
    $notes = $_POST['notes'];

    $update = "UPDATE service_request 
               SET technician_id = '$tech_id', price = '$price', status = 'Cancelled', customer_notes = '$notes'
               WHERE id = '$service_id'";
    if (mysqli_query($con, $update)) {
        echo "<script>alert('Cancelled successfully!'); 
              window.location.href='admindashboard.php';</script>";
        exit;
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

// Fetch list of available technicians
$techs = mysqli_query($con, "SELECT id, first_name, last_name FROM users WHERE role='technician'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Service Ticket Details</title>
<link rel="stylesheet" href="celsoadmin/detail.css?v=<?php echo time()  ?>" />
</head>
<body>
  <div class="container" role="main" aria-label="Service Ticket Details">
    <header>
      <h1>Cancellation #<?php echo $row['service_id'] ?? $row['id']; ?> - <?php echo $row['service_type'] ?></h1>
    </header>

    <section class="ticket-info">
      <?php if($row): ?>
      <p><strong>Resident Name:</strong> <?php echo $row['customer_name']; ?></p>
      <p><strong>Address:</strong> <?php echo $row['address']; ?></p>
      <p><strong>Date Scheduled:</strong> <?php echo date("M d, Y h:i, A ", strtotime($row['preferred_date'])); ?></p>
      <p><strong>Location:</strong> <?php echo $row['location_room']; ?></p>
      <p><strong>Assigned Technician:</strong> 
         <?php echo $row['technician_name'] ? $row['technician_name'] : "Not Assigned"; ?>
      </p>
      <p><strong>Service Price:</strong> 
         <?php echo $row['price'] ? "₱".$row['price'] : "Not Set"; ?>
      </p>  
      <?php endif; ?>
    </section>

    <section class="assign-form">
      <h2>Reason For Cancellation</h2>
      <form method="POST" onsubmit="return confirmSave();">
        <label for="Reason">Reason</label>
        <input type="text" name="notes" placeholder="Date is not applicable. . ." required>
        <br>
        <br>

        


    <button class="btn" type="submit" name="assign">Save</button>
        
    </div>
      </form>
      <script>
function confirmSave() {
  return confirm("Are you sure you want to cancel?");
}
</script>
      
    </section>

  </div>
  <a href="admindashboard.php" class="btn" aria-label="Back to Dashboard">Back</a>
</body>

</html>
