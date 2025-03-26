<?php
require_once("../../functions/config/koneksi.php");
require_once("../../functions/lib_function.php");
$id = $_POST['ids'];
$query = $koneksi->query("SELECT *,a.harga as hrg,a.tgl_kadaluarsa as tgl_ex from tb_detail_pengadaan a JOIN tb_bahan_baku b ON a.id_bahan_baku=b.id_bahan_baku WHERE a.id_pengadaan='$id'");

$query2 = $koneksi->query("SELECT SUM(harga*jumlah) as total FROM tb_detail_pengadaan WHERE id_pengadaan='$id'");
$data2 = $query2->fetch_array();
$total = $data2['total'];
?>


<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title"><i class="icon-add mr-2"></i>Detail pengadaan #<?= $id; ?></h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>

    <div class="modal-body">
        <table class="table table-bordered">
            <tr>
                <th>No.</th>
                <th>Bahan Baku</th>
                <th>Tgl Kadaluarsa</th>
                <th>Harga (Rp)</th>
                <th>Jumlah (Kg)</th>
                <th>Subtotal (Rp)</th>
            </tr>
            <?php
            $no = 1;
            foreach ($query as $data) :
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $data['nama_bahan_baku'] ?></td>
                    <td><?= ubah_format_tgl($data['tgl_ex']) ?></td>
                    <td><?= rp($data['hrg']) ?></td>
                    <td><?= $data['jumlah'] ?></td>
                    <td><?= rp($data['jumlah'] * $data['hrg']) ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <th colspan="5">GRAND TOTAL (Rp) :</th>
                <th><?= rp($total) ?></th>
                <input type="hidden" name="total" id="total" value="<?= $total ?>">
            </tr>
        </table>

    </div>

    <div class="modal-footer">
        <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i>
            Tutup</button>
    </div>
</div>