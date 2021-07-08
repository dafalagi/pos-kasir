<?php 
$success_msg = "";
$error_msg = "";

if(isset($_POST['hapus_data'])){

    $no_nota = filter_input(INPUT_POST, 'id_pegawai', FILTER_SANITIZE_STRING);

    $sql = "DELETE FROM pegawai
            WHERE id_pegawai = :id_pegawai";
  
    $stmt = $db->prepare($sql);
  
    // bind parameter ke query
    $params = array(
        ":id_pegawai" => $id_pegawai
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

    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $alamat = filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_STRING);
    $telp_p = filter_input(INPUT_POST, 'telp_p', FILTER_SANITIZE_STRING);
    $id_toko = filter_input(INPUT_POST, 'id_toko', FILTER_SANITIZE_STRING);
  
    $sql = "INSERT INTO pegawai (nama, username, password, alamat, telp_p, id_toko) 
            VALUES (:nama, :username, :password, :alamat, :telp_p, :id_toko)";
  
    $stmt = $db->prepare($sql);
  
    // bind parameter ke query
    $params = array(
        ":nama" => $nama,
        ":username" => $username,
        ":password" => $password,
        ":alamat" => $alamat,
        ":telp_p" => $telp_p,
        ":id_toko" => $id_toko
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

  $id_pegawai_baru = filter_input(INPUT_POST, 'id_pegawai_baru', FILTER_SANITIZE_STRING);
  $id_pegawai_lama = filter_input(INPUT_POST, 'id_pegawai_lama', FILTER_SANITIZE_STRING);
  $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
  $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
  $alamat = filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_STRING);
  $telp_p = filter_input(INPUT_POST, 'telp_p', FILTER_SANITIZE_STRING);
  $id_toko = filter_input(INPUT_POST, 'id_toko', FILTER_SANITIZE_STRING);

  $sql = "UPDATE pegawai
          SET id_pegawai = :id_pegawai_baru, nama = :nama, username = :username, password = :password,
          alamat = :alamat, telp_p = :telp_p, id_toko = :id_toko
          WHERE id_pegawai = :id_pegawai_lama";

  $stmt = $db->prepare($sql);

  // bind parameter ke query
  $params = array(
      ":id_pegawai_baru" => $id_pegawai_baru,
      ":id_pegawai_lama" => $id_pegawai_lama,
      ":nama" => $nama,
      ":username" => $username,
      ":password" => $password,
      ":alamat" => $alamat,
      ":telp_p" => $telp_p,
      ":id_toko" => $id_toko
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