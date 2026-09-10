<?php

session_start();

require_once "../models/dbConnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $user_id = $_SESSION["user_id"];
    $slot_id = $_POST["slot_id"];
    $vehicle_number = $_POST["vehicle_number"];
    $booking_date = $_POST["booking_date"];
    $booking_time = $_POST["booking_time"];

    $conn = dbConnection();

    $sql = "INSERT INTO bookings (user_id, slot_id, vehicle_number, booking_date, booking_time, status)
            VALUES (?, ?, ?, ?, ?, 'pending')";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "iisss",
        $user_id,
        $slot_id,
        $vehicle_number,
        $booking_date,
        $booking_time
    );

    if (mysqli_stmt_execute($stmt))
    {
        $update = "UPDATE parking_slots SET status='booked' WHERE id=?";

        $update_stmt = mysqli_prepare($conn, $update);

        mysqli_stmt_bind_param($update_stmt, "i", $slot_id);

        mysqli_stmt_execute($update_stmt);

        header("Location: ../views/student/dashboard.php");
        exit();
    }
    else
    {
        echo "Booking failed";
    }
}
if (isset($_GET["approve"]))
{
    $id = $_GET["approve"];

    $conn = dbConnection();

    $sql = "UPDATE bookings SET status='active' WHERE id=?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt))
    {
        header("Location: ../views/staff/bookings.php");
        exit();
    }
    else
    {
        echo "Approval failed";
    }
}

if (isset($_GET["reject"]))
{
    $id = $_GET["reject"];

    $conn = dbConnection();

    $sql = "SELECT slot_id FROM bookings WHERE id=?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $id);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $booking = mysqli_fetch_assoc($result);

    if ($booking)
    {
        $slot_id = $booking["slot_id"];

        $sql = "UPDATE bookings SET status='cancelled' WHERE id=?";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "i", $id);

        mysqli_stmt_execute($stmt);

        $sql = "UPDATE parking_slots SET status='available' WHERE id=?";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "i", $slot_id);

        mysqli_stmt_execute($stmt);
    }

    header("Location: ../views/staff/bookings.php");
    exit();
}

if (isset($_GET["cancel"]))
{
    $id = $_GET["cancel"];

    $conn = dbConnection();

    $sql = "SELECT slot_id FROM bookings WHERE id=?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $id);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $booking = mysqli_fetch_assoc($result);

    if ($booking)
    {
        $slot_id = $booking["slot_id"];

        $sql = "UPDATE bookings SET status='cancelled' WHERE id=?";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "i", $id);

        mysqli_stmt_execute($stmt);

        $sql = "UPDATE parking_slots SET status='available' WHERE id=?";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "i", $slot_id);

        mysqli_stmt_execute($stmt);
    }

    header("Location: ../views/student/dashboard.php");
    exit();
}
?>