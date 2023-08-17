<?php
$currentPage = "catalog.php";
?>

<?php
require_once "header.php";
?>

<?php

$bradcam_query = $dbconn->prepare("SELECT * FROM bradcam WHERE bradcam_id =:bradcam_id");
$bradcam_query->execute(['bradcam_id' => 1]);
$bradcam_data = $bradcam_query->fetch(PDO::FETCH_ASSOC);

$image_url = $bradcam_data['bradcam_product_url'];
$header_text = $bradcam_data['bradcam_product_title'];
generateBradcamArea($image_url, $header_text);

?>

<?php
require_once "offers-area.php";
?>

<?php
require_once "category-area.php";
?>

<?php
//require_once "instagram-area.php";
?>

<?php
require_once "footer.php";
?>