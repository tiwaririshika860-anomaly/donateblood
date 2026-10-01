<?php

include "db.php";

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$sql = "SELECT * FROM users WHERE email = ? AND password = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "ss",
    $email,
    $password
);

$stmt->execute();

$result = $stmt->get_result();
if ($result->num_rows > 0) {

    session_start();

    $user = $result->fetch_assoc();

    $_SESSION['user_email'] = $email;

    if ($user['user_type'] === 'Admin') {

        $_SESSION['admin'] = true;

        header("Location: admin.php");
        exit;

    } else {

        header("Location: user-dashboard.php");
        exit;

    }


} else {
    echo "Invalid email or password.";
}

$stmt->close();
$conn->close();

?>