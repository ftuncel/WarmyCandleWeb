<?php

require_once '../ftadmin/netting/dbconnect.php';

$response = array();

$query = $dbconn->prepare(
    "SELECT slider_id, slider_title, slider_description, slider_url
    FROM slider 
    WHERE slider_is_active = '1'
    ORDER BY slider_order;");

$query->execute();

if ($query->rowCount() > 0) {
    $response['sliders'] = array();
    while ($query_row = $query->fetch(PDO::FETCH_ASSOC)) {
        $slider = array();
        $slider['slider_id'] = $query_row['slider_id'];
        $slider['slider_title'] = $query_row['slider_title'];
        $slider['slider_description'] = $query_row['slider_description'];
        $slider['slider_url'] = $query_row['slider_url'];
        array_push($response['sliders'], $slider);
    }
    $response['success'] = 1;
} else {
    $response['success'] = 0;
    $response['message'] = "No category found in the database.";
}

echo json_encode($response);

?>