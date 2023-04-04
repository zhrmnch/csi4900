

<?php

$servername = "";
$username = "";
$password = "";
$dbname = "";

$mysqli = new mysqli(hostname: $servername,
                     username: $username,
                     password: $password,
                     database: $dbname);
                     
if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;

?>
