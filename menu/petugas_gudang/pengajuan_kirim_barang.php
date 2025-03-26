<?php
include "../../functions/lib_function.php";
include "../../functions/config/koneksi.php";
$id_post = isset($_POST['ids']) ? $_POST['ids'] : '';
$query = $koneksi->query("SELECT * from tb_pengajuan a JOIN tb_detail_pengajuan b ON a.id_pengajuan=b.id_pengajuan LEFT JOIN tb_bahan_baku c ON b.id_bahan_baku=c.id_bahan_baku where a.id_pengajuan='$id_post'");
$data = $query->fetch_array();

$query2 = $koneksi->query("SELECT * from tb_pengajuan a JOIN tb_bahan_baku b ON b.id_bahan_baku=b.id_bahan_baku where a.id_pengajuan='$id_post'");
$data2 = $query2->fetch_array();
?>

<form onsubmit="return CekStok()" action="proccess/pengajuan_kirim_barang.php" method="POST">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
            Kirim Bahan Baku
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
                ×
            </span>
        </button>
    </div>
    <div class="modal-body">

        <input value="<?= $id_post ?>" type="hidden" class="form-control" id="id" name="id">
        <input readonly value="<?= $data2['id_toko'] ?>" type="" class="form-control" id="toko" name="toko">
        <input readonly value="<?= date('Y-m-d') ?>" type="hidden" class="form-control" id="tgl" name="tgl">
        <input value="<?= $data['id_toko'] ?>" size="3" type="hidden" name="id_toko" id="">
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Bahan Baku</th>
                <th>Jumlah Ajuan (Kg)</th>
                <th>Jumlah Kirim (Kg)</th>
            </tr>
            <?php
                $no = 1;
                foreach ($query as $data) :
                    $query3 = $koneksi->query("SELECT SUM(sisa) as sisa FROM tb_stok WHERE tipe='in' AND id_bahan_baku='$data[id_bahan_baku]'");
                    $data3 = $query3->fetch_array();
                    $sisa = $data3['sisa'];
                    $limit = $sisa; // Pastikan $limit diatur sesuai dengan nilai stok yang tersedia
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data['nama_bahan_baku']; ?></td>
                        <td><?= $data['jumlah']; ?></td>
                        <td>
                            <input value="<?= $data['id_bahan_baku'] ?>" size="3" type="hidden" name="id_bahan_baku[]" id="">
                            <input value="<?= $limit ?>" size="3" type="hidden" name="jml_stok[]" id="jml_stok">
                            <input min="1" required style="width: 60px;" size="3" type="number" name="jml_kirim[]" id="jml_kirim">
                            <small style="color: orangered; display: none;">Stok tidak cukup!</small>
                        </td>
                    </tr>
                <?php endforeach; ?>

        </table>

    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success">Konfirmasi</button>
    </div>
</form>
<?php
if (isset($_GET['success'])) {
    alert_pengiriman($_GET['success'], true, $_GET['menu']);
} else if (isset($_GET['error'])) {
    alert_pengiriman($_GET['error'], false, $_GET['menu']);
}
?>
<script>
    function CekStok() {
    var boxes = document.getElementsByName("jml_kirim[]");
    var jml_stok = document.getElementsByName("jml_stok[]");
    var ret = true;

    for (var x = 0; x < boxes.length; x++) {
        var kirimValue = parseInt(boxes[x].value);
        var stokValue = parseInt(jml_stok[x].value);

        if (isNaN(kirimValue) || isNaN(stokValue)) {
            continue; // Skip iteration if values are not numbers
        }

        if (kirimValue > stokValue) {
            $(boxes[x]).next('small').show();
            $(boxes[x]).css('border-color', 'orangered');
            ret = false;
        } else {
            $(boxes[x]).next('small').hide();
            $(boxes[x]).css('border-color', '');
        }
    }

    return ret;
}
</script>