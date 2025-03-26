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

$id_toko = oto('tb_toko', 'id_toko', 'TK');
$toko     =  $_POST['toko'];
$alamat     =  $_POST['alamat'];
$no_hp     =  $_POST['no_hp'];

$simpan = mysqli_query($koneksi, "INSERT INTO `tb_toko`(`id_toko`, `nama_toko`,`alamat_toko`,`no_hp`) VALUES ('$id_toko','$toko','$alamat','$no_hp')");
if ($simpan) {
    header("location:../?menu=toko&success=1");
} else {
    echo $koneksi->error;
}
