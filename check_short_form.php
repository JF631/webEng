<?php

$servername = "localhost";
$username = "debian-sys-maint";
$password = "SC88k4LOS7Mkv8Fl";
$dbname = "Themenanmeldung";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$shortForm = "";
if(isset($_POST['short_form'])){
    $shortForm = $_POST['short_form'];
}

$sql = "SELECT title, shortTitle, topicDescription FROM topics WHERE shortTitle LIKE '%$shortForm%'";
$result = $conn->query($sql);
$rows = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    echo json_encode($rows);
} else {
    echo "No results";
}

$conn->close();

?>
