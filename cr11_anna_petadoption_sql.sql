-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2020 at 08:26 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cr11_anna_petadoption.sql`
--
CREATE DATABASE IF NOT EXISTS `cr11_anna_petadoption.sql` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cr11_anna_petadoption.sql`;

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `animalID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `species` varchar(50) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `adoptableDate` date DEFAULT NULL,
  `hobbies` varchar(100) DEFAULT NULL,
  `animalImg` varchar(500) DEFAULT NULL,
  `type` enum('small','large','senior') DEFAULT 'small',
  `website` varchar(200) DEFAULT NULL,
  `fk_locationID` int(11) DEFAULT NULL,
  `adoptedByUserID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`animalID`, `name`, `species`, `birthdate`, `adoptableDate`, `hobbies`, `animalImg`, `type`, `website`, `fk_locationID`, `adoptedByUserID`) VALUES
(25, 'Mostarda', 'Cat', '2010-01-16', '2019-12-17', 'to sleep in the sun', 'https://images.pexels.com/photos/160839/cat-animal-love-pet-160839.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940', 'senior', NULL, 4, 4),
(26, 'Mango', 'bird', '2019-10-31', '2020-03-27', 'eating Mangos!', 'https://images.pexels.com/photos/1972531/pexels-photo-1972531.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940', 'small', NULL, 4, NULL),
(28, 'Mel', 'sheep', '2016-09-23', '2019-06-01', 'to eat fresh grass', 'https://images.pexels.com/photos/667225/pexels-photo-667225.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940', 'large', NULL, 4, 3),
(29, 'Little', 'hamster', '2020-12-15', '2020-05-17', 'walking around the house', 'https://images.pexels.com/photos/2253859/pexels-photo-2253859.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940', 'small', NULL, 4, NULL),
(30, 'Napoleon', 'cat', '2010-03-08', '2018-08-07', 'chasing insects', 'https://images.pexels.com/photos/3652805/pexels-photo-3652805.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940', 'senior', NULL, 4, NULL),
(31, 'Frederico', 'dog', '2020-05-15', '2020-07-20', 'eating shoes', 'https://images.pexels.com/photos/115526/pexels-photo-115526.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940', 'small', NULL, 4, NULL),
(32, 'Woody', 'owl', '2017-11-19', '2018-10-12', 'cuddles with his humans', 'https://images.pexels.com/photos/105809/pexels-photo-105809.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940', 'small', NULL, 4, NULL),
(33, 'Dora', 'dog', '2008-10-30', '2017-03-16', 'chill on her bed', 'https://images.pexels.com/photos/994174/pexels-photo-994174.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940', 'senior', NULL, 4, NULL),
(34, 'Sahara', 'giraff', '2010-04-02', '2016-08-03', 'looking for fruit trees', 'https://images.pexels.com/photos/70442/pexels-photo-70442.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940', 'large', '', 4, NULL),
(35, 'Brazil', 'bird', '2017-02-27', '2020-02-15', 'taking baths', 'https://images.pexels.com/photos/750565/pexels-photo-750565.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940', 'small', NULL, 4, NULL),
(36, 'Pancake', 'cat', '2020-05-13', '2020-07-01', 'to follow you around the house', 'https://cdn.pixabay.com/photo/2019/05/24/06/48/cat-4225674_960_720.jpg', 'small', NULL, 4, NULL),
(38, 'Donna', 'Frog', '2020-01-02', '2020-03-24', 'jump around!', 'https://images.pexels.com/photos/129566/pexels-photo-129566.jpeg?auto=compress&amp;cs=tinysrgb&amp;dpr=1&amp;w=500', 'small', '', 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `locationID` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`locationID`, `address`, `zip`, `city`, `country`) VALUES
(4, 'Yellow Brick Road', '07', 'Not in Kansas', 'Oz');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `userPass` varchar(256) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `userImg` varchar(50) DEFAULT NULL,
  `userStatus` enum('user','admin','superadmin') DEFAULT 'user',
  `fk_locationID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `firstName`, `lastName`, `email`, `userPass`, `birthdate`, `userImg`, `userStatus`, `fk_locationID`) VALUES
(1, 'admin', 'admin', 'admin@mail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '1988-01-09', 'https://cdn.pixabay.com/photo/2016/01/21/08/38/wom', 'admin', NULL),
(3, 'cacau', 'costa', 'cacaud@mail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '1993-09-09', 'https://cdn.pixabay.com/photo/2016/01/21/08/38/wom', 'user', NULL),
(4, 'Anna Luiza', 'Costa', 'annaluizafaya@gmail.com', '52b911a1936cc558574d9bbccba9496148023665a6b356533dae8a11bb81c799', '1992-04-07', NULL, 'superadmin', NULL),
(5, 'Maria', 'Jaeger', 'maria@gmail.com', 'af1c8f5572f161e7f795d3302a3af956228eb5440f1d14b8aaaa598b7d01ddaa', NULL, NULL, 'admin', NULL),
(6, 'Sara', 'Seila', 'sara@gmail.com', '4e9ce95b959c7b33f27717a67f8985ca471e6843fe1a18ca516e8b18dbb075aa', NULL, NULL, 'user', NULL),
(7, 'pedro', 'lima', 'pedro@gmail.com', '389ff4503d5ffa88c10b4b6d23964e77aa09a06c0bec103a6f4cbbc849b254c6', NULL, NULL, 'user', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`animalID`),
  ADD KEY `fk_locationID` (`fk_locationID`),
  ADD KEY `adoptedByUserID` (`adoptedByUserID`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`locationID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_locationID` (`fk_locationID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `animalID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `locationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `animals`
--
ALTER TABLE `animals`
  ADD CONSTRAINT `animals_ibfk_1` FOREIGN KEY (`fk_locationID`) REFERENCES `locations` (`locationID`),
  ADD CONSTRAINT `animals_ibfk_2` FOREIGN KEY (`adoptedByUserID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`fk_locationID`) REFERENCES `locations` (`locationID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
