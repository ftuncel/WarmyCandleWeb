<?php
$currentPage = "catalog.php";
?>

<?php
include "header.php";
?>

<?php

$category_id = $_GET['category_id'];

$category_query = $dbconn->prepare("SELECT * FROM category WHERE category_id = $category_id");
$category_query->execute([]);
$category_data = $category_query->fetch(PDO::FETCH_ASSOC);

$image_url = $category_data['category_photo_url'];
$header_text = $category_data['category_name'];
generateBradcamArea($image_url, $header_text);


/*$bradcam_query = $dbconn->prepare("SELECT * FROM bradcam WHERE bradcam_id =:bradcam_id");
$bradcam_query->execute(['bradcam_id' => 1]);
$bradcam_data = $bradcam_query->fetch(PDO::FETCH_ASSOC);

$image_url = $bradcam_data['bradcam_product_url'];
$header_text = $bradcam_data['bradcam_product_title'];
generateBradcamArea($image_url, $header_text);
*/
?>

<?php
require_once "product-area.php";
?>

<?php
//require_once "instagram-area.php";
?>

<?php
require_once "footer.php";
?>