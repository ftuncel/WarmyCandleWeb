    <?php
    $setting_about_query = $dbconn->prepare("SELECT * FROM setting_about WHERE setting_about_id = 1");
    $setting_about_query->execute();
    $setting_about_data = $setting_about_query->fetch(PDO::FETCH_ASSOC);
    
    $video_title = $setting_about_data['setting_about_video_title'];
    $video_detail = $setting_about_data['setting_about_video_detail'];
    $video_bg_url = $setting_about_data['setting_about_video_photo_url'];
    $video_link = $setting_about_data['setting_about_video_link'];

    ?>


    <!-- video_area_start -->
    <div class="video_area video_bg overlay" style="background-image: url('<?php echo $video_bg_url; ?>');">
        <div class="video_area_inner text-center">
            <span><?php echo $video_title; ?></span>
            <h3><?php echo $video_detail; ?> </h3>
            <a href="<?php echo $video_link; ?>" class="video_btn popup-video">
                <i class="fa fa-play"></i>
            </a>
        </div>
    </div>
    <!-- video_area_end -->