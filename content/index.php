<?php

$breadcum = "Halaman Utama";


$sql = "SELECT COUNT(*) AS total_transaksi FROM transaksi";
$stmt = $db->prepare($sql);
$stmt->execute();
$total_transaksi = $stmt->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT COUNT(*) AS total_kategori_produk FROM kategori_produk";
$stmt = $db->prepare($sql);
$stmt->execute();
$total_kategori_produk = $stmt->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT COUNT(*) AS total_produk FROM produk";
$stmt = $db->prepare($sql);
$stmt->execute();
$total_produk = $stmt->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT COUNT(*) AS total_pegawai FROM pegawai";
$stmt = $db->prepare($sql);
$stmt->execute();
$total_pegawai = $stmt->fetch(PDO::FETCH_ASSOC);


?>
    
    <?php include("layouts/components/breadcum.php"); ?>

    <div class="row layout-top-spacing">
      <div class="col-sm">
      
        <div class="widget widget-one_hybrid widget-followers">
            <div class="widget-heading">
                <p class="w-value"><?php echo $total_kategori_produk["total_kategori_produk"] ?></p>
                <h5 class="">Total Kategori</h5>
            </div>
        </div>
      </div>
      <div class="col-sm">

        <div class="widget widget-one_hybrid widget-followers">
            <div class="widget-heading">
                <p class="w-value"><?php echo $total_produk["total_produk"] ?></p>
                <h5 class="">Total Produk</h5>
            </div>
        </div>

      </div>
      <div class="col-sm">

        <div class="widget widget-one_hybrid widget-followers">
            <div class="widget-heading">
                <p class="w-value"><?php echo $total_transaksi["total_transaksi"]; ?></p>
                <h5 class="">Total Transaksi</h5>
            </div>
        </div>
        
      </div>
      <div class="col-sm">

        <div class="widget widget-one_hybrid widget-followers">
            <div class="widget-heading">
                <p class="w-value"><?php echo $total_pegawai["total_pegawai"]; ?></p>
                <h5 class="">Total Pegawai</h5>
            </div>
        </div>
        
      </div>
    </div>
        