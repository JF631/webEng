<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $topic = $_POST["title"];
        $shortForm = $_POST["shortTitle"];
        $description = $_POST["description"];

        $servername = "localhost";
        $username = "debian-sys-maint";
        $password = "SC88k4LOS7Mkv8Fl";
        $dbname = "Themenanmeldung";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        echo "connection established";

        if(isset($_POST['topicId']) && !empty($_POST['topicId'])){
            $id = $_POST['topicId'];
            echo $id;
            unset($_POST['topicId']);
            $sql = "UPDATE topics SET title='$topic', shortTitle='$shortForm', topicDescription='$description' WHERE id='$id'";
        }else{
            $sql = "INSERT INTO topics (title, shortTitle, topicDescription) VALUES ('$topic', '$shortForm', '$description')";
        }

        if ($conn->query($sql) === TRUE) {
            header("Location: content.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
        $conn->close();


    }
?>