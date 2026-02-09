<?php
session_start();
include '../koneksi.php';

$tgl_jual = $_POST['tgl_jual'];
$user_id  = $_POST['user_id'];

$id_barang = $_POST['id_barang'];
$jumlah    = $_POST['jumlah'];

$total = 0;

/* SIMPAN HEADER */
$simpan = mysqli_query($koneksi,"
    INSERT INTO penjualan (tgl_jual, user_id, total_harga)
    VALUES ('$tgl_jual','$user_id','0')
");

if(!$simpan){
    die("Gagal simpan penjualan: ".mysqli_error($koneksi));
}

/* AMBIL ID JUAL OTOMATIS */
$id_jual = mysqli_insert_id($koneksi);

/* SIMPAN DETAIL */
for($i=0; $i<count($id_barang); $i++){

    if($id_barang[$i] != "" && $jumlah[$i] > 0){

        $q = mysqli_query($koneksi,"
            SELECT harga_jual 
            FROM barang 
            WHERE id_barang='".$id_barang[$i]."'
        ");
        $b = mysqli_fetch_assoc($q);

        $harga    = $b['harga_jual'];
        $subtotal = $harga * $jumlah[$i];
        $total   += $subtotal;

        mysqli_query($koneksi,"
            INSERT INTO penjualan_detail
            (id_jual, id_barang, jumlah, harga, subtotal)
            VALUES
            ('$id_jual','".$id_barang[$i]."','".$jumlah[$i]."','$harga','$subtotal')
        ");
    }
}

/* UPDATE TOTAL */
mysqli_query($koneksi,"
    UPDATE penjualan 
    SET total_harga='$total' 
    WHERE id_jual='$id_jual'
");

header("location:penjualan.php");
