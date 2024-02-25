<?php
// Check if taskId is set in the request
if (isset($_GET['taskId'])) {
    // Get the task ID from the request
    $taskId = $_GET['taskId'];
    
    echo "Task ID: " . $taskId; // Debug output

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

    // Prepare a delete statement
    $sql = "DELETE FROM assignments WHERE task_id = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $taskId);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            echo "Task deleted successfully";
        } else {
            echo "Error deleting task: " . $conn->error; // Debug output
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $conn->close();
} else {
    echo "Task ID not provided";
}
?>
