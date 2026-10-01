<?php
include "db.php";

$name = $_POST['name'];
$age = $_POST['age'];
$blood_group = $_POST['blood_group'];
$city = $_POST['city'];
$phone = $_POST['phone'];

$sql = "INSERT INTO donor (name, age, blood_group, city, phone)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sisss", $name, $age, $blood_group, $city, $phone);

if ($stmt->execute()) {
    echo "Donor registered successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>