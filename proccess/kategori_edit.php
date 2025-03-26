<?php
include "../functions/config/koneksi.php";

$id_kategori     =  $_POST['id_kategori'];
$nama_kategori     =  $_POST['nama_kategori'];

$simpan = mysqli_query($koneksi, "UPDATE `tb_kategori` SET 
                                `nama_kategori`='$nama_kategori'
                                WHERE id_kategori='$id_kategori'");

if ($simpan) {
    header("location:../?menu=kategori&success=2");
} else {
    echo $koneksi->error;
}
