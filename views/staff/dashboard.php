<?php

session_start();

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "staff")
{
    header("Location: ../authentication/login.php");
    exit();
}

?>

<!DOCTYPE html>

<html>

<head>

    <title>Staff Dashboard</title>

    <link rel="stylesheet" href="staff.css">

</head>

<body>

<div class="staff-container">

    <h1>Staff Dashboard</h1>

    <div class="staff-cards">

        <div class="staff-card">

            <h2>Manage Bookings</h2>


            <a href="bookings.php">View Bookings</a>

        </div>

        <div class="staff-card">

            <h2>Parking Information</h2>


            <a href="information.php">View Information</a>

        </div>

    </div>

    <a href="../../controllers/logoutController.php" class="logout-link">
        Logout
    </a>

</div>

<script src="staff.js" defer></script>

</body>

</html>