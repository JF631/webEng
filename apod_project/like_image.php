<?php
session_start();

if (!isset($_SESSION['username'])) {
    // Redirect to overview.php if the username is not set in the session
    echo 'Noooo ';

    header("Location: overview.php");
    exit(); // Terminate script execution after redirect
}

$username = $_SESSION['username'];
if (!isset($_POST['date'])) {
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
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT date, username FROM Images WHERE date = '$date'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // Username already exists, redirect to register page
    $sql = "DELETE FROM Images WHERE date = '$date' AND username = '$username'";
    if ($conn->query($sql) === TRUE) {
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

//$sql = "INSERT INTO Users (name, password) VALUES ('wikiiii', '123')";
$sql = "INSERT INTO Images (date, username) VALUES ('$date', '$username')";
if ($conn->query($sql) === TRUE) {
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>
