<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['email'])) {
    require $_SERVER["DOCUMENT_ROOT"] . '/expertsystem-psychologist/config/database.php';

    // Get the user data based on the email stored in the session
    $email = $_SESSION['email'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user data was fetched successfully
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<h4>Name: " . $row['first_name'] . " " . $row['last_name'] . "</h4>";
            echo "<h4>Age: " . $row['age'] . "</h4>";
            echo "<h4>Email: " . $row['email'] . "</h4>";
            echo "<h4>ID: " . $row['user_id'] . "</h4>";
            $_SESSION['fk-user-id'] = $row['user_id'];
        }

        // Get the results data based on the fetched user_id
        $userid = $_SESSION['fk-user-id'];
        $stmt = $conn->prepare("SELECT * FROM result WHERE user_id = ?");
        $stmt->bind_param("i", $userid);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if results data was fetched successfully
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div style='border: 2px solid black;'>";
                echo "<p>Result ID: " . $row['result_id'] . "</p>";
                echo "<p>Result: " . $row['result'] . "</p>";
                echo "<h4>Date Taken: " . $row['created_at'] . "</h4>";
                echo "</div>";
            }
        } else {
            echo "No results found for the user.";
        }
    } else {
        echo "User not found in the database.";
    }

    // Unset the session variables after use
    unset($_SESSION['fk-user-id']);
    unset($_SESSION['email']);
} else {
    echo "Email not found in the session.";
}
?>
