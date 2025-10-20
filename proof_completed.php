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
    
    $query = "UPDATE service_request 
                SET status='Completed'
                WHERE id='$service_id'";

    mysqli_query($con, $query);

    $_SESSION['status'] = "Job marked as completed";
    header("Location: admindashboard.php?");
    exit();
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
<link rel="stylesheet" href="proof_completed.css?v=<?php echo time()  ?>" />
</head>
<body>
  <div class="container" role="main" aria-label="Service Ticket Details">
    <header>
      <h1>Service Ticket #<?php echo $row['service_id'] ?? $row['id']; ?> - <?php echo $row['service_type'] ?></h1>
    </header>
    <form method="POST" onsubmit="return confirmSave();">
    <section class="ticket-info">
      <?php if($row): ?>
      <p><strong>Resident Name:</strong> <?php echo $row['customer_name']; ?></p>
      <p><strong>AC Model:</strong> <?php echo $row['ac_model']; ?></p>
      <p><strong>AC Brand:</strong> <?php echo $row['ac_brand']; ?></p>
      <p><strong>Address:</strong> <?php echo $row['address']; ?></p>
      <p><strong>Date Finished:</strong> <?php echo date("M d, Y h:i, A ", strtotime($row['date_finished'])); ?></p>
      <p><strong>Location:</strong> <?php echo $row['location_room']; ?></p>
      <p><strong>Assigned Technician:</strong> 
         <?php echo $row['technician_name'] ? $row['technician_name'] : "Not Assigned"; ?>
      </p>

    <div class="backgroundshits" style="background-color: gray; color: black;">
      <p><strong>Service Price:</strong> 
         <?php echo $row['price'] ? "₱".$row['price'] : "Not Set"; ?>
      </p>  
      <p><strong>Technician Notes:</strong> <?php echo $row['technician_note'] ?></p>
      <p><strong>Aircon Photo Proof:</strong>

        <img src="<?php echo $row['proof_photo']; ?>">
      </p>
      <?php endif; ?>
      </div>
    </section>

    
          <div class="containeralignright">
         
          
        </select>
        </div>
        <br>
            <div class="containeralignleft">
        
        <div class="containeralignright">
        
        </div>
        </div>
            <div class="buttonalign">
        <button class="btn" type="submit" name="assign">Paid</button>
   
        
        </div>
      </form>
      <a href="admindashboard.php" class="btn" aria-label="Back to Dashboard">Back</a>
      <script>
function confirmSave() {
  return confirm("Are you sure you want to save these changes?");
}
</script>
      
    </section>
    
  </div>

</body>
</html>
