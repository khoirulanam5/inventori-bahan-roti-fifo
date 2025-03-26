<?php
include "../../functions/lib_function.php";
include "../../functions/config/koneksi.php";
$id_post = isset($_POST['ids']) ? $_POST['ids'] : '';
$query = $koneksi->query("SELECT * from tb_kategori where id_kategori='$id_post'");
$data = $query->fetch_array();
?>
<form action="proccess/kategori_edit.php" method="POST">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
            Edit Kategori
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
                ×
            </span>
        </button>
    </div>
    <div class="modal-body">
        <input value="<?= $id_post ?>" type="hidden" class="form-control" id="id" name="id_kategori">
        <div class="form-group">
            <label for="nama">Nama Kategori</label>
            <input required value="<?= $data['nama_kategori']; ?>" type="text" class="form-control" id="nama" name="nama_kategori">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Simpan</button>
    </div>
</form>