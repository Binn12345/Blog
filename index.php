<!DOCTYPE html>
<html lang="en">
<?php 

  session_start();
  require_once('components/head.php'); 
  require_once('config/functions.php'); 


  $key = generateKey(); 
  $originalText = "This is a secret message.";
  $encryptedText = encryptData($originalText, $key);

 

  if (isset($_SESSION['user_id'])) {
      // Redirect to login if not logged in

      header('Location: site/');
      exit;
  } else {

    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
          <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
          <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'SESSION IS DIE'
                });
         
          </script>";
  }


  
?>
<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <!-- <img src="assets/img/logo.png" alt=""> -->
                  <!-- <span class="d-none d-lg-block">NiceAdmin</span> -->
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your username & password to login</p>
                  </div>

                  <div class="row g-3 needs-validation" novalidate id="login">

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="hidden" name="hjob" value="toLogin"/> 
                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <!-- <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div> -->

                    <div class="col-12">
                      <div class="form-check">
                        <!-- <input class="form-check-input" name="remember" type="checkbox" value="accepted" id="acceptTerms" required> -->
                        <input class="form-check-input" name="remember" type="checkbox" value="remember" id="rememberMe" required>
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" id="doLogin">Login</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Don't have account? <a href="register.php?proceed=<?php echo urlencode($encryptedText); ?>">Create an account</a></p>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->
  <?php require_once("components/script.php")?>
  <?php require_once("process/netscript.php") ?>
</body>

</html>