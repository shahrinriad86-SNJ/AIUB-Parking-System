<?php

require_once "../models/dbConnect.php";

if (isset($_POST["add"]))
{
    $slot_number = $_POST["slot_number"];

    $conn = dbConnection();

    $sql = "INSERT INTO parking_slots (slot_number, status) VALUES (?, 'available')";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "s", $slot_number);

    if (mysqli_stmt_execute($stmt))
    {
        header("Location: ../views/admin/slots.php");
        exit();
    }
    else
    {
        echo "Slot add failed";
    }
}

if (isset($_GET["delete"]))
{
    $id = $_GET["delete"];

    $conn = dbConnection();

    $sql = "DELETE FROM parking_slots WHERE id=?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt))
    {
        header("Location: ../views/admin/slots.php");
        exit();
    }
    else
    {
        echo "Delete failed";
    }
}
if (isset($_POST["update"]))
{
    $id = $_POST["id"];
    $slot_number = $_POST["slot_number"];
    $status = $_POST["status"];

    $conn = dbConnection();

    $sql = "UPDATE parking_slots SET slot_number=?, status=? WHERE id=?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "ssi", $slot_number, $status, $id);

    if (mysqli_stmt_execute($stmt))
    {
        header("Location: ../views/admin/slots.php");
        exit();
    }
    else
    {
        echo "Update failed";
    }
}
?>