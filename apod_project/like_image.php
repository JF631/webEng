<?php
session_start();

if (!isset($_SESSION['username'])) {
    http_response_code(401); // Set the HTTP status code to indicate unauthorized access
    exit(); // Terminate script execution after redirect
}

$username = $_SESSION['username'];
if (!isset($_POST['date'])) {
    http_response_code(400); // Set the HTTP status code to indicate a bad request
    echo "Error: Date not received.";
    exit(); // Terminate script execution if the date is not received
}   

$date = $_POST['date'];

$servername = "localhost";
$db_user = "debian-sys-maint";
$db_password = "SC88k4LOS7Mkv8Fl";
$dbname = "APOD";

$conn = new mysqli($servername, $db_user, $db_password, $dbname);
if ($conn->connect_error) {
    http_response_code(500); // Set the HTTP status code to indicate an internal server error
    echo "Connection failed: " . $conn->connect_error;
    exit(); // Terminate script execution if the connection fails
}

$sql = "SELECT date, username FROM Images WHERE date = '$date' AND username = '$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // Image already exists for the user, delete it
    $sql = "DELETE FROM Images WHERE date = '$date' AND username = '$username'";
    if ($conn->query($sql) === TRUE) {
        echo 'unliked'; // Return 'unliked' as the response
    } else {
        http_response_code(500); // Set the HTTP status code to indicate an internal server error
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // Image doesn't exist for the user, add it
    $sql = "INSERT INTO Images (date, username) VALUES ('$date', '$username')";
    if ($conn->query($sql) === TRUE) {
        echo 'liked'; // Return 'liked' as the response
    } else {
        http_response_code(500); // Set the HTTP status code to indicate an internal server error
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close(); // Close the database connection
?>
