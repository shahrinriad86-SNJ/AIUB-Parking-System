<!doctype html>
<html>

<head>
    <title>AIUB Parking System</title>
    <link rel="stylesheet" href="authentication.css">
</head>

<body>

    <form id="loginForm">

        <label for="email">  Email: </label>
       
        <input type="text" name="email" id="email">

        <span id="emailErr"></span>

        <br><br>

        <label for="password"> Password:  </label>
        
        <input type="password" name="password" id="password">

        <span id="passwordErr"></span>

        <br><br>

        <input type="submit" value="Login">

        <span id="loginErr"></span>

        <br><br>

        <a href="forgot-password.php">
            Forgot Password?
        </a>

        <br><br>

        <a href="registration.php">
         Create an Account
        </a>

    </form>

    <script src="authentication.js"></script>

</body>

</html>