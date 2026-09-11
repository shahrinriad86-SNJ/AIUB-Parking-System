<?php

session_start();

require_once "../../models/dbConnect.php";

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "admin")
{
    header("Location: ../authentication/login.php");
    exit();
}

$conn = dbConnection();

if (isset($_POST["add"]))
{
    $slot_number = $_POST["slot_number"];

    $sql = "INSERT INTO parking_slots (slot_number, status) VALUES (?, 'available')";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "s", $slot_number);

    mysqli_stmt_execute($stmt);

    header("Location: slots.php");
    exit();
}

if (isset($_POST["update"]))
{
    $id = $_POST["id"];
    $slot_number = $_POST["slot_number"];
    $status = $_POST["status"];

    $sql = "UPDATE parking_slots SET slot_number=?, status=? WHERE id=?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "ssi", $slot_number, $status, $id);

    mysqli_stmt_execute($stmt);

    header("Location: slots.php");
    exit();
}

if (isset($_POST["change_status"]))
{
    $id = $_POST["id"];
    $status = $_POST["status"];

    $sql = "UPDATE parking_slots SET status=? WHERE id=?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "si", $status, $id);

    mysqli_stmt_execute($stmt);

    header("Location: slots.php");
    exit();
}

if (isset($_GET["delete"]))
{
    $id = $_GET["delete"];

    $sql = "DELETE FROM parking_slots WHERE id=?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $id);

    mysqli_stmt_execute($stmt);

    header("Location: slots.php");
    exit();
}

$edit_slot = null;

if (isset($_GET["edit"]))
{
    $id = $_GET["edit"];

    $sql = "SELECT * FROM parking_slots WHERE id=?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $id);

    mysqli_stmt_execute($stmt);

    $result_edit = mysqli_stmt_get_result($stmt);

    $edit_slot = mysqli_fetch_assoc($result_edit);
}

$sql = "SELECT * FROM parking_slots";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>

<html>

<head>

    <title>Parking Slots</title>

    <link rel="stylesheet" href="admin.css">

</head>

<body>

<div class="slots-container">

    <h1>Parking Slots</h1>

    <?php

    if ($edit_slot)
    {

    ?>

    <h2>Edit Parking Slot</h2>

    <form action="slots.php" method="POST" class="slot-add-form">

        <input
            type="hidden"
            name="id"
            value="<?php echo $edit_slot["id"]; ?>" >

        <input
            type="text"
            name="slot_number"
            value="<?php echo $edit_slot["slot_number"]; ?>"
            required >

        <input
            type="hidden"
            name="status"
            value="<?php echo $edit_slot["status"]; ?>" >

        <button type="submit" name="update">
            Update Slot
        </button>

        <a href="slots.php" class="back-btn">
            Cancel
        </a>

    </form>

    <?php

    }
    else
    {

    ?>

    <form action="slots.php" method="POST" class="slot-add-form">

        <input
            type="text"
            name="slot_number"
            placeholder="Enter Slot Number"
            required >

        <button type="submit" name="add">
            Add Slot
        </button>

    </form>

    <?php

    }

    ?>

    <br><br>

    <table>

        <tr>

            <th>ID</th>
            <th>Slot Number</th>
            <th>Status</th>
            <th>Action</th>

        </tr>

        <?php

        while ($slot = mysqli_fetch_assoc($result))
        {

        ?>

        <tr>

            <td><?php echo $slot["id"]; ?></td>

            <td><?php echo $slot["slot_number"]; ?></td>

            <td><?php echo $slot["status"]; ?></td>

            <td>

                <div class="action-buttons">

                    <form action="slots.php" method="POST">

                        <input
                            type="hidden"
                            name="id"
                            value="<?php echo $slot["id"]; ?>" >

                        <input
                            type="hidden"
                            name="status"
                            value="<?php echo $slot["status"] == "available" ? "booked" : "available"; ?>" >

                        <button
                            type="submit"
                            name="change_status" >
                            <?php echo $slot["status"] == "available" ? "Booked" : "Available"; ?>
                        </button>

                    </form>

                    <a
                        href="slots.php?delete=<?php echo $slot["id"]; ?>"
                        class="delete-btn" >
                        Delete
                    </a>

                </div>

            </td>

        </tr>

        <?php

        }

        ?>

    </table>

    <br><br>

    <a
        href="../../controllers/logoutController.php"
        class="logout-link" >
        Logout
    </a>

    <br><br>

    <a href="dashboard.php" class="back-btn">
        Back to Dashboard
    </a>

</div>

<script src="admin.js" defer></script>

</body>

</html>