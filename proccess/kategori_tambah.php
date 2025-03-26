<?php
include "../functions/config/koneksi.php";

$kategori     =  $_POST['kategori'];


$simpan = mysqli_query($koneksi, "INSERT INTO `tb_kategori`(`id_kategori`, `nama_kategori`) VALUES ('','$kategori')");
if ($simpan) {
    header("location:../?menu=kategori&success=1");
} else {
    echo $koneksi->error;
}
