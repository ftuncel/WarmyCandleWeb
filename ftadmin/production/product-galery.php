<?php

include 'header.php';

?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">


    </div>

    <div class="col-md-12">
      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

          <form action="" method="POST">
            <div class="input-group">
              <input type="text" class="form-control" name="aranan" placeholder="Anahtar Kelime Giriniz...">
              <span class="input-group-btn">
                <button class="btn btn-default" type="submit" name="arama">Ara!</button>
              </span>
            </div>
          </form>
        </div>
      </div>
    </div>


    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <div align="left" class="col-md-6">
                <h2>Ürün Fotoğraf İşlemleri</h2>
                <br>
              </div>
              <form action="../netting/process.php" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="product_id" value="<?php echo $_GET['product_id']; ?>">

                <div align="right" class="col-md-6">
                  <button type="submit" name="product_photo_delete" class="btn btn-danger "><i class="fa fa-trash" aria-hidden="true"></i> Seçilenleri Sil</button>
                  <a class="btn btn-success" href="product-photo-add.php?product_id=<?php echo $_GET['product_id']; ?>"><i class="fa fa-plus" aria-hidden="true"></i> Ürün Fotoğraf Yükle</a>
                </div>
                <div class="clearfix"></div>
            </div>


            <div class="x_content">


              <?php

              /*
              $count_per_page = 25; // sayfada gösterilecek içerik miktarını belirtiyoruz.

              $query = $dbconn->prepare("select * from product_photo");
              $query->execute();
              $total_photo_count = $query->rowCount();

              $total_page = ceil($total_photo_count / $count_per_page);

              // eğer sayfa girilmemişse 1 varsayalım.
              $page = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;

              // eğer 1'den küçük bir sayfa sayısı girildiyse 1 yapalım.
              if ($page < 1) $page = 1;

              // toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayalım.
              if ($page > $total_page) $page = $total_page;

              $limit = ($page - 1) * $count_per_page;

              $product_photo_query = $dbconn->prepare("select * from product_photo where product_id=:product_id order by product_photo_id DESC limit $limit,$count_per_page");
              */
              $product_photo_query = $dbconn->prepare("select * from product_photo where product_id=:product_id");
              $product_photo_query->execute(array(
                'product_id' => $_GET['product_id']
              ));

              while ($product_photo_data = $product_photo_query->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="col-md-55">
                  <label>
                    <div class="image view view-first">
                      <img style="width: 250px; height: 100px; display: block;" src="../../<?php echo $product_photo_data['product_photo_url']; ?>" alt="image" />
                      <div class="mask">
                        <p><?php echo $product_photo_data['product_photo_url']; ?> <?php echo $product_photo_data['product_photo_id']; ?></p>
                        <div class="tools tools-bottom">
                          <!--<a href="#"><i class="fa fa-times"></i></a>-->
                        </div>
                      </div>
                    </div>
                    <?php $product_photo_select = array(); ?>
                    <input type="checkbox" name="product_photo_select[]" value="<?php echo $product_photo_data['product_photo_id']; ?>"> Seç
                  </label>
                </div>
              <?php } ?>

              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
<!-- /page content -->



<?php include 'footer.php'; ?>