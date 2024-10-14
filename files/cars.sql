-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 08, 2024 at 09:09 AM
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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `merk`, `model`, `bouwjaar`, `prijs`, `afbeelding_url`, `beschrijving`, `created_at`) VALUES
(8, 'Bmw', '340i', 2022, 68000.00, NULL, 'Zeer nette bmw 340i  \r\n\r\nPK:340\r\nKM:68000\r\nEigenaren:3', '2024-10-03 10:40:33'),
(10, 'BMW', '340i', 2022, 68000.00, NULL, 'Zeer nette BMW 340i, PK:340, KM:68000, Eigenaar: 1', '2024-10-03 11:21:30'),
(11, 'Renault', 'Talisman', 2019, 35000.00, NULL, 'Zeer nette Renault Talisman, PK:230, KM:44000, Eigenaar: 1', '2024-10-03 11:21:30'),
(12, 'Audi', 'A4', 2021, 45000.00, NULL, 'Sportieve Audi A4, PK:300, KM:52000, Eigenaar: 1', '2024-10-03 11:21:30'),
(13, 'Mercedes', 'C-Class', 2020, 55000.00, NULL, 'Luxueuze Mercedes C-Class, PK:320, KM:37000, Eigenaar: 1', '2024-10-03 11:21:30'),
(14, 'Volkswagen', 'Golf', 2018, 30000.00, NULL, 'Volkswagen Golf, PK:230, KM:89000, Eigenaar: 1', '2024-10-03 11:21:30'),
(19, 'Ford', 'Mustang', 2020, 60000.00, NULL, 'Ford Mustang, PK:450, KM:35000, Eigenaar: 1', '2024-10-03 11:21:30'),
(20, 'Jaguar', 'F-Type', 2022, 90000.00, NULL, 'Jaguar F-Type, PK:575, KM:18000, Eigenaar: 1', '2024-10-03 11:21:30'),
(23, 'Maserati', 'Ghibli', 2021, 75000.00, NULL, 'Maserati Ghibli, PK:430, KM:24000, Eigenaar: 1', '2024-10-03 11:21:30'),
(29, 'Lexus', 'LC500', 2021, 95000.00, NULL, 'Lexus LC500, PK:471, KM:22000, Eigenaar: 1', '2024-10-03 11:21:30'),
(30, 'BMW', '340i', 2022, 68000.00, NULL, 'Zeer nette BMW 340i met veel opties.', '2024-10-03 10:40:33'),
(31, 'BMW', 'X5', 2021, 75000.00, NULL, 'BMW X5 met sportpakket en full option.', '2024-10-03 10:50:12'),
(32, 'BMW', 'M3', 2020, 85000.00, NULL, 'BMW M3, high-performance sports car.', '2024-10-03 11:10:54'),
(33, 'BMW', '520d', 2019, 45000.00, NULL, 'BMW 520d met dieselmotor, zuinig en krachtig.', '2024-10-03 11:30:21'),
(34, 'BMW', 'X3', 2018, 40000.00, NULL, 'Compacte SUV met veel comfort en rijplezier.', '2024-10-03 11:40:44'),
(35, 'Renault', 'Talisman', 2019, 35000.00, NULL, 'Zeer nette Renault Talisman, voorzien van PK:230 en KM:44000.', '2024-10-03 11:05:49'),
(36, 'Renault', 'Clio', 2021, 22000.00, NULL, 'Populaire compacte Renault Clio, ideaal voor in de stad.', '2024-10-03 12:10:25'),
(37, 'Renault', 'Megane', 2020, 27000.00, NULL, 'Renault Megane met modern design en rijcomfort.', '2024-10-03 12:20:45'),
(38, 'Renault', 'Captur', 2022, 29000.00, NULL, 'Compacte SUV Renault Captur, perfect voor gezinnen.', '2024-10-03 12:30:33'),
(39, 'Renault', 'Koleos', 2020, 45000.00, NULL, 'Luxe SUV met veel ruimte en geavanceerde technologie.', '2024-10-03 12:40:12'),
(40, 'Volkswagen', 'Golf', 2022, 32000.00, NULL, 'Volkswagen Golf, sportieve compacte wagen.', '2024-10-03 13:00:12'),
(41, 'Volkswagen', 'Polo', 2021, 25000.00, NULL, 'Compacte en zuinige Volkswagen Polo.', '2024-10-03 13:10:35'),
(42, 'Volkswagen', 'Tiguan', 2020, 42000.00, NULL, 'Volkswagen Tiguan SUV, comfortabel en ruim.', '2024-10-03 13:20:25'),
(43, 'Volkswagen', 'Passat', 2019, 38000.00, NULL, 'Volkswagen Passat, luxe gezinswagen.', '2024-10-03 13:30:19'),
(44, 'Volkswagen', 'Arteon', 2021, 46000.00, NULL, 'Stijlvolle Volkswagen Arteon met moderne snufjes.', '2024-10-03 13:40:40'),
(45, 'Audi', 'A3', 2022, 37000.00, NULL, 'Compacte Audi A3, ideaal voor stedelijk gebruik.', '2024-10-03 14:00:00'),
(46, 'Audi', 'A6', 2021, 62000.00, NULL, 'Luxe Audi A6, met krachtige prestaties.', '2024-10-03 14:10:15'),
(47, 'Audi', 'Q5', 2020, 55000.00, NULL, 'Audi Q5 SUV, perfect voor lange reizen.', '2024-10-03 14:20:25'),
(48, 'Audi', 'A8', 2019, 95000.00, NULL, 'Audi A8 met high-end luxe en technologie.', '2024-10-03 14:30:45'),
(49, 'Audi', 'RS6', 2022, 120000.00, NULL, 'Audi RS6, high-performance sportwagen.', '2024-10-03 14:40:12'),
(50, 'test', 'test', 3232, 32424.00, NULL, '32423', '2024-10-03 15:39:52'),
(51, 'tt', 'tt', 432, 344432.00, NULL, 'tt', '2024-10-03 16:24:12'),
(52, 'audi', 'TT', 2020, 30.00, NULL, 'gaycedes', '2024-10-04 11:14:38'),
(53, 'alpina', 'b58', 2020, 90.00, 'https://img.freepik.com/premium-photo/silver-car-with-number-2-side_1081462-19443.jpg?w=996', 'bon simang', '2024-10-04 21:37:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
