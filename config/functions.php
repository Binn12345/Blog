<?php

// phpinfo();
// die;
// var_dump($host);
// Function to generate a random encryption key
function generateKey($length = 32) {
    return bin2hex(random_bytes($length));
}

// Function to encrypt data
function encryptData($plaintext, $key) {
    // Cipher method
    $cipher = "AES-256-CBC";

    // Generate a random initialization vector (IV)
    $iv_length = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($iv_length);

    // Encrypt the data
    $encrypted = openssl_encrypt($plaintext, $cipher, hex2bin($key), 0, $iv);

    // Combine IV and encrypted data (base64-encoded)
    return base64_encode($iv . $encrypted);
}

// Function to decrypt data
function decryptData($encryptedData, $key) {
    // Cipher method
    $cipher = "AES-256-CBC";

    // Decode the base64-encoded data
    $data = base64_decode($encryptedData);

    // Extract the IV and the encrypted text
    $iv_length = openssl_cipher_iv_length($cipher);
    $iv = substr($data, 0, $iv_length);
    $encryptedText = substr($data, $iv_length);

    // Decrypt the data
    return openssl_decrypt($encryptedText, $cipher, hex2bin($key), 0, $iv);
}


// Global variable for the database connection
$globalDbConnection = null;

// $host = '127.0.0.1';
// $username = 'root';
// $password = '';
// $database = 'nativeconn';
// Function to initialize and return the global database connection
function getDbConnection() {
    require_once 'db.php';
    
    global $globalDbConnection;

    // var_dump($globalDbConnection);
    if (!$globalDbConnection) {
        // Database credentials
        $server = $host;
        $db_user = $username;
        $db_pass = $password;
        $database = $database;

         // Create a new mysqli connection
         $globalDbConnection = new mysqli($server, $db_user, $db_pass, $database);

         // Check the connection
         if ($globalDbConnection->connect_error) {
             die("Connection failed: " . $globalDbConnection->connect_error);
         }
    }

    return $globalDbConnection;
}

function timeAgo($datetime) {
    $now = new DateTime();
    $past = new DateTime($datetime);
    $diff = $now->diff($past);

    if ($diff->y > 0) {
        return $diff->y . " years ago";
    } elseif ($diff->m > 0) {
        return $diff->m . " months ago";
    } elseif ($diff->d > 0) {
        return $diff->d . " days ago";
    } elseif ($diff->h > 0) {
        return $diff->h . " hours ago";
    } elseif ($diff->i > 0) {
        return $diff->i . " minutes ago";
    } else {
        return "Just now";
    }
}


function getRandomParagraphFromAPI() {
    $apiUrl = "https://loripsum.net/api/1/short/plaintext";
    return file_get_contents($apiUrl);
}

function getRandomParagraph() {
    $paragraphs = [
        "The quick brown fox jumps over the lazy dog. This is a classic pangram used for testing fonts and keyboards.",
        "Technology is rapidly evolving, changing the way we interact with the world. Artificial intelligence and automation are playing a major role in shaping the future.",
        "In the middle of difficulty lies opportunity. Every challenge presents a chance to learn and grow, making resilience an essential trait for success.",
        "Nature is an endless source of inspiration. The beauty of the mountains, rivers, and forests reminds us of the wonders of the world.",
        "Reading books opens the door to countless worlds. Each page turns into an adventure, allowing the reader to travel through time and space.","HAHAHAHAHHAHAHAHA so weird"
    ];
    
    return $paragraphs[array_rand($paragraphs)];
}



?>