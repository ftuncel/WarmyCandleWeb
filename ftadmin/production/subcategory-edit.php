<?php
include 'header.php';

$subcategory_query = $dbconn->prepare("SELECT * FROM subcategory where subcategory_id=:subcategory_id");
$subcategory_query->execute(array(
  'subcategory_id' => $_GET['subcategory_id']
));
$subcategory_data = $subcategory_query->fetch(PDO::FETCH_ASSOC);

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Alt kategori Düzenleme </h2>

            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />

            <?php
            include 'common/show-status.php'
            ?>
            <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->
            <form action="../netting/process.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

              <!-- Kategori seçme başlangıç -->
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori<span class="required">*</span>
                </label>
                <?php
                $category_query = $dbconn->prepare("select * from category where category_id=:category_id");
                $category_query->execute(['category_id' => $subcategory_data['category_id']]);
                $category_data = $category_query->fetch(PDO::FETCH_ASSOC);
                ?>
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <input type="text" id="subcategory_name" name="subcategory_name" value="<?php echo $category_data['category_name'] ?>" required="required" class="form-control col-md-7 col-xs-12" readonly>
                </div>
              </div>

              <!-- kategori seçme bitiş -->
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori Ad <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="subcategory_name" name="subcategory_name" value="<?php echo $subcategory_data['subcategory_name'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <input type="hidden" name="subcategory_id" value="<?php echo $subcategory_data['subcategory_id'] ?>">
              <div class="ln_solid"></div>
              <div class="form-group">
                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" name="subcategory_edit" class="btn btn-success">Güncelle</button>
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