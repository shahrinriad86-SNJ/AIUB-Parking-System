<?php

$serverName = "localhost";
$userName = "root";
$dbPassword = "";
$db = "AIUB-Parking_System";

function dbConnection()
{
    global $serverName;
    global $userName;
    global $dbPassword;
    global $db;

    $conn = mysqli_connect($serverName, $userName, $dbPassword, $db);

    if ($conn)
    {
        return $conn;
    }
    else
    {
        echo "connection failed" . mysqli_connect_error();
    }
}

?>