-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Nov 2025 pada 11.30
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skillhub`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-1c31ecdcf43a4c45335e125fdd661c66', 'i:1;', 1763824839),
('laravel-cache-1c31ecdcf43a4c45335e125fdd661c66:timer', 'i:1763824839;', 1763824839),
('laravel-cache-6f490d3096104ab101ef5d026390ae50', 'i:1;', 1763891700),
('laravel-cache-6f490d3096104ab101ef5d026390ae50:timer', 'i:1763891700;', 1763891700),
('laravel-cache-81bf2fec292c5d25cf6bdfe14456d433', 'i:1;', 1763881984),
('laravel-cache-81bf2fec292c5d25cf6bdfe14456d433:timer', 'i:1763881984;', 1763881984),
('laravel-cache-add|127.0.0.1', 'i:1;', 1763881985),
('laravel-cache-add|127.0.0.1:timer', 'i:1763881985;', 1763881985);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `jobs`
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
-- Struktur dari tabel `job_batches`
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
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_09_02_075243_add_two_factor_columns_to_users_table', 1),
(5, '2025_11_22_014640_create_ms_members_table', 1),
(6, '2025_11_22_014652_create_ms_classes_table', 1),
(7, '2025_11_22_014702_create_tr_class_members_table', 1),
(9, '2025_11_22_052132_update_ms_members_make_email_phone_required', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_classes`
--

CREATE TABLE `ms_classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `instructor` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ms_classes`
--

INSERT INTO `ms_classes` (`id`, `name`, `description`, `instructor`, `created_at`, `updated_at`) VALUES
(1, 'Desain Grafis', 'Pelatihan desain grafis menggunakan Adobe Photoshop, Illustrator, dan CorelDraw', 'Pak Agus Wijaya', '2025-11-21 18:58:22', '2025-11-21 18:58:22'),
(2, 'Pemrograman Dasar', 'Belajar dasar-dasar pemrograman menggunakan Python dan JavaScript', 'Bu Sari Indrawati', '2025-11-21 18:58:22', '2025-11-21 18:58:22'),
(3, 'Editing Video', 'Pelatihan editing video menggunakan Adobe Premiere Pro dan After Effects', 'Pak Budi Santoso', '2025-11-21 18:58:22', '2025-11-21 18:58:22'),
(4, 'Public Speaking', 'Meningkatkan kemampuan berbicara di depan umum dan presentasi', 'Bu Maya Sari', '2025-11-21 18:58:22', '2025-11-21 18:58:22'),
(5, 'Digital Marketing', 'Strategi pemasaran digital menggunakan social media dan SEO', 'Pak Rudi Hartono', '2025-11-21 18:58:22', '2025-11-21 18:58:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_members`
--

CREATE TABLE `ms_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ms_members`
--

INSERT INTO `ms_members` (`id`, `name`, `email`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Budi Santoso', 'budi@example.com', '081234567890', 'Jakarta', '2025-11-21 18:58:22', '2025-11-21 18:58:22'),
(2, 'Siti Nurhaliza', 'siti@example.com', '081234567891', 'Bandung', '2025-11-21 18:58:22', '2025-11-21 18:58:22'),
(3, 'Ahmad Fauzi', 'ahmad@example.com', '081234567892', 'Surabaya', '2025-11-21 18:58:22', '2025-11-21 18:58:22'),
(4, 'Dewi Lestari', 'dewi@example.com', '081234567893', 'Yogyakarta', '2025-11-21 18:58:22', '2025-11-21 18:58:22'),
(5, 'Rudi Hartono', 'rudi@example.com', '081234567894', 'Medan', '2025-11-21 18:58:22', '2025-11-21 18:58:22'),
(6, 'Maya Sari', 'maya@example.com', '081234567895', 'Semarang', '2025-11-21 18:58:22', '2025-11-21 18:58:22'),
(7, 'Indra Gunawan', 'indra@example.com', '081234567896', 'Makassar', '2025-11-21 18:58:22', '2025-11-21 18:58:22'),
(8, 'Lina Wijaya', 'lina@example.com', '081234567897', 'Palembang', '2025-11-21 18:58:22', '2025-11-21 18:58:22'),
(9, 'Eko Prasetyo', 'eko@example.com', '081234567898', 'Denpasar', '2025-11-21 18:58:22', '2025-11-21 18:58:22'),
(12, 'Jesslyn L', 'jesslyn@example.co.id', '0812222222222', 'jalan\n', '2025-11-21 20:01:59', '2025-11-21 20:02:45'),
(22, 'dodi', 'jlevanahalim@student.ciputra.ac.id', '098987697865', NULL, '2025-11-22 19:27:25', '2025-11-22 19:27:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
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
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('6ZJ1l4hDb9NzgJxYDBGTQwol6wPYDFlrMhPlxQvG', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiU0s0NHFyV2xtTGhxcDkxcEYzVEk4bnpVaHhkOWZDcms1TDBwUEhyQiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9tZW1iZXJzIjtzOjU6InJvdXRlIjtzOjEzOiJtZW1iZXJzLmluZGV4Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1763891659),
('iLaJDZtg434tqBEmFErH5GWJF64Y2n88L6dClD2C', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 OPR/123.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMVFUdjR6c0xmdDNPcG93cFZTM2tZMVZDQ2xab0E5SzNwRVFETlpZSiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1763881651);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_class_members`
--

CREATE TABLE `tr_class_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ms_class_id` bigint(20) UNSIGNED NOT NULL,
  `ms_member_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tr_class_members`
--

INSERT INTO `tr_class_members` (`id`, `ms_class_id`, `ms_member_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-11-21 18:58:23', '2025-11-21 18:58:23'),
(2, 2, 1, '2025-11-21 18:58:23', '2025-11-21 18:58:23'),
(3, 3, 1, '2025-11-21 18:58:23', '2025-11-21 18:58:23'),
(4, 1, 2, '2025-11-21 18:58:23', '2025-11-21 18:58:23'),
(5, 4, 2, '2025-11-21 18:58:23', '2025-11-21 18:58:23'),
(8, 3, 4, '2025-11-21 18:58:23', '2025-11-21 18:58:23'),
(10, 4, 5, '2025-11-21 18:58:23', '2025-11-21 18:58:23'),
(11, 5, 5, '2025-11-21 18:58:23', '2025-11-21 18:58:23'),
(13, 2, 6, '2025-11-21 18:58:23', '2025-11-21 18:58:23'),
(15, 3, 7, '2025-11-21 18:58:23', '2025-11-21 18:58:23'),
(16, 4, 7, '2025-11-21 18:58:23', '2025-11-21 18:58:23'),
(17, 5, 8, '2025-11-21 18:58:23', '2025-11-21 18:58:23'),
(19, 1, 9, '2025-11-21 18:58:23', '2025-11-21 18:58:23'),
(20, 5, 9, '2025-11-21 18:58:23', '2025-11-21 18:58:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `user_id`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin123', '$2y$12$DWemJ/czMrXZrO3H7FqThu/PU1CNftavvBddTz4IQKbrGXk7plR8a', NULL, NULL, NULL, NULL, '2025-11-21 18:58:22', '2025-11-21 19:26:50');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ms_classes`
--
ALTER TABLE `ms_classes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ms_members`
--
ALTER TABLE `ms_members`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `tr_class_members`
--
ALTER TABLE `tr_class_members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tr_class_members_ms_class_id_ms_member_id_unique` (`ms_class_id`,`ms_member_id`),
  ADD KEY `tr_class_members_ms_member_id_foreign` (`ms_member_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_user_id_unique` (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `ms_classes`
--
ALTER TABLE `ms_classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `ms_members`
--
ALTER TABLE `ms_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `tr_class_members`
--
ALTER TABLE `tr_class_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tr_class_members`
--
ALTER TABLE `tr_class_members`
  ADD CONSTRAINT `tr_class_members_ms_class_id_foreign` FOREIGN KEY (`ms_class_id`) REFERENCES `ms_classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tr_class_members_ms_member_id_foreign` FOREIGN KEY (`ms_member_id`) REFERENCES `ms_members` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
