<?php
require_once 'definition.php';

function generateBradcamArea($image_url, $header_text) {
    echo '<div class="bradcam_area" style="background-image: url(\'' . $image_url . '\')">';
    echo '<h3>'.$header_text.'</h3>';
    echo '</div>';
}

function generateSlider($backgroundImageUrl, $title, $description) {
    echo '<div class="single_slider d-flex align-items-center justify-content-center " style="background-image: url(' . $backgroundImageUrl . ');">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="slider_text text-center">
                            <h3>' . $title . '</h3>
                            <p>' . $description . '</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
}


function uploadFile($file, $uploads_dir, $preFileName="") {
    if (!empty($file)) {
        $tmp_name = $file['tmp_name'];
        $name = $file['name'];

        $fileExtension = pathinfo($name, PATHINFO_EXTENSION);
        $fileName = pathinfo($name, PATHINFO_FILENAME);

        $uniqueName = $preFileName . $fileName . '_' . uniqid() . '.' . $fileExtension;
        $uploadPath = $uploads_dir . '/' . $uniqueName;

        if (move_uploaded_file($tmp_name, $uploadPath)) {
            return $uploadPath;
        }
    }
    global $DEFAULT_NO_PHOTO_URL;
    return $DEFAULT_NO_PHOTO_URL;
}

function getURL($fileName) {
    global $DEFAULT_NO_PHOTO_URL;

    if (isset($fileName)){
        if (file_exists($fileName)) {
            return $fileName;
        }
    }
    return $DEFAULT_NO_PHOTO_URL;
}


function getUrlWithFileDepth($fileName, $filedepth) {
    global $DEFAULT_NO_PHOTO_URL;

    if (isset($fileName)){
        if (file_exists($filedepth.$fileName)) {
            return $filedepth.$fileName;
        }
    }
    return $filedepth.$DEFAULT_NO_PHOTO_URL;
}

function getCountOfProductPhoto($dbconn, $product_id) {
    $query = $dbconn->prepare("SELECT COUNT(*) AS _c FROM product_photo WHERE product_id = :product_id");
    $query->execute(array(
        'product_id' => $product_id
    ));
    $data = $query->fetch(PDO::FETCH_ASSOC);
    $num_photos = $data['_c'];

    return $num_photos;
}


function getCountOfSubcategory($dbconn, $category_id) {
    $query = $dbconn->prepare("SELECT COUNT(*) AS _c FROM subcategory WHERE category_id = :category_id");
    $query->execute(array(
        'category_id' => $category_id
    ));
    $data = $query->fetch(PDO::FETCH_ASSOC);
    $num_photos = $data['_c'];

    return $num_photos;
}

function getCategoryName($dbconn, $category_id) {
    $query = $dbconn->prepare("SELECT category_name as _name FROM category WHERE category_id = :category_id");
    $query->execute(array(
        'category_id' => $category_id
    ));
    $data = $query->fetch(PDO::FETCH_ASSOC);
    $name = $data['_name'];

    return $name;
}

function getSubcategoryName($dbconn, $subcategory_id) {
    global $DEFAULT_SUBCATEGORY_NAME;
    if (!isset($subcategory_id) || $subcategory_id == 0 ) {
        return $DEFAULT_SUBCATEGORY_NAME;
    }
    $query = $dbconn->prepare("SELECT subcategory_name as _name FROM subcategory WHERE subcategory_id = :subcategory_id");
    $query->execute(array(
        'subcategory_id' => $subcategory_id
    ));
    $data = $query->fetch(PDO::FETCH_ASSOC);

    return $data['_name'];
}