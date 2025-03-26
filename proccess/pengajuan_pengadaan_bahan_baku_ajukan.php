<?php
include "../functions/config/koneksi.php";


$id = $_GET['id'];
$k = $_GET['k'];

if ($k == 'sesi') {
    $simpan = mysqli_query($koneksi, "UPDATE tb_pengajuan_pengadaan_bahan_baku SET status_admin='1' WHERE id='$id'");
} else {
    $simpan = mysqli_query($koneksi, "UPDATE tb_pengajuan_pengadaan_bahan_baku SET status_pemilik='1' WHERE id='$id'");
}


// ALERT
if ($simpan) {
    header("location:../?menu=pengajuan_pengadaan_bahan_baku&success=4");
} else {
    echo $koneksi->error;
}
