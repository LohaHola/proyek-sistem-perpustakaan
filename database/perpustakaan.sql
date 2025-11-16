-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2025 at 10:22 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun_login`
--

CREATE TABLE `akun_login` (
  `ID_Akun` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password_Hash` varchar(255) NOT NULL,
  `Role` enum('admin','petugas','anggota') NOT NULL,
  `ID_Anggota` int(11) NOT NULL,
  `ID_Petugas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun_login`
--

INSERT INTO `akun_login` (`ID_Akun`, `Username`, `Password_Hash`, `Role`, `ID_Anggota`, `ID_Petugas`) VALUES
(1, 'arya79', '$2y$10$U/RYCJ1fzbwfNDeCb7prTumjvyw1u0ifn8pfByKtWtPo5d62BP2JS', 'admin', 6, 5);

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `ID_Anggota` int(11) NOT NULL,
  `Nama_Anggota` varchar(100) NOT NULL,
  `Tgl_Lahir` date DEFAULT NULL,
  `No_Telp` varchar(20) DEFAULT NULL,
  `Tanggal_Daftar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`ID_Anggota`, `Nama_Anggota`, `Tgl_Lahir`, `No_Telp`, `Tanggal_Daftar`) VALUES
(6, 'Muhammad Arya Nugraha', '2006-02-27', '08111188879', '2025-11-16');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `ID_Buku` int(11) NOT NULL,
  `ISBN` varchar(20) DEFAULT NULL,
  `Judul` varchar(200) NOT NULL,
  `Tahun_Terbit` int(11) DEFAULT NULL,
  `ID_Penerbit` int(11) DEFAULT NULL,
  `ID_Kategori` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`ID_Buku`, `ISBN`, `Judul`, `Tahun_Terbit`, `ID_Penerbit`, `ID_Kategori`) VALUES
(11, '9786028588459', 'Filosofi Kopi', 2013, 1, 8),
(12, '9786028588500', 'Hello Dunia', 2016, 9, 6);

-- --------------------------------------------------------

--
-- Table structure for table `denda`
--

CREATE TABLE `denda` (
  `ID_Denda` int(11) NOT NULL,
  `ID_Peminjaman` int(11) NOT NULL,
  `Total_Denda` decimal(10,2) NOT NULL,
  `Tgl_Pembayaran` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `eksemplar`
--

CREATE TABLE `eksemplar` (
  `ID_Eksemplar` int(11) NOT NULL,
  `ID_Buku` int(11) NOT NULL,
  `No_Induk_Inventaris` varchar(50) NOT NULL,
  `Status_Ketersediaan` text DEFAULT 'tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eksemplar`
--

INSERT INTO `eksemplar` (`ID_Eksemplar`, `ID_Buku`, `No_Induk_Inventaris`, `Status_Ketersediaan`) VALUES
(20, 11, '11-001', 'tersedia'),
(21, 11, '11-002', 'tersedia'),
(22, 11, '11-003', 'tersedia'),
(23, 11, '11-004', 'tersedia'),
(24, 11, '11-005', 'tersedia'),
(25, 11, '11-006', 'tersedia'),
(26, 11, '11-007', 'tersedia'),
(27, 11, '11-008', 'tersedia'),
(28, 11, '11-009', 'tersedia'),
(29, 11, '11-010', 'tersedia'),
(30, 11, '11-011', 'tersedia'),
(31, 11, '11-012', 'tersedia'),
(32, 11, '11-013', 'tersedia'),
(33, 11, '11-014', 'tersedia'),
(34, 11, '11-015', 'tersedia'),
(35, 11, '11-016', 'tersedia'),
(36, 11, '11-017', 'tersedia'),
(37, 11, '11-018', 'tersedia'),
(38, 11, '11-019', 'tersedia'),
(39, 11, '11-020', 'tersedia'),
(40, 11, '11-021', 'tersedia'),
(41, 12, '12-001', 'tersedia'),
(42, 12, '12-002', 'tersedia'),
(43, 12, '12-003', 'tersedia'),
(44, 12, '12-004', 'tersedia'),
(45, 12, '12-005', 'tersedia'),
(46, 12, '12-006', 'tersedia'),
(47, 12, '12-007', 'tersedia'),
(48, 12, '12-008', 'tersedia'),
(49, 12, '12-009', 'tersedia'),
(50, 12, '12-010', 'tersedia'),
(51, 12, '12-011', 'tersedia'),
(52, 12, '12-012', 'tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `ID_Kategori` int(11) NOT NULL,
  `Nama_Kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`ID_Kategori`, `Nama_Kategori`) VALUES
(6, 'Anak-anak'),
(5, 'Biografi'),
(1, 'Fiksi'),
(2, 'Non-Fiksi'),
(7, 'Referensi'),
(9, 'Sains'),
(8, 'Sastra'),
(4, 'Sejarah'),
(10, 'Seni'),
(3, 'Teknologi');

-- --------------------------------------------------------

--
-- Table structure for table `log_kunjungan`
--

CREATE TABLE `log_kunjungan` (
  `ID_Kunjungan` int(11) NOT NULL,
  `Tgl_Waktu_Kunjungan` datetime NOT NULL,
  `Tujuan_Kunjungan` text DEFAULT NULL,
  `ID_Anggota` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_kunjungan`
--

INSERT INTO `log_kunjungan` (`ID_Kunjungan`, `Tgl_Waktu_Kunjungan`, `Tujuan_Kunjungan`, `ID_Anggota`) VALUES
(6, '2025-11-16 22:20:25', 'Login ke sistem', 6);

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

CREATE TABLE `penerbit` (
  `ID_Penerbit` int(11) NOT NULL,
  `Nama_Penerbit` varchar(100) NOT NULL,
  `Alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`ID_Penerbit`, `Nama_Penerbit`, `Alamat`) VALUES
(1, 'Penerbit Gramedia', 'Jakarta'),
(2, 'Mizan Publishing', 'Bandung'),
(3, 'Erlangga', 'Jakarta'),
(4, 'Republika', 'Jakarta'),
(5, 'Kompas Gramedia', 'Jakarta'),
(6, 'Bentang Pustaka', 'Yogyakarta'),
(7, 'LKiS', 'Jakarta'),
(8, 'GagasMedia', 'Jakarta'),
(9, 'Noura Book', 'Jakarta'),
(10, 'Loveable', 'Jakarta');

-- --------------------------------------------------------

--
-- Table structure for table `pengarang`
--

CREATE TABLE `pengarang` (
  `ID_Pengarang` int(11) NOT NULL,
  `Nama_Pengarang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengarang`
--

INSERT INTO `pengarang` (`ID_Pengarang`, `Nama_Pengarang`) VALUES
(11, 'Arya Nugraha');

-- --------------------------------------------------------

--
-- Table structure for table `penulisan`
--

CREATE TABLE `penulisan` (
  `ID_Buku` int(11) NOT NULL,
  `ID_Pengarang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penulisan`
--

INSERT INTO `penulisan` (`ID_Buku`, `ID_Pengarang`) VALUES
(11, 11),
(12, 11);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `ID_Petugas` int(11) NOT NULL,
  `Nama_Petugas` varchar(100) NOT NULL,
  `Jabatan` enum('Administrator','Petugas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`ID_Petugas`, `Nama_Petugas`, `Jabatan`) VALUES
(5, 'Muhammad Arya Nugraha', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_peminjaman`
--

CREATE TABLE `transaksi_peminjaman` (
  `ID_Peminjaman` int(11) NOT NULL,
  `ID_Anggota` int(11) NOT NULL,
  `ID_Eksemplar` int(11) NOT NULL,
  `ID_Petugas_Pinjam` int(11) NOT NULL,
  `Tgl_Pinjam` date NOT NULL,
  `Tgl_Harus_Kembali` date NOT NULL,
  `Tgl_Aktual_Kembali` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun_login`
--
ALTER TABLE `akun_login`
  ADD PRIMARY KEY (`ID_Akun`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD KEY `ID_Anggota` (`ID_Anggota`),
  ADD KEY `ID_Petugas` (`ID_Petugas`);

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`ID_Anggota`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`ID_Buku`),
  ADD UNIQUE KEY `ISBN` (`ISBN`),
  ADD KEY `ID_Penerbit` (`ID_Penerbit`),
  ADD KEY `ID_Kategori` (`ID_Kategori`);

--
-- Indexes for table `denda`
--
ALTER TABLE `denda`
  ADD PRIMARY KEY (`ID_Denda`),
  ADD UNIQUE KEY `ID_Peminjaman` (`ID_Peminjaman`);

--
-- Indexes for table `eksemplar`
--
ALTER TABLE `eksemplar`
  ADD PRIMARY KEY (`ID_Eksemplar`),
  ADD UNIQUE KEY `No_Induk_Inventaris` (`No_Induk_Inventaris`),
  ADD KEY `ID_Buku` (`ID_Buku`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`ID_Kategori`),
  ADD UNIQUE KEY `Nama_Kategori` (`Nama_Kategori`);

--
-- Indexes for table `log_kunjungan`
--
ALTER TABLE `log_kunjungan`
  ADD PRIMARY KEY (`ID_Kunjungan`),
  ADD KEY `ID_Anggota` (`ID_Anggota`);

--
-- Indexes for table `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`ID_Penerbit`);

--
-- Indexes for table `pengarang`
--
ALTER TABLE `pengarang`
  ADD PRIMARY KEY (`ID_Pengarang`);

--
-- Indexes for table `penulisan`
--
ALTER TABLE `penulisan`
  ADD PRIMARY KEY (`ID_Buku`,`ID_Pengarang`),
  ADD KEY `ID_Pengarang` (`ID_Pengarang`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`ID_Petugas`);

--
-- Indexes for table `transaksi_peminjaman`
--
ALTER TABLE `transaksi_peminjaman`
  ADD PRIMARY KEY (`ID_Peminjaman`),
  ADD KEY `ID_Anggota` (`ID_Anggota`),
  ADD KEY `ID_Eksemplar` (`ID_Eksemplar`),
  ADD KEY `ID_Petugas_Pinjam` (`ID_Petugas_Pinjam`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun_login`
--
ALTER TABLE `akun_login`
  MODIFY `ID_Akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `ID_Anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `ID_Buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `denda`
--
ALTER TABLE `denda`
  MODIFY `ID_Denda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `eksemplar`
--
ALTER TABLE `eksemplar`
  MODIFY `ID_Eksemplar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `ID_Kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `log_kunjungan`
--
ALTER TABLE `log_kunjungan`
  MODIFY `ID_Kunjungan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `ID_Penerbit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pengarang`
--
ALTER TABLE `pengarang`
  MODIFY `ID_Pengarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `ID_Petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi_peminjaman`
--
ALTER TABLE `transaksi_peminjaman`
  MODIFY `ID_Peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `akun_login`
--
ALTER TABLE `akun_login`
  ADD CONSTRAINT `akun_login_ibfk_1` FOREIGN KEY (`ID_Anggota`) REFERENCES `anggota` (`ID_Anggota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `akun_login_ibfk_2` FOREIGN KEY (`ID_Petugas`) REFERENCES `petugas` (`ID_Petugas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`ID_Penerbit`) REFERENCES `penerbit` (`ID_Penerbit`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `buku_ibfk_2` FOREIGN KEY (`ID_Kategori`) REFERENCES `kategori` (`ID_Kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `denda`
--
ALTER TABLE `denda`
  ADD CONSTRAINT `denda_ibfk_1` FOREIGN KEY (`ID_Peminjaman`) REFERENCES `transaksi_peminjaman` (`ID_Peminjaman`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eksemplar`
--
ALTER TABLE `eksemplar`
  ADD CONSTRAINT `eksemplar_ibfk_1` FOREIGN KEY (`ID_Buku`) REFERENCES `buku` (`ID_Buku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `log_kunjungan`
--
ALTER TABLE `log_kunjungan`
  ADD CONSTRAINT `log_kunjungan_ibfk_1` FOREIGN KEY (`ID_Anggota`) REFERENCES `anggota` (`ID_Anggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penulisan`
--
ALTER TABLE `penulisan`
  ADD CONSTRAINT `penulisan_ibfk_1` FOREIGN KEY (`ID_Buku`) REFERENCES `buku` (`ID_Buku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penulisan_ibfk_2` FOREIGN KEY (`ID_Pengarang`) REFERENCES `pengarang` (`ID_Pengarang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_peminjaman`
--
ALTER TABLE `transaksi_peminjaman`
  ADD CONSTRAINT `transaksi_peminjaman_ibfk_1` FOREIGN KEY (`ID_Anggota`) REFERENCES `anggota` (`ID_Anggota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_peminjaman_ibfk_2` FOREIGN KEY (`ID_Eksemplar`) REFERENCES `eksemplar` (`ID_Eksemplar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_peminjaman_ibfk_3` FOREIGN KEY (`ID_Petugas_Pinjam`) REFERENCES `petugas` (`ID_Petugas`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
