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
                <th>Aksi</th>
            </tr>
            <?php
            $no = 1;
            foreach ($query as $data) :

            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $data['nama_bahan_baku']; ?></td>
                    <td><?= $data['jumlah']; ?></td>
                    <td>
                        <a href="#"><span onclick="hapus2(this)" data-id="<?= $data['id'] ?>" class="badge badge-danger"><i class="far fa-trash-alt"></i></span></a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>

    </div>

    <div class="modal-footer">
        <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i>
            Tutup</button>
    </div>
</div>

<script>
    function hapus2(dt) {
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
                        url: 'proccess/pengajuan_pengadaan_bahan_baku_hapus_detail.php', // File yang akan memproses data
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
                                window.location.replace('?menu=pengajuan_pengadaan_roti');
                            }, 1000);
                        }
                    });
                }
            })
    }
</script>