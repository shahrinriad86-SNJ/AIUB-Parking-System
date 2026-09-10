<!doctype html>

<html>

<head>

    <title>Forgot Password</title>

    <link rel="stylesheet" href="authentication.css">

</head>

<body>

    <form id="forgotPasswordForm">

        <h2>Forgot Password</h2>

        <label for="email">Email:</label>

        <input type="email" name="email" id="email">

        <span id="emailErr"></span>

        <br><br>

        <label for="password">New Password:</label>

        <input type="password" name="password" id="password">

        <span id="passwordErr"></span>

        <br><br>

        <label for="confirmPassword">Confirm Password:</label>

        <input type="password" name="confirmPassword" id="confirmPassword">

        <span id="confirmPasswordErr"></span>

        <br><br>

        <input type="submit" value="Change Password">

        <span id="forgotPasswordErr"></span>

        <br><br>

        <a href="login.php">
            Back to Login
        </a>

    </form>

    <script src="authentication.js"></script>

</body>

</html>