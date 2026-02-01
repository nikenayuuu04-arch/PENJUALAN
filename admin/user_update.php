<?php
include '../koneksi.php';

$id       = $_POST['id'];
$username = $_POST['username'];
$nama     = $_POST['nama'];
$status   = $_POST['status'];
$password = $_POST['password'];

$data = mysqli_query($koneksi, "SELECT * FROM user WHERE user_id='$id'");
$d = mysqli_fetch_assoc($data);

if ($password == "" || empty($password)) {
    $password_baru = $d['password'];
} else {
    $password_baru = $password;
}

mysqli_query($koneksi, "
    UPDATE user SET
        username = '$username',
        password = '$password_baru',
        user_nama = '$nama',
        user_status = '$status'
    WHERE user_id = '$id'
");

header("location:user.php");
?>