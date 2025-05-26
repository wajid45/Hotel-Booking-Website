<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = $_POST['login-email'];
  $password = $_POST['login-password'];

  $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows > 0) {
    $stmt->bind_result($user_id, $hashed_password);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
      echo "Login successful. Welcome!";
      // You can redirect or start session here
    } else {
      echo "Incorrect password.";
    }
  } else {
    echo "No user found with this email.";
  }

  $stmt->close();
  $conn->close();
}
?>
