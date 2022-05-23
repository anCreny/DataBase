-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: db
-- Время создания: Май 23 2022 г., 09:14
-- Версия сервера: 8.0.29
-- Версия PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Pawnshop`
--

DELIMITER $$
--
-- Процедуры
--
CREATE DEFINER=`root`@`%` PROCEDURE `ActiveDeals` ()  READS SQL DATA SELECT Deal.IDDeal, CONCAT(Client.Name, ' ', Client.Surname) AS Client, Deal.ProductDescription, Deal.TakingDate, DATEDIFF(Deal.ReturningDate, CURRENT_DATE) AS DaysLeft, Deal.ReturningDate 
FROM Deal
JOIN Client
ON Client.IDClient = Deal.IDClient
WHERE IDDeal IN (SELECT IDDeal FROM OwnProduct)
AND Deal.ReturningDate > CURRENT_DATE$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `Client`
--

CREATE TABLE `Client` (
  `IDClient` int NOT NULL,
  `Surname` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `Name` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `Patronymic` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `NumberOfPaper` varchar(6) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `PaperSeries` varchar(4) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `PaperTakingDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `Client`
--

INSERT INTO `Client` (`IDClient`, `Surname`, `Name`, `Patronymic`, `NumberOfPaper`, `PaperSeries`, `PaperTakingDate`) VALUES
(3, 'Бояркин', 'Артем', 'Михайлович', '231122', '3122', '2014-05-07'),
(4, 'Иванов', 'Иван', 'Иванович', '213422', '1231', '2019-05-08'),
(5, 'Петров', 'Иван', 'Васильевич', '123512', '1131', '2019-03-05'),
(6, 'Сидоров', 'Михаил', 'Иванович', '126123', '8654', '2011-01-01'),
(7, 'Силин', 'Максим', 'Юрьевич', '964567', '7772', '2014-01-06'),
(8, 'Божухарь', 'Владимир', 'Иванович', '213422', '1231', '2019-05-08'),
(9, 'Голубев', 'Даниил', 'Максимович', '623461', '7345', '2015-05-01'),
(10, 'Касаткин', 'Виктор', 'Юрьевич', '128533', '6234', '2013-05-22'),
(11, 'Девочкин', 'Александр', 'Викторович', '920573', '6234', '2017-11-02'),
(12, 'Школьников', 'Дмитрий', 'Николаевич', '123486', '1111', '2012-05-08'),
(13, 'Никишин', 'Илья', 'Владимирович', '861234', '5612', '2019-05-08'),
(14, 'Петушков', 'Олег', 'Иванович', '213222', '4531', '2016-05-18');

--
-- Триггеры `Client`
--
DELIMITER $$
CREATE TRIGGER `Incorrect Number1` BEFORE INSERT ON `Client` FOR EACH ROW IF CHAR_LENGTH(NEW.NumberOfPaper) != 6 THEN
SIGNAL SQLSTATE VALUE '99999'
      SET MESSAGE_TEXT = "The Paper Number must be only 6 numbers";
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Incorrect Number2` BEFORE UPDATE ON `Client` FOR EACH ROW IF CHAR_LENGTH(NEW.NumberOfPaper) != 6 THEN
SIGNAL SQLSTATE VALUE '99999'
      SET MESSAGE_TEXT = "The Paper Number must be only 6 numbers";
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Incorrect Series1` BEFORE INSERT ON `Client` FOR EACH ROW IF CHAR_LENGTH(NEW.PaperSeries) != 4 THEN
SIGNAL SQLSTATE VALUE '99999'
      SET MESSAGE_TEXT = "The Paper Series must be only 4 numbers";
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Incorrect Series2` BEFORE UPDATE ON `Client` FOR EACH ROW IF CHAR_LENGTH(NEW.PaperSeries) != 4 THEN
SIGNAL SQLSTATE VALUE '99999'
      SET MESSAGE_TEXT = "The Paper Series must be only 4 numbers";
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `Deal`
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

--
-- Дамп данных таблицы `Deal`
--

INSERT INTO `Deal` (`IDDeal`, `IDClient`, `IDProductCategory`, `ProductDescription`, `TakingDate`, `ReturningDate`, `Pledge`, `Comission`) VALUES
(7, 3, 7, 'Iphone 11', '2022-03-02', '2022-05-02', 4000, 12),
(8, 3, 8, 'soft pillow', '2022-04-01', '2022-06-01', 300, 2),
(9, 9, 7, 'Laptop Lenovo', '2022-05-17', '2022-07-08', 3000, 12),
(11, 8, 7, 'Samsung A52', '2022-02-01', '2022-05-31', 1500, 16),
(12, 13, 8, 'Two pillows', '2022-05-03', '2022-05-05', 20, 2),
(13, 7, 6, 'Father\'s glasses', '2018-12-05', '2018-12-12', 600, 5),
(15, 10, 9, 'Paper pack\r\n', '2022-05-01', '2022-06-10', 4500, 20),
(16, 6, 5, 'Flower pot', '2021-08-02', '2020-11-20', 50, 4);

--
-- Триггеры `Deal`
--
DELIMITER $$
CREATE TRIGGER `Incorrect Dates2` BEFORE UPDATE ON `Deal` FOR EACH ROW IF NEW.ReturningDate < NEW.TakingDate
THEN
	SIGNAL SQLSTATE VALUE '99999'
      SET MESSAGE_TEXT = "The TakingDate couldn't be later then ReturningDate ";
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Incorrect TakingDate` BEFORE INSERT ON `Deal` FOR EACH ROW IF CURRENT_DATE < NEW.TakingDate
THEN
	SIGNAL SQLSTATE VALUE '99999'
      SET MESSAGE_TEXT = "You can't be in the future.";
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Incorrect TakingDate2` BEFORE UPDATE ON `Deal` FOR EACH ROW IF CURRENT_DATE < NEW.TakingDate
THEN
	SIGNAL SQLSTATE VALUE '99999'
      SET MESSAGE_TEXT = "You can't be in the future.";
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Incorrent dates` BEFORE INSERT ON `Deal` FOR EACH ROW IF NEW.ReturningDate < NEW.TakingDate
THEN
	SIGNAL SQLSTATE VALUE '99999'
      SET MESSAGE_TEXT = "The TakingDate couldn't be later then ReturningDate ";
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `OwnProduct`
--

CREATE TABLE `OwnProduct` (
  `IDOwnProduct` int NOT NULL,
  `IDDeal` int NOT NULL,
  `CurrentPrice` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `OwnProduct`
--

INSERT INTO `OwnProduct` (`IDOwnProduct`, `IDDeal`, `CurrentPrice`) VALUES
(5, 16, 200),
(6, 9, 1999),
(7, 8, 699),
(9, 11, 1999),
(10, 12, 299),
(11, 15, 5000),
(12, 7, 2222);

-- --------------------------------------------------------

--
-- Структура таблицы `Price`
--

CREATE TABLE `Price` (
  `IDPrice` int NOT NULL,
  `IDOwnProduct` int NOT NULL,
  `Price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Price`
--

INSERT INTO `Price` (`IDPrice`, `IDOwnProduct`, `Price`) VALUES
(2, 5, 2000),
(3, 5, 500),
(4, 6, 3999),
(5, 6, 799),
(6, 7, 231),
(7, 7, 299),
(10, 9, 999),
(11, 9, 2499),
(12, 10, 499),
(13, 10, 199),
(14, 11, 5999),
(15, 11, 3999);

-- --------------------------------------------------------

--
-- Структура таблицы `ProductCategory`
--

CREATE TABLE `ProductCategory` (
  `IDProductCategory` int NOT NULL,
  `Name` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `Notes` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `ProductCategory`
--

INSERT INTO `ProductCategory` (`IDProductCategory`, `Name`, `Notes`) VALUES
(5, 'Plastic', 'Smth plastic'),
(6, 'Glass', 'Smth from glass'),
(7, 'Electronic', 'Some electronics'),
(8, 'Fabric', 'Smth Fabric'),
(9, 'Paper', 'Smth Paper');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Client`
--
ALTER TABLE `Client`
  ADD PRIMARY KEY (`IDClient`);

--
-- Индексы таблицы `Deal`
--
ALTER TABLE `Deal`
  ADD PRIMARY KEY (`IDDeal`),
  ADD KEY `Client` (`IDClient`),
  ADD KEY `ProductCategory` (`IDProductCategory`);

--
-- Индексы таблицы `OwnProduct`
--
ALTER TABLE `OwnProduct`
  ADD PRIMARY KEY (`IDOwnProduct`),
  ADD KEY `Deal` (`IDDeal`);

--
-- Индексы таблицы `Price`
--
ALTER TABLE `Price`
  ADD PRIMARY KEY (`IDPrice`),
  ADD KEY `OwnProduct` (`IDOwnProduct`);

--
-- Индексы таблицы `ProductCategory`
--
ALTER TABLE `ProductCategory`
  ADD PRIMARY KEY (`IDProductCategory`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Client`
--
ALTER TABLE `Client`
  MODIFY `IDClient` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `Deal`
--
ALTER TABLE `Deal`
  MODIFY `IDDeal` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `OwnProduct`
--
ALTER TABLE `OwnProduct`
  MODIFY `IDOwnProduct` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `Price`
--
ALTER TABLE `Price`
  MODIFY `IDPrice` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `ProductCategory`
--
ALTER TABLE `ProductCategory`
  MODIFY `IDProductCategory` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Deal`
--
ALTER TABLE `Deal`
  ADD CONSTRAINT `Client` FOREIGN KEY (`IDClient`) REFERENCES `Client` (`IDClient`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `ProductCategory` FOREIGN KEY (`IDProductCategory`) REFERENCES `ProductCategory` (`IDProductCategory`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `OwnProduct`
--
ALTER TABLE `OwnProduct`
  ADD CONSTRAINT `3` FOREIGN KEY (`IDDeal`) REFERENCES `Deal` (`IDDeal`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `Price`
--
ALTER TABLE `Price`
  ADD CONSTRAINT `6` FOREIGN KEY (`IDOwnProduct`) REFERENCES `OwnProduct` (`IDOwnProduct`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
