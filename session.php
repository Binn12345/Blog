<?php
session_start();
$timeout = 300; // 300 seconds = 5 minutes

// Check if session exists
if (isset($_SESSION['LAST_ACTIVITY'])) {
    $inactiveTime = time() - $_SESSION['LAST_ACTIVITY'];

    if ($inactiveTime > $timeout) {
        session_unset();
        session_destroy();
        echo json_encode(['expired' => true]); // Send response to frontend
        exit;
    }
}

// Update session time only when the user interacts
echo json_encode(['expired' => false]);
?>
