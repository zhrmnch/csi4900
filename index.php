<?php

session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "./Back-end/database.php";
    
    $sql = "SELECT * FROM user_info
            WHERE user_id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    
    <h1>Home</h1>
    
    <?php if (isset($user)): ?>
        
        <p>Hello <?= htmlspecialchars($user["user_name"]) ?></p>
        
        <p><a href="./Back-end/login/logout.php">Log out</a></p>
        
    <?php else: ?>
        
        <p><a href="./Back-end/login/login.php">Log in</a> or <a href="./Back-end/sign-up/sign-up.php">sign up</a></p>
        
    <?php endif; ?>
    
</body>
</html>