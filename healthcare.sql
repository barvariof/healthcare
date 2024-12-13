-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Des 2024 pada 09.30
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
-- Database: `healthcare`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `antrian`
--

CREATE TABLE `antrian` (
  `idAntrian` int(11) NOT NULL,
  `antrianPoliId` int(11) NOT NULL,
  `antrianPasienId` int(11) NOT NULL,
  `antrianNo` varchar(255) NOT NULL,
  `antrianWaktuReg` datetime NOT NULL,
  `antrianStatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `antrian`
--

INSERT INTO `antrian` (`idAntrian`, `antrianPoliId`, `antrianPasienId`, `antrianNo`, `antrianWaktuReg`, `antrianStatus`) VALUES
(10, 5, 4, 'GZ/1213/001', '2024-12-13 11:16:49', 2),
(11, 5, 2, 'GZ/1213/002', '2024-12-13 11:32:33', 2),
(12, 4, 1, 'GG/1213/001', '2024-12-13 11:32:46', 2),
(13, 3, 4, 'UM/1213/001', '2024-12-13 13:22:43', 2),
(14, 5, 1, 'GZ/1213/003', '2024-12-13 13:23:22', 2),
(15, 4, 2, 'GG/1213/002', '2024-12-13 14:12:29', 2),
(16, 4, 2, 'GG/1213/003', '2024-12-13 14:38:23', 2),
(17, 3, 1, 'UM/1213/002', '2024-12-13 14:39:21', 2),
(18, 4, 4, 'GG/1213/004', '2024-12-13 14:40:00', 2),
(19, 3, 4, 'UM/1213/003', '2024-12-13 14:40:38', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `idPasien` int(11) NOT NULL,
  `nikPasien` varchar(255) NOT NULL,
  `namaPasien` varchar(255) NOT NULL,
  `ttlPasien` varchar(255) NOT NULL,
  `genderPasien` varchar(255) NOT NULL,
  `golDarahPasien` varchar(255) NOT NULL,
  `alamatPasien` varchar(255) NOT NULL,
  `noTelpPasien` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`idPasien`, `nikPasien`, `namaPasien`, `ttlPasien`, `genderPasien`, `golDarahPasien`, `alamatPasien`, `noTelpPasien`) VALUES
(1, '0871627634821964', 'Agus Nopek', 'Surakarta, 13 Mei 2007', 'Pria', 'AB', 'Banyuanyar, Banjarsari, Surakarta, Jawa Tengah', '089521456732'),
(2, '0389383298749824', 'Agus Thoriq', 'Karanganyar, 10 Januari 2000', 'Pria', 'B+', 'ejfwauefbuwgbfewusdcfjsbfihwihfoiwf', '313172387879'),
(4, '4985958395829852', 'Kayo', 'Surakarta, 18 Maret 2006', 'Pria', 'O+', 'akjdaihdioajdoiawhdoihoiehfo', '917398173983');

-- --------------------------------------------------------

--
-- Struktur dari tabel `poli`
--

CREATE TABLE `poli` (
  `idPoli` int(11) NOT NULL,
  `namaPoli` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `poli`
--

INSERT INTO `poli` (`idPoli`, `namaPoli`) VALUES
(3, 'Poli Umum'),
(4, 'Poli Gigi'),
(5, 'Poli Gizi');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`idAntrian`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`idPasien`);

--
-- Indeks untuk tabel `poli`
--
ALTER TABLE `poli`
  ADD PRIMARY KEY (`idPoli`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `antrian`
--
ALTER TABLE `antrian`
  MODIFY `idAntrian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `pasien`
--
ALTER TABLE `pasien`
  MODIFY `idPasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `poli`
--
ALTER TABLE `poli`
  MODIFY `idPoli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
