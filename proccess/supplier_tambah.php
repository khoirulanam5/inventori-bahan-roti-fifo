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

$id_supplier = oto('tb_supplier', 'id_supplier', 'SUP');
$supplier     =  $_POST['supplier'];
$alamat     =  $_POST['alamat'];
$no_hp     =  $_POST['no_hp'];

$simpan = mysqli_query($koneksi, "INSERT INTO `tb_supplier`(`id_supplier`, `nama_supplier`,`alamat`,`no_hp`) VALUES ('$id_supplier','$supplier','$alamat','$no_hp')");

// ALERT
if ($simpan) {
    header("location:../?menu=supplier&success=1");
} else {
    echo $koneksi->error;
}
