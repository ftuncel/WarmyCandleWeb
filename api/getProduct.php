<?php

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    process_request();
} else {
    $response['success'] = 0;
    $response['message'] = "Only POST requests are allowed.";
    echo json_encode($response);
    exit();
}

function process_request()
{
    if (isset($_POST['product_id'])) {
        $product_id = $_POST['product_id'];

        require_once '../ftadmin/netting/dbconnect.php';
        
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
         WHERE p.product_is_active = '1' AND p.product_id = :product_id"
        );

        $query->bindParam(':product_id', $product_id, PDO::PARAM_INT);

        $query->execute();

        if ($query->rowCount() > 0) {
            $response['products'] = array();
            while ($query_row = $query->fetch(PDO::FETCH_ASSOC)) {
                $product = array();
                $product['product_id'] = $query_row['product_id'];
                $product['product_name'] = $query_row['product_name'];
                $product['category_name'] = $query_row['category_name'];
                $product['subcategory_name'] = $query_row['subcategory_name'];
                $product['product_description'] = $query_row['product_description'];
                $product['product_type'] = $query_row['product_type'];
                $product['product_color'] = $query_row['product_color'];
                $product['product_size'] = $query_row['product_size'];
                $product['product_price'] = $query_row['product_price'];
                $product['product_stock'] = $query_row['product_stock'];

                array_push($response['products'], $product);
            }
            $response['success'] = 1;
        } else {
            $response['success'] = 0;
            $response['message'] = "No product found in the database.";
        }
    } else {
        $response['success'] = 0;
        $response['message'] = "Required filed(s) missing";
    }

    echo json_encode($response);
}