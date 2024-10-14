-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 04 okt 2024 om 13:05
-- Serverversie: 10.4.28-MariaDB
-- PHP-versie: 8.2.4

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
-- Tabelstructuur voor tabel `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `merk` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `bouwjaar` int(4) NOT NULL,
  `prijs` decimal(10,2) NOT NULL,
  `afbeelding` varchar(255) DEFAULT NULL,
  `beschrijving` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `cars`
--

INSERT INTO `cars` (`id`, `merk`, `model`, `bouwjaar`, `prijs`, `afbeelding`, `beschrijving`, `created_at`, `image`) VALUES
(8, 'Bmw', '340i', 2022, 68000.00, 'uploads/6Q1Qu2xmthcFJx0JLN3hQo-465f49d3ce16e55355dab7c2d1793eb1-bmw-340i-xdrive-front-1100.jpg', 'Zeer nette bmw 340i  \r\n\r\nPK:340\r\nKM:68000\r\nEigenaren:3', '2024-10-03 10:40:33', NULL),
(10, 'BMW', '340i', 2022, 68000.00, '6Q1Qu2xmthcFJx0JLN3hQo.jpg', 'Zeer nette BMW 340i, PK:340, KM:68000, Eigenaar: 1', '2024-10-03 11:21:30', NULL),
(11, 'Renault', 'Talisman', 2019, 35000.00, 'renault-talisman-2019-specs-01.jpg', 'Zeer nette Renault Talisman, PK:230, KM:44000, Eigenaar: 1', '2024-10-03 11:21:30', NULL),
(12, 'Audi', 'A4', 2021, 45000.00, 'uploads/6Q1Qu2xmthcFJx0JLN3hQo-465f49d3ce16e55355dab7c2d1793eb1-bmw-340i-xdrive-front-1100.jpg', 'Sportieve Audi A4, PK:300, KM:52000, Eigenaar: 1', '2024-10-03 11:21:30', NULL),
(13, 'Mercedes', 'C-Class', 2020, 55000.00, 'mercedes-c-class.jpg', 'Luxueuze Mercedes C-Class, PK:320, KM:37000, Eigenaar: 1', '2024-10-03 11:21:30', NULL),
(14, 'Volkswagen', 'Golf', 2018, 30000.00, 'vw-golf.jpg', 'Volkswagen Golf, PK:230, KM:89000, Eigenaar: 1', '2024-10-03 11:21:30', NULL),
(19, 'Ford', 'Mustang', 2020, 60000.00, 'ford-mustang.jpg', 'Ford Mustang, PK:450, KM:35000, Eigenaar: 1', '2024-10-03 11:21:30', NULL),
(20, 'Jaguar', 'F-Type', 2022, 90000.00, 'jaguar-f-type.jpg', 'Jaguar F-Type, PK:575, KM:18000, Eigenaar: 1', '2024-10-03 11:21:30', NULL),
(23, 'Maserati', 'Ghibli', 2021, 75000.00, 'maserati-ghibli.jpg', 'Maserati Ghibli, PK:430, KM:24000, Eigenaar: 1', '2024-10-03 11:21:30', NULL),
(29, 'Lexus', 'LC500', 2021, 95000.00, 'lexus-lc500.jpg', 'Lexus LC500, PK:471, KM:22000, Eigenaar: 1', '2024-10-03 11:21:30', NULL),
(30, 'BMW', '340i', 2022, 68000.00, 'bmw-340i.jpg', 'Zeer nette BMW 340i met veel opties.', '2024-10-03 10:40:33', NULL),
(31, 'BMW', 'X5', 2021, 75000.00, 'bmw-x5.jpg', 'BMW X5 met sportpakket en full option.', '2024-10-03 10:50:12', NULL),
(32, 'BMW', 'M3', 2020, 85000.00, 'bmw-m3.jpg', 'BMW M3, high-performance sports car.', '2024-10-03 11:10:54', NULL),
(33, 'BMW', '520d', 2019, 45000.00, 'bmw-520d.jpg', 'BMW 520d met dieselmotor, zuinig en krachtig.', '2024-10-03 11:30:21', NULL),
(34, 'BMW', 'X3', 2018, 40000.00, 'bmw-x3.jpg', 'Compacte SUV met veel comfort en rijplezier.', '2024-10-03 11:40:44', NULL),
(35, 'Renault', 'Talisman', 2019, 35000.00, 'uploads/6Q1Qu2xmthcFJx0JLN3hQo-465f49d3ce16e55355dab7c2d1793eb1-bmw-340i-xdrive-front-1100.jpg', 'Zeer nette Renault Talisman, voorzien van PK:230 en KM:44000.', '2024-10-03 11:05:49', NULL),
(36, 'Renault', 'Clio', 2021, 22000.00, 'renault-clio.jpg', 'Populaire compacte Renault Clio, ideaal voor in de stad.', '2024-10-03 12:10:25', NULL),
(37, 'Renault', 'Megane', 2020, 27000.00, 'renault-megane.jpg', 'Renault Megane met modern design en rijcomfort.', '2024-10-03 12:20:45', NULL),
(38, 'Renault', 'Captur', 2022, 29000.00, 'renault-captur.jpg', 'Compacte SUV Renault Captur, perfect voor gezinnen.', '2024-10-03 12:30:33', NULL),
(39, 'Renault', 'Koleos', 2020, 45000.00, 'renault-koleos.jpg', 'Luxe SUV met veel ruimte en geavanceerde technologie.', '2024-10-03 12:40:12', NULL),
(40, 'Volkswagen', 'Golf', 2022, 32000.00, 'vw-golf.jpg', 'Volkswagen Golf, sportieve compacte wagen.', '2024-10-03 13:00:12', NULL),
(41, 'Volkswagen', 'Polo', 2021, 25000.00, 'vw-polo.jpg', 'Compacte en zuinige Volkswagen Polo.', '2024-10-03 13:10:35', NULL),
(42, 'Volkswagen', 'Tiguan', 2020, 42000.00, 'vw-tiguan.jpg', 'Volkswagen Tiguan SUV, comfortabel en ruim.', '2024-10-03 13:20:25', NULL),
(43, 'Volkswagen', 'Passat', 2019, 38000.00, 'vw-passat.jpg', 'Volkswagen Passat, luxe gezinswagen.', '2024-10-03 13:30:19', NULL),
(44, 'Volkswagen', 'Arteon', 2021, 46000.00, 'vw-arteon.jpg', 'Stijlvolle Volkswagen Arteon met moderne snufjes.', '2024-10-03 13:40:40', NULL),
(45, 'Audi', 'A3', 2022, 37000.00, 'audi-a3.jpg', 'Compacte Audi A3, ideaal voor stedelijk gebruik.', '2024-10-03 14:00:00', NULL),
(46, 'Audi', 'A6', 2021, 62000.00, 'audi-a6.jpg', 'Luxe Audi A6, met krachtige prestaties.', '2024-10-03 14:10:15', NULL),
(47, 'Audi', 'Q5', 2020, 55000.00, 'audi-q5.jpg', 'Audi Q5 SUV, perfect voor lange reizen.', '2024-10-03 14:20:25', NULL),
(48, 'Audi', 'A8', 2019, 95000.00, 'audi-a8.jpg', 'Audi A8 met high-end luxe en technologie.', '2024-10-03 14:30:45', NULL),
(49, 'Audi', 'RS6', 2022, 120000.00, 'uploads/6Q1Qu2xmthcFJx0JLN3hQo-465f49d3ce16e55355dab7c2d1793eb1-bmw-340i-xdrive-front-1100.jpg', 'Audi RS6, high-performance sportwagen.', '2024-10-03 14:40:12', NULL),
(50, 'test', 'test', 3232, 32424.00, 'uploads/6Q1Qu2xmthcFJx0JLN3hQo-465f49d3ce16e55355dab7c2d1793eb1-bmw-340i-xdrive-front-1100.jpg', '32423', '2024-10-03 15:39:52', NULL),
(51, 'tt', 'tt', 432, 344432.00, 'uploads/gallery_images_2_0_16412256341530504947.jpg', 'tt', '2024-10-03 16:24:12', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `naam` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL,
  `rol` enum('admin','klant') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `naam`, `email`, `wachtwoord`, `rol`, `created_at`) VALUES
(1, 'Admin', 'admin@premiumwagens.nl', '0192023a7bbd73250516f069df18b500', 'admin', '2024-10-02 12:17:32'),
(2, 'Klant', 'klant@premiumwagens.nl', 'fdaa5eefceb86cad8027d985a084f491', 'klant', '2024-10-02 12:17:32'),
(3, 'test', 'test@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 'klant', '2024-10-02 12:31:59'),
(4, 'erik', 'erik@gmail.com', '6a42dd6e7ca9a813693714b0d9aa1ad8', 'klant', '2024-10-02 21:15:47'),
(5, 'jan', 'jan@gmail.com', 'fa27ef3ef6570e32a79e74deca7c1bc3', 'klant', '2024-10-03 10:38:04');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
