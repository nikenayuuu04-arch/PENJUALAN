<?php
include '../koneksi.php';

$tgl_jual = $_POST['tgl_jual'];
$user_id  = $_POST['user_id'];

$id_barang = $_POST['id_barang'];
$jumlah    = $_POST['jumlah'];

for($i=0; $i<count($id_barang); $i++){

    if($id_barang[$i] != "" && $jumlah[$i] > 0){

        // ambil barang
        $barang = mysqli_fetch_assoc(mysqli_query($koneksi,
            "SELECT * FROM barang WHERE id_barang='$id_barang[$i]'"));

        $harga = $barang['harga_jual'];
        $stok  = $barang['stok'];

        // cek stok
        if($stok < $jumlah[$i]){
            echo "<script>alert('Stok tidak cukup untuk ".$barang['nama_barang']."');history.back();</script>";
            exit;
        }

        $total = $harga * $jumlah[$i];

        // bikin ID jual baru tiap barang
        $id_jual = "PJ".time().$i;

        // simpan transaksi (1 barang 1 transaksi)
        mysqli_query($koneksi,"INSERT INTO penjualan(id_jual,id_barang,tgl_jual,total_harga,user_id)
        VALUES('$id_jual','$id_barang[$i]','$tgl_jual','$total','$user_id')");

        // kurangi stok
        mysqli_query($koneksi,"UPDATE barang SET stok = stok - $jumlah[$i] WHERE id_barang='$id_barang[$i]'");
    }
}

echo "<script>alert('Semua barang berhasil ditambahkan');location='penjualan.php';</script>";
?>
