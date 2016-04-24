-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2016 at 02:28 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fabrikawood`
--

-- --------------------------------------------------------

--
-- Table structure for table `dobavljac`
--

CREATE TABLE IF NOT EXISTS `dobavljac` (
  `DobavljacID` int(11) NOT NULL AUTO_INCREMENT,
  `Naziv` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `Telefon` varchar(20) COLLATE utf8_slovenian_ci NOT NULL,
  `Email` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `Adresa` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `TekuciRacun` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `Opis` text COLLATE utf8_slovenian_ci NOT NULL,
  PRIMARY KEY (`DobavljacID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `dobavljac`
--

INSERT INTO `dobavljac` (`DobavljacID`, `Naziv`, `Telefon`, `Email`, `Adresa`, `TekuciRacun`, `Opis`) VALUES
(1, 'Woody', '030111111', 'woody@woody.net', '120 City Wood', '0000154700552', '');

-- --------------------------------------------------------

--
-- Table structure for table `kupovina`
--

CREATE TABLE IF NOT EXISTS `kupovina` (
  `ProizvodID` int(11) NOT NULL,
  `KupovinaID` int(11) NOT NULL,
  `Kolicina` int(11) NOT NULL,
  KEY `ProizvodID` (`ProizvodID`,`KupovinaID`),
  KEY `KupovinaID` (`KupovinaID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `kupovina`
--

INSERT INTO `kupovina` (`ProizvodID`, `KupovinaID`, `Kolicina`) VALUES
(4, 1, 100),
(2, 1, 100),
(4, 2, 50),
(3, 2, 60),
(4, 3, 160),
(2, 3, 100),
(1, 4, 50),
(5, 4, 60),
(2, 5, 160),
(3, 5, 100);

-- --------------------------------------------------------

--
-- Table structure for table `kupovinaproizvoda`
--

CREATE TABLE IF NOT EXISTS `kupovinaproizvoda` (
  `KupovinaID` int(11) NOT NULL AUTO_INCREMENT,
  `NazivKupca` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `Email` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `Telefon` varchar(20) COLLATE utf8_slovenian_ci NOT NULL,
  `DatumKupovine` date NOT NULL,
  `KreiraoNarudzbenicu` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  PRIMARY KEY (`KupovinaID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `kupovinaproizvoda`
--

INSERT INTO `kupovinaproizvoda` (`KupovinaID`, `NazivKupca`, `Email`, `Telefon`, `DatumKupovine`, `KreiraoNarudzbenicu`) VALUES
(1, 'John', 'john@jj.com', '+387622238422', '2016-03-31', 'Enzio Enzio'),
(2, 'Emazetti', 'john@emazetti.com', '+38765555414', '2016-03-31', 'John Johny'),
(3, 'Ben', 'ben@mail.com', '+38761314123', '2016-04-14', 'John Johny'),
(4, 'Haris', 'haris@nesto.com', '+38761233123', '2016-04-09', 'Emily'),
(5, 'Adna', 'adna@mail.com', '+387563131424', '2016-04-22', 'Emily');

-- --------------------------------------------------------

--
-- Table structure for table `menadzer`
--

CREATE TABLE IF NOT EXISTS `menadzer` (
  `MenadzerID` int(11) NOT NULL AUTO_INCREMENT,
  `Ime` varchar(10) COLLATE utf8_slovenian_ci NOT NULL,
  `Prezime` varchar(30) COLLATE utf8_slovenian_ci NOT NULL,
  `DatumRodjenja` date NOT NULL,
  `Email` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `Telefon` varchar(20) COLLATE utf8_slovenian_ci NOT NULL,
  `Opis` text COLLATE utf8_slovenian_ci NOT NULL,
  `Tip` int(11) NOT NULL,
  `Username` varchar(30) COLLATE utf8_slovenian_ci NOT NULL,
  `Password` varchar(25) COLLATE utf8_slovenian_ci NOT NULL,
  PRIMARY KEY (`MenadzerID`),
  UNIQUE KEY `Username` (`Username`),
  KEY `Tip` (`Tip`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `menadzer`
--

INSERT INTO `menadzer` (`MenadzerID`, `Ime`, `Prezime`, `DatumRodjenja`, `Email`, `Telefon`, `Opis`, `Tip`, `Username`, `Password`) VALUES
(1, 'Nicolas', 'Cage', '1964-01-07', 'ncage@gemail.com', '062222111', 'You don''t say?', 1, 'ncage', 'ncage'),
(2, 'Mathew', 'McConaughey', '1969-11-04', 'mmcconaughey@gemail.com', '061555444', 'Alright, alright, alright.', 2, 'mathew', 'mathew');

-- --------------------------------------------------------

--
-- Table structure for table `narucenesirovine`
--

CREATE TABLE IF NOT EXISTS `narucenesirovine` (
  `NarudzbenicaID` int(11) NOT NULL,
  `SirovinaID` int(11) NOT NULL,
  KEY `NarudzbenicaID` (`NarudzbenicaID`,`SirovinaID`),
  KEY `SirovinaID` (`SirovinaID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `narudzbenica`
--

CREATE TABLE IF NOT EXISTS `narudzbenica` (
  `NarudzbenicaID` int(11) NOT NULL AUTO_INCREMENT,
  `Datum` date NOT NULL,
  `Dobavljac` int(11) NOT NULL,
  `Tekst` text COLLATE utf8_slovenian_ci NOT NULL,
  `IzdaoNarudzbenicu` int(11) NOT NULL,
  PRIMARY KEY (`NarudzbenicaID`),
  KEY `Dobavljac` (`Dobavljac`,`IzdaoNarudzbenicu`),
  KEY `IzdaoNarudzbenicu` (`IzdaoNarudzbenicu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sirovine`
--

CREATE TABLE IF NOT EXISTS `sirovine` (
  `ProizvodID` int(11) NOT NULL,
  `SirovinaID` int(11) NOT NULL,
  `KolicinaSirovine` int(11) NOT NULL,
  KEY `ProizvodID` (`ProizvodID`,`SirovinaID`),
  KEY `SirovinaID` (`SirovinaID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `sirovine`
--

INSERT INTO `sirovine` (`ProizvodID`, `SirovinaID`, `KolicinaSirovine`) VALUES
(1, 3, 20),
(3, 3, 50),
(3, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `skladisteproizvoda`
--

CREATE TABLE IF NOT EXISTS `skladisteproizvoda` (
  `ProizvodID` int(11) NOT NULL AUTO_INCREMENT,
  `Naziv` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `Kolicina` int(11) NOT NULL,
  `Cijena` double NOT NULL,
  `Opis` text COLLATE utf8_slovenian_ci NOT NULL,
  `Slika` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `DatumAzuriranja` datetime NOT NULL,
  `Azurirao` int(11) NOT NULL,
  PRIMARY KEY (`ProizvodID`),
  KEY `Azurirao` (`Azurirao`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `skladisteproizvoda`
--

INSERT INTO `skladisteproizvoda` (`ProizvodID`, `Naziv`, `Kolicina`, `Cijena`, `Opis`, `Slika`, `DatumAzuriranja`, `Azurirao`) VALUES
(1, 'Radni stol Libelle', 124, 100, 'Proizvođač: TVILUM SCANBIRK A/S, Ege Alle'' 2, Faaarvang, Danska', '8.jpg', '2016-03-29 00:00:00', 1),
(2, 'Krevet Wiking', 512, 230, 'Proizvođač: FLEXA4DREAMS - THUKA, Hornsyld Industivej 4, 8783 Hornsyld, Danska', '7.jpg', '2016-03-14 00:00:00', 1),
(3, 'Vitrina Olympus', 0, 435, 'Proizvođač: Zhejiang Henglin Chair Industry Co., Ltd., 3Block, Sunlight Industry Zone, Anji County, Zhejiang', '9.jpg', '2016-03-16 00:00:00', 1),
(4, 'Police Basics', 77, 419.99, 'Proizvođač: TVILUM SCANBIRK A/S, Ege Alle'' 2, Faaarvang, Danska\n\n\n', '6.jpg', '2016-03-15 00:00:00', 1),
(5, 'Stolić Rocco', 120, 49.99, 'Proizvođač: BAZHOU ZHONGBO TOUGHENED GLASS PRODUCT CO.,LTD Zhongxing Industryzone Dongduan, Langfang City, Kina', '5.jpg', '2015-11-17 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `skladistesirovina`
--

CREATE TABLE IF NOT EXISTS `skladistesirovina` (
  `SirovinaID` int(11) NOT NULL AUTO_INCREMENT,
  `Naziv` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `Kolicina` int(11) NOT NULL,
  `Cijena` double NOT NULL,
  `Dimenzije` double NOT NULL,
  `Opis` text COLLATE utf8_slovenian_ci NOT NULL,
  `DatumAzuriranja` datetime NOT NULL,
  `Azurirao` int(11) NOT NULL,
  PRIMARY KEY (`SirovinaID`),
  KEY `Azurirao` (`Azurirao`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `skladistesirovina`
--

INSERT INTO `skladistesirovina` (`SirovinaID`, `Naziv`, `Kolicina`, `Cijena`, `Dimenzije`, `Opis`, `DatumAzuriranja`, `Azurirao`) VALUES
(3, 'bukva', 124, 130, 40, 'Dimenzije su u m3, a cijena se računa po 1m3.', '2016-03-15 00:00:00', 1),
(4, 'staklo1', 89, 150, 0.72, '', '2016-03-01 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tipmenadzera`
--

CREATE TABLE IF NOT EXISTS `tipmenadzera` (
  `TipID` int(11) NOT NULL AUTO_INCREMENT,
  `Naziv` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `Plata` double NOT NULL,
  PRIMARY KEY (`TipID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tipmenadzera`
--

INSERT INTO `tipmenadzera` (`TipID`, `Naziv`, `Plata`) VALUES
(1, 'menadzer prodaje', 1800),
(2, 'menadzer nabavke', 2000);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kupovina`
--
ALTER TABLE `kupovina`
  ADD CONSTRAINT `kupovina_ibfk_1` FOREIGN KEY (`ProizvodID`) REFERENCES `skladisteproizvoda` (`ProizvodID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kupovina_ibfk_2` FOREIGN KEY (`KupovinaID`) REFERENCES `kupovinaproizvoda` (`KupovinaID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menadzer`
--
ALTER TABLE `menadzer`
  ADD CONSTRAINT `tipmenadzerafk` FOREIGN KEY (`Tip`) REFERENCES `tipmenadzera` (`TipID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `narucenesirovine`
--
ALTER TABLE `narucenesirovine`
  ADD CONSTRAINT `narucenesirovine_ibfk_1` FOREIGN KEY (`NarudzbenicaID`) REFERENCES `narudzbenica` (`NarudzbenicaID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `narucenesirovine_ibfk_2` FOREIGN KEY (`SirovinaID`) REFERENCES `skladistesirovina` (`SirovinaID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `narudzbenica`
--
ALTER TABLE `narudzbenica`
  ADD CONSTRAINT `narudzbenica_ibfk_1` FOREIGN KEY (`Dobavljac`) REFERENCES `dobavljac` (`DobavljacID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `narudzbenica_ibfk_2` FOREIGN KEY (`IzdaoNarudzbenicu`) REFERENCES `menadzer` (`MenadzerID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sirovine`
--
ALTER TABLE `sirovine`
  ADD CONSTRAINT `sirovine_ibfk_1` FOREIGN KEY (`ProizvodID`) REFERENCES `skladisteproizvoda` (`ProizvodID`),
  ADD CONSTRAINT `sirovine_ibfk_2` FOREIGN KEY (`SirovinaID`) REFERENCES `skladistesirovina` (`SirovinaID`);

--
-- Constraints for table `skladisteproizvoda`
--
ALTER TABLE `skladisteproizvoda`
  ADD CONSTRAINT `skladisteproizvoda_ibfk_1` FOREIGN KEY (`Azurirao`) REFERENCES `menadzer` (`MenadzerID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `skladistesirovina`
--
ALTER TABLE `skladistesirovina`
  ADD CONSTRAINT `skladistesirovina_ibfk_1` FOREIGN KEY (`Azurirao`) REFERENCES `menadzer` (`MenadzerID`) ON DELETE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
