<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = $_POST['login-email'];
  $password = $_POST['login-password'];

  $sql = "SELECT id, password FROM users WHERE email = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $email);
  $result = $stmt->execute();

  if ($result->num_rows > 0) {
      
  }

}
?>
