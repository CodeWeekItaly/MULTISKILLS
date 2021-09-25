-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 25, 2021 at 01:16 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iocdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `available`
--

CREATE TABLE `available` (
  `id` int(13) NOT NULL,
  `idProduct` int(13) NOT NULL,
  `avFrom` date NOT NULL,
  `avTo` date NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `stock` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(2) NOT NULL,
  `description` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `description`) VALUES
(1, 'Fruit'),
(2, 'Vegetable'),
(3, 'Meat'),
(4, 'Dairy'),
(5, 'Bakery'),
(6, 'Drink'),
(7, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `id` int(13) NOT NULL,
  `idOrder` int(13) NOT NULL,
  `idAvailable` int(13) NOT NULL,
  `quantity` int(3) NOT NULL,
  `totalPrice` decimal(6,2) NOT NULL DEFAULT 0.00,
  `processed` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(13) NOT NULL,
  `idUser` int(13) NOT NULL,
  `paymentMethod` varchar(100) NOT NULL,
  `shippingAddress` text NOT NULL,
  `billingAddress` text NOT NULL,
  `totalPrice` decimal(6,2) NOT NULL DEFAULT 0.00,
  `dateOrder` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(13) NOT NULL,
  `idUser` int(13) NOT NULL,
  `category` int(2) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL,
  `um` varchar(20) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `productPicture` varchar(300) DEFAULT NULL,
  `qtySold` int(6) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(13) NOT NULL,
  `idProduct` int(13) NOT NULL,
  `idUser` int(13) NOT NULL,
  `rating` decimal(2,1) NOT NULL,
  `comment` varchar(300) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `surname` varchar(30) DEFAULT NULL,
  `company` varchar(50) DEFAULT NULL,
  `companylocation` varchar(30) DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `state` varchar(30) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `zipcode` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `profilePicture` varchar(150) DEFAULT NULL,
  `seller` tinyint(1) DEFAULT NULL,
  `otp` varchar(6) DEFAULT NULL,
  `verified` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `company`, `companylocation`, `description`, `telephone`, `address`, `state`, `city`, `zipcode`, `email`, `password`, `profilePicture`, `seller`, `otp`, `verified`) VALUES
(2, 'Francesco', 'Peluso', 'MULTISKILLS', 'Florence', 'IOcommerce staff member.\r\nFull Stack Developer.', '0828123456', 'Via Del Corso, 1', 'Italy', 'Florence', '00100', 'francesco.peluso04@gmail.com', '$2y$10$jmO7Le5/e2kpgRQ4GySAx.jgQJK.Ctl4xK11PDrUVUvXnaqzafBZC', 'idProfile-2.jpg', 1, '587297', NULL),
(3, 'Demo', 'Account', 'IOcommerce', 'Rome', NULL, '0828123456', 'Via Del Corso, 1', 'Italy', 'Rome', '00100', 'demo@iocommerce.com', '$2y$10$2K1tsnSeFKozu5CwyFMeLukNVkznSvxHtDSShcWmxrm486V6Tv0UC', NULL, 1, NULL, NULL),
(10, 'Remo', 'Labarca', '', NULL, '', '0828123456', '', '', '', '', 'demo2@iocommerce.it', '$2y$10$MmNpdN.NYB4PrwvmuMnm9.hWK2rLl6XscPeTl6YUClO6RckUg3cbG', NULL, 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `available`
--
ALTER TABLE `available`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`idProduct`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idOrder` (`idOrder`,`idAvailable`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idProduct` (`idProduct`,`idUser`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `available`
--
ALTER TABLE `available`
  MODIFY `id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
