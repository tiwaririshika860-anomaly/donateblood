<?php

include "db.php";

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$user_type = $_POST['user_type'] ?? '';

$sql = "INSERT INTO users (name, email, password, user_type)
        VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "ssss",
    $name,
    $email,
    $password,
    $user_type
);
if ($stmt->execute()) {
    header("Location: login.html");
    exit;
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>