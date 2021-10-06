-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql112.epizy.com
-- Generation Time: Apr 23, 2021 at 10:11 AM
-- Server version: 5.6.48-88.0
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_28425586_halfmoon`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `foodtype` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `price`, `deleted`, `foodtype`) VALUES
(1, 'Matcha Green Tea', '3.00', 0, 'Tea'),
(2, 'Supreme Japanese Genmaichai', '3.00', 0, 'Tea'),
(3, 'Japanese Sancha Green Tea', '3.00', 0, 'Tea'),
(4, 'Japanese Premium Gyokoro', '3.00', 0, 'Tea'),
(5, 'Bancha Green Tea', '3.00', 0, 'Dessert'),
(6, 'Oolong Tea', '3.00', 0, 'Tea'),
(10, 'Black Tea', '3.00', 0, 'Tea'),
(11, 'Hibiscus Tea', '3.00', 0, 'Tea'),
(12, 'Chamomile Tea', '3.00', 0, 'Tea'),
(13, 'Matcha and strawberry', '3.00', 0, 'Dessert'),
(14, 'Matcha Crepe Cake', '3.00', 0, 'Tea'),
(15, 'Mixed Mushroom Steamed Buns', '3.00', 0, 'Side'),
(16, 'Seasoned Crispy chicken steamed buns', '3.00', 0, 'Side'),
(22, 'Castella', '3.00', 0, 'Dessert'),
(23, 'Wagashi', '3.00', 0, 'Tea'),
(24, '', '0.00', 0, 'Dessert');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tablenumber` int(2) NOT NULL,
  `description` varchar(300) NOT NULL,
  `total` int(11) NOT NULL,
  `status` varchar(25) NOT NULL DEFAULT 'Ordered!',
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `tablenumber`, `description`, `total`, `status`, `deleted`) VALUES
(50, 2, 1, '', 6, 'Cancelled by Customer', 1),
(51, 21, 3, '', 9, 'Waiting to be Served!', 0),
(52, 2, 3, 'Gluten Free, ty', 9, 'In Kitchen!', 0),
(53, 2, 2, '', 9, 'Ordered!', 0),
(49, 2, 2, '', 9, 'In Kitchen!', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `item_id`, `quantity`, `price`) VALUES
(452, 53, 3, 1, 3),
(451, 53, 2, 1, 3),
(450, 53, 1, 1, 3),
(449, 52, 3, 1, 3),
(448, 52, 2, 1, 3),
(447, 52, 1, 1, 3),
(446, 51, 3, 1, 3),
(445, 51, 2, 1, 3),
(444, 51, 1, 1, 3),
(443, 50, 2, 1, 3),
(442, 50, 1, 1, 3),
(441, 49, 3, 1, 3),
(440, 49, 2, 1, 3),
(439, 49, 1, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `poster_id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `description` varchar(3000) NOT NULL,
  `status` varchar(8) NOT NULL DEFAULT 'Open',
  `type` varchar(30) NOT NULL DEFAULT 'Others',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `poster_id`, `subject`, `description`, `status`, `type`, `date`, `deleted`) VALUES
(1, 2, 'Subject 1', 'New Description for Subject 1', 'Answered', 'Support', '2017-03-30 18:08:51', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_details`
--

CREATE TABLE `ticket_details` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket_details`
--

INSERT INTO `ticket_details` (`id`, `ticket_id`, `user_id`, `description`, `date`) VALUES
(1, 1, 2, 'New Description for Subject 1', '2017-03-30 18:08:51'),
(2, 1, 2, 'Reply-1 for Subject 1', '2017-03-30 19:59:09'),
(3, 1, 1, 'Reply-2 for Subject 1 from Administrator.', '2017-03-30 20:35:39'),
(4, 1, 1, 'Reply-3 for Subject 1 from Administrator.', '2017-03-30 20:49:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` varchar(15) NOT NULL DEFAULT 'Waiter',
  `name` varchar(15) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(16) NOT NULL,
  `email` varchar(35) DEFAULT NULL,
  `address` varchar(300) DEFAULT NULL,
  `contact` bigint(11) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `username`, `password`, `email`, `address`, `contact`, `verified`, `deleted`) VALUES
(1, 'Administrator', 'admin 2', 'root', 'toor', 'admin@email.com', 'Address 1', 790367615, 1, 0),
(2, 'Waiter', 'WaiterAdi', 'Adrian21', 'Password1', 'waiter@email.com', 'Address 2', 7981673986, 1, 0),
(3, 'Waiter', 'Waiter 2', 'user2', 'pass2', 'waiter@email.com', 'Address 3', 9898000002, 1, 0),
(4, 'Waiter', 'Waiter 3', 'user3', 'pass3', 'waiter@email.com', '', 9898000003, 0, 0),
(5, 'Waiter', 'Waiter 4', 'user4', 'pass4', 'waiter@email.com', '', 9898000004, 0, 1),
(6, 'Waiter', 'Waiter 5', 'James1', 'Password1', 'waiter@email.com', '13 Street Name', 7189798731, 0, 0),
(8, 'Waiter', 'Waiter 6', 'Simon11', 'Password1', 'waiter@email.com', '18 Street Name', 7189798719, 0, 0),
(9, 'Chef', 'Chef 1', 'Simon15', 'Password1', 'chef@email.com', '19 Street Name', 7981986981, 0, 0),
(10, 'Chef', 'Chef 2', 'Simon19', 'Password1', 'chef@email.com', '20 Street Name', 7998616871, 0, 0),
(11, 'Chef', 'Chef 3', 'daniellacg', 'Adrian21!', 'chef@email.com', '13 Elan Close', 7468455585, 0, 0),
(12, 'Chef', 'Chef 4', 'Test', 'pass', 'chef@email.com', '13 Street Name', 71561651231, 0, 1),
(13, 'Chef', 'ChefScott', 'ScottMan', 'Password1', 'chef@email.com', '13 Street Name', 7783465873, 1, 1),
(14, 'Waiter', 'Waiter 7', 'WaiterJeff', 'password', 'waiter@email.com', '', 7189798719, 1, 0),
(15, 'Chef', 'Chef 6', 'Chef John', 'password', 'chef@email.com', '', 7189798719, 1, 0),
(16, 'Waiter', 'Waiter 8', 'Waiterjoe', 'password', 'waiter@email.com', '', 7189798719, 1, 0),
(17, 'Chef', 'Chef 7', 'ChefMan', 'password', 'chef@email.com', '', 9898000004, 1, 0),
(22, 'Waiter', 'WaiterMann', 'Waiter 9', 'Password1', 'waiter@email.com', '', 7981673986, 1, 0),
(21, 'Chef', 'John', 'ChefJohn', 'Password1', 'email@email.com', '13 Street Name', 7867523756, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `poster_id` (`poster_id`);

--
-- Indexes for table `ticket_details`
--
ALTER TABLE `ticket_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_id` (`ticket_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=453;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ticket_details`
--
ALTER TABLE `ticket_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
