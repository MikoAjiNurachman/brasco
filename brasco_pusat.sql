-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Des 2019 pada 05.37
-- Versi server: 10.3.16-MariaDB
-- Versi PHP: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brasco_pusat`
--
CREATE DATABASE IF NOT EXISTS `brasco_pusat` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `brasco_pusat`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `groupType` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nomor_hp` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `groupType`, `alamat`, `nomor_hp`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$AP2e4HcWnDpoeRUON02Yp.iQymYrkFJBcdr8.I0TE/8F5Ijwo95ui', 'utility', 'admin', '123', '2019-11-11 04:45:45', NULL),
(8, 'inventory', '$2y$10$gm0UcnTl4jM4FwGvTaye/eMmELjQ/iQCFUlaBLW8WpOkjHFY6Zfsa', 'inventory', 'adwadwadawdwa', '02020', '2019-11-12 02:09:47', NULL),
(9, 'pemasaran', '$2y$10$cMg2US3K7tDXcnLHgSElyed.K8cVX.fI2XMcvrdsPj3p4Qi8E56Om', 'pemasaran', 'awdawdawdwad', '202020', '2019-11-12 02:10:17', NULL),
(10, 'procurement', '$2y$10$aQ.P2bY2TSBkgfeJK8G3Aew3gISp/l9wwly4X.m4K065NMaeH5j5K', 'procurement', 'Jl. Basudewo 1086C\r\nJl. Kanguru Raya No. 2 AB', '132213', '2019-11-12 02:10:35', NULL),
(11, 'utility', '$2y$10$A/m2D8JnXkBtuOVJjW4lkOmz93GOjCOoOqZ19Pu.nAcyNmd/5X7sq', 'utility', 'wadwadwa', '234', '2019-11-12 02:11:18', NULL),
(25, 'manager', '$2y$10$dFqRVqcr2.mlV7XdKDckbuSlGY6ypjtyCGRKM//cdbjFTtiDtxO2a', 'manager', 'awakkawok', '0812222', '2019-11-13 07:02:43', '2019-11-14 01:10:55'),
(30, 'superadmin', '$2y$10$U6ZteqP0KBL8EHPQGtqjNOAxMoABAEculsJwoTp/4lrAhOMnBV5l2', 'superadmin', 'adawdad', '21123', '2019-11-14 01:42:37', '2019-11-14 01:42:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bank`
--

DROP TABLE IF EXISTS `bank`;
CREATE TABLE `bank` (
  `kode_bank` varchar(255) NOT NULL,
  `nama_bank` varchar(255) NOT NULL,
  `saldo_jalan` varchar(255) NOT NULL,
  `saldo_awal` varchar(255) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `nomor_akun` varchar(255) NOT NULL,
  `id_admin` varchar(255) NOT NULL,
  `id_edit_admin` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bank`
--

INSERT INTO `bank` (`kode_bank`, `nama_bank`, `saldo_jalan`, `saldo_awal`, `tipe`, `nomor_akun`, `id_admin`, `id_edit_admin`, `created_at`, `updated_at`) VALUES
('B-001', 'BCA', '990000000', '1000000000', 'bank', '100.103', '30', '30', '2019-11-26 08:26:05', '2019-12-11 08:38:31'),
('B-002', 'Mandiri', '500000000', '500000000', 'bank', '100.104', '30', '0', '2019-11-26 08:29:00', '2019-11-26 08:31:02'),
('K-001', 'Kas', '5000000', '5000000', 'kas', '100.101', '30', '0', '2019-11-26 08:26:46', '2019-11-26 08:31:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bank_input_pembayaran`
--

DROP TABLE IF EXISTS `bank_input_pembayaran`;
CREATE TABLE `bank_input_pembayaran` (
  `nomor_kas_keluar` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `id_bank` varchar(255) NOT NULL,
  `no_giro` varchar(255) NOT NULL,
  `tanggal_giro` date NOT NULL,
  `jenis_biaya` varchar(255) NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `id_admin` varchar(255) NOT NULL,
  `id_edit_admin` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bank_input_pembayaran`
--

INSERT INTO `bank_input_pembayaran` (`nomor_kas_keluar`, `tanggal`, `id_bank`, `no_giro`, `tanggal_giro`, `jenis_biaya`, `jumlah`, `keterangan`, `id_admin`, `id_edit_admin`, `created_at`, `updated_at`) VALUES
('NKK-00000013', '2019-11-26', 'B-001', '1234', '2019-11-26', '300.200', '10000000', 'bayar', '30', '0', '2019-11-26 08:31:48', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bank_input_penerimaan`
--

DROP TABLE IF EXISTS `bank_input_penerimaan`;
CREATE TABLE `bank_input_penerimaan` (
  `nomor_kas_masuk` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `id_bank` varchar(255) NOT NULL,
  `no_giro` varchar(255) NOT NULL,
  `tanggal_giro` date NOT NULL,
  `jenis_pendapatan` varchar(255) NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `id_admin` varchar(255) NOT NULL,
  `id_edit_admin` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `counter`
--

DROP TABLE IF EXISTS `counter`;
CREATE TABLE `counter` (
  `tabel` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `header` varchar(255) NOT NULL,
  `digit` varchar(8) NOT NULL,
  `id_edit_admin` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `counter`
--

INSERT INTO `counter` (`tabel`, `nama`, `header`, `digit`, `id_edit_admin`, `created_at`, `updated_at`) VALUES
('diskon_barang_reject', 'Diskon Barang Reject', 'RJ', '19110005', '30', '2019-11-05 02:36:56', '2019-12-16 07:50:40'),
('faktur', 'Kode Faktur', 'IF', '19110000', '30', '2019-11-05 02:36:56', '2019-11-26 06:28:23'),
('kwitansi_invoice', 'Kwitansi Invoice', 'KV', '00000011', '30', '2019-11-05 02:36:56', '2019-11-16 08:31:22'),
('nomor_terima', 'Nomor Terima', 'NT', '00000000', '30', '2019-11-05 07:42:04', '2019-11-14 08:36:50'),
('nomor_transfer', 'Nomor Transfer', 'NF', '00000000', '30', '2019-11-05 07:42:04', '2019-11-14 08:36:50'),
('no_kas_keluar', 'Nomor Kas Keluar', 'NKK', '00000014', '30', '2019-11-05 07:42:04', '2019-11-26 08:36:07'),
('no_kas_masuk', 'Nomor Kas Masuk', 'NKM', '00000006', '30', '2019-11-05 07:42:04', '2019-11-16 12:26:34'),
('no_transaksi', 'Nomor Transaksi', 'NTR', '00000000', '30', '2019-11-05 07:42:04', '2019-11-14 08:36:50'),
('order_gudang', 'Kode Order Gudang', 'OD', '19110000', '30', '2019-11-05 02:36:56', '2019-12-09 08:09:09'),
('packing', 'Kode Packing Gudang', 'PK', '19110001', '30', '2019-11-05 02:36:56', '2019-12-25 13:15:55'),
('pengajuan_perubahan_harga', 'Pengajuan Perubahan Harga', 'PH', '10004568', '30', '2019-11-05 02:36:56', '2019-12-16 07:02:36'),
('picking', 'Kode Picking Gudang', 'PI', '19110003', '30', '2019-11-05 02:36:56', '2019-12-25 12:25:46'),
('purchase_order', 'Kode Purchase Order', 'PO', '19110002', '30', '2019-11-05 02:36:56', '2019-12-09 09:01:27'),
('purchasing', 'Kode Purchasing', 'PU', '19110000', '30', '2019-11-05 02:36:56', '2019-11-26 06:28:24'),
('retur_pembelian_barang', 'Kode Retur Pembelian Barang', 'RT', '19110003', '30', '2019-11-06 06:49:06', '2019-12-26 17:12:49'),
('sales_invoice', 'Kode Sales Invoice', 'SI', '19110000', '30', '2019-11-05 02:36:56', '2019-11-26 06:28:24'),
('sales_order', 'Kode Sales Order', 'SO', '00000000', '30', '2019-11-05 02:36:56', '2019-11-14 08:37:11'),
('stock_opname', 'Kode Stock Opname', 'ST', '00000057', '30', '2019-11-05 02:36:56', '2019-12-26 16:22:51'),
('supplier', 'Kode Supplier', 'SP', '00000000', '30', '2019-11-05 02:36:56', '2019-11-14 08:36:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `kode` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kota` varchar(255) NOT NULL,
  `kodepos` varchar(255) NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `handphone` varchar(255) NOT NULL,
  `npwp` varchar(255) NOT NULL,
  `ktp` varchar(255) NOT NULL,
  `tipe_customer` varchar(255) NOT NULL,
  `kredit` varchar(2) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `kode_sales` varchar(255) NOT NULL,
  `top` varchar(255) NOT NULL,
  `batas_kredit` varchar(255) NOT NULL,
  `tanggal_jual_akhir` date NOT NULL,
  `saldo_awal` varchar(255) NOT NULL,
  `saldo_jalan` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `id_admin` varchar(255) NOT NULL,
  `id_edit_admin` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`kode`, `nama`, `alamat`, `kota`, `kodepos`, `telepon`, `handphone`, `npwp`, `ktp`, `tipe_customer`, `kredit`, `contact_name`, `email`, `kode_sales`, `top`, `batas_kredit`, `tanggal_jual_akhir`, `saldo_awal`, `saldo_jalan`, `keterangan`, `id_admin`, `id_edit_admin`, `created_at`, `updated_at`) VALUES
('CUST-001', 'Brasco Puncak', 'jl puncak', 'bogor', '9999', '999999999999', '999999999999', '1234567890', '123412341234', '1', 'Y', 'roni', 'roni@gmail.com', '333', '90', '1000000000', '2019-11-26', '0', '0', 'customer', '30', '0', '2019-11-26 07:46:56', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `diskon_barang_reject`
--

DROP TABLE IF EXISTS `diskon_barang_reject`;
CREATE TABLE `diskon_barang_reject` (
  `id` int(11) NOT NULL,
  `kode_reject` varchar(255) NOT NULL,
  `kode_customer` varchar(255) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `barcode_reject` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `diskon` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `id_admin` varchar(255) NOT NULL,
  `id_edit_admin` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `diskon_barang_reject`
--

INSERT INTO `diskon_barang_reject` (`id`, `kode_reject`, `kode_customer`, `barcode`, `barcode_reject`, `quantity`, `diskon`, `status`, `id_admin`, `id_edit_admin`, `created_at`, `updated_at`) VALUES
(1, 'RJ-19110001', 'CUST-001', '778899', '778899R', '1', '50', 1, '30', '30', '2019-11-26 08:12:51', '2019-11-26 08:13:59'),
(2, 'RJ-19110001', 'CUST-001', '778899', '778899R', '1', '50', 1, '30', '30', '2019-11-26 08:12:51', '2019-11-26 08:14:05'),
(3, 'RJ-19110001', 'CUST-001', '778899', '778899R', '1', '50', 1, '30', '30', '2019-11-26 08:12:51', '2019-11-26 08:14:11'),
(4, 'RJ-19110002', 'CUST-001', '445566', '445566R', '1', '50', 1, '30', '30', '2019-11-26 08:16:22', '2019-11-26 08:16:30'),
(5, 'RJ-19110002', 'CUST-001', '445566', '445566R', '1', '50', 1, '30', '30', '2019-11-26 08:16:22', '2019-11-26 08:16:36'),
(6, 'RJ-19110003', 'CUST-001', '778899', '778899R', '7', '20', 1, '30', '30', '2019-12-16 07:43:43', '2019-12-16 07:44:24'),
(7, 'RJ-19110003', 'CUST-001', '778899', '778899R', '7', '20', 1, '30', '30', '2019-12-16 07:43:43', '2019-12-16 07:44:31'),
(8, 'RJ-19110003', 'CUST-001', '778899', '778899R', '7', '20', 1, '30', '30', '2019-12-16 07:43:43', '2019-12-16 07:44:38'),
(9, 'RJ-19110004', 'CUST-001', '778899', '778899R', '8', '25', 0, '30', '0', '2019-12-16 07:49:54', NULL),
(10, 'RJ-19110004', 'CUST-001', '778899', '778899R', '8', '25', 0, '30', '0', '2019-12-16 07:49:54', NULL),
(11, 'RJ-19110004', 'CUST-001', '778899', '778899R', '8', '25', 0, '30', '0', '2019-12-16 07:49:54', NULL),
(12, 'RJ-19110005', 'CUST-001', '445566', '445566R', '6', '25', 0, '30', '0', '2019-12-16 07:50:40', NULL),
(13, 'RJ-19110005', 'CUST-001', '445566', '445566R', '6', '25', 0, '30', '0', '2019-12-16 07:50:40', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `intrn`
--

DROP TABLE IF EXISTS `intrn`;
CREATE TABLE `intrn` (
  `kode` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `kode_item` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `satuan` varchar(255) NOT NULL,
  `harga_beli` varchar(255) NOT NULL,
  `hpp` varchar(255) NOT NULL,
  `harga_jual` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `tipe_transaksi` varchar(255) NOT NULL,
  `kode_user` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `intrn`
--

INSERT INTO `intrn` (`kode`, `tanggal`, `kode_item`, `quantity`, `satuan`, `harga_beli`, `hpp`, `harga_jual`, `discount`, `keterangan`, `tipe_transaksi`, `kode_user`, `created_at`, `updated_at`) VALUES
(1, '2019-11-26', '112233', '100', '100', '60000', '6000000', '0', '0', 'Purchasing', 'PU', '30', '2019-11-26 07:10:22', NULL),
(2, '2019-11-26', '445566', '100', '100', '100000', '10000000', '0', '0', 'Purchasing', 'PU', '30', '2019-11-26 07:10:22', NULL),
(3, '2019-11-26', '778899', '100', '100', '130000', '13000000', '0', '0', 'Purchasing', 'PU', '30', '2019-11-26 07:10:22', NULL),
(4, '2019-12-24', '778899R', '3', '124', '232', '28768', '0', '0', 'Purchasing', 'PU', '30', '2019-12-24 12:25:23', NULL),
(5, '2019-12-26', '445566', '10', '1', '100000', '1000000', '0', '0', 'Retur Barang Pembelian', 'RB', '30', '2019-12-26 17:00:09', NULL),
(6, '2019-12-26', '778899', '19', '1', '130000', '2470000', '0', '0', 'Retur Barang Pembelian', 'RB', '30', '2019-12-26 17:00:09', NULL),
(7, '2019-12-27', '112233', '5', '2', '60000', '300000', '0', '0', 'Retur Barang Pembelian', 'RB', '30', '2019-12-26 17:12:49', NULL),
(8, '2019-12-27', '778899R', '4', '1', '232', '928', '0', '0', 'Retur Barang Pembelian', 'RB', '30', '2019-12-26 17:12:49', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventory`
--

DROP TABLE IF EXISTS `inventory`;
CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `satuan` varchar(255) NOT NULL,
  `id_tipe_barang` varchar(255) NOT NULL,
  `harga_jual1` varchar(255) NOT NULL,
  `harga_jual2` varchar(255) NOT NULL,
  `harga_jual3` varchar(255) NOT NULL,
  `harga_beli` varchar(255) NOT NULL,
  `quantity` varchar(255) DEFAULT '0',
  `id_admin` varchar(255) NOT NULL,
  `id_edit_admin` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `inventory`
--

INSERT INTO `inventory` (`id`, `barcode`, `nama_barang`, `satuan`, `id_tipe_barang`, `harga_jual1`, `harga_jual2`, `harga_jual3`, `harga_beli`, `quantity`, `id_admin`, `id_edit_admin`, `created_at`, `update_at`) VALUES
(1, '112233', 'Baju Batik BRASCO', '2', '4', '72000', '77000', '80000', '60000', '75', '30', '30', '2019-11-26 06:34:40', '2019-12-26 17:12:49'),
(2, '445566', 'Celana BRASCO', '1', '3', '120000', '130000', '140000', '100000', '70', '30', '30', '2019-11-26 06:35:58', '2019-12-26 17:00:09'),
(3, '778899', 'Sepatu BRASCO', '1', '3', '150000', '160000', '170000', '130000', '50', '30', '30', '2019-11-26 06:36:30', '2019-12-26 17:00:09'),
(4, '778899R', 'Sepatu BRASCO', '1', '3', '30000', '160000', '170000', '232', '120', '30', '30', '2019-11-26 08:13:59', '2019-12-26 17:12:49'),
(5, '445566R', 'Celana BRASCO', '1', '3', '60000', '130000', '140000', '25000', '90', '30', '30', '2019-11-26 08:16:30', '2019-12-16 06:58:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurnal_referensi`
--

DROP TABLE IF EXISTS `jurnal_referensi`;
CREATE TABLE `jurnal_referensi` (
  `id` int(11) NOT NULL,
  `kas` char(13) NOT NULL,
  `bank` char(13) NOT NULL,
  `umbeli` char(13) NOT NULL,
  `hutang` char(13) NOT NULL,
  `persediaan` char(13) NOT NULL,
  `ppnmasuk` char(13) NOT NULL,
  `ongkirbeli` char(13) NOT NULL,
  `persediaan_in_transit` char(13) NOT NULL,
  `persediaan_gd1` char(13) NOT NULL,
  `persediaan_gd2` char(13) NOT NULL,
  `persediaan_brg_jadi` char(13) NOT NULL,
  `persediaan_bahan_baku_dlm_proses` char(13) NOT NULL,
  `persediaan_bahan_pembantu` char(13) NOT NULL,
  `biaya_upah_produksi` char(13) NOT NULL,
  `biaya_jasa_maklon` char(13) NOT NULL,
  `biaya_biaya_listrik` char(13) NOT NULL,
  `biaya_penyusutan_inv_pabrik` char(13) NOT NULL,
  `biaya_pr_mesin` char(13) NOT NULL,
  `biaya_perlengkapan_pabrik` char(13) NOT NULL,
  `biaya_lain` char(13) NOT NULL,
  `persediaan_gd3` char(13) NOT NULL,
  `umjual` char(13) NOT NULL,
  `piutang` char(13) NOT NULL,
  `penjualan` char(13) NOT NULL,
  `ppnkeluar` char(13) NOT NULL,
  `ongkirjual` char(13) NOT NULL,
  `hpp` char(13) NOT NULL,
  `retur_penjualan` char(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jurnal_referensi`
--

INSERT INTO `jurnal_referensi` (`id`, `kas`, `bank`, `umbeli`, `hutang`, `persediaan`, `ppnmasuk`, `ongkirbeli`, `persediaan_in_transit`, `persediaan_gd1`, `persediaan_gd2`, `persediaan_brg_jadi`, `persediaan_bahan_baku_dlm_proses`, `persediaan_bahan_pembantu`, `biaya_upah_produksi`, `biaya_jasa_maklon`, `biaya_biaya_listrik`, `biaya_penyusutan_inv_pabrik`, `biaya_pr_mesin`, `biaya_perlengkapan_pabrik`, `biaya_lain`, `persediaan_gd3`, `umjual`, `piutang`, `penjualan`, `ppnkeluar`, `ongkirjual`, `hpp`, `retur_penjualan`) VALUES
(1, '100.101', '100.103', '104.120', '401.000', '103.100', '103.110', '700.123', '103.100', '103.101', '103.100', '300.321', '104.101', '103.120', '401.000', '104.101', '100.000', '100.100', '100.000', '100.000', '100.000', '100.000', '600.101', '101.100', '600.100', '300.320', '700.123', '600.201', '104.100');

-- --------------------------------------------------------

--
-- Struktur dari tabel `label_barcode`
--

DROP TABLE IF EXISTS `label_barcode`;
CREATE TABLE `label_barcode` (
  `id` int(11) NOT NULL,
  `kode_po` varchar(255) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `harga` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `id_admin` varchar(255) NOT NULL,
  `id_edit_admin` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `label_barcode`
--

INSERT INTO `label_barcode` (`id`, `kode_po`, `barcode`, `harga`, `keterangan`, `quantity`, `id_admin`, `id_edit_admin`, `created_at`, `updated_at`) VALUES
(1, 'PO-19110001', '778899', '130000', 'beli', '150', '30', '0', '2019-11-26 06:58:23', NULL),
(2, 'PO-19110001', '778899', '130000', 'beli', '150', '30', '0', '2019-11-26 06:58:23', NULL),
(3, 'PO-19110001', '112233', '75000', 'a', '150', '30', '0', '2019-11-26 06:58:23', NULL),
(4, 'PO-19110001', '445566', '120000', 'a', '150', '30', '0', '2019-11-26 06:58:23', NULL),
(5, 'PO-19110001', '778899', '150000', 'a', '150', '30', '0', '2019-11-26 06:58:23', NULL),
(6, 'PO-19110002', '112233', '3', 'asdadw', '2', '30', '0', '2019-12-09 09:01:27', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_akun`
--

DROP TABLE IF EXISTS `ms_akun`;
CREATE TABLE `ms_akun` (
  `kodeakun` varchar(20) NOT NULL,
  `namaakun` varchar(100) DEFAULT NULL,
  `jenis` char(1) DEFAULT NULL,
  `status` char(1) DEFAULT 'A',
  `kelompok` varchar(20) DEFAULT NULL,
  `akuninduk` varchar(20) DEFAULT NULL,
  `kodecab` char(3) DEFAULT NULL,
  `tx` char(1) DEFAULT 'Y',
  `lvl` int(11) DEFAULT 0,
  `perusahaan` varchar(2) DEFAULT '0',
  `divisi` varchar(2) DEFAULT '0',
  `lrj` char(1) DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ms_akun`
--

INSERT INTO `ms_akun` (`kodeakun`, `namaakun`, `jenis`, `status`, `kelompok`, `akuninduk`, `kodecab`, `tx`, `lvl`, `perusahaan`, `divisi`, `lrj`) VALUES
('100.000', 'AKTIVA', 'D', 'A', NULL, NULL, NULL, 'N', 0, '0', '0', 'N'),
('100.100', 'AKTIVA LANCAR', 'D', 'A', NULL, NULL, NULL, 'N', 0, '0', '0', 'N'),
('100.101', 'Kas', 'D', 'A', 'B', NULL, NULL, 'Y', 0, '0', '0', 'N'),
('100.102', 'Bank BNI', 'D', 'A', 'B', NULL, NULL, 'Y', 0, '0', '0', 'N'),
('100.103', 'Bank BCA', 'D', 'A', 'B', NULL, NULL, 'Y', 0, '0', '0', 'N'),
('100.104', 'Bank Mandiri', 'D', 'A', 'B', NULL, NULL, 'Y', 0, '0', '0', 'N'),
('101.100', 'Piutang Dagang', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('101.102', 'Piutang Gesek BCA', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('101.103', 'Piutang Gesek Mandiri', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('102.100', 'Pajak Dibayar Dimuka', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('102.101', 'Pajak Dibayar Dimuka PPH 25', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('102.102', 'Pajak Dibayar Dimuka PPH 22', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('102.103', 'Pajak Dibayar Dimuka PPH 23', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('102.110', 'Pajak Dibayar Dimuka PPH Final', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('102.111', 'Pajak Dibayar Dimuka PPH', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('103.100', 'Persediaan Barang Dagangan', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('103.101', 'Persediaan Barang Dagang', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('103.110', 'PPN Masukan', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('103.120', 'Pembelian yg blm di FP kan', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('104.100', 'Biaya Dibayar Dimuka', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('104.101', 'Sewa Dibayar Dimuka', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('104.110', 'Biaya Bunga Ditangguhkan', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('104.120', 'Uang Muka Pembelian', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('200.000', 'AKTIVA TETAP', 'D', 'A', NULL, NULL, NULL, 'N', 0, '0', '0', 'N'),
('201.100', 'Bangunan', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('201.101', 'Peralatan', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('201.200', 'Inventaris Kantor', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('201.201', 'Inventaris Kendaraan', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('201.300', 'Akumulasi Penyusutan Kantor', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('201.301', 'Akumulasi Penyusutan Kendaraan', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('202.000', 'AKTIVA LAIN LAIN', 'D', 'A', NULL, NULL, NULL, 'N', 0, '0', '0', 'N'),
('300.000', 'PASSIVA', 'K', 'A', NULL, NULL, NULL, 'N', 0, '0', '0', 'N'),
('300.100', 'PASSIVA LANCAR', 'K', 'A', NULL, NULL, NULL, 'N', 0, '0', '0', 'N'),
('300.200', 'Hutang Dagang', 'K', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('300.300', 'Hutang Pajak', 'K', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('300.301', 'Hutang PPH 25', 'K', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('300.302', 'Hutang PPH 21', 'K', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('300.310', 'Hutang PPN', 'K', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('300.311', 'Hutang PPH Final', 'K', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('300.320', 'PPN Keluaran', 'K', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('300.321', 'PPN Keluaran Dibebaskan', 'K', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('300.330', 'Penjualan yg blm di FP kan', 'K', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('400.000', 'Hutang Bank', 'K', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('400.100', 'Hutang Bank BNI', 'K', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('400.200', 'Hutang Leasing', 'K', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('401.000', 'Hutang Lain - Lain', 'K', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('401.100', 'Hutang Lain-Lain', 'K', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('500.000', 'EKUITAS', 'K', 'A', NULL, NULL, NULL, 'N', 0, '0', '0', 'N'),
('500.100', 'Modal', 'K', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('500.110', 'Laba Yang Ditahan', 'K', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('500.520', 'Prive', 'K', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('500.530', 'Laba Rugi Periode Berjalan', 'K', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('600.000', 'PENDAPATAN USAHA', 'K', 'A', NULL, NULL, NULL, 'N', 0, '0', '0', 'N'),
('600.100', 'Penjualan', 'K', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('600.101', 'Uang Muka Penjualan', 'K', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('600.200', 'HARGA POKOK PENJUALAN', 'K', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('600.201', 'HPP', 'K', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('700.000', 'BIAYA - BIAYA USAHA', 'D', 'A', NULL, NULL, NULL, 'N', 0, '0', '0', 'N'),
('700.100', 'Biaya Gaji', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('700.101', 'Biaya Listrik & Air', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('700.102', 'Biaya Telepon & Fax', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('700.103', 'Biaya Kantor', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('700.104', 'Biaya Alat Tulis Kantor', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('700.105', 'Biaya Bahan Bakar', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('700.106', 'Biaya Pemeliharan Bangunan', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('700.107', 'Biaya Service & Pemeliharaan', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('700.108', 'Biaya Pajak', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('700.109', 'Biaya PPH Final Pasal 4 (2)', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('700.110', 'Biaya Keamanan', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('700.111', 'Biaya Parkir & Tol', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('700.112', 'Biaya Penyusutan Inventaris Kantor', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('700.113', 'Biaya Penyusutan Inventaris Kendaraan', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('700.114', 'Biaya Asuransi', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('700.115', 'Biaya Pengobatan', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('700.116', 'Biaya Perlengkapan', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('700.117', 'Biaya Transport', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('700.118', 'Biaya Perjalanan Dinas', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('700.119', 'Biaya Materai', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('700.120', 'Biaya Kliring', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('700.121', 'Biaya Paket', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('700.122', 'Biaya Pengiriman', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('700.123', 'Biaya Kendaraan', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('700.124', 'Biaya KB-KB', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('700.130', 'Biaya Lain - Lain', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('700.131', 'Biaya Sewa', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('700.200', 'BIAYA LAIN - LAINNYA (Diluar Usaha)', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('700.201', 'Biaya Administrasi Bank', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('700.210', 'Pajak Bunga', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('700.211', 'Biaya Bunga', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('700.300', 'BIAYA LAIN-LAIN', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('700.310', 'Kerugian Lain - Lain', 'D', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('800.000', 'PENDAPATAN LAIN-LAIN', 'K', 'A', NULL, NULL, NULL, 'N', 0, '0', '0', 'N'),
('800.100', 'Pendapatan Lain -Lain', 'K', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('800.110', 'Pendapatan Bunga', 'K', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N'),
('800.120', 'Pendapatan Jasa Giro', 'K', 'A', NULL, NULL, NULL, 'Y', 0, '0', '0', 'N');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_gudang`
--

DROP TABLE IF EXISTS `order_gudang`;
CREATE TABLE `order_gudang` (
  `nomor_order` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `nomor_so` varchar(255) NOT NULL,
  `kode_customer` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `id_admin` varchar(255) NOT NULL,
  `id_edit_admin` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `order_gudang`
--

INSERT INTO `order_gudang` (`nomor_order`, `tanggal`, `nomor_so`, `kode_customer`, `keterangan`, `total`, `id_admin`, `id_edit_admin`, `created_at`, `updated_at`) VALUES
('OD-19110001', '2019-11-26', 'PO123', 'CUST-001', 'a', '150', '30', '0', '2019-11-26 07:54:36', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_gudang_item`
--

DROP TABLE IF EXISTS `order_gudang_item`;
CREATE TABLE `order_gudang_item` (
  `id` int(11) NOT NULL,
  `nomor_order` varchar(255) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `id_admin` varchar(255) NOT NULL,
  `id_edit_admin` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `order_gudang_item`
--

INSERT INTO `order_gudang_item` (`id`, `nomor_order`, `barcode`, `quantity`, `id_admin`, `id_edit_admin`, `created_at`, `updated_at`) VALUES
(1, 'OD-19110001', '112233', '50', '30', '0', '2019-11-26 07:54:37', '2019-12-25 12:00:42'),
(2, 'OD-19110001', '445566', '50', '30', '0', '2019-11-26 07:54:37', '2019-12-25 12:00:45'),
(3, 'OD-19110001', '778899', '50', '30', '0', '2019-11-26 07:54:37', '2019-12-25 12:00:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `packing`
--

DROP TABLE IF EXISTS `packing`;
CREATE TABLE `packing` (
  `nomor_packing` varchar(255) NOT NULL,
  `kode_customer` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `total` varchar(255) NOT NULL,
  `id_admin` varchar(255) NOT NULL,
  `id_edit_admin` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `packing`
--

INSERT INTO `packing` (`nomor_packing`, `kode_customer`, `tanggal`, `total`, `id_admin`, `id_edit_admin`, `created_at`, `updated_at`) VALUES
('PK-19110001', 'CUST-001', '2019-12-25', '105', '30', '0', '2019-12-25 13:07:34', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `packing_item`
--

DROP TABLE IF EXISTS `packing_item`;
CREATE TABLE `packing_item` (
  `id` int(11) NOT NULL,
  `nomor_packing` varchar(255) NOT NULL,
  `id_picking_item` int(11) NOT NULL,
  `quantity_packing` int(11) NOT NULL,
  `id_admin` varchar(255) NOT NULL,
  `id_edit_admin` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `packing_item`
--

INSERT INTO `packing_item` (`id`, `nomor_packing`, `id_picking_item`, `quantity_packing`, `id_admin`, `id_edit_admin`, `created_at`, `updated_at`) VALUES
(1, 'PK-19110001', 1, 35, '30', '0', '2019-12-25 13:07:33', NULL),
(2, 'PK-19110001', 2, 35, '30', '0', '2019-12-25 13:07:33', NULL),
(3, 'PK-19110001', 3, 35, '30', '0', '2019-12-25 13:07:34', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan_perubahan_harga`
--

DROP TABLE IF EXISTS `pengajuan_perubahan_harga`;
CREATE TABLE `pengajuan_perubahan_harga` (
  `nomor_pengajuan` varchar(255) NOT NULL,
  `tipe_customer` varchar(255) NOT NULL,
  `tanggal_approve` date DEFAULT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'belum_approve',
  `id_admin` varchar(255) NOT NULL,
  `id_edit_admin` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengajuan_perubahan_harga`
--

INSERT INTO `pengajuan_perubahan_harga` (`nomor_pengajuan`, `tipe_customer`, `tanggal_approve`, `tanggal_pengajuan`, `keterangan`, `status`, `id_admin`, `id_edit_admin`, `created_at`, `updated_at`) VALUES
('PH-10004567', '1', '2019-11-26', '2019-11-26', 'ok', 'approve', '30', '30', '2019-11-26 08:20:52', '2019-11-26 08:22:45'),
('PH-10004568', '1', NULL, '2019-12-26', NULL, 'belum_approve', '30', '0', '2019-12-16 07:02:35', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `picking`
--

DROP TABLE IF EXISTS `picking`;
CREATE TABLE `picking` (
  `nomor_picking` varchar(255) NOT NULL,
  `nomor_order` varchar(255) NOT NULL,
  `kode_customer` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `total_picking` int(255) NOT NULL,
  `tanggal` date NOT NULL,
  `id_admin` varchar(255) NOT NULL,
  `id_edit_admin` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `picking`
--

INSERT INTO `picking` (`nomor_picking`, `nomor_order`, `kode_customer`, `status`, `total`, `total_picking`, `tanggal`, `id_admin`, `id_edit_admin`, `created_at`, `updated_at`) VALUES
('PI-19110003', 'OD-19110001', 'CUST-001', 'Proses', '105', 0, '2019-12-25', '30', '30', '2019-12-25 12:25:47', '2019-12-25 12:33:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `picking_item`
--

DROP TABLE IF EXISTS `picking_item`;
CREATE TABLE `picking_item` (
  `id` int(11) NOT NULL,
  `nomor_picking` varchar(255) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `id_order_item` varchar(255) NOT NULL,
  `quantity_picking` varchar(255) NOT NULL,
  `quantity_packing` varchar(255) NOT NULL DEFAULT '0',
  `quantity_order` varchar(255) NOT NULL,
  `id_admin` varchar(255) NOT NULL,
  `id_edit_admin` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `picking_item`
--

INSERT INTO `picking_item` (`id`, `nomor_picking`, `barcode`, `id_order_item`, `quantity_picking`, `quantity_packing`, `quantity_order`, `id_admin`, `id_edit_admin`, `created_at`, `updated_at`) VALUES
(1, 'PI-19110003', '112233', '1', '35', '35', '50', '30', '30', '2019-12-25 12:25:46', '2019-12-25 13:07:33'),
(2, 'PI-19110003', '445566', '2', '35', '35', '50', '30', '30', '2019-12-25 12:25:46', '2019-12-25 13:07:33'),
(3, 'PI-19110003', '778899', '3', '35', '35', '50', '30', '30', '2019-12-25 12:25:46', '2019-12-25 13:07:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pph_item`
--

DROP TABLE IF EXISTS `pph_item`;
CREATE TABLE `pph_item` (
  `id` int(11) NOT NULL,
  `nomor_pengajuan` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `tipe_customer` varchar(255) NOT NULL,
  `barcode_inventory` varchar(255) NOT NULL,
  `harga_jual_lama` varchar(255) NOT NULL,
  `harga_jual_baru` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `id_admin` varchar(255) NOT NULL,
  `id_edit_admin` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pph_item`
--

INSERT INTO `pph_item` (`id`, `nomor_pengajuan`, `tanggal`, `tipe_customer`, `barcode_inventory`, `harga_jual_lama`, `harga_jual_baru`, `keterangan`, `id_admin`, `id_edit_admin`, `created_at`, `updated_at`) VALUES
(1, 'PH-10004567', '2019-11-26', '1', '112233', '75000', '72000', 'a', '30', '0', '2019-11-26 08:20:52', NULL),
(2, 'PH-10004568', '2019-12-26', '1', '445566', '120000', '444', 'adawd', '30', '0', '2019-12-16 07:02:35', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `profil`
--

DROP TABLE IF EXISTS `profil`;
CREATE TABLE `profil` (
  `id` int(60) NOT NULL,
  `kode_cabang` varchar(255) NOT NULL,
  `nama_cabang` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `alamat2` varchar(255) NOT NULL,
  `kota` varchar(255) NOT NULL,
  `kodepos` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `chief` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `id_edit_admin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `profil`
--

INSERT INTO `profil` (`id`, `kode_cabang`, `nama_cabang`, `alamat`, `alamat2`, `kota`, `kodepos`, `no_telp`, `no_hp`, `chief`, `logo`, `id_edit_admin`) VALUES
(1, '1', 'BRASCO Pusat', 'Jl. Jakarta', 'RT 01 RW 12', 'Jakarta', '53456', '02414752737', '08245465637', 'Big Boss', 'a1qwd37f9l401.jpg', '30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchase_order`
--

DROP TABLE IF EXISTS `purchase_order`;
CREATE TABLE `purchase_order` (
  `kode` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `tanggal_approve` date DEFAULT NULL,
  `kode_supplier` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kota` varchar(255) NOT NULL,
  `kodepos` varchar(255) NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `handphone` varchar(255) NOT NULL,
  `dpp` varchar(255) NOT NULL,
  `uangmuka_beli` varchar(255) NOT NULL DEFAULT '0',
  `tipe_ppn` varchar(2) DEFAULT NULL,
  `tipe_ppn_input` varchar(255) NOT NULL,
  `total_harga` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `keterangan_approve` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Belum Approve',
  `id_admin` varchar(255) NOT NULL,
  `id_edit_admin` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `purchase_order`
--

INSERT INTO `purchase_order` (`kode`, `tanggal`, `tanggal_approve`, `kode_supplier`, `nama`, `alamat`, `kota`, `kodepos`, `telepon`, `handphone`, `dpp`, `uangmuka_beli`, `tipe_ppn`, `tipe_ppn_input`, `total_harga`, `keterangan`, `keterangan_approve`, `status`, `id_admin`, `id_edit_admin`, `created_at`, `updated_at`) VALUES
('PO-19110001', '2019-11-26', '2019-12-10', 'AB-001', 'BRASCO Pusat', 'Jl. Jakarta', 'Jakarta', '53456', '02414752737', '08245465637', '43500000', '0', 'E', '4350000', '47850000', 'beli', 'ga', 'Reject', '30', '0', '2019-11-26 06:58:22', '2019-12-10 11:17:24'),
('PO-19110002', '2019-12-09', '2019-12-10', 'SP-002', 'BRASCO Pusat', 'Jl. Jakarta', 'Jakarta', '53456', '02414752737', '08245465637', '1160', '0', 'T', '0', '1160', '', 'oke', 'Approve', '30', '0', '2019-12-09 09:01:27', '2019-12-10 11:17:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchase_order_item`
--

DROP TABLE IF EXISTS `purchase_order_item`;
CREATE TABLE `purchase_order_item` (
  `id` int(11) NOT NULL,
  `kode_po` varchar(255) NOT NULL,
  `barcode_inventory` varchar(255) NOT NULL,
  `kode_item_supplier` varchar(255) DEFAULT NULL,
  `nama_inventory` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `quantity_purchasing` varchar(255) DEFAULT NULL,
  `harga_satuan` varchar(255) NOT NULL,
  `satuan` varchar(255) NOT NULL,
  `id_admin` varchar(255) NOT NULL,
  `id_edit_admin` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `purchase_order_item`
--

INSERT INTO `purchase_order_item` (`id`, `kode_po`, `barcode_inventory`, `kode_item_supplier`, `nama_inventory`, `quantity`, `quantity_purchasing`, `harga_satuan`, `satuan`, `id_admin`, `id_edit_admin`, `created_at`, `updated_at`) VALUES
(1, 'PO-19110001', '112233', '112233', 'Baju Batik BRASCO', '150', '', '60000', '1', '30', '0', '2019-11-26 06:58:22', NULL),
(2, 'PO-19110001', '445566', '445566', 'Celana BRASCO', '150', '', '100000', '1', '30', '0', '2019-11-26 06:58:22', NULL),
(3, 'PO-19110001', '778899', '778899', 'Sepatu BRASCO', '150', '', '130000', '1', '30', '0', '2019-11-26 06:58:23', NULL),
(4, 'PO-19110002', '778899R', '4', 'Sepatu BRASCO', '5', '2', '232', '1', '30', '0', '2019-12-09 09:01:27', '2019-12-24 12:25:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchasing`
--

DROP TABLE IF EXISTS `purchasing`;
CREATE TABLE `purchasing` (
  `kode` varchar(255) NOT NULL,
  `nomor_surat_jalan` varchar(255) NOT NULL,
  `no_invoice` varchar(255) NOT NULL,
  `kode_supplier` varchar(255) NOT NULL,
  `kode_po` varchar(255) NOT NULL,
  `diterima_oleh` varchar(255) NOT NULL,
  `tanggal_terima` date NOT NULL,
  `tanggal_jatuh_tempo` date NOT NULL,
  `total_quantity` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `outstanding` varchar(255) NOT NULL,
  `id_admin` varchar(255) NOT NULL,
  `id_edit_admin` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `purchasing`
--

INSERT INTO `purchasing` (`kode`, `nomor_surat_jalan`, `no_invoice`, `kode_supplier`, `kode_po`, `diterima_oleh`, `tanggal_terima`, `tanggal_jatuh_tempo`, `total_quantity`, `total`, `outstanding`, `id_admin`, `id_edit_admin`, `created_at`, `updated_at`) VALUES
('PU-5000', 'FFFF', '23232323', 'SP-002', 'PO-19110002', 'Rando', '2019-12-24', '2357-02-06', '3', '696', '696', '30', '0', '2019-12-24 12:25:23', NULL),
('pu01', 'sj01', 'in01', 'AB-001', 'PO-19110001', 'ipan', '2019-11-26', '2020-02-24', '300', '29000000', '9000000', '30', '30', '2019-11-26 07:10:22', '2019-11-26 08:36:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchasing_item`
--

DROP TABLE IF EXISTS `purchasing_item`;
CREATE TABLE `purchasing_item` (
  `id` int(11) NOT NULL,
  `kode_pu` varchar(255) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `quantity_order` varchar(255) NOT NULL,
  `quantity_terima` varchar(255) NOT NULL,
  `harga_satuan` varchar(255) NOT NULL,
  `id_admin` varchar(255) NOT NULL,
  `id_edit_admin` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `purchasing_item`
--

INSERT INTO `purchasing_item` (`id`, `kode_pu`, `barcode`, `quantity_order`, `quantity_terima`, `harga_satuan`, `id_admin`, `id_edit_admin`, `created_at`, `updated_at`) VALUES
(1, 'in01', '112233', '150', '100', '60000', '30', '0', '2019-11-26 07:10:22', NULL),
(2, 'in01', '445566', '150', '100', '100000', '30', '0', '2019-11-26 07:10:22', NULL),
(3, 'in01', '778899', '150', '100', '130000', '30', '0', '2019-11-26 07:10:22', NULL),
(4, '23232323', '778899R', '5', '3', '232', '30', '0', '2019-12-24 12:25:23', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `retur_pembelian_barang`
--

DROP TABLE IF EXISTS `retur_pembelian_barang`;
CREATE TABLE `retur_pembelian_barang` (
  `nomor_retur` varchar(255) NOT NULL,
  `nomor_invoice` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `kode_supplier` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `id_admin` varchar(255) NOT NULL,
  `id_edit_admin` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `retur_pembelian_barang`
--

INSERT INTO `retur_pembelian_barang` (`nomor_retur`, `nomor_invoice`, `tanggal`, `kode_supplier`, `keterangan`, `id_admin`, `id_edit_admin`, `created_at`, `updated_at`) VALUES
('RT-19110001', '123', '2019-11-26', 'AB-001', 'a', '30', '0', '2019-11-26 08:45:50', NULL),
('RT-19110002', 'INV-22222', '2019-12-26', 'SP-002', 'SUP NIBB', '30', '0', '2019-12-26 17:00:09', NULL),
('RT-19110003', 'TT-2', '2019-12-27', 'SP-002', 'wot?', '30', '0', '2019-12-26 17:12:49', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `retur_pembelian_barang_item`
--

DROP TABLE IF EXISTS `retur_pembelian_barang_item`;
CREATE TABLE `retur_pembelian_barang_item` (
  `id` int(11) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `nomor_retur` varchar(255) NOT NULL,
  `id_admin` varchar(255) NOT NULL,
  `id_edit_admin` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `retur_pembelian_barang_item`
--

INSERT INTO `retur_pembelian_barang_item` (`id`, `barcode`, `jumlah`, `keterangan`, `nomor_retur`, `id_admin`, `id_edit_admin`, `created_at`, `updated_at`) VALUES
(1, '445566', '2', 'rusak', 'RT-19110001', '30', '0', '2019-11-26 08:45:50', NULL),
(2, '445566', '10', 'WAHAHAHA', 'RT-19110002', '30', '0', '2019-12-26 17:00:09', NULL),
(3, '778899', '19', 'TEEHHEHEHE', 'RT-19110002', '30', '0', '2019-12-26 17:00:09', NULL),
(4, '112233', '5', 'eeee', 'RT-19110003', '30', '0', '2019-12-26 17:12:49', NULL),
(5, '778899R', '4', 'aaaa', 'RT-19110003', '30', '0', '2019-12-26 17:12:49', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sales_invoice`
--

DROP TABLE IF EXISTS `sales_invoice`;
CREATE TABLE `sales_invoice` (
  `nomor_invoice` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `kode_customer` varchar(255) NOT NULL,
  `data` text NOT NULL,
  `catatan` text NOT NULL,
  `surat_jalan` int(1) NOT NULL DEFAULT 0,
  `kwitansi` int(1) NOT NULL DEFAULT 0,
  `subtotal` varchar(255) NOT NULL,
  `ongkir` varchar(255) NOT NULL,
  `ppn` varchar(255) NOT NULL,
  `tipe_ppn` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `outstanding` varchar(255) NOT NULL,
  `id_admin` varchar(255) NOT NULL,
  `id_edit_admin` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sales_order`
--

DROP TABLE IF EXISTS `sales_order`;
CREATE TABLE `sales_order` (
  `nomor_so` varchar(255) NOT NULL,
  `tanggal_so` date NOT NULL,
  `kode_customer` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `uangmuka_jual` varchar(255) NOT NULL,
  `id_admin` varchar(255) NOT NULL,
  `id_edit_admin` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sales_order`
--

INSERT INTO `sales_order` (`nomor_so`, `tanggal_so`, `kode_customer`, `keterangan`, `total`, `uangmuka_jual`, `id_admin`, `id_edit_admin`, `created_at`, `updated_at`) VALUES
('PO123', '2019-11-26', 'CUST-001', 'so', '150', '', '30', '0', '2019-11-26 07:50:49', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sales_order_item`
--

DROP TABLE IF EXISTS `sales_order_item`;
CREATE TABLE `sales_order_item` (
  `id` int(11) NOT NULL,
  `nomor_so` varchar(255) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `id_admin` varchar(255) NOT NULL,
  `id_edit_admin` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sales_order_item`
--

INSERT INTO `sales_order_item` (`id`, `nomor_so`, `barcode`, `quantity`, `id_admin`, `id_edit_admin`, `created_at`, `updated_at`) VALUES
(1, 'PO123', '112233', '50', '30', '0', '2019-11-26 07:50:49', NULL),
(2, 'PO123', '445566', '50', '30', '0', '2019-11-26 07:50:49', NULL),
(3, 'PO123', '778899', '50', '30', '0', '2019-11-26 07:50:49', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan`
--

DROP TABLE IF EXISTS `satuan`;
CREATE TABLE `satuan` (
  `id` int(11) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `id_admin` varchar(255) NOT NULL,
  `id_edit_admin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `satuan`
--

INSERT INTO `satuan` (`id`, `satuan`, `id_admin`, `id_edit_admin`) VALUES
(1, 'PCS', '30', '0'),
(2, 'PACK', '30', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock_opname`
--

DROP TABLE IF EXISTS `stock_opname`;
CREATE TABLE `stock_opname` (
  `id` int(11) NOT NULL,
  `kode` varchar(255) NOT NULL,
  `barcode_inventory` varchar(255) NOT NULL,
  `quantity_opname` varchar(255) NOT NULL,
  `quantity_selisih` varchar(255) NOT NULL,
  `approved` int(1) NOT NULL,
  `id_admin` varchar(255) NOT NULL,
  `id_edit_admin` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `stock_opname`
--

INSERT INTO `stock_opname` (`id`, `kode`, `barcode_inventory`, `quantity_opname`, `quantity_selisih`, `approved`, `id_admin`, `id_edit_admin`, `created_at`, `updated_at`) VALUES
(1, 'ST-00000057', '112233', '80', '10', 1, '30', '0', '2019-12-26 16:22:51', '2019-12-26 16:23:30'),
(2, 'ST-00000057', '445566', '80', '10', 1, '30', '0', '2019-12-26 16:22:52', '2019-12-26 16:23:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier` (
  `kode` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kota` varchar(255) NOT NULL,
  `kodepos` varchar(255) NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `handphone` varchar(255) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `kredit` varchar(255) NOT NULL,
  `top` varchar(255) NOT NULL,
  `pkp` varchar(2) NOT NULL,
  `saldo_awal` varchar(255) DEFAULT '0',
  `saldo_jalan` varchar(255) NOT NULL DEFAULT '0',
  `tanggal_beli_akhir` date NOT NULL,
  `id_admin` varchar(255) NOT NULL,
  `id_edit_admin` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`kode`, `nama`, `alamat`, `kota`, `kodepos`, `telepon`, `fax`, `handphone`, `contact_name`, `email`, `kredit`, `top`, `pkp`, `saldo_awal`, `saldo_jalan`, `tanggal_beli_akhir`, `id_admin`, `id_edit_admin`, `created_at`, `updated_at`) VALUES
('AB-001', 'Supplier AB', 'Alamat AB', 'Jakarta', '99999', '082133333333', '123123', '081111112121', 'Kontak AB', 'ab@gmail.com', '1000000000', '90', 'Y', '0', '0', '2019-11-26', '30', '0', '2019-11-26 06:41:23', '2019-11-26 07:10:23'),
('SP-002', 'Nanda', 'Jl. Basudewo 1086C\r\nJl. Kanguru Raya No. 2 AB', 'Semarang', '50246', '2323212', '', '6281542464268', 'Hanif', 'hanifsetyananda17@gmail.com', '213123', '123131', 'Y', '1111111111111111', '0', '2019-12-24', '30', '0', '2019-12-09 08:25:07', '2019-12-24 12:25:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier_saldo`
--

DROP TABLE IF EXISTS `supplier_saldo`;
CREATE TABLE `supplier_saldo` (
  `kode_supplier` varchar(255) NOT NULL,
  `saldo_awal` varchar(255) NOT NULL,
  `saldo_jalan` varchar(255) DEFAULT '0',
  `id_admin` varchar(255) NOT NULL,
  `id_edit_admin` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tipe_barang`
--

DROP TABLE IF EXISTS `tipe_barang`;
CREATE TABLE `tipe_barang` (
  `id` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `id_admin` varchar(255) NOT NULL,
  `id_edit_admin` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tipe_barang`
--

INSERT INTO `tipe_barang` (`id`, `nama_barang`, `id_admin`, `id_edit_admin`, `created_at`, `update_at`) VALUES
(3, 'NORMAL', '30', '0', '2019-11-26 06:33:58', NULL),
(4, 'REJECT', '30', '0', '2019-11-26 06:34:03', NULL),
(5, 'HADIAH', '30', '0', '2019-11-26 06:34:09', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_jurnal`
--

DROP TABLE IF EXISTS `tr_jurnal`;
CREATE TABLE `tr_jurnal` (
  `nomor` int(11) NOT NULL,
  `noref` varchar(20) NOT NULL,
  `novoucher` varchar(20) NOT NULL,
  `nourut` int(11) NOT NULL,
  `kodeakun` varchar(20) NOT NULL,
  `debet` double(15,2) NOT NULL,
  `kredit` double(15,2) NOT NULL,
  `keterangan` varchar(225) NOT NULL,
  `tanggal` date NOT NULL,
  `jenis` char(2) NOT NULL DEFAULT 'JK',
  `posted` char(1) NOT NULL DEFAULT 'T',
  `kodecbg` char(3) NOT NULL DEFAULT '1',
  `userid` varchar(20) NOT NULL,
  `tglrekam` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `wbs` varchar(10) DEFAULT NULL,
  `useredit` varchar(20) DEFAULT NULL,
  `tgledit` timestamp NULL DEFAULT NULL,
  `statusid` int(11) DEFAULT NULL,
  `ket` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tr_jurnal`
--

INSERT INTO `tr_jurnal` (`nomor`, `noref`, `novoucher`, `nourut`, `kodeakun`, `debet`, `kredit`, `keterangan`, `tanggal`, `jenis`, `posted`, `kodecbg`, `userid`, `tglrekam`, `wbs`, `useredit`, `tgledit`, `statusid`, `ket`) VALUES
(1, '', 'pu01', 1, '103.100', 29000000.00, 0.00, 'Persediaan Purchasing', '2019-11-26', 'JK', 'T', '1', '30', '2019-11-26 07:10:23', '', '', NULL, 0, ''),
(2, '', 'pu01', 2, '103.110', 4350000.00, 0.00, 'PPN Purchasing', '2019-11-26', 'JK', 'T', '1', '30', '2019-11-26 07:10:23', '', '', NULL, 0, ''),
(3, '', 'pu01', 4, '401.000', 0.00, 33350000.00, 'Hutang Purchasing', '2019-11-26', 'JK', 'T', '1', '30', '2019-11-26 07:10:23', '', '', NULL, 0, ''),
(5, '', 'ST-00000056', 1, 'AKTIVA', 0.00, 99999999.00, 'Adjust Selisih Stock Opname', '2019-12-16', 'JK', 'T', '1', '30', '2019-12-16 08:38:18', '', '0', NULL, 0, ''),
(6, '', 'PU-5000', 1, '103.100', 696.00, 0.00, 'Persediaan Purchasing', '2019-12-24', 'JK', 'T', '1', '30', '2019-12-24 12:25:23', '', '', NULL, 0, ''),
(7, '', 'PU-5000', 2, '103.110', 0.00, 0.00, 'PPN Purchasing', '2019-12-24', 'JK', 'T', '1', '30', '2019-12-24 12:25:23', '', '', NULL, 0, ''),
(8, '', 'PU-5000', 4, '401.000', 0.00, 696.00, 'Hutang Purchasing', '2019-12-24', 'JK', 'T', '1', '30', '2019-12-24 12:25:23', '', '', NULL, 0, ''),
(9, '', 'ST-00000057', 1, 'Persediaan Barang Da', 200000.00, 0.00, 'Adjust Selisih Stock Opname', '2019-12-26', 'JK', 'T', '1', '30', '2019-12-26 16:23:30', '', '0', NULL, 0, ''),
(10, '', 'ST-00000057', 2, 'Kas', 0.00, 200000.00, 'Adjust Selisih Stock Opname', '2019-12-26', 'JK', 'T', '1', '30', '2019-12-26 16:23:30', '', '0', NULL, 0, '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`kode_bank`);

--
-- Indeks untuk tabel `bank_input_pembayaran`
--
ALTER TABLE `bank_input_pembayaran`
  ADD PRIMARY KEY (`nomor_kas_keluar`);

--
-- Indeks untuk tabel `bank_input_penerimaan`
--
ALTER TABLE `bank_input_penerimaan`
  ADD PRIMARY KEY (`nomor_kas_masuk`);

--
-- Indeks untuk tabel `counter`
--
ALTER TABLE `counter`
  ADD PRIMARY KEY (`tabel`);

--
-- Indeks untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`kode`);

--
-- Indeks untuk tabel `diskon_barang_reject`
--
ALTER TABLE `diskon_barang_reject`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `intrn`
--
ALTER TABLE `intrn`
  ADD PRIMARY KEY (`kode`);

--
-- Indeks untuk tabel `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jurnal_referensi`
--
ALTER TABLE `jurnal_referensi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `label_barcode`
--
ALTER TABLE `label_barcode`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ms_akun`
--
ALTER TABLE `ms_akun`
  ADD PRIMARY KEY (`kodeakun`);

--
-- Indeks untuk tabel `order_gudang`
--
ALTER TABLE `order_gudang`
  ADD PRIMARY KEY (`nomor_order`);

--
-- Indeks untuk tabel `order_gudang_item`
--
ALTER TABLE `order_gudang_item`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `packing`
--
ALTER TABLE `packing`
  ADD PRIMARY KEY (`nomor_packing`);

--
-- Indeks untuk tabel `packing_item`
--
ALTER TABLE `packing_item`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengajuan_perubahan_harga`
--
ALTER TABLE `pengajuan_perubahan_harga`
  ADD PRIMARY KEY (`nomor_pengajuan`);

--
-- Indeks untuk tabel `picking`
--
ALTER TABLE `picking`
  ADD PRIMARY KEY (`nomor_picking`);

--
-- Indeks untuk tabel `picking_item`
--
ALTER TABLE `picking_item`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pph_item`
--
ALTER TABLE `pph_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indeks untuk tabel `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`kode`);

--
-- Indeks untuk tabel `purchase_order_item`
--
ALTER TABLE `purchase_order_item`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `purchasing`
--
ALTER TABLE `purchasing`
  ADD PRIMARY KEY (`kode`);

--
-- Indeks untuk tabel `purchasing_item`
--
ALTER TABLE `purchasing_item`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `retur_pembelian_barang`
--
ALTER TABLE `retur_pembelian_barang`
  ADD PRIMARY KEY (`nomor_retur`);

--
-- Indeks untuk tabel `retur_pembelian_barang_item`
--
ALTER TABLE `retur_pembelian_barang_item`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sales_invoice`
--
ALTER TABLE `sales_invoice`
  ADD PRIMARY KEY (`nomor_invoice`);

--
-- Indeks untuk tabel `sales_order`
--
ALTER TABLE `sales_order`
  ADD PRIMARY KEY (`nomor_so`);

--
-- Indeks untuk tabel `sales_order_item`
--
ALTER TABLE `sales_order_item`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stock_opname`
--
ALTER TABLE `stock_opname`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`kode`);

--
-- Indeks untuk tabel `supplier_saldo`
--
ALTER TABLE `supplier_saldo`
  ADD PRIMARY KEY (`kode_supplier`);

--
-- Indeks untuk tabel `tipe_barang`
--
ALTER TABLE `tipe_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tr_jurnal`
--
ALTER TABLE `tr_jurnal`
  ADD PRIMARY KEY (`nomor`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `diskon_barang_reject`
--
ALTER TABLE `diskon_barang_reject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `intrn`
--
ALTER TABLE `intrn`
  MODIFY `kode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `jurnal_referensi`
--
ALTER TABLE `jurnal_referensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `label_barcode`
--
ALTER TABLE `label_barcode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `order_gudang_item`
--
ALTER TABLE `order_gudang_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `packing_item`
--
ALTER TABLE `packing_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `picking_item`
--
ALTER TABLE `picking_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pph_item`
--
ALTER TABLE `pph_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `profil`
--
ALTER TABLE `profil`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `purchase_order_item`
--
ALTER TABLE `purchase_order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `purchasing_item`
--
ALTER TABLE `purchasing_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `retur_pembelian_barang_item`
--
ALTER TABLE `retur_pembelian_barang_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `sales_order_item`
--
ALTER TABLE `sales_order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `stock_opname`
--
ALTER TABLE `stock_opname`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tipe_barang`
--
ALTER TABLE `tipe_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tr_jurnal`
--
ALTER TABLE `tr_jurnal`
  MODIFY `nomor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
