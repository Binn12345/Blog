<?php
    session_start();
    // var_dump('<pre>',$_SESSION);
    if(!$_SESSION['restricted_access']) {
        header('Location: site/');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f8f9fa;
            text-align: center;
        }
        .error-container {
            max-width: 500px;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .error-icon {
            font-size: 50px;
            color: #dc3545;
        }
    </style>
</head>
<body>

    <div class="error-container">
        <div class="error-icon">🚫</div>
        <h2 class="mt-3 text-danger">Access Denied</h2>
        <p class="text-muted">
            You do not have permission to access this page.  
            If you believe this is an error, please contact the administrator.
        </p>
        <a href="site/" class="btn btn-primary">🔙 Return to Home</a>
    </div>

</body>
</html>
