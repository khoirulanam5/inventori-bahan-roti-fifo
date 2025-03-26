<?php
include "../functions/config/koneksi.php";

$id_supplier     =  $_POST['id_supplier'];
$supplier     =  $_POST['supplier'];
$alamat     =  $_POST['alamat'];
$no_hp     =  $_POST['no_hp'];

$simpan = mysqli_query($koneksi, "UPDATE `tb_supplier` SET 
                                `nama_supplier`='$supplier',
                                `alamat`='$alamat',
                                `no_hp`='$no_hp'
                                WHERE id_supplier='$id_supplier'");

// ALERT
if ($simpan) {
    header("location:../?menu=supplier&success=2");
} else {
    echo $koneksi->error;
}
