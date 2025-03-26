<?php
include "../functions/config/koneksi.php";


$bahan_baku     =  $_POST['bahan_baku'];
$jumlah     =  $_POST['jumlah'];
$harga     =  $_POST['harga'];
$tgl_kadaluarsa     =  $_POST['tgl_kadaluarsa'];


$simpan = mysqli_query($koneksi, "INSERT INTO `tb_tmp_pengadaan`(`id`, `id_bahan_baku`,`harga`, `jumlah`,`tgl_kadaluarsa`) VALUES ('','$bahan_baku','$harga','$jumlah','$tgl_kadaluarsa')");
if ($simpan) {
    header("location:../?menu=pengadaan&p=tambah");
} else {
    echo $koneksi->error;
}
