<?php
// Fetch APOD JSON data for the gallery
include 'fetch_apod.php';
$currentDate = date("Y-m-d");
$oneHundredDaysAgo = date("Y-m-d", strtotime('-7 days', strtotime($currentDate)));
$galleryJson = fetchAPODs($oneHundredDaysAgo, $currentDate);

foreach ($galleryJson as $galleryItem) {
    $galleryTitle = $galleryItem->title;
    $galleryImageUrl = $galleryItem->url;
    $galleryExplanation = $galleryItem->explanation;

    echo '<div class="col-lg-3 col-md-6 col-sm-6">';
    echo '<div class="card gallery-card">';
    echo '<a href="#" class="image-link" data-toggle="modal" data-target="#imageModal" data-src="' . $galleryImageUrl . '" data-title="' . $galleryTitle . '">';
    echo '<img class="card-img-top lazy-image img-fluid" src="' . $galleryImageUrl . '" alt="' . $galleryTitle . '">';
    echo '</a>';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">' . $galleryTitle . '</h5>';
    echo '<button class="btn btn-info info-button" data-toggle="modal" data-target="#infoModal" data-title="' . $galleryTitle . '" data-explanation="' . $galleryExplanation . '">i</button>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
?>
