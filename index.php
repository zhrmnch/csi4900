<?php

session_start();

if (isset($_SESSION["user_id"])) {


    $mysqli = require "Back-end/database.php";

    $sql = "SELECT * FROM user_info
            WHERE user_id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <meta charset="UTF-8">
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
            <h1>Home</h1>

            <?php if (isset($user)): ?>

                <p>Hello
                    <?= htmlspecialchars($user["user_name"]) ?>
                </p>

                <?php if ($user["is_test1_complete"] == 0): ?>

                    <p><a href='Front-end/test_1/test1_intro.html'>Test 1</a></p>
                <?php else: ?>
                    <p>Test 1 is completed! Thanks!</p>

                <?php endif; ?>

                <p><a type="logout" href="Back-end/login/logout.php">Log out</a></p>
            <?php else: ?>

                <p><a href="Back-end/login/login.php">Log in</a> or <a href="Front-end/sign-up/sign-up.html">sign up</a></p>


            <?php endif; ?>


        </form>
    </div>
</body>

</html>