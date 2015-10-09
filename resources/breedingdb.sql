-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2015 at 04:00 PM
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
-- Table structure for table `combinations`
--

CREATE TABLE IF NOT EXISTS `combinations` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) DEFAULT NULL,
  `CombinationType` enum('Race','Color') DEFAULT NULL,
  `Description` text,
  `ImageUrl` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=81 ;

--
-- Dumping data for table `combinations`
--

INSERT INTO `combinations` (`ID`, `Name`, `CombinationType`, `Description`, `ImageUrl`, `created_at`, `updated_at`) VALUES
(1, 'Glatthaar', 'Race', NULL, NULL, '2015-10-09', NULL),
(2, 'Crested', 'Race', NULL, NULL, '2015-10-09', NULL),
(3, 'Rosetten', 'Race', NULL, NULL, '2015-10-09', NULL),
(4, 'Rex', 'Race', NULL, NULL, '2015-10-09', NULL),
(5, 'US-Teddy', 'Race', NULL, NULL, '2015-10-09', NULL),
(6, 'CH-Teddy', 'Race', NULL, NULL, '2015-10-09', NULL),
(7, 'Sheltie', 'Race', NULL, NULL, '2015-10-09', NULL),
(8, 'Coronet', 'Race', NULL, NULL, '2015-10-09', NULL),
(9, 'Peruaner', 'Race', NULL, NULL, '2015-10-09', NULL),
(10, 'Texel', 'Race', NULL, NULL, '2015-10-09', NULL),
(11, 'Merino', 'Race', NULL, NULL, '2015-10-09', NULL),
(12, 'Alpaka', 'Race', NULL, NULL, '2015-10-09', NULL),
(13, 'Lunkarya', 'Race', NULL, NULL, '2015-10-09', NULL),
(14, 'Ridgeback', 'Race', NULL, NULL, '2015-10-09', NULL),
(15, 'Curly', 'Race', NULL, NULL, '2015-10-09', NULL),
(16, 'Angora', 'Race', NULL, NULL, '2015-10-09', NULL),
(17, 'Mohair', 'Race', NULL, NULL, '2015-10-09', NULL),
(18, 'Minipli', 'Race', NULL, NULL, '2015-10-09', NULL),
(19, 'Sheba Mini Yak', 'Race', NULL, NULL, '2015-10-09', NULL),
(20, 'Goldagouti', 'Color', NULL, NULL, '2015-10-09', NULL),
(21, 'Grauagouti', 'Color', NULL, NULL, '2015-10-09', NULL),
(22, 'Lemonagouti', 'Color', NULL, NULL, '2015-10-09', NULL),
(23, 'Silberagouti', 'Color', NULL, NULL, '2015-10-09', NULL),
(24, 'Orangeagouti', 'Color', NULL, NULL, '2015-10-09', NULL),
(25, 'Buffagouti', 'Color', NULL, NULL, '2015-10-09', NULL),
(26, 'Cremeagouti', 'Color', NULL, NULL, '2015-10-09', NULL),
(27, 'Cinnamonagouti', 'Color', NULL, NULL, '2015-10-09', NULL),
(28, 'Salmagouti', 'Color', NULL, NULL, '2015-10-09', NULL),
(29, 'Lilacagouti', 'Color', NULL, NULL, '2015-10-09', NULL),
(30, 'Beige-Goldagouti', 'Color', NULL, NULL, '2015-10-09', NULL),
(31, 'Beige-Agouti', 'Color', NULL, NULL, '2015-10-09', NULL),
(32, 'Slate Blue-Gold-Agouti', 'Color', NULL, NULL, '2015-10-09', NULL),
(33, 'Slate Blue-Safran-Agouti', 'Color', NULL, NULL, '2015-10-09', NULL),
(34, 'Slate Blue-Creme-Agouti', 'Color', NULL, NULL, '2015-10-09', NULL),
(35, 'Slate Blue-Creme-Agouti', 'Color', NULL, NULL, '2015-10-09', NULL),
(36, 'Slate Blue-Weiss-Agouti', 'Color', NULL, NULL, '2015-10-09', NULL),
(37, 'Coffee-Gold-Agouti', 'Color', NULL, NULL, '2015-10-09', NULL),
(38, 'Coffe-Safran-Agouti', 'Color', NULL, NULL, '2015-10-09', NULL),
(39, 'Coffee-Creme', 'Color', NULL, NULL, '2015-10-09', NULL),
(40, 'Coffee-Weiss-Agouti', 'Color', NULL, '', '2015-10-09', NULL),
(41, 'Lilac-Safran-Agouti', 'Color', NULL, NULL, '2015-10-09', NULL),
(42, 'Lilac-Creme-Agouti', 'Color', NULL, NULL, '2015-10-09', NULL),
(43, 'Beige-Safran-Agouti', NULL, NULL, NULL, '2015-10-09', NULL),
(44, 'Beige-Creme-Agouti', 'Color', NULL, NULL, '2015-10-09', NULL),
(45, 'Schwarz', 'Color', NULL, NULL, '2015-10-09', NULL),
(46, 'Schokolade', 'Color', NULL, NULL, '2015-10-09', NULL),
(47, 'Slate Blue', 'Color', NULL, NULL, '2015-10-09', NULL),
(48, 'Coffee', 'Color', NULL, NULL, '2015-10-09', NULL),
(49, 'Lilac', 'Color', NULL, NULL, '2015-10-09', NULL),
(50, 'Beige', 'Color', NULL, NULL, '2015-10-09', NULL),
(51, 'Beige', 'Color', NULL, NULL, '2015-10-09', NULL),
(52, 'Rot', 'Color', NULL, NULL, '2015-10-09', NULL),
(53, 'Gold d.e', 'Color', NULL, NULL, '2015-10-09', NULL),
(54, 'Gold r.e', 'Color', NULL, NULL, '2015-10-09', NULL),
(55, 'Buff', 'Color', NULL, NULL, '2015-10-09', NULL),
(56, 'Creme d.e', 'Color', NULL, NULL, '2015-10-09', NULL),
(57, 'Creme r.e', 'Color', NULL, NULL, '2015-10-09', NULL),
(58, 'Weiss d.e', 'Color', NULL, NULL, '2015-10-09', NULL),
(59, 'Weiss r.e', 'Color', NULL, NULL, '2015-10-09', NULL),
(60, 'Brindle Schwarz-Rot', 'Color', NULL, NULL, '2015-10-09', NULL),
(61, 'Brindle Schokolade Buff', 'Color', NULL, NULL, '2015-10-09', NULL),
(62, 'Schildpatt Schwarz-Rot', 'Color', NULL, NULL, '2015-10-09', NULL),
(63, 'Schildpatt Schokolade-Buff', 'Color', NULL, NULL, '2015-10-09', NULL),
(64, 'Holländer Schwar-Rot Agouti', 'Color', NULL, NULL, '2015-10-09', NULL),
(65, 'Holländer Schwarz', 'Color', NULL, NULL, '2015-10-09', NULL),
(66, 'Himalaya Schwarz', 'Color', NULL, NULL, '2015-10-09', NULL),
(67, 'Himalaya Schokolade', 'Color', NULL, NULL, '2015-10-09', NULL),
(68, 'Dalmatiner Schwarz', 'Color', NULL, NULL, '2015-10-09', NULL),
(69, 'Dalmatiner Schwarz-Rot-Agouti', 'Color', NULL, NULL, '2015-10-09', NULL),
(70, 'Schimmel Schwarz', 'Color', NULL, NULL, '2015-10-09', NULL),
(71, 'Schimmel Schwarz-Rot', 'Color', NULL, NULL, '2015-10-09', NULL),
(72, 'Dapple', 'Color', NULL, NULL, '2015-10-09', NULL),
(73, 'California Rot', 'Color', NULL, NULL, '2015-10-09', NULL),
(74, 'California Weiss', 'Color', NULL, NULL, '2015-10-09', NULL),
(75, 'Schwarz-Weiss (Zweifarbig)', 'Color', NULL, NULL, '2015-10-09', NULL),
(76, 'Rot-Weiss (zweifarbig)', 'Color', NULL, NULL, '2015-10-09', NULL),
(77, 'Schwarz-Rot-Weiss', 'Color', NULL, NULL, '2015-10-09', NULL),
(78, 'Schwarz-Rot-Weiss (dreifarbig)', 'Color', NULL, NULL, '2015-10-09', NULL),
(79, 'Schokolade-Buff-Weiss', 'Color', NULL, NULL, '2015-10-09', NULL),
(80, 'Marder', 'Color', NULL, NULL, '2015-10-09', NULL);

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
(1, NULL, 'test', '30.03.2013', 'test', 'LL rhrh MM stst SnSn RxRx FzFz ChCh lulu', 'arar BB CC EE PP SS rnrn', NULL, 1, 1, 1, '2015-08-06', '2015-08-06'),
(2, NULL, 'Lenny', '30.03.2014', 'NHZ', 'LL rhrh MM stst SnSn RxRx FzFz ChCh lulu', 'AA BB CC EE PP SS rnrn', NULL, 0, NULL, 1, '2015-08-07', '2015-08-07');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `weight_guineapig`
--

INSERT INTO `weight_guineapig` (`ID`, `id_guineapig`, `Weight`, `DateOfWeighing`, `updated_at`, `created_at`) VALUES
(1, 1, '1.00', '2015-08-19', '0000-00-00', '0000-00-00'),
(2, 1, '0.50', '2015-08-28', '0000-00-00', '0000-00-00'),
(3, 1, '2.50', '2015-09-19', '2015-09-18', '2015-09-18'),
(4, 1, '2.00', '2015-09-18', '2015-09-18', '2015-09-18'),
(5, 1, '1.80', '2015-09-17', '2015-09-18', '2015-09-18'),
(6, 2, '2.00', '2015-10-19', '2015-09-18', '2015-09-18'),
(7, 2, '1.50', '2015-10-09', '2015-10-09', '2015-10-09');

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
