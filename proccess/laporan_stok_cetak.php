<title class="noprint">Cetak Stok</title>

<head>
    <style type="text/css">
        .header {
            font-size: 16px;
            font-weight: bold;
            padding-bottom: 5px;
        }

        .nomor {
            font-size: 15px;
        }

        .table-header {
            width: 100%;
            border: 1px #000;
            font-size: 16px;
            line-height: 21px;
        }

        .table-header td {
            border: 0px;
            vertical-align: top;
            padding: 2px;
            margin: 0px;
            border-bottom: 1px solid #000;
        }

        .table-header th {
            background: none;
            text-align: left;
            text-transform: none;
            white-space: pre;
        }

        .table-isi {
            width: 100%;
            font-size: 16px;
            line-height: 21px;
            border-width: thin;
            border: 1px solid #000;
        }

        .table-isi td {
            vertical-align: top;
            padding: 5px;
            margin: 0px;
            border: 1px solid #000;
        }

        .table-isi th {
            width: 12px;
            text-align: left;
            text-transform: none;
            color: #000;
            display: table-header-group;
        }

        .tebal {
            font-weight: bold;
        }

        .div-ttd {
            width: 30%;
            text-align: center;
        }

        a,
        a:active,
        a:visited {
            text-decoration: none;
            color: #000000;
        }

        a:hover {
            text-decoration: none;
            color: blue;
            font-weight: bold;
        }

        .bodynya {
            color: #000000;
            font-size: 16px;
            font-family: 'calibri';
            font-style: normal;
            width: 1000px;
        }

        .footer {

            font-size: 16px;
            font-style: normal;
            font-weight: normal;
            line-height: 21px;
        }



        @media print {
            body * {
                visibility: hidden;
                font-size: 16px;
                font-family: 'calibri';
            }

            #printSection,
            #printSection * {
                visibility: visible;
                font-size: 16px;
            }

            #printSection,
            #printSection * {

                top: 0;
                font-size: 16px;

            }

            #printSection {

                top: 0;
                font-size: 16px;



            }

            table {
                page-break-inside: auto
            }

            div {
                page-break-inside: avoid;
            }

            /* This is the key */
            thead {
                display: table-header-group
            }

            tfoot {
                display: table-footer-group
            }

        }
    </style>
    <script>
        setTimeout(function() {
            window.print();
            self.close();
        }, 200);
    </script>
</head>
<?php
include '../functions/config/koneksi.php';
include '../functions/lib_function.php';
session_start();
$id = $_SESSION['user']['id_relasi'];
$q = $koneksi->query("SELECT nama_toko FROM tb_toko WHERE id_toko='$id'");
$d = $q->fetch_array();
$dari = $_POST['dari'];
$sampai = $_POST['sampai'];

$query = laporan_stok_bahan_baku($id, $dari, $sampai);
$cek = $query->num_rows;

?>

<body class="bodynya">
    <div id="print-me">
        <div id='printSection' class='bodynya' width='900px'>
            <center>
                <h3 style="margin-bottom: 0;">Laporan Stok Bahan Baku</h3>
                <h3 style="margin-top: 0;margin-bottom: 0;">Toko : <?= $d['nama_toko'] ?></h3>
                <h5 style="margin-top: 0;margin-bottom: 0;">Dari Tanggal : <?= ubah_format_tgl($dari) ?></h5>
                <h5 style="margin-top: 0;margin-bottom: 0;">Sampai Tanggal : <?= ubah_format_tgl($sampai) ?></h5>

            </center>
            <div style="text-align: right;margin-top: 30px;">

                <small style="font-style: italic">Dicetak : <?= date('d-m-Y H:i:s') ?></small>
            </div>
            <table class='table-isi' width='900px' cellspacing='0' border='1'>
                <tr style="text-align: center;font-weight: bold;">
                    <td style="width: 20px;">No</td>
                    <td>Tgl Masuk</td>
                    <td>Nama Bahan Baku</td>
                    <td>Jumlah</td>
                </tr>
                <?php
                if ($cek < 1) {
                ?>
                    <tr>
                        <td colspan="4" align="center"><span style="color: orangered;font-style: italic;">Data tidak ditemukan!</span></td>
                    </tr>

                    <?php
                } else {
                    $no = 1;
                    foreach ($query as $data) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= ubah_format_tgl($data['tgl']) ?></td>
                            <td><?= $data['nama_bahan_baku'] ?></td>
                            <td style="text-align: center;"><?= $data['jumlah'] ?></td>

                        </tr>
                <?php
                    }
                } ?>
            </table>

        </div>
    </div>
</body>