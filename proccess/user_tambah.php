<?php
include "../functions/config/koneksi.php";

function oto($tabel, $id, $inisial)
{
    include "../functions/config/koneksi.php";
    $panjang = 3;
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
$id_user = oto('tb_user', 'id_user', 'U');
$username     =  $_POST['username'];
$password     =  $_POST['password'];
$level     =  $_POST['level'];
$id_relasi     =  $_POST['petugas_toko'];

$simpan = mysqli_query($koneksi, "INSERT INTO `tb_user`(`id_user`, `username`,`password`,`level`,`id_relasi`) VALUES ('$id_user','$username','$password','$level','$id_relasi')");
if ($simpan) {
    header("location:../?menu=user&success=1");
} else {
    echo $koneksi->error;
}
