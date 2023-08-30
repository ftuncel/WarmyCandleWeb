<?php

require_once '../ftadmin/netting/dbconnect.php';

$response = array();

$query_about = $dbconn->prepare("SELECT * FROM setting_about");
$query_about->execute();

$query_setting = $dbconn->prepare("SELECT * FROM setting");
$query_setting->execute();

if ($query_about->rowCount() > 0 && $query_setting->rowCount() > 0 ) {
    $response['about'] = array();

    $query_about_row = $query_about->fetch(PDO::FETCH_ASSOC);
    $query_setting_row = $query_setting->fetch(PDO::FETCH_ASSOC);

    $data = array();
    $data['id'] = $query_about_row['setting_about_id'];
    $data['about_title'] = $query_about_row['setting_about_title'];
    $data['about_detail'] = $query_about_row['setting_about_detail'];
    $data['gsm'] = $query_setting_row['setting_gsm'];
    $data['mail'] = $query_setting_row['setting_mail'];
    $data['instagram'] = $query_setting_row['setting_instagram'];
    
    $response['about'] = $data;
    $response['success'] = 1;
} else {
    $response['success'] = 0;
    $response['message'] = "No data found on DB";
}

echo json_encode($response);

?>