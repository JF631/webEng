<?php
// Fetch APOD JSON data for the gallery
include 'fetch_apod.php';
$currentDate = date("Y-m-d");
$oneHundredDaysAgo = date("Y-m-d", strtotime('-8 days', strtotime($currentDate)));
$galleryJson = fetchAPODs($oneHundredDaysAgo, $currentDate);

foreach ($galleryJson as $galleryItem) {
    $galleryTitle = $galleryItem->title;
    $galleryImageUrl = $galleryItem->url;
    $galleryExplanation = $galleryItem->explanation;
    $galleryDate = $galleryItem->date;

    // Check if the image is already liked by the current user
    $isLiked = false; // Assume it's not liked by default

    // Replace 'YOUR_USERNAME' with the actual username
    $username = 'lukas';

    // Perform a database query to check if the image is liked by the user
    $servername = "localhost";
    $db_user = "debian-sys-maint";
    $db_password = "SC88k4LOS7Mkv8Fl";
    $dbname = "APOD";

    $conn = new mysqli($servername, $db_user, $db_password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    

    $sql = "SELECT * FROM Images WHERE username = '$username' AND date = '$galleryDate'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        // The image is liked by the user
        $isLiked = true;
        echo '<script>console.log("Image Date: ' . $galleryDate . '");</script>';

    }

    echo '<div class="col-lg-3 col-md-6 col-sm-6">';
    echo '<div class="card gallery-card position-relative">';
    echo '<a href="#" class="image-link" data-toggle="modal" data-target="#imageModal" data-src="' . $galleryImageUrl . '" data-title="' . $galleryTitle . '" data-date="' . $galleryDate . '">';
    echo '<img class="card-img-top lazy-image img-fluid" src="' . $galleryImageUrl . '" alt="' . $galleryTitle . '">';

    // Toggle the 'liked' class based on the $isLiked variable
    $likedClass = $isLiked ? 'liked' : '';
    echo '<button class="btn btn-link like-button position-absolute top-0 start-100 translate-middle ' . $likedClass . '"><i class="bi ' . ($isLiked ? 'bi-heart-fill' : 'bi-heart') . '"></i></button>';

    echo '</a>';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">' . $galleryTitle . '</h5>';
    echo '<button class="btn btn-info info-button" data-toggle="modal" data-target="#infoModal" data-title="' . $galleryTitle . '" data-explanation="' . $galleryExplanation . '">i</button>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

$conn->close(); // Close the database connection

?>