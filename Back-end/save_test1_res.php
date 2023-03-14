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

session_start();
$answer = $_POST["answer"];


if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];


    $sql = "INSERT INTO test1_result (user_id, answer) VALUES (?, ?)";

    $stmt = $conn->stmt_init();

    if (!$stmt->prepare($sql)) {
        die("SQL error: " . $conn->error);
    }

    $stmt->bind_param("is", $user_id, $answer);

    if ($stmt->execute()) {

        echo "prompt('Thank you for participating! The next phase will involve another set of questions for you to learn more about phishing and non-phishing emails.')";


        $sql = sprintf("SELECT * FROM user_info WHERE user_id = %d", $conn->real_escape_string($user_id));
        $result = $conn->query($sql);
        $user = $result->fetch_assoc();

        $alter_sql = "UPDATE user_info SET is_test1_complete=1 WHERE user_id=$user_id";

        if ($conn->query($alter_sql) === TRUE) {
            echo "prompt('Thank you for doing the first phase! let's learn more about this topic!')";
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
        } else {
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
        }

    } else {

        echo "went wrong!";
        exit;
    }



} else {
    // Session variable not set, send the user to login page
    header("location: /index.html");

}

?>