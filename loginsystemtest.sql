-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 24. Dez 2022 um 01:26
-- Server-Version: 10.3.37-MariaDB-0ubuntu0.20.04.1
-- PHP-Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `loginsystemtest`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `playerdata`
--

CREATE TABLE `playerdata` (
  `id` int(11) NOT NULL,
  `playerid` varchar(255) DEFAULT NULL,
  `level` int(255) NOT NULL DEFAULT 0,
  `exp` int(255) NOT NULL DEFAULT 0,
  `points` int(255) NOT NULL DEFAULT 0,
  `coins` int(255) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `playerdata`
--

INSERT INTO `playerdata` (`id`, `playerid`, `level`, `exp`, `points`, `coins`) VALUES
(18, 'yourmail@defconnet.work', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `userdata`
--

CREATE TABLE `userdata` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `online` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `userdata`
--

INSERT INTO `userdata` (`id`, `email`, `password`, `username`, `online`) VALUES
(23, 'yourmail@defconnet.work', '$2y$10$BiJJEoXRJElKENNBXIYjSODL/Xr7g.IXge9dDIrKEk1k.I0gb4eTS', 'YourName', 1);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `playerdata`
--
ALTER TABLE `playerdata`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email_2` (`email`,`password`),
  ADD KEY `INDEX` (`email`,`password`) USING BTREE;

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `playerdata`
--
ALTER TABLE `playerdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT für Tabelle `userdata`
--
ALTER TABLE `userdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
