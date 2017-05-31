-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2017 at 03:47 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iabamun_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `army`
--

CREATE TABLE `army` (
  `Army_ID` int(255) NOT NULL,
  `Effectiveness` int(10) NOT NULL,
  `Level` int(10) NOT NULL,
  `Flanking_Range` int(10) NOT NULL,
  `Armor` int(10) NOT NULL,
  `Attack_Power` int(10) NOT NULL,
  `Shielding_Power` int(10) NOT NULL,
  `Amount` int(11) NOT NULL,
  `Morale` int(10) NOT NULL,
  `Piercing` int(10) NOT NULL,
  `Shredding` int(10) NOT NULL,
  `Recrutement_Time` int(10) NOT NULL,
  `Unit_Name` varchar(30) NOT NULL,
  `Village_ID` int(255) NOT NULL,
  `Unit_ID` int(255) NOT NULL,
  `Wood` int(20) NOT NULL,
  `Stone` int(11) NOT NULL,
  `Metals` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `army`
--

INSERT INTO `army` (`Army_ID`, `Effectiveness`, `Level`, `Flanking_Range`, `Armor`, `Attack_Power`, `Shielding_Power`, `Amount`, `Morale`, `Piercing`, `Shredding`, `Recrutement_Time`, `Unit_Name`, `Village_ID`, `Unit_ID`, `Wood`, `Stone`, `Metals`) VALUES
(1, 100, 1, 100, 10, 10, 10, 4154, 10, 10, 10, 101, 'Spear_Man', 1, 1, 40, 0, 50),
(2, 100, 1, 1, 1, 1, 1, 2, 1, 1, 1, 10, 'Sword_Man', 1, 2, 30, 0, 40);

-- --------------------------------------------------------

--
-- Table structure for table `bericht`
--

CREATE TABLE `bericht` (
  `Bericht_ID` int(255) NOT NULL,
  `Reciever_ID` int(255) NOT NULL,
  `Zender_ID` int(255) NOT NULL,
  `TimeStamp` datetime NOT NULL,
  `Bericht` varchar(255) NOT NULL,
  `Subject` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `building`
--

CREATE TABLE `building` (
  `Building_ID` int(255) NOT NULL,
  `Building_Name` varchar(255) NOT NULL,
  `Spawn_Rate` int(255) NOT NULL,
  `HP` int(255) NOT NULL,
  `Armor` int(255) NOT NULL,
  `Level` int(10) NOT NULL,
  `Time_to_Next` int(255) NOT NULL,
  `Village_ID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `building`
--

INSERT INTO `building` (`Building_ID`, `Building_Name`, `Spawn_Rate`, `HP`, `Armor`, `Level`, `Time_to_Next`, `Village_ID`) VALUES
(1, 'Wood', 4500, 500, 100, 5, 30, 1),
(2, 'Metals', 4500, 500, 100, 8, 30, 1),
(3, 'Food', 4500, 100, 100, 4, 30, 1),
(4, 'Stone', 4500, 500, 100, 4, 30, 1),
(25, 'City_Hall', 0, 800, 300, 3, 140, 1);

-- --------------------------------------------------------

--
-- Table structure for table `building_in_progress`
--

CREATE TABLE `building_in_progress` (
  `ID` int(255) NOT NULL,
  `Village_ID` int(255) NOT NULL,
  `End_Time` int(255) NOT NULL,
  `Building_ID` int(255) NOT NULL,
  `Level` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `building_list`
--

CREATE TABLE `building_list` (
  `Building_ID` int(255) NOT NULL,
  `Building_Name` varchar(255) NOT NULL,
  `Spawn_Rate` int(255) NOT NULL,
  `HP` int(255) NOT NULL,
  `Armor` int(255) NOT NULL,
  `Time_to_Next` int(255) NOT NULL,
  `Wood` int(255) NOT NULL,
  `Metals` int(255) NOT NULL,
  `Stone` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `building_list`
--

INSERT INTO `building_list` (`Building_ID`, `Building_Name`, `Spawn_Rate`, `HP`, `Armor`, `Time_to_Next`, `Wood`, `Metals`, `Stone`) VALUES
(1, 'Wood', 4500, 500, 100, 30, 500, 500, 500),
(2, 'Metals', 4500, 500, 100, 30, 500, 500, 500),
(3, 'Food', 4500, 500, 100, 30, 500, 500, 500),
(4, 'Stone', 4500, 500, 100, 30, 500, 500, 500),
(5, 'City_Hall', 0, 800, 300, 140, 500, 500, 500);

-- --------------------------------------------------------

--
-- Table structure for table `cells`
--

CREATE TABLE `cells` (
  `Cell_ID` int(255) NOT NULL,
  `Coordinates` varchar(255) NOT NULL,
  `Terrain` int(255) NOT NULL,
  `Map_ID` int(10) NOT NULL,
  `Resource_ID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cells`
--

INSERT INTO `cells` (`Cell_ID`, `Coordinates`, `Terrain`, `Map_ID`, `Resource_ID`) VALUES
(1, '0-0', 1, 1, 1),
(2, '0-1', 1, 1, 1),
(3, '0-2', 1, 1, 1),
(4, '0-3', 1, 1, 1),
(5, '0-4', 1, 1, 1),
(6, '0-5', 1, 1, 1),
(7, '0-6', 1, 1, 1),
(8, '0-7', 1, 1, 1),
(9, '0-8', 1, 1, 1),
(10, '0-9', 1, 1, 1),
(11, '0-10', 1, 1, 1),
(12, '0-11', 1, 1, 1),
(13, '0-12', 1, 1, 1),
(14, '0-13', 1, 1, 1),
(15, '0-14', 1, 1, 1),
(16, '0-15', 1, 1, 1),
(17, '0-16', 1, 1, 1),
(18, '0-17', 1, 1, 1),
(19, '0-18', 1, 1, 1),
(20, '0-19', 1, 1, 1),
(21, '1-0', 1, 1, 1),
(22, '1-1', 1, 1, 1),
(23, '1-2', 1, 1, 1),
(24, '1-3', 1, 1, 1),
(25, '1-4', 1, 1, 1),
(26, '1-5', 1, 1, 1),
(27, '1-6', 1, 1, 1),
(28, '1-7', 1, 1, 1),
(29, '1-8', 1, 1, 1),
(30, '1-9', 1, 1, 1),
(31, '1-10', 1, 1, 1),
(32, '1-11', 1, 1, 1),
(33, '1-12', 1, 1, 1),
(34, '1-13', 1, 1, 1),
(35, '1-14', 1, 1, 1),
(36, '1-15', 1, 1, 1),
(37, '1-16', 1, 1, 1),
(38, '1-17', 1, 1, 1),
(39, '1-18', 1, 1, 1),
(40, '1-19', 1, 1, 1),
(41, '2-0', 1, 1, 1),
(42, '2-1', 1, 1, 1),
(43, '2-2', 1, 1, 1),
(44, '2-3', 1, 1, 1),
(45, '2-4', 1, 1, 1),
(46, '2-5', 1, 1, 1),
(47, '2-6', 1, 1, 1),
(48, '2-7', 1, 1, 1),
(49, '2-8', 1, 1, 1),
(50, '2-9', 1, 1, 1),
(51, '2-10', 1, 1, 1),
(52, '2-11', 1, 1, 1),
(53, '2-12', 1, 1, 1),
(54, '2-13', 1, 1, 1),
(55, '2-14', 1, 1, 1),
(56, '2-15', 1, 1, 1),
(57, '2-16', 1, 1, 1),
(58, '2-17', 1, 1, 1),
(59, '2-18', 1, 1, 1),
(60, '2-19', 1, 1, 1),
(61, '3-0', 1, 1, 1),
(62, '3-1', 1, 1, 1),
(63, '3-2', 1, 1, 1),
(64, '3-3', 1, 1, 1),
(65, '3-4', 1, 1, 1),
(66, '3-5', 1, 1, 1),
(67, '3-6', 1, 1, 1),
(68, '3-7', 1, 1, 1),
(69, '3-8', 1, 1, 1),
(70, '3-9', 1, 1, 1),
(71, '3-10', 1, 1, 1),
(72, '3-11', 1, 1, 1),
(73, '3-12', 1, 1, 1),
(74, '3-13', 1, 1, 1),
(75, '3-14', 1, 1, 1),
(76, '3-15', 1, 1, 1),
(77, '3-16', 1, 1, 1),
(78, '3-17', 1, 1, 1),
(79, '3-18', 1, 1, 1),
(80, '3-19', 1, 1, 1),
(81, '4-0', 1, 1, 1),
(82, '4-1', 1, 1, 1),
(83, '4-2', 1, 1, 1),
(84, '4-3', 1, 1, 1),
(85, '4-4', 1, 1, 1),
(86, '4-5', 1, 1, 1),
(87, '4-6', 1, 1, 1),
(88, '4-7', 1, 1, 1),
(89, '4-8', 1, 1, 1),
(90, '4-9', 1, 1, 1),
(91, '4-10', 1, 1, 1),
(92, '4-11', 1, 1, 1),
(93, '4-12', 1, 1, 1),
(94, '4-13', 1, 1, 1),
(95, '4-14', 1, 1, 1),
(96, '4-15', 1, 1, 1),
(97, '4-16', 1, 1, 1),
(98, '4-17', 1, 1, 1),
(99, '4-18', 1, 1, 1),
(100, '4-19', 1, 1, 1),
(101, '5-0', 1, 1, 1),
(102, '5-1', 1, 1, 1),
(103, '5-2', 1, 1, 1),
(104, '5-3', 1, 1, 1),
(105, '5-4', 1, 1, 1),
(106, '5-5', 1, 1, 1),
(107, '5-6', 1, 1, 1),
(108, '5-7', 1, 1, 1),
(109, '5-8', 1, 1, 1),
(110, '5-9', 1, 1, 1),
(111, '5-10', 1, 1, 1),
(112, '5-11', 1, 1, 1),
(113, '5-12', 1, 1, 1),
(114, '5-13', 1, 1, 1),
(115, '5-14', 1, 1, 1),
(116, '5-15', 1, 1, 1),
(117, '5-16', 1, 1, 1),
(118, '5-17', 1, 1, 1),
(119, '5-18', 1, 1, 1),
(120, '5-19', 1, 1, 1),
(121, '6-0', 1, 1, 1),
(122, '6-1', 1, 1, 1),
(123, '6-2', 1, 1, 1),
(124, '6-3', 1, 1, 1),
(125, '6-4', 1, 1, 1),
(126, '6-5', 1, 1, 1),
(127, '6-6', 1, 1, 1),
(128, '6-7', 1, 1, 1),
(129, '6-8', 1, 1, 1),
(130, '6-9', 1, 1, 1),
(131, '6-10', 1, 1, 1),
(132, '6-11', 1, 1, 1),
(133, '6-12', 1, 1, 1),
(134, '6-13', 1, 1, 1),
(135, '6-14', 1, 1, 1),
(136, '6-15', 1, 1, 1),
(137, '6-16', 1, 1, 1),
(138, '6-17', 1, 1, 1),
(139, '6-18', 1, 1, 1),
(140, '6-19', 1, 1, 1),
(141, '7-0', 1, 1, 1),
(142, '7-1', 1, 1, 1),
(143, '7-2', 1, 1, 1),
(144, '7-3', 1, 1, 1),
(145, '7-4', 1, 1, 1),
(146, '7-5', 1, 1, 1),
(147, '7-6', 1, 1, 1),
(148, '7-7', 1, 1, 1),
(149, '7-8', 1, 1, 1),
(150, '7-9', 1, 1, 1),
(151, '7-10', 1, 1, 1),
(152, '7-11', 1, 1, 1),
(153, '7-12', 1, 1, 1),
(154, '7-13', 1, 1, 1),
(155, '7-14', 1, 1, 1),
(156, '7-15', 1, 1, 1),
(157, '7-16', 1, 1, 1),
(158, '7-17', 1, 1, 1),
(159, '7-18', 1, 1, 1),
(160, '7-19', 1, 1, 1),
(161, '8-0', 1, 1, 1),
(162, '8-1', 1, 1, 1),
(163, '8-2', 1, 1, 1),
(164, '8-3', 1, 1, 1),
(165, '8-4', 1, 1, 1),
(166, '8-5', 1, 1, 1),
(167, '8-6', 1, 1, 1),
(168, '8-7', 1, 1, 1),
(169, '8-8', 1, 1, 1),
(170, '8-9', 1, 1, 1),
(171, '8-10', 1, 1, 1),
(172, '8-11', 1, 1, 1),
(173, '8-12', 1, 1, 1),
(174, '8-13', 1, 1, 1),
(175, '8-14', 1, 1, 1),
(176, '8-15', 1, 1, 1),
(177, '8-16', 1, 1, 1),
(178, '8-17', 1, 1, 1),
(179, '8-18', 1, 1, 1),
(180, '8-19', 1, 1, 1),
(181, '9-0', 1, 1, 1),
(182, '9-1', 1, 1, 1),
(183, '9-2', 1, 1, 1),
(184, '9-3', 1, 1, 1),
(185, '9-4', 1, 1, 1),
(186, '9-5', 1, 1, 1),
(187, '9-6', 1, 1, 1),
(188, '9-7', 1, 1, 1),
(189, '9-8', 1, 1, 1),
(190, '9-9', 1, 1, 1),
(191, '9-10', 1, 1, 1),
(192, '9-11', 1, 1, 1),
(193, '9-12', 1, 1, 1),
(194, '9-13', 1, 1, 1),
(195, '9-14', 1, 1, 1),
(196, '9-15', 1, 1, 1),
(197, '9-16', 1, 1, 1),
(198, '9-17', 1, 1, 1),
(199, '9-18', 1, 1, 1),
(200, '9-19', 1, 1, 1),
(201, '10-0', 1, 1, 1),
(202, '10-1', 1, 1, 1),
(203, '10-2', 1, 1, 1),
(204, '10-3', 1, 1, 1),
(205, '10-4', 1, 1, 1),
(206, '10-5', 1, 1, 1),
(207, '10-6', 1, 1, 1),
(208, '10-7', 1, 1, 1),
(209, '10-8', 1, 1, 1),
(210, '10-9', 1, 1, 1),
(211, '10-10', 1, 1, 1),
(212, '10-11', 1, 1, 1),
(213, '10-12', 1, 1, 1),
(214, '10-13', 1, 1, 1),
(215, '10-14', 1, 1, 1),
(216, '10-15', 1, 1, 1),
(217, '10-16', 1, 1, 1),
(218, '10-17', 1, 1, 1),
(219, '10-18', 1, 1, 1),
(220, '10-19', 1, 1, 1),
(221, '11-0', 1, 1, 1),
(222, '11-1', 1, 1, 1),
(223, '11-2', 1, 1, 1),
(224, '11-3', 1, 1, 1),
(225, '11-4', 1, 1, 1),
(226, '11-5', 1, 1, 1),
(227, '11-6', 1, 1, 1),
(228, '11-7', 1, 1, 1),
(229, '11-8', 1, 1, 1),
(230, '11-9', 1, 1, 1),
(231, '11-10', 1, 1, 1),
(232, '11-11', 1, 1, 1),
(233, '11-12', 1, 1, 1),
(234, '11-13', 1, 1, 1),
(235, '11-14', 1, 1, 1),
(236, '11-15', 1, 1, 1),
(237, '11-16', 1, 1, 1),
(238, '11-17', 1, 1, 1),
(239, '11-18', 1, 1, 1),
(240, '11-19', 1, 1, 1),
(241, '12-0', 1, 1, 1),
(242, '12-1', 1, 1, 1),
(243, '12-2', 1, 1, 1),
(244, '12-3', 1, 1, 1),
(245, '12-4', 1, 1, 1),
(246, '12-5', 1, 1, 1),
(247, '12-6', 1, 1, 1),
(248, '12-7', 1, 1, 1),
(249, '12-8', 1, 1, 1),
(250, '12-9', 1, 1, 1),
(251, '12-10', 1, 1, 1),
(252, '12-11', 1, 1, 1),
(253, '12-12', 1, 1, 1),
(254, '12-13', 1, 1, 1),
(255, '12-14', 1, 1, 1),
(256, '12-15', 1, 1, 1),
(257, '12-16', 1, 1, 1),
(258, '12-17', 1, 1, 1),
(259, '12-18', 1, 1, 1),
(260, '12-19', 1, 1, 1),
(261, '13-0', 1, 1, 1),
(262, '13-1', 1, 1, 1),
(263, '13-2', 1, 1, 1),
(264, '13-3', 1, 1, 1),
(265, '13-4', 1, 1, 1),
(266, '13-5', 1, 1, 1),
(267, '13-6', 1, 1, 1),
(268, '13-7', 1, 1, 1),
(269, '13-8', 1, 1, 1),
(270, '13-9', 1, 1, 1),
(271, '13-10', 1, 1, 1),
(272, '13-11', 1, 1, 1),
(273, '13-12', 1, 1, 1),
(274, '13-13', 1, 1, 1),
(275, '13-14', 1, 1, 1),
(276, '13-15', 1, 1, 1),
(277, '13-16', 1, 1, 1),
(278, '13-17', 1, 1, 1),
(279, '13-18', 1, 1, 1),
(280, '13-19', 1, 1, 1),
(281, '14-0', 1, 1, 1),
(282, '14-1', 1, 1, 1),
(283, '14-2', 1, 1, 1),
(284, '14-3', 1, 1, 1),
(285, '14-4', 1, 1, 1),
(286, '14-5', 1, 1, 1),
(287, '14-6', 1, 1, 1),
(288, '14-7', 1, 1, 1),
(289, '14-8', 1, 1, 1),
(290, '14-9', 1, 1, 1),
(291, '14-10', 1, 1, 1),
(292, '14-11', 1, 1, 1),
(293, '14-12', 1, 1, 1),
(294, '14-13', 1, 1, 1),
(295, '14-14', 1, 1, 1),
(296, '14-15', 1, 1, 1),
(297, '14-16', 1, 1, 1),
(298, '14-17', 1, 1, 1),
(299, '14-18', 1, 1, 1),
(300, '14-19', 1, 1, 1),
(301, '15-0', 1, 1, 1),
(302, '15-1', 1, 1, 1),
(303, '15-2', 1, 1, 1),
(304, '15-3', 1, 1, 1),
(305, '15-4', 1, 1, 1),
(306, '15-5', 1, 1, 1),
(307, '15-6', 1, 1, 1),
(308, '15-7', 1, 1, 1),
(309, '15-8', 1, 1, 1),
(310, '15-9', 1, 1, 1),
(311, '15-10', 1, 1, 1),
(312, '15-11', 1, 1, 1),
(313, '15-12', 1, 1, 1),
(314, '15-13', 1, 1, 1),
(315, '15-14', 1, 1, 1),
(316, '15-15', 1, 1, 1),
(317, '15-16', 1, 1, 1),
(318, '15-17', 1, 1, 1),
(319, '15-18', 1, 1, 1),
(320, '15-19', 1, 1, 1),
(321, '16-0', 1, 1, 1),
(322, '16-1', 1, 1, 1),
(323, '16-2', 1, 1, 1),
(324, '16-3', 1, 1, 1),
(325, '16-4', 1, 1, 1),
(326, '16-5', 1, 1, 1),
(327, '16-6', 1, 1, 1),
(328, '16-7', 1, 1, 1),
(329, '16-8', 1, 1, 1),
(330, '16-9', 1, 1, 1),
(331, '16-10', 1, 1, 1),
(332, '16-11', 1, 1, 1),
(333, '16-12', 1, 1, 1),
(334, '16-13', 1, 1, 1),
(335, '16-14', 1, 1, 1),
(336, '16-15', 1, 1, 1),
(337, '16-16', 1, 1, 1),
(338, '16-17', 1, 1, 1),
(339, '16-18', 1, 1, 1),
(340, '16-19', 1, 1, 1),
(341, '17-0', 1, 1, 1),
(342, '17-1', 1, 1, 1),
(343, '17-2', 1, 1, 1),
(344, '17-3', 1, 1, 1),
(345, '17-4', 1, 1, 1),
(346, '17-5', 1, 1, 1),
(347, '17-6', 1, 1, 1),
(348, '17-7', 1, 1, 1),
(349, '17-8', 1, 1, 1),
(350, '17-9', 1, 1, 1),
(351, '17-10', 1, 1, 1),
(352, '17-11', 1, 1, 1),
(353, '17-12', 1, 1, 1),
(354, '17-13', 1, 1, 1),
(355, '17-14', 1, 1, 1),
(356, '17-15', 1, 1, 1),
(357, '17-16', 1, 1, 1),
(358, '17-17', 1, 1, 1),
(359, '17-18', 1, 1, 1),
(360, '17-19', 1, 1, 1),
(361, '18-0', 1, 1, 1),
(362, '18-1', 1, 1, 1),
(363, '18-2', 1, 1, 1),
(364, '18-3', 1, 1, 1),
(365, '18-4', 1, 1, 1),
(366, '18-5', 1, 1, 1),
(367, '18-6', 1, 1, 1),
(368, '18-7', 1, 1, 1),
(369, '18-8', 1, 1, 1),
(370, '18-9', 1, 1, 1),
(371, '18-10', 1, 1, 1),
(372, '18-11', 1, 1, 1),
(373, '18-12', 1, 1, 1),
(374, '18-13', 1, 1, 1),
(375, '18-14', 1, 1, 1),
(376, '18-15', 1, 1, 1),
(377, '18-16', 1, 1, 1),
(378, '18-17', 1, 1, 1),
(379, '18-18', 1, 1, 1),
(380, '18-19', 1, 1, 1),
(381, '19-0', 1, 1, 1),
(382, '19-1', 1, 1, 1),
(383, '19-2', 1, 1, 1),
(384, '19-3', 1, 1, 1),
(385, '19-4', 1, 1, 1),
(386, '19-5', 1, 1, 1),
(387, '19-6', 1, 1, 1),
(388, '19-7', 1, 1, 1),
(389, '19-8', 1, 1, 1),
(390, '19-9', 1, 1, 1),
(391, '19-10', 1, 1, 1),
(392, '19-11', 1, 1, 1),
(393, '19-12', 1, 1, 1),
(394, '19-13', 1, 1, 1),
(395, '19-14', 1, 1, 1),
(396, '19-15', 1, 1, 1),
(397, '19-16', 1, 1, 1),
(398, '19-17', 1, 1, 1),
(399, '19-18', 1, 1, 1),
(400, '19-19', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `Chat_ID` int(255) NOT NULL,
  `User1_ID` int(255) NOT NULL,
  `User2_ID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chat_message`
--

CREATE TABLE `chat_message` (
  `Message_ID` int(255) NOT NULL,
  `Chat_ID` int(255) NOT NULL,
  `User_ID` int(255) NOT NULL,
  `TimeStamp` datetime NOT NULL,
  `Bericht` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ordered_units`
--

CREATE TABLE `ordered_units` (
  `ID` int(255) NOT NULL,
  `Spear_Man` int(50) NOT NULL,
  `Sword_Man` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Order_ID` int(255) NOT NULL,
  `Origin_Village_ID` int(255) NOT NULL,
  `Destination_Village_ID` int(255) NOT NULL,
  `Type` varchar(255) NOT NULL,
  `Return_On_Success` int(1) NOT NULL,
  `Units_ID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `recrutement`
--

CREATE TABLE `recrutement` (
  `Recrutement_ID` int(255) NOT NULL,
  `Village_ID` int(255) NOT NULL,
  `Unit_ID` int(255) NOT NULL,
  `Amount` int(255) NOT NULL,
  `End_Time` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `Report_ID` int(255) NOT NULL,
  `User_ID` int(255) NOT NULL,
  `Type` int(2) NOT NULL,
  `Bericht` int(255) NOT NULL,
  `Subject` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `Resource_ID` int(255) NOT NULL,
  `Resource_Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`Resource_ID`, `Resource_Name`) VALUES
(1, 'Marble'),
(2, 'Gold');

-- --------------------------------------------------------

--
-- Table structure for table `storage`
--

CREATE TABLE `storage` (
  `Storage_ID` int(255) NOT NULL,
  `Food` int(255) NOT NULL,
  `Metals` int(255) NOT NULL,
  `Stone` int(255) NOT NULL,
  `Wood` int(255) NOT NULL,
  `Timestamp` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `storage`
--

INSERT INTO `storage` (`Storage_ID`, `Food`, `Metals`, `Stone`, `Wood`, `Timestamp`) VALUES
(1, 2147483647, 2147483647, 2147483647, 2147483647, 1496224842);

-- --------------------------------------------------------

--
-- Table structure for table `tech`
--

CREATE TABLE `tech` (
  `Tech_ID` int(255) NOT NULL,
  `Tech_Name` varchar(255) NOT NULL,
  `Effect` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tech_list`
--

CREATE TABLE `tech_list` (
  `Tech_ID` int(255) NOT NULL,
  `User_ID` int(255) NOT NULL,
  `Tech_List` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `terrain`
--

CREATE TABLE `terrain` (
  `Terrain_ID` int(255) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `terrain`
--

INSERT INTO `terrain` (`Terrain_ID`, `Name`) VALUES
(1, 'Forest'),
(2, 'Plain');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `Unit_ID` int(255) NOT NULL,
  `Level` int(255) NOT NULL,
  `Effectiveness` int(255) NOT NULL,
  `Flanking_Range` int(255) NOT NULL,
  `Armor` int(255) NOT NULL,
  `Attack_Power` int(255) NOT NULL,
  `Shielding_Power` int(255) NOT NULL,
  `Amount` int(255) NOT NULL,
  `Morale` int(255) NOT NULL,
  `Piercing` int(255) NOT NULL,
  `Shredding` int(255) NOT NULL,
  `Recrutement_Time` int(20) NOT NULL,
  `Unit_Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`Unit_ID`, `Level`, `Effectiveness`, `Flanking_Range`, `Armor`, `Attack_Power`, `Shielding_Power`, `Amount`, `Morale`, `Piercing`, `Shredding`, `Recrutement_Time`, `Unit_Name`) VALUES
(1, 1, 100, 1, 5, 20, 10, 200, 100, 30, 10, 120, 'Spear_Man'),
(2, 1, 1, 1, 1, 1, 11, 1, 1, 1, 1, 10, 'Sword_Man');

-- --------------------------------------------------------

--
-- Table structure for table `upgrade`
--

CREATE TABLE `upgrade` (
  `Upgrade_ID` int(255) NOT NULL,
  `Upgrade_Name` varchar(255) NOT NULL,
  `Effect` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `upgrade_list`
--

CREATE TABLE `upgrade_list` (
  `Upgrade_ID` int(255) NOT NULL,
  `Village_ID` int(255) NOT NULL,
  `Upgrade_List` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `User_ID` int(255) NOT NULL,
  `User_Name` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Mail` varchar(255) NOT NULL,
  `Phone_Number` varchar(20) NOT NULL,
  `Phone_Number2` varchar(20) DEFAULT NULL,
  `Age` int(2) DEFAULT NULL,
  `City` varchar(255) DEFAULT NULL,
  `Text` varchar(255) DEFAULT NULL,
  `Points` int(255) NOT NULL DEFAULT '0',
  `salt` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_ID`, `User_Name`, `Password`, `Mail`, `Phone_Number`, `Phone_Number2`, `Age`, `City`, `Text`, `Points`, `salt`) VALUES
(1, 'Lelouch557', '557557', 'andreBlok@hotmail.nl', '06 8145 8436', NULL, 21, 'Beilen', NULL, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `village`
--

CREATE TABLE `village` (
  `Village_ID` int(255) NOT NULL,
  `User_ID` int(255) NOT NULL,
  `Cell_ID` int(255) NOT NULL,
  `Storage_ID` int(255) NOT NULL,
  `Scout_Range` int(255) NOT NULL,
  `Prestige` int(255) NOT NULL,
  `Squalor` int(255) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `village`
--

INSERT INTO `village` (`Village_ID`, `User_ID`, `Cell_ID`, `Storage_ID`, `Scout_Range`, `Prestige`, `Squalor`, `Name`) VALUES
(1, 1, 1, 1, 25, 50, 5, 'Code-Geass-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `army`
--
ALTER TABLE `army`
  ADD PRIMARY KEY (`Army_ID`);

--
-- Indexes for table `bericht`
--
ALTER TABLE `bericht`
  ADD PRIMARY KEY (`Bericht_ID`);

--
-- Indexes for table `building`
--
ALTER TABLE `building`
  ADD PRIMARY KEY (`Building_ID`);

--
-- Indexes for table `building_in_progress`
--
ALTER TABLE `building_in_progress`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `building_list`
--
ALTER TABLE `building_list`
  ADD PRIMARY KEY (`Building_ID`);

--
-- Indexes for table `cells`
--
ALTER TABLE `cells`
  ADD PRIMARY KEY (`Cell_ID`),
  ADD UNIQUE KEY `Coordinates` (`Coordinates`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`Chat_ID`);

--
-- Indexes for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`Message_ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Order_ID`);

--
-- Indexes for table `recrutement`
--
ALTER TABLE `recrutement`
  ADD PRIMARY KEY (`Recrutement_ID`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`Report_ID`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`Resource_ID`);

--
-- Indexes for table `storage`
--
ALTER TABLE `storage`
  ADD PRIMARY KEY (`Storage_ID`);

--
-- Indexes for table `tech`
--
ALTER TABLE `tech`
  ADD PRIMARY KEY (`Tech_ID`);

--
-- Indexes for table `tech_list`
--
ALTER TABLE `tech_list`
  ADD PRIMARY KEY (`Tech_ID`,`User_ID`);

--
-- Indexes for table `terrain`
--
ALTER TABLE `terrain`
  ADD PRIMARY KEY (`Terrain_ID`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`Unit_ID`);

--
-- Indexes for table `upgrade`
--
ALTER TABLE `upgrade`
  ADD PRIMARY KEY (`Upgrade_ID`);

--
-- Indexes for table `upgrade_list`
--
ALTER TABLE `upgrade_list`
  ADD PRIMARY KEY (`Upgrade_ID`,`Village_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_ID`),
  ADD UNIQUE KEY `User_Name` (`User_Name`),
  ADD UNIQUE KEY `Mail` (`Mail`),
  ADD UNIQUE KEY `Phone_Number` (`Phone_Number`),
  ADD UNIQUE KEY `salt` (`salt`);

--
-- Indexes for table `village`
--
ALTER TABLE `village`
  ADD PRIMARY KEY (`Village_ID`),
  ADD UNIQUE KEY `Storage_ID` (`Storage_ID`),
  ADD UNIQUE KEY `User_ID` (`User_ID`),
  ADD UNIQUE KEY `Cell_ID` (`Cell_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `army`
--
ALTER TABLE `army`
  MODIFY `Army_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `bericht`
--
ALTER TABLE `bericht`
  MODIFY `Bericht_ID` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `building`
--
ALTER TABLE `building`
  MODIFY `Building_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `building_in_progress`
--
ALTER TABLE `building_in_progress`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `building_list`
--
ALTER TABLE `building_list`
  MODIFY `Building_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `cells`
--
ALTER TABLE `cells`
  MODIFY `Cell_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=401;
--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `Chat_ID` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `Message_ID` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Order_ID` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `recrutement`
--
ALTER TABLE `recrutement`
  MODIFY `Recrutement_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `Report_ID` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `Resource_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `storage`
--
ALTER TABLE `storage`
  MODIFY `Storage_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tech`
--
ALTER TABLE `tech`
  MODIFY `Tech_ID` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `terrain`
--
ALTER TABLE `terrain`
  MODIFY `Terrain_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `Unit_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `upgrade`
--
ALTER TABLE `upgrade`
  MODIFY `Upgrade_ID` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `upgrade_list`
--
ALTER TABLE `upgrade_list`
  MODIFY `Upgrade_ID` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `village`
--
ALTER TABLE `village`
  MODIFY `Village_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
