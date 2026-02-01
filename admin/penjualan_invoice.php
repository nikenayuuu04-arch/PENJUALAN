<!DOCTYPE html>
<html>
<head>
    <title>Nota Penjualan</title>
    <link rel="stylesheet" type="text/css" href="../aset/css/bootstrap.css">
    <style>
        body{
            font-family: monospace;
            background: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }
        .nota{
            width: 420px;
            background: #fff;
            margin-top: 60px;
            padding: 20px;
            border: 1px dashed #000;
        }
        .center{text-align:center;}
        .right{text-align:right;}
        hr{border-top:1px dashed #000;}
        .row-item{
            display:flex;
            justify-content:space-between;
        }
        .small{font-size:13px;}
    </style>
</head>
<body>

<?php
include '../koneksi.php';

$id = $_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($koneksi,"
    SELECT 
        p.id_jual,
        p.tgl_jual,
        p.total_harga,
        u.user_nama,
        b.nama_barang,
        b.harga_jual
    FROM penjualan p
    JOIN user u ON p.user_id = u.user_id
    JOIN barang b ON p.id_barang = b.id_barang
    WHERE p.id_jual='$id'
"));

$jumlah = 1;
if($data['harga_jual'] > 0){
    $jumlah = $data['total_harga'] / $data['harga_jual'];
}
?>

<div class="nota">

    <div class="center">
        <b>TOKO RPL</b><br>
        <span class="small">Sistem Informasi Penjualan</span>
    </div>

    <hr>

    <div class="small">
        No : INV-<?= $data['id_jual']; ?><br>
        Tgl: <?= date('d/m/Y', strtotime($data['tgl_jual'])); ?><br>
        Kasir: <?= $data['user_nama']; ?>
    </div>

    <hr>

    <div><?= $data['nama_barang']; ?></div>

    <div class="row-item small">
        <span>Rp <?= number_format($data['harga_jual']); ?> x<?= $jumlah; ?></span>
        <span>Rp <?= number_format($data['total_harga']); ?></span>
    </div>

    <hr>

    <div class="row-item">
        <b>TOTAL</b>
        <b>Rp <?= number_format($data['total_harga']); ?></b>
    </div>

    <hr>

    <div class="center small">
        TERIMA KASIH<br>
        SELAMAT BERBELANJA
    </div>

    <div class="center" style="margin-top:15px;">
        <a href="penjualan.php" class="btn btn-xs btn-default">Kembali</a>
    </div>

</div>

</body>
</html>
