<?php
include 'header.php';

$slider_query = $dbconn->prepare("SELECT * FROM slider order by slider_id");
$slider_query->execute();

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Slider Düzenleme Sayfası Listesi <small> Slider ayarlarını buradan yapabilirsiniz </small></h2>
            <div class="clearfix"></div>
            <div align="right">
              <a href="slider-add.php"><button class="btn btn-success btn-xs"> Yeni Ekle</button></a>
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
                  <th>Resim</th>
                  <th>Ad</th>
                  <th>* Başlık *</th>
                  <th>* Açıklama *</th>
                  <th>Sıra No</th>
                  <th>* Dosya yolu *</th>
                  <th>Durum</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>

              <tbody>

                <?php

                $count = 0;

                while ($slider_data = $slider_query->fetch(PDO::FETCH_ASSOC)) {
                  $count++;
                  $file_depth = "../../";
                  $fileURL = isset($slider_data['slider_url'])
                    ? getUrlWithFileDepth($slider_data['slider_url'], $file_depth)
                    : ($DEFAULT_NO_PHOTO_URL);
                ?>

                  <tr>
                    <td width="20"><?php echo $count ?></td>
                    <td><img width="100" src="<?php echo $fileURL ?>"></td>
                    <td><?php echo $slider_data['slider_name'] ?></td>
                    <td><?php echo $slider_data['slider_title'] ?></td>
                    <td><?php echo $slider_data['slider_description'] ?></td>
                    <td><?php echo $slider_data['slider_order'] ?></td>
                    <td><?php echo $slider_data['slider_url'] ?></td>
                    <!--                     
                    <td>
                      <center><a href="slider-galery.php?slider_id=<?php echo $slider_data['slider_id'] ?>"><button class="btn btn-success btn-xs">Resim İşlemleri</button></a></center>
                    </td> 
                    -->
                    <td>
                      <center>
                        <?php
                        if ($slider_data['slider_is_active'] == 1) { ?>
                          <button class="btn btn-success btn-xs">Aktif</button>
                        <?php } else { ?>
                          <button class="btn btn-danger btn-xs">Pasif</button>
                        <?php } ?>
                      </center>
                    </td>
                    <td>
                      <center><a href="slider-edit.php?slider_id=<?php echo $slider_data['slider_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a></center>
                    </td>
                    <td>
                      <center><a href="../netting/process.php?slider_id=<?php echo $slider_data['slider_id']; ?>&slider_delete=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center>
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