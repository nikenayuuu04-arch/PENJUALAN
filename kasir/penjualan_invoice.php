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

// ambil data header penjualan
$header = mysqli_fetch_assoc(mysqli_query($koneksi,"
    SELECT 
        p.id_jual,
        p.tgl_jual,
        p.total_harga,
        u.user_nama
    FROM penjualan p
    JOIN user u ON p.user_id = u.user_id
    WHERE p.id_jual='$id'
"));

// ambil detail barang
$detail = mysqli_query($koneksi,"
    SELECT 
        d.jumlah,
        d.harga,
        d.subtotal,
        b.nama_barang
    FROM penjualan_detail d
    JOIN barang b ON d.id_barang = b.id_barang
    WHERE d.id_jual='$id'
");
?>

<div class="nota">

    <div class="center">
        <b>Toko Bintang</b><br>
        <span class="small">Sistem Informasi Penjualan</span>
    </div>

    <hr>

    <div class="small">
        No : INV-<?= $header['id_jual']; ?><br>
        Tgl: <?= date('d/m/Y', strtotime($header['tgl_jual'])); ?><br>
        Kasir: <?= $header['user_nama']; ?>
    </div>

    <hr>

    <?php while($d = mysqli_fetch_assoc($detail)){ ?>
        <div class="small"><?= $d['nama_barang']; ?></div>

        <div class="row-item small">
            <span>
                Rp <?= number_format($d['harga']); ?> x<?= $d['jumlah']; ?>
            </span>
            <span>
                Rp <?= number_format($d['subtotal']); ?>
            </span>
        </div>
    <?php } ?>

    <hr>

    <div class="row-item">
        <b>TOTAL</b>
        <b>Rp <?= number_format($header['total_harga']); ?></b>
    </div>

    <hr>

    <div class="center small">
        TERIMA KASIH<br>
        SELAMAT BERBELANJA
    </div>

</div>

<script>
    window.print();
    window.onafterprint = function(){
        window.close();
    }
</script>

</body>
</html>
