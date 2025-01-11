-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: localhost
-- Čas generovania: Pi 13.Dec 2024, 17:52
-- Verzia serveru: 10.4.28-MariaDB
-- Verzia PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `Krajcovic`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `Pacient`
--

CREATE TABLE `Pacient` (
  `ID_pacienta` int(11) NOT NULL,
  `Meno` varchar(20) NOT NULL,
  `Priezvisko` varchar(50) NOT NULL,
  `datum_narodenia` date NOT NULL,
  `telefon` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `Pacient`
--

INSERT INTO `Pacient` (`ID_pacienta`, `Meno`, `Priezvisko`, `datum_narodenia`, `telefon`) VALUES
(1, 'Janko', 'Mrkvička', '1985-10-08', '+421900000000'),
(2, 'Anna', 'Zvedaná', '1985-08-18', '+421912345678');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `Vysetrenie`
--

CREATE TABLE `Vysetrenie` (
  `ID_vysetrenia` int(11) NOT NULL,
  `datum` date NOT NULL,
  `typ_vysetrenia` int(3) NOT NULL,
  `cena` decimal(10,2) NOT NULL,
  `opakovana_kontrola` char(1) NOT NULL,
  `ID_pacienta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `Vysetrenie`
--

INSERT INTO `Vysetrenie` (`ID_vysetrenia`, `datum`, `typ_vysetrenia`, `cena`, `opakovana_kontrola`, `ID_pacienta`) VALUES
(3, '2024-12-21', 4, 233.00, 'A', 2),
(4, '2024-12-11', 3, 2321.05, 'A', 1),
(5, '2024-12-12', 4, 345.99, 'N', 1);

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `Pacient`
--
ALTER TABLE `Pacient`
  ADD PRIMARY KEY (`ID_pacienta`);

--
-- Indexy pre tabuľku `Vysetrenie`
--
ALTER TABLE `Vysetrenie`
  ADD PRIMARY KEY (`ID_vysetrenia`),
  ADD KEY `ID_pacienta` (`ID_pacienta`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `Pacient`
--
ALTER TABLE `Pacient`
  MODIFY `ID_pacienta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pre tabuľku `Vysetrenie`
--
ALTER TABLE `Vysetrenie`
  MODIFY `ID_vysetrenia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Obmedzenie pre exportované tabuľky
--

--
-- Obmedzenie pre tabuľku `Vysetrenie`
--
ALTER TABLE `Vysetrenie`
  ADD CONSTRAINT `vysetrenie_ibfk_1` FOREIGN KEY (`ID_pacienta`) REFERENCES `Pacient` (`ID_pacienta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
