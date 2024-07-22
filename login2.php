<?php
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //$username = $_POST['username'];
    //$password = $_POST['password'];
    //$ip = $_POST['ip'];
   
    //$latitude = $_POST['latitude'];
    //$longitude = $_POST['longitude'];

    // Save data to a file or database (for demonstration, we save it to a file)
    //$file = fopen('login_data.txt', 'a');
    //fwrite($file, "Username: $username\nPassword: $password\nIP: $ip\nLatitude: $latitude\nLongitude: $longitude\n\n");
    //fclose($file);

    //echo "Login data saved successfully.";
//}
//?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // hash the password
    $ip = $_POST['ip'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO logins (username, password, ip, latitude, longitude) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $password, $ip, $latitude, $longitude);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Login data saved successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
