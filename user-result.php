<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require $_SERVER["DOCUMENT_ROOT"] . '/expertsystem-psychologist/config/database.php';

$email = $_SESSION['email'];

// Prepare and bind the query
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

// Close the prepared statement and the database connection
$stmt->close();
$conn->close();

?>