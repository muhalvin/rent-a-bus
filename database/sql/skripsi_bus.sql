-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 06, 2024 at 11:28 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi_bus`
--

-- --------------------------------------------------------

--
-- Table structure for table `api`
--

CREATE TABLE `api` (
  `id` int NOT NULL,
  `api` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `api`
--

INSERT INTO `api` (`id`, `api`, `value`, `created_at`, `updated_at`) VALUES
(1, 'Midtrans', '{\"merchant_id_sandbox\":\"G359912867\",\"client_key_sandbox\":\"SB-Mid-client-YZAhlU_jDTFgTrH8\",\"server_key_sandbox\":\"SB-Mid-server-Bi29N_kFqcXWjMl9FTcxMksq\",\"merchant_id\":\"-\",\"client_key\":\"-\",\"server_key\":\"-\",\"is_sandbox\":\"1\"}', NULL, '2023-12-20 23:10:14'),
(2, 'OpenAI', '{\"api_key\":\"your_api_key\",\"max_tokens\":500}', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` text COLLATE utf8mb4_unicode_ci,
  `isi` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `permalink` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dibaca` int NOT NULL DEFAULT '0',
  `tanggal` date DEFAULT NULL,
  `is_publish` tinyint NOT NULL DEFAULT '1',
  `kategori_berita_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  `jml_kata` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `berita_tags`
--

CREATE TABLE `berita_tags` (
  `berita_id` bigint NOT NULL,
  `berita_tags` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `id` bigint UNSIGNED NOT NULL,
  `bus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_merek` int NOT NULL,
  `id_tipe` int NOT NULL,
  `harga_sewa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `kapasitas` int NOT NULL DEFAULT '1',
  `tahun_bus` year DEFAULT NULL,
  `no_rangka` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_mesin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_plat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_operasi` year DEFAULT NULL,
  `mileage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transmission` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Manual',
  `luggage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '32 Bags',
  `fuel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Solar',
  `fitur` text COLLATE utf8mb4_unicode_ci,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `is_aktif` tinyint NOT NULL DEFAULT '1',
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int NOT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`id`, `bus`, `id_merek`, `id_tipe`, `harga_sewa`, `kapasitas`, `tahun_bus`, `no_rangka`, `no_mesin`, `no_plat`, `tahun_operasi`, `mileage`, `transmission`, `luggage`, `fuel`, `fitur`, `deskripsi`, `is_aktif`, `gambar`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Bus Volvo 01', 1, 1, '1500000', 32, '2019', 'RK1238202121', 'MZN1239393202', 'S 12323 Y', '2019', '1300', 'Manual', '32 Bags', 'Solar', NULL, NULL, 1, 'photo/aVHp1i3zWbjWXEVx0b99iBNTu2KleE4TJ4w1xzrd.png', 1, 1, NULL, '2023-12-20 06:52:52'),
(2, 'bis 2', 2, 2, '2000000', 32, '2020', '12321jkhkhjk', 'oiuiouiouoi12', 'S 12331 AA', '2020', '3500', 'Manual', '64', 'Solar', '<p>fitur a b c d</p>', '<p>deskripsi</p>', 1, NULL, 1, 1, NULL, '2023-12-24 20:25:24');

-- --------------------------------------------------------

--
-- Table structure for table `bus_gambar`
--

CREATE TABLE `bus_gambar` (
  `id` bigint UNSIGNED NOT NULL,
  `id_bus` int NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bus_gambar`
--

INSERT INTO `bus_gambar` (`id`, `id_bus`, `gambar`, `created_at`, `updated_at`) VALUES
(2, 1, 'photo/647mHddA8YlHngE2Ar802Vap26n3Ps4kK1nilnry.jpg', '2023-12-20 17:19:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hak_akses`
--

CREATE TABLE `hak_akses` (
  `id` int NOT NULL,
  `level_id` int NOT NULL,
  `menu_id` text COLLATE utf8mb4_unicode_ci,
  `menu_detail_id` text COLLATE utf8mb4_unicode_ci,
  `tambah` tinyint DEFAULT NULL,
  `ubah` tinyint DEFAULT NULL,
  `hapus` tinyint DEFAULT NULL,
  `lihat` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hak_akses`
--

INSERT INTO `hak_akses` (`id`, `level_id`, `menu_id`, `menu_detail_id`, `tambah`, `ubah`, `hapus`, `lihat`, `created_at`, `updated_at`) VALUES
(33, 1, '1', NULL, 1, 1, 1, 1, NULL, NULL),
(34, 1, '2', NULL, 0, 0, 0, 0, NULL, NULL),
(35, 1, '6', NULL, 1, 1, 1, 1, NULL, NULL),
(36, 1, '7', NULL, 1, 1, 1, 1, NULL, NULL),
(37, 1, '8', NULL, 1, 1, 1, 1, NULL, NULL),
(38, 1, '9', NULL, 1, 1, 1, 1, NULL, NULL),
(39, 1, '10', NULL, 0, 1, 0, 1, NULL, NULL),
(40, 1, '11', NULL, 1, 1, 1, 1, NULL, NULL),
(41, 1, '3', NULL, 0, 0, 0, 0, NULL, NULL),
(42, 1, '12', NULL, 1, 1, 1, 1, NULL, NULL),
(43, 1, '4', NULL, 0, 0, 0, 0, NULL, NULL),
(44, 1, '13', NULL, 1, 1, 1, 1, NULL, NULL),
(45, 1, '14', NULL, 1, 1, 1, 1, NULL, NULL),
(46, 1, '5', NULL, 1, 1, 1, 1, NULL, NULL),
(47, 1, '15', NULL, 0, 0, 0, 0, NULL, NULL),
(48, 1, '19', NULL, 1, 1, 1, 1, NULL, NULL),
(49, 1, '20', NULL, 1, 1, 1, 1, NULL, NULL),
(50, 1, '16', NULL, 1, 1, 1, 1, NULL, NULL),
(51, 1, '17', NULL, 0, 0, 0, 0, NULL, NULL),
(52, 1, '21', NULL, 1, 1, 1, 1, NULL, NULL),
(53, 1, '22', NULL, 1, 1, 1, 1, NULL, NULL),
(54, 1, '18', NULL, 1, 1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `icons`
--

CREATE TABLE `icons` (
  `id` int NOT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `icons`
--

INSERT INTO `icons` (`id`, `icon`) VALUES
(1, 'fa fa-fire'),
(2, 'fa fa-home'),
(3, 'fa fa-yin-yang'),
(4, 'fa fa-wrench'),
(5, 'fa fa-wifi'),
(6, 'fa fa-bolt'),
(7, 'fa fa-warehouse'),
(8, 'fa fa-building'),
(9, 'fa fa-video'),
(10, 'fa fa-users'),
(11, 'fa fa-user-alt'),
(12, 'fa fa-download'),
(13, 'fa fa-upload'),
(14, 'fa fa-layer-group'),
(15, 'fa fa-file'),
(16, 'fa fa-file-excel'),
(17, 'fa fa-file-pdf'),
(20, 'fa fa-key'),
(21, 'fa fa-cog'),
(22, 'fa fa-leaf'),
(23, 'fa fa-envelope'),
(24, 'fa fa-code'),
(25, 'fa fa-cloud'),
(26, 'fa fa-paper-plane'),
(27, 'fa fa-university'),
(28, 'fa fa-laptop'),
(29, 'fa fa-print'),
(30, 'fa fa-tv'),
(31, 'fa fa-trophy'),
(32, 'fa fa-tree'),
(33, 'fa fa-trash'),
(34, 'fa fa-times-circle'),
(35, 'fa fa-toggle-on'),
(36, 'fa fa-toggle-off'),
(37, 'fa fa-ticket-alt'),
(38, 'fa fa-th-list'),
(39, 'fa fa-thumbtack'),
(40, 'fa fa-terminal'),
(41, 'fa fa-tasks'),
(42, 'fa fa-tag'),
(43, 'fa fa-tags'),
(44, 'fa fa-sync'),
(45, 'fa fa-store-alt'),
(46, 'fa fa-stopwatch'),
(47, 'fa fa-sticky-note'),
(48, 'fa fa-spell-check'),
(49, 'fa fa-sms'),
(50, 'fa fa-sign-in-alt'),
(51, 'fa fa-sign-out-alt'),
(52, 'fa fa-shopping-cart'),
(53, 'fa fa-shopping-bag'),
(54, 'fa fa-shield-alt'),
(55, 'fa fa-share-alt'),
(56, 'fa fa-shipping-fast'),
(57, 'fa fa-server'),
(58, 'fa fa-seedling'),
(59, 'fa fa-search'),
(60, 'fa fa-search-plus'),
(61, 'fa fa-search-minus'),
(62, 'fa fa-scroll'),
(63, 'fa fa-rocket'),
(64, 'fa fa-rss'),
(65, 'fa fa-retweet'),
(66, 'fa fa-road'),
(67, 'fa fa-radiation'),
(68, 'fa fa-qrcode'),
(69, 'fa fa-pray'),
(70, 'fa fa-podcast'),
(71, 'fa fa-plus-circle'),
(72, 'fa fa-phone'),
(73, 'fa fa-phone-alt'),
(74, 'fa fa-pencil-alt'),
(75, 'fa fa-pen'),
(76, 'fa fa-paperclip'),
(77, 'fa fa-palette'),
(78, 'fa fa-newspaper'),
(79, 'fa fa-music'),
(80, 'fa fa-money-bill-alt'),
(81, 'fa fa-meteor'),
(82, 'fa fa-bullhorn'),
(83, 'fa fa-medal'),
(84, 'fa fa-marker'),
(85, 'fa fa-map-pin'),
(86, 'fa fa-map-marker-alt'),
(87, 'fa fa-map-marked-alt'),
(88, 'fa fa-map'),
(89, 'fa fa-male'),
(90, 'fa fa-female'),
(91, 'fa fa-mail-bulk'),
(92, 'fa fa-location-arrow'),
(93, 'fa fa-link'),
(94, 'fa fa-language'),
(95, 'fa fa-landmark'),
(96, 'fa fa-infinity'),
(97, 'fa fa-images'),
(98, 'fa fa-id-card'),
(99, 'fa fa-hotel'),
(100, 'fa fa-hospital-alt'),
(101, 'fa fa-home'),
(102, 'fa fa-history'),
(103, 'fa fa-hdd'),
(104, 'fa fa-handshake'),
(105, 'fa fa-hammer'),
(106, 'fa fa-grip-vertical'),
(107, 'fa fa-grip-horizontal'),
(108, 'fa fa-graduation-cap'),
(109, 'fa fa-globe'),
(110, 'fa fa-gifts'),
(111, 'fa fa-gift'),
(112, 'fa fa-gem'),
(113, 'fa fa-gamepad'),
(114, 'fa fa-font'),
(115, 'fa fa-folder'),
(116, 'fa fa-folder-open'),
(117, 'fa fa-flag'),
(118, 'fa fa-fingerprint'),
(119, 'fa fa-filter'),
(120, 'fa fa-film'),
(121, 'fa fa-file-word'),
(122, 'fa fa-file-excel'),
(123, 'fa fa-file-import'),
(124, 'fa fa-file-export'),
(125, 'fa fa-certificate'),
(126, 'fa fa-feather'),
(127, 'fa fa-fan'),
(128, 'fa fa-eye'),
(129, 'fa fa-exclamation'),
(130, 'fa fa-exclamation-circle'),
(131, 'fa fa-edit'),
(132, 'fa fa-dice'),
(133, 'fa fa-database'),
(134, 'fa fa-cube'),
(135, 'fa fa-cubes'),
(136, 'fa fa-crosshairs'),
(137, 'fa fa-copy'),
(138, 'fa fa-credit-card'),
(139, 'fa fa-copyright'),
(140, 'fa fa-compass'),
(141, 'fa fa-comments'),
(142, 'fa fa-comment-alt'),
(143, 'fa fa-coins'),
(144, 'fa fa-cloud-upload-alt'),
(145, 'fa fa-screwdriver'),
(146, 'fa fa-toolbox'),
(147, 'fa fa-heart');

-- --------------------------------------------------------

--
-- Table structure for table `info_mail`
--

CREATE TABLE `info_mail` (
  `protocol` char(10) COLLATE utf8mb4_unicode_ci DEFAULT 'smtp',
  `smtp_host` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'ssl://smtp.googlemail.com',
  `smtp_port` char(5) COLLATE utf8mb4_unicode_ci DEFAULT '465',
  `smtp_user` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT 'yourmail@mail.com',
  `smtp_pass` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT 'yourpassword',
  `charset` char(10) COLLATE utf8mb4_unicode_ci DEFAULT 'iso-8859-1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `info_sistem`
--

CREATE TABLE `info_sistem` (
  `title_header` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'CRUD Builder',
  `title_footer` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PT. Digital Media Bangsa',
  `logo` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'CRUD Builder Laravel',
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yourmail@mail.com',
  `alamat` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_telepon` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website_status` tinyint NOT NULL DEFAULT '1',
  `id_bahasa` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `info_sistem`
--

INSERT INTO `info_sistem` (`title_header`, `title_footer`, `logo`, `app_name`, `deskripsi`, `email`, `alamat`, `no_telepon`, `website_status`, `id_bahasa`, `created_at`, `updated_at`) VALUES
('Penyewaan Bus', 'PT. Penyewaan Bus', NULL, 'App Penyewaan Bus', 'Ini aplikasi untuk penyewaan bus pariwisata yang berstudi kasus pada PT. XYZ', 'yourmail@mail.com', 'Jombang - Jawa Timur', '085123123332', 1, NULL, '2023-12-17 07:12:02', '2023-12-22 03:46:54');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_berita`
--

CREATE TABLE `kategori_berita` (
  `id` bigint UNSIGNED NOT NULL,
  `kategori_berita` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_aktif` tinyint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id` int NOT NULL,
  `level` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `level`, `created_at`, `updated_at`) VALUES
(1, 'Super User', '2023-12-17 07:12:02', NULL),
(2, 'Admin', '2023-12-17 07:12:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int NOT NULL,
  `menu` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_text` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon_id` int DEFAULT NULL,
  `is_link` tinyint NOT NULL DEFAULT '0',
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_separator` tinyint NOT NULL DEFAULT '0',
  `separator_text` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urutan` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '100',
  `parent_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `menu`, `lang_text`, `icon_id`, `is_link`, `link`, `is_separator`, `separator_text`, `urutan`, `parent_id`) VALUES
(1, 'Dashboard', 'dashboard', 2, 1, 'home', 0, NULL, '100', NULL),
(2, 'Modul Sistem', 'modul_sistem', 22, 0, NULL, 0, NULL, '110', NULL),
(3, 'Manajemen API', 'manajemen_api', 144, 0, NULL, 0, NULL, '120', NULL),
(4, 'Berita', 'berita', 78, 0, NULL, 0, NULL, '130', NULL),
(5, 'Open AI', 'open_ai', 6, 1, 'openai', 0, NULL, '121', NULL),
(6, 'Info Sistem', 'info_sistem', NULL, 1, 'info_sistem', 0, NULL, '10', 2),
(7, 'Modul Icon', 'modul_icon', NULL, 1, 'icons', 0, NULL, '11', 2),
(8, 'Menu', 'menu', NULL, 1, 'menu', 0, NULL, '12', 2),
(9, 'Level', 'level', NULL, 1, 'level', 0, NULL, '13', 2),
(10, 'Hak Akses', 'hak_akses', NULL, 1, 'hak_akses', 0, NULL, '14', 2),
(11, 'User', 'user', NULL, 1, 'users', 0, NULL, '15', 2),
(12, 'Setup API', 'api', NULL, 1, 'api', 0, NULL, '10', 3),
(13, 'Kategori Berita', 'kategori_berita', NULL, 1, 'kategori_berita', 0, NULL, '10', 4),
(14, 'Berita', 'berita', NULL, 1, 'berita', 0, NULL, '11', 4),
(15, 'Data Primer', 'data_primer', 146, 0, NULL, 0, NULL, '101', NULL),
(16, 'Bus', 'bus', 85, 1, 'bus', 0, NULL, '102', NULL),
(17, 'Data Pesanan', 'data_pesanan', 52, 0, NULL, 0, NULL, '103', NULL),
(18, 'Data Penyewa', 'data_penyewa', 10, 1, 'penyewa', 0, NULL, '104', NULL),
(19, 'Type', 'type', NULL, 1, 'type', 0, NULL, '1', 15),
(20, 'Merek', 'merek', NULL, 1, 'merek', 0, NULL, '2', 15),
(21, 'Pesanan', 'pesanan', NULL, 1, 'pesanan', 0, NULL, '1', 17),
(22, 'Transaksi', 'transaksi', NULL, 1, 'transaksi', 0, NULL, '2', 17);

-- --------------------------------------------------------

--
-- Table structure for table `merek`
--

CREATE TABLE `merek` (
  `id` bigint UNSIGNED NOT NULL,
  `merek` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `merek`
--

INSERT INTO `merek` (`id`, `merek`, `created_at`, `updated_at`) VALUES
(1, 'Volvo', NULL, NULL),
(2, 'Mercedes Benz', NULL, NULL),
(3, 'Honda', NULL, '2023-12-20 04:51:18');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_12_10_012710_create_info_sistem_table', 1),
(6, '2022_12_10_125048_create_level_table', 1),
(7, '2022_12_10_125504_create_menu_table', 1),
(8, '2022_12_10_125542_create_icons_table', 1),
(9, '2022_12_10_125602_create_hak_akses_table', 1),
(10, '2022_12_10_125631_create_info_mail_table', 1),
(11, '2022_12_14_021114_update_attribute_menu_table', 1),
(12, '2022_12_14_051655_create_api_table', 1),
(13, '2022_12_15_024302_update_attribute_hak_akses_table', 1),
(14, '2022_12_16_100715_update_hak_akses_table', 1),
(15, '2022_12_16_120145_change_table_atrribute_hak_akses', 1),
(16, '2022_12_16_141428_create_kategori_berita_table', 1),
(17, '2022_12_16_141448_create_berita_table', 1),
(18, '2022_12_18_020501_update_attribute_berita_table', 1),
(19, '2022_12_18_020756_create_berita_tags_table', 1),
(20, '2022_12_18_021907_update_attribut_tabel_users', 1),
(21, '2022_12_18_021924_update_attribut_tabel_menu', 1),
(22, '2022_12_18_021940_update_attribut_tabel_berita', 1),
(23, '2022_12_18_022854_update_attribut_tabel_hak_akses', 1),
(24, '2022_12_18_030613_update_attribut_tabel_berita', 1),
(25, '2023_12_20_110706_create_table_bus', 2),
(26, '2023_12_20_111509_create_table_bus_gambar', 2),
(27, '2023_12_20_112816_create_table_merek', 2),
(28, '2023_12_20_112904_create_penyewa', 2),
(29, '2023_12_20_113137_create_pesanan', 2),
(30, '2023_12_20_113511_create_tipe', 2),
(31, '2023_12_20_113537_create_transaksi', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penyewa`
--

CREATE TABLE `penyewa` (
  `id` bigint UNSIGNED NOT NULL,
  `penyewa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `kitas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Laki-Laki',
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penyewa`
--

INSERT INTO `penyewa` (`id`, `penyewa`, `alamat`, `kitas`, `jk`, `no_hp`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Agoes', 'Ds. Kedawung Kec. Meikarta Indonesia', '58971283192332', 'Laki-Laki', '085122323233', 1, 1, '2023-12-20 19:42:53', '2023-12-20 19:43:22'),
(2, 'Andin', 'Alamat saya di Indonesia', '2131298371298', 'Perempuan', '085755056530', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` bigint UNSIGNED NOT NULL,
  `kd_pesanan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_penyewa` int NOT NULL,
  `id_bus` int NOT NULL,
  `tgl_pesan` date DEFAULT NULL,
  `tgl_mulai_sewa` date DEFAULT NULL,
  `tgl_selesai_sewa` date DEFAULT NULL,
  `waktu_pickup` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `total_biaya` int DEFAULT NULL,
  `status` enum('belum','dp','lunas') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum',
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `kd_pesanan`, `id_penyewa`, `id_bus`, `tgl_pesan`, `tgl_mulai_sewa`, `tgl_selesai_sewa`, `waktu_pickup`, `keterangan`, `total_biaya`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'PS1703128596', 1, 1, '2023-12-21', '2023-12-21', '2023-12-21', '12:30', '<p>Sewa untuk antar nikahan</p>', 1500000, 'belum', 1, 1, '2023-12-20 20:16:36', '2023-12-20 23:05:45'),
(14, 'PS1703229859', 2, 1, '2023-12-22', '2023-12-22', '2023-12-22', '12:12', 'Lama penyewaan 1 hari. Titik penjemputan di lokasi sekitaran Mojokerto dan berakhir menuju lokasi Surabaya', 1500000, 'lunas', NULL, NULL, '2023-12-22 00:24:19', '2023-12-22 03:06:13'),
(15, 'PS1704540361', 1, 1, '2024-01-06', '2024-03-01', '2024-03-03', '08:00', 'Lama penyewaan 3 hari. Titik penjemputan di lokasi sekitaran Jombang dan berakhir menuju lokasi Jakarta', 4500000, 'lunas', NULL, NULL, '2024-01-06 04:26:01', '2024-01-06 04:27:03');

-- --------------------------------------------------------

--
-- Table structure for table `tipe`
--

CREATE TABLE `tipe` (
  `id` bigint UNSIGNED NOT NULL,
  `tipe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tipe`
--

INSERT INTO `tipe` (`id`, `tipe`, `created_at`, `updated_at`) VALUES
(1, 'Tipe Sheet 32', NULL, '2023-12-20 04:48:32'),
(2, 'Tipe Sheet 64', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` bigint UNSIGNED NOT NULL,
  `kd_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pesanan` int NOT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `jumlah` int NOT NULL,
  `metode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `merchant_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biller_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `kd_transaksi`, `id_pesanan`, `tgl_transaksi`, `jumlah`, `metode`, `status`, `keterangan`, `transaction_id`, `payment_type`, `merchant_code`, `biller_code`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'TF1703138201', 1, '2023-12-21', 1000000, 'Cash', 0, 'cicil 1jt kurang 500rb', NULL, NULL, NULL, NULL, 1, 1, '2023-12-20 22:56:41', '2023-12-20 23:05:45'),
(3, 'TF1703229859230866746', 14, '2023-12-22', 1500000, NULL, 1, '{\"status_code\":\"201\",\"status_message\":\"Transaksi sedang diproses\",\"transaction_id\":\"7f07b8e4-cad7-49ac-93fc-0e4c18f7bb1c\",\"order_id\":\"TF1703229859230866746\",\"gross_amount\":\"1500000.00\",\"payment_type\":\"bank_transfer\",\"transaction_time\":\"2023-12-22 16:55:56\",\"transaction_status\":\"pending\",\"fraud_status\":\"accept\",\"va_numbers\":[{\"bank\":\"bri\",\"va_number\":\"128672243449855346\"}],\"pdf_url\":\"https:\\/\\/app.sandbox.midtrans.com\\/snap\\/v1\\/transactions\\/a54ff2fc-343f-41f6-a874-d63f1bd799b9\\/pdf\",\"finish_redirect_url\":\"http:\\/\\/example.com?order_id=TF1703229859230866746&status_code=201&transaction_status=pending\"}', '7f07b8e4-cad7-49ac-93fc-0e4c18f7bb1c', 'bank_transfer', '128672243449855346', NULL, NULL, NULL, '2023-12-21 17:00:00', '2023-12-22 03:06:13'),
(4, 'TF1704540361670019919', 15, '2024-01-06', 4500000, NULL, 1, '{\"status_code\":\"200\",\"status_message\":\"Success, transaction is found\",\"transaction_id\":\"a1f8c923-d47c-4fcf-9a1a-bc843d475062\",\"order_id\":\"TF1704540361670019919\",\"gross_amount\":\"4500000.00\",\"payment_type\":\"bank_transfer\",\"transaction_time\":\"2024-01-06 18:26:22\",\"transaction_status\":\"settlement\",\"fraud_status\":\"accept\",\"va_numbers\":[{\"bank\":\"bni\",\"va_number\":\"9881286741451714\"}],\"pdf_url\":\"https:\\/\\/app.sandbox.midtrans.com\\/snap\\/v1\\/transactions\\/1af22e24-2c52-45ed-8d6b-eea2575c8392\\/pdf\",\"finish_redirect_url\":\"http:\\/\\/example.com?order_id=TF1704540361670019919&status_code=200&transaction_status=settlement\"}', 'a1f8c923-d47c-4fcf-9a1a-bc843d475062', 'bank_transfer', '9881286741451714', NULL, NULL, NULL, '2024-01-05 17:00:00', '2024-01-06 04:27:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Laki-Laki',
  `alamat` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `no_hp` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_aktif` tinyint NOT NULL DEFAULT '1',
  `id_level` int NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `email_verified_at`, `password`, `jk`, `alamat`, `tgl_lahir`, `no_hp`, `foto`, `is_aktif`, `id_level`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@admin.com', NULL, '$2y$10$5Az0lomBpwls6k4Wz6REM.TmcHoCmOcVOUQ4vj34P6IE4uQMpmc8C', 'Laki-Laki', 'Indonesia', '2023-12-17', '628571235873', NULL, 1, 1, NULL, '2023-12-17 07:12:02', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api`
--
ALTER TABLE `api`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `berita_kategori_berita_id_created_by_updated_by_index` (`kategori_berita_id`,`created_by`,`updated_by`);

--
-- Indexes for table `berita_tags`
--
ALTER TABLE `berita_tags`
  ADD KEY `berita_tags_berita_id_index` (`berita_id`);

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bus_created_by_index` (`created_by`),
  ADD KEY `bus_updated_by_index` (`updated_by`);

--
-- Indexes for table `bus_gambar`
--
ALTER TABLE `bus_gambar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bus_gambar_id_bus_index` (`id_bus`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hak_akses`
--
ALTER TABLE `hak_akses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hak_akses_level_id_index` (`level_id`);

--
-- Indexes for table `icons`
--
ALTER TABLE `icons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_berita`
--
ALTER TABLE `kategori_berita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_icon_id_index` (`icon_id`);

--
-- Indexes for table `merek`
--
ALTER TABLE `merek`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `penyewa`
--
ALTER TABLE `penyewa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penyewa_created_by_index` (`created_by`),
  ADD KEY `penyewa_updated_by_index` (`updated_by`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pesanan_id_penyewa_index` (`id_penyewa`),
  ADD KEY `pesanan_id_bus_index` (`id_bus`),
  ADD KEY `pesanan_created_by_index` (`created_by`),
  ADD KEY `pesanan_updated_by_index` (`updated_by`);

--
-- Indexes for table `tipe`
--
ALTER TABLE `tipe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_id_pesanan_index` (`id_pesanan`),
  ADD KEY `transaksi_created_by_index` (`created_by`),
  ADD KEY `transaksi_updated_by_index` (`updated_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_id_level_index` (`id_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api`
--
ALTER TABLE `api`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bus`
--
ALTER TABLE `bus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bus_gambar`
--
ALTER TABLE `bus_gambar`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hak_akses`
--
ALTER TABLE `hak_akses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `icons`
--
ALTER TABLE `icons`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `kategori_berita`
--
ALTER TABLE `kategori_berita`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `merek`
--
ALTER TABLE `merek`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `penyewa`
--
ALTER TABLE `penyewa`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tipe`
--
ALTER TABLE `tipe`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
