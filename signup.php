<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = $_POST['signup-name'];
  $email = $_POST['signup-email'];
  $password = password_hash($_POST['signup-password'], PASSWORD_DEFAULT);

  $stmt = $mysqli("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");

  if ($stmt->execute()) {
    echo "Signup successful. You can now <a href='index.html'>login</a>.";
  } else {
    echo "Error: " . $stmt->error;
  }

  $stmt->close();
  $conn->close();
}
?>
  