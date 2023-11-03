<?php

$host = "localhost";
$dbname = "userdb";
$username = "root";
$password = "";

$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_errno) {
    die("Connection failure: ".$mysqli->connect_error);
}

return $mysqli;