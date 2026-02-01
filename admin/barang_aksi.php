<?php
    include '../koneksi.php';

    // ambil data dari form barang_tambah.php
    $id_barang = $_POST['id_barang'];
    $nama       = $_POST['nama_barang'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    $stok       = $_POST['stok'];

    // simpan ke tabel barang
    mysqli_query($koneksi, "
        INSERT INTO barang (
            id_barang,
            nama_barang,
            harga_beli,
            harga_jual,
            stok
        ) VALUES (
            '$id_barang',
            '$nama',
            '$harga_beli',
            '$harga_jual',
            '$stok'
        )
    ");

    // kembali ke halaman barang
    header("location:barang.php");
?>