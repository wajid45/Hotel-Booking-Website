<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $room = $_POST['room'];
    $requests = $_POST['requests'];

    $stmt = $conn->prepare("INSERT INTO reservations (name, email, checkin, checkout, room, requests) VALUES (?, ?, ?, ?, ?, ?)");

    if ($stmt->execute()) {
        echo "<h2>Thank you! Your reservation has been received.</h2>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
