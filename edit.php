<?php
session_start();

$hostname = "localhost";
$username = "b032210245";
$password = "021018070713";
$dbname = "student_b032210245";

// Establish database connection
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
$userName = $_SESSION['username'];
$commentId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch the comment for editing
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $query = "SELECT * FROM comments WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $commentId, $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $comment = $result->fetch_assoc();

    if (!$comment) {
        die("Comment not found or unauthorized access.");
    }
}

// Update the comment
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $opinion = $_POST['opinion'];
    $rating = $_POST['rating'];

    $query = "UPDATE comments SET opinion = ?, rating = ? WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("siii", $opinion, $rating, $commentId, $userId);
    $stmt->execute();

    header('Location: forum.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Comment</title>
    <link rel="stylesheet" href="edit.css">
    <link rel="stylesheet" href="forum.css">
</head>
<body>
    <div class="edit-container">
        <div class="edit-box">
            <h2>Share Your Thoughts</h2>
            <form method="POST">
                <!-- Star Rating -->
                <div class="rating">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <input type="radio" id="star<?php echo $i; ?>" name="rating" value="<?php echo $i; ?>" <?php echo $comment['rating'] == $i ? 'checked' : ''; ?>>
                        <label for="star<?php echo $i; ?>">&#9733;</label>
                    <?php endfor; ?>
                </div>

                <!-- Opinion Text Area -->
                <textarea name="opinion" placeholder="Your opinion..."><?php echo htmlspecialchars($comment['opinion']); ?></textarea>

                <!-- Buttons -->
                <div class="buttons">
                    <button type="submit" class="submit-btn">Submit</button>
                    <button type="button" class="cancel-btn" onclick="window.location.href='forum.php';">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>


<?php
// Close the database connection
$conn->close();
?>
