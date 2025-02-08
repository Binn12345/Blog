<?php

$host = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'nativeconn';

// $conn = new mysqli($host, $username, $password, $database);
// if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$globalDbConnection = null;
try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $globalDbConnection = 1;
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}


?>