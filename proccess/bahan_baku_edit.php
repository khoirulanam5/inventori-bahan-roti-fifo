<?php
include "../functions/config/koneksi.php";

$id_bahan_baku = $_POST['id_bahan_baku'];
$nama_bahan_baku     =  $_POST['nama_bahan_baku'];
$kategori     =  $_POST['kategori'];
$harga     =  $_POST['harga'];

$simpan = mysqli_query($koneksi, "UPDATE `tb_bahan_baku` SET 
                                `nama_bahan_baku`='$nama_bahan_baku',
                                `id_kategori`='$kategori',
                                `harga`='$harga'
                                
                                WHERE id_bahan_baku='$id_bahan_baku'");

// ALERT
if ($simpan) {
    header("location:../?menu=bahan_baku&success=2");
} else {
    echo $koneksi->error;
}
