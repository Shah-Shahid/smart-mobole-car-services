-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2019 at 09:40 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smcs`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(8) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'shahid.sheikhpora@gmail.com', 'ssssss');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(8) NOT NULL,
  `cid` int(8) NOT NULL,
  `did` int(8) NOT NULL,
  `vehicleType` varchar(20) NOT NULL,
  `vehiclenumber` varchar(12) NOT NULL,
  `package` int(8) NOT NULL,
  `amount` int(8) NOT NULL,
  `date` datetime NOT NULL,
  `worker` int(8) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'Pending',
  `payment` varchar(25) NOT NULL DEFAULT 'Not Paid',
  `response` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `cid`, `did`, `vehicleType`, `vehiclenumber`, `package`, `amount`, `date`, `worker`, `status`, `payment`, `response`) VALUES
(1, 6, 96, '3', 'JKO1D-4657', 2, 300, '2019-04-04 00:00:00', 0, 'Pending', 'Not Paid', ''),
(2, 9, 97, '4', 'DL33-6754', 4, 2, '2019-04-11 00:00:00', 1, 'Not Available', 'Paid Online', ''),
(3, 5, 95, '6', 'JK05-6111', 1, 300, '2019-05-08 16:10:00', 1, 'Pending', 'Paid Online', ''),
(4, 57, 103, '3', 'JK02E-6011', 3, 450, '2019-05-10 11:55:00', 1, 'Not Available', 'Offline/Paid to Worker', ''),
(5, 11, 97, '9', 'JK2E-7865', 5, 300, '2019-05-08 16:22:00', 11, 'Pending', 'Not Paid', ''),
(6, 9, 86, '8', 'JK012-3927', 5, 300, '2019-05-11 11:10:00', 15, 'Pending', 'Not Paid', ''),
(7, 5, 98, '5', 'JK111-7865', 2, 400, '2019-05-08 17:27:00', 0, 'Pending', 'Not Paid', ''),
(8, 5, 100, '5', 'JK955-7643', 2, 400, '2019-05-18 23:35:00', 0, 'Pending', 'Not Paid', ''),
(9, 5, 101, '5', 'MP76-7865', 2, 400, '2019-05-26 09:25:00', 0, 'Pending', 'Not Paid', ''),
(10, 4, 103, '6', 'JK02E-5947', 5, 300, '2019-05-09 10:30:00', 0, 'Pending', 'Not Paid', ''),
(11, 11, 100, '8', 'JK02D-5643', 5, 300, '1970-01-01 01:00:00', 0, 'Pending', 'Not Paid', ''),
(12, 11, 101, '9', 'MP90H-5643', 3, 450, '2019-05-10 04:25:00', 0, 'Pending', 'Not Paid', ''),
(13, 60, 100, '3', 'JK01s6467', 1, 300, '2019-05-10 12:01:00', 0, 'Pending', 'Not Paid', ''),
(15, 4, 101, '9', '', 6, 900, '2019-05-12 23:30:00', 0, 'Pending', 'Not Paid', ''),
(16, 4, 99, '9', 'HP676-564', 4, 500, '2019-05-09 03:10:00', 0, 'Pending', 'Not Paid', ''),
(17, 4, 96, '9', 'JK67-6743', 5, 300, '2019-05-08 01:05:00', 0, 'Pending', 'Not Paid', ''),
(18, 4, 105, '8', 'Jk987-5643', 2, 400, '2019-05-08 08:35:00', 0, 'Pending', 'Not Paid', ''),
(19, 57, 107, '5', 'JK067-6435', 5, 300, '2019-05-09 09:10:00', 0, 'Pending', 'Not Paid', ''),
(20, 4, 104, '9', 'KP86-6743', 7, 300, '2019-05-10 10:00:00', 0, 'Pending', 'Not Paid', ''),
(21, 57, 96, '1', 'JK099-1111', 8, 500, '2019-05-17 09:50:00', 15, 'Done', 'Offline/Paid to Worker', ''),
(22, 5, 95, '15', '', 8, 500, '2019-05-15 09:30:00', 15, 'Pending', 'Not Paid', ''),
(23, 57, 86, '15', '', 6, 900, '2019-05-08 02:05:00', 15, 'Pending', 'Not Paid', ''),
(24, 57, 86, '15', 'JK045-2222', 6, 900, '1970-01-01 01:00:00', 1, 'Not Available', 'Not Paid', ''),
(26, 57, 86, '15', '', 6, 900, '2019-05-15 14:16:00', 0, 'Pending', 'Not Paid', ''),
(30, 5, 86, '7', 'jk111111', 4, 500, '2019-05-16 11:03:00', 1, 'Not Available', 'Paid Online', ''),
(35, 5, 103, '7', '', 4, 500, '2019-05-16 11:33:00', 0, 'Pending', 'Not Paid', ''),
(36, 5, 86, '7', 'jk-9876', 4, 500, '2019-05-16 11:42:00', 15, 'Pending', 'Paid Online', ''),
(38, 5, 104, '7', 'Jk099-2019', 4, 500, '2019-05-16 12:16:00', 0, 'Pending', 'Not Paid', ''),
(39, 4, 109, '8', 'JK-2018E', 2, 400, '2019-05-16 12:41:00', 0, 'Pending', 'Not Paid', ''),
(40, 4, 86, '15', 'hhh', 5, 300, '2019-05-16 13:39:00', 13, 'Pending', 'Not Paid', ''),
(41, 57, 86, '4', 'JK00-9999', 1, 300, '2019-05-16 16:38:00', 15, 'Pending', 'Not Paid', ''),
(42, 57, 104, '7', 'JK90D-8037', 3, 450, '2019-05-16 20:29:00', 0, 'Pending', 'Not Paid', ''),
(43, 4, 109, '8', 'JKEE2-2018', 6, 900, '2019-05-16 20:40:00', 1, 'Pending', 'Not Paid', ''),
(44, 11, 109, '4', 'DL001-4563', 8, 500, '2019-05-16 20:47:00', 0, 'Pending', 'Not Paid', ''),
(45, 11, 0, '4', '', 8, 500, '1970-01-01 01:00:00', 0, 'Pending', 'Not Paid', ''),
(46, 11, 109, '3', 'MP003P-3547', 2, 400, '2019-05-16 21:03:00', 0, 'Pending', 'Not Paid', ''),
(47, 11, 104, '7', 'jk34-5642', 5, 300, '2019-05-16 21:22:00', 0, 'Pending', 'Not Paid', ''),
(48, 4, 109, '6', 'JK09-0000', 4, 500, '2019-05-16 21:57:00', 15, 'Pending', 'Not Paid', ''),
(49, 11, 86, '6', 'hhhh-tt6711', 5, 300, '2019-05-16 23:00:00', 0, 'Pending', 'Not Paid', ''),
(50, 5, 109, '6', 'kkkk000', 7, 300, '2019-05-17 17:23:00', 15, 'Pending', 'Not Paid', ''),
(51, 59, 86, '7', 'HP9090-543', 5, 300, '2019-05-17 17:40:00', 0, 'Pending', 'Not Paid', ''),
(52, 65, 86, '6', 'Jk05-3333', 8, 500, '2019-05-19 13:14:00', 1, 'Done', 'Paid Online', ''),
(53, 57, 103, '6', 'hghg', 6, 900, '2019-05-19 20:23:00', 0, 'Pending', 'Not Paid', ''),
(54, 66, 109, '7', 'KR32-5950', 5, 300, '2019-05-20 10:16:00', 1, 'Done', 'Offline/Paid to Worker', ''),
(55, 66, 109, '7', 'MR564-5634', 4, 500, '2019-05-20 10:30:00', 0, 'Pending', 'Paid Online', ''),
(56, 66, 109, '8', 'KR-67', 5, 300, '2019-05-20 11:53:00', 1, 'Done', 'Offline/Paid to Worker', ''),
(57, 66, 98, '4', 'QT78-6574', 4, 500, '2019-05-20 12:10:00', 0, 'Pending', 'Not Paid', ''),
(58, 65, 98, '7', 'SMCS-3547', 1, 300, '2019-05-20 12:14:00', 0, 'Pending', 'Not Paid', ''),
(59, 65, 98, '5', 'MP56T-9797', 4, 500, '2019-05-20 12:25:00', 0, 'Pending', 'Not Paid', ''),
(60, 4, 86, '1', '', 8, 500, '2019-05-20 13:36:00', 0, 'Pending', 'Paid Online', ''),
(61, 4, 0, '6', '', 8, 500, '1970-01-01 01:00:00', 0, 'Pending', 'Not Paid', ''),
(62, 4, 0, '6', '', 8, 500, '1970-01-01 01:00:00', 0, 'Pending', 'Not Paid', ''),
(63, 4, 0, '6', '', 8, 500, '1970-01-01 01:00:00', 0, 'Pending', 'Not Paid', ''),
(64, 4, 103, '7', 'kkkkkkkk', 6, 900, '1970-01-01 01:00:00', 0, 'Pending', 'Paid Online', ''),
(65, 66, 86, '5', 'Jkfb-7854', 5, 300, '2019-05-20 22:15:00', 0, 'Pending', 'Paid Online', '{\"ORDERID\":\"65\",\"MID\":\"PWTjnA76910680061917\",\"TXNID\":\"20190520111212800110168253000515216\",\"TXNAMOUNT\":\"300.00\",\"PAYMENTMODE\":\"DC\",\"CURRENCY\":\"INR\",\"TXNDATE\":\"2019-05-20 22:16:41.0\",\"STATUS\":\"TXN_SUCCESS\",\"RESPCODE\":\"01\",\"RESPMSG\":\"Txn Success\",\"GATEWAYNAME\":\"HDFC\",\"BANKTXNID\":\"4036217121962950\",\"BANKNAME\":\"Jammu & Kashmir Bank Ltd\",\"CHECKSUMHASH\":\"RWTiLZw04gUxf5YKn7BMTzJ5Ep+VYGCedLLN7xMTRAFimt8gPUFovfcWtv0/PR1Y4sbHUbZ8au+9ZeAD00GirTAblYiOUB7XO5faQJs4yIk=\"}'),
(66, 66, 103, '6', '', 7, 300, '2019-05-21 21:37:00', 0, 'Pending', 'Not Paid', ''),
(67, 66, 0, '6', '', 6, 900, '1970-01-01 01:00:00', 0, 'Pending', 'Not Paid', ''),
(68, 57, 103, '15', 'jaka014323', 3, 450, '2019-05-16 09:30:00', 0, 'Pending', 'Not Paid', ''),
(69, 5, 109, '5', '', 5, 300, '2019-06-07 19:10:00', 0, 'Pending', 'Paid Online', '{\"ORDERID\":\"69\",\"MID\":\"PWTjnA76910680061917\",\"TXNID\":\"20190602111212800110168294300545460\",\"TXNAMOUNT\":\"300.00\",\"PAYMENTMODE\":\"NB\",\"CURRENCY\":\"INR\",\"TXNDATE\":\"2019-06-02 18:15:45.0\",\"STATUS\":\"TXN_SUCCESS\",\"RESPCODE\":\"01\",\"RESPMSG\":\"Txn Success\",\"GATEWAYNAME\":\"ANDB\",\"BANKTXNID\":\"19715962873\",\"BANKNAME\":\"ANDB\",\"CHECKSUMHASH\":\"7tsPunh7M3dpRoSOtLeyYL2QcI8FU6SDzkP+xiXadJ5EeWNNHyli14DOYN2QJJxwsXZZBChbcnL7kRvGDGxqkQU3yklybYO+aV5Yq2nf++M=\"}');

-- --------------------------------------------------------

--
-- Table structure for table `customerlogin`
--

CREATE TABLE `customerlogin` (
  `id` int(8) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `email` varchar(40) NOT NULL,
  `address` varchar(60) NOT NULL,
  `password` varchar(40) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customerlogin`
--

INSERT INTO `customerlogin` (`id`, `firstname`, `lastname`, `phone`, `email`, `address`, `password`, `status`) VALUES
(4, 'Saima ', 'Rasool Shah', '9909906668', 'saima@gmail.com', 'Baramulla college', 'b59c67bf196a4758191e42f76670ceba', 1),
(5, 'Asifa', 'Rasool Shah', '7006654570', 'asifa@gmail.com', 'Sherkhpora Kreeri', 'b59c67bf196a4758191e42f76670ceba', 1),
(6, 'Mir', 'Mannat', '9898989898', 'mirmanat@gmail.com', 'Nishat Srinagar', 'b59c67bf196a4758191e42f76670ceba', 0),
(9, 'Muzafar', 'Customer', '9906474530', 'muzfar@gmail.com', 'Pulwama', 'b59c67bf196a4758191e42f76670ceba', 1),
(11, 'Zahid', 'Shopian', '7051412125', 'zahid@gmail.com', 'Imam Sahib', 'b59c67bf196a4758191e42f76670ceba', 1),
(57, 'Shahid', 'Shah', '9797724745', 'shahid.sheikhpora@gmail.com', 'Rangreth Srinagar', 'b59c67bf196a4758191e42f76670ceba', 1),
(59, 'Saquib', 'Mustafa', '7654327865', 'mustafa@gmail.com', 'Mustafa Lane', 'b59c67bf196a4758191e42f76670ceba', 0),
(65, 'Muzzi', 'Mca', '9906474530', 'muzafarahmad649@gmail.com', 'Gogo Rangreth', 'b0baee9d279d34fa1dfd71aadb908c3f', 1),
(66, 'Logic', 'Paradise', '9797724745', 'logicparadise.shahid@gmail.com', 'HMT Srinagar', 'b59c67bf196a4758191e42f76670ceba', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dealer_ratings`
--

CREATE TABLE `dealer_ratings` (
  `id` int(5) NOT NULL,
  `did` int(5) NOT NULL,
  `name` varchar(20) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rating` int(2) NOT NULL DEFAULT '0',
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dealer_ratings`
--

INSERT INTO `dealer_ratings` (`id`, `did`, `name`, `date`, `rating`, `comments`) VALUES
(1, 86, '0', '2019-05-21 14:51:04', 4, 'Great Dealer, Best Services Ever In my life'),
(2, 86, '0', '2019-05-21 14:53:01', 5, 'Good I love it'),
(3, 86, '0', '2019-05-21 14:53:11', 2, 'Great'),
(4, 86, '0', '2019-05-21 14:53:20', 3, 'Nice!!!'),
(5, 86, '0', '2019-05-21 14:53:34', 1, 'Fine '),
(6, 86, '0', '2019-05-21 14:53:46', 2, 'Average'),
(7, 86, '0', '2019-05-21 14:53:53', 1, 'Normal'),
(8, 86, '0', '2019-05-21 19:21:10', 5, 'Not Bad'),
(9, 95, '0', '2019-05-22 11:24:25', 5, 'Awsome'),
(10, 95, '0', '2019-05-22 11:34:51', 5, 'Gigantic'),
(11, 97, '0', '2019-05-22 15:00:32', 3, 'Marvellous'),
(12, 95, '0', '2019-05-22 15:01:25', 1, 'not bad'),
(13, 95, '0', '2019-05-22 15:02:19', 1, 'wow'),
(14, 95, '0', '2019-05-22 15:03:08', 1, 'nice'),
(15, 95, '0', '2019-05-22 15:03:49', 1, ''),
(16, 97, '0', '2019-05-22 15:04:44', 2, 'chalega'),
(17, 97, '0', '2019-05-22 15:06:06', 3, 'good'),
(18, 98, '0', '2019-05-22 15:08:29', 5, 'Dangling'),
(19, 109, '0', '2019-05-22 15:24:55', 5, 'Excellent service,, I must say No 1 company'),
(20, 97, 'Sajid Rizvi', '2019-05-24 11:18:20', 3, 'Satisfactory, Geniuene');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(8) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  `phone` varchar(13) NOT NULL,
  `email` varchar(40) NOT NULL,
  `address` varchar(60) NOT NULL DEFAULT 'Not Provided',
  `workshop` varchar(50) DEFAULT 'Not Available',
  `district` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `status` int(2) DEFAULT '0',
  `lat` double NOT NULL,
  `lon` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `firstname`, `lastname`, `phone`, `email`, `address`, `workshop`, `district`, `password`, `status`, `lat`, `lon`) VALUES
(86, 'Shahid', 'Dealer', '9797724745', 'shahid.sheikhpora@gmail.com', 'Kreeri', 'MCA Pamposh', 'baramulla', '934b535800b1cba8f96a5d72f72f1611', 1, 33.778175, 76.57617139999999),
(95, 'Baba', 'Rayees', '9797724724', 'baba@gmail.com', 'Baba reshi', 'Reshi Wash Point', 'baramulla', '934b535800b1cba8f96a5d72f72f1611', 1, 34.1111271, 74.72991730000001),
(96, 'Asifa', 'Rasool Shah', '9906474530', 'asifa@gmail.com', 'Dholipora Kreeri', 'Jahangir Wash', 'srinagar', '934b535800b1cba8f96a5d72f72f1611', 1, 33.778175, 76.57617139999999),
(97, 'Zahid', 'Dealer', '7051412125', 'zahid@gmail.com', 'Sanatnagar', 'MCA Car Wash', 'srinagar', '934b535800b1cba8f96a5d72f72f1611', 1, 33.778175, 76.57617139999999),
(98, 'Muzafar', 'Dealer', '9906474530', 'logicparadise.shahid@gmail.com', 'Nishat Srinagar', 'Tech Works', 'srinagar', '934b535800b1cba8f96a5d72f72f1611', 1, 33.778175, 76.57617139999999),
(103, 'Tabasum', 'Rafi', '', 'tabu@gmail.com', 'Sheikhpora', 'Deen And Co.', 'baramulla', 'bcc720f2981d1a68dbd66ffd67560c37', 1, 22.778175, 40.57617139999999),
(109, 'Sabit', 'Ramzan', '9797724645', 'shahid.shahid.rasool200@gmail.com', 'Khanyar', 'Down Town Tech. works', 'srinagar', '934b535800b1cba8f96a5d72f72f1611', 1, 34.1111816, 74.7297995),
(112, 'hhhh', 'kjkhkjhk', '7676767676', 'ggg@yyy.lll', 'hfh', 'hhhh', 'anantnag', 'fa7f08233358e9b466effa1328168527', 1, 0, 0),
(113, 'dummy', 'dealer', '9999999999', 'dummy@gmail.com', 'dummy', 'dymmy wash', 'srinagar', '934b535800b1cba8f96a5d72f72f1611', 0, 0, 0),
(114, 'dummy 2', 'Dealer', '8888888888', 'dymmy2@gmail.com', 'dddd', 'D2 Wash', 'srinagar', '934b535800b1cba8f96a5d72f72f1611', 0, 33.778175, 76.57617139999999),
(115, 'Dummr 3', 'Dealer', '7777777777', 'dummy3@gmail.com', 'dddd', 'D3 Wash', 'pulwama', '934b535800b1cba8f96a5d72f72f1611', 0, 33.778175, 76.57617139999999);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(8) NOT NULL,
  `name` varchar(20) NOT NULL,
  `carid` int(8) NOT NULL,
  `amount` int(8) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `carid`, `amount`, `description`) VALUES
(1, 'Basic Hand Wash', 1, 300, 'Exterior Hand Wash, Towel Hand Dry, Wheel Shine'),
(2, 'Delux Wash', 1, 400, 'Exterior Hand Wash, Towel Hand Dry, Wheel Shine, Tire Dressing, Windows In & Out, Sealer Hand Wax '),
(3, 'Platinum Works', 1, 450, 'Exterior Hand Wash <br>Towel Hand Dry,  Wheel Shine, Tire Dressing, Windows In & Out, Sealer Hand Wax, Interior Vacuum, Door Shuts & Plastics, Dashboard Clean, Air Freshener, Sealer Hand Wax, Triple C'),
(4, 'Ultimate Shine', 1, 500, 'Exterior Hand Wash <br>Towel Hand Dry,  Wheel Shine, Tire Dressing, Windows In & Out, Sealer Hand Wax, Interior Vacuum, Door Shuts & Plastics, Dashboard Clean, Air Freshener, Sealer Hand Wax, Triple C'),
(5, 'Foam Wash', 3, 300, 'All body foam wash, drying with shining material, tyre wash.'),
(6, 'ggg', 3, 900, 'thgfgdfdgh'),
(7, '', 5, 300, 'This is a wash package without description'),
(8, 'Nalla Wash', 5, 500, 'stone servicing');

-- --------------------------------------------------------

--
-- Table structure for table `vehicletype`
--

CREATE TABLE `vehicletype` (
  `id` int(8) NOT NULL,
  `category` varchar(30) NOT NULL,
  `image` varchar(50) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicletype`
--

INSERT INTO `vehicletype` (`id`, `category`, `image`, `name`) VALUES
(1, 'bike', 'images/bike.png', 'Bike'),
(3, 'car', 'images/regularcar.jpg', 'Regular Size Car'),
(4, 'mini_van', 'images/mini-van.png', 'Mini Van'),
(5, 'pickup_truck', 'images/pickup-truck.png', 'Pickup Truck'),
(6, 'car_medium', 'images/car-medium.png', 'Medium Size Car'),
(7, 'compact_suv', 'images/compact-suv.jpg', 'Compact SUV '),
(8, 'cargo_truck', 'images/cargo-truck.png', 'Cargo Truck'),
(15, 'ccl', 'Images/ccl.jpg', 'cycle');

-- --------------------------------------------------------

--
-- Table structure for table `workers`
--

CREATE TABLE `workers` (
  `id` int(4) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `email` varchar(40) NOT NULL DEFAULT 'someone@example.com',
  `joindate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `did` int(5) NOT NULL,
  `password` varchar(20) NOT NULL,
  `status` int(5) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workers`
--

INSERT INTO `workers` (`id`, `firstname`, `lastname`, `phone`, `email`, `joindate`, `did`, `password`, `status`) VALUES
(1, 'Ghulam Mohiudin', 'Khan', '0', 'logicparadise.shahid@gmail.com', '2019-05-09 10:03:35', 96, '3333', 0),
(2, 'Mohd Makbool', 'Khan', '0', 'someone@example.com', '2019-05-09 10:03:35', 97, '3333', 0),
(3, 'Riyaz Ahmad', 'Tantray', '0', 'someone@example.com', '2019-05-09 10:16:28', 97, '3333', 1),
(4, 'Majid', 'Parray', '0', 'someone@example.com', '2019-05-09 10:16:28', 100, '3333', 1),
(5, 'Bilal', 'Khan', '0', 'someone@example.com', '2019-05-09 10:18:17', 100, '3333', 0),
(6, 'Mohd Waseem', 'Akram', '0', 'someone@example.com', '2019-05-09 10:18:17', 96, '3333', 0),
(9, 'Asif Ramzan', 'Mir', '0', 'someone@example.com', '2019-05-09 11:31:40', 97, '3333', 0),
(10, 'Majeed', 'Rizvi', '0', 'someone@example.com', '2019-05-09 11:39:24', 97, '3333', 0),
(11, 'Zubair Ahmad', 'Shah', '0', 'someone@example.com', '2019-05-09 11:41:53', 95, '3333', 0),
(12, 'Sajad', 'Khan', '0', 'someone@example.com', '2019-05-10 04:12:27', 97, '3333', 0),
(13, 'Fazil Geelani', 'War', '0', 'someone@example.com', '2019-05-11 04:50:54', 86, '3333', 0),
(14, 'Samad', 'najar', '2147483647', 'samad@gmail.com', '2019-05-14 16:38:32', 95, '3333', 0),
(15, 'Muzzafar Ahmad', 'UNOSIS', '9906474530', 'shahid.shahid.rasool200@gmail.com', '2019-05-15 11:46:59', 96, '3333', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customerlogin`
--
ALTER TABLE `customerlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealer_ratings`
--
ALTER TABLE `dealer_ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicletype`
--
ALTER TABLE `vehicletype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `customerlogin`
--
ALTER TABLE `customerlogin`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `dealer_ratings`
--
ALTER TABLE `dealer_ratings`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vehicletype`
--
ALTER TABLE `vehicletype`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `workers`
--
ALTER TABLE `workers`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
