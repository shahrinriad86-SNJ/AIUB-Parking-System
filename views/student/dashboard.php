<?php

session_start();

if(isset($_SESSION["user_id"]) && isset($_SESSION["role"]))
{
    if($_SESSION["role"]=="admin")
    {
        header("Location: ../admin/dashboard.php");
        exit();
    }
    else if($_SESSION["role"]=="staff")
    {
        header("Location: ../staff/dashboard.php");
        exit();
    }
    else if($_SESSION["role"]=="student")
    {
        
    }
    else
    {
        header("Location: ../authentication/login.php");
        exit();
    }
}
else
{
    header("Location: ../authentication/login.php");
    exit();
}

require_once "../../models/dbConnect.php";

$conn = dbConnection();

$sql = "SELECT * FROM parking_slots";

$result = mysqli_query($conn, $sql);

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

        <div id="parkingSection">

            <div class="section-header">

                <h2>Parking Slots</h2>

                <p>View and book an available parking slot</p>

            </div>

            <div class="slot-container">

                <?php

                while ($slot = mysqli_fetch_assoc($result))
                {

                ?>

                    <div class="slot-card">

                        <div class="slot-top">

                            <h3><?php echo $slot["slot_number"]; ?></h3>

                            <span class="status <?php echo $slot["status"]; ?>">
                                <?php echo ucfirst($slot["status"]); ?>
                            </span>

                        </div>

                        <?php

                        if ($slot["status"] == "available")
                        {

                        ?>

                            <form action="../../controllers/bookingController.php" method="POST">

                                <input type="hidden" name="slot_id" value="<?php echo $slot["id"]; ?>">

                                <label>Vehicle Number</label>

                                <input type="text" name="vehicle_number" placeholder="Enter vehicle number" required>

                                <label>Booking Date</label>

                                <input type="date" name="booking_date" required>

                                <label>Booking Time</label>

                                <input type="time" name="booking_time" required>

                                <button type="submit">Book This Slot</button>

                            </form>

                        <?php

                        }
                        else
                        {

                        ?>

                            <p class="unavailable">This slot is currently unavailable.</p>

                        <?php

                        }

                        ?>

                    </div>

                <?php

                }

                ?>

            </div>

            <button id="backFromParking">Back to Dashboard</button>

        </div>

        <div id="bookingSection">

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

                            <h3>Slot <?php echo $booking["slot_number"]; ?></h3>

                            <span class="status <?php echo $booking["status"]; ?>">
                                <?php echo ucfirst($booking["status"]); ?>
                            </span>

                        </div>

                        <p><strong>Vehicle Number:</strong> <?php echo $booking["vehicle_number"]; ?></p>

                        <p><strong>Date:</strong> <?php echo $booking["booking_date"]; ?></p>

                        <p><strong>Time:</strong> <?php echo $booking["booking_time"]; ?></p>

                        <?php

                        if ($booking["status"] == "pending" || $booking["status"] == "active")
                        {

                        ?>

                            <a class="cancel-btn" href="../../controllers/bookingController.php?cancel=<?php echo $booking["id"]; ?>">
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

            <button id="backFromBooking">Back to Dashboard</button>

        </div>

    </div>

        <script src="student.js" defer></script>

</body>

</html>