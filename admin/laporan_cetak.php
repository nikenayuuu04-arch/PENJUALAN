<?php
include '../koneksi.php';

$dari   = $_GET['dari'];
$sampai = $_GET['sampai'];
?>

<h3>Laporan Penjualan</h3>
<p>Dari <?= $dari ?> sampai <?= $sampai ?></p>

<table border="1" cellpadding="6" cellspacing="0" width="100%">
    <tr>
        <th>No</th>
        <th>Invoice</th>
        <th>Tanggal</th>
        <th>Kasir</th>
        <th>Barang</th>
        <th>Harga</th>
        <th>Total</th>
    </tr>

<?php
$no=1;
$data = mysqli_query($koneksi,"
    SELECT p.*, b.nama_barang, b.harga_jual, u.user_nama
    FROM penjualan p
    JOIN barang b ON p.id_barang = b.id_barang
    JOIN user u ON p.user_id = u.user_id
    WHERE date(p.tgl_jual) >= '$dari' 
    AND date(p.tgl_jual) <= '$sampai'
    ORDER BY p.id_jual DESC
");

while($d=mysqli_fetch_array($data)){
?>
<tr>
    <td><?= $no++; ?></td>
    <td>INV-<?= $d['id_jual']; ?></td>
    <td><?= $d['tgl_jual']; ?></td>
    <td><?= $d['user_nama']; ?></td>
    <td><?= $d['nama_barang']; ?></td>
    <td>Rp <?= number_format($d['harga_jual']); ?></td>
    <td>Rp <?= number_format($d['total_harga']); ?></td>
</tr>
<?php } ?>
</table>

<script>window.print();</script>
