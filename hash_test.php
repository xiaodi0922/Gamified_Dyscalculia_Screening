<?php
// Define a plain text password
$password = "mypassword123";

// Hash the password using password_hash()
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

echo "Original Password: $password<br>";
echo "Hashed Password: $hashedPassword<br>";

// Verify the password against the hash
if (password_verify($password, $hashedPassword)) {
    echo "Password verification successful!";
} else {
    echo "Password verification failed!";
}
?>
