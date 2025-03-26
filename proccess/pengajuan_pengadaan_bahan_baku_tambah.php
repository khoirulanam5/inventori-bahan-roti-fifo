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

$id_pengajuan = oto('tb_pengajuan_pengadaan_bahan_baku', 'id', 'PPBB');
$tgl     =  $_POST['tgl'];

$simpan = mysqli_query($koneksi, "INSERT INTO `tb_pengajuan_pengadaan_bahan_baku`(`id`, `tgl`) VALUES ('$id_pengajuan','$tgl')");

if ($simpan) {
    $query2 = $koneksi->query("SELECT * FROM tb_tmp_pengajuan_pengadaan_bahan_baku");

    foreach ($query2 as $data2) {
        $simpan = mysqli_query($koneksi, "INSERT INTO `tb_detail_pengajuan_pengadaan_bahan_baku`(`id`, `id_pengajuan_pengadaan_bahan_baku`,`id_bahan_baku`,`jumlah`) VALUES ('','$id_pengajuan','" . $data2['id_bahan_baku'] . "','" . $data2['jumlah'] . "')");
    }
    $hapus = $koneksi->query("truncate tb_tmp_pengajuan_pengadaan_bahan_baku");
}

// ALERT
if ($simpan) {
    header("location:../?menu=pengajuan_pengadaan_bahan_baku&success=1");
} else {
    echo $koneksi->error;
}
