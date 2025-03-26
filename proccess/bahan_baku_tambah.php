<?php
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
$id_bahan_baku = oto('tb_bahan_baku', 'id_bahan_baku', 'BB');
$bahan_baku     =  $_POST['bahan_baku'];
$kategori     =  $_POST['kategori'];
$harga     =  $_POST['harga'];

// ALERT
$simpan = mysqli_query($koneksi, "INSERT INTO `tb_bahan_baku`(`id_bahan_baku`, `nama_bahan_baku`,`id_kategori`,`harga`) VALUES ('$id_bahan_baku','$bahan_baku','$kategori','$harga')");
if ($simpan) {
    header("location:../?menu=bahan_baku&success=1");
} else {
    echo $koneksi->error;
}
