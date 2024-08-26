-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2024 at 11:39 AM
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
-- Database: `finance`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_budget`
--

DROP TABLE IF EXISTS `tbl_budget`;
CREATE TABLE IF NOT EXISTS `tbl_budget` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `monthly_budget` int(11) NOT NULL,
  `tbl_user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_budget_tbl_users_FK` (`tbl_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_budget`
--

INSERT INTO `tbl_budget` (`id`, `monthly_budget`, `tbl_user_id`) VALUES
(1, 10000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expenses`
--

DROP TABLE IF EXISTS `tbl_expenses`;
CREATE TABLE IF NOT EXISTS `tbl_expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tbl_expense_category_id` int(11) NOT NULL,
  `expense_name` text NOT NULL,
  `expense_date` date NOT NULL,
  `expense_spent` int(11) NOT NULL,
  `expense_description` text NOT NULL,
  `tbl_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_expense_tbl_expense_category_id_IDX` (`tbl_expense_category_id`) USING BTREE,
  KEY `tbl_expenses_tbl_users_FK` (`tbl_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_expenses`
--

INSERT INTO `tbl_expenses` (`id`, `tbl_expense_category_id`, `expense_name`, `expense_date`, `expense_spent`, `expense_description`, `tbl_user_id`) VALUES
(1, 1, 'Lunch', '2024-05-11', 300, 'Lunch on SM City', 1),
(2, 3, 'Dinner', '2024-05-25', 100, 'Aw', 1),
(3, 6, 'Electricity', '2024-05-27', 1500, '', 1),
(4, 5, 'Bus', '2024-06-01', 50, '', 1),
(6, 1, 'Lunch', '2024-06-03', 200, 'Lunch on SM City', 1),
(7, 3, 'Dinner', '2024-06-03', 50, 'Aw', 1),
(9, 5, 'Bus', '2024-06-06', 150, '', 1),
(11, 3, 'Dinner', '2024-06-07', 150, 'Dinner with friends', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expense_categories`
--

DROP TABLE IF EXISTS `tbl_expense_categories`;
CREATE TABLE IF NOT EXISTS `tbl_expense_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` text NOT NULL,
  `category_budget` int(11) DEFAULT NULL,
  `tbl_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_expense_categories_unique` (`category_name`) USING HASH,
  KEY `tbl_expense_categories_tbl_users_FK` (`tbl_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_expense_categories`
--

INSERT INTO `tbl_expense_categories` (`id`, `category_name`, `category_budget`, `tbl_user_id`) VALUES
(1, 'Allowance', 700, 1),
(3, 'Food', 2000, 1),
(5, 'Transportation', 400, 1),
(6, 'Utilities', 2000, 1),
(9, 'Gaming', 1000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(200) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `last_login_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`, `last_login_at`) VALUES
(1, 'Admin', 'admin@email.com', '09a1a0e07fc27a29df0724c04731613b3f0663f6', '2024-06-06 22:09:34', NULL, '2024-06-08 14:25:20');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_budget`
--
ALTER TABLE `tbl_budget`
  ADD CONSTRAINT `tbl_budget_tbl_users_FK` FOREIGN KEY (`tbl_user_id`) REFERENCES `tbl_users` (`id`);

--
-- Constraints for table `tbl_expenses`
--
ALTER TABLE `tbl_expenses`
  ADD CONSTRAINT `tbl_expenses_tbl_expense_categories_FK` FOREIGN KEY (`tbl_expense_category_id`) REFERENCES `tbl_expense_categories` (`id`),
  ADD CONSTRAINT `tbl_expenses_tbl_users_FK` FOREIGN KEY (`tbl_user_id`) REFERENCES `tbl_users` (`id`);

--
-- Constraints for table `tbl_expense_categories`
--
ALTER TABLE `tbl_expense_categories`
  ADD CONSTRAINT `tbl_expense_categories_tbl_users_FK` FOREIGN KEY (`tbl_user_id`) REFERENCES `tbl_users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
