<?php 
include 'header.php';
include '../koneksi.php';
?>

<div class="container">

    <div class="alert alert-info text-center">
        <h4 style="margin-bottom:0px;">Data Penjualan</h4>
    </div>

    <div class="panel">
        <div class="panel-body">

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Jual</th>
                        <th>Tanggal</th>
                        <th>Kasir</th>
                        <th>Nama Barang</th>
                        <th>Harga Barang</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th width="15%">Opsi</th>
                    </tr>
                </thead>

                <tbody>
                <?php
                $data = mysqli_query($koneksi,"
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
                    ORDER BY p.id_jual DESC
                ");

                $no = 1;
                while($d = mysqli_fetch_array($data)){

                    // hitung jumlah barang (tanpa kolom jumlah)
                    $jumlah = 1;
                    if($d['harga_jual'] > 0){
                        $jumlah = $d['total_harga'] / $d['harga_jual'];
                    }
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td>INVOICE-<?= $d['id_jual']; ?></td>
                        <td><?= date('d-m-Y', strtotime($d['tgl_jual'])); ?></td>
                        <td><?= $d['user_nama']; ?></td>
                        <td><?= $d['nama_barang']; ?></td>
                        <td>Rp <?= number_format($d['harga_jual']); ?></td>
                        <td><?= $jumlah; ?></td>
                        <td>Rp <?= number_format($d['total_harga']); ?></td>
                        <td class="text-center">

                            <a href="penjualan_invoice.php?id=<?= $d['id_jual']; ?>"
                               class="btn btn-warning btn-xs">
                                Invoice
                            </a>

                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
