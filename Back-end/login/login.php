<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $mysqli = require "../database.php";

    $sql = sprintf("SELECT * FROM user_info
                    WHERE user_name = '%s'",
        $mysqli->real_escape_string($_POST["name"])
    );

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();

    if ($user) {

        if (password_verify($_POST["password"], $user["user_password"])) {

            session_start();

            session_regenerate_id();

            $_SESSION["user_id"] = $user["user_id"];

            header("Location: ../../index.php");
            exit;
        }
    }

    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F8F8FF;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            width: 400px;
            padding: 40px;
            background-color: #FFFFFF;
            border-radius: 10px;
            box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type=submit],
        button[type=button] {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button[type=submit]:hover,
        button[type=button]:hover {
            background-color: #45a049;
        }

        @media screen and (max-width: 480px) {
            form {
                width: 80%;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <form method="POST">
            <h1>Login</h1>

            <?php if ($is_invalid): ?>
                <em>Invalid login</em>
            <?php endif; ?>

            <label for="name"><b>Name:</b></label>
            <input type="text" placeholder="Enter Name" name="name" id="name" required>
            <label for=" password"><b>Password:</b></label>
            <input type="password" name="password" id="password">
            <button type="submit">Login</button>
            <button type="button" onclick="location.href='../../Front-end/sign-up/sign-up.html'">Register</button>
        </form>
    </div>

</body>

</html>