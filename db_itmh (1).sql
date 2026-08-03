-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2026 at 03:24 AM
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
-- Database: `db_itmh`
--

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_aset` varchar(255) NOT NULL,
  `nama_perangkat` varchar(255) NOT NULL,
  `merk` varchar(255) DEFAULT NULL,
  `spesifikasi` text DEFAULT NULL,
  `serial_number` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `mac_address` varchar(255) DEFAULT NULL,
  `jenis_perangkat_id` bigint(20) UNSIGNED NOT NULL,
  `kondisi_id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `kode_aset`, `nama_perangkat`, `merk`, `spesifikasi`, `serial_number`, `ip_address`, `mac_address`, `jenis_perangkat_id`, `kondisi_id`, `unit_id`, `created_at`, `updated_at`) VALUES
(1, 'AST-IT-001', 'PC IT 102', 'HP', 'Intel(R) Core(TM) i7-4770 CPU @ 3.40GHz (8 CPUs), ~3.4GHz, 16384MB RAM, System Model: 400-265d', '4CE41010GJ', '172.16.103.102', '0C-54-A5-57-B7-DE', 54, 59, 69, '2026-07-19 23:17:31', '2026-07-19 23:17:31'),
(2, 'AST-IT-002', 'Charger Laptop RPU A Bedah', 'Charger Laptop Asus', NULL, '-', NULL, NULL, 72, 59, 23, '2026-07-22 23:43:59', '2026-07-22 23:43:59'),
(3, 'AST-IT-003', 'Laptop Farmasi Rawat Inap', 'Asus', 'OS WINDOWS 11 HS, intel core i3', '-', '172.16.103.205', '-', 57, 59, 16, '2026-07-30 19:17:00', '2026-07-30 19:17:00');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-itrsmh25@gmail.com|172.16.103.22', 'i:1;', 1785690147),
('laravel-cache-itrsmh25@gmail.com|172.16.103.22:timer', 'i:1785690147;', 1785690147);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `form_permintaan_perubahans`
--

CREATE TABLE `form_permintaan_perubahans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_pemohon` varchar(255) NOT NULL,
  `unit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `shift_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `nomor_ext` varchar(255) DEFAULT NULL,
  `data_pasien` varchar(255) DEFAULT NULL,
  `jenis_permintaan_id` bigint(20) UNSIGNED NOT NULL,
  `uraian_alasan` text NOT NULL,
  `bukti_dukung` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `teknisi_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `form_permintaan_perubahans`
--

INSERT INTO `form_permintaan_perubahans` (`id`, `nama_pemohon`, `unit_id`, `shift_id`, `nip`, `nomor_ext`, `data_pasien`, `jenis_permintaan_id`, `uraian_alasan`, `bukti_dukung`, `status`, `teknisi_id`, `created_at`, `updated_at`) VALUES
(1, 'Test', 14, 38, 'Test', 'test', 'test', 61, 'test', NULL, 'approved', 71, '2026-07-20 05:52:51', '2026-07-22 08:05:23'),
(2, 'wardiah', 20, 36, '-', '405', 'SITI MAYSAROH / 000082939', 61, 'salah resep', 'bukti_dukung/1784601410_Screenshot 2026-07-21 093335.jpg', 'approved', 42, '2026-07-20 19:36:50', '2026-07-20 19:45:29'),
(3, 'iis sumiyati', 15, 41, '0753.09.25', '-', '194750', 62, 'ada implementasi yang belum di masukan', NULL, 'approved', 42, '2026-07-21 18:35:39', '2026-07-21 18:39:26'),
(4, 'Siti Yullianti', 15, 41, '0821.01.26', '083898622772', 'SRI WIJI / 000195702 /', 61, 'Mau nambahin advice dari dokter, biar ga banyak cppt', NULL, 'approved', 42, '2026-07-21 19:03:18', '2026-07-21 23:06:03'),
(5, 'Suci Wulandari', 15, 40, '0631.07.24', '083808138729', '195702 tn. Sri Wiji', 62, 'Hapus evaluasi', NULL, 'approved', 71, '2026-07-22 08:22:15', '2026-07-22 08:24:40'),
(6, 'dr reza SpAn', 15, 36, '0014.05.19', NULL, '195665', 63, 'buka resgister karena belum mmebuat from aff cvc dan ektubasi .', NULL, 'approved', 42, '2026-07-22 19:16:03', '2026-07-23 18:13:15'),
(7, 'Yudha', 69, 41, NULL, NULL, NULL, 62, 'Test', NULL, 'approved', 71, '2026-07-23 07:39:37', '2026-07-30 00:36:33'),
(8, 'TANTI', 14, 40, '0852.06.26', NULL, 'RAYYAN (000193904 )', 62, 'ADA TAMBAHAN', NULL, 'approved', 46, '2026-07-23 07:40:37', '2026-07-23 07:41:06'),
(9, 'leni marliani', 15, 41, '0705.04.25', '-', '000195734', 61, 'ada yang salah', NULL, 'approved', 46, '2026-07-23 11:41:41', '2026-07-23 11:44:38'),
(10, 'nurul rizki', 15, 41, '0350.06.21', '087885551828', '195784', 61, 'ada yg salah', NULL, 'approved', 43, '2026-07-23 18:11:28', '2026-07-23 18:20:42'),
(11, 'nurul rizki', 15, 41, '0350.06.21', NULL, '195784', 61, 'ada yang mau diperbaiki', NULL, 'approved', 43, '2026-07-23 18:12:04', '2026-07-23 18:20:48'),
(12, 'Siti Yulianti', 15, 36, '0821.01.26', '083898622772', 'YATNA / 000072908', 62, 'Mau ubah jam eval', NULL, 'approved', 71, '2026-07-25 00:09:47', '2026-07-30 00:35:50'),
(13, 'vira cahya wulandari', 14, 36, '18801.01.26', '0895402326738', '195705/ an.NAWAL PRABU LUMBAINI', 62, 'belum menghitung balance cairan', 'bukti_dukung/1784970169_WhatsApp Image 2026-07-25 at 16.01.50.jpeg', 'approved', 43, '2026-07-25 02:02:49', '2026-07-25 06:05:41'),
(14, 'vira cahya wulandari', 14, 36, '18801.01.26', '0895402326738', '195705/ an.NAWAL PRABU LUMBAINI', 62, 'belum menghitung balance cairan', 'bukti_dukung/1784970170_WhatsApp Image 2026-07-25 at 16.01.50.jpeg', 'approved', 43, '2026-07-25 02:02:50', '2026-07-25 06:06:05'),
(15, 'vira cahya wulandari', 14, 36, '18801.01.26', '0895402326738', '195705/ an.NAWAL PRABU LUMBAINI', 62, 'belum menghitung balance cairan', 'bukti_dukung/1784970171_WhatsApp Image 2026-07-25 at 16.01.50.jpeg', 'approved', 43, '2026-07-25 02:02:51', '2026-07-25 06:05:58'),
(16, 'vira cahya wulandari', 14, 36, '18801.01.26', '0895402326738', '195705/ an.NAWAL PRABU LUMBAINI', 62, 'belum menghitung balance cairan', 'bukti_dukung/1784970172_WhatsApp Image 2026-07-25 at 16.01.50.jpeg', 'approved', 43, '2026-07-25 02:02:52', '2026-07-25 06:05:50'),
(17, 'vira cahya wulandari', 14, 36, '18801.01.26', '0895402326738', '195705/ an.NAWAL PRABU LUMBAINI', 62, 'belum menghitung balance cairan', 'bukti_dukung/1784970172_WhatsApp Image 2026-07-25 at 16.01.50.jpeg', 'approved', 43, '2026-07-25 02:02:52', '2026-07-25 03:15:13'),
(18, 'tiara syalwa', 14, 40, NULL, '203', 'nawal prabu lumbaini (195705)', 62, 'ingin buka eval karna ada salah input data', NULL, 'approved', 43, '2026-07-25 05:57:29', '2026-07-25 06:05:02'),
(19, 'vira cahya wulandari', 14, 39, '18801.01.26', '0895402326738', '195705/ an.NAWAL PRABU LUMBAINI', 62, 'menghitung balance cairan salah', NULL, 'approved', 43, '2026-07-25 06:15:19', '2026-07-25 23:50:16'),
(20, 'tiara syalwa', 14, 36, NULL, '203', 'rayyan arqasya elzayn (193904)', 62, 'ingin buka eval karna ada kesalahan input data', NULL, 'approved', 43, '2026-07-25 22:22:21', '2026-07-25 23:50:32'),
(21, 'Dania ramadanti', 20, 40, NULL, '405', 'By Ny Heni Handayani', 65, 'Salah penulisan jenis kelamin bayi', NULL, 'approved', 43, '2026-07-26 07:33:02', '2026-07-26 07:41:49'),
(22, 'dr Febrina', 20, 40, '0321.01.21', '0853-2000-5150', 'BY NY RINI / 000195951', 66, 'salah jenis kelamin', 'bukti_dukung/1785167821_Screenshot 2026-07-27 224339.png', 'approved', 71, '2026-07-27 08:57:01', '2026-07-30 00:36:25'),
(23, 'dr. Febrina', 20, 40, '0321.01.21', '0853-2000-5150', 'BY NY RINI / 000195951', 66, 'jenis kelamin salah', 'bukti_dukung/1785167943_Screenshot 2026-07-27 225553.png', 'approved', 71, '2026-07-27 08:59:03', '2026-07-30 00:36:17'),
(24, 'Yani Fitriyani', 23, 36, NULL, '083871899000', 'Suhepi Sekar (151325)', 65, 'Hapus assessment awal keperawatan suhepi Sekar/151325', NULL, 'approved', 46, '2026-07-27 20:55:16', '2026-07-27 21:10:30'),
(25, 'Putri andini', 17, 40, '0661.11.24', NULL, '195995', 65, 'Hapus cppt dan ass awal, karna salah down score', 'bukti_dukung/1785243923_C2DEBB41-8BAE-4C14-A767-D688639A4A13.jpeg', 'approved', 71, '2026-07-28 06:05:23', '2026-07-30 00:36:01'),
(26, 'Putri Andini', 17, 40, '0661.11.24', NULL, '195995', 65, 'Hapus ass awal dan cppt karna salah ketik down score', NULL, 'approved', 71, '2026-07-28 06:06:17', '2026-07-30 00:35:42'),
(27, 'Adella resyananda putri', 23, 36, NULL, NULL, 'Suhepi sekar / 151325', 61, 'belum mencatat data subjektif', NULL, 'approved', 71, '2026-07-29 03:21:14', '2026-07-30 00:35:28'),
(28, 'Iis Aliya Rahmah', 22, 41, '0844.04.26', '306', '165350 / Siti Fatimah', 62, 'salah menutup, harusnya pasien pulang', NULL, 'approved', 71, '2026-07-29 18:29:13', '2026-07-30 00:35:16'),
(29, 'ririn sapera', 9, 36, NULL, NULL, 'NUR HALIPA / 000195847', 65, 'salah diagnosa', NULL, 'approved', 46, '2026-07-29 22:53:38', '2026-07-29 22:54:55'),
(30, 'ririn sapera', 9, 36, NULL, NULL, 'NUR HALIPA / 000195847', 62, 'buka evaluasi', NULL, 'approved', 71, '2026-07-30 01:08:30', '2026-07-30 01:11:17'),
(31, 'ririn sapera', 9, 36, NULL, NULL, 'BY NY NUR HALIPA / 000196067', 64, 'hapus status neonatus karna tidak klik bayi kembar', NULL, 'approved', 71, '2026-07-30 01:16:22', '2026-07-30 01:16:45'),
(32, 'Suci Wulandari', 15, 41, '0631.07.24', '083808128729', '195974', 62, 'Hapus evaluasi', NULL, 'approved', 70, '2026-07-30 16:25:20', '2026-07-30 16:30:27'),
(33, 'iis sumiyati', 15, 41, '-', '-', '196037', 61, 'ada yang perlu di tambahkan untuk di cppt', NULL, 'approved', 43, '2026-07-30 17:53:06', '2026-07-31 22:58:58'),
(34, 'WIDYA', 15, 41, NULL, NULL, '68393/HERRU MORENTS NGE', 61, 'mau menambahkan di asessment ulang', NULL, 'approved', 43, '2026-07-30 17:54:10', '2026-07-30 17:58:00'),
(35, 'WIDYA', 15, 41, NULL, NULL, '68393/HERRU MORENTS NGE', 61, 'menambahkan assessment ulang', NULL, 'approved', 43, '2026-07-30 17:54:52', '2026-07-31 22:58:48'),
(36, 'nur ain mutiyani', 15, 36, '0696.03.25', '-', 'NERIN BIN TAJID / 000196037', 61, 'hapus cppt salah ajam', NULL, 'approved', 43, '2026-07-30 18:58:31', '2026-07-31 22:59:07'),
(37, 'nur ain mutiyani', 15, 36, '0696.03.25', '-', 'MURDAN / 000195974', 62, 'edit evaluasi mengubah tulsan 25cm menjadi 23cm', NULL, 'approved', 42, '2026-07-30 19:16:58', '2026-07-31 03:40:34'),
(38, 'nur ain mutiyani', 15, 36, '0696.03.25', '-', 'MURDAN / 000195974', 63, 'Buka regist untuk Revisi edit kesalahan isi eval', NULL, 'approved', 43, '2026-07-30 19:23:12', '2026-07-30 19:24:44');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_harians`
--

CREATE TABLE `laporan_harians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `shift_id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `teknisi_id` bigint(20) UNSIGNED NOT NULL,
  `faktor_masalah_id` bigint(20) UNSIGNED NOT NULL,
  `status_tiket_id` bigint(20) UNSIGNED NOT NULL,
  `teknisi_penerima_id` bigint(20) UNSIGNED DEFAULT NULL,
  `masalah` text NOT NULL,
  `nama_pelapor` varchar(255) NOT NULL,
  `tindak_lanjut` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporan_harians`
--

INSERT INTO `laporan_harians` (`id`, `tanggal`, `shift_id`, `unit_id`, `teknisi_id`, `faktor_masalah_id`, `status_tiket_id`, `teknisi_penerima_id`, `masalah`, `nama_pelapor`, `tindak_lanjut`, `created_at`, `updated_at`) VALUES
(1, '2026-07-20', 36, 2, 42, 51, 49, NULL, 'Kertas tersangkut di dalam printer', 'Yosi', '-', '2026-07-19 22:05:19', '2026-07-19 22:05:19'),
(2, '2026-07-20', 36, 28, 42, 51, 49, NULL, 'Tidak bisa print', 'Bu Rika', '-', '2026-07-19 22:05:51', '2026-07-19 22:05:51'),
(3, '2026-07-20', 36, 3, 42, 51, 49, NULL, 'Laptop ns belakang stuck logo', 'Yunime', '-', '2026-07-19 22:06:39', '2026-07-19 22:06:39'),
(4, '2026-07-20', 36, 3, 42, 51, 49, NULL, 'Komputer EX Jantung mati', 'Resti', '-', '2026-07-19 22:09:07', '2026-07-19 22:09:07'),
(5, '2026-07-20', 36, 1, 42, 51, 49, NULL, 'Printer bermasalah print terus', 'Tiara', '-', '2026-07-19 22:09:44', '2026-07-19 22:09:44'),
(6, '2026-07-20', 36, 3, 42, 51, 49, NULL, 'Printer tersangkut kertas', 'Kikin', '-', '2026-07-19 22:10:11', '2026-07-19 22:10:11'),
(7, '2026-07-20', 36, 68, 42, 53, 49, NULL, 'Alur Terapi Wicara', 'Sutik', '-', '2026-07-19 23:12:30', '2026-07-19 23:12:30'),
(9, '2026-07-21', 36, 20, 42, 61, 49, NULL, 'Permintaan: salah resep', 'wardiah', '-', '2026-07-20 19:45:29', '2026-07-20 19:45:29'),
(10, '2026-07-22', 41, 15, 42, 62, 49, NULL, 'Permintaan: ada implementasi yang belum di masukan', 'iis sumiyati', '-', '2026-07-21 18:39:26', '2026-07-21 18:39:26'),
(11, '2026-07-22', 41, 15, 42, 61, 49, NULL, 'Permintaan: Mau nambahin advice dari dokter, biar ga banyak cppt', 'Siti Yullianti', '-', '2026-07-21 23:06:03', '2026-07-21 23:06:03'),
(12, '2026-07-22', 38, 14, 71, 61, 49, NULL, 'Permintaan: test', 'Test', '-', '2026-07-22 08:05:24', '2026-07-22 08:05:24'),
(13, '2026-07-22', 40, 15, 71, 62, 49, NULL, 'Permintaan: Hapus evaluasi', 'Suci Wulandari', '-', '2026-07-22 08:24:40', '2026-07-22 08:24:40'),
(14, '2026-07-23', 41, 2, 46, 50, 49, NULL, 'Pc Pendaftaran lemot', 'Harfan', '-', '2026-07-23 07:35:13', '2026-07-23 07:35:13'),
(15, '2026-07-23', 40, 14, 46, 62, 49, NULL, 'Permintaan: ADA TAMBAHAN', 'TANTI', '-', '2026-07-23 07:41:06', '2026-07-23 07:41:06'),
(16, '2026-07-23', 41, 15, 46, 61, 49, NULL, 'Permintaan: ada yang salah', 'leni marliani', '-', '2026-07-23 11:44:38', '2026-07-23 11:44:38'),
(17, '2026-07-23', 41, 21, 46, 53, 49, NULL, 'Hapus Cppt', 'Juwita', '-', '2026-07-23 15:36:37', '2026-07-23 15:36:37'),
(18, '2026-07-23', 41, 15, 46, 53, 49, NULL, 'Salah menggunakan akun saat input cppt dokter', 'dr.Jaga Ruangan', 'Hapus CPPT', '2026-07-23 15:40:30', '2026-07-23 15:40:30'),
(19, '2026-07-23', 41, 15, 46, 53, 49, NULL, 'Salah Menggunakan akun saat input cppt dokter', 'dr.Jaga Ruangan', 'Hapus CPPT', '2026-07-23 15:41:46', '2026-07-23 15:41:46'),
(20, '2026-07-23', 41, 15, 46, 53, 49, NULL, 'Salah Menggunakan akun saat input cppt dokter', 'dr.Jaga Ruangan', 'Hapus CPPT', '2026-07-23 15:42:12', '2026-07-23 15:42:12'),
(21, '2026-07-23', 41, 3, 46, 51, 49, NULL, 'menyalakan semua tv display poliklinik', 'IT', '-', '2026-07-23 15:44:02', '2026-07-23 15:44:02'),
(22, '2026-07-24', 36, 15, 42, 63, 49, NULL, 'Permintaan: buka resgister karena belum mmebuat from aff cvc dan ektubasi .', 'dr reza SpAn', '-', '2026-07-23 18:13:15', '2026-07-23 18:13:15'),
(23, '2026-07-24', 41, 15, 43, 61, 49, NULL, 'Permintaan: ada yg salah', 'nurul rizki', '-', '2026-07-23 18:20:42', '2026-07-23 18:20:42'),
(24, '2026-07-24', 41, 15, 43, 61, 49, NULL, 'Permintaan: ada yang mau diperbaiki', 'nurul rizki', '-', '2026-07-23 18:20:48', '2026-07-23 18:20:48'),
(25, '2026-07-24', 41, 9, 46, 53, 49, NULL, 'Kesalahan input diagnosa dan jam pada assesmen awal keperawatan', 'Ririn', 'Hapus Askep awal', '2026-07-24 15:13:21', '2026-07-24 15:13:21'),
(26, '2026-07-24', 41, 18, 46, 51, 49, NULL, 'Komputer ngefreeze', 'Dewi', 'Restart Komputer', '2026-07-24 15:16:25', '2026-07-24 15:16:25'),
(27, '2026-07-25', 36, 14, 43, 62, 49, NULL, 'Permintaan: belum menghitung balance cairan', 'vira cahya wulandari', '-', '2026-07-25 03:15:13', '2026-07-25 03:15:13'),
(28, '2026-07-25', 40, 14, 43, 62, 49, NULL, 'Permintaan: ingin buka eval karna ada salah input data', 'tiara syalwa', '-', '2026-07-25 06:05:02', '2026-07-25 06:05:02'),
(29, '2026-07-25', 36, 14, 43, 62, 49, NULL, 'Permintaan: belum menghitung balance cairan', 'vira cahya wulandari', '-', '2026-07-25 06:05:42', '2026-07-25 06:05:42'),
(30, '2026-07-25', 36, 14, 43, 62, 49, NULL, 'Permintaan: belum menghitung balance cairan', 'vira cahya wulandari', '-', '2026-07-25 06:05:50', '2026-07-25 06:05:50'),
(31, '2026-07-25', 36, 14, 43, 62, 49, NULL, 'Permintaan: belum menghitung balance cairan', 'vira cahya wulandari', '-', '2026-07-25 06:05:58', '2026-07-25 06:05:58'),
(32, '2026-07-25', 36, 14, 43, 62, 49, NULL, 'Permintaan: belum menghitung balance cairan', 'vira cahya wulandari', '-', '2026-07-25 06:06:05', '2026-07-25 06:06:05'),
(33, '2026-07-25', 40, 15, 43, 53, 49, NULL, 'HAPUS EVAL REQBY SITI YULIANTI', 'SITI YULIANTI', 'HAPUS EVAL', '2026-07-25 06:50:43', '2026-07-25 06:50:43'),
(34, '2026-07-25', 40, 14, 43, 53, 49, NULL, 'HAPUS EVAL REQBY VIRA', 'VIRA', 'HAPUS EVAL', '2026-07-25 06:52:41', '2026-07-25 06:52:41'),
(35, '2026-07-25', 40, 14, 43, 53, 49, NULL, 'HAPUS EVAL REQBY VIRA', 'VIRA', 'HAPUS EVAL', '2026-07-25 06:52:42', '2026-07-25 06:52:42'),
(36, '2026-07-25', 40, 14, 43, 53, 49, NULL, 'HAPUS EVAL REQBY VIRA', 'VIRA', 'HAPUS EVAL', '2026-07-25 06:52:42', '2026-07-25 06:52:42'),
(37, '2026-07-25', 40, 1, 43, 53, 49, NULL, 'BUKA REGIST REQBY dr sera', 'dr sera', 'buka regist', '2026-07-25 06:54:03', '2026-07-25 06:54:03'),
(38, '2026-07-25', 40, 1, 43, 53, 49, NULL, 'HAPUS ASMED dr sera', 'dr sera', 'hapus asmed', '2026-07-25 06:54:50', '2026-07-25 06:54:50'),
(39, '2026-07-25', 40, 22, 43, 53, 49, NULL, 'HAPUS OBAT', 'USWATUN', 'REPORT NUHA', '2026-07-25 06:55:43', '2026-07-25 06:55:43'),
(40, '2026-07-26', 39, 14, 43, 62, 49, NULL, 'Permintaan: menghitung balance cairan salah', 'vira cahya wulandari', '-', '2026-07-25 23:50:16', '2026-07-25 23:50:16'),
(41, '2026-07-26', 36, 14, 43, 62, 49, NULL, 'Permintaan: ingin buka eval karna ada kesalahan input data', 'tiara syalwa', '-', '2026-07-25 23:50:32', '2026-07-25 23:50:32'),
(42, '2026-07-26', 40, 20, 43, 65, 49, NULL, 'Permintaan: Salah penulisan jenis kelamin bayi', 'Dania ramadanti', '-', '2026-07-26 07:41:50', '2026-07-26 07:41:50'),
(43, '2026-07-28', 36, 23, 46, 65, 49, NULL, 'Permintaan: Hapus assessment awal keperawatan suhepi Sekar/151325', 'Yani Fitriyani', '-', '2026-07-27 21:10:31', '2026-07-27 21:10:31'),
(44, '2026-07-30', 36, 9, 46, 65, 49, NULL, 'Permintaan: salah diagnosa', 'ririn sapera', '-', '2026-07-29 22:54:55', '2026-07-29 22:54:55'),
(45, '2026-07-30', 41, 22, 71, 62, 49, NULL, 'Permintaan: salah menutup, harusnya pasien pulang', 'Iis Aliya Rahmah', '-', '2026-07-30 00:35:16', '2026-07-30 00:35:16'),
(46, '2026-07-30', 36, 23, 71, 61, 49, NULL, 'Permintaan: belum mencatat data subjektif', 'Adella resyananda putri', '-', '2026-07-30 00:35:28', '2026-07-30 00:35:28'),
(47, '2026-07-30', 40, 17, 71, 65, 49, NULL, 'Permintaan: Hapus ass awal dan cppt karna salah ketik down score', 'Putri Andini', '-', '2026-07-30 00:35:42', '2026-07-30 00:35:42'),
(48, '2026-07-30', 36, 15, 71, 62, 49, NULL, 'Permintaan: Mau ubah jam eval', 'Siti Yulianti', '-', '2026-07-30 00:35:50', '2026-07-30 00:35:50'),
(49, '2026-07-30', 40, 17, 71, 65, 49, NULL, 'Permintaan: Hapus cppt dan ass awal, karna salah down score', 'Putri andini', '-', '2026-07-30 00:36:01', '2026-07-30 00:36:01'),
(50, '2026-07-30', 40, 20, 71, 66, 49, NULL, 'Permintaan: jenis kelamin salah', 'dr. Febrina', '-', '2026-07-30 00:36:17', '2026-07-30 00:36:17'),
(51, '2026-07-30', 40, 20, 71, 66, 49, NULL, 'Permintaan: salah jenis kelamin', 'dr Febrina', '-', '2026-07-30 00:36:25', '2026-07-30 00:36:25'),
(52, '2026-07-30', 41, 69, 71, 62, 49, NULL, 'Permintaan: Test', 'Yudha', '-', '2026-07-30 00:36:33', '2026-07-30 00:36:33'),
(53, '2026-07-30', 36, 9, 71, 62, 49, NULL, 'Permintaan: buka evaluasi', 'ririn sapera', '-', '2026-07-30 01:11:17', '2026-07-30 01:11:17'),
(54, '2026-07-30', 36, 9, 71, 64, 49, NULL, 'Permintaan: hapus status neonatus karna tidak klik bayi kembar', 'ririn sapera', '-', '2026-07-30 01:16:45', '2026-07-30 01:16:45'),
(55, '2026-07-30', 41, 15, 70, 62, 49, NULL, 'Permintaan: Hapus evaluasi', 'Suci Wulandari', '-', '2026-07-30 16:30:27', '2026-07-30 16:30:27'),
(56, '2026-07-31', 41, 15, 43, 61, 49, NULL, 'Permintaan: mau menambahkan di asessment ulang', 'WIDYA', '-', '2026-07-30 17:58:00', '2026-07-30 17:58:00'),
(57, '2026-07-31', 36, 15, 43, 63, 49, NULL, 'Permintaan: Buka regist untuk Revisi edit kesalahan isi eval', 'nur ain mutiyani', '-', '2026-07-30 19:24:44', '2026-07-30 19:24:44'),
(58, '2026-07-31', 36, 15, 42, 62, 49, NULL, 'Permintaan: edit evaluasi mengubah tulsan 25cm menjadi 23cm', 'nur ain mutiyani', '-', '2026-07-31 03:40:34', '2026-07-31 03:40:34'),
(59, '2026-08-01', 41, 15, 43, 61, 49, NULL, 'Permintaan: menambahkan assessment ulang', 'WIDYA', '-', '2026-07-31 22:58:49', '2026-07-31 22:58:49'),
(60, '2026-08-01', 41, 15, 43, 61, 49, NULL, 'Permintaan: ada yang perlu di tambahkan untuk di cppt', 'iis sumiyati', '-', '2026-07-31 22:58:58', '2026-07-31 22:58:58'),
(61, '2026-08-01', 36, 15, 43, 61, 49, NULL, 'Permintaan: hapus cppt salah ajam', 'nur ain mutiyani', '-', '2026-07-31 22:59:07', '2026-07-31 22:59:07'),
(62, '2026-08-01', 41, 9, 46, 53, 49, NULL, 'Hapus Eval IGD', 'Ririn', '-', '2026-08-01 13:46:54', '2026-08-01 13:46:54'),
(63, '2026-08-01', 41, 9, 46, 53, 49, NULL, 'Hapus asmed igd karna salah input diagnosa dan lainnya', 'Ririn', 'hapus asmed', '2026-08-01 13:48:24', '2026-08-01 13:48:24'),
(64, '2026-08-01', 41, 9, 46, 53, 49, NULL, 'kesalahan input askep awal', 'Ririn', 'Hapus Askep awal', '2026-08-01 13:49:07', '2026-08-01 13:49:07'),
(65, '2026-08-01', 41, 15, 46, 53, 49, NULL, 'salah input eval', 'riska', 'HAPUS EVAL', '2026-08-01 13:50:09', '2026-08-01 13:51:28'),
(66, '2026-08-01', 41, 14, 46, 53, 49, NULL, 'salah klik tgl pada daftar rencana pemberian obat', 'vira', 'request Nuha untuk disesuaikan', '2026-08-01 13:53:46', '2026-08-01 17:22:30'),
(67, '2026-08-01', 41, 22, 46, 52, 49, NULL, 'google chrome tidak bisa di close', 'Siti badriah', 'done', '2026-08-01 13:56:49', '2026-08-01 13:56:49'),
(68, '2026-08-02', 41, 73, 46, 53, 49, NULL, 'Salah input asesmen ulang', 'dr Anastasya', 'Hapus CPPT', '2026-08-02 15:50:08', '2026-08-02 15:50:08'),
(69, '2026-08-02', 41, 22, 46, 53, 49, NULL, 'salah input askep ulang', 'Siti Badriah', 'Hapus CPPT', '2026-08-02 15:50:58', '2026-08-02 15:50:58'),
(70, '2026-08-02', 41, 15, 46, 50, 49, NULL, 'Tidak ada koneksi internet di komputer', 'Siti Yulianti', 'Enable Disable Ethernet/cabut colok LAN', '2026-08-02 15:53:03', '2026-08-02 15:53:03');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_kerusakan`
--

CREATE TABLE `laporan_kerusakan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `asset_id` bigint(20) UNSIGNED NOT NULL,
  `deskripsi_kerusakan` text NOT NULL,
  `foto_bukti` varchar(255) DEFAULT NULL,
  `rekomendasi` enum('service','beli_baru') NOT NULL,
  `alasan_rekomendasi` text NOT NULL,
  `estimasi_biaya` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_mappings`
--

CREATE TABLE `master_mappings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_mappings`
--

INSERT INTO `master_mappings` (`id`, `type`, `name`, `created_at`, `updated_at`) VALUES
(1, 'unit', 'IGD', '2026-07-19 21:54:11', '2026-07-19 21:54:11'),
(2, 'unit', 'Pendaftaran', '2026-07-19 21:54:16', '2026-07-19 21:54:16'),
(3, 'unit', 'Poliklinik', '2026-07-19 21:54:22', '2026-07-19 21:54:22'),
(4, 'unit', 'Farmasi Rawat Jalan', '2026-07-19 21:54:31', '2026-07-19 21:54:31'),
(5, 'unit', 'Gudang Farmasi', '2026-07-19 21:54:42', '2026-07-19 21:54:42'),
(6, 'unit', 'Kasir', '2026-07-19 21:54:47', '2026-07-19 21:54:47'),
(7, 'unit', 'Laboratorium', '2026-07-19 21:54:52', '2026-07-19 21:54:52'),
(8, 'unit', 'Radiologi', '2026-07-19 21:54:56', '2026-07-19 21:54:56'),
(9, 'unit', 'VK / Kamar Bersalin', '2026-07-19 21:55:04', '2026-07-19 21:55:04'),
(10, 'unit', 'Gudang Logistik', '2026-07-19 21:55:12', '2026-07-19 21:55:12'),
(11, 'unit', 'Gizi', '2026-07-19 21:55:15', '2026-07-19 21:55:15'),
(12, 'unit', 'Security', '2026-07-19 21:55:21', '2026-07-19 21:55:21'),
(13, 'unit', 'Maintenance', '2026-07-19 21:55:26', '2026-07-19 21:55:26'),
(14, 'unit', 'RPA', '2026-07-19 21:55:30', '2026-07-19 21:55:30'),
(15, 'unit', 'ICU', '2026-07-19 21:55:33', '2026-07-19 21:55:33'),
(16, 'unit', 'Farmas Rawat Inap', '2026-07-19 21:55:41', '2026-07-19 21:55:41'),
(17, 'unit', 'Neonatologi', '2026-07-19 21:55:49', '2026-07-19 21:55:49'),
(18, 'unit', 'Kamar Operasi', '2026-07-19 21:55:54', '2026-07-19 21:55:54'),
(19, 'unit', 'CSSD', '2026-07-19 21:55:58', '2026-07-19 21:55:58'),
(20, 'unit', 'RPK', '2026-07-19 21:56:03', '2026-07-19 21:56:03'),
(21, 'unit', 'RPU B', '2026-07-19 21:56:08', '2026-07-19 21:56:08'),
(22, 'unit', 'RPU A', '2026-07-19 21:56:13', '2026-07-19 21:56:13'),
(23, 'unit', 'RPU A Bedah', '2026-07-19 21:56:18', '2026-07-19 21:56:18'),
(24, 'unit', 'Marketing', '2026-07-19 21:56:30', '2026-07-19 21:56:30'),
(25, 'unit', 'Kesling', '2026-07-19 21:56:36', '2026-07-19 21:56:36'),
(26, 'unit', 'PPI', '2026-07-19 21:56:44', '2026-07-19 21:56:44'),
(27, 'unit', 'ATEM', '2026-07-19 21:56:47', '2026-07-19 21:56:47'),
(28, 'unit', 'HRD', '2026-07-19 21:56:50', '2026-07-19 21:56:50'),
(29, 'unit', 'Casemix', '2026-07-19 21:56:55', '2026-07-19 21:56:55'),
(30, 'unit', 'Keuangan', '2026-07-19 21:56:59', '2026-07-19 21:56:59'),
(31, 'unit', 'Penunjang Medis', '2026-07-19 21:57:09', '2026-07-19 21:57:09'),
(32, 'unit', 'Rekam Medis', '2026-07-19 21:57:24', '2026-07-19 21:57:24'),
(33, 'unit', 'Manager Keperawatan', '2026-07-19 21:57:33', '2026-07-19 21:57:33'),
(34, 'unit', 'SPV', '2026-07-19 21:57:36', '2026-07-19 21:57:36'),
(35, 'unit', 'Dokter Manager', '2026-07-19 21:57:50', '2026-07-19 21:57:50'),
(36, 'shift', 'Shift Pagi ( 07:00 - 15:00 WIB )', '2026-07-19 21:58:17', '2026-07-19 21:58:17'),
(38, 'shift', 'Shift Pagi ( 08:00 - 16:00 WIB )', '2026-07-19 21:58:46', '2026-07-19 21:58:46'),
(39, 'shift', 'Shift Pagi ( 07:00 - 14:00 WIB )', '2026-07-19 21:59:00', '2026-07-19 21:59:00'),
(40, 'shift', 'Shift Siang ( 14:00 - 21:00 WIB )', '2026-07-19 21:59:18', '2026-07-19 21:59:18'),
(41, 'shift', 'Shift Malam ( 21:00 - 07:00 WIB )', '2026-07-19 21:59:38', '2026-07-19 21:59:38'),
(42, 'teknisi', 'Muhamad Fikri Ramadhon, S.Kom', '2026-07-19 21:59:59', '2026-07-19 21:59:59'),
(43, 'teknisi', 'Vino Abdullah, S.Kom', '2026-07-19 22:00:11', '2026-07-19 22:00:11'),
(46, 'teknisi', 'Yudha Wastu Pratama, S.Kom', '2026-07-19 22:00:59', '2026-07-19 22:00:59'),
(47, 'status_tiket', 'Oper Shift', '2026-07-19 22:01:14', '2026-07-19 22:01:14'),
(48, 'status_tiket', 'Pending', '2026-07-19 22:01:21', '2026-07-19 22:01:21'),
(49, 'status_tiket', 'Solve', '2026-07-19 22:01:28', '2026-07-19 22:01:28'),
(50, 'faktor_masalah', 'Jaringan', '2026-07-19 22:01:35', '2026-07-19 22:01:35'),
(51, 'faktor_masalah', 'Hardware', '2026-07-19 22:01:43', '2026-07-19 22:01:43'),
(52, 'faktor_masalah', 'Software', '2026-07-19 22:01:51', '2026-07-19 22:01:51'),
(53, 'faktor_masalah', 'Sistem', '2026-07-19 22:02:05', '2026-07-19 22:02:05'),
(54, 'jenis_perangkat', 'CPU', '2026-07-19 22:02:16', '2026-07-19 22:02:16'),
(55, 'jenis_perangkat', 'Printer', '2026-07-19 22:02:22', '2026-07-19 22:02:22'),
(56, 'jenis_perangkat', 'Monitor', '2026-07-19 22:02:33', '2026-07-19 22:02:33'),
(57, 'jenis_perangkat', 'Laptop', '2026-07-19 22:02:47', '2026-07-19 22:02:47'),
(58, 'jenis_perangkat', 'Tablet', '2026-07-19 22:02:57', '2026-07-19 22:02:57'),
(59, 'kondisi', 'GOOD - Normal', '2026-07-19 22:03:12', '2026-07-19 22:03:12'),
(60, 'kondisi', 'DAMAGED - Rusak', '2026-07-19 22:03:23', '2026-07-19 22:03:23'),
(61, 'jenis_permintaan', 'Hapus CPPT', '2026-07-19 22:03:34', '2026-07-19 22:03:34'),
(62, 'jenis_permintaan', 'Hapus Evaluasi', '2026-07-19 22:03:41', '2026-07-19 22:03:41'),
(63, 'jenis_permintaan', 'Buka Regis', '2026-07-19 22:03:49', '2026-07-19 22:03:49'),
(64, 'jenis_permintaan', 'Tutup Regis', '2026-07-19 22:03:56', '2026-07-19 22:03:56'),
(65, 'jenis_permintaan', 'Hapus Asesmen Awal Keperawatan', '2026-07-19 22:04:06', '2026-07-19 22:04:06'),
(66, 'jenis_permintaan', 'Hapus Asesmen Awal Medis', '2026-07-19 22:04:16', '2026-07-19 22:04:16'),
(67, 'unit', 'Fisioterapi', '2026-07-19 23:11:48', '2026-07-19 23:11:48'),
(68, 'unit', 'Terapi Wicara', '2026-07-19 23:11:55', '2026-07-19 23:11:55'),
(69, 'unit', 'IT', '2026-07-19 23:14:05', '2026-07-19 23:14:05'),
(70, 'teknisi', 'M. Ryan Andika, S.Kom', '2026-07-19 23:24:04', '2026-07-19 23:24:04'),
(71, 'teknisi', 'Eko Nopiyanto Nugroho, S.Kom', '2026-07-20 00:59:57', '2026-07-20 00:59:57'),
(72, 'jenis_perangkat', 'CHARGER LAPTOP', '2026-07-22 23:16:48', '2026-07-22 23:16:48'),
(73, 'unit', 'Dokter Ruangan', '2026-08-02 15:49:21', '2026-08-02 15:49:21');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_07_09_170640_create_master_mappings_table', 1),
(5, '2026_07_09_174758_create_laporan_harians_table', 1),
(6, '2026_07_09_180404_create_assets_table', 1),
(7, '2026_07_10_114432_create_schedules_table', 1),
(8, '2026_07_12_111910_create_form_permintaan_perubahans_table', 1),
(9, '2026_07_12_125937_alter_form_permintaan_perubahan_add_unit_id', 1),
(10, '2026_07_13_161918_add_shift_id_to_form_permintaan_perubahans_table', 1),
(11, '2026_07_14_110703_create_laporan_kerusakans_table', 1),
(12, '2026_07_18_145018_permintaan_hak_akses', 1),
(13, '2026_07_20_124556_drop_bagian_unit_from_form_permintaan_perubahans_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_hak_akses`
--

CREATE TABLE `permintaan_hak_akses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `nik_penduduk` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `unit` varchar(255) NOT NULL,
  `lulusan` varchar(255) NOT NULL,
  `no_str` varchar(255) NOT NULL,
  `tgl_terbit_str` date NOT NULL,
  `no_sip` varchar(255) DEFAULT NULL,
  `tgl_terbit_sip` date DEFAULT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `hp_whatsapp` varchar(255) NOT NULL,
  `alamat_ktp` text NOT NULL,
  `pendidikan` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permintaan_hak_akses`
--

INSERT INTO `permintaan_hak_akses` (`id`, `nama_lengkap`, `nik_penduduk`, `tempat_lahir`, `tanggal_lahir`, `unit`, `lulusan`, `no_str`, `tgl_terbit_str`, `no_sip`, `tgl_terbit_sip`, `nip`, `hp_whatsapp`, `alamat_ktp`, `pendidikan`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Fitri Hartanti', '3671085102030008', 'Tangerang', '2003-11-02', 'RPA', 'Universitas Cendikia Abditama', 'MS00002009208082', '2025-12-12', 'B/400.7.22.2/2349/VII - DPMPTSP/2026', '2026-07-12', '0852.06.26', '081929600960', 'Taman Kota Permai 2', 'DIII Keperawatan', 'fitrihartanti82@gmail.com', '2026-07-22 00:49:24', '2026-07-23 20:28:43');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teknisi_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `shift` varchar(5) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('4AuSxWoXDqupzVhsuAOHYxaFXmn8uVOx9f5HQ8TN', 1, '172.16.103.102', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiZFlhV1JSVzI4R1VLb3dkMldabkN4NmVDTG0xbVhNa0NzeHpFNGFFSCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM5OiJodHRwOi8vMTcyLjE2LjEwMy4xOTU6ODAxMi9hc3NldC9jcmVhdGUiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzg1NDY0MDc2O319', 1785464097),
('6wQLPGPi6LG5SIsBf01mJZcnqknUslqqSg2KCBEX', NULL, '172.16.103.102', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiZndwdUF1Z0d1cXNaVkE1eXk5N0locldqYjV0ZHdTNjFQYmVoVk1zQiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785463346),
('9wC3C756OJRLtkGYRieCMH3MFNM0PhN3xGxXynNm', 2, '172.16.103.102', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiWUx3eDF0ekVaR1R2WjRaMnBjWDgzTHE5T0ZsV2M5UFFCakpRaTVDOSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM5OiJodHRwOi8vMTcyLjE2LjEwMy4xOTU6ODAxMi9hc3NldC9jcmVhdGUiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzg1NDYzMjMwO319', 1785463233),
('DsPo7ddvbDmlJZFExsmBff6KQfMoTqj8gK6tnII6', 1, '172.16.103.102', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiOGd6RVRUT1E1a0c3YURtVGhpcXBzZno3b25kRWg3cGdCN0NaMjFGRSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vMTcyLjE2LjEwMy4xOTU6ODAxMi9ob21lIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTc4NTQ2NDAxNTt9fQ==', 1785464029),
('gjTsAEnv5FtmdCWZ5lTxGoINZqOadiZbIS57pa6N', 1, '172.16.103.102', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiZGtzcVJramF3c3gwVzQwOGhDWjByUlkxUmRvZzhUUHJMajdUN3dqcCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM5OiJodHRwOi8vMTcyLjE2LjEwMy4xOTU6ODAxMi9hc3NldC9jcmVhdGUiO3M6NToicm91dGUiO047fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzg1NDYzNDcxO319', 1785463474),
('HQQ3cHPlfbFs4lTbMKwS2CiOA8VIKkaKW5So1TJu', NULL, '172.16.103.102', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiUVVVRERyVExIdkd4NGFYRnFrSGh5M1QybVZwV3FYYzNlTTh1QzJzWCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785463510),
('hR4BHgT4AzuYMhvL7HCAe2O1x3VJFoeJyj5AfzWf', NULL, '172.16.103.254', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSTdWSjFZN25ZcEgwZTRBaHZMTm51dEI3S1BacElkanhQU25pZlFIMCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMDMuMTg3LjE2Mi4xMDY6NTg3MC9mb3JtLXBlcnViYWhhbiI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785459292),
('hYpxxsY2QpVB1xg44IrNJJjQijUnXFeyQfRoY33y', 2, '172.16.103.102', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiVlU5eVJ6UFZPamo4SDM2WENJbnp5M2JPQ1IyMGxINTNVN0ZVYkVCaSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjMyOiJodHRwOi8vMTcyLjE2LjEwMy4xOTU6ODAxMi9hc3NldCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3ODU0NjM0MTE7fX0=', 1785463442),
('IYJDvzf8ZZ1RETWsY4IOlwaE1IftCwatG03sQ2VH', NULL, '172.16.103.102', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoibENqc2Mwb3FwMlhxd0FhZVI5M0pqTDZDeU16dkpTZ2NjWmNtTkZOcSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785463850),
('kmAXvVIiugTJn6PH1PbdnLs6Pog6qeMbtTnuspDG', 2, '172.16.103.102', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiRlRQb1hxV1BPQmFPNWh1ZnNua04zSGs5aURrZ0dWRmRBTncwaTRzdSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjU1OiJodHRwOi8vMTcyLjE2LjEwMy4xOTU6ODAxMi9mb3JtLXBlcm1pbnRhYW4taW5kZXg/cGFnZT0xIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTc4NTcxOTg0OTt9fQ==', 1785719949),
('LE5RWqwyU0q1xz5PVPwXUsrbXpVm8apDDbaDqKXD', 2, '172.16.103.102', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiaW1HVXJvMnRJY0hkVlk3MThIM1R2aW81ODRicVlRRDAzdkRVN0RjSiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjQ0OiJodHRwOi8vMTcyLjE2LjEwMy4xOTU6ODAxMi9sYXBvcmFuLWtlcnVzYWthbiI7czo1OiJyb3V0ZSI7czoyMzoibGFwb3Jhbi1rZXJ1c2FrYW4uaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTc4NTQ2NDIzNTt9fQ==', 1785464281),
('n3PlY8WJSN8VIr02pUTfFnz1SIb6fQmtimOoJW7J', 2, '172.16.103.102', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiNzVlQ1JiR2tpSE1KSFlrc1JnZVFoNVFZN2d6bE81QjY5QnBPejBDRCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM0OiJodHRwOi8vMTcyLjE2LjEwMy4xOTU6ODAxMi9sYXBvcmFuIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTc4NTcxMDg4Mzt9fQ==', 1785711183),
('NxfYBr9vzmsUZpiAvvLnLDhUIB8AQVjQBOSZZZvb', NULL, '172.16.103.22', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiM05USGU1MTl0U2ZKbVVTSjN5dHUzN3lpcUM3T3pUWWM0ZW9RRmhXTiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNjoiaHR0cDovLzE3Mi4xNi4xMDMuMTk1OjgwMTIiO31zOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czozMjoiaHR0cDovLzE3Mi4xNi4xMDMuMTk1OjgwMTIvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1785463482),
('qEs2X0vxdtZQJvnlEcIQB4FznkI2s6L0o4VXeSTq', NULL, '172.16.103.102', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOVJaaERHM2lqbThmQXUwbXFYV1dLZFc3bDFaSmptNFpsWVlLZTRyOCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MzoiaHR0cDovLzE3Mi4xNi4xMDMuMTk1OjgwMTIvbGFwb3Jhbi1oYW5kb3ZlciI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjMyOiJodHRwOi8vMTcyLjE2LjEwMy4xOTU6ODAxMi9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785464284),
('revkdkCzumrCw9JQWBxnkeEXwp7q1FaMpxecpmJt', NULL, '172.16.103.254', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaDFlQU43ZUI5VjJZRlJ1OUZ4REtIbE1RQ05FbEFqNUZSU1JYaWdrOCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMDMuMTg3LjE2Mi4xMDY6NTg3MC9mb3JtLXBlcnViYWhhbiI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785464219),
('uM1BPu8HJ8Nq2UjmCv69usQ05qVQphSrm2lMKAEb', NULL, '172.16.103.102', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoieGFWbDZNN3h0a1RXVWNyRHJBaWp2dDdsRVE5RGMxOGNHTnhFUmUxcyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785463306),
('uUhYwodZfXSQapEqhr9pYi0m5AN4d134m1XhwkcL', 1, '172.16.103.102', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiOWQ2UHZBbEtMbjZMMFo3azhkUEMxbjVqRVNZVXVPd1oxRU55anIxNyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjMyOiJodHRwOi8vMTcyLjE2LjEwMy4xOTU6ODAxMi9hc3NldCI7czo1OiJyb3V0ZSI7czoxMToiYXNzZXQuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTc4NTQ2NDE5Mjt9fQ==', 1785464221),
('xiHiL3ifw2WtFn2RmyRtNUGnG9ovlAnnv6Am1hRr', 2, '172.16.103.102', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiSlhKblpaUFRGUjY0Nno5a3NKMnFkbzQ4RHpxTmZ0MVhQZmh5Y3kzcSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjI2OiJodHRwOi8vMTcyLjE2LjEwMy4xOTU6ODAxMiI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3ODU0NTQxODM7fX0=', 1785463090),
('XyJwEBuTMdTba4Smt1hGHex5op2FYmYenk1Fkin4', 1, '172.16.103.102', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiTXZwNUN3djJJMFpBVGdXNFBzd0FoNVV0M3FZRjgwSWFPYU8zWHU2ZSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM5OiJodHRwOi8vMTcyLjE2LjEwMy4xOTU6ODAxMi9hc3NldC9jcmVhdGUiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzg1NDYzODE4O319', 1785463823),
('yHsF7w8RbRvtCtDjIxhVsvVwZSS4Q93sSrYnQ5JR', 2, '172.16.103.102', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiT3RiRkc3Y2hkdlhJdk95em5FazMwRWhBRmRDWGlPY1l5WUhDNHd2QSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM5OiJodHRwOi8vMTcyLjE2LjEwMy4xOTU6ODAxMi9hc3NldC9jcmVhdGUiO3M6NToicm91dGUiO047fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzg1NDYzMzE2O319', 1785463317),
('yUxV8cEW1Tk7WQHrQtkhYDgALTdkq2mdYRvP2Uer', NULL, '172.16.103.254', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicUtQYmx2cUkyblB0WVRVT3F0aUcxWll3d1NTT05zZkJ1RWl3QUZ3eiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMDMuMTg3LjE2Mi4xMDY6NTg3MC9mb3JtLXBlcnViYWhhbiI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785719836),
('ZNKPoBtEuEolorLbbxShvKY3PJ90Cx6txqIqNmiu', 1, '172.16.103.22', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiMjNhem5rQjNvME9FMzE1ZUFlMjFSOHM5QnhnZ2JGMHNoMjZiM0tKciI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NjU6Imh0dHA6Ly8xNzIuMTYuMTAzLjE5NTo4MDEyL2xhcG9yYW4vZXhwb3J0LXBkZj9idWxhbj0wNyZ0YWh1bj0yMDI2IjtzOjU6InJvdXRlIjtzOjE4OiJsYXBvcmFuLmV4cG9ydC5wZGYiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YTowOnt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3ODU2OTAxMDA7fX0=', 1785690360);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Utama', 'admin@perusahaan.com', NULL, '$2y$12$sTbDA/pIy9BZG7R0B2g/9eRSwTcj8WV8/BWr4NnGfTEFMneksCUlC', NULL, '2026-07-19 21:52:05', '2026-07-19 21:52:05'),
(2, 'IT RS Mitra Husada', 'itrsmh25@gmail.com', NULL, '$2y$12$SP60GzNVPgbqmfbPKxQgr.IQUXPo6OKGmIjrUQ/8tS.nH6fpcyq06', NULL, '2026-07-19 21:54:00', '2026-07-19 21:54:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `assets_kode_aset_unique` (`kode_aset`),
  ADD KEY `assets_jenis_perangkat_id_foreign` (`jenis_perangkat_id`),
  ADD KEY `assets_kondisi_id_foreign` (`kondisi_id`),
  ADD KEY `assets_unit_id_foreign` (`unit_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `form_permintaan_perubahans`
--
ALTER TABLE `form_permintaan_perubahans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `form_permintaan_perubahans_jenis_permintaan_id_foreign` (`jenis_permintaan_id`),
  ADD KEY `form_permintaan_perubahans_teknisi_id_foreign` (`teknisi_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan_harians`
--
ALTER TABLE `laporan_harians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laporan_harians_shift_id_foreign` (`shift_id`),
  ADD KEY `laporan_harians_unit_id_foreign` (`unit_id`),
  ADD KEY `laporan_harians_teknisi_id_foreign` (`teknisi_id`),
  ADD KEY `laporan_harians_faktor_masalah_id_foreign` (`faktor_masalah_id`),
  ADD KEY `laporan_harians_status_tiket_id_foreign` (`status_tiket_id`),
  ADD KEY `laporan_harians_teknisi_penerima_id_foreign` (`teknisi_penerima_id`);

--
-- Indexes for table `laporan_kerusakan`
--
ALTER TABLE `laporan_kerusakan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laporan_kerusakan_asset_id_foreign` (`asset_id`);

--
-- Indexes for table `master_mappings`
--
ALTER TABLE `master_mappings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permintaan_hak_akses`
--
ALTER TABLE `permintaan_hak_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `schedules_teknisi_id_date_unique` (`teknisi_id`,`date`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form_permintaan_perubahans`
--
ALTER TABLE `form_permintaan_perubahans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporan_harians`
--
ALTER TABLE `laporan_harians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `laporan_kerusakan`
--
ALTER TABLE `laporan_kerusakan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_mappings`
--
ALTER TABLE `master_mappings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `permintaan_hak_akses`
--
ALTER TABLE `permintaan_hak_akses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assets`
--
ALTER TABLE `assets`
  ADD CONSTRAINT `assets_jenis_perangkat_id_foreign` FOREIGN KEY (`jenis_perangkat_id`) REFERENCES `master_mappings` (`id`),
  ADD CONSTRAINT `assets_kondisi_id_foreign` FOREIGN KEY (`kondisi_id`) REFERENCES `master_mappings` (`id`),
  ADD CONSTRAINT `assets_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `master_mappings` (`id`);

--
-- Constraints for table `form_permintaan_perubahans`
--
ALTER TABLE `form_permintaan_perubahans`
  ADD CONSTRAINT `form_permintaan_perubahans_jenis_permintaan_id_foreign` FOREIGN KEY (`jenis_permintaan_id`) REFERENCES `master_mappings` (`id`),
  ADD CONSTRAINT `form_permintaan_perubahans_teknisi_id_foreign` FOREIGN KEY (`teknisi_id`) REFERENCES `master_mappings` (`id`);

--
-- Constraints for table `laporan_harians`
--
ALTER TABLE `laporan_harians`
  ADD CONSTRAINT `laporan_harians_faktor_masalah_id_foreign` FOREIGN KEY (`faktor_masalah_id`) REFERENCES `master_mappings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `laporan_harians_shift_id_foreign` FOREIGN KEY (`shift_id`) REFERENCES `master_mappings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `laporan_harians_status_tiket_id_foreign` FOREIGN KEY (`status_tiket_id`) REFERENCES `master_mappings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `laporan_harians_teknisi_id_foreign` FOREIGN KEY (`teknisi_id`) REFERENCES `master_mappings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `laporan_harians_teknisi_penerima_id_foreign` FOREIGN KEY (`teknisi_penerima_id`) REFERENCES `master_mappings` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `laporan_harians_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `master_mappings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `laporan_kerusakan`
--
ALTER TABLE `laporan_kerusakan`
  ADD CONSTRAINT `laporan_kerusakan_asset_id_foreign` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`);

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_teknisi_id_foreign` FOREIGN KEY (`teknisi_id`) REFERENCES `master_mappings` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
