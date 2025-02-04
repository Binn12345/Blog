<?php
session_start();
// require_once ('userinfo.php');

?>

<!DOCTYPE html>
<html lang="en">

<?php require_once("../components/head.php") ?>

<body>

  <!-- ======= Header ======= -->
  <?php require_once("../components/header.php") ?>
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <?php if (in_array($user['usertype'], array('0'))) require_once("../components/sidebar.php") ?>
  <!-- End Sidebar-->

  <!-- Session Timeout Modal -->
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



  <!-- <main id="main" class="main">
    <section class="section dashboard">
      <div class="row"> -->

  <!-- Left side columns -->
  <!-- <?= var_dump('<pre>', $_POST, $_SESSION, $usertype) ?> -->


  <?php if (in_array($user['usertype'], array('0'))) {
    require_once("admin.php");

  ?>
  <?php } else if (in_array($user['usertype'], array('1'))) {
    require_once("user.php");
  } ?>




  <!-- ======= Footer ======= -->
  <?php if (in_array($user['usertype'], array('0'))) require_once("../components/footer.php") ?>
  <!-- End Footer -->

  <?php require_once("../components/script.php") ?>

  <script>
    $(document).ready(function() {
      let inactivityTimer;
      let isModalShown = false; // Track if modal is open
      let sessionCheckInterval = setInterval(checkSession, 10000); // Check session every 10 sec
      let autoLogoutTimer; // Timer for auto logout

      function checkSession() {
        $.getJSON("../session.php", function(data) {
          if (data.expired) {
            clearInterval(sessionCheckInterval);
            window.location.href = "../logout.php"; // Force logout
          }
        });
      }

      // Show session timeout modal
      function showModal() {
        if (!isModalShown) {
          $("#sessionModal").modal("show");
          isModalShown = true;

          // Auto-logout if no response within 60 seconds
          autoLogoutTimer = setTimeout(function() {
            window.location.href = "../logout.php";
          }, 60000); // 1-minute auto logout
        }
      }

      // Reset the inactivity timer (but don't auto-hide modal)
      function resetTimer() {
        clearTimeout(inactivityTimer);
        inactivityTimer = setTimeout(showModal, 300000); // Show modal after 5 min
      }

      // Detect user activity and reset the timer
      $(document).on("mousemove keypress click", function() {
        resetTimer();
      });

      // Handle tab visibility change
      document.addEventListener("visibilitychange", function() {
        if (!document.hidden) {
          $.getJSON("../session.php", function(data) {
            if (data.expired) {
              window.location.href = "../logout.php";
            } else if (isModalShown) {
              $("#sessionModal").modal("show"); // Keep modal open after returning
            }
          });
        }
      });

      // "Stay Logged In" Button Click
      $("#stayLoggedIn").click(function() {
        $.get("../session.php", function() {
          $("#sessionModal").modal("hide");
          isModalShown = false;
          clearTimeout(autoLogoutTimer); // Stop auto-logout
          resetTimer();
        });
      });

      // "Log Out" Button Click
      $("#logout").click(function() {
        window.location.href = "../logout.php";
      });

      resetTimer(); // Start inactivity timer on page load


      /* tester script seconds only */
      //   let inactivityTimer;
      // let sessionCheckInterval = setInterval(checkSession, 1000); // Check session every 1 second

      // function checkSession() {
      //     $.getJSON("../session.php", function (data) {
      //         if (data.expired) {
      //             clearInterval(sessionCheckInterval);
      //             window.location.href = "../logout.php";
      //         }
      //     });
      // }

      // // Reset the inactivity timer and hide modal
      // function resetTimer() {
      //     clearTimeout(inactivityTimer);
      //     $("#sessionModal").modal("hide");
      //     inactivityTimer = setTimeout(function () {
      //         $("#sessionModal").modal("show");
      //     }, 3000); // Show modal after 3 seconds of inactivity
      // }

      // // Detect user activity and reset the timer
      // $(document).on("mousemove keypress click", function () {
      //     resetTimer();
      // });

      // // "Stay Logged In" Button Click
      // $("#stayLoggedIn").click(function () {
      //     $.get("../session.php", function () {
      //         resetTimer(); // Restart the inactivity timer
      //     });
      // });

      // // "Log Out" Button Click
      // $("#logout").click(function () {
      //     window.location.href = "../logout.php";
      // });

      // resetTimer(); // Start inactivity timer on page load
    });
  </script>
</body>

</html>