<?php

require_once '../ftadmin/netting/dbconnect.php';

$response = array();

$query = $dbconn->prepare(
    "SELECT product_id,
            product_name,
            category_name,
            subcategory_name,
            product_description,
            product_type,
            product_color,
            product_size,
            product_price,
            product_stock
     FROM product as p 
     INNER JOIN category as c on p.category_id = c.category_id
     LEFT JOIN subcategory as s on s.subcategory_id = p.subcategory_id
     WHERE p.product_is_active = '1' and p.product_is_highlight = '1';");

$query->execute();

if ($query->rowCount() > 0) {
    $response['products'] = array();
    while ($query_row = $query->fetch(PDO::FETCH_ASSOC)) {
        $photo_url = getPhoto($dbconn, $query_row['product_id']);

        $product = array();

        $product['product_id'] = $query_row['product_id'];
        $product['product_name'] = $query_row['product_name'];
        $product['category_name'] = $query_row['category_name'];
        
        $subcategory_name = 'Standart';
        if (isset($query_row['subcategory_name'])){
            if ($query_row['subcategory_name'] != ""){
                $subcategory_name = $query_row['subcategory_name'];
            }
        }

        $product['subcategory_name'] = $subcategory_name;
        $product['product_description'] = $query_row['product_description'];
        $product['product_type'] = $query_row['product_type'];
        $product['product_color'] = $query_row['product_color'];
        $product['product_size'] = $query_row['product_size'];
        $product['product_price'] = $query_row['product_price'];
        $product['product_stock'] = $query_row['product_stock'];
        $product['product_photo_url'] = $photo_url;

        array_push($response['products'], $product);
    }
    $response['success'] = 1;
} else {
    $response['success'] = 0;
    $response['message'] = "No product found in the database.";
}

echo json_encode($response);



function getPhoto($dbconn, $id){
    $query = $dbconn->prepare(
        "SELECT product_photo_url FROM product_photo
         WHERE product_id = {$id};
         LIMIT 1");
    
    $query->execute();

    $query_row = $query->fetch(PDO::FETCH_ASSOC);
    
    return $query_row['product_photo_url'];
}

?>

