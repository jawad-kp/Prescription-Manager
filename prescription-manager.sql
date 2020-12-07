-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2020 at 11:03 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prescription-manager`
--
CREATE DATABASE IF NOT EXISTS `prescription-manager` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `prescription-manager`;

-- --------------------------------------------------------

--
-- Table structure for table `adminlog`
--

DROP TABLE IF EXISTS `adminlog`;
CREATE TABLE `adminlog` (
  `Name` varchar(200) NOT NULL COMMENT 'The admin''s name',
  `AdmId` varchar(200) NOT NULL COMMENT 'The User name for the admin',
  `AdmPass` varchar(400) NOT NULL COMMENT 'The hashed admin password',
  `PhnNo` varchar(15) NOT NULL COMMENT 'Contact information for the admin'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Admin Table for Approving and removing doctors';

-- --------------------------------------------------------

--
-- Table structure for table `doclog`
--

DROP TABLE IF EXISTS `doclog`;
CREATE TABLE `doclog` (
  `DocID` varchar(300) NOT NULL COMMENT 'This is the Primary Key column that holds Doctor ID for us',
  `DocName` mediumtext NOT NULL COMMENT 'The Doctor''s Name',
  `DocPass` varchar(600) NOT NULL COMMENT 'Hashed Password',
  `DocAddr` mediumtext NOT NULL COMMENT 'Doctor''s work address',
  `Contact` varchar(15) NOT NULL COMMENT 'Doctor''s contact number'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Registered Doctor login details';

-- --------------------------------------------------------

--
-- Stand-in structure for view `nameviewer`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `nameviewer`;
CREATE TABLE `nameviewer` (
`DocName` mediumtext
,`PatID` varchar(400)
,`PrescID` varchar(300)
,`DocReport` mediumtext
,`Expiry` date
);

-- --------------------------------------------------------

--
-- Table structure for table `patlist`
--

DROP TABLE IF EXISTS `patlist`;
CREATE TABLE `patlist` (
  `DocID` varchar(300) NOT NULL COMMENT 'References Doc ID',
  `PatID` varchar(400) NOT NULL COMMENT 'References Pat ID',
  `PrescID` varchar(300) NOT NULL COMMENT 'Holds The Prescription ID',
  `DocReport` mediumtext NOT NULL COMMENT 'A general diagnosis',
  `Comments` mediumtext COMMENT 'Comments in general',
  `Expiry` date DEFAULT NULL COMMENT 'When The prescription is supposed to expire'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Patient And Prescription List';

-- --------------------------------------------------------

--
-- Table structure for table `patlog`
--

DROP TABLE IF EXISTS `patlog`;
CREATE TABLE `patlog` (
  `PatID` varchar(400) NOT NULL COMMENT 'This is the Primary Key column that holds patient ID for us',
  `PatName` mediumtext NOT NULL COMMENT 'Patient Names. These are encrypted.',
  `PatPass` mediumtext NOT NULL COMMENT 'Hashed Patient Password',
  `Addr` mediumtext NOT NULL COMMENT 'Patient''s address',
  `PatDOB` date NOT NULL COMMENT 'Patient''s Date Of Birth',
  `PatGen` enum('Cis-Male','Cis-Female','Non Binary','Decline','Trans-Male','Trans-Female') NOT NULL DEFAULT 'Decline' COMMENT 'Patient''s Gender'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This table houses basic user profiles.';

-- --------------------------------------------------------

--
-- Table structure for table `pendingdoc`
--

DROP TABLE IF EXISTS `pendingdoc`;
CREATE TABLE `pendingdoc` (
  `DocID` varchar(300) NOT NULL COMMENT 'This is the Primary Key column that holds Doctor ID for us',
  `DocName` mediumtext NOT NULL COMMENT 'The Doctor''s Name',
  `DocPass` varchar(600) NOT NULL COMMENT 'Hashed Password',
  `DocAddr` mediumtext NOT NULL COMMENT 'Doctor''s work address',
  `Contact` varchar(15) NOT NULL COMMENT 'Doctor''s contact number'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Pending Doctor login details';

-- --------------------------------------------------------

--
-- Table structure for table `presclog`
--

DROP TABLE IF EXISTS `presclog`;
CREATE TABLE `presclog` (
  `PrescID` varchar(300) NOT NULL COMMENT 'References PrescId in Patlist',
  `MedName` varchar(300) NOT NULL COMMENT 'Tablet''s Name',
  `Dosage` varchar(60) NOT NULL COMMENT 'The Dosage of the tablet',
  `Frequency` varchar(300) NOT NULL COMMENT 'How often to take the tablet'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Main Prescription Table';

-- --------------------------------------------------------

--
-- Structure for view `nameviewer`
--
DROP TABLE IF EXISTS `nameviewer`;

DROP VIEW IF EXISTS `nameviewer`;
CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `nameviewer`  AS SELECT `doclog`.`DocName` AS `DocName`, `patlist`.`PatID` AS `PatID`, `patlist`.`PrescID` AS `PrescID`, `patlist`.`DocReport` AS `DocReport`, `patlist`.`Expiry` AS `Expiry` FROM (`patlist` join `doclog`) WHERE (`patlist`.`DocID` = `doclog`.`DocID`) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlog`
--
ALTER TABLE `adminlog`
  ADD PRIMARY KEY (`AdmId`);

--
-- Indexes for table `doclog`
--
ALTER TABLE `doclog`
  ADD PRIMARY KEY (`DocID`);

--
-- Indexes for table `patlist`
--
ALTER TABLE `patlist`
  ADD PRIMARY KEY (`PrescID`),
  ADD UNIQUE KEY `Unique Presc` (`PrescID`),
  ADD KEY `DocID linked to DocID Log` (`DocID`),
  ADD KEY `PatID Linked to PatID in PatLog` (`PatID`);

--
-- Indexes for table `patlog`
--
ALTER TABLE `patlog`
  ADD PRIMARY KEY (`PatID`);

--
-- Indexes for table `pendingdoc`
--
ALTER TABLE `pendingdoc`
  ADD PRIMARY KEY (`DocID`);

--
-- Indexes for table `presclog`
--
ALTER TABLE `presclog`
  ADD PRIMARY KEY (`MedName`,`PrescID`),
  ADD KEY `PrescID Link to patlist(PrescID)` (`PrescID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `patlist`
--
ALTER TABLE `patlist`
  ADD CONSTRAINT `DocID linked to DocID Log` FOREIGN KEY (`DocID`) REFERENCES `doclog` (`DocID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `PatID Linked to PatID in PatLog` FOREIGN KEY (`PatID`) REFERENCES `patlog` (`PatID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `presclog`
--
ALTER TABLE `presclog`
  ADD CONSTRAINT `PrescID Link to patlist(PrescID)` FOREIGN KEY (`PrescID`) REFERENCES `patlist` (`PrescID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
