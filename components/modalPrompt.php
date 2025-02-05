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
<!-- END Session Timeout Modal -->