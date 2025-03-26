<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="layout-spacing mt-3">
            <div class="widget-content widget-content-area br-6">
                <form action="proccess/pengadaan_tambah.php" method="POST">
                    <h5 class="card-title">Transaksi Pengadaan Ke Supplier</h5>
                    <hr>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Pilih Kode Pengajuan Pengadaan</label>
                            <select class="form-control" name="id_pengajuan" id="id_pengajuan">
                                <?php
                                $query = list_pengajuan_pengadaan_bahan_baku_by();
                                foreach ($query as $data) :
                                ?>
                                    <option value="<?= $data['id'] ?>"><?= $data['id'] ?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                        <input type="submit" name="pilih" value="Pilih Pengajuan" class="btn btn-primary mb-2">
                    </div>
                    <hr>
                    <div class="table-responsive mb-4 mt-4">
                        <!-- <button type="button" data-toggle="modal" data-target="#tambah_data" class="btn btn-primary mb-2 TambahData">Tambah Data</button> -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input required value="<?= date('Y-m-d') ?>" type="date" class="form-control" id="tgl" name="tgl">
                            </div>
                            <div class="form-group">
                                <label>Supplier</label>
                                <select class="form-control" name="supplier" id="supplier">
                                    <?php
                                    $query = list_supplier();
                                    foreach ($query as $data) :
                                    ?>
                                        <option value="<?= $data['id_supplier'] ?>"><?= $data['nama_supplier'] ?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <table class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Bahan Baku</th>
                                    <th>Tgl Kadaluarsa</th>
                                    <th>Harga (Rp)</th>
                                    <th>Jumlah (Kg)</th>
                                    <th>Subtotal (Rp)</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include "functions/config/koneksi.php";
                                $i = 1;
                                $view = list_tmp_pengadaan();
                                foreach ($view as $data) :
                                ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $data['nama_bahan_baku'] ?></td>
                                        <td><?= ubah_format_tgl($data['tgl_ex']) ?></td>
                                        <td><?= rp($data['hrg']) ?></td>
                                        <td><?= $data['jumlah'] ?></td>
                                        <td><?= rp($data['jumlah'] * $data['hrg']) ?></td>
                                        <td>
                                            <a href="#" id="EditSupplier" data-id="<?= $data['id']; ?>"><span class="badge badge-success"><i class="far fa-edit"></i></span></a>
                                            <a href="#"><span onclick="hapus(this)" data-id="<?= $data['id'] ?>" class="badge badge-danger"><i class="far fa-trash-alt"></i></span></a>
                                        </td>
                                    </tr>
                                <?php
                                endforeach;

                                $query = $koneksi->query("SELECT SUM(harga*jumlah) as total FROM tb_tmp_pengadaan");
                                $data = $query->fetch_array();
                                $total = $data['total'];
                                ?>
                                <tr>
                                    <th colspan="5">GRAND TOTAL (Rp) :</th>
                                    <th><?= rp($total) ?></th>
                                    <input type="hidden" name="total" id="total" value="<?= $total ?>">
                                </tr>
                            </tbody>

                        </table>
                    </div>
                    <div class="text-right">
                        <input type="submit" name="simpan" value="Simpan Transaksi" class="btn btn-primary mb-2">
                        <!-- <button type="submit" class="btn btn-primary mb-2">Simpan Transaksi</button> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="tambah_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="proccess/pengadaan_tambah_data.php" method="POST">
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
                        <label>harga (Rp)</label>
                        <input required type="text" class="form-control" id="harga" name="harga">
                    </div>
                    <div class="form-group">
                        <label>Jumlah (Kg)</label>
                        <input required type="text" class="form-control" id="jumlah" name="jumlah">
                    </div>
                    <div class="form-group">
                        <label>Tgl Kadaluarsa</label>
                        <input required type="date" class="form-control" id="tgl_kadaluarsa" name="tgl_kadaluarsa">
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
        var fileedit = 'menu/petugas_gudang/pengadaan_tambah_edit.php';
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
                        url: 'proccess/pengadaan_tambah_hapus.php', // File yang akan memproses data
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
                                window.location.replace('?menu=pengadaan&p=tambah');
                            }, 1000);
                        }
                    });
                }
            })
    }
</script>