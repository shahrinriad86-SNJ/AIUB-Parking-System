<!doctype html>

<html>

<head>

    <title>Registration</title>

    <link rel="stylesheet" href="authentication.css">

</head>

<body>

    <form id="registrationForm" action="../../controllers/registrationController.php" method="POST">

        <h2>Registration</h2>

        <label for="name">Name:</label>

        <input type="text" name="name" id="name" required>

        <br><br>

        <label for="email">Email:</label>

        <input type="email" name="email" id="email" required>

        <br><br>

        <label for="password">Password:</label>

        <input type="password" name="password" id="password" required>

        <br><br>

        <label for="role">Role:</label>

        <select name="role" id="role" required>

            <option value="">Select Role</option>

            <option value="student">Student</option>

            <option value="staff">Staff</option>

            <option value="admin">Admin</option>

        </select>

        <br><br>

        <button type="submit">Register</button>

        <br><br>

        <a href="login.php">
            Already have an account? Login
        </a>

    </form>

</body>

</html>