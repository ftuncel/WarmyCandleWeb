    <!-- slider_area_start -->
    <!-- 

"Sıcak Yansımalar"
"Alevli Dokunuşlar"
"Işık Dansı"
"Huzur Kaynağı"
"Romantik Alevler"
"Sakin Işıltılar"
"Rahatlatıcı Yanıklar"
"Yaratıcı Alevler"
"Sıcaklık Hikayesi"
"Ortam Aydınlatıcılar"


"Sıcak Alevli Dokunuşlar, Atmosferi Değiştirir"
"Mum Işığıyla Anın Büyüsünü Yakala"
"Ruhunu Aydınlatan Mumlar, Huzuru Getirir"
"Mumun Büyüsüne Kapıl, Sıcaklığı Hisset"
"Sıcacık Işığın Yaratıcılığını Alevlendir"
"Mumlarla Yarat, Ortamı Sarmala"
"Mum Işığıyla Aşkı Yakala, Romantiği Yaşat"
"Sakinliği Mum Işığıyla Keşfet"
"Sıcaklık Veren Mumlar, Huzur Sunar"
"Mumlarla Aydınlanan Anlar, Özel Kılar"
-->
    <div class="slider_area">
        <div class="slider_active owl-carousel">

            <?php
            ob_start();
            
            $db_slider_count = 0;

            $slider_query = $dbconn->prepare("SELECT * FROM slider WHERE slider_is_active = :slider_is_active order by slider_order");
            $slider_query->execute(array(
                'slider_is_active' => 1
            ));

            while ($slider_data = $slider_query->fetch(PDO::FETCH_ASSOC)) {
                $backgroundImage = $slider_data['slider_url'];
                $title = $slider_data['slider_title'];
                $description = $slider_data['slider_description'];
                generateSlider($backgroundImage, $title, $description);
                $db_slider_count = $db_slider_count + 1;
            }

            if (!$db_slider_count){
                // static context
                $backgroundImage = "img/ftdefault/ft_slider1.png";
                $title = "Işık Dansı";
                $description = "Sakinliği Mum Işığıyla Keşfet";
                generateSlider($backgroundImage, $title, $description);

                $backgroundImage = "img/ftdefault/ft_slider2.png";
                $title = "Sıcak Yansımalar";
                $description = "Mum Işığıyla Anın Büyüsünü Yakala";
                generateSlider($backgroundImage, $title, $description);
            }
            ?>
        </div>
    </div>
    <!-- slider_area_end -->