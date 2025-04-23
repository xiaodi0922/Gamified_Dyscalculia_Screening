<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection details
$hostname = "localhost";
$username = "b032210245";
$password = "021018070713";
$dbname = "student_b032210245";

// Establish database connection
$conn = mysqli_connect($hostname, $username, $password, $dbname);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connected successfully to the database.";
}

// Close the database connection
mysqli_close($conn);
?>
