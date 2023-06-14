<?php

function fetchCurrentAPOD(){
    $url = "https://api.nasa.gov/planetary/apod?api_key=6AT1BjGHJIL1yr47QApFUnVmVa2dxmTfhpSevfaD";
    $apodData = file_get_contents($url);
    $apodJson = json_decode($apodData);
    return $apodJson;
}

function fetchAPODs($startDate, $endDate){
    $url = "https://api.nasa.gov/planetary/apod?api_key=6AT1BjGHJIL1yr47QApFUnVmVa2dxmTfhpSevfaD&start_date=$startDate&end_date=$endDate";
    $apodData = file_get_contents($url);
    $apodJson = json_decode($apodData);
    return $apodJson;
}

?>