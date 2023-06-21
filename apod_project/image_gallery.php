<?php
session_start();
// Fetch APOD JSON data for the gallery
include 'fetch_apod.php';

// Check if an offset value is provided
$offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
$dayString = '-' . $offset . ' days';

$currentDate = date("Y-m-d");
$oneHundredDaysAgo = date("Y-m-d", strtotime($dayString, strtotime($currentDate)));
$galleryJson = fetchAPODs($oneHundredDaysAgo, $currentDate);

$loggedIn = isset($_SESSION['username']);
$username = '';
if ($loggedIn) {
    $username = $_SESSION['username'];
}

$servername = "localhost";
$db_user = "debian-sys-maint";
$db_password = "SC88k4LOS7Mkv8Fl";
$dbname = "APOD";

$conn = new mysqli($servername, $db_user, $db_password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

foreach ($galleryJson as $galleryItem) {
    $galleryTitle = $galleryItem->title;
    $galleryImageUrl = $galleryItem->url;
    $galleryExplanation = $galleryItem->explanation;
    $galleryDate = $galleryItem->date;

    // Check if the image is already liked by the current user
    $isLiked = false; // Assume it's not liked by default

    if ($loggedIn) {
        $sql = "SELECT * FROM Images WHERE username = '$username' AND date = '$galleryDate'";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            // The image is liked by the user
            $isLiked = true;
            echo '<script>console.log("Image Date: ' . $galleryDate . '");</script>';
        }
    }

    echo '<div class="col-lg-3 col-md-6 col-sm-6 gallery-item">'; // Added 'gallery-item' class
    echo '<div class="card gallery-card position-relative">';
    echo '<a href="#" class="image-link" data-toggle="modal" data-target="#imageModal" data-src="' . $galleryImageUrl . '" data-title="' . $galleryTitle . '" data-date="' . $galleryDate . '">';
    echo '<img class="card-img-top lazy-image img-fluid" style="width: 100%; height: 200px; object-fit: cover;" src="' . $galleryImageUrl . '" alt="' . $galleryTitle . '"></a>';

    echo '<div class="card-body">';
    echo '<div class="d-flex justify-content-between">';
    echo '<h5 class="card-title">' . $galleryTitle . '</h5>';

    $likedClass = $isLiked ? 'liked' : ''; // Define the $likedClass variable

    echo '</div>';
    echo '<button class="btn btn-link like-button ' . $likedClass . '"><i class="bi ' . ($isLiked ? 'bi-heart-fill' : 'bi-heart') . '"></i></button>';
    echo '</div>';
    echo '<button class="btn btn-info info-button" data-toggle="modal" data-target="#infoModal" data-title="' . $galleryTitle . '" data-explanation="' . $galleryExplanation . '">i</button>';
    echo '</div>';
    echo '</div>';
}

$conn->close(); // Close the database connection
?>
