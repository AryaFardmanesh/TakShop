-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2025 at 01:21 PM
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

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `name`, `phone`, `zipcode`, `address`, `role`, `status`, `ban_message`, `date`) VALUES
('6825e7cdb4fd66825e7cdb4fd96825e7', 'admin', '$2y$10$4Gmbfk83I1DvFrZgJQihJ.TySeo2Sve2KbQf/iTIpknmrBe6AxV6.', 'آریا فردمنش', '09024708900', '1478090180', 'تهران, منطقه 5, میدان دانشگاه, کوی اخلاص', 20, 10, '', '2025-05-15'),
('6826d98d199166826d98d1991a6826d9', 'normal_demo', '$2y$10$wt/CGrX.ChqAq0Bs30OQD.O2agFqAkY02VoJaFmqwWHJVnpOEYudK', 'حساب عادی', '09120000000', '000000000', 'وبسایت فروشگاهی تک شاپ.', 10, 10, '', '2025-05-16'),
('6829b57a8d88d6829b57a8d8906829b5', 'normal2', '$2y$10$YJFYO.rnVTRfTQK3la8n2uOV0h0DdolKStGtU.c5VZvv2fvXo/nDC', 'حساب تست', '09120000000', '000000000', 'وبسایت فروشگاهی تک شاپ.', 10, 20, '', '2025-05-18'),
('6829b5f8a40df6829b5f8a40e36829b5', 'admin2', '$2y$10$GhTQNwn3tO7sMreih./E1eBjZjQLMLR2WzSObQWTcRozTpMxa5C56', 'مدیر دوم سایت', '09024708900', '۱۴۷۵۹۱۴۷۷۹', 'وبسایت فروشگاهی تک شاپ.', 20, 10, '', '2025-05-18');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` varchar(32) NOT NULL,
  `cart_id` varchar(32) NOT NULL,
  `product_id` varchar(32) NOT NULL,
  `count` int(11) NOT NULL DEFAULT 0,
  `owner` varchar(32) NOT NULL
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
  `image` varchar(512) NOT NULL DEFAULT 'default.png',
  `status` int(11) NOT NULL,
  `ban_message` varchar(2048) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `owner`, `name`, `description`, `price`, `count`, `image`, `status`, `ban_message`) VALUES
('6829b89bb41dd6829b89bb41e26829b8', '6825e7cdb4fd66825e7cdb4fd96825e7', 'کتاب New England', 'کتاب بسیار زیبا The New England نسخه فیزیکی.', 50000, 100, '2025051819-pexels-athena-3417719.jpg', 10, ''),
('6829b8dbcbb4b6829b8dbcbb4d6829b8', '6825e7cdb4fd66825e7cdb4fd96825e7', 'ماگ با طرح سنگی', 'ماگ بسیار زیبا با تم طبیعت مخصوص نوشیدن چای.', 100000, 200, '2025051823-pexels-charlotte-may-5946759.jpg', 10, ''),
('6829b9191d3486829b9191d34a6829b9', '6825e7cdb4fd66825e7cdb4fd96825e7', 'تیشرت عمده', 'تیشرت با طرح های مختلف در رنگ بندی و اندازه های متفاوت.', 250000, 10000, '2025051825-pexels-daiangan-102129.jpg', 10, ''),
('6829b9cc295626829b9cc295646829b9', '6825e7cdb4fd66825e7cdb4fd96825e7', 'پیراهن مردانه', 'پیراهن مردانه در طرح های مختلف.', 300000, 80, '2025051824-pexels-david-bartus-43782-297933.jpg', 10, ''),
('6829ba260aac26829ba260aac56829ba', '6825e7cdb4fd66825e7cdb4fd96825e7', 'کتاب Python', 'کتاب آموزش برنامه نویسی با زبان Python برای علاقه مندان به حوضه برنامه نویسی و کامپیوتر.', 500000, 30, '2025051854-pexels-divinetechygirl-1181671.jpg', 10, ''),
('6829ba5c515f86829ba5c515fb6829ba', '6825e7cdb4fd66825e7cdb4fd96825e7', 'کتاب Hooked', 'کتاب بسیار جذاب Hooked.', 250000, 5, '2025051848-pexels-itismowgli-824197.jpg', 10, ''),
('6829ba9a73b3f6829ba9a73b426829ba', '6825e7cdb4fd66825e7cdb4fd96825e7', 'کتاب 1000 Chairs', 'کتاب داستانی 1000 Chairs برای دوست داران کتاب.', 500000, 50, '2025051850-pexels-ivan-samkov-4238505.jpg', 10, ''),
('6829bad1097d66829bad1097d76829ba', '6825e7cdb4fd66825e7cdb4fd96825e7', 'شلوار جین', 'شلوار جین عمده در رنگ بندی مختلف و سایز های متفاوت به قیمت عمده.', 350000, 2000, '2025051845-pexels-karolina-grabowska-4210860.jpg', 10, ''),
('6829bbf48b5f86829bbf48b5fb6829bb', '6825e7cdb4fd66825e7cdb4fd96825e7', 'شلوار جین', 'شلوار جین با کیفیت بالا.', 800000, 20, '2025051836-pexels-karolina-grabowska-4210866.jpg', 10, ''),
('6829bc3245e616829bc3245e646829bc', '6825e7cdb4fd66825e7cdb4fd96825e7', 'دفتر سفید', 'دفتر سفید, مناسب برای نوشتن یاداشت های روزانه.', 75000, 100, '2025051838-pexels-karolina-grabowska-4218705.jpg', 10, ''),
('6829bc5cb75ee6829bc5cb75f06829bc', '6825e7cdb4fd66825e7cdb4fd96825e7', 'ماگ سفید طرح دار', 'ماگ سفید طرح دار زیبا مناسب برای نوشیدن قهوه.', 150000, 100, '2025051820-pexels-lilartsy-3335613.jpg', 10, ''),
('6829bc8d0e2b66829bc8d0e2b86829bc', '6825e7cdb4fd66825e7cdb4fd96825e7', 'شلوار های جین', 'شلوار های جین در سه رنگ مختلف.', 1400000, 10, '2025051809-pexels-micaasato-1082529.jpg', 10, ''),
('6829bcc3bd49b6829bcc3bd49d6829bc', '6825e7cdb4fd66825e7cdb4fd96825e7', 'ست کامل تابستونی', 'ست کامل تابستوی همراه با تیشرت و کفش و ساعت.', 2400000, 5, '2025051803-pexels-mnzoutfits-1639729.jpg', 10, ''),
('6829be69892da6829be69892dd6829be', '6829b5f8a40df6829b5f8a40e36829b5', 'ست کامل تابستونی', 'ست کامل تابستونی همراه با یک شلوار و کفش و پیراهن و ساعت.', 5000000, 10, '2025051805-pexels-mnzoutfits-1670770.jpg', 10, ''),
('6829be9b249996829be9b2499b6829be', '6829b5f8a40df6829b5f8a40e36829b5', 'کفش', 'کفش با طرح ها و رنگ های مختلف در انواع سایز ها.', 1200000, 50, '2025051855-pexels-nietjuhart-934069.jpg', 10, ''),
('6829becb519f86829becb519fa6829be', '6829b5f8a40df6829b5f8a40e36829b5', 'ماگ با طرح نسکافه', 'ماگ با طرح نسکافه مناسب برای نوشیدن قهوه.', 199000, 1000, '2025051843-pexels-photo-1545668.jpeg', 10, ''),
('6829bf2805c966829bf2805c986829bf', '6829b5f8a40df6829b5f8a40e36829b5', 'شلوار جین با قیمت عمده', 'شلوار جین با قیمت عمده, طرح و اندازه ثابت است.', 400000, 5000, '2025051816-pexels-pixabay-52518.jpg', 10, ''),
('6829bf71447556829bf71447586829bf', '6829b5f8a40df6829b5f8a40e36829b5', 'ماپ صورتی', 'ماپ صورتی و نوشته ساده مناسب برای هدیه دادن.', 250000, 100, '2025051829-pexels-polina-zimmerman-3747154.jpg', 10, ''),
('6829bfc11a5566829bfc11a5596829bf', '6829b5f8a40df6829b5f8a40e36829b5', 'ست رسمی', 'یک کفش به همراه یک پیراهن.', 2400000, 50, '2025051849-pexels-solliefoto-298863.jpg', 10, ''),
('6829bff490e6d6829bff490e6f6829bf', '6829b5f8a40df6829b5f8a40e36829b5', 'کفش مردانه', 'کفش رسمی مردانه با ساز های و طرح های مخلتف.', 850000, 80, '2025051840-pexels-solliefoto-298864.jpg', 10, ''),
('6829c0430bcf26829c0430bcf46829c0', '6829b5f8a40df6829b5f8a40e36829b5', 'ساعت دخترانه', 'ساعت مناسب برای بانوان در طرح و رنگ های متفاوت.', 2400000, 50, '2025051859-pexels-the-5th-50003-179909.jpg', 10, ''),
('6829c07d99dfc6829c07d99dfe6829c0', '6829b5f8a40df6829b5f8a40e36829b5', 'کتاب Heapt', 'کتاب علمی Heapt.', 750000, 380, '2025051857-pexels-thought-catalog-317580-2228582.jpg', 10, ''),
('6829c11a3773c6829c11a377416829c1', '6829b5f8a40df6829b5f8a40e36829b5', 'کتاب women', 'کتاب \"This is for the women who dont give F**k\" برای دوست داران کتاب.', 450000, 15, '2025051834-pexels-thought-catalog-317580-2228586.jpg', 10, ''),
('6829c1557024f6829c155702516829c1', '6829b5f8a40df6829b5f8a40e36829b5', 'شلوار جین عمده', 'شلوار جین عمده تک سایز در رنگ های متفاوت. کیفیت بالا', 600000, 10000, '2025051833-pexels-wb2008-2129970.jpg', 10, '');

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
