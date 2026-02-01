<!DOCTYPE html>
<html>
<head>
    <title>Sistem Informasi Penjualan RPL Skanega</title>
    <link rel="stylesheet" type="text/css" href="../aset/css/bootstrap.css">
    <script type="text/javascript" src="../aset/js/jquery.js"></script>
    <script type="text/javascript" src="../aset/js/bootstrap.js"></script>
</head>

<body style="background: #f0f0f0">

<?php
    session_start();

    // cek login
    if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
        header("location:../index.php?pesan=belum_login");
        exit;
    }
?>

<nav class="navbar navbar-inverse" style="border-radius:0px;">
    <div class="container-fluid">

        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Kasir</a>
        </div>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="nav navbar-nav">

                <li>
                    <a href="index.php">
                        <i class="glyphicon glyphicon-home"></i> Dashboard
                    </a>
                </li>

                <li>
                    <a href="penjualan.php">
                        <i class="glyphicon glyphicon-shopping-cart"></i> Penjualan
                    </a>
                </li>

                <li>
                    <a href="logout.php">
                        <i class="glyphicon glyphicon-log-out"></i> Logout
                    </a>
                </li>

            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li>
                    <p style="color:white; margin-top:15px; margin-right:15px;">
                        Halo, <b><?php echo $_SESSION['username']; ?></b>
                    </p>
                </li>
            </ul>
        </div>

    </div>
</nav>