<?php
include 'db.php';


if (isset($_POST['submit'])) {
    // Sanitize and retrieve inputs
    $name = $_POST['name'];
    $email = $_POST['email'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $room = $_POST['room'];
    $requests = $_POST['requests'];

    // Prepare the SQL statement
    $sql ="INSERT INTO reservations (name, email, checkin, checkout, room, requests) VALUES (?, ?, ?, ?, ?, ?)";

    // Execute the statement
    if (mysqli_query($conn, $sql)) {
        echo "<h2>Thank you! Your reservation has been received.</h2>";
    } else {
        echo "Error: Database not connected ";
    }

}
else {
    echo "<h3>Invalid request method. Please submit the form.</h3>";
}
?>
