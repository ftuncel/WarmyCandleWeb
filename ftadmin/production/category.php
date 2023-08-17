<?php
include 'header.php';

$category_query = $dbconn->prepare("SELECT * FROM category order by category_id");
$category_query->execute();

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Kategori Listesi <small> Kategorileri güncelleyip kaydedin</small></h2>
            <div class="clearfix"></div>
            <div align="right">
              <a href="category-add.php"><button class="btn btn-success btn-xs"> Yeni Ekle</button></a>
            </div>
          </div>
          <div class="x_content">
            <br />

            <!-- status  -->
            <?php include 'common/show-status.php' ?>
            <!-- status  -->

            <!-- Div İçerik Başlangıç -->

            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Resim</th>
                  <th>Ad</th>
                  <th>Alt Kategory Sayısı</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>

              <tbody>

                <?php

                $count = 0;

                while ($category_data = $category_query->fetch(PDO::FETCH_ASSOC)) {
                  $count++;

                  $file_depth = "../../";
                  $fileURL = isset($category_data['category_photo_url'])
                    ? getUrlWithFileDepth($category_data['category_photo_url'], $file_depth)
                    : ($file_depth.$DEFAULT_NO_PHOTO_URL);
                ?>

                  <tr>
                    <td><?php echo $category_data['category_id'] ?></td>
                    <td><img width="100" src="<?php echo $fileURL ?>"></td>
                    <td><?php echo $category_data['category_name'] ?></td>
                    <?php
                    $subcategoryCount = getCountOfSubcategory($dbconn, $category_data['category_id'])
                    ?>
                    <td><?php echo $subcategoryCount; ?></td>

                    <td>
                      <center><a href="category-edit.php?category_id=<?php echo $category_data['category_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a></center>
                    </td>
                    <td>
                      <center><a href="../netting/process.php?category_id=<?php echo $category_data['category_id']; ?>&category_delete=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            <!-- Div İçerik Bitişi -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->

<?php include 'footer.php'; ?>