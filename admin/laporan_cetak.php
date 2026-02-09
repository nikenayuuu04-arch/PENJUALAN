<?php
include '../koneksi.php';

$dari   = $_GET['dari'];
$sampai = $_GET['sampai'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan</title>
    <style>
        body{ font-family: Arial; }
        table{ border-collapse: collapse; width:100%; }
        th, td{ border:1px solid #000; padding:6px; }
        th{ background:#eee; }
    </style>
</head>
<body>

<h3>LAPORAN PENJUALAN</h3>
<p>Dari <b><?= $dari ?></b> sampai <b><?= $sampai ?></b></p>

<table>
    <tr>
        <th>No</th>
        <th>Invoice</th>
        <th>Tanggal</th>
        <th>Kasir</th>
        <th>Jumlah Item</th>
        <th>Total Harga</th>
    </tr>

<?php
$no = 1;
$data = mysqli_query($koneksi,"
    SELECT 
        p.id_jual,
        p.tgl_jual,
        p.total_harga,
        u.user_nama,
        SUM(d.jumlah) AS total_item
    FROM penjualan p
    JOIN user u ON p.user_id = u.user_id
    JOIN penjualan_detail d ON p.id_jual = d.id_jual
    WHERE DATE(p.tgl_jual) BETWEEN '$dari' AND '$sampai'
    GROUP BY p.id_jual
    ORDER BY p.id_jual DESC
");

while($d = mysqli_fetch_assoc($data)){
?>
<tr>
    <td><?= $no++; ?></td>
    <td>INV-<?= $d['id_jual']; ?></td>
    <td><?= $d['tgl_jual']; ?></td>
    <td><?= $d['user_nama']; ?></td>
    <td><?= $d['total_item']; ?> item</td>
    <td>Rp <?= number_format($d['total_harga']); ?></td>
</tr>
<?php } ?>

</table>

<script>
    window.print();
</script>

</body>
</html>
