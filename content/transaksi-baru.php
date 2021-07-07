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

if(isset($_POST['tambah_data'])){
    
    $total_harga = filter_input(INPUT_POST, 'total_harga', FILTER_SANITIZE_STRING);
    $tgl_transaksi = filter_input(INPUT_POST, 'tgl_transaksi', FILTER_SANITIZE_STRING);
    $id_pegawai = filter_input(INPUT_POST, 'id_pegawai', FILTER_SANITIZE_STRING);
  
    $sql = "INSERT INTO transaksi (total_harga, tgl_transaksi, id_pegawai) 
            VALUES (:total_harga, :tgl_transaksi, :id_pegawai)";
  
    $stmt = $db->prepare($sql);
  
    // bind parameter ke query
    $params = array(
        ":total_harga" => $total_harga,
        ":tgl_transaksi" => $tgl_transaksi,
        ":id_pegawai" => $id_pegawai
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