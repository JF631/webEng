<?php
$username = $_POST['username'];
$password = $_POST['password'];

$servername = "localhost";
$db_user = "debian-sys-maint";
$db_password = "SC88k4LOS7Mkv8Fl";
$dbname = "Themenanmeldung";

$conn = new mysqli($servername, $db_user, $db_password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT passwd FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (password_verify($password, $row['passwd'])) {
        session_start();
        $_SESSION['username'] = $username;
        header("Location: content.php");
        exit();
    } else {
        echo "Incorrect username or password";
    }
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();


?>