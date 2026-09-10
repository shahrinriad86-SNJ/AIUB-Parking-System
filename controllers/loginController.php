<?php

session_start();

header("Content-Type: application/json");

require_once "../models/usersModel.php";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $email = $_POST["email"];
    $password = $_POST["password"];

    $user = login($email, $password);

    if ($user)
    {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["name"] = $user["name"];
        $_SESSION["email"] = $user["email"];
        $_SESSION["role"] = $user["role"];

        echo json_encode([
            "success" => true,
            "role" => $user["role"]
        ]);

        exit();
    }
    else
    {
        echo json_encode([
            "success" => false,
            "message" => "Invalid email or password"
        ]);

        exit();
    }
}

echo json_encode([
    "success" => false,
    "message" => "Invalid request"
]);

?>