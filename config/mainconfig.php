<?php

$cfg_baseurl = "/pos-kasir";
$cfg_appname = "Aplikasi Point Of Sale Kelompok FEDORA";
$cfg_logoname = "POS Fedora";
$cfg_favicon = "";

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "toko";

try {    
    //create PDO connection 
    $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
} catch(PDOException $e) {
    //show error
    die("Terjadi masalah: " . $e->getMessage());
}