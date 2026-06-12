-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 12, 2024 at 02:10 AM
-- Server version: 8.0.39
-- PHP Version: 8.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cars_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `CarID` int NOT NULL,
  `carYear` int NOT NULL,
  `carMake` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `carModel` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `carImage` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`CarID`, `carYear`, `carMake`, `carModel`, `carImage`) VALUES
(9, 2013, 'Audi', 'S4', 'rluleS42013.jpg'),
(10, 2013, 'Ford', 'Fusion', 'rafaFusion2013.jpg'),
(11, 2010, 'Volkswagon', 'Rabbit', 'rafaRabbit2010.jpg'),
(12, 2010, 'Audi', 'A4', 'rafaA42010.jpg'),
(13, 2018, 'Ford', 'F-150', 'ggarciaF-1502018.png');

-- --------------------------------------------------------

--
-- Table structure for table `car_maintenance_issues`
--

CREATE TABLE `car_maintenance_issues` (
  `recordID` int NOT NULL,
  `serviceType` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `serviceDate` date DEFAULT NULL,
  `serviceDescription` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `serviceMileage` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `CarID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car_maintenance_issues`
--

INSERT INTO `car_maintenance_issues` (`recordID`, `serviceType`, `serviceDate`, `serviceDescription`, `serviceMileage`, `CarID`) VALUES
(20, 'Issue', '2024-12-08', 'Rubbing in the rear', '123450', 9),
(21, 'Maintenance', '2024-10-14', 'Oil change', '123300', 9),
(22, 'Maintenance', '2024-12-01', 'Oil change', '168000', 12),
(23, 'Maintenance', '2024-08-20', 'Thermostat replaced', '123000', 9),
(24, 'Issue', '2024-12-10', 'Leaking oil from oil pan', '132500', 11),
(25, 'Maintenance', '2024-11-05', 'brakes', '122350', 10);

-- --------------------------------------------------------

--
-- Table structure for table `ownership`
--

CREATE TABLE `ownership` (
  `ownerShipID` int NOT NULL,
  `UserID` int NOT NULL,
  `CarID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ownership`
--

INSERT INTO `ownership` (`ownerShipID`, `UserID`, `CarID`) VALUES
(9, 2, 10),
(10, 2, 11),
(11, 2, 12),
(12, 21, 13);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int NOT NULL,
  `UserFirstName` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `UserLastName` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `Username` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `UserFirstName`, `UserLastName`, `Username`, `Password`, `admin`) VALUES
(2, 'rafa', 'rafa', 'rafa', '$2y$10$2Vg3SuCFIT7XWIMTGBU2qOxvLiujWXvPoIylBIvTl/Nwdbh1Re3hK', 1),
(19, 'rafa', 'lule', 'rlule', '$2y$10$Dhb.Iq91ij6FRWeiPhHkHe8EyU2arvv6eq7LNSfaPkd0s0NA4Pvv6', 1),
(21, 'Gaby', 'Garcia', 'ggarcia', '$2y$10$Ov0RDL8E6vZ80/G4fnHzSuPOD/4GMJYHDEsqLBkXKgTh.EC45Q6BW', 1),
(22, 'Jose', 'Barraza', 'jb', '$2y$10$2ShXdMAwEcWHliHXlFHeceidPwRHPgL5FvA1fO17nnap8ig.o43f6', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`CarID`);

--
-- Indexes for table `car_maintenance_issues`
--
ALTER TABLE `car_maintenance_issues`
  ADD PRIMARY KEY (`recordID`),
  ADD KEY `car_maintenance_cars_CarID_FK` (`CarID`);

--
-- Indexes for table `ownership`
--
ALTER TABLE `ownership`
  ADD PRIMARY KEY (`ownerShipID`),
  ADD KEY `ownership_cars_CarID_FK` (`CarID`),
  ADD KEY `ownership_user_UserID_FK` (`UserID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `CarID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `car_maintenance_issues`
--
ALTER TABLE `car_maintenance_issues`
  MODIFY `recordID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `ownership`
--
ALTER TABLE `ownership`
  MODIFY `ownerShipID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `car_maintenance_issues`
--
ALTER TABLE `car_maintenance_issues`
  ADD CONSTRAINT `car_maintenance_cars_CarID_FK` FOREIGN KEY (`CarID`) REFERENCES `cars` (`CarID`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `ownership`
--
ALTER TABLE `ownership`
  ADD CONSTRAINT `ownership_cars_CarID_FK` FOREIGN KEY (`CarID`) REFERENCES `cars` (`CarID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ownership_user_UserID_FK` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
