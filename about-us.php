<?php
$currentPage = "about-us.php";
?>

<?php
require_once "header.php";
?>

<?php
$bradcam_query = $dbconn->prepare("SELECT * FROM bradcam WHERE bradcam_id =:id");
$bradcam_query->execute(['id' => 1]);
$bradcam_data = $bradcam_query->fetch(PDO::FETCH_ASSOC);

$header_text = $bradcam_data['bradcam_about_us_title'];
$image_url = $bradcam_data['bradcam_about_us_url'];
generateBradcamArea($image_url, $header_text);
?>

<?php
require_once "about-us-area.php";
?>

<?php
    require_once "video-area.php";
?>

<?php
// require_once "instagram-area.php";
?>

<?php
require_once "footer.php";
?>