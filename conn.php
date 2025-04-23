<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "viktorklucina";

$conn = new mysqli($servername, $username, $password, $dbname);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
