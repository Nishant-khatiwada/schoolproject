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

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    // Redirect user to login page if not logged in
    header("Location: login.html");
    exit();
}

// Retrieve tasks from the form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tasks = $_POST["tasks"];
    // Split tasks into an array
    $taskList = explode("\n", $tasks);
    
    // Insert each task into the database
    $success = true; // Flag to track insertion success
    foreach ($taskList as $task) {
        // Trim whitespace from the task
        $task = trim($task);
        
        // Check if task is not empty
        if (!empty($task)) {
            // Insert task into the database
            $user_id = $_SESSION["user_id"];
            $escaped_task = $conn->real_escape_string($task); // Escape task to prevent SQL injection
            $sql = "INSERT INTO assignments (task_name, user_id) VALUES ('$escaped_task', $user_id)";
            if ($conn->query($sql) !== TRUE) {
                // Set success flag to false if there's an error
                $success = false;
                // Output error message
                echo "Error inserting task: " . $conn->error;
            }
        }
    }
    
    if ($success) {
        // Redirect to home page if all tasks were inserted successfully
        header("Location: home.html");
        exit();
    } else {
        // Optionally, you can display an error message here instead of redirecting
        echo "There was an error inserting tasks. Please try again.";
    }
}

// Close connection
$conn->close();
?>
