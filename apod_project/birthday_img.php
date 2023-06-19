<?php
if (!isset($_POST['date'])) {
    http_response_code(400); // Set the HTTP status code to indicate a bad request
    echo "Error: Date not received.";
    exit(); // Terminate script execution if the date is not received
}

$date = $_POST['date'];

// Validate and format the date using the DateTime class
$dateTime = DateTime::createFromFormat('Y-m-d', $date);
if (!$dateTime) {
    http_response_code(400);
    echo "Error: Invalid date format.";
    exit();
}

$formattedDate = $dateTime->format('Y-m-d');

$url = "https://api.nasa.gov/planetary/apod?api_key=6AT1BjGHJIL1yr47QApFUnVmVa2dxmTfhpSevfaD&date=$formattedDate";
$apodData = file_get_contents($url);

if ($apodData === false) {
    http_response_code(500);
    echo "Error: Failed to fetch APOD data.";
    exit();
}

$apodJson = json_decode($apodData);

echo json_encode($apodJson);
?>
