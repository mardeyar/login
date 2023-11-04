<?php

// Variable for checking validity of user login info
$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mysqli = require __DIR__ . "/config.php";
    $sql = sprintf("SELECT * FROM accounts
            WHERE username = '%s'",
        $mysqli->real_escape_string($_POST["userName"])); // Escape prevent SQL injection attacks

    $result = $mysqli->query($sql); // This will execute the above code block
    $user = $result->fetch_assoc(); // This will get the data

    if ($user) {
        if (password_verify($_POST["password"], $user["password_hash"])) {
            // If everything is good and verified, start the session for user
            session_start();
            session_regenerate_id(); // This will help to prevent attacks
            $_SESSION["user_id"] = $user["id"];
            header("Location: index.php");
            exit();
        }
    }

    $is_invalid = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css"/>
    <link rel="icon" href="/images/icon.png">
    <title>Login</title>
</head>
<body>

<form id="info-form" method="post">

    <h1>Login</h1>

    <!-- This block gets displayed if validLogin boolean is not true (invalid credentials) -->
    <?php if ($is_invalid): ?>
        <p id="submit-error">Invalid login</p>
    <?php endif; ?>

    <div class="input-field">
        <label for="username"></label>
        <input type="text" name="userName" placeholder="Username" id="username"
               value="<?= htmlspecialchars($_POST["userName"] ?? "") ?>">
    </div>

    <div class="input-field">
        <label for="password"></label>
        <input type="password" name="password" placeholder="Password" id="password">
    </div>

    <input type="submit" id="submit-btn" value="Login">

    <div class="login-direct">
        <p>Don't yet have an account? <a href="register.php">Register here</a></p>
    </div>

</form>

<script src="js/validation.js"></script>

</body>
</html>