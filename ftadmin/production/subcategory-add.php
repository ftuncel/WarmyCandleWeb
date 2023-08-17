<?php

include 'header.php';

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Kategori Ekleme</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />

            <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->
            <form action="../netting/process.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
              

              <!-- Kategori seçme başlangıç -->
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori Seç<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <?php

                  //$product_id=$uruncek['category_id']; 

                  $category_query = $dbconn->prepare("select * from category");
                  $category_query->execute();

                  ?>
                  <select class="select2_multiple form-control" required="" name="category_id">
                    <?php
                    while ($category_data = $category_query->fetch(PDO::FETCH_ASSOC)) {
                      $category_id = $category_data['category_id'];
                    ?>
                      <option value="<?php echo $category_data['category_id']; ?>"><?php echo $category_data['category_name']; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <!-- kategori seçme bitiş -->
              

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Alt kategori Ad<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="subcategory_name" name="subcategory_name" placeholder="Alt kategori adını giriniz" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="ln_solid"></div>
              <div class="form-group">
                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" name="subcategory_add" class="btn btn-success">Kaydet</button>
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