<?php
require "koneksi.php";

if (isset($_POST['bsimpan'])) {
	try {
		$kode_peminjaman = $_POST['kode_peminjaman'];
		$id_pengguna = $_POST['id_pengguna'];
		$tanggal_dikembalikan = $_POST['tanggal_dikembalikan'];
		$status_pengembalian = $_POST['status_pengembalian'];

		$sql = "INSERT INTO tb_pengembalian (kode_peminjaman, id_pengguna, tanggal_dikembalikan, status_pengembalian) VALUES ('$kode_peminjaman', '$id_pengguna', '$tanggal_dikembalikan', '$status_pengembalian')";

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
                    window.location.href = 'pengembalian.php';
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
                    window.location.href = 'pengembalian.php';
                });
            </script>
            </body>
            </html>";
        exit();
    }
}

if (isset($_POST['bedit'])) {
	$id = $_POST['kode_pengembalian'];
	$kode_peminjaman = $_POST['kode_peminjaman'];
	$id_pengguna = $_POST['id_pengguna'];
	$tanggal_dikembalikan = $_POST['tanggal_dikembalikan'];
	$status_pengembalian = $_POST['status_pengembalian'];

	$sql = "UPDATE tb_pengembalian SET kode_peminjaman='$kode_peminjaman', id_pengguna='$id_pengguna', tanggal_dikembalikan='$tanggal_dikembalikan', status_pengembalian='$status_pengembalian' WHERE kode_pengembalian=$id";

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
                    window.location.href = 'pengembalian.php';
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
                    window.location.href = 'pengembalian.php';
                });
            </script>
            </body>
            </html>";
	}
}

// if (isset($_POST['bhapus'])) {

// 	$id =  $mysqli->real_escape_string($_POST['kode_pengembalian']);
// 	$sql = "DELETE FROM tb_pengembalian WHERE kode_pengembalian=$id";

// 	$hapus = $mysqli->query($sql);

// 	if ($hapus) {
// 		echo "<script>
//             alert('Data Berhasil di Hapus!');
//             document.location='pengembalian.php';
//             </script>";
// 	} else {
// 		echo "<script>
//             alert('Hapus Data Gagal!');
//             document.location='pengembalian.php';
//             </script>";
// 	}
// }
	
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $sql = "DELETE FROM tb_pengembalian WHERE kode_pengembalian=$id";
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
                    window.location.href = 'pengembalian.php';
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
                    window.location.href = 'pengembalian.php';
                });
            </script>
            </body>
            </html>";
        exit();
    }
}		
 ?>