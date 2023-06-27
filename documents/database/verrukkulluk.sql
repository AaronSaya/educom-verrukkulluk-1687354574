-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 27 jun 2023 om 16:59
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
-- Database: `verrukkulluk`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `artikel`
--

CREATE TABLE `artikel` (
  `id` int(10) NOT NULL,
  `naam_artikel` varchar(30) NOT NULL,
  `omschrijving` varchar(30) NOT NULL,
  `prijs` decimal(10,2) NOT NULL,
  `eenheid` varchar(30) NOT NULL,
  `hoeveelheid_verpakking` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `artikel`
--

INSERT INTO `artikel` (`id`, `naam_artikel`, `omschrijving`, `prijs`, `eenheid`, `hoeveelheid_verpakking`) VALUES
(1, 'Munt', 'Munt met fijne mentholsmaak vo', 1.09, 'gr', 15),
(2, 'Verstegen Strooier Chili', 'Verstegen chilipoeder is een m', 2.99, 'gr', 35),
(3, 'Alpro Cooking', '\r\nAlpro cooking plantaardige v', 1.59, 'ml', 250),
(4, 'Biologisch Knoflook', 'Knoflook behoort tot de famili', 1.09, 'gr', 100),
(5, 'Biologisch Gele uien', 'Uien behoren tot de familie va', 0.99, 'gr', 500),
(6, 'Maggi Groente bouillon minder ', 'Voeg met Maggi groentebouillon', 1.49, 'gr', 72),
(7, 'Bonduelle Tuinerwtjes', 'Deze groene parels geven kleur', 1.89, 'gr', 400),
(8, 'Campina Botergoud ongezouten r', 'Campina botergoud ongezouten r', 1.79, 'gr', 125),
(9, 'Parrano Orginale rasp', 'Parrano originale rasp is een ', 2.65, 'gr', 100),
(10, 'Olijfolie traditioneel', 'Olijfolie verkregen uit koude ', 7.39, 'ml', 1000),
(11, 'Tomaten', 'Tomaten zijn sappig en vol van', 1.49, 'gr', 500),
(12, 'Campina Halfvolle melk', 'Een glas verse melk is lekker ', 1.79, 'ml', 1000),
(13, 'Galbani Ricotta', 'De frisse, milde smaak en luch', 3.35, 'gr', 250),
(14, 'Zalmfilet', 'De zalm wordt gekweekt in Noor', 9.69, 'gr', 310),
(15, 'Spinazie grootverpakking', 'Spinazie heeft een enkelvoudig', 2.45, 'gr', 600),
(16, 'Grand Italia Lasagne volkoren', 'Een traditionele Italiaanse la', 2.45, 'gr', 250),
(17, 'Citroensap', 'Citroensap uit concentraat', 0.59, 'ml', 200),
(18, 'Sinaasappelsap', 'Lekker verfrissend! Deze licht', 1.45, 'ml', 1000),
(19, 'Alpro Soja naturel', 'Alpro plantaardige variatie op', 2.09, 'gr', 500),
(20, 'Bananen tros', 'De banaan is de bekendste trop', 1.49, 'gr', 500),
(21, 'Zespri Sungold kiwi bio', 'Verwen je zintuigen met de onw', 4.49, 'stuks', 4),
(22, 'Avocado', 'Avocado is een zachte en romig', 0.79, 'stuks', 1),
(23, 'Biologisch Sperziebonen', 'Vriesverse hele sperziebonen u', 1.49, 'gr', 450),
(24, 'Conimex Gebakken uitjes', 'Conimex krokante gebakken uitj', 1.19, 'gr', 100),
(25, 'Conimex Kroepoek Naturel', 'Conimex naturel kroepoek is op', 1.55, 'gr', 72),
(26, 'Lassie Zilvervliesrijst kortko', 'Volkoren rijst met een nootach', 1.49, 'gr', 400),
(27, 'Conimex Badjak sambal', 'Conimex sambal Badjak is een a', 1.79, 'gr', 200),
(28, 'Koriander', 'Deze koriander met een zachtzo', 1.09, 'gr', 15),
(29, 'Maggi Rundvlees bouillonblokje', 'De Maggi runderbouillonblokjes', 1.29, 'gr', 80),
(30, 'Sereh', 'Een echte smaakmaker in de Azi', 1.09, 'gr', 50),
(31, 'Verstegen Laurier heel', 'Laurierbladeren zijn ovaal van', 1.99, 'gr', 4),
(32, 'Fairtrade Original Kokosmelk', 'Bij een kleine fabriek in Sri ', 2.25, 'ml', 400),
(33, 'Greenfields Runder sukadelappe', 'Stoofvlees dat zo zacht is, da', 10.49, 'gr', 700),
(34, 'Conimex Rendang vlees boemboe', 'Conimex rendang vlees boemboe ', 1.79, 'gr', 95);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruiker`
--

CREATE TABLE `gebruiker` (
  `id` int(10) NOT NULL,
  `gebruikersnaam` varchar(50) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `afbeelding` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `gebruiker`
--

INSERT INTO `gebruiker` (`id`, `gebruikersnaam`, `wachtwoord`, `email`, `afbeelding`) VALUES
(1, 'Alba', 'Tros123', 'AlbaTros@1234', 0x416c62612e6a7067),
(2, 'Octo', 'Tentakel123', 'OctoTentakel@1234', 0x4f63746f2e6a7067),
(3, 'Bassie', 'Adriaan123', 'Bassie&Adriaan@1234', 0x4261737369652e6a7067),
(4, 'Mike', 'Tyson123', 'MikeTyson@1234', 0x6d696b652e6a7067);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gerecht`
--

CREATE TABLE `gerecht` (
  `id` int(10) NOT NULL,
  `keuken_id` int(10) NOT NULL,
  `type_id` int(10) NOT NULL,
  `gebruiker_id` int(10) NOT NULL,
  `datum_toegevoegd` datetime NOT NULL DEFAULT current_timestamp(),
  `titel` varchar(30) NOT NULL,
  `omschrijving` text NOT NULL,
  `afbeelding` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `gerecht`
--

INSERT INTO `gerecht` (`id`, `keuken_id`, `type_id`, `gebruiker_id`, `datum_toegevoegd`, `titel`, `omschrijving`, `afbeelding`) VALUES
(1, 1, 2, 3, '2021-12-12 00:00:00', 'Heerlijke vers gemaakte soep v', 'Heerlijke vers gemaakte soep van doperwtjes met een frisse smaak van munt. Simpel en snel gemaakt in 20 minuten.', 0x657277746a65732e6a7067),
(2, 3, 4, 1, '2023-06-27 00:00:00', 'Zalm spinazie lasagne', 'Makkelijke verse lasagne met laagjes romige spinazie, plakjes tomaat en zalm, een heerlijke combinatie van pasta, groenten en vis', 0x6c617361676e652d6d65742d7a616c6d2e6a7067),
(3, 5, 6, 1, '2023-05-13 00:00:00', 'Kiwi smoothie met avocado', 'Met deze smoothie heb je een kickstart van een ochtend, want hij zit boordevol vitamines. Extra lekker door de gele kiwi en de romige avocado.', 0x5a65737072695f736d6f6f746869652e6a7067),
(4, 7, 8, 4, '2020-07-17 00:00:00', 'Indonesische rendang basisrece', 'Hoe maak je zelf de lekkerste rendang thuis? Met dit recept kun je kiezen voor een zelfgemaakte of kant en klare boemboe en bevat eenvoudige ingrediënten en stap voor stap fotos', 0x52656e64616e672e6a7067);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gerecht_info`
--

CREATE TABLE `gerecht_info` (
  `id` int(10) NOT NULL,
  `record_type` varchar(1) NOT NULL,
  `gerecht_id` int(10) NOT NULL,
  `gebruiker_id` int(10) DEFAULT NULL,
  `datum` varchar(10) NOT NULL,
  `numeriekveld` int(10) NOT NULL,
  `tekstveld` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `gerecht_info`
--

INSERT INTO `gerecht_info` (`id`, `record_type`, `gerecht_id`, `gebruiker_id`, `datum`, `numeriekveld`, `tekstveld`) VALUES
(1, 'B', 1, NULL, '23-03-2022', 1, 'Snipper het uitje en de knoflook en fruit deze aan in een soeppan'),
(2, 'B', 1, NULL, '23-03-2022', 2, 'Voeg de bevroren erwtjes en wat blaadjes verse munt toe en bak een minuutje mee.'),
(3, 'B', 1, NULL, '23-03-2022', 3, 'Voeg het water toe en breng aan de kook..'),
(4, 'B', 1, NULL, '23-03-2022', 4, 'Doe het bouillontablet erbij en laat oplossen.'),
(5, 'B', 1, NULL, '23-03-2022', 5, 'Kook de erwtjes ca. 10 minuutjes en pureer dan fijn met een staafmixer. Je kunt dit ook in een (sterke) blender doen.'),
(6, 'B', 1, NULL, '23-03-2022', 6, 'Roer dan de room erdoor en breng de soep op smaak met een snufje chili en eventueel een snufje zwarte peper..'),
(7, 'B', 1, NULL, '23-03-2022', 7, 'Garneer de soep met wat munt, extra erwtjes en maak een swirl met room of olie.'),
(8, 'B', 1, NULL, '23-03-2022', 8, 'Serveertip: Lekker met een zelfgemaakt knoflookbroodje of een bietenquiche erbij om er een volledige hoofdmaaltijd van te maken.'),
(9, 'O', 2, 3, '12-12-2012', 0, 'BLABLABLABLBALBALBLABBALBLABLA'),
(10, 'B', 2, NULL, '29-01-1999', 1, 'Verwarm de oven op 200 graden. Bak de spinazie in etappes in een grote pan tot deze geslonken is. Snijd de zalm in dunne plakken.'),
(11, 'B', 2, NULL, '29-01-1999', 2, 'Druk met een lepel zo veel mogelijk vocht uit de spinazie in een zeef of vergiet. Doe de geslonken spinazie in een kom en voeg de ricotta en melk toe en meng door elkaar. Breng op smaak met een flinke snuf peper, zout en knoflook.'),
(12, 'B', 2, NULL, '29-01-1999', 3, 'Vet de ovenschaal in en verdeel een beetje (ca ⅕ deel) van het spinazie mengsel over de bodem. Leg hier 3 a 4 lasagnevellen op. Verdeel hier wat van het spinazie mengsel (ca ⅕ deel) over en de helft van de plakjes zalm. Dek weer af met lasagnevellen en schep er weer een beetje van het spinazie mengsel over en 1 tomaat in plakken.'),
(13, 'B', 2, NULL, '29-01-1999', 4, 'Herhaal dit nog een keer met het spinazie mengsel en zalm, lasagnebladen en eindig met het spinazie mengsel met plakjes tomaat. Bestrooi de zalm lasagne met kaas en zet ca. 45 minuten in de oven tot hij gaar is.'),
(14, 'B', 2, NULL, '29-01-1999', 5, 'Tip: je kunt ook gerookte zalm gebruiken ipv verse filet. Dan komt de zalmsmaak nog beter naar voren in het gerecht. In plaats van spinazie kun je ook spinazie uit de diepvries gebruiken (niet gehakte) en deze laten ontdooien en goed uitlekken.'),
(16, 'B', 3, NULL, '23-03-2019', 1, 'Schil de kiwi, avocado en banaan en snijd in grove stukken'),
(17, 'B', 3, NULL, '23-03-2019', 2, 'Voeg eventueel een schep havermout toe voor een volledig ontbijtje.'),
(18, 'B', 3, NULL, '23-03-2019', 3, 'Tip: drink de smoothie direct op na het bereiden. Door de combinatie van rauwe kiwi’s met melkproducten kan deze gaan schiften. Dit geld trouwens ook voor gelatine.'),
(20, 'B', 4, NULL, '11-11-2011', 1, 'Maak eerst de boemboe als je deze niet kant-en-klaar hebt gekocht.'),
(21, 'B', 4, NULL, '11-11-2011', 2, 'Snijd het vlees in blokjes.'),
(22, 'B', 4, NULL, '11-11-2011', 3, 'Doe de boemboe in een grote (braad/stoof) pan en bak een minuutje aan. Houd je van pittig dan kun je ook een beetje sambal toevoegen.'),
(23, 'B', 4, NULL, '11-11-2011', 4, 'Voeg het vlees toe en schep er doorheen.'),
(24, 'B', 4, NULL, '11-11-2011', 5, 'Voeg vervolgens de kokosmelk en water toe en het blaadje laurier en sereh. Kruimel het bouillonblokje er bij en laat de rendang 3 uur stoven met deksel schuin op de pan. Roer af en toe door.'),
(25, 'B', 4, NULL, '11-11-2011', 6, 'Wil je de rendang iets laten indikken? Haal dan de deksel van de pan en laat nog iets langer stoven. Wil je hem juist wat dunner dan kun je een beetje water toevoegen. Proef op het laatst of er nog een beetje peper of zout nodig is. Garneer de rendang met wat koriander of geraspte kokos.'),
(26, 'B', 4, NULL, '11-11-2011', 7, 'Vaak is de rendang de volgende dag nog lekkerder. Bewaar hem in de koelkast max. 3 dag of vries hem in.'),
(27, 'W', 4, 1, '11-11-2011', 5, '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `ingrediënten`
--

CREATE TABLE `ingrediënten` (
  `id` int(10) NOT NULL,
  `gerecht_id` int(10) NOT NULL,
  `artikel_id` int(10) NOT NULL,
  `hoeveelheid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `ingrediënten`
--

INSERT INTO `ingrediënten` (`id`, `gerecht_id`, `artikel_id`, `hoeveelheid`) VALUES
(1, 1, 6, 500),
(2, 1, 7, 450),
(3, 1, 5, 50),
(4, 1, 4, 5),
(5, 1, 10, 5),
(6, 1, 3, 100),
(7, 1, 2, 1),
(8, 1, 1, 10),
(9, 2, 16, 250),
(10, 2, 15, 600),
(11, 2, 14, 300),
(12, 2, 11, 200),
(13, 2, 4, 5),
(14, 2, 13, 450),
(15, 2, 12, 125),
(16, 2, 9, 30),
(17, 2, 10, 5),
(18, 3, 21, 2),
(19, 3, 20, 200),
(20, 3, 19, 200),
(21, 3, 18, 300),
(22, 3, 22, 2),
(23, 3, 17, 20),
(24, 4, 34, 95),
(25, 4, 33, 1000),
(26, 4, 32, 400),
(27, 4, 29, 10),
(28, 4, 31, 1),
(29, 4, 30, 20),
(30, 4, 28, 7),
(31, 4, 27, 10),
(32, 4, 26, 400),
(33, 4, 25, 35),
(34, 4, 24, 50),
(35, 4, 23, 600);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `keuken_type`
--

CREATE TABLE `keuken_type` (
  `id` int(10) NOT NULL,
  `record_type` varchar(1) NOT NULL,
  `omschrijving` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `keuken_type`
--

INSERT INTO `keuken_type` (`id`, `record_type`, `omschrijving`) VALUES
(1, 'K', 'Nederlands'),
(2, 'T', 'Voorgerecht'),
(3, 'K', 'Italiaans'),
(4, 'T', 'Hoofdgerecht'),
(5, 'K', 'Amerikaans'),
(6, 'T', 'Smoothie'),
(7, 'K', 'Indonesisch'),
(8, 'T', 'Hoofdgerecht');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `gebruiker`
--
ALTER TABLE `gebruiker`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `gerecht`
--
ALTER TABLE `gerecht`
  ADD PRIMARY KEY (`id`),
  ADD KEY `keuken_id` (`keuken_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexen voor tabel `gerecht_info`
--
ALTER TABLE `gerecht_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gerecht_id` (`gerecht_id`);

--
-- Indexen voor tabel `ingrediënten`
--
ALTER TABLE `ingrediënten`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gerecht_id` (`gerecht_id`),
  ADD KEY `artikel_id` (`artikel_id`);

--
-- Indexen voor tabel `keuken_type`
--
ALTER TABLE `keuken_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT voor een tabel `gebruiker`
--
ALTER TABLE `gebruiker`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `gerecht`
--
ALTER TABLE `gerecht`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `gerecht_info`
--
ALTER TABLE `gerecht_info`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT voor een tabel `ingrediënten`
--
ALTER TABLE `ingrediënten`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT voor een tabel `keuken_type`
--
ALTER TABLE `keuken_type`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `gerecht`
--
ALTER TABLE `gerecht`
  ADD CONSTRAINT `gerecht_ibfk_1` FOREIGN KEY (`keuken_id`) REFERENCES `keuken_type` (`id`),
  ADD CONSTRAINT `gerecht_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `keuken_type` (`id`);

--
-- Beperkingen voor tabel `gerecht_info`
--
ALTER TABLE `gerecht_info`
  ADD CONSTRAINT `gerecht_info_ibfk_1` FOREIGN KEY (`gerecht_id`) REFERENCES `gerecht` (`id`);

--
-- Beperkingen voor tabel `ingrediënten`
--
ALTER TABLE `ingrediënten`
  ADD CONSTRAINT `ingrediënten_ibfk_1` FOREIGN KEY (`gerecht_id`) REFERENCES `gerecht` (`id`),
  ADD CONSTRAINT `ingrediënten_ibfk_2` FOREIGN KEY (`artikel_id`) REFERENCES `artikel` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
