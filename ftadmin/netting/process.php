<?php
session_start();
require_once 'dbconnect.php';
require_once 'definition.php';
require_once 'function.php';

if ($debugging_active) {
    error_reporting(E_ALL);

    echo "POST";
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    echo "GET";
    echo "<pre>";
    print_r($_GET);
    echo "</pre>";
}

if (isset($_POST['admin_login'])) {
    $user_mail = $_POST['user_mail'];
    $user_password = md5($_POST['user_password']);

    $userquery = $dbconn->prepare("SELECT * FROM user where user_mail=:user_mail and user_password=:user_password and user_level=:user_level");
    $userquery->execute(array(
        'user_mail' => $user_mail,
        'user_password' => $user_password,
        'user_level' => 5
    ));

    echo $count = $userquery->rowCount();

    if ($count == 1) {
        $_SESSION['user_mail'] = $user_mail;
        header("Location:../production/index.php");
        exit;
    } else {
        header("Location:../production/login.php?status=no");
        exit;
    }
}

/***********
 * SETTING *
 ***********/
if (isset($_POST['setting_save_all'])) {
    try {
        $sql = $dbconn->prepare("UPDATE setting SET
            setting_title=:setting_title,
            setting_icon=:setting_icon,
            setting_description=:setting_description,
            setting_about_title=:setting_about_title,
            setting_about_detail=:setting_about_detail,
            setting_author=:setting_author,
            setting_gsm=:setting_gsm,
            setting_mail=:setting_mail,
            setting_address=:setting_address,
            setting_maps=:setting_maps,
            setting_facebook=:setting_facebook,
            setting_twitter=:setting_twitter,
            setting_youtube=:setting_youtube,
            setting_instagram=:setting_instagram,
            setting_smtphost=:setting_smtphost,
            setting_smtpuser=:setting_smtpuser,
            setting_smtppassword=:setting_smtppassword,
            setting_smtpport=:setting_smtpport,
            setting_maintanance=:setting_maintanance
            WHERE setting_id=1
        ");

        $update = $sql->execute(
            [
                'setting_title' => $_POST['setting_title'],
                'setting_icon' => $_POST['setting_icon'],
                'setting_description' => $_POST['setting_description'],
                'setting_about_title' => $_POST['setting_about_title'],
                'setting_about_detail' => $_POST['setting_about_detail'],
                'setting_description' => $_POST['setting_description'],
                'setting_author' => $_POST['setting_author'],
                'setting_gsm' => $_POST['setting_gsm'],
                'setting_mail' => $_POST['setting_mail'],
                'setting_address' => $_POST['setting_address'],
                'setting_maps' => $_POST['setting_maps'],
                'setting_facebook' => $_POST['setting_facebook'],
                'setting_twitter' => $_POST['setting_twitter'],
                'setting_youtube' => $_POST['setting_youtube'],
                'setting_instagram' => $_POST['setting_instagram'],
                'setting_smtphost' => $_POST['setting_smtphost'],
                'setting_smtpuser' => $_POST['setting_smtpuser'],
                'setting_smtppassword' => $_POST['setting_smtppassword'],
                'setting_smtpport' => $_POST['setting_smtpport'],
                'setting_maintanance' => $_POST['setting_maintanance']
            ]
        );
        if ($update) {
            $_SESSION['status'] = "ok";
        } else {
            $_SESSION['status'] = "fail";
        }
    } catch (PDOException $e) {
        if ($debugging_active) {
            echo ("Exception got: " . $e);
            exit;
        }
        $_SESSION['status'] = "fail";
    }

    Header("Location:../production/setting-all.php");
    exit;
}

if (isset($_POST['setting_save_general'])) {
    try {
        $sql = $dbconn->prepare("UPDATE setting SET
            setting_title=:setting_title,
            setting_description=:setting_description,
            setting_keywords=:setting_keywords
            WHERE setting_id=1
        ");

        $update = $sql->execute(
            [
                'setting_title' => $_POST['setting_title'],
                'setting_description' => $_POST['setting_description'],
                'setting_keywords' => $_POST['setting_keywords']
            ]
        );
        if ($update) {
            $_SESSION['status'] = "ok";
        } else {
            $_SESSION['status'] = "fail";
        }
    } catch (PDOException $e) {
        if ($debugging_active) {
            echo ("Exception got: " . $e);
            exit;
        }
        $_SESSION['status'] = "fail";
    }

    Header("Location:../production/setting-general.php");
    exit;
}

if (isset($_POST['setting_save_contact'])) {
    try {
        $sql = $dbconn->prepare("UPDATE setting SET
            setting_mail=:setting_mail,
            setting_gsm=:setting_gsm,
            setting_address=:setting_address
            WHERE setting_id=1
        ");

        $update = $sql->execute(
            [
                'setting_mail' => $_POST['setting_mail'],
                'setting_gsm' => $_POST['setting_gsm'],
                'setting_address' => $_POST['setting_address']
            ]
        );
        if ($update) {
            $_SESSION['status'] = "ok";
        } else {
            $_SESSION['status'] = "fail";
        }
    } catch (PDOException $e) {
        if ($debugging_active) {
            echo ("Exception got: " . $e);
            exit;
        }
        $_SESSION['status'] = "fail";
    }
    Header("Location:../production/setting-general.php");
    exit;
}

if (isset($_POST['setting_save_social'])) {
    try {
        $sql = $dbconn->prepare("UPDATE setting SET
            setting_facebook=:setting_facebook,
            setting_twitter=:setting_twitter,
            setting_youtube=:setting_youtube,
            setting_instagram=:setting_instagram
            WHERE setting_id=1
        ");

        $result = $sql->execute(
            [
                'setting_facebook' => $_POST['setting_facebook'],
                'setting_twitter' => $_POST['setting_twitter'],
                'setting_youtube' => $_POST['setting_youtube'],
                'setting_instagram' => $_POST['setting_instagram']
            ]
        );
        if ($result) {
            $_SESSION['status'] = "ok";
        } else {
            $_SESSION['status'] = "fail";
        }
    } catch (PDOException $e) {
        if ($debugging_active) {
            echo ("Exception got: " . $e);
            exit;
        }
        $_SESSION['status'] = "fail";
    }
    Header("Location:../production/setting-social.php");
    exit;
}

if (isset($_POST['setting_icon_edit'])) {
    $fileName = "setting-icon.php";
    try {
        if ($_FILES['setting_icon']["size"] > 0) {

            $uploads_dir = '../../img/icon';
            $uploadPath = uploadFile($_FILES['setting_icon'], $uploads_dir);
            if ($uploadPath === "") {
                $_SESSION['status'] = "fail";
                Header("Location:../production/setting-icon.php?durum=file_upload_fail");
                exit;
            }
            $uploadPathDB = substr($uploadPath, 6);

            $sql = $dbconn->prepare("UPDATE setting SET
            setting_icon=:setting_icon
            WHERE setting_id=1
            ");

            $setting_query = $dbconn->prepare("SELECT * FROM setting WHERE setting_id = 1");
            $setting_query->execute();
            $setting_data = $setting_query->fetch(PDO::FETCH_ASSOC);
            $old_url = $setting_data['setting_icon'];

            $update = $sql->execute(
                [
                    'setting_icon' => $uploadPathDB
                ]
            );
            if ($update) {
                $_SESSION['status'] = "ok";
                if (!unlink("../../$old_url")) {
                    echo "unlink fail";
                }
            } else {
                $_SESSION['status'] = "fail";
            }
        }
    } catch (PDOException $e) {
        if ($debugging_active) {
            echo ("Exception got: " . $e);
            exit;
        }
        $_SESSION['status'] = "fail";
    }

    Header("Location:../production/setting-icon.php");
    exit;
}

if (isset($_POST['setting_about_save_all'])) {
    try {
        $query = $dbconn->prepare("UPDATE setting_about SET
        setting_about_title=:setting_about_title,
        setting_about_detail=:setting_about_detail,
        setting_about_video_title=:setting_about_video_title,
        setting_about_video_detail=:setting_about_video_detail,
        setting_about_video_link=:setting_about_video_link
        WHERE setting_about_id=1
    ");

        $result = $query->execute(
            [
                'setting_about_title' => $_POST['setting_about_title'],
                'setting_about_detail' => $_POST['setting_about_detail'],
                'setting_about_video_title' => $_POST['setting_about_video_title'],
                'setting_about_video_detail' => $_POST['setting_about_video_detail'],
                'setting_about_video_link' => $_POST['setting_about_video_link']
            ]
        );

        if ($result) {
            $_SESSION['status'] = "ok";
        } else {
            $_SESSION['status'] = "fail";
        }
    } catch (PDOException $e) {
        if ($debugging_active) {
            echo ("Exception got: " . $e);
            exit;
        }
        $_SESSION['status'] = "fail";
    }

    Header("Location:../production/setting-about.php");
    exit;
}

if (isset($_POST['go_to_about_photo1_page'])) {
    Header("Location:../production/setting-about-photo1.php");
    exit;
}

if (isset($_POST['go_to_about_photo2_page'])) {
    Header("Location:../production/setting-about-photo2.php");
    exit;
}

if (isset($_POST['go_to_about_video_photo_page'])) {
    Header("Location:../production/setting-about-video-photo.php");
    exit;
}

if (isset($_POST['setting_about_video_photo_edit'])) {
    $fileName = "setting-about-video-photo.php";
    try {
        if ($_FILES['setting_about_video_photo_url']["size"] > 0) {

            $uploads_dir = '../../img/about';
            $uploadPath = uploadFile($_FILES['setting_about_video_photo_url'], $uploads_dir);
            if ($uploadPath === "") {
                $_SESSION['status'] = "fail";
                Header("Location:../production/$fileName?durum=file_upload_fail");
                exit;
            }
            $uploadPathDB = substr($uploadPath, 6);

            $setting_about_query = $dbconn->prepare("SELECT * FROM setting_about WHERE setting_about_id = 1");
            $setting_about_query->execute();
            $setting_about_data = $setting_about_query->fetch(PDO::FETCH_ASSOC);
            $old_url = $setting_about_data['setting_about_video_photo_url'];

            $sql = $dbconn->prepare("UPDATE setting_about SET
            setting_about_video_photo_url=:setting_about_video_photo_url
            WHERE setting_about_id=1
            ");

            $update = $sql->execute(
                [
                    'setting_about_video_photo_url' => $uploadPathDB
                ]
            );
            if ($update) {
                unlink("../../$old_url");
                $_SESSION['status'] = "ok";
            } else {
                $_SESSION['status'] = "fail";
            }
        }
    } catch (PDOException $e) {
        if ($debugging_active) {
            echo ("Exception got: " . $e);
            exit;
        }
        $_SESSION['status'] = "fail";
    }

    Header("Location:../production/$fileName");
    exit;
}

if (isset($_POST['setting_about_photo1_edit'])) {
    $fileName = "setting-about-photo1.php";
    try {
        if ($_FILES['setting_about_photo1_url']["size"] > 0) {

            $uploads_dir = '../../img/about';
            $uploadPath = uploadFile($_FILES['setting_about_photo1_url'], $uploads_dir);
            if ($uploadPath === "") {
                $_SESSION['status'] = "fail";
                Header("Location:../production/$fileName?durum=file_upload_fail");
                exit;
            }
            $uploadPathDB = substr($uploadPath, 6);

            $setting_about_query = $dbconn->prepare("SELECT * FROM setting_about WHERE setting_about_id = 1");
            $setting_about_query->execute();
            $setting_about_data = $setting_about_query->fetch(PDO::FETCH_ASSOC);
            $old_url = $setting_about_data['setting_about_photo1_url'];

            $sql = $dbconn->prepare("UPDATE setting_about SET
            setting_about_photo1_url=:setting_about_photo1_url
            WHERE setting_about_id=1
            ");

            $update = $sql->execute(
                [
                    'setting_about_photo1_url' => $uploadPathDB
                ]
            );
            if ($update) {
                $_SESSION['status'] = "ok";
                echo "sql update ok";
                if (!unlink("../../$old_url")) {
                    echo "unlink fail";
                }
            } else {
                $_SESSION['status'] = "fail";
            }
            exit;
        }
    } catch (PDOException $e) {
        if ($debugging_active) {
            echo ("Exception got: " . $e);
            exit;
        }
        $_SESSION['status'] = "fail";
    }

    Header("Location:../production/$fileName");
    exit;
}

if (isset($_POST['setting_about_photo2_edit'])) {
    $fileName = "setting-about-photo2.php";
    try {
        if ($_FILES['setting_about_photo2_url']["size"] > 0) {
            $uploads_dir = '../../img/about';
            $uploadPath = uploadFile($_FILES['setting_about_photo2_url'], $uploads_dir);
            if ($uploadPath === "") {
                $_SESSION['status'] = "fail";
                Header("Location:../production/$fileName?durum=file_upload_fail");
                exit;
            }
            $uploadPathDB = substr($uploadPath, 6);

            $setting_about_query = $dbconn->prepare("SELECT * FROM setting_about WHERE setting_about_id = 1");
            $setting_about_query->execute();
            $setting_about_data = $setting_about_query->fetch(PDO::FETCH_ASSOC);
            $old_url = $setting_about_data['setting_about_photo2_url'];

            $sql = $dbconn->prepare("UPDATE setting_about SET
            setting_about_photo2_url=:setting_about_photo2_url
            WHERE setting_about_id=1
            ");

            $update = $sql->execute(
                [
                    'setting_about_photo2_url' => $uploadPathDB
                ]
            );
            if ($update) {
                unlink("../../$old_url");
                $_SESSION['status'] = "ok";
            } else {
                $_SESSION['status'] = "fail";
            }
        }
    } catch (PDOException $e) {
        if ($debugging_active) {
            echo ("Exception got: " . $e);
            exit;
        }
        $_SESSION['status'] = "fail";
    }

    Header("Location:../production/$fileName");
    exit;
}

/***********
 * PRODUCT *
 ***********/
if (isset($_POST['product_add'])) {

    $save = $dbconn->prepare("INSERT INTO product SET
		category_id=:category_id,
		product_name=:product_name,
		product_description=:product_description,
        product_type=:product_type,
		product_color=:product_color,
		product_size=:product_size,
		product_price=:product_price,
		product_stock=:product_stock,
		product_is_active=:product_is_active
		");
    $result = $save->execute(array(
        'category_id' => $_POST['category_id'],
        'product_name' => $_POST['product_name'],
        'product_description' => $_POST['product_description'],
        'product_type' => $_POST['product_type'],
        'product_color' => $_POST['product_color'],
        'product_size' => $_POST['product_size'],
        'product_price' => $_POST['product_price'],
        'product_stock' => $_POST['product_stock'],
        'product_is_active' => $_POST['product_is_active']
    ));

    if ($result) {
        $_SESSION['status'] = "ok";
    } else {
        $_SESSION['status'] = "fail";
    }

    if ($result) {
        Header("Location:../production/product.php?durum=ok");
        exit;
    } else {
        Header("Location:../production/product.php?durum=no");
        exit;
    }
}

if (isset($_POST['product_edit'])) {

    $product_id = $_POST['product_id'];

    $query = $dbconn->prepare("UPDATE product SET
		subcategory_id=:subcategory_id,
		product_name=:product_name,
		product_description=:product_description,
        product_type=:product_type,
		product_color=:product_color,
		product_size=:product_size,
		product_price=:product_price,
		product_stock=:product_stock,
		product_is_active=:product_is_active
        WHERE product_id={$product_id}
        ");
    $result = $query->execute(array(
        'subcategory_id' => $_POST['subcategory_id'],
        'product_name' => $_POST['product_name'],
        'product_description' => $_POST['product_description'],
        'product_type' => $_POST['product_type'],
        'product_color' => $_POST['product_color'],
        'product_size' => $_POST['product_size'],
        'product_price' => $_POST['product_price'],
        'product_stock' => $_POST['product_stock'],
        'product_is_active' => $_POST['product_is_active']
    ));

    if ($result) {
        $_SESSION['status'] = "ok";
    } else {
        $_SESSION['status'] = "fail";
    }

    if ($result) {
        Header("Location:../production/product.php?durum=ok");
    } else {
        Header("Location:../production/product.php?durum=no");
    }
}

if (isset($_GET['product_delete'])) {
    if ($_GET['product_delete'] == "ok") {

        $photo_query = $dbconn->prepare("SELECT * FROM product_photo WHERE product_id = :product_id");
        $photo_query->execute(array(
            'product_id' => $_GET['product_id']
        ));

        $photo_result = $photo_query->fetchAll(PDO::FETCH_ASSOC);
        $num_photos = count($photo_result);

        if ($num_photos != 0) {
            Header("Location:../production/product.php?durum=photo_exist");
            exit;
        }

        $query = $dbconn->prepare("DELETE from product where product_id=:product_id");
        $result = $query->execute(array(
            'product_id' => $_GET['product_id']
        ));

        if ($result) {
            $_SESSION['status'] = "ok";
        } else {
            $_SESSION['status'] = "fail";
        }

        if ($result) {
            Header("Location:../production/product.php?durum=ok");
            exit;
        } else {
            Header("Location:../production/product.php?durum=no");
            exit;
        }
    }
}

if (isset($_GET['product_highlight']) && isset($_GET['product_id']) && isset($_GET['product_highlight'])) {
    $product_id = $_GET['product_id'];
    if ($_GET['product_highlight'] == "ok") {
        echo "burdayız2";

        $query = $dbconn->prepare("UPDATE product SET
		product_is_highlight=:product_is_highlight
        WHERE product_id={$product_id}
        ");
        $result = $query->execute(array(
            'product_is_highlight' => $_GET['product_is_highlight']
        ));

        if ($result) {
            $_SESSION['status'] = "ok";
        } else {
            $_SESSION['status'] = "fail";
        }

        if ($result) {
            Header("Location:../production/product.php?durum=ok");
            exit;
        } else {
            Header("Location:../production/product.php?durum=no");
            exit;
        }
    }
}

if (isset($_POST['product_photo_delete'])) {
    $product_id = $_POST['product_id'];

    echo $checklist = $_POST['product_photo_select'];

    foreach ($checklist as $list) {

        $query_photo = $dbconn->prepare("SELECT * from product_photo where product_photo_id=:product_photo_id");
        $query_photo->execute(array(
            'product_photo_id' => $list
        ));
        $photo_data = $query_photo->fetch(PDO::FETCH_ASSOC);

        echo "<pre>";
        print_r($photo_data);
        echo "</pre>";

        $photounlink = $photo_data['product_photo_url'];
        unlink("../../$photounlink");

        $query = $dbconn->prepare("DELETE from product_photo where product_photo_id=:product_photo_id");
        $result = $query->execute(array(
            'product_photo_id' => $list
        ));
    }

    if ($result) {
        Header("Location:../production/product-galery.php?product_id=$product_id&durum=ok");
        exit;
    } else {
        Header("Location:../production/product-galery.php?product_id=$product_id&durum=no");
        exit;
    }
}

/************
 * CATEGORY *
 ************/
if (isset($_POST['category_add'])) {
    $query = $dbconn->prepare("INSERT INTO category SET
		category_name=:category_name
		");
    $result = $query->execute(array(
        'category_name' => $_POST['category_name']
    ));

    if ($result) {
        $_SESSION['status'] = "ok";
    } else {
        $_SESSION['status'] = "fail";
    }

    if ($result) {
        Header("Location:../production/category.php?durum=ok");
    } else {
        Header("Location:../production/category.php?durum=no");
    }
}

if (isset($_POST['category_edit'])) {

    $category_id = $_POST['category_id'];

    $query = $dbconn->prepare("UPDATE category SET
		category_name=:category_name
        WHERE category_id={$category_id}
        ");
    $result = $query->execute(array(
        'category_name' => $_POST['category_name']
    ));

    if ($result) {
        $_SESSION['status'] = "ok";
    } else {
        $_SESSION['status'] = "fail";
    }

    if ($insert) {
        Header("Location:../production/category.php?durum=ok");
    } else {
        Header("Location:../production/category.php?durum=no");
    }
}

if (isset($_GET['category_delete'])) {
    if ($_GET['category_delete'] == "ok") {
        $query = $dbconn->prepare("DELETE from category where category_id=:category_id");
        $result = $query->execute(array(
            'category_id' => $_GET['category_id']
        ));

        if ($result) {
            $_SESSION['status'] = "ok";
        } else {
            $_SESSION['status'] = "fail";
        }

        if ($result) {
            Header("Location:../production/category.php?durum=ok");
        } else {
            Header("Location:../production/category.php?durum=no");
        }
    }
}

if (isset($_POST['category_photo_edit'])) {
    $category_id = $_POST['category_id'];
    if ($_FILES['category_photo_url']["size"] > 0) {
        $uploads_dir = '../../img/category';
        $uploadPath = uploadFile($_FILES['category_photo_url'], $uploads_dir);
        if ($uploadPath === "") {
            $_SESSION['status'] = "fail";
            Header("Location:../production/category-edit.php?durum=file_upload_fail");
            exit;
        }
        $uploadPathDB = substr($uploadPath, 6);

        echo $uploadPathDB;

        $query = $dbconn->prepare("UPDATE category SET
	    	category_photo_url=:category_photo_url
			WHERE category_id = {$_POST['category_id']}
        ");
        $result = $query->execute(array(
            'category_photo_url' => $uploadPathDB
        ));

        if ($result) {
            $_SESSION['status'] = "ok";
        } else {
            $_SESSION['status'] = "fail";
        }

        if ($result) {
            $resimunlink = $_POST['category_photo_url_str'];
            unlink("../../$resimunlink");
            Header("Location:../production/category-edit.php?category_id=$category_id&durum=ok");
            exit;
        } else {
            Header("Location:../production/category-edit.php?category_id=$category_id&durum=no");
            exit;
        }
    }
}

/***************
 * SUBCATEGORY *
 ***************/
if (isset($_POST['subcategory_add'])) {
    $query = $dbconn->prepare("INSERT INTO subcategory SET
        category_id=:category_id,
		subcategory_name=:subcategory_name
		");
    $result = $query->execute(array(
        'category_id' => $_POST['category_id'],
        'subcategory_name' => $_POST['subcategory_name']
    ));

    if ($result) {
        $_SESSION['status'] = "ok";
    } else {
        $_SESSION['status'] = "fail";
    }

    if ($result) {
        Header("Location:../production/subcategory.php?durum=ok");
    } else {
        Header("Location:../production/subcategory.php?durum=no");
    }
}

if (isset($_POST['subcategory_edit'])) {

    $subcategory_id = $_POST['subcategory_id'];

    $query = $dbconn->prepare("UPDATE subcategory 
                            SET subcategory_name=:subcategory_name 
                            WHERE subcategory_id={$subcategory_id}
        ");
    $result = $query->execute(array(
        'subcategory_name' => $_POST['subcategory_name']
    ));

    if ($result) {
        $_SESSION['status'] = "ok";
    } else {
        $_SESSION['status'] = "fail";
    }

    if ($insert) {
        Header("Location:../production/subcategory.php?durum=ok");
    } else {
        Header("Location:../production/subcategory.php?durum=no");
    }
}

if (isset($_GET['subcategory_delete'])) {
    if ($_GET['subcategory_delete'] == "ok") {
        $query = $dbconn->prepare("DELETE from subcategory where subcategory_id=:subcategory_id");
        $result = $query->execute(array(
            'subcategory_id' => $_GET['subcategory_id']
        ));

        if ($result) {
            $_SESSION['status'] = "ok";
        } else {
            $_SESSION['status'] = "fail";
        }

        if ($result) {
            Header("Location:../production/subcategory.php?durum=ok");
        } else {
            Header("Location:../production/subcategory.php?durum=no");
        }
    }
}

/**********
 * SLIDER *
 **********/
if (isset($_POST['bradcam_save'])) {
    try {
        $sql = $dbconn->prepare("UPDATE bradcam SET
            bradcam_product_title=:bradcam_product_title,
            bradcam_product_url=:bradcam_product_url,
            bradcam_about_us_title=:bradcam_about_us_title,
            bradcam_about_us_url=:bradcam_about_us_url
            WHERE bradcam_id=1
        ");

        $result = $sql->execute(
            [
                'bradcam_product_title' => $_POST['bradcam_product_title'],
                'bradcam_product_url' => $_POST['bradcam_product_url'],
                'bradcam_about_us_title' => $_POST['bradcam_about_us_title'],
                'bradcam_about_us_url' => $_POST['bradcam_about_us_url']
            ]
        );
        if ($result) {
            $_SESSION['status'] = "ok";
        } else {
            $_SESSION['status'] = "fail";
        }
    } catch (PDOException $e) {
        if ($debugging_active) {
            echo ("Exception got: " . $e);
            exit;
        }
        $_SESSION['status'] = "fail";
    }

    Header("Location:../production/bradcam.php");
    exit;
}

if (isset($_POST['slider_save'])) {
    $uploads_dir = '../../img/slider';
    $uploadPath = uploadFile($_FILES['slider_url'], $uploads_dir);
    if ($uploadPath === "") {
        $_SESSION['status'] = "fail";
        Header("Location:../production/slider.php?durum=file_upload_fail");
        exit;
    }
    $uploadPathDB = substr($uploadPath, 6);

    $query = $dbconn->prepare("INSERT INTO slider SET
		slider_name=:slider_name,
		slider_title=:slider_title,
		slider_description=:slider_description,
        slider_order=:slider_order,
        slider_is_active=:slider_is_active,
		slider_url=:slider_url
		");
    $result = $query->execute(array(
        'slider_name' => $_POST['slider_name'],
        'slider_title' => $_POST['slider_title'],
        'slider_description' => $_POST['slider_description'],
        'slider_order' => $_POST['slider_order'],
        'slider_is_active' => $_POST['slider_is_active'],
        'slider_url' => $uploadPathDB
    ));

    if ($result) {
        $_SESSION['status'] = "ok";
    } else {
        $_SESSION['status'] = "fail";
    }

    if ($result) {
        Header("Location:../production/slider.php?durum=ok");
        exit;
    } else {
        Header("Location:../production/slider.php?durum=no");
        exit;
    }
}

if (isset($_POST['slider_edit'])) {
    if ($_FILES['slider_url']["size"] > 0) {

        $uploads_dir = '../../img/slider';
        $uploadPath = uploadFile($_FILES['slider_url'], $uploads_dir);
        if ($uploadPath === "") {
            $_SESSION['status'] = "fail";
            Header("Location:../production/slider-edit.php?durum=file_upload_fail");
            exit;
        }
        $uploadPathDB = substr($uploadPath, 6);

        $query = $dbconn->prepare("UPDATE slider SET
            slider_name=:slider_name,
		    slider_title=:slider_title,
		    slider_description=:slider_description,
            slider_order=:slider_order,
            slider_is_active=:slider_is_active,
	    	slider_url=:slider_url
			WHERE slider_id={$_POST['slider_id']}");
        $result = $query->execute(array(
            'slider_name' => $_POST['slider_name'],
            'slider_title' => $_POST['slider_title'],
            'slider_description' => $_POST['slider_description'],
            'slider_order' => $_POST['slider_order'],
            'slider_is_active' => $_POST['slider_is_active'],
            'slider_url' => $uploadPathDB
        ));

        $slider_id = $_POST['slider_id'];

        if ($result) {
            $_SESSION['status'] = "ok";
        } else {
            $_SESSION['status'] = "fail";
        }

        if ($result) {
            $resimunlink = $_POST['slider_url'];
            unlink("../../$resimunlink");
            Header("Location:../production/slider-edit.php?slider_id=$slider_id&durum=ok");
            exit;
        } else {
            Header("Location:../production/slider-edit.php?durum=no");
            exit;
        }
    } else {
        $query = $dbconn->prepare("UPDATE slider SET
            slider_name=:slider_name,
		    slider_title=:slider_title,
		    slider_description=:slider_description,
            slider_order=:slider_order,
            slider_is_active=:slider_is_active
			WHERE slider_id={$_POST['slider_id']}");
        $result = $query->execute(array(
            'slider_name' => $_POST['slider_name'],
            'slider_title' => $_POST['slider_title'],
            'slider_description' => $_POST['slider_description'],
            'slider_order' => $_POST['slider_order'],
            'slider_is_active' => $_POST['slider_is_active']
        ));

        $slider_id = $_POST['slider_id'];

        if ($result) {
            $_SESSION['status'] = "ok";
        } else {
            $_SESSION['status'] = "fail";
        }

        if ($result) {
            Header("Location:../production/slider-edit.php?slider_id=$slider_id&durum=ok");
            exit;
        } else {
            Header("Location:../production/slider-edit.php?durum=no");
            exit;
        }
    }
}

if (isset($_GET['slider_delete'])) {
    if ($_GET['slider_delete'] == "ok") {

        $query = $dbconn->prepare("SELECT * FROM slider where slider_id=:id");
        $query->execute(array(
            'id' => $_GET['slider_id']
        ));
        $slider_data = $query->fetch(PDO::FETCH_ASSOC);

        $query = $dbconn->prepare("DELETE from slider where slider_id=:slider_id");
        $result = $query->execute(array(
            'slider_id' => $_GET['slider_id']
        ));

        if ($result) {
            $_SESSION['status'] = "ok";
        } else {
            $_SESSION['status'] = "fail";
        }

        if ($result) {
            $resimunlink = $slider_data['slider_url'];
            unlink("../../$resimunlink");
            Header("Location:../production/slider.php?durum=ok");
            exit;
        } else {
            Header("Location:../production/slider.php?durum=no");
            exit;
        }
    }
}

/*
if (isset($_POST['slider_save'])) {
    $uploads_dir = '../../img/slider';
    @$tmp_name = $_FILES['slider_url']["tmp_name"];
    @$name = $_FILES['slider_url']["name"];
    //resmin isminin benzersiz olması
    $benzersizsayi1 = rand(20000, 32000);
    $benzersizsayi2 = rand(20000, 32000);
    $benzersizsayi3 = rand(20000, 32000);
    $benzersizsayi4 = rand(20000, 32000);
    $benzersizad = $benzersizsayi1 . $benzersizsayi2 . $benzersizsayi3 . $benzersizsayi4;
    $refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad . $name;

    if (!@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name")) {
        $_SESSION['status'] = "fail";
        Header("Location:../production/slider.php?durum=file_upload_fail");
        exit;
    }

    $query = $dbconn->prepare("INSERT INTO slider SET
		slider_name=:slider_name,
		slider_title=:slider_title,
		slider_description=:slider_description,
        slider_order=:slider_order,
        slider_is_active=:slider_is_active,
		slider_url=:slider_url
		");
    $result = $query->execute(array(
        'slider_name' => $_POST['slider_name'],
        'slider_title' => $_POST['slider_title'],
        'slider_description' => $_POST['slider_description'],
        'slider_order' => $_POST['slider_order'],
        'slider_is_active' => $_POST['slider_is_active'],
        'slider_url' => $refimgyol
    ));

    if ($result) {
        $_SESSION['status'] = "ok";
    } else {
        $_SESSION['status'] = "fail";
    }

    if ($result) {
        Header("Location:../production/slider.php?durum=ok");
        exit;
    } else {
        Header("Location:../production/slider.php?durum=no");
        exit;
    }
}
*/

/*
if (isset($_POST['slider_edit'])) {
    if ($_FILES['slider_url']["size"] > 0) {
        $uploads_dir = '../../img/slider';
        @$tmp_name = $_FILES['slider_url']["tmp_name"];
        @$name = $_FILES['slider_url']["name"];
        $benzersizsayi1 = rand(20000, 32000);
        $benzersizsayi2 = rand(20000, 32000);
        $benzersizsayi3 = rand(20000, 32000);
        $benzersizsayi4 = rand(20000, 32000);
        $benzersizad = $benzersizsayi1 . $benzersizsayi2 . $benzersizsayi3 . $benzersizsayi4;
        $refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad . $name;
        @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");

        $query = $dbconn->prepare("UPDATE slider SET
            slider_name=:slider_name,
		    slider_title=:slider_title,
		    slider_description=:slider_description,
            slider_order=:slider_order,
            slider_is_active=:slider_is_active,
	    	slider_url=:slider_url
			WHERE slider_id={$_POST['slider_id']}");
        $result = $query->execute(array(
            'slider_name' => $_POST['slider_name'],
            'slider_title' => $_POST['slider_title'],
            'slider_description' => $_POST['slider_description'],
            'slider_order' => $_POST['slider_order'],
            'slider_is_active' => $_POST['slider_is_active'],
            'slider_url' => $refimgyol
        ));

        $slider_id = $_POST['slider_id'];

        
        if ($result) {
            $_SESSION['status'] = "ok";
        } else {
            $_SESSION['status'] = "fail";
        }

        if ($result) {
            $resimunlink = $_POST['slider_url'];
            unlink("../../$resimunlink");
            Header("Location:../production/slider-edit.php?slider_id=$slider_id&durum=ok");
            exit;
        } else {
            Header("Location:../production/slider-edit.php?durum=no");
            exit;
        }
    } else {
        $query = $dbconn->prepare("UPDATE slider SET
            slider_name=:slider_name,
		    slider_title=:slider_title,
		    slider_description=:slider_description,
            slider_order=:slider_order,
            slider_is_active=:slider_is_active
			WHERE slider_id={$_POST['slider_id']}");
        $result = $query->execute(array(
            'slider_name' => $_POST['slider_name'],
            'slider_title' => $_POST['slider_title'],
            'slider_description' => $_POST['slider_description'],
            'slider_order' => $_POST['slider_order'],
            'slider_is_active' => $_POST['slider_is_active']
        ));

        $slider_id = $_POST['slider_id'];

        if ($result) {
            $_SESSION['status'] = "ok";
        } else {
            $_SESSION['status'] = "fail";
        }

        if ($result) {
            Header("Location:../production/slider-edit.php?slider_id=$slider_id&durum=ok");
            exit;
        } else {
            Header("Location:../production/slider-edit.php?durum=no");
            exit;
        }
    }
}
*/

/***********
 * BRADCAM *
 ***********/
if (isset($_POST['bradcam_product_edit'])) {
    if ($_FILES['bradcam_product_url']["size"] > 0) {
        $uploads_dir = '../../img/bradcam';
        $uploadPath = uploadFile($_FILES['bradcam_product_url'], $uploads_dir);
        if ($uploadPath === "") {
            $_SESSION['status'] = "fail";
            Header("Location:../production/bradcam.php?durum=file_upload_fail");
            exit;
        }
        $uploadPathDB = substr($uploadPath, 6);

        $query = $dbconn->prepare("UPDATE bradcam SET
            bradcam_product_title=:bradcam_product_title,
	    	bradcam_product_url=:bradcam_product_url
			WHERE bradcam_id = 1
        ");
        $result = $query->execute(array(
            'bradcam_product_title' => $_POST['bradcam_product_title'],
            'bradcam_product_url' => $uploadPathDB
        ));

        if ($result) {
            $_SESSION['status'] = "ok";
        } else {
            $_SESSION['status'] = "fail";
        }

        if ($result) {
            $resimunlink = $_POST['bradcam_product_url_str'];
            echo $resimunlink;
            unlink("../../$resimunlink");
            Header("Location:../production/bradcam.php?&durum=ok");
            exit;
        } else {
            Header("Location:../production/bradcam.php?durum=no");
            exit;
        }
    } else {
        $query = $dbconn->prepare("UPDATE bradcam SET
            bradcam_product_title=:bradcam_product_title
			WHERE bradcam_id = 1
        ");
        $result = $query->execute(array(
            'bradcam_product_title' => $_POST['bradcam_product_title']
        ));

        if ($result) {
            $_SESSION['status'] = "ok";
        } else {
            $_SESSION['status'] = "fail";
        }

        if ($result) {
            Header("Location:../production/bradcam.php?&durum=ok");
            exit;
        } else {
            Header("Location:../production/bradcam.php?durum=no");
            exit;
        }
    }
}

if (isset($_POST['bradcam_about_us_edit'])) {
    if ($_FILES['bradcam_about_us_url']["size"] > 0) {
        $uploads_dir = '../../img/bradcam';
        $uploadPath = uploadFile($_FILES['bradcam_about_us_url'], $uploads_dir);
        if ($uploadPath === "") {
            $_SESSION['status'] = "fail";
            Header("Location:../production/bradcam.php?durum=file_upload_fail");
            exit;
        }
        $uploadPathDB = substr($uploadPath, 6);

        $query = $dbconn->prepare("UPDATE bradcam SET
            bradcam_about_us_title=:bradcam_about_us_title,
	    	bradcam_about_us_url=:bradcam_about_us_url
			WHERE bradcam_id = 1
        ");
        $result = $query->execute(array(
            'bradcam_about_us_title' => $_POST['bradcam_about_us_title'],
            'bradcam_about_us_url' => $uploadPathDB
        ));

        if ($result) {
            $_SESSION['status'] = "ok";
        } else {
            $_SESSION['status'] = "fail";
        }

        if ($result) {
            $resimunlink = $_POST['bradcam_about_us_url_str'];
            echo $resimunlink;
            unlink("../../$resimunlink");
            Header("Location:../production/bradcam.php?&durum=ok");
            exit;
        } else {
            Header("Location:../production/bradcam.php?durum=no");
            exit;
        }
    } else {
        $query = $dbconn->prepare("UPDATE bradcam SET
            bradcam_about_us_title=:bradcam_about_us_title
			WHERE bradcam_id = 1
        ");
        $result = $query->execute(array(
            'bradcam_about_us_title' => $_POST['bradcam_about_us_title']
        ));

        if ($result) {
            $_SESSION['status'] = "ok";
        } else {
            $_SESSION['status'] = "fail";
        }

        if ($result) {
            Header("Location:../production/bradcam.php?&durum=ok");
            exit;
        } else {
            Header("Location:../production/bradcam.php?durum=no");
            exit;
        }
    }
}

/*********
 * OTHER *
 *********/
/*
if (isset($_POST['user_add'])) {

    echo $user_name=htmlspecialchars($_POST['user_name']); echo "<br>";
    echo $user_mail=htmlspecialchars($_POST['user_mail']); echo "<br>";

    echo $user_password1=trim($_POST['user_password1']); echo "<br>";
    echo $user_password2=trim($_POST['user_password1']); echo "<br>";

    if ($user_password1==$user_password2) {
        if (strlen($user_password1)>=6) {

            $user_query=$dbconn->prepare("select * from user where mail=:mail");
            $user_query->execute(array(
                'mail' => $user_mail
                ));

            //dönen satır sayısını belirtir
            $count=$user_query->rowCount();

            if ($say==0) {

                //md5 fonksiyonu şifreyi md5 şifreli hale getirir.
                $user_password=md5($user_password1);

                $user_level=1;

            //Kullanıcı kayıt işlemi yapılıyor...
                $user_save_query=$dbconn->prepare("INSERT INTO user SET
                    name=:name,
                    mail=:mail,
                    password=:password,
                    level=:level
                    ");
                $insert=$user_save_query->execute(array(
                    'name' => $user_name,
                    'mail' => $user_mail,
                    'password' => $user_password,
                    'level' => $user_level
                    ));

                if ($insert) {

                header("Location:../../index.php?durum=loginbasarili");

                //Header("Location:../production/genel-ayarlar.php?durum=ok");

                } else {
                    header("Location:../../register.php?durum=basarisiz");
                }
            } else {
                header("Location:../../register.php?durum=mukerrerkayit");
            }

        // Bitiş
        } else {

            header("Location:../../register.php?durum=eksiksifre");

        }

    } else {
        header("Location:../../register.php?durum=farklisifre");
    }
}
*/