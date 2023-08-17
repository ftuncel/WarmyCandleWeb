<?php require_once 'header.php'; ?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Resim Ayarları <small> Resim ayarlarını güncelleyip kaydedin</small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />

            <?php
            $setting_about_query = $dbconn->prepare("SELECT * FROM setting_about WHERE setting_about_id = 1");
            $setting_about_query->execute();
            $setting_about_data = $setting_about_query->fetch(PDO::FETCH_ASSOC);
            ?>

            <?php
            if (isset($_SESSION['status']) && $_SESSION['status'] == 'ok') { ?>

              <div class="alert alert-success">
                <p> Güncelleme başarılı </p>
              </div>

            <?php

            } else if (isset($_SESSION['status']) && $_SESSION['status'] == 'fail') { ?>

              <div class="alert alert-danger">
                <p> Güncelleme başarısız ! </p>
              </div>

            <?php }
            unset($_SESSION['status']);
            ?>

            <form action="../netting/process.php" method="POST" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yüklü Logo</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="setting_about_photo1_url_old" value="<?php echo $setting_about_data['setting_about_photo1_url']; ?>" class="form-control col-md-7 col-xs-12" readonly>
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-3 col-sm-3 col-xs-12"> </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <?php
                  if (strlen($setting_about_data['setting_about_photo1_url']) > 0) { ?>
                    <img width="300" src="../../<?php echo $setting_about_data['setting_about_photo1_url']; ?>">
                  <?php } else { ?>
                    <img width="300" src="../../img/ftdefault/no_icon.png">
                  <?php } ?>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yeni Resim Seç </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" id="first-name" name="setting_about_photo1_url" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-3 col-sm-3 col-xs-12"></div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <label class="blinking-text col-md-12 col-sm-12 col-xs-12" for="first-name">!!! Not: 300x400 önerilir !!! </label>
                </div>
              </div>

              <div class="ln_solid"></div>

              <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" name="setting_about_photo1_edit" class="btn btn-success">Güncelle</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->

<?php require_once 'footer.php'; ?>