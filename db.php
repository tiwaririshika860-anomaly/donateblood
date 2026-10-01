<?php

$host = "127.0.0.1";
$port = 3307;
$user = "root";
$password = "";
$database = "blood_donation";

$conn = new mysqli($host, $user, $password, $database, $port);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

?>