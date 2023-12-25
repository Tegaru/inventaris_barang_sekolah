<?php
require "koneksi.php";

if (isset($_POST['bsimpan'])) {
    try {
        $nama_barang = $_POST['nama_barang'];
        $jenis_barang = $_POST['jenis_barang'];
        $kondisi_barang = $_POST['kondisi_barang'];
        $jumlah = $_POST['jumlah'];
        $kode_ruang = $_POST['kode_ruang'];


        $sql = "INSERT INTO tb_barang (nama_barang, jenis_barang, kondisi_barang, jumlah, kode_ruang) VALUES ('$nama_barang', '$jenis_barang', '$kondisi_barang', '$jumlah', '$kode_ruang')";
        
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
                    window.location.href = 'barang.php';
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
                    window.location.href = 'barang.php';
                });
            </script>
            </body>
            </html>";
        exit();
    }
}



if (isset($_POST['bedit'])) {
	$id = $_POST['kode_barang'];
	$nama_barang = $_POST['nama_barang'];
	$jenis_barang = $_POST['jenis_barang'];
	$kondisi_barang = $_POST['kondisi_barang'];
	$jumlah = $_POST['jumlah'];
	$kode_ruang = $_POST['kode_ruang'];

	$sql = "UPDATE tb_barang SET nama_barang='$nama_barang', jenis_barang='$jenis_barang', kondisi_barang='$kondisi_barang', jumlah='$jumlah', kode_ruang='$kode_ruang' WHERE kode_barang=$id";

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
                    window.location.href = 'barang.php';
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
                    window.location.href = 'barang.php';
                });
            </script>
            </body>
            </html>";
	}
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $sql = "DELETE FROM tb_barang WHERE kode_barang=$id";
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
                    window.location.href = 'barang.php';
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
                    window.location.href = 'barang.php';
                });
            </script>
            </body>
            </html>";
        exit();
    }
}
	
	
 ?>