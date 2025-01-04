<?php
    if (!isset($_SESSION['user_id'])) {
        header('Location: ../'); exit;
    }
    require_once '../config/functions.php';

    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = getDbConnection()->prepare($query);
    $stmt->bind_param('s', $_SESSION['username']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0)  $user = $result->fetch_assoc(); /* object na */

?>