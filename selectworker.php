<!DOCTYPE html>
<?php 
include('fetch_request.php');
?>

<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Select Worker</title>
<link rel="stylesheet" href="celsoadmin/selectworker.css?v=<?php echo time(); ?>" />
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>Select Worker</h1>
    </div>

    <div class="worker-list">
      <table>
        <thead>
          
          <tr>
            <th>Name</th>
            <th>Role</th>
            <th>Status</th>
            
            <th>Action</th>
          </tr>
          
        </thead>
        <tbody>
          <?php while($row = mysqli_fetch_array($technician_run)) : ?>
          <tr>
            <td><?php echo $row['first_name'], ' ', $row['last_name'] ?></td>
            <td>Technician</td>
            <td class="status-<?php echo strtolower($row['status']) ?>"><?php echo $row['status'] ?></td>
            
            <td>
              <form action="remove_technician.php" method="POST"
              onsubmit="return confirm('Are you sure you want to delete this technician?');">
              <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
              <button class="btn btn-remove" name="remove_btn" type="submit">Remove</button>
              </form>
            </td>
          </tr>
          <?php endwhile; ?>
          
        </tbody>
      </table>
    </div>

  </div> 

  <div class="back-button" style="margin-top:20px; text-align:center;">
    <a href="admindashboard.php">
      <button class="btn">Back to Admin Dashboard</button>
    </a>
  </div>

  <script src="selectworker.js"></script>
</body>
</html>