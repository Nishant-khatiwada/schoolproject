<?php
// Database connection parameters
$servername = "localhost"; // Or use 127.0.0.1
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$database = "tasks"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve tasks from the form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tasks = $_POST["tasks"];
    // Split tasks into an array
    $taskList = explode("\n", $tasks);
    
    // Insert each task into the database
    foreach ($taskList as $task) {
        // Trim whitespace from the task
        $task = trim($task);
        // Insert task into the database
        $sql = "INSERT INTO assignments (task_name) VALUES ('$task')";
        if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        
        }
    }
    header("Location: home.html");
    exit; // Make sure to stop further execution after redirection
    
}

// Close connection
$conn->close();

?>
