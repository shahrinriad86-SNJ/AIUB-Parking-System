<?php

session_start();

if (!isset($_SESSION["user_id"]) || !isset($_SESSION["role"]) || $_SESSION["role"] != "student")
{
    header("Location: ../authentication/login.php");
    exit();
}

require_once "../../models/dbConnect.php";

$conn = dbConnection();

$user_id = $_SESSION["user_id"];

$booking_sql = "SELECT bookings.*, parking_slots.slot_number
                FROM bookings
                INNER JOIN parking_slots ON bookings.slot_id = parking_slots.id
                WHERE bookings.user_id=?";

$stmt = mysqli_prepare($conn, $booking_sql);

mysqli_stmt_bind_param($stmt, "i", $user_id);

mysqli_stmt_execute($stmt);

$booking_result = mysqli_stmt_get_result($stmt);

?>

<!doctype html>

<html>

<head>

    <title>My Bookings</title>

    <link rel="stylesheet" href="student.css">

</head>

<body>

    <div class="container">

        <div id="bookingSection" style="display: block;">

            <div class="section-header">

                <h2>My Bookings</h2>

                <p>View your parking booking information</p>

            </div>

            <?php

            if (mysqli_num_rows($booking_result) > 0)
            {

                while ($booking = mysqli_fetch_assoc($booking_result))
                {

            ?>

                    <div class="booking-card">

                        <div class="booking-top">

                            <h3>
                                Slot <?php echo $booking["slot_number"]; ?>
                            </h3>

                            <span class="status <?php echo $booking["status"]; ?>">
                                <?php echo ucfirst($booking["status"]); ?>
                            </span>

                        </div>

                        <p>
                            <strong>Vehicle Number:</strong>
                            <?php echo $booking["vehicle_number"]; ?>
                        </p>

                        <p>
                            <strong>Date:</strong>
                            <?php echo $booking["booking_date"]; ?>
                        </p>

                        <p>
                            <strong>Time:</strong>
                            <?php echo $booking["booking_time"]; ?>
                        </p>

                        <?php

                        if ($booking["status"] == "pending" || $booking["status"] == "active")
                        {

                        ?>

                            <a
                                class="cancel-btn"
                                href="../../controllers/bookingController.php?cancel=<?php echo $booking["id"]; ?>"
                            >
                                Cancel Booking
                            </a>

                        <?php

                        }

                        ?>

                    </div>

            <?php

                }

            }
            else
            {

            ?>

                <div class="no-booking">

                    <p>No bookings found.</p>

                </div>

            <?php

            }

            ?>

            <button
                id="backFromBooking"
                onclick="window.location.href='dashboard.php'"
            >
                Back to Dashboard
            </button>

        </div>

    </div>

</body>

</html>