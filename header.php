<?php
ob_start();
session_start();
require_once 'ftadmin/netting/dbconnect.php';
require_once 'ftadmin/netting/function.php';

$setting_query = $dbconn->prepare("SELECT * FROM setting where setting_id=:setting_id");
$setting_query->execute(array(
    'setting_id' => 1
));
$setting_data = $setting_query->fetch(PDO::FETCH_ASSOC);

// echo "<pre>";
// print_r($setting_data);
// echo "</pre>";
// exit;
?>

<!doctype html>
<html class="no-js" lang="tr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $setting_data['setting_title'] ?></title>
    <meta name="description" content="<?php echo $setting_data['setting_description'] ?>">
    <meta name="keywords" content="<?php echo $setting_data['setting_keywords'] ?>">
    <meta name="author" content="<?php echo $setting_data['setting_author'] ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $setting_data['setting_icon'] ?>">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/gijgo.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/slicknav.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <!-- header-start -->
    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid p-0">
                    <div class="row align-items-center no-gutters">
                        <div class="col-xl-5 col-lg-6">
                            <div class="main-menu  d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a <?php if ($currentPage === 'index.php') echo 'class="active"'; ?> href="index.php">Ana Sayfa</a></li>
                                        <li><a <?php if ($currentPage === 'catalog.php') echo 'class="active"'; ?> href="catalog.php">Ürünler</a></li>
                                        <li><a <?php if ($currentPage === 'about-us.php') echo 'class="active"'; ?> href="about-us.php">Hakkımızda</a></li>
                                        <!--
                                        <li><a href="#">blog <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                <li><a href="blog.html">blog</a></li>
                                                <li><a href="single-blog.html">single-blog</a></li>
                                            </ul>
                                        </li>
                                    
                                        <li><a href="#">pages <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                <li><a href="elements.html">elements</a></li>
                                            </ul>
                                        </li>
                                    
                                        <li><a href="contact.html">İletişim</a></li>
                                        -->
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2">
                            <div class="logo-img">
                                <a href="index.php">
                                    <?php if ($setting_data['setting_icon'] != "") { ?>
                                        <img src="<?php echo $setting_data['setting_icon'] ?>" alt="" width="100" height="100">
                                    <?php  } else { ?>
                                        <img src="img/ftdefault/ft_icon.png" alt="" width="100" height="100">
                                    <?php  } ?>

                                </a>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-4 d-none d-lg-block">
                            <div class="book_room">
                                <div class="socail_links">
                                    <ul>
                                        <li>
                                            <a href="<?php echo $setting_data['setting_facebook'] ?>">
                                                <i class="fa fa-facebook-square"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $setting_data['setting_twitter'] ?>">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $setting_data['setting_instagram'] ?>">
                                                <i class="fa fa-instagram"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!--                                 
                                <div class="book_btn d-none d-lg-block">
                                    <a class="popup-with-form" href="#test-form">Giriş & Kayıt Ol</a>
                                </div> 
                                -->
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->