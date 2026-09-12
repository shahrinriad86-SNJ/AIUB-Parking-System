<?php

session_start();

if (!isset($_SESSION["user_id"]) || !isset($_SESSION["role"]) || $_SESSION["role"] != "student")
{
    header("Location: ../authentication/login.php");
    exit();
}

?>

<!doctype html>

<html>

<head>

    <title>Student Dashboard</title>

    <link rel="stylesheet" href="student.css">

</head>

<body>

    <div class="container">

        <div id="dashboardSection">

            <div class="dashboard-header">

                <h1>Student Dashboard</h1>

                <p>Welcome to AIUB Parking System</p>

            </div>

            <div class="menu">

                <button id="parkingBtn">

                    <span>🅿️</span>

                    <strong>Parking Slots</strong>

                    <small>View available parking slots</small>

                </button>

                <button id="bookingBtn">

                    <span>🚘</span>

                    <strong>My Bookings</strong>

                    <small>View your booking information</small>

                </button>

            </div>

            <button id="logoutBtn">Logout</button>

        </div>

    </div>

    <script src="student.js" defer></script>

</body>

</html>