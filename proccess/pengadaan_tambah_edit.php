<?php
include "../functions/config/koneksi.php";


$id     =  $_POST['id'];
$jumlah     =  $_POST['jumlah'];
$tgl_kadaluarsa     =  $_POST['tgl_kadaluarsa'];


$simpan = mysqli_query($koneksi, "UPDATE tb_tmp_pengadaan SET jumlah='$jumlah',tgl_kadaluarsa='$tgl_kadaluarsa' WHERE id='$id'");
if ($simpan) {
    header("location:../?menu=pengadaan&p=tambah");
} else {
    echo $koneksi->error;
}
