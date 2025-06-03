<?php

function connect_db() {
    $conn = new mysqli("localhost", "root", "", "hotel_db");
    if ($conn->connect_error) {
        die("❌ Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = connect_db();

    $name = $_POST['name'];
    $email = $_POST['email'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $room = $_POST['room'];
    $requests = $_POST['requests'];

    $stmt = $conn->prepare("INSERT INTO reservations (name, email, checkin, checkout, room, requests) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $email, $checkin, $checkout, $room, $requests);

    if ($stmt->execute()) {
        echo '
        <!DOCTYPE html>
        <html>
        <head>
            <title>Booking Confirmed</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    text-align: center;
                    padding: 50px;
                    background: linear-gradient(to top, rgba(66, 66, 66, 0.5) 40%, rgba(66, 66, 66, 0.5) 40%),
                                url("img/pen1.jpg") center;
                    background-size: cover;
                    color: white;
                }
                .box {
                    background: white;
                    padding: 30px;
                    max-width: 500px;
                    margin: auto;
                    border-radius: 10px;
                    box-shadow: 0 0 10px rgba(0,0,0,0.1);
                    color: black;
                }
                h2 { color: green; }
            </style>
        </head>
        <body>
            <div class="box">
                <h2>✅ Booking Successful!</h2>
                <p>Thank you for booking with Royalton Hotel.</p>
            </div>
        </body>
        </html>';
    } else {
        echo "❌ Error: " . $stmt->error;
    }
}
?>