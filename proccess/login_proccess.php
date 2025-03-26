<?php
session_start();
//koneksi ke database
include "../functions/config/koneksi.php";


if (isset($_POST['var_usn']) and isset($_POST['var_pwd'])) {
	$username = addslashes($_POST['var_usn']);
	$password = addslashes($_POST['var_pwd']);
	$check    = $koneksi->query('select * from tb_user where username="' . $username . '" AND password="' . $password . '" ');
	if (mysqli_num_rows($check) == 0) {
		echo 'Username atau Password Salah !';
	} else {
		$data = $check->fetch_array();
		$level = $data['level'];
		if ($level == 'warga') {
			$check2    = $koneksi->query("select acc from tb_warga where id_user='$data[id_user]'");
			$data2 = $check2->fetch_array();
			$acc = $data2['acc'];
			if ($acc == 0) {
				echo 'Akun Belum di ACC administrator!';
			} else {
				$check    = $koneksi->query('select * from tb_user where username="' . $username . '" AND password="' . $password . '" ');
				while ($run = mysqli_fetch_assoc($check)) {
					$_SESSION['user']['id_user'] = $run['id_user'];
					$_SESSION['user']['level'] = $run['level'];
					$_SESSION['user']['username'] = $run['username'];

					echo 'ok';
				}
			}
		} else {
			$check    = $koneksi->query('select * from tb_user where username="' . $username . '" AND password="' . $password . '" ');
			while ($run = mysqli_fetch_assoc($check)) {
				$_SESSION['user']['id_user'] = $run['id_user'];
				$_SESSION['user']['level'] = $run['level'];
				$_SESSION['user']['username'] = $run['username'];
				$_SESSION['user']['id_relasi'] = $run['id_relasi'];

				echo 'ok';
			}
		}
	}
}
