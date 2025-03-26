<?php
session_start();
include "../functions/config/koneksi.php";

if (isset($_POST['pilih'])) {
    $koneksi->query("truncate tb_tmp_pengadaan");

    $id_pengajuan = $_POST['id_pengajuan'];

    $query = $koneksi->query("SELECT * FROM tb_detail_pengajuan_pengadaan_bahan_baku a LEFT JOIN tb_bahan_baku b ON a.id_bahan_baku=b.id_bahan_baku WHERE a.id_pengajuan_pengadaan_bahan_baku='$id_pengajuan'");
    foreach ($query as $data) {
        $simpan = mysqli_query($koneksi, "INSERT INTO `tb_tmp_pengadaan`(`id`,`id_bahan_baku`,`harga`, `jumlah`,`tgl_kadaluarsa`) VALUES ('','" . $data['id_bahan_baku'] . "','" . $data['harga'] . "','','')");
    }

    header("location:../?menu=pengadaan&p=tambah");
} else {

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
    $id_pengajuan = $_POST['id_pengajuan'];
    $id_pengadaan = oto('tb_pengadaan', 'id_pengadaan', 'PN');
    $tgl     =  $_POST['tgl'];
    $supplier = $_POST['supplier'];
    $total = $_POST['total'];

    $simpan = mysqli_query($koneksi, "INSERT INTO `tb_pengadaan`(`id_pengadaan`,`id_supplier`, `tgl_pengadaan`,`total`) VALUES ('$id_pengadaan','$supplier','$tgl','$total')");

    if ($simpan) {
        $query2 = $koneksi->query("SELECT * FROM tb_tmp_pengadaan");

        foreach ($query2 as $data2) {
            $simpan = mysqli_query($koneksi, "INSERT INTO `tb_detail_pengadaan`(`id`, `id_pengadaan`,`id_bahan_baku`,`harga`, `jumlah`,`tgl_kadaluarsa`) VALUES ('','$id_pengadaan','" . $data2['id_bahan_baku'] . "','" . $data2['harga'] . "','" . $data2['jumlah'] . "','" . $data2['tgl_kadaluarsa'] . "')");

            $simpan2 = $koneksi->query("INSERT INTO `tb_stok`(`id_stok`, `tgl`, `jumlah`, `sisa`, `id_bahan_baku`, `tipe`, `id_toko`, `tgl_kadaluarsa`) VALUES ('','$tgl','" . $data2['jumlah'] . "','" . $data2['jumlah'] . "','" . $data2['id_bahan_baku'] . "','in','','" . $data2['tgl_kadaluarsa'] . "')");
        }
        if ($simpan2) {
            $hapus = $koneksi->query("truncate tb_tmp_pengadaan");

            $koneksi->query("UPDATE tb_pengajuan_pengadaan_bahan_baku SET selesai='1' WHERE id='$id_pengajuan'");
        }
    }

    if ($simpan) {
        header("location:../?menu=pengadaan&success=1");
    } else {
        echo $koneksi->error;
    }
}
