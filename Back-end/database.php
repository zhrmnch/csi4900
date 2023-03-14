<!-- Code taken from : https://github.com/daveh/php-signup-login/blob/main/database.php -->

<?php

$servername = "sql206.epizy.com";
$username = "epiz_33729702";
$password = "MFFFfJp6Kj";
$dbname = "epiz_33729702_information__page";

$mysqli = new mysqli(hostname: $servername,
                     username: $username,
                     password: $password,
                     database: $dbname);
                     
if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;

?>
