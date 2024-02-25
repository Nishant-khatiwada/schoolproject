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

// Retrieve task name from the form
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["task_name"])) {
    $taskName = $_POST["task_name"];

    // Insert task into the database
    $sql = "INSERT INTO assignments (task_name) VALUES ('$taskName')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        // Redirect after successful insertion
        header("Location: home.html");
        exit(); // Ensure no further code execution after redirection
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
