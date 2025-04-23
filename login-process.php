<?php
require 'conn.php'; 
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

$email = mysqli_real_escape_string($conn, $email);

$query = "SELECT iduser, heslo FROM user WHERE email=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
    
    if (password_verify($password, $user['heslo'])) {
        $_SESSION['iduser'] = $user['iduser'];
        header("Location: index.php");
        exit;
    } else {
        header("Location: login.php?error=invalid");
        exit;
    }
} else {
    header("Location: login.php?error=invalid");
    exit;
}

$stmt->close();
$conn->close();
?>
