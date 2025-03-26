<?php
include "../functions/config/koneksi.php";

$id_user     =  $_POST['id_user'];
$username     =  $_POST['username'];
$password     =  $_POST['password'];
$level     =  $_POST['level'];
$id_relasi     =  $_POST['petugas_toko'];
if ($level == 'petugas_toko') {

    $simpan = mysqli_query($koneksi, "UPDATE `tb_user` SET 
                                `username`='$username',
                                `password`='$password',
                                `id_relasi`='$id_relasi',
                                `level`='$level'
                                WHERE id_user='$id_user'");
} else {
    $simpan = mysqli_query($koneksi, "UPDATE `tb_user` SET 
                                `username`='$username',
                                `password`='$password',
                                `id_relasi`='',
                                `level`='$level'
                                WHERE id_user='$id_user'");
}
if ($simpan) {
    header("location:../?menu=user&success=2");
} else {
    echo $koneksi->error;
}
