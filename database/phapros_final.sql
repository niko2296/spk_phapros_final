-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2019 at 06:03 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `aturan_matriks`
--

CREATE TABLE `aturan_matriks` (
  `id_matriks` bigint(20) NOT NULL,
  `id_departemen` bigint(20) NOT NULL,
  `tanggal_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aturan_matriks`
--

INSERT INTO `aturan_matriks` (`id_matriks`, `id_departemen`, `tanggal_input`) VALUES
(3, 3, '2019-04-26');

-- --------------------------------------------------------

--
-- Table structure for table `aturan_penilai`
--

CREATE TABLE `aturan_penilai` (
  `id_aturan` bigint(20) NOT NULL,
  `id_jabatan_penilai` bigint(20) NOT NULL DEFAULT '0',
  `id_departemen_penilai` bigint(20) NOT NULL,
  `id_unit_penilai` bigint(20) NOT NULL DEFAULT '0',
  `id_jabatan_dinilai` bigint(20) NOT NULL DEFAULT '0',
  `id_departemen_dinilai` bigint(20) NOT NULL,
  `id_unit_dinilai` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aturan_penilai`
--

INSERT INTO `aturan_penilai` (`id_aturan`, `id_jabatan_penilai`, `id_departemen_penilai`, `id_unit_penilai`, `id_jabatan_dinilai`, `id_departemen_dinilai`, `id_unit_dinilai`) VALUES
(7, 3, 1, 0, 1, 1, 2),
(14, 3, 1, 0, 1, 1, 1),
(15, 1, 1, 1, 2, 1, 1),
(17, 1, 1, 2, 4, 1, 2),
(18, 3, 3, 0, 1, 3, 3),
(19, 3, 3, 0, 1, 3, 4),
(20, 1, 3, 3, 5, 3, 3),
(21, 1, 3, 4, 5, 3, 4);

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
(1, 1, '115.00', '0.00', '100.00', '2019-04-12'),
(2, 1, '100.00', '114.00', '90.00', '2019-04-12'),
(3, 2, '0.00', '75.00', '100.00', '2019-04-22'),
(4, 2, '76.00', '90.00', '90.00', '2019-04-12');

-- --------------------------------------------------------

--
-- Table structure for table `data_catatan`
--

CREATE TABLE `data_catatan` (
  `id_catatan` bigint(20) NOT NULL,
  `id_anggota` bigint(20) NOT NULL,
  `id_jabatan` bigint(20) NOT NULL,
  `id_departemen` bigint(20) NOT NULL,
  `id_unit` bigint(20) NOT NULL,
  `id_periode` bigint(20) NOT NULL,
  `catatan` text NOT NULL,
  `tanggal_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_catatan2`
--

CREATE TABLE `data_catatan2` (
  `id_catatan` bigint(20) NOT NULL,
  `id_anggota` bigint(20) NOT NULL,
  `id_jabatan` bigint(20) NOT NULL,
  `id_departemen` bigint(20) NOT NULL,
  `id_unit` bigint(20) NOT NULL,
  `id_periode` bigint(20) NOT NULL,
  `catatan` text NOT NULL,
  `tanggal_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_kompetensi_individu`
--

CREATE TABLE `data_kompetensi_individu` (
  `id_kompetensi_individu` bigint(20) NOT NULL,
  `id_anggota` bigint(20) NOT NULL,
  `id_jabatan` bigint(20) NOT NULL,
  `id_departemen` bigint(20) NOT NULL,
  `id_unit` bigint(20) NOT NULL,
  `id_kompetensi` bigint(20) NOT NULL,
  `id_peringkat` bigint(20) NOT NULL,
  `id_periode` bigint(20) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `jenis` int(5) NOT NULL,
  `matriks` int(5) NOT NULL DEFAULT '0',
  `id_verifikator` bigint(20) NOT NULL DEFAULT '0',
  `id_jabatan_verifikator` bigint(20) NOT NULL,
  `id_departemen_verifikator` bigint(20) NOT NULL,
  `id_unit_verifikator` bigint(20) NOT NULL,
  `tanggal_verifikasi` date NOT NULL,
  `tanggal_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_kompetensi_individu`
--

INSERT INTO `data_kompetensi_individu` (`id_kompetensi_individu`, `id_anggota`, `id_jabatan`, `id_departemen`, `id_unit`, `id_kompetensi`, `id_peringkat`, `id_periode`, `status`, `jenis`, `matriks`, `id_verifikator`, `id_jabatan_verifikator`, `id_departemen_verifikator`, `id_unit_verifikator`, `tanggal_verifikasi`, `tanggal_input`) VALUES
(5, 1, 2, 1, 1, 1, 4, 1, 1, 1, 0, 4, 1, 1, 1, '2019-05-01', '2019-04-20'),
(6, 1, 2, 1, 1, 7, 3, 1, 1, 2, 0, 4, 1, 1, 1, '2019-05-01', '2019-04-20'),
(10, 8, 5, 3, 3, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, '2019-04-29', '2019-04-26');

-- --------------------------------------------------------

--
-- Table structure for table `data_kompetensi_verifikasi`
--

CREATE TABLE `data_kompetensi_verifikasi` (
  `id_kompetensi_verifikasi` bigint(20) NOT NULL,
  `id_kompetensi_individu` bigint(20) NOT NULL,
  `nama_kompetensi` varchar(50) NOT NULL,
  `indikator_terendah` text NOT NULL,
  `indikator_tertinggi` text NOT NULL,
  `bobot` decimal(20,2) NOT NULL,
  `peringkat` int(20) NOT NULL,
  `nilai` int(20) NOT NULL,
  `periode` bigint(20) NOT NULL,
  `kelompok_jabatan` varchar(50) NOT NULL,
  `id_anggota` bigint(20) NOT NULL,
  `nama_anggota` varchar(50) NOT NULL,
  `id_jabatan` bigint(20) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `id_departemen` bigint(20) NOT NULL,
  `departemen` varchar(50) NOT NULL,
  `id_unit` bigint(20) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `id_verifikator` bigint(20) NOT NULL,
  `nama_verifikator` varchar(50) NOT NULL,
  `id_jabatan_verifikator` bigint(20) NOT NULL,
  `jabatan_verifikator` varchar(50) NOT NULL,
  `id_departemen_verifikator` bigint(20) NOT NULL,
  `departemen_verifikator` varchar(50) NOT NULL,
  `id_unit_verifikator` bigint(20) NOT NULL,
  `unit_verifikator` varchar(50) NOT NULL,
  `tanggal_input` date NOT NULL,
  `tanggal_verifikator` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_kompetensi_verifikasi`
--

INSERT INTO `data_kompetensi_verifikasi` (`id_kompetensi_verifikasi`, `id_kompetensi_individu`, `nama_kompetensi`, `indikator_terendah`, `indikator_tertinggi`, `bobot`, `peringkat`, `nilai`, `periode`, `kelompok_jabatan`, `id_anggota`, `nama_anggota`, `id_jabatan`, `jabatan`, `id_departemen`, `departemen`, `id_unit`, `unit`, `id_verifikator`, `nama_verifikator`, `id_jabatan_verifikator`, `jabatan_verifikator`, `id_departemen_verifikator`, `departemen_verifikator`, `id_unit_verifikator`, `unit_verifikator`, `tanggal_input`, `tanggal_verifikator`) VALUES
(29, 10, 'Strive for Excellence', 'Memenuhi apa yang dipersyaratkan pada standar operasional pekerjaan ketika dalam pengawasan, kurang menunjukkan inisiatif untuk melakukan perbaikan dan upaya dalam mencapai efisiensi proses kerjanya. Mencermati permasalahan sebelum situasinya menjadi serius/genting, hanya pada saat diminta secara khusus.', 'Mampu memenuhi apa yang dipersyaratkan pada standar operasional pekerjaannya. Menunjukkan inisiatif untuk melakukan perbaikan secara terus menerus, berupaya mencapai efisiensi dalam proses kerja, serta proaktif mencermati permasalahan sebelum situasinya menjadi serius/genting.', '10.00', 5, 100, 2019, 'Operasional', 8, 'Syifa', 5, 'Administrasi', 3, 'Sumber Daya dan Manusia', 3, 'Tenaga Kerja', 6, 'Ani', 1, 'Asisten Manager', 3, 'Sumber Daya dan Manusia', 3, 'Tenaga Kerja', '2019-04-26', '2019-04-29'),
(30, 10, 'Strive for Excellence', 'Memenuhi apa yang dipersyaratkan pada standar operasional pekerjaan ketika dalam pengawasan, kurang menunjukkan inisiatif untuk melakukan perbaikan dan upaya dalam mencapai efisiensi proses kerjanya. Mencermati permasalahan sebelum situasinya menjadi serius/genting, hanya pada saat diminta secara khusus.', 'Mampu memenuhi apa yang dipersyaratkan pada standar operasional pekerjaannya. Menunjukkan inisiatif untuk melakukan perbaikan secara terus menerus, berupaya mencapai efisiensi dalam proses kerja, serta proaktif mencermati permasalahan sebelum situasinya menjadi serius/genting.', '10.00', 5, 100, 2019, 'Operasional', 8, 'Syifa', 5, 'Administrasi', 3, 'Sumber Daya dan Manusia', 3, 'Tenaga Kerja', 10, 'Anggita', 3, 'Manager', 3, 'Sumber Daya dan Manusia', 0, '', '2019-04-26', '2019-04-29'),
(32, 5, 'Strive for Excellence', 'Memenuhi apa yang dipersyaratkan pada standar operasional pekerjaan ketika dalam pengawasan, kurang menunjukkan inisiatif untuk melakukan perbaikan dan upaya dalam mencapai efisiensi proses kerjanya. Mencermati permasalahan sebelum situasinya menjadi serius/genting, hanya pada saat diminta secara khusus.', 'Mampu memenuhi apa yang dipersyaratkan pada standar operasional pekerjaannya. Menunjukkan inisiatif untuk melakukan perbaikan secara terus menerus, berupaya mencapai efisiensi dalam proses kerja, serta proaktif mencermati permasalahan sebelum situasinya menjadi serius/genting.', '10.00', 2, 70, 2019, 'Operasional', 1, 'Niko Kusdiarto', 2, 'Programmer', 1, 'Teknologi Informasi', 1, 'Software', 4, 'Kusneni Rositawati', 1, 'Asisten Manager', 1, 'Teknologi Informasi', 1, 'Software', '2019-04-20', '2019-05-01'),
(33, 6, 'Percobaan', 'Terendah', 'Tertinggi', '10.00', 3, 80, 2019, 'Kompetensi Khusus', 1, 'Niko Kusdiarto', 2, 'Programmer', 1, 'Teknologi Informasi', 1, 'Software', 4, 'Kusneni Rositawati', 1, 'Asisten Manager', 1, 'Teknologi Informasi', 1, 'Software', '2019-04-20', '2019-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `data_kpi`
--

CREATE TABLE `data_kpi` (
  `id_kpi` bigint(20) NOT NULL,
  `id_anggota` bigint(20) NOT NULL DEFAULT '0',
  `id_jabatan` bigint(20) NOT NULL DEFAULT '0',
  `id_departemen` bigint(20) NOT NULL DEFAULT '0',
  `id_unit` bigint(20) NOT NULL DEFAULT '0',
  `id_periode` bigint(20) NOT NULL DEFAULT '0',
  `kpi` text NOT NULL,
  `deskripsi` text NOT NULL,
  `bobot` decimal(20,2) NOT NULL DEFAULT '0.00',
  `sasaran` decimal(20,2) NOT NULL DEFAULT '0.00',
  `satuan` varchar(20) NOT NULL,
  `sifat_kpi` int(2) NOT NULL DEFAULT '0',
  `status` int(2) NOT NULL DEFAULT '0',
  `id_verifikator` bigint(20) NOT NULL DEFAULT '0',
  `id_jabatan_verifikator` bigint(20) NOT NULL DEFAULT '0',
  `id_departemen_verifikator` bigint(20) NOT NULL DEFAULT '0',
  `id_unit_verifikator` bigint(20) NOT NULL DEFAULT '0',
  `tanggal_input` date NOT NULL,
  `tanggal_verifikasi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_kpi`
--

INSERT INTO `data_kpi` (`id_kpi`, `id_anggota`, `id_jabatan`, `id_departemen`, `id_unit`, `id_periode`, `kpi`, `deskripsi`, `bobot`, `sasaran`, `satuan`, `sifat_kpi`, `status`, `id_verifikator`, `id_jabatan_verifikator`, `id_departemen_verifikator`, `id_unit_verifikator`, `tanggal_input`, `tanggal_verifikasi`) VALUES
(2, 1, 2, 1, 1, 1, 'Pengeluaran', 'Jumlah Pengeluaran', '50.00', '5.00', '1', 1, 1, 4, 1, 1, 1, '2019-04-16', '2019-04-20'),
(3, 1, 2, 1, 1, 1, 'Projek', 'Jumlah Projek', '50.00', '10.00', '3', 2, 1, 4, 1, 1, 1, '2019-04-24', '2019-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `data_kpi_verifikasi`
--

CREATE TABLE `data_kpi_verifikasi` (
  `id_kpi_verifikasi` bigint(20) NOT NULL,
  `id_kpi_asli` bigint(20) NOT NULL,
  `nama_anggota` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL DEFAULT '0',
  `departemen` varchar(50) NOT NULL,
  `unit` varchar(50) DEFAULT '0',
  `periode` bigint(20) NOT NULL DEFAULT '0',
  `kpi` text NOT NULL,
  `deskripsi` text NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `sifat_kpi` int(2) NOT NULL DEFAULT '0',
  `nama_verifikator` varchar(50) NOT NULL,
  `jabatan_verifikator` varchar(50) NOT NULL,
  `departemen_verifikator` varchar(50) NOT NULL,
  `unit_verifikator` varchar(50) NOT NULL,
  `tanggal_input` date NOT NULL,
  `tanggal_verifikasi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_kpi_verifikasi`
--

INSERT INTO `data_kpi_verifikasi` (`id_kpi_verifikasi`, `id_kpi_asli`, `nama_anggota`, `jabatan`, `departemen`, `unit`, `periode`, `kpi`, `deskripsi`, `satuan`, `sifat_kpi`, `nama_verifikator`, `jabatan_verifikator`, `departemen_verifikator`, `unit_verifikator`, `tanggal_input`, `tanggal_verifikasi`) VALUES
(10, 2, 'Niko Kusdiarto', 'Programmer', 'Teknologi Informasi', 'Software', 2019, 'Pengeluaran', 'Jumlah Pengeluaran', '1', 1, 'Kusneni Rositawati', 'Asisten Manager', 'Teknologi Informasi', 'Software', '2019-04-16', '2019-04-20'),
(20, 3, 'Niko Kusdiarto', 'Programmer', 'Teknologi Informasi', 'Software', 2019, 'Projek', 'Jumlah Projek', '3', 2, 'Kusneni Rositawati', 'Asisten Manager', 'Teknologi Informasi', 'Software', '2019-04-24', '2019-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `data_realisasi_kpi`
--

CREATE TABLE `data_realisasi_kpi` (
  `id_realisasi` bigint(20) NOT NULL,
  `id_kpi` bigint(20) NOT NULL,
  `id_anggota` bigint(20) NOT NULL,
  `id_jabatan` bigint(20) NOT NULL,
  `id_departemen` bigint(20) NOT NULL,
  `id_unit` bigint(20) NOT NULL,
  `id_periode` bigint(20) NOT NULL,
  `realisasi` decimal(20,2) NOT NULL,
  `keterangan` text NOT NULL,
  `status` int(5) NOT NULL,
  `tanggal_input` date NOT NULL,
  `id_verifikator` bigint(20) NOT NULL,
  `id_jabatan_verifikator` bigint(20) NOT NULL,
  `id_departemen_verifikator` bigint(20) NOT NULL,
  `id_unit_verifikator` bigint(20) NOT NULL,
  `tanggal_verif` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_realisasi_kpi`
--

INSERT INTO `data_realisasi_kpi` (`id_realisasi`, `id_kpi`, `id_anggota`, `id_jabatan`, `id_departemen`, `id_unit`, `id_periode`, `realisasi`, `keterangan`, `status`, `tanggal_input`, `id_verifikator`, `id_jabatan_verifikator`, `id_departemen_verifikator`, `id_unit_verifikator`, `tanggal_verif`) VALUES
(6, 2, 1, 2, 1, 1, 1, '5.00', 'Siap', 1, '2019-04-20', 4, 1, 1, 1, '2019-04-25'),
(9, 3, 1, 2, 1, 1, 1, '5.00', 'Oke', 1, '2019-05-01', 4, 1, 1, 1, '2019-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `data_realisasi_verifikasi`
--

CREATE TABLE `data_realisasi_verifikasi` (
  `id_realisasi_verifikasi` bigint(20) NOT NULL,
  `id_realisasi_asli` bigint(20) NOT NULL,
  `id_kpi_asli` bigint(20) NOT NULL,
  `nama_anggota` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `departemen` varchar(50) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `periode` bigint(20) NOT NULL,
  `realisasi` decimal(20,2) NOT NULL,
  `keterangan` text NOT NULL,
  `nama_verifikator` varchar(50) NOT NULL,
  `jabatan_verifikator` varchar(50) NOT NULL,
  `departemen_verifikator` varchar(50) NOT NULL,
  `unit_verifikator` varchar(50) NOT NULL,
  `tanggal_input` date NOT NULL,
  `tanggal_verifikasi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_realisasi_verifikasi`
--

INSERT INTO `data_realisasi_verifikasi` (`id_realisasi_verifikasi`, `id_realisasi_asli`, `id_kpi_asli`, `nama_anggota`, `jabatan`, `departemen`, `unit`, `periode`, `realisasi`, `keterangan`, `nama_verifikator`, `jabatan_verifikator`, `departemen_verifikator`, `unit_verifikator`, `tanggal_input`, `tanggal_verifikasi`) VALUES
(13, 6, 2, 'Niko Kusdiarto', 'Programmer', 'Teknologi Informasi', 'Software', 2019, '5.00', 'Siap', 'Kusneni Rositawati', 'Asisten Manager', 'Teknologi Informasi', 'Software', '2019-04-20', '2019-04-25'),
(17, 9, 3, 'Niko Kusdiarto', 'Programmer', 'Teknologi Informasi', 'Software', 2019, '5.00', 'Oke', 'Kusneni Rositawati', 'Asisten Manager', 'Teknologi Informasi', 'Software', '2019-05-01', '2019-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria_nilai`
--

CREATE TABLE `kriteria_nilai` (
  `id_kriteria` bigint(20) NOT NULL,
  `batas_minimum` int(20) NOT NULL,
  `batas_maksimum` int(20) NOT NULL,
  `kriteria_nilai` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `id_periode` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria_nilai`
--

INSERT INTO `kriteria_nilai` (`id_kriteria`, `batas_minimum`, `batas_maksimum`, `kriteria_nilai`, `keterangan`, `id_periode`) VALUES
(1, 96, 100, 'Baik Sekali', 'Untuk Usulan Naik Gaji 3 Poin', 1),
(2, 86, 95, 'Baik', 'Untuk Usulan Naik Gaji 2 Poin', 1),
(3, 71, 85, 'Cukup Baik', 'Untuk Naik Gaji 1,5 Poin', 1),
(4, 61, 70, 'Cukup', 'Untuk Naik Gaji 1 Poin', 1),
(5, 0, 60, 'Kurang', 'Untuk Tidak Naik Gaji 0 Poin', 1);

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
  `id_departemen` bigint(20) NOT NULL,
  `id_unit` bigint(20) NOT NULL,
  `alamat` text NOT NULL,
  `tanggal_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_anggota`
--

INSERT INTO `mst_anggota` (`id_anggota`, `nik`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `status`, `nomor_hp`, `email`, `id_golongan`, `id_jabatan`, `id_departemen`, `id_unit`, `alamat`, `tanggal_input`) VALUES
(1, '11111', 'Niko Kusdiarto', 1, 'Kabupaten Semarang', '1996-02-02', 1, '082118009419', 'niko.kusdiarto@gmail.com', 1, 4, 1, 2, 'Ungaran', '2019-04-12'),
(2, '22222', 'Rico Agung Pribadi', 1, 'Semarang', '1996-03-30', 1, '085123456789', 'rico@gmail.com', 1, 4, 1, 2, 'Ungaran', '2019-04-14'),
(3, '33333', 'Eko Sudiarto', 1, 'Tegal', '1966-07-22', 2, '085865244793', 'eko@gmail.com', 1, 1, 1, 2, 'Leyangan', '2019-04-14'),
(4, '44444', 'Kusneni Rositawati', 2, 'Purworejo', '1965-07-30', 2, '081575662267', 'kusneni@gmail.com', 1, 1, 1, 1, 'Ungaran', '2019-04-14'),
(5, '55555', 'Suradi', 1, 'Tegal', '1966-01-01', 2, '081789456123', 'suradi@gmail.com', 1, 3, 1, 0, 'Semarang', '2019-04-14'),
(6, '66666', 'Ani', 2, 'Solo', '1984-01-01', 2, '081234567890', 'ani@gmail.com', 1, 1, 3, 3, 'Solo', '2019-04-26'),
(7, '77777', 'Duvito', 1, 'Solo', '2019-04-01', 2, '081098765432', 'duvito@gmail.com', 1, 1, 3, 4, 'Solo', '2019-04-26'),
(8, '88888', 'Syifa', 2, 'Solo', '2019-04-01', 1, '081234567890', 'syifa@gmail.com', 1, 5, 3, 4, 'Solo', '2019-04-26'),
(9, '99999', 'Bayu', 1, 'Solo', '2019-04-01', 1, '081234567890', 'bayu@gmail.com', 1, 5, 3, 4, 'Solo', '2019-04-26'),
(10, '11112', 'Anggita', 2, 'Karanganyar', '1996-01-19', 1, '081098765432', 'anggita@gmail.com', 1, 3, 3, 0, 'Karanganyar', '2019-04-26');

-- --------------------------------------------------------

--
-- Table structure for table `mst_departemen`
--

CREATE TABLE `mst_departemen` (
  `id_departemen` bigint(20) NOT NULL,
  `nama_departemen` varchar(50) NOT NULL,
  `tanggal_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_departemen`
--

INSERT INTO `mst_departemen` (`id_departemen`, `nama_departemen`, `tanggal_input`) VALUES
(1, 'Teknologi Informasi', '2019-04-12'),
(3, 'Sumber Daya dan Manusia', '2019-04-12');

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
(1, 'I A', '2019-04-12');

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
(1, 'Asisten Manager', '2019-04-12'),
(2, 'Programmer', '2019-04-12'),
(3, 'Manager', '2019-04-13'),
(4, 'Technical Support', '2019-04-14'),
(5, 'Administrasi', '2019-04-26');

-- --------------------------------------------------------

--
-- Table structure for table `mst_kelompok_jabatan`
--

CREATE TABLE `mst_kelompok_jabatan` (
  `id_kelompok` bigint(20) NOT NULL,
  `nama_kelompok` varchar(25) NOT NULL,
  `id_jabatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_kelompok_jabatan`
--

INSERT INTO `mst_kelompok_jabatan` (`id_kelompok`, `nama_kelompok`, `id_jabatan`) VALUES
(1, 'Operasional', 'a:3:{i:0;s:1:\"2\";i:1;s:1:\"4\";i:2;s:1:\"5\";}');

-- --------------------------------------------------------

--
-- Table structure for table `mst_kompetensi`
--

CREATE TABLE `mst_kompetensi` (
  `id_kompetensi` bigint(20) NOT NULL,
  `id_periode` bigint(20) NOT NULL,
  `id_kelompok` bigint(20) NOT NULL,
  `nama_kompetensi` varchar(50) NOT NULL,
  `indikator_terendah` text NOT NULL,
  `indikator_tertinggi` text NOT NULL,
  `bobot` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_kompetensi`
--

INSERT INTO `mst_kompetensi` (`id_kompetensi`, `id_periode`, `id_kelompok`, `nama_kompetensi`, `indikator_terendah`, `indikator_tertinggi`, `bobot`) VALUES
(1, 1, 1, 'Strive for Excellence', 'Memenuhi apa yang dipersyaratkan pada standar operasional pekerjaan ketika dalam pengawasan, kurang menunjukkan inisiatif untuk melakukan perbaikan dan upaya dalam mencapai efisiensi proses kerjanya. Mencermati permasalahan sebelum situasinya menjadi serius/genting, hanya pada saat diminta secara khusus.', 'Mampu memenuhi apa yang dipersyaratkan pada standar operasional pekerjaannya. Menunjukkan inisiatif untuk melakukan perbaikan secara terus menerus, berupaya mencapai efisiensi dalam proses kerja, serta proaktif mencermati permasalahan sebelum situasinya menjadi serius/genting.', '10.00');

-- --------------------------------------------------------

--
-- Table structure for table `mst_kompetensi_khusus`
--

CREATE TABLE `mst_kompetensi_khusus` (
  `id_kompetensi_khusus` bigint(20) NOT NULL,
  `id_periode` bigint(20) NOT NULL,
  `id_jabatan` bigint(20) NOT NULL,
  `id_departemen` bigint(20) NOT NULL,
  `id_unit` bigint(20) NOT NULL DEFAULT '0',
  `nama_kompetensi` varchar(50) NOT NULL,
  `indikator_terendah` text NOT NULL,
  `indikator_tertinggi` text NOT NULL,
  `bobot` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_kompetensi_khusus`
--

INSERT INTO `mst_kompetensi_khusus` (`id_kompetensi_khusus`, `id_periode`, `id_jabatan`, `id_departemen`, `id_unit`, `nama_kompetensi`, `indikator_terendah`, `indikator_tertinggi`, `bobot`) VALUES
(7, 1, 2, 1, 1, 'Percobaan', 'Terendah', 'Tertinggi', '10.00');

-- --------------------------------------------------------

--
-- Table structure for table `mst_peringkat`
--

CREATE TABLE `mst_peringkat` (
  `id_peringkat` bigint(20) NOT NULL,
  `id_periode` bigint(20) NOT NULL,
  `peringkat` int(20) NOT NULL,
  `nilai` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_peringkat`
--

INSERT INTO `mst_peringkat` (`id_peringkat`, `id_periode`, `peringkat`, `nilai`) VALUES
(1, 1, 5, 100),
(2, 1, 4, 90),
(3, 1, 3, 80),
(4, 1, 2, 70),
(5, 1, 1, 60);

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
(1, 2019, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_polarisasi`
--

CREATE TABLE `mst_polarisasi` (
  `id_polarisasi` bigint(20) NOT NULL,
  `nama_polarisasi` varchar(50) NOT NULL,
  `id_periode` bigint(20) NOT NULL,
  `rumus` int(5) NOT NULL DEFAULT '0',
  `tanggal_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_polarisasi`
--

INSERT INTO `mst_polarisasi` (`id_polarisasi`, `nama_polarisasi`, `id_periode`, `rumus`, `tanggal_input`) VALUES
(1, 'Positif', 1, 1, '2019-04-12'),
(2, 'Negatif', 1, 2, '2019-04-22');

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
(1, 'Rp', 'a:1:{i:0;s:1:\"1\";}', 1, '2019-04-12'),
(3, 'Jam', 'a:1:{i:0;s:1:\"2\";}', 1, '2019-04-13');

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
(1, 'Software', '2019-04-12'),
(2, 'Hardware', '2019-04-12'),
(3, 'Tenaga Kerja', '2019-04-13'),
(4, 'Perekrutan Pegawai', '2019-04-13');

-- --------------------------------------------------------

--
-- Table structure for table `mutasi_pegawai`
--

CREATE TABLE `mutasi_pegawai` (
  `id_mutasi` bigint(20) NOT NULL,
  `id_anggota` bigint(20) NOT NULL,
  `id_jabatan_lama` bigint(20) NOT NULL,
  `id_departemen_lama` bigint(20) NOT NULL,
  `id_unit_lama` bigint(20) NOT NULL,
  `id_jabatan_baru` bigint(20) NOT NULL,
  `id_departemen_baru` bigint(20) NOT NULL,
  `id_unit_baru` bigint(20) NOT NULL,
  `id_periode` bigint(20) NOT NULL,
  `tanggal_mutasi` date NOT NULL,
  `tanggal_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mutasi_pegawai`
--

INSERT INTO `mutasi_pegawai` (`id_mutasi`, `id_anggota`, `id_jabatan_lama`, `id_departemen_lama`, `id_unit_lama`, `id_jabatan_baru`, `id_departemen_baru`, `id_unit_baru`, `id_periode`, `tanggal_mutasi`, `tanggal_input`) VALUES
(5, 1, 2, 1, 1, 4, 1, 2, 1, '2019-04-27', '2019-04-27'),
(7, 8, 5, 3, 3, 5, 3, 4, 1, '2019-04-29', '2019-04-29');

-- --------------------------------------------------------

--
-- Table structure for table `persentase_nilai`
--

CREATE TABLE `persentase_nilai` (
  `id_persentase` bigint(20) NOT NULL,
  `persentase_kpi` decimal(20,2) NOT NULL,
  `persentase_kompetensi` decimal(20,2) NOT NULL,
  `id_periode` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `persentase_nilai`
--

INSERT INTO `persentase_nilai` (`id_persentase`, `persentase_kpi`, `persentase_kompetensi`, `id_periode`) VALUES
(1, '70.00', '30.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `perubahan_kompetensi`
--

CREATE TABLE `perubahan_kompetensi` (
  `id_perubahan_kompetensi` bigint(20) NOT NULL,
  `id_kompetensi_asli` bigint(20) NOT NULL,
  `id_periode` bigint(20) NOT NULL,
  `id_anggota` bigint(20) NOT NULL,
  `id_jabatan` bigint(20) NOT NULL,
  `id_departemen` bigint(20) NOT NULL,
  `id_unit` bigint(20) NOT NULL,
  `id_anggota_perubahan` bigint(20) NOT NULL,
  `id_jabatan_perubahan` bigint(20) NOT NULL,
  `id_departemen_perubahan` bigint(20) NOT NULL,
  `id_unit_perubahan` bigint(20) NOT NULL,
  `pangkat` int(5) NOT NULL,
  `id_peringkat` bigint(20) NOT NULL,
  `tanggal_perubahan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perubahan_kompetensi`
--

INSERT INTO `perubahan_kompetensi` (`id_perubahan_kompetensi`, `id_kompetensi_asli`, `id_periode`, `id_anggota`, `id_jabatan`, `id_departemen`, `id_unit`, `id_anggota_perubahan`, `id_jabatan_perubahan`, `id_departemen_perubahan`, `id_unit_perubahan`, `pangkat`, `id_peringkat`, `tanggal_perubahan`) VALUES
(3, 5, 1, 1, 2, 1, 1, 4, 1, 1, 1, 1, 2, '2019-04-25'),
(4, 6, 1, 1, 2, 1, 1, 4, 1, 1, 1, 1, 2, '2019-04-25'),
(5, 5, 1, 1, 2, 1, 1, 5, 3, 1, 0, 2, 1, '2019-04-25'),
(6, 6, 1, 1, 2, 1, 1, 5, 3, 1, 0, 2, 5, '2019-04-25'),
(12, 10, 1, 8, 5, 3, 3, 10, 3, 3, 0, 0, 5, '2019-04-29'),
(13, 10, 1, 8, 5, 3, 3, 6, 1, 3, 3, 0, 4, '2019-04-29');

-- --------------------------------------------------------

--
-- Table structure for table `perubahan_usulan_kpi`
--

CREATE TABLE `perubahan_usulan_kpi` (
  `id_perubahan_usulan` bigint(20) NOT NULL,
  `id_kpi` bigint(20) NOT NULL,
  `id_periode` bigint(20) NOT NULL,
  `id_anggota` bigint(20) NOT NULL,
  `id_jabatan` bigint(20) NOT NULL,
  `id_departemen` bigint(20) NOT NULL,
  `id_unit` bigint(20) NOT NULL,
  `id_anggota_perubahan` bigint(20) NOT NULL,
  `id_jabatan_perubahan` bigint(20) NOT NULL,
  `id_departemen_perubahan` bigint(20) NOT NULL,
  `id_unit_perubahan` bigint(20) NOT NULL,
  `pangkat` int(5) NOT NULL,
  `bobot` decimal(20,2) NOT NULL,
  `sasaran` decimal(20,2) NOT NULL,
  `tanggal_perubahan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perubahan_usulan_kpi`
--

INSERT INTO `perubahan_usulan_kpi` (`id_perubahan_usulan`, `id_kpi`, `id_periode`, `id_anggota`, `id_jabatan`, `id_departemen`, `id_unit`, `id_anggota_perubahan`, `id_jabatan_perubahan`, `id_departemen_perubahan`, `id_unit_perubahan`, `pangkat`, `bobot`, `sasaran`, `tanggal_perubahan`) VALUES
(2, 2, 1, 1, 2, 1, 1, 4, 1, 1, 1, 1, '30.00', '5.00', '2019-04-25'),
(3, 3, 1, 1, 2, 1, 1, 4, 1, 1, 1, 1, '70.00', '5.00', '2019-04-25');

-- --------------------------------------------------------

--
-- Table structure for table `perubahan_usulan_realisasi`
--

CREATE TABLE `perubahan_usulan_realisasi` (
  `id_perubahan_realisasi` bigint(20) NOT NULL,
  `id_kpi_asli` bigint(20) NOT NULL,
  `id_periode` bigint(20) NOT NULL,
  `id_anggota` bigint(20) NOT NULL,
  `id_jabatan` bigint(20) NOT NULL,
  `id_departemen` bigint(20) NOT NULL,
  `id_unit` bigint(20) NOT NULL,
  `id_anggota_perubahan` bigint(20) NOT NULL,
  `id_jabatan_perubahan` bigint(20) NOT NULL,
  `id_departemen_perubahan` bigint(20) NOT NULL,
  `id_unit_perubahan` bigint(20) NOT NULL,
  `pangkat` int(5) NOT NULL,
  `realisasi` decimal(20,2) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal_perubahan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perubahan_usulan_realisasi`
--

INSERT INTO `perubahan_usulan_realisasi` (`id_perubahan_realisasi`, `id_kpi_asli`, `id_periode`, `id_anggota`, `id_jabatan`, `id_departemen`, `id_unit`, `id_anggota_perubahan`, `id_jabatan_perubahan`, `id_departemen_perubahan`, `id_unit_perubahan`, `pangkat`, `realisasi`, `keterangan`, `tanggal_perubahan`) VALUES
(1, 2, 1, 1, 2, 1, 1, 4, 1, 1, 1, 1, '5.00', 'Siap', '2019-05-01'),
(2, 2, 1, 1, 2, 1, 1, 5, 3, 1, 0, 2, '5.00', 'Siap', '2019-05-01');

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
(3, '33333', 'b7bc2a2f5bb6d521e64c8974c143e9a0', 1, 0),
(4, '44444', '79b7cdcd14db14e9cb498f1793817d69', 1, 0),
(5, '55555', 'c5fe25896e49ddfe996db7508cf00534', 1, 0),
(6, '66666', 'ae8b5aa26a3ae31612eec1d1f6ffbce9', 1, 0),
(7, '77777', '22a4d9b04fe95c9893b41e2fde83a427', 1, 0),
(8, '88888', '1c395a8dce135849bd73c6dba3b54809', 1, 0),
(9, '99999', 'd3eb9a9233e52948740d7eb8c3062d14', 1, 0),
(10, '11112', 'afcb7a2f1c158286b48062cd885a9866', 1, 0);

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
(1, '2019-04-01', '2019-04-30', 1, '2019-04-17'),
(2, '2019-04-01', '2019-04-30', 2, '2019-04-17');

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
(1, '2019-04-01', '2019-04-30', 1, '2019-04-17'),
(2, '2019-04-01', '2019-04-30', 2, '2019-04-17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses_menu`
--
ALTER TABLE `akses_menu`
  ADD PRIMARY KEY (`id_akses`);

--
-- Indexes for table `aturan_matriks`
--
ALTER TABLE `aturan_matriks`
  ADD PRIMARY KEY (`id_matriks`);

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
-- Indexes for table `data_catatan2`
--
ALTER TABLE `data_catatan2`
  ADD PRIMARY KEY (`id_catatan`);

--
-- Indexes for table `data_kompetensi_individu`
--
ALTER TABLE `data_kompetensi_individu`
  ADD PRIMARY KEY (`id_kompetensi_individu`);

--
-- Indexes for table `data_kompetensi_verifikasi`
--
ALTER TABLE `data_kompetensi_verifikasi`
  ADD PRIMARY KEY (`id_kompetensi_verifikasi`);

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
-- Indexes for table `data_realisasi_verifikasi`
--
ALTER TABLE `data_realisasi_verifikasi`
  ADD PRIMARY KEY (`id_realisasi_verifikasi`);

--
-- Indexes for table `kriteria_nilai`
--
ALTER TABLE `kriteria_nilai`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `mst_anggota`
--
ALTER TABLE `mst_anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `mst_departemen`
--
ALTER TABLE `mst_departemen`
  ADD PRIMARY KEY (`id_departemen`);

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
-- Indexes for table `mst_kelompok_jabatan`
--
ALTER TABLE `mst_kelompok_jabatan`
  ADD PRIMARY KEY (`id_kelompok`);

--
-- Indexes for table `mst_kompetensi`
--
ALTER TABLE `mst_kompetensi`
  ADD PRIMARY KEY (`id_kompetensi`);

--
-- Indexes for table `mst_kompetensi_khusus`
--
ALTER TABLE `mst_kompetensi_khusus`
  ADD PRIMARY KEY (`id_kompetensi_khusus`);

--
-- Indexes for table `mst_peringkat`
--
ALTER TABLE `mst_peringkat`
  ADD PRIMARY KEY (`id_peringkat`);

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
-- Indexes for table `mutasi_pegawai`
--
ALTER TABLE `mutasi_pegawai`
  ADD PRIMARY KEY (`id_mutasi`);

--
-- Indexes for table `persentase_nilai`
--
ALTER TABLE `persentase_nilai`
  ADD PRIMARY KEY (`id_persentase`);

--
-- Indexes for table `perubahan_kompetensi`
--
ALTER TABLE `perubahan_kompetensi`
  ADD PRIMARY KEY (`id_perubahan_kompetensi`);

--
-- Indexes for table `perubahan_usulan_kpi`
--
ALTER TABLE `perubahan_usulan_kpi`
  ADD PRIMARY KEY (`id_perubahan_usulan`);

--
-- Indexes for table `perubahan_usulan_realisasi`
--
ALTER TABLE `perubahan_usulan_realisasi`
  ADD PRIMARY KEY (`id_perubahan_realisasi`);

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
  MODIFY `id_akses` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `aturan_matriks`
--
ALTER TABLE `aturan_matriks`
  MODIFY `id_matriks` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `aturan_penilai`
--
ALTER TABLE `aturan_penilai`
  MODIFY `id_aturan` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `aturan_polarisasi`
--
ALTER TABLE `aturan_polarisasi`
  MODIFY `id_aturan_polarisasi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `data_catatan`
--
ALTER TABLE `data_catatan`
  MODIFY `id_catatan` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `data_catatan2`
--
ALTER TABLE `data_catatan2`
  MODIFY `id_catatan` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_kompetensi_individu`
--
ALTER TABLE `data_kompetensi_individu`
  MODIFY `id_kompetensi_individu` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `data_kompetensi_verifikasi`
--
ALTER TABLE `data_kompetensi_verifikasi`
  MODIFY `id_kompetensi_verifikasi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `data_kpi`
--
ALTER TABLE `data_kpi`
  MODIFY `id_kpi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `data_kpi_verifikasi`
--
ALTER TABLE `data_kpi_verifikasi`
  MODIFY `id_kpi_verifikasi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `data_realisasi_kpi`
--
ALTER TABLE `data_realisasi_kpi`
  MODIFY `id_realisasi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `data_realisasi_verifikasi`
--
ALTER TABLE `data_realisasi_verifikasi`
  MODIFY `id_realisasi_verifikasi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `kriteria_nilai`
--
ALTER TABLE `kriteria_nilai`
  MODIFY `id_kriteria` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mst_anggota`
--
ALTER TABLE `mst_anggota`
  MODIFY `id_anggota` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mst_departemen`
--
ALTER TABLE `mst_departemen`
  MODIFY `id_departemen` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mst_golongan`
--
ALTER TABLE `mst_golongan`
  MODIFY `id_golongan` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mst_jabatan`
--
ALTER TABLE `mst_jabatan`
  MODIFY `id_jabatan` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mst_kelompok_jabatan`
--
ALTER TABLE `mst_kelompok_jabatan`
  MODIFY `id_kelompok` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mst_kompetensi`
--
ALTER TABLE `mst_kompetensi`
  MODIFY `id_kompetensi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mst_kompetensi_khusus`
--
ALTER TABLE `mst_kompetensi_khusus`
  MODIFY `id_kompetensi_khusus` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mst_peringkat`
--
ALTER TABLE `mst_peringkat`
  MODIFY `id_peringkat` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mst_periode`
--
ALTER TABLE `mst_periode`
  MODIFY `id_periode` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mst_polarisasi`
--
ALTER TABLE `mst_polarisasi`
  MODIFY `id_polarisasi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mst_satuan`
--
ALTER TABLE `mst_satuan`
  MODIFY `id_satuan` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mst_unit`
--
ALTER TABLE `mst_unit`
  MODIFY `id_unit` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mutasi_pegawai`
--
ALTER TABLE `mutasi_pegawai`
  MODIFY `id_mutasi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `persentase_nilai`
--
ALTER TABLE `persentase_nilai`
  MODIFY `id_persentase` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `perubahan_kompetensi`
--
ALTER TABLE `perubahan_kompetensi`
  MODIFY `id_perubahan_kompetensi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `perubahan_usulan_kpi`
--
ALTER TABLE `perubahan_usulan_kpi`
  MODIFY `id_perubahan_usulan` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `perubahan_usulan_realisasi`
--
ALTER TABLE `perubahan_usulan_realisasi`
  MODIFY `id_perubahan_realisasi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
