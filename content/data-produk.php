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