<?php
$username = $_POST['username'];
$password = $_POST['password'];

$servername = "localhost";
$db_user = "debian-sys-maint";
$db_password = "SC88k4LOS7Mkv8Fl";
$dbname = "APOD";

$conn = new mysqli($servername, $db_user, $db_password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT password FROM Users WHERE name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row == null || !password_verify($password, $row['password'])) {
        http_response_code(401);
        exit();
    } else {
        session_start();
        $_SESSION['username'] = $username;
        header("Location: overview.php");
        exit;
    }
} else {
    http_response_code(500);
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>