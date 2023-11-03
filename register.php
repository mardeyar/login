<?php
// This allows duplicate email or username to catch errno 1062 for display purposes
mysqli_report(MYSQLI_REPORT_OFF);

// Set a variable to catch errno 1062 for duplicates
$isDuplicate = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $mysqli = require __DIR__ . "/config.php";

    $sql = "INSERT INTO accounts (username, email, password_hash)
        VALUES (?, ?, ?)";

    // Prepared statement
    $statement = $mysqli->stmt_init();
    if (!$statement->prepare($sql)) { // This will catch any SQL syntax errors
        die("SQL error: " . $mysqli->error);
    }

    // This will bind parameters to the placeholder values the insert statement
    $statement->bind_param("sss", // The 3 sss means all 3 parameters are string value
        $_POST["userName"],
        $_POST["email"],
        $password_hash);

    // This will execute the $statement variable, inserting data into the table
    // If successful, message below will print to screen. If not, the error message will tell why not
    if ($statement->execute()) {
        header("Location: signup-success.html");
        exit;
    } else {
        if ($mysqli->errno === 1062) {
            $isDuplicate = true;
        } else {
            die($mysqli->error . " " . $mysqli->errno);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<form id="info-form" action="register.php" method="post">

    <h1>Register</h1>

    <!-- This block gets displayed if isDuplicate boolean is true (duplicate username or email) -->
    <?php if ($isDuplicate): ?>
        <p id="submit-error">Username or email already in use</p>
    <?php endif; ?>

    <div class="input-field">
        <label for="username"></label>
        <input type="text" name="userName" placeholder="Username" id="username">
        <div class="error"></div>
    </div>

    <div class="input-field">
        <label for="email"></label>
        <input type="email" name="email" placeholder="Email" id="email">
        <div class="error"></div>
    </div>

    <div class="input-field">
        <label for="password"></label>
        <input type="password" name="password" placeholder="Password" id="password">
        <div class="error"></div>
    </div>

    <div class="input-field">
        <label for="password_confirm"></label>
        <input type="password" name="password_confirm" id="password_confirm" placeholder="Confirm password">
        <div class="error"></div>
    </div>

    <input type="submit" id="submit-btn" value="Register">

    <div class="login-direct">
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>

</form>

<script src="js/validation.js"></script>

</body>
</html>
