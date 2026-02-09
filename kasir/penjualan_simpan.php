<?php
include '../koneksi.php';
session_start();

if(!isset($_SESSION['user_id'])){
    die("Akses ditolak, silakan login");
}

$user_id = $_SESSION['user_id'];
$tgl = date('Y-m-d');

mysqli_query($koneksi,"
INSERT INTO penjualan (tgl_jual, user_id, total_harga)
VALUES ('$tgl','$user_id','0')
");

$id_jual = mysqli_insert_id($koneksi);
$total = 0;

for($i=0; $i < count($_POST['id_barang']); $i++){
    $id_barang = $_POST['id_barang'][$i];
    $jumlah    = $_POST['jumlah'][$i];

    $q = mysqli_query($koneksi,"
        SELECT harga_jual FROM barang WHERE id_barang='$id_barang'
    ");
    $b = mysqli_fetch_assoc($q);

    $harga = $b['harga_jual'];
    $subtotal = $harga * $jumlah;

    mysqli_query($koneksi,"
    INSERT INTO penjualan_detail
    (id_jual, id_barang, jumlah, harga, subtotal)
    VALUES
    ('$id_jual','$id_barang','$jumlah','$harga','$subtotal')
    ");

    $total += $subtotal;
}

mysqli_query($koneksi,"
UPDATE penjualan SET total_harga='$total' WHERE id_jual='$id_jual'
");

header("location:penjualan.php");
