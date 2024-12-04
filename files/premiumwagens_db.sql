-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 04, 2024 at 11:17 AM
-- Server version: 8.2.0
-- PHP Version: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `premiumwagens_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `auto_verkoop`
--

CREATE TABLE `auto_verkoop` (
  `id` int NOT NULL,
  `merk` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `model` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `bouwjaar` int NOT NULL,
  `kilometerstand` int NOT NULL,
  `prijs` decimal(10,2) NOT NULL,
  `afbeelding_url` text COLLATE utf8mb4_general_ci NOT NULL,
  `klant_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `berichten`
--

CREATE TABLE `berichten` (
  `id` int NOT NULL,
  `naam` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `bericht` text COLLATE utf8mb4_general_ci NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `gelezen` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `berichten`
--

INSERT INTO `berichten` (`id`, `naam`, `email`, `bericht`, `datum`, `gelezen`) VALUES
(1, 'test', 'test@gmail.com', 'test', '2024-10-16 09:31:40', 0),
(2, 'test', 'test@gmail.com', 'test', '2024-10-16 09:36:45', 0),
(3, 'aaa', 'aaa@gmail.com', 'aaa', '2024-10-16 09:37:00', 0),
(4, 'aaa', 'aaa@gmail.com', 'aaa', '2024-10-16 09:51:45', 0),
(5, 'aaa', 'aaa@gmail.com', 'aaa', '2024-10-16 09:55:13', 0),
(6, 'test ', 'test@gmail.com', 'test', '2024-10-16 09:55:39', 0),
(7, 'test ', 'test@gmail.com', 'test', '2024-10-16 10:01:58', 0),
(14, 'ali', 'ali@gmail.com', 'hallo??', '2024-10-16 10:40:52', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int NOT NULL,
  `merk` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `model` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `bouwjaar` int NOT NULL,
  `prijs` decimal(10,2) NOT NULL,
  `afbeelding_url` varchar(512) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `beschrijving` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `locatie` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kilometerstand` int DEFAULT NULL,
  `transmissie` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `brandstof` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `vermogen` int DEFAULT NULL,
  `verkoper` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telefoonnummer` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `carrosserietype` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `categorie` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `aandrijving` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `stoelen` int DEFAULT NULL,
  `deuren` int DEFAULT NULL,
  `advertentienr` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `apk` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cilinderinhoud` decimal(5,1) DEFAULT NULL,
  `versnellingen` int DEFAULT NULL,
  `cilinders` int DEFAULT NULL,
  `leeggewicht` int DEFAULT NULL,
  `vermogen_kw` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gereserveerd` tinyint(1) DEFAULT '0',
  `is_approved` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `merk`, `model`, `bouwjaar`, `prijs`, `afbeelding_url`, `beschrijving`, `created_at`, `locatie`, `kilometerstand`, `transmissie`, `brandstof`, `vermogen`, `verkoper`, `telefoonnummer`, `carrosserietype`, `categorie`, `aandrijving`, `stoelen`, `deuren`, `advertentienr`, `apk`, `cilinderinhoud`, `versnellingen`, `cilinders`, `leeggewicht`, `vermogen_kw`, `gereserveerd`, `is_approved`) VALUES
(59, 'BMW', '340i', 2019, 45500.00, 'https://prod.pictures.autoscout24.net/listing-images/13265bfa-0087-4d8f-88ae-cf4c1b47ea73_f9e1acab-d8f2-4e6c-a2a8-cb1858ceb8c4.jpg/720x540.webp', 'Basisgegevens\r\nCarrosserietype\r\nSedan\r\nCategorie\r\nGebruikt\r\nAandrijving\r\n4x4\r\nStoelen\r\n5\r\nDeuren\r\n4\r\nAdvertentienr.\r\nGBS-26-R\r\nVoertuiggeschiedenis\r\nKilometerstand\r\n150.500 km\r\nBouwjaar\r\n10/2019\r\nAPK\r\n02/2025\r\nVolledige onderhoudshistorie\r\nJa\r\nTechnische Gegevens\r\nVermogen kW (PK)\r\n275 kW (374 PK)\r\nTransmissie\r\nAutomatisch\r\nCilinderinhoud\r\n2.998 cm³\r\nCilinders\r\n6\r\nLeeggewicht\r\n1.645 kg', '2024-10-08 09:22:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1),
(61, 'Audi', 'A6', 2020, 40950.00, 'https://prod.pictures.autoscout24.net/listing-images/f585f2fb-d456-4a2c-a330-6dd343c580e7_4a5b87ce-9b3e-4080-a45a-e202ccee84ad.jpg/1920x1080.webp', 'test', '2024-10-08 13:22:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(63, 'Renault', 'Megane RS', 2023, 60450.00, 'https://prod.pictures.autoscout24.net/listing-images/7544d9f1-460a-47d6-9d0e-9e32387f5460_353fed96-c2b5-4664-a8d7-d04c00dd0a33.jpg/720x540.webp', '', '2024-10-08 22:57:03', NULL, 30, 'Automaat', NULL, NULL, NULL, NULL, 'Htachback', 'Nieuw', 'Voorwiel', 5, 5, '1001', '05-09-2025', 1800.0, 7, 4, 1200, '350', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `car_images`
--

CREATE TABLE `car_images` (
  `id` int NOT NULL,
  `car_id` int DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car_images`
--

INSERT INTO `car_images` (`id`, `car_id`, `image_url`) VALUES
(7, 61, 'https://prod.pictures.autoscout24.net/listing-images/f585f2fb-d456-4a2c-a330-6dd343c580e7_c833d902-e152-4612-882b-47da3306de11.jpg/1920x1080.webp'),
(8, 61, 'https://prod.pictures.autoscout24.net/listing-images/f585f2fb-d456-4a2c-a330-6dd343c580e7_f570380d-45e7-4b06-b0d1-06329d7f8bb7.jpg/1920x1080.webp'),
(9, 61, 'https://prod.pictures.autoscout24.net/listing-images/f585f2fb-d456-4a2c-a330-6dd343c580e7_1909f5e6-7e10-40f6-9c6c-8b72d44d87f7.jpg/1920x1080.webp'),
(13, 63, 'https://prod.pictures.autoscout24.net/listing-images/7544d9f1-460a-47d6-9d0e-9e32387f5460_1ac8374f-3f13-459c-b37d-00c4511cb949.jpg/720x540.webp'),
(14, 63, 'https://prod.pictures.autoscout24.net/listing-images/7544d9f1-460a-47d6-9d0e-9e32387f5460_90dd84ef-fdd4-4cc6-9d35-f3f9d82cb1c1.jpg/720x540.webp'),
(15, 63, 'https://prod.pictures.autoscout24.net/listing-images/7544d9f1-460a-47d6-9d0e-9e32387f5460_0fc2a4de-f5a5-4210-ae10-6a92fe499edc.jpg/720x540.webp');

-- --------------------------------------------------------

--
-- Table structure for table `reserveringen`
--

CREATE TABLE `reserveringen` (
  `id` int NOT NULL,
  `auto_id` int NOT NULL,
  `naam` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `telefoon` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `opmerkingen` text COLLATE utf8mb4_general_ci,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `naam` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `wachtwoord` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `rol` enum('admin','klant') COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `naam`, `email`, `wachtwoord`, `rol`, `created_at`) VALUES
(1, 'Admin', 'admin@premiumwagens.nl', '0192023a7bbd73250516f069df18b500', 'admin', '2024-10-02 12:17:32'),
(2, 'Klant', 'klant@premiumwagens.nl', 'fdaa5eefceb86cad8027d985a084f491', 'klant', '2024-10-02 12:17:32'),
(3, 'test', 'test@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 'klant', '2024-10-02 12:31:59'),
(4, 'erik', 'erik@gmail.com', '6a42dd6e7ca9a813693714b0d9aa1ad8', 'klant', '2024-10-02 21:15:47'),
(5, 'jan', 'jan@gmail.com', 'fa27ef3ef6570e32a79e74deca7c1bc3', 'klant', '2024-10-03 10:38:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auto_verkoop`
--
ALTER TABLE `auto_verkoop`
  ADD PRIMARY KEY (`id`),
  ADD KEY `klant_id` (`klant_id`);

--
-- Indexes for table `berichten`
--
ALTER TABLE `berichten`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_images`
--
ALTER TABLE `car_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexes for table `reserveringen`
--
ALTER TABLE `reserveringen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auto_id` (`auto_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auto_verkoop`
--
ALTER TABLE `auto_verkoop`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `berichten`
--
ALTER TABLE `berichten`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `car_images`
--
ALTER TABLE `car_images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `reserveringen`
--
ALTER TABLE `reserveringen`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auto_verkoop`
--
ALTER TABLE `auto_verkoop`
  ADD CONSTRAINT `auto_verkoop_ibfk_1` FOREIGN KEY (`klant_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `car_images`
--
ALTER TABLE `car_images`
  ADD CONSTRAINT `car_images_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reserveringen`
--
ALTER TABLE `reserveringen`
  ADD CONSTRAINT `reserveringen_ibfk_1` FOREIGN KEY (`auto_id`) REFERENCES `cars` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
