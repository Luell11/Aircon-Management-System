<?php 
include(__DIR__ . '/include/header.php'); 
include "dbcon.php";
include "fetch_request.php";
$backgroundImage = 'dash.jpg'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Customer Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      font-family: 'Comic Sans MS', 'Comic Sans', cursive !important;
      background: url('<?php echo $backgroundImage; ?>') no-repeat center center fixed;
      background-size: cover;
      margin: 0;
    }
    body::before {
      content: "";
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0, 0, 0, 0.6);
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

    .profile-box {
      max-width: 900px;
      margin: 5rem auto 3rem auto; /* adjust margin kasi may navbar */
      padding: 2rem;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 20px;
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      box-shadow: 0 8px 25px rgba(0,0,0,0.5);
      color: #fff;
    }
    .profile-pic {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      border: 4px solid #fff;
      box-shadow: 0 5px 15px rgba(0,0,0,0.4);
    }
    .info-label {
      font-weight: bold;
      color: #ffde59;
    }
    .btn-edit {
      background: linear-gradient(45deg, #ff6b6b, #f94d6a);
      border: none;
      color: #fff;
      font-weight: bold;
      border-radius: 40px;
      padding: 12px 24px;
      margin-top: 2rem;
      transition: 0.3s;
    }
    .btn-edit:hover {
      background: linear-gradient(45deg, #e63946, #ff5252);
      transform: translateY(-3px);
    }
  </style>
</head>
<body>


<div class="profile-box">
  <div class="row align-items-center">
    <?php while ($row = mysqli_fetch_assoc($userprofile_run)): ?>
      <div class="col-md-8 profile-info">
        <h2>👤 Customer Profile</h2>
        <p><span class="info-label">Full Name:</span> <?php echo $row['first_name'],' ', $row['last_name'] ?></p>
        <p><span class="info-label">Email:</span> <?php echo $row['email'] ?></p>
        <p><span class="info-label">Phone:</span> <?php echo $row['phone'] ?></p>
        <p><span class="info-label">Address:</span> <?php echo $row['address'] ?></p>

        <!-- Button trigger modal -->
        <button class="btn btn-edit" data-bs-toggle="modal" data-bs-target="#editProfileModal">
          ✏️ Edit Profile
        </button>
      </div>

      <div class="col-md-4 text-center">
        <img src="<?php echo !empty($row['profile_pic']) ? $row['profile_pic'] : 'images/nopfp.jpg'; ?>"class="profile-pic">  
      </div>
    <?php endwhile; ?>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-dark p-3 rounded-4">
      <div class="modal-header">
        <h5 class="modal-title">Edit Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
       <form action="upload_profile.php" method="POST" enctype="multipart/form-data"> 
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
        <div class="modal-body">
        
          <div class="mb-3">
            <label class="form-label">Profile Picture</label>
            <input type="file" name="profile_pic" class="form-control" id="profilePicInput">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit"  name="upload_profile" class="btn btn-primary">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
