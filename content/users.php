<?php 
$success_msg = "";
$error_msg = "";
$breadcum = "Data rak buku";

if(isset($_POST['submitdelete'])){

  $delete_rak_buku = filter_input(INPUT_POST, 'delete_rak_buku', FILTER_SANITIZE_STRING);

  $sql = "DELETE FROM rak_buku
          WHERE id_rak_buku = :id_rak_buku";

  $stmt = $db->prepare($sql);

  // bind parameter ke query
  $params = array(
      ":id_rak_buku" => $delete_rak_buku
  );

  // eksekusi query untuk menyimpan ke database
  $saved = $stmt->execute($params);
  if($saved) {
    $success_msg = "Data berhasil dihapus";
  } else {
    $error_msg = "Data tidak berhasil dihapus";
  }
}

if(isset($_POST['tambahdatarak'])){
  
  $id_rak_buku = filter_input(INPUT_POST, 'idrakbuku', FILTER_SANITIZE_STRING);
  $jenis_buku = filter_input(INPUT_POST, 'jenisbuku', FILTER_SANITIZE_STRING);

  $sql = "INSERT INTO rak_buku (id_rak_buku,jenis_buku) 
          VALUES (:id_rak_buku, :jenis_buku)";

  $stmt = $db->prepare($sql);

  // bind parameter ke query
  $params = array(
      ":id_rak_buku" => $id_rak_buku,
      ":jenis_buku" => $jenis_buku
  );

  // eksekusi query untuk menyimpan ke database
  $saved = $stmt->execute($params);
  if($saved) {
    $success_msg = "Data berhasil ditambahkan";
  } else {
    $error_msg = "Data tidak berhasil ditambahkan";
  }
}

if(isset($_POST['editdatarak'])){

  $id_rak_buku_lama = filter_input(INPUT_POST, 'idrakbukulama', FILTER_SANITIZE_STRING);
  $id_rak_buku_baru = filter_input(INPUT_POST, 'idrakbukubaru', FILTER_SANITIZE_STRING);
  $jenis_buku_baru = filter_input(INPUT_POST, 'jenisbukubaru', FILTER_SANITIZE_STRING);

  $sql = "UPDATE rak_buku
          SET id_rak_buku = :id_rak_buku_baru, jenis_buku = :jenis_buku_baru
          WHERE id_rak_buku = :id_rak_buku_lama";

  $stmt = $db->prepare($sql);

  // bind parameter ke query
  $params = array(
      ":id_rak_buku_baru" => $id_rak_buku_baru,
      ":jenis_buku_baru" => $jenis_buku_baru,
      ":id_rak_buku_lama" => $id_rak_buku_lama
  );

  // eksekusi query untuk menyimpan ke database
  $saved = $stmt->execute($params);
  if($saved) {
    $success_msg = "Data berhasil ditambahkan";
  } else {
    $error_msg = "Data tidak berhasil ditambahkan";
  }
}

?>
    

        <?php include("layouts/components/breadcum.php") ?>

        <div class="px-4 md:px-10 mx-auto w-full -m-24">
          <div class="flex flex-wrap">
            <div class="w-full xl:w-12 mb-12 xl:mb-0 px-4">
              <div
                class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white"
              >
                <div class="rounded-t mb-0 px-4 py-3 bg-transparent">
                  <div class="flex flex-wrap items-center">
                    <div class="relative w-full max-w-full flex-grow flex-1">
                      <h6
                        class="uppercase mb-1 text-xs font-semibold"
                      >
                        Manajemen
                      </h6>
                      <h2 class="text-black text-xl font-semibold">
                        Data Pengguna
                      </h2>
                    </div>
                  </div>
                </div>
                <div class="p-4 flex-auto">
                  <!-- Chart -->
                  <div class="block w-full overflow-x-auto">
                  <!-- Projects table -->
                  <table class="items-center w-full">
                    <thead>
                      <tr>
                        <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                          ID
                        </th>
                        <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                          Username
                        </th>
                        <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                          Nama
                        </th>
                        <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                          Email
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php

                    $query_data_users = "SELECT * FROM users ORDER BY id DESC";
                    $dd = $db->prepare($query_data_users);
                    $dd->execute();
                    $no = 1;
                    while($row = $dd->fetch(PDO::FETCH_ASSOC)){
                     $id = $row['id'];
                     $username = $row['username'];
                     $name = $row['name'];
                     $email = $row['email'];
                      ?>
                      <tr>
                        <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                          <?php echo $id; ?>
                        </th>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                          <?php echo $username; ?>
                        </td>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                          <?php echo $name; ?>
                        </td>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                          <i class="fas fa-arrow-up text-emerald-500 mr-4"></i>
                           <?php echo $email; ?>
                        </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            
          </div>
 <!-- 
        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah data rak buku</h4>
              </div>
              <form method="POST">
              <div class="modal-body">
                <div class="box-body">
                  <div class="form-group">
                    <label for="idrakbuku">ID Rak Buku</label>
                    <input type="text" name="idrakbuku" class="form-control" id="idrakbuku" placeholder="Ex: M001" required>
                  </div>
                  <div class="form-group">
                    <label for="jenisbuku">Jenis Rak Buku</label>
                    <input type="text" name="jenisbuku" class="form-control" id="jenisbuku" placeholder="Ex: Manajemen Bisnis" required>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" name="tambahdatarak" class="btn btn-primary">Submit</button>
              </div>
              </form>
            </div>
          
          </div>
        </div>
        <!-- /.modal -->