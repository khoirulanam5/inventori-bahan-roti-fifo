<?php
include "../../functions/lib_function.php";
include "../../functions/config/koneksi.php";
$id_post = isset($_POST['ids']) ? $_POST['ids'] : '';
$query = $koneksi->query("SELECT * from tb_bahan_baku where id_bahan_baku='$id_post'");
$data = $query->fetch_array();
?>
<form action="proccess/bahan_baku_edit.php" method="POST">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
            Edit Bahan Baku
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
                ×
            </span>
        </button>
    </div>
    <div class="modal-body">
        <input value="<?= $id_post ?>" type="hidden" class="form-control" id="id" name="id_bahan_baku">
        <div class="form-group">
            <label for="nama">Nama Bahan Baku</label>
            <input required value="<?= $data['nama_bahan_baku']; ?>" type="text" class="form-control" id="nama" name="nama_bahan_baku">
        </div>
        <div class="form-group">
            <label>Kategori</label>
            <select class="form-control" name="kategori" id="kategori">
                <?php
                $query2 = list_kategori();
                foreach ($query2 as $data2) :
                ?>
                    <option <?php
                            if ($data2['id_kategori'] == $data['id_kategori']) {
                                echo 'selected';
                            }
                            ?> value="<?= $data2['id_kategori'] ?>"><?= $data2['nama_kategori'] ?></option>
                <?php
                endforeach;
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Harga</label>
            <input value="<?= $data['harga']; ?>" required type="text" class="form-control" id="harga" name="harga">
        </div>
        <div class="form-group">
            <label>Limit Pengiriman</label>
            <input value="<?= $data['max_keluar']; ?>" required type="text" class="form-control" id="max_keluar" name="max_keluar">
        </div>
        <div class="form-group">
            <label>Nama Toko</label>
                <select class="form-control" name="id_toko" id="id_toko">
                <?php
                    $query = list_toko();
                    foreach ($query as $data) :
                    ?>
                    <option value="<?= $data['id_toko'] ?>"><?= $data['nama_toko'] ?></option>
                    <?php
                    endforeach;
                    ?>
                </select>
            </div>
        <!-- <div class="form-group">
            <label>Tgl Kadaluarsa</label>
            <input value="<?= $data['tgl_kadaluarsa']; ?>" required type="date" class="form-control" id="tgl_kadaluarsa" name="tgl_kadaluarsa">
        </div> -->
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Simpan</button>
    </div>
</form>