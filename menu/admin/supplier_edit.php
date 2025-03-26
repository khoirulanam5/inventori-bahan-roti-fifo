<?php
include "../../functions/lib_function.php";
include "../../functions/config/koneksi.php";
$id_post = isset($_POST['ids']) ? $_POST['ids'] : '';
$query = $koneksi->query("SELECT * from tb_supplier where id_supplier='$id_post'");
$data = $query->fetch_array();
?>
<form action="proccess/supplier_edit.php" method="POST">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
            Edit Supplier
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
                ×
            </span>
        </button>
    </div>
    <div class="modal-body">

        <input value="<?= $id_post ?>" type="hidden" class="form-control" id="id" name="id_supplier">

        <div class="form-group">
            <label>Supplier</label>
            <input required value="<?= $data['nama_supplier']; ?>" type="text" class="form-control" id="supplier" name="supplier">
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <input required value="<?= $data['alamat']; ?>" type="text" class="form-control" id="alamat" name="alamat">
        </div>
        <div class="form-group">
            <label>No Hp</label>
            <input required value="<?= $data['no_hp']; ?>" type="text" class="form-control" id="no_hp" name="no_hp">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Simpan</button>
    </div>
</form>