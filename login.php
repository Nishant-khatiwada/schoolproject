<?php
session_start();

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

// Process login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    // Query to check if user exists
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if ($row["password"] == $password) {
            // User found and password matches, set session
            $_SESSION["username"] = $username;
            
            // Redirect to dashboard
            header("Location: home.html");
            exit();
        } else {
            // Password incorrect, redirect to login page with error message
            header("Location: login.html?error=incorrect_password");
            exit();
        }
    } else {
        // User not found, redirect to signup page with error message
        header("Location: login.html?error=user_not_found");
        exit();
    }
}

$conn->close();
?>
