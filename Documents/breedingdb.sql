-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2015 at 05:08 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `breedingdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `breedings`
--

CREATE TABLE IF NOT EXISTS `breedings` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) DEFAULT NULL,
  `BreedingAbbrDef` varchar(10) NOT NULL,
  `Description` text,
  `user_id` int(11) NOT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_breedings_users1_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `breedings`
--

INSERT INTO `breedings` (`ID`, `Name`, `BreedingAbbrDef`, `Description`, `user_id`, `updated_at`, `created_at`) VALUES
(1, 'test', 'test', 'test                                                ', 1, '2015-08-06', '2015-08-06'),
(2, 'zweite Zucht', 'test', 'test							\r\n						', 1, '2015-08-06', '2015-08-06'),
(3, 'e', 'ts', 'tes', 2, '2015-08-04', '2015-08-05');

-- --------------------------------------------------------

--
-- Table structure for table `guinea pigs`
--

CREATE TABLE IF NOT EXISTS `guinea pigs` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Image` varchar(100) DEFAULT NULL,
  `Name` varchar(50) NOT NULL,
  `BirthDate` varchar(50) NOT NULL,
  `breedingAbbr` varchar(45) DEFAULT NULL,
  `Race` varchar(100) NOT NULL,
  `Color` varchar(100) NOT NULL,
  `DateOfDeath` varchar(50) DEFAULT NULL,
  `Sexe` int(1) DEFAULT '0',
  `idLitter` int(11) DEFAULT NULL,
  `id_breeding` int(11) DEFAULT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_guinea pigs_litter_idx` (`idLitter`),
  KEY `fk_guinea pigs_breedings1_idx` (`id_breeding`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `guinea pigs`
--

INSERT INTO `guinea pigs` (`ID`, `Image`, `Name`, `BirthDate`, `breedingAbbr`, `Race`, `Color`, `DateOfDeath`, `Sexe`, `idLitter`, `id_breeding`, `updated_at`, `created_at`) VALUES
(1, NULL, 'test', '30.03.1996', 'test', 'test', 'aA bB crC eE Pp rnrn Ss', NULL, 1, 1, 1, '2015-08-06', '2015-08-06'),
(2, NULL, 'Lenny', '30.03.1996', 'NHZ', 'test', 'Aa bB cdcr Eep PP Rnrn SS', NULL, 0, NULL, 1, '2015-08-07', '2015-08-07');

-- --------------------------------------------------------

--
-- Table structure for table `litter`
--

CREATE TABLE IF NOT EXISTS `litter` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `startdate` date DEFAULT NULL,
  `expectedLitterDate` date DEFAULT NULL,
  `IDMotherGP` int(11) NOT NULL,
  `IDFatherGP` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_litter_guinea pigs1_idx` (`IDMotherGP`),
  KEY `fk_litter_guinea pigs2_idx` (`IDFatherGP`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `litter`
--

INSERT INTO `litter` (`ID`, `startdate`, `expectedLitterDate`, `IDMotherGP`, `IDFatherGP`) VALUES
(1, '2015-08-07', '2015-09-03', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `birthdate` date NOT NULL,
  `password` varchar(256) DEFAULT NULL,
  `remember_token` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `firstname`, `lastname`, `birthdate`, `password`, `remember_token`, `email`, `updated_at`, `created_at`) VALUES
(1, 'Natalie', 'Schumacher', '1996-03-30', '$2y$10$Pv9jicYTJ.olEvnV1sQj4.ABnmW2i0fXM3u8BPPxsEMK55cA8g6re', '', 'snatsch@gmx.ch', '2015-08-06', '2015-08-06'),
(2, 'test', 'test', '2015-08-12', 'test', '', 'test', '2015-08-04', '2015-08-04');

-- --------------------------------------------------------

--
-- Table structure for table `weight_guineapig`
--

CREATE TABLE IF NOT EXISTS `weight_guineapig` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `id_guineapig` int(11) NOT NULL,
  `Weight` decimal(10,2) NOT NULL,
  `DateOfWeighing` date NOT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `IDGuineaPig` (`id_guineapig`),
  KEY `id_guineapig` (`id_guineapig`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `weight_guineapig`
--

INSERT INTO `weight_guineapig` (`ID`, `id_guineapig`, `Weight`, `DateOfWeighing`, `updated_at`, `created_at`) VALUES
(1, 1, '1.00', '2015-08-19', '0000-00-00', '0000-00-00'),
(2, 1, '0.50', '2015-08-28', '0000-00-00', '0000-00-00'),
(3, 1, '2.50', '2015-09-19', '2015-09-18', '2015-09-18'),
(4, 1, '2.00', '2015-09-18', '2015-09-18', '2015-09-18'),
(5, 1, '1.80', '2015-09-17', '2015-09-18', '2015-09-18'),
(6, 2, '2.00', '2015-10-19', '2015-09-18', '2015-09-18');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `breedings`
--
ALTER TABLE `breedings`
  ADD CONSTRAINT `breedings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`);

--
-- Constraints for table `guinea pigs`
--
ALTER TABLE `guinea pigs`
  ADD CONSTRAINT `guinea pigs_ibfk_1` FOREIGN KEY (`id_breeding`) REFERENCES `breedings` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `litter`
--
ALTER TABLE `litter`
  ADD CONSTRAINT `fk_litter_guinea pigs1` FOREIGN KEY (`IDMotherGP`) REFERENCES `guinea pigs` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_litter_guinea pigs2` FOREIGN KEY (`IDFatherGP`) REFERENCES `guinea pigs` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `weight_guineapig`
--
ALTER TABLE `weight_guineapig`
  ADD CONSTRAINT `weight_guineapig_ibfk_1` FOREIGN KEY (`id_guineapig`) REFERENCES `guinea pigs` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
