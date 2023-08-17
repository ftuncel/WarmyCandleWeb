<?php
include 'header.php';

$category_query = $dbconn->prepare("SELECT * FROM category where category_id=:category_id");
$category_query->execute(array(
  'category_id' => $_GET['category_id']
));
$category_data = $category_query->fetch(PDO::FETCH_ASSOC);

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Kategori Düzenleme </h2>

            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />

            <?php
            include 'common/show-status.php'
            ?>

            <div class="col-md-4 col-sm-4 col-xs-12">
              <form action="../netting/process.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori Ad </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" id="category_name" name="category_name" value="<?php echo $category_data['category_name'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>

                <input type="hidden" name="category_id" value="<?php echo $category_data['category_id'] ?>">
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div align="right" class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                    <button type="submit" name="category_edit" class="btn btn-success">Güncelle</button>
                  </div>
                </div>
              </form>
            </div>

            <div class="col-md-8 col-sm-8 col-xs-12">
              <form action="../netting/process.php" method="POST" id="demo-form2" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Photo URL</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="category_name" name="category_photo_url_str" value="<?php echo $category_data['category_photo_url'] ?>" required="required" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yüklü Logo</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <?php
                    $file_depth = "../../";
                    $fileURL = isset($category_data['category_photo_url'])
                      ? getUrlWithFileDepth($category_data['category_photo_url'], $file_depth)
                      : ($DEFAULT_NO_PHOTO_URL);
                    ?>
                    <img width="300" src="<?php echo $fileURL ?>">
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-3 col-sm-3 col-xs-12">
                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="first-name">Yeni Logo Seç</label>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="file" id="first-name" name="category_photo_url" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>

                <div class="form-group">
                <div class="col-md-3 col-sm-3 col-xs-12"></div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <label class="blinking-text col-md-12 col-sm-12 col-xs-12">!!! Not: 960x600 önerilir !!! </label>
                </div>
              </div>

                <input type="hidden" name="category_id" value="<?php echo $category_data['category_id'] ?>">
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" name="category_photo_edit" class="btn btn-success">Fotograf Güncelle</button>
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

<?php include 'footer.php'; ?>