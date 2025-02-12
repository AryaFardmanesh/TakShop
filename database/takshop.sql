-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2025 at 08:43 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `takshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` varchar(32) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(120) NOT NULL,
  `name` varchar(320) NOT NULL DEFAULT 'New_User',
  `phone` varchar(13) DEFAULT NULL,
  `zipcode` varchar(10) DEFAULT NULL,
  `address` varchar(2048) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `ban_message` varchar(2048) DEFAULT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` varchar(32) NOT NULL,
  `cart_id` varchar(32) NOT NULL,
  `product_id` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts_category`
--

CREATE TABLE `carts_category` (
  `id` varchar(32) NOT NULL,
  `cart_id` varchar(32) NOT NULL,
  `owner` varchar(60) NOT NULL,
  `total_price` decimal(15,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` varchar(32) NOT NULL,
  `cart_id` varchar(32) NOT NULL,
  `status` int(11) NOT NULL,
  `ban_message` varchar(2048) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` varchar(32) NOT NULL,
  `cart_id` varchar(32) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments_sessions`
--

CREATE TABLE `payments_sessions` (
  `id` varchar(32) NOT NULL,
  `cart_id` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` varchar(32) NOT NULL,
  `owner` varchar(60) NOT NULL,
  `name` varchar(256) NOT NULL DEFAULT 'No_Product_Name',
  `description` varchar(2048) NOT NULL DEFAULT 'No_Product_Description',
  `price` decimal(15,0) NOT NULL,
  `count` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `ban_message` varchar(2048) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products_removed`
--

CREATE TABLE `products_removed` (
  `id` varchar(32) NOT NULL,
  `owner` varchar(60) NOT NULL,
  `name` varchar(256) NOT NULL DEFAULT 'No_Product_Name',
  `description` varchar(2048) NOT NULL DEFAULT 'No_Product_Description',
  `price` decimal(15,0) NOT NULL,
  `count` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `ban_message` varchar(2048) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts_category`
--
ALTER TABLE `carts_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments_sessions`
--
ALTER TABLE `payments_sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_removed`
--
ALTER TABLE `products_removed`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
