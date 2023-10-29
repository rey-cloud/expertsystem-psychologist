<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['answer'])) {
        $question_number = $_POST['question_number'];
        $_SESSION['answers'][$question_number] = $_POST['answer'];
    }
}

// Initialize current question number
$question_number = 0;

if (isset($_POST['next'])) {
    $question_number = $_POST['question_number'] + 1;
} elseif (isset($_POST['previous'])) {
    $question_number = $_POST['question_number'] - 1;
}

if (!isset($_SESSION['answers'])) {
    $_SESSION['answers'] = array();
}

if (isset($_POST['submit'])) {
    // Assuming you have a database connection
    require $_SERVER["DOCUMENT_ROOT"] . '/expertsystem-psychologist/config/database.php';

    // Include the save-user.php file to save the user data
    include('save-user.php');

    // Include the get-id.php file to fetch the user_id
    include('get-id.php');

    $user_id = $row['user_id']; // Get the user_id from the fetched row

    // Inserting the answers into the database
    $values = array($user_id); // Include the user_id as the first value in the array
    $placeholders = array("user_id"); // Include "user_id" as the first placeholder in the array

    foreach ($_SESSION['answers'] as $index => $answer) {
        $values[] = $answer;
        $placeholders[] = "q" . ($index + 1);
    }

    $valuesString = implode("', '", $values);
    $placeholdersString = implode(", ", $placeholders);

    // Open the database connection before executing the query
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO result ($placeholdersString) VALUES ('$valuesString')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection after executing the query
    $conn->close();

    // Redirect to the result page

    // Unset the session after saving to the database
    unset($_SESSION['answers']);
    unset($_SESSION['first']);
    unset($_SESSION['last']);
    unset($_SESSION['email']);
    unset($_SESSION['pass-pin']);
    unset($_SESSION['displayed_questions']);
    header("Location: result.php");
    exit();
}

include('question-choices.php');
?>
