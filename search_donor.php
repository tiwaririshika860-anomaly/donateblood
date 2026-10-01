<?php
include "db.php";

$blood_group = $_GET['blood_group'];
$city = $_GET['city'];

$sql = "SELECT name, age, blood_group, city, phone
        FROM donor
        WHERE blood_group = ? AND city = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $blood_group, $city);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p>";
        echo "Name: " . htmlspecialchars($row['name']) . "<br>";
        echo "Age: " . htmlspecialchars($row['age']) . "<br>";
        echo "Blood Group: " . htmlspecialchars($row['blood_group']) . "<br>";
        echo "City: " . htmlspecialchars($row['city']) . "<br>";
        echo "Phone: " . htmlspecialchars($row['phone']);
        echo "</p><hr>";
    }
} else {
    echo "No donor found.";
}

$stmt->close();
$conn->close();
?>