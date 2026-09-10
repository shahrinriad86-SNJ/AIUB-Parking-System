<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once "../models/usersModel.php";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    $password = password_hash($password, PASSWORD_DEFAULT);

    $result = addUser($name, $email, $password, $role);

    if ($result)
    {
        header("Location: ../views/authentication/login.php");
        exit();
    }
    else
    {
        echo "Registration failed";
    }
}

?>

