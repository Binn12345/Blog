<?php 

session_start(); 
// Check if user is logged in

// var_dump('<pre>',$_SESSION);
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Redirect to login page
    exit;
}

// Assuming user data is stored in session
$user = $_SESSION['usertype'];

// kapag inaccess ng ordinary user
if ($user == '1') {
    $_SESSION['restricted_access'] = true; // Set session to trigger modal
    header("Location: ../restricted.php"); // Redirect to a "Not Authorized" page
    exit;
}

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

    <!-- Restricted Access Modal -->
    <?php if (isset($_SESSION['restricted_access']) && $_SESSION['restricted_access'] === true): ?>
        <div class="modal fade" id="restrictedModal" tabindex="-1" aria-labelledby="restrictedModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="restrictedModalLabel">🚫 Access Denied</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>You do not have permission to access this page. Please contact the administrator if you believe this is an error.</p>
                    </div>
                    <div class="modal-footer">
                        <a href="dashboard.php" class="btn btn-primary">Return to Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
        <?php unset($_SESSION['restricted_access']); ?> <!-- Clear session after showing modal -->
    <?php endif; ?>


    

    
    <?php require_once("../components/script.php") ?>
</body>

</html>