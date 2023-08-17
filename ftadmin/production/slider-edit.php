<?php

include 'header.php';

$slider_query = $dbconn->prepare("SELECT * FROM slider where slider_id=:slider_id");
$slider_query->execute(array(
  'slider_id' => $_GET['slider_id']
));

$slider_data = $slider_query->fetch(PDO::FETCH_ASSOC);
?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Slider Düzenle <small> Slider düzenleyip kaydedin </small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />

            <!-- status  -->
            <?php include 'common/show-status.php' ?>
            <!-- status  -->

            <form action="../netting/process.php" method="POST" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yüklü Resim</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="bradcam_about_us_url_str" value="<?php echo $slider_data['slider_url']; ?>" class="form-control col-md-7 col-xs-12" readonly>
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-3 col-sm-3 col-xs-12"> </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <img width="300" src="../../<?php echo $slider_data['slider_url']; ?>">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Slider Resim (1920x850) <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" id="first-name" name="slider_url" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-3 col-sm-3 col-xs-12"></div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <label class="blinking-text col-md-12 col-sm-12 col-xs-12">!!! Not: 1920x850 önerilir !!! </label>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Slider Ad <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="slider_name" required="required" value="<?php echo $slider_data['slider_name'] ?>" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Slider Başlık <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="slider_title" required="required" value="<?php echo $slider_data['slider_title'] ?>" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Slider İçerik <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="slider_description" required="required" value="<?php echo $slider_data['slider_description'] ?>" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Slider Sıra <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="slider_order" required="required" value="<?php echo $slider_data['slider_order'] ?>" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Slider Durum<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select id="heard" class="form-control" name="slider_is_active" required>
                    <option value="1" <?php echo $slider_data['slider_is_active'] == 1 ? 'selected=""' : ''; ?>>Aktif</option>
                    <option value="0" <?php echo $slider_data['slider_is_active'] == 0 ? 'selected=""' : ''; ?>>Pasif</option>
                  </select>
                </div>
              </div>

              <input type="hidden" name="slider_id" value="<?php echo $slider_data['slider_id'] ?>">
              <input type="hidden" name="slider_url" value="<?php echo $slider_data['slider_url'] ?>">

              <div class="ln_solid"></div>

              <div class="form-group">
                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" name="slider_edit" class="btn btn-success">Güncelle</button>
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

<?php include 'footer.php'; ?>