<?php require_once 'header.php'; ?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Ayarları Güncelle <small> Site ayarlarını güncelleyip kaydedin</small></h2>
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
            include 'common/show-status.php'
            ?>

            <form action="../netting/process.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="setting-mail">E-mail <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="mail" name="setting_mail" value="<?php echo $setting_get['setting_mail']; ?>" required class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="setting-gsm">Site GSM numarası <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="setting_gsm" value="<?php echo $setting_get['setting_gsm']; ?>" required class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="setting-adres">Site adresi <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea name="setting_address" class="form-control col-md-7 col-xs-12"><?php echo $setting_get['setting_address']; ?></textarea>
                </div>
              </div>

              <div class="ln_solid"></div>

              <div class="form-group">
                <div align="right " class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" name="setting_save_contact" class="btn btn-success">Güncelle</button>
                </div>
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