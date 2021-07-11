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
                    <th>Uang Bayar</th>
                    <th>Uang Kembali</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $query = "SELECT * FROM transaksi ORDER BY no_nota DESC";
                $dd = $db->prepare($query);
                $dd->execute();
                $no = 1;
                while($row = $dd->fetch(PDO::FETCH_ASSOC)){
                 $no_nota = $row['no_nota'];
                 $total_harga = $row['total_harga'];
                 $uang_bayar = $row['uang_bayar'];
                 $uang_kembali = $row['uang_kembali'];
            ?>
                <tr>
                    <td><?php echo $no_nota ?></td>
                    <td><?php echo $total_harga ?></td>
                    <td><?php echo $uang_bayar ?></td>
                    <td><?php echo $uang_kembali ?></td>
                    <td>
                    </td>
                </tr>
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
      <h4 class="modal-title">Tambah Transaksi</h4>
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
      </div>
      <div class="modal-body">
      <form class="mt-0" method="POST">
      <div class="form-group">
      <select name="no_nota" class="form-control mb-4">
      <option value="">Pilih Nomor Nota</option>
      <?php
        $option = "SELECT * FROM transaksi GROUP BY no_nota";
        $select = $db->prepare($option);
        $select->execute();
        while($data = $select->fetch(PDO::FETCH_ASSOC))
        {?>
          <option value="<?php echo $data['no_nota']?>"><?php echo $data['no_nota']?></option>
        <?php }
      ?>
      </select>
      </div>
      <div class="form-group">
      <select name="id_produk" class="form-control mb-4">
      <option value="">Pilih Nama Produk</option>
      <?php
        $option = "SELECT * FROM produk GROUP BY id_produk";
        $select = $db->prepare($option);
        $select->execute();
        while($data = $select->fetch(PDO::FETCH_ASSOC))
        {?>
          <option value="<?php echo $data['id_produk']?>"><?php echo $data['nama_produk']?></option>
        <?php }
      ?>
      </select>
      </div>
      <div class="form-group">
      <input type="text" name="kuantitas" class="form-control mb-4" maxlength = "10" size = "10"id="" placeholder="Kuantitas">
      </div>
      <div class="form-group">
      <input type="text" name="sub_total" class="form-control mb-4" maxlength = "10" size = "10" id="" placeholder="Sub Total"></input>
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