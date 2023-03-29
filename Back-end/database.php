

<?php

$servername = "us-cdbr-east-06.cleardb.net";
$username = "b838b2923dd5db";
$password = "54a1f26c";
$dbname = "heroku_394277472ffc4b2";

$mysqli = new mysqli(hostname: $servername,
                     username: $username,
                     password: $password,
                     database: $dbname);
                     
if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;

?>
