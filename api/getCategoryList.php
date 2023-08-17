<?php

require_once '../ftadmin/netting/dbconnect.php';

$response = array();

$query = $dbconn->prepare(
    "SELECT category_id, category_name FROM category");

$query->execute();

if ($query->rowCount() > 0) {
    $response['categories'] = array();
    while ($query_row = $query->fetch(PDO::FETCH_ASSOC)) {
        $category = array();
        $category['category_id'] = $query_row['category_id'];
        $category['category_name'] = $query_row['category_name'];

        array_push($response['categories'], $category);
    }
    $response['success'] = 1;
} else {
    $response['success'] = 0;
    $response['message'] = "No category found in the database.";
}

echo json_encode($response);

?>