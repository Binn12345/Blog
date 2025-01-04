<?php

    session_start();
    session_unset();
    session_destroy();

    header('Location: ../Blog'); // Redirect to the login form
    exit;

?>