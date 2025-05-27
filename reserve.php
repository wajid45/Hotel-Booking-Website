<?php
include 'db.php'; // Make sure this file sets up $conn properly

// Enable error reporting for debugging (you can turn this off in production)
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize user inputs
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $room = $_POST['room'];
    $requests = htmlspecialchars(trim($_POST['requests']));

    // Prepare SQL statement using prepared statements
    $stmt = $conn->prepare(
        "INSERT INTO reservations (name, email, checkin, checkout, room, requests) 
        VALUES (?, ?, ?, ?, ?, ?)"
    );

    // Bind parameters (s = string)
    $stmt->bind_param("ssssss", $name, $email, $checkin, $checkout, $room, $requests);

    // Try executing the statement
    try {
        $stmt->execute();
        echo "<h2>Thank you, $name! Your reservation has been received.</h2>";
    } catch (Exception $e) {
        echo "<p>Error while saving your reservation: " . $e->getMessage() . "</p>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "<h3>Invalid request method. Please submit the form.</h3>";
}
?>
