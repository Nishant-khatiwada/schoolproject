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

// Ensure user is logged in
if (!isset($_SESSION["user_id"])) {
    // Redirect user to login page if not logged in
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION["user_id"]; 

// Retrieve tasks from the database
$sql = "SELECT task_id, task_name FROM assignments WHERE user_id = $user_id";
$result = $conn->query($sql);

if (!$result) {
    die("Error fetching tasks: " . $conn->error);
}

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
