<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="page-header">
            <div class="page-title">
                <h3>Data User</h3>
            </div>
        </div>
        <div class="row" id="cancel-row">
            <div class="col-sm-12 layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah_data">Tambah</button>
                    <div class="table-responsive mb-4 mt-4">
                        <table id="zero-config" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Level</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $view = list_user();
                                foreach ($view as $data) :
                                    if ($data['level'] == 'pemilik') {
                                        $level = ucfirst('Pemilik');
                                    } else if ($data['level'] == 'admin') {
                                        $level = ucfirst('Admin');
                                    } else {
                                        $level = ucfirst($data['level']);
                                    }

                                    if (empty($data['id_relasi'])) {
                                        $level2 = '';
                                    } else {
                                        $level2 = ' (' . $data['nama_toko'] . ')';
                                    }

                                ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $data['username'] ?></td>
                                        <td><?= $data['password'] ?></td>
                                        <td><?= $level . $level2 ?></td>
                                        <td>
                                            <a href="#" id="EditSupplier" data-id="<?= $data['id_user']; ?>"><span class="badge badge-success"><i class="far fa-edit"></i></span></a>
                                            <a href="#"><span onclick="hapus(this)" data-id="<?= $data['id_user'] ?>" class="badge badge-danger"><i class="far fa-trash-alt"></i></span></a>
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
    alert_process($_GET['success'], true, "User", $_GET['menu']);
} else if (isset($_GET['fail'])) {
    alert_process($_GET['fail'], false, "User", $_GET['menu']);
}
?>
<!-- Modal Tambah Data -->
<div class="modal fade" id="tambah_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="proccess/user_tambah.php" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Level</label>
                        <select onchange="show_pusk()" class="form-control" name="level" id="level">
                            <option value="petugas_produksi">Petugas Produksi</option>
                            <option value="petugas_gudang">Petugas Gudang</option>
                            <option value="pemilik">Pemilik</option>
                            <option value="admin">Admin</option>
                            <option value="petugas_toko">Petugas Toko</option>
                        </select>
                    </div>

                    <div id="pusk" class="form-group" style="display: none;">
                        <label>Toko</label>
                        <select class="form-control" name="petugas_toko" id="petugas_toko">
                            <option value="">-=Pilih Opsi=-</option>
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
                    <div class="form-group">
                        <label>Username</label>
                        <input required type="text" class="form-control" id="username" name="username">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input required type="password" class="form-control" id="password" name="password">
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

<!-- Modal Edit Data -->
<div class="modal fade" id="modalku">
    <div class="modal-dialog">
        <div id="modal_tambah" class="modal-content">
            ....
        </div>
    </div>
</div>

<script>
    function show_pusk() {
        var level = $('#level').val();
        if (level == 'petugas_toko') {
            $('#pusk').show();
        } else {
            $('#pusk').hide();
        }
    }

    // Edit tampilan
    $(document).on('click', '#EditSupplier', function(e) {
        var id_supplier = $(this).data('id');
        $('#modalku').modal('show');
        var fileedit = 'menu/pemilik/user_edit.php';
        $.ajax({
            type: 'POST',
            url: fileedit,
            data: { ids: id_supplier },
            success: function(data) {
                $('#modal_tambah').html(data);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Error: ' + textStatus + ' - ' + errorThrown);
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
                        type: 'POST',
                        url: 'proccess/user_hapus.php',
                        data: { id: id },
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
                                window.location.replace('?menu=user');
                            }, 1000);
                        }
                    });
                }
            })
    }
</script>
