-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 31, 2023 at 06:42 AM
-- Server version: 8.0.33-0ubuntu0.22.04.2
-- PHP Version: 8.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web-a0335`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggotakelompoks`
--

CREATE TABLE `anggotakelompoks` (
  `id` bigint UNSIGNED NOT NULL,
  `kelompok_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0 Tidak Aktif, 1 Aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `anggotakelompoks`
--

INSERT INTO `anggotakelompoks` (`id`, `kelompok_id`, `user_id`, `token`, `status`, `created_at`, `updated_at`) VALUES
(6, 3, 1, 'RUQ6H', '1', '2023-03-22 19:35:21', '2023-03-22 19:35:21'),
(8, 4, 5, 'rB7Oe', '1', '2023-05-23 15:14:23', '2023-05-23 15:14:23');

-- --------------------------------------------------------

--
-- Table structure for table `artefaks`
--

CREATE TABLE `artefaks` (
  `id` bigint UNSIGNED NOT NULL,
  `tugasakhir_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `kelompok_id` bigint UNSIGNED NOT NULL,
  `prodi_id` bigint UNSIGNED NOT NULL,
  `tahun` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bimbingans`
--

CREATE TABLE `bimbingans` (
  `id` bigint UNSIGNED NOT NULL,
  `mahasiswa_id` bigint UNSIGNED NOT NULL,
  `dosen_id` bigint UNSIGNED NOT NULL,
  `waktu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 Proses, 1 Diterima, 2 Ditolak',
  `alasan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dokumenpengujis`
--

CREATE TABLE `dokumenpengujis` (
  `id` bigint UNSIGNED NOT NULL,
  `mahasiswa_id` bigint UNSIGNED NOT NULL,
  `dosen_id` bigint UNSIGNED NOT NULL,
  `tugasakhir_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dokumenproposals`
--

CREATE TABLE `dokumenproposals` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `proposal_id` bigint UNSIGNED NOT NULL,
  `prodi_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dokumentugasakhirs`
--

CREATE TABLE `dokumentugasakhirs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `tugasakhir_id` bigint UNSIGNED NOT NULL,
  `prodi_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dosens`
--

CREATE TABLE `dosens` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `role` enum('Pembimbing','Penguji') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pembimbing',
  `kuota` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dosens`
--

INSERT INTO `dosens` (`id`, `user_id`, `role`, `kuota`, `created_at`, `updated_at`) VALUES
(3, 3, 'Pembimbing', '0', '2023-03-16 08:56:47', '2023-05-23 15:15:47'),
(5, 3, 'Penguji', NULL, '2023-03-19 01:04:27', '2023-03-19 01:04:27'),
(7, 10, 'Penguji', NULL, '2023-05-22 10:19:36', '2023-05-22 10:19:36'),
(8, 10, 'Pembimbing', '0', '2023-05-23 12:05:09', '2023-05-23 15:16:13');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kelompoks`
--

CREATE TABLE `kelompoks` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prodi_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelompoks`
--

INSERT INTO `kelompoks` (`id`, `name`, `prodi_id`, `created_at`, `updated_at`) VALUES
(3, 'Kelompok 1', 1, '2023-03-15 10:35:36', '2023-03-15 10:35:36'),
(4, 'Kelompok 2', 1, '2023-03-15 10:35:48', '2023-03-15 10:35:48');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2023_03_13_143357_create_roles_table', 1),
(5, '2023_03_13_143437_create_prodis_table', 1),
(6, '2023_03_13_175322_create_proposals_table', 2),
(7, '2023_03_14_114611_create_tugasakhirs_table', 3),
(8, '2023_03_14_181053_create_dosens_table', 4),
(9, '2023_03_15_154710_delete_field_dosen_id_in_dosens', 5),
(10, '2023_03_15_154832_add_field_user_id_to_dosens', 6),
(11, '2023_03_15_165004_create_kelompoks_table', 7),
(12, '2023_03_15_165504_create_anggotakelompoks_table', 7),
(13, '2023_03_15_173159_add_field_token_to_anggotakelompoks', 8),
(14, '2023_03_16_134112_create_pengajuanpembimbings_table', 9),
(15, '2023_03_16_171815_create_bimbingans_table', 10),
(18, '2023_03_16_175209_delete_field_status_in_bimbingans', 11),
(19, '2023_03_16_175258_add_field_status_to_bimbingans', 11),
(23, '2023_03_16_182807_create_pengajuanjuduls_table', 12),
(24, '2023_03_17_055849_add_field_kelompok_id_to_tugasakhirs', 13),
(25, '2023_03_17_060036_add_field_kelompok_id_to_proposals', 13),
(26, '2023_03_17_080148_create_artefaks_table', 14),
(27, '2023_03_18_211556_create_pengumumans_table', 15),
(28, '2023_03_19_034849_add_field_alasan_to_pengajuanjuduls', 16),
(29, '2023_03_19_082800_create_dokumenpengujis_table', 17),
(30, '2023_03_19_094502_add_field_status_to_dokumenpengujis', 18),
(31, '2023_03_19_100545_delete_field_status_in_dokumenpengujis', 19),
(32, '2023_03_19_100701_add_field_kirim_to_tugasakhirs', 19),
(33, '2023_03_19_101902_add_field_alasan_to_bimbingans', 20),
(34, '2023_03_19_121843_create_dokumenproposals_table', 21),
(35, '2023_03_19_121905_create_dokumentugasakhirs_table', 21),
(36, '2023_03_27_133141_create_tugas_table', 22),
(37, '2023_03_27_133437_add_field_tugas_id_to_tugasakhirs', 22),
(38, '2023_03_27_141004_add_field_prodi_id_to_tugas', 23),
(39, '2023_03_27_172346_add_field_tugas_id_to_proposals', 24),
(40, '2023_03_27_175104_add_field_status_to_tugas', 25),
(41, '2023_03_27_184904_create_penilaians_table', 26),
(42, '2023_03_27_190222_add_field_kelompok_id_to_penilaians', 27),
(43, '2023_03_27_190448_add_field_prodi_id_to_penilaians', 28),
(44, '2023_03_27_194041_add_field_total_to_penilaians', 29),
(45, '2023_03_30_144405_add_field_prodi_id_to_pengajuanjuduls', 30),
(46, '2023_03_30_144803_delete_field_tugas_id_in_penilaians', 31),
(47, '2023_03_30_144858_add_field_pengajuanjudul_id_to_penilaians', 31),
(48, '2023_03_30_151028_add_field_prodi_id_to_artefaks', 32),
(49, '2023_05_19_213523_add_field_link_jadwal_to_pengumumans', 33),
(50, '2023_05_22_093450_create_nilai_sempros_table', 34),
(51, '2023_05_22_094443_add_field_prodi_id_to_nilai_sempros', 35),
(52, '2023_05_22_094657_add_field_pengajuanjudul_id_to_nilai_sempros', 36),
(53, '2023_05_22_104113_create_nilai_seminars_table', 37),
(54, '2023_05_22_105051_add_field_pengajuanjudul_id_to_nilai_seminars', 38),
(55, '2023_05_22_201348_create_nilai_pembimbings_table', 39),
(56, '2023_05_23_145127_create_nilai_prasidangs_table', 40),
(57, '2023_05_23_145136_create_nilai_sidangs_table', 40),
(59, '2023_05_23_210340_create_nilai_adms_table', 41),
(60, '2023_05_23_223645_create_penilaiantas_table', 42),
(61, '2023_05_24_001145_add_field_nilai_6_to_nilai_pembimbings', 43),
(62, '2023_05_30_011737_add_field_submit_dokumen_to_nilai_adms', 44),
(63, '2023_05_31_031922_add_field_reschedule_to_nilai_adms', 45);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_adms`
--

CREATE TABLE `nilai_adms` (
  `id` bigint UNSIGNED NOT NULL,
  `pengajuanjudul_id` bigint UNSIGNED NOT NULL,
  `mahasiswa_id` bigint UNSIGNED NOT NULL,
  `koordinator_id` bigint UNSIGNED NOT NULL,
  `prodi_id` bigint UNSIGNED NOT NULL,
  `status` enum('TA 1','TA 2') COLLATE utf8mb4_unicode_ci NOT NULL,
  `submit_dokumen_1` enum('ya','tidak') COLLATE utf8mb4_unicode_ci NOT NULL,
  `schedule_1` enum('ya','tidak') COLLATE utf8mb4_unicode_ci NOT NULL,
  `reschedule_1` enum('ya','tidak') COLLATE utf8mb4_unicode_ci NOT NULL,
  `ulang_1` enum('ya','tidak') COLLATE utf8mb4_unicode_ci NOT NULL,
  `submit_dokumen_2` enum('ya','tidak') COLLATE utf8mb4_unicode_ci NOT NULL,
  `schedule_2` enum('ya','tidak') COLLATE utf8mb4_unicode_ci NOT NULL,
  `reschedule_2` enum('ya','tidak') COLLATE utf8mb4_unicode_ci NOT NULL,
  `ulang_2` enum('ya','tidak') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'sempro/prasidang',
  `nilai_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'seminar/sidang',
  `persentase` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `persentase_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_nilai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nilai_adms`
--

INSERT INTO `nilai_adms` (`id`, `pengajuanjudul_id`, `mahasiswa_id`, `koordinator_id`, `prodi_id`, `status`, `submit_dokumen_1`, `schedule_1`, `reschedule_1`, `ulang_1`, `submit_dokumen_2`, `schedule_2`, `reschedule_2`, `ulang_2`, `nilai_1`, `nilai_2`, `persentase`, `persentase_2`, `total_nilai`, `created_at`, `updated_at`) VALUES
(3, 6, 5, 4, 1, 'TA 1', 'ya', 'ya', 'ya', 'ya', 'ya', 'ya', 'ya', 'ya', '83.33', '83.18', '', '', '83.26', '2023-05-23 15:23:41', '2023-05-23 15:23:41'),
(10, 5, 1, 4, 1, 'TA 1', 'ya', 'ya', 'ya', 'tidak', 'ya', 'ya', 'tidak', 'tidak', '90', '90', '90', '89', '80.55', '2023-05-30 21:05:24', '2023-05-30 21:05:24'),
(11, 6, 5, 4, 1, 'TA 2', 'ya', 'ya', 'tidak', 'tidak', 'ya', 'ya', 'tidak', 'tidak', '90', '90', '90', '90', '81', '2023-05-30 21:17:29', '2023-05-30 21:17:29'),
(12, 5, 1, 4, 1, 'TA 2', 'ya', 'ya', 'tidak', 'tidak', 'ya', 'ya', 'tidak', 'tidak', '90', '90', '100', '100', '90', '2023-05-30 21:24:53', '2023-05-30 21:24:53');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_pembimbings`
--

CREATE TABLE `nilai_pembimbings` (
  `id` bigint UNSIGNED NOT NULL,
  `pengajuanjudul_id` bigint UNSIGNED NOT NULL,
  `mahasiswa_id` bigint UNSIGNED NOT NULL,
  `dosen_id` bigint UNSIGNED NOT NULL,
  `prodi_id` bigint UNSIGNED NOT NULL,
  `status` enum('TA 1','TA 2') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_4` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_5` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_6` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai_7` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_nilai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nilai_pembimbings`
--

INSERT INTO `nilai_pembimbings` (`id`, `pengajuanjudul_id`, `mahasiswa_id`, `dosen_id`, `prodi_id`, `status`, `nilai_1`, `nilai_2`, `nilai_3`, `nilai_4`, `nilai_5`, `nilai_6`, `nilai_7`, `total_nilai`, `created_at`, `updated_at`) VALUES
(3, 5, 1, 10, 1, 'TA 1', '80', '82', '70', '77', '81', NULL, NULL, '76.9', '2023-05-23 12:07:13', '2023-05-23 12:07:13'),
(4, 5, 1, 3, 1, 'TA 1', '80', '90', '80', '85', '86', NULL, NULL, '84.35', '2023-05-23 12:09:40', '2023-05-30 23:27:24'),
(5, 6, 5, 10, 1, 'TA 1', '81', '82', '83', '84', '85', NULL, NULL, '82.8', '2023-05-23 15:19:56', '2023-05-23 15:19:56'),
(6, 6, 5, 3, 1, 'TA 1', '82', '82', '88', '85', '82', NULL, NULL, '84.4', '2023-05-23 15:22:39', '2023-05-23 15:22:39'),
(9, 5, 1, 3, 1, 'TA 2', '90', '90', '90', '90', '90', '90', '90', '90', '2023-05-23 17:36:30', '2023-05-30 23:27:55'),
(10, 5, 1, 10, 1, 'TA 2', '90', '90', '90', '90', '90', '90', '91', '90.25', '2023-05-23 17:37:23', '2023-05-23 17:37:23');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_prasidangs`
--

CREATE TABLE `nilai_prasidangs` (
  `id` bigint UNSIGNED NOT NULL,
  `pengajuanjudul_id` bigint UNSIGNED NOT NULL,
  `mahasiswa_id` bigint UNSIGNED NOT NULL,
  `dosen_id` bigint UNSIGNED NOT NULL,
  `prodi_id` bigint UNSIGNED NOT NULL,
  `penilai` enum('Penguji','Pembimbing') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_4` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_5` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_nilai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nilai_prasidangs`
--

INSERT INTO `nilai_prasidangs` (`id`, `pengajuanjudul_id`, `mahasiswa_id`, `dosen_id`, `prodi_id`, `penilai`, `nilai_1`, `nilai_2`, `nilai_3`, `nilai_4`, `nilai_5`, `total_nilai`, `created_at`, `updated_at`) VALUES
(3, 5, 1, 3, 1, 'Penguji', '80', '90', '88', '85', '88', '86.35', '2023-05-23 16:39:10', '2023-05-30 23:02:18'),
(4, 5, 1, 3, 1, 'Pembimbing', '82', '82', '80', '85', '81', '81.35', '2023-05-23 16:40:13', '2023-05-30 23:02:41'),
(5, 5, 1, 10, 1, 'Penguji', '90', '90', '90', '90', '90', '90', '2023-05-23 16:42:42', '2023-05-23 16:42:42'),
(6, 5, 1, 10, 1, 'Pembimbing', '90', '90', '90', '90', '90', '90', '2023-05-23 16:43:19', '2023-05-23 16:43:19');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_seminars`
--

CREATE TABLE `nilai_seminars` (
  `id` bigint UNSIGNED NOT NULL,
  `pengajuanjudul_id` bigint UNSIGNED NOT NULL,
  `mahasiswa_id` bigint UNSIGNED NOT NULL,
  `dosen_id` bigint UNSIGNED NOT NULL,
  `prodi_id` bigint UNSIGNED NOT NULL,
  `penilai` enum('Penguji','Pembimbing') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_4` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_nilai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nilai_seminars`
--

INSERT INTO `nilai_seminars` (`id`, `pengajuanjudul_id`, `mahasiswa_id`, `dosen_id`, `prodi_id`, `penilai`, `nilai_1`, `nilai_2`, `nilai_3`, `nilai_4`, `total_nilai`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 3, 1, 'Penguji', '80', '90', '80', '85', '83', '2023-05-22 03:57:54', '2023-05-30 22:52:05'),
(2, 5, 1, 10, 1, 'Pembimbing', '80', '70', '84', '85', '82.2', '2023-05-23 12:06:52', '2023-05-23 12:06:52'),
(3, 5, 1, 10, 1, 'Penguji', '80', '82', '88', '85', '83', '2023-05-23 12:08:13', '2023-05-23 12:08:13'),
(4, 5, 1, 3, 1, 'Pembimbing', '90', '82', '80', '85', '86.6', '2023-05-23 12:09:18', '2023-05-30 22:51:40'),
(5, 6, 5, 10, 1, 'Pembimbing', '82', '83', '84', '85', '83.65', '2023-05-23 15:19:29', '2023-05-23 15:19:29'),
(6, 6, 5, 10, 1, 'Penguji', '82', '82', '88', '83', '82.8', '2023-05-23 15:21:20', '2023-05-23 15:21:20'),
(7, 6, 5, 3, 1, 'Pembimbing', '82', '82', '88', '83', '82.8', '2023-05-23 15:22:18', '2023-05-23 15:22:18'),
(8, 6, 5, 3, 1, 'Penguji', '81', '83', '88', '85', '83.45', '2023-05-23 15:23:15', '2023-05-23 15:23:15');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_sempros`
--

CREATE TABLE `nilai_sempros` (
  `id` bigint UNSIGNED NOT NULL,
  `pengajuanjudul_id` bigint UNSIGNED NOT NULL,
  `mahasiswa_id` bigint UNSIGNED NOT NULL,
  `dosen_id` bigint UNSIGNED NOT NULL,
  `prodi_id` bigint UNSIGNED NOT NULL,
  `penilai` enum('Penguji','Pembimbing') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_4` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_nilai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nilai_sempros`
--

INSERT INTO `nilai_sempros` (`id`, `pengajuanjudul_id`, `mahasiswa_id`, `dosen_id`, `prodi_id`, `penilai`, `nilai_1`, `nilai_2`, `nilai_3`, `nilai_4`, `total_nilai`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 3, 1, 'Penguji', '80', '90', '80', '85', '83', '2023-05-22 03:18:05', '2023-05-30 22:40:27'),
(3, 5, 1, 10, 1, 'Pembimbing', '80', '75', '88', '80', '80.15', '2023-05-23 12:06:24', '2023-05-23 12:06:24'),
(4, 5, 1, 10, 1, 'Penguji', '75', '82', '88', '85', '81', '2023-05-23 12:07:47', '2023-05-23 12:07:47'),
(5, 5, 1, 3, 1, 'Pembimbing', '90', '90', '90', '90', '90', '2023-05-23 12:09:05', '2023-05-30 22:41:28'),
(6, 6, 5, 10, 1, 'Pembimbing', '80', '82', '88', '85', '83', '2023-05-23 15:19:04', '2023-05-23 15:19:04'),
(7, 6, 5, 10, 1, 'Penguji', '82', '83', '84', '85', '83.65', '2023-05-23 15:20:52', '2023-05-23 15:20:52'),
(8, 6, 5, 3, 1, 'Pembimbing', '82', '83', '88', '83', '82.85', '2023-05-23 15:21:55', '2023-05-23 15:21:55'),
(9, 6, 5, 3, 1, 'Penguji', '82', '90', '88', '85', '84.2', '2023-05-23 15:23:00', '2023-05-30 22:40:53');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_sidangs`
--

CREATE TABLE `nilai_sidangs` (
  `id` bigint UNSIGNED NOT NULL,
  `pengajuanjudul_id` bigint UNSIGNED NOT NULL,
  `mahasiswa_id` bigint UNSIGNED NOT NULL,
  `dosen_id` bigint UNSIGNED NOT NULL,
  `prodi_id` bigint UNSIGNED NOT NULL,
  `penilai` enum('Penguji','Pembimbing') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_4` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_5` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_nilai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nilai_sidangs`
--

INSERT INTO `nilai_sidangs` (`id`, `pengajuanjudul_id`, `mahasiswa_id`, `dosen_id`, `prodi_id`, `penilai`, `nilai_1`, `nilai_2`, `nilai_3`, `nilai_4`, `nilai_5`, `total_nilai`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 3, 1, 'Penguji', '82', '82', '88', '85', '90', '87.55', '2023-05-23 16:39:28', '2023-05-30 23:12:16'),
(2, 5, 1, 3, 1, 'Pembimbing', '90', '90', '90', '90', '89', '89.4', '2023-05-23 16:42:07', '2023-05-30 23:12:37'),
(3, 5, 1, 10, 1, 'Penguji', '90', '90', '90', '90', '90', '90', '2023-05-23 16:42:58', '2023-05-23 16:42:58'),
(4, 5, 1, 10, 1, 'Pembimbing', '90', '90', '90', '90', '90', '90', '2023-05-23 16:43:43', '2023-05-23 16:43:43');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengajuanjuduls`
--

CREATE TABLE `pengajuanjuduls` (
  `id` bigint UNSIGNED NOT NULL,
  `mahasiswa_id` bigint UNSIGNED NOT NULL,
  `dosen_id` bigint UNSIGNED NOT NULL,
  `prodi_id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alasan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('0','1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 Proses, 1 Diterima, 2 Ditolak',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengajuanjuduls`
--

INSERT INTO `pengajuanjuduls` (`id`, `mahasiswa_id`, `dosen_id`, `prodi_id`, `judul`, `keterangan`, `alasan`, `status`, `created_at`, `updated_at`) VALUES
(5, 1, 3, 1, 'Sistem Administrasi Kuliah', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', NULL, '1', '2023-05-19 15:07:03', '2023-05-19 15:07:36'),
(6, 5, 10, 1, 'Sistem Penjadwalan Mata Kuliah', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', NULL, '1', '2023-05-23 15:17:45', '2023-05-23 15:18:26');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuanpembimbings`
--

CREATE TABLE `pengajuanpembimbings` (
  `id` bigint UNSIGNED NOT NULL,
  `mahasiswa_id` bigint UNSIGNED NOT NULL,
  `dosen_id` bigint UNSIGNED NOT NULL,
  `status` enum('0','1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 Proses',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengajuanpembimbings`
--

INSERT INTO `pengajuanpembimbings` (`id`, `mahasiswa_id`, `dosen_id`, `status`, `created_at`, `updated_at`) VALUES
(7, 1, 3, '1', '2023-05-19 15:05:26', '2023-05-19 15:05:55'),
(8, 1, 10, '1', '2023-05-23 12:05:30', '2023-05-23 12:06:02'),
(9, 5, 3, '1', '2023-05-23 15:15:06', '2023-05-23 15:15:47'),
(10, 5, 10, '1', '2023-05-23 15:15:08', '2023-05-23 15:16:13');

-- --------------------------------------------------------

--
-- Table structure for table `pengumumans`
--

CREATE TABLE `pengumumans` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `prodi_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_jadwal` text COLLATE utf8mb4_unicode_ci,
  `file_jadwal` text COLLATE utf8mb4_unicode_ci,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengumumans`
--

INSERT INTO `pengumumans` (`id`, `user_id`, `prodi_id`, `title`, `link_jadwal`, `file_jadwal`, `description`, `created_at`, `updated_at`) VALUES
(5, 6, 1, 'Jadwal Bimbingan', NULL, 'file/Nilai-TA-2-D3TI-2223_Fix---Template.xlsx', 'Berikut Jadwal Bimbingan terbaru', '2023-05-19 14:48:20', '2023-05-19 14:48:20');

-- --------------------------------------------------------

--
-- Table structure for table `penilaians`
--

CREATE TABLE `penilaians` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `kelompok_id` bigint UNSIGNED NOT NULL,
  `prodi_id` bigint UNSIGNED NOT NULL,
  `pengajuanjudul_id` bigint UNSIGNED NOT NULL,
  `nilai_proposal` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_ta` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_pembimbing` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_adm` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penilaiantas`
--

CREATE TABLE `penilaiantas` (
  `id` bigint UNSIGNED NOT NULL,
  `pengajuanjudul_id` bigint UNSIGNED NOT NULL,
  `mahasiswa_id` bigint UNSIGNED NOT NULL,
  `prodi_id` bigint UNSIGNED NOT NULL,
  `status` enum('TA 1','TA 2') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'NSempro/NPrasidang',
  `nilai_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'NSeminar/NSidang',
  `nilai_3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'NPembimbing',
  `nilai_4` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'NAdministrasi',
  `total_nilai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penilaiantas`
--

INSERT INTO `penilaiantas` (`id`, `pengajuanjudul_id`, `mahasiswa_id`, `prodi_id`, `status`, `nilai_1`, `nilai_2`, `nilai_3`, `nilai_4`, `total_nilai`, `grade`, `created_at`, `updated_at`) VALUES
(3, 6, 5, 1, 'TA 1', '83.33', '83.18', '83.6', '83.26', '83.37', 'A', '2023-05-23 16:16:24', '2023-05-23 16:16:24'),
(11, 5, 1, 1, 'TA 1', '83.54', '83.7', '80.63', '80.5', '82.11', 'A', '2023-05-30 23:30:18', '2023-05-30 23:30:18'),
(12, 5, 1, 1, 'TA 2', '86.93', '89.24', '90.13', '90', '89.29', 'A', '2023-05-30 23:41:41', '2023-05-30 23:41:41');

-- --------------------------------------------------------

--
-- Table structure for table `prodis`
--

CREATE TABLE `prodis` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prodis`
--

INSERT INTO `prodis` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'D3TI', '-', '2023-03-13 07:46:41', '2023-03-13 07:46:41'),
(2, 'D3TK', '-', '2023-03-13 15:02:55', '2023-03-13 15:02:55'),
(3, 'D3TRPL', '-', '2023-03-13 15:02:55', '2023-03-13 15:02:55');

-- --------------------------------------------------------

--
-- Table structure for table `proposals`
--

CREATE TABLE `proposals` (
  `id` bigint UNSIGNED NOT NULL,
  `tugas_id` bigint UNSIGNED NOT NULL,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `kelompok_id` bigint UNSIGNED NOT NULL,
  `status` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 Artefak, 1 Aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Mahasiswa', '2023-03-13 07:46:28', '2023-03-13 07:46:28'),
(2, 'Dosen', '2023-03-13 15:04:25', '2023-03-13 15:04:25'),
(3, 'Koordinator', '2023-03-13 15:05:58', '2023-03-13 15:05:58'),
(4, 'Baak', '2023-03-13 15:05:58', '2023-03-13 15:05:58');

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deadline` date NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `prodi_id` bigint UNSIGNED NOT NULL,
  `status` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0 Selesai, 1 Aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tugasakhirs`
--

CREATE TABLE `tugasakhirs` (
  `id` bigint UNSIGNED NOT NULL,
  `tugas_id` int NOT NULL,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `kelompok_id` bigint UNSIGNED NOT NULL,
  `status` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 Artefak, 1 Aktif',
  `kirim` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 Belum dikirim, 1 Terkirim',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nim` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `prodi_id` bigint UNSIGNED NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `nim`, `email`, `email_verified_at`, `foto`, `role_id`, `prodi_id`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Dony Shawn', '32101991', 'dony@gmail.com', NULL, 'images/user/1678816898-UserProfile.jpg', 1, 1, '$2y$10$jRTScunYZzDCGsEms9HrwOK/J0G1JxaCP7nHi8iq3XrSgB2WMH.t.', NULL, NULL, '2023-03-19 06:35:03'),
(3, 'John', '23001011', 'john@gmail.com', NULL, NULL, 2, 1, '$2y$10$D5VIUSC2sSFVFUFmmMnTG.ySaB0AJmtJ7nax7GCXISR0l0k1kmSai', NULL, '2023-03-13 08:21:53', '2023-03-13 08:21:53'),
(4, 'Randy', '320122188191', 'randy@gmail.com', NULL, NULL, 3, 1, '$2y$10$QnZP7Mz3xlAZU9L9v0J2w.IQpid7eWvblUw7P3Bl6FM5j8aaSAfRm', NULL, '2023-03-14 08:53:15', '2023-03-14 08:53:15'),
(5, 'Max', '320122188192', 'max@gmail.com', NULL, NULL, 1, 1, '$2y$10$t9VFCZEtK8quyT/NeZ/geu94pqON0Ckw275LcrmWFQgdgk/9ryJpm', NULL, '2023-03-14 09:21:13', '2023-03-14 09:21:13'),
(6, 'BAAK D3TI', '1', 'baakd3ti@gmail.com', NULL, NULL, 4, 1, '$2y$10$NcE8mZ9Vg7x8XWFFB0cjuuBu2xHt0Fi3WIfBbH9SqsSOPT/FumV8K', NULL, '2023-03-15 09:41:15', '2023-03-15 09:41:15'),
(7, 'BAAK D3TK', '2', 'baakd3tk@gmail.com', NULL, NULL, 4, 2, '$2y$10$NcE8mZ9Vg7x8XWFFB0cjuuBu2xHt0Fi3WIfBbH9SqsSOPT/FumV8K', NULL, '2023-03-19 11:43:01', '2023-03-19 11:43:01'),
(8, 'BAAK D3TRPL', '3', 'baakd3trpl@gmail.com', NULL, NULL, 4, 3, '$2y$10$NcE8mZ9Vg7x8XWFFB0cjuuBu2xHt0Fi3WIfBbH9SqsSOPT/FumV8K', NULL, '2023-03-19 11:43:01', '2023-03-19 11:43:01'),
(9, 'mamat', '32012218819', 'mamat@gmail.com', NULL, NULL, 1, 1, '$2y$10$ZvmA0ql7/sh/YRBesFXtuOSu07jmLs5BK24NG1yOf2JJ42uvsRAcu', NULL, '2023-03-22 01:49:29', '2023-03-22 01:49:29'),
(10, 'Sarah', '230010111222', 'sarah@gmail.com', NULL, NULL, 2, 1, '$2y$10$9McGGJX3TuC/NAuwemX6/OcNpdnPafq0RQIUX6Qn9r.xIo7gDgIq2', NULL, '2023-03-27 11:20:23', '2023-03-27 11:20:23'),
(11, 'Desy', '230010113121', 'desy@gmail.com', NULL, NULL, 3, 2, '$2y$10$wfILyfQsF2aZ5GMcX6/jku8lfOf6Ph8i2Mpc3PwR/p0kwAQ2YhLcy', NULL, '2023-03-27 11:21:34', '2023-03-27 11:21:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggotakelompoks`
--
ALTER TABLE `anggotakelompoks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelompok_id` (`kelompok_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `artefaks`
--
ALTER TABLE `artefaks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelompok_id` (`kelompok_id`),
  ADD KEY `prodi_id` (`prodi_id`),
  ADD KEY `tugasakhir_id` (`tugasakhir_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `bimbingans`
--
ALTER TABLE `bimbingans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mahasiswa_id` (`mahasiswa_id`),
  ADD KEY `dosen_id` (`dosen_id`);

--
-- Indexes for table `dokumenpengujis`
--
ALTER TABLE `dokumenpengujis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tugasakhir_id` (`tugasakhir_id`),
  ADD KEY `mahasiswa_id` (`mahasiswa_id`),
  ADD KEY `dosen_id` (`dosen_id`);

--
-- Indexes for table `dokumenproposals`
--
ALTER TABLE `dokumenproposals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prodi_id` (`prodi_id`),
  ADD KEY `proposal_id` (`proposal_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `dokumentugasakhirs`
--
ALTER TABLE `dokumentugasakhirs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prodi_id` (`prodi_id`),
  ADD KEY `tugasakhir_id` (`tugasakhir_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `dosens`
--
ALTER TABLE `dosens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kelompoks`
--
ALTER TABLE `kelompoks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_adms`
--
ALTER TABLE `nilai_adms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nilai_adms_pengajuanjudul_id_foreign` (`pengajuanjudul_id`),
  ADD KEY `nilai_adms_prodi_id_foreign` (`prodi_id`),
  ADD KEY `nilai_adms_mahasiswa_id_foreign` (`mahasiswa_id`),
  ADD KEY `nilai_adms_koordinator_id_foreign` (`koordinator_id`);

--
-- Indexes for table `nilai_pembimbings`
--
ALTER TABLE `nilai_pembimbings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nilai_pembimbings_pengajuanjudul_id_foreign` (`pengajuanjudul_id`),
  ADD KEY `nilai_pembimbings_prodi_id_foreign` (`prodi_id`),
  ADD KEY `nilai_pembimbings_mahasiswa_id_foreign` (`mahasiswa_id`),
  ADD KEY `nilai_pembimbings_dosen_id_foreign` (`dosen_id`);

--
-- Indexes for table `nilai_prasidangs`
--
ALTER TABLE `nilai_prasidangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nilai_prasidangs_pengajuanjudul_id_foreign` (`pengajuanjudul_id`),
  ADD KEY `nilai_prasidangs_prodi_id_foreign` (`prodi_id`),
  ADD KEY `nilai_prasidangs_mahasiswa_id_foreign` (`mahasiswa_id`),
  ADD KEY `nilai_prasidangs_dosen_id_foreign` (`dosen_id`);

--
-- Indexes for table `nilai_seminars`
--
ALTER TABLE `nilai_seminars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nilai_seminars_mahasiswa_id_foreign` (`mahasiswa_id`),
  ADD KEY `nilai_seminars_dosen_id_foreign` (`dosen_id`),
  ADD KEY `nilai_seminars_pengajuanjudul_id_foreign` (`pengajuanjudul_id`),
  ADD KEY `nilai_seminars_prodi_id_foreign` (`prodi_id`);

--
-- Indexes for table `nilai_sempros`
--
ALTER TABLE `nilai_sempros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nilai_sempros_mahasiswa_id_foreign` (`mahasiswa_id`),
  ADD KEY `nilai_sempros_dosen_id_foreign` (`dosen_id`),
  ADD KEY `nilai_sempros_prodi_id_foreign` (`prodi_id`),
  ADD KEY `nilai_sempros_pengajuanjudul_id_foreign` (`pengajuanjudul_id`);

--
-- Indexes for table `nilai_sidangs`
--
ALTER TABLE `nilai_sidangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nilai_sidangs_pengajuanjudul_id_foreign` (`pengajuanjudul_id`),
  ADD KEY `nilai_sidangs_prodi_id_foreign` (`prodi_id`),
  ADD KEY `nilai_sidangs_mahasiswa_id_foreign` (`mahasiswa_id`),
  ADD KEY `nilai_sidangs_dosen_id_foreign` (`dosen_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pengajuanjuduls`
--
ALTER TABLE `pengajuanjuduls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prodi_id` (`prodi_id`),
  ADD KEY `dosen_id` (`dosen_id`),
  ADD KEY `mahasiswa_id` (`mahasiswa_id`);

--
-- Indexes for table `pengajuanpembimbings`
--
ALTER TABLE `pengajuanpembimbings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dosen_id` (`dosen_id`),
  ADD KEY `mahasiswa_id` (`mahasiswa_id`);

--
-- Indexes for table `pengumumans`
--
ALTER TABLE `pengumumans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prodi_id` (`prodi_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `penilaians`
--
ALTER TABLE `penilaians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelompok_id` (`kelompok_id`),
  ADD KEY `pengajuanjudul_id` (`pengajuanjudul_id`),
  ADD KEY `prodi_id` (`prodi_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `penilaiantas`
--
ALTER TABLE `penilaiantas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penilaiantas_pengajuanjudul_id_foreign` (`pengajuanjudul_id`),
  ADD KEY `penilaiantas_prodi_id_foreign` (`prodi_id`),
  ADD KEY `penilaiantas_mahasiswa_id_foreign` (`mahasiswa_id`);

--
-- Indexes for table `prodis`
--
ALTER TABLE `prodis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proposals`
--
ALTER TABLE `proposals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelompok_id` (`kelompok_id`),
  ADD KEY `tugas_id` (`tugas_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prodi_id` (`prodi_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tugasakhirs`
--
ALTER TABLE `tugasakhirs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `kelompok_id` (`kelompok_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_nim_unique` (`nim`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggotakelompoks`
--
ALTER TABLE `anggotakelompoks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `artefaks`
--
ALTER TABLE `artefaks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bimbingans`
--
ALTER TABLE `bimbingans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dokumenpengujis`
--
ALTER TABLE `dokumenpengujis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dokumenproposals`
--
ALTER TABLE `dokumenproposals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `dokumentugasakhirs`
--
ALTER TABLE `dokumentugasakhirs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dosens`
--
ALTER TABLE `dosens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelompoks`
--
ALTER TABLE `kelompoks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `nilai_adms`
--
ALTER TABLE `nilai_adms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `nilai_pembimbings`
--
ALTER TABLE `nilai_pembimbings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `nilai_prasidangs`
--
ALTER TABLE `nilai_prasidangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nilai_seminars`
--
ALTER TABLE `nilai_seminars`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `nilai_sempros`
--
ALTER TABLE `nilai_sempros`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `nilai_sidangs`
--
ALTER TABLE `nilai_sidangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengajuanjuduls`
--
ALTER TABLE `pengajuanjuduls`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pengajuanpembimbings`
--
ALTER TABLE `pengajuanpembimbings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pengumumans`
--
ALTER TABLE `pengumumans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `penilaians`
--
ALTER TABLE `penilaians`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `penilaiantas`
--
ALTER TABLE `penilaiantas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `prodis`
--
ALTER TABLE `prodis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `proposals`
--
ALTER TABLE `proposals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tugasakhirs`
--
ALTER TABLE `tugasakhirs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anggotakelompoks`
--
ALTER TABLE `anggotakelompoks`
  ADD CONSTRAINT `anggotakelompoks_ibfk_1` FOREIGN KEY (`kelompok_id`) REFERENCES `kelompoks` (`id`),
  ADD CONSTRAINT `anggotakelompoks_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `artefaks`
--
ALTER TABLE `artefaks`
  ADD CONSTRAINT `artefaks_ibfk_1` FOREIGN KEY (`kelompok_id`) REFERENCES `kelompoks` (`id`),
  ADD CONSTRAINT `artefaks_ibfk_2` FOREIGN KEY (`prodi_id`) REFERENCES `prodis` (`id`),
  ADD CONSTRAINT `artefaks_ibfk_3` FOREIGN KEY (`tugasakhir_id`) REFERENCES `tugasakhirs` (`id`),
  ADD CONSTRAINT `artefaks_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `bimbingans`
--
ALTER TABLE `bimbingans`
  ADD CONSTRAINT `bimbingans_ibfk_1` FOREIGN KEY (`mahasiswa_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bimbingans_ibfk_2` FOREIGN KEY (`dosen_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `dokumenpengujis`
--
ALTER TABLE `dokumenpengujis`
  ADD CONSTRAINT `dokumenpengujis_ibfk_1` FOREIGN KEY (`tugasakhir_id`) REFERENCES `tugasakhirs` (`id`),
  ADD CONSTRAINT `dokumenpengujis_ibfk_2` FOREIGN KEY (`mahasiswa_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `dokumenpengujis_ibfk_3` FOREIGN KEY (`dosen_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `dokumenproposals`
--
ALTER TABLE `dokumenproposals`
  ADD CONSTRAINT `dokumenproposals_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `prodis` (`id`),
  ADD CONSTRAINT `dokumenproposals_ibfk_2` FOREIGN KEY (`proposal_id`) REFERENCES `proposals` (`id`),
  ADD CONSTRAINT `dokumenproposals_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `dokumentugasakhirs`
--
ALTER TABLE `dokumentugasakhirs`
  ADD CONSTRAINT `dokumentugasakhirs_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `prodis` (`id`),
  ADD CONSTRAINT `dokumentugasakhirs_ibfk_2` FOREIGN KEY (`tugasakhir_id`) REFERENCES `tugasakhirs` (`id`),
  ADD CONSTRAINT `dokumentugasakhirs_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `dosens`
--
ALTER TABLE `dosens`
  ADD CONSTRAINT `dosens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `kelompoks`
--
ALTER TABLE `kelompoks`
  ADD CONSTRAINT `kelompoks_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `prodis` (`id`);

--
-- Constraints for table `nilai_adms`
--
ALTER TABLE `nilai_adms`
  ADD CONSTRAINT `nilai_adms_koordinator_id_foreign` FOREIGN KEY (`koordinator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_adms_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_adms_pengajuanjudul_id_foreign` FOREIGN KEY (`pengajuanjudul_id`) REFERENCES `pengajuanjuduls` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_adms_prodi_id_foreign` FOREIGN KEY (`prodi_id`) REFERENCES `prodis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `nilai_pembimbings`
--
ALTER TABLE `nilai_pembimbings`
  ADD CONSTRAINT `nilai_pembimbings_dosen_id_foreign` FOREIGN KEY (`dosen_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_pembimbings_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_pembimbings_pengajuanjudul_id_foreign` FOREIGN KEY (`pengajuanjudul_id`) REFERENCES `pengajuanjuduls` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_pembimbings_prodi_id_foreign` FOREIGN KEY (`prodi_id`) REFERENCES `prodis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `nilai_prasidangs`
--
ALTER TABLE `nilai_prasidangs`
  ADD CONSTRAINT `nilai_prasidangs_dosen_id_foreign` FOREIGN KEY (`dosen_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_prasidangs_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_prasidangs_pengajuanjudul_id_foreign` FOREIGN KEY (`pengajuanjudul_id`) REFERENCES `pengajuanjuduls` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_prasidangs_prodi_id_foreign` FOREIGN KEY (`prodi_id`) REFERENCES `prodis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `nilai_seminars`
--
ALTER TABLE `nilai_seminars`
  ADD CONSTRAINT `nilai_seminars_dosen_id_foreign` FOREIGN KEY (`dosen_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_seminars_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_seminars_pengajuanjudul_id_foreign` FOREIGN KEY (`pengajuanjudul_id`) REFERENCES `pengajuanjuduls` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_seminars_prodi_id_foreign` FOREIGN KEY (`prodi_id`) REFERENCES `prodis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `nilai_sempros`
--
ALTER TABLE `nilai_sempros`
  ADD CONSTRAINT `nilai_sempros_dosen_id_foreign` FOREIGN KEY (`dosen_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_sempros_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_sempros_pengajuanjudul_id_foreign` FOREIGN KEY (`pengajuanjudul_id`) REFERENCES `pengajuanjuduls` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_sempros_prodi_id_foreign` FOREIGN KEY (`prodi_id`) REFERENCES `prodis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `nilai_sidangs`
--
ALTER TABLE `nilai_sidangs`
  ADD CONSTRAINT `nilai_sidangs_dosen_id_foreign` FOREIGN KEY (`dosen_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_sidangs_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_sidangs_pengajuanjudul_id_foreign` FOREIGN KEY (`pengajuanjudul_id`) REFERENCES `pengajuanjuduls` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_sidangs_prodi_id_foreign` FOREIGN KEY (`prodi_id`) REFERENCES `prodis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengajuanjuduls`
--
ALTER TABLE `pengajuanjuduls`
  ADD CONSTRAINT `pengajuanjuduls_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `prodis` (`id`),
  ADD CONSTRAINT `pengajuanjuduls_ibfk_2` FOREIGN KEY (`dosen_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `pengajuanjuduls_ibfk_3` FOREIGN KEY (`mahasiswa_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `pengajuanpembimbings`
--
ALTER TABLE `pengajuanpembimbings`
  ADD CONSTRAINT `pengajuanpembimbings_ibfk_1` FOREIGN KEY (`dosen_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `pengajuanpembimbings_ibfk_2` FOREIGN KEY (`mahasiswa_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `pengumumans`
--
ALTER TABLE `pengumumans`
  ADD CONSTRAINT `pengumumans_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `prodis` (`id`),
  ADD CONSTRAINT `pengumumans_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `penilaians`
--
ALTER TABLE `penilaians`
  ADD CONSTRAINT `penilaians_ibfk_1` FOREIGN KEY (`kelompok_id`) REFERENCES `kelompoks` (`id`),
  ADD CONSTRAINT `penilaians_ibfk_2` FOREIGN KEY (`pengajuanjudul_id`) REFERENCES `pengajuanjuduls` (`id`),
  ADD CONSTRAINT `penilaians_ibfk_3` FOREIGN KEY (`prodi_id`) REFERENCES `prodis` (`id`),
  ADD CONSTRAINT `penilaians_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `penilaiantas`
--
ALTER TABLE `penilaiantas`
  ADD CONSTRAINT `penilaiantas_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaiantas_pengajuanjudul_id_foreign` FOREIGN KEY (`pengajuanjudul_id`) REFERENCES `pengajuanjuduls` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaiantas_prodi_id_foreign` FOREIGN KEY (`prodi_id`) REFERENCES `prodis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `proposals`
--
ALTER TABLE `proposals`
  ADD CONSTRAINT `proposals_ibfk_1` FOREIGN KEY (`kelompok_id`) REFERENCES `kelompoks` (`id`),
  ADD CONSTRAINT `proposals_ibfk_2` FOREIGN KEY (`tugas_id`) REFERENCES `tugas` (`id`),
  ADD CONSTRAINT `proposals_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `tugas`
--
ALTER TABLE `tugas`
  ADD CONSTRAINT `tugas_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `prodis` (`id`),
  ADD CONSTRAINT `tugas_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `tugasakhirs`
--
ALTER TABLE `tugasakhirs`
  ADD CONSTRAINT `tugasakhirs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tugasakhirs_ibfk_2` FOREIGN KEY (`kelompok_id`) REFERENCES `kelompoks` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
