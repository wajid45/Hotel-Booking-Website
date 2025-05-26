<?php
$servername = "localhost";
$username = "root"; // default for XAMPP
$password = "";     // default is empty
$dbname = "user_auth";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize input
$name = mysqli_real_escape_string($conn, $_POST['signup-name']);
$email = mysqli_real_escape_string($conn, $_POST['signup-email']);
$password = password_hash($_POST['signup-password'], PASSWORD_BCRYPT);

// Insert user
$sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "Signup successful. <a href='index.html'>Login now</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
