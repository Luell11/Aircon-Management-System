
<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Add Technician</title>
<link rel="stylesheet" href="celsoadmin/addtechnicians.css?v=<?php echo time() ?>" />
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>Add Technician</h1>
    </div>

    <form class="tech-form" id="techForm" action="add_technician.php" method="POST">
      <label for="first_name">First Name:</label>
      <input type="text" id="name" name="first_name" placeholder="First Name" required />

      <label for="last_name">Last Name:</label>
      <input type="text" id="name" name="last_name" placeholder="Last Name" required />

      <label for="phone">Phone:</label>
      <input type="tel" id="phone" name="phone" placeholder="Phone Number"/>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" placeholder="Email Address" required />

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" placeholder="Password" required minlength="6" />

      <label for="role">Role:</label>
      <select id="role" name="role" required>
        <option value="" disabled selected>Select Role</option>
        <option value="Technician">Technician</option>
      </select>

      <button type="submit" name="add_btn" class="btn">Add Technician</button>
    </form>
  </div>



<a href="admindashboard.php">
  <button class="btn">Back to Admin Dashboard</button>
</a>
</body>
</html>