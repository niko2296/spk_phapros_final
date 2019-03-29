-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2019 at 09:39 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phapros_final`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses_menu`
--

CREATE TABLE `akses_menu` (
  `id_akses` bigint(20) NOT NULL,
  `id_jabatan` bigint(20) NOT NULL DEFAULT '0',
  `menu1` int(2) NOT NULL DEFAULT '0',
  `menu2` int(2) NOT NULL DEFAULT '0',
  `menu3` int(2) NOT NULL DEFAULT '0',
  `menu4` int(2) NOT NULL DEFAULT '0',
  `menu5` int(2) NOT NULL DEFAULT '0',
  `menu6` int(2) NOT NULL DEFAULT '0',
  `menu7` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akses_menu`
--

INSERT INTO `akses_menu` (`id_akses`, `id_jabatan`, `menu1`, `menu2`, `menu3`, `menu4`, `menu5`, `menu6`, `menu7`) VALUES
(1, 3, 0, 0, 0, 0, 1, 0, 0),
(2, 2, 0, 0, 0, 0, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `aturan_penilai`
--

CREATE TABLE `aturan_penilai` (
  `id_aturan` bigint(20) NOT NULL,
  `id_jabatan_penilai` bigint(20) NOT NULL DEFAULT '0',
  `id_unit_penilai` bigint(20) NOT NULL DEFAULT '0',
  `id_jabatan_dinilai` bigint(20) NOT NULL DEFAULT '0',
  `id_unit_dinilai` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aturan_penilai`
--

INSERT INTO `aturan_penilai` (`id_aturan`, `id_jabatan_penilai`, `id_unit_penilai`, `id_jabatan_dinilai`, `id_unit_dinilai`) VALUES
(5, 2, 1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `aturan_polarisasi`
--

CREATE TABLE `aturan_polarisasi` (
  `id_aturan_polarisasi` bigint(20) NOT NULL,
  `id_polarisasi` bigint(20) NOT NULL,
  `bmi` decimal(10,2) NOT NULL,
  `bma` decimal(10,2) NOT NULL,
  `poin` decimal(10,2) NOT NULL,
  `tanggal_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aturan_polarisasi`
--

INSERT INTO `aturan_polarisasi` (`id_aturan_polarisasi`, `id_polarisasi`, `bmi`, `bma`, `poin`, `tanggal_input`) VALUES
(8, 10, '1.00', '20.00', '1.00', '2019-03-21'),
(14, 23, '1.00', '20.00', '1.00', '2019-03-21'),
(15, 23, '21.00', '40.00', '2.00', '2019-03-21'),
(18, 2, '1.00', '50.00', '1.00', '2019-03-21'),
(21, 4, '1.00', '20.00', '1.00', '2019-03-21'),
(22, 4, '21.00', '40.00', '2.00', '2019-03-21'),
(23, 5, '1.00', '50.00', '1.00', '2019-03-21'),
(24, 6, '1.00', '20.00', '1.00', '2019-03-21'),
(25, 6, '21.00', '40.00', '2.00', '2019-03-21');

-- --------------------------------------------------------

--
-- Table structure for table `data_catatan`
--

CREATE TABLE `data_catatan` (
  `id_catatan` bigint(20) NOT NULL,
  `id_anggota` bigint(20) NOT NULL,
  `id_jabatan` bigint(20) NOT NULL,
  `id_unit` bigint(20) NOT NULL,
  `id_periode` bigint(20) NOT NULL,
  `catatan` text NOT NULL,
  `tanggal_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_kpi`
--

CREATE TABLE `data_kpi` (
  `id_kpi` bigint(20) NOT NULL,
  `id_anggota` bigint(20) NOT NULL DEFAULT '0',
  `id_jabatan` bigint(20) NOT NULL DEFAULT '0',
  `id_unit` bigint(20) DEFAULT '0',
  `id_periode` bigint(20) NOT NULL DEFAULT '0',
  `kpi` text NOT NULL,
  `deskripsi` text NOT NULL,
  `bobot` decimal(20,2) NOT NULL DEFAULT '0.00',
  `sasaran` decimal(20,2) NOT NULL DEFAULT '0.00',
  `satuan` varchar(20) NOT NULL,
  `sifat_kpi` int(2) NOT NULL DEFAULT '0',
  `status` int(2) NOT NULL DEFAULT '0',
  `id_verifikator` bigint(20) NOT NULL DEFAULT '0',
  `tanggal_input` date NOT NULL,
  `tanggal_verifikasi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_kpi`
--

INSERT INTO `data_kpi` (`id_kpi`, `id_anggota`, `id_jabatan`, `id_unit`, `id_periode`, `kpi`, `deskripsi`, `bobot`, `sasaran`, `satuan`, `sifat_kpi`, `status`, `id_verifikator`, `tanggal_input`, `tanggal_verifikasi`) VALUES
(2, 1, 3, 1, 3, 'Coba Edit 2', 'Ini Coba Edit 2', '80.00', '30.00', '9', 5, 1, 2, '2019-03-22', '2019-03-26'),
(3, 1, 3, 1, 3, 'Coba Edit 1', 'Ini Coba Edit 1', '10.00', '3.00', '10', 6, 1, 2, '2019-03-22', '2019-03-26'),
(4, 1, 3, 1, 3, 'Coba 3', 'Ini Coba 3', '10.00', '5.00', '9', 5, 1, 2, '2019-03-26', '2019-03-26');

-- --------------------------------------------------------

--
-- Table structure for table `data_kpi_verifikasi`
--

CREATE TABLE `data_kpi_verifikasi` (
  `id_kpi_verifikasi` bigint(20) NOT NULL,
  `id_kpi_asli` bigint(20) NOT NULL,
  `id_anggota` bigint(20) NOT NULL DEFAULT '0',
  `jabatan` varchar(50) NOT NULL DEFAULT '0',
  `unit` varchar(50) DEFAULT '0',
  `periode` bigint(20) NOT NULL DEFAULT '0',
  `kpi` text NOT NULL,
  `deskripsi` text NOT NULL,
  `bobot` decimal(10,0) NOT NULL DEFAULT '0',
  `sasaran` decimal(10,0) NOT NULL DEFAULT '0',
  `satuan` varchar(20) NOT NULL,
  `sifat_kpi` int(2) NOT NULL DEFAULT '0',
  `status` int(2) NOT NULL DEFAULT '0',
  `id_verifikator` bigint(20) NOT NULL DEFAULT '0',
  `tanggal_input` date NOT NULL,
  `tanggal_verifikasi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_kpi_verifikasi`
--

INSERT INTO `data_kpi_verifikasi` (`id_kpi_verifikasi`, `id_kpi_asli`, `id_anggota`, `jabatan`, `unit`, `periode`, `kpi`, `deskripsi`, `bobot`, `sasaran`, `satuan`, `sifat_kpi`, `status`, `id_verifikator`, `tanggal_input`, `tanggal_verifikasi`) VALUES
(3, 2, 1, 'Programmer', 'Teknologi Informasi', 2020, 'Coba Edit 2', 'Ini Coba Edit 2', '80', '30', '9', 5, 1, 2, '2019-03-22', '2019-03-26'),
(6, 3, 1, 'Programmer', 'Teknologi Informasi', 2020, 'Coba Edit 1', 'Ini Coba Edit 1', '10', '3', '10', 6, 1, 0, '2019-03-22', '2019-03-26'),
(7, 4, 1, 'Programmer', 'Teknologi Informasi', 2020, 'Coba 3', 'Ini Coba 3', '10', '5', '9', 5, 1, 0, '2019-03-26', '2019-03-26');

-- --------------------------------------------------------

--
-- Table structure for table `data_realisasi_kpi`
--

CREATE TABLE `data_realisasi_kpi` (
  `id_realisasi` bigint(20) NOT NULL,
  `id_kpi` bigint(20) NOT NULL,
  `realisasi` decimal(20,2) NOT NULL,
  `keterangan` text NOT NULL,
  `status` int(5) NOT NULL,
  `tanggal_input` date NOT NULL,
  `id_verifikator` bigint(20) NOT NULL,
  `tanggal_verif` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_realisasi_kpi`
--

INSERT INTO `data_realisasi_kpi` (`id_realisasi`, `id_kpi`, `realisasi`, `keterangan`, `status`, `tanggal_input`, `id_verifikator`, `tanggal_verif`) VALUES
(4, 2, '6.00', 'a', 1, '2019-03-28', 0, '0000-00-00'),
(5, 3, '5.00', 'b', 1, '2019-03-28', 0, '0000-00-00'),
(6, 4, '3.00', 'ini coba keterangan', 0, '2019-03-28', 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `mst_anggota`
--

CREATE TABLE `mst_anggota` (
  `id_anggota` bigint(20) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` int(2) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `status` int(2) NOT NULL,
  `nomor_hp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `id_golongan` bigint(20) NOT NULL,
  `id_jabatan` bigint(20) NOT NULL,
  `id_unit` bigint(20) NOT NULL,
  `alamat` text NOT NULL,
  `tanggal_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_anggota`
--

INSERT INTO `mst_anggota` (`id_anggota`, `nik`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `status`, `nomor_hp`, `email`, `id_golongan`, `id_jabatan`, `id_unit`, `alamat`, `tanggal_input`) VALUES
(1, '11111', 'Niko Kusdiarto', 1, 'Kabupaten Semarang', '1996-02-02', 1, '082118009419', 'niko.kusdiarto@gmail.com', 1, 3, 1, 'Ungaran', '2019-03-21'),
(2, '22222', 'Eko Sudiarto', 1, 'Tegal', '1966-06-22', 2, '085865244793', 'ekosud@gmail.com', 1, 2, 1, 'Leyangan', '2019-03-21'),
(3, '33333', 'Kusneni Rositawati', 1, 'Semarang', '1966-06-30', 2, '081575662267', 'kusneni@gmail.com', 1, 3, 1, 'Leyangan', '2019-03-25');

-- --------------------------------------------------------

--
-- Table structure for table `mst_golongan`
--

CREATE TABLE `mst_golongan` (
  `id_golongan` bigint(20) NOT NULL,
  `nama_golongan` varchar(50) NOT NULL,
  `tanggal_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_golongan`
--

INSERT INTO `mst_golongan` (`id_golongan`, `nama_golongan`, `tanggal_input`) VALUES
(1, 'I A', '2019-03-25');

-- --------------------------------------------------------

--
-- Table structure for table `mst_jabatan`
--

CREATE TABLE `mst_jabatan` (
  `id_jabatan` bigint(20) NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL,
  `tanggal_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_jabatan`
--

INSERT INTO `mst_jabatan` (`id_jabatan`, `nama_jabatan`, `tanggal_input`) VALUES
(2, 'Asisten Manager', '2019-03-21'),
(3, 'Programmer', '2019-03-21');

-- --------------------------------------------------------

--
-- Table structure for table `mst_periode`
--

CREATE TABLE `mst_periode` (
  `id_periode` bigint(20) NOT NULL,
  `tahun` int(10) NOT NULL,
  `status` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_periode`
--

INSERT INTO `mst_periode` (`id_periode`, `tahun`, `status`) VALUES
(2, 2019, 0),
(3, 2020, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_polarisasi`
--

CREATE TABLE `mst_polarisasi` (
  `id_polarisasi` bigint(20) NOT NULL,
  `nama_polarisasi` varchar(50) NOT NULL,
  `id_periode` bigint(20) NOT NULL,
  `tanggal_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_polarisasi`
--

INSERT INTO `mst_polarisasi` (`id_polarisasi`, `nama_polarisasi`, `id_periode`, `tanggal_input`) VALUES
(2, 'Negatif', 2, '2019-03-21'),
(4, 'Absolute Positif', 2, '2019-03-21'),
(5, 'Negatif', 3, '2019-03-21'),
(6, 'Absolute Positif', 3, '2019-03-21');

-- --------------------------------------------------------

--
-- Table structure for table `mst_satuan`
--

CREATE TABLE `mst_satuan` (
  `id_satuan` bigint(20) NOT NULL,
  `nama_satuan` varchar(50) NOT NULL,
  `jenis_polarisasi` text NOT NULL,
  `id_periode` bigint(20) NOT NULL,
  `tanggal_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_satuan`
--

INSERT INTO `mst_satuan` (`id_satuan`, `nama_satuan`, `jenis_polarisasi`, `id_periode`, `tanggal_input`) VALUES
(1, '%', 'a:1:{i:0;s:1:\"2\";}', 2, '2019-03-21'),
(2, 'Coba 1', 'a:2:{i:0;s:1:\"2\";i:1;s:1:\"4\";}', 2, '2019-03-21'),
(9, '%', 'a:1:{i:0;s:1:\"5\";}', 3, '2019-03-21'),
(10, 'Coba 1', 'a:2:{i:0;s:1:\"5\";i:1;s:1:\"6\";}', 3, '2019-03-21');

-- --------------------------------------------------------

--
-- Table structure for table `mst_unit`
--

CREATE TABLE `mst_unit` (
  `id_unit` bigint(20) NOT NULL,
  `nama_unit` varchar(50) NOT NULL,
  `tanggal_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_unit`
--

INSERT INTO `mst_unit` (`id_unit`, `nama_unit`, `tanggal_input`) VALUES
(1, 'Teknologi Informasi', '2019-03-21');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` bigint(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  `aksus` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `status`, `aksus`) VALUES
(1, '11111', 'b0baee9d279d34fa1dfd71aadb908c3f', 1, 0),
(2, '22222', '3d2172418ce305c7d16d4b05597c6a59', 1, 0),
(3, '33333', 'b7bc2a2f5bb6d521e64c8974c143e9a0', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `waktu_input`
--

CREATE TABLE `waktu_input` (
  `id_waktu_input` bigint(20) NOT NULL,
  `tanggal_awal_input` date NOT NULL,
  `tanggal_akhir_input` date NOT NULL,
  `jenis_input` int(5) NOT NULL,
  `tanggal_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `waktu_input`
--

INSERT INTO `waktu_input` (`id_waktu_input`, `tanggal_awal_input`, `tanggal_akhir_input`, `jenis_input`, `tanggal_input`) VALUES
(1, '2019-03-01', '2019-03-31', 2, '2019-03-21');

-- --------------------------------------------------------

--
-- Table structure for table `waktu_verifikasi`
--

CREATE TABLE `waktu_verifikasi` (
  `id_waktu_verifikasi` bigint(20) NOT NULL,
  `tanggal_awal_verifikasi` date NOT NULL,
  `tanggal_akhir_verifikasi` date NOT NULL,
  `jenis_verifikasi` int(5) NOT NULL,
  `tanggal_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `waktu_verifikasi`
--

INSERT INTO `waktu_verifikasi` (`id_waktu_verifikasi`, `tanggal_awal_verifikasi`, `tanggal_akhir_verifikasi`, `jenis_verifikasi`, `tanggal_input`) VALUES
(2, '2019-03-01', '2019-03-31', 1, '2019-03-28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses_menu`
--
ALTER TABLE `akses_menu`
  ADD PRIMARY KEY (`id_akses`);

--
-- Indexes for table `aturan_penilai`
--
ALTER TABLE `aturan_penilai`
  ADD PRIMARY KEY (`id_aturan`);

--
-- Indexes for table `aturan_polarisasi`
--
ALTER TABLE `aturan_polarisasi`
  ADD PRIMARY KEY (`id_aturan_polarisasi`);

--
-- Indexes for table `data_catatan`
--
ALTER TABLE `data_catatan`
  ADD PRIMARY KEY (`id_catatan`);

--
-- Indexes for table `data_kpi`
--
ALTER TABLE `data_kpi`
  ADD PRIMARY KEY (`id_kpi`);

--
-- Indexes for table `data_kpi_verifikasi`
--
ALTER TABLE `data_kpi_verifikasi`
  ADD PRIMARY KEY (`id_kpi_verifikasi`);

--
-- Indexes for table `data_realisasi_kpi`
--
ALTER TABLE `data_realisasi_kpi`
  ADD PRIMARY KEY (`id_realisasi`);

--
-- Indexes for table `mst_anggota`
--
ALTER TABLE `mst_anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `mst_golongan`
--
ALTER TABLE `mst_golongan`
  ADD PRIMARY KEY (`id_golongan`);

--
-- Indexes for table `mst_jabatan`
--
ALTER TABLE `mst_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `mst_periode`
--
ALTER TABLE `mst_periode`
  ADD PRIMARY KEY (`id_periode`);

--
-- Indexes for table `mst_polarisasi`
--
ALTER TABLE `mst_polarisasi`
  ADD PRIMARY KEY (`id_polarisasi`);

--
-- Indexes for table `mst_satuan`
--
ALTER TABLE `mst_satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `mst_unit`
--
ALTER TABLE `mst_unit`
  ADD PRIMARY KEY (`id_unit`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `waktu_input`
--
ALTER TABLE `waktu_input`
  ADD PRIMARY KEY (`id_waktu_input`);

--
-- Indexes for table `waktu_verifikasi`
--
ALTER TABLE `waktu_verifikasi`
  ADD PRIMARY KEY (`id_waktu_verifikasi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akses_menu`
--
ALTER TABLE `akses_menu`
  MODIFY `id_akses` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `aturan_penilai`
--
ALTER TABLE `aturan_penilai`
  MODIFY `id_aturan` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `aturan_polarisasi`
--
ALTER TABLE `aturan_polarisasi`
  MODIFY `id_aturan_polarisasi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `data_catatan`
--
ALTER TABLE `data_catatan`
  MODIFY `id_catatan` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_kpi`
--
ALTER TABLE `data_kpi`
  MODIFY `id_kpi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `data_kpi_verifikasi`
--
ALTER TABLE `data_kpi_verifikasi`
  MODIFY `id_kpi_verifikasi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `data_realisasi_kpi`
--
ALTER TABLE `data_realisasi_kpi`
  MODIFY `id_realisasi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mst_anggota`
--
ALTER TABLE `mst_anggota`
  MODIFY `id_anggota` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mst_golongan`
--
ALTER TABLE `mst_golongan`
  MODIFY `id_golongan` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mst_jabatan`
--
ALTER TABLE `mst_jabatan`
  MODIFY `id_jabatan` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mst_periode`
--
ALTER TABLE `mst_periode`
  MODIFY `id_periode` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mst_polarisasi`
--
ALTER TABLE `mst_polarisasi`
  MODIFY `id_polarisasi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mst_satuan`
--
ALTER TABLE `mst_satuan`
  MODIFY `id_satuan` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mst_unit`
--
ALTER TABLE `mst_unit`
  MODIFY `id_unit` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `waktu_input`
--
ALTER TABLE `waktu_input`
  MODIFY `id_waktu_input` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `waktu_verifikasi`
--
ALTER TABLE `waktu_verifikasi`
  MODIFY `id_waktu_verifikasi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
