<?php

$point = 0;
$requestUri = $_SERVER['REQUEST_URI'];
if (strpos($requestUri, 'site') !== false) $point = 1;
if (strpos($requestUri, 'Blog/') === false) $point = 1;

// Convert to boolean
$point = (bool) $point;
// var_dump('<pre>',$point);die;
if (!$point) {

?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<?php } else { ?>



    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short">Chat</i>
    </a>
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<?php } ?>

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


        // /* tester script seconds only */
        // let inactivityTimer;
        // let sessionCheckInterval = setInterval(checkSession, 10000); // Check session every 10 seconds

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
        //     }, 300000); // Show modal after 5 minutes of inactivity (300,000ms)
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

    $(document).ready(function() {
        $("#restrictedModal").modal("show");
    });

    setTimeout(() => {
        document.getElementById('loadingSkeleton').classList.add('d-none'); // Hide Skeleton Loader
        document.getElementById('postContent').classList.remove('d-none'); // Show Actual Post Content
    }, 2000);
</script>