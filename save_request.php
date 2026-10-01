<?php
include "db.php";

$patient_name = $_POST['patient_name'];
$blood_group = $_POST['blood_group'];
$units = $_POST['units'];
$location = $_POST['location'];
$contact = $_POST['contact'];
$message = $_POST['message'];

$sql = "INSERT INTO blood_requests
        (patient_name, blood_group, units, location, contact, message)
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "ssisss",
    $patient_name,
    $blood_group,
    $units,
    $location,
    $contact,
    $message
);

if ($stmt->execute()) {
    echo "Blood request submitted successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>