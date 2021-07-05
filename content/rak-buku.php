<?php 
$success_msg = "";
$error_msg = "";
$breadcum = "Data rak buku";

if(isset($_POST['submitdelete'])){

  $delete_rak_buku = filter_input(INPUT_POST, 'delete_rak_buku', FILTER_SANITIZE_STRING);

  $sql = "DELETE FROM rak_buku
          WHERE id_rak_buku = :id_rak_buku";

  $stmt = $db->prepare($sql);

  // bind parameter ke query
  $params = array(
      ":id_rak_buku" => $delete_rak_buku
  );

  // eksekusi query untuk menyimpan ke database
  $saved = $stmt->execute($params);
  if($saved) {
    $success_msg = "Data berhasil dihapus";
  } else {
    $error_msg = "Data tidak berhasil dihapus";
  }
}

if(isset($_POST['tambahdatarak'])){
  
  $id_rak_buku = filter_input(INPUT_POST, 'idrakbuku', FILTER_SANITIZE_STRING);
  $jenis_buku = filter_input(INPUT_POST, 'jenisbuku', FILTER_SANITIZE_STRING);

  $sql = "INSERT INTO rak_buku (id_rak_buku,jenis_buku) 
          VALUES (:id_rak_buku, :jenis_buku)";

  $stmt = $db->prepare($sql);

  // bind parameter ke query
  $params = array(
      ":id_rak_buku" => $id_rak_buku,
      ":jenis_buku" => $jenis_buku
  );

  // eksekusi query untuk menyimpan ke database
  $saved = $stmt->execute($params);
  if($saved) {
    $success_msg = "Data berhasil ditambahkan";
  } else {
    $error_msg = "Data tidak berhasil ditambahkan";
  }
}

if(isset($_POST['editdatarak'])){

  $id_rak_buku_lama = filter_input(INPUT_POST, 'idrakbukulama', FILTER_SANITIZE_STRING);
  $id_rak_buku_baru = filter_input(INPUT_POST, 'idrakbukubaru', FILTER_SANITIZE_STRING);
  $jenis_buku_baru = filter_input(INPUT_POST, 'jenisbukubaru', FILTER_SANITIZE_STRING);

  $sql = "UPDATE rak_buku
          SET id_rak_buku = :id_rak_buku_baru, jenis_buku = :jenis_buku_baru
          WHERE id_rak_buku = :id_rak_buku_lama";

  $stmt = $db->prepare($sql);

  // bind parameter ke query
  $params = array(
      ":id_rak_buku_baru" => $id_rak_buku_baru,
      ":jenis_buku_baru" => $jenis_buku_baru,
      ":id_rak_buku_lama" => $id_rak_buku_lama
  );

  // eksekusi query untuk menyimpan ke database
  $saved = $stmt->execute($params);
  if($saved) {
    $success_msg = "Data berhasil ditambahkan";
  } else {
    $error_msg = "Data tidak berhasil ditambahkan";
  }
}

?>
    
    <?php include("layouts/components/breadcum.php"); ?>

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
        <div class="text-right">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
            Tambah Data Rak Buku
          </button>
        </div>
        <br>
        <?php if (!empty($success_msg)) { ?>
          <div class="callout callout-success">
            <h4>SUCCESS !</h4>

            <p><?php echo $success_msg; ?></p>
          </div>
        <?php } ?>

        <?php if (!empty($error_msg)) { ?>
          <div class="callout callout-danger">
            <h4>ERROR !</h4>

            <p><?php echo $success_msg; ?></p>
          </div>
        <?php } ?>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Rak buku perputakaan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID Rak</th>
                  <th>Jenis Buku</th>
                  <th>Tindakan</th>
                </tr>
                </thead>
                
                <tbody>
                <?php

                    $query_data_rak = "SELECT * FROM rak_buku ORDER BY id_rak_buku DESC";
                    $dd = $db->prepare($query_data_rak);
                    $dd->execute();
                    $no = 1;
                    while($row = $dd->fetch(PDO::FETCH_ASSOC)){
                     $id_rak_buku = $row['id_rak_buku'];
                     $jenis_buku = $row['jenis_buku'];
                ?>
                <tr>
                  <td><?php echo $id_rak_buku; ?></td>
                  <td><?php echo $jenis_buku; ?></td>
                  <td>
                  <!--
                    <form method=POST>
                      <input type="hidden" name="delete_rak_buku" value="<?php echo $id_rak_buku;?>">
                      <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to do that?');" name="submitdelete" ><i class="fa fa-trash"></i> Hapus</button>
                    </form>
                  -->
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-edit-<?php echo $id_rak_buku; ?>">
                      Edit Data Rak Buku
                    </button>

                    <div class="modal fade" id="modal-edit-<?php echo $id_rak_buku; ?>">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Edit data rak buku</h4>
                          </div>
                          <form method="POST">
                          <div class="modal-body">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="idrakbukubaru">ID Rak Buku</label>
                                <input type="text" name="idrakbukubaru" class="form-control" id="idrakbukubaru" placeholder="<?php echo $id_rak_buku; ?>" required>
                              </div>

                              <div class="form-group">
                                <label for="jenisbukubaru">Jenis Rak Buku</label>
                                <input type="text" name="jenisbukubaru" class="form-control" id="jenisbukubaru" placeholder="<?php echo $jenis_buku; ?>" required>
                              </div>
                              <input type="hidden" name="idrakbukulama" value="<?php echo $id_rak_buku;?>">
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" name="editdatarak" class="btn btn-primary">Submit</button>
                          </div>
                          </form>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                  </td>
                </tr>
                <?php } ?>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah data rak buku</h4>
              </div>
              <form method="POST">
              <div class="modal-body">
                <div class="box-body">
                  <div class="form-group">
                    <label for="idrakbuku">ID Rak Buku</label>
                    <input type="text" name="idrakbuku" class="form-control" id="idrakbuku" placeholder="Ex: M001" required>
                  </div>
                  <div class="form-group">
                    <label for="jenisbuku">Jenis Rak Buku</label>
                    <input type="text" name="jenisbuku" class="form-control" id="jenisbuku" placeholder="Ex: Manajemen Bisnis" required>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" name="tambahdatarak" class="btn btn-primary">Submit</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->