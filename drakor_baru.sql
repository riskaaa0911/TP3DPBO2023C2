-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Bulan Mei 2023 pada 16.57
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `drakor_baru`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `drama`
--

CREATE TABLE `drama` (
  `id_drama` int(11) NOT NULL,
  `poster_drama` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `jml_eps` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `id_writer` int(11) NOT NULL,
  `id_produksi` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `sinopsis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `drama`
--

INSERT INTO `drama` (`id_drama`, `poster_drama`, `judul`, `jml_eps`, `tahun`, `id_writer`, `id_produksi`, `rating`, `sinopsis`) VALUES
(1, 'Signal.jpg', 'Signal', 16, 2021, 1, 1, 10, 'Hae Yeong adalah petugas polisi dan profiler kriminal. Suatu hari, dia menemukan walkie-talkie yang memungkinkan dia untuk berhubungan \r\ndengan Detektif Lee Jae Han yang ada di masa lalu. Petugas polisi Hae Yeong, Jae Han, dan Cha So Hyun kemudian melakukan perjalanan untuk menyelesaikan kasus dingin.'),
(2, 'Extracurricular.jpg', 'Extracurricular', 10, 2020, 2, 2, 8, '\"Ekstrakurikuler\" berpusat di sekitar empat siswa \r\nsekolah menengah yang mulai melakukan \r\nkejahatan untuk mendapatkan uang dan bahaya tak \r\nterduga yang mereka hadapi sebagai akibatnya.'),
(5, 'Vincenzo.jpg', 'Vincenzo', 20, 2021, 4, 1, 9, 'Vincenzo Cassano, pengacara mafia Korea-Italia, kembali ke tanah airnya untuk mencari tempat penyimpanan aset mafia dan peluang bisnis pencucian uang baru. Namun, ia harus melawan Babel Corporate Group yang korup untuk melindungi kepentingan keluarga Cassano. Dalam perjuangannya, Vincenzo tak disangka menjadi pejuang keadilan yang membantu penduduk setempat melawan tirani Babel.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produksi`
--

CREATE TABLE `produksi` (
  `id_produksi` int(11) NOT NULL,
  `nama_produksi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produksi`
--

INSERT INTO `produksi` (`id_produksi`, `nama_produksi`) VALUES
(1, 'tvN'),
(2, 'Netflix');

-- --------------------------------------------------------

--
-- Struktur dari tabel `writer`
--

CREATE TABLE `writer` (
  `id_writer` int(11) NOT NULL,
  `nama_writer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `writer`
--

INSERT INTO `writer` (`id_writer`, `nama_writer`) VALUES
(1, 'Kim Eun Hee'),
(2, 'Jin Han Sae'),
(4, 'Park Jae Bum');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `drama`
--
ALTER TABLE `drama`
  ADD PRIMARY KEY (`id_drama`),
  ADD KEY `id_writer` (`id_writer`),
  ADD KEY `id_produksi` (`id_produksi`);

--
-- Indeks untuk tabel `produksi`
--
ALTER TABLE `produksi`
  ADD PRIMARY KEY (`id_produksi`);

--
-- Indeks untuk tabel `writer`
--
ALTER TABLE `writer`
  ADD PRIMARY KEY (`id_writer`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `drama`
--
ALTER TABLE `drama`
  MODIFY `id_drama` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `produksi`
--
ALTER TABLE `produksi`
  MODIFY `id_produksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `writer`
--
ALTER TABLE `writer`
  MODIFY `id_writer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `drama`
--
ALTER TABLE `drama`
  ADD CONSTRAINT `drama_ibfk_1` FOREIGN KEY (`id_writer`) REFERENCES `writer` (`id_writer`),
  ADD CONSTRAINT `drama_ibfk_2` FOREIGN KEY (`id_produksi`) REFERENCES `produksi` (`id_produksi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
