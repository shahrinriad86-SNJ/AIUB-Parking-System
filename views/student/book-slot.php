<?php

session_start();

if (!isset($_SESSION["user_id"]) || !isset($_SESSION["role"]) || $_SESSION["role"] != "student")
{
    header("Location: ../authentication/login.php");
    exit();
}

require_once "../../models/dbConnect.php";

$conn = dbConnection();

$sql = "SELECT * FROM parking_slots";

$result = mysqli_query($conn, $sql);

?>

<!doctype html>

<html>

<head>

    <title>Book Parking Slot</title>

    <link rel="stylesheet" href="student.css">

</head>

<body>

    <div class="container">

        <div id="parkingSection" style="display: block;">

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

                                <input
                                    type="hidden"
                                    name="slot_id"
                                    value="<?php echo $slot["id"]; ?>"
                                >

                                <label>Vehicle Number</label>

                                <input
                                    type="text"
                                    name="vehicle_number"
                                    placeholder="Enter vehicle number"
                                    required
                                >

                                <label>Booking Date</label>

                                <input
                                    type="date"
                                    name="booking_date"
                                    required
                                >

                                <label>Booking Time</label>

                                <input
                                    type="time"
                                    name="booking_time"
                                    required
                                >

                                <button type="submit">
                                    Book This Slot
                                </button>

                            </form>

                        <?php

                        }
                        else
                        {

                        ?>

                            <p class="unavailable">
                                This slot is currently unavailable.
                            </p>

                        <?php

                        }

                        ?>

                    </div>

                <?php

                }

                ?>

            </div>

            <button
                id="backFromParking"
                onclick="window.location.href='dashboard.php'"
            >
                Back to Dashboard
            </button>

        </div>

    </div>

</body>

</html>