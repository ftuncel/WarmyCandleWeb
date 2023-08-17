<?php
include 'header.php';

$setting_about_query = $dbconn->prepare("SELECT * FROM setting_about WHERE setting_about_id = 1");
$setting_about_query->execute();
$setting_about_data = $setting_about_query->fetch(PDO::FETCH_ASSOC);

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Hakkında Düzenleme Sayfası Listesi <small> Hakkında ayarlarını buradan yapabilirsiniz </small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />

            <!-- status  -->
            <?php include 'common/show-status.php' ?>
            <!-- status  -->

            <form action="../netting/process.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Başlık</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="setting_about_title" value="<?php echo $setting_about_data['setting_about_title']; ?>" required class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Detay</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea class="form-control col-md-7 col-xs-12" required name="setting_about_detail"><?php echo $setting_about_data['setting_about_detail']; ?></textarea>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Resim 1</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="" value="<?php echo $setting_about_data['setting_about_photo1_url']; ?>" required class="form-control col-md-7 col-xs-12" readonly>
                  <?php
                  if (strlen($setting_about_data['setting_about_photo1_url']) > 0) { ?>
                    <img width="200" src="../../<?php echo $setting_about_data['setting_about_photo1_url']; ?>">
                  <?php } else { ?>
                    <img width="200" src="../../img/ftdefault/no_icon.png">
                  <?php } ?>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <button type="submit" name="go_to_about_photo1_page" class="btn btn-primary">Resim1 Düzenle</button>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Resim 2</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="" value="<?php echo $setting_about_data['setting_about_photo2_url']; ?>" required class="form-control col-md-7 col-xs-12" readonly>
                  <?php
                  if (strlen($setting_about_data['setting_about_photo2_url']) > 0) { ?>
                    <img width="200" src="../../<?php echo $setting_about_data['setting_about_photo2_url']; ?>">
                  <?php } else { ?>
                    <img width="200" src="../../img/ftdefault/no_icon.png">
                  <?php } ?>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <button type="submit" name="go_to_about_photo2_page" class="btn btn-primary">Resim2 Düzenle</button>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" >Video Başlığı</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="setting_about_video_title" value="<?php echo $setting_about_data['setting_about_video_title']; ?>" required class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Video Detayı</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="setting_about_video_detail" value="<?php echo $setting_about_data['setting_about_video_detail']; ?>" required class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Video Afiş Resmi</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="" value="<?php echo $setting_about_data['setting_about_video_photo_url']; ?>" required class="form-control col-md-7 col-xs-12" readonly>
                  <?php
                  if (strlen($setting_about_data['setting_about_video_photo_url']) > 0) { ?>
                    <img width="200" src="../../<?php echo $setting_about_data['setting_about_video_photo_url']; ?>">
                  <?php } else { ?>
                    <img width="200" src="../../img/ftdefault/no_icon.png">
                  <?php } ?>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <button type="submit" name="go_to_about_video_photo_page" class="btn btn-primary">Video Afiş Düzenle</button>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Video Linki</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="setting_about_video_link" value="<?php echo $setting_about_data['setting_about_video_link']; ?>" required class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="ln_solid"></div>

              <div class="form-group">
                <div align="right " class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" name="setting_about_save_all" class="btn btn-success">Güncelle</button>
                </div>
              </div>

            </form>

            <!-- Div İçerik Bitişi -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->

<?php include 'footer.php'; ?>