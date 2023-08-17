<?php
error_reporting(0);
ob_start();
session_start();
require_once 'dbconnect.php';
require_once 'definition.php';
require_once 'function.php';

if ($debugging_active) {
	echo "<pre>";
	print_r($_POST);
	echo "</pre>";
}

if (!empty($_FILES)) {

	$uploads_dir = '../../img/product';
	$product_id = $_POST['product_id'];

	$uploadPath = uploadFile($_FILES['file'], $uploads_dir, $product_id.'_');
	if ($uploadPath === "") {
		$_SESSION['status'] = "fail";
		exit;
	}
	$uploadPathDB = substr($uploadPath, 6);

	$query = $dbconn->prepare("INSERT INTO product_photo SET
	product_photo_url=:product_photo_url,
	product_id=:product_id");
	$insert = $query->execute(array(
		'product_photo_url' => $uploadPathDB,
		'product_id' => $product_id
	));

	/*
	$uploads_dir = '../../img/product';

	$tmp_name = $_FILES['file']['tmp_name'];
	$name = $_FILES['file']['name'];

	$fileExtension = pathinfo($name, PATHINFO_EXTENSION);
	$fileName = pathinfo($name, PATHINFO_FILENAME);

	$uniqueName = $fileName . '_' . uniqid() . '.' . $fileExtension;
	$uploadPath = $uploads_dir . '/' . $uniqueName;

	if (move_uploaded_file($tmp_name, $uploadPath)) {
		$uploadPathDB = substr($uploadPath, 6);
		$product_id = $_POST['product_id'];
		$query = $dbconn->prepare("INSERT INTO product_photo SET
			product_photo_url=:product_photo_url,
			product_id=:product_id");
		$insert = $query->execute(array(
			'product_photo_url' => $uploadPathDB,
			'product_id' => $product_id
		));
	}


	*/
	/*
	$uploads_dir = '../../img/product';
	@$tmp_name = $_FILES['file']["tmp_name"];
	@$name = $_FILES['file']["name"];
	$benzersizsayi1=rand(20000,32000);
	$benzersizsayi2=rand(20000,32000);
	$benzersizsayi3=rand(20000,32000);
	$benzersizsayi4=rand(20000,32000);

	$benzersizad=$benzersizsayi1.$benzersizsayi2.$benzersizsayi3.$benzersizsayi4;
	$refimgyol=substr($uploads_dir, 6)."/".$benzersizad.$name;
	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");

	$product_id=$_POST['product_id'];

	$kaydet=$dbconn->prepare("INSERT INTO product_photo SET
		product_photo_url=:product_photo_url,
		product_id=:product_id");
	$insert=$kaydet->execute(array(
		'product_photo_url' => $refimgyol,
		'product_id' => $product_id
		));
*/
}
