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


    <main id="main" class="main">
        <div>
            
        </div>
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <!-- Sales Card -->
                        <div class="col-xxl-12 col-md-6">


                            <div class="card">
                                <div class="card-body">
                             
                                   
                                    <div class="col-xxl-12 col-md-6">
                                        <div class="row">
                                            <div class="col-xxl-10 col-md-12">
                                                <h5 class="card-title">User Accounts</h5>
                                            </div>
                                            <!-- <div class="col-xxl-5 col-md-12">
                                                 <button type="button" class="btn btn-primary rounded-pill mt-2">Add User Account</button>
                                            </div> -->
                                            <div class="col-xxl-2 col-md-12">
                                                 <button type="button" class="btn btn-primary rounded-pill mt-3 w-100">Add User Account</button>
                                                <!-- <h5 class="card-title">User Accounts</h5> -->
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class=""></div>
                                    <!-- <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable. Check for <a href="https://fiduswriter.github.io/simple-datatables/demos/" target="_blank">more examples</a>.</p> -->
                                    <!-- Table with stripped rows -->
                                    <?=dynamicdataTable(true,'useraccount')?>
                                    <!-- End Table with stripped rows -->

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
        </section>


    </main>


    <!-- ======= Footer ======= -->
    <?php if (in_array($user['usertype'], array('0'))) require_once("../components/footer.php") ?>
    <!-- End Footer -->


    <?php require_once("../components/script.php") ?>
    <!-- <script>
        $(document).ready(function() {
            $('#userTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true
            });
        });

        function editUser(btn) {
            let row = $(btn).closest('tr');
            let name = row.find("td:nth-child(1)").text();
            alert("Edit user: " + name);
        }

        function deleteUser(btn) {
            if (confirm("Are you sure you want to delete this user?")) {
                $(btn).closest('tr').remove();
            }
        }
    </script> -->

</body>

</html>