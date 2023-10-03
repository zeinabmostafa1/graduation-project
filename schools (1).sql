-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2023 at 11:38 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schools`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `is_status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `email`, `password`, `is_status`) VALUES
(1, '1', '1', '1', '1', 1),
(2, 'admin', 'admin', 'admin@admin.com', '1', 1),
(3, 'david', 'davidmonir7', 'david@gmail.com', 'password', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categ`
--

CREATE TABLE `categ` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `img` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `categ`
--

INSERT INTO `categ` (`id`, `user_id`, `name`, `img`, `created_at`) VALUES
(36, 3, 'Pens and pencils', '648af132051c47.64166982.jpg', '2023-06-15 11:08:34'),
(37, 3, 'notebooks and books', '648af147873188.60918365.jpg', '2023-06-15 11:08:55'),
(38, 3, 'senitzers', '648af159d62b21.50254792.jpg', '2023-06-15 11:09:13'),
(39, 3, 'others', '648af1670b8fb9.65611696.jpg', '2023-06-15 11:09:27');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(50) NOT NULL,
  `total_amount` double NOT NULL,
  `address` varchar(250) NOT NULL,
  `total_products` int(50) NOT NULL,
  `total_quantity` int(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `total_amount`, `address`, `total_products`, `total_quantity`, `created_at`) VALUES
(4, 1, 100, ' dasdsa', 1, 1, '2023-06-22 14:01:04'),
(5, 1, 30, ' dasdsa', 1, 2, '2023-06-22 14:36:13'),
(6, 3, 4260, ' 12kmcd', 14, 25, '2023-06-22 19:32:39');

-- --------------------------------------------------------

--
-- Table structure for table `orders_messages`
--

CREATE TABLE `orders_messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `message` varchar(500) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `admin_reply` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `admin_reply_updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `orders_messages`
--

INSERT INTO `orders_messages` (`id`, `user_id`, `order_id`, `message`, `admin_id`, `admin_reply`, `created_at`, `admin_reply_updated_at`) VALUES
(1, 1, 4, 'hi\r\n', 1, 'hi', '2023-06-22 14:49:43', '2023-06-22 14:50:18'),
(2, 1, 4, 'hjh', NULL, NULL, '2023-06-22 14:53:19', NULL),
(3, 3, 6, 'hi', NULL, NULL, '2023-06-22 19:38:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(50) NOT NULL,
  `product_id` int(50) NOT NULL,
  `quantity` int(50) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 4, 90, 1, 100),
(2, 5, 4, 2, 15),
(3, 6, 2, 4, 130),
(4, 6, 5, 1, 10),
(5, 6, 8, 1, 40),
(6, 6, 11, 1, 70),
(7, 6, 14, 1, 80),
(8, 6, 22, 2, 350),
(9, 6, 23, 2, 400),
(10, 6, 29, 1, 250),
(11, 6, 33, 1, 80),
(12, 6, 35, 2, 60),
(13, 6, 38, 3, 100),
(14, 6, 41, 3, 100),
(15, 6, 47, 1, 90),
(16, 6, 26, 2, 450);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `img` varchar(250) NOT NULL,
  `price` double NOT NULL,
  `school_id` int(11) NOT NULL,
  `quality_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `img`, `price`, `school_id`, `quality_id`, `created_at`) VALUES
(1, 'grade 1', '64943245c90af1.31491005.jpg', 5350, 6, 1, '2023-06-17 10:11:06'),
(2, 'grade 1', '64945389ec9364.20368689.jpg', 4500, 6, 2, '2023-06-17 10:11:38'),
(3, 'grade 1', '64949749ede7a2.46568658.jpg', 3520, 6, 3, '2023-06-17 10:11:53'),
(4, 'grade 2 high', '649497ca25e880.82630172.png', 4410, 6, 1, '2023-06-17 12:03:55'),
(5, 'grade 2 mediam', '648da13e3fb7d5.15827249.png', 3935, 6, 2, '2023-06-17 12:04:14'),
(6, 'grade 2 low', '648da1518da282.93618576.png', 3350, 6, 3, '2023-06-17 12:04:33'),
(7, 'grade 3 high', '649498114ac458.99606871.png', 5504, 6, 1, '2023-06-21 11:12:11'),
(8, 'grade 3 mediam', '6494a2533974f8.26778689.png', 5024, 6, 2, '2023-06-21 11:12:24'),
(9, 'grade 3 economic', '6494a27465b283.77727181.png', 4170, 6, 3, '2023-06-21 11:13:11'),
(10, 'grade 4 high', '6494a2f77dfbb0.53665468.png', 5200, 6, 1, '2023-06-21 19:06:01'),
(11, 'grade 4 mediam', '6494a315e52324.07973640.png', 3960, 6, 2, '2023-06-21 19:06:32'),
(12, 'grade 4 economic', '6494a44215ed24.63420969.png', 2910, 6, 3, '2023-06-21 19:07:04'),
(13, 'Grade 5 - high quality', '64937acfa11358.34096008.png', 4561, 6, 1, '2023-06-21 22:33:51'),
(14, 'Grade 5 - medium quality', '64937ae70b32d8.07569996.png', 4419, 6, 2, '2023-06-21 22:34:15'),
(15, 'Grade 5 - economic quality', '64937af732b162.18079536.png', 4075, 6, 3, '2023-06-21 22:34:31'),
(16, 'grade 6 - high quality', '64937b0bb508f0.30688952.png', 0, 6, 1, '2023-06-21 22:34:51'),
(17, 'grade 6 - medium quality', '64937b1a22bed1.52725487.png', 0, 6, 2, '2023-06-21 22:35:06'),
(18, 'grade 6 - economic quality', '64937b37433a39.31955975.png', 0, 6, 3, '2023-06-21 22:35:35');

-- --------------------------------------------------------

--
-- Table structure for table `package_details`
--

CREATE TABLE `package_details` (
  `id` int(11) NOT NULL,
  `packge_id` int(50) NOT NULL,
  `product_id` int(50) NOT NULL,
  `price` int(50) NOT NULL,
  `quantity` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `package_details`
--

INSERT INTO `package_details` (`id`, `packge_id`, `product_id`, `price`, `quantity`, `user_id`, `created_at`) VALUES
(2, 1, 4, 15, 1, 3, '2023-06-17 11:01:25'),
(3, 1, 7, 55, 1, 3, '2023-06-17 11:02:07'),
(4, 1, 13, 80, 1, 3, '2023-06-17 11:09:58'),
(5, 1, 24, 400, 2, 3, '2023-06-17 11:19:13'),
(6, 1, 25, 450, 2, 3, '2023-06-17 11:19:14'),
(7, 1, 28, 550, 2, 3, '2023-06-17 11:21:46'),
(8, 1, 29, 250, 1, 3, '2023-06-17 11:22:43'),
(9, 1, 31, 100, 1, 3, '2023-06-17 11:24:34'),
(10, 1, 34, 80, 2, 3, '2023-06-17 11:26:59'),
(11, 1, 37, 120, 3, 3, '2023-06-17 11:28:33'),
(12, 1, 40, 120, 3, 3, '2023-06-17 11:30:40'),
(13, 1, 43, 100, 2, 3, '2023-06-17 11:32:18'),
(14, 1, 46, 130, 1, 3, '2023-06-17 11:34:16'),
(15, 1, 10, 90, 1, 3, '2023-06-17 11:43:43'),
(16, 1, 1, 180, 4, 3, '2023-06-17 11:45:51'),
(17, 2, 2, 130, 4, 3, '2023-06-17 11:47:55'),
(18, 2, 5, 10, 1, 3, '2023-06-17 11:47:55'),
(19, 2, 8, 40, 1, 3, '2023-06-17 11:47:55'),
(20, 2, 11, 70, 1, 3, '2023-06-17 11:47:55'),
(21, 2, 14, 80, 1, 3, '2023-06-17 11:47:55'),
(22, 2, 22, 350, 2, 3, '2023-06-17 11:48:45'),
(23, 2, 23, 400, 2, 3, '2023-06-17 11:48:45'),
(24, 2, 29, 250, 1, 3, '2023-06-17 11:52:33'),
(25, 2, 33, 80, 1, 3, '2023-06-17 11:53:01'),
(26, 2, 35, 60, 2, 3, '2023-06-17 11:53:21'),
(27, 2, 38, 100, 3, 3, '2023-06-17 11:53:43'),
(28, 2, 41, 100, 3, 3, '2023-06-17 11:54:08'),
(29, 2, 44, 80, 3, 3, '2023-06-17 11:54:35'),
(30, 2, 47, 90, 1, 3, '2023-06-17 11:54:59'),
(31, 2, 26, 450, 2, 3, '2023-06-17 11:56:21'),
(32, 3, 3, 100, 4, 3, '2023-06-17 11:57:15'),
(33, 3, 6, 5, 1, 3, '2023-06-17 11:57:15'),
(34, 3, 9, 25, 1, 3, '2023-06-17 11:57:15'),
(35, 3, 12, 50, 1, 3, '2023-06-17 11:57:15'),
(36, 3, 16, 80, 1, 3, '2023-06-17 11:57:15'),
(37, 3, 20, 300, 2, 3, '2023-06-17 11:58:10'),
(38, 3, 21, 400, 2, 3, '2023-06-17 11:58:12'),
(39, 3, 27, 400, 1, 3, '2023-06-17 11:58:26'),
(40, 3, 29, 250, 1, 3, '2023-06-17 11:59:09'),
(41, 3, 94, 100, 1, 3, '2023-06-17 11:59:10'),
(42, 3, 39, 80, 3, 3, '2023-06-17 11:59:59'),
(43, 3, 32, 60, 1, 3, '2023-06-17 12:00:10'),
(44, 3, 36, 40, 2, 3, '2023-06-17 12:00:29'),
(45, 3, 42, 70, 3, 3, '2023-06-17 12:00:51'),
(46, 3, 45, 50, 3, 3, '2023-06-17 12:01:17'),
(47, 3, 48, 70, 1, 3, '2023-06-17 12:01:42'),
(48, 4, 75, 50, 12, 3, '2023-06-17 12:06:02'),
(49, 4, 7, 55, 4, 3, '2023-06-17 12:06:44'),
(50, 4, 50, 200, 2, 3, '2023-06-17 12:09:17'),
(51, 4, 111, 200, 1, 3, '2023-06-17 12:09:17'),
(52, 4, 53, 70, 1, 3, '2023-06-17 12:10:11'),
(53, 4, 13, 80, 1, 3, '2023-06-17 12:10:53'),
(54, 4, 14, 80, 1, 3, '2023-06-17 12:10:54'),
(55, 4, 16, 80, 1, 3, '2023-06-17 12:10:54'),
(56, 4, 17, 80, 1, 3, '2023-06-17 12:10:54'),
(57, 4, 57, 500, 2, 3, '2023-06-17 12:11:26'),
(58, 4, 37, 120, 1, 3, '2023-06-17 12:13:13'),
(59, 4, 28, 550, 2, 3, '2023-06-17 12:13:32'),
(60, 4, 31, 100, 1, 3, '2023-06-17 12:13:46'),
(61, 4, 58, 110, 1, 3, '2023-06-17 12:14:26'),
(62, 4, 40, 120, 3, 3, '2023-06-17 12:14:44'),
(63, 4, 43, 100, 1, 3, '2023-06-17 12:15:23'),
(64, 4, 46, 130, 1, 3, '2023-06-17 12:16:24'),
(65, 5, 76, 35, 12, 3, '2023-06-17 12:19:08'),
(66, 5, 8, 40, 4, 3, '2023-06-17 12:19:36'),
(67, 5, 51, 150, 1, 3, '2023-06-17 12:20:20'),
(68, 5, 109, 150, 2, 3, '2023-06-17 12:20:20'),
(69, 5, 54, 60, 1, 3, '2023-06-17 12:20:44'),
(70, 5, 13, 80, 1, 3, '2023-06-17 12:21:02'),
(71, 5, 14, 80, 1, 3, '2023-06-17 12:21:25'),
(72, 5, 16, 80, 1, 3, '2023-06-17 12:21:26'),
(73, 5, 17, 80, 1, 3, '2023-06-17 12:21:26'),
(74, 5, 26, 450, 2, 3, '2023-06-17 12:22:03'),
(75, 5, 55, 450, 2, 3, '2023-06-17 12:22:03'),
(76, 5, 33, 80, 1, 3, '2023-06-17 12:22:41'),
(77, 5, 38, 100, 1, 3, '2023-06-17 12:23:06'),
(78, 5, 59, 75, 1, 3, '2023-06-17 12:23:27'),
(79, 5, 41, 100, 3, 3, '2023-06-17 12:23:46'),
(80, 5, 44, 80, 1, 3, '2023-06-17 12:24:03'),
(81, 5, 47, 90, 1, 3, '2023-06-17 12:24:22'),
(82, 6, 77, 30, 12, 3, '2023-06-17 12:24:53'),
(83, 6, 9, 25, 4, 3, '2023-06-17 12:25:27'),
(84, 6, 13, 80, 1, 3, '2023-06-17 12:25:27'),
(85, 6, 14, 80, 1, 3, '2023-06-17 12:25:27'),
(86, 6, 16, 80, 1, 3, '2023-06-17 12:25:27'),
(87, 6, 17, 80, 1, 3, '2023-06-17 12:25:27'),
(88, 6, 49, 100, 1, 3, '2023-06-17 12:25:48'),
(89, 6, 113, 100, 2, 3, '2023-06-17 12:25:48'),
(90, 6, 52, 50, 1, 3, '2023-06-17 12:26:54'),
(91, 6, 56, 450, 2, 3, '2023-06-17 12:28:02'),
(92, 6, 27, 400, 2, 3, '2023-06-17 12:28:12'),
(93, 6, 32, 60, 1, 3, '2023-06-17 12:28:31'),
(94, 6, 39, 80, 1, 3, '2023-06-17 12:28:57'),
(95, 6, 42, 70, 3, 3, '2023-06-17 12:29:09'),
(96, 6, 60, 50, 1, 3, '2023-06-17 12:29:20'),
(97, 6, 45, 50, 1, 3, '2023-06-17 12:29:45'),
(98, 6, 48, 70, 1, 3, '2023-06-17 12:34:18'),
(99, 7, 1, 180, 2, 3, '2023-06-21 11:14:03'),
(100, 7, 61, 100, 1, 3, '2023-06-21 11:14:51'),
(101, 7, 13, 80, 1, 3, '2023-06-21 11:15:30'),
(102, 7, 14, 80, 1, 3, '2023-06-21 11:15:30'),
(103, 7, 15, 80, 1, 3, '2023-06-21 11:15:30'),
(104, 7, 16, 80, 1, 3, '2023-06-21 11:15:30'),
(105, 7, 17, 80, 1, 3, '2023-06-21 11:15:30'),
(106, 7, 18, 80, 1, 3, '2023-06-21 11:15:30'),
(107, 7, 64, 150, 2, 3, '2023-06-21 11:16:27'),
(108, 7, 70, 400, 1, 3, '2023-06-21 11:17:11'),
(110, 7, 57, 500, 1, 3, '2023-06-21 11:19:24'),
(111, 7, 31, 100, 1, 3, '2023-06-21 11:19:49'),
(112, 7, 10, 90, 4, 3, '2023-06-21 11:20:26'),
(113, 7, 28, 550, 1, 3, '2023-06-21 11:20:48'),
(114, 7, 67, 18, 3, 3, '2023-06-21 11:21:28'),
(115, 7, 34, 80, 2, 3, '2023-06-21 11:22:01'),
(116, 7, 84, 250, 1, 3, '2023-06-21 11:22:24'),
(117, 7, 43, 100, 1, 3, '2023-06-21 11:22:51'),
(118, 7, 40, 120, 2, 3, '2023-06-21 11:23:12'),
(119, 7, 37, 120, 1, 3, '2023-06-21 11:23:37'),
(120, 7, 96, 300, 1, 3, '2023-06-21 11:24:17'),
(121, 7, 46, 130, 1, 3, '2023-06-21 11:24:38'),
(122, 7, 50, 200, 1, 3, '2023-06-21 11:29:09'),
(123, 7, 101, 300, 1, 3, '2023-06-21 11:29:09'),
(124, 8, 2, 130, 2, 3, '2023-06-21 11:30:34'),
(125, 8, 11, 70, 4, 3, '2023-06-21 11:30:36'),
(126, 8, 13, 80, 1, 3, '2023-06-21 11:30:36'),
(127, 8, 14, 80, 1, 3, '2023-06-21 11:30:36'),
(128, 8, 15, 80, 1, 3, '2023-06-21 11:30:36'),
(129, 8, 16, 80, 1, 3, '2023-06-21 11:30:36'),
(130, 8, 17, 80, 1, 3, '2023-06-21 11:30:36'),
(131, 8, 18, 80, 1, 3, '2023-06-21 11:30:36'),
(132, 8, 62, 70, 1, 3, '2023-06-21 11:31:37'),
(133, 8, 65, 100, 2, 3, '2023-06-21 11:32:11'),
(134, 8, 71, 350, 1, 3, '2023-06-21 11:33:43'),
(135, 8, 55, 450, 2, 3, '2023-06-21 11:34:14'),
(136, 8, 32, 60, 1, 3, '2023-06-21 11:43:30'),
(137, 8, 26, 450, 2, 3, '2023-06-21 11:44:13'),
(138, 8, 35, 60, 2, 3, '2023-06-21 11:44:50'),
(139, 8, 67, 18, 3, 3, '2023-06-21 11:45:20'),
(140, 8, 85, 300, 1, 3, '2023-06-21 11:46:25'),
(141, 8, 41, 100, 2, 3, '2023-06-21 11:46:51'),
(142, 8, 44, 80, 1, 3, '2023-06-21 11:47:10'),
(143, 8, 38, 100, 1, 3, '2023-06-21 11:47:41'),
(144, 8, 51, 150, 1, 3, '2023-06-21 11:49:49'),
(145, 8, 109, 150, 1, 3, '2023-06-21 11:49:49'),
(146, 8, 97, 280, 1, 3, '2023-06-21 11:50:09'),
(147, 8, 47, 90, 1, 3, '2023-06-21 11:50:27'),
(148, 9, 3, 100, 2, 3, '2023-06-21 18:53:51'),
(149, 9, 63, 50, 1, 3, '2023-06-21 18:55:05'),
(150, 9, 12, 50, 4, 3, '2023-06-21 18:56:08'),
(151, 9, 13, 80, 1, 3, '2023-06-21 18:56:10'),
(152, 9, 14, 80, 1, 3, '2023-06-21 18:56:10'),
(153, 9, 15, 80, 1, 3, '2023-06-21 18:56:10'),
(154, 9, 16, 80, 1, 3, '2023-06-21 18:56:10'),
(155, 9, 17, 80, 1, 3, '2023-06-21 18:56:10'),
(156, 9, 18, 80, 1, 3, '2023-06-21 18:56:10'),
(157, 9, 56, 450, 2, 3, '2023-06-21 18:56:23'),
(158, 9, 27, 400, 2, 3, '2023-06-21 18:56:48'),
(159, 9, 66, 70, 2, 3, '2023-06-21 18:57:19'),
(160, 9, 72, 300, 1, 3, '2023-06-21 18:58:58'),
(161, 9, 33, 80, 1, 3, '2023-06-21 18:59:23'),
(162, 9, 36, 40, 2, 3, '2023-06-21 19:00:01'),
(163, 9, 69, 10, 3, 3, '2023-06-21 19:00:25'),
(164, 9, 86, 200, 1, 3, '2023-06-21 19:01:04'),
(165, 9, 49, 100, 1, 3, '2023-06-21 19:01:33'),
(166, 9, 113, 100, 1, 3, '2023-06-21 19:01:33'),
(167, 9, 42, 70, 2, 3, '2023-06-21 19:01:58'),
(168, 9, 45, 50, 1, 3, '2023-06-21 19:02:34'),
(169, 9, 98, 250, 1, 3, '2023-06-21 19:03:02'),
(170, 9, 48, 70, 1, 3, '2023-06-21 19:03:20'),
(171, 10, 70, 400, 1, 3, '2023-06-21 19:10:47'),
(172, 10, 73, 400, 1, 3, '2023-06-21 19:10:47'),
(173, 10, 1, 180, 3, 3, '2023-06-21 19:13:27'),
(174, 10, 4, 15, 4, 3, '2023-06-21 19:13:27'),
(175, 10, 13, 80, 1, 3, '2023-06-21 19:13:27'),
(176, 10, 14, 80, 1, 3, '2023-06-21 19:13:27'),
(177, 10, 64, 150, 1, 3, '2023-06-21 19:14:24'),
(178, 10, 78, 400, 2, 3, '2023-06-21 19:15:07'),
(179, 10, 57, 500, 1, 3, '2023-06-21 19:16:04'),
(180, 10, 31, 100, 1, 3, '2023-06-21 19:16:37'),
(181, 10, 28, 550, 1, 3, '2023-06-21 19:17:18'),
(182, 10, 81, 100, 3, 3, '2023-06-21 19:18:29'),
(183, 10, 85, 300, 1, 3, '2023-06-21 19:19:08'),
(184, 10, 34, 80, 2, 3, '2023-06-21 19:19:51'),
(185, 10, 87, 100, 2, 3, '2023-06-21 19:21:16'),
(186, 10, 90, 100, 2, 3, '2023-06-21 19:21:17'),
(187, 10, 93, 150, 1, 3, '2023-06-21 19:21:58'),
(188, 10, 40, 120, 1, 3, '2023-06-21 19:22:33'),
(189, 10, 58, 110, 1, 3, '2023-06-21 19:26:45'),
(190, 11, 2, 130, 3, 3, '2023-06-21 19:29:08'),
(191, 11, 5, 10, 4, 3, '2023-06-21 19:29:08'),
(192, 11, 13, 80, 1, 3, '2023-06-21 19:29:08'),
(193, 11, 14, 80, 1, 3, '2023-06-21 19:29:09'),
(194, 11, 71, 350, 1, 3, '2023-06-21 19:29:33'),
(195, 11, 74, 350, 1, 3, '2023-06-21 19:29:33'),
(196, 11, 78, 400, 2, 3, '2023-06-21 19:30:38'),
(197, 11, 56, 450, 1, 3, '2023-06-21 19:31:15'),
(198, 11, 32, 60, 1, 3, '2023-06-21 19:32:01'),
(199, 11, 26, 450, 1, 3, '2023-06-21 19:32:35'),
(200, 11, 82, 80, 3, 3, '2023-06-21 19:33:05'),
(201, 11, 88, 80, 2, 3, '2023-06-21 19:33:46'),
(202, 11, 91, 80, 2, 3, '2023-06-21 19:33:46'),
(203, 11, 84, 250, 1, 3, '2023-06-21 19:34:11'),
(204, 11, 65, 100, 1, 3, '2023-06-21 19:35:02'),
(205, 12, 74, 350, 1, 3, '2023-06-21 20:24:32'),
(206, 12, 3, 100, 3, 3, '2023-06-21 20:27:14'),
(207, 12, 6, 5, 4, 3, '2023-06-21 21:24:31'),
(208, 12, 13, 80, 1, 3, '2023-06-21 21:24:31'),
(209, 12, 14, 80, 1, 3, '2023-06-21 21:24:31'),
(210, 12, 52, 50, 2, 3, '2023-06-21 21:28:45'),
(211, 12, 66, 70, 1, 3, '2023-06-21 22:05:55'),
(212, 12, 120, 90, 1, 3, '2023-06-21 22:06:54'),
(213, 12, 28, 550, 1, 3, '2023-06-21 22:07:11'),
(214, 12, 81, 100, 3, 3, '2023-06-21 22:07:33'),
(215, 12, 86, 200, 1, 3, '2023-06-21 22:08:01'),
(216, 12, 36, 40, 2, 3, '2023-06-21 22:08:39'),
(217, 12, 69, 10, 1, 3, '2023-06-21 22:10:23'),
(218, 12, 89, 70, 1, 3, '2023-06-21 22:10:23'),
(219, 12, 92, 70, 1, 3, '2023-06-21 22:10:23'),
(220, 12, 29, 250, 1, 3, '2023-06-21 22:11:41'),
(221, 12, 42, 70, 2, 3, '2023-06-21 22:12:21'),
(222, 12, 45, 50, 1, 3, '2023-06-21 22:12:46'),
(223, 12, 60, 50, 2, 3, '2023-06-21 22:13:14'),
(242, 14, 75, 50, 10, 3, '2023-06-21 23:36:46'),
(243, 14, 62, 70, 1, 3, '2023-06-21 23:39:55'),
(244, 14, 16, 80, 1, 3, '2023-06-21 23:41:45'),
(245, 14, 18, 80, 1, 3, '2023-06-21 23:41:45'),
(246, 14, 115, 550, 1, 3, '2023-06-21 23:42:11'),
(247, 14, 119, 550, 1, 3, '2023-06-21 23:42:40'),
(248, 14, 120, 90, 1, 3, '2023-06-21 23:43:05'),
(249, 14, 7, 55, 3, 3, '2023-06-21 23:43:15'),
(250, 14, 55, 450, 1, 3, '2023-06-21 23:43:48'),
(251, 14, 84, 250, 2, 3, '2023-06-21 23:44:12'),
(252, 14, 68, 12, 2, 3, '2023-06-21 23:44:26'),
(253, 14, 123, 150, 2, 3, '2023-06-21 23:44:41'),
(254, 14, 41, 100, 3, 3, '2023-06-21 23:45:06'),
(255, 14, 44, 80, 1, 3, '2023-06-21 23:46:29'),
(256, 14, 39, 80, 1, 3, '2023-06-21 23:46:59'),
(257, 15, 112, 100, 3, 3, '2023-06-21 23:58:51'),
(258, 15, 75, 50, 10, 3, '2023-06-21 23:59:11'),
(259, 15, 63, 50, 1, 3, '2023-06-21 23:59:28'),
(260, 15, 14, 80, 1, 3, '2023-06-21 23:59:57'),
(261, 15, 16, 80, 1, 3, '2023-06-21 23:59:57'),
(262, 15, 116, 500, 1, 3, '2023-06-22 00:00:13'),
(263, 15, 118, 500, 1, 3, '2023-06-22 00:00:56'),
(264, 15, 120, 90, 1, 3, '2023-06-22 00:01:15'),
(265, 15, 7, 55, 3, 3, '2023-06-22 00:01:29'),
(266, 15, 26, 450, 1, 3, '2023-06-22 00:01:48'),
(267, 15, 86, 200, 2, 3, '2023-06-22 00:02:05'),
(268, 15, 69, 10, 2, 3, '2023-06-22 00:02:25'),
(269, 15, 123, 150, 2, 3, '2023-06-22 00:02:38'),
(270, 15, 42, 70, 3, 3, '2023-06-22 00:02:56'),
(271, 15, 45, 50, 1, 3, '2023-06-22 00:03:14'),
(272, 15, 39, 80, 1, 3, '2023-06-22 00:03:30'),
(273, 15, 96, 300, 1, 3, '2023-06-22 00:03:48'),
(274, 14, 96, 300, 2, 3, '2023-06-22 00:05:04'),
(275, 13, 50, 200, 3, 3, '2023-06-22 00:13:32'),
(276, 13, 75, 50, 10, 3, '2023-06-22 00:15:06'),
(277, 13, 61, 100, 1, 3, '2023-06-22 00:15:31'),
(278, 13, 13, 80, 1, 3, '2023-06-22 00:16:28'),
(279, 13, 14, 80, 1, 3, '2023-06-22 00:16:28'),
(280, 13, 114, 600, 1, 3, '2023-06-22 00:16:50'),
(281, 13, 117, 600, 1, 3, '2023-06-22 00:17:06'),
(282, 13, 120, 90, 1, 3, '2023-06-22 00:17:21'),
(283, 13, 7, 55, 3, 3, '2023-06-22 00:17:46'),
(284, 13, 26, 450, 1, 3, '2023-06-22 00:18:03'),
(285, 13, 85, 300, 2, 3, '2023-06-22 00:18:30'),
(286, 13, 67, 18, 2, 3, '2023-06-22 00:18:44'),
(287, 13, 123, 150, 2, 3, '2023-06-22 00:18:55'),
(288, 13, 40, 120, 3, 3, '2023-06-22 00:19:11');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `categ_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(25) NOT NULL,
  `IMG` varchar(500) NOT NULL,
  `quantity` int(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `categ_id`, `name`, `price`, `IMG`, `quantity`, `created_at`) VALUES
(1, 3, 36, 'Boxes of 12 pencils (Ticonderoga Brand) (Pre sharpened)', 100, '648af4ed7b6252.44924303.jpg', 100, '2023-06-15 11:24:29'),
(2, 3, 36, 'Boxes of 12 pencils (faber casteel) (Pre sharpened)', 130, '649495edbc1827.05092808.jpg', 96, '2023-06-15 11:25:27'),
(3, 3, 36, 'Boxes of 12 pencils (STAEDTLER) (Pre sharpened)', 100, '648af54a347382.23517761.jpeg', 100, '2023-06-15 11:26:02'),
(4, 3, 36, 'Red Click pen roto', 15, '648af5981d8f05.27994025.jpg', 98, '2023-06-15 11:27:20'),
(5, 3, 36, 'red click pen senator', 10, '648af5c1536f95.26909583.jpg', 99, '2023-06-15 11:28:01'),
(6, 3, 36, 'Red Click pens ezee', 5, '648af5e6b416a5.61484672.png', 100, '2023-06-15 11:28:38'),
(7, 3, 39, 'Elmer’s 4 oz. Glue ', 55, '6494935021ac32.54231634.jpg', 100, '2023-06-15 11:29:23'),
(8, 3, 39, 'Deli Stick up 4 oz.Glue', 40, '648af642d89f61.50596241.jpg', 99, '2023-06-15 11:30:10'),
(9, 3, 39, 'zjd oz. Glue', 25, '648af668d21c34.84044647.jpeg', 100, '2023-06-15 11:30:48'),
(10, 3, 39, 'White Glue Stick (deli)', 90, '64948c81a59643.92704497.jpg', 100, '2023-06-15 11:32:24'),
(11, 3, 39, 'White Glue Stick (elmer\'s)', 70, '648af6ebbba532.85071882.jpg', 99, '2023-06-15 11:32:59'),
(12, 3, 39, 'White Glue Stick (fevi)', 50, '648af7093f0e74.82158657.jpg', 100, '2023-06-15 11:33:29'),
(13, 3, 39, 'Plastic Pocket Folders with brads blue', 80, '648afc0faa7f63.00932243.jpg', 100, '2023-06-15 11:54:55'),
(14, 3, 39, 'Plastic Pocket Folders with brads red', 80, '648afc28a078f8.13261731.jpg', 99, '2023-06-15 11:55:20'),
(15, 3, 39, 'Plastic Pocket Folders with brads purple', 80, '649494156c4643.86515014.jpg', 100, '2023-06-15 11:56:08'),
(16, 3, 39, 'Plastic Pocket Folders with brads yellow', 80, '648afc7b7978f0.03940578.jpg', 100, '2023-06-15 11:56:43'),
(17, 3, 39, 'Plastic Pocket Folders with brads orange', 80, '649492426d9752.49157138.jpg', 100, '2023-06-15 11:58:04'),
(18, 3, 39, 'Plastic Pocket Folders with brads black', 80, '648afd0598e305.86471906.jpg', 100, '2023-06-15 11:59:01'),
(19, 3, 39, 'Plastic Pocket Folder', 50, '648afd2f997199.80767610.jpg', 100, '2023-06-15 11:59:43'),
(20, 3, 36, 'faber castell colors 8 packs', 300, '648b048849d1b4.23168316.jpg', 100, '2023-06-15 12:31:04'),
(21, 3, 36, 'faber castell colors 16 packs', 400, '648b04e5c26e12.26873020.jpg', 100, '2023-06-15 12:32:37'),
(22, 3, 36, 'Crayola colors 8 packs', 350, '64946b25dfee52.73937553.jpg', 98, '2023-06-15 12:33:28'),
(23, 3, 36, 'Crayola colors 16 packs', 400, '648b053b7a1288.01113853.png', 98, '2023-06-15 12:34:03'),
(24, 3, 36, 'deli colors 8 packs', 400, '648b0576c604f9.03899270.png', 100, '2023-06-15 12:35:02'),
(25, 3, 36, 'deli colors 16 packs', 450, '648b059bc8b7d9.08010052.jpg', 100, '2023-06-15 12:35:39'),
(26, 3, 36, 'Crayola Washable Markers (10 count)', 450, '648b05d61b14e2.35163856.jpg', 98, '2023-06-15 12:36:38'),
(27, 3, 36, 'faber castell Washable Markers (10 count)', 400, '648b05f9bfd680.84129665.jpg', 100, '2023-06-15 12:37:13'),
(28, 3, 36, 'Deli Washable Markers (10 count)', 550, '648b061b50cdc3.90665163.jpg', 100, '2023-06-15 12:37:47'),
(29, 3, 36, 'Expo Low Odor Dry Erase Markers Fine Tip Black (4 count)', 250, '648b081ed5baa4.20282280.jpg', 99, '2023-06-15 12:46:22'),
(30, 3, 36, 'Expo Low Odor Dry Erase Markers Fine Tip Black (12 count)', 500, '648b084e18ec59.87004190.jpg', 100, '2023-06-15 12:47:10'),
(31, 3, 39, 'Fiskars Scissors 5 in. with BLUNT edge', 100, '648b0875e5cb98.39454497.jpg', 100, '2023-06-15 12:47:49'),
(32, 3, 39, 'Faber castell Scissors 5 in. with BLUNT edge', 60, '648b089f61ccc9.40696289.jpg', 100, '2023-06-15 12:48:31'),
(33, 3, 39, 'Deli Scissors 5 in. with BLUNT edge', 80, '648b08f61e3860.83441384.jpg', 99, '2023-06-15 12:49:58'),
(34, 3, 39, 'Papermate -Pink Pearl Large Erasers', 80, '649492bfc92c89.95931483.jpg', 100, '2023-06-15 12:50:34'),
(35, 3, 39, 'Faber castell Large Erasers', 60, '648b093bd297f4.80165346.jpg', 98, '2023-06-15 12:51:07'),
(36, 3, 39, 'Jumbo Large Erasers', 40, '648b096217a667.00151208.jpg', 100, '2023-06-15 12:51:46'),
(37, 3, 38, 'Containers of Baby Wipes  100wipes', 120, '648b099c822fd3.80599730.jpg', 100, '2023-06-15 12:52:44'),
(38, 3, 38, 'Containers of Baby Wipes  80 wipes', 100, '64946cae93c205.92297677.jpg', 97, '2023-06-15 12:53:49'),
(39, 3, 38, 'Containers of Baby Wipes 64 wipes', 80, '648b09f5c8da52.53914892.jpg', 100, '2023-06-15 12:54:13'),
(40, 3, 38, 'LARGE Boxes of kleenex 160 pieces', 120, '648b0a39e23297.66697661.jpg', 100, '2023-06-15 12:55:21'),
(41, 3, 38, 'LARGE Boxes of kleenex fine 160 pieces', 100, '648b0a5e706f54.40517995.jpg', 97, '2023-06-15 12:55:58'),
(42, 3, 38, 'LARGE  Boxes of Kleenex carmen 160 pieces', 70, '648b0a7f405a87.93548749.jpg', 100, '2023-06-15 12:56:31'),
(43, 3, 38, 'Large Rolls of Paper Towels (Bounty brand)', 100, '648b91aa6f6911.34524160.jpg', 100, '2023-06-15 22:33:14'),
(45, 3, 38, 'Large Rolls of Paper Towels (sparkle brand)', 50, '648b928e9151b2.94669510.png', 100, '2023-06-15 22:37:02'),
(46, 3, 39, 'Box of Band-Aid Bandages 50 pieces', 130, '648b934182d2c5.19725671.jpg', 100, '2023-06-15 22:40:01'),
(47, 3, 39, 'Box of Bandages 50 pieces curad', 90, '648b9417b13894.24961291.jpg', 99, '2023-06-15 22:43:35'),
(48, 3, 39, 'Box of Bandages 50 pieces leader', 70, '648b94381c9833.78440533.jpg', 100, '2023-06-15 22:44:08'),
(49, 3, 37, 'Spiral Notebooks (70 pages) scholar green', 100, '648b94dd7c2169.58752489.jpg', 100, '2023-06-15 22:46:53'),
(50, 3, 37, 'Spiral Notebooks (70 pages) mead red', 200, '649493a0a88b27.01731573.jpg', 100, '2023-06-15 22:49:31'),
(51, 3, 37, 'Spiral Notebooks (70 pages) pen+ gear green', 150, '649468b1daf390.34833491.jpg', 100, '2023-06-15 22:50:25'),
(52, 3, 37, 'Black Marble Composition 200 scholar', 50, '648b976aee6418.65152918.jpg', 100, '2023-06-15 22:57:47'),
(53, 3, 37, 'Black Composition 200 pages mead', 70, '648b978b4ee0b4.62221714.jpg', 100, '2023-06-15 22:58:19'),
(54, 3, 37, 'Black Marble Composition 200 pages pen+gear', 60, '648b97b51c4883.27451902.jpeg', 100, '2023-06-15 22:59:01'),
(55, 3, 36, 'Crayola colors 24 pack', 450, '649490d5df4b78.91989943.jpg', 100, '2023-06-15 23:03:17'),
(56, 3, 36, 'faber castell colors 24 pack', 450, '648b98e26afbc0.36870207.jpg', 100, '2023-06-15 23:04:02'),
(57, 3, 36, 'deli colors 24 packs', 500, '648b9940e35593.36021438.png', 100, '2023-06-15 23:05:36'),
(58, 3, 38, '8 oz. Hand Sanitizer puranic', 110, '648b998f997cc8.21401399.jpg', 100, '2023-06-15 23:06:55'),
(59, 3, 38, '8 oz. Hand Sanitizer germ', 75, '648b99b5823bb9.46960054.jpg', 100, '2023-06-15 23:07:33'),
(60, 3, 38, '8 oz. Hand Sanitizer purell', 50, '64948d81418c34.00708709.jpg', 100, '2023-06-15 23:08:00'),
(61, 3, 36, '10-Pack of Red pens – No click style faber castell', 100, '648b9a2a1525e4.22777600.jpg', 100, '2023-06-15 23:09:30'),
(62, 3, 36, '10-Pack of Red pens – No click style retactable', 70, '648b9a51bec811.41421513.jpg', 100, '2023-06-15 23:10:09'),
(63, 3, 36, '10-Pack of Red pens – No click style tre mate', 50, '64947b43bb0379.70943491.jpg', 100, '2023-06-15 23:10:56'),
(64, 3, 37, 'Packs of Wide Ruled Loose Leaf 100 sheet', 150, '648b9b0c6b5962.46497748.jpg', 100, '2023-06-15 23:13:16'),
(65, 3, 37, 'Packs of Wide Ruled Loose Leaf 100 mead', 100, '648b9b3f2f9ad7.35224442.jpg', 100, '2023-06-15 23:14:07'),
(66, 3, 36, 'Packs of Wide Ruled Loose Leaf 100 Three Leaf', 70, '648b9b622501a0.56904675.jpeg', 100, '2023-06-15 23:14:42'),
(67, 3, 36, 'Yellow highlighters deli', 18, '64946e31aeab21.61698698.png', 100, '2023-06-15 23:16:55'),
(68, 3, 36, 'Yellow highlighters faber castell', 12, '648b9c0056a9a3.45527347.jpg', 100, '2023-06-15 23:17:20'),
(69, 3, 36, 'Yellow highlighters prima', 10, '648b9c1e5de077.62949405.jpg', 100, '2023-06-15 23:17:50'),
(70, 3, 37, 'Avery Binder three ring White', 400, '648b9c9fc28c97.82191988.jpg', 100, '2023-06-15 23:19:59'),
(71, 3, 37, 'wilson jones binder three ring white', 350, '648d792661b278.29361842.jpg', 100, '2023-06-17 09:13:10'),
(72, 3, 37, 'Premier binder three ring white', 300, '648d7954095905.67221933.jpg', 100, '2023-06-17 09:13:56'),
(73, 3, 37, 'Blue Avery Binder three ring with pockets', 400, '64948ed362a2e0.70884976.jpg', 100, '2023-06-17 09:14:46'),
(74, 3, 37, 'Blue Designders Binder three ring with pockets', 350, '648d79a4c96222.89348918.jpg', 100, '2023-06-17 09:15:16'),
(75, 3, 36, 'Pencils (Ticonderoga Brand – Pre-Sharpened', 50, '648d79fe5218c9.00277973.jpg', 100, '2023-06-17 09:16:46'),
(77, 3, 36, 'Pencils (STAEDTLER Brand) – Pre-Sharpened', 30, '648d7a353a50e8.49352395.jpg', 100, '2023-06-17 09:17:41'),
(78, 3, 37, 'Black Marble Journals', 400, '648d7a5431efd7.35362678.jpg', 100, '2023-06-17 09:18:12'),
(79, 3, 37, 'Black Marble (Mead) Journals ', 375, '648d7a95dbd3b6.16445493.jpg', 100, '2023-06-17 09:19:17'),
(80, 3, 37, 'Black Marble (Pen + Gear) Journals', 350, '648d7ab13187a0.59781083.jpeg', 100, '2023-06-17 09:19:45'),
(81, 3, 39, 'Scotch 3M brand Large Glue Sticks', 100, '648d7ae58abba6.86137821.jpg', 100, '2023-06-17 09:20:37'),
(82, 3, 39, 'Reynolds 3M brand Large Glue Sticks', 80, '648d7b027288b3.67704054.jpg', 100, '2023-06-17 09:21:06'),
(83, 3, 39, 'UHU 3M brand Large Glue Sticks.jpg', 70, '64948b8747fea6.11832146.jpg', 100, '2023-06-17 09:22:01'),
(84, 3, 37, 'Pack of index cards (ruled) 100-pack BAZIC', 250, '648d7b93472787.08022861.jpg', 100, '2023-06-17 09:23:31'),
(85, 3, 37, 'Pack of index cards (ruled) 100-pack mead', 300, '648d7bd28e09e9.82630449.jpg', 100, '2023-06-17 09:24:34'),
(86, 3, 37, 'Pack of index cards (ruled) 100-pack oxford', 200, '64948de9829635.82344021.jpg', 100, '2023-06-17 09:25:04'),
(87, 3, 36, 'pink highlighters deli', 100, '64949646b8a053.19203943.png', 100, '2023-06-17 09:26:00'),
(88, 3, 36, 'Pink highlighters faber castell', 80, '64946d3479c8a6.82940400.jpg', 100, '2023-06-17 09:26:27'),
(89, 3, 36, 'Pink highlighters prima', 70, '648d7c5a025c46.36763476.jpg', 100, '2023-06-17 09:26:50'),
(90, 3, 36, 'Green highlighters deli', 100, '64947bc5b84514.15879486.png', 99, '2023-06-17 09:27:12'),
(91, 3, 36, 'green highlighters faber castell', 80, '648d7c880e5f85.26908750.jpg', 100, '2023-06-17 09:27:36'),
(92, 3, 36, 'green highlighters prima', 70, '648d7c9ab1a207.07806763.jpg', 100, '2023-06-17 09:27:54'),
(93, 3, 36, 'Black Sharpie – Fine Tip', 150, '64948f372d6de6.74415575.jpg', 100, '2023-06-17 09:28:28'),
(94, 3, 36, 'Black EXPO – Fine Tip', 100, '648d7ccf0281c4.74921313.jpg', 100, '2023-06-17 09:28:47'),
(95, 3, 36, 'Black Faber-Castell – Fine Tip', 80, '64949584be4d78.25281622.jpg', 100, '2023-06-17 09:29:09'),
(96, 3, 38, 'Box of Quart Sized Ziploc Bags ', 300, '648d7d5467a275.52156000.jpg', 100, '2023-06-17 09:31:00'),
(97, 3, 38, 'Box of Quart Sized Ziploc (GLAD) Bags ', 280, '648d7d846b7d81.67105503.jpeg', 100, '2023-06-17 09:31:48'),
(98, 3, 38, 'Box of Quart Sized Ziploc (Hefty) Bags ', 250, '648d7da0a334c0.51481485.jpg', 100, '2023-06-17 09:32:16'),
(99, 3, 37, 'Spiral Notebooks (100 pages) mead red', 300, '648d7e55618c16.32805309.jpg', 100, '2023-06-17 09:35:17'),
(100, 3, 37, 'Spiral Notebooks (100 pages) mead blue', 300, '648d7e8cd407a6.14262932.jpg', 100, '2023-06-17 09:36:12'),
(101, 3, 37, 'Spiral Notebooks (100 pages) mead green', 300, '648d7ea4840237.45990882.jpg', 100, '2023-06-17 09:36:36'),
(102, 3, 37, 'Spiral Notebooks (100 pages) pen+ gear blue', 250, '64948aad5c2fb0.14797390.jpg', 100, '2023-06-17 09:37:05'),
(103, 3, 37, 'Spiral Notebooks (100 pages) pen+ gear green', 250, '648d7ed95d9a30.92326680.jpg', 100, '2023-06-17 09:37:29'),
(104, 3, 37, 'Spiral Notebooks (100 pages) pen+ gear red', 250, '649490243ecfc5.00262215.jpg', 100, '2023-06-17 09:37:57'),
(105, 3, 37, 'Spiral Notebooks (100 pages) scholar blue', 200, '648d7f0ca26db0.52998301.jpg', 100, '2023-06-17 09:38:20'),
(106, 3, 37, 'Spiral Notebooks (100 pages) scholar green', 200, '648d7f287ca3b1.19938218.jpg', 100, '2023-06-17 09:38:48'),
(107, 3, 37, 'Spiral Notebooks (100 pages) scholar red', 200, '648d7f3e3fdaf5.86172484.jpg', 100, '2023-06-17 09:39:10'),
(108, 3, 37, 'Spiral Notebooks (70 pages) pen+ gear blue', 150, '648d7f7ca209a2.25989070.jpg', 100, '2023-06-17 09:40:12'),
(109, 3, 37, 'Spiral Notebooks (70 pages) pen+ gear red', 150, '648d7f9d815883.97450442.png', 100, '2023-06-17 09:40:45'),
(110, 3, 37, 'Spiral Notebooks (70 pages) mead blue', 200, '648d7fb52f8fd3.23677405.jpg', 100, '2023-06-17 09:41:09'),
(111, 3, 37, 'Spiral Notebooks (70 pages) mead green', 200, '648d7fd04816d4.81950846.jpeg', 100, '2023-06-17 09:41:36'),
(112, 3, 37, 'Spiral Notebooks (70 pages) scholar blue', 100, '648d7fe5deb713.29416619.jpg', 100, '2023-06-17 09:41:57'),
(113, 3, 37, 'Spiral Notebooks (70 pages) scholar red', 100, '648d8001789748.40001698.jpg', 100, '2023-06-17 09:42:25'),
(114, 3, 37, '10 pocket or larger Nylon expandable folder mead', 600, '648d80365fb0b2.50107857.jpg', 100, '2023-06-17 09:43:18'),
(115, 3, 37, '10 pocket or larger Nylon expandable folder pen+ gear', 550, '648d806063a711.97754421.jpg', 100, '2023-06-17 09:44:00'),
(116, 3, 36, '10 pocket or larger Nylon expandable folder (any color) avery ', 500, '64948cf4e27468.92484403.jpg', 100, '2023-06-17 09:55:38'),
(117, 3, 36, '24 Pack erasable colored pencils deli', 600, '6494918273a2c6.23538568.jpg', 100, '2023-06-17 09:56:17'),
(118, 3, 36, '24 Pack erasable colored pencils faber castell', 500, '648d8360646a17.87185897.jpg', 100, '2023-06-17 09:56:48'),
(119, 3, 36, '24 Pack erasable colored pencils crayola', 550, '648d8382310d68.19641262.jpg', 100, '2023-06-17 09:57:22'),
(120, 3, 39, 'Fiskar’s 7 in. or larger Scissors (sharp edge)', 90, '648d83bae21798.18991211.jpg', 100, '2023-06-17 09:58:18'),
(122, 3, 39, 'deli 7 in. or larger Scissors (sharp edge)', 100, '648d83f298a5b7.13957427.jpg', 100, '2023-06-17 09:59:14'),
(123, 3, 36, 'Sharpie Fine Point Markers', 150, '648d8459297fb4.88253362.jpg', 100, '2023-06-17 10:00:57'),
(124, 3, 36, 'Deli Fine Point Markers', 200, '648d8459297fb4.88253362.jpg', 100, '2023-06-17 10:01:32'),
(125, 3, 36, 'Faber castell Fine Point Markers', 100, '648d84934ab543.77373434.jpg', 100, '2023-06-17 10:01:55');

-- --------------------------------------------------------

--
-- Table structure for table `quality`
--

CREATE TABLE `quality` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `quality`
--

INSERT INTO `quality` (`id`, `name`) VALUES
(1, 'High quality'),
(2, 'Medium quality'),
(3, 'Economic quality');

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `descrption` varchar(250) NOT NULL,
  `img` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `name`, `descrption`, `img`, `created_at`) VALUES
(6, 'st.fatima', 'St Fatima School is a school in Nasr City, Cairo, Egypt. Established in 1982, the school serves students in preschool through secondary stages of education. It\'s mostly known for its IGCSE division', '648d857e0c7e85.38939688.png', '2023-06-17 10:05:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(100) NOT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `country` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `is_status` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `password`, `phone`, `email`, `address`, `address2`, `country`, `state`, `zip`, `is_status`, `created_at`) VALUES
(1, 'ahmed', 'mahmpou', 'ali', '$2y$10$MfzShdN5nkPV4U4cWuPuU.9K3sJSbHOMNWF/AcgxIYLP1j71CvIpK', '01147380657', 'ahmed@gmail.com', 'dasdsa', '', 'Egypt', 'Cairo', '3333', 1, '2023-06-22 11:14:12'),
(2, 'raghad', 'Darwish', 'zm@yahoo.com', '$2y$10$chV0PYoBgAHuYjP.6Xm3p.4hWVL.1T2ACg1kMN.4ImqjF6LTSFDWi', '01022642588', 'zainab.mostafa.hassn@commerce.helwan.edu.eg', 'ertgerd', '', 'Egypt', 'Cairo', 'fr', 1, '2023-06-22 15:54:35'),
(3, 'ahmed', 'ahmed', 'ahmed ahmed', '$2y$10$CAM6Z3NXJGC1NZ1G1LFFB.QMFUl5drmi68XaFDC/Yg9SFRlxfltHG', '01129164390', 'ahmed@yahoo.com', '12kmcd', '12cdsc', 'Egypt', 'Cairo', '123', 1, '2023-06-22 19:31:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categ`
--
ALTER TABLE `categ`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_messages`
--
ALTER TABLE `orders_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_details`
--
ALTER TABLE `package_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categ_id` (`categ_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `quality`
--
ALTER TABLE `quality`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categ`
--
ALTER TABLE `categ`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders_messages`
--
ALTER TABLE `orders_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `package_details`
--
ALTER TABLE `package_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=289;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `quality`
--
ALTER TABLE `quality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`categ_id`) REFERENCES `categ` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
