<?php
$username = $_POST['username'];
$password = $_POST['password'];
$passwordRepeat = $_POST['passwordRepeat'];

if (empty($password) || empty($passwordRepeat) || empty($username)) {
    header("Location: register.html");
    exit();
}

// Check if username exists in database
$sql = "SELECT username FROM users WHERE username = '$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // Username already exists, redirect to register page
    header("Location: register.html");
    exit();
}

if (strcmp($password, $passwordRepeat) == 0) {


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

    $pswdHash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, passwd) VALUES ('$username', '$pswdHash')";
    if ($conn->query($sql) === TRUE) {
        session_start();
        $_SESSION['username'] = $username;
        header("Location: content.php");
        exit();
    } else {
        header("Location: register.html");
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>