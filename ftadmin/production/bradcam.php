<?php require_once 'header.php'; ?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Bradcam Ayarlarını Güncelle <small> Bradcam ayarlarını güncelleyip kaydedin</small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />

            <?php
            $bradcam_query = $dbconn->prepare("SELECT * FROM bradcam WHERE bradcam_id =:id");
            $bradcam_query->execute(
              [
                'id' => 1
              ]
            );

            $bradcam_data = $bradcam_query->fetch(PDO::FETCH_ASSOC);
            //echo "<pre>";
            //print_r($bradcam_data);
            //echo "</pre>";
            ?>

            <?php
            include 'common/show-status.php'
            ?>

            <div class="col-md-6 col-sm-12 col-xs-12">
              <form action="../netting/process.php" method="POST" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">

                <div class="form-group">
                  <div align="center">
                    <label class="col-md-12 col-sm-12 col-xs-12" for="first-name">Ürün Brodcam </label>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Başlık </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="bradcam_product_title" value="<?php echo $bradcam_data['bradcam_product_title']; ?>" required class="form-control col-md-7 col-xs-12">
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yüklü Resim</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="first-name" name="bradcam_product_url_str" value="<?php echo $bradcam_data['bradcam_product_url']; ?>" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-3 col-sm-3 col-xs-12"></div>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <?php
                    if (strlen($bradcam_data['bradcam_product_url']) > 0) { ?>
                      <img width="300" src="../../<?php echo $bradcam_data['bradcam_product_url']; ?>">
                    <?php } else { ?>
                      <img width="300" src="../../img/ftdefault/no_icon.png">
                    <?php } ?>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yeni resim<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="file" id="first-name" name="bradcam_product_url" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-3 col-sm-6 col-xs-12"></div>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <label class="blinking-text col-md-12 col-sm-12 col-xs-12" for="first-name">!!! Not: 1920x500 önerilir !!! </label>
                  </div>
                </div>

                <div class="ln_solid"></div>

                <div class="form-group">
                  <div align="right " class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" name="bradcam_product_edit" class="btn btn-success">Güncelle</button>
                  </div>
                </div>

              </form>
            </div>





            <div class="col-md-6 col-sm-12 col-xs-12">
              <form action="../netting/process.php" method="POST" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                <div class="form-group">
                  <div align="center">
                    <label class="col-md-12 col-sm-12 col-xs-12">Hakkımızda Brodcam</label>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Başlık </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="bradcam_about_us_title" value="<?php echo $bradcam_data['bradcam_about_us_title']; ?>" required class="form-control col-md-7 col-xs-12">
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yüklü Resim</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="first-name" name="bradcam_about_us_url_str" value="<?php echo $bradcam_data['bradcam_about_us_url']; ?>" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>
                
                <div class="form-group">
                  <div class="col-md-3 col-sm-3 col-xs-12"></div>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <?php
                    if (strlen($bradcam_data['bradcam_about_us_url']) > 0) { ?>
                      <img width="300" src="../../<?php echo $bradcam_data['bradcam_about_us_url']; ?>">
                    <?php } else { ?>
                      <img width="300" src="../../img/ftdefault/no_icon.png">
                    <?php } ?>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yeni resim<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="file" id="first-name" name="bradcam_about_us_url" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-3 col-sm-6 col-xs-12"></div>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <label class="blinking-text col-md-12 col-sm-12 col-xs-12" for="first-name">!!! Not: 1920x500 önerilir !!! </label>
                  </div>
                </div>

                <div class="ln_solid"></div>

                <div class="form-group">
                  <div align="right " class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" name="bradcam_about_us_edit" class="btn btn-success">Güncelle</button>
                  </div>
                </div>

              </form>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->

<?php require_once 'footer.php'; ?>