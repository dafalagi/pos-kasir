<?php 
$success_msg = "";
$error_msg = "";

if(isset($_POST['hapus_data'])){
 
    

}

if(isset($_POST['tambah_data'])){
  

}

if(isset($_POST['edit'])){


}
?>
<html>
    <head>
        <title>DATA PRODUK</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    </head>

    <body>
        <div class="container mt-3">
        <!-- Awal form barang-->
            <div class="card mt-3">
            <div class="card-header bg-primary text-white">
                Form Data Produk 
            </div>
            <div class="card-body">
                <form method="post" action="">
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" name="nama_produk"  class="form-control" size="50" maxlength="50" placeholder="Masukkan Nama Produk" required>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Produk</label>
                        <textarea class="form-control" name="desc_produk" class="form-control" placeholder="Masukkan Deskripsi Produk" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Stok</label>
                        <input type="text" name="stok" class="form-control" size="5" maxlength="5" placeholder="Masukkan Kuantitas Stok Produk" required>
                    </div>

                    <div class="form-group">
                        <label>Harga</label>
                        <input type="text" name="harga" class="form-control" size="10" maxlength="10" placeholder="Harga Produk" required>
                    </div>

                    <div class="form-group">
                        <label>Kategori Produk</label>
                        <select class="form-control" name="kategori">
                            <option></option>
                            <option></option>
                        </select>
                    </div>

                    

                    <button type="submit" class="btn btn-success" name="tambah_data">Simpan Data</button>
                    <button type="reset" class="btn btn-danger" name="breset">Reset Form</button>
                    </form>
                    </div>
            </div>
            <!-- Akhir form barang-->
                <!-- Awal tabel produk -->
                <div class="card mt-3">
                    <div class="card-header bg-dark text-white">
                        Tabel Data Produk
                    </div>
                    <div class="card-body">
                            <div align="right" style="margin-bottom:15px;" >
                                <form action="" method="POST">
                                    <input type="submit" value="RESET" name="treset" style="padding:5px;"/>
                                    <input type="text" name="input_search" class = "mt-1" style="width:300px; padding:5px;" placeholder="cari barang"/>
                                    <input type="submit" value="CARI" name="tcari" style="padding:5px;"/>
                                </form>
                            </div>
                            <table class="table table-bordered table-striped">
                            
                            <tr>
                                <th>ID BARANG </th>
                                <th>NAMA BARANG</th>
                                <th>DESKRIPSI PRODUK</th>
                                <th>STOK BARANG</th>
                                <th>HARGA BARANG</th>
                                <th>KATEGORI</th>
                                <th>ACTION</th>
                            </tr>
                            
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <button type="submit" class="btn btn-warning" name="edit_data">EDIT</button>
                                    <button type="submit" class="btn btn-danger" name="hapus_data">HAPUS</button>
                                </td>
                            </tr>
                        </table>
                            
                    </div>
                    </div>
                <!-- Akhir tabel produk -->
            
        </div>
    </body>
</html>
<?php
?>