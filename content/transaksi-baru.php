<?php 
$success_msg = "";
$error_msg = "";

if(isset($_POST['hapus_data'])){

    $no_nota = filter_input(INPUT_POST, 'no_nota', FILTER_SANITIZE_STRING);

    $sql = "DELETE FROM transaksi
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
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
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
                $query = "SELECT id_cart, nama_produk, jumlah, (a.harga*b.jumlah) AS sub_total
                          FROM produk a INNER JOIN cart b 
                          ON a.id_produk = b.id_produk
                          WHERE id_cart = ".$_SESSION["user"]["id_pegawai"]." ORDER BY id_cart DESC";
                $dd = $db->prepare($query);
                $dd->execute();
                $no = 0;
                while($row = $dd->fetch(PDO::FETCH_ASSOC)){
                 $no++;
                 $id_produk = $row['nama_produk'];
                 $jumlah = $row['jumlah'];
                 $sub_total = $row['sub_total'];
            ?>
                <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $id_produk ?></td>
                    <td><?php echo $jumlah ?></td>
                    <td><?php echo $sub_total ?></td>
                    <td>
                    <form method=POST>
                      <input type="hidden" name="id_produk" value="<?php echo $id_produk; ?>"></input>
                      <button type="submit" name="tambah_cart" class="btn btn-dark mb-2 mr-2 rounded-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                      </button>
                    </form>
                    </td>
                </tr>
            </tbody>
            <?php } ?>
        </table>
      </div>
      
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
                <input type="number" class="form-control" value="<?php echo $total ?>" readonly>
            </div>
            <div class="form-group col-md-6">
                <label>Total Bayar</label>
                <input type="number" class="form-control" >
            </div>
            <div class="form-group col-md-6">
                <label>Total Kembalian</label>
                <input type="number" class="form-control" readonly>
            </div>
      </div>
      
      <div class="text-right">
                <button class="btn btn-success mb-2">Bayar</button>            
            </div>
    </div>       
