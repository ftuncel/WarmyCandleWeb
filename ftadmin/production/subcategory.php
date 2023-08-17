<?php
include 'header.php';

$subcategory_query = $dbconn->prepare("SELECT * FROM subcategory order by subcategory_id");
$subcategory_query->execute();

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Alt kategori Listesi <small> Alt kategorileri güncelleyip kaydedin</small></h2>
            <div class="clearfix"></div>
            <div align="right">
              <a href="subcategory-add.php"><button class="btn btn-success btn-xs"> Yeni Ekle</button></a>
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
                  <th>Alt Kategori Adı</th>
                  <th>Kategori Adı</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>

              <tbody>

                <?php

                $count = 0;

                while ($subcategory_data = $subcategory_query->fetch(PDO::FETCH_ASSOC)) {
                  $count++;

                  $category_name = getCategoryName($dbconn, $subcategory_data['category_id']);
                ?>

                  <tr>
                    <td><?php echo $subcategory_data['subcategory_id'] ?></td>
                    <td><?php echo $subcategory_data['subcategory_name'] ?></td>
                    <td><?php echo $category_name ?></td>

                    <td>
                      <center><a href="subcategory-edit.php?subcategory_id=<?php echo $subcategory_data['subcategory_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a></center>
                    </td>
                    <td>
                      <center><a href="../netting/process.php?subcategory_id=<?php echo $subcategory_data['subcategory_id']; ?>&category_delete=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center>
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