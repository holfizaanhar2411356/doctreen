-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2026 at 12:30 PM
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
-- Database: `doct`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kontak` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `keluhan`
--

CREATE TABLE `keluhan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `id_petani` bigint(20) UNSIGNED NOT NULL,
  `id_tanaman` bigint(20) UNSIGNED DEFAULT NULL,
  `judul_keluhan` varchar(255) NOT NULL,
  `isi_keluhan` text NOT NULL,
  `foto_kendala` varchar(255) DEFAULT NULL,
  `tanggal_keluhan` date NOT NULL,
  `status` enum('pending_payment','baru','sedang_berjalan','selesai') DEFAULT 'pending_payment',
  `last_resolved_at` timestamp NULL DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `ulasan` text DEFAULT NULL,
  `metode_bayar` varchar(255) DEFAULT NULL,
  `snap_token_konsultasi` varchar(255) DEFAULT NULL,
  `order_id_konsultasi` varchar(255) DEFAULT NULL,
  `payment_type_konsultasi` varchar(255) DEFAULT NULL,
  `midtrans_status_konsultasi` varchar(255) DEFAULT NULL,
  `status_bayar_konsultasi` varchar(255) NOT NULL DEFAULT 'menunggu',
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `keluhan`
--

INSERT INTO `keluhan` (`id`, `parent_id`, `id_petani`, `id_tanaman`, `judul_keluhan`, `isi_keluhan`, `foto_kendala`, `tanggal_keluhan`, `status`, `last_resolved_at`, `rating`, `ulasan`, `metode_bayar`, `snap_token_konsultasi`, `order_id_konsultasi`, `payment_type_konsultasi`, `midtrans_status_konsultasi`, `status_bayar_konsultasi`, `bukti_bayar`, `created_at`, `updated_at`) VALUES
(16, NULL, 6, NULL, 'jdjdjd', 'd', 'keluhan/n2udg0NVGBacQpoGo8aR0pfx5xD6UqOFozCRplrq.jpg', '2026-05-27', 'baru', NULL, NULL, NULL, 'Transfer Bank', '9bd69dfc-8fa1-4311-8ff3-06284f330a7a', 'DOCTREEN-KONSUL-16-1779901189', NULL, NULL, 'menunggu', NULL, '2026-05-27 09:59:48', '2026-05-27 09:59:51'),
(22, NULL, 1, NULL, 'daun kuning', 'fhhhhh', 'keluhan/KLyKkGAD04jU3Wc3WH5aS0Rl38XnDba1fV1JUtdE.jpg', '2026-05-29', 'baru', NULL, 5, 'j', 'Bank transfer', '88e256f8-9620-4fa9-8ef1-df0f323acecd', 'DOCTREEN-KONSUL-22-1780091595', NULL, 'expire', 'gagal', NULL, '2026-05-29 14:24:08', '2026-05-29 14:53:21');

-- --------------------------------------------------------

--
-- Table structure for table `konsultan`
--

CREATE TABLE `konsultan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `keahlian` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'verifikasi',
  `alamat` text DEFAULT NULL,
  `telepon` varchar(50) DEFAULT NULL,
  `tarif_konsultasi` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `foto_profil` varchar(255) DEFAULT NULL,
  `dokumen_tipe` varchar(100) DEFAULT NULL,
  `dokumen_path` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `konsultan`
--

INSERT INTO `konsultan` (`id`, `user_id`, `nama`, `keahlian`, `status`, `alamat`, `telepon`, `tarif_konsultasi`, `created_at`, `updated_at`, `foto_profil`, `dokumen_tipe`, `dokumen_path`) VALUES
(2, 5, 'za', 'padi', 'aktif', 'kkw', NULL, 25000, '2026-05-09 00:30:56', '2026-05-28 07:35:37', 'profil/x5zvN5i73jLFTKL43A4bJcDEWkzp2F0coLow9ABO.jpg', 'Portofolio', 'konsultan_documents/PWtPageNQwG4s2Ps7Wnw447hL0QosKeKImFcalSp.pdf'),
(3, 7, 'Maya Sari', 'jagung', 'aktif', NULL, NULL, 23000, '2026-05-16 04:34:48', '2026-05-16 04:47:36', NULL, NULL, NULL),
(4, 16, 'holfiza', 'jagung', 'aktif', NULL, NULL, 17000, '2026-05-19 05:41:25', '2026-05-26 08:53:41', 'avatar/NDOwa0MmVA6lch3MqGAoxqDTicGAnke6V6mtEeSo.png', NULL, 'konsultan_documents/RuZKzwPOAIDSjFcmCB6TQYOtMH8U4Qf10f8VxolB.pdf'),
(5, 17, 'Holfiza Anhar', 'ssss', 'verifikasi', NULL, NULL, 26000, '2026-05-21 10:49:13', '2026-05-23 04:54:38', NULL, 'Portofolio', 'konsultan_documents/AndsFdxlHO1Unns8o50OgeAkvbdN2znmlMbIXvGn.pdf'),
(6, 18, 'Holfiza Anhar', 'ssss', 'verifikasi', NULL, NULL, 8000, '2026-05-21 11:16:18', '2026-05-23 04:57:00', NULL, 'Portofolio', 'konsultan_documents/tdaC4dS3iBFJ0U55eHBZugNEjoQoHf72uZnEouWT.docx'),
(9, 24, 'holfiza anhar', 'maling jambu', 'verifikasi', NULL, NULL, 13000, '2026-05-27 10:04:35', '2026-05-27 10:06:35', NULL, 'Portofolio/Sertifikat', 'konsultan_documents/sfuMdmoRo7fFG6NrUi9u0MGyfSCgkLaOAiZxRmk6.docx'),
(11, 26, 'za', 'maling jambu', 'verifikasi', NULL, NULL, 5000, '2026-05-27 19:29:37', '2026-05-27 19:29:37', NULL, 'Portofolio/Sertifikat', '[\"konsultan_documents\\/r3Ky34qp3Gnxq6ocLNNL8BdtKjUg4LDmAWOgzkkE.pdf\"]');

-- --------------------------------------------------------

--
-- Table structure for table `konsultasi`
--

CREATE TABLE `konsultasi` (
  `id_konsultasi` bigint(20) UNSIGNED NOT NULL,
  `id_konsultan` bigint(20) UNSIGNED DEFAULT NULL,
  `id_keluhan` bigint(20) UNSIGNED NOT NULL,
  `tanggal_konsultasi` date DEFAULT NULL,
  `catatan_konsultasi` text DEFAULT NULL,
  `diagnosa` varchar(255) DEFAULT NULL,
  `rekomendasi` varchar(255) DEFAULT NULL,
  `status` enum('menunggu','proses','selesai') NOT NULL DEFAULT 'menunggu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `konsultasi`
--

INSERT INTO `konsultasi` (`id_konsultasi`, `id_konsultan`, `id_keluhan`, `tanggal_konsultasi`, `catatan_konsultasi`, `diagnosa`, `rekomendasi`, `status`, `created_at`, `updated_at`) VALUES
(16, 2, 16, '2026-05-27', NULL, NULL, NULL, 'menunggu', '2026-05-27 09:59:48', '2026-05-27 09:59:48'),
(21, 2, 22, '2026-05-29', 's', 'sggg', 's', 'proses', '2026-05-29 14:24:08', '2026-05-29 14:53:14');

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
(20, '2026_05_24_120000_add_added_by_to_tanaman_table', 1),
(21, '2026_05_24_132857_add_rating_and_ulasan_to_keluhan_table', 2),
(22, '2026_05_24_153700_add_midtrans_columns_to_keluhan_table', 3),
(23, '2026_05_24_153600_add_midtrans_columns_to_pesanan_table', 4),
(24, '2026_05_28_140250_add_needs_password_reset_to_users_table', 5),
(25, '2026_05_29_211919_add_parent_id_to_keluhan_table', 6),
(27, '2026_05_30_095133_add_last_resolved_at_to_keluhan_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('holfiza2602@gmail.com', '$2y$12$JEqkDhlmHLPvpy15vb8v/uq7jYXxrMhTHrFJcp8B.VZRj7AAJYWdC', '2026-05-28 08:20:51'),
('holfizaanhar@gmail.com', '$2y$12$Khw7ETXtH.VPnd17YLXg9Ou.ihXlAkZqSqaYPmvrJGmIr0aeMvW.a', '2026-05-21 02:14:54');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_petani` bigint(20) UNSIGNED NOT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `id_toko` int(11) DEFAULT NULL,
  `nama_produk` varchar(255) DEFAULT NULL,
  `kuantitas` int(11) NOT NULL DEFAULT 1,
  `tanggal_pesan` datetime NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `metode_kirim` varchar(255) NOT NULL,
  `metode_bayar` varchar(255) DEFAULT NULL,
  `status_bayar` enum('menunggu','lunas','batal') DEFAULT 'menunggu',
  `snap_token` varchar(255) DEFAULT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `midtrans_status` varchar(255) DEFAULT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `id_petani`, `id_produk`, `id_toko`, `nama_produk`, `kuantitas`, `tanggal_pesan`, `total_harga`, `metode_kirim`, `metode_bayar`, `status_bayar`, `snap_token`, `order_id`, `payment_type`, `midtrans_status`, `bukti_bayar`, `created_at`, `updated_at`) VALUES
(14, 6, 5, 4, 'banzai', 2, '2026-05-27 00:00:00', 66.00, 'JNE', 'Transfer Bank', 'menunggu', '6aaf1341-c7f1-44b0-81f6-5d3b065f248b', 'DOCTREEN-PRODUK-14-1779901261', NULL, NULL, NULL, '2026-05-27 10:01:00', '2026-05-27 10:01:03'),
(15, 1, 5, 4, 'banzai', 1, '2026-05-28 00:00:00', 33.00, 'JNE', 'Transfer Bank', 'menunggu', '62221aa6-3869-4257-ad37-032b49d69e15', 'DOCTREEN-PRODUK-15-1779981882', NULL, NULL, NULL, '2026-05-28 08:24:41', '2026-05-28 08:24:44'),
(16, 1, 5, 4, 'banzai', 2, '2026-05-28 00:00:00', 66.00, 'JNE', 'Transfer Bank', 'menunggu', '9eae09b2-7083-4075-a091-112dd33fc776', 'DOCTREEN-PRODUK-16-1779982783', NULL, NULL, NULL, '2026-05-28 08:39:42', '2026-05-28 08:39:45'),
(17, 1, 5, 4, 'banzai', 1, '2026-05-28 00:00:00', 33.00, 'JNE', 'Transfer Bank', 'menunggu', 'be0c2539-04db-4542-8a43-ae1321193755', 'DOCTREEN-PRODUK-17-1779985055', NULL, NULL, NULL, '2026-05-28 09:17:34', '2026-05-28 09:17:36'),
(18, 1, 5, 4, 'banzai', 1, '2026-05-29 00:00:00', 33.00, 'JNE', 'Transfer Bank', 'menunggu', NULL, NULL, NULL, NULL, NULL, '2026-05-29 15:03:59', '2026-05-29 15:03:59');

-- --------------------------------------------------------

--
-- Table structure for table `petani`
--

CREATE TABLE `petani` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `daerah` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `foto_profil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `petani`
--

INSERT INTO `petani` (`id`, `user_id`, `nama`, `daerah`, `created_at`, `updated_at`, `foto_profil`) VALUES
(1, 3, 'za', 'jawa', '2026-05-09 00:06:39', '2026-05-21 09:35:29', 'avatar/ZqJqDiIX89koWAfCpTGXlK48A59sHLWCbz9Q4reg.jpg'),
(2, 6, 'Holfiza Anhar', 'jawa', '2026-05-16 04:05:32', '2026-05-16 04:05:32', NULL),
(3, 9, 'Holfiza Anhar', 'jawa', '2026-05-16 05:02:45', '2026-05-21 09:35:02', 'avatar/xaQylsQrBR4pqwF2dLRCP8aTWln1AtFVUu0VMZJS.jpg'),
(4, 13, 'holfiza', 'jawa', '2026-05-18 08:25:53', '2026-05-21 09:34:47', 'avatar/MSw5TcYTp2k3zykfiuFIUF2zkOOhJpbhkPKvgkQW.png'),
(5, 19, 'zahra', 'bogor,jawa barat', '2026-05-24 07:21:06', '2026-05-24 07:21:32', 'profil/FRWE7j7DS1OxUYFMokshzjapyNUIVWtXGBMjM5fF.png'),
(6, 23, 'holfiz', 'jawa', '2026-05-27 09:58:57', '2026-05-27 10:00:28', 'profil/cRxKp8U6GiHPHqQJ35sijiBSZLysLEgH8JiszZAZ.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_toko` bigint(20) UNSIGNED NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `harga` decimal(10,2) NOT NULL DEFAULT 0.00,
  `deskripsi` text DEFAULT NULL,
  `foto_produk` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `id_toko`, `nama_produk`, `kategori`, `stok`, `harga`, `deskripsi`, `foto_produk`, `created_at`, `updated_at`) VALUES
(5, 4, 'banzai', 'k', 18, 33.00, 'kkkk', 'produk/VEaylXaCZ95VS3iCC0I3AOKd0Sz9hF0otYJJsNfu.jpg', '2026-05-27 01:04:57', '2026-05-29 15:03:59');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat`
--

CREATE TABLE `riwayat` (
  `id_riwayat` bigint(20) UNSIGNED NOT NULL,
  `id_keluhan` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal_waktu` datetime NOT NULL,
  `tipe_interaksi` varchar(255) NOT NULL,
  `masalah` text DEFAULT NULL,
  `tindakan` text DEFAULT NULL,
  `nama_petani` varchar(255) DEFAULT NULL,
  `nama_konsultan` varchar(255) DEFAULT NULL,
  `ulasan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `riwayat`
--

INSERT INTO `riwayat` (`id_riwayat`, `id_keluhan`, `tanggal_waktu`, `tipe_interaksi`, `masalah`, `tindakan`, `nama_petani`, `nama_konsultan`, `ulasan`) VALUES
(6, 15, '2026-05-27 14:34:43', 'Konsultasi Online', 'ks', 'anjay aja', 'za', 'za', NULL),
(7, 20, '2026-05-28 15:55:04', 'Konsultasi Online', 'jdjdjd', 'jjjj', 'za', 'za', NULL),
(8, 21, '2026-05-28 15:55:35', 'Konsultasi Online', 'daun kuning', 'ffff', 'za', 'za', NULL),
(9, 21, '2026-05-28 15:59:32', 'Konsultasi Online', 'daun kuning', 'ffff', 'za', 'za', NULL),
(10, 22, '2026-05-29 21:27:17', 'Konsultasi Online', 'daun kuning', 's', 'za', 'za', NULL),
(11, 22, '2026-05-29 21:50:28', 'Konsultasi Online', 'daun kuning', 's', 'za', 'za', NULL);

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

-- --------------------------------------------------------

--
-- Table structure for table `tanaman`
--

CREATE TABLE `tanaman` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_tanaman` varchar(255) NOT NULL,
  `nama_latin` varchar(255) DEFAULT NULL,
  `jenis_tanaman` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `foto_tanaman` varchar(255) DEFAULT NULL,
  `metode_perawatan` text DEFAULT NULL,
  `protokol_pengobatan` text DEFAULT NULL,
  `ancaman_hama` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`ancaman_hama`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `added_by` varchar(255) DEFAULT 'Admin Doctreen'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tanaman`
--

INSERT INTO `tanaman` (`id`, `nama_tanaman`, `nama_latin`, `jenis_tanaman`, `deskripsi`, `foto_tanaman`, `metode_perawatan`, `protokol_pengobatan`, `ancaman_hama`, `created_at`, `updated_at`, `added_by`) VALUES
(65, 'Cabai Rawit', 'Capsicum frutescens', 'Palawija', 'j', 'tanaman/DzxBKnUlNp8KhulVPe0gNElOKoWrDz65AFstWxXw.jpg', 'hh', 'h', '[\"h\",\"j\",\"j\"]', '2026-05-28 04:21:45', '2026-05-28 04:21:45', 'Konsultan za'),
(66, ',', ',', 'Pangan', '.', 'tanaman/gk5tKZKOx0PcU28dppktQH2eGVaaKuuzmS6Ws79K.jpg', ';', ';', '[\"l\",\"l\",\"l\"]', '2026-05-28 06:03:14', '2026-05-28 06:03:14', 'Konsultan za'),
(67, 'Cabai Rawit', 'g', 'Pangan', 'g', 'tanaman/qW1CihUawglvZwbdc7ljZhctCdSbEm9iLVQAhauZ.jpg', NULL, NULL, '[]', '2026-05-28 07:12:25', '2026-05-28 07:12:25', 'Konsultan za'),
(68, 'Cabai Rawit', 'Capsicum frutescens', 'Pangan', 'k', 'tanaman/z3CqC5tLlOBkxc58Ep9ANQKMaEptvQJJaFGjqCN1.png', 'k', 'k', '[]', '2026-05-28 07:50:15', '2026-05-28 07:50:52', 'Konsultan za');

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nama_toko` varchar(255) NOT NULL,
  `alamat` text DEFAULT NULL,
  `status` enum('verifikasi','aktif','nonaktif') NOT NULL DEFAULT 'verifikasi',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `foto_profil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`id`, `user_id`, `nama_toko`, `alamat`, `status`, `created_at`, `updated_at`, `foto_profil`) VALUES
(4, 22, 'kiw', 'jl', 'aktif', '2026-05-27 01:04:21', '2026-05-27 01:06:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `id_ulasan` bigint(20) UNSIGNED NOT NULL,
  `id_konsultasi` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal_ulasan` date NOT NULL,
  `komentar` text DEFAULT NULL,
  `skor_rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ulasan`
--

INSERT INTO `ulasan` (`id_ulasan`, `id_konsultasi`, `tanggal_ulasan`, `komentar`, `skor_rating`) VALUES
(1, 4, '2026-05-24', 'k', 3),
(2, 2, '2026-05-24', ',', 4),
(3, 7, '2026-05-24', 'anjay dikit', 4),
(4, 20, '2026-05-28', 'asek', 5),
(5, 21, '2026-05-29', 'j', 5);

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
  `needs_password_reset` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `telepon` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'petani',
  `foto_profil` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `needs_password_reset`, `remember_token`, `telepon`, `role`, `foto_profil`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', '2026-05-09 00:00:33', '$2y$12$gjF.SexqixvlBFwFQfC9DeLZXzXXEeSg1oK3NSUMOtgX2OPZtUno6', 0, '04fXRQy539', NULL, 'petani', NULL, '2026-05-09 00:00:33', '2026-05-09 00:00:33'),
(2, 'Admin doctreen', 'admin@doctreen.com', NULL, '$2y$12$jAiBdYd1iwhZ87WdqxONzOH039S1sQxNDOqhQr7/v8hGKD03rpaSy', 0, NULL, '08123456789', 'admin', NULL, '2026-05-09 00:00:33', '2026-05-09 00:00:33'),
(3, 'za', 'holfiza2602@gmail.com', NULL, '$2y$12$Eq3uiJheCXXoaP21F0lno.PjMuGoLF9G70gTheDW5zDezO2xabZxS', 0, NULL, '0987867857295', 'petani', 'avatar/ZqJqDiIX89koWAfCpTGXlK48A59sHLWCbz9Q4reg.jpg', '2026-05-09 00:06:39', '2026-05-21 12:44:48'),
(5, 'za', 'holfiza202@upi.edu', NULL, '$2y$12$tj3HYg1JIvrTw4izB2vxFO1GCk86gL6RFf64DznHBIa8gzQddJolK', 0, NULL, '0987867857295', 'konsultan', 'profil/x5zvN5i73jLFTKL43A4bJcDEWkzp2F0coLow9ABO.jpg', '2026-05-09 00:30:56', '2026-05-28 07:35:37'),
(6, 'Holfiza Anhar', 'holfiza262@gmail.com', NULL, '$2y$12$GXTlUyCU15J2d8gEcZi3q.kPizTjuPb7iyvdJA6FUzjQr2L5QSKkW', 0, NULL, '0987867857295', 'petani', NULL, '2026-05-16 04:05:32', '2026-05-16 04:05:32'),
(7, 'Maya Sari', 'maya@gmail.com', NULL, '$2y$12$parRT.auSytUGlhm7SlUH.dIyslxcdKZ4CMHVpWTVSX9Ac7wYp4um', 0, NULL, '0987867857295', 'konsultan', NULL, '2026-05-16 04:34:48', '2026-05-16 04:34:48'),
(8, 'kkkkk', 'holfiza2602@email.com', NULL, '$2y$12$E5rkAMnN4DPFzVhhTsAWNOXXO2j9wApPe3oD/YdtV09jp0/eWjlgO', 0, NULL, '0987867857295', 'toko', NULL, '2026-05-16 04:41:47', '2026-05-16 04:41:47'),
(9, 'Holfiza Anhar', 'holfiza602@gmail.com', NULL, '$2y$12$wa2Gp/DQZ0bWLqyLwmwCMOtSSBDhOAnvsERr.K4hIPU9x5eBcJETC', 0, NULL, '0987867857295', 'petani', NULL, '2026-05-16 05:02:45', '2026-05-16 05:02:45'),
(13, 'holfiza', 'holfiz2602@upi.edu', NULL, '$2y$12$otwTi7ZlCcQuc1o8bm7oIeweqWe.RIxr2y/BoGrOnXsFLWf3CKWLW', 0, NULL, '087876857493', 'petani', NULL, '2026-05-18 08:25:53', '2026-05-18 08:25:53'),
(14, 'kiw', 'holfizaanhar@gmail.com', NULL, '$2y$12$FT6MRbr99t.1rcgeTD4s/O7OJ6jjnMfsB8oxKAflvdIDlPic6qK.m', 0, NULL, '087867576498', 'toko', 'toko_profil/8DD5E5Rn3EQPyzrGTH4bK5x5wnPty31t7el41IHr.png', '2026-05-18 08:47:02', '2026-05-26 08:54:02'),
(15, 'j', 'holfiza2602@upi.ed', NULL, '$2y$12$JUKoNVmYrxCrpYH6dp6MIuzFtkWb0p/qIwK9V7nECp7wNtxIV4cxq', 0, NULL, '0987867857295', 'toko', 'toko_profil/ooGrIfyk4aNK0yjUW1E79cxAoFuoeS9kq6qbL4tK.jpg', '2026-05-18 23:46:13', '2026-05-21 20:16:50'),
(16, 'holfiza', 'holfiza02@upi.edu', NULL, '$2y$12$bzYY1Z/CRHWfMH1KH2M4ruErkMrfAJP3v6ZS7bThg6oIhflaBaSxq', 0, NULL, '0987867857295', 'konsultan', 'avatar/NDOwa0MmVA6lch3MqGAoxqDTicGAnke6V6mtEeSo.png', '2026-05-19 05:41:25', '2026-05-26 08:53:41'),
(17, 'Holfiza Anhar', 'holfizanhar@gmail.com', NULL, '$2y$12$nq4FcY3f8sOSY6nZeQYW.OXkqzU8YS8tN3jxh.WXSESYJDbg5kwcm', 0, NULL, '0987867857295', 'konsultan', NULL, '2026-05-21 10:49:13', '2026-05-21 10:49:13'),
(18, 'Holfiza Anhar', 'holfizaahar@gmail.com', NULL, '$2y$12$/rg0t8VGHyK7GC8QLaDmYujIZKPYS7ix7kSTQn1NhSOnPhRtqNP1u', 0, NULL, '0987867857295', 'konsultan', NULL, '2026-05-21 11:16:18', '2026-05-21 11:16:18'),
(19, 'zahra', 'zara23332@gmail.com', NULL, '$2y$12$o3GXKjLLAAzUUmquMXpQzu6ZKJA3k2FT1uYTvprJub7g2Y/8kcO5y', 0, NULL, '0987867857295', 'petani', 'profil/FRWE7j7DS1OxUYFMokshzjapyNUIVWtXGBMjM5fF.png', '2026-05-24 07:21:06', '2026-05-24 07:21:32'),
(22, 'kiw', 'may@gmail.com', NULL, '$2y$12$7NZCYCc/LPAF7TDXWq.7D.A8.kzH/N4Lz6QFqDRfokIJKUkOGeSAe', 0, NULL, '087867576498', 'toko', 'toko_profil/JeEwvkIoMGUiAnsKDBDb2ayiLSttkXjj24gpk8s8.jpg', '2026-05-27 01:04:21', '2026-05-27 01:04:21'),
(23, 'holfiz', 'holfiza22@gmail.com', NULL, '$2y$12$xDdMCFooYVNX0myS74k2xOdEVpjebD3lUOsY/2h71qCRLo9wuoNFW', 0, NULL, '0987867857295', 'petani', 'profil/cRxKp8U6GiHPHqQJ35sijiBSZLysLEgH8JiszZAZ.jpg', '2026-05-27 09:58:57', '2026-05-27 10:00:28'),
(24, 'holfiza anhar', 'mayaw@gmail.com', NULL, '$2y$12$ITfz9KUhbie4kBWXEgW1jOaUqIrI9xORURZJgNjYLpiINVfuYVO5y', 0, NULL, '0987867857295', 'konsultan', NULL, '2026-05-27 10:04:35', '2026-05-27 10:04:35'),
(26, 'za', 'holfiz260@upi.edu', NULL, '$2y$12$Wy7FCp1dH.AWrPaxyvHAouGxO4tDglUZklLdahQTNi7kU.pCVCuMe', 0, NULL, '087876857493', 'konsultan', NULL, '2026-05-27 19:29:36', '2026-05-27 19:29:36');

-- --------------------------------------------------------

--
-- Table structure for table `video_tanaman`
--

CREATE TABLE `video_tanaman` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_tanaman` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `uploader` enum('admin','konsultan') NOT NULL DEFAULT 'admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `video_tanaman`
--

INSERT INTO `video_tanaman` (`id`, `id_tanaman`, `judul`, `url`, `file_path`, `uploader`, `created_at`, `updated_at`) VALUES
(123, 65, 'Cobit 4.1 IT Maturity Model Assessment -- penilaian tingkat kematangan proses tata kelola TI', NULL, 'videos/8jJUofRipE7MIiMLI7CZO6nCOHLhshhaqUZjupJb.mp4', 'konsultan', '2026-05-28 04:21:45', '2026-05-28 04:21:45'),
(124, 65, 'Panduan Perawatan', 'https://youtu.be/RzU3d7xtsZ4?si=eVPCmUZ3vHh9qu7Y', NULL, 'konsultan', '2026-05-28 04:23:05', '2026-05-28 04:23:05'),
(125, 65, 'Panduan Perawatan', 'https://youtu.be/RzU3d7xtsZ4?si=eVPCmUZ3vHh9qu7Y', NULL, 'konsultan', '2026-05-28 04:23:52', '2026-05-28 04:23:52'),
(126, 65, 'Panduan Perawatan', 'https://youtu.be/RzU3d7xtsZ4?si=eVPCmUZ3vHh9qu7Y', NULL, 'konsultan', '2026-05-28 05:56:05', '2026-05-28 05:56:05'),
(127, 66, 'Panduan Perawatan', 'https://youtu.be/RzU3d7xtsZ4?si=eVPCmUZ3vHh9qu7Y', NULL, 'konsultan', '2026-05-28 06:03:14', '2026-05-28 06:03:14'),
(128, 66, 'holfiza anhar_2411356_Pertemuan 7', NULL, 'videos/lFbJzn4aqf4bD538WcWE2cd004CzlJAVL67Zbrz9.mp4', 'konsultan', '2026-05-28 06:05:47', '2026-05-28 06:05:47'),
(129, 66, 'Panduan Perawatan', 'https://youtu.be/RzU3d7xtsZ4?si=eVPCmUZ3vHh9qu7Y', NULL, 'konsultan', '2026-05-28 06:10:04', '2026-05-28 06:10:04'),
(130, 66, 'Cobit 4.1 IT Maturity Model Assessment -- penilaian tingkat kematangan proses tata kelola TI', 'https://youtu.be/RzU3d7xtsZ4?si=eVPCmUZ3vHh9qu7Y', NULL, 'konsultan', '2026-05-28 06:10:04', '2026-05-28 06:10:04'),
(131, 66, 'Panduan Perawatan', 'https://youtu.be/RzU3d7xtsZ4?si=eVPCmUZ3vHh9qu7Y', NULL, 'konsultan', '2026-05-28 06:10:04', '2026-05-28 06:10:04'),
(132, 66, 'Panduan Perawatan', 'https://youtu.be/RzU3d7xtsZ4?si=eVPCmUZ3vHh9qu7Y', NULL, 'konsultan', '2026-05-28 06:10:04', '2026-05-28 06:10:04'),
(133, 65, 'Panduan Perawatan', 'https://youtu.be/RzU3d7xtsZ4?si=eVPCmUZ3vHh9qu7Y', NULL, 'konsultan', '2026-05-28 06:11:13', '2026-05-28 06:11:13'),
(134, 67, 'Cobit 4.1 IT Maturity Model Assessment -- penilaian tingkat kematangan proses tata kelola TI', 'https://youtu.be/RzU3d7xtsZ4?si=eVPCmUZ3vHh9qu7Y', NULL, 'konsultan', '2026-05-28 07:12:25', '2026-05-28 07:12:25'),
(135, 67, 'Panduan Perawatan', 'https://youtu.be/RzU3d7xtsZ4?si=eVPCmUZ3vHh9qu7Y', NULL, 'admin', '2026-05-28 07:21:07', '2026-05-28 07:21:07'),
(136, 67, 'holfiza anhar_2411356_Pertemuan 7', NULL, 'videos/aLV5cyCWa1fttDUdtuzoy4S5k8IeKGQJSMr0TfFY.mp4', 'admin', '2026-05-28 07:28:00', '2026-05-28 07:28:00'),
(137, 65, 'tugas rpl holfiza anhar', NULL, 'videos/DGvspSq8N0dm12GM97C5hvvQ20OwIao7LqyKj1Gr.mp4', 'admin', '2026-05-28 07:29:35', '2026-05-28 07:29:35'),
(138, 66, 'holfiza anhar_2411356_Pertemuan 7', NULL, 'videos/LipvfeqJAjKouCLbVibXUHCA1vaYFcwZZQBVXRxz.mp4', 'admin', '2026-05-28 07:32:11', '2026-05-28 07:32:11'),
(139, 68, 'Panduan Perawatan', 'https://youtu.be/RzU3d7xtsZ4?si=eVPCmUZ3vHh9qu7Y', NULL, 'konsultan', '2026-05-28 07:50:15', '2026-05-28 07:50:15'),
(140, 68, 'anjay', NULL, 'videos/VdX5UwgnioJX6EA0sg832b5eJLxnIcycqkr4HrQR.mp4', 'konsultan', '2026-05-28 07:50:15', '2026-05-28 07:50:15'),
(141, 68, 'Cobit 4.1 IT Maturity Model Assessment -- penilaian tingkat kematangan proses tata kelola TI', NULL, 'videos/fylwuodvTXtMhTdlv0DkJpuSXulcpxTcf7PDDVIc.mp4', 'konsultan', '2026-05-28 07:50:52', '2026-05-28 07:50:52'),
(142, 68, 'Cobit 4.1 IT Maturity Model Assessment -- penilaian tingkat kematangan proses tata kelola TI', NULL, 'videos/4gaIUAR1BUDx38VxrFUzs7eeUqzeEkYMj80892ZP.mp4', 'konsultan', '2026-05-28 19:21:40', '2026-05-28 19:21:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `admin_username_unique` (`username`),
  ADD UNIQUE KEY `admin_email_unique` (`email`);

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
-- Indexes for table `keluhan`
--
ALTER TABLE `keluhan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `keluhan_order_id_konsultasi_unique` (`order_id_konsultasi`),
  ADD KEY `fk_keluhan_petani` (`id_petani`),
  ADD KEY `fk_keluhan_tanaman` (`id_tanaman`),
  ADD KEY `keluhan_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `konsultan`
--
ALTER TABLE `konsultan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `konsultan_user_id_foreign` (`user_id`);

--
-- Indexes for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD PRIMARY KEY (`id_konsultasi`),
  ADD KEY `fk_konsultasi_konsultan` (`id_konsultan`),
  ADD KEY `fk_konsultasi_keluhan` (`id_keluhan`);

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
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pesanan_order_id_unique` (`order_id`),
  ADD KEY `fk_pesanan_petani` (`id_petani`);

--
-- Indexes for table `petani`
--
ALTER TABLE `petani`
  ADD PRIMARY KEY (`id`),
  ADD KEY `petani_user_id_foreign` (`user_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_produk_toko_idx` (`id_toko`);

--
-- Indexes for table `riwayat`
--
ALTER TABLE `riwayat`
  ADD PRIMARY KEY (`id_riwayat`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tanaman`
--
ALTER TABLE `tanaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id`),
  ADD KEY `toko_user_id_foreign` (`user_id`);

--
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id_ulasan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `video_tanaman`
--
ALTER TABLE `video_tanaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_video_tanaman_id` (`id_tanaman`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keluhan`
--
ALTER TABLE `keluhan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `konsultan`
--
ALTER TABLE `konsultan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `id_konsultasi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `petani`
--
ALTER TABLE `petani`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `riwayat`
--
ALTER TABLE `riwayat`
  MODIFY `id_riwayat` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tanaman`
--
ALTER TABLE `tanaman`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `toko`
--
ALTER TABLE `toko`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id_ulasan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `video_tanaman`
--
ALTER TABLE `video_tanaman`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `keluhan`
--
ALTER TABLE `keluhan`
  ADD CONSTRAINT `fk_keluhan_petani` FOREIGN KEY (`id_petani`) REFERENCES `petani` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_keluhan_tanaman` FOREIGN KEY (`id_tanaman`) REFERENCES `tanaman` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `keluhan_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `keluhan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `konsultan`
--
ALTER TABLE `konsultan`
  ADD CONSTRAINT `konsultan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD CONSTRAINT `fk_konsultasi_keluhan` FOREIGN KEY (`id_keluhan`) REFERENCES `keluhan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_konsultasi_konsultan` FOREIGN KEY (`id_konsultan`) REFERENCES `konsultan` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `fk_pesanan_petani` FOREIGN KEY (`id_petani`) REFERENCES `petani` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `petani`
--
ALTER TABLE `petani`
  ADD CONSTRAINT `petani_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `fk_produk_toko` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `toko`
--
ALTER TABLE `toko`
  ADD CONSTRAINT `toko_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `video_tanaman`
--
ALTER TABLE `video_tanaman`
  ADD CONSTRAINT `fk_video_tanaman_id` FOREIGN KEY (`id_tanaman`) REFERENCES `tanaman` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
