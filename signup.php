<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "tasks";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process sign-up form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    // Check if username already exists
    $check_username = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($check_username);
    
    if ($result->num_rows > 0) {
        // Username already exists, redirect to sign-up page with error message
        header("Location: signup.html?error=username_exists");
        exit();
    } else {
        // Insert new user into the database
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        if ($conn->query($sql) === TRUE) {
            // Sign-up successful, redirect to login page
            header("Location: login.html");
            exit();
        } else {
            // Error inserting user, redirect to sign-up page with error message
            header("Location: signup.html?error=signup_failed");
            exit();
        }
    }
}

$conn->close();
?>
