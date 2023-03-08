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
    $confidence = $_POST['confidence'];
    $tech_field = $_POST['tech-field'];

    $sql_get_len = "SELECT COUNT(*) AS num_rows FROM user_info;";
    $result = mysqli_query($conn, $sql_get_len);
    $row = mysqli_fetch_assoc($result);
    $num_rows = $row['num_rows'];
    $user_group = $num_rows % 3;

    $sql_insert = "INSERT INTO user_info (user_name,user_group,user_confidence,is_tech_field) VALUES ( '$name', $user_group, $confidence, $tech_field)";

    if ($conn->query($sql_insert) === TRUE) {
        header("location: /index.html");
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
       


    $conn->close();


    ?>

</body>

</html>