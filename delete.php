<?php
session_start();
$hostname = "localhost";
$username = "b032210245";
$password = "021018070713";
$dbname = "student_b032210245";

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
}

$userId = $_SESSION['user_id'];

// Validate comment ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid comment ID");
}

$commentId = intval($_GET['id']);

// Delete the comment
$query = "DELETE FROM comments WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($query);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("ii", $commentId, $userId);
$stmt->execute();

// Redirect after deletion
header('Location: forum.php');
exit;

// Close the statement and connection
$stmt->close();
$conn->close();
?>
