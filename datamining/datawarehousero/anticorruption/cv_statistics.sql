-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 31, 2019 at 07:18 PM
-- Server version: 5.7.27-0ubuntu0.19.04.1
-- PHP Version: 7.2.19-0ubuntu0.19.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cv_statistics`
--

-- --------------------------------------------------------

--
-- Table structure for table `cv`
--

CREATE TABLE `cv` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `institution` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `urlpdf` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cv`
--

INSERT INTO `cv` (`id`, `fullname`, `institution`, `position`, `url`, `urlpdf`, `date_added`) VALUES
(1, 'IOAN DENEȘ', 'Ministerul Apelor si Padurilor', 'MINISTRUL', 'http://apepaduri.gov.ro/ministru-2/', 'http://apepaduri.gov.ro/wp-content/uploads/2014/07/Ioan_Denes_CV-1.pdf', '2019-08-24 12:28:25'),
(2, 'Daniel-Constantin Coroamă', 'Ministerul Apelor si Padurilor', 'Secretar de stat pentru Păduri', 'http://apepaduri.gov.ro/secretar-de-stat-pentru-paduri/', 'http://apepaduri.gov.ro/wp-content/uploads/2017/03/CV-Daniel-Constantin-COROAM%C4%82.pdf', '2019-08-24 12:30:59'),
(3, 'ADRIANA PETCU', 'Ministerul Apelor si Padurilor', 'Secretar de stat pentru Ape', 'http://apepaduri.gov.ro/secretar-de-stat-pentru-ape/', 'http://apepaduri.gov.ro/wp-content/uploads/2017/03/CV_Adriana.Petcu_.SS_.Ape_-1.pdf', '2019-08-24 12:31:47'),
(4, 'CONSTANTIN-DAN DELEANU', 'Ministerul Apelor si Padurilor', 'Subsecretar de Stat', 'http://apepaduri.gov.ro/subsecretar-de-stat/', 'http://apepaduri.gov.ro/wp-content/uploads/2014/07/CV-Ion-Anghel-02.2017-ptr.-site.pdf', '2019-08-24 12:32:36'),
(5, 'Győző István BÁRCZI', 'Ministerul Apelor si Padurilor', 'Secretar General', 'http://apepaduri.gov.ro/secretar-general/', 'http://apepaduri.gov.ro/wp-content/uploads/2017/02/CV-Europass-20170301-Ba%CC%81rczi-RO-2.pdf', '2019-08-24 12:33:26'),
(6, 'Ion ANGHEL', 'Ministerul Apelor si Padurilor', 'Secretar general adjunct', 'http://apepaduri.gov.ro/secretar-general-adjunct/', 'http://apepaduri.gov.ro/wp-content/uploads/2014/07/CV-Ion-Anghel-02.2017-ptr.-site.pdf', '2019-08-24 12:34:21');

-- --------------------------------------------------------

--
-- Table structure for table `sourceurls`
--

CREATE TABLE `sourceurls` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `linked` varchar(255) NOT NULL,
  `dateref` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sourceurls`
--

INSERT INTO `sourceurls` (`id`, `name`, `linked`, `dateref`) VALUES
(1, 'Ministere defuncte din România', 'https://ro.wikipedia.org/wiki/Categorie:Ministere_defuncte_din_Rom%C3%A2nia', '2019-08-24 00:00:00'),
(2, 'Ministerul Apelor și Pădurilor ', 'http://apepaduri.gov.ro/conducere/', '2019-08-24 18:01:34'),
(3, 'Organizații guvernamentale din România', 'https://ro.wikipedia.org/wiki/Categorie:Organiza%C8%9Bii_guvernamentale_din_Rom%C3%A2nia', '2019-08-24 18:01:51'),
(4, 'Ministere în România', 'https://ro.wikipedia.org/wiki/Categorie:Ministere_%C3%AEn_Rom%C3%A2nia', '2019-08-24 18:02:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cv`
--
ALTER TABLE `cv`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sourceurls`
--
ALTER TABLE `sourceurls`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cv`
--
ALTER TABLE `cv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sourceurls`
--
ALTER TABLE `sourceurls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
