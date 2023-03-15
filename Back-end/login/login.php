

<?php

//from: https://github.com/daveh/php-signup-login/blob/main/login.php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/Back-end/database.php";
    
    $sql = sprintf("SELECT * FROM user_info
                    WHERE user_name = '%s'",
                   $mysqli->real_escape_string($_POST["name"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["user_password"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["user_id"];
            
            header("Location: index.php");
            exit;
        }
    }
    
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    
    <h1>Login</h1>
    
    <?php if ($is_invalid): ?>
        <em>Invalid login</em>
    <?php endif; ?>
    
    <form method="post">
        <label for="name">Name</label>
        <input type="name" name="name" id="name"
               value="<?= htmlspecialchars($_POST["name"] ?? "") ?>">
        
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        
        <button>Log in</button>
    </form>
    
</body>
</html>