<?php
include 'header.php';

$product_query = $dbconn->prepare("SELECT * FROM product order by product_id");
$product_query->execute();

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Ürünler Listesi <small> Ürünleri güncelleyip kaydedin </small></h2>
            <div class="clearfix"></div>
            <div align="right">
              <a href="product-add.php"><button class="btn btn-success btn-xs"> Yeni Ekle</button></a>
            </div>
          </div>
          <div class="x_content">
            <br />

            <!-- status  -->
            <?php include 'common/show-status.php' ?>
            <!-- status  -->

            <!-- Div İçerik Başlangıç -->
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Kategori</th>
                  <th>Alt Kategori</th>
                  <th>Ad</th>
                  <th>Renk</th>
                  <th>Boyut</th>
                  <th>Fiyat</th>
                  <th>Miktar</th>
                  <th>Resim İşlemleri</th>
                  <th>Öne Çıkar</th>
                  <th>Durum</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>

              <tbody>

                <?php

                $count = 0;

                while ($product_data = $product_query->fetch(PDO::FETCH_ASSOC)) {
                  global $DEFAULT_SUBCATEGORY_NAME;
                  $count++;

                  $category_name = getCategoryName($dbconn, $product_data['category_id']);
                  $subcategory_name = isset($product_data['subcategory_id'])
                    ? getSubcategoryName($dbconn, $product_data['subcategory_id'])
                    : $DEFAULT_SUBCATEGORY_NAME;
                  $num_photos = getCountOfProductPhoto($dbconn, $product_data['product_id']);
                  $photo_button_type = "btn-success";
                  if ($num_photos == 0) {
                    $photo_button_type = "btn-warning";
                  }
                ?>

                  <tr>
                    <td width="20"><?php echo $count ?></td>
                    <td><?php echo $category_name ?></td>
                    <td><?php echo getSubcategoryName($dbconn, $product_data['subcategory_id']); ?></td>
                    <td><?php echo $product_data['product_name'] ?></td>
                    <td><?php echo $product_data['product_color'] ?></td>
                    <td><?php echo $product_data['product_size'] ?></td>
                    <td><?php echo $product_data['product_price'] ?> ₺</td>
                    <td><?php echo $product_data['product_stock'] ?></td>
                    <td>
                      <center><a href="product-galery.php?product_id=<?php echo $product_data['product_id'] ?>"><button class="btn <?php echo $photo_button_type; ?> btn-xs">Resim İşlemleri (<?php echo $num_photos; ?>)</button></a></center>
                    </td>

                    <td>
                      <center>
                        <?php
                        $is_highlight = $product_data['product_is_highlight'];
                        if ( $is_highlight == 0) { ?>
                          <a href="../netting/process.php?product_id=<?php echo $product_data['product_id'] ?>&product_is_highlight=1&product_highlight=ok"><button class="btn btn-warning btn-xs">Ön Çıkar</button></a>
                        <?php } elseif ( $is_highlight == 1) { ?>
                          <a href="../netting/process.php?product_id=<?php echo $product_data['product_id'] ?>&product_is_highlight=0&product_highlight=ok"><button class="btn btn-success btn-xs">Öne çıkarıldı</button></a>
                        <?php } ?>
                      </center>
                    </td>
                    <td>
                      <center>
                        <?php
                        if ($product_data['product_is_active'] == 1) { ?>
                          <button class="btn btn-success btn-xs">Aktif</button>
                        <?php } else { ?>
                          <button class="btn btn-danger btn-xs">Pasif</button>
                        <?php } ?>
                      </center>
                    </td>
                    <td>
                      <center><a href="product-edit.php?product_id=<?php echo $product_data['product_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a></center>
                    </td>
                    <td>
                      <?php if ($num_photos == 0) { ?>
                        <center><a href="../netting/process.php?product_id=<?php echo $product_data['product_id']; ?>&product_delete=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center>
                      <?php } ?>
                    </td>
                  </tr>
                <?php  }
                ?>
              </tbody>
            </table>

            <!-- Div İçerik Bitişi -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->

<?php include 'footer.php'; ?>