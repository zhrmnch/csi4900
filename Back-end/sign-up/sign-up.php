<?php

if (empty($_POST["name"])) {
    die("Name is required");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

if (!preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if (!preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
}


$mysqli = require "../database.php";

$name = strtolower($_POST['name']);
$confidence = $_POST['confidence'];
$tech_field = $_POST['tech-field'];
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);


$sql_get_len = "SELECT COUNT(*) AS num_rows FROM user_info;";
$result = mysqli_query($mysqli, $sql_get_len);
$row = mysqli_fetch_assoc($result);
$num_rows = $row['num_rows'];
$user_group = $num_rows % 3;



$sql_insert = "INSERT INTO user_info (user_name,user_group,user_confidence,is_tech_field,user_password) VALUES (?,?,?,?,?)";

$stmt = $mysqli->stmt_init();
if (!$stmt->prepare($sql_insert)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("siiis", $name, $user_group, $confidence, $tech_field, $password_hash);

if ($stmt->execute()) {

    header("Location: ../../Front-end/sign-up/signup-success.html");
    exit;

} else {

    if ($mysqli->errno === 1062) {
        die("email already taken");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}