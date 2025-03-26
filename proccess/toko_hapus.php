<?php
include "../functions/config/koneksi.php";

$id     =  $_POST['id'];

$simpan = mysqli_query($koneksi, "DELETE from tb_toko where id_toko='$id'");
