<?php
require "koneksi.php";

if (isset($_POST['bsimpan'])) {
	try {
		$nama_ruang = $_POST['nama_ruang'];


		$sql = "INSERT INTO tb_ruang (nama_ruang) VALUES ('$nama_ruang')";

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
                    window.location.href = 'ruang.php';
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
                    window.location.href = 'ruang.php';
                });
            </script>
            </body>
            </html>";
        exit();
    }
}

if (isset($_POST['bedit'])) {
	$id = $_POST['kode_ruang'];
	$nama_ruang = $_POST['nama_ruang'];

	$sql = "UPDATE tb_ruang SET nama_ruang='$nama_ruang' WHERE kode_ruang=$id";

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
                    window.location.href = 'ruang.php';
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
                    window.location.href = 'ruang.php';
                });
            </script>
            </body>
            </html>";
	}
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
     try {
        $sql = "DELETE FROM tb_ruang WHERE kode_ruang=$id";
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
                    window.location.href = 'ruang.php';
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
                    text: 'karena ada relasi di tabel barang',
                    showConfirmButton: true,
                    confirmButtonColor: '#6A68DE',
                }).then((result) => {
                    window.location.href = 'ruang.php';
                });
            </script>
            </body>
            </html>";
        exit();
    }
}
	
	
 ?>