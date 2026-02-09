<?php
    include 'header.php';
    include '../koneksi.php';
?>

<div class="container">
    
    <div class="alert alert-info text-center">
        <h4 style="margin-bottom:0px;">Data Barang</h4>
    </div>

    <div class="panel">
        <div class="panel-body">

            <a href="barang_tambah.php" class="btn btn-sm btn-info pull-right">
                <i class="glyphicon glyphicon-plus"></i> Tambah Barang
            </a>
            <br><br>

            <table class="table table-bordered table-striped">
                <tr>
                    <th width="1%">No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                    <th>Status</th>
                    <th width="15%">Opsi</th>
                </tr>

                <?php
                    $data = mysqli_query($koneksi,"SELECT * FROM barang");
                    $no = 1;
                    while($d = mysqli_fetch_array($data)){

                        if($d['stok'] > 0){
                            $status = "<span class='label label-success'>TERSEDIA</span>";
                        } else {
                            $status = "<span class='label label-danger'>HABIS</span>";
                        }
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $d['id_barang']; ?></td>
                    <td><?php echo $d['nama_barang']; ?></td>
                    <td>Rp <?php echo number_format($d['harga_beli']); ?></td>
                    <td>Rp <?php echo number_format($d['harga_jual']); ?></td>
                    <td><?php echo $d['stok']; ?></td>
                    <td><?php echo $status; ?></td>
                    <td>
                        <a href="barang_edit.php?id=<?php echo $d['id_barang']; ?>" class="btn btn-sm btn-warning">
                            <i class="glyphicon glyphicon-edit"></i>
                        </a>
                        <a href="barang_hapus.php?id=<?php echo $d['id_barang']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data?')">
                            <i class="glyphicon glyphicon-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </table>

        </div>
    </div>
</div>