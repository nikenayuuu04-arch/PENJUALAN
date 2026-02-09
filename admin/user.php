<?php
    include 'header.php';
    include '../koneksi.php';
?>

<div class="container">
    <div class="alert alert-info text-center">
        <h4 style="margin-bottom:0px;">Data User</h4>
    </div>

    <div class="panel">
        <div class="panel-body">
            <a href="user_tambah.php" class="btn btn-sm btn-info pull-right">
                <i class="glyphicon glyphicon-plus"></i> Tambah User
            </a>
            <br><br>

            <table class="table table-bordered table-striped">
                <tr>
                    <th width="1%">No</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Status</th>
                    <th width="20%">Opsi</th>
                </tr>

                <?php
                    $data = mysqli_query($koneksi,"SELECT * FROM user ORDER BY user_id DESC");
                    $no = 1;
                    while ($d = mysqli_fetch_array($data)) {
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $d['username']; ?></td>
                    <td><?php echo $d['user_nama']; ?></td>
                    <td>
                        <?php
                            if ($d['user_status'] == 1) {
                                echo "<span class='label label-primary'>Admin</span>";
                            } elseif ($d['user_status'] == 2) {
                                echo "<span class='label label-success'>Kasir</span>";
                            }
                        ?>
                    </td>
                    <td>
                        <a href="user_edit.php?id=<?php echo $d['user_id']; ?>" 
                           class="btn btn-sm btn-warning">Edit</a>

                        <a href="user_hapus.php?id=<?php echo $d['user_id']; ?>" 
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Yakin hapus user ini?')">
                           Hapus
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>