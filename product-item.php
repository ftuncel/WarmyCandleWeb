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
$product_id = $_GET['product_id'];
$product_query = $dbconn->prepare("SELECT * FROM product where product_id = $product_id");
$product_query->execute();
$product_data = $product_query->fetch(PDO::FETCH_ASSOC);

$product_photo_query = $dbconn->prepare("select * from product_photo where product_id=$product_id");
$product_photo_query->execute();
?>


<div class="whole-wrap">
    <div class="container box_1170">
        <!-- Start Sample Area -->
        <section class="sample-text-area">
            <div class="container box_1170">
                <h3 class="text-heading"><?php echo $product_data['product_name'] ?></h3>
                <p class="sample-text">
                    (<?php echo getCategoryName($dbconn, $product_data['category_id']); ?> - <?php echo getSubcategoryName($dbconn, $product_data['subcategory_id']); ?>)
                </p>
                <p class="sample-text">
                    <?php echo $product_data['product_description'] ?>
                </p>

                <h3 class="mb-20">Ürünle ilgili diğer detaylar</h3>
                <div class="">
                    <ul class="unordered-list">
                        <li>Renk: <?php echo $product_data['product_color'] ?></li>
                        <li>Boyut: <?php echo $product_data['product_size'] ?></li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- End Sample Area -->

        <!-- Start Align Area -->
        <div class="section-top-border">
            <h3>Ürün Görselleri</h3>
            <div class="row gallery-item">
                <?php

                while ($product_photo_data = $product_photo_query->fetch(PDO::FETCH_ASSOC)) {
                    $fileURL = isset($product_photo_data['product_photo_url'])
                        ? getURL($product_photo_data['product_photo_url'])
                        : $DEFAULT_NO_PHOTO_URL;
                ?>
                    <script>
                        var productPhotoURL = <?php echo json_encode($product_photo_data['product_photo_url']); ?>;
                        console.info(productPhotoURL);
                    </script>
                    <div class="col-md-4">
                        <a href="<?php echo $fileURL; ?>" class="img-pop-up">
                            <div class="single-gallery-image" style="background: url('<?php echo $fileURL; ?>');"></div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php
require_once "footer.php";
?>