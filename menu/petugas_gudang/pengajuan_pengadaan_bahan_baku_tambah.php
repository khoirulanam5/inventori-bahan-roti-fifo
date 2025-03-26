<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="layout-spacing mt-3">
            <div class="widget-content widget-content-area br-6">
                <form action="proccess/pengajuan_pengadaan_bahan_baku_tambah.php" method="POST">
                    <h5 class="card-title">Transaksi Ajukan Pengadaan</h5>
                    <hr>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input required type="date" class="form-control" id="tgl" name="tgl">
                        </div>
                    </div>
                    <div class="table-responsive mb-4 mt-4">
                        <button type="button" data-toggle="modal" data-target="#tambah_data" class="btn btn-primary mb-2 TambahData">Tambah Data</button>
                        <table class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Bahan Baku</th>
                                    <th>Jumlah (Kg)</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $view = list_tmp_pengajuan_pengadaan_bahan_baku();
                                foreach ($view as $data) :
                                ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $data['nama_bahan_baku'] ?></td>
                                        <td><?= $data['jumlah'] ?></td>
                                        <td>
                                            <a href="#"><span onclick="hapus(this)" data-id="<?= $data['id'] ?>" class="badge badge-danger"><i class="far fa-trash-alt"></i></span></a>
                                        </td>
                                    </tr>
                                <?php
                                endforeach;
                                ?>
                            </tbody>

                        </table>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary mb-2">Simpan Transaksi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="tambah_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="proccess/pengajuan_pengadaan_bahan_baku_tambah_data.php" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Bahan Baku</label>
                        <select class="form-control" name="bahan_baku" id="bahan_baku">
                            <?php
                            $query = list_bahan_baku();
                            foreach ($query as $data) :
                            ?>
                                <option value="<?= $data['id_bahan_baku'] ?>"><?= $data['nama_bahan_baku'] ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jumlah (Kg)</label>
                        <input required type="text" class="form-control" id="jumlah" name="jumlah">
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
                        url: 'proccess/pengajuan_tambah_hapus.php', // File yang akan memproses data
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
                                window.location.replace('?menu=pengajuan&p=tambah');
                            }, 1000);
                        }
                    });
                }
            })
    }
</script>