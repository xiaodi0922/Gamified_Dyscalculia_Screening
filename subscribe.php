<?php
// Database connection parameters
$hostname = "localhost";
$username = "b032210245";
$password = "021018070713";
$dbname = "student_b032210245";

try {
    // Establish a database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the submitted email
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Prepare an SQL statement to insert the subscriber
            $stmt = $pdo->prepare("INSERT INTO subscribers (email, subscribed_at) VALUES (:email, NOW())");
            $stmt->bindParam(':email', $email);

            if ($stmt->execute()) {
                echo "<script>alert('Thank you for subscribing!'); window.location.href='home.php';</script>";
            } else {
                echo "<script>alert('Error subscribing. Please try again.'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Invalid email address. Please try again.'); window.history.back();</script>";
        }
    }
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>
