<?php 
$success_msg = "";
$error_msg = "";

if(isset($_POST['hapus_data'])){

    $no_nota = filter_input(INPUT_POST, 'no_nota', FILTER_SANITIZE_STRING);

    $sql = "DELETE FROM detail_transaksi
            WHERE no_nota = :no_nota";
  
    $stmt = $db->prepare($sql);
  
    // bind parameter ke query
    $params = array(
        ":no_nota" => $no_nota
    );
  
    // eksekusi query untuk menyimpan ke database
    $saved = $stmt->execute($params);
    if($saved) {
      $success_msg = "Data berhasil dihapus";
    } else {
      $error_msg = "Data tidak berhasil dihapus";
    }

}

if(isset($_POST['tambah_data'])){

    $no_nota = filter_input(INPUT_POST, 'no_nota', FILTER_SANITIZE_STRING);
    $id_produk = filter_input(INPUT_POST, 'id_produk', FILTER_SANITIZE_STRING);
    $kuantitas = filter_input(INPUT_POST, 'kuantitas', FILTER_SANITIZE_STRING);
    $sub_total = filter_input(INPUT_POST, 'sub_total', FILTER_SANITIZE_STRING);
  
    $sql = "INSERT INTO detail_transaksi (no_nota, id_produk, kuantitas, sub_total) 
            VALUES (:no_nota, :id_produk, :kuantitas, :sub_total)";
  
    $stmt = $db->prepare($sql);
  
    // bind parameter ke query
    $params = array(
        ":no_nota" => $no_nota,
        ":id_produk" => $id_produk,
        ":kuantitas" => $kuantitas,
        ":sub_total" => $sub_total
    );
  
    // eksekusi query untuk menyimpan ke database
    $saved = $stmt->execute($params);
    if($saved) {
      $success_msg = "Data berhasil ditambahkan";
    } else {
      $error_msg = "Data tidak berhasil ditambahkan";
    }

}

if(isset($_POST['edit_data'])){

  $no_nota_lama = filter_input(INPUT_POST, 'no_nota_lama', FILTER_SANITIZE_STRING);
  $no_nota_baru = filter_input(INPUT_POST, 'no_nota_baru', FILTER_SANITIZE_STRING);
  $id_produk = filter_input(INPUT_POST, 'id_produk', FILTER_SANITIZE_STRING);
  $kuantitas = filter_input(INPUT_POST, 'kuantitas', FILTER_SANITIZE_STRING);
  $sub_total = filter_input(INPUT_POST, 'sub_total', FILTER_SANITIZE_STRING);

  $sql = "UPDATE detail_transaksi
          SET no_nota = :no_nota_baru, id_produk = :id_produk, kuantitas = :kuantitas,
          sub_total = :sub_total
          WHERE no_nota = :no_nota_lama";

  $stmt = $db->prepare($sql);

  // bind parameter ke query
  $params = array(
      ":no_nota_baru" => $no_nota_baru,
      ":no_nota_lama" => $no_nota_lama,
      ":id_produk" => $id_produk,
      ":kuantitas" => $kuantitas,
      ":sub_total" => $sub_total
  );

  // eksekusi query untuk menyimpan ke database
  $saved = $stmt->execute($params);
  if($saved) {
    $success_msg = "Data berhasil diubah";
  } else {
    $error_msg = "Data tidak berhasil diubah";
  }

}

?>
<html>
<br>


<div class="widget-content widget-content-area br-6">    
    <div>
      <button type="button" class="btn btn-primary mb-2 mr-2" data-toggle="modal" data-target="#loginModal">
        Tambah Data Transaksi
      </button>
    </div>
    <div class="table-responsive mb-4 mt-4">
    <?php if (!empty($success_msg)) { ?>
      <div class="alert alert-gradient" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
        <strong>SUCCESS!</strong> <?php echo $success_msg; ?>. </button>
      </div> 
    <?php } ?>
                        
    <?php if (!empty($error_msg)) { ?>
      <div class="alert alert-gradient" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
        <strong>ERROR!</strong> <?php echo $error_msg; ?>. </button>
      </div> 
    <?php } ?>
        <table id="zero-config" class="table table-hover" style="width:100%">
            <thead>
                <tr>
                    <th>Nomor Nota</th>
                    <th>Total Harga</th>
                    <th>Tanggal Transaksi</th>
                    <th>ID Pegawai</th>
                    <th class="no-content"></>
                </tr>
            </thead>
            <tbody>
            <?php
                $query = "SELECT * FROM kategori_produk ORDER BY id_kategori DESC";
                $dd = $db->prepare($query);
                $dd->execute();
                $no = 1;
                while($row = $dd->fetch(PDO::FETCH_ASSOC)){
                 $id_kategori = $row['id_kategori'];
                 $nama_kategori = $row['nama_kategori'];
            ?>
                <tr>
                    <td><?php echo $id_kategori ?></td>
                    <td><?php echo $nama_kategori ?></td>
                    <td>
                    <div class="row">
                    <button type="button" class="btn btn-dark mb-2 mr-2 rounded-circle" data-toggle="modal" data-target="#edit-kategori-<?php echo $id_kategori; ?>">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg> 
                    </button>
                    
                    <form method=POST>
                      <input type="hidden" name="no_nota" value="<?php echo $id_kategori; ?>"></input>
                      <button type="submit" name="hapus_data" class="btn btn-dark mb-2 mr-2 rounded-circle" onclick="return confirm('Are you sure you want to do that?');">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle table-cancel"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                      </button>
                    </form>
                    </div>
                    </td>
                </tr>
                <!--- MODAL EDIT KATEGORI -->                                
                <div class="modal fade" id="edit-kategori-<?php echo $id_kategori; ?>" tabindex="-1" role="dialog" aria-labelledby="edit-kategori<?php echo $id_kategori; ?>" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header" id="loginModalLabel">
                            <h4 class="modal-title">Edit Transaksi <?php echo $id_kategori; ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                          </div>
                          <div class="modal-body">
                            <form class="mt-0" method="POST">
                              <div class="form-group">
                                <input type="hidden" name="no_nota_lama"value="<?php echo $id_kategori; ?>">
                                <input type="text" name="no_nota_baru" class="form-control mb-2" maxlength = "10" size = "10" value="<?php echo $id_kategori; ?>" placeholder="<?php echo $id_kategori; ?>" required></input>
                              </div>
                              <div class="form-group">
                                <input type="text" name="total_harga" class="form-control mb-2" maxlength = "15" size = "15" value="<?php echo $id_kategori; ?>" placeholder="<?php echo $id_kategori; ?>" required></input>
                              </div>
                              <div class="form-group">
                                <input type="text" name="tgl_transaksi" class="form-control mb-2" maxlength = "10" size = "10" value="<?php echo $id_kategori; ?>" placeholder="<?php echo $id_kategori; ?>" required></input>
                              </div>
                              <div class="form-group">
                                <input type="text" name="id_pegawai" class="form-control mb-2" maxlength = "10" size = "10" value="<?php echo $id_kategori; ?>" placeholder="<?php echo $id_kategori; ?>" required></input>
                              </div>

                              <div class="form-group text-right">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                <button type="submit" name="edit_data" class="btn btn-success">Kirim</button>
                              </>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!--- MODAL TAMBAH KATEGORI -->                                
<div class="modal fade bd-example-modal-lg" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" id="loginModalLabel">
      <h4 class="modal-title">Tambah Pegawai</h4>
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
      </div>
      <div class="modal-body">
      <form class="mt-0" method="POST">
      <div class="form-group">
      <input type="text" name="no_nota" class="form-control mb-2" maxlength = "10" size = "10" id="" placeholder="Nomor Nota"></input>
      </div>
      <div class="form-group">
      <input type="text" name="total_harga" class="form-control mb-4" maxlength = "15" size = "15" id="" placeholder="Total Harga"></input>
      </div>
      <div class="form-group">
      <textarea type="text" name="tgl_transaksi" class="form-control mb-4" maxlength = "10" size = "10"id="" placeholder="Tanggal Transaksi"></textarea>
      </div>
      <div class="form-group">
      <input type="text" name="id_pegawai" class="form-control mb-4" maxlength = "10" size = "10" id="" placeholder="Id Pegawai"></input>
      </div>
      
      <div class="form-group text-right">
      <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
      <button type="submit" name="tambah_data" class="btn btn-success">Kirim</button>
      </div>
      </form>
      </div>
    </div>
  </div>
</div>
</html>