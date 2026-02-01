<?php
    include '../koneksi.php';

    $username   = $_POST['username'];
    $password   = $_POST['password'];
    $nama       = $_POST['nama'];
    $status     = $_POST['status'];

    mysqli_query($koneksi, "INSERT INTO user VALUES(NULL, '$username', '$password', '$nama', '$status')");

    header("location:user.php");
?>