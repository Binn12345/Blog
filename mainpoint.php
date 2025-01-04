<?php
// Set response type
header('Content-Type: application/json');

// Allow CORS for development purposes (optional)
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

// Parse the URL and route the request
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uriSegments = explode('/', trim($uri, '/'));

// Ensure the URL starts with 'api'
if ($uriSegments[0] !== 'api') {
    http_response_code(404);
    echo json_encode(['error' => 'Invalid endpoint']);
    exit();
}

// Get the resource (e.g., 'users')
$resource = $uriSegments[1] ?? null;

// Check if the requested resource exists
if ($resource && file_exists(__DIR__ . "/api/$resource/index.php")) {
    // Include the resource's index.php
    require_once __DIR__ . "/api/$resource/index.php";
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Resource not found']);
}
?>
