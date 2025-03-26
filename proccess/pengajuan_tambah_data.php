<?php
include "../functions/config/koneksi.php";

$bahan_baku     =  $_POST['bahan_baku'];
$jumlah     =  $_POST['jumlah'];

$simpan = mysqli_query($koneksi, "INSERT INTO `tb_tmp_pengajuan`(`id`, `id_bahan_baku`, `jumlah`) VALUES ('','$bahan_baku','$jumlah')");

// ALERT
if ($simpan) {
    header("location:../?menu=pengajuan&p=tambah");
} else {
    echo $koneksi->error;
}
