<?php

    require_once '../config/functions.php';

    // Sanitize the $_POST array
    foreach ($_POST as $key => $value) $_POST[$key] = htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');

    // Extract the POST variables using extract() function
    extract($_POST);

    $terms = isset($terms) ? 1 : 0;
    $hjob  = isset($hjob) ? $hjob : $_POST['hjob'];

    // var_dump('<pre>',$_POST,$hjob,$_POST);die;
    switch ($hjob) {
            case 'tosave':
                echo tosave($name,$email,$username,$password,$terms);
                break;
            case 'toUsername':
                echo toUsername($userss);
                break;
            case 'toedit':
    }

    function tosave($n,$e,$u,$p,$t) {

        $connection = getDbConnection(); // Get the global DB connection

        // Disable error reporting display (to avoid debug messages mixing with JSON)
        ini_set('display_errors', 0);
        header('Content-Type: application/json');

        // Hash the password with bcrypt
        $hashedPassword = password_hash($p, PASSWORD_BCRYPT);

        // Check if the email already exists
        $emailCheckQuery = "SELECT id FROM users WHERE email = ?";
        $emailCheckStmt = $connection->prepare($emailCheckQuery);

        if (!$emailCheckStmt) {
            echo json_encode([
                "status" => 0,
                "message" => "Error preparing query"
            ]);
            exit;
        }


        // Bind the email parameter and execute
        $emailCheckStmt->bind_param("s", $e);
        $emailCheckStmt->execute();
        $emailCheckStmt->store_result();


        if(!filter_var($e, FILTER_VALIDATE_EMAIL) || strpos($e, '@gmail.com') === false){
            echo json_encode([
                "status" => 0,
                "message" => "Invalid email address or not a @gmail.com account"
            ]);
            exit;
        }


        if ($emailCheckStmt->num_rows > 0) {
            echo json_encode([
                "status" => 0,
                "message" => "Email already exists"
            ]);
        } else if (empty($e)) { 
            echo json_encode([
                "status" => 0,
                "message" => "Email is required!"
            ]);
        } else if (empty($u)) { 
            echo json_encode([
                "status" => 0,
                "message" => "Username is required!"
            ]);
        } else if (empty($p)) { 
            echo json_encode([
                "status" => 0,
                "message" => "Password is required!"
            ]);
        } else {
            // Prepare the SQL query for inserting the new user
            $stmt = $connection->prepare("INSERT INTO users (name, email, username, password, terms) VALUES (?, ?, ?, ?, ?)");
            if (!$stmt) {
                echo json_encode([
                    "status" => 0,
                    "message" => "Error preparing query"
                ]);
                exit;
            }

            // Bind parameters
            $stmt->bind_param("ssssi", $n, $e, $u, $hashedPassword, $t);

            // Execute the query
            if ($stmt->execute()) {
                echo json_encode([
                    "status" => 1,
                    "message" => "Account successfully saved."
                ]);
            } else {
                echo json_encode([
                    "status" => 0,
                    "message" => "Error executing the query"
                ]);
            }

            // Close the statement
            $stmt->close();
        }


        // Close the email check statement
        $emailCheckStmt->close();
        mysqli_close($connection);
        // return $message;
    }

    function toUsername($u) {
        $connection = getDbConnection(); // Get the global DB connection
        
        // Disable error reporting display (to avoid debug messages mixing with JSON)
        ini_set('display_errors', 0);
        header('Content-Type: application/json');

        // Check if the username already exists
        $usernameCheckQuery = "SELECT username FROM users WHERE username =?";
        $usernameCheckStmt = $connection->prepare($usernameCheckQuery);
        
        if (!$usernameCheckStmt) {
            echo json_encode([
                "status" => 0,
                "message" => "Error preparing query"
            ]);
            exit;
        }
        
        // Bind the username parameter and execute
        $usernameCheckStmt->bind_param("s", $u);
        $usernameCheckStmt->execute();
        $usernameCheckStmt->store_result();
        
        if ($usernameCheckStmt->num_rows > 0) {
            echo json_encode([
                "status" => 0,
                "message" => "$u already exists"
            ]);
        } else if (empty($u)) {
            echo json_encode([
                "status" => 0,
                "message" => "Username is required!"
            ]);
        } else {
            echo json_encode([
                "status" => 1,
                "message" => "$u is available."
            ]);
        }
        
        // Close the statement
        $usernameCheckStmt->close();
        // return $message;
        // Close the database connection
        // mysqli_close($connection);

    }




    // Optionally close the database connection at the end of the script
    register_shutdown_function(function () {
        global $globalDbConnection;
        if ($globalDbConnection) {
            mysqli_close($globalDbConnection);
        }
    });


?>