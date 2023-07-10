-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2023 at 08:47 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbms`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `passengerDetails` (IN `id` INT)  BEGIN SELECT * FROM passenger WHERE P_id = id; END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `B_id` int(11) NOT NULL,
  `Seat_No` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Train_id` int(11) DEFAULT NULL,
  `P_id` int(11) DEFAULT NULL,
  `bookedTime` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`B_id`, `Seat_No`, `Date`, `Train_id`, `P_id`, `bookedTime`) VALUES
(2812, 34, '2019-04-01', 23901, 5039, '2023-01-30 07:28:01'),
(3479, 65, '2021-07-29', 23901, 7360, '2023-01-30 07:28:01'),
(6231, 47, '2021-11-29', 74238, 1803, '2023-01-30 07:28:01'),
(7820, 15, '2020-03-09', 82902, 5039, '2023-01-30 07:28:01'),
(7835, 7, '2021-01-25', 42315, 9101, '2023-01-30 07:28:01'),
(7959, 21, '2023-01-30', 100, 9107, '2023-01-30 07:28:01'),
(7960, 17, '2023-01-30', 100, 9107, '2023-01-30 07:35:57');

--
-- Triggers `booking`
--
DELIMITER $$
CREATE TRIGGER `bookedTime` BEFORE INSERT ON `booking` FOR EACH ROW BEGIN set new.bookedTime = NOW(); END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `P_id` int(11) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`P_id`, `username`, `password`) VALUES
(1, 'admin', 'admin'),
(3, 'aniketh_br', 'anikethbr'),
(1803, 'Joe', 'joe123'),
(2702, 'Ria', 'ria2'),
(5039, 'Susan', 'susan123'),
(7360, 'Albert', 'ALBERT'),
(9101, 'Peter', 'peter123'),
(9102, 'amit', 'Kart@2019'),
(9103, 'kashyap', 'Kmk@02118'),
(9104, 'shreejesh', 'Shree@123'),
(9105, 'vishal1', 'Kart@2019'),
(9106, 'test', 'Test@2345'),
(9107, 'karthik', 'Karthik@2019');

-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

CREATE TABLE `passenger` (
  `P_id` int(11) NOT NULL,
  `Id_Proof` varchar(12) DEFAULT NULL,
  `Name` varchar(30) NOT NULL,
  `Gender` char(1) NOT NULL,
  `Age` int(11) NOT NULL,
  `Phone` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `passenger`
--

INSERT INTO `passenger` (`P_id`, `Id_Proof`, `Name`, `Gender`, `Age`, `Phone`) VALUES
(3, '192-168-1-2', 'Aniketh BR', 'M', 21, 0),
(1803, '73588102963', 'Joe', 'M', 19, 0),
(5039, '994195347235', 'Susan', 'F', 39, 0),
(7360, '566672721332', 'Albert', 'M', 34, 0),
(9101, '635791618970', 'Peter', 'M', 61, 0),
(9102, '192-168-1-1', 'Amit', 'M', 21, 1212121212),
(9103, '192-168-1-1', 'Karthik M kashyap', 'M', 20, 9876545678),
(9104, '192-168-1-1', 'Shreejesh', 'M', 19, 9445372834),
(9105, '192-168-1-1', 'Vishal1', 'M', 19, 1212121212),
(9106, '12313142', 'test', 'M', 45, 1234567890),
(9107, '192-168-1-2', 'karthik', 'M', 54, 1234567890);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `Staff_id` int(11) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Designation` varchar(40) NOT NULL,
  `Phone_No` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`Staff_id`, `Name`, `Designation`, `Phone_No`) VALUES
(123, 'Jhon', 'TT', '7816182010'),
(156, 'Rahul Sharma', 'Travelling Ticket Inspector', '6752359835'),
(187, 'Jayadev Mitali', 'Sr.Loco Pilot', '8976710736'),
(289, 'Rijul Aggarwal', 'Passenger Guard', '9921484813'),
(312, 'Vikram singh', 'Loco Pilot', '7816182010');

-- --------------------------------------------------------

--
-- Table structure for table `train`
--

CREATE TABLE `train` (
  `Train_id` int(11) NOT NULL,
  `Train_name` varchar(50) NOT NULL,
  `Source` varchar(50) NOT NULL,
  `Destination` varchar(50) NOT NULL,
  `No_of_seats` int(11) NOT NULL,
  `Seat_booked` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `train`
--

INSERT INTO `train` (`Train_id`, `Train_name`, `Source`, `Destination`, `No_of_seats`, `Seat_booked`) VALUES
(100, 'Amaravathi', 'KSD', 'MNGLR', 1234, 0),
(1234, 'Konkan Express', 'Manglore', 'Mumbai', 1000, 0),
(23901, 'Amaravati Express', 'Howrah Jn', 'Vasco', 1320, 650),
(42315, 'Parasuram Express', 'Nagercoil Jn', 'Mangalore Central', 645, 192),
(62417, 'Karnataka Express', 'Bangalore', 'New Delhi', 1445, 509),
(74238, 'Ananthapuri Express', 'Kollam Junction', 'Chennai Egmore', 1112, 891),
(82902, 'Deccan Express', 'Mumbai', 'Pune', 990, 723);

-- --------------------------------------------------------

--
-- Table structure for table `train_staff`
--

CREATE TABLE `train_staff` (
  `Train_id` int(11) NOT NULL,
  `Staff_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `train_staff`
--

INSERT INTO `train_staff` (`Train_id`, `Staff_id`) VALUES
(100, 187),
(23901, 156),
(23901, 187),
(23901, 312),
(42315, 187),
(62417, 289);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`B_id`),
  ADD KEY `Train_id` (`Train_id`),
  ADD KEY `P_id` (`P_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`P_id`);

--
-- Indexes for table `passenger`
--
ALTER TABLE `passenger`
  ADD PRIMARY KEY (`P_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`Staff_id`);

--
-- Indexes for table `train`
--
ALTER TABLE `train`
  ADD PRIMARY KEY (`Train_id`);

--
-- Indexes for table `train_staff`
--
ALTER TABLE `train_staff`
  ADD PRIMARY KEY (`Train_id`,`Staff_id`),
  ADD KEY `Staff_id` (`Staff_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `B_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7961;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `P_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9108;

--
-- AUTO_INCREMENT for table `train`
--
ALTER TABLE `train`
  MODIFY `Train_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82908;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`Train_id`) REFERENCES `train` (`Train_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`P_id`) REFERENCES `passenger` (`P_id`) ON DELETE CASCADE;

--
-- Constraints for table `passenger`
--
ALTER TABLE `passenger`
  ADD CONSTRAINT `passenger_ibfk_1` FOREIGN KEY (`P_id`) REFERENCES `login` (`p_id`) ON DELETE CASCADE;

--
-- Constraints for table `train_staff`
--
ALTER TABLE `train_staff`
  ADD CONSTRAINT `train_staff_ibfk_1` FOREIGN KEY (`Train_id`) REFERENCES `train` (`Train_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `train_staff_ibfk_2` FOREIGN KEY (`Staff_id`) REFERENCES `staff` (`Staff_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
