<?php
include "../functions/config/koneksi.php";

$id     =  $_POST['id'];

$simpan = mysqli_query($koneksi, "DELETE from tb_detail_pengajuan_pengadaan_bahan_baku where id='$id'");
