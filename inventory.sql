-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 01, 2025 at 12:46 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `keluar`
--

CREATE TABLE `keluar` (
  `idkeluar` int NOT NULL,
  `idbarang` int NOT NULL,
  `kodebarang` varchar(20) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `penerima` varchar(25) NOT NULL,
  `keterangan` varchar(30) NOT NULL,
  `qty` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `iduser` int NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`iduser`, `email`, `password`) VALUES
(1, 'kita@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `masuk`
--

CREATE TABLE `masuk` (
  `idmasuk` int NOT NULL,
  `idbarang` int NOT NULL,
  `kodebarang` varchar(20) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `penerima` varchar(30) NOT NULL,
  `keterangan` varchar(25) NOT NULL,
  `qty` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `masuk`
--

INSERT INTO `masuk` (`idmasuk`, `idbarang`, `kodebarang`, `tanggal`, `penerima`, `keterangan`, `qty`) VALUES
(13, 15, '02090107007 ', '2025-04-30 07:40:18', 'Nafa', 'Belii baru', 10);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `idbarang` int NOT NULL,
  `kodebarang` varchar(20) DEFAULT NULL,
  `namabarang` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `satuan` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `stock` int NOT NULL,
  `harga` bigint DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `tahun` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`idbarang`, `kodebarang`, `namabarang`, `satuan`, `stock`, `harga`, `lokasi`, `tahun`) VALUES
(16, '3.03.02.05.001', 'Tool Kit Set', 'Buah', 1, 22810500, 'Bidang Teknik', 2024),
(17, '3.05.01.04.001', 'Lemari Besi/Metal', 'Buah', 2, 3050000, 'Kearsipan', 2024),
(18, '3.05.01.04.005', 'Filing Cabinet Besi', 'Buah', 2, 2876700, 'Kearsipan', 2024),
(19, '3.05.01.04.018', 'Kontainer', 'Buah', 1, 7409250, 'Bidang Teknik', 2024),
(20, '3.05.02.01.002', 'Meja Kerja Kayu', 'Buah', 9, 2389583, 'TVRI Banten', 2024),
(21, '3.05.02.01.003', 'Kursi Besi/Metal', 'Buah', 12, 1304250, 'TVRI Banten', 2024),
(22, '3.05.02.01.005', 'Sice', 'Buah', 4, 4495500, 'TVRI Banten', 2024),
(23, '3.05.02.01.006', 'Bangku Panjang Besi/Metal', 'Buah', 2, 1942500, 'TVRI Banten', 2024),
(24, '3.05.02.03.003', 'Mesin Pemotong Rumput', 'Buah', 1, 2997000, 'TVRI Banten', 2024),
(26, '3.05.02.06.002', 'Televisi', 'Buah', 7, 7322280, '-', 2024),
(27, '3.05.02.06.035', 'Kaca Hias', 'Buah', 1, 1443000, 'TVRI Banten', 2024),
(28, '3.05.02.06.036', 'Dispenser', 'Buah', 1, 3246750, 'TVRI Banten', 2024),
(29, '3.05.02.06.072', 'Lampu', 'Buah', 1, 1665000, 'Studio', 2024),
(30, '3.06.01.01.001', 'Audio Mixing Console', 'Buah', 1, 88800000, 'Teknik', 2024),
(31, '3.06.01.01.002', 'Audio Mixing Portable', 'Buah', 1, 4073700, 'Teknik', 2024),
(32, '3.06.01.01.036', 'Microphone/Wireless MIC', 'Buah', 3, 6689600, 'Teknik', 2024),
(33, '3.06.01.01.041', 'Professional Sound System', 'Buah', 6, 18796000, 'Teknik', 2024),
(34, '3.06.01.01.051', 'Automatic Voltage Regulator (AVR)', 'Buah', 1, 49950000, 'Teknik', 2024),
(35, '3.06.01.01.060', 'Power Amplifier', 'Buah', 1, 8397150, 'Teknik', 2024),
(36, '3.06.01.01.082', 'Interfaceboard', 'Buah', 1, 33522000, 'Teknik', 2024),
(37, '3.06.01.02.039', 'Editing Electronic', 'Buah', 1, 11721600, 'Teknik', 2024),
(38, '3.06.01.02.041', 'Remote Control Unit', 'Buah', 1, 3463200, 'Teknik', 2024),
(39, '3.06.01.02.042', 'Rak Peralatan', 'Buah', 2, 3457650, 'Teknik', 2024),
(40, '3.06.01.02.061', 'Lensa Kamera', 'Buah', 1, 29637000, 'Teknik', 2024),
(41, '3.06.01.02.120', 'Lighting Head Body', 'Buah', 8, 8700000, 'Teknik', 2024),
(42, '3.06.01.02.167', 'Drone', 'Buah', 1, 18370500, 'Teknik', 2024),
(43, '3.06.01.02.169', 'Action Cam', 'Buah', 1, 10545000, 'Teknik', 2024),
(44, '3.06.02.01.004', 'Telephone Mobile', 'Buah', 4, 29906175, 'Teknik', 2024),
(45, '3.06.03.23.022', 'Change Over Switch', 'Buah', 2, 33660750, 'Teknik', 2024),
(46, '3.06.03.41.999', 'Peralatan Antena Pemancar dan Penerima UHF Lainnya', 'Dummy', 2, 8769000, 'Teknik', 2024),
(47, '3.10.01.02.001', 'P.C Unit', 'Buah', 3, 16886800, 'TVRI Banten', 2024),
(48, '3.10.01.02.002', 'LapTop', 'Buah', 3, 17508926, '-', 2024),
(49, '3.10.01.02.009', 'Tablet PC', 'Buah', 1, 13799000, 'Kepala Stasiun', 2024),
(50, '3.10.02.01.004', 'Storage Modul Disk (Peralatan Mainframe)', 'Buah', 1, 1998000, 'Teknik', 2024),
(51, '3.10.02.03.003', 'Printer (Peralatan Personal Komputer)', 'Buah', 4, 6757100, 'Ruang Cetak', 2024),
(52, '3.05.02.04.004', 'A.C. Split', 'Buah', 2, 18283087, 'Transmisi', 2024),
(53, '3.05.02.04.004', 'A.C. Split', 'Buah', 2, 18283087, 'TVRI Banten', 2024),
(154, '3.01.03.15.006', 'Mini Digital Video Recorder', 'Set', 1, 5217000, 'TVRI', 2023),
(155, '3.03.02.05.001', 'Tool Kit Set', 'Buah', 1, 5170000, 'TVRI', 2023),
(156, '3.03.02.05.002', 'Tool Kit Box', 'Buah', 1, 9271497, 'TVRI', 2023),
(157, '3.05.01.04.001', 'Lemari Besi/Metal', 'Buah', 1, 2153400, 'TVRI', 2023),
(158, '3.05.01.04.002', 'Lemari Kayu', 'Buah', 2, 2053500, 'TVRI', 2023),
(159, '3.05.01.04.003', 'Rak Besi', 'Buah', 10, 2053560, 'TVRI', 2023),
(160, '3.05.01.04.005', 'Filing Cabinet Besi', 'Buah', 3, 3237500, 'TVRI', 2023),
(161, '3.05.02.01.001', 'Meja Kerja Besi/Metal', 'Buah', 2, 7603500, 'TVRI', 2023),
(162, '3.05.02.01.002', 'Meja Kerja Kayu', 'Buah', 2, 4247800, 'TVRI', 2023),
(163, '3.05.02.01.003', 'Kursi Besi/Metal', 'Buah', 7, 7770000, 'TVRI', 2023),
(164, '3.05.02.01.005', 'Sice', 'Buah', 5, 16317000, 'TVRI', 2023),
(165, '3.05.02.04.001', 'Lemari Es', 'Buah', 2, 5200000, 'TVRI', 2023),
(166, '3.05.02.04.004', 'A.C. Split', 'Buah', 11, 128557044, 'TVRI', 2023),
(167, '3.05.02.06.014', 'Microphone', 'Buah', 1, 7425900, 'TVRI', 2023),
(168, '3.05.02.06.036', 'Dispenser', 'Buah', 2, 3700000, 'TVRI', 2023),
(169, '3.06.01.01.019', 'Multitrack Recorder', 'Buah', 1, 9352610, 'TVRI', 2023),
(170, '3.06.01.01.036', 'Microphone/Wireless MIC', 'Buah', 7, 73421947, 'TVRI', 2023),
(171, '3.06.01.01.038', 'Microphone Connector Box', 'Buah', 1, 4626176, 'TVRI', 2023),
(172, '3.06.01.02.011', 'Video Distribution Amplifier', 'Buah', 7, 184681800, 'TVRI', 2023),
(173, '3.06.01.02.012', 'Video Monitor', 'Buah', 38, 759080530, 'TVRI', 2023),
(174, '3.06.01.02.024', 'Video Processor', 'Buah', 1, 14652000, 'TVRI', 2023),
(175, '3.06.01.02.034', 'Teleprompter', 'Buah', 1, 1500000, 'TVRI', 2023),
(176, '3.06.01.02.045', 'Tripod Camera', 'Buah', 2, 15451200, 'TVRI', 2023),
(177, '3.06.01.02.061', 'Lensa Kamera', 'Buah', 3, 203480560, 'TVRI', 2023),
(178, '3.06.01.02.121', 'Lighting Mechanic', 'Buah', 4, 372607020, 'TVRI', 2023),
(179, '3.06.01.02.128', 'Camera Digital', 'Buah', 1, 9590400, 'TVRI', 2023),
(180, '3.06.01.02.129', 'Tas Kamera', 'Buah', 1, 11655000, 'TVRI', 2023),
(181, '3.06.01.02.135', 'LCD Monitor', 'Buah', 3, 41407884, 'TVRI', 2023),
(182, '3.06.01.02.142', 'Recording Workstation', 'Buah', 1, 17498040, 'TVRI', 2023),
(183, '3.06.01.02.145', 'Connectors', 'Buah', 1, 5350200, 'TVRI', 2023),
(184, '3.06.01.02.158', 'Monopod', 'Buah', 3, 22843800, 'TVRI', 2023),
(185, '3.06.01.03.004', 'Alat Tulis Gambar', 'Buah', 1, 3241200, 'TVRI', 2023),
(186, '3.06.01.03.999', 'Peralatan Studio Gambar Lainnya', 'Buah', 1, 9546000, 'TVRI', 2023),
(187, '3.06.01.05.047', 'Kamera Udara', 'Buah', 1, 23021400, 'TVRI', 2023),
(188, '3.06.02.07.017', 'Handphone Encription', 'Buah', 1, 34509900, 'TVRI', 2023),
(189, '3.06.03.22.001', 'Dehumidifier', 'Buah', 2, 6604500, 'TVRI', 2023),
(190, '3.06.03.35.999', 'Peralatan Pemancar Lainnya', 'Buah', 1, 3990167500, 'TVRI', 2023),
(191, '3.09.04.02.031', 'Kamera Digital', 'Buah', 1, 69930000, 'TVRI', 2023),
(192, '3.09.04.07.009', 'Bateray Pack Camera', 'Buah', 16, 33437982, 'TVRI', 2023),
(193, '3.10.01.02.001', 'P.C Unit', 'Buah', 1, 203923090, 'TVRI', 2023),
(194, '3.10.01.02.002', 'Lap Top', 'Buah', 2, 237162600, 'TVRI', 2023),
(195, '3.10.02.02.017', 'Speaker Komputer', 'Buah', 4, 12276600, 'TVRI', 2023),
(196, '3.10.02.03.002', 'Monitor', 'Buah', 1, 25070000, 'TVRI', 2023),
(197, '3.10.02.03.003', 'Printer', 'Buah', 5, 25103538, 'TVRI', 2023),
(198, '3.10.02.03.004', 'Scanner', 'Buah', 3, 46373900, 'TVRI', 2023),
(199, '3.10.02.03.017', 'External/ Portable Hardisk', 'Buah', 26, 36373000, 'TVRI', 2023),
(200, '3.10.02.04.005', 'Netware Interface External', 'Buah', 4, 16091900, 'TVRI', 2023),
(201, '3.10.02.04.023', 'Wireless Access Point', 'Buah', 2, 7703400, 'TVRI', 2023),
(202, '3.10.02.04.024', 'Switch', 'Buah', 8, 54497900, 'TVRI', 2023),
(203, '3.10.02.04.026', 'Acces Point', 'Buah', 1, 9612600, 'TVRI', 2023);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keluar`
--
ALTER TABLE `keluar`
  ADD PRIMARY KEY (`idkeluar`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`iduser`);

--
-- Indexes for table `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`idmasuk`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`idbarang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keluar`
--
ALTER TABLE `keluar`
  MODIFY `idkeluar` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `iduser` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `masuk`
--
ALTER TABLE `masuk`
  MODIFY `idmasuk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `idbarang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
