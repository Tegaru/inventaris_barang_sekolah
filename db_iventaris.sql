-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Des 2023 pada 08.24
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_iventaris`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang`
--

CREATE TABLE `tb_barang` (
  `kode_barang` int(11) NOT NULL,
  `kode_ruang` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `jenis_barang` varchar(100) NOT NULL,
  `kondisi_barang` enum('Baik','Rusak','','') NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_barang`
--

INSERT INTO `tb_barang` (`kode_barang`, `kode_ruang`, `nama_barang`, `jenis_barang`, `kondisi_barang`, `jumlah`) VALUES
(14, 2, 'Laptop Lenovo', 'Laptop', 'Baik', 18),
(15, 3, 'Komputer SPC', 'Komputer', 'Baik', 10),
(137, 13, 'Proyektor Epson', 'Proyektor', 'Baik', 4),
(138, 4, 'Komputer Lenovo', 'Komputer', 'Baik', 10),
(139, 3, 'Keyboard Mtech', 'Keyboard', 'Baik', 5),
(140, 3, 'Mouse Logitech', 'Mouse', 'Baik', 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_peminjaman`
--

CREATE TABLE `tb_peminjaman` (
  `kode_peminjaman` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `kode_barang` int(11) NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `jumlah_pinjam` int(11) NOT NULL,
  `status_peminjaman` enum('dipinjam','kembali','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_peminjaman`
--

INSERT INTO `tb_peminjaman` (`kode_peminjaman`, `id_pengguna`, `kode_barang`, `tanggal_peminjaman`, `tanggal_kembali`, `jumlah_pinjam`, `status_peminjaman`) VALUES
(13, 1, 15, '2023-12-14', '2023-12-14', 10, 'kembali'),
(42, 3, 14, '2023-12-19', '2023-12-20', 2, 'dipinjam'),
(65, 17, 137, '2023-12-23', '2023-12-23', 1, 'dipinjam'),
(66, 5, 14, '2023-12-23', '2023-12-24', 3, 'kembali'),
(67, 18, 140, '2023-12-23', '2023-12-23', 1, 'dipinjam');

--
-- Trigger `tb_peminjaman`
--
DELIMITER $$
CREATE TRIGGER `dipinjam_jml_peminjaman` BEFORE UPDATE ON `tb_peminjaman` FOR EACH ROW BEGIN

  IF NEW.status_peminjaman = 'Dipinjam' AND OLD.status_peminjaman <> 'Dipinjam' THEN
    -- Perbarui jumlah barang di tb_barang
    UPDATE tb_barang
    SET jumlah = jumlah - NEW.jumlah_pinjam
    WHERE kode_barang = NEW.kode_barang;
  END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `jml_peminjaman` AFTER INSERT ON `tb_peminjaman` FOR EACH ROW BEGIN

UPDATE tb_barang set jumlah = jumlah - NEW.jumlah_pinjam WHERE kode_barang = NEW.kode_barang;
IF (SELECT jumlah FROM tb_barang WHERE kode_barang = NEW.kode_barang) < 0 THEN
      SIGNAL SQLSTATE '45000'
      SET MESSAGE_TEXT = 'Jumlah barang tidak dapat menjadi negatif';
    END IF;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `kembalikan_jumlah_barang` BEFORE UPDATE ON `tb_peminjaman` FOR EACH ROW BEGIN

  IF NEW.status_peminjaman = 'Kembali' AND OLD.status_peminjaman <> 'Kembali' THEN
    -- Perbarui jumlah barang di tb_barang
    UPDATE tb_barang
    SET jumlah = jumlah + NEW.jumlah_pinjam
    WHERE kode_barang = NEW.kode_barang;
  END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_jumlah_barang` BEFORE UPDATE ON `tb_peminjaman` FOR EACH ROW BEGIN
  -- Periksa apakah terjadi perubahan pada jumlah_pinjam
  IF NEW.jumlah_pinjam <> OLD.jumlah_pinjam THEN
    -- Update jumlah_barang di tb_barang
    UPDATE tb_barang
    SET jumlah = OLD.jumlah_pinjam - NEW.jumlah_pinjam + jumlah
    WHERE kode_barang = NEW.kode_barang;
    IF (SELECT jumlah FROM tb_barang WHERE kode_barang = NEW.kode_barang) < 0 THEN
      SIGNAL SQLSTATE '45000'
      SET MESSAGE_TEXT = 'Jumlah barang tidak dapat menjadi negatif';
    END IF;
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengembalian`
--

CREATE TABLE `tb_pengembalian` (
  `kode_pengembalian` int(11) NOT NULL,
  `kode_peminjaman` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `tanggal_dikembalikan` date NOT NULL,
  `status_pengembalian` enum('Selesai','Rusak','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_pengembalian`
--

INSERT INTO `tb_pengembalian` (`kode_pengembalian`, `kode_peminjaman`, `id_pengguna`, `tanggal_dikembalikan`, `status_pengembalian`) VALUES
(1, 13, 1, '2023-12-01', 'Selesai'),
(13, 66, 5, '2023-12-23', 'Selesai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengguna`
--

CREATE TABLE `tb_pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama_pengguna` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan','','') NOT NULL,
  `no_hp` varchar(12) NOT NULL,
  `status_pengguna` enum('Siswa','Guru','Karyawan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id_pengguna`, `nama_pengguna`, `jenis_kelamin`, `no_hp`, `status_pengguna`) VALUES
(1, 'Tegar Rohim', 'Laki-laki', '081212567165', 'Karyawan'),
(3, 'Erika Putri', 'Perempuan', '09233232233', 'Siswa'),
(5, 'Arif Alwi', 'Laki-laki', '08767555443', 'Guru'),
(17, 'Ari Anwar', 'Laki-laki', '085676543444', 'Siswa'),
(18, 'Eny Wiedaa', 'Perempuan', '087676555444', 'Guru');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_ruang`
--

CREATE TABLE `tb_ruang` (
  `kode_ruang` int(11) NOT NULL,
  `nama_ruang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_ruang`
--

INSERT INTO `tb_ruang` (`kode_ruang`, `nama_ruang`) VALUES
(2, 'Ruang 201'),
(3, 'Ruang 202'),
(4, 'Ruang 203'),
(13, 'Ruang Kantor'),
(14, 'Ruang TU');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`) VALUES
(5, 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(8, 'tegar', '827ccb0eea8a706c4c34a16891f84e7b');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`kode_barang`),
  ADD KEY `kode_ruang` (`kode_ruang`);

--
-- Indeks untuk tabel `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  ADD PRIMARY KEY (`kode_peminjaman`),
  ADD KEY `id_pengguna` (`id_pengguna`,`kode_barang`),
  ADD KEY `kode_barang` (`kode_barang`);

--
-- Indeks untuk tabel `tb_pengembalian`
--
ALTER TABLE `tb_pengembalian`
  ADD PRIMARY KEY (`kode_pengembalian`),
  ADD KEY `id_pengguna` (`id_pengguna`),
  ADD KEY `kode_peminjaman` (`kode_peminjaman`);

--
-- Indeks untuk tabel `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indeks untuk tabel `tb_ruang`
--
ALTER TABLE `tb_ruang`
  ADD PRIMARY KEY (`kode_ruang`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `kode_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT untuk tabel `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  MODIFY `kode_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT untuk tabel `tb_pengembalian`
--
ALTER TABLE `tb_pengembalian`
  MODIFY `kode_pengembalian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tb_ruang`
--
ALTER TABLE `tb_ruang`
  MODIFY `kode_ruang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD CONSTRAINT `tb_barang_ibfk_1` FOREIGN KEY (`kode_ruang`) REFERENCES `tb_ruang` (`kode_ruang`);

--
-- Ketidakleluasaan untuk tabel `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  ADD CONSTRAINT `tb_peminjaman_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `tb_pengguna` (`id_pengguna`),
  ADD CONSTRAINT `tb_peminjaman_ibfk_2` FOREIGN KEY (`kode_barang`) REFERENCES `tb_barang` (`kode_barang`);

--
-- Ketidakleluasaan untuk tabel `tb_pengembalian`
--
ALTER TABLE `tb_pengembalian`
  ADD CONSTRAINT `tb_pengembalian_ibfk_1` FOREIGN KEY (`kode_peminjaman`) REFERENCES `tb_peminjaman` (`kode_peminjaman`),
  ADD CONSTRAINT `tb_pengembalian_ibfk_2` FOREIGN KEY (`id_pengguna`) REFERENCES `tb_pengguna` (`id_pengguna`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
