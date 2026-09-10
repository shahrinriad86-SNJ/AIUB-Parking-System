<?php

session_start();

require_once "../../models/dbConnect.php";

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "staff")
{
    header("Location: ../authentication/login.php");
    exit();
}

$conn = dbConnection();

$sql = "SELECT bookings.*, users.name, users.email, parking_slots.slot_number
        FROM bookings
        INNER JOIN users ON bookings.user_id = users.id
        INNER JOIN parking_slots ON bookings.slot_id = parking_slots.id";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>

<html>

<head>

    <title>Manage Bookings</title>

    <link rel="stylesheet" href="staff.css">

</head>

<body>

<div class="booking-container">

    <h1>Manage Bookings</h1>

    <table>

        <tr>

            <th>ID</th>
            <th>Student Name</th>
            <th>Email</th>
            <th>Slot</th>
            <th>Vehicle Number</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
            <th>Action</th>

        </tr>

        <?php

        while ($booking = mysqli_fetch_assoc($result))
        {

        ?>

        <tr>

            <td><?php echo $booking["id"]; ?></td>

            <td><?php echo $booking["name"]; ?></td>

            <td><?php echo $booking["email"]; ?></td>

            <td><?php echo $booking["slot_number"]; ?></td>

            <td><?php echo $booking["vehicle_number"]; ?></td>

            <td><?php echo $booking["booking_date"]; ?></td>

            <td><?php echo $booking["booking_time"]; ?></td>

            <td><?php echo $booking["status"]; ?></td>

            <td>

                <a
                    href="../../controllers/bookingController.php?approve=<?php echo $booking["id"]; ?>"
                    class="approve-btn"
                >
                    Approve
                </a>

                <a
                    href="../../controllers/bookingController.php?reject=<?php echo $booking["id"]; ?>"
                    class="reject-btn"
                >
                    Reject
                </a>

            </td>

        </tr>

        <?php

        }

        ?>

    </table>

    <br><br>

    <a
        href="../../controllers/logoutController.php"
        class="logout-link"
    >
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