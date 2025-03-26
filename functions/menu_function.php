<?php

// petugas produksi
function show_home($menu = "", $p = "") {
	switch ($menu) {
		case "kategori":
			$mn = "kategori.php";

			break;
		case "bahan_baku":
			$mn = "bahan_baku.php";

			break;
		case "pengajuan":
			$mn = "pengajuan.php";

			break;
		case "pengajuan_pengadaan_bahan_baku":
			$mn = "pengajuan_pengadaan_bahan_baku.php";

			break;
		case "penggunaan_bahan_baku":
			$mn = "penggunaan_bahan_baku.php";

			break;

		default:
			$mn = "dashboard.php";
	}
	include_once("menu/petugas_produksi/" . $mn);
}

function show_admin($menu = "", $p = "") {
	switch ($menu) {
		case "toko":
			$mn = "toko.php";

			break;
		case "supplier":
			$mn = "supplier.php";

			break;
		case "pengajuan":
			$mn = "pengajuan.php";

			break;
		case "stok":
			$mn = "stok.php";

			break;
		case "stok_fifo":
			$mn = "stok_fifo.php";

			break;
		case "pengajuan_pengadaan_bahan_baku":
			$mn = "pengajuan_pengadaan_bahan_baku.php";
			break;

		default:
			$mn = "dashboard.php";
	}
	include_once("menu/admin/" . $mn);
}

function show_pemilik($menu = "", $p = "") {
	switch ($menu) {
		case "user":
			$mn = "user.php";
			break;
		case "supplier":
			$mn = "supplier.php";
			break;
		case "pengajuan_pengadaan_bahan_baku":
			$mn = "pengajuan_pengadaan_bahan_baku.php";
			break;
		case "pengajuan_pengadaan_bahan_baku":
			$mn = "pengajuan_pengadaan_bahan_baku.php";
			break;
		case "laporan_bahan_baku_keluar":
			$mn = "laporan_bahan_baku_keluar.php";
			break;


		default:
			$mn = "dashboard.php";
	}
	include_once("menu/pemilik/" . $mn);
}

function show_petugas_toko($menu = "", $p = "") {

	switch ($menu) {
		case "pengajuan":
			$mn = "pengajuan.php";
			if ($p == "tambah") {
				$mn = "pengajuan_tambah.php";
			} else if ($p == "edit") {
				$mn = "pengajuan_edit.php";
			}
			break;
		case "laporan_stok":
			$mn = "laporan_stok.php";

			break;

			
		default:
			$mn = "dashboard.php";
	}
	include_once("menu/petugas_toko/" . $mn);
}

function show_petugas_gudang($menu = "", $p = "") {
	switch ($menu) {
		case "pengajuan":
			$mn = "pengajuan.php";

			break;
		case "pengadaan":
			$mn = "pengadaan.php";
			if ($p == "tambah") {
				$mn = "pengadaan_tambah.php";
			} else if ($p == "edit") {
				$mn = "pengadaan_edit.php";
			}
			break;
		case "stok":
			$mn = "stok.php";

			break;
		case "bahan_baku":
			$mn = "bahan_baku.php";

			break;
		case "stok_fifo":
			$mn = "stok_fifo.php";

			break;
		case "barang_keluar":
			$mn = "barang_keluar.php";
			break;
		case "pengajuan_pengadaan_bahan_baku":
			$mn = "pengajuan_pengadaan_bahan_baku.php";
			if ($p == "tambah") {
				$mn = "pengajuan_pengadaan_bahan_baku_tambah.php";
			} else if ($p == "edit") {
				$mn = "pengajuan_pengadaan_bahan_baku_edit.php";
			}
			break;

		default:
			$mn = "dashboard.php";
	}
	include_once("menu/petugas_gudang/" . $mn);
}
