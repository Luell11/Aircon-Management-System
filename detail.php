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

    $update = "UPDATE service_request 
               SET technician_id = '$tech_id', price = '$price', status = 'In Progress' 
               WHERE id = '$service_id'";
    if (mysqli_query($con, $update)) {
        echo "<script>alert('Technician and Price updated successfully!'); 
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
      <h1>Service Ticket #<?php echo $row['service_id'] ?? $row['id']; ?> - <?php echo $row['service_type'] ?></h1>
    </header>

    <section class="ticket-info">
      <?php if($row): ?>
      <p><strong>Resident Name:</strong> <?php echo $row['customer_name']; ?></p>
      <p><strong>AC Model:</strong> <?php echo $row['ac_model']; ?></p>
      <p><strong>AC Brand:</strong> <?php echo $row['ac_brand']; ?></p>
      <p><strong>Address:</strong> <?php echo $row['address']; ?></p>
      <p><strong>Date Scheduled:</strong> <?php echo date("M d, Y h:i, A ", strtotime($row['preferred_date'])); ?></p>
      <p><strong>Location:</strong> <?php echo $row['location_room']; ?></p>
      <p><strong>Assigned Technician:</strong> 
         <?php echo $row['technician_name'] ? $row['technician_name'] : "Not Assigned"; ?>
      </p>
      <p><strong>Service Price:</strong> 
         <?php echo $row['price'] ? "₱".$row['price'] : "Not Set"; ?>
      </p>  
      <p><strong>Aircon Photo:</strong>
        <img src="<?php echo $row['photo']; ?>">
      </p>
      <?php endif; ?>
    </section>

    <section class="assign-form">
      <h2>Assign Technician & Set Price</h2>
      <form method="POST" onsubmit="return confirmSave();">
        <div class="containerofcontainer">
        <div class="containeralignleft">
        <label for="technician">Technician:</label>
        </div>
        <select name="technician" id="technician" required>
          <div class="containeralignright">
          <option value="">-- Select Technician --</option>
          <?php while($t = mysqli_fetch_assoc($techs)): ?>
            <option value="<?php echo $t['id']; ?>">
              <?php echo $t['first_name'].' '.$t['last_name']; ?>
            </option>
          <?php endwhile; ?>
        </select>
        </div>
        <br>
            <div class="containeralignleft">
        <label for="price">Service Price (₱):</label>
        <div class="containeralignright">
        <input type="number" step="0.01" name="price" id="price" required>
        
        <br><br>
</div>
</div>
            <div class="buttonalign">
        <button class="btn" type="submit" name="assign">Save</button>
        <a class="btn" style="background-color: red;" href="decline_request.php?id=<?php echo $row['service_id']; ?>">Cancel</a>
        
        </div>
      </form>
      <script>
function confirmSave() {
  return confirm("Are you sure you want to save these changes?");
}
</script>
      
    </section>

  </div>
  <a href="admindashboard.php" class="btn" aria-label="Back to Dashboard">Back</a>
</body>

</html>
