<?php

$point = 0;
$requestUri = $_SERVER['REQUEST_URI'];
if (strpos($requestUri, 'site') !== false) $point = 1;
if (strpos($requestUri, 'Blog/') === false) $point = 1;

// Convert to boolean
$point = (bool) $point;
$_SESSION['restricted_access'] = false;
if (!$point) {

?>

  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Blog</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <style>
      /* .sidebar-nav .nav-item.ds {
        
      } */

      .custom-alert .swal2-title {
        font-size: 2px;
        /* Adjust this size */
        line-height: 1.5;
      }

      .custom-alert .swal2-popup {
        padding: 10px;
        /* Optional: adjust padding if needed */
        /* line-height: 1.5; */
      }
    </style>

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  </head>


<?php } else {

  if (!isset($_SESSION['user_id'])) {
    header('Location: ../');
    exit;
  }

  require_once '../config/functions.php';

  $query = "SELECT * FROM users WHERE username = ?";
  $stmt = getDbConnection()->prepare($query);
  $stmt->bind_param('s', $_SESSION['username']);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows > 0)  $user = $result->fetch_assoc(); /* object na */

?>


  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Blog</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">


    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  </head>

<?php } ?>


<!-- Log Out Confirmation Modal -->
<div class="modal fade" id="basicModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow-lg border-0">

      <!-- Header -->
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title fw-bold" id="logoutModalLabel">
          Confirm Log Out
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Body -->
      <div class="modal-body text-center">
        <p class="mb-3">
          Are you sure you want to log out?
        </p>
        <p class="text-muted small">
          Logging out will end your current session, and you will need to log in again to access your account.
        </p>
      </div>

      <!-- Footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" class="btn btn-secondary px-4 fw-bold" data-bs-dismiss="modal">
          ❌ Cancel
        </button>
        <a href="../logout.php" class="btn btn-danger px-4 fw-bold">
          ✅ Yes, Log Out
        </a>
      </div>

    </div>
  </div>
</div>


<!-- Session Timeout Modal -->
<div id="sessionModal" class="modal fade" tabindex="-1" aria-labelledby="sessionModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow-lg border-0">
      <!-- Header -->
      <div class="modal-header bg-warning text-dark">
        <h5 class="modal-title fw-bold" id="sessionModalLabel">
          ⚠️ Your Session is About to Expire
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Body -->
      <div class="modal-body text-center">
        <p class="mb-3">
          You have been inactive for a while. For security reasons, your session will automatically log out.
        </p>
        <p class="text-muted small">
          To stay logged in, please click **"Stay Logged In"** within the next **1 minute**.
          Otherwise, you will be logged out for security purposes.
        </p>
      </div>

      <!-- Footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button id="stayLoggedIn" class="btn btn-success px-4 fw-bold" data-bs-dismiss="modal">
          ✅ Stay Logged In
        </button>
        <a href="../logout.php" class="btn btn-danger px-4 fw-bold">
          🚪 Log Out
        </a>
      </div>
    </div>
  </div>
</div>