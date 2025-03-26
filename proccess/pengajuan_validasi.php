<?php
include "../functions/config/koneksi.php";

$id = $_GET['id'];

$simpan = mysqli_query($koneksi, "UPDATE tb_pengajuan SET status='1' WHERE id_pengajuan='$id'");
if ($simpan) {
    header("location:../?menu=pengajuan&success=4");
    exit();
} else {
    echo $koneksi->error;
}
