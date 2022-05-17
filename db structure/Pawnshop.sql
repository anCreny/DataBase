-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: May 17, 2022 at 07:29 PM
-- Server version: 8.0.29
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Pawnshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `Client`
--

CREATE TABLE `Client` (
  `IDClient` int NOT NULL,
  `Surname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Patronymic` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `PaperNumber` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `PaperSeries` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `PaperTakingDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Client`
--

INSERT INTO `Client` (`IDClient`, `Surname`, `Name`, `Patronymic`, `PaperNumber`, `PaperSeries`, `PaperTakingDate`) VALUES
(3, 'Бояркин', 'Артем', 'Михайлович', '231122', '3122', '2014-05-07'),
(4, 'Иванов', 'Иван', 'Иванович', '213422', '1231', '2019-05-08'),
(5, 'Петров', 'Иван', 'Васильевич', '123512', '1131', '2019-03-05'),
(6, 'Сидоров', 'Михаил', 'Иванович', '126123', '8654', '2011-01-01'),
(7, 'Силин', 'Максим', 'Юрьевич', '964567', '7772', '2014-01-06'),
(8, 'Кожухарь', 'Владимир', 'Иванович', '213422', '1231', '2019-05-08'),
(9, 'Голубев', 'Даниил', 'Максимович', '623462', '7345', '2015-05-01'),
(10, 'Касаткин', 'Виктор', 'Юрьевич', '128534', '6234', '2013-05-22'),
(11, 'Девочкин', 'Александр', 'Викторович', '920573', '6234', '2017-11-02'),
(12, 'Школьников', 'Дмитрий', 'Николаевич', '123486', '1111', '2012-05-08'),
(13, 'Никишин', 'Илья', 'Владимирович', '861234', '5612', '2019-05-08'),
(14, 'Петушков', 'Олег', 'Иванович', '213222', '4531', '2016-05-18');

-- --------------------------------------------------------

--
-- Table structure for table `Deal`
--

CREATE TABLE `Deal` (
  `IDDeal` int NOT NULL,
  `IDClient` int NOT NULL,
  `IDProductCategory` int NOT NULL,
  `ProductDescription` varchar(255) NOT NULL,
  `TakingDate` date NOT NULL,
  `ReturningDate` date NOT NULL,
  `Pledge` int NOT NULL,
  `Comission` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `OwnProduct`
--

CREATE TABLE `OwnProduct` (
  `IDOwnProduct` int NOT NULL,
  `IDDeal` int NOT NULL,
  `CurrentPrice` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Price`
--

CREATE TABLE `Price` (
  `(PK)IDPrice` int NOT NULL,
  `IDOwnProduct` int NOT NULL,
  `Price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ProductCategory`
--

CREATE TABLE `ProductCategory` (
  `IDProductCategory` int NOT NULL,
  `Name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Notes` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ProductCategory`
--

INSERT INTO `ProductCategory` (`IDProductCategory`, `Name`, `Notes`) VALUES
(1, 'Yellow', 'Yellow');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Client`
--
ALTER TABLE `Client`
  ADD PRIMARY KEY (`IDClient`);

--
-- Indexes for table `Deal`
--
ALTER TABLE `Deal`
  ADD PRIMARY KEY (`IDDeal`),
  ADD KEY `1` (`IDClient`),
  ADD KEY `2` (`IDProductCategory`);

--
-- Indexes for table `OwnProduct`
--
ALTER TABLE `OwnProduct`
  ADD PRIMARY KEY (`IDOwnProduct`),
  ADD KEY `3` (`IDDeal`);

--
-- Indexes for table `Price`
--
ALTER TABLE `Price`
  ADD PRIMARY KEY (`(PK)IDPrice`),
  ADD KEY `6` (`IDOwnProduct`);

--
-- Indexes for table `ProductCategory`
--
ALTER TABLE `ProductCategory`
  ADD PRIMARY KEY (`IDProductCategory`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Client`
--
ALTER TABLE `Client`
  MODIFY `IDClient` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `Deal`
--
ALTER TABLE `Deal`
  MODIFY `IDDeal` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `OwnProduct`
--
ALTER TABLE `OwnProduct`
  MODIFY `IDOwnProduct` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Price`
--
ALTER TABLE `Price`
  MODIFY `(PK)IDPrice` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ProductCategory`
--
ALTER TABLE `ProductCategory`
  MODIFY `IDProductCategory` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Deal`
--
ALTER TABLE `Deal`
  ADD CONSTRAINT `1` FOREIGN KEY (`IDClient`) REFERENCES `Client` (`IDClient`) ON DELETE CASCADE,
  ADD CONSTRAINT `2` FOREIGN KEY (`IDProductCategory`) REFERENCES `ProductCategory` (`IDProductCategory`) ON DELETE RESTRICT;

--
-- Constraints for table `OwnProduct`
--
ALTER TABLE `OwnProduct`
  ADD CONSTRAINT `3` FOREIGN KEY (`IDDeal`) REFERENCES `Deal` (`IDDeal`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `Price`
--
ALTER TABLE `Price`
  ADD CONSTRAINT `6` FOREIGN KEY (`IDOwnProduct`) REFERENCES `OwnProduct` (`IDOwnProduct`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
