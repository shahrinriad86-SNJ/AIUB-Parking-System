<?php

require_once "../models/usersModel.php";

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $email = isset($_POST["email"]) ? trim($_POST["email"]) : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";

    if ($email == "" || $password == "")
    {
        echo json_encode([
            "success" => false,
            "message" => "All fields are required"
        ]);

        exit();
    }

    $result = changePassword($email, $password);

    if ($result)
    {
        echo json_encode([
            "success" => true,
            "message" => "Password changed successfully!"
        ]);
    }
    else
    {
        echo json_encode([
            "success" => false,
            "message" => "Email not found or password could not be changed"
        ]);
    }

    exit();
}

echo json_encode([
    "success" => false,
    "message" => "Invalid request"
]);

?>