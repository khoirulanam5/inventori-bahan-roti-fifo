<?php
include "../functions/config/koneksi.php";

$id     =  $_POST['id'];

$simpan = mysqli_query($koneksi, "DELETE from tb_tmp_pengajuan where id='$id'");
