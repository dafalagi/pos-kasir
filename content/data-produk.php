<?php 
$success_msg = "";
$error_msg = "";

if(isset($_POST['hapus_data'])){

    $id_produk = filter_input(INPUT_POST, 'id_produk', FILTER_SANITIZE_STRING);

    $sql = "DELETE FROM produk
            WHERE id_produk = :id_produk";
  
    $stmt = $db->prepare($sql);
  
    // bind parameter ke query
    $params = array(
        ":id_produk" => $id_produk
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

    $nama_produk = filter_input(INPUT_POST, 'nama_produk', FILTER_SANITIZE_STRING);
    $desc_produk = filter_input(INPUT_POST, 'desc_produk', FILTER_SANITIZE_STRING);
    $stok = filter_input(INPUT_POST, 'stok', FILTER_SANITIZE_STRING);
    $harga = filter_input(INPUT_POST, 'harga', FILTER_SANITIZE_STRING);
    $id_kategori = filter_input(INPUT_POST, 'id_kategori', FILTER_SANITIZE_STRING);
  
    $sql = "INSERT INTO produk (nama_produk, desc_produk, stok, harga, id_kategori) 
            VALUES (:nama_produk, :desc_produk, :stok, :harga, :id_kategori)";
  
    $stmt = $db->prepare($sql);
  
    // bind parameter ke query
    $params = array(
        ":nama_produk" => $nama_produk,
        ":desc_produk" => $desc_produk,
        ":stok" => $stok,
        ":harga" => $harga,
        ":id_kategori" => $id_kategori
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

    $id_produk_lama = filter_input(INPUT_POST, 'id_produk_lama', FILTER_SANITIZE_STRING);
    $id_produk_baru = filter_input(INPUT_POST, 'id_produk_baru', FILTER_SANITIZE_STRING);
    $nama_produk = filter_input(INPUT_POST, 'nama_produk', FILTER_SANITIZE_STRING);
    $desc_produk = filter_input(INPUT_POST, 'desc_produk', FILTER_SANITIZE_STRING);
    $stok = filter_input(INPUT_POST, 'stok', FILTER_SANITIZE_STRING);
    $harga = filter_input(INPUT_POST, 'harga', FILTER_SANITIZE_STRING);
  
    $sql = "UPDATE produk
            SET id_produk = :id_produk_baru, nama_produk = :nama_produk, desc_produk = :desc_produk,
            stok = :stok, harga = :harga 
            WHERE id_produk = :id_produk_lama";
  
    $stmt = $db->prepare($sql);
  
    // bind parameter ke query
    $params = array(
        ":id_produk_baru" => $id_produk_baru,
        ":id_produk_lama" => $id_produk_lama,
        ":nama_produk" => $nama_produk,
        ":desc_produk" => $desc_produk,
        ":stok" => $stok,
        ":harga" => $harga
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
        Tambah Data Produk
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
                    <th>ID Produk</th>
                    <th>Nama Produk</th>
                    <th>Deskripsi Produk</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Id Kategori</th>
                    <th class="no-content"></>
                </tr>
            </thead>
            <tbody>
            <?php
                $query = "SELECT * FROM produk ORDER BY id_produk DESC";
                $dd = $db->prepare($query);
                $dd->execute();
                $no = 1;
                while($row = $dd->fetch(PDO::FETCH_ASSOC)){
                 $id_produk = $row['id_produk'];
                 $nama_produk = $row['nama_produk'];
                 $desc_produk = $row['desc_produk'];
                 $stok = $row['stok'];
                 $harga = $row['harga'];
                 $id_kategori = $row['id_kategori'];
            ?>
                <tr>
                    <td><?php echo $id_produk ?></td>
                    <td><?php echo $nama_produk ?></td>
                    <td><?php echo $desc_produk ?></td>
                    <td><?php echo $stok ?></td>
                    <td><?php echo $harga ?></td>
                    <td><?php echo $id_kategori ?></td>
                    <td>
                    <div class="row">
                    <button type="button" class="btn btn-dark mb-2 mr-2 rounded-circle" data-toggle="modal" data-target="#edit-produk-<?php echo $id_produk; ?>">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg> 
                    </button>
                    
                    <form method=POST>
                      <input type="hidden" name="id_produk" value="<?php echo $id_produk; ?>"></input>
                      <button type="submit" name="hapus_data" class="btn btn-dark mb-2 mr-2 rounded-circle" onclick="return confirm('Are you sure you want to do that?');">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle table-cancel"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                      </button>
                    </form>
                    </div>
                    </td>
                </tr>
                <!--- MODAL EDIT -->                                
                <div class="modal fade" id="edit-produk-<?php echo $id_produk; ?>" tabindex="-1" role="dialog" aria-labelledby="edit-produk<?php echo $id_produk; ?>" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header" id="loginModalLabel">
                            <h4 class="modal-title">Edit Produk <?php echo $id_produk; ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                          </div>
                          <div class="modal-body">
                            <form class="mt-0" method="POST">
                              <div class="form-group">
                                <input type="hidden" name="id_produk_lama"value="<?php echo $id_produk; ?>">
                                <input type="text" name="id_produk_baru" class="form-control mb-2" maxlength = "10" size = "10" value="<?php echo $id_produk; ?>" placeholder="<?php echo $id_produk; ?>" required>
                              </div>
                              <div class="form-group">
                                <input type="text" name="nama_produk" class="form-control mb-2" maxlength = "50" size = "50" value="<?php echo $nama_produk; ?>" placeholder="<?php echo $nama_produk; ?>" required>
                              </div>
                              <div class="form-group">
                                <textarea type="text" name="desc_produk" class="form-control mb-2" maxlength = "100" size = "100" placeholder="<?php echo $desc_produk; ?>" required><?php echo $desc_produk; ?></textarea>
                              </div>
                              <div class="form-group">
                                <input type="text" name="stok" class="form-control mb-2" maxlength = "5" size = "5" value="<?php echo $stok; ?>" placeholder="<?php echo $stok; ?>" required>
                              </div>
                              <div class="form-group">
                                <input type="text" name="harga" class="form-control mb-2" maxlength = "10" size = "10"  value="<?php echo $harga; ?>" placeholder="<?php echo $harga; ?>" required>
                              </div>
                              <div class="form-group">
                              <input type="text" name="id_kategori" class="form-control mb-4" maxlength = "4" size = "4" value="<?php echo $id_kategori?>" placeholder="<?php echo $id_kategori?>" required>
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

<!--- MODAL TAMBAH -->                                
<div class="modal fade bd-example-modal-lg" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" id="loginModalLabel">
      <h4 class="modal-title">Tambah Produk</h4>
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
      </div>
      <div class="modal-body">
      <form class="mt-0" method="POST">
      <div class="form-group">
      <input type="text" name="nama_produk" class="form-control mb-4" maxlength = "50" size = "50" id="" placeholder="Nama Produk"></input>
      </div>
      <div class="form-group">
      <textarea type="text" name="desc_produk" class="form-control mb-4" maxlength = "100" size = "100"id="" placeholder="Dekripsi Produk"></textarea>
      </div>
      <div class="form-group">
      <input type="text" name="stok" class="form-control mb-4" maxlength = "5" size = "5" id="" placeholder="Stok Barang"></input>
      </div>
      <div class="form-group">
      <input type="text" name="harga" class="form-control mb-4" maxlength = "10" size = "10" id="" placeholder="Harga Barang"></input>
      </div>
      <div class="form-group">
      <select name="id_kategori" class="form-control mb-4">
      <option value="">Pilih Nama Kategori</option>
      <?php
        $option = "SELECT * FROM kategori_produk GROUP BY id_kategori";
        $select = $db->prepare($option);
        $select->execute();
        while($data = $select->fetch(PDO::FETCH_ASSOC))
        {?>
          <option value="<?php echo $data['id_kategori']?>"><?php echo $data['nama_kategori']?></option>
        <?php }
      ?>
      </select>
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
