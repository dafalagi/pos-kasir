<?php 
$success_msg = "";
$error_msg = "";

if(isset($_POST['delete_cart'])){

    $id_produk = filter_input(INPUT_POST, 'id_produk', FILTER_SANITIZE_STRING);

    $sql = "DELETE FROM cart
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


if(isset($_POST['trx_add'])){
  $total_harga = filter_input(INPUT_POST, 'total_harga', FILTER_SANITIZE_STRING);
  $uang_bayar = filter_input(INPUT_POST, 'uang_bayar', FILTER_SANITIZE_STRING);
  $uang_kembali = filter_input(INPUT_POST, 'uang_kembali', FILTER_SANITIZE_STRING);
  $tgl_transaksi = filter_input(INPUT_POST, 'tgl_transaksi', FILTER_SANITIZE_STRING);

  $sql = "INSERT INTO transaksi (total_harga, uang_bayar, uang_kembali, tgl_transaksi, id_pegawai) 
          VALUES (:total_harga, :uang_bayar, :uang_kembali, :tgl_transaksi, :id_pegawai)";

  $stmt = $db->prepare($sql);

  $params = array(
    ":total_harga" => $total_harga,
    ":uang_bayar" => $uang_bayar,
    ":uang_kembali" => $uang_kembali,
    ":tgl_transaksi" => $tgl_transaksi,
    ":id_pegawai" => $_SESSION["user"]["id_pegawai"]
  );

  $saved = $stmt->execute($params);

  $sqld = "SELECT * FROM transaksi ORDER BY no_nota DESC LIMIT 1";

  $stmtf = $db->prepare($sqld);

  $sd = $stmtf->execute();

  $trx = $stmtf->fetch(PDO::FETCH_ASSOC);

  $query = "SELECT * FROM cart ORDER BY id_cart DESC";
  $dd = $db->prepare($query);
  $dd->execute();
  $no = 1;
  while($row = $dd->fetch(PDO::FETCH_ASSOC)){
   $id_produks = $row['id_produk'];
   $jumlahs = $row['jumlah'];

   $sql = "INSERT INTO detail_transaksi (no_nota, id_produk, kuantitas) 
            VALUES (:no_nota, :id_produk, :kuantitas)";

   $sql77 = "SELECT stok 
   FROM produk 
   WHERE id_produk=".$id_produks;
   
   $stmt25 = $db->prepare($sql77);
     
   
   $stmt25->execute();

   $stokss = $stmt25->fetch(PDO::FETCH_ASSOC);
  
   $sql7 = "UPDATE produk 
   SET stok= :data_stok_baru
   WHERE id_produk=".$id_produks;
 
   $stmt25 = $db->prepare($sql7);
     
   $params = array(
    ":data_stok_baru" => $stokss["stok"] - $jumlahs,
   );

   $stmt25->execute($params);

   $stmt2 = $db->prepare($sql);
     
   $params = array(
    ":no_nota" => $trx["no_nota"],
    ":id_produk" => $id_produks,
    ":kuantitas" => $jumlahs
   );

   $stmt2->execute($params);

   

  }

  

  $sql2 = "DELETE FROM cart";

  $stm2 = $db->prepare($sql2);

  $go = $stm2->execute();

  if($saved) {
    $success_msg = "Data berhasil ditambahkan ke transaksi";
  } else {
    $error_msg = "Data tidak berhasil ditambahkan";
  }

}

if(isset($_POST['tambah_cart'])){
    
    $id_produk = filter_input(INPUT_POST, 'id_produk', FILTER_SANITIZE_STRING);
    
    $sql = "SELECT * FROM cart WHERE id_produk = :id_produk AND id_cart = :id_cart";

    $stmt = $db->prepare($sql);

    $params = array(
      ":id_cart" => $_SESSION["user"]["id_pegawai"],
      ":id_produk" => $id_produk
    );

    $saved = $stmt->execute($params);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row > 0) {
        $sql = "UPDATE cart 
                SET jumlah= :jumlah
                WHERE id_produk= :id_produk AND id_cart= :id_cart";
      
        $stmt = $db->prepare($sql);

        $params = array(
          ":id_cart" => $_SESSION["user"]["id_pegawai"],
          ":id_produk" => $id_produk,
          ":jumlah" => ($row["jumlah"] + 1)
        );

        $saved = $stmt->execute($params);

    } else {
  
        $sql = "INSERT INTO cart (id_cart, id_produk, jumlah) 
                VALUES (:id_cart, :id_produk, :jumlah)";

        $stmt = $db->prepare($sql);

        // bind parameter ke query
        $params = array(
            ":id_cart" => $_SESSION["user"]["id_pegawai"],
            ":id_produk" => $id_produk,
            ":jumlah" => 1
        );
    }
    // eksekusi query untuk menyimpan ke database
    $saved = $stmt->execute($params);
    if($saved) {
      $success_msg = "Data berhasil ditambahkan ke keranjang";
    } else {
      $error_msg = "Data tidak berhasil ditambahkan";
    }

}

if(isset($_POST['edit_data'])){
    
    $no_nota_lama = filter_input(INPUT_POST, 'no_nota_lama', FILTER_SANITIZE_STRING);
    $no_nota_baru = filter_input(INPUT_POST, 'no_nota_baru', FILTER_SANITIZE_STRING);
    $total_harga = filter_input(INPUT_POST, 'total_harga', FILTER_SANITIZE_STRING);
    $tgl_transaksi = filter_input(INPUT_POST, 'tgl_transaksi', FILTER_SANITIZE_STRING);
    $id_pegawai = filter_input(INPUT_POST, 'id_pegawai', FILTER_SANITIZE_STRING);
  
    $sql = "UPDATE transaksi
            SET no_nota = :no_nota_baru, total_harga = :total_harga, tgl_transaksi = :tgl_transaksi,
            id_pegawai = :id_pegawai
            WHERE no_nota = :no_nota_lama";
  
    $stmt = $db->prepare($sql);
  
    // bind parameter ke query
    $params = array(
        ":no_nota_baru" => $no_nota_baru,
        ":no_nota_lama" => $no_nota_lama,
        ":total_harga" => $total_harga,
        ":tgl_transaksi" => $tgl_transaksi,
        ":id_pegawai" => $id_pegawai
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
<br>

<div class="row layout-top-spacing" id="cancel-row">
  
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
  <div class="col-md-12">
  <div class="widget-content widget-content-area br-6">    
    <div class="widget-heading">
      <h5>Pencarian Produk</h5>
    </div>
      <div class="table-responsive mb-4 mt-4">
        <table id="zero-config" class="table table-hover" style="width:100%">
            <thead>
                <tr>
                    <th>ID Produk</th>
                    <th>Nama Produk</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Id Kategori</th>
                    <th>Action</th>
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
                    <td><?php echo $stok ?></td>
                    <td><?php echo $harga ?></td>
                    <td><?php echo $id_kategori ?></td>
                    <td>
                    <form method=POST>
                      <input type="hidden" name="id_produk" value="<?php echo $id_produk; ?>"></input>
                      <button type="submit" name="tambah_cart" class="btn btn-dark mb-2 mr-2 rounded-circle">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                      </button>
                    </form>
                    </td>
                </tr>
            </tbody>
            <?php } ?>
        </table>
      </div>
    </div>       
  </div>           
</div>
<br>
<div class="widget-content widget-content-area br-6">    
    <div class="widget-heading">
      <h5>Data keranjang</h5>
    </div>
      <div class="table-responsive mb-4 mt-4">
        <table id="zero-cart" class="table table-hover" style="width:100%">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>ID Produk</th>
                    <th>Jumlah</th>
                    <th>Sub Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $query = "SELECT id_cart, a.id_produk, nama_produk, jumlah, (a.harga*b.jumlah) AS sub_total
                          FROM produk a INNER JOIN cart b 
                          ON a.id_produk = b.id_produk
                          WHERE id_cart = ".$_SESSION["user"]["id_pegawai"]." ORDER BY id_cart DESC";
                $dd = $db->prepare($query);
                $dd->execute();
                $no = 0;
                while($row = $dd->fetch(PDO::FETCH_ASSOC)){
                 $no++;
                 $id_produk = $row['id_produk'];
                 $nama_produk = $row['nama_produk'];
                 $jumlah = $row['jumlah'];
                 $sub_total = $row['sub_total'];
            ?>
                <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $nama_produk ?></td>
                    <td><?php echo $jumlah ?></td>
                    <td><?php echo $sub_total ?></td>
                    <td>
                    <form method=POST>
                      <input type="hidden" name="id_produk" value="<?php echo $id_produk; ?>"></input>
                      <button type="submit" name="delete_cart" class="btn btn-dark mb-2 mr-2 rounded-circle" onclick="return confirm('Are you sure you want to do that?');">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                      </button>
                    </form>
                    </td>
                </tr>
            </tbody>
            <?php } ?>
        </table>
      </div>
      <form method="POST">
         <div class="form-row mb-4">
               <?php 
                 $query = "SELECT SUM((a.harga*b.jumlah)) AS total_harga
                           FROM produk a INNER JOIN cart b 
                           ON a.id_produk = b.id_produk
                           WHERE id_cart = ".$_SESSION["user"]["id_pegawai"];
                 $dd = $db->prepare($query);
                 $dd->execute();
                 $no = 0;
                 $tot = $dd->fetch(PDO::FETCH_ASSOC);
                 $total = $tot['total_harga'];
               ?>
               <div class="form-group col-md-6">
                   <label>Total Harga</label>
                   <input type="number" name="total_harga" id="total_harga" class="form-control" value="<?php echo $total ?>" readonly>
               </div>
               <div class="form-group col-md-6">
                   <label>Total Bayar</label>
                   <input type="number" name="uang_bayar" id="uang_bayar" class="form-control" >
               </div>
               <div class="form-group col-md-6">
                   <label>Total Kembalian</label>
                   <input type="text" name="uang_kembali" id="uang_kembali" class="form-control" readonly>
               </div>
               <div class="form-group col-md-6">
                   <label>Tanggal Pemesanan</label>
                   <input type="text" name="tgl_transaksi"  value="<?php echo (new \DateTime())->format('Y-m-d') ?>" placeholder="<?php echo (new \DateTime())->format('Y-m-d H:i:s') ?>" class="form-control" readonly>
               </div>
         </div>
                  
         <div class="text-right">
           <button type="submit" name="trx_add" class="btn btn-success mb-2">Bayar</button>            
         </div>
        </div>   
      </form>    
