-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jan 2025 pada 13.46
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mhs`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `judul`, `deskripsi`, `tanggal`) VALUES
(2, 'Sistem Informasi Akademik', 'Selamat datang di Sistem Informasi Akademik Universitas Mercu Buana', '2024-12-29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_dosen`
--

CREATE TABLE `tb_dosen` (
  `id_dosen` int(11) NOT NULL,
  `nama_dosen` varchar(40) NOT NULL,
  `nik_nidn` int(30) NOT NULL,
  `prodi` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `foto` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_dosen`
--

INSERT INTO `tb_dosen` (`id_dosen`, `nama_dosen`, `nik_nidn`, `prodi`, `email`, `no_telp`, `foto`) VALUES
(1, 'Agus Darmawan', 199809877, 'Informatika', 'Agus_dar@yahoo.co.id', '021894567xxx', 0x706e672d7472616e73706172656e742d66616d696c792d7369626c696e672d7369626c696e67732d6368696c6472656e2d62726f746865722d626162792d6b6964732d62726f74686572732d6769726c2d746f6765746865722d7468756d626e61696c2e706e67),
(3, 'Agus Hermawan', 199809889, 'Informatika', 'agusher@gmail.com', '081576899', ''),
(4, 'Agus Sulistiyo', 199809874, 'Informasi', 'agus_sul@gmail.com', '0816786543', ''),
(5, 'Budi Anwar Sanusi', 1987654319, 'Teknik Informatika', 'bud_aw@yahoo.co.id', '0816786556', ''),
(6, 'Budi Gunawan', 1987654309, 'Teknik Informasi', 'budi_gd@yahoo.co.id', '0812347689', ''),
(7, 'Budi Sarwito', 1987654313, 'Teknik Informatika', 'budisarwito@yahoo.co.id', '0816786511', ''),
(8, 'Budiman', 1987654309, 'Teknik Informasi', 'budiman@yahoo.co.id', '0812347667', ''),
(9, 'Cecep Firdaus', 1987654369, 'Teknik Komputer', 'cepfir@gmail.com', '0813786995', ''),
(10, 'Cecep Nurcahyo', 1987654379, 'Teknik Informatika', 'CN@gmail.com', '0817786589', ''),
(11, 'jajang', 129281212, 'Bisnis', 'jajagaming@gmail', '087639913891', ''),
(13, 'agus', 892425, 'Sastra Indo', 'jkdj@jsfd', '08402552', 0x61627374726163742d68657861676f6e2d6261636b67726f756e642d746563686e6f6c6f67792d706f6c69676f6e616c2d64657369676e2d6469676974616c2d667574757269737469632d6d696e696d616c69736d5f3131383333312d3430312e6a7067),
(14, 'palmer', 39010131, 'Olahraga', 'pal@fka', '9340913', 0x57686174734170705f496d6167655f323032342d31322d32335f61745f31375f35305f30322e6a706567),
(15, 'palmeri', 9203901, 'kedokteran', 'palmjan@mf', '0000313901', 0x6176617461722e706e67);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_matkul`
--

CREATE TABLE `tb_matkul` (
  `id_matkul` int(11) NOT NULL,
  `kode_matkul` varchar(10) NOT NULL,
  `nama_matkul` varchar(100) NOT NULL,
  `sks` int(4) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `semester` int(3) NOT NULL,
  `hari` varchar(20) NOT NULL,
  `waktu` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_matkul`
--

INSERT INTO `tb_matkul` (`id_matkul`, `kode_matkul`, `nama_matkul`, `sks`, `jurusan`, `semester`, `hari`, `waktu`) VALUES
(13, 'IF101', 'Pemrograman Dasar Web ', 3, 'Informatika', 1, 'Senin', '08:00-10:15'),
(14, 'IF102', 'Struktur Data 2', 3, 'Informatika', 3, 'Selasa', '10:00-12:00'),
(15, 'IF104', 'Sistem Operasi', 3, 'Informatika', 2, 'Rabu', '08:00-10:15'),
(17, 'MK102', 'Akuntansi Dasar', 3, 'Ekonomi', 2, 'Kamis', '08:00-10:15 '),
(18, 'MK103', 'Manajemen Pemasaran', 2, 'Ekonomi', 1, 'Jumat', '10:00-12:00'),
(19, 'MK104', 'Hukum Bisnis', 3, 'Hukum', 2, 'Senin', '10:00-12:00'),
(20, 'MK105', 'Sosiologi', 2, 'Sosiologi', 3, 'Selasa', '08:00-10:15'),
(21, 'MK106', 'Psikologi Sosial', 3, 'Psikologi', 3, 'Rabu', '10:00-12:00'),
(22, 'MK107', 'Hukum Pidana', 3, 'Hukum', 4, 'Kamis', '10:00-12:00'),
(23, 'IF105', 'Mathematical Tools', 3, 'Informatika', 5, 'Senin', '07:30-10:15'),
(24, 'HK020', 'KUHP', 2, 'Hukum', 4, 'Kamis', '10:00-12:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_mhs`
--

CREATE TABLE `tb_mhs` (
  `id_mhs` int(11) NOT NULL,
  `nama_mhs` varchar(255) NOT NULL,
  `nim` int(11) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jurusan` varchar(255) NOT NULL,
  `email` varchar(25) NOT NULL,
  `no_telp` int(20) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `semester` int(3) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_mhs`
--

INSERT INTO `tb_mhs` (`id_mhs`, `nama_mhs`, `nim`, `alamat`, `tgl_lahir`, `jurusan`, `email`, `no_telp`, `foto`, `semester`, `id_user`) VALUES
(11, 'cecep', 6545657, 'KP. BARU', '2024-09-02', 'mgfgnf', 'wawa@gmail.com', 90790686, 'WhatsApp_Image_2024-10-22_at_08_53_06.jpeg', 1, 26),
(12, 'rulz', 75675675, 'ngfhtnetdg', '2024-10-28', 'jukiyuiryhe', 'bdfhftgre@gdgr', 87685674, 'Business_Model_Canvas_KWU_3_(1)_page-0001.jpg', 0, 27),
(20, 'syahrul', 2147483647, 'KP. BARU', '2021-02-05', 'Bisnis', 'rul0502@gmail', 390029421, 'cover.png', 0, 17),
(21, 'huhu', 734824, 'jakspo', '2024-12-01', 'Teknik Informatika', 'djak@jf', 38193433, 'WhatsApp_Image_2024-12-23_at_17_50_03_(1).jpeg', 0, 16),
(23, 'agus', 4524241, 'welll', '2024-02-12', 'sigam', 'agus@hhigao', 674656, '52eb7f0dc57f815ae45b0e898b7ef3d1_t.jpeg', 0, 21),
(24, 'Didi', 2124544, 'Jakarta Pusat', '2003-02-11', 'Ekonomi', 'didi@gmail.com', 897428454, 'images_(1).jpg', 0, 24),
(29, 'hafiz', 2147483647, 'Jakarta Barat', '2017-06-21', 'Hukum', 'hafiz12@gmail', 893748242, 'user1-128x128.jpg', 2, 23),
(30, 'jdfksfs', 72387183, 'djfskf', '2025-01-07', 'Hukum', 'ajd@ja', 90899131, 'avatar4.png', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_users`
--

CREATE TABLE `tb_users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_users`
--

INSERT INTO `tb_users` (`id_user`, `username`, `password`, `role`, `created_at`, `foto`) VALUES
(1, 'admin', '024d7f84fff11dd7e8d9c510137a2381', 'admin', '2024-12-24 07:23:09', 'user_1_1736849513.jpg'),
(4, 'tata', '72446060a8ac34628d77aa1aad90d776', 'user', '2024-12-25 10:50:14', ''),
(5, 'syahrul', '024d7f84fff11dd7e8d9c510137a2381', 'user', '2024-12-25 11:45:57', ''),
(6, 'rulz', '202cb962ac59075b964b07152d234b70', 'user', '2024-12-30 10:24:16', 'user_6_1735673153.png'),
(16, 'huhu123', '202cb962ac59075b964b07152d234b70', 'user', '2025-01-01 00:44:20', ''),
(17, 'syahrul123', '202cb962ac59075b964b07152d234b70', 'user', '2025-01-01 00:46:08', ''),
(18, 'adminnew', '202cb962ac59075b964b07152d234b70', 'admin', '2025-01-01 00:51:04', ''),
(19, 'haha1', '202cb962ac59075b964b07152d234b70', 'user', '2025-01-01 00:53:11', ''),
(20, 'Didi', '202cb962ac59075b964b07152d234b70', 'user', '2025-01-01 00:59:25', 'user_20_1735753595.png'),
(21, 'agus123', '202cb962ac59075b964b07152d234b70', 'user', '2025-01-01 01:00:29', ''),
(22, 'tata123', '202cb962ac59075b964b07152d234b70', 'user', '2025-01-01 01:00:52', ''),
(23, 'hafiz12', '202cb962ac59075b964b07152d234b70', 'user', '2025-01-01 01:05:10', 'user_23_1736849695.jpg'),
(24, 'Didi', '202cb962ac59075b964b07152d234b70', 'user', '2025-01-01 01:15:40', ''),
(25, 'rara', '202cb962ac59075b964b07152d234b70', 'admin', '2025-01-01 01:20:08', ''),
(26, 'cep123', '202cb962ac59075b964b07152d234b70', 'user', '2025-01-01 01:21:38', ''),
(27, 'rulz123', '202cb962ac59075b964b07152d234b70', 'user', '2025-01-14 04:15:36', ''),
(28, 'tes123', '202cb962ac59075b964b07152d234b70', 'admin', '2025-01-14 04:17:49', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_dosen`
--
ALTER TABLE `tb_dosen`
  ADD PRIMARY KEY (`id_dosen`);

--
-- Indeks untuk tabel `tb_matkul`
--
ALTER TABLE `tb_matkul`
  ADD PRIMARY KEY (`id_matkul`);

--
-- Indeks untuk tabel `tb_mhs`
--
ALTER TABLE `tb_mhs`
  ADD PRIMARY KEY (`id_mhs`),
  ADD KEY `fk_user` (`id_user`);

--
-- Indeks untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_dosen`
--
ALTER TABLE `tb_dosen`
  MODIFY `id_dosen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tb_matkul`
--
ALTER TABLE `tb_matkul`
  MODIFY `id_matkul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `tb_mhs`
--
ALTER TABLE `tb_mhs`
  MODIFY `id_mhs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
