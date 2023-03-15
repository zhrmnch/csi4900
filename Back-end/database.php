<!-- Code taken from : https://github.com/daveh/php-signup-login/blob/main/database.php -->

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hp_db";

$mysqli = new mysqli(hostname: $servername,
                     username: $username,
                     password: $password,
                     database: $dbname);
                     
if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;

?>
