<?php
// Start session to get user session data
session_start();

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['username']);
$userId = $isLoggedIn ? $_SESSION['user_id'] : null;
$userName = $isLoggedIn ? $_SESSION['username'] : null;

// Include database connection parameters
$hostname = "localhost";
$username = "b032210245";
$password = "021018070713";
$dbname = "student_b032210245";

// Establish database connection
$conn = new mysqli($hostname, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Variables for messages
$message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve session user ID
    $user_id = $_SESSION['user_id'] ?? null; // Ensure session user_id is set
    $username = $_SESSION['username'] ?? 'Guest'; // Fallback to Guest if no username

    // Retrieve form inputs
    $rating = $_POST['rating'] ?? 0; // Default to 0 if not set
    $opinion = $_POST['opinion'] ?? '';

    // Check if all fields are filled
    if ($user_id && !empty($opinion) && $rating > 0) {
        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO comments (user_id, username, rating, opinion, created_at) VALUES (?, ?, ?, ?, NOW())");
        $stmt->bind_param("isis", $user_id, $username, $rating, $opinion);

        // Execute the statement
        if ($stmt->execute()) {
            $message = "Thank you for your feedback!";
        } else {
            $message = "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        $message = "Please fill in all fields before submitting.";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Box icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="submit.css">
    <link rel="stylesheet" href="home.css">
    <title>Submit Feedback</title>
    <script>
        // JavaScript for rating stars
        function setRating(value) {
            document.getElementById('rating-value').value = value;

            // Highlight stars up to the selected one
            const stars = document.querySelectorAll('.star');
            stars.forEach((star, index) => {
                if (index < value) {
                    star.classList.add('selected');
                } else {
                    star.classList.remove('selected');
                }
            });
        }
    </script>
</head>
<body>
    <div class="header">
        <!-- Navigation bar -->
        <a href="#" class="logo"><img src="image/dyscover.png" alt="Logo"></a>
        <i class='bx bx-menu' id="menu-icon"></i>
        <nav class="navbar">
            <a href="home.php">Home</a>
            <a href="home.php">Features</a>
            <a href="home.php">Element</a>
            <a href="forum.php">Forum</a>
          <?php if ($isLoggedIn): ?>
                <a href="logout.php">Logout</a>
                <span>Welcome, <?php echo htmlspecialchars($userName); ?>!</span>
            <?php else: ?>
                <a href="login.html">Login/Register</a>
            <?php endif; ?>
        </nav>
    </div>

    <div class="wrapper">
        <h3>Share Your Thoughts</h3>

        <!-- Display messages -->
        <?php if (!empty($message)): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>

        <!-- Feedback Form -->
        <form action="submit.php" method="POST">
            <div class="rating">
                <input type="hidden" name="rating" id="rating-value" value="0">
                <i class="bx bx-star star" style="--i:0" onclick="setRating(1)"></i>
                <i class="bx bx-star star" style="--i:1" onclick="setRating(2)"></i>
                <i class="bx bx-star star" style="--i:2" onclick="setRating(3)"></i>
                <i class="bx bx-star star" style="--i:3" onclick="setRating(4)"></i>
                <i class="bx bx-star star" style="--i:4" onclick="setRating(5)"></i>
            </div>
            <textarea name="opinion" cols="30" rows="5" placeholder="Your opinion..."></textarea>
            <div class="btn-group">
                <button type="submit" class="btn submit">Submit</button>
                <button type="button" class="btn cancel" onclick="window.location.href='forum.php';">Cancel</button>
            </div>
        </form>
    </div>
        <script src="submit.js"></script>
</body>
</html>
