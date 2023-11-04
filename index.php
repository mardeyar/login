<?php

// Start the session to store values in the super global
session_start();

// Database connection requirements
$mysqli = require __DIR__ . "/config.php";
$sql = "SELECT * FROM accounts";
$result = $mysqli->query($sql);
$users = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

$user = null;

// Check to see if the username is set and logged in
if (isset($_SESSION["user_id"])) {
    $currentUserID = $_SESSION["user_id"];

    // Find which user is currently logged in within the $users array
    foreach ($users as $u) {
        if ($u["id"] == $currentUserID) {
            $user = $u;
            break;
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
    <link rel="stylesheet" href="/css/home.css"/>
    <link rel="icon" href="/images/icon.png">
    <title>Home</title>
</head>
<body>

<header>
    <!-- Fetch the session username, display as variable -->
    <?php if (isset($user)): ?>
        <h2>Welcome back, <?= htmlspecialchars($user["username"]) ?>!</h2>
    <?php else: ?>
    <!-- Send user to the landing page if not logged in -->
        <?php
        header("Location: landing.html");
        exit;
        ?>
    <?php endif; ?>
</header>

<!-- Table display that will list all users info within the DB -->
<div class="container">

    <?php if (!empty($users)): ?>
    <h2>Current Users</h2>
    <table>
        <tr>
            <th>UserID</th>
            <th>Username</th>
            <th>Email</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user["id"] ?></td>
            <td><?= $user["username"] ?></td>
            <td><?= $user["email"] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php else: ?>
        <p>No users found</p>
    <?php endif; ?>
    <a id="logout" href="logout.php">Logout</a>
</div>

</body>
</html>