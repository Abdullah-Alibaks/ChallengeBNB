-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 14 jan 2021 om 23:36
-- Serverversie: 10.4.11-MariaDB
-- PHP-versie: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cottagerentals`
--
CREATE DATABASE IF NOT EXISTS `cottagerentals` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cottagerentals`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `homes`
--

DROP TABLE IF EXISTS `homes`;
CREATE TABLE `homes` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `price_p_p_p_n` decimal(5,2) NOT NULL,
  `price_bed_sheets` decimal(5,2) NOT NULL,
  `description` text DEFAULT NULL,
  `longitude` decimal(7,5) DEFAULT NULL,
  `latitude` decimal(7,5) DEFAULT NULL,
  `provincie` varchar(60) DEFAULT NULL,
  `max_capacity` int(4) NOT NULL,
  `bath_present` tinyint(1) NOT NULL DEFAULT 0,
  `pool_present` tinyint(4) NOT NULL,
  `bbq_present` tinyint(4) NOT NULL,
  `wifi_present` tinyint(4) NOT NULL,
  `fireplace_present` tinyint(4) NOT NULL,
  `dishwasher_present` tinyint(4) NOT NULL,
  `bike_rental` tinyint(4) NOT NULL,
  `price_bike_rental` decimal(5,2) NOT NULL COMMENT 'per bike',
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `homes`
--

INSERT INTO `homes` (`id`, `name`, `price_p_p_p_n`, `price_bed_sheets`, `description`, `longitude`, `latitude`, `provincie`, `max_capacity`, `bath_present`, `pool_present`, `bbq_present`, `wifi_present`, `fireplace_present`, `dishwasher_present`, `bike_rental`, `price_bike_rental`, `image`) VALUES
(1, 'IJmuiden Cottage', '55.00', '10.00', 'Welkom bij dit huisje! In 2018 is dit huisje gerenoveerd. De woning bestaat uit twee lagen met op de begane grond een ingerichte keuken met inbouwapparatuur, een grote woonruimte en een toilet. De bovenverdieping is bestaat uit twee slaapkamers met twee tweepersoonsbedden. Daarnaast is er ook een badkamer met ligbad en toilet. De woning is voorzien van CV, WIFI, en digitale tv.', '4.61001', '52.44902', 'Noord-Holland', 4, 0, 0, 1, 0, 0, 0, 0, '0.00', 'images/Ijmuiden.jpg'),
(2, 'Assen Bungalow', '150.00', '0.00', '  Het huisje is omringd door bomen, bloemen en planten. Het is een prachtige plek om wakker te worden met het geluid van vogels. Mischien ziet u vanaf de tuinbank egeltjes en eekhoorns. Het huisje heeft een compleet ingerichte keuken met o.a. een 5 pits gaskooksstel, grote oven en uitgebreide benodigdheden. Er is een aparte eettafel aanwezig', '6.64928', '52.99864', 'Drenthe', 6, 0, 1, 1, 0, 0, 0, 0, '0.00', 'Assen.jpg'),
(3, 'Espelo Entree', '300.00', '0.00', ' Het huisje ligt op het platteland tussen Deventer (20 minuten) en Almelo (30 minuten), in het coulissenlandschap van de achterhoek. Je kunt hier perfect wandelen of fietsen. Met het huisje als thuisbasis kun je de achterhoek en vlakbij het Nationaal Park De Sallandse Heuvelrug kun je hier een geweldige tijde beleven. De verhuurders genieten elke dag weer van de rust en de ruimte.', '6.36800', '52.30340', 'Overijssel', 8, 1, 1, 1, 0, 0, 0, 1, '15.00', 'images/Espelo.jpg'),
(4, 'Weustenrade Woning', '75.00', '0.00', '    Bent u op zoek naar een verblijf met veel mooie natuur in de buurt waar u echt tot rust komt? Dan is het dit natuurhuisje misschien de plek die u zocht. Het huisje staat op een vakantiepark, waar er een relaxte en gemoedelijke sfeer hangt. Het huisje staat tegen een bos aan, beschikt over een mooie afgesloten tuin en u bent al met minder dan 50 meter lopen in de prachtige natuur.', '5.90979', '50.89720', 'Limburg', 4, 1, 0, 1, 0, 1, 0, 0, '0.00', 'images/Weusterade.jpg');

-- --------------------------------------------------------

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `homes`
--
ALTER TABLE `homes`
  ADD PRIMARY KEY (`id`);


--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `homes`
--
ALTER TABLE `homes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
