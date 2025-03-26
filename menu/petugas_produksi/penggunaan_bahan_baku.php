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
                <h3>Data Penggunaan Bahan Baku</h3>
            </div>
        </div>

        <div class="row" id="cancel-row">

            <div class="col-sm-12 layout-spacing">
                <div class="widget-content widget-content-area br-6">

                    <div class="table-responsive mb-4 mt-4">
                        <table id="zero-config" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <!-- <th>ID Bahan Baku</th> -->
                                    <th>Nama Bahan Baku</th>
                                    <th>Tanggal</th>
                                    <th>Tipe in/out</th>
                                    <th>Jumlah (Kg)</th>
                                    <!-- <th>Sisa Stok (Kg)</th> -->
                                    <th>Tgl Kadaluarsa</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                include("functions/config/koneksi.php");
                                $i = 1;
                                $view = list_penggunaan_bahan_baku();
                                foreach ($view as $data) :
                                ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <!-- <td><?= $data['id_bahan_baku'] ?></td> -->
                                        <td><?= $data['nama_bahan_baku'] ?></td>
                                        <td><?= ubah_format_tgl($data['tgl']) ?></td>
                                        <td><?= $data['tipe'] ?></td>
                                        <td><?= rp($data['jumlah']) ?></td>
                                        <!-- <td><?= rp($data['sisa']) ?></td> -->
                                        <td><?= ubah_format_tgl($data['tgl_kadaluarsa']) ?></td>
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