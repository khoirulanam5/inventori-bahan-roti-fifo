<?php
require_once("../../functions/config/koneksi.php");
require_once("../../functions/lib_function.php");
$id = $_POST['ids'];
$query = $koneksi->query("SELECT * from tb_detail_pengajuan_pengadaan_bahan_baku a JOIN tb_bahan_baku b ON a.id_bahan_baku=b.id_bahan_baku WHERE a.id_pengajuan_pengadaan_bahan_baku='$id'");
?>

<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title"><i class="icon-add mr-2"></i>Detail Pengajuan #<?= $id; ?></h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>

    <div class="modal-body">
        <table class="table table-bordered">
            <tr>
                <th>No.</th>
                <th>Bahan Baku</th>
                <th>Jumlah (Kg)</th>
            </tr>
            <?php
            $no = 1;
            foreach ($query as $data) :

            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $data['nama_bahan_baku']; ?></td>
                    <td><?= $data['jumlah']; ?></td>

                </tr>
            <?php endforeach; ?>

        </table>

    </div>

    <div class="modal-footer">
        <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i>
            Tutup</button>

    </div>
</div>