-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2019 at 11:03 PM
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
-- Database: `phapros`
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
(1, 3, 1, 0, 1, 0, 1, 1, 1),
(2, 2, 1, 0, 0, 0, 1, 1, 1),
(3, 4, 0, 0, 0, 0, 1, 0, 0);

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
(4, 3, 1, 4, 1),
(5, 2, 1, 3, 1),
(6, 2, 1, 4, 1),
(11, 2, 2, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `data_kpi`
--

CREATE TABLE `data_kpi` (
  `id_kpi` bigint(20) NOT NULL,
  `id_anggota` bigint(20) NOT NULL DEFAULT '0',
  `id_jabatan` bigint(20) NOT NULL DEFAULT '0',
  `id_unit` bigint(20) DEFAULT '0',
  `tahun` int(20) NOT NULL DEFAULT '0',
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
-- Dumping data for table `data_kpi`
--

INSERT INTO `data_kpi` (`id_kpi`, `id_anggota`, `id_jabatan`, `id_unit`, `tahun`, `kpi`, `deskripsi`, `bobot`, `sasaran`, `satuan`, `sifat_kpi`, `status`, `id_verifikator`, `tanggal_input`, `tanggal_verifikasi`) VALUES
(1, 2, 4, 1, 2019, 'Coba 1', 'Ini Uji Coba 1', '30', '10', '1', 1, 1, 0, '2019-03-11', '2019-03-14'),
(2, 2, 4, 1, 2019, 'Coba 2', 'Ini Uji Coba 2', '70', '20', '3', 5, 1, 1, '2019-03-11', '2019-03-12'),
(3, 1, 3, 1, 2019, 'Baru Coba 1', 'Ini Baru Coba 1', '20', '5', '1', 1, 1, 0, '2019-03-12', '2019-03-14'),
(5, 1, 3, 1, 2019, 'Baru Coba 2', 'Ini Baru Coba 2', '80', '10', '3', 5, 1, 0, '2019-03-13', '2019-03-14'),
(7, 2, 4, 1, 2010, 'Baru Sekali 1', 'Ini Baru Sekali 1', '60', '30', '1', 2, 1, 1, '2019-03-14', '2019-03-14'),
(8, 2, 4, 1, 2010, 'Baru Sekali 2', 'Baru Sekali 2', '40', '15', '3', 5, 1, 1, '2019-03-14', '2019-03-14'),
(9, 1, 3, 1, 2021, 'Baru Coba 1', 'Ini Baru Coba 1', '20', '5', '1', 1, 1, 0, '2019-03-15', '2019-03-15'),
(10, 1, 3, 1, 2021, 'Baru Coba 2', 'Ini Baru Coba 2', '80', '10', '3', 5, 1, 0, '2019-03-15', '2019-03-15');

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
(1, '11111', 'Eko Sudiarto', 1, 'Tegal', '1966-06-22', 2, '085865244793', 'ekosudiarto@gmail.com', 1, 3, 1, 'Ungaran', '2019-03-11'),
(2, '22222', 'Niko Kusdiarto', 1, 'Kabupaten Semarang', '1996-02-02', 1, '082118009419', 'niko.kusdiarto@gmail.com', 3, 4, 1, 'Leyangan', '2019-03-11'),
(3, '33333', 'Kusneni Rositawati', 2, 'Semarang', '1965-06-30', 2, '081575662267', 'kusneni@gmail.com', 4, 2, 1, 'Leyangan', '2019-03-13');

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
(1, 'I A', '2019-03-11'),
(2, 'I B', '2019-03-11'),
(3, 'II A', '2019-03-11'),
(4, 'II B', '2019-03-11');

-- --------------------------------------------------------

--
-- Table structure for table `mst_jabatan`
--

CREATE TABLE `mst_jabatan` (
  `id_jabatan` bigint(20) NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL,
  `akses_nilai` int(2) NOT NULL DEFAULT '0',
  `tanggal_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_jabatan`
--

INSERT INTO `mst_jabatan` (`id_jabatan`, `nama_jabatan`, `akses_nilai`, `tanggal_input`) VALUES
(1, 'Direktur', 1, '2019-03-11'),
(2, 'Manager', 1, '2019-03-11'),
(3, 'Asisten Manager', 1, '2019-03-11'),
(4, 'Programmer', 0, '2019-03-11');

-- --------------------------------------------------------

--
-- Table structure for table `mst_satuan`
--

CREATE TABLE `mst_satuan` (
  `id_satuan` bigint(20) NOT NULL,
  `nama_satuan` varchar(50) NOT NULL,
  `jenis_polarisasi` text NOT NULL,
  `tanggal_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_satuan`
--

INSERT INTO `mst_satuan` (`id_satuan`, `nama_satuan`, `jenis_polarisasi`, `tanggal_input`) VALUES
(1, '%', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";i:3;s:1:\"4\";i:4;s:1:\"5\";i:5;s:1:\"6\";}', '2019-03-12'),
(3, 'Jam', 'a:1:{i:0;s:1:\"5\";}', '2019-03-11');

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
(1, 'Teknologi Informasi', '2019-03-11'),
(2, 'SDM', '2019-03-15');

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
(1, '11111', 'e10adc3949ba59abbe56e057f20f883e', 1, 0),
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
  `tanggal_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `waktu_input`
--

INSERT INTO `waktu_input` (`id_waktu_input`, `tanggal_awal_input`, `tanggal_akhir_input`, `tanggal_input`) VALUES
(2, '2019-03-01', '2019-03-31', '2019-03-15');

-- --------------------------------------------------------

--
-- Table structure for table `waktu_verifikasi`
--

CREATE TABLE `waktu_verifikasi` (
  `id_waktu_verifikasi` bigint(20) NOT NULL,
  `tanggal_awal_verifikasi` date NOT NULL,
  `tanggal_akhir_verifikasi` date NOT NULL,
  `tanggal_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `waktu_verifikasi`
--

INSERT INTO `waktu_verifikasi` (`id_waktu_verifikasi`, `tanggal_awal_verifikasi`, `tanggal_akhir_verifikasi`, `tanggal_input`) VALUES
(2, '2019-03-01', '2019-03-31', '2019-03-15');

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
-- Indexes for table `data_kpi`
--
ALTER TABLE `data_kpi`
  ADD PRIMARY KEY (`id_kpi`);

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
  MODIFY `id_akses` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `aturan_penilai`
--
ALTER TABLE `aturan_penilai`
  MODIFY `id_aturan` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `data_kpi`
--
ALTER TABLE `data_kpi`
  MODIFY `id_kpi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mst_anggota`
--
ALTER TABLE `mst_anggota`
  MODIFY `id_anggota` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mst_golongan`
--
ALTER TABLE `mst_golongan`
  MODIFY `id_golongan` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mst_jabatan`
--
ALTER TABLE `mst_jabatan`
  MODIFY `id_jabatan` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mst_satuan`
--
ALTER TABLE `mst_satuan`
  MODIFY `id_satuan` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mst_unit`
--
ALTER TABLE `mst_unit`
  MODIFY `id_unit` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `waktu_input`
--
ALTER TABLE `waktu_input`
  MODIFY `id_waktu_input` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `waktu_verifikasi`
--
ALTER TABLE `waktu_verifikasi`
  MODIFY `id_waktu_verifikasi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
