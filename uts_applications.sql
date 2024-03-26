-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2024 at 01:39 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uts_applications`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `namabarang` varchar(255) NOT NULL,
  `jenisbarang` varchar(70) NOT NULL,
  `deskripsi` varchar(500) NOT NULL,
  `komposisi` varchar(500) NOT NULL,
  `tanggalkedaluwarsa` varchar(70) NOT NULL,
  `foto` varchar(500) NOT NULL,
  `jumlahstokbarang` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `namabarang`, `jenisbarang`, `deskripsi`, `komposisi`, `tanggalkedaluwarsa`, `foto`, `jumlahstokbarang`, `created_at`, `updated_at`, `harga`, `kategori_id`) VALUES
(11111, 'Chitato Rasa Barberque', 'Makanan Ringan', '\"Life is Never Flat\" adalah jiwa dari Chitato, membuat keseharian jadi maksimal dari tiap situasi kehidupan.', 'Kentang, minyak kelapa sawit, bumbu rasa sapi panggang, antioksidan (TBHQ), vitamin (A & C) dan mineral (kalsium & zat besi)', '13/04/2025', '1709495959.jpeg', 35, '2024-03-03 12:59:19', '2024-03-22 14:32:45', 13000, 1),
(31111, 'Panadol Flu dan Batuk', 'Obat', 'Panadol Cold & Flu meredakan gejala hidung tersumbat batuk yang tidak berdahak, dan demam yang menyertai influenza. Tersedia untuk varian Panadol Flu & Batuk', 'Parasetamol 500mg, Pseudoephedrine HCl 30mg, Dextromethorphan HBr 15mg', '13/04/2025', '1709815296.jpg', 49, '2024-03-07 05:41:36', '2024-03-21 03:55:39', 12500, 3),
(21111, 'Minute Maid Pulpy', 'Minuman', 'Minuman buah jeruk dengan bulir jeruk, dan mengandung vitamin C dalam kemasan praktis botol isi 300ml.', 'AIR, GULA, BULIR JERUK / ORANGE PULP (4,7%), KONSENTRAT JERUK (MENGANDUNG SARI BUAH 5,3%), PENGATUR KEASAMAN (ASAM SITRAT, TRINATRIUM SITRAT), VITAMIN C, PERISA ALAMI, PEWARNA ALAMI (BETA KAROTEN CI NO. 75130).', '13/04/2025', '1709815339.png', 35, '2024-03-07 05:42:19', '2024-03-22 14:23:31', 7000, 2),
(41111, 'Wipol', 'Pembersih', 'Memiliki lantai dan ruangan yang bersih dari kuman merupakan salah satu indikasi penting kebersihan rumah secara menyeluruh', 'Ethoxylated Alcohol dan Benzalknium Chloride 99%', '17 Agustus 2025', '1710729407.jpg', 87, '2024-03-17 19:36:47', '2024-03-22 14:31:57', 10200, 4),
(41112, 'Saniter', 'Pembersih Alkohol', 'Saniter spray air & surface + fresh clean. Aerosol sanitizer, membunuh kuman secara cepat. Meningkatkan kesegaran pada ruangan anda.', 'Alkohol 70% Benzalkonium Klorida 0.05 %', '17 Agustus 2025', '1710740517.jpg', 83, '2024-03-17 22:41:57', '2024-03-22 14:31:52', 27500, 4),
(51111, 'Tayo Little Bus', 'Mainan Anak - Anak', 'Tayo adalah mainan anak - anak berbentuk bus', 'Plastik', '-', '1710793848.jpeg', 0, '2024-03-18 13:30:48', '2024-03-22 14:12:14', 30000, 5);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_picture` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `product_price` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `product_name`, `product_picture`, `quantity`, `product_price`, `created_at`, `updated_at`) VALUES
(140, 3, 11111, 'Chitato Rasa Barberquea', '1709495959.jpeg', 1, 13000, '2024-03-21 03:55:00', '2024-03-21 03:55:00'),
(141, 3, 31111, 'Panadol Flu dan Batuk', '1709815296.jpg', 1, 12500, '2024-03-21 03:55:03', '2024-03-21 03:55:03'),
(142, 3, 21111, 'Minute Maid Pulpy', '1709815339.png', 13, 7000, '2024-03-21 03:55:04', '2024-03-22 14:17:41'),
(152, 6, 21111, 'Minute Maid Pulpy', '1709815339.png', 1, 7000, '2024-03-22 14:23:31', '2024-03-22 14:23:31'),
(153, 6, 41112, 'Saniter', '1710740517.jpg', 1, 27500, '2024-03-22 14:31:52', '2024-03-22 14:31:52'),
(154, 6, 41111, 'Wipol', '1710729407.jpg', 1, 10200, '2024-03-22 14:31:57', '2024-03-22 14:31:57');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_category` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `product_category`, `created_at`, `updated_at`) VALUES
(1, 'Makanan', '2024-02-28 15:56:54', '2024-03-18 14:00:39'),
(2, 'Minuman', '2024-02-28 15:57:00', '2024-02-28 15:57:00'),
(3, 'Obat - Obatan', '2024-02-28 15:57:12', '2024-02-28 15:57:12'),
(4, 'Produk Rumah Tangga', '2024-02-28 15:57:25', '2024-02-28 15:57:25'),
(5, 'Lain - Lain', '2024-02-28 15:57:35', '2024-02-28 15:57:35'),
(6, 'Alkohol', '2024-03-05 00:38:55', '2024-03-17 22:39:29');

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
-- Table structure for table `generalmanageroperasional`
--

CREATE TABLE `generalmanageroperasional` (
  `id_generalmanageroperasional` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nomor_telepon` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'inactive',
  `gambar` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `generalmanageroperasional`
--

INSERT INTO `generalmanageroperasional` (`id_generalmanageroperasional`, `email`, `nama`, `nomor_telepon`, `username`, `password`, `jabatan`, `status`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'Fanomulyadi@gmail.com', 'Fano', '123456', 'Fano', '$2y$10$7GS0BrqX7jYwn33QrOE/ke67BDkFMrtyB5YPZQSiMCt1LRkpv5jOW', 'generalmanageroperasional', 'inactive', '1709159823_WhatsApp Image 2022-12-03 at 15.15.17.jpeg', '2024-02-28 15:37:03', '2024-02-28 15:37:03');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nomor_telepon` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'inactive',
  `status_belanja_bantuan_karyawan` varchar(50) NOT NULL DEFAULT 'inactive',
  `gambar` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `email`, `nama`, `nomor_telepon`, `username`, `password`, `jabatan`, `status`, `status_belanja_bantuan_karyawan`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'Virgin@gmail.com', 'Virgin', '1234567890', 'Virgin', '$2y$10$y0Zz74tyh4vRlQ4YW0NW6unEruhKxANOHM.SKOOTdYdZIfDJvVioa', 'karyawan', 'inactive', 'inactive', '1709159906_Vic Firth American Classic 5A Barrel.png', '2024-02-28 15:38:26', '2024-02-28 15:38:26');

-- --------------------------------------------------------

--
-- Table structure for table `metode_pembayaran`
--

CREATE TABLE `metode_pembayaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namametodepembayaran` varchar(255) NOT NULL,
  `saldo` varchar(70) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `metode_pembayaran`
--

INSERT INTO `metode_pembayaran` (`id`, `namametodepembayaran`, `saldo`, `created_at`, `updated_at`) VALUES
(1, 'Gopay', '5000', NULL, NULL),
(2, 'Ovo', '999999999', NULL, NULL),
(3, 'Tunai', '1', NULL, NULL),
(4, 'QRIS', '1', NULL, NULL);

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_04_06_043251_userlist', 1),
(6, '2023_04_10_060004_products', 1),
(7, '2023_04_10_060041_categories', 1),
(8, '2023_04_10_060206_add_category_id_to_products', 1),
(9, '2023_04_11_065016_carts', 1),
(10, '2023_04_11_100145_transactions', 1),
(11, '2024_02_28_221230_karyawan', 2),
(12, '2024_02_28_221246_pelanggan', 2),
(13, '2024_02_28_221327_generalmanageroperasional', 2),
(14, '2024_02_28_221357_passcode', 2),
(15, '2024_02_28_221511_userlist', 3),
(16, '2024_03_03_130459_barang', 4),
(17, '2024_03_03_130843_add_category_id_to_barang', 5),
(18, '2024_03_03_194535_barang', 6),
(19, '2024_03_03_194731_add_kategori_id_to_barang', 7),
(20, '2024_03_03_195150_add_harga_to_barang', 8),
(21, '2024_03_03_195317_add_kategori_id_to_barang', 9),
(22, '2024_03_08_040911_pelaporankegiatankriminalitas', 10),
(23, '2024_03_14_080622_add_id_pelanggan_belanja_bantuan_karyawan_to_userlist', 11),
(25, '2024_03_21_080737_metode_pembayaran', 12);

-- --------------------------------------------------------

--
-- Table structure for table `passcode`
--

CREATE TABLE `passcode` (
  `id_passcode` bigint(20) UNSIGNED NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `passcode`
--

INSERT INTO `passcode` (`id_passcode`, `password`, `created_at`, `updated_at`) VALUES
(1, 'IndomaretSelfService', NULL, NULL);

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
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nomor_telepon` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'inactive',
  `status_belanja_bantuan_karyawan` varchar(50) NOT NULL DEFAULT 'inactive',
  `gambar` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `email`, `nama`, `nomor_telepon`, `username`, `password`, `status`, `status_belanja_bantuan_karyawan`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'Yoel@gmail.com', 'Yoel', '0987654321', 'Yoel', '$2y$10$MS.iCt6e561sRvnOm5.yU.NqUK3bsI7Fk0hmD0ZhU7G8C.ixYqrb2', 'inactive', 'inactive', '1709161294_Thai Style Beef with Basil & Chillies.jpg', '2024-02-28 16:01:34', '2024-02-28 16:01:34'),
(2, '1@gmail.com', '1', '1', '1', '$2y$10$naamxQj2XKth/RPkhPnKCOFd2YROQe4MXakY.cU2SFFN6a28pPfye', 'inactive', 'inactive', '1710238707_02_Prabowo-Gibran_2024.svg.png', '2024-03-12 03:18:27', '2024-03-12 03:18:27'),
(3, '2@gmail.com', '2', '2', '2', '$2y$10$EnpeHwHMZChvRXjHoIZ07OLtZI73AyVnJigwTHwf06RrGt/A.Okvq', 'inactive', 'inactive', '1710766772_WhatsApp Image 2023-12-24 at 18.39.14_2ad6d8e3.jpg', '2024-03-18 05:59:32', '2024-03-18 05:59:32'),
(4, '3@gmail.com', '3', '3', '3', '$2y$10$ZP7RiLGRlGdY6baJZ0diJO8jKyF6slWg9YU3q85KpjphY/1QJ5LzO', 'inactive', 'inactive', '1711140823_Dancing Squirrels.gif', '2024-03-22 13:53:43', '2024-03-22 13:53:43');

-- --------------------------------------------------------

--
-- Table structure for table `pelaporankegiatankriminalitas`
--

CREATE TABLE `pelaporankegiatankriminalitas` (
  `id_pelaporankegiatankriminalitas` int(11) NOT NULL,
  `username` varchar(70) NOT NULL,
  `deskripsi` varchar(500) NOT NULL,
  `foto` varchar(500) NOT NULL,
  `statuspelaporan` varchar(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelaporankegiatankriminalitas`
--

INSERT INTO `pelaporankegiatankriminalitas` (`id_pelaporankegiatankriminalitas`, `username`, `deskripsi`, `foto`, `statuspelaporan`, `created_at`, `updated_at`) VALUES
(2, 'Yoel', 'Pencurian Ikang', '1710234715.png', 'Dalam Peninjauan', '2024-03-12 02:11:55', '2024-03-18 13:38:50');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` bigint(20) NOT NULL,
  `product_stock` bigint(20) NOT NULL,
  `product_picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_picture` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `transaction_status` varchar(255) NOT NULL,
  `product_price` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `transaction_id`, `user_id`, `product_id`, `product_name`, `product_picture`, `quantity`, `transaction_status`, `product_price`, `created_at`, `updated_at`) VALUES
(1, 1710235592, 3, 11111, 'Chitato Rasa Barberque', '1709495959.jpeg', 5, 'Paid', 13000, NULL, NULL),
(2, 1710291910, 4, 31111, 'Panadol Flu dan Batuk', '1709815296.jpg', 1, 'Paid', 12500, NULL, NULL),
(3, 1710292979, 3, 11111, 'Chitato Rasa Barberque', '1709495959.jpeg', 3, 'Paid', 13000, NULL, NULL),
(4, 1710292979, 3, 21111, 'Minute Maid Pulpy', '1709815339.png', 1, 'Paid', 7000, NULL, NULL),
(5, 1710299917, 3, 11111, 'Chitato Rasa Barberque', '1709495959.jpeg', 1, 'Paid', 13000, NULL, NULL),
(6, 1710306682, 3, 11111, 'Chitato Rasa Barberque', '1709495959.jpeg', 1, 'Paid', 13000, NULL, NULL),
(7, 1710306682, 3, 31111, 'Panadol Flu dan Batuk', '1709815296.jpg', 1, 'Paid', 12500, NULL, NULL),
(8, 1710306682, 3, 21111, 'Minute Maid Pulpy', '1709815339.png', 1, 'Paid', 7000, NULL, NULL),
(9, 1710406889, 3, 11111, 'Chitato Rasa Barberque', '1709495959.jpeg', 1, 'Paid', 13000, NULL, NULL),
(10, 1710406889, 3, 31111, 'Panadol Flu dan Batuk', '1709815296.jpg', 2, 'Paid', 12500, NULL, NULL),
(11, 1710406889, 3, 21111, 'Minute Maid Pulpy', '1709815339.png', 1, 'Paid', 7000, NULL, NULL),
(12, 1710407189, 3, 31111, 'Panadol Flu dan Batuk', '1709815296.jpg', 1, 'Paid', 12500, NULL, NULL),
(13, 1710410385, 4, 11111, 'Chitato Rasa Barberque', '1709495959.jpeg', 2, 'Paid', 13000, NULL, NULL),
(14, 1710410385, 4, 21111, 'Minute Maid Pulpy', '1709815339.png', 3, 'Paid', 7000, NULL, NULL),
(15, 1710410431, 3, 31111, 'Panadol Flu dan Batuk', '1709815296.jpg', 1, 'Paid', 12500, NULL, NULL),
(16, 1710410431, 3, 21111, 'Minute Maid Pulpy', '1709815339.png', 1, 'Paid', 7000, NULL, NULL),
(17, 1710572194, 3, 21111, 'Minute Maid Pulpy', '1709815339.png', 1, 'Paid', 7000, NULL, NULL),
(18, 1710572341, 4, 11111, 'Chitato Rasa Barberque', '1709495959.jpeg', 1, 'Paid', 13000, NULL, NULL),
(19, 1710572341, 4, 31111, 'Panadol Flu dan Batuk', '1709815296.jpg', 10, 'Paid', 12500, NULL, NULL),
(20, 1710573962, 4, 11111, 'Chitato Rasa Barberque', '1709495959.jpeg', 4, 'Paid', 13000, NULL, NULL),
(21, 1710590695, 3, 11111, 'Chitato Rasa Barberque', '1709495959.jpeg', 4, 'Paid', 13000, NULL, NULL),
(22, 1710590808, 4, 11111, 'Chitato Rasa Barberque', '1709495959.jpeg', 4, 'Paid', 13000, NULL, NULL),
(23, 1710590860, 4, 31111, 'Panadol Flu dan Batuk', '1709815296.jpg', 4, 'Paid', 12500, NULL, NULL),
(24, 1710590877, 4, 11111, 'Chitato Rasa Barberque', '1709495959.jpeg', 1, 'Paid', 13000, NULL, NULL),
(25, 1710590971, 3, 11111, 'Chitato Rasa Barberque', '1709495959.jpeg', 7, 'Paid', 13000, NULL, NULL),
(26, 1710591038, 3, 31111, 'Panadol Flu dan Batuk', '1709815296.jpg', 10, 'Paid', 12500, NULL, NULL),
(27, 1710591089, 4, 31111, 'Panadol Flu dan Batuk', '1709815296.jpg', 2, 'Paid', 12500, NULL, NULL),
(28, 1710591107, 4, 31111, 'Panadol Flu dan Batuk', '1709815296.jpg', 10, 'Paid', 12500, NULL, NULL),
(29, 1710591260, 3, 11111, 'Chitato Rasa Barberque', '1709495959.jpeg', 11, 'Paid', 13000, NULL, NULL),
(30, 1710742539, 3, 11111, 'Chitato Rasa Barberque', '1709495959.jpeg', 7, 'Paid', 13000, NULL, NULL),
(31, 1710742539, 3, 31111, 'Panadol Flu dan Batuk', '1709815296.jpg', 3, 'Paid', 12500, NULL, NULL),
(32, 1710742539, 3, 21111, 'Minute Maid Pulpy', '1709815339.png', 1, 'Paid', 7000, NULL, NULL),
(33, 1710742539, 3, 41111, 'Wipol', '1710729407.jpg', 1, 'Paid', 10200, NULL, NULL),
(34, 1710791814, 3, 21111, 'Minute Maid Pulpy', '1709815339.png', 4, 'Paid', 7000, NULL, NULL),
(35, 1710791814, 3, 11111, 'Chitato Rasa Barberque', '1709495959.jpeg', 1, 'Paid', 13000, NULL, NULL),
(36, 1710793138, 4, 21111, 'Minute Maid Pulpy', '1709815339.png', 10, 'Paid', 7000, NULL, NULL),
(37, 1710793250, 4, 41111, 'Wipol', '1710729407.jpg', 1, 'Paid', 10200, NULL, NULL),
(38, 1710797199, 5, 11111, 'Chitato Rasa Barberquea', '1709495959.jpeg', 1, 'Paid', 13000, NULL, NULL),
(39, 1710906219, 3, 11111, 'Chitato Rasa Barberquea', '1709495959.jpeg', 5, 'Paid', 13000, NULL, NULL),
(40, 1710906416, 3, 11111, 'Chitato Rasa Barberquea', '1709495959.jpeg', 1, 'Paid', 13000, NULL, NULL),
(41, 1710906596, 3, 11111, 'Chitato Rasa Barberquea', '1709495959.jpeg', 4, 'Paid', 13000, NULL, NULL),
(42, 1710906596, 3, 31111, 'Panadol Flu dan Batuk', '1709815296.jpg', 1, 'Paid', 12500, NULL, NULL),
(43, 1710906596, 3, 21111, 'Minute Maid Pulpy', '1709815339.png', 1, 'Paid', 7000, NULL, NULL),
(44, 1710906596, 3, 41111, 'Wipol', '1710729407.jpg', 1, 'Paid', 10200, NULL, NULL),
(45, 1710906596, 3, 41112, 'Saniter', '1710740517.jpg', 5, 'Paid', 27500, NULL, NULL),
(46, 1710906596, 3, 51111, 'Tayo Little Bus', '1710793848.jpeg', 7, 'Paid', 30000, NULL, NULL),
(47, 1710906625, 3, 51111, 'Tayo Little Bus', '1710793848.jpeg', 1, 'Paid', 30000, NULL, NULL),
(48, 1710906707, 3, 11111, 'Chitato Rasa Barberquea', '1709495959.jpeg', 1, 'Paid', 13000, NULL, NULL),
(49, 1710906738, 3, 11111, 'Chitato Rasa Barberquea', '1709495959.jpeg', 1, 'Paid', 13000, NULL, NULL),
(50, 1710906762, 3, 31111, 'Panadol Flu dan Batuk', '1709815296.jpg', 1, 'Paid', 12500, NULL, NULL),
(51, 1710906903, 3, 51111, 'Tayo Little Bus', '1710793848.jpeg', 5, 'Paid', 30000, NULL, NULL),
(52, 1710906903, 3, 41112, 'Saniter', '1710740517.jpg', 1, 'Paid', 27500, NULL, NULL),
(53, 1710906903, 3, 41111, 'Wipol', '1710729407.jpg', 1, 'Paid', 10200, NULL, NULL),
(54, 1710906903, 3, 21111, 'Minute Maid Pulpy', '1709815339.png', 1, 'Paid', 7000, NULL, NULL),
(55, 1710906903, 3, 31111, 'Panadol Flu dan Batuk', '1709815296.jpg', 4, 'Paid', 12500, NULL, NULL),
(56, 1710906903, 3, 11111, 'Chitato Rasa Barberquea', '1709495959.jpeg', 2, 'Paid', 13000, NULL, NULL),
(57, 1710998417, 3, 11111, 'Chitato Rasa Barberquea', '1709495959.jpeg', 2, 'Paid', 13000, NULL, NULL),
(58, 1710998417, 3, 51111, 'Tayo Little Bus', '1710793848.jpeg', 1, 'Paid', 30000, NULL, NULL),
(59, 1710998417, 3, 21111, 'Minute Maid Pulpy', '1709815339.png', 1, 'Paid', 7000, NULL, NULL),
(60, 1711010800, 3, 11111, 'Chitato Rasa Barberquea', '1709495959.jpeg', 1, 'Paid', 13000, NULL, NULL),
(61, 1711010800, 3, 31111, 'Panadol Flu dan Batuk', '1709815296.jpg', 1, 'Paid', 12500, NULL, NULL),
(62, 1711010800, 3, 21111, 'Minute Maid Pulpy', '1709815339.png', 1, 'Paid', 7000, NULL, NULL),
(63, 1711010800, 3, 41111, 'Wipol', '1710729407.jpg', 1, 'Paid', 10200, NULL, NULL),
(64, 1711010800, 3, 41112, 'Saniter', '1710740517.jpg', 1, 'Paid', 27500, NULL, NULL),
(65, 1711010800, 3, 51111, 'Tayo Little Bus', '1710793848.jpeg', 2, 'Paid', 30000, NULL, NULL),
(66, 1711011773, 3, 31111, 'Panadol Flu dan Batuk', '1709815296.jpg', 1, 'Paid', 12500, NULL, NULL),
(67, 1711012538, 3, 11111, 'Chitato Rasa Barberquea', '1709495959.jpeg', 1, 'Paid', 13000, NULL, NULL),
(68, 1711013036, 3, 11111, 'Chitato Rasa Barberquea', '1709495959.jpeg', 1, 'Paid', 13000, NULL, NULL),
(69, 1711013415, 3, 11111, 'Chitato Rasa Barberquea', '1709495959.jpeg', 1, 'Paid', 13000, NULL, NULL),
(70, 1711013612, 3, 11111, 'Chitato Rasa Barberquea', '1709495959.jpeg', 1, 'Paid', 13000, NULL, NULL),
(71, 1711014865, 3, 31111, 'Panadol Flu dan Batuk', '1709815296.jpg', 1, 'Paid', 12500, NULL, NULL),
(72, 1711014887, 3, 51111, 'Tayo Little Bus', '1710793848.jpeg', 1, 'Paid', 30000, NULL, NULL),
(73, 1711016251, 3, 41112, 'Saniter', '1710740517.jpg', 1, 'Paid', 27500, NULL, NULL),
(74, 1711016269, 3, 11111, 'Chitato Rasa Barberquea', '1709495959.jpeg', 1, 'Paid', 13000, NULL, NULL),
(75, 1711016286, 3, 11111, 'Chitato Rasa Barberquea', '1709495959.jpeg', 1, 'Paid', 13000, NULL, NULL),
(76, 1711016296, 3, 21111, 'Minute Maid Pulpy', '1709815339.png', 1, 'Paid', 7000, NULL, NULL),
(77, 1711016306, 3, 51111, 'Tayo Little Bus', '1710793848.jpeg', 1, 'Paid', 30000, NULL, NULL),
(78, 1711016568, 3, 41111, 'Wipol', '1710729407.jpg', 1, 'Paid', 10200, NULL, NULL),
(79, 1711016615, 3, 41112, 'Saniter', '1710740517.jpg', 1, 'Paid', 27500, NULL, NULL),
(80, 1711016708, 3, 41112, 'Saniter', '1710740517.jpg', 1, 'Paid', 27500, NULL, NULL),
(81, 1711016921, 3, 41112, 'Saniter', '1710740517.jpg', 3, 'Paid', 27500, NULL, NULL),
(82, 1711017897, 3, 21111, 'Minute Maid Pulpy', '1709815339.png', 1, 'Paid', 7000, NULL, NULL),
(83, 1711017915, 3, 31111, 'Panadol Flu dan Batuk', '1709815296.jpg', 1, 'Paid', 12500, NULL, NULL),
(84, 1711017946, 3, 51111, 'Tayo Little Bus', '1710793848.jpeg', 1, 'Paid', 30000, NULL, NULL),
(85, 1711018088, 3, 51111, 'Tayo Little Bus', '1710793848.jpeg', 1, 'Paid', 30000, NULL, NULL),
(86, 1711018392, 3, 51111, 'Tayo Little Bus', '1710793848.jpeg', 1, 'Paid', 30000, NULL, NULL),
(87, 1711018487, 3, 51111, 'Tayo Little Bus', '1710793848.jpeg', 7, 'Paid', 30000, NULL, NULL),
(88, 1711018581, 4, 11111, 'Chitato Rasa Barberquea', '1709495959.jpeg', 1, 'Paid', 13000, NULL, NULL),
(89, 1711018581, 4, 31111, 'Panadol Flu dan Batuk', '1709815296.jpg', 6, 'Paid', 12500, NULL, NULL),
(90, 1711018581, 4, 21111, 'Minute Maid Pulpy', '1709815339.png', 1, 'Paid', 7000, NULL, NULL),
(91, 1711018976, 4, 41111, 'Wipol', '1710729407.jpg', 1, 'Paid', 10200, NULL, NULL),
(92, 1711018991, 4, 41111, 'Wipol', '1710729407.jpg', 1, 'Paid', 10200, NULL, NULL),
(93, 1711142308, 6, 51111, 'Tayo Little Bus', '1710793848.jpeg', 1, 'Paid', 30000, NULL, NULL),
(94, 1711142308, 6, 21111, 'Minute Maid Pulpy', '1709815339.png', 14, 'Paid', 7000, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userlist`
--

CREATE TABLE `userlist` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nomor_telepon` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL DEFAULT 'pelanggan',
  `status` varchar(50) NOT NULL DEFAULT 'inactive',
  `status_belanja_bantuan_karyawan` varchar(50) NOT NULL DEFAULT 'inactive',
  `gambar` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_pelanggan_belanja_bantuan_karyawan` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `userlist`
--

INSERT INTO `userlist` (`id`, `email`, `nama`, `nomor_telepon`, `username`, `password`, `jabatan`, `status`, `status_belanja_bantuan_karyawan`, `gambar`, `created_at`, `updated_at`, `id_pelanggan_belanja_bantuan_karyawan`) VALUES
(1, 'Fanomulyadi@gmail.com', 'Fano', '123456', 'Fano', '$2y$10$gbFbGGucDrA1FGVesn0KMupBERESn2GjFopd6W4vNZ5TpH0OXnxuS', 'generalmanageroperasional', 'active', 'inactive', 'Shaun The Sheep 1.gif', '2024-02-28 15:37:03', '2024-03-22 15:14:42', 0),
(2, 'Virgin@gmail.com', 'Virgin', '1234567890', 'Virgin', '$2y$10$y0Zz74tyh4vRlQ4YW0NW6unEruhKxANOHM.SKOOTdYdZIfDJvVioa', 'karyawan', 'inactive', 'inactive', '1709159906_Vic Firth American Classic 5A Barrel.png', '2024-02-28 15:38:26', '2024-03-19 21:14:49', 0),
(3, 'Yoel@gmail.com', 'Yoel', '0987654321', 'Yoel', '$2y$10$MS.iCt6e561sRvnOm5.yU.NqUK3bsI7Fk0hmD0ZhU7G8C.ixYqrb2', 'pelanggan', 'inactive', 'inactive', '1709161294_Thai Style Beef with Basil & Chillies.jpg', '2024-02-28 16:01:34', '2024-03-22 14:17:49', 0),
(4, '1@gmail.com', '1', '1', '1', '$2y$10$naamxQj2XKth/RPkhPnKCOFd2YROQe4MXakY.cU2SFFN6a28pPfye', 'pelanggan', 'inactive', 'inactive', 'Shopping.gif', '2024-03-12 03:18:27', '2024-03-22 03:46:41', 0),
(5, '2@gmail.com', '2', '2', '2', '$2y$10$EnpeHwHMZChvRXjHoIZ07OLtZI73AyVnJigwTHwf06RrGt/A.Okvq', 'pelanggan', 'inactive', 'inactive', '1710766772_WhatsApp Image 2023-12-24 at 18.39.14_2ad6d8e3.jpg', '2024-03-18 05:59:32', '2024-03-18 14:28:13', 0),
(6, '3@gmail.com', '3', '3', '3', '$2y$10$ZP7RiLGRlGdY6baJZ0diJO8jKyF6slWg9YU3q85KpjphY/1QJ5LzO', 'pelanggan', 'inactive', 'inactive', '1711140823_Dancing Squirrels.gif', '2024-03-22 13:53:43', '2024-03-22 15:14:37', 0);

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
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD KEY `barang_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `generalmanageroperasional`
--
ALTER TABLE `generalmanageroperasional`
  ADD PRIMARY KEY (`id_generalmanageroperasional`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passcode`
--
ALTER TABLE `passcode`
  ADD PRIMARY KEY (`id_passcode`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pelaporankegiatankriminalitas`
--
ALTER TABLE `pelaporankegiatankriminalitas`
  ADD PRIMARY KEY (`id_pelaporankegiatankriminalitas`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlist`
--
ALTER TABLE `userlist`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `generalmanageroperasional`
--
ALTER TABLE `generalmanageroperasional`
  MODIFY `id_generalmanageroperasional` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `passcode`
--
ALTER TABLE `passcode`
  MODIFY `id_passcode` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pelaporankegiatankriminalitas`
--
ALTER TABLE `pelaporankegiatankriminalitas`
  MODIFY `id_pelaporankegiatankriminalitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `userlist`
--
ALTER TABLE `userlist`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
