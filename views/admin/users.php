<?php

session_start();

require_once "../../models/dbConnect.php";

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "admin")
{
    header("Location: ../authentication/login.php");
    exit();
}

$conn = dbConnection();

$sql = "SELECT * FROM users";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>

<html>

<head>


<title>Manage Users</title>

<link rel="stylesheet" href="admin.css">


</head>

<body>

<div class="users-container">

    <h1>Manage Users</h1>

    <table>

        <tr>

            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Created At</th>
            <th>Action</th>

        </tr>

        <?php

        while ($user = mysqli_fetch_assoc($result))
        {

        ?>

        <tr>

            <td><?php echo $user["id"]; ?></td>

            <td><?php echo $user["name"]; ?></td>

            <td><?php echo $user["email"]; ?></td>

            <td><?php echo $user["role"]; ?></td>

            <td><?php echo $user["created_at"]; ?></td>

            <td>

                <a class="delete-btn" href="../../controllers/userController.php?delete=<?php echo $user["id"]; ?>">
                    Delete
                </a>

            </td>

        </tr>

        <?php

        }

        ?>

    </table>
<a href="../../controllers/logoutController.php" class="logout-link">Logout</a>

<br><br>

<a href="dashboard.php" class="back-btn">Back to Dashboard</a>
</div>


</body>

</html>
