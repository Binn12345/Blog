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

</body>

</html>