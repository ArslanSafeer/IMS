-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2020 at 02:22 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ims`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `branch_id` int(11) NOT NULL,
  `branch_name` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`branch_id`, `branch_name`, `status`) VALUES
(1, 'Super Branch', 0),
(2, 'Mini Branch', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) DEFAULT NULL,
  `category_description` varchar(100) DEFAULT NULL,
  `Entry_by` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `branch_id` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_description`, `Entry_by`, `deleted`, `branch_id`) VALUES
(4, 'Milkpak', 'milkpak doodh', NULL, 1, 1),
(5, 'Milkpak123', 'milkpak doodh12', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `current_rates`
--

CREATE TABLE `current_rates` (
  `rate_id` int(11) NOT NULL,
  `item_id` int(255) DEFAULT NULL,
  `current_rate` int(255) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `branch_id` int(11) DEFAULT NULL,
  `entry_by` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `current_rates`
--

INSERT INTO `current_rates` (`rate_id`, `item_id`, `current_rate`, `date`, `branch_id`, `entry_by`) VALUES
(2, 3, 13, '2020-03-19 03:22:29', 1, 0),
(4, 5, 3, '2020-03-19 03:23:54', 1, 2),
(13, 4, 12, '2020-03-01 02:58:50', 1, 2),
(14, 6, 123, '2020-04-07 03:32:12', 1, 2),
(15, 7, 12, '2020-04-07 03:32:19', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `discount_id` int(11) NOT NULL,
  `invoice_no` int(11) DEFAULT NULL,
  `amount` float(15,0) DEFAULT NULL,
  `entry_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`discount_id`, `invoice_no`, `amount`, `entry_date`) VALUES
(1, 0, 0, NULL),
(2, 0, 0, NULL),
(3, 0, 0, NULL),
(4, 0, 0, NULL),
(5, 0, 0, NULL),
(6, 0, 0, '2020-03-01 00:00:00'),
(7, 24, 2, '2020-03-01 00:00:00'),
(8, 24, 2, '2020-03-01 00:00:00'),
(9, 25, 1, '2020-03-01 00:00:00'),
(10, 26, 0, '2020-03-01 00:00:00'),
(11, 27, 0, '2020-03-01 00:00:00'),
(12, 28, 1, '2020-04-07 00:00:00'),
(13, 29, 1, '2020-04-07 00:00:00'),
(14, 30, 0, '2020-04-07 00:00:00'),
(15, 30, 0, '2020-04-07 00:00:00'),
(16, 30, 0, '2020-04-07 00:00:00'),
(17, 30, 0, '2020-04-07 00:00:00'),
(18, 31, 1, '2020-04-07 00:00:00'),
(19, 32, 0, '2020-04-07 00:00:00'),
(20, 39, 18, '2020-04-12 06:15:27'),
(21, 40, 5, '2020-04-12 06:16:49'),
(22, 41, 0, '2020-03-01 02:14:12'),
(23, 42, 10, '2020-03-01 02:15:02'),
(24, 43, 12, '2020-04-13 02:16:45'),
(25, 44, 11, '2020-04-13 04:42:05'),
(26, 45, 12, '2020-04-15 01:51:54'),
(27, 46, 10, '2020-04-15 01:52:09'),
(28, 47, 80, '2020-04-17 02:24:51'),
(29, 48, 5, '2020-04-17 02:25:05'),
(30, 49, 120, '2020-04-19 05:49:01'),
(31, 50, 10, '2020-04-19 06:06:22'),
(32, 51, 12, '2020-04-20 02:48:52');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `Employee_id` int(11) NOT NULL,
  `Employee_name` varchar(100) DEFAULT NULL,
  `Employee_designation` varchar(100) DEFAULT NULL,
  `Employee_dob` date DEFAULT NULL,
  `Entry_by` varchar(100) DEFAULT NULL,
  `System_ip` varchar(100) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `Employee_phone` varchar(50) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`Employee_id`, `Employee_name`, `Employee_designation`, `Employee_dob`, `Entry_by`, `System_ip`, `Password`, `Employee_phone`, `deleted`, `branch_id`) VALUES
(1, '', '', '0000-00-00', NULL, NULL, '$newpassword', '', 1, NULL),
(2, 'arsalan', 'assia', '2020-02-10', NULL, NULL, '222', '03123456784', 1, 1),
(3, 'arsalan', 'assia', '2020-02-10', NULL, NULL, '$newpassword', '03123456784444', 1, NULL),
(4, 'one', 'one', '2020-02-10', NULL, NULL, '$newpassword', '1', 0, NULL),
(5, 'two', 'two', '2020-02-10', NULL, NULL, '$newpassword', '2', 1, NULL),
(6, 'two', 'two', '2020-02-10', NULL, NULL, '$newpassword', '2', 0, NULL),
(7, 'two', 'two', '2020-02-10', NULL, NULL, '$newpassword', '2', 0, NULL),
(8, 'two', 'two', '2020-02-10', NULL, NULL, '$newpassword', '2', 0, NULL),
(9, 'two', 'two', '2020-02-10', NULL, NULL, '$newpassword', '2', 1, NULL),
(10, 'Noman', 'Assiatant', '2020-02-10', NULL, NULL, '$newpassword', '03123456784', 1, NULL),
(11, 'safeer noman', 'Assistant', '2020-02-11', NULL, NULL, '$newpassword', '0312345678432323', 1, NULL),
(12, 'abbas', 'Assiatant', '2020-02-12', NULL, NULL, '$newpassword', '03123456784', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `Item_id` int(11) NOT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `unit_id` int(11) NOT NULL,
  `item_weight` varchar(100) DEFAULT NULL,
  `item_color` varchar(100) DEFAULT NULL,
  `entry_date` datetime NOT NULL DEFAULT current_timestamp(),
  `Entry_by` int(11) DEFAULT NULL,
  `system_ip` varchar(50) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `category_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`Item_id`, `item_name`, `unit_id`, `item_weight`, `item_color`, `entry_date`, `Entry_by`, `system_ip`, `deleted`, `category_id`, `branch_id`) VALUES
(1, 'milk', 0, '34kg', 'red', '0000-00-00 00:00:00', NULL, NULL, 1, NULL, 1),
(2, '', 0, '0000kg', 'red', '0000-00-00 00:00:00', NULL, NULL, 1, NULL, 0),
(3, 'Milk', 0, '34kg', 'red', '0000-00-00 00:00:00', NULL, NULL, 0, NULL, 0),
(4, 'abbcc', 0, '23', 'red', '0000-00-00 00:00:00', NULL, NULL, 0, NULL, 0),
(5, 'abbcc', 9, '23', 'red', '0000-00-00 00:00:00', NULL, NULL, 0, NULL, 0),
(6, 'abbcccc', 9, '23', 'red', '0000-00-00 00:00:00', NULL, NULL, 0, NULL, 0),
(7, 'abbcccc', 9, '23', 'red', '0000-00-00 00:00:00', NULL, NULL, 0, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_child`
--

CREATE TABLE `order_child` (
  `child_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `product_qty` int(11) DEFAULT NULL,
  `Entry_by` int(11) DEFAULT NULL,
  `entry_date` datetime NOT NULL DEFAULT current_timestamp(),
  `branch_id` int(11) DEFAULT 0,
  `received_qty` int(11) NOT NULL,
  `purchase_amount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_child`
--

INSERT INTO `order_child` (`child_id`, `order_id`, `item_id`, `product_qty`, `Entry_by`, `entry_date`, `branch_id`, `received_qty`, `purchase_amount`) VALUES
(46, 19, 3, 1, 2, '2020-03-12 15:25:57', 0, 1, 10),
(47, 19, 4, 2, 2, '2020-03-12 15:26:22', 0, 2, 5),
(48, 19, 5, 3, 2, '2020-03-12 15:26:31', 0, 2, 15),
(49, 19, 6, 4, 2, '2020-03-12 15:26:37', 0, 4, 20),
(50, 19, 7, 5, 2, '2020-03-12 15:26:52', 0, 3, 25),
(51, 20, 3, 1, 2, '2020-03-12 16:21:18', 0, 1, 5),
(52, 20, 4, 2, 2, '2020-03-12 16:21:23', 0, 2, 10),
(53, 21, 3, 1, 2, '2020-03-15 06:32:01', 0, 0, NULL),
(54, 21, 4, 2, 2, '2020-03-15 06:32:07', 0, 0, NULL),
(55, 21, 5, 3, 2, '2020-03-15 06:32:14', 0, 0, NULL),
(56, 21, 6, 4, 2, '2020-03-15 06:32:22', 0, 0, NULL),
(57, 22, 3, 1, 2, '2020-03-16 02:47:31', 0, 0, NULL),
(58, 22, 4, 2, 2, '2020-03-16 02:47:37', 0, 0, NULL),
(59, 22, 5, 3, 2, '2020-03-16 02:47:43', 0, 0, NULL),
(68, 23, 3, 12, 2, '2020-03-20 04:13:51', 1, 0, NULL),
(69, 23, 4, 11, 2, '2020-03-20 04:13:57', 1, 0, NULL),
(70, 23, 5, 12, 2, '2020-03-20 04:14:02', 1, 0, NULL),
(71, 23, 6, 12, 2, '2020-03-20 04:14:10', 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_head`
--

CREATE TABLE `order_head` (
  `order_id` int(11) NOT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `order_by` int(11) DEFAULT NULL,
  `order_status` int(11) DEFAULT 0,
  `branch_id` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_head`
--

INSERT INTO `order_head` (`order_id`, `order_date`, `order_by`, `order_status`, `branch_id`) VALUES
(19, '2020-03-12 15:25:43', 2, 1, 1),
(20, '2020-03-12 15:41:53', 2, 1, 1),
(21, '2020-03-15 06:31:53', 2, 1, 1),
(22, '2020-03-16 02:47:25', 2, 1, 1),
(23, '2020-03-20 04:13:35', 2, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sold_child`
--

CREATE TABLE `sold_child` (
  `child_id` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `entry_by` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `product_qty` int(11) DEFAULT NULL,
  `invoice_no` int(11) DEFAULT NULL,
  `current_rate` int(255) DEFAULT NULL,
  `entry_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sold_child`
--

INSERT INTO `sold_child` (`child_id`, `branch_id`, `entry_by`, `item_id`, `product_qty`, `invoice_no`, `current_rate`, `entry_date`) VALUES
(55, 1, 2, 3, 23, 33, NULL, NULL),
(56, 1, 2, 4, 40, 33, 0, NULL),
(57, 1, 2, 5, 12, 34, 0, NULL),
(58, 1, 2, 3, 12, 35, 0, NULL),
(59, 1, 2, 3, 12, 36, 0, NULL),
(60, 1, 2, 5, 12, 36, 0, NULL),
(61, 1, 2, 3, 12, 37, 13, NULL),
(62, 1, 2, 5, 12, 37, 3, NULL),
(63, 1, 2, 4, 12, 37, 12, NULL),
(64, 1, 2, 4, 12, 38, 12, '2020-04-10 03:53:42'),
(65, 1, 2, 5, 12, 38, 3, '2020-04-10 03:53:47'),
(66, 1, 2, 3, 32, 39, 13, '2020-04-10 04:20:17'),
(67, 1, 2, 4, 12, 40, 12, '2020-04-12 06:16:36'),
(68, 1, 2, 4, 123, 41, 12, '2020-04-12 06:28:07'),
(70, 1, 2, 3, 40, 43, 13, '2020-04-13 02:16:41'),
(71, 1, 2, 3, 40, 44, 13, '2020-04-13 04:41:35'),
(72, 1, 2, 4, 40, 45, 12, '2020-04-13 04:42:15'),
(73, 1, 2, 4, 23, 46, 12, '2020-04-15 01:52:05'),
(75, 1, 2, 4, 234, 47, 12, '2020-04-17 02:24:45'),
(76, 1, 2, 7, 123, 48, 12, '2020-04-17 02:25:01'),
(77, 1, 2, 3, 23, 49, 13, '2020-04-19 05:47:56'),
(78, 1, 2, 4, 22, 49, 12, '2020-04-19 05:48:16'),
(79, 1, 2, 5, 32, 49, 3, '2020-04-19 05:48:24'),
(80, 1, 2, 6, 23, 49, 123, '2020-04-19 05:48:40'),
(81, 1, 2, 4, 23, 50, 12, '2020-04-19 06:04:56'),
(82, 1, 2, 5, 23, 50, 3, '2020-04-19 06:06:18'),
(83, 1, 2, 4, 23, 51, 12, '2020-04-20 02:48:35'),
(84, 1, 2, 5, 23, 51, 3, '2020-04-20 02:48:40'),
(85, 1, 2, 3, 23, 51, 13, '2020-04-20 02:48:46');

-- --------------------------------------------------------

--
-- Table structure for table `sold_head`
--

CREATE TABLE `sold_head` (
  `invoice_no` int(11) NOT NULL,
  `entry_by` int(255) DEFAULT NULL,
  `branch_id` int(11) DEFAULT 0,
  `invoice_status` int(11) DEFAULT 0,
  `entry_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sold_head`
--

INSERT INTO `sold_head` (`invoice_no`, `entry_by`, `branch_id`, `invoice_status`, `entry_date`) VALUES
(1, 2, 1, 1, NULL),
(2, 2, NULL, 1, NULL),
(3, 2, NULL, 1, NULL),
(4, 2, NULL, 1, NULL),
(5, 2, NULL, 1, NULL),
(6, 2, NULL, 1, NULL),
(7, 2, NULL, 1, NULL),
(8, 2, NULL, 1, NULL),
(9, 2, NULL, 1, NULL),
(10, 2, NULL, 1, NULL),
(11, 2, NULL, 1, NULL),
(12, 2, NULL, 1, NULL),
(13, 2, 0, 1, NULL),
(14, 2, 0, 1, NULL),
(15, 2, 0, 1, NULL),
(16, 2, 1, 1, NULL),
(17, 2, 1, 1, NULL),
(18, 2, 1, 1, NULL),
(19, 2, 1, 1, NULL),
(20, 2, 1, 1, NULL),
(21, 2, 1, 1, NULL),
(22, 2, 1, 1, NULL),
(23, 2, 1, 1, NULL),
(24, 2, 1, 1, NULL),
(25, 2, 1, 1, NULL),
(26, 2, 1, 1, NULL),
(27, 2, 1, 1, NULL),
(28, 2, 1, 1, NULL),
(29, 2, 1, 1, NULL),
(30, 2, 1, 1, NULL),
(31, 2, 1, 1, NULL),
(32, 2, 1, 1, NULL),
(33, 2, 1, 1, NULL),
(34, 2, 1, 1, NULL),
(35, 2, 1, 1, NULL),
(36, 2, 1, 1, NULL),
(37, 2, 1, 1, NULL),
(38, 2, 1, 1, NULL),
(39, 2, 1, 1, '2020-04-10 04:20:09'),
(40, 2, 1, 1, '2020-04-12 06:15:41'),
(41, 2, 1, 1, '2020-04-12 06:16:52'),
(42, 2, 1, 1, '2020-03-01 02:14:16'),
(43, 2, 1, 1, '2020-03-01 02:15:05'),
(44, 2, 1, 1, '2020-04-13 04:41:30'),
(45, 2, 1, 1, '2020-04-13 04:42:10'),
(46, 2, 1, 1, '2020-04-15 01:51:56'),
(47, 2, 1, 1, '2020-04-15 01:52:11'),
(48, 2, 1, 1, '2020-04-17 02:24:54'),
(49, 2, 1, 1, '2020-04-17 02:25:07'),
(50, 2, 1, 1, '2020-04-19 05:49:04'),
(51, 2, 1, 1, '2020-04-20 02:48:29');

-- --------------------------------------------------------

--
-- Table structure for table `stock_income`
--

CREATE TABLE `stock_income` (
  `stock_id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `total_amount` int(255) DEFAULT NULL,
  `Paid_amount` int(255) DEFAULT NULL,
  `Due_amuount` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `supplierlist`
--

CREATE TABLE `supplierlist` (
  `Supplier_id` int(11) NOT NULL,
  `Supplier_name` varchar(255) DEFAULT NULL,
  `Supplier_Phoneno` varchar(12) DEFAULT NULL,
  `Supplier_address` varchar(100) DEFAULT NULL,
  `Supplier_ntn` varchar(9) DEFAULT NULL,
  `Supplier_cnic` varchar(15) DEFAULT NULL,
  `Supplier_entrydate` datetime DEFAULT NULL,
  `System_ip` varchar(50) DEFAULT NULL,
  `Entry_by` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `Payee_no` varchar(200) DEFAULT NULL,
  `Account_no` varchar(200) DEFAULT NULL,
  `branch_id` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplierlist`
--

INSERT INTO `supplierlist` (`Supplier_id`, `Supplier_name`, `Supplier_Phoneno`, `Supplier_address`, `Supplier_ntn`, `Supplier_cnic`, `Supplier_entrydate`, `System_ip`, `Entry_by`, `deleted`, `Payee_no`, `Account_no`, `branch_id`) VALUES
(1, '', '', '', '123456', '', NULL, NULL, NULL, 1, NULL, NULL, 1),
(2, 'Arsalan', '123456', 'QUAID AZAM COLONY ', '123456', '3740552726253', NULL, NULL, NULL, 1, NULL, NULL, 0),
(3, '', '', '', '123456', '', NULL, NULL, NULL, 1, NULL, NULL, 0),
(4, 'Aaaaaaaaaaa', '123456', 'QUAID AZAM COLONY ', '123456', '3740552726253', NULL, NULL, NULL, 0, NULL, NULL, 0),
(5, 'Arsalan', '123456', 'QUAID AZAM COLONY ', '123456', '3740552', NULL, NULL, NULL, 0, 'Arsa', '12367800', 0);

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `unit_id` int(11) NOT NULL,
  `unit_name` varchar(100) DEFAULT NULL,
  `unit_description` varchar(100) DEFAULT NULL,
  `Employee_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `branch_id` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`unit_id`, `unit_name`, `unit_description`, `Employee_id`, `deleted`, `branch_id`) VALUES
(1, 'Milk', 'Milk pak', NULL, 1, 1),
(2, 'Milk', 'Milk pak', NULL, 0, 0),
(3, 'Milkkk', 'Milk pak', NULL, 0, 0),
(4, 'zzz', 'hhhhhhhh', NULL, 0, 0),
(5, 'Milk', 'Milk', NULL, 1, 0),
(6, 'Milkkkl', 'Milk pak', NULL, 1, 0),
(7, 'Milkkkl', 'Milk pak', NULL, 1, 0),
(8, 'Milkkkl', 'Milk pak', NULL, 1, 0),
(9, 'kg', 'Milk pak', NULL, 0, 0),
(10, 'letter', 'Milk pakkkk', NULL, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `current_rates`
--
ALTER TABLE `current_rates`
  ADD PRIMARY KEY (`rate_id`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`discount_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`Employee_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`Item_id`);

--
-- Indexes for table `order_child`
--
ALTER TABLE `order_child`
  ADD PRIMARY KEY (`child_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `order_head`
--
ALTER TABLE `order_head`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `sold_child`
--
ALTER TABLE `sold_child`
  ADD PRIMARY KEY (`child_id`),
  ADD KEY `sold_child_ibfk_1` (`invoice_no`);

--
-- Indexes for table `sold_head`
--
ALTER TABLE `sold_head`
  ADD PRIMARY KEY (`invoice_no`);

--
-- Indexes for table `stock_income`
--
ALTER TABLE `stock_income`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `supplierlist`
--
ALTER TABLE `supplierlist`
  ADD PRIMARY KEY (`Supplier_id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `current_rates`
--
ALTER TABLE `current_rates`
  MODIFY `rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `discount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `Employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `Item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_child`
--
ALTER TABLE `order_child`
  MODIFY `child_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `order_head`
--
ALTER TABLE `order_head`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `sold_child`
--
ALTER TABLE `sold_child`
  MODIFY `child_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `sold_head`
--
ALTER TABLE `sold_head`
  MODIFY `invoice_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `stock_income`
--
ALTER TABLE `stock_income`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplierlist`
--
ALTER TABLE `supplierlist`
  MODIFY `Supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_child`
--
ALTER TABLE `order_child`
  ADD CONSTRAINT `order_child_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order_head` (`order_id`) ON UPDATE NO ACTION;

--
-- Constraints for table `sold_child`
--
ALTER TABLE `sold_child`
  ADD CONSTRAINT `sold_child_ibfk_1` FOREIGN KEY (`invoice_no`) REFERENCES `sold_head` (`invoice_no`) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
