<?php 
    include 'header.php';
    include '../koneksi.php';
?>

<div class="container">
    <div class="alert alert-info text-center">
        <h4 style="margin-bottom: 0px;">
            <b>Selamat Datang Admin!</b> Sistem Informasi Penjualan RPL Skanega
        </h4>
    </div>

    <!-- DASHBOARD -->
    <div class="panel">
        <div class="panel-heading">
            <h4>Dashboard</h4>
        </div>
        <div class="panel-body">
            <div class="row">

                <div class="col-md-3">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h1>
                                <i class="glyphicon glyphicon-user"></i>
                                <span class="pull-right">
                                    <?php
                                        $user = mysqli_query($koneksi,"SELECT * FROM user");
                                        echo mysqli_num_rows($user);
                                    ?>
                                </span>
                            </h1>
                            Total User
                        </div>
                    </div>
                </div>

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

            </div>
        </div>
    </div>

    <!-- RIWAYAT PENJUALAN -->
    <div class="panel">
        <div class="panel-heading">
            <h4>Riwayat Penjualan</h4>
        </div>
        <div class="panel-body">

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Invoice</th>
                        <th>Tanggal</th>
                        <th>Kasir</th>
                        <th>Jumlah Item</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>

                <tbody>
                <?php
                $query = mysqli_query($koneksi,"
                    SELECT 
                        p.id_jual,
                        p.tgl_jual,
                        p.total_harga,
                        u.user_nama,
                        SUM(d.jumlah) AS total_item
                    FROM penjualan p
                    JOIN user u ON p.user_id = u.user_id
                    JOIN penjualan_detail d ON p.id_jual = d.id_jual
                    GROUP BY p.id_jual
                    ORDER BY p.id_jual DESC
                ");

                $no = 1;
                while ($row = mysqli_fetch_assoc($query)) {
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td>INV-<?= $row['id_jual']; ?></td>
                        <td><?= date('d-m-Y', strtotime($row['tgl_jual'])); ?></td>
                        <td><?= $row['user_nama']; ?></td>
                        <td><?= $row['total_item']; ?> item</td>
                        <td>Rp <?= number_format($row['total_harga']); ?></td>
                    </tr>
                <?php } ?>
                </tbody>

            </table>

        </div>
    </div>

</div>