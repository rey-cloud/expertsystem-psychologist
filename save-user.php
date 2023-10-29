<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require $_SERVER["DOCUMENT_ROOT"] . '/expertsystem-psychologist/config/database.php';

$stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, pass) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $firstname, $lastname, $email, $pass);

$firstname = $_SESSION['first'];
$lastname = $_SESSION['last'];
$email = $_SESSION['email']; 
$pass = $_SESSION['pass-pin'];
$stmt->execute();

$stmt->close();
$conn->close();

?>
