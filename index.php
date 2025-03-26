<?php
session_start();
$sesi = isset($_SESSION['user']) ? $_SESSION['user'] : null;

if (is_array($sesi)) {
    if ($sesi['level'] == 'petugas_produksi') {
        include("menu/petugas_produksi/index.php");
    } else if ($sesi['level'] == 'petugas_toko') {
        include("menu/petugas_toko/index.php");
    } else if ($sesi['level'] == 'admin') {
        include("menu/admin/index.php");
    } else if ($sesi['level'] == 'pemilik') {
        include("menu/pemilik/index.php");
    } else if ($sesi['level'] == 'petugas_gudang') {
        include("menu/petugas_gudang/index.php");
    } else {
        include("menu/login.php");
    }
} else {
    include("menu/login.php");
}
?>
