<?php

$point = 0;
$requestUri = $_SERVER['REQUEST_URI'];
if (strpos($requestUri, 'site') !== false) $point = 1;
if (strpos($requestUri, 'Blog/') === false) $point = 1;

// Convert to boolean
$point = (bool) $point;
// var_dump('<pre>',$point,$requestUri);die;
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


        if ("<?= $point ?>") {
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
                    }, 30000); // 1-minute auto logout
                    // }, 30000); // 30sec auto logout
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
        }

    });

    $(document).ready(function() {
        $("#restrictedModal").modal("show");
    });

    setTimeout(() => {
        let loadingSkeleton = document.getElementById('loadingSkeleton');
        let postContent = document.getElementById('postContent');

        if (!loadingSkeleton) {
            // admin side
        } else {
            loadingSkeleton.classList.add('d-none');
            // console.error("Element with ID 'loadingSkeleton' not found!");
        }

        if (!postContent) {
                // admin side
             // Show Actual Post Content
        } else {
            postContent.classList.remove('d-none');
            // console.error("Element with ID 'postContent' not found!");
        }


        // document.getElementById('loadingSkeleton').classList.add('d-none'); // Hide Skeleton Loader
        // document.getElementById('postContent').classList.remove('d-none'); // Show Actual Post Content
    }, 2000);

    // Example array of image URLs (replace with dynamic values from your backend)
    const images = [
        "../assets/img/test.jpg",
        "../assets/img/profile-img.jpg",
        "../assets/img/messages-3.jpg",
        "../assets/img/messages-3.jpg",
        "../assets/img/profile-img.jpg",
        "../assets/img/profile-img.jpg",
        "../assets/img/profile-img.jpg",
        "../assets/img/profile-img.jpg",
        "../assets/img/profile-img.jpg",
    ];

    const container = document.getElementById("imageContainer");

    if (!container) {
            /* admin side */
    } else {
        let html = "";
        if (images.length === 1) {
            html += `<img src="${images[0]}" class="img-fluid rounded w-100" style="max-height: 500px; object-fit: cover;">`;
        } else if (images.length === 2) {
            html += `<div class="row g-2">`;
            images.forEach(img => {
                html += `<div class="col-6">
                        <img src="${img}" class="img-fluid rounded w-100" style="max-height: 300px; object-fit: cover;">
                     </div>`;
            });
            html += `</div>`;
        } else if (images.length === 3) {
            html += `<div class="row g-2">
                    <div class="col-12">
                        <img src="${images[0]}" class="img-fluid rounded w-100" style="max-height: 400px; object-fit: cover;">
                    </div>
                    <div class="col-6">
                        <img src="${images[1]}" class="img-fluid rounded w-100" style="max-height: 300px; object-fit: cover;">
                    </div>
                    <div class="col-6">
                        <img src="${images[2]}" class="img-fluid rounded w-100" style="max-height: 300px; object-fit: cover;">
                    </div>
                 </div>`;
        } else {
            html += `<div class="row g-2">`;
            images.slice(0, 3).forEach(img => {
                html += `<div class="col-6">
                        <img src="${img}" class="img-fluid rounded w-100" style="max-height: 250px; object-fit: cover;">
                     </div>`;
            });
            if (images.length > 4) {
                html += `<div class="col-6 position-relative">
                        <img src="${images[4]}" class="img-fluid rounded w-100" style="max-height: 250px; object-fit: cover; filter: brightness(70%);">
                        <div class="position-absolute top-50 start-50 translate-middle text-white fw-bold fs-4">+${images.length - 4}</div>
                     </div>`;
            }
            html += `</div>`;
        }

        container.innerHTML = html;
    }

    // alert("<?php echo ($_SERVER['REQUEST_URI'] === '/Blog/site/profile.php' || strpos($_SERVER['REQUEST_URI'], 'profile.php') !== false) ? 'true' : 'false'; ?>");
    /* SERVER SIDE */
    document.addEventListener("DOMContentLoaded", function () {
        if (<?php echo ($_SERVER['REQUEST_URI'] === '/Blog/site/profile.php' || strpos($_SERVER['REQUEST_URI'], 'profile.php') !== false) ? 'true' : 'false'; ?>) {
            document.body.classList.add("toggle-sidebar");
        }
    });
</script>

<script>

</script>