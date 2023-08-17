<?php
$setting_about_query = $dbconn->prepare("SELECT * FROM setting_about WHERE setting_about_id = 1");
$setting_about_query->execute();
$setting_about_data = $setting_about_query->fetch(PDO::FETCH_ASSOC);

if (isset($setting_about_data['setting_about_photo1_url'])) {
    $sa_p1_url = $setting_about_data['setting_about_photo1_url'];
}

if (isset($setting_about_data['setting_about_photo2_url'])) {
    $sa_p2_url = $setting_about_data['setting_about_photo2_url'];
}

?>

<!-- about_area_start -->
<div class="about_area">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-5">
                <div class="about_info">
                    <div class="section_title mb-20px">
                        <span>Hakkımızda</span>
                        <h3>
                            <?php
                            if (isset($setting_about_data['setting_about_title'])) {
                                echo $setting_about_data['setting_about_title'];
                            } else {
                                $default_setting_about_title = "Işıltılı mumlar en doğal haliyle";
                                echo $default_setting_about_title;
                            }
                            ?>
                        </h3>
                    </div>
                    <p>
                        <?php
                        if (isset($setting_about_data['setting_about_detail'])) {
                            echo $setting_about_data['setting_about_detail'];
                        } else {
                            $default_setting_about_detail = "Mum Dünyası olarak, tutkumuz mumlar ve ışığın büyüsüdür. El emeği ve özenle tasarlanmış yüksek kaliteli mumlar sunuyoruz. Estetik tasarımlarımızla evlerinizi sıcaklık ve güzellikle doldurmayı hedefliyoruz. Müşteri memnuniyeti bizim için önceliklidir ve size en iyi deneyimi sunmak için buradayız. Mumlarımızın ışığıyla özel anlarınıza romantik bir atmosfer katın. Güvenilir ve kaliteli mumlarla dolu bir dünyada sizleri ağırlamaktan mutluluk duyarız.";
                            echo $default_setting_about_detail;
                        }
                        ?>
                    </p>
                </div>
            </div>
            <div class="col-xl-7 col-lg-7">
                <div class="about_thumb d-flex">
                    <div class="img_1">
                        <img src="<?php echo $sa_p1_url; ?>" alt="mum resim">
                    </div>
                    <div class="img_2">
                        <img src="<?php echo $sa_p2_url; ?>" alt="mum resim">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- about_area_end -->