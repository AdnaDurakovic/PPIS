-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2016 at 12:35 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `skladisteproizvoda`
--

INSERT INTO `skladisteproizvoda` (`ProizvodID`, `Naziv`, `Kolicina`, `Cijena`, `Opis`, `Slika`, `DatumAzuriranja`, `Azurirao`) VALUES
(1, 'Radni stol Libelle', 124, 100, 'Proizvođač: TVILUM SCANBIRK A/S, Ege Alle'' 2, Faaarvang, Danska', '8.jpg', '2016-03-29 00:00:00', 1),
(2, 'Krevet Wiking', 512, 230, 'Proizvođač: FLEXA4DREAMS - THUKA, Hornsyld Industivej 4, 8783 Hornsyld, Danska', '7.jpg', '2016-03-14 00:00:00', 1),
(3, 'Vitrina Olympus', 10, 435, 'Proizvođač: Zhejiang Henglin Chair Industry Co., Ltd., 3Block, Sunlight Industry Zone, Anji County, Zhejiang', '9.jpg', '2016-03-16 00:00:00', 1),
(4, 'Police Basics', 77, 419.99, 'Proizvođač: TVILUM SCANBIRK A/S, Ege Alle'' 2, Faaarvang, Danska\n\n\n', '6.jpg', '2016-03-15 00:00:00', 1),
(5, 'Stolić Rocco', 120, 49.99, 'Proizvođač: BAZHOU ZHONGBO TOUGHENED GLASS PRODUCT CO.,LTD Zhongxing Industryzone Dongduan, Langfang City, Kina', '5.jpg', '2015-11-17 00:00:00', 1),
(6, 'Charly dječji krevet', 500, 450, 'Proizvođač: PARISOT MEUBLES.Av Jacques Parisot,St Loup sur Semouse,FRANCE\r\n\r\n\r\n', '14.jpg', '2016-05-11 00:00:00', 1),
(7, 'Function radni stol', 300, 79.99, 'Proizvođač: TVILUM SCANBIRK A/S, Ege Alle'' 2, Faaarvang, Danska', '13.jpg', '2016-03-15 00:00:00', 1),
(8, 'Olivia blok kuhinja', 450, 2000, 'Proizvođač: Forma Ideale d.o.o.,Industrijska bb,Kragujevac,Srbija', '12.jpg', '2016-03-15 00:00:00', 1),
(9, 'Hana ormar', 350, 360, 'Proizvođač: Forma Ideale d.o.o.,Industrijska bb,Kragujevac,Srbija', '11.jpg', '2016-03-15 00:00:00', 1),
(10, 'Soul regal', 500, 470, 'Proizvođač: FABRYKI MEBLI FORTE S.A., UL.BIALA 1, 07-300 OSTROW MAZOWIECKA, POLJSKA', '10.jpg', '2016-03-15 00:00:00', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `skladisteproizvoda`
--
ALTER TABLE `skladisteproizvoda`
  ADD CONSTRAINT `skladisteproizvoda_ibfk_1` FOREIGN KEY (`Azurirao`) REFERENCES `menadzer` (`MenadzerID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
