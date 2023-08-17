<?php
$category_query = $dbconn->prepare("SELECT * FROM category");
$category_query->execute();
?>
<!-- features_room_startt -->
<div class="features_room">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section_title text-center mb-100">
                    <!-- <span>Featured Rooms</span> -->
                    <h3>Kategoriler</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="rooms_here">
        <?php
        while ($category_data = $category_query->fetch(PDO::FETCH_ASSOC)) {
            $fileURL = isset($category_data['category_photo_url'])
                ? getURL($category_data['category_photo_url'])
                : $DEFAULT_NO_PHOTO_URL;
        ?>
            <div class="single_rooms">
                <div class="room_thumb">
                    <img src="<?php echo getURL($fileURL) ?>" alt="">
                    <div class="room_heading d-flex justify-content-between align-items-center">
                        <div class="room_heading_inner">
                            <h3><?php echo $category_data['category_name'] ?></h3>
                        </div>
                        <a href="category.php?category_id=<?php echo $category_data['category_id'] ?>" class="line-button">Ürünler</a>
                    </div>
                </div>
            </div>
        <?php } ?>
        <!--
        <div class="single_rooms">
            <div class="room_thumb">
                <img src="img/rooms/1.png" alt="">
                <div class="room_heading d-flex justify-content-between align-items-center">
                    <div class="room_heading_inner">
                        <span>From $250/night</span>
                        <h3>Superior Room</h3>
                    </div>
                    <a href="#" class="line-button">book now</a>
                </div>
            </div>
        </div>
        -->
    </div>
</div>
<!-- features_room_end -->