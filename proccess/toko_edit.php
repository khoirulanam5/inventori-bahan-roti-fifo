<?php
include "../functions/config/koneksi.php";

$id_toko     =  $_POST['id_toko'];
$toko     =  $_POST['toko'];
$alamat     =  $_POST['alamat'];
$no_hp     =  $_POST['no_hp'];

$simpan = mysqli_query($koneksi, "UPDATE `tb_toko` SET 
                                `nama_toko`='$toko',
                                `alamat_toko`='$toko',
                                `no_hp`='$no_hp'
                                WHERE id_toko='$id_toko'");

if ($simpan) {
    header("location:../?menu=toko&success=2");
} else {
    echo $koneksi->error;
}
