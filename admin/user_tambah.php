<?php
    include 'header.php';
?>

<div class="container">
    <br><br>
    <div class="col-md-5 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4><b>Tambah User Baru</b></h4>
            </div>

            <div class="panel-body">
                <form method="POST" action="user_aksi.php">

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control"
                               placeholder="Masukkan Username" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control"
                               placeholder="Masukkan Password" required>
                    </div>

                    <div class="form-group">
                        <label>Nama User</label>
                        <input type="text" name="nama" class="form-control"
                               placeholder="Masukkan Nama User" required>
                    </div>

                    <div class="form-group">
                        <label>Status User</label>
                        <select name="status" class="form-control" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="1">Admin</option>
                            <option value="2">Kasir</option>
                        </select>
                    </div>

                    <br>
                    <input type="submit" value="Simpan" class="btn btn-primary">
                    <a href="user.php" class="btn btn-default">Kembali</a>

                </form>
            </div>
        </div>
    </div>
</div>