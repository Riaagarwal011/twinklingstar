<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "twinklingstar";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if both username and password are provided
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Prepare and execute a database query to check user credentials
        $sql = "SELECT * FROM details WHERE username = '$username' AND password = '$password'";
        $result = $conn->query($sql);

        // Check if the query returned any rows
        if ($result->num_rows > 0) {
            // Login successful, redirect to a success page
            header("Location: erp.html");
            exit();
        } else {
            // Login failed, show error message
            $error = "Incorrect credentials. Please try again.";
        }
    } else {
        // Required fields not provided, show error message
        $error = "Both username and password are required.";
    }
}

// Close the database connection
$conn->close();
?>