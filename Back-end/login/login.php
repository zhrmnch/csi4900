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

$name = $_POST['name'];
$password = $_POST['password'];

$sql = sprintf("SELECT * FROM user_info WHERE user_name = '%s'", $conn->real_escape_string(strtolower($name)));

$result = $conn->query($sql);

$user = $result->fetch_assoc();

if ($user) {

    if (password_verify($password, $user["user_password"])) {
        echo "hereee";
        session_start();

        session_regenerate_id();

        $_SESSION["user_id"] = $user["user_id"];


        if ($user['is_test1_complete'] == 0) {
            header("location: /pages/test_1/test1.html");
            exit;
        } elseif ($user['is_learning_complete'] == 0) {
            // 0 -> authentic
            if ($user['user_group'] === 0) {
                header("location: /pages/authentic/authentic.html");
                exit;

                //1 -> alternate
            } elseif ($user['user_group'] == 1) {
                header("location: /pages/alternate.html");
                exit;

                // 2 -> ambiguous  
            } elseif ($user['user_group'] == 2) {
                echo "Working in progress ...add later";
                exit;
            }
        } elseif ($user['is_test2_complete'] == 0) {
            echo "Working in progress-- ...add later";
            exit;
        }

    } else {
        header("location: /login-fail.html");
        exit;
    }

} else {
    header("location: /login-fail.html");
    exit;

}

$conn->close();
?>