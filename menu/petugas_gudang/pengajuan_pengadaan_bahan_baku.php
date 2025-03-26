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
                <h3>Ajukan Pengadaan</h3>
            </div>
        </div>

        <div class="row" id="cancel-row">
            <div class="col-sm-12 layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <a href="?menu=pengajuan_pengadaan_bahan_baku&p=tambah"><button type="button" class="btn btn-primary">Tambah</button></a>
                    <div class="table-responsive mb-4 mt-4">
                        <table id="zero-config" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID</th>
                                    <th>Tgl Pengajuan</th>
                                    <th>Admin</th>
                                    <th>Pemilik</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $view = list_pengajuan_pengadaan_bahan_baku();
                                foreach ($view as $data) :
                                    if ($data['status_admin'] == '0') {
                                        $status1 = '<font style="color:red">Diproses</font>';
                                    } else {
                                        $status1 = '<font style="color:blue">Disetujui</font>';
                                    }
                                    if ($data['status_pemilik'] == '0') {
                                        $status2 = '<font style="color:red">Diproses</font>';
                                    } else {
                                        $status2 = '<font style="color:blue">Disetujui</font>';
                                    }

                                ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><button id="LihatSupplier" value="<?= $data['id']; ?>" class="lik">#<?= $data['id']; ?> </button></td>
                                        <td><?= ubah_format_tgl($data['tgl']) ?></td>
                                        <td><?= $status1 ?></td>
                                        <td><?= $status2 ?></td>
                                        <td>
                                            <!-- <a href="?menu=pengajuan&p=edit&id=<?= $data['id'] ?>"><span class="badge badge-success"><i class="far fa-edit"></i></span></a> -->
                                            <a href="#"><span onclick="hapus(this)" data-id="<?= $data['id'] ?>" class="badge badge-danger"><i class="far fa-trash-alt"></i></span></a>
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
    alert_validasi(true, $_GET['menu']);
} else if (isset($_GET['fail'])) {
    alert_process($_GET['fail'], false, "Pengajuan", $_GET['menu']);
}
?>
<!-- Modal -->


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
        var fileedit = 'menu/petugas_gudang/pengajuan_pengadaan_bahan_baku_detail.php';
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
        var fileedit = 'menu/admin/toko_edit.php';
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
                        url: 'proccess/pengajuan_pengadaan_bahan_baku_hapus.php', // File yang akan memproses data
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
                                window.location.replace('?menu=pengajuan_pengadaan_bahan_baku');
                            }, 1000);
                        }
                    });
                }
            })
    }
</script>