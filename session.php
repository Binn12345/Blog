<?php
session_start();
$timeout = 300; // 300 seconds = 5 minutes
$_SESSION['LAST_ACTIVITY'] = time();

// Checker ng session kung expired na 
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $timeout)) {
    session_unset();
    session_destroy();
    echo json_encode(['expired' => true]);
    exit;
} else {
    $_SESSION['LAST_ACTIVITY'] = time();
    echo json_encode(['expired' => false]);
}
