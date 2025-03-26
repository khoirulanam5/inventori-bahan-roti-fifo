<?php
include "../../functions/lib_function.php";
include "../../functions/config/koneksi.php";
$id_post = isset($_POST['ids']) ? $_POST['ids'] : '';
$query = $koneksi->query("SELECT * from tb_tmp_pengadaan a JOIN tb_bahan_baku b ON a.id_bahan_baku=b.id_bahan_baku where a.id='$id_post'");
$data = $query->fetch_array();
?>
<form action="proccess/pengadaan_tambah_edit.php" method="POST">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
            Edit
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
                ×
            </span>
        </button>
    </div>
    <div class="modal-body">
        <input value="<?= $id_post ?>" type="hidden" class="form-control" id="id" name="id">
        <div class="form-group">
            <label>Bahan Baku</label>
            <input readonly value="<?= $data['nama_bahan_baku']; ?>" type="text" class="form-control" id="bahan_baku" name="bahan_baku">
        </div>
        <div class="form-group">
            <label>Harga (Rp)</label>
            <input readonly value="<?= $data['harga']; ?>" type="text" class="form-control" id="harga" name="harga">
        </div>
        <div class="form-group">
            <label>Jumlah (Kg)</label>
            <input required type="number" class="form-control" id="jumlah" name="jumlah">
        </div>
        <div class="form-group">
            <label>Tgl Kadaluarsa</label>
            <input required type="date" class="form-control" id="tgl_kadaluarsa" name="tgl_kadaluarsa">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Simpan</button>
    </div>
</form>