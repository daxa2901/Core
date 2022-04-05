-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2022 at 08:41 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_daxa`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminId` int(11) NOT NULL,
  `firstName` varchar(64) NOT NULL,
  `lastName` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `mobile` bigint(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 2,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `firstName`, `lastName`, `email`, `password`, `mobile`, `status`, `createdDate`, `updatedDate`) VALUES
(69, 'daxa', 'dd', 'daxa@gmail.com', '398d45fd9e65aa18add20cc3cb3798fb', 9584484657, 1, '2022-03-28 09:29:55', '2022-04-04 09:00:38');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` int(20) NOT NULL,
  `name` varchar(64) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 2,
  `parentId` int(11) DEFAULT NULL,
  `categoryPath` varchar(64) DEFAULT NULL,
  `base` int(11) DEFAULT NULL,
  `thumb` int(11) DEFAULT NULL,
  `small` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `name`, `createdAt`, `updatedAt`, `status`, `parentId`, `categoryPath`, `base`, `thumb`, `small`) VALUES
(235, 'Bedroom', '2022-04-05 09:53:07', NULL, 1, NULL, '235', 43, 43, 43),
(236, 'new', '2022-04-05 18:46:14', NULL, 1, NULL, '236', NULL, NULL, NULL),
(237, 'phone121', '2022-04-05 18:54:47', NULL, 1, NULL, '237', NULL, NULL, NULL),
(238, 'Electronic', '2022-04-05 19:05:46', NULL, 1, NULL, '238', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_media`
--

CREATE TABLE `category_media` (
  `mediaId` int(11) NOT NULL,
  `categoryId` int(11) DEFAULT NULL,
  `media` varchar(100) NOT NULL,
  `gallery` tinyint(4) NOT NULL DEFAULT 2,
  `status` tinyint(4) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_media`
--

INSERT INTO `category_media` (`mediaId`, `categoryId`, `media`, `gallery`, `status`) VALUES
(32, NULL, '54_17032022080350.png', 2, 2),
(33, NULL, '54_17032022090333.png', 2, 2),
(34, NULL, '54_17032022090308.png', 2, 2),
(39, NULL, '54_17032022080355.png', 2, 2),
(41, NULL, '54_17032022080309.png', 1, 1),
(42, NULL, '54_03042022070455.png', 2, 2),
(43, 235, '54_05042022100414.png', 2, 2),
(44, 236, '54_05042022060400.png', 2, 2),
(45, 237, 'bg_05042022060400.jpg', 2, 2),
(46, 238, '54_05042022070458.png', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `category_product`
--

CREATE TABLE `category_product` (
  `entityId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `configId` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(30) NOT NULL,
  `value` varchar(255) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`configId`, `name`, `code`, `value`, `status`, `createdAt`) VALUES
(169, 'name', 'code324', 'value', 1, '2022-04-01 12:52:36');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerId` int(11) NOT NULL,
  `firstName` varchar(64) NOT NULL,
  `lastName` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `mobile` bigint(10) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 2,
  `salsemanId` int(11) DEFAULT NULL,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerId`, `firstName`, `lastName`, `email`, `mobile`, `status`, `salsemanId`, `createdDate`, `updatedDate`) VALUES
(132, 'daxa', 'ichchhuda', 'd@gmail.com', 9656654345, 1, 7, '2022-03-28 09:37:07', '2022-03-28 18:24:46'),
(193, '', '', '', 0, 1, 7, '2022-03-31 08:43:30', '2022-03-31 13:54:21'),
(196, '', '', '', 0, 1, 7, '2022-03-31 08:48:33', '2022-03-31 08:50:21'),
(197, '', '', '', 0, 1, 7, '2022-03-31 08:59:35', NULL),
(198, '', '', '', 0, 1, 7, '2022-03-31 08:59:49', '2022-03-31 09:09:59'),
(201, '', '', '', 0, 1, 7, '2022-03-31 12:54:35', NULL),
(202, '', '', '', 0, 1, 7, '2022-03-31 12:54:50', NULL),
(203, '', '', '', 0, 1, 11, '2022-03-31 12:56:02', NULL),
(204, '', '', '', 0, 1, 11, '2022-03-31 12:57:05', NULL),
(205, '', '', '', 0, 1, 12, '2022-03-31 12:58:03', NULL),
(206, '', '', '', 0, 1, 12, '2022-03-31 12:58:22', NULL),
(207, '', '', '', 0, 1, 12, '2022-03-31 13:00:01', NULL),
(208, '', '', '', 0, 1, 12, '2022-03-31 13:00:33', NULL),
(209, '', '', '', 0, 1, 12, '2022-03-31 13:00:36', NULL),
(210, '', '', '', 0, 1, 12, '2022-03-31 13:01:03', NULL),
(211, '', '', '', 0, 1, 12, '2022-03-31 13:01:49', NULL),
(212, '', '', '', 0, 1, 12, '2022-03-31 13:02:08', NULL),
(213, 'daxa', '', '', 0, 1, 15, '2022-03-31 13:03:03', NULL),
(214, 'sssss', '', '', 0, 1, 15, '2022-03-31 13:04:47', NULL),
(215, '', '', '', 0, 1, NULL, '2022-03-31 13:05:48', NULL),
(216, '', '', '', 0, 1, NULL, '2022-03-31 13:07:45', NULL),
(217, '', '', '', 0, 1, NULL, '2022-03-31 13:07:54', NULL),
(218, '', '', '', 0, 1, NULL, '2022-03-31 13:08:19', NULL),
(219, '', '', '', 0, 1, NULL, '2022-03-31 13:11:47', NULL),
(220, '', '', '', 0, 1, NULL, '2022-03-31 13:12:06', NULL),
(223, 'daxa', '', '', 0, 1, NULL, '2022-03-31 13:23:23', NULL),
(224, 'aa', '', '', 0, 1, NULL, '2022-03-31 13:25:26', NULL),
(227, '', '', '', 0, 1, NULL, '2022-03-31 13:29:37', NULL),
(228, '', '', '', 0, 1, NULL, '2022-03-31 13:29:39', NULL),
(229, '', '', '', 0, 1, NULL, '2022-03-31 13:30:11', NULL),
(230, '', '', '', 0, 1, NULL, '2022-03-31 13:30:38', NULL),
(231, 'daxa', '', '', 0, 1, NULL, '2022-03-31 13:32:53', NULL),
(232, '', '', 'j@gmail.com', 0, 1, NULL, '2022-03-31 13:33:18', NULL),
(233, '', 'new', '', 12121, 1, NULL, '2022-03-31 13:34:10', NULL),
(234, '', '', '', 0, 1, NULL, '2022-03-31 13:35:00', NULL),
(235, '', '', '', 0, 1, NULL, '2022-03-31 13:36:03', NULL),
(236, 'daxa', 'jj', '', 0, 1, NULL, '2022-03-31 13:37:34', NULL),
(237, 'daxa', 'jj', 'j@gmail.com', 0, 1, NULL, '2022-03-31 13:38:58', NULL),
(238, 'aa', 'jj', '', 0, 1, NULL, '2022-03-31 13:40:22', NULL),
(245, 'daxa', '', '', 0, 1, NULL, '2022-03-31 13:47:46', '2022-03-31 21:45:59'),
(251, 'daxa', '', '', 0, 1, NULL, '2022-03-31 22:13:47', '2022-04-04 15:17:43'),
(262, 'daxa', 'd', '', 0, 1, NULL, '2022-04-05 08:22:09', NULL),
(263, 'daxa', 'd', '', 0, 1, NULL, '2022-04-05 08:22:28', NULL),
(264, 'daxa', 'd', '', 0, 1, NULL, '2022-04-05 08:24:36', NULL),
(265, 'daxa', 'd', 'j@gmail.com', 0, 1, NULL, '2022-04-05 08:26:48', NULL),
(266, 'daxa', 'd', 'j@gmail.com', 0, 1, NULL, '2022-04-05 08:28:40', NULL),
(267, 'daxa', 'ddd', 'j@gmail.com', 0, 1, NULL, '2022-04-05 08:29:38', '2022-04-05 08:32:12'),
(268, 'daxa', 'ddd', 'j@gmail.com', 0, 1, NULL, '2022-04-05 08:31:54', '2022-04-05 09:36:06'),
(276, 'daxa', 'ddd', 'j@gmail.com', 12, 2, NULL, '2022-04-05 09:37:16', '2022-04-05 09:51:02'),
(277, '', '', '', 0, 1, NULL, '2022-04-05 17:16:56', NULL),
(278, 'daxa', '', '', 0, 1, NULL, '2022-04-05 17:32:37', NULL),
(279, 'dda', '', '', 0, 1, NULL, '2022-04-05 17:33:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `addressId` int(11) NOT NULL,
  `customerId` int(64) NOT NULL,
  `address` varchar(64) NOT NULL,
  `city` varchar(64) NOT NULL,
  `state` varchar(64) NOT NULL,
  `country` varchar(64) NOT NULL,
  `postalCode` int(6) DEFAULT NULL,
  `type` varchar(64) NOT NULL DEFAULT '',
  `same` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`addressId`, `customerId`, `address`, `city`, `state`, `country`, `postalCode`, `type`, `same`) VALUES
(154, 132, 'Balagam (Ghed)', 'JUNAGADH', 'GUJARAT', 'INDIA', 362220, 'billing', 2),
(155, 132, 'Balagam (Ghed)', 'JUNAGADH', 'GUJARAT', 'India', 362220, 'shipping', 2),
(276, 193, '', '', '', '', NULL, 'billing', 2),
(277, 193, '', '', '', '', NULL, 'shipping', 2),
(282, 196, '', '', '', '', NULL, 'billing', 2),
(283, 196, '', '', '', '', NULL, 'shipping', 2),
(284, 197, '', '', '', '', NULL, 'billing', 2),
(285, 197, '', '', '', '', NULL, 'shipping', 2),
(286, 198, 'Balagam (Ghed)', 'JUNAGADH', 'GUJARAT', 'India', 362220, 'billing', 1),
(287, 198, 'Balagam (Ghed)', 'JUNAGADH', 'GUJARAT', 'India', 362220, 'shipping', 1),
(292, 201, '', '', '', '', NULL, 'billing', 2),
(293, 201, '', '', '', '', NULL, 'shipping', 2),
(294, 202, '', '', '', '', NULL, 'billing', 2),
(295, 202, '', '', '', '', NULL, 'shipping', 2),
(296, 203, '', '', '', '', NULL, 'billing', 2),
(297, 203, '', '', '', '', NULL, 'shipping', 2),
(298, 204, '', '', '', '', NULL, 'billing', 2),
(299, 204, '', '', '', '', NULL, 'shipping', 2),
(300, 205, '', '', '', '', NULL, 'billing', 2),
(301, 205, '', '', '', '', NULL, 'shipping', 2),
(302, 206, '', '', '', '', NULL, 'billing', 2),
(303, 206, '', '', '', '', NULL, 'shipping', 2),
(304, 207, '', '', '', '', NULL, 'billing', 2),
(305, 207, '', '', '', '', NULL, 'shipping', 2),
(306, 208, '', '', '', '', NULL, 'billing', 2),
(307, 208, '', '', '', '', NULL, 'shipping', 2),
(308, 209, '', '', '', '', NULL, 'billing', 2),
(309, 209, '', '', '', '', NULL, 'shipping', 2),
(310, 210, '', '', '', '', NULL, 'billing', 2),
(311, 210, '', '', '', '', NULL, 'shipping', 2),
(312, 211, '', '', '', '', NULL, 'billing', 2),
(313, 211, '', '', '', '', NULL, 'shipping', 2),
(314, 212, '', '', '', '', NULL, 'billing', 2),
(315, 212, '', '', '', '', NULL, 'shipping', 2),
(316, 213, '', '', '', '', NULL, 'billing', 2),
(317, 213, '', '', '', '', NULL, 'shipping', 2),
(318, 214, '', '', '', '', NULL, 'billing', 2),
(319, 214, '', '', '', '', NULL, 'shipping', 2),
(320, 215, '', '', '', '', NULL, 'billing', 2),
(321, 215, '', '', '', '', NULL, 'shipping', 2),
(322, 216, '', '', '', '', NULL, 'billing', 2),
(323, 216, '', '', '', '', NULL, 'shipping', 2),
(324, 217, '', '', '', '', NULL, 'billing', 2),
(325, 217, '', '', '', '', NULL, 'shipping', 2),
(326, 218, '', '', '', '', NULL, 'billing', 2),
(327, 218, '', '', '', '', NULL, 'shipping', 2),
(328, 219, '', '', '', '', NULL, 'billing', 2),
(329, 219, '', '', '', '', NULL, 'shipping', 2),
(330, 220, '', '', '', '', NULL, 'billing', 2),
(331, 220, '', '', '', '', NULL, 'shipping', 2),
(336, 223, '', '', '', '', NULL, 'billing', 2),
(337, 223, '', '', '', '', NULL, 'shipping', 2),
(338, 224, '', '', '', '', NULL, 'billing', 2),
(339, 224, '', '', '', '', NULL, 'shipping', 2),
(344, 227, '', '', '', '', NULL, 'billing', 2),
(345, 227, '', '', '', '', NULL, 'shipping', 2),
(346, 228, '', '', '', '', NULL, 'billing', 2),
(347, 228, '', '', '', '', NULL, 'shipping', 2),
(348, 229, '', '', '', '', NULL, 'billing', 2),
(349, 229, '', '', '', '', NULL, 'shipping', 2),
(350, 230, '', '', '', '', NULL, 'billing', 2),
(351, 230, '', '', '', '', NULL, 'shipping', 2),
(352, 231, '', '', '', '', NULL, 'billing', 2),
(353, 231, '', '', '', '', NULL, 'shipping', 2),
(354, 232, '', '', '', '', NULL, 'billing', 2),
(355, 232, '', '', '', '', NULL, 'shipping', 2),
(356, 233, '', '', '', '', NULL, 'billing', 2),
(357, 233, '', '', '', '', NULL, 'shipping', 2),
(358, 234, '', '', '', '', NULL, 'billing', 2),
(359, 234, '', '', '', '', NULL, 'shipping', 2),
(360, 235, '', '', '', '', NULL, 'billing', 2),
(361, 235, '', '', '', '', NULL, 'shipping', 2),
(362, 236, '', '', '', '', NULL, 'billing', 2),
(363, 236, '', '', '', '', NULL, 'shipping', 2),
(364, 237, '', '', '', '', NULL, 'billing', 2),
(365, 237, '', '', '', '', NULL, 'shipping', 2),
(366, 238, '', '', '', '', NULL, 'billing', 2),
(367, 238, '', '', '', '', NULL, 'shipping', 2),
(380, 245, 'Balagam (Ghed)', 'JUNAGADH', 'GUJARAT', 'India', 362220, 'billing', 2),
(381, 245, 'Balagam (Ghed)', 'JUNAGADH', 'GUJARAT', 'India', 362220, 'shipping', 2),
(392, 251, 'Balagam (Ghed)', 'JUNAGADH', 'GUJARAT', 'India', 362220, 'billing', 1),
(393, 251, 'Balagam (Ghed)', 'JUNAGADH', 'GUJARAT', 'India', 362220, 'shipping', 1),
(414, 262, '', '', '', '', NULL, 'billing', 2),
(415, 262, '', '', '', '', NULL, 'shipping', 2),
(416, 263, '', '', '', '', NULL, 'billing', 2),
(417, 263, '', '', '', '', NULL, 'shipping', 2),
(418, 264, '', '', '', '', NULL, 'billing', 2),
(419, 264, '', '', '', '', NULL, 'shipping', 2),
(420, 265, '', '', '', '', NULL, 'billing', 2),
(421, 265, '', '', '', '', NULL, 'shipping', 2),
(422, 266, '', '', '', '', NULL, 'billing', 2),
(423, 266, '', '', '', '', NULL, 'shipping', 2),
(424, 267, 'Balagam (Ghed)1', 'JUNAGADH', 'GUJARAT', 'India', 362220, 'billing', 1),
(425, 267, 'Balagam (Ghed)1', 'JUNAGADH', 'GUJARAT', 'India', 362220, 'shipping', 1),
(426, 268, 'Balagam (Ghed)', 'JUNAGADH', 'GUJARAT', 'India', 362220, 'billing', 1),
(427, 268, 'Balagam (Ghed)', 'JUNAGADH', 'GUJARAT', 'India', 362220, 'shipping', 1),
(442, 276, 'Balagam (Ghed)', 'JUNAGADH', 'GUJARAT', 'India', 362220, 'billing', 1),
(443, 276, 'Balagam (Ghed)', 'JUNAGADH', 'GUJARAT', 'India', 362220, 'shipping', 1),
(444, 277, '', '', '', '', NULL, 'billing', 2),
(445, 277, '', '', '', '', NULL, 'shipping', 2),
(446, 278, '', '', '', '', NULL, 'billing', 2),
(447, 278, '', '', '', '', NULL, 'shipping', 2),
(448, 279, 'Balagam (Ghed)11', 'JUNAGADH', 'GUJARAT', 'India', 362220, 'billing', 1),
(449, 279, 'Balagam (Ghed)11', 'JUNAGADH', 'GUJARAT', 'India', 362220, 'shipping', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_price`
--

CREATE TABLE `customer_price` (
  `entityId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_price`
--

INSERT INTO `customer_price` (`entityId`, `productId`, `customerId`, `price`) VALUES
(41, 78, 205, 1221),
(42, 79, 205, 100),
(43, 80, 205, 10000),
(44, 82, 205, 3000),
(45, 85, 205, 1222),
(46, 92, 205, 200),
(47, 78, 213, 1222),
(48, 79, 213, 100),
(49, 80, 213, 10000),
(50, 82, 213, 3000),
(51, 85, 213, 1222),
(52, 92, 213, 200),
(53, 96, 213, 150),
(54, 97, 213, 150),
(55, 98, 213, 150),
(56, 99, 213, 150),
(57, 100, 213, 150),
(58, 101, 213, 1222),
(59, 102, 213, 150);

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `pageId` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `code` varchar(64) NOT NULL,
  `content` varchar(64) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 2,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`pageId`, `name`, `code`, `content`, `status`, `createdAt`) VALUES
(22, 'name22', 'code22', 'content22', 1, '0000-00-00 00:00:00'),
(23, 'name23', 'code23', 'content23', 1, '0000-00-00 00:00:00'),
(24, 'name24', 'code24', 'content24', 1, '0000-00-00 00:00:00'),
(25, 'name25', 'code25', 'content25', 1, '0000-00-00 00:00:00'),
(26, 'name26', 'code26', 'content26', 1, '0000-00-00 00:00:00'),
(27, 'name27', 'code27', 'content27', 1, '0000-00-00 00:00:00'),
(28, 'name28', 'code28', 'content28', 1, '0000-00-00 00:00:00'),
(29, 'name29', 'code29', 'content29', 1, '0000-00-00 00:00:00'),
(30, 'name30', 'code30', 'content30', 1, '0000-00-00 00:00:00'),
(31, 'name31', 'code31', 'content31', 1, '0000-00-00 00:00:00'),
(32, 'name32', 'code32', 'content32', 1, '0000-00-00 00:00:00'),
(33, 'name33', 'code33', 'content33', 1, '0000-00-00 00:00:00'),
(34, 'name34', 'code34', 'content34', 1, '0000-00-00 00:00:00'),
(35, 'name35', 'code35', 'content35', 1, '0000-00-00 00:00:00'),
(36, 'name36', 'code36', 'content36', 1, '0000-00-00 00:00:00'),
(37, 'name37', 'code37', 'content37', 1, '0000-00-00 00:00:00'),
(38, 'name38', 'code38', 'content38', 1, '0000-00-00 00:00:00'),
(39, 'name39', 'code39', 'content39', 1, '0000-00-00 00:00:00'),
(40, 'name40', 'code40', 'content40', 1, '0000-00-00 00:00:00'),
(41, 'name41', 'code41', 'content41', 1, '0000-00-00 00:00:00'),
(42, 'name42', 'code42', 'content42', 1, '0000-00-00 00:00:00'),
(43, 'name43', 'code43', 'content43', 1, '0000-00-00 00:00:00'),
(44, 'name44', 'code44', 'content44', 1, '0000-00-00 00:00:00'),
(45, 'name45', 'code45', 'content45', 1, '0000-00-00 00:00:00'),
(46, 'name46', 'code46', 'content46', 1, '0000-00-00 00:00:00'),
(47, 'name47', 'code47', 'content47', 1, '0000-00-00 00:00:00'),
(48, 'name48', 'code48', 'content48', 1, '0000-00-00 00:00:00'),
(49, 'name49', 'code49', 'content49', 1, '0000-00-00 00:00:00'),
(50, 'name50', 'code50', 'content50', 1, '0000-00-00 00:00:00'),
(51, 'name51', 'code51', 'content51', 1, '0000-00-00 00:00:00'),
(52, 'name52', 'code52', 'content52', 1, '0000-00-00 00:00:00'),
(53, 'name53', 'code53', 'content53', 1, '0000-00-00 00:00:00'),
(54, 'name54', 'code54', 'content54', 1, '0000-00-00 00:00:00'),
(55, 'name55', 'code55', 'content55', 1, '0000-00-00 00:00:00'),
(56, 'name56', 'code56', 'content56', 1, '0000-00-00 00:00:00'),
(57, 'name57', 'code57', 'content57', 1, '0000-00-00 00:00:00'),
(58, 'name58', 'code58', 'content58', 1, '0000-00-00 00:00:00'),
(59, 'name59', 'code59', 'content59', 1, '0000-00-00 00:00:00'),
(60, 'name60', 'code60', 'content60', 1, '0000-00-00 00:00:00'),
(61, 'name61', 'code61', 'content61', 1, '0000-00-00 00:00:00'),
(62, 'name62', 'code62', 'content62', 1, '0000-00-00 00:00:00'),
(63, 'name63', 'code63', 'content63', 1, '0000-00-00 00:00:00'),
(64, 'name64', 'code64', 'content64', 1, '0000-00-00 00:00:00'),
(65, 'name65', 'code65', 'content65', 1, '0000-00-00 00:00:00'),
(66, 'name66', 'code66', 'content66', 1, '0000-00-00 00:00:00'),
(67, 'name67', 'code67', 'content67', 1, '0000-00-00 00:00:00'),
(68, 'name68', 'code68', 'content68', 1, '0000-00-00 00:00:00'),
(69, 'name69', 'code69', 'content69', 1, '0000-00-00 00:00:00'),
(70, 'name70', 'code70', 'content70', 1, '0000-00-00 00:00:00'),
(71, 'name71', 'code71', 'content71', 1, '0000-00-00 00:00:00'),
(72, 'name72', 'code72', 'content72', 1, '0000-00-00 00:00:00'),
(73, 'name73', 'code73', 'content73', 1, '0000-00-00 00:00:00'),
(74, 'name74', 'code74', 'content74', 1, '0000-00-00 00:00:00'),
(75, 'name75', 'code75', 'content75', 1, '0000-00-00 00:00:00'),
(76, 'name76', 'code76', 'content76', 1, '0000-00-00 00:00:00'),
(77, 'name77', 'code77', 'content77', 1, '0000-00-00 00:00:00'),
(78, 'name78', 'code78', 'content78', 1, '0000-00-00 00:00:00'),
(79, 'name79', 'code79', 'content79', 1, '0000-00-00 00:00:00'),
(80, 'name80', 'code80', 'content80', 1, '0000-00-00 00:00:00'),
(81, 'name81', 'code81', 'content81', 1, '0000-00-00 00:00:00'),
(82, 'name82', 'code82', 'content82', 1, '0000-00-00 00:00:00'),
(83, 'name83', 'code83', 'content83', 1, '0000-00-00 00:00:00'),
(84, 'name84', 'code84', 'content84', 1, '0000-00-00 00:00:00'),
(85, 'name85', 'code85', 'content85', 1, '0000-00-00 00:00:00'),
(86, 'name86', 'code86', 'content86', 1, '0000-00-00 00:00:00'),
(87, 'name87', 'code87', 'content87', 1, '0000-00-00 00:00:00'),
(88, 'name88', 'code88', 'content88', 1, '0000-00-00 00:00:00'),
(89, 'name89', 'code89', 'content89', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `sku` varchar(64) NOT NULL,
  `tax` decimal(10,0) NOT NULL,
  `cost` float NOT NULL,
  `discount` float NOT NULL,
  `discountMode` tinyint(4) NOT NULL DEFAULT 2,
  `base` int(11) DEFAULT NULL,
  `thumb` int(11) DEFAULT NULL,
  `small` int(11) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `name`, `price`, `quantity`, `sku`, `tax`, `cost`, `discount`, `discountMode`, `base`, `thumb`, `small`, `createdAt`, `updatedAt`, `status`) VALUES
(78, 'realme 9', 1222, 20, 'sku', '10', 1000, 10, 1, 100, 100, NULL, '2022-03-17 20:44:11', '2022-03-23 12:09:57', 1),
(79, 'mi', 100, 10, 'sku12', '5', 90, 5, 2, 101, NULL, NULL, '2022-03-20 17:20:22', '2022-03-23 12:09:52', 1),
(80, 'realme 11', 10000, 20, 'realme', '10', 9000, 10, 1, 102, NULL, NULL, '2022-03-20 17:20:45', '2022-03-23 12:09:36', 1),
(82, 'Charger', 3000, 40, 'charger sku', '10', 2850, 2, 2, NULL, NULL, NULL, '2022-03-23 13:21:05', '2022-03-23 19:01:05', 1),
(85, 'realme 9', 1222, 3, 'sku11224412', '20', 1000.22, 10, 2, NULL, NULL, NULL, '2022-03-23 19:02:20', '2022-03-24 10:40:18', 1),
(92, 'realme 9', 200, 1, 'sku1212', '10', 100, 10, 1, 105, NULL, NULL, '2022-03-31 16:14:02', '2022-04-05 17:54:06', 1),
(96, 'realme 9', 150, 1, 'aass', '10', 100, 10, 2, NULL, NULL, NULL, '2022-04-05 17:41:15', NULL, 1),
(97, 'realme 9', 150, 0, 'skuwewe', '10', 100, 10, 2, NULL, NULL, NULL, '2022-04-05 17:41:57', NULL, 1),
(98, 'mi', 150, 0, 'sku111123', '10', 100, 10, 2, NULL, NULL, NULL, '2022-04-05 17:43:02', NULL, 1),
(99, 'new item', 150, 0, 'sku12121', '10', 100, 10, 2, NULL, NULL, NULL, '2022-04-05 17:49:03', '2022-04-05 17:49:07', 1),
(100, 'realme 9', 150, 0, 'sku121111', '10', 100, 10, 2, NULL, NULL, NULL, '2022-04-05 17:51:38', '2022-04-05 17:51:42', 1),
(101, 'realme 9', 1222, 1, 'sku32', '10', 1000, 10, 2, NULL, NULL, NULL, '2022-04-05 17:55:15', NULL, 1),
(102, 'realme 9', 150, 0, 'sku545', '10', 100, 10, 2, NULL, 106, NULL, '2022-04-05 18:02:57', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_media`
--

CREATE TABLE `product_media` (
  `mediaId` int(11) NOT NULL,
  `productId` int(11) DEFAULT NULL,
  `media` varchar(64) NOT NULL,
  `gallery` tinyint(4) NOT NULL DEFAULT 2,
  `status` tinyint(4) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_media`
--

INSERT INTO `product_media` (`mediaId`, `productId`, `media`, `gallery`, `status`) VALUES
(100, 78, '54_17032022080327.png', 2, 2),
(101, 79, '54_21032022040306.png', 2, 2),
(102, 80, 'abt4_21032022040342.jpg', 2, 2),
(105, 92, '54_05042022110433.png', 2, 2),
(106, 102, '54_05042022060411.png', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `salseman`
--

CREATE TABLE `salseman` (
  `salsemanId` int(11) NOT NULL,
  `firstName` varchar(64) NOT NULL,
  `lastName` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `percentage` float NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 2,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salseman`
--

INSERT INTO `salseman` (`salsemanId`, `firstName`, `lastName`, `email`, `mobile`, `percentage`, `status`, `createdAt`, `updatedAt`) VALUES
(6, 'dd', 'dd', 'dd@gmail.com', '1212', 10, 2, '2022-03-01 12:16:18', NULL),
(7, 'dd', 'dd', 'dd@gmail.com', '1212', 20, 1, '2022-03-02 10:04:07', '2022-04-03 19:50:44'),
(11, 'dd1', 'dd', 'dd@gmail.com', '1212', 30, 1, '2022-04-03 21:13:09', '2022-04-04 13:42:23'),
(12, 'dd', 'dd', 'dd@gmail.com', '1212', 30, 1, '2022-04-04 13:42:37', '2022-04-05 19:50:20'),
(14, 'dd', 'dd', 'dd@gmail.com', '1212', 30, 1, '2022-04-05 19:50:40', NULL),
(15, 'dd', 'dd', 'dd@gmail.com', '1212', 30, 1, '2022-04-05 19:57:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendorId` int(11) NOT NULL,
  `firstName` varchar(64) NOT NULL,
  `lastName` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `mobile` varchar(64) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 2,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendorId`, `firstName`, `lastName`, `email`, `mobile`, `status`, `createdAt`, `updatedAt`) VALUES
(1, 'daxa', 'daxa', 'daxa@gmail.com', '111', 2, '2022-03-01 12:58:00', '2022-03-30 13:21:42'),
(13, 'daxa', 'dd', 'dd@gmail.com', '121', 1, '2022-03-14 22:22:43', '2022-04-04 10:25:03'),
(17, 'daxad', 'dd', 'dd@gmail.com', '121', 1, '2022-04-04 10:34:43', '2022-04-05 16:23:34'),
(19, 'daxa', 'dd', 'dd@gmail.com', '121', 1, '2022-04-05 16:26:09', NULL),
(23, '', '', '', '', 1, '2022-04-05 17:21:41', '2022-04-05 17:29:21'),
(24, 'daxa', '', '', '', 1, '2022-04-05 17:29:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_address`
--

CREATE TABLE `vendor_address` (
  `addressId` int(11) NOT NULL,
  `vendorId` int(11) NOT NULL,
  `address` varchar(64) NOT NULL,
  `city` varchar(64) NOT NULL,
  `state` varchar(64) NOT NULL,
  `postalCode` int(11) NOT NULL,
  `country` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor_address`
--

INSERT INTO `vendor_address` (`addressId`, `vendorId`, `address`, `city`, `state`, `postalCode`, `country`) VALUES
(1, 1, 'Balagam (Ghed)1', 'JUNAGADH', 'GUJARAT', 362220, 'India'),
(9, 13, 'ws1', 'wewe', 'wew', 321200, 'we'),
(10, 17, 'Balagam (Ghed)', 'JUNAGADH', 'GUJARAT', 362220, 'India'),
(11, 23, 'Balagam (Ghed)', 'JUNAGADH', 'GUJARAT', 362220, 'India'),
(12, 24, 'Balagam (Ghed)', 'JUNAGADH', 'GUJARAT', 362220, 'India');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminId`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`),
  ADD KEY `parentId` (`parentId`),
  ADD KEY `base` (`base`),
  ADD KEY `thumb` (`thumb`),
  ADD KEY `small` (`small`);

--
-- Indexes for table `category_media`
--
ALTER TABLE `category_media`
  ADD PRIMARY KEY (`mediaId`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Indexes for table `category_product`
--
ALTER TABLE `category_product`
  ADD PRIMARY KEY (`entityId`),
  ADD UNIQUE KEY `productId` (`productId`,`categoryId`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`configId`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerId`),
  ADD KEY `salsemanId` (`salsemanId`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `address_ibfk_1` (`customerId`);

--
-- Indexes for table `customer_price`
--
ALTER TABLE `customer_price`
  ADD PRIMARY KEY (`entityId`),
  ADD UNIQUE KEY `productId` (`productId`,`customerId`),
  ADD KEY `customerId` (`customerId`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`pageId`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`),
  ADD UNIQUE KEY `sku` (`sku`),
  ADD KEY `base` (`base`),
  ADD KEY `thumb` (`thumb`),
  ADD KEY `small` (`small`);

--
-- Indexes for table `product_media`
--
ALTER TABLE `product_media`
  ADD PRIMARY KEY (`mediaId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `salseman`
--
ALTER TABLE `salseman`
  ADD PRIMARY KEY (`salsemanId`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendorId`);

--
-- Indexes for table `vendor_address`
--
ALTER TABLE `vendor_address`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `vendorId` (`vendorId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;

--
-- AUTO_INCREMENT for table `category_media`
--
ALTER TABLE `category_media`
  MODIFY `mediaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `category_product`
--
ALTER TABLE `category_product`
  MODIFY `entityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `configId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=280;

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=450;

--
-- AUTO_INCREMENT for table `customer_price`
--
ALTER TABLE `customer_price`
  MODIFY `entityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `pageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `product_media`
--
ALTER TABLE `product_media`
  MODIFY `mediaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `salseman`
--
ALTER TABLE `salseman`
  MODIFY `salsemanId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `vendor_address`
--
ALTER TABLE `vendor_address`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`parentId`) REFERENCES `category` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `category_ibfk_2` FOREIGN KEY (`base`) REFERENCES `category_media` (`mediaId`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `category_ibfk_3` FOREIGN KEY (`thumb`) REFERENCES `category_media` (`mediaId`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `category_ibfk_4` FOREIGN KEY (`small`) REFERENCES `category_media` (`mediaId`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `category_media`
--
ALTER TABLE `category_media`
  ADD CONSTRAINT `category_media_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `category` (`categoryId`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `category_product`
--
ALTER TABLE `category_product`
  ADD CONSTRAINT `category_product_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `category` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `category_product_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`salsemanId`) REFERENCES `salseman` (`salsemanId`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD CONSTRAINT `customer_address_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_price`
--
ALTER TABLE `customer_price`
  ADD CONSTRAINT `customer_price_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_price_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`base`) REFERENCES `product_media` (`mediaId`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`thumb`) REFERENCES `product_media` (`mediaId`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`small`) REFERENCES `product_media` (`mediaId`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `product_media`
--
ALTER TABLE `product_media`
  ADD CONSTRAINT `product_media_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendor_address`
--
ALTER TABLE `vendor_address`
  ADD CONSTRAINT `vendor_address_ibfk_1` FOREIGN KEY (`vendorId`) REFERENCES `vendor` (`vendorId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
