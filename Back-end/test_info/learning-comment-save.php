<?php

session_start();

if (isset($_SESSION["user_id"])) {

    $mysqli = require "../database.php";

    $sql = "SELECT * FROM user_info
            WHERE user_id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
}


$mysqli = require "../database.php";
$user_id = $user["user_id"];
$rush_scale = $_POST['rush'];
$user_comment = $_POST['comments'];



$sql_insert = "UPDATE learning_result SET scale_rush= ? , user_comment=? WHERE user_id = {$user['user_id']};";

$stmt = $mysqli->stmt_init();
if (!$stmt->prepare($sql_insert)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("is", $rush_scale, $user_comment);

if ($stmt->execute()) {

    $sql_test1_update = "UPDATE user_info SET is_learning_complete=?  WHERE user_id = {$user['user_id']}";
    $stmt2 = $mysqli->stmt_init();
    if (!$stmt2->prepare($sql_test1_update)) {
        die("SQL error: " . $mysqli->error);
    }

    $one = 1;
    $stmt2->bind_param("i", $one);
    if ($stmt2->execute()) {
        header("Location: ../../Front-end/learning/learning_complete.html");
        exit;
    } else {

        die($mysqli->error . " " . $mysqli->errno);

    }




} else {


    die($mysqli->error . " " . $mysqli->errno);

}