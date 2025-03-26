<?php
include "../functions/config/koneksi.php";

$id = $_POST['id'];
$tgl     =  $_POST['tgl'];

$id_toko = $_POST['id_toko'];
$id_bahan_baku = $_POST['id_bahan_baku'];
$jml_kirim = $_POST['jml_kirim'];



// $simpan = mysqli_query($koneksi, "SELECT * FROM tb_detail_pengajuan a JOIN tb_pengajuan b ON a.id_pengajuan=b.id_pengajuan LEFT JOIN tb_obat c ON a.id_obat=c.id_obat WHERE a.id_pengajuan='$id'");
foreach ($id_bahan_baku as $data => $d) {
    //simpan ke stok


    //update jml_kirim di detail_pengajuan
    $simpan2 = $koneksi->query("UPDATE tb_detail_pengajuan SET jml_kirim='" . $jml_kirim[$data] . "' WHERE id_pengajuan='" . $id . "' AND id_bahan_baku='" . $id_bahan_baku[$data] . "'");

    //metode fifo
    $query2 = $koneksi->query("SELECT SUM(sisa) as jml_out FROM tb_stok WHERE tipe='in' AND id_bahan_baku='" . $id_bahan_baku[$data] . "'");
    $data2 = $query2->fetch_array();
    $stok_all = $data2['jml_out'];

    $bahan_baku = $id_bahan_baku[$data];
    $qty    = $jml_kirim[$data];

    $sql    = "SELECT * FROM tb_stok WHERE id_bahan_baku = '$bahan_baku' AND tipe='in' AND sisa > 0 ORDER by tgl_kadaluarsa ASC";
    $result = mysqli_query($koneksi, $sql);

    if ($qty <= $stok_all) {

        // Lakukan Perulangan pd setiap List Stok Barang
        // hasil ($result): 

        // nama     tgl          stok       step
        //----------------------------
        // beras    2018-02-01    30         1 (++)
        // beras    2018-02-03    50         2 
        // beras    2018-02-03    40         3 

        while ($row = mysqli_fetch_assoc($result)) {

            $tgl_kadaluarsa  = $row['tgl_kadaluarsa'];
            $stok = $row['sisa'];

            // Selama Qty > 0 (belum habis) artinya => stok pd setiap list akan terus dieksekusi (dikurangi) 
            // logika nya gini :

            // --------loop 1--------
            // qty beli = 50 .... stok (1 feb) = 30 maka 
            // qty - stok => 50 - 30 = 20 (masih kurang maka ambil di stok tgl berikutnya ...)
            // artinya ekseskui lanjut ...

            // --------loop 2--------
            // qty beli = 20 .... stok (3 feb) = 50 maka
            // qty - stok => 20 - 50 = -30 (hasil -minus) artinya $qty > 0 == false ... (tidak terpenuhi)
            // maka pengurangan stok (update data) akan dijalankan sampai disini

            if ($qty > 0) {

                // buat var $temp sbg. pengurang
                $temp = $qty;

                //proses pengurangan
                $qty = $qty - $stok;

                // jika hasil pengurangan > 0 berarti stok pd list pertama kurang  .. jadi update stok jd 0.. 
                // contoh : qty = 50 , stok = 30 .....maka 50 - 30 = 20.. (20 > 0 =>true)
                // dan juga sebaliknya jika stok berikutnya cukup yawess.. $stok - $temp;

                if ($qty > 0) {
                    $stok_update = 0;
                } else {
                    $stok_update = $stok - $temp;
                }

                $sql = "UPDATE tb_stok SET sisa = '$stok_update' WHERE id_bahan_baku = '$bahan_baku' AND tgl_kadaluarsa = '$tgl_kadaluarsa' AND tipe='in'";
                echo "<br>$sql<br><br>";
                $cek = mysqli_query($koneksi, $sql);
                $tes = $temp - $qty - $stok_update;
                $simpan = $koneksi->query("INSERT INTO `tb_stok`(`id_stok`, `tgl`, `jumlah`, `sisa`, `id_bahan_baku`, `tipe`, `id_toko`, `tgl_kadaluarsa`) VALUES ('','$tgl','" . $tes . "','','" . $bahan_baku . "','out','" . $id_toko . "','" . $tgl_kadaluarsa . "')");
            }
        }
    }
}


if ($simpan) {
    $koneksi->query("UPDATE tb_pengajuan SET brg_keluar='1' WHERE id_pengajuan='$id'");
    header("location:../?menu=pengajuan&success=1");
} else {
    echo $koneksi->error;
}
