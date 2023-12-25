<?php
require "koneksi.php";

if (isset($_POST['bsimpan'])) {
	try {
		$nama_pengguna = $_POST['nama_pengguna'];
		$jenis_kelamin = $_POST['jenis_kelamin'];
		$no_hp = $_POST['no_hp'];
        $status_pengguna = $_POST['status_pengguna'];

		$sql = "INSERT INTO tb_pengguna (nama_pengguna, jenis_kelamin, no_hp, status_pengguna) VALUES ('$nama_pengguna', '$jenis_kelamin', '$no_hp', '$status_pengguna')";

		$simpan = $mysqli->query($sql);

		if ($simpan) {
			echo "<!DOCTYPE html>
            <html>
            <head>
                <title>Alert Berhasil</title>
            </head>
            <body>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Tambah Data Berhasil',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    window.location.href = 'pengguna.php';
                });
            </script>
            </body>
            </html>";
		} 

	} catch (Exception $e) {
        echo "<!DOCTYPE html>
            <html>
            <head>
                <title>Alert Error</title>
            </head>
            <body>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Tambah Data Gagal',
                    text: 'Data tidak boleh kosong',
                    showConfirmButton: true,
                    confirmButtonColor: '#6A68DE',
                }).then((result) => {
                    window.location.href = 'pengguna.php';
                });
            </script>
            </body>
            </html>";
        exit();
    }
}

if (isset($_POST['bedit'])) {
	$id = $_POST['id_pengguna'];
	$nama_pengguna = $_POST['nama_pengguna'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
	$no_hp = $_POST['no_hp'];
    $status_pengguna = $_POST['status_pengguna'];

	$sql = "UPDATE tb_pengguna SET nama_pengguna='$nama_pengguna', jenis_kelamin='$jenis_kelamin', no_hp='$no_hp', status_pengguna='$status_pengguna' WHERE id_pengguna=$id";

	$edit = $mysqli->query($sql);

	if ($edit) {
		echo "<!DOCTYPE html>
            <html>
            <head>
                <title>Alert Berhasil</title>
            </head>
            <body>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Edit Data Berhasil',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    window.location.href = 'pengguna.php';
                });
            </script>
            </body>
            </html>";
	} else {
		echo "<!DOCTYPE html>
            <html>
            <head>
                <title>Alert Error</title>
            </head>
            <body>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Edit Data Gagal',
                    showConfirmButton: true,
                    confirmButtonColor: '#6A68DE',
                }).then((result) => {
                    window.location.href = 'pengguna.php';
                });
            </script>
            </body>
            </html>";
	}
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $sql = "DELETE FROM tb_pengguna WHERE id_pengguna=$id";
        $hapus = $mysqli->query($sql);

        if (!$hapus) {
            throw new Exception('Error in the query: ' . $mysqli->error);
        }

        echo "<!DOCTYPE html>
            <html>
            <head>
                <title>Alert Berhasil</title>
            </head>
            <body>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Hapus Data Berhasil',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    window.location.href = 'pengguna.php';
                });
            </script>
            </body>
            </html>";

    } catch (Exception $e) {
    	echo "<!DOCTYPE html>
            <html>
            <head>
                <title>Alert Error</title>
            </head>
            <body>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Hapus Data Gagal',
                    text: 'karena ada relasi di tabel peminjaman',
                    showConfirmButton: true,
                    confirmButtonColor: '#6A68DE',
                }).then((result) => {
                    window.location.href = 'pengguna.php';
                });
            </script>
            </body>
            </html>";
        exit();
    }
}
	
	
 ?>