<?php 
$success_msg = "";
$error_msg = "";

if(isset($_POST['hapus_data'])){

    $no_nota = filter_input(INPUT_POST, 'id_toko', FILTER_SANITIZE_STRING);

    $sql = "DELETE FROM toko
            WHERE id_toko = :id_toko";
  
    $stmt = $db->prepare($sql);
  
    // bind parameter ke query
    $params = array(
        ":id_toko" => $id_toko
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

    $id_toko = filter_input(INPUT_POST, 'id_toko', FILTER_SANITIZE_STRING);
    $nama_toko = filter_input(INPUT_POST, 'nama_toko', FILTER_SANITIZE_STRING);
    $alamat_toko = filter_input(INPUT_POST, 'alamat_toko', FILTER_SANITIZE_STRING);
    $telp = filter_input(INPUT_POST, 'telp', FILTER_SANITIZE_STRING);
    $nama_pemilik = filter_input(INPUT_POST, 'nama_pemilik', FILTER_SANITIZE_STRING);
  
    $sql = "INSERT INTO toko (id_toko, nama_toko, alamat_toko, telp, nama_pemilik) 
            VALUES (:id_toko, :nama_toko, :alamat_toko, :telp, :nama_pemilik)";
  
    $stmt = $db->prepare($sql);
  
    // bind parameter ke query
    $params = array(
        ":id_toko" => $id_toko,
        ":nama_toko" => $nama_toko,
        ":alamat_toko" => $alamat_toko,
        ":telp" => $telp,
        ":nama_pemilik" => $nama_pemilik
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

  $id_toko_baru = filter_input(INPUT_POST, 'id_toko_baru', FILTER_SANITIZE_STRING);
  $id_toko_lama = filter_input(INPUT_POST, 'id_toko_lama', FILTER_SANITIZE_STRING);
  $nama_toko = filter_input(INPUT_POST, 'nama_toko', FILTER_SANITIZE_STRING);
  $alamat_toko = filter_input(INPUT_POST, 'alamat_toko', FILTER_SANITIZE_STRING);
  $telp = filter_input(INPUT_POST, 'telp', FILTER_SANITIZE_STRING);
  $nama_pemilik = filter_input(INPUT_POST, 'nama_pemilik', FILTER_SANITIZE_STRING);

  $sql = "UPDATE transaksi
          SET id_toko = :id_toko_baru, nama_toko = :nama_toko, alamat_toko = :alamat_toko,
          telp = :telp, nama_pemilik = :nama_pemilik
          WHERE id_toko = :id_toko_lama";

  $stmt = $db->prepare($sql);

  // bind parameter ke query
  $params = array(
      ":id_toko_baru" => $id_toko_baru,
      ":id_toko_lama" => $id_toko_lama,
      ":nama_toko" => $nama_toko,
      ":alamat_toko" => $alamat_toko,
      ":telp" => $telp,
      ":nama_pemilik" => $nama_pemilik
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