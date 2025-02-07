<?php

    // use PHPMailer\PHPMailer\PHPMailer;
    // use PHPMailer\PHPMailer\Exception;

    // // Load PHPMailer
    // require 'path/to/PHPMailer/src/Exception.php';
    // require 'path/to/PHPMailer/src/PHPMailer.php';
    // require 'path/to/PHPMailer/src/SMTP.php';
    session_start();
    require_once '../config/functions.php';

    // Disable error reporting display (to avoid debug messages mixing with JSON)
    ini_set('display_errors', 0);
    header('Content-Type: application/json');


    // Sanitize the $_POST array
    foreach ($_POST as $key => $value) $_POST[$key] = htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');

    // Extract the POST variables using extract() function
    extract($_POST);

    $terms = isset($terms) ? 1 : 0;
    $remember = isset($remember) ? 1 : 0;
    $hjob  = isset($hjob) ? $hjob : $_POST['hjob'];

    // var_dump('<pre>',$_POST,$hjob);
    switch ($hjob) {
            case 'tosave':
                echo tosave($name,$email,$username,$password,$terms);
                break;
            case 'toUsername':
                echo toUserOrEmail($key,$value);
                break;
            case 'toLogin':
                echo toLoginFunc($username,$password,$remember);
                break;
            case 'toedit':
    }

    function tosave($n,$e,$u,$p,$t) {
        
        $type = $type ?? '1';
        $connection = getDbConnection(); // Get the global DB connection
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

        if (empty($n) && empty($e) && empty($u) && empty($p)) {
            echo json_encode([
                "status" => 0,
                "message" => "All fields are required!",
                "css"   => "block"
            ]);
            exit;
        } else if (empty($n)) {
            echo json_encode([
                  "status" => 0,
                "message" => "Name is required!"
            ]);
            exit;
        } else if(!filter_var($e, FILTER_VALIDATE_EMAIL) || strpos($e, '@gmail.com') === false){
            echo json_encode([
                "status" => 0,
                "message" => "Invalid email address or not a @gmail.com account"
            ]);
            exit;
        } else if (empty($n)) {
            echo json_encode([
                "status" => 0,
                "message" => "Name is required!"
            ]);
            exit;
        } else if (empty($u)){
            echo json_encode([
                "status" => 0,
                "message" => "Username is required!"
            ]);
            exit;
        } else if (empty($p)) {
            echo json_encode([
                "status" => 0,
                "message" => "Password is required!"
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
            $stmt = $connection->prepare("INSERT INTO users (name, email, username, password, usertype, terms) VALUES (?, ?, ?, ?, ? ,?)");
            if (!$stmt) {
                echo json_encode([
                    "status" => 0,
                    "message" => "Error preparing query"
                ]);
                exit;
            }

            // Bind parameters
            $stmt->bind_param("ssssii", $n, $e, $u, $hashedPassword,$type,$t);

            // Execute the query
            if ($stmt->execute()) {

                // $mail = new PHPMailer(true);

                try {
                    // // SMTP Configuration
                    // $mail->isSMTP();
                    // $mail->Host = 'smtp.yourdomain.com';
                    // $mail->SMTPAuth = true;
                    // $mail->Username = 'your-smtp-username';
                    // $mail->Password = 'your-smtp-password';
                    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    // $mail->Port = 587;

                    // // Email Content
                    // $mail->setFrom('no-reply@yourdomain.com', 'Your Platform Name');
                    // $mail->addAddress($e, $n);
                    // $mail->Subject = 'Welcome to Our Platform!';
                    // $mail->Body = "Dear $n,\n\nThank you for registering an account with us. Your username is: $u.\n\nRegards,\nThe Team";

                    // // Send Email
                    // $mail->send();

                    echo json_encode([
                        "status" => 1,
                        "message" => "Account successfully saved. An email has been sent to $e."
                    ]);
                } catch (Exception $e) {
                    echo json_encode([
                        "status" => 1,
                        "message" => "Account successfully saved, but email sending failed: "
                    ]);
                }





                // echo json_encode([
                //     "status" => 1,
                //     "message" => "Account successfully saved."
                // ]);
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
        // mysqli_close($connection);
        // return $message;
    }

    function toUserOrEmail($k,$v) {

        $connection = getDbConnection();
        $tblColumn = '';
        if($k == 'username') $tblColumn = 'username';
        else $tblColumn = 'email'; 
        
        // Check if the username already exists
        $usernameCheckQuery = "SELECT ".$tblColumn." FROM users WHERE ".$tblColumn." =?";
        $usernameCheckStmt = $connection->prepare($usernameCheckQuery);
        
        if (!$usernameCheckStmt) {
            echo json_encode([
                "status" => 0,
                "message" => "Error preparing query"
            ]);
            exit;
        }
        
        if($k == 'username') { 
                // Bind the username parameter and execute
                $usernameCheckStmt->bind_param("s", $v);
                $usernameCheckStmt->execute();
                $usernameCheckStmt->store_result();
                
                if ($usernameCheckStmt->num_rows > 0) {
                    echo json_encode([
                        "key"  => "u",
                        "status" => 0,
                        "message" => "$v already exists"
                    ]);
                } else if (empty($v)) {
                    echo json_encode([
                        "key"  => "u",
                        "status" => 0,
                        "message" => "Username is required!"
                    ]);
                } else {
                    echo json_encode([
                        "key"  => "u",
                        "status" => 1,
                        "message" => "$v is available."
                    ]);
                }
        } else {
                // Bind the username parameter and execute
                $usernameCheckStmt->bind_param("s", $v);
                $usernameCheckStmt->execute();
                $usernameCheckStmt->store_result();
                
                if ($usernameCheckStmt->num_rows > 0) {
                    echo json_encode([
                        "key"  => "e",
                        "status" => 0,
                        "message" => "$v already exists"
                    ]);
                } else if (empty($v)) {
                    echo json_encode([
                        "key"  => "e",
                        "status" => 0,
                        "message" => "Email is required!"
                    ]);
                } else {
                    echo json_encode([
                        "key"  => "e",
                        "status" => 1,
                        "message" => "$v is available."
                    ]);
                }
        }
      
        
        // Close the statement
        $usernameCheckStmt->close();
        // return $message;
        // Close the database connection
        // mysqli_close($connection);

    }

    function toLoginFunc($u,$p,$r) {
        // var_dump('<pre>',$u,$p,$r);

        $username = trim($u);
        $password = $p;


        $connection = getDbConnection();
        // Validate input
        if (empty($username) || empty($password)) {
            echo "Please fill in all fields.";
            exit;
        }

        // Check user in the database
        $query = "SELECT * FROM users WHERE username = ? OR email = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param('ss', $username, $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['usertype'] = $user['usertype'];

                echo json_encode([
                    "status" => 1,
                    "message" => "Login successful."
                ]);
                exit;
            } else {
                echo json_encode([
                    "status" => 0,
                    "message" => "Invalid password."
                ]);
                // echo "Invalid password.";
            }
        } else {
            echo json_encode([
                "status" => 0,
                "message" => "No user found with that username/email."
            ]);
            // echo "No user found with that username/email.";
        }

        $stmt->close();
        
    }




    // Optionally close the database connection at the end of the script
    register_shutdown_function(function () {
        global $globalDbConnection;
        if ($globalDbConnection) {
            mysqli_close($globalDbConnection);
        }
    });


?>