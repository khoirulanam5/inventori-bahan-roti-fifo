<?php
include "../functions/config/koneksi.php";

$id_pengajuan = $_POST['id'];
$tgl     =  $_POST['tgl'];


$simpan = mysqli_query($koneksi, "UPDATE tb_pengajuan SET tgl_pengajuan='$tgl' WHERE id_pengajuan='$id_pengajuan'");

if ($simpan) {
    $query2 = $koneksi->query("SELECT * FROM tb_tmp_pengajuan");

    foreach ($query2 as $data2) {
        $simpan = mysqli_query($koneksi, "INSERT INTO `tb_detail_pengajuan`(`id`, `id_pengajuan`,`id_bahan_baku`,`jumlah`) VALUES ('','$id_pengajuan','" . $data2['id_bahan_baku'] . "','" . $data2['jumlah'] . "')");
    }
    $hapus = $koneksi->query("truncate tb_tmp_pengajuan");
}

if ($simpan) {
    header("location:../?menu=pengajuan&success=1");
} else {
    echo $koneksi->error;
}
