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


    // Step 2: Prepare an SQL statement to insert the name into the database
    $sql = "INSERT INTO user_information (name,confidence,tech_field) VALUES ( '$name', $confidence, $tech_field)";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();


    ?>

</body>

</html>