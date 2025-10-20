<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!-- Bootstrap & Boxicons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css?v=<?php echo time(); ?>" rel="stylesheet" />
<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

<style>

body {
  margin: 0 !important;
  padding: 0 !important;
}


.navbar {
  margin: 0 !important;
  padding: 0.5rem 1rem !important;
  border-radius: 0 !important;
}


.navbar-dark.bg-dark {
  position: sticky;
  top: 0;
  z-index: 1050;
}


.navbar-nav .nav-link {
  padding: 0.5rem 0.8rem !important;
}
</style>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center" href="#">
      <i class='bx bx-wrench me-2'></i>Aircon Ayos
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTech" aria-controls="navbarTech" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
        <li class="nav-item">
          <a class="nav-link text-danger" href="logout.php">
            <i class='bx bx-log-out me-1'></i>Logout
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
