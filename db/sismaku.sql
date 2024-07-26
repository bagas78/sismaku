-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2024 at 12:03 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sismaku`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_absen`
--

CREATE TABLE `t_absen` (
  `absen_id` int(11) NOT NULL,
  `absen_karyawan` int(11) DEFAULT NULL,
  `absen_upah` text DEFAULT NULL,
  `absen_jam` time DEFAULT NULL,
  `absen_tanggal` date DEFAULT NULL,
  `absen_status` enum('masuk','tidak') DEFAULT NULL,
  `absen_bayar` enum('sudah','belum') DEFAULT 'belum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_absen`
--

INSERT INTO `t_absen` (`absen_id`, `absen_karyawan`, `absen_upah`, `absen_jam`, `absen_tanggal`, `absen_status`, `absen_bayar`) VALUES
(29, 7, '80000', '02:14:32', '2024-06-23', 'masuk', 'sudah'),
(30, 6, '70000', '02:14:40', '2024-06-23', 'masuk', 'belum'),
(31, 5, '0', '02:14:43', '2024-06-23', 'tidak', 'belum'),
(32, 7, '80000', '11:11:56', '2024-07-04', 'masuk', 'belum'),
(33, 6, '70000', '11:11:58', '2024-07-04', 'masuk', 'belum'),
(34, 5, '70000', '11:11:59', '2024-07-04', 'masuk', 'belum'),
(35, 7, '80000', '06:47:57', '2024-07-25', 'masuk', 'belum'),
(36, 6, '70000', '06:47:59', '2024-07-25', 'masuk', 'belum'),
(37, 5, '70000', '06:48:01', '2024-07-25', 'masuk', 'belum');

-- --------------------------------------------------------

--
-- Table structure for table `t_barang`
--

CREATE TABLE `t_barang` (
  `barang_id` int(11) NOT NULL,
  `barang_kode` text NOT NULL,
  `barang_kategori` text NOT NULL,
  `barang_stok` text NOT NULL DEFAULT '0',
  `barang_nama` text NOT NULL,
  `barang_satuan` enum('kg','ekor','pcs','tray') NOT NULL,
  `barang_tanggal` date NOT NULL DEFAULT curdate(),
  `barang_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_barang`
--

INSERT INTO `t_barang` (`barang_id`, `barang_kode`, `barang_kategori`, `barang_stok`, `barang_nama`, `barang_satuan`, `barang_tanggal`, `barang_hapus`) VALUES
(31, 'KB0017', '3', '2', 'BETTERZYM', 'pcs', '2023-07-27', 0),
(32, 'KB0018', '3', '5', 'MEDIVAC CORYZA', 'pcs', '2023-07-27', 0),
(33, 'KB0019', '3', '0', 'EGG STIMULANT', 'pcs', '2023-07-29', 0),
(34, 'KB0020', '3', '0', 'CYPROTIL PLUS', 'pcs', '2023-07-29', 0),
(36, 'KB0022', '3', '0', 'TOLTRADEX', 'pcs', '2023-07-29', 0),
(38, 'KB0024', '3', '0', 'ENDOMIX', 'pcs', '2023-07-29', 0),
(39, 'KB0025', '3', '0', 'MEDIVAC ND-IB', 'pcs', '2023-07-29', 0),
(40, 'KB0026', '3', '0', 'LD BOTOL ', 'pcs', '2023-07-29', 0),
(41, 'KB0027', '3', '0', 'MULTIIC HC', 'pcs', '2023-07-29', 0),
(42, 'KB0028', '3', '0', 'SUP ELEKTOLIT', 'pcs', '2023-07-29', 0),
(43, 'KB0029', '3', '0', 'MDCP', 'pcs', '2023-07-29', 0),
(44, 'KB0030', '3', '0', 'PITABLOCK', 'pcs', '2023-07-29', 0),
(68, 'KB0054', '2', '10', 'JAGUNG PAK HUSEN', 'kg', '2023-08-05', 0),
(69, 'KB0055', '2', '0', 'JAGUNG', 'kg', '2023-08-05', 0),
(70, 'KB0056', '2', '5', 'KATUL', 'kg', '2023-08-05', 0),
(71, 'KB0057', '2', '0', 'BKK', 'kg', '2023-08-05', 0),
(72, 'KB0058', '2', '0', 'MBM', 'kg', '2023-08-05', 0),
(73, 'KB0059', '2', '0', 'MENIR BATU', 'kg', '2023-08-05', 0),
(78, 'KB0064', '1', '110', 'TELUR MERAH', 'tray', '2023-08-05', 0),
(134, 'KB00120', '2', '10', 'GANDUM', 'kg', '2023-11-21', 0),
(138, 'KB0021', '4', '15', 'Kotoran Ayam', 'kg', '2024-07-25', 0),
(139, 'KB0022', '5', '1000', 'Ayam Petelur Sussex', 'ekor', '2024-07-25', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_barang_kategori`
--

CREATE TABLE `t_barang_kategori` (
  `barang_kategori_id` int(11) NOT NULL,
  `barang_kategori_nama` text NOT NULL,
  `barang_kategori_satuan` enum('kg','ekor','pcs','tray') NOT NULL,
  `barang_kategori_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_barang_kategori`
--

INSERT INTO `t_barang_kategori` (`barang_kategori_id`, `barang_kategori_nama`, `barang_kategori_satuan`, `barang_kategori_tanggal`) VALUES
(1, 'telur', 'tray', '2023-02-27'),
(2, 'pakan', 'kg', '2023-02-27'),
(3, 'obat', 'pcs', '2023-02-27'),
(4, 'kotoran', 'kg', '2024-07-25'),
(5, 'ayam', 'ekor', '2024-07-25'),
(6, 'afkir', 'ekor', '2024-07-25');

-- --------------------------------------------------------

--
-- Table structure for table `t_detail_user`
--

CREATE TABLE `t_detail_user` (
  `detail_id` int(11) NOT NULL,
  `detail_id_user` int(11) DEFAULT NULL,
  `detail_jabatan` varchar(50) DEFAULT NULL,
  `detail_pendidikan` text DEFAULT NULL,
  `detail_alamat` text DEFAULT NULL,
  `detail_biodata` text DEFAULT NULL,
  `detail_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_detail_user`
--

INSERT INTO `t_detail_user` (`detail_id`, `detail_id_user`, `detail_jabatan`, `detail_pendidikan`, `detail_alamat`, `detail_biodata`, `detail_hapus`) VALUES
(1, 2, 'BOS', '-', 'Pandanarum ', '-', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_gaji`
--

CREATE TABLE `t_gaji` (
  `gaji_id` int(11) NOT NULL,
  `gaji_karyawan` text NOT NULL,
  `gaji_nominal` text DEFAULT NULL,
  `gaji_keterangan` text DEFAULT NULL,
  `gaji_tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_gaji`
--

INSERT INTO `t_gaji` (`gaji_id`, `gaji_karyawan`, `gaji_nominal`, `gaji_keterangan`, `gaji_tanggal`) VALUES
(4, '4', '70000', 'Ambil butuh uang', '2023-03-30'),
(5, '3', '70000', 'Waktunya bayaran', '2023-03-30'),
(6, '4', '140000', '-', '2023-05-13'),
(7, '7', '80000', 'di bayar', '2024-06-23');

-- --------------------------------------------------------

--
-- Table structure for table `t_karyawan`
--

CREATE TABLE `t_karyawan` (
  `karyawan_id` int(11) NOT NULL,
  `karyawan_kode` text NOT NULL,
  `karyawan_nama` text NOT NULL,
  `karyawan_alamat` text NOT NULL,
  `karyawan_telp` text NOT NULL,
  `karyawan_upah` text NOT NULL,
  `karyawan_tanggal` date NOT NULL DEFAULT curdate(),
  `karyawan_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_karyawan`
--

INSERT INTO `t_karyawan` (`karyawan_id`, `karyawan_kode`, `karyawan_nama`, `karyawan_alamat`, `karyawan_telp`, `karyawan_upah`, `karyawan_tanggal`, `karyawan_hapus`) VALUES
(2, 'KR001', 'David latumahina', '-', '085855011542', '55000', '2023-02-25', 1),
(3, 'KR002', 'Mario dandi satrio', '-', '085234567890', '70000', '2023-02-25', 1),
(4, 'KR003', 'Agnes gracia haryanto', '-', '085676443232', '70000', '2023-02-26', 1),
(5, 'KR004', 'Patrik star', 'Bikini Bottom', '085653887625', '70000', '2024-06-22', 0),
(6, 'KR005', 'Spongebob Squarepants', 'Bikini Bottom', '087265625789', '70000', '2024-06-22', 0),
(7, 'KR006', 'Squidward Tentacles', 'Bikini Bottom', '081123567432', '80000', '2024-06-22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_kontak`
--

CREATE TABLE `t_kontak` (
  `kontak_id` int(11) NOT NULL,
  `kontak_jenis` set('s','p') NOT NULL DEFAULT '',
  `kontak_kode` text NOT NULL,
  `kontak_nama` text NOT NULL,
  `kontak_alamat` text NOT NULL,
  `kontak_tlp` text NOT NULL,
  `kontak_tanggal` date NOT NULL DEFAULT curdate(),
  `kontak_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_kontak`
--

INSERT INTO `t_kontak` (`kontak_id`, `kontak_jenis`, `kontak_kode`, `kontak_nama`, `kontak_alamat`, `kontak_tlp`, `kontak_tanggal`, `kontak_hapus`) VALUES
(7, 's', 'SP003', 'MEDION ARDHIKA PRATAMA', 'BLITAR', '000', '2023-07-27', 0),
(8, 's', 'SP004', 'PT.SARANA VETERINARIA JAYA ABADI', 'TAMAN TEKNO BSD SEKTOR XI BLOK J2/5 TANGGERANG SELATAN', '02175880369', '2023-07-29', 0),
(9, 's', 'SP005', 'PT MULTIFARMA SATWA MAJU', 'JL.AYA PAUNG PAMJANG NO.81 LEGO-TANGGERANG', '0215979876', '2023-07-29', 0),
(10, 's', 'SP006', 'MULTI EDITAS UTAMA', 'JL.PERINTIS KEMERDEKAAN KOMMP.RUKO PERTAMA BORDI TEXTILL CENTRE BLOK A-4 TASIKMALAYA ', '026532794', '2023-07-29', 0),
(11, 's', 'SP007', 'AHMAD LUDOYO', 'LUDOYO', '000', '2023-07-29', 0),
(12, 's', 'SP008', 'PT.AGRINUSA JAYA SENTOSA', 'JL.RAYA JUANDA SEDATIAGUNG.SIDOARJO', '0318671623', '2023-07-29', 0),
(13, 's', 'SP009', 'PT.LEWI MANUNGGAL', 'BLITAR', '000', '2023-07-29', 0),
(15, 's', 'SP0011', 'PT.BCAF', 'BLITAR', '000', '2023-08-01', 0),
(16, 's', 'SP0012', 'PAK KHUSEN', 'BLITAR', '00', '2023-08-05', 0),
(17, 's', 'SP0013', 'PA NOR', 'BLITAR', '00', '2023-08-05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_pembelian`
--

CREATE TABLE `t_pembelian` (
  `pembelian_id` int(11) NOT NULL,
  `pembelian_user` int(11) DEFAULT NULL,
  `pembelian_nomor` text DEFAULT NULL,
  `pembelian_kontak` int(11) DEFAULT NULL,
  `pembelian_sales` text DEFAULT NULL,
  `pembelian_jatuh_tempo` date DEFAULT NULL,
  `pembelian_keterangan` text DEFAULT NULL,
  `pembelian_qty` text DEFAULT NULL,
  `pembelian_ppn` text DEFAULT NULL,
  `pembelian_total` text DEFAULT NULL,
  `pembelian_tanggal` date DEFAULT curdate(),
  `pembelian_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pembelian`
--

INSERT INTO `t_pembelian` (`pembelian_id`, `pembelian_user`, `pembelian_nomor`, `pembelian_kontak`, `pembelian_sales`, `pembelian_jatuh_tempo`, `pembelian_keterangan`, `pembelian_qty`, `pembelian_ppn`, `pembelian_total`, `pembelian_tanggal`, `pembelian_hapus`) VALUES
(197, 2, 'PB-220624-1', 7, 'Pegi alias perong', '2024-06-22', 'Pembelian pakan', '30', '0', '280000', '2024-06-22', 0),
(198, 2, 'PB-220624-2', 7, 'Pegi alias perong', '2024-06-22', 'pembelian obat', '15', '0', '155000', '2024-06-22', 0),
(200, 2, 'PB-220624-3', 7, 'Mas Bro', '2024-06-22', 'Hutang', '10', '0', '100000', '2024-06-22', 0),
(201, 2, 'PB-170724-4', 7, 'test', '2024-07-17', 'testing', '10', '0', '100000', '2024-07-17', 0),
(205, 2, 'PB-250724-5', 7, 'Mas Bro', '2024-07-25', 'Pembelian Ayam', '500', '0', '3500000', '2024-07-25', 0),
(206, 2, 'PB-250724-6', 7, 'Mas Bro', '2024-07-25', 'ayam', '500', '0', '4000000', '2024-07-25', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_pembelian_barang`
--

CREATE TABLE `t_pembelian_barang` (
  `pembelian_barang_id` int(11) NOT NULL,
  `pembelian_barang_nomor` text DEFAULT NULL,
  `pembelian_barang_kategori` text DEFAULT NULL,
  `pembelian_barang_barang` text DEFAULT NULL,
  `pembelian_barang_harga` text DEFAULT NULL,
  `pembelian_barang_diskon` text DEFAULT NULL,
  `pembelian_barang_qty` text DEFAULT NULL,
  `pembelian_barang_subtotal` text DEFAULT NULL,
  `pembelian_barang_tanggal` date DEFAULT curdate(),
  `pembelian_barang_keluar` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pembelian_barang`
--

INSERT INTO `t_pembelian_barang` (`pembelian_barang_id`, `pembelian_barang_nomor`, `pembelian_barang_kategori`, `pembelian_barang_barang`, `pembelian_barang_harga`, `pembelian_barang_diskon`, `pembelian_barang_qty`, `pembelian_barang_subtotal`, `pembelian_barang_tanggal`, `pembelian_barang_keluar`) VALUES
(243, 'PB-220624-1', '2', '70', '8000', '0', '10', '80000', '2024-06-22', ''),
(244, 'PB-220624-1', '2', '68', '10000', '0', '20', '200000', '2024-06-22', ''),
(245, 'PB-220624-2', '3', '32', '12000', '0', '10', '120000', '2024-06-22', ''),
(246, 'PB-220624-2', '3', '31', '7000', '0', '5', '35000', '2024-06-22', ''),
(249, 'PB-220624-3', '3', '31', '12000', '0', '5', '60000', '2024-06-22', ''),
(250, 'PB-220624-3', '2', '68', '8000', '0', '5', '40000', '2024-06-22', ''),
(251, 'PB-170724-4', '2', '134', '10000', '0', '10', '100000', '2024-07-17', ''),
(253, 'PB-250724-5', '5', '139', '7000', '0', '500', '3500000', '2024-07-25', '2027-01-24'),
(254, 'PB-250724-6', '5', '139', '8000', '0', '500', '4000000', '2024-07-25', '2027-01-24');

-- --------------------------------------------------------

--
-- Table structure for table `t_penjualan`
--

CREATE TABLE `t_penjualan` (
  `penjualan_id` int(11) NOT NULL,
  `penjualan_user` int(11) DEFAULT NULL,
  `penjualan_nomor` text DEFAULT NULL,
  `penjualan_jatuh_tempo` text DEFAULT NULL,
  `penjualan_keterangan` text DEFAULT NULL,
  `penjualan_qty` text DEFAULT NULL,
  `penjualan_ppn` int(11) DEFAULT NULL,
  `penjualan_total` text DEFAULT NULL,
  `penjualan_tanggal` date DEFAULT curdate(),
  `penjualan_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_penjualan`
--

INSERT INTO `t_penjualan` (`penjualan_id`, `penjualan_user`, `penjualan_nomor`, `penjualan_jatuh_tempo`, `penjualan_keterangan`, `penjualan_qty`, `penjualan_ppn`, `penjualan_total`, `penjualan_tanggal`, `penjualan_hapus`) VALUES
(34, 2, 'PJ-230624-1', '2024-06-23', 'lunas', '10', 0, '300000', '2024-06-23', 0),
(35, 2, 'PJ-250724-2', '2024-07-25', 'jual kotoran', '5', 0, '25000', '2024-07-25', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_penjualan_barang`
--

CREATE TABLE `t_penjualan_barang` (
  `penjualan_barang_id` int(11) NOT NULL,
  `penjualan_barang_nomor` text NOT NULL,
  `penjualan_barang_barang` text NOT NULL,
  `penjualan_barang_harga` text NOT NULL,
  `penjualan_barang_diskon` text NOT NULL,
  `penjualan_barang_stok` text NOT NULL,
  `penjualan_barang_qty` text NOT NULL,
  `penjualan_barang_subtotal` text NOT NULL,
  `penjualan_barang_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_penjualan_barang`
--

INSERT INTO `t_penjualan_barang` (`penjualan_barang_id`, `penjualan_barang_nomor`, `penjualan_barang_barang`, `penjualan_barang_harga`, `penjualan_barang_diskon`, `penjualan_barang_stok`, `penjualan_barang_qty`, `penjualan_barang_subtotal`, `penjualan_barang_tanggal`) VALUES
(39, 'PJ-230624-1', '78', '30000', '0', '  100', '10', '300000', '2024-06-23'),
(40, 'PJ-250724-2', '138', '5000', '0', '10', '5', '25000', '2024-07-25');

-- --------------------------------------------------------

--
-- Table structure for table `t_recording`
--

CREATE TABLE `t_recording` (
  `recording_id` int(11) NOT NULL,
  `recording_nomor` text NOT NULL,
  `recording_user` text NOT NULL,
  `recording_tanggal` date DEFAULT NULL,
  `recording_bobot` text NOT NULL,
  `recording_populasi` text NOT NULL,
  `recording_keterangan` text NOT NULL,
  `recording_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_recording`
--

INSERT INTO `t_recording` (`recording_id`, `recording_nomor`, `recording_user`, `recording_tanggal`, `recording_bobot`, `recording_populasi`, `recording_keterangan`, `recording_hapus`) VALUES
(280, 'RC-230624-1', '2', '2024-06-23', '2', '1000', 'recoding hari minggu', 0),
(286, 'RC-250724-2', '2', '2024-07-25', '2', '500', 'kotoran ayam edit', 0),
(288, 'RC-260724-3', '2', '2024-07-26', '2', '1000', 'test ayam mati', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_recording_barang`
--

CREATE TABLE `t_recording_barang` (
  `recording_barang_id` int(11) NOT NULL,
  `recording_barang_nomor` text DEFAULT NULL,
  `recording_barang_barang` text DEFAULT '0',
  `recording_barang_stok` text DEFAULT '0',
  `recording_barang_jumlah` text DEFAULT '0',
  `recording_barang_kategori` text DEFAULT NULL,
  `recording_barang_tanggal` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_recording_barang`
--

INSERT INTO `t_recording_barang` (`recording_barang_id`, `recording_barang_nomor`, `recording_barang_barang`, `recording_barang_stok`, `recording_barang_jumlah`, `recording_barang_kategori`, `recording_barang_tanggal`) VALUES
(535, 'RC-230624-1', '78', '0', '100', 'telur', '2024-06-23'),
(536, 'RC-230624-1', '70', '10', '5', 'pakan', '2024-06-23'),
(537, 'RC-230624-1', '68', '25', '5', 'pakan', '2024-06-23'),
(538, 'RC-230624-1', '32', '10', '5', 'obat', '2024-06-23'),
(539, 'RC-230624-1', '31', '10', '5', 'obat', '2024-06-23'),
(566, 'RC-250724-2', '78', '0', '10', 'telur', '2024-07-25'),
(567, 'RC-250724-2', '68', '20', '5', 'pakan', '2024-07-25'),
(568, 'RC-250724-2', '31', '5', '2', 'obat', '2024-07-25'),
(569, 'RC-250724-2', '138', '0', '10', 'kotoran', '2024-07-25'),
(584, 'RC-260724-3', '78', '0', '10', 'telur', '2024-07-26'),
(585, 'RC-260724-3', '68', '15', '5', 'pakan', '2024-07-26'),
(586, 'RC-260724-3', '31', '3', '1', 'obat', '2024-07-26'),
(587, 'RC-260724-3', '139', '1000', '15', 'ayam', '2024-07-26'),
(588, 'RC-260724-3', '138', '0', '10', 'kotoran', '2024-07-26');

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE `t_user` (
  `user_id` int(11) NOT NULL,
  `user_nama` text DEFAULT NULL,
  `user_email` text DEFAULT NULL,
  `user_password` text DEFAULT NULL,
  `user_level` int(11) DEFAULT 1,
  `user_foto` text DEFAULT NULL,
  `user_hapus` int(11) DEFAULT 0,
  `user_tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`user_id`, `user_nama`, `user_email`, `user_password`, `user_level`, `user_foto`, `user_hapus`, `user_tanggal`) VALUES
(2, 'Admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 1, '728b1793940f5ea980454e5ace4eee3a.jpg', 0, '2020-05-10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_absen`
--
ALTER TABLE `t_absen`
  ADD PRIMARY KEY (`absen_id`);

--
-- Indexes for table `t_barang`
--
ALTER TABLE `t_barang`
  ADD PRIMARY KEY (`barang_id`);

--
-- Indexes for table `t_barang_kategori`
--
ALTER TABLE `t_barang_kategori`
  ADD PRIMARY KEY (`barang_kategori_id`);

--
-- Indexes for table `t_detail_user`
--
ALTER TABLE `t_detail_user`
  ADD PRIMARY KEY (`detail_id`);

--
-- Indexes for table `t_gaji`
--
ALTER TABLE `t_gaji`
  ADD PRIMARY KEY (`gaji_id`);

--
-- Indexes for table `t_karyawan`
--
ALTER TABLE `t_karyawan`
  ADD PRIMARY KEY (`karyawan_id`);

--
-- Indexes for table `t_kontak`
--
ALTER TABLE `t_kontak`
  ADD PRIMARY KEY (`kontak_id`);

--
-- Indexes for table `t_pembelian`
--
ALTER TABLE `t_pembelian`
  ADD PRIMARY KEY (`pembelian_id`);

--
-- Indexes for table `t_pembelian_barang`
--
ALTER TABLE `t_pembelian_barang`
  ADD PRIMARY KEY (`pembelian_barang_id`);

--
-- Indexes for table `t_penjualan`
--
ALTER TABLE `t_penjualan`
  ADD PRIMARY KEY (`penjualan_id`);

--
-- Indexes for table `t_penjualan_barang`
--
ALTER TABLE `t_penjualan_barang`
  ADD PRIMARY KEY (`penjualan_barang_id`);

--
-- Indexes for table `t_recording`
--
ALTER TABLE `t_recording`
  ADD PRIMARY KEY (`recording_id`);

--
-- Indexes for table `t_recording_barang`
--
ALTER TABLE `t_recording_barang`
  ADD PRIMARY KEY (`recording_barang_id`) USING BTREE;

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_absen`
--
ALTER TABLE `t_absen`
  MODIFY `absen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `t_barang`
--
ALTER TABLE `t_barang`
  MODIFY `barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `t_barang_kategori`
--
ALTER TABLE `t_barang_kategori`
  MODIFY `barang_kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t_detail_user`
--
ALTER TABLE `t_detail_user`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `t_gaji`
--
ALTER TABLE `t_gaji`
  MODIFY `gaji_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `t_karyawan`
--
ALTER TABLE `t_karyawan`
  MODIFY `karyawan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `t_kontak`
--
ALTER TABLE `t_kontak`
  MODIFY `kontak_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `t_pembelian`
--
ALTER TABLE `t_pembelian`
  MODIFY `pembelian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- AUTO_INCREMENT for table `t_pembelian_barang`
--
ALTER TABLE `t_pembelian_barang`
  MODIFY `pembelian_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=255;

--
-- AUTO_INCREMENT for table `t_penjualan`
--
ALTER TABLE `t_penjualan`
  MODIFY `penjualan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `t_penjualan_barang`
--
ALTER TABLE `t_penjualan_barang`
  MODIFY `penjualan_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `t_recording`
--
ALTER TABLE `t_recording`
  MODIFY `recording_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=289;

--
-- AUTO_INCREMENT for table `t_recording_barang`
--
ALTER TABLE `t_recording_barang`
  MODIFY `recording_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=589;

--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
