-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 06, 2025 at 05:31 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kuliah`
--

-- --------------------------------------------------------

--
-- Table structure for table `krs`
--

CREATE TABLE `krs` (
  `id` int NOT NULL,
  `mahasiswa_npm` char(13) DEFAULT NULL,
  `matakuliah_kodemk` char(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `krs`
--

INSERT INTO `krs` (`id`, `mahasiswa_npm`, `matakuliah_kodemk`) VALUES
(2, '2310631170001', '123001'),
(3, '2310631170002', '123002'),
(6, '2310631170003', '123001'),
(7, '2310631170004', '123003'),
(8, '2310631170005', '123004'),
(9, '2310631170006', '123001'),
(10, '2310631170007', '123001'),
(11, '2310631170008', '123002'),
(12, '2310631170009', '123002'),
(13, '2310631170010', '123003');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `npm` char(13) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `jurusan` enum('Teknik Informatika','Sistem Operasi') DEFAULT NULL,
  `alamat` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`npm`, `nama`, `jurusan`, `alamat`) VALUES
('2310631170001', 'Siska Putri', 'Sistem Operasi', 'Jl. Gunung Bromo'),
('2310631170002', 'Ujang Aziz', 'Teknik Informatika', 'Jl. Gunung Agung'),
('2310631170003', 'Veronica Setyano', 'Sistem Operasi', 'Jl. Gunung Rinjani'),
('2310631170004', 'Rizka Nurmala Putri', 'Teknik Informatika', 'Jl. Gunung Merbabu'),
('2310631170005', 'Eren Putra', 'Sistem Operasi', 'Jl. Gunung Lawu'),
('2310631170006', 'Putra Abdul Rachman', 'Teknik Informatika', 'Jl. Gunung Slamet'),
('2310631170007', 'Rahmat Andriyadi', 'Sistem Operasi', 'Jl. Gunung Sumbing'),
('2310631170008', 'Ayu Puspitasari', 'Sistem Operasi', 'Jl. Gunung Sindoro'),
('2310631170009', 'Putri Ayuni', 'Sistem Operasi', 'Jl. Gunung Prau'),
('2310631170010', 'Andri Muhammad', 'Teknik Informatika', 'Jl. Gunung Argopuro');

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE `matakuliah` (
  `kodemk` char(6) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `jumlah_sks` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `matakuliah`
--

INSERT INTO `matakuliah` (`kodemk`, `nama`, `jumlah_sks`) VALUES
('123001', 'Basis Data', 3),
('123002', 'Pemrograman Berbasis Web', 3),
('123003', 'Algoritma dan Struktur Data', 3),
('123004', 'Kajian Jurnal Informatika', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `krs`
--
ALTER TABLE `krs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mahasiswa_npm` (`mahasiswa_npm`),
  ADD KEY `matakuliah_kodemk` (`matakuliah_kodemk`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`npm`);

--
-- Indexes for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`kodemk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `krs`
--
ALTER TABLE `krs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `krs`
--
ALTER TABLE `krs`
  ADD CONSTRAINT `krs_ibfk_1` FOREIGN KEY (`mahasiswa_npm`) REFERENCES `mahasiswa` (`npm`),
  ADD CONSTRAINT `krs_ibfk_2` FOREIGN KEY (`matakuliah_kodemk`) REFERENCES `matakuliah` (`kodemk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
