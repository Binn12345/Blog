<?php
// Allow CORS and set content type
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

// Database configuration
$host = '127.0.0.1';
$username = 'root';
$password = '';
$dbname = 'nativeconn';

// Establish database connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]);
    exit();
}

// Handle the request method
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestMethod === 'GET') {
    getUsers($pdo);
} elseif ($requestMethod === 'POST') {
    createUser($pdo);
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Method not allowed']);
    exit();
}

// Function to handle GET requests
function getUsers($pdo)
{
    try {
        $stmt = $pdo->query("SELECT * FROM users");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        http_response_code(200); // OK
        echo json_encode($users);
    } catch (PDOException $e) {
        http_response_code(500); // Internal Server Error
        echo json_encode(['error' => 'Failed to fetch users: ' . $e->getMessage()]);
    }
}


function createUser($pdo)
{
    // Use $_POST to handle form-data
    $name = isset($_POST['name']) ? $_POST['name'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;

    // Validate input
    if (empty($name) || empty($email)) {
        http_response_code(400); // Bad Request
        echo json_encode(['error' => 'Invalid input: name and email are required']);
        return;
    }

    try {
        // Insert the user into the database
        $stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Respond with the created user
        $newUser = [
            'id' => $pdo->lastInsertId(),
            'name' => $name,
            'email' => $email
        ];

        http_response_code(201); // Created
        echo json_encode($newUser);
    } catch (PDOException $e) {
        http_response_code(500); // Internal Server Error
        echo json_encode(['error' => 'Failed to create user: ' . $e->getMessage()]);
    }
}

// Function to handle POST requests
// function createUser($pdo)
// {
//     // Read the raw input
//     $inputData = file_get_contents('php://input');
//     $data = json_decode($inputData, true);

//     // Validate input
//     if (!isset($data['name']) || !isset($data['email'])) {
//         http_response_code(400); // Bad Request
//         echo json_encode(['error' => 'Invalid input: name and email are required']);
//         return;
//     }

//     try {
//         // Insert the user into the database
//         $stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
//         $stmt->bindParam(':name', $data['name']);
//         $stmt->bindParam(':email', $data['email']);
//         $stmt->execute();

//         // Respond with the created user
//         $newUser = [
//             'id' => $pdo->lastInsertId(),
//             'name' => $data['name'],
//             'email' => $data['email']
//         ];

//         http_response_code(201); // Created
//         echo json_encode($newUser);
//     } catch (PDOException $e) {
//         http_response_code(500); // Internal Server Error
//         echo json_encode(['error' => 'Failed to create user: ' . $e->getMessage()]);
//     }
// }
?>
