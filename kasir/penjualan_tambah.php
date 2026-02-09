<?php
include 'header.php';
include '../koneksi.php';
?>

<div class="container">
    <h4>Transaksi Penjualan</h4>

    <form action="penjualan_simpan.php" method="POST">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Barang</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="barang">
                <tr>
                    <td>
                        <select name="id_barang[]" class="form-control" required>
                            <?php
                            $barang = mysqli_query($koneksi,"SELECT * FROM barang");
                            while($b = mysqli_fetch_array($barang)){
                            ?>
                            <option value="<?= $b['id_barang']; ?>">
                                <?= $b['nama_barang']; ?> - Rp <?= number_format($b['harga_jual']); ?>
                            </option>
                            <?php } ?>
                        </select>
                    </td>
                    <td>
                        <input type="number" name="jumlah[]" class="form-control" value="1" required>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm" onclick="hapus(this)">X</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <button type="button" class="btn btn-success btn-sm" onclick="tambah()">+ Barang</button>
        <br><br>
        <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
    </form>
</div>

<script>
function tambah(){
    let html = document.querySelector('#barang tr').cloneNode(true);
    document.getElementById('barang').appendChild(html);
}
function hapus(el){
    el.parentElement.parentElement.remove();
}
</script>
