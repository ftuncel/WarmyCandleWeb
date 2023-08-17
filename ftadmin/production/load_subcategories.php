<?php
ob_start();
session_start();
require_once '../netting/dbconnect.php';

$operation = $_GET['subcategory'];

// Seçilen kategoriye göre alt kategorileri getirin
if ($operation == "fill") {

    $category_id = $_POST['category_id'];

    // Alt kategorileri veritabanından çekin
    $sub_category_query = $dbconn->prepare("SELECT * FROM subcategory WHERE category_id = :category_id");
    $sub_category_query->execute(array(
        'category_id' => $category_id
    ));

    $subcategories = $sub_category_query->fetchAll(PDO::FETCH_ASSOC);

    // JSON formatında alt kategorileri döndürün
    header('Content-Type: application/json');
    echo json_encode($subcategories);
}
?>