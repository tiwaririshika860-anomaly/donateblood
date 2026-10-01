<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.html");
    exit;
}

include "db.php";

$donor_count_result = $conn->query("SELECT COUNT(*) AS total FROM donor");
$donor_count = $donor_count_result->fetch_assoc()['total'];

$request_count_result = $conn->query("SELECT COUNT(*) AS total FROM blood_requests");
$request_count = $request_count_result->fetch_assoc()['total'];

$group_count_result = $conn->query("SELECT COUNT(DISTINCT blood_group) AS total FROM donor");
$group_count = $group_count_result->fetch_assoc()['total'];

$donors = $conn->query("
    SELECT name, blood_group, city
    FROM donor
    ORDER BY id DESC
");

$requests = $conn->query("
    SELECT patient_name, blood_group, location
    FROM blood_requests
    ORDER BY patient_name ASC
");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard</title>

    <style>

        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            background-color: #f5f5f5;
        }

        header {
            background-color: #b30000;
            color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            margin: 0;
        }

        .logout {
            background-color: white;
            color: #b30000;
            padding: 10px 18px;
            text-decoration: none;
            border-radius: 5px;
        }

        .dashboard {
            width: 90%;
            margin: 30px auto;
        }

        .cards {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .card {
            background-color: white;
            padding: 25px;
            flex: 1;
            min-width: 200px;
            border-radius: 10px;
            box-shadow: 0 3px 10px #ccc;
        }

        .card h2 {
            color: #b30000;
            font-size: 32px;
            margin: 0 0 10px;
        }

        .section {
            background-color: white;
            margin-top: 30px;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 10px #ccc;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #b30000;
            color: white;
        }

        .status {
            color: green;
            font-weight: bold;
        }

    </style>

</head>

<body>

    <header>

        <h1>🩸 Admin Dashboard</h1>

        <a class="logout" href="logout.php">
            Logout
        </a>

    </header>

    <div class="dashboard">

        <div class="cards">

            <div class="card">
                <h2><?php echo $donor_count; ?></h2>
                <p>Registered Donors</p>
            </div>

            <div class="card">
                <h2><?php echo $request_count; ?></h2>
                <p>Blood Requests</p>
            </div>

            <div class="card">
                <h2><?php echo $group_count; ?></h2>
                <p>Available Blood Groups</p>
            </div>

        </div>

        <div class="section">

            <h2>Donor List</h2>

            <table>

                <tr>
                    <th>Name</th>
                    <th>Blood Group</th>
                    <th>Area</th>
                    <th>Status</th>
                </tr>

                <?php if ($donors->num_rows > 0) { ?>

                    <?php while ($donor = $donors->fetch_assoc()) { ?>

                        <tr>

                            <td><?php echo htmlspecialchars($donor['name']); ?></td>

                            <td><?php echo htmlspecialchars($donor['blood_group']); ?></td>

                            <td><?php echo htmlspecialchars($donor['city']); ?></td>

                            <td class="status">Available</td>

                        </tr>

                    <?php } ?>

                <?php } else { ?>

                    <tr>
                        <td colspan="4">No donors registered yet.</td>
                    </tr>

                <?php } ?>

            </table>

        </div>

        <div class="section">

            <h2>Blood Requests</h2>

            <table>

                <tr>
                    <th>Patient</th>
                    <th>Blood Group</th>
                    <th>Location</th>
                    <th>Status</th>
                </tr>

                <?php if ($requests->num_rows > 0) { ?>

                    <?php while ($request = $requests->fetch_assoc()) { ?>

                        <tr>

                            <td><?php echo htmlspecialchars($request['patient_name']); ?></td>

                            <td><?php echo htmlspecialchars($request['blood_group']); ?></td>

                            <td><?php echo htmlspecialchars($request['location']); ?></td>

                            <td>Pending</td>

                        </tr>

                    <?php } ?>

                <?php } else { ?>

                    <tr>
                        <td colspan="4">No blood requests yet.</td>
                    </tr>

                <?php } ?>

            </table>

        </div>

    </div>

</body>

</html>

<?php
$conn->close();
?>