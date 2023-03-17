<?php

session_start();

if (isset($_SESSION["user_id"])) {

    $mysqli = require "../database.php";

    $sql = "SELECT * FROM user_info
            WHERE user_id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
}


$mysqli = require "..\database.php";
$user_id = $user["user_id"];
$answer = json_decode(file_get_contents("php://input"), true);


$sql_insert = "INSERT INTO test1_info (user_id,user_answer) VALUES (?,?)";

$stmt = $mysqli->stmt_init();
if (!$stmt->prepare($sql_insert)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("is", $user_id, $answer);

if ($stmt->execute()) {

    header("Location: ../../Front-end/test_1/test1_complete.html");
    exit;

} else {
   

    if ($mysqli->errno === 1062) {
        die("email already taken");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}