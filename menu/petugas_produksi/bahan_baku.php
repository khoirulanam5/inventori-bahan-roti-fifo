<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="page-header">
            <div class="page-title">
                <h3>Data Bahan Baku</h3>
            </div>
        </div>

        <div class="row" id="cancel-row">
            <div class="col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah_data">Tambah</button>
                    <div class="table-responsive mb-4 mt-4">
                        <table id="zero-config" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Bahan Baku</th>
                                    <th>Kategori</th>
                                    <th>Harga (Rp)</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $view = list_bahan_baku();
                                foreach ($view as $data) :
                                ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $data['nama_bahan_baku'] ?></td>
                                        <td><?= $data['nama_kategori'] ?></td>
                                        <td><?= rp($data['harga']) ?></td>
                                        <td>
                                            <a href="#" id="EditSupplier" data-id="<?= $data['id_bahan_baku']; ?>"><span class="badge badge-success"><i class="far fa-edit"></i></span></a>
                                            <a href="#"><span onclick="hapus(this)" data-id="<?= $data['id_bahan_baku'] ?>" class="badge badge-danger"><i class="far fa-trash-alt"></i></span></a>
                                        </td>
                                    </tr>
                                <?php
                                endforeach;
                                ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_GET['success'])) {
    alert_process($_GET['success'], true, "bahan_baku", $_GET['menu']);
} else if (isset($_GET['fail'])) {
    alert_process($_GET['fail'], false, "bahan_baku", $_GET['menu']);
}
?>
<!-- Modal -->
<div class="modal fade" id="tambah_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="proccess/bahan_baku_tambah.php" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Bahan Baku</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Bahan Baku</label>
                        <input autofocus="" required type="text" class="form-control" id="bahan_baku" name="bahan_baku">
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select class="form-control" name="kategori" id="kategori">
                            <?php
                            $query = list_kategori();
                            foreach ($query as $data) :
                            ?>
                                <option value="<?= $data['id_kategori'] ?>"><?= $data['nama_kategori'] ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Harga (Rp)</label>
                        <input required type="text" class="form-control" id="harga" name="harga">
                    </div>
                    <div class="form-group">
                        <label>Nama Toko</label>
                        <select class="form-control" name="id_toko" id="id_toko" readonly>
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalku">
    <div class="modal-dialog">
        <div id="modal_tambah" class="modal-content">
            ....
        </div>
    </div>
</div>


<script>
    //edit tampilan
    $(document).on('click', '#EditSupplier', function(e) {
        var id_supplier = $(this).data('id');
        $('#modalku').modal('show');
        var fileedit = 'menu/petugas_produksi/bahan_baku_edit.php';
        $.ajax({
            type: 'POST',
            url: fileedit,
            data: 'ids=' + id_supplier,
            success: function(data) {
                $('#modal_tambah').html(data);
            }
        });
    });
</script>

<script>
    function hapus(dt) {
        var id = $(dt).data('id');
        swal.fire({
                title: "Yakin ingin menghapus?",
                text: "Data yang terhapus akan hilang permanen!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Hapus",
                cancelButtonText: "Batal",
                confirmButtonClass: "btn btn-success mr-3",
                cancelButtonClass: "btn btn-danger",
                buttonsStyling: !1,
            })
            .then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST', // Metode pengiriman data menggunakan POST
                        url: 'proccess/bahan_baku_hapus.php', // File yang akan memproses data
                        data: 'id=' + id,
                        dataType: "html",
                        success: function(response) {
                            setTimeout(function() {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000
                                });

                                Toast.fire({
                                    type: 'success',
                                    title: 'Hapus Berhasil',
                                    text: 'Hapus Data Berhasil'
                                })
                            }, 10);
                            window.setTimeout(function() {
                                window.location.replace('?menu=bahan_baku');
                            }, 1000);
                        }
                    });
                }
            })
    }
</script>