<?php
    include 'header.php';
?>

<div class="container">
    <br><br><br>
    <div class="col-md-5 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4><b>Tambah Barang</b></h4>
            </div>
            <div class="panel-body">

                <form method="POST" action="barang_aksi.php">

                    <div class="form-group">
                        <label>Id Barang</label>
                        <input type="text" name="id_barang" class="form-control"
                               placeholder="Masukkan Kode Barang" required>
                    </div>

                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control"
                               placeholder="Masukkan Nama Barang" required>
                    </div>

                    <div class="form-group">
                        <label>Harga Beli</label>
                        <input type="number" name="harga_beli" class="form-control"
                               placeholder="Masukkan Harga Beli" required>
                    </div>

                    <div class="form-group">
                        <label>Harga Jual</label>
                        <input type="number" name="harga_jual" class="form-control"
                               placeholder="Masukkan Harga Jual" required>
                    </div>

                    <div class="form-group">
                        <label>Stok</label>
                        <input type="number" name="stok" class="form-control"
                               placeholder="Masukkan Jumlah Stok" required>
                    </div>

                    <br>
                    <input type="submit" class="btn btn-primary" value="Simpan">
                    <a href="barang.php" class="btn btn-default">Kembali</a>

                </form>

            </div>
        </div>
    </div>
</div>