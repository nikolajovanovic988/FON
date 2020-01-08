-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 08, 2019 at 11:21 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `academy`
--

-- --------------------------------------------------------

--
-- Table structure for table `Car`
--

CREATE TABLE `Car` (
  `CarID` int(11) NOT NULL,
  `DriverID` int(11) NOT NULL,
  `Car` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Car`
--

INSERT INTO `Car` (`CarID`, `DriverID`, `Car`) VALUES
(1, 1, 'Peugeot'),
(2, 2, 'Renault'),
(3, 5, 'Citroen'),
(4, 6, 'Opel'),
(5, 9, 'Hyundai');

-- --------------------------------------------------------

--
-- Table structure for table `CarInfo`
--

CREATE TABLE `CarInfo` (
  `CarInfoID` int(11) NOT NULL,
  `CarID` int(11) NOT NULL,
  `Color` varchar(255) NOT NULL,
  `Year` varchar(255) NOT NULL,
  `Dors` varchar(255) NOT NULL,
  `Picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CarInfo`
--

INSERT INTO `CarInfo` (`CarInfoID`, `CarID`, `Color`, `Year`, `Dors`, `Picture`) VALUES
(1, 1, 'Blue', '2019', '5', 'https://www.peugeot.rs/media/showrooms/3008/peugeot_3008_galerie-12-1.68708.18.jpg'),
(2, 2, 'Red', '2019', '3', 'http://www.renault.rs/CountriesData/Serbia/images/cars/CLIOB98/RotaryBloc/renault-clio-ph2-b98-959x525_ig_w800_h450.jpg'),
(3, 3, 'White', '2019', '5', 'https://autopromet.rs/citroen/wp-content/uploads/2019/04/C3-thumb.jpg'),
(4, 4, 'Yelow', '2019', '3', 'https://img-ik.cars.co.za/images/2019/4/OpelCorsaGSi/tr:n-news_large/gsi1.jpg'),
(5, 5, 'Gray', '2019', '5', 'https://upload.wikimedia.org/wikipedia/commons/7/75/2018_Hyundai_i30_SE_Nav_T-GDi_1.3_Front.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `Driver`
--

CREATE TABLE `Driver` (
  `DriverID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Surname` varchar(255) NOT NULL,
  `Mail` varchar(255) NOT NULL,
  `Phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Driver`
--

INSERT INTO `Driver` (`DriverID`, `Name`, `Surname`, `Mail`, `Phone`) VALUES
(1, 'Nikola', 'Nikolic', 'nikola@gmail.com', '0691234567'),
(2, 'Marko', 'Markovic', 'marko@gmail.com', '0692234567'),
(5, 'Milos', 'Milosevic', 'milos@gmail.com', '0693234567'),
(6, 'Stefan', 'Stevic', 'stefan@gmail.com', '0694234567'),
(9, 'Petar', 'Peric', 'petar@gmail.com', '0695234567');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Car`
--
ALTER TABLE `Car`
  ADD PRIMARY KEY (`CarID`),
  ADD KEY `PersonID` (`DriverID`);

--
-- Indexes for table `CarInfo`
--
ALTER TABLE `CarInfo`
  ADD PRIMARY KEY (`CarInfoID`),
  ADD KEY `CarID` (`CarID`);

--
-- Indexes for table `Driver`
--
ALTER TABLE `Driver`
  ADD PRIMARY KEY (`DriverID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Car`
--
ALTER TABLE `Car`
  MODIFY `CarID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `CarInfo`
--
ALTER TABLE `CarInfo`
  MODIFY `CarInfoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Driver`
--
ALTER TABLE `Driver`
  MODIFY `DriverID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Car`
--
ALTER TABLE `Car`
  ADD CONSTRAINT `Car_ibfk_1` FOREIGN KEY (`DriverID`) REFERENCES `Driver` (`DriverID`);

--
-- Constraints for table `CarInfo`
--
ALTER TABLE `CarInfo`
  ADD CONSTRAINT `CarInfo_ibfk_1` FOREIGN KEY (`CarID`) REFERENCES `Car` (`CarID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
