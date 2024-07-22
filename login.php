<?php
// Database connection details
$servername = "localhost";
$db_username = "root"; // default username for XAMPP
$db_password = ""; // default password for XAMPP
$dbname = "login_db"; // the name of your database

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    error_log("Connection failed: " . $conn->connect_error);
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // hash the password
    $ip = $_POST['ip'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO logins (username, password, ip, latitude, longitude) VALUES (?, ?, ?, ?, ?)");
    if ($stmt === false) {
        error_log("Statement preparation failed: " . $conn->error);
        die("Statement preparation failed: " . $conn->error);
    }

    $bind = $stmt->bind_param("sssss", $username, $password, $ip, $latitude, $longitude);
    if ($bind === false) {
        error_log("Parameter binding failed: " . $stmt->error);
        die("Parameter binding failed: " . $stmt->error);
    }

    // Execute the statement
    if ($stmt->execute()) {
        echo "Login data saved successfully.";
    } else {
        error_log("Execution failed: " . $stmt->error);
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
