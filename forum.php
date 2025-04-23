<?php
session_start(); // Start session to access session data

// Include database connection parameters
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
$isLoggedIn = isset($_SESSION['username']);
$userId = $isLoggedIn ? $_SESSION['user_id'] : null;
$userName = $isLoggedIn ? $_SESSION['username'] : null;

// Retrieve comments from the database
$commentsQuery = "SELECT * FROM comments ORDER BY created_at DESC";
$commentsResult = $conn->query($commentsQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;600;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="forum.css">
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <div class="header">
        <a href="#" class="logo"><img src="image/dyscover.png" alt="Logo"></a>
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

    <div class="container">
        <?php if ($isLoggedIn): ?>
            <p>Logged in as <strong><?php echo htmlspecialchars($userName); ?></strong> (User ID: <?php echo htmlspecialchars($userId); ?>)</p>
        <?php else: ?>
            <p>Please <a href="login.html">log in</a> to participate in the forum.</p>
        <?php endif; ?>

        <div class="subforum-title">
            <h1>My Forum</h1>
        </div>

        <div class="btn-group">
            <button type="button" class="btn comment" onclick="window.location.href='submit.php';">Comment</button>
        </div>
    
        <div class="subforum">
            <?php if ($commentsResult && $commentsResult->num_rows > 0): ?>
                <?php while ($row = $commentsResult->fetch_assoc()): ?>
                    <div class="subforum-row">
                        <div class="subforum-icon subforum-column center">
                            <i class="bx bx-user-circle center"></i>
                        </div>
                        <div class="subforum-description subforum-column">
                            <h4><a href="#">Post Title</a></h4>
                            <b>By: <?php echo htmlspecialchars($row['username']); ?></b>
                            <small><?php echo htmlspecialchars(date('d M Y', strtotime($row['created_at']))); ?></small>
                            <p><?php echo htmlspecialchars($row['opinion']); ?></p>
                            <p>Rating: <?php echo str_repeat("⭐", $row['rating']); ?> (<?php echo $row['rating']; ?>/5)</p>
                            
                            <!-- Edit and Delete buttons -->
                            <?php if ($isLoggedIn && $row['user_id'] == $userId): ?>
                                <div class="actions">
                                    <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn edit">Edit</a>
                                    <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn delete" onclick="return confirm('Are you sure you want to delete this comment?');">Delete</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No comments available. Be the first to share your thoughts!</p>
            <?php endif; ?>
        </div>
    </div>
   
    <script src="forum.js"></script>
    <script src="home.js"></script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
