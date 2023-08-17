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

            <form action="../netting/process.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Site logo url</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="setting_icon" value="<?php echo $setting_get['setting_icon']; ?>" required class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Site başlığı</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="setting_title" value="<?php echo $setting_get['setting_title']; ?>" required class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="setting-description">Site açıklama</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea class="form-control col-md-7 col-xs-12" required name="setting_description"><?php echo $setting_get['setting_description']; ?></textarea>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="setting-description">Site anahtar kelimeler</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea class="form-control col-md-7 col-xs-12" required name="setting_keywords"><?php echo $setting_get['setting_keywords']; ?></textarea>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="setting-description">Hakkımızda başlık</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="setting_about_title" value="<?php echo $setting_get['setting_about_title']; ?>" required class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="setting-about_description">Hakkımızda açıklama</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea class="form-control col-md-7 col-xs-12" required name="setting_about_title"><?php echo $setting_get['setting_about_detail']; ?></textarea>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="setting-author">Yazar</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="setting_author" value="<?php echo $setting_get['setting_author']; ?>" required class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="setting-mail">E-mail</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="mail" name="setting_mail" value="<?php echo $setting_get['setting_mail']; ?>" required class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="setting-gsm">Site GSM numarası</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="setting_gsm" value="<?php echo $setting_get['setting_gsm']; ?>" required class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="setting-adres">Site adresi</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea name="setting_address" class="form-control col-md-7 col-xs-12"><?php echo $setting_get['setting_address']; ?></textarea>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="setting-maps">Konum bilgisi</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="setting_maps" value="<?php echo $setting_get['setting_maps']; ?>" required class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="setting-facebook">Facebook hesap</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="setting_facebook" value="<?php echo $setting_get['setting_facebook']; ?>" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="setting-twitter">Twitter hesap</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="setting_twitter" value="<?php echo $setting_get['setting_twitter']; ?>" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="setting-youtube">YouTube kanalı</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="setting_youtube" value="<?php echo $setting_get['setting_youtube']; ?>" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="setting-instagram">Instagram kanalı</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="setting_instagram" value="<?php echo $setting_get['setting_instagram']; ?>" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="setting-smtphost">SMTP sunucusu</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="setting_smtphost" value="<?php echo $setting_get['setting_smtphost']; ?>" required class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="setting-smtpuser">SMTP kullanıcı adı</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="setting_smtpuser" value="<?php echo $setting_get['setting_smtpuser']; ?>" required class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="setting-smtppassword">SMTP şifresi</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="password" name="setting_smtppassword" value="<?php echo $setting_get['setting_smtppassword']; ?>" required class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="setting-smtpport">SMTP portu</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="setting_smtpport" value="<?php echo $setting_get['setting_smtpport']; ?>" required class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="setting-maintanance">Bakım modu</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select name="setting_maintanance" class="form-control col-md-7 col-xs-12">
                    <option value="0" <?php echo ($setting_get['setting_maintanance'] === '0') ? 'selected' : ''; ?>>Kapalı</option>
                    <option value="1" <?php echo ($setting_get['setting_maintanance'] === '1') ? 'selected' : ''; ?>>Açık</option>
                  </select>
                </div>
              </div>

              <div class="ln_solid"></div>

              <div class="form-group">
                <div align="right " class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" name="setting_save_all" class="btn btn-success">Güncelle</button>
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