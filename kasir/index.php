<?php 
    include 'header.php';
    include '../koneksi.php';
?>

<div class="container">
    <div class="alert alert-info text-center">
        <h4 style="margin-bottom: 0px;">
            <b>Selamat Datang!</b> Sistem Informasi Penjualan
        </h4>
    </div>

    <!-- DASHBOARD -->
    <div class="panel">
        <div class="panel-heading">
            <h4>Dashboard Kasir</h4>
        </div>
        <div class="panel-body">
            <div class="row">

                <!-- TOTAL BARANG -->
                <div class="col-md-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h1>
                                <i class="glyphicon glyphicon-list"></i>
                                <span class="pull-right">
                                    <?php
                                        $barang = mysqli_query($koneksi,"SELECT * FROM barang");
                                        echo mysqli_num_rows($barang);
                                    ?>
                                </span>
                            </h1>
                            Total Barang
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h1>
                                <i class="glyphicon glyphicon-ok-circle"></i>
                                <span class="pull-right">
                                    <?php
                                        $ready = mysqli_query($koneksi,"SELECT * FROM barang WHERE stok > 0");
                                        echo mysqli_num_rows($ready);
                                    ?>
                                </span>
                            </h1>
                            Stok Tersedia
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h1>
                                <i class="glyphicon glyphicon-remove-circle"></i>
                                <span class="pull-right">
                                    <?php
                                        $habis = mysqli_query($koneksi,"SELECT * FROM barang WHERE stok = 0");
                                        echo mysqli_num_rows($habis);
                                    ?>
                                </span>
                            </h1>
                            Stok Habis
                        </div>
                    </div>
                </div>

                <!-- TOTAL TRANSAKSI -->
                <div class="col-md-3">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h1>
                                <i class="glyphicon glyphicon-stats"></i>
                                <span class="pull-right">
                                    <?php
                                        $all = mysqli_query($koneksi,"SELECT * FROM penjualan");
                                        echo mysqli_num_rows($all);
                                    ?>
                                </span>
                            </h1>
                            Total Penjualan
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- RIWAYAT PENJUALAN -->
    <div class="panel">
        <div class="panel-heading">
            <h4>Riwayat Penjualan Terbaru</h4>
        </div>
        <div class="panel-body">

            <table class="table table-bordered table-striped">
                <tr>
                    <th>No</th>
                    <th>ID Jual</th>
                    <th>Tanggal</th>
                    <th>Kasir</th>
                    <th>Nama Barang</th>
                    <th>Harga Barang</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                </tr>

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
                    while ($d = mysqli_fetch_array($data)) {

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
                </tr>

                <?php } ?>
            </table>

        </div>
    </div>

</div>