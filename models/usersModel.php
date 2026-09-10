<?php

require_once __DIR__ . "/dbConnect.php";

function login($email, $password)
{
    $conn = dbConnection();

    if ($conn)
    {
        $sql = "SELECT * FROM users WHERE email=?";

        $stmt = mysqli_prepare($conn, $sql);

        if (!$stmt)
        {
            return null;
        }

        mysqli_stmt_bind_param($stmt, "s", $email);

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0)
        {
            while ($row = mysqli_fetch_assoc($result))
            {
                if (password_verify($password, $row["password"]))
                {
                    return $row;
                }
            }
        }

        return null;
    }

    return null;
}

function addUser($name, $email, $password, $role)
{
    $conn = dbConnection();

    if ($conn)
    {
        $sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);

        if (!$stmt)
        {
            return false;
        }

        mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $password, $role);

        if (mysqli_stmt_execute($stmt))
        {
            return true;
        }
    }

    return false;
}

function changePassword($email, $password)
{
    $conn = dbConnection();

    if ($conn)
    {
        $sql = "UPDATE users SET password=? WHERE email=?";

        $stmt = mysqli_prepare($conn, $sql);

        if (!$stmt)
        {
            return false;
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "ss", $hashed_password, $email);

        if (mysqli_stmt_execute($stmt))
        {
            if (mysqli_stmt_affected_rows($stmt) > 0)
            {
                return true;
            }
        }
    }

    return false;
}

?>