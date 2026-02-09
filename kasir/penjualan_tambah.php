<?php 
include 'header.php';
include '../koneksi.php';
?>

<div class="container">
    <div class="panel">
        <div class="panel-heading">
            <h4>Tambah Penjualan</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-10 col-md-offset-1">

                <form method="POST" action="penjualan_aksi.php">

                    <!-- TANGGAL -->
                    <div class="form-group">
                        <label>Tanggal Jual</label>
                        <input type="date" name="tgl_jual" class="form-control" required>
                    </div>

                    <!-- KASIR -->
                    <div class="form-group">
                        <label>Kasir</label>
                        <select name="user_id" class="form-control" required>
                            <option value="">- Pilih Kasir -</option>
                            <?php
                            $kasir = mysqli_query($koneksi,"SELECT * FROM user");
                            while($k = mysqli_fetch_array($kasir)){
                            ?>
                                <option value="<?php echo $k['user_id']; ?>">
                                    <?php echo $k['user_nama']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <hr>
                    <h4>Daftar Barang (1 Transaksi Banyak Barang)</h4>

                    <table class="table table-bordered">
                        <tr>
                            <th>Barang</th>
                            <th>Harga Jual</th>
                            <th>Jumlah</th>
                        </tr>

                        <?php for($i=0;$i<5;$i++){ ?>
                        <tr>
                            <td>
                                <select name="id_barang[]" class="form-control barang">
                                    <option value="">- Pilih Barang -</option>
                                    <?php
                                    $barang = mysqli_query($koneksi,"SELECT * FROM barang");
                                    while($b=mysqli_fetch_assoc($barang)){
                                    ?>
                                        <option value="<?= $b['id_barang']; ?>"
                                                data-harga="<?= $b['harga_jual']; ?>">
                                            <?= $b['nama_barang']; ?> (Stok: <?= $b['stok']; ?>)
                                        </option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <input type="number" name="harga[]" class="form-control harga" readonly>
                            </td>
                            <td>
                                <input type="number" name="jumlah[]" class="form-control" min="1">
                            </td>
                        </tr>
                        <?php } ?>
                    </table>

                    <input type="submit" class="btn btn-primary" value="Simpan Penjualan">

                </form>

            </div>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.barang').forEach(function(el){
    el.addEventListener('change', function(){
        let harga = this.options[this.selectedIndex].dataset.harga;
        this.closest('tr').querySelector('.harga').value = harga || '';
    });
});
</script>
