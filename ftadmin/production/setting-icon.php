<?php require_once 'header.php'; ?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Logo Ayarları <small> Logo ayarlarını güncelleyip kaydedin</small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />

            <?php
            $sql = $dbconn->prepare("SELECT * FROM setting WHERE setting_id =:id");
            $sql->execute(
              [
                'id' => 1
              ]
            );

            $setting_get = $sql->fetch(PDO::FETCH_ASSOC);
            //echo "<pre>";
            //print_r($result);
            //echo "</pre>";
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
                  <input type="text" id="first-name" name="setting_icon_str" value="<?php echo $setting_get['setting_icon']; ?>" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-3 col-sm-3 col-xs-12"></div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <?php
                  if (strlen($setting_get['setting_icon']) > 0) { ?>
                    <img width="200" src="../../<?php echo $setting_get['setting_icon']; ?>">
                  <?php } else { ?>
                    <img width="200" src="../../img/ftdefault/no_icon.png">
                  <?php } ?>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yeni Logo Seç </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" id="first-name" name="setting_icon" class="form-control col-md-7 col-xs-12">
                </div>
              </div>


              <div class="form-group">
                <div class="col-md-3 col-sm-3 col-xs-12"></div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <label class="blinking-text col-md-12 col-sm-12 col-xs-12" for="first-name">!!! Not: 112x92 önerilir !!! </label>
                </div>
              </div>

              <div class="ln_solid"></div>

              <input type="hidden" name="setting_icon_old" value="<?php echo $setting_get['setting_icon']; ?>">

              <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" name="setting_icon_edit" class="btn btn-success">Güncelle</button>
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