<?php

session_start();

if(isset($_SESSION["user_id"]) && isset($_SESSION["role"]))
{
    if($_SESSION["role"]=="admin")
    {
        
    }
    else if($_SESSION["role"]=="staff")
    {
        header("Location: ../staff/dashboard.php");
        exit();
    }
    else if($_SESSION["role"]=="student")
    {
        header("Location: ../student/dashboard.php");
        exit();
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

?>

<!doctype html>

<html>

<head>


<title>Admin Dashboard</title>

<link rel="stylesheet" href="admin.css">

</head>

<body>


<div class="sidebar">

    <h2>AIUB Parking</h2>

    <a href="dashboard.php">Dashboard</a>

    <a href="users.php">Manage Users</a>

    <a href="slots.php">Parking Slots</a>

    <a href="information.php">Information</a>

    <button id="logoutBtn">Logout</button>

</div>

<div class="content">

    <h1>Admin Dashboard</h1>

    <p>Welcome Admin</p>

    <div class="cards">

        <div class="card">
            <h3>Manage Users</h3>
            <p>View and manage users</p>
            <a href="users.php">View Users</a>
        </div>

        <div class="card">
            <h3>Parking Slots</h3>
            <p>Manage parking slots</p>
            <a href="slots.php">View Slots</a>
        </div>

        <div class="card">
            <h3>Information</h3>
            <p>View parking information</p>
            <a href="information.php">View Information</a>
        </div>

    </div>

</div>

<script src="admin.js" defer></script>
</body>

</html>
