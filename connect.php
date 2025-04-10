<?php
$host = "localhost";
$user = "root"; // Default XAMPP username
$pass = ""; // Default password is empty
$dbname = "library";

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

