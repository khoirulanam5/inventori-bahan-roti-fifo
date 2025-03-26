<?php
include "../../functions/lib_function.php";
include "../../functions/config/koneksi.php";

$id_post = isset($_POST['ids']) ? $_POST['ids'] : '';
$query = $koneksi->query("SELECT * from tb_user where id_user='$id_post'");
$data = $query->fetch_array();
?>

<form action="proccess/user_edit.php" method="POST">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
        <input value="<?= $id_post ?>" type="hidden" class="form-control" id="id" name="id_user">
        <div class="form-group">
            <label>Level</label>
            <select onchange="show_pusk()" class="form-control" name="level" id="level2">
                <option <?= ($data['level'] == 'petugas_produksi') ? 'selected' : '' ?> value="petugas_produksi">Petugas Produksi</option>
                <option <?= ($data['level'] == 'petugas_gudang') ? 'selected' : '' ?> value="petugas_gudang">Petugas Gudang</option>
                <option <?= ($data['level'] == 'pemilik') ? 'selected' : '' ?> value="pemilik">Pemilik</option>
                <option <?= ($data['level'] == 'admin') ? 'selected' : '' ?> value="admin">Admin</option>
                <option <?= ($data['level'] == 'petugas_toko') ? 'selected' : '' ?> value="petugas_toko">Petugas Toko</option>
            </select>
        </div>
        <?php
        $kls = ($data['level'] == 'petugas_toko') ? 'block' : 'none';
        ?>
        <div id="pusk2" class="form-group" style="display: <?= $kls ?>;">
            <label>Toko</label>
            <select class="form-control" name="petugas_toko" id="petugas_toko">
                <option value="">-=Pilih Opsi=-</option>
                <?php
                $query2 = list_toko();
                foreach ($query2 as $data2) :
                ?>
                    <option <?= ($data['id_relasi'] == $data2['id_toko']) ? 'selected' : '' ?> value="<?= $data2['id_toko'] ?>"><?= $data2['nama_toko'] ?></option>
                <?php
                endforeach;
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Username</label>
            <input required value="<?= $data['username']; ?>" type="text" class="form-control" id="username" name="username">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input required value="<?= $data['password']; ?>" type="password" class="form-control" id="password" name="password">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Simpan</button>
    </div>
</form>

<script>
    function show_pusk() {
        var level = $('#level2').val();
        if (level == 'petugas_toko') {
            $('#pusk2').show();
        } else {
            $('#pusk2').hide();
        }
    }
</script>
