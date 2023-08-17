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
            <h2>Ürün Ekleme</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />

            <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->
            <form action="../netting/process.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
              <!-- Kategori seçme başlangıç -->
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Kategori Seç</label>
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <?php

                  //$product_id=$uruncek['category_id']; 

                  $category_query = $dbconn->prepare("select * from category");
                  $category_query->execute();

                  ?>
                  <select id="category" class="select2_multiple form-control" required="" name="category_id">
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

              <!-- Alt Kategori seçme başlangıç -->
              <!-- 
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Alt Kategori Seç<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <select class="select2_multiple form-control" required="" name="subcategory_id" id="subcategory">
                    <option value="">Alt Kategori Seçin</option>
                  </select>
                </div>
              </div>
                    -->
              <!-- Alt kategori seçme bitiş -->

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Ürün Ad</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="product_name" placeholder="Ürün adını giriniz" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <!-- Ck Editör Başlangıç 
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Ürün Detay <span class="required">*</span>
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
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Ürün açıklama</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea name="product_description" class="form-control col-md-7 col-xs-12"></textarea>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Ürün Tipi</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="product_color" placeholder="Ürün tipini giriniz" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Ürün Rengi <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="product_color" placeholder="Ürün rengini giriniz" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Ürün Boyutları <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="product_size" placeholder="Ürün boyutlarını giriniz" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Ürün Fiyat <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="product_price" placeholder="Ürün fiyat giriniz" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <!--
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Ürün Video <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="urun_video" placeholder="Ürün video giriniz" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Ürün Keyword <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="urun_keyword" placeholder="Ürün keyword giriniz" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
            -->
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Ürün Stok Miktarı<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="product_stock" placeholder="Ürün stok miktarını giriniz" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <!--
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Ürün Durum<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select id="heard" class="form-control" name="product_is_highlighted" required>
                    <option value="1" >Aktif</option>
                    <option value="0" >Pasif</option>
                  </select>
                </div>
              </div>
            -->

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Ürün Durum<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select id="heard" class="form-control" name="product_is_active" required>
                    <option value="1">Aktif</option>
                    <option value="0">Pasif</option>
                  </select>
                </div>
              </div>

              <div class="ln_solid"></div>
              <div class="form-group">
                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" name="product_add" class="btn btn-success">Kaydet</button>
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

<script>
  // Kategori seçildiğinde alt kategorileri yükle

  document.getElementById('category').addEventListener('change', function() {
    console.error('Burdayız');
    const selectedCategoryId = this.value;
    const subCategorySelect = document.getElementById('subcategory');

    // Seçilen kategoriye göre alt kategorileri yükle
    fetch(`load_subcategories.php?category_id=${selectedCategoryId}`)
      .then(response => response.json())
      .then(data => {
        subCategorySelect.innerHTML = '<option value="">Alt Kategori Seçin</option>';

        // Yüklenen alt kategorileri ekle
        data.forEach(subcategory => {
          const option = document.createElement('option');
          option.value = subcategory.subcategory_id;
          option.textContent = subcategory.subcategory_name;
          subCategorySelect.appendChild(option);
        });
      })
      .catch(error => console.error('Hata oluştu:', error));
  });
</script>
<?php include 'footer.php'; ?>