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
  <div id="sessionModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Session Timeout Warning</h5>
        </div>
        <div class="modal-body">
          <p>Your session is about to expire. Do you want to stay logged in?</p>
        </div>
        <div class="modal-footer">
          <button id="stayLoggedIn" class="btn btn-success">Stay Logged In</button>
          <button id="logout" class="btn btn-danger">Log Out</button>
        </div>
      </div>
    </div>
  </div>

  <main id="main" class="main">

    <!-- <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div> -->

    <div class="modal fade" id="basicModal" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Basic Modal</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Non omnis incidunt qui sed occaecati magni asperiores est mollitia. Soluta at et reprehenderit. Placeat autem numquam et fuga numquam. Tempora in facere consequatur sit dolor ipsum. Consequatur nemo amet incidunt est facilis. Dolorem neque recusandae quo sit molestias sint dignissimos.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" data-bs-dismiss="modal">Stay Logged In</button>
            <button type="button" class="btn btn-danger">Logout</button>
          </div>
        </div>
      </div>
    </div><!-- End Basic Modal-->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->

        <!-- <?= var_dump('<pre>', $_POST, $_SESSION, $usertype) ?> -->

        <?php if (in_array($user['usertype'], array('0'))) {
          require_once("admin.php"); ?>
        <?php } else if (in_array($user['usertype'], array('1'))) {
          require_once("user.php");
        } ?>



        <?php if (in_array($user['usertype'], array('0')))  require_once("adminrightside.php"); ?>


      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php if (in_array($user['usertype'], array('0'))) require_once("../components/footer.php") ?>
  <!-- End Footer -->

  <?php require_once("../components/script.php") ?>

  <script>
    $(document).ready(function() {
      let sessionTimeout = 4 * 60 * 1000; // 4 minutes before showing modal
      let sessionInterval = setInterval(checkSession, 5000); // Check session every 5 sec

      function checkSession() {
        $.getJSON("../session.php", function(data) {
          if (data.expired) {
            clearInterval(sessionInterval);
            window.location.href = "../logout.php";
          }
        });
      }

      // Show modal before session expires
      setTimeout(function() {
        $("#sessionModal").modal("show");
      }, sessionTimeout);

      // Stay logged in
      $("#stayLoggedIn").click(function() {
        $.get("../session.php", function() {
          $("#sessionModal").modal("hide");
        });
      });

      // Log out
      $("#logout").click(function() {
        window.location.href = "../logout.php";
      });

      
      /* tester script seconds only */
      // let sessionInterval = setInterval(checkSession, 1000); // Check session every 1 second
      // let modalTimeout = 0; // Track inactivity

      // function checkSession() {
      //     $.getJSON("../session.php", function (data) {
      //         if (data.expired) {
      //             clearInterval(sessionInterval);
      //             window.location.href = "../logout.php";
      //         }
      //     });
      // }

      // // Detect inactivity (3 seconds)
      // function resetTimer() {
      //     clearTimeout(modalTimeout);
      //     modalTimeout = setTimeout(function () {
      //         $("#sessionModal").modal("show");
      //     }, 3000); // Show modal after 3 seconds of inactivity
      // }

      // $(document).on("mousemove keypress click", function () {
      //     resetTimer(); // Reset inactivity timer
      // });

      // // Stay Logged In
      // $("#stayLoggedIn").click(function () {
      //     $.get("../session.php", function () {
      //         $("#sessionModal").modal("hide");
      //         resetTimer(); // Reset inactivity timer
      //     });
      // });

      // // Log Out
      // $("#logout").click(function () {
      //     window.location.href = "../logout.php";
      // });

      // resetTimer(); // Start inactivity timer
    });
  </script>
</body>

</html>