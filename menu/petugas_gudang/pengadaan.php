<style>
    .lik {
        background-color: transparent;
        border: 0;
        color: blue;
    }
</style>
<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="page-header">
            <div class="page-title">
                <h3>Data Pengadaan</h3>
            </div>
        </div>

        <div class="row" id="cancel-row">
            <div class="col-sm-12 layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <a href="?menu=pengadaan&p=tambah"><button type="button" class="btn btn-primary">Tambah</button></a>
                    <div class="table-responsive mb-4 mt-4">
                        <table id="zero-config" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID</th>
                                    <th>Supplier</th>
                                    <th>Tgl Pengadaan</th>
                                    <th>Total Harga (Rp)</th>
                                    <th>Aksi</th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $view = list_pengadaan();
                                foreach ($view as $data) :
                                ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><button id="LihatSupplier" value="<?= $data['id_pengadaan']; ?>" class="lik">#<?= $data['id_pengadaan']; ?> </button></td>
                                        <td><?= $data['nama_supplier'] ?></td>
                                        <td><?= ubah_format_tgl($data['tgl_pengadaan']) ?></td>
                                        <td><?= rp($data['total']) ?></td>
                                        <td>
                                            <!-- <a href="?menu=pengajuan&p=edit&id=<?= $data['id_pengajuan'] ?>"><span class="badge badge-success"><i class="far fa-edit"></i></span></a> -->
                                            <a href="#"><span onclick="hapus(this)" data-id="<?= $data['id_pengadaan'] ?>" class="badge badge-danger"><i class="far fa-trash-alt"></i></span></a>
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
    alert_process($_GET['success'], true, "Pengajuan", $_GET['menu']);
} else if (isset($_GET['fail'])) {
    alert_process($_GET['fail'], false, "Pengajuan", $_GET['menu']);
}
?>
<!-- Modal -->
<div class="modal fade" id="tambah_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="proccess/toko_tambah.php" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Toko</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Toko</label>
                        <input required type="text" class="form-control" id="toko" name="toko">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input required type="text" class="form-control" id="alamat" name="alamat">
                    </div>
                    <div class="form-group">
                        <label>No Hp</label>
                        <input required type="number" class="form-control" id="no_hp" name="no_hp">
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

<div class="modal fade" id="modalku2">
    <div class="modal-dialog modal-lg">
        <div id="modal_tambah2" class="modal-content">
            ....
        </div>
    </div>
</div>


<script>
    $(document).on('click', '#LihatSupplier', function(e) {
        var id_supplier = $(this).val();
        $('#modalku2').modal('show');
        var fileedit = 'menu/petugas_gudang/pengadaan_detail.php';
        $.ajax({
            type: 'POST',
            url: fileedit,
            data: 'ids=' + id_supplier,
            success: function(data) {
                $('#modal_tambah2').html(data);
            }
        });
    });
    //edit tampilan
    $(document).on('click', '#EditSupplier', function(e) {
        var id_supplier = $(this).data('id');
        $('#modalku').modal('show');
        var fileedit = 'menu/petugas_gudang/pengajuan_kirim_barang.php';
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
                        url: 'proccess/pengadaan_hapus.php', // File yang akan memproses data
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
                                window.location.replace('?menu=pengadaan');
                            }, 1000);
                        }
                    });
                }
            })
    }
</script>