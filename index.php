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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>

<body>

    <h1>Home</h1>

    <?php if (isset($user)): ?>

        <p>Hello
            <?= htmlspecialchars($user["user_name"]) ?>
        </p>

        <p><a href="Back-end/login/logout.php">Log out</a></p>

        <?php if ($user["is_test1_complete"] == 0): ?>

            <p><a href='Front-end/test_1/test1_intro.html'>Test 1</a></p>
        <?php else: ?>
            <p>Test 1 is completed! Thanks!</p>

        <?php endif; ?>
    <?php else: ?>

        <p><a href="Back-end/login/login.php">Log in</a> or <a href="Front-end/sign-up/sign-up.html">sign up</a></p>

    <?php endif; ?>

</body>

</html>