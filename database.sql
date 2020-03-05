-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 23120.m.tld.pl
-- Czas generowania: 05 Mar 2020, 01:03
-- Wersja serwera: 5.7.28-31-log
-- Wersja PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `baza23120_marcin_property`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `details`
--

CREATE TABLE `details` (
  `ID` int(11) NOT NULL,
  `id_offer` int(11) NOT NULL,
  `id_domain` int(11) NOT NULL,
  `terrain_area` int(11) DEFAULT NULL,
  `dimensions` char(50) DEFAULT NULL,
  `video` text,
  `virtual_walk` text,
  `market` char(50) DEFAULT NULL,
  `rent` int(11) DEFAULT NULL,
  `rentCurrency` char(10) DEFAULT NULL,
  `deposit` int(11) DEFAULT NULL,
  `depositCurrency` char(10) DEFAULT NULL,
  `building_type` char(50) DEFAULT NULL,
  `floor_no` char(20) DEFAULT NULL,
  `building_floors_num` char(20) DEFAULT NULL,
  `building_material` char(50) DEFAULT NULL,
  `windows_type` char(50) DEFAULT NULL,
  `build_year` smallint(4) DEFAULT NULL,
  `construction_status` char(80) DEFAULT NULL,
  `building_ownership` char(80) DEFAULT NULL,
  `rooms_num` char(20) DEFAULT NULL,
  `structure` char(50) DEFAULT NULL,
  `lighting` char(50) DEFAULT NULL,
  `height` mediumint(9) DEFAULT NULL,
  `parking` char(50) DEFAULT NULL,
  `flooring` char(50) DEFAULT NULL,
  `floors_num` char(20) DEFAULT NULL,
  `garret_type` char(50) DEFAULT NULL,
  `roof_type` char(50) DEFAULT NULL,
  `roofing` char(50) DEFAULT NULL,
  `free_from` date DEFAULT NULL,
  `plot_type` char(50) DEFAULT NULL,
  `location` char(50) DEFAULT NULL,
  `people_size` char(20) DEFAULT NULL,
  `fence` char(50) DEFAULT NULL,
  `heating` char(50) DEFAULT NULL,
  `recreational` tinyint(1) DEFAULT NULL,
  `noSmokingOnly` tinyint(1) DEFAULT NULL,
  `rentToStudents` tinyint(1) DEFAULT NULL,
  `office_space` tinyint(1) DEFAULT NULL,
  `social_facilities` tinyint(1) DEFAULT NULL,
  `ramp` tinyint(1) DEFAULT NULL,
  `media_type_electricity` tinyint(1) DEFAULT NULL,
  `media_type_water` tinyint(1) DEFAULT NULL,
  `media_type_gas` tinyint(1) DEFAULT NULL,
  `media_type_telephone` tinyint(1) DEFAULT NULL,
  `media_type_sewage` tinyint(1) DEFAULT NULL,
  `media_type_cesspool` tinyint(1) DEFAULT NULL,
  `media_type_rafinery` tinyint(1) DEFAULT NULL,
  `media_type_internet` tinyint(1) DEFAULT NULL,
  `media_type_water_purification` tinyint(1) DEFAULT NULL,
  `media_type_cable_tv` tinyint(1) DEFAULT NULL,
  `media_type_power` tinyint(1) DEFAULT NULL,
  `access_type_dirt` tinyint(1) DEFAULT NULL,
  `access_type_soft_surfaced` tinyint(1) DEFAULT NULL,
  `access_type_hard_surfaced` tinyint(1) DEFAULT NULL,
  `access_type_asphalt` tinyint(1) DEFAULT NULL,
  `vicinity_type_forest` tinyint(1) DEFAULT NULL,
  `vicinity_type_lake` tinyint(1) DEFAULT NULL,
  `vicinity_type_open_terrain` tinyint(1) DEFAULT NULL,
  `vicinity_type_mountains` tinyint(1) DEFAULT NULL,
  `vicinity_type_sea` tinyint(1) DEFAULT NULL,
  `security_type_roller_shutters` tinyint(1) DEFAULT NULL,
  `security_type_anti_burglary_door` tinyint(1) DEFAULT NULL,
  `security_type_entryphone` tinyint(1) DEFAULT NULL,
  `security_type_monitoring` tinyint(1) DEFAULT NULL,
  `security_type_alarm` tinyint(1) DEFAULT NULL,
  `security_type_closed_area` tinyint(1) DEFAULT NULL,
  `equipment_type_furniture` tinyint(1) DEFAULT NULL,
  `equipment_type_washing_machine` tinyint(1) DEFAULT NULL,
  `equipment_type_dishwasher` tinyint(1) DEFAULT NULL,
  `equipment_type_fridge` tinyint(1) DEFAULT NULL,
  `equipment_type_stove` tinyint(1) DEFAULT NULL,
  `equipment_type_oven` tinyint(1) DEFAULT NULL,
  `equipment_type_tv` tinyint(1) DEFAULT NULL,
  `extras_type_attic` tinyint(1) DEFAULT NULL,
  `extras_type_pool` tinyint(1) DEFAULT NULL,
  `extras_type_balcony` tinyint(1) DEFAULT NULL,
  `extras_type_usable_room` tinyint(1) DEFAULT NULL,
  `extras_type_garage` tinyint(1) DEFAULT NULL,
  `extras_type_basement` tinyint(1) DEFAULT NULL,
  `extras_type_garden` tinyint(1) DEFAULT NULL,
  `extras_type_terrace` tinyint(1) DEFAULT NULL,
  `extras_type_lift` tinyint(1) DEFAULT NULL,
  `extras_type_two_storey` tinyint(1) DEFAULT NULL,
  `extras_type_separate_kitchen` tinyint(1) DEFAULT NULL,
  `extras_type_air_conditioning` tinyint(1) DEFAULT NULL,
  `extras_type_shop_window` tinyint(1) DEFAULT NULL,
  `extras_type_parking` tinyint(1) DEFAULT NULL,
  `fence_type_brick` tinyint(1) DEFAULT NULL,
  `fence_type_wire` tinyint(1) DEFAULT NULL,
  `fence_type_metal` tinyint(1) DEFAULT NULL,
  `fence_type_wooden` tinyint(1) DEFAULT NULL,
  `fence_type_concrete` tinyint(1) DEFAULT NULL,
  `fence_type_hedge` tinyint(1) DEFAULT NULL,
  `fence_type_other` tinyint(1) DEFAULT NULL,
  `heating_type_oil` tinyint(1) DEFAULT NULL,
  `heating_type_electric` tinyint(1) DEFAULT NULL,
  `heating_type_urban` tinyint(1) DEFAULT NULL,
  `heating_type_fireplace` tinyint(1) DEFAULT NULL,
  `heating_type_stove` tinyint(1) DEFAULT NULL,
  `heating_type_gas` tinyint(1) DEFAULT NULL,
  `heating_type_coal` tinyint(1) DEFAULT NULL,
  `heating_type_biomass` tinyint(1) DEFAULT NULL,
  `heating_type_heat_pump` tinyint(1) DEFAULT NULL,
  `heating_type_solar_collector` tinyint(1) DEFAULT NULL,
  `heating_type_geothermal` tinyint(1) DEFAULT NULL,
  `use_type_services` tinyint(1) DEFAULT NULL,
  `use_type_office` tinyint(1) DEFAULT NULL,
  `use_type_retail` tinyint(1) DEFAULT NULL,
  `use_type_gastronomy` tinyint(1) DEFAULT NULL,
  `use_type_industral` tinyint(1) DEFAULT NULL,
  `use_type_hotel` tinyint(1) DEFAULT NULL,
  `use_type_stock` tinyint(1) DEFAULT NULL,
  `use_type_manufacturing` tinyint(1) DEFAULT NULL,
  `use_type_commercial` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `links`
--

CREATE TABLE `links` (
  `ID` int(11) NOT NULL,
  `id_domain` int(11) NOT NULL,
  `own_id_offer` int(11) NOT NULL,
  `url` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `offers`
--

CREATE TABLE `offers` (
  `ID` int(11) NOT NULL,
  `id_domain` int(11) NOT NULL,
  `own_id_offer` int(11) NOT NULL,
  `offer_type` int(11) NOT NULL,
  `db_add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` mediumtext NOT NULL,
  `description` longtext NOT NULL,
  `geo_level_1` text,
  `geo_level_2` text,
  `geo_level_3` text,
  `geo_level_4` text,
  `start_date` datetime NOT NULL,
  `price` int(11) NOT NULL,
  `price_currency` char(5) NOT NULL,
  `area` int(11) NOT NULL,
  `area_price` int(11) NOT NULL,
  `map_address` text,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `offerOwner` char(50) DEFAULT NULL,
  `person_id` int(45) DEFAULT NULL,
  `phone` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `photos`
--

CREATE TABLE `photos` (
  `ID` int(11) NOT NULL,
  `id_offer` int(11) NOT NULL,
  `url` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sites`
--

CREATE TABLE `sites` (
  `ID` int(11) NOT NULL,
  `domain` char(200) CHARACTER SET utf8 NOT NULL,
  `last_updated` int(11) NOT NULL DEFAULT '0',
  `last_page` int(11) NOT NULL DEFAULT '0',
  `price_range` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `sites`
--

INSERT INTO `sites` (`ID`, `domain`, `last_updated`, `last_page`, `price_range`) VALUES
(1, 'https://gratka.pl/nieruchomosci', 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `id_domain` smallint(4) DEFAULT NULL,
  `own_id_user` bigint(45) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `phone2` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `idx_id_offer` (`id_offer`);

--
-- Indeksy dla tabeli `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `idx_id_domain` (`id_domain`),
  ADD KEY `idx_own_id_offer` (`own_id_offer`) USING BTREE;
ALTER TABLE `links` ADD FULLTEXT KEY `idx_url` (`url`);

--
-- Indeksy dla tabeli `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `idx_id_domain` (`id_domain`),
  ADD KEY `person_id` (`person_id`);

--
-- Indeksy dla tabeli `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `idx_id_offer` (`id_offer`) USING BTREE;

--
-- Indeksy dla tabeli `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `own_id_user` (`own_id_user`);

--
-- AUTO_INCREMENT dla tabel zrzutów
--

--
-- AUTO_INCREMENT dla tabeli `details`
--
ALTER TABLE `details`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `links`
--
ALTER TABLE `links`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `offers`
--
ALTER TABLE `offers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `photos`
--
ALTER TABLE `photos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `sites`
--
ALTER TABLE `sites`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `users` (`ID`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
