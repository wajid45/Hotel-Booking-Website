<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'hotel_db';

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
echo "Connection failed " . mysqli_connect_error();
}
else{
  echo "Connected successfully!";
}
?>
