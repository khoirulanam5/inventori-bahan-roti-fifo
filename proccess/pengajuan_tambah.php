<?php
session_start();
include "../functions/config/koneksi.php";

function oto($tabel, $id, $inisial)
{
    include "../functions/config/koneksi.php";
    $panjang = 7;
    $query = "SELECT max($id) as maxKode FROM $tabel";
    $hasil = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_array($hasil);
    $kodeBarang = $data['maxKode'];
    if ($kodeBarang == "") {
        $angka = 0;
    } else {
        $angka = substr($kodeBarang, strlen($inisial));
    }
    $angka++;
    $angka  = strval($angka);
    $tmp    = "";
    for ($i = 1; $i <= ($panjang - strlen($inisial) - strlen($angka)); $i++) {
        $tmp = $tmp . "0";
    }


    return $inisial . $tmp . $angka;
}

$id_pengajuan = oto('tb_pengajuan', 'id_pengajuan', 'PJ');
$tgl     =  $_POST['tgl'];
$id_toko = $_SESSION['user']['id_relasi'];


$simpan = mysqli_query($koneksi, "INSERT INTO `tb_pengajuan`(`id_pengajuan`, `tgl_pengajuan`,`id_toko`, `status`) VALUES ('$id_pengajuan','$tgl','$id_toko', '0')");

if ($simpan) {
    $query2 = $koneksi->query("SELECT * FROM tb_tmp_pengajuan");

    foreach ($query2 as $data2) {
        $simpan = mysqli_query($koneksi, "INSERT INTO `tb_detail_pengajuan`(`id`, `id_pengajuan`,`id_bahan_baku`,`jumlah`) VALUES ('','$id_pengajuan','" . $data2['id_bahan_baku'] . "','" . $data2['jumlah'] . "')");
    }
    $hapus = $koneksi->query("truncate tb_tmp_pengajuan");
}

// ALERT
if ($simpan) {
    header("location:../?menu=pengajuan&success=1");
} else {
    echo $koneksi->error;
}
