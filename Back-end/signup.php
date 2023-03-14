<?php
$servername = "sql206.epizy.com";
$username = "epiz_33729702";
$server_password = "MFFFfJp6Kj";
$dbname = "epiz_33729702_information__page";

$conn = mysqli_connect($servername, $username, $server_password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


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

$name = strtolower($_POST['name']);
$confidence = $_POST['confidence'];
$tech_field = $_POST['tech-field'];
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);


$sql_get_len = "SELECT COUNT(*) AS num_rows FROM user_info;";
$result = mysqli_query($conn, $sql_get_len);
$row = mysqli_fetch_assoc($result);
$num_rows = $row['num_rows'];
$user_group = $num_rows % 3;


$sql_insert = "INSERT INTO user_info (user_name,user_group,user_confidence,is_tech_field,user_password) VALUES ( '$name', $user_group, $confidence, $tech_field,'$password_hash')";


if ($conn->query($sql_insert) === TRUE) {
    header("location: /signup-success.html");
} else {
    echo "Error: " . $sql_insert . "<br>" . $conn->error;
}



$conn->close();
?>