<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title></title>
</head>

<body>

    <?php
    $servername = "sql206.epizy.com";
    $username = "epiz_33729702";
    $password = "MFFFfJp6Kj";
    $dbname = "epiz_33729702_information__page";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $name = $_POST['name'];

    $sql = "SELECT * FROM user_info WHERE user_name='$name'";
    $result = mysqli_query($conn, $sql);

    // If the name exists, redirect to another page
    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);
        if ($row['is_test1_complete'] == 0) {
            header("location: /pages/test_1/test1.html");
        } elseif ($row['is_learning_complete'] == 0) {
            // 0 -> authentic
            if ($row['user_group'] === 0) {
                header("location: /pages/authentic/authentic.html");

                //1 -> alternate
            } elseif ($row['user_group'] == 1) {
                header("location: /pages/alternate.html");

                // 2 -> ambiguous  
            } elseif ($row['user_group'] == 2) {
                echo "Working in progress ...add later";
            }
        } elseif ($row['is_test2_complete'] == 0) {
            echo "Working in progress-- ...add later";
        }

        exit();
    }


    $conn->close();
    ?>

</body>

</html>