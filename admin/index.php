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
            <h4>Riwayat Penjualan Terbaru</h4>
        </div>
        <div class="panel-body">

            <table class="table table-bordered table-striped">
                <tr>
                    <th width="1%">No</th>
                    <th>Tanggal</th>
                    <th>Nama Barang</th>
                    <th>Total Harga</th>
                    <th>Nama Kasir</th>
                </tr>

                <?php
                    $data = mysqli_query($koneksi,"
                        SELECT penjualan.*, barang.nama_barang, user.user_nama
                        FROM penjualan
                        JOIN barang ON barang.id_barang = penjualan.id_barang
                        JOIN user ON user.user_id = penjualan.user_id
                        ORDER BY id_jual DESC
                        LIMIT 10
                    ");

                    $no = 1;
                    while ($d = mysqli_fetch_array($data)) {
                ?>

                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $d['tgl_jual']; ?></td>
                    <td><?php echo $d['nama_barang']; ?></td>
                    <td>Rp <?php echo number_format($d['total_harga']); ?></td>
                    <td><?php echo $d['user_nama']; ?></td>
                </tr>

                <?php } ?>
            </table>

        </div>
    </div>

</div>