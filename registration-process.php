<?php

require 'conn.php';

$firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
$lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = $_POST['password'];
$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
$street = filter_input(INPUT_POST, 'street', FILTER_SANITIZE_STRING);
$city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
$psc = filter_input(INPUT_POST, 'psc', FILTER_SANITIZE_STRING);
$billingDetails = filter_input(INPUT_POST, 'billingDetails', FILTER_SANITIZE_STRING);
$creditCardNumber = filter_input(INPUT_POST, 'creditCardNumber', FILTER_SANITIZE_STRING);
$expirationDate = filter_input(INPUT_POST, 'expirationDate', FILTER_SANITIZE_STRING);
$cvv = filter_input(INPUT_POST, 'cvv', FILTER_SANITIZE_STRING);

$errors = [];

if (!preg_match("/^[a-zA-Z\s]+$/", $firstName)) {
    $errors[] = "Špatně zadané jméno.";
}
if (!preg_match("/^[a-zA-Z\s]+$/", $lastName)) {
    $errors[] = "Špatně zadané příjmení.";
}
if (!$email) {
    $errors[] = "Špatně zadaný email.";
}
if (strlen($password) < 8) {
    $errors[] = "Heslo musí obsahovat minimálně 8 znaků.";
}
if (!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{3}$/", $phone)) {
    $errors[] = "Špatně zadané telefonní číslo.";
}
if (!preg_match("/^[0-9]{5}$/", $psc)) {
    $errors[] = "Špatně zadané PSČ.";
}
if (!preg_match("/^[0-9]{16}$/", $creditCardNumber)) {
    $errors[] = "Špatně zadané číslo kreditní karty.";
}
if (!preg_match("/^[0-9]{2}\/[0-9]{2}$/", $expirationDate)) {
    $errors[] = "Špatně zadané datum expirace.";
}
if (!preg_match("/^[0-9]{3}$/", $cvv)) {
    $errors[] = "Špatně zadané CVV.";
}

if (!empty($errors)) {
    header("Location: register.php?error=invalid");
    exit;
}

$paymentMethodQuery = "INSERT INTO platebnimetoda (cislokarty, cvv, datum) VALUES (?, ?, ?)";
$stmt = $conn->prepare($paymentMethodQuery);
$stmt->bind_param("sss", $creditCardNumber, $cvv, $expirationDate);
$stmt->execute();
$paymentMethodId = $stmt->insert_id;

$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

$userQuery = "INSERT INTO user (jmeno, primeni, heslo, ico, ulicecp, mesto, PSC, telefon, email, platebnimetoda_idplatebnimetoda) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($userQuery);
$stmt->bind_param("sssssssssi", $firstName, $lastName, $hashedPassword, $billingDetails, $street, $city, $psc, $phone, $email, $paymentMethodId);
$stmt->execute();

$stmt->close();
$conn->close();

header("Location: registrationsuccess.php");
exit();
?>
