<?php include 'header.php'; ?>
<?php include '../koneksi.php'; ?>

<div class="container">
    <div class="panel">
        <div class="panel-heading">
            <h4>Filter Laporan Penjualan</h4>
        </div>
        <div class="panel-body">
            <form action="" method="get">
                <table class="table table-bordered">
                    <tr>
                        <th>Dari Tanggal</th>
                        <th>Sampai Tanggal</th>
                        <th width="1%"></th>
                    </tr>
                    <tr>
                        <td><input type="date" name="tgl_dari" class="form-control"></td>
                        <td><input type="date" name="tgl_sampai" class="form-control"></td>
                        <td><input type="submit" class="btn btn-primary" value="Filter"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

<?php
if(isset($_GET['tgl_dari']) && isset($_GET['tgl_sampai'])){
    $dari   = $_GET['tgl_dari'];
    $sampai = $_GET['tgl_sampai'];
?>

    <div class="panel">
        <div class="panel-heading">
            <h4>Laporan Penjualan dari <b><?= $dari ?></b> sampai <b><?= $sampai ?></b></h4>
        </div>
        <div class="panel-body">

            <a target="_blank" href="laporan_cetak.php?dari=<?= $dari ?>&sampai=<?= $sampai ?>" 
               class="btn btn-success">
               <i class="glyphicon glyphicon-print"></i> Cetak
            </a>

            <br><br>

            <table class="table table-bordered table-striped">
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
                $no = 1;
                $data = mysqli_query($koneksi,"
                    SELECT p.*, b.nama_barang, b.harga_jual, u.user_nama
                    FROM penjualan p
                    JOIN barang b ON p.id_barang = b.id_barang
                    JOIN user u ON p.user_id = u.user_id
                    WHERE date(p.tgl_jual) >= '$dari' 
                    AND date(p.tgl_jual) <= '$sampai'
                    ORDER BY p.id_jual DESC
                ");

                while($d = mysqli_fetch_array($data)){
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

        </div>
    </div>

<?php } ?>
</div>
