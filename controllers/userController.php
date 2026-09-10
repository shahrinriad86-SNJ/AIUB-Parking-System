<?php

require_once "../models/dbConnect.php";

if (isset($_GET["delete"]))
{
    $id = $_GET["delete"];

    $conn = dbConnection();

    $sql = "DELETE FROM bookings WHERE user_id=?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $id);

    mysqli_stmt_execute($stmt);

    $sql = "DELETE FROM users WHERE id=?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt))
    {
        header("Location: ../views/admin/users.php");
        exit();
    }
    else
    {
        echo "Delete failed";
    }
}

?>