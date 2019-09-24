-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2019. Sze 24. 14:51
-- Kiszolgáló verziója: 10.1.39-MariaDB
-- PHP verzió: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `web_api`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `account`
--

CREATE TABLE `account` (
  `id` int(5) NOT NULL,
  `fullname` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `account`
--

INSERT INTO `account` (`id`, `fullname`, `username`, `password`) VALUES
(1, 'Kószó Gábor', 'gabor01', 'ce1a09e639942fdbcfe5791bcf06ca3e'),
(2, 'Michel Angelo', 'michel01', 'a44dc41981313bc8c000977111571d51');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `termektipus`
--

CREATE TABLE `termektipus` (
  `id` int(5) NOT NULL,
  `nev` varchar(255) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `termektipus`
--

INSERT INTO `termektipus` (`id`, `nev`) VALUES
(1, 'élelmiszer'),
(2, 'elektronika'),
(3, 'háztartás'),
(4, 'élvezeti cikk');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `vasarolttermekek`
--

CREATE TABLE `vasarolttermekek` (
  `id` int(11) NOT NULL,
  `termekId` int(11) NOT NULL,
  `darab` int(11) NOT NULL,
  `termeknev` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `ar` int(11) NOT NULL,
  `vasarlo` varchar(255) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `vasarolttermekek`
--

INSERT INTO `vasarolttermekek` (`id`, `termekId`, `darab`, `termeknev`, `ar`, `vasarlo`) VALUES
(1, 1, 2, 'Pick szalámi', 2000, 'John Doe'),
(2, 2, 2, 'Samsung LCD TV', 400000, 'Jane Doe'),
(3, 4, 1, 'Jameson Irish Whiskey', 7900, 'Jon Jones'),
(4, 3, 5, 'szappan', 1000, 'Will Smith');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `termektipus`
--
ALTER TABLE `termektipus`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `vasarolttermekek`
--
ALTER TABLE `vasarolttermekek`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `termekId` (`termekId`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `account`
--
ALTER TABLE `account`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `termektipus`
--
ALTER TABLE `termektipus`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `vasarolttermekek`
--
ALTER TABLE `vasarolttermekek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
