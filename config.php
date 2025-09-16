<?php
$servername = "localhost";
$username = "root";   // default XAMPP username
$password = "";       // default XAMPP has empty password
$dbname = "myapp";  // must match the database you created

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

