-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2023 at 02:37 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `action_logs`
--

CREATE TABLE `action_logs` (
  `id` int(11) NOT NULL,
  `datetime` datetime DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `action_logs`
--

INSERT INTO `action_logs` (`id`, `datetime`, `role`, `username`, `action`) VALUES
(1, '2023-03-06 11:22:10', 'Owner', 'owner', 'User has logged in'),
(2, '2023-03-06 04:31:46', 'Owner', 'owner', 'Successfully saved the Category'),
(3, '2023-03-06 04:32:09', 'Owner', 'owner', 'Successfully saved the Product'),
(4, '2023-03-06 04:35:00', 'Owner', 'owner', 'Successfully saved the Product'),
(5, '2023-03-06 04:42:41', 'Owner', 'owner', 'Successfully saved the Category'),
(6, '2023-03-06 04:43:06', 'Owner', 'owner', 'Successfully saved the Product'),
(7, '2023-03-06 04:46:56', 'Owner', 'owner', 'Successfully saved the Product'),
(8, '2023-03-06 04:57:52', 'Owner', 'owner', 'Successfully update sell price of the Product'),
(9, '2023-03-06 04:57:53', 'Owner', 'owner', 'Successfully saved the Product details'),
(10, '2023-03-06 13:32:20', 'Owner', 'owner', 'User has logged in'),
(11, '2023-03-06 17:17:54', 'Owner', 'owner', 'User has logged in'),
(12, '2023-03-07 13:03:19', 'Owner', 'owner', 'User has logged in'),
(13, '2023-03-07 15:02:39', 'Owner', 'owner', 'Successfully saved the Product'),
(14, '2023-03-07 15:02:40', 'Owner', 'owner', 'Successfully update sell price of the Product'),
(15, '2023-03-07 15:02:41', 'Owner', 'owner', 'Successfully saved the Product details'),
(16, '2023-03-07 15:02:41', 'Owner', 'owner', 'Successfully update sell price of the Product'),
(17, '2023-03-07 15:02:41', 'Owner', 'owner', 'Successfully saved the Product details'),
(18, '2023-03-07 15:03:25', 'Owner', 'owner', 'Successfully updated the Product'),
(19, '2023-03-07 15:03:27', 'Owner', 'owner', 'Successfully updated the Product'),
(20, '2023-03-07 15:03:27', 'Owner', 'owner', 'Successfully updated the Product'),
(21, '2023-03-07 15:03:27', 'Owner', 'owner', 'Successfully updated the Product'),
(22, '2023-03-07 15:03:27', 'Owner', 'owner', 'Successfully updated the Product'),
(23, '2023-03-07 15:03:28', 'Owner', 'owner', 'Successfully updated the Product'),
(24, '2023-03-07 15:03:28', 'Owner', 'owner', 'Successfully updated the Product'),
(25, '2023-03-07 15:03:28', 'Owner', 'owner', 'Successfully updated the Product'),
(26, '2023-03-07 15:03:28', 'Owner', 'owner', 'Successfully updated the Product'),
(27, '2023-03-07 15:03:28', 'Owner', 'owner', 'Successfully updated the Product'),
(28, '2023-03-07 15:03:28', 'Owner', 'owner', 'Successfully updated the Product'),
(29, '2023-03-07 15:03:29', 'Owner', 'owner', 'Successfully updated the Product'),
(30, '2023-03-07 15:03:29', 'Owner', 'owner', 'Successfully updated the Product'),
(31, '2023-03-07 15:03:31', 'Owner', 'owner', 'Successfully updated the Product'),
(32, '2023-03-07 15:03:31', 'Owner', 'owner', 'Successfully updated the Product'),
(33, '2023-03-07 15:03:31', 'Owner', 'owner', 'Successfully updated the Product'),
(34, '2023-03-07 15:03:31', 'Owner', 'owner', 'Successfully updated the Product'),
(35, '2023-03-07 15:03:34', 'Owner', 'owner', 'Successfully updated the Product'),
(36, '2023-03-08 07:58:48', 'Owner', 'owner', 'User has logged in'),
(37, '2023-03-08 01:35:07', 'Owner', 'owner', 'Successfully saved the User'),
(38, '2023-03-08 01:35:41', 'Owner', 'owner', 'User has logged out'),
(39, '2023-03-08 08:36:42', 'Admin', 'Ready', 'User has logged in'),
(40, '2023-03-08 01:38:26', 'Admin', 'Ready', 'Successfully change password the User'),
(41, '2023-03-08 08:39:24', 'Admin', 'Ready', 'User has logged in');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Hotdog'),
(2, 'keme');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `expense` varchar(25) NOT NULL,
  `amount` float NOT NULL,
  `issuer` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `number` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date_transact` datetime DEFAULT NULL,
  `total_items` int(11) DEFAULT NULL,
  `total_purchase` float DEFAULT NULL,
  `discount` tinyint(1) DEFAULT 0 COMMENT 'True | False',
  `costumer_name` varchar(100) DEFAULT NULL,
  `osca_number` varchar(100) DEFAULT NULL,
  `cash_payment` float DEFAULT NULL,
  `label` int(11) DEFAULT NULL,
  `voider` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `issues`
--

CREATE TABLE `issues` (
  `id` int(11) NOT NULL,
  `damage_description` varchar(100) NOT NULL,
  `incomplete_description` varchar(100) NOT NULL,
  `theft_description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `barcode` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `sale_price` float DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `max_stock` int(11) DEFAULT NULL,
  `min_stock` int(11) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `expired_products` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `barcode`, `name`, `sale_price`, `status`, `max_stock`, `min_stock`, `type`, `expired_products`) VALUES
(1, 1, 356536, 'Rreaddf', 44, 1, NULL, NULL, 'generic', 0),
(2, 1, 47356, 'grwtg', 44, 1, NULL, NULL, 'branded', 0),
(3, 2, 36735, 'Ready to be', 66, 1, NULL, NULL, 'branded', 0),
(4, 2, 33, 'afterretwry', 44, 1, NULL, NULL, 'generic', 0),
(5, 2, 12345, 'MOONLIGHT SUNRISE', 55, 1, 300, 50, 'generic', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `buy_price` float DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `manufacture_date` date DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `expired_status` int(11) DEFAULT 0,
  `batch` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`id`, `product_id`, `quantity`, `buy_price`, `date_added`, `manufacture_date`, `expiration_date`, `expired_status`, `batch`) VALUES
(5, 4, 322, 33, '2023-03-06 04:57:52', '2023-03-06', '2023-11-02', 0, 1),
(7, 5, 300, 44, '2023-03-07 15:02:40', '2023-03-07', '2023-12-28', 0, 1),
(8, 5, 40, 44, '2023-03-07 15:02:41', '2023-03-07', '2023-02-08', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id` int(11) NOT NULL,
  `orders` varchar(50) NOT NULL,
  `supply` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` float NOT NULL,
  `order_date` datetime NOT NULL,
  `receiving_date` datetime NOT NULL,
  `supplier` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `paid` datetime DEFAULT NULL,
  `delivery` datetime DEFAULT NULL,
  `received` datetime DEFAULT NULL,
  `stock` datetime DEFAULT NULL,
  `damaged` int(11) DEFAULT NULL,
  `incomplete` int(11) DEFAULT NULL,
  `theft` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`id`, `orders`, `supply`, `quantity`, `amount`, `order_date`, `receiving_date`, `supplier`, `status`, `paid`, `delivery`, `received`, `stock`, `damaged`, `incomplete`, `theft`) VALUES
(1, 'dhety', 0, 344, 5555, '0000-00-00 00:00:00', '2023-04-07 00:00:00', 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL),
(2, 'ghsfgs', 0, 44, 555, '0000-00-00 00:00:00', '2023-04-07 00:00:00', 2, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL),
(3, 'rwtwt', 0, 455, 6666, '0000-00-00 00:00:00', '2023-03-31 00:00:00', 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'rwtwt', 0, 455, 6666, '0000-00-00 00:00:00', '2023-03-31 00:00:00', 2, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL),
(6, 'Keme', 0, 400, 4000, '0000-00-00 00:00:00', '2023-04-01 00:00:00', 3, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'qwerty', 0, 200, 2000, '0000-00-00 00:00:00', '2023-03-31 00:00:00', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'bnbnb', 0, 557, 6000, '0000-00-00 00:00:00', '2023-03-27 00:00:00', 3, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Save your tears', 0, 500, 6000, '0000-00-00 00:00:00', '2023-03-16 00:00:00', 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `date_purchased` datetime DEFAULT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `product_detail_id` int(11) DEFAULT NULL,
  `void` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `supplier_name` varchar(25) NOT NULL,
  `product_supply` int(11) NOT NULL,
  `personnel` varchar(25) NOT NULL,
  `contact_number` int(11) NOT NULL,
  `email` varchar(25) NOT NULL,
  `address` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trigger`
--

CREATE TABLE `trigger` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `triggered` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `login_attempt` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `password`, `role`, `status`, `last_login`, `login_attempt`) VALUES
(1, 'John', 'Doe', 'owner', '$2y$10$uovfGxUqgB7aaOXTlT832OEXoy52Kj1lJ6wzqchHhhnTi65937ZAS', 1, 1, '2023-03-08 07:58:48', 0),
(8, 'Chou', 'Tzuyu', 'Ready', '$2y$10$2YupNAahHjKmWJ5rHhiqTebUt7IxbGS3VwsKhH5MGPUZfhuCkgMUK', 2, 1, '2023-03-08 08:39:24', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action_logs`
--
ALTER TABLE `action_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_FK` (`user_id`);

--
-- Indexes for table `issues`
--
ALTER TABLE `issues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_FK` (`category_id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_details_FK` (`product_id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_FK` (`product_id`),
  ADD KEY `sales_FK_1` (`invoice_id`),
  ADD KEY `sales_FK_2` (`product_detail_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trigger`
--
ALTER TABLE `trigger`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trigger_FK` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action_logs`
--
ALTER TABLE `action_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issues`
--
ALTER TABLE `issues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trigger`
--
ALTER TABLE `trigger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_FK` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `product_details`
--
ALTER TABLE `product_details`
  ADD CONSTRAINT `product_details_FK` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_FK` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `sales_FK_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`),
  ADD CONSTRAINT `sales_FK_2` FOREIGN KEY (`product_detail_id`) REFERENCES `product_details` (`id`);

--
-- Constraints for table `trigger`
--
ALTER TABLE `trigger`
  ADD CONSTRAINT `trigger_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
