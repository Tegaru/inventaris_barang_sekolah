<?php
require "koneksi.php";

if (isset($_POST['bsimpan'])) {
    try {
        $id_pengguna = $_POST['id_pengguna'];
        $kode_barang = $_POST['kode_barang'];
        $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
        $tanggal_kembali = $_POST['tanggal_kembali'];
        $jumlah_pinjam = $_POST['jumlah_pinjam'];
        $status_peminjaman = $_POST['status_peminjaman'];


        $sql_barang = "SELECT jumlah FROM tb_barang WHERE kode_barang = '$kode_barang'";
        $result_barang = $mysqli->query($sql_barang);

        if ($result_barang->num_rows > 0) {
            $barang = $result_barang->fetch_assoc();
            $jumlah_barang = $barang['jumlah'];

            if ($jumlah_barang < $jumlah_pinjam) {
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
                            text: 'Jumlah barang tidak mencukupi',
                            showConfirmButton: true,
                            confirmButtonColor: '#6A68DE',
                        }).then((result) => {
                            window.location.href = 'peminjaman.php';
                        });
                    </script>
                    </body>
                    </html>";
                exit();
            }
        }

 
        $sql = "INSERT INTO tb_peminjaman (id_pengguna, kode_barang, tanggal_peminjaman, tanggal_kembali, jumlah_pinjam, status_peminjaman) VALUES ('$id_pengguna', '$kode_barang', '$tanggal_peminjaman', '$tanggal_kembali', '$jumlah_pinjam', '$status_peminjaman')";

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
                        window.location.href = 'peminjaman.php';
                    });
                </script>
                </body>
                </html>";
        } else {
     
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
                    window.location.href = 'peminjaman.php';
                });
            </script>
            </body>
            </html>";
        exit();
    }
}

if (isset($_POST['bedit'])) {
    try {
        $id = $_POST['kode_peminjaman'];
        $id_pengguna = $_POST['id_pengguna'];
        $kode_barang = $_POST['kode_barang'];
        $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
        $tanggal_kembali = $_POST['tanggal_kembali'];
        $jumlah_pinjam = $_POST['jumlah_pinjam'];
        $status_peminjaman = $_POST['status_peminjaman'];

            // Update data peminjaman
        $sql = "UPDATE tb_peminjaman SET id_pengguna='$id_pengguna', kode_barang='$kode_barang', tanggal_peminjaman='$tanggal_peminjaman', tanggal_kembali='$tanggal_kembali', jumlah_pinjam='$jumlah_pinjam', status_peminjaman='$status_peminjaman' WHERE kode_peminjaman=$id";
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
                        window.location.href = 'peminjaman.php';
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
                        window.location.href = 'peminjaman.php';
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
                        text: 'Jumlah barang tidak mencukupi',
                        showConfirmButton: true,
                        confirmButtonColor: '#6A68DE',
                    }).then((result) => {
                        window.location.href = 'peminjaman.php';
                    });
                </script>
                </body>
                </html>";
            exit();
        }
} 


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $sql = "DELETE FROM tb_peminjaman WHERE kode_peminjaman=$id";
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
                    window.location.href = 'peminjaman.php';
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
                    text: 'karena ada relasi di tabel pengembalian',
                    showConfirmButton: true,
                    confirmButtonColor: '#6A68DE',
                }).then((result) => {
                    window.location.href = 'peminjaman.php';
                });
            </script>
            </body>
            </html>";
        exit();
    }
}	
 ?>