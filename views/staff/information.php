<?php

session_start();

require_once "../../models/dbConnect.php";

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "staff")
{
    header("Location: ../authentication/login.php");
    exit();
}

$conn = dbConnection();

$slot_sql = "SELECT COUNT(*) AS total_slots FROM parking_slots";
$slot_result = mysqli_query($conn, $slot_sql);
$slot_data = mysqli_fetch_assoc($slot_result);

$available_sql = "SELECT COUNT(*) AS available_slots FROM parking_slots WHERE status='available'";
$available_result = mysqli_query($conn, $available_sql);
$available_data = mysqli_fetch_assoc($available_result);

$booked_sql = "SELECT COUNT(*) AS booked_slots FROM parking_slots WHERE status='booked'";
$booked_result = mysqli_query($conn, $booked_sql);
$booked_data = mysqli_fetch_assoc($booked_result);

$booking_sql = "SELECT COUNT(*) AS total_bookings FROM bookings";
$booking_result = mysqli_query($conn, $booking_sql);
$booking_data = mysqli_fetch_assoc($booking_result);

?>

<!DOCTYPE html>

<html>

<head>

    <title>Parking Information</title>

    <link rel="stylesheet" href="staff.css">

</head>

<body>

<div class="information-container">

    <h1>Parking Information</h1>

    <div class="information-cards">

        <div class="information-card">
            <h3>Total Parking Slots</h3>
            <p><?php echo $slot_data["total_slots"]; ?></p>
        </div>

        <div class="information-card">
            <h3>Available Slots</h3>
            <p><?php echo $available_data["available_slots"]; ?></p>
        </div>

        <div class="information-card">
            <h3>Booked Slots</h3>
            <p><?php echo $booked_data["booked_slots"]; ?></p>
        </div>

        <div class="information-card">
            <h3>Total Bookings</h3>
            <p><?php echo $booking_data["total_bookings"]; ?></p>
        </div>

    </div>

    <br><br>

    <a href="../../controllers/logoutController.php" class="logout-link">
        Logout
    </a>

    <br><br>

    <a href="dashboard.php" class="back-btn">
        Back to Dashboard
    </a>

</div>

<script src="staff.js" defer></script>

</body>

</html>