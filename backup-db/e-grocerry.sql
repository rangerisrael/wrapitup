-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2022 at 11:48 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-grocerry`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `birthday` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` int(11) NOT NULL COMMENT '0 = Administrator | 1 = Customer',
  `status` int(11) NOT NULL,
  `month` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `firstname`, `surname`, `email`, `contact`, `birthday`, `age`, `username`, `password`, `role`, `status`, `month`, `year`, `created_at`, `updated_at`) VALUES
(2, 'John David', 'Lozano', 'lozanojohndavid@gmail.com', '09956425669', '', NULL, 'petmark', '$2y$10$YU9eLnvjSvnUVgx9tv4S7.Ov1bl8wrhl2im6B5S1XiSFwXv2S2RtW', 0, 0, '2', '2022', '2022-02-17 09:32:59', '2022-02-20 21:06:38'),
(3, 'JEddahlyn', 'Cabuga', 'cabugajeddahlyn@gmail.com', '09265691158', '1994-03-31', 27, 'jeddah', '$2y$10$SEeJIznr48roLtKm3lDfBeTauUGRnyEpmaDg895jIaNhw7u.BVPOC', 1, 0, '2', '2022', '2022-02-18 03:36:32', '2022-02-20 22:43:50'),
(4, 'Adora', 'Lozano', 'lozanoadora@gmail.com', NULL, NULL, NULL, 'adora', '$2y$10$Pgu4Uhpfne3NtK/nSFES0OI5llNVBq8OBMIWrOkWt4u8qD6.pOYEO', 1, 0, '2', '2022', '2022-02-19 08:30:28', '2022-02-20 21:14:45'),
(5, 'John David', 'Lozano', 'lozanojohndavid@gmail.com', '09956425669', '', NULL, 'petmark', '$2y$10$YU9eLnvjSvnUVgx9tv4S7.Ov1bl8wrhl2im6B5S1XiSFwXv2S2RtW', 0, 0, '2', '2022', '2022-02-17 09:32:59', '2022-02-20 21:06:38'),
(6, 'JEddahlyn', 'Cabuga', 'cabugajeddahlyn@gmail.com', '09265691158', '1994-03-31', 27, 'jeddah', '$2y$10$nUyiuaNaWEAyrnbV0NUPMeLS9AHQ63w4AMYcsQLSf6gzBqxEkRFs.', 1, 0, '2', '2022', '2022-02-18 03:36:32', '2022-02-20 21:06:38'),
(7, 'Adora', 'Lozano', 'lozanoadora@gmail.com', NULL, NULL, NULL, 'adora', '$2y$10$Pgu4Uhpfne3NtK/nSFES0OI5llNVBq8OBMIWrOkWt4u8qD6.pOYEO', 1, 0, '2', '2022', '2022-02-19 08:30:28', '2022-02-20 21:14:45'),
(8, 'John David', 'Lozano', 'lozanojohndavid@gmail.com', '09956425669', '', NULL, 'petmark', '$2y$10$YU9eLnvjSvnUVgx9tv4S7.Ov1bl8wrhl2im6B5S1XiSFwXv2S2RtW', 0, 0, '2', '2022', '2022-02-17 09:32:59', '2022-02-20 21:06:38'),
(9, 'JEddahlyn', 'Cabuga', 'cabugajeddahlyn@gmail.com', '09265691158', '1994-03-31', 27, 'jeddah', '$2y$10$nUyiuaNaWEAyrnbV0NUPMeLS9AHQ63w4AMYcsQLSf6gzBqxEkRFs.', 1, 0, '2', '2022', '2022-02-18 03:36:32', '2022-02-20 21:06:38'),
(10, 'Adora', 'Lozano', 'lozanoadora@gmail.com', NULL, NULL, NULL, 'adora', '$2y$10$Pgu4Uhpfne3NtK/nSFES0OI5llNVBq8OBMIWrOkWt4u8qD6.pOYEO', 1, 0, '2', '2022', '2022-02-19 08:30:28', '2022-02-20 21:14:45'),
(11, 'John David', 'Lozano', 'lozanojohndavid@gmail.com', '09956425669', '', NULL, 'petmark', '$2y$10$YU9eLnvjSvnUVgx9tv4S7.Ov1bl8wrhl2im6B5S1XiSFwXv2S2RtW', 0, 0, '2', '2022', '2022-02-17 09:32:59', '2022-02-20 21:06:38'),
(12, 'JEddahlyn', 'Cabuga', 'cabugajeddahlyn@gmail.com', '09265691158', '1994-03-31', 27, 'jeddah', '$2y$10$nUyiuaNaWEAyrnbV0NUPMeLS9AHQ63w4AMYcsQLSf6gzBqxEkRFs.', 1, 0, '2', '2022', '2022-02-18 03:36:32', '2022-02-20 21:06:38'),
(13, 'Adora', 'Lozano', 'lozanoadora@gmail.com', NULL, NULL, NULL, 'adora', '$2y$10$Pgu4Uhpfne3NtK/nSFES0OI5llNVBq8OBMIWrOkWt4u8qD6.pOYEO', 1, 0, '2', '2022', '2022-02-19 08:30:28', '2022-02-20 21:14:45'),
(14, 'John David', 'Lozano', 'lozanojohndavid@gmail.com', '09956425669', '', NULL, 'petmark', '$2y$10$YU9eLnvjSvnUVgx9tv4S7.Ov1bl8wrhl2im6B5S1XiSFwXv2S2RtW', 0, 0, '2', '2022', '2022-02-17 09:32:59', '2022-02-20 21:06:38'),
(15, 'JEddahlyn', 'Cabuga', 'cabugajeddahlyn@gmail.com', '09265691158', '1994-03-31', 27, 'jeddah', '$2y$10$nUyiuaNaWEAyrnbV0NUPMeLS9AHQ63w4AMYcsQLSf6gzBqxEkRFs.', 1, 0, '2', '2022', '2022-02-18 03:36:32', '2022-02-20 21:06:38'),
(16, 'Adora', 'Lozano', 'lozanoadora@gmail.com', NULL, NULL, NULL, 'adora', '$2y$10$Pgu4Uhpfne3NtK/nSFES0OI5llNVBq8OBMIWrOkWt4u8qD6.pOYEO', 1, 0, '2', '2022', '2022-02-19 08:30:28', '2022-02-20 21:14:45');

-- --------------------------------------------------------

--
-- Table structure for table `accounts_address`
--

CREATE TABLE `accounts_address` (
  `id` int(11) NOT NULL,
  `accounts_id` int(11) NOT NULL,
  `shipping_firstname` varchar(255) DEFAULT NULL,
  `shipping_surname` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL COMMENT 'Billing Address | Shipping Address',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts_address`
--

INSERT INTO `accounts_address` (`id`, `accounts_id`, `shipping_firstname`, `shipping_surname`, `contact`, `country`, `city`, `state`, `address`, `zip`, `category`, `created_at`, `updated_at`) VALUES
(7, 2, 'John', 'Lozano', '09956425669', 'PH', 'Quezon City', 'Metro Manila', 'Block 1 Lot 50', '1121', 'Shipping Address', '2022-02-17 10:34:32', '2022-02-17 20:02:37'),
(10, 2, '', '', '', 'PH', 'Quezon City', 'Metro Manila', 'Block 1 Lot 50 S.P.S.C', '1127', 'Billing Address', '2022-02-17 12:06:32', '2022-02-17 20:02:51'),
(11, 3, NULL, NULL, NULL, 'PH', 'Quezon City', 'Metro Manila', 'Block 1 Lot 50 S.P.S.C', '1127', 'Billing Address', '2022-02-18 04:04:14', '2022-02-18 04:04:14'),
(12, 3, 'John', 'Lozano', '09996655656', 'PH', 'Quezon City', 'Metro Manila', 'Block 1 Lot 50', '1121', 'Shipping Address', '2022-02-18 04:04:22', '2022-02-18 04:04:22');

-- --------------------------------------------------------

--
-- Table structure for table `meta`
--

CREATE TABLE `meta` (
  `id` int(11) NOT NULL,
  `identifier` varchar(11) DEFAULT NULL,
  `description` varchar(5000) NOT NULL,
  `keywords` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `product_categories_id` int(11) NOT NULL,
  `product_sub_categories_id` int(11) NOT NULL,
  `title` varchar(3000) DEFAULT NULL,
  `short_description` varchar(5000) DEFAULT NULL,
  `long_description` longtext,
  `price` decimal(10,2) NOT NULL,
  `stocks` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `is_featured` int(11) NOT NULL DEFAULT '0',
  `meta_description` varchar(5000) DEFAULT NULL,
  `meta_keywords` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `featured_image`, `product_categories_id`, `product_sub_categories_id`, `title`, `short_description`, `long_description`, `price`, `stocks`, `discount`, `is_featured`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`) VALUES
(1, 'default.png', 3, 13, 'Argentina Cornbeef', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', '80.00', 70, 0, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Canned Goods', '2022-02-17 05:30:41', '2022-02-20 20:36:42'),
(2, 'default.png', 3, 13, 'Meatloaf', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', '80.00', 94, 0, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Canned Goods', '2022-02-17 05:30:41', '2022-02-20 20:34:25');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(11) NOT NULL,
  `images` varchar(255) NOT NULL,
  `parent` varchar(255) DEFAULT NULL,
  `is_featured` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `images`, `parent`, `is_featured`, `created_at`, `updated_at`) VALUES
(1, 'fruits.jpg', 'Fruits', 1, '2022-02-13 00:16:46', '2022-02-18 01:16:57'),
(2, 'vegetables.png', 'Vegetables', 1, '2022-02-13 00:16:46', '2022-02-18 01:11:47'),
(3, 'cannedgoods.jpg', 'Canned Goods', 1, '2022-02-13 00:16:46', '2022-02-18 01:06:35'),
(4, 'beverages.png', 'Beverages', 1, '2022-02-13 00:16:46', '2022-02-18 01:00:42'),
(5, 'others.png', 'Others', 1, '2022-02-13 00:19:46', '2022-02-18 01:01:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_galleries`
--

CREATE TABLE `product_galleries` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_galleries`
--

INSERT INTO `product_galleries` (`id`, `product_id`, `images`, `created_at`, `updated_at`) VALUES
(1, 1, 'default.png', '2022-02-17 05:34:03', '2022-02-17 05:34:03'),
(2, 1, 'default.png', '2022-02-17 05:34:03', '2022-02-17 05:34:03'),
(3, 1, 'default.png', '2022-02-17 05:34:03', '2022-02-17 05:34:03'),
(4, 1, 'category-1.png', '2022-02-17 05:34:03', '2022-02-17 06:02:48'),
(5, 2, 'default.png', '2022-02-17 05:34:03', '2022-02-17 05:34:03'),
(6, 2, 'default.png', '2022-02-17 05:34:03', '2022-02-17 05:34:03'),
(7, 2, 'default.png', '2022-02-17 05:34:03', '2022-02-17 05:34:03'),
(8, 2, 'category-1.png', '2022-02-17 05:34:03', '2022-02-17 06:02:48');

-- --------------------------------------------------------

--
-- Table structure for table `product_sub_categories`
--

CREATE TABLE `product_sub_categories` (
  `id` int(11) NOT NULL,
  `product_categories_id` int(11) NOT NULL,
  `child` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_sub_categories`
--

INSERT INTO `product_sub_categories` (`id`, `product_categories_id`, `child`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bananas', '2022-02-12 23:39:42', '2022-02-12 23:39:42'),
(2, 1, 'Apples', '2022-02-12 23:39:42', '2022-02-12 23:39:42'),
(3, 1, 'Grapes', '2022-02-12 23:39:42', '2022-02-12 23:39:42'),
(4, 1, 'Oranges', '2022-02-12 23:39:42', '2022-02-12 23:39:42'),
(5, 1, 'Strawberries', '2022-02-12 23:39:42', '2022-02-12 23:39:42'),
(6, 1, 'Avocadoes', '2022-02-12 23:39:42', '2022-02-12 23:39:42'),
(7, 2, 'Potatoes', '2022-02-12 23:39:42', '2022-02-12 23:39:42'),
(8, 2, 'Tomatoes', '2022-02-12 23:39:42', '2022-02-12 23:39:42'),
(9, 2, 'Onions', '2022-02-12 23:39:42', '2022-02-12 23:39:42'),
(10, 2, 'Carrots', '2022-02-12 23:39:42', '2022-02-12 23:39:42'),
(11, 2, 'Lettuce', '2022-02-12 23:39:42', '2022-02-12 23:39:42'),
(12, 2, 'Brocolli', '2022-02-12 23:39:42', '2022-02-12 23:39:42'),
(13, 3, 'Olives', '2022-02-12 23:39:42', '2022-02-12 23:39:42'),
(14, 3, 'Soap', '2022-02-12 23:39:42', '2022-02-12 23:39:42'),
(15, 3, 'Tuna', '2022-02-12 23:39:42', '2022-02-12 23:39:42'),
(16, 3, 'Veggies', '2022-02-12 23:39:42', '2022-02-12 23:39:42'),
(17, 4, 'Water', '2022-02-12 23:39:42', '2022-02-12 23:39:42'),
(18, 4, 'Coffee', '2022-02-12 23:39:42', '2022-02-12 23:39:42'),
(19, 4, 'Milk', '2022-02-12 23:39:42', '2022-02-12 23:39:42'),
(20, 4, 'Juice', '2022-02-12 23:39:42', '2022-02-12 23:39:42');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ratings` int(11) NOT NULL,
  `comment` varchar(3000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `accounts_id` int(11) DEFAULT NULL,
  `product` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `method_of_payment` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0 = Pending | 1 = Processing | 2 = Completed | 3 = Cancelled',
  `reference` varchar(255) DEFAULT NULL,
  `receipt_image` varchar(255) DEFAULT NULL,
  `notes` varchar(3000) DEFAULT NULL,
  `shipping_trigger` varchar(255) DEFAULT NULL,
  `month` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `accounts_id`, `product`, `quantity`, `price`, `method_of_payment`, `status`, `reference`, `receipt_image`, `notes`, `shipping_trigger`, `month`, `year`, `created_at`, `updated_at`) VALUES
(23, 2, 'Argentina Cornbeef', 4, '80.00', 'Stripe', 2, 'ch_3KUJBLLVtJN7KRxg1zmioRDS', NULL, '', 'No', '1', '2022', '2021-12-31 16:00:00', '2022-02-20 20:31:33'),
(24, 2, 'Argentina Cornbeef', 12, '80.00', 'Cash On Delivery', 0, 'JFRYHZ7IAE', NULL, '', 'No', '1', '2022', '2021-12-31 16:00:00', '2022-02-20 20:31:39'),
(25, 2, 'Argentina Cornbeef', 1, '80.00', 'Cash On Delivery', 1, 'QMPVLCUHAR', NULL, '', 'No', '2', '2022', '2022-02-17 23:19:49', '2022-02-20 20:53:26'),
(26, 2, 'Argentina Cornbeef', 3, '80.00', 'Cash On Delivery', 0, 'N6CR0XSM3L', NULL, '', 'No', '2', '2022', '2022-02-17 23:20:00', '2022-02-20 20:04:08'),
(27, 2, 'Argentina Cornbeef', 1, '80.00', 'Cash On Delivery', 0, 'OE68N7LXFU', NULL, '', 'No', '2', '2022', '2022-02-17 23:20:11', '2022-02-20 20:04:08'),
(28, 2, 'Meatloaf', 5, '80.00', 'Cash On Delivery', 0, 'OE68N7LXFU', NULL, '', 'No', '2', '2022', '2022-02-17 23:20:11', '2022-02-20 20:04:07'),
(29, 2, 'Argentina Cornbeef', 10, '80.00', 'Stripe', 2, 'ch_3KUJUkLVtJN7KRxg1nDmsUVM', NULL, '', 'No', '2', '2022', '2022-02-17 23:34:43', '2022-02-20 20:04:06'),
(30, 3, 'Argentina Cornbeef', 2, '80.00', 'Cash On Delivery', 0, 'F0OMZIX92D', NULL, '', 'No', '2', '2022', '2022-02-18 04:16:20', '2022-02-20 20:04:05'),
(31, 3, 'Meatloaf', 3, '80.00', 'Cash On Delivery', 0, 'F0OMZIX92D', NULL, '', 'No', '2', '2022', '2022-02-18 04:16:20', '2022-02-20 20:04:04'),
(32, 3, 'Argentina Cornbeef', 99, '80.00', 'Bank Transfer', 0, 'R7D0HVEILP', NULL, '', 'No', '2', '2022', '2022-01-22 04:17:18', '2022-02-20 22:47:52'),
(33, 3, 'Meatloaf', 1, '80.00', 'Bank Transfer', 0, 'R7D0HVEILP', NULL, '', 'No', '2', '2022', '2022-01-22 04:17:18', '2022-02-20 22:47:52'),
(34, 3, 'Meatloaf', 1, '80.00', 'Stripe', 2, 'ch_3KUNukLVtJN7KRxg0ftwoNIU', NULL, '', 'No', '2', '2022', '2022-02-18 04:17:51', '2022-02-20 20:04:01'),
(35, 3, 'Argentina Cornbeef', 2, '80.00', 'Cash On Delivery', 0, 'JD1WY4H58N', NULL, '', 'No', '2', '2022', '2022-02-18 13:10:36', '2022-02-20 20:04:00'),
(36, 3, 'Meatloaf', 2, '80.00', 'Stripe', 2, 'ch_3KUdibLVtJN7KRxg0bv19w8Q', NULL, '', 'No', '2', '2022', '2022-02-18 21:10:21', '2022-02-20 20:03:59'),
(37, 3, 'Argentina Cornbeef', 19, '80.00', 'Stripe', 2, 'ch_3KUdibLVtJN7KRxg0bv19w8Q', NULL, '', 'No', '2', '2022', '2022-02-18 21:10:21', '2022-02-20 20:03:57'),
(38, 3, 'Argentina Cornbeef', 2, '80.00', 'Cash On Delivery', 0, '3YPDM14N68', NULL, '', 'Yes', '2', '2022', '2022-02-17 16:00:00', '2022-02-20 20:11:17'),
(39, 3, 'Argentina Cornbeef', 1, '80.00', 'Bank Transfer', 0, '1R04FKJNQV', '273929062_1813320875529794_120893468967483054_n.jpg', '', 'No', '2', '2022', '2022-02-17 16:00:00', '2022-02-20 20:11:12'),
(40, 2, 'Meatloaf', 4, '80.00', 'Bank Transfer', 0, 'NHF9KAO65U', NULL, '', 'No', '3', '2022', '2022-02-28 20:34:25', '2022-02-20 20:37:28'),
(41, 2, 'Argentina Cornbeef', 4, '80.00', 'Bank Transfer', 0, 'NHF9KAO65U', NULL, '', 'No', '3', '2022', '2022-02-28 20:34:25', '2022-02-20 20:37:25'),
(42, 2, 'Argentina Cornbeef', 2, '80.00', 'Cash On Delivery', 0, 'G2NBOQ1CZD', NULL, '', 'No', '3', '2022', '2022-02-28 20:36:42', '2022-02-20 20:37:22');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `month` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `ip_address`, `month`, `year`, `created_at`, `updated_at`) VALUES
(1, '112.200.237.231', '2', '2022', '2022-02-21 05:21:53', '2022-02-21 05:21:53'),
(2, '::1', '1', '2022', '2022-01-10 05:31:04', '2022-02-21 05:37:19'),
(3, '::1', '2', '2022', '2022-02-21 05:32:09', '2022-02-21 05:32:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounts_address`
--
ALTER TABLE `accounts_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meta`
--
ALTER TABLE `meta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_galleries`
--
ALTER TABLE `product_galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sub_categories`
--
ALTER TABLE `product_sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `accounts_address`
--
ALTER TABLE `accounts_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `meta`
--
ALTER TABLE `meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_galleries`
--
ALTER TABLE `product_galleries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_sub_categories`
--
ALTER TABLE `product_sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
