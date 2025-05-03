-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 19, 2025 at 01:02 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bke_users`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `updated_at` int DEFAULT NULL,
  `created_at` int DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `order_detail_id` int NOT NULL AUTO_INCREMENT COMMENT 'Mã số chi tiết đơn hàng',
  `order_id` int NOT NULL COMMENT 'Mã số đơn hàng',
  `product_id` int NOT NULL COMMENT 'Mã số sản phẩm',
  `updated_at` datetime DEFAULT NULL COMMENT 'Thời gian cập nhật',
  `created_at` datetime DEFAULT NULL COMMENT 'Thời gian tạo',
  PRIMARY KEY (`order_detail_id`),
  KEY `foreignkey_orderdetail-products` (`product_id`),
  KEY `foreignkey_orderdetail-orders` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int NOT NULL AUTO_INCREMENT COMMENT 'Mã số sản phẩm',
  `product_name` varchar(255) NOT NULL COMMENT 'Tên sản phẩm',
  `product_price` double NOT NULL COMMENT 'Giá sản phẩm',
  `product_description` text NOT NULL COMMENT 'Mô tả sản phẩm',
  `updated_at` datetime DEFAULT NULL COMMENT 'Thời gian cập nhật',
  `created_at` datetime DEFAULT NULL COMMENT 'Thời gian tạo',
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT COMMENT 'Mã số user',
  `user_name` varchar(25) NOT NULL COMMENT 'Tên user',
  `user_email` varchar(55) NOT NULL COMMENT 'Email',
  `user_password` varchar(255) NOT NULL COMMENT 'Mật khẩu',
  `update_at` datetime DEFAULT NULL COMMENT 'Thời gian cập nhật',
  `create_at` datetime DEFAULT NULL COMMENT 'Thời gian tạo',
  `reset_token` varchar(255) DEFAULT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `update_at`, `create_at`, `reset_token`, `role`) VALUES
(0, 'admin1', 'admin1@gmail.com', '$2y$10$I6l9larMYm8g8dhbyusL1u5T635ZZCfCoYGhCe2cOvdAkU.QoU3lG', NULL, '2025-03-19 10:17:32', NULL, 'admin'),
(15, 'tCrkBEGd', 'tCrkBEGd@example.com', '$2y$10$2b3iE0YVxPHJ7dMIgafZXOCGfsajnLzM9PAQxCu470bm3HZ4upwZu', '2025-03-19 10:43:17', '2025-03-19 03:39:41', NULL, 'user'),
(16, 'LE0gZ6CL', 'LE0gZ6CL@example.com', '$2y$10$IUoBMnAJJLKlnEw9Im/wyOl3Oz2TvxyRGxQBy4i5HzHjNWEwc.xo.', NULL, '2025-03-19 03:39:41', NULL, 'user'),
(17, 'B2r78Fkr', 'B2r78Fkr@example.com', '$2y$10$yV8zzHhGQdDhLkYRd2cpkO.rp3OzmvwSUsTvNxygMYrxj.49tbi5m', NULL, '2025-03-19 03:39:41', NULL, 'user'),
(18, 'qXK0YHlb', 'qXK0YHlb@example.com', '$2y$10$LJ7jE5eIg/EM21Ou9RCL0e1f79H.TQ.iDo0JBeefEKZr1yTHRRxLS', '2025-03-19 10:43:29', '2025-03-19 03:39:41', NULL, 'user'),
(19, 'g2sqplc5', 'g2sqplc5@example.com', '$2y$10$0NYeEZ9.V/EWVGbBTzhH0evoes40DUUtmZpxDMudzAQrzj3zWwuOK', NULL, '2025-03-19 03:39:41', NULL, 'user'),
(20, 'FECleHKc', 'FECleHKc@example.com', '$2y$10$7NkFArScTVOgIy.OSNDUf.X2Ejogb8M6xPp9spfhwUDTDIfm3EziC', NULL, '2025-03-19 03:39:41', NULL, 'user'),
(21, 'MR9bvHGK', 'MR9bvHGK@example.com', '$2y$10$RLf2gp7tyXTfZz0Bzdji/eod2xEvxmUSlzrUVv.aacXVlD.wdHBiS', NULL, '2025-03-19 03:39:41', '9d1deac743400099726e2cb1b723c428222f82d25fdab21ea1e5baaa6d71b245', 'user'),
(22, 'LwggAhxR', 'LwggAhxR@example.com', '$2y$10$eOrjFImXD./P8KVFJBwZF.A0FJ3tQwPKzU3sGEWBvIQBrhcjYPvoa', NULL, '2025-03-19 03:39:41', NULL, 'user'),
(23, 'OvwUMIVD', 'OvwUMIVD@example.com', '$2y$10$WoToeekSlx/rM.K.Aw2TKeU4dHB/qPXHKdA153UzZbS4qWrQ28X0y', NULL, '2025-03-19 03:39:41', NULL, 'user'),
(24, 'f9mTVT5p', 'f9mTVT5p@example.com', '$2y$10$p4vlOLnfmz7brJaxAg2wV.fdOmT9Mpv4tZhoODzp0.hcopHiFfk8W', NULL, '2025-03-19 03:39:41', NULL, 'user'),
(25, '0DyFB718', '0DyFB718@example.com', '$2y$10$BlgT0T978FDWPNfF/VznWOxLsfCuHRPMpjU5qrIOfJkrlH1UjhDsO', NULL, '2025-03-19 03:42:00', NULL, 'user'),
(26, 'aSVEQSrM', 'aSVEQSrM@example.com', '$2y$10$nNROCf33EQVEQVe7gJGahuLaG7XcqiTMGfcIuNRD21ey4ACX/LUx2', NULL, '2025-03-19 03:42:00', NULL, 'user'),
(27, 'oN0L4B2y', 'oN0L4B2y@example.com', '$2y$10$OIiCjUIrsR1tWi561OzKmu7TNhAxqDPKo3lEqVB4rB/ip9xielQkq', NULL, '2025-03-19 03:42:00', NULL, 'user'),
(28, 'eLqC6rr4', 'eLqC6rr4@example.com', '$2y$10$FGsEJnjojYhGZIQi84IamO2V78/dpi2EIacNShtfz7KAmAku4zmIW', NULL, '2025-03-19 03:42:00', '3b4a8154c566951f4271773ff50b72cf892762580a9419ad5e1bad480c3eae8e', 'user'),
(29, 'jrRLmJtq', 'jrRLmJtq@example.com', '$2y$10$xsgNbWkDS/Fz8Cj5RUaqU.pWhQL0oDyItpHs4gtVRVD8OEKNCJUNK', NULL, '2025-03-19 03:42:00', NULL, 'user'),
(30, 'RUUwTRnR', 'RUUwTRnR@example.com', '$2y$10$vxm0mJYL/Kvoban/9dyF4en97HAmd/gFUyi/cIkQZibt/7x65qEWK', NULL, '2025-03-19 03:42:00', NULL, 'user'),
(31, '2xDxMqfM', '2xDxMqfM@example.com', '$2y$10$QTBezE4mk8rLV58RRLB6MOmx/6c0FlRMIzOuylPk41AWfn4Hy8.oO', NULL, '2025-03-19 03:42:01', NULL, 'user'),
(32, 'wbEi7SYy', 'wbEi7SYy@example.com', '$2y$10$vhRSd2kBYf9zKomn3ApalukYK/gtUBmiaqmot5p6HAPs3XXRWs9C2', NULL, '2025-03-19 03:42:01', NULL, 'user'),
(33, 'AAB3AbdU', 'AAB3AbdU@example.com', '$2y$10$BAOWWRuyI4Cli1QmP3fgnuYzKGT2OKAJhRi/GhN75ZPC9FSrPeMFO', NULL, '2025-03-19 03:42:01', NULL, 'user'),
(34, '1tbh35wd', '1tbh35wd@example.com', '$2y$10$iMillXvWd7HrM9tm4LCsP.EmvvS6gOGW.UxMPEWfU.HgbSw8HuSTC', NULL, '2025-03-19 03:42:01', '4e2a080885aa1c8895f5ad3594b9513cbf781f7bfad453f436d8d1d0a5d5490a', 'user'),
(35, 'mwK3zB0M', 'mwK3zB0M@example.com', '$2y$10$Fuls1v2PmKKUQI4rETpHVeO1irjjpjPLYYmELzxvAtf0RvLs0PYKa', NULL, '2025-03-19 03:42:03', NULL, 'user'),
(36, 'Vm633rcE', 'Vm633rcE@example.com', '$2y$10$Ue90Or1WVe3LEpS9EB3uCO1cEREMRrTo1zE/vl1KiwDPF2yFDkz0O', NULL, '2025-03-19 03:42:04', NULL, 'user'),
(37, 'BnIh5mY8', 'BnIh5mY8@example.com', '$2y$10$qKdAJAyz0ZIHWRMDYYg./OgH4/kmH1YP3CIkWHjpA24bgjSua56Ze', NULL, '2025-03-19 03:42:04', NULL, 'user'),
(38, 'cjMLe6MF', 'cjMLe6MF@example.com', '$2y$10$4vHZ9FT9z2ktl4Pl99ZsMuBhbAr..wVAiaGO/KU//1FKFY2igrJhy', NULL, '2025-03-19 03:42:04', NULL, 'user'),
(39, 'g6TSyAEC', 'g6TSyAEC@example.com', '$2y$10$4XoxVDdcJTaVxeSnLgbOYeb7YTRYbrkmBESecgTVQjQrn1jwqA7uu', NULL, '2025-03-19 03:42:04', NULL, 'user'),
(40, 'kxMBRV3I', 'kxMBRV3I@example.com', '$2y$10$hlBssZgyGmrfJOP8Y.R6ju6.udNKGPlaK1UFqMdH3DeNDWqpj1H0.', NULL, '2025-03-19 03:42:04', NULL, 'user'),
(41, 'v4AK8ocm', 'v4AK8ocm@example.com', '$2y$10$Tg/u4WwLt7MO2VhoomFYBOLBPRpzrenLkDoOSTvIxgUf.Rjct6j8a', NULL, '2025-03-19 03:42:04', NULL, 'user'),
(42, 'rCn2mfGU', 'rCn2mfGU@example.com', '$2y$10$qrstidakXt20zRCEllV2Mug78O84DgYCkw8PIWMZIbe71YhbbXBEq', NULL, '2025-03-19 03:42:04', NULL, 'user'),
(43, 'vCROcSeL', 'vCROcSeL@example.com', '$2y$10$ZQohzdL.QsyAamnGJb7kl.lUMgqJEVDMpRVt12qUxxJd3cDJ6PWH.', NULL, '2025-03-19 03:42:04', NULL, 'user'),
(44, 'mN3gPeCQ', 'mN3gPeCQ@example.com', '$2y$10$EiPzxEmph/6DmycnmarkyutFnw0zieH2dXPtEzzpzrHob5k22OhVm', NULL, '2025-03-19 03:42:04', NULL, 'user'),
(45, 'scvBjbAZ', 'scvBjbAZ@example.com', '$2y$10$CfiuQyszEe6UL24FC3URL.dhpKFBWTz4R/8FfuBkQnEyNMyARBMLq', NULL, '2025-03-19 03:42:08', NULL, 'user'),
(46, '6O7hgam8', '6O7hgam8@example.com', '$2y$10$rKBtJKU4x2r1uOm.ccDd.OuFXnG.rjaEYF76taJ4wLqhpU5/3aAhW', NULL, '2025-03-19 03:42:08', NULL, 'user'),
(47, '8WPUxkF1', '8WPUxkF1@example.com', '$2y$10$bnMAL6XTy1yI/hg/JyGKZ.uQAhxeOUNYV/hvX8dZhJFBjZYksc/pq', NULL, '2025-03-19 03:42:08', NULL, 'user'),
(48, '79JkBPJc', '79JkBPJc@example.com', '$2y$10$aW6PeyFma9wraSbZL7U4HOE5DS.lSwitcQPZeQZRtwpOCtbJMGZLS', NULL, '2025-03-19 03:42:08', NULL, 'user'),
(49, 'yvEl3OeL', 'yvEl3OeL@example.com', '$2y$10$6DwD/KypgNmyoYUk.kehV.FD8RvbgQV9vGg1iupijv0Vkj6TPh/5m', NULL, '2025-03-19 03:42:08', NULL, 'user'),
(50, '7MUYYefG', '7MUYYefG@example.com', '$2y$10$884/0xIaFxP0umKI4EbN6OuWvLx79shx8IMn2pA7oK9980VxypJgm', NULL, '2025-03-19 03:42:08', NULL, 'user'),
(51, '1KPOdCJj', '1KPOdCJj@example.com', '$2y$10$Yw4Lhkj6W7BbuQjMeKmYZeGEWG7VxYYXGgEWimqSu7ioVdwZOOa7K', NULL, '2025-03-19 03:42:08', NULL, 'user'),
(52, 'to6HrJs9', 'to6HrJs9@example.com', '$2y$10$JhYzeWWqXc5q8x8U68neDOR3I.GkJOrtvF0/aY1ev0xJkiod7wASu', NULL, '2025-03-19 03:42:08', NULL, 'user'),
(53, 'NgX6hih5', 'NgX6hih5@example.com', '$2y$10$maZD2i4hv7rdm074HT/aVebgpO/gaifPxuP2EnmSL5bamhNuhgXqy', NULL, '2025-03-19 03:42:08', NULL, 'user'),
(54, 'yU7VuG8D', 'yU7VuG8D@example.com', '$2y$10$dY.AF/gZCTuaLUXQW1111e.NfhPTjfBavbgf7MptaHZPbZxyNiPYu', NULL, '2025-03-19 03:42:08', NULL, 'user');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `foreignkey_order-users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `foreignkey_orderdetail-orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foreignkey_orderdetail-products` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
