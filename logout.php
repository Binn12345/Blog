<?php

    session_start();
    session_unset();
    session_destroy();

    header('Location: ../'); // Redirect to the login form
    exit;

?>