<?php
include "../functions/config/koneksi.php";


$bahan_baku     =  $_POST['bahan_baku'];
$jumlah     =  $_POST['jumlah'];


$simpan = mysqli_query($koneksi, "INSERT INTO `tb_tmp_pengajuan_pengadaan_bahan_baku`(`id`, `id_bahan_baku`, `jumlah`) VALUES ('','$bahan_baku','$jumlah')");
// ALERT
if ($simpan) {
    header("location:../?menu=pengajuan_pengadaan_bahan_baku&p=tambah");
} else {
    echo $koneksi->error;
}
