<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = $_POST['signup-name'];
  $email = $_POST['signup-email'];
  $password = password_hash($_POST['signup-password'], PASSWORD_DEFAULT);

  $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $name, $email, $password);

  if ($stmt->execute()) {
    echo "Signup successful. You can now <a href='index.html'>login</a>.";
  } else {
    echo "Error: " . $stmt->error;
  }

  $stmt->close();
  $conn->close();
}
?>
