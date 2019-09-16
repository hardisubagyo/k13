-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2019 at 04:35 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_k13`
--

-- --------------------------------------------------------

--
-- Table structure for table `tm_agama`
--

CREATE TABLE `tm_agama` (
  `id_agama` int(3) NOT NULL,
  `nama_agama` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tm_agama`
--

INSERT INTO `tm_agama` (`id_agama`, `nama_agama`) VALUES
(3, 'Islam'),
(4, 'Protestan'),
(5, 'Katolik'),
(6, 'Hindu'),
(7, 'Budha');

-- --------------------------------------------------------

--
-- Table structure for table `tm_akses`
--

CREATE TABLE `tm_akses` (
  `id_akses` int(3) NOT NULL,
  `nama_akses` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tm_akses`
--

INSERT INTO `tm_akses` (`id_akses`, `nama_akses`) VALUES
(2, 'Guru'),
(3, 'Wali Kelas'),
(4, 'Kepala Sekolah'),
(5, 'Tata Usaha');

-- --------------------------------------------------------

--
-- Table structure for table `tm_ekstra`
--

CREATE TABLE `tm_ekstra` (
  `id_ekstra` int(3) NOT NULL,
  `nama_ekstra` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tm_ekstra`
--

INSERT INTO `tm_ekstra` (`id_ekstra`, `nama_ekstra`) VALUES
(3, 'Pramuka'),
(4, 'Beladiri');

-- --------------------------------------------------------

--
-- Table structure for table `tm_jenis_kd`
--

CREATE TABLE `tm_jenis_kd` (
  `id_jenis_kd` int(3) NOT NULL,
  `nama_jenis_kd` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tm_jenis_kd`
--

INSERT INTO `tm_jenis_kd` (`id_jenis_kd`, `nama_jenis_kd`) VALUES
(2, 'Pengetahuan'),
(3, 'Keterampilan');

-- --------------------------------------------------------

--
-- Table structure for table `tm_jenis_matpel`
--

CREATE TABLE `tm_jenis_matpel` (
  `id_jenis_matpel` int(3) NOT NULL,
  `nama_jenis_matpel` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tm_jenis_matpel`
--

INSERT INTO `tm_jenis_matpel` (`id_jenis_matpel`, `nama_jenis_matpel`) VALUES
(1, 'Muatan Lokal'),
(2, 'Non Muatan Lokal');

-- --------------------------------------------------------

--
-- Table structure for table `tm_jenkel`
--

CREATE TABLE `tm_jenkel` (
  `id_jenkel` int(3) NOT NULL,
  `nama_jenkel` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tm_jenkel`
--

INSERT INTO `tm_jenkel` (`id_jenkel`, `nama_jenkel`) VALUES
(1, 'Laki-laki'),
(2, 'Perempuan');

-- --------------------------------------------------------

--
-- Table structure for table `tm_kategori`
--

CREATE TABLE `tm_kategori` (
  `id_kategori` int(3) NOT NULL,
  `nama_kategori` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tm_kategori`
--

INSERT INTO `tm_kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Kategori 1'),
(2, 'Katgeori 2');

-- --------------------------------------------------------

--
-- Table structure for table `tm_kd`
--

CREATE TABLE `tm_kd` (
  `id_kd` int(3) NOT NULL,
  `no_kd` varchar(254) NOT NULL,
  `deskripsi_kd` varchar(254) NOT NULL,
  `id_matpel` int(3) NOT NULL,
  `id_jenis_kd` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tm_kelas`
--

CREATE TABLE `tm_kelas` (
  `id_kelas` int(11) NOT NULL,
  `kelas` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tm_kelas`
--

INSERT INTO `tm_kelas` (`id_kelas`, `kelas`) VALUES
(1, '1A - Semester 1'),
(2, '1B - Semester 1'),
(3, 'Null');

-- --------------------------------------------------------

--
-- Table structure for table `tm_matpel`
--

CREATE TABLE `tm_matpel` (
  `id_matpel` int(3) NOT NULL,
  `nama_matpel` varchar(254) NOT NULL,
  `id_jenis_matpel` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tm_matpel`
--

INSERT INTO `tm_matpel` (`id_matpel`, `nama_matpel`, `id_jenis_matpel`) VALUES
(1, 'Agama', 2),
(2, 'PPKN', 2),
(3, 'Bhs. Indonesia', 2),
(4, 'Matematika', 2),
(5, 'SBDP', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tm_pegawai`
--

CREATE TABLE `tm_pegawai` (
  `NIP` varchar(30) NOT NULL,
  `nama_pegawai` varchar(254) NOT NULL,
  `email` varchar(254) NOT NULL,
  `password` varchar(254) NOT NULL,
  `id_akses` int(3) NOT NULL,
  `id_kelas` int(3) NOT NULL,
  `id_kategori` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tm_pegawai`
--

INSERT INTO `tm_pegawai` (`NIP`, `nama_pegawai`, `email`, `password`, `id_akses`, `id_kelas`, `id_kategori`) VALUES
('10215410575', 'Hardi Subagyo', 'hardi@gmail.co.id', 'f45731e3d39a1b2330bbf93e9b3de59e', 2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tm_siswa`
--

CREATE TABLE `tm_siswa` (
  `NISN` varchar(30) NOT NULL,
  `id_jenkel` int(3) NOT NULL,
  `id_agama` int(3) NOT NULL,
  `no_induk` varchar(30) NOT NULL,
  `nama_lengkap` varchar(254) NOT NULL,
  `nama_panggilan` varchar(254) NOT NULL,
  `tmpt_lahit` varchar(254) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `pendidikan_sblmnya` varchar(254) NOT NULL,
  `alamat` varchar(254) NOT NULL,
  `nama_ayah` varchar(254) NOT NULL,
  `nama_ibu` varchar(254) NOT NULL,
  `id_kelas` int(3) NOT NULL,
  `id_kategori` int(3) NOT NULL,
  `pek_ayah` varchar(254) NOT NULL,
  `pek_ibu` varchar(254) NOT NULL,
  `alamat_ortu` varchar(254) NOT NULL,
  `tlp` varchar(254) NOT NULL,
  `nama_wali` varchar(254) NOT NULL,
  `pek_wali` varchar(254) NOT NULL,
  `alamat_wali` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tr _absen`
--

CREATE TABLE `tr _absen` (
  `id _absen` int(3) NOT NULL,
  `NISN` varchar(30) NOT NULL,
  `sakit` int(3) NOT NULL,
  `ijin` int(3) NOT NULL,
  `alpa` int(3) NOT NULL,
  `saran` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tr_ekstra`
--

CREATE TABLE `tr_ekstra` (
  `id_ekstra` int(3) NOT NULL,
  `NISN` varchar(30) NOT NULL,
  `id_tm_ekstra` int(3) NOT NULL,
  `nilai` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tr_fisik`
--

CREATE TABLE `tr_fisik` (
  `id_fisik` int(3) NOT NULL,
  `NISN` varchar(30) NOT NULL,
  `tinggi _ 1` varchar(254) NOT NULL,
  `berat _ 1` varchar(254) NOT NULL,
  `tinggi _ 2` varchar(254) NOT NULL,
  `berat _ 2` varchar(254) NOT NULL,
  `pendengaran` varchar(254) NOT NULL,
  `penglihatan` varchar(254) NOT NULL,
  `gigi` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tr_nilai_matpel`
--

CREATE TABLE `tr_nilai_matpel` (
  `id_nilai` int(3) NOT NULL,
  `NISN` varchar(254) NOT NULL,
  `id_matpel` int(3) NOT NULL,
  `id_kd` int(3) NOT NULL,
  `nilai` varchar(6) NOT NULL,
  `id_kelas` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tr_nilai_sosial`
--

CREATE TABLE `tr_nilai_sosial` (
  `id _nilai _sosi` int(10) NOT NULL,
  `NISN` varchar(30) NOT NULL,
  `jujur` varchar(254) NOT NULL,
  `disiplin` varchar(254) NOT NULL,
  `tanggung_jawab` varchar(254) NOT NULL,
  `santun` varchar(254) NOT NULL,
  `peduli` varchar(254) NOT NULL,
  `percaya_diri` varchar(254) NOT NULL,
  `id_kelas` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tr_nilai_spirit`
--

CREATE TABLE `tr_nilai_spirit` (
  `id _nilai _spirit` int(3) NOT NULL,
  `NISN` varchar(254) NOT NULL,
  `beribadah` text NOT NULL,
  `syukur` text NOT NULL,
  `berdoa` text NOT NULL,
  `toleransi` text NOT NULL,
  `deskripsi` text NOT NULL,
  `id_kelas` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tr_prestasi`
--

CREATE TABLE `tr_prestasi` (
  `id_prestasi` int(3) NOT NULL,
  `NISN` varchar(254) NOT NULL,
  `jenis` varchar(254) NOT NULL,
  `keterangan` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tm_agama`
--
ALTER TABLE `tm_agama`
  ADD PRIMARY KEY (`id_agama`);

--
-- Indexes for table `tm_akses`
--
ALTER TABLE `tm_akses`
  ADD PRIMARY KEY (`id_akses`);

--
-- Indexes for table `tm_ekstra`
--
ALTER TABLE `tm_ekstra`
  ADD PRIMARY KEY (`id_ekstra`);

--
-- Indexes for table `tm_jenis_kd`
--
ALTER TABLE `tm_jenis_kd`
  ADD PRIMARY KEY (`id_jenis_kd`);

--
-- Indexes for table `tm_jenis_matpel`
--
ALTER TABLE `tm_jenis_matpel`
  ADD PRIMARY KEY (`id_jenis_matpel`);

--
-- Indexes for table `tm_jenkel`
--
ALTER TABLE `tm_jenkel`
  ADD PRIMARY KEY (`id_jenkel`);

--
-- Indexes for table `tm_kategori`
--
ALTER TABLE `tm_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tm_kd`
--
ALTER TABLE `tm_kd`
  ADD PRIMARY KEY (`id_kd`);

--
-- Indexes for table `tm_kelas`
--
ALTER TABLE `tm_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `tm_matpel`
--
ALTER TABLE `tm_matpel`
  ADD PRIMARY KEY (`id_matpel`);

--
-- Indexes for table `tm_pegawai`
--
ALTER TABLE `tm_pegawai`
  ADD PRIMARY KEY (`NIP`);

--
-- Indexes for table `tm_siswa`
--
ALTER TABLE `tm_siswa`
  ADD PRIMARY KEY (`NISN`);

--
-- Indexes for table `tr _absen`
--
ALTER TABLE `tr _absen`
  ADD PRIMARY KEY (`id _absen`);

--
-- Indexes for table `tr_ekstra`
--
ALTER TABLE `tr_ekstra`
  ADD PRIMARY KEY (`id_ekstra`);

--
-- Indexes for table `tr_fisik`
--
ALTER TABLE `tr_fisik`
  ADD PRIMARY KEY (`id_fisik`);

--
-- Indexes for table `tr_nilai_matpel`
--
ALTER TABLE `tr_nilai_matpel`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `tr_nilai_sosial`
--
ALTER TABLE `tr_nilai_sosial`
  ADD PRIMARY KEY (`id _nilai _sosi`);

--
-- Indexes for table `tr_nilai_spirit`
--
ALTER TABLE `tr_nilai_spirit`
  ADD PRIMARY KEY (`id _nilai _spirit`);

--
-- Indexes for table `tr_prestasi`
--
ALTER TABLE `tr_prestasi`
  ADD PRIMARY KEY (`id_prestasi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tm_agama`
--
ALTER TABLE `tm_agama`
  MODIFY `id_agama` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tm_akses`
--
ALTER TABLE `tm_akses`
  MODIFY `id_akses` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tm_ekstra`
--
ALTER TABLE `tm_ekstra`
  MODIFY `id_ekstra` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tm_jenis_kd`
--
ALTER TABLE `tm_jenis_kd`
  MODIFY `id_jenis_kd` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tm_jenis_matpel`
--
ALTER TABLE `tm_jenis_matpel`
  MODIFY `id_jenis_matpel` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tm_jenkel`
--
ALTER TABLE `tm_jenkel`
  MODIFY `id_jenkel` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tm_kategori`
--
ALTER TABLE `tm_kategori`
  MODIFY `id_kategori` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tm_kd`
--
ALTER TABLE `tm_kd`
  MODIFY `id_kd` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tm_kelas`
--
ALTER TABLE `tm_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tm_matpel`
--
ALTER TABLE `tm_matpel`
  MODIFY `id_matpel` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tr _absen`
--
ALTER TABLE `tr _absen`
  MODIFY `id _absen` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tr_ekstra`
--
ALTER TABLE `tr_ekstra`
  MODIFY `id_ekstra` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tr_fisik`
--
ALTER TABLE `tr_fisik`
  MODIFY `id_fisik` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tr_nilai_matpel`
--
ALTER TABLE `tr_nilai_matpel`
  MODIFY `id_nilai` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tr_nilai_sosial`
--
ALTER TABLE `tr_nilai_sosial`
  MODIFY `id _nilai _sosi` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tr_nilai_spirit`
--
ALTER TABLE `tr_nilai_spirit`
  MODIFY `id _nilai _spirit` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tr_prestasi`
--
ALTER TABLE `tr_prestasi`
  MODIFY `id_prestasi` int(3) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
