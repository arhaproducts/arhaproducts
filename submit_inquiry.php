<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection settings
$host = 'localhost'; // Your host
$username = 'root'; // Your MySQL username (no '@localhost')
$password = 'root'; // Your MySQL password (no '@localhost')
$dbname = 'aarha'; // Your database name

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO inq (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect back to the inquiry form with a success message
        header("Location: inquiry.html?success=1");
        exit(); // Ensure script stops after redirect
    } else {
        echo "Error: " . $stmt->error; // Display any SQL errors
    }

    $stmt->close();
}

$conn->close();
?>
