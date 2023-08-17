<?php
include 'header.php';

$product_query = $dbconn->prepare("SELECT * FROM product where product_id=:product_id");
$product_query->execute(array(
  'product_id' => $_GET['product_id']
));
$product_data = $product_query->fetch(PDO::FETCH_ASSOC);

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Ürün Düzenleme </h2>

            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />

            <?php
            include 'common/show-status.php'
            ?>
            <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->
            <form action="../netting/process.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Ad <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="product_name" value="<?php echo $product_data['product_name'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="" name="" value="<?php echo getCategoryName($dbconn, $product_data['category_id']); ?>" required="required" class="form-control col-md-7 col-xs-12" readonly>
                </div>
              </div>

              <!-- alt Kategori seçme başlangıç -->
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori Seç<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <?php
                  $product_category_id = $product_data['category_id'];
                  $product_subcategory_id = $product_data['subcategory_id'];

                  $subcategory_query = $dbconn->prepare("select * from subcategory where category_id = $product_category_id");
                  $subcategory_query->execute();
                  ?>
                  <select class="select2_multiple form-control" required="" name="subcategory_id">
                    <?php
                    while ($subcategory_data = $subcategory_query->fetch(PDO::FETCH_ASSOC)) {
                      $subcategory_id = $subcategory_data['subcategory_id'];
                    ?>
                      <option <?php
                              if ($product_subcategory_id == $subcategory_id) {
                                echo "selected='select'";
                              }
                              ?> value="<?php echo $subcategory_data['subcategory_id']; ?>">
                        <?php echo $subcategory_data['subcategory_name']; ?>
                      </option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <!-- alt kategori seçme bitiş -->
              <!-- Ck Editör Başlangıç 
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Detay <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">

                    <textarea  class="ckeditor" id="editor1" name="product_description"></textarea>
                  </div>
                </div>

                <script type="text/javascript">
                 CKEDITOR.replace( 'editor1',
                 {
                  filebrowserBrowseUrl : 'ckfinder/ckfinder.html',
                  filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',
                  filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',
                  filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                  filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                  filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                  forcePasteAsPlainText: true
                } 
                );
              </script>
            -->
              <!-- Ck Editör Bitiş -->

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün açıklama</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea name="product_description" class="form-control col-md-7 col-xs-12"><?php echo $product_data['product_description'] ?></textarea>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Tipi</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="product_type" value="<?php echo $product_data['product_type'] ?>" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Renk</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="product_color" value="<?php echo $product_data['product_color'] ?>" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Boyut</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="product_size" value="<?php echo $product_data['product_size'] ?>" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Fiyat</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="product_price" value="<?php echo $product_data['product_price'] ?>" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Stok</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="number" id="first-name" name="product_stock" value="<?php echo $product_data['product_stock'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Durum</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select id="heard" class="form-control" name="product_is_active" required>
                    <!-- Kısa İf Kulllanımı 
                    <?php echo $product_data['product_is_active'] == '1' ? 'selected=""' : ''; ?>
                    -->
                    <option value="1" <?php echo $product_data['product_is_active'] == '1' ? 'selected=""' : ''; ?>>Aktif</option>
                    <option value="0" <?php if ($product_data['product_is_active'] == 0) {
                                        echo 'selected=""';
                                      } ?>>Pasif</option>
                  </select>
                </div>
              </div>
              <input type="hidden" name="product_id" value="<?php echo $product_data['product_id'] ?>">
              <div class="ln_solid"></div>
              <div class="form-group">
                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" name="product_edit" class="btn btn-success">Güncelle</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>



    <hr>
    <hr>
    <hr>



  </div>
</div>
<!-- /page content -->

<?php include 'footer.php'; ?>