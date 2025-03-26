<?php
require_once("config/koneksi.php");
// 1. fungsi-fungsi string, menampilkan teks berdasarkan kode

function zen($url, $userkey, $passkey, $telepon, $message) {
  $curlHandle = curl_init();
  curl_setopt($curlHandle, CURLOPT_URL, $url);
  curl_setopt($curlHandle, CURLOPT_HEADER, 0);
  curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
  curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($curlHandle, CURLOPT_TIMEOUT, 30);
  curl_setopt($curlHandle, CURLOPT_POST, 1);
  curl_setopt($curlHandle, CURLOPT_POSTFIELDS, array(
    'userkey' => $userkey,
    'passkey' => $passkey,
    'to' => $telepon,
    'message' => $message
  ));
  $results = json_decode(curl_exec($curlHandle), true);
  curl_close($curlHandle);
  return $results;
}

function penyebut($nilai) {
  $nilai = abs($nilai);
  $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  $temp = "";
  if ($nilai < 12) {
    $temp = " " . $huruf[$nilai];
  } else if ($nilai < 20) {
    $temp = penyebut($nilai - 10) . " belas";
  } else if ($nilai < 100) {
    $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
  } else if ($nilai < 200) {
    $temp = " seratus" . penyebut($nilai - 100);
  } else if ($nilai < 1000) {
    $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
  } else if ($nilai < 2000) {
    $temp = " seribu" . penyebut($nilai - 1000);
  } else if ($nilai < 1000000) {
    $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
  } else if ($nilai < 1000000000) {
    $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
  } else if ($nilai < 1000000000000) {
    $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
  } else if ($nilai < 1000000000000000) {
    $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
  }
  return $temp;
}

function terbilang($nilai) {
  if ($nilai < 0) {
    $hasil = "minus " . trim(penyebut($nilai));
  } else {
    $hasil = trim(penyebut($nilai));
  }
  return $hasil;
}
function huruf($nilai) {
  if ($nilai >= 0 && $nilai <= 34) {
    $huruf = 'E';
  } else if ($nilai >= 35 && $nilai <= 44) {
    $huruf = 'D';
  } else if ($nilai >= 45 && $nilai <= 54) {
    $huruf = 'CD';
  } else if ($nilai >= 55 && $nilai <= 60) {
    $huruf = 'C';
  } else if ($nilai >= 61 && $nilai <= 66) {
    $huruf = 'BC';
  } else if ($nilai >= 67 && $nilai <= 74) {
    $huruf = 'B';
  } else if ($nilai >= 75 && $nilai <= 84) {
    $huruf = 'AB';
  } else if ($nilai >= 85 && $nilai <= 100) {
    $huruf = 'A';
  }
  return $huruf;
}

//menampilkan string bulan dalam tahun
function str_bln($bln) {
  $bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
  return $bulan[$bln - 1];
}

//2. Fungsi tentang pertanggalan

//ubah format tangggal dari yyyy-mm-dd
//ex:ubah_format('1992-05-18') => 18-05-1992
//	 ubah_format('1992-05-18',2) => 18 Mei 1992
//	 ubah_format('1992-05-18',3) => 18/05/1992
function ubah_format_tgl($tgl, $format = 1, $reverse = false) {
  if ($reverse) {
    if ($format == 1) {
      return date("Y-m-d", strtotime($tgl));
    }
  } else {
    if ($format == 1) {
      return date("d-m-Y", strtotime($tgl));
    } else if ($format == 2) {
      return date("d", strtotime($tgl)) . " " . str_bln(date("m", strtotime($tgl))) . " " . date("Y", strtotime($tgl));
    } else if ($format == 3) {
      return date("d/m/Y", strtotime($tgl));
    }
  }
}

function rp($x) {
  return number_format($x, 0, '', '.');
}

function list_kategori() {
  include("config/koneksi.php");
  $view = $koneksi->query("SELECT * from tb_kategori");
  return $view;
}

function list_toko() {
  include("config/koneksi.php");
  $view = $koneksi->query("SELECT * from tb_toko");
  return $view;
}

function list_supplier() {
  include("config/koneksi.php");
  $view = $koneksi->query("SELECT * from tb_supplier");
  return $view;
}

function list_user() {
  include("config/koneksi.php");
  $view = $koneksi->query("SELECT * from tb_user a LEFT JOIN tb_toko b ON a.id_relasi=b.id_toko");
  return $view;
}

function list_bahan_baku() {
  include("config/koneksi.php");
  $view = $koneksi->query("SELECT * from tb_bahan_baku a LEFT JOIN tb_kategori c ON a.id_kategori=c.id_kategori");
  return $view;
}

function list_bahan_baku_fifo() {
  include("config/koneksi.php");
  $view = $koneksi->query("SELECT * from tb_bahan_baku a LEFT JOIN tb_stok b ON a.id_bahan_baku=b.id_bahan_baku WHERE b.tipe='in' ORDER BY b.tgl_kadaluarsa ASC");
  return $view;
}

function list_penggunaan_bahan_baku() {
    include("config/koneksi.php");
    $query = "SELECT b.id_bahan_baku, b.nama_bahan_baku, a.tgl, a.tipe, a.jumlah, a.sisa, a.tgl_kadaluarsa 
              FROM tb_stok a 
              JOIN tb_bahan_baku b ON a.id_stok = a.id_stok 
              ORDER BY a.tgl_kadaluarsa ASC";
    $view = $koneksi->query($query);
    return $view;
}

function list_pengajuan() {
  include("config/koneksi.php");
  $id = $_SESSION['user']['id_relasi'];
  $view = $koneksi->query("SELECT * from tb_pengajuan WHERE id_toko='$id'");
  return $view;
}

function list_pengajuan_pengadaan_bahan_baku() {
  include("config/koneksi.php");
  $view = $koneksi->query("SELECT * from tb_pengajuan_pengadaan_bahan_baku");
  return $view;
}

function list_pengajuan_pengadaan_bahan_baku_by() {
  include("config/koneksi.php");
  $view = $koneksi->query("SELECT * from tb_pengajuan_pengadaan_bahan_baku WHERE selesai='0'");
  return $view;
}

function list_pengajuan_petugas_produksi() {
  include("config/koneksi.php");
  $view = $koneksi->query("SELECT * from tb_pengajuan a JOIN tb_toko b ON a.id_toko=b.id_toko");
  return $view;
}

function list_pengajuan_petugas_gudang() {
  include("config/koneksi.php");
  $view = $koneksi->query("SELECT * from tb_pengajuan a JOIN tb_toko b ON a.id_toko=b.id_toko WHERE a.status='1'");
  return $view;
}

function list_tmp_pengajuan() {
  include("config/koneksi.php");
  $view = $koneksi->query("SELECT * from tb_tmp_pengajuan a JOIN tb_bahan_baku b ON a.id_bahan_baku=b.id_bahan_baku");
  return $view;
}

function list_tmp_pengajuan_pengadaan_bahan_baku() {
  include("config/koneksi.php");
  $view = $koneksi->query("SELECT * from tb_tmp_pengajuan_pengadaan_bahan_baku a JOIN tb_bahan_baku b ON a.id_bahan_baku=b.id_bahan_baku");
  return $view;
}

function list_pengadaan() {
  include("config/koneksi.php");
  $view = $koneksi->query("SELECT * from tb_pengadaan a JOIN tb_supplier b ON a.id_supplier=b.id_supplier");
  return $view;
}

function list_tmp_pengadaan() {
  include("config/koneksi.php");
  $view = $koneksi->query("SELECT *,a.harga as hrg,a.tgl_kadaluarsa as tgl_ex from tb_tmp_pengadaan a JOIN tb_bahan_baku b ON a.id_bahan_baku=b.id_bahan_baku");
  return $view;
}

function laporan_stok_bahan_baku($id, $dari, $sampai) {
    include("config/koneksi.php");
    $view = $koneksi->query("SELECT * FROM tb_stok a 
                             JOIN tb_bahan_baku b ON a.id_bahan_baku = b.id_bahan_baku 
                             WHERE a.id_toko = '$id' 
                             AND tgl BETWEEN '$dari' AND '$sampai' 
                             ORDER BY tgl ASC"); // Mengurutkan berdasarkan tanggal paling lama di urutan atas
    return $view;
}





















// =======================================================================












function alert_process($id, $status, $data, $menu, $text = "") {
  $stat = "";
  if ($text == "") {
    if ($id == 1) {
      $text = "menambah";
    } else if ($id == 2) {
      $text = "mengubah";
    } else if ($id == 3) {
      $text = "menghapus";
    } else if ($id == 4) {
      $text = "Mengirim SMS";
    } else if ($id == 5) {
      $text = "Import";
    }
  }
  if ($status) {
    $stat = "Berhasil";
  } else {
    $stat = "Gagal";
  }

  echo "
  <script>
	setTimeout(function () { 
		Swal.fire({
      toast: true,
      position: 'top-end',
      title:'" . $stat . " " . $text . " data " . $data . "',
      type:'" . (($status) ? "success" : "error") . "',
      showConfirmButton: false
  });
  },10);
  window.setTimeout(function(){ 
  window.location.replace('?menu=" . $menu . "');
 } ,1500); 
  </script>";
}

function alert_process2($id, $status, $data, $menu, $text = "") {
  $stat = "";
  if ($text == "") {
    if ($id == 1) {
      $text = "menambah";
    } else if ($id == 2) {
      $text = "mengubah";
    } else if ($id == 3) {
      $text = "menghapus";
    } else if ($id == 4) {
      $text = "Mengirim SMS";
    }
  }
  if ($status) {
    $stat = "Berhasil";
  } else {
    $stat = "Gagal";
  }
  echo "<script>
	setTimeout(function () { 
			swal.fire({
		title:'" . $stat . " " . $text . " data " . $data . "',
   type:'" . (($status) ? "success" : "error") . "'
  });
  },10);
  window.setTimeout(function(){ 
  window.history.back();
 } ,2000); 
  </script>";
}

function alert_validasi($status, $menu) {
  echo "
  <script>
	setTimeout(function () { 
		Swal.fire({
      toast: true,
      position: 'top-end',
      title:'Validasi Berhasil',
      type:'" . (($status) ? "success" : "error") . "',
      showConfirmButton: false
  });
  },10);
  window.setTimeout(function(){ 
  window.location.replace('?menu=" . $menu . "');
 } ,2000); 
  </script>";
}

function alert_pengiriman($status, $menu) {
  echo "
  <script>
	setTimeout(function () { 
		Swal.fire({
      toast: true,
      position: 'top-end',
      title:'Pengiriman bahan baku berhasil',
      type:'" . (($status) ? "success" : "error") . "',
      showConfirmButton: false
  });
  },10);
  window.setTimeout(function(){ 
  window.location.replace('?menu=" . $menu . "');
 } ,4000); 
  </script>";
}