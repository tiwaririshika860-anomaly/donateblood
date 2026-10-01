<?php

session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location: login.html");
    exit;
}

$email = $_SESSION['user_email'];

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Dashboard</title>

    <style>

        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            background-color: #fff5f5;
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

        .container {
            width: 90%;
            margin: 40px auto;
        }

        .welcome {
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 10px #ccc;
        }

        .cards {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 25px;
        }

        .card {
            background-color: white;
            padding: 25px;
            flex: 1;
            min-width: 220px;
            border-radius: 10px;
            box-shadow: 0 3px 10px #ccc;
        }

        .card h2 {
            color: #b30000;
        }

        .card a {
            display: inline-block;
            background-color: #b30000;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
        }

    </style>

</head>

<body>

    <header>

        <h1>🩸 User Dashboard</h1>

        <a class="logout" href="logout.php">
            Logout
        </a>

    </header>

    <div class="container">

        <div class="welcome">

            <h2>Welcome!</h2>

            <p>
                Logged in as:
                <strong><?php echo htmlspecialchars($email); ?></strong>
            </p>

        </div>

        <div class="cards">

            <div class="card">

                <h2>Donate Blood</h2>

                <p>
                    Register as a blood donor.
                </p>

                <a href="donor.html">
                    Donate Now
                </a>

            </div>

            <div class="card">

                <h2>Find Blood</h2>

                <p>
                    Search for available donors.
                </p>

                <a href="find-blood.html">
                    Find Blood
                </a>

            </div>

            <div class="card">

                <h2>Request Blood</h2>

                <p>
                    Submit a blood request.
                </p>

                <a href="request.html">
                    Request Blood
                </a>

            </div>

        </div>

    </div>

</body>

</html>