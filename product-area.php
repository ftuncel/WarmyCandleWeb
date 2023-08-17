    <!-- offers_area_start -->
    <div class="offers_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section_title text-center mb-100">
                        </br />
                        <span>Bu kategorideki ürünler</span>
                        <!-- <h3>Bu kategorideki ürünler</h3> -->
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                $category_id = $_GET['category_id'];
                $product_query = $dbconn->prepare("SELECT * FROM product WHERE product_is_active = '1' and category_id= $category_id");
                $product_query->execute();

                while ($product_data = $product_query->fetch(PDO::FETCH_ASSOC)) {

                    $product_photo_query = $dbconn->prepare("select * from product_photo where product_id=:product_id LIMIT 1");
                    $product_photo_query->execute(array(
                        'product_id' => $product_data['product_id']
                    ));
                    $product_photo_data = $product_photo_query->fetch(PDO::FETCH_ASSOC);

                    $fileURL = isset($product_photo_data['product_photo_url'])
                        ? getURL($product_photo_data['product_photo_url'])
                        : $DEFAULT_NO_PHOTO_URL;
                ?>
                    <div class="col-xl-4 col-md-4">
                        <div class="single_offers">
                            <div class="about_thumb">
                                <img src="<?php echo $fileURL ?>" alt="">
                            </div>
                            <h3> <?php echo $product_data['product_name']; ?> </h3>
                            <a href="product-item.php?product_id=<?php echo $product_data['product_id'] ?>" class="book_now">Ürüne git</a>
                            <p> <?php echo $product_data['product_description']; ?> </p>
                            <p></p>
                        </div>
                    </div>

                <?php } ?>

            </div>
        </div>
    </div>
    <!-- offers_area_end -->