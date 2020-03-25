-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2020 at 08:55 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_detail`
--

CREATE TABLE `admin_detail` (
  `admin_name` varchar(20) NOT NULL,
  `admin_pass` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_detail`
--

INSERT INTO `admin_detail` (`admin_name`, `admin_pass`) VALUES
('gurkirtan', 'gurkirtan'),
('ram', 'ram123');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cust_id` varchar(20) NOT NULL,
  `cart_items` varchar(500) DEFAULT NULL,
  `cart_total` bigint(20) DEFAULT NULL,
  `cart_value` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category_detail`
--

CREATE TABLE `category_detail` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(20) DEFAULT NULL,
  `cat_items` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_detail`
--

INSERT INTO `category_detail` (`cat_id`, `cat_name`, `cat_items`) VALUES
(1, 'breakfast', 4),
(3, 'lunch', 2),
(14, 'fast food', 1),
(15, 'pizza', 5),
(16, 'punjabi', 2);

-- --------------------------------------------------------

--
-- Table structure for table `current_order`
--

CREATE TABLE `current_order` (
  `order_id` varchar(22) NOT NULL,
  `cust_order` varchar(500) NOT NULL,
  `status` varchar(20) NOT NULL,
  `tran_moode` varchar(20) NOT NULL,
  `cust_ph` varchar(12) NOT NULL,
  `totalamount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `current_order`
--

INSERT INTO `current_order` (`order_id`, `cust_order`, `status`, `tran_moode`, `cust_ph`, `totalamount`) VALUES
('97809451231583386609', '{\"rava dosa\":\"1\"}', 'order placed', 'online', '9780945123', 63),
('97809451231583470263', '{\"idli\":\"1\"}', 'order placed', 'online', '9780945123', 1.8),
('98771530941582972091', '{\"idli\":\"1\",\"paneer prantha\":\"1\",\"upma\":\"1\"}', 'conformed', 'online', '9877153094', 84.4),
('98771530941582972783', '{\"upma\":\"1\",\"rava dosa\":\"1\"}', 'conformed', 'online', '9877153094', 126),
('98771530941582973271', '{\"paneer prantha\":\"1\",\"upma\":\"1\"}', 'On The Way', 'cod', '9877153094', 82.6),
('98771530941582973384', '{\"paneer prantha\":\"1\"}', 'On The Way', 'cod', '9877153094', 19.6);

-- --------------------------------------------------------

--
-- Table structure for table `cust_detail`
--

CREATE TABLE `cust_detail` (
  `cust_ph` varchar(10) NOT NULL,
  `cust__name` varchar(25) NOT NULL,
  `cust_pass` varchar(18) NOT NULL,
  `cust_addr` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cust_detail`
--

INSERT INTO `cust_detail` (`cust_ph`, `cust__name`, `cust_pass`, `cust_addr`) VALUES
('2147483647', 'gurkirtan', 'password', 'babri'),
('8544988212', 'karan', 'karandd', 'shalla'),
('9780945123', 'ram kumar', 'ram123', 'gurdaspur'),
('9780966853', 'naina', 'naina123', 'gurdaspur'),
('9877153094', 'gurkirtan', 'password', 'babri');

-- --------------------------------------------------------

--
-- Table structure for table `item_detail`
--

CREATE TABLE `item_detail` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(25) NOT NULL,
  `item_price` int(11) NOT NULL,
  `item_discount` int(11) NOT NULL,
  `item_ing` varchar(40) NOT NULL,
  `item_type` varchar(15) NOT NULL,
  `item_cat` varchar(15) NOT NULL,
  `item_img` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_detail`
--

INSERT INTO `item_detail` (`item_id`, `item_name`, `item_price`, `item_discount`, `item_ing`, `item_type`, `item_cat`, `item_img`) VALUES
(1, 'pizza', 200, 10, 'olives meat', 'non-veg', 'pizza', '../item_image/pizza.jpg'),
(2, 'cheeze pizza', 250, 10, 'mozzarella parmesan', 'veg', 'pizza', '../item_image/cheeze.jpg'),
(5, 'hawaiin pizza', 387, 20, 'pinapple ham', 'non-veg', 'pizza', '../item_image/hawaiin pizza.jpg'),
(11, 'pure veg pizza', 200, 5, 'cheeze olives', 'veg', 'pizza', '../item_image/veg.jpg'),
(13, 'mushroom pizza', 387, 10, 'mushroom cheese', 'veg', 'pizza', '../item_image/68mushroom_pizza.jpg'),
(15, 'idli', 2, 10, 'rice urad daal', 'veg', 'breakfast', '../item_image/3481idli.jpg'),
(16, 'puri chole', 70, 2, 'flour chickpea', 'veg', 'punjabi', '../item_image/6.jpg'),
(18, 'paneer tikka', 50, 5, 'paneer baked in tandoor', 'veg', 'punjabi', '../item_image/9.jpg'),
(20, 'butter chicken', 100, 5, 'chicken ', 'non-veg', 'lunch', '../item_image/10-00-25-butter-chicken-recipe-murgh-makhani-500x375.jpg'),
(23, 'paneer prantha', 20, 2, 'paneer', 'veg', 'breakfast', '../item_image/4741paneer-paratha.jpg'),
(24, 'mutton korma', 150, 2, 'chicken ', 'non-veg', 'lunch', '../item_image/79310-00-01-mutton-korma-500x375.jpg'),
(25, 'chicken fires', 90, 5, 'sovoury spices', 'veg', 'fast food', '../item_image/Burger-King-Chicken-Fries.png'),
(27, 'upma', 70, 10, 'rice urad daal', 'veg', 'breakfast', '../item_image/6003upma-recipe-breakfast-recipes1.jpg'),
(28, 'rava dosa', 70, 10, 'rice urad daal', 'veg', 'breakfast', '../item_image/264rava-dosa-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `old_order`
--

CREATE TABLE `old_order` (
  `order_id` varchar(22) NOT NULL,
  `cust_ph` varchar(12) NOT NULL,
  `status` varchar(30) NOT NULL,
  `mode` varchar(12) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cust_order` varchar(500) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `old_order`
--

INSERT INTO `old_order` (`order_id`, `cust_ph`, `status`, `mode`, `time`, `cust_order`, `total`) VALUES
('98771530941582973528', '9877153094', 'cancel', 'cod', '2020-03-04 16:04:36', '{\"idli\":\"1\",\"paneer prantha\":\"1\"}', 0),
('98771530941582973482', '9877153094', 'Delivered', 'cod', '2020-03-04 16:11:40', '{\"paneer prantha\":\"1\",\"upma\":\"1\",\"rava dosa\":\"1\"}', 0),
('98771530941582972688', '9877153094', 'cancel', 'online', '2020-03-04 16:21:44', '{\"paneer prantha\":\"1\",\"upma\":\"1\"}', 83),
('98771530941582973346', '9877153094', 'Delivered', 'cod', '2020-03-04 16:22:08', '{\"paneer prantha\":\"1\",\"rava dosa\":\"1\"}', 83),
('97809451231583386434', '9780945123', 'Delivered', 'cod', '2020-03-05 05:35:00', '{\"pure veg pizza\":\"1\",\"paneer prantha\":\"1\",\"upma\":\"1\",\"rava dosa\":\"1\"}', 336);

-- --------------------------------------------------------

--
-- Table structure for table `tran_detail`
--

CREATE TABLE `tran_detail` (
  `cust_ph` varchar(13) NOT NULL,
  `tran_amt` varchar(10000) NOT NULL,
  `tran_id` varchar(50) NOT NULL,
  `order_id` varchar(22) NOT NULL,
  `tran_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tran_detail`
--

INSERT INTO `tran_detail` (`cust_ph`, `tran_amt`, `tran_id`, `order_id`, `tran_date`) VALUES
('9877153094', '145.60', '20200225111212800110168118501301418', '98771530941582624518', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_detail`
--
ALTER TABLE `admin_detail`
  ADD PRIMARY KEY (`admin_name`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `category_detail`
--
ALTER TABLE `category_detail`
  ADD PRIMARY KEY (`cat_id`),
  ADD UNIQUE KEY `cat_name` (`cat_name`);

--
-- Indexes for table `current_order`
--
ALTER TABLE `current_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `cust_detail`
--
ALTER TABLE `cust_detail`
  ADD PRIMARY KEY (`cust_ph`);

--
-- Indexes for table `item_detail`
--
ALTER TABLE `item_detail`
  ADD PRIMARY KEY (`item_id`),
  ADD UNIQUE KEY `item_name` (`item_name`);

--
-- Indexes for table `tran_detail`
--
ALTER TABLE `tran_detail`
  ADD PRIMARY KEY (`cust_ph`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_detail`
--
ALTER TABLE `category_detail`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `item_detail`
--
ALTER TABLE `item_detail`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
