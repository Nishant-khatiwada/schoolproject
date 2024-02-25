<?php
// Check if taskId and newTaskName are set in the request
if (isset($_POST['taskId']) && isset($_POST['newTaskName'])) {
    // Get the task ID and new task name from the request
    $taskId = $_POST['taskId'];
    $newTaskName = $_POST['newTaskName'];

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

    // Prepare an update statement
    $sql = "UPDATE assignments SET task_name = ? WHERE task_id = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("si", $newTaskName, $taskId);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            echo "Task updated successfully";
        } else {
            echo "Error updating task";
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $conn->close();
} else {
    echo "Task ID or new task name not provided";
}
?>
