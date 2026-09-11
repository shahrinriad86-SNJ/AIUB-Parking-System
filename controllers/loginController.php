<?php

session_start();

header("Content-Type: application/json");

require_once "../models/usersModel.php";
require_once "../models/telegramConfig.php";

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

        $message = "🔐 New Login\n\n";
        $message .= "User: " . $user["name"] . "\n";
        $message .= "Email: " . $user["email"] . "\n";
        $message .= "Role: " . $user["role"] . "\n";
        $message .= "Time: " . date("Y-m-d H:i:s");

        $url = "https://api.telegram.org/bot" . $telegramBotToken . "/sendMessage";

        $data = [
            "chat_id" => $telegramChatId,
            "text" => $message
        ];

        $options = [
            "http" => [
                "header" => "Content-Type: application/x-www-form-urlencoded\r\n",
                "method" => "POST",
                "content" => http_build_query($data)
            ]
        ];

        $context = stream_context_create($options);

        file_get_contents($url, false, $context);

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