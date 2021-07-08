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