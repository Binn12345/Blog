<!DOCTYPE html>
<html lang="en">
<?php 
  session_start();  
  require_once("components/head.php");




  if (isset($_SESSION['user_id'])) {
    // Redirect to login if  logged in

    header('Location: site/');
    exit;
  }

?>
<style>
  /* .valid-feecback { 
    display: none;
    width: 100%;
    margin-top: .25rem;
    font-size: .875em;
    color: var(--bs-form-invalid-color);
  } */

</style>
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
                  <span class="d-none d-lg-block"></span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                  </div>

                  <div class="row g-3" id='serial'>
                 
                    <div class="col-12">
                      <input type="hidden" name="hjob" value="tosave" />
                      <label for="yourName" class="form-label">Name</label>
                      <input type="text" name="name" class="form-control" id="yourName" required>
                      <div class="invalid-feedback" id="nameFeedback">Please, enter your name!</div>
                    </div>
                    <!-- checkUsername() 'key','EmailValue','UserVal' -->
                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="email" name="email" class="form-control" id="yourEmail" oninput="checkUserEmailVal('email',this.value)" required>
                        <div class="invalid-feedback" id="emailFeedback">Please enter a valid Email adddress!</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourUsernameR" class="form-label">Username</label>
                        <!-- <span class="input-group-text" id="inputGroupPrepend">@</span> -->
                        <input type="text" name="username" class="form-control" id="yourUsernameR" oninput="checkUserEmailVal('username',this.value)" required>
                        <div class="invalid-feedback"  id="usernameFeedback">Please choose a username.</div>
                    </div>

                    <!-- <div class="col-12 position-relative">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback" id="pFeedback">Please enter your password!</div>
                    </div> -->

                    <div class="col-12 position-relative">
                      <label for="yourPassword" class="form-label">Password</label>
                      <div class="input-group">
                        <input
                          type="password"
                          name="password"
                          class="form-control"
                          id="yourPassword"
                          required
                        />
                        <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                          <i class="fas fa-eye"></i>
                        </span>
                      </div>
                      <div class="invalid-feedback" id="pFeedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="accepted" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">
                          I agree and accept the <a href="#">terms and conditions</a>
                        </label>
                        <div class="invalid-feedback">You must agree before submitting.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" id='create'>Create Account</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="/Blog">Log in</a></p>
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

  <?php require_once("components/script.php") ?>
  <?php require_once("process/netscript.php") ?>

</body>

</html>
