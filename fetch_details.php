<?php

$servername = "localhost";
$username = "debian-sys-maint";
$password = "SC88k4LOS7Mkv8Fl";
$dbname = "Themenanmeldung";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = -1;
if(isset($_POST['topic_id'])){
    $id = $_POST['topic_id'];
}

$sql = "SELECT title, shortTitle, topicDescription FROM topics WHERE id = $id";
if ($result = $conn->query($sql)) {
    $rows = $result->fetch_assoc();
    echo json_encode($rows);
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}



?>