<?php

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    process_request();
} else {
    $response['success'] = 0;
    $response['message'] = "Only POST requests are allowed. ". $_SERVER['REQUEST_METHOD'];
    echo json_encode($response);
    exit();
}

function process_request(){
    if (isset($_POST['product_id'])) {
        $product_id = $_POST['product_id'];

        require_once '../ftadmin/netting/dbconnect.php';
    
        $query = $dbconn->prepare("SELECT * FROM product_photo WHERE product_id = :product_id");
        $query->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        // echo $query->queryString;

        $query->execute();
    
        if ($query->rowCount() > 0) {
            $response['product_photo_list'] = array();
            while ($query_row = $query->fetch(PDO::FETCH_ASSOC)) {
                array_push($response['product_photo_list'], $query_row['product_photo_url']);
            }
            $response['success'] = 1;
        } else {
            $response['success'] = 0;
            $response['message'] = "No product found in the database.";
        }
    
    }else{
        $response['success'] = 0;
        $response['message'] = "Required filed(s) missing";
    }
    
    echo json_encode($response);
}
