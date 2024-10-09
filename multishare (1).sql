-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 09 Okt 2024 pada 05.41
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `multishare`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `access_path`
--

CREATE TABLE `access_path` (
  `id` varchar(36) NOT NULL,
  `pid` varchar(36) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `urutan` int DEFAULT NULL,
  `urutan_path` text,
  `link` varchar(255) DEFAULT NULL,
  `pid_path` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `access_path`
--

INSERT INTO `access_path` (`id`, `pid`, `nama`, `icon`, `urutan`, `urutan_path`, `link`, `pid_path`) VALUES
('25c2944c-f7be-45d0-84f4-2e1d2f530b4a', 'e10e4cd1-137d-46d7-bb0f-7864cfc5a4fc', 'Akses', 'dripicons-checkmark', 3, NULL, 'setaccess', '131ca369-c607-11ec-9240-809133ff6caa,32361898-c607-11ec-9240-809133ff6caa,25c2944c-f7be-45d0-84f4-2e1d2f530b4a'),
('32361898-c607-11ec-9240-809133ff6caa', '', 'Settings', 'icon-fa fas fa-cog', 1, '', 'MetricaSetting', '131ca369-c607-11ec-9240-809133ff6caa'),
('a737d05f-c607-11ec-9240-809133ff6caa', 'e10e4cd1-137d-46d7-bb0f-7864cfc5a4fc', 'User', 'dripicons-user', 1, NULL, 'setusermanagement', '131ca369-c607-11ec-9240-809133ff6caa,32361898-c607-11ec-9240-809133ff6caa,a737d05f-c607-11ec-9240-809133ff6caa'),
('d0bbd8eb-a466-453e-96cc-39b0d8192e9c', '', 'Setting', 'icon-fa fas fa-cog', 2, '02', 'MetricaSetting', NULL),
('d1c8f634-c607-11ec-9240-809133ff6caa', 'e10e4cd1-137d-46d7-bb0f-7864cfc5a4fc', 'Group', 'dripicons-user-group', 2, NULL, 'setgroup', '131ca369-c607-11ec-9240-809133ff6caa,32361898-c607-11ec-9240-809133ff6caa,d1c8f634-c607-11ec-9240-809133ff6caa'),
('e10e4cd1-137d-46d7-bb0f-7864cfc5a4fc', '32361898-c607-11ec-9240-809133ff6caa', 'User Access', 'icon-fa fas fa-users', 1, '', '', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `group_access`
--

CREATE TABLE `group_access` (
  `id` varchar(36) NOT NULL,
  `group_id` varchar(36) NOT NULL,
  `access_id` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `group_access`
--

INSERT INTO `group_access` (`id`, `group_id`, `access_id`) VALUES
('2f0de4b1-0939-4f80-90be-af14f1bf20e5', '4673beb8-bbaf-11ec-be92-809133ff6caa', 'e10e4cd1-137d-46d7-bb0f-7864cfc5a4fc'),
('40d61527-c39a-451c-8134-f1014fb5f883', '4673beb8-bbaf-11ec-be92-809133ff6caa', '32361898-c607-11ec-9240-809133ff6caa'),
('cd9a3a77-a820-4b53-af79-7c8b366216d2', '4673beb8-bbaf-11ec-be92-809133ff6caa', 'd1c8f634-c607-11ec-9240-809133ff6caa'),
('d50bf3ac-43a2-4036-a03f-124f0ebdfc35', '4673beb8-bbaf-11ec-be92-809133ff6caa', '25c2944c-f7be-45d0-84f4-2e1d2f530b4a'),
('ea4354d1-b8f6-40c3-aa63-e32b5b7cfdb2', '4673beb8-bbaf-11ec-be92-809133ff6caa', 'a737d05f-c607-11ec-9240-809133ff6caa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `group_path`
--

CREATE TABLE `group_path` (
  `id` varchar(36) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` text,
  `landing_page` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `group_path`
--

INSERT INTO `group_path` (`id`, `nama`, `deskripsi`, `landing_page`) VALUES
('4673beb8-bbaf-11ec-be92-809133ff6caa', 'ADMIN', 'As an Admin', 'setaccess'),
('55c6ff60-9b6b-447e-8dbb-9fe9fb6f223f', 'USER', 'User', 'setsetting');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sys_profile`
--

CREATE TABLE `sys_profile` (
  `id` varchar(36) NOT NULL,
  `syslogo` varchar(255) DEFAULT NULL,
  `systitle` varchar(255) DEFAULT NULL,
  `sysname` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `sys_profile`
--

INSERT INTO `sys_profile` (`id`, `syslogo`, `systitle`, `sysname`) VALUES
('7ee2b583-1316-11ed-b785-e82a44eb9daf', '7ee2b583-1316-11ed-b785-e82a44eb9daf.jpeg', 'Multi Sharing', 'Oktav');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `register_token` varchar(255) DEFAULT NULL,
  `group_id` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `status`, `last_login`, `reset_token`, `register_token`, `group_id`) VALUES
('0cc1e24e-130d-11ed-b785-e82a44eb9daf', 'Admin', 'admin@gmail.com', 'beb0781567aaa6c4be14eebf8f9eea5344ee836d8313bf32873ef8f1232b196b260a4aa621aa5fe4c1466287349b1e008ec5c083dae5fe41b88ea2530b20f298484a5c64a82d9fc8921117a29572ee747a79fffe07', 1, '2024-10-09 06:22:16', NULL, NULL, '4673beb8-bbaf-11ec-be92-809133ff6caa'),
('24af9ca3-86cd-4ec5-b41d-7932b86ebede', 'Kiki', 'user@gmail.com', '73dcb26540a98f4f6343ec1f06bc08db746dd1add168a4cb9d5bf73fa3d189f7b3d779514a950d0b1d8386ee622d0df50e7ffb1283267eab659fafacd862e6b849900480db9f812e5256d3069407ba3160b4b7a698', 1, NULL, NULL, 'c8a333d86242b4aad9a860de883e8546eb0da37d0fdb53caa0c645046b824482d09b8555f77e8334ce1f011ee16ca4225e3111df0abad94bd2c9b9bc8ada4bc2fdea86cb308924df9902efe8bc6f4528dee12c29aae62c', '55c6ff60-9b6b-447e-8dbb-9fe9fb6f223f');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_approval`
--

CREATE TABLE `user_approval` (
  `id` varchar(36) NOT NULL,
  `approved_by` varchar(36) NOT NULL,
  `user_id` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `access_path`
--
ALTER TABLE `access_path`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `group_access`
--
ALTER TABLE `group_access`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `group_path`
--
ALTER TABLE `group_path`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sys_profile`
--
ALTER TABLE `sys_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `user_approval`
--
ALTER TABLE `user_approval`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
