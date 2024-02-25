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

// Retrieve tasks from the database
$sql = "SELECT task_id, task_name FROM assignments"; // Select both task_id and task_name
$result = $conn->query($sql);

$tasks = array();
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $tasks[] = $row; // Store both task_id and task_name in the array
    }
} else {
    echo "0 results";
}

// Close connection
$conn->close();

// Output tasks as JSON
header('Content-Type: application/json');
echo json_encode($tasks);
?>
