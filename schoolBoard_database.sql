-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 06, 2022 at 08:26 AM
-- Server version: 5.7.37-cll-lve
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schoolBoard_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `gradelvl` varchar(50) NOT NULL,
  `subjec_t` varchar(50) NOT NULL,
  `quarter_no` varchar(50) NOT NULL,
  `module_no` varchar(100) NOT NULL,
  `title` varchar(50) NOT NULL,
  `e_filename` varchar(100) NOT NULL,
  `size` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`gradelvl`, `subjec_t`, `quarter_no`, `module_no`, `title`, `e_filename`, `size`) VALUES
('Grade 7', 'Araling Panlipunan', 'Quarter 1', '3', 'Mga Likas na Yaman ng Asya', 'AP7_Q1_Module-3_MgaLikasnaYamanngAsya_v2.pdf', 1322327),
('Grade 7', 'Araling Panlipunan', 'Quarter 1', '4', 'Implikasyon ng Likas na Yaman sa Pamumuhay ng mga ', 'AP7_Q1_Module-4_ImplikasyonngLikasnaYamansaPamumuhayngmgaAsyano_v2.pdf', 790627),
('Grade 7', 'Araling Panlipunan', 'Quarter 1', '2', 'Kahalagahan ng Ugnayan ng Tao at Kapaligiran', 'AP7_Q1_Module_2_KahalagahanngUgnayanngTaosatKapaligiran_v2.pdf', 3260362),
('Grade 7', 'Arts', 'Quarter 1', '1', 'Arts And Crafts Of Luzon Attires Fabrics And Tapes', 'Arts7_Q1_Mod1_ArtsAndCraftsOfLuzonAttiresFabricsAndTapestriesCraftsAndAccessoriesAndBodyOrnament_v2.', 2267300),
('Grade 7', 'Arts', 'Quarter 1', '2', 'The Majestic Architecture And Sculpture Of Luzon', 'Arts7_Q1_Mod2_TheMajesticArchitectureAndSculptureOfLuzon-v2.pdf', 1552016),
('Grade 7', 'English', 'Quarter 1', '2', 'Media-Resources', 'Copy of English-7-Quarter-1-Module-2-Media-Resources.CC.pdf', 2243971),
('Grade 7', 'English', 'Quarter 1', '3', 'Identifying the Purpose Intended Audience and Feat', 'Copy of English-7-Quarter-1-Module-3-Identifying-the-Purpose-Intended-Audience-and-Features-of-Mater', 784418),
('Grade 7', 'English', 'Quarter 1', '4', 'Passive and Active Voice', 'Copy of English-7-Quarter-1-Module-4-Passive-and-Active-Voice.CC.pdf', 668947),
('Grade 7', 'Mathematics', 'Quarter 1', '1', 'ADM', 'MATH 7  ADM Module 5 - EDITED VERSION 2.0 (1) (1).docx', 787004),
('Grade 7', 'Science', 'Quarter 1', '121', 'Test', 'SCIENCE 10 Module 7 Activity_v2.pdf', 577837);

-- --------------------------------------------------------

--
-- Table structure for table `grades_per_subject`
--

CREATE TABLE `grades_per_subject` (
  `LRN` varchar(20) DEFAULT NULL,
  `Year_lvl` int(5) DEFAULT NULL,
  `subject` varchar(50) DEFAULT NULL,
  `periodic_grading` int(5) DEFAULT NULL,
  `grade` int(5) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grades_per_subject`
--

INSERT INTO `grades_per_subject` (`LRN`, `Year_lvl`, `subject`, `periodic_grading`, `grade`, `status`) VALUES
('1111256127', 7, 'Filipino', 1, 95, NULL),
('1111256127', 7, 'Filipino', 2, 90, NULL),
('1111256127', 7, 'Filipino', 3, 94, NULL),
('1111256127', 7, 'Filipino', 4, 95, NULL),
('1111256127', 7, 'English', 1, 92, NULL),
('1111256127', 7, 'English', 2, 89, NULL),
('1111256127', 7, 'English', 3, 75, NULL),
('1111256127', 7, 'English', 4, 93, NULL),
('1111256127', 7, 'Araling Panlipunan', 1, 87, NULL),
('1111256127', 7, 'Araling Panlipunan', 2, 86, NULL),
('1111256127', 7, 'Araling Panlipunan', 3, 91, NULL),
('1111256127', 7, 'Araling Panlipunan', 4, 88, NULL),
('1111256127', 7, 'Math', 1, 72, NULL),
('1111256127', 7, 'Math', 2, 90, NULL),
('1111256127', 7, 'Math', 3, 85, NULL),
('1111256127', 7, 'Math', 4, 81, NULL),
('1111256127', 7, 'Science', 1, 90, NULL),
('1111256127', 7, 'Science', 2, 90, NULL),
('1111256127', 7, 'Science', 3, 91, NULL),
('1111256127', 7, 'Science', 4, 85, NULL),
('1111256127', 7, 'Technology and Livelihood Education', 1, 95, NULL),
('1111256127', 7, 'Technology and Livelihood Education', 2, 90, NULL),
('1111256127', 7, 'Technology and Livelihood Education', 3, 94, NULL),
('1111256127', 7, 'Technology and Livelihood Education', 4, 95, NULL),
('1111256127', 7, 'Edukasyon sa Pagpapakatao', 1, 90, NULL),
('1111256127', 7, 'Edukasyon sa Pagpapakatao', 2, 92, NULL),
('1111256127', 7, 'Edukasyon sa Pagpapakatao', 3, 94, NULL),
('1111256127', 7, 'Edukasyon sa Pagpapakatao', 4, 95, NULL),
('1111256127', 7, 'Music', 1, 90, NULL),
('1111256127', 7, 'Music', 2, 91, NULL),
('1111256127', 7, 'Music', 3, 92, NULL),
('1111256127', 7, 'Music', 4, 93, NULL),
('1111256127', 7, 'Arts', 1, 84, NULL),
('1111256127', 7, 'Arts', 2, 91, NULL),
('1111256127', 7, 'Arts', 3, 92, NULL),
('1111256127', 7, 'Arts', 4, 89, NULL),
('1111256127', 7, 'Physical Education', 1, 87, NULL),
('1111256127', 7, 'Physical Education', 2, 89, NULL),
('1111256127', 7, 'Physical Education', 3, 88, NULL),
('1111256127', 7, 'Physical Education', 4, 85, NULL),
('1111256127', 7, 'Health', 1, 95, NULL),
('1111256127', 7, 'Health', 2, 91, NULL),
('1111256127', 7, 'Health', 3, 92, NULL),
('1111256127', 7, 'Health', 4, 90, NULL),
('2221256127', 7, 'Filipino', 1, 95, NULL),
('2221256127', 7, 'Filipino', 2, 88, NULL),
('2221256127', 7, 'Filipino', 3, 94, NULL),
('2221256127', 7, 'Filipino', 4, 95, NULL),
('2221256127', 7, 'English', 1, 92, NULL),
('2221256127', 7, 'English', 2, 76, NULL),
('2221256127', 7, 'English', 3, 75, NULL),
('2221256127', 7, 'English', 4, 93, NULL),
('2221256127', 7, 'Araling Panlipunan', 1, 80, NULL),
('2221256127', 7, 'Araling Panlipunan', 2, 90, NULL),
('2221256127', 7, 'Araling Panlipunan', 3, 91, NULL),
('2221256127', 7, 'Araling Panlipunan', 4, 88, NULL),
('2221256127', 7, 'Math', 1, 72, NULL),
('2221256127', 7, 'Math', 2, 95, NULL),
('2221256127', 7, 'Math', 3, 85, NULL),
('2221256127', 7, 'Math', 4, 78, NULL),
('2221256127', 7, 'Science', 1, 68, NULL),
('2221256127', 7, 'Science', 2, 90, NULL),
('2221256127', 7, 'Science', 3, 91, NULL),
('2221256127', 7, 'Science', 4, 70, NULL),
('2221256127', 7, 'Technology and Livelihood Education', 1, 88, NULL),
('2221256127', 7, 'Technology and Livelihood Education', 2, 90, NULL),
('2221256127', 7, 'Technology and Livelihood Education', 3, 94, NULL),
('2221256127', 7, 'Technology and Livelihood Education', 4, 90, NULL),
('2221256127', 7, 'Edukasyon sa Pagpapakatao', 1, 90, NULL),
('2221256127', 7, 'Edukasyon sa Pagpapakatao', 2, 85, NULL),
('2221256127', 7, 'Edukasyon sa Pagpapakatao', 3, 78, NULL),
('2221256127', 7, 'Edukasyon sa Pagpapakatao', 4, 75, NULL),
('2221256127', 7, 'Music', 1, 88, NULL),
('2221256127', 7, 'Music', 2, 88, NULL),
('2221256127', 7, 'Music', 3, 92, NULL),
('2221256127', 7, 'Music', 4, 96, NULL),
('2221256127', 7, 'Arts', 1, 84, NULL),
('2221256127', 7, 'Arts', 2, 91, NULL),
('2221256127', 7, 'Arts', 3, 90, NULL),
('2221256127', 7, 'Arts', 4, 89, NULL),
('2221256127', 7, 'Physical Education', 1, 87, NULL),
('2221256127', 7, 'Physical Education', 2, 89, NULL),
('2221256127', 7, 'Physical Education', 3, 88, NULL),
('2221256127', 7, 'Physical Education', 4, 85, NULL),
('2221256127', 7, 'Health', 1, 95, NULL),
('2221256127', 7, 'Health', 2, 91, NULL),
('2221256127', 7, 'Health', 3, 92, NULL),
('2221256127', 7, 'Health', 4, 90, NULL),
('3331256127', 7, 'Filipino', 1, 95, NULL),
('3331256127', 7, 'Filipino', 2, 90, NULL),
('3331256127', 7, 'Filipino', 3, 94, NULL),
('3331256127', 7, 'Filipino', 4, 95, NULL),
('3331256127', 7, 'English', 1, 92, NULL),
('3331256127', 7, 'English', 2, 89, NULL),
('3331256127', 7, 'English', 3, 75, NULL),
('3331256127', 7, 'English', 4, 93, NULL),
('3331256127', 7, 'Araling Panlipunan', 1, 87, NULL),
('3331256127', 7, 'Araling Panlipunan', 2, 86, NULL),
('3331256127', 7, 'Araling Panlipunan', 3, 91, NULL),
('3331256127', 7, 'Araling Panlipunan', 4, 88, NULL),
('3331256127', 7, 'Math', 1, 72, NULL),
('3331256127', 7, 'Math', 2, 90, NULL),
('3331256127', 7, 'Math', 3, 85, NULL),
('3331256127', 7, 'Math', 4, 81, NULL),
('3331256127', 7, 'Science', 1, 90, NULL),
('3331256127', 7, 'Science', 2, 87, NULL),
('3331256127', 7, 'Science', 3, 91, NULL),
('3331256127', 7, 'Science', 4, 92, NULL),
('3331256127', 7, 'Technology and Livelihood Education', 1, 95, NULL),
('3331256127', 7, 'Technology and Livelihood Education', 2, 90, NULL),
('3331256127', 7, 'Technology and Livelihood Education', 3, 94, NULL),
('3331256127', 7, 'Technology and Livelihood Education', 4, 95, NULL),
('3331256127', 7, 'Edukasyon sa Pagpapakatao', 1, 90, NULL),
('3331256127', 7, 'Edukasyon sa Pagpapakatao', 2, 88, NULL),
('3331256127', 7, 'Edukasyon sa Pagpapakatao', 3, 94, NULL),
('3331256127', 7, 'Edukasyon sa Pagpapakatao', 4, 95, NULL),
('3331256127', 7, 'Music', 1, 90, NULL),
('3331256127', 7, 'Music', 2, 91, NULL),
('3331256127', 7, 'Music', 3, 92, NULL),
('3331256127', 7, 'Music', 4, 93, NULL),
('3331256127', 7, 'Arts', 1, 84, NULL),
('3331256127', 7, 'Arts', 2, 91, NULL),
('3331256127', 7, 'Arts', 3, 92, NULL),
('3331256127', 7, 'Arts', 4, 89, NULL),
('3331256127', 7, 'Physical Education', 1, 87, NULL),
('3331256127', 7, 'Physical Education', 2, 89, NULL),
('3331256127', 7, 'Physical Education', 3, 78, NULL),
('3331256127', 7, 'Physical Education', 4, 85, NULL),
('3331256127', 7, 'Health', 1, 95, NULL),
('3331256127', 7, 'Health', 2, 91, NULL),
('3331256127', 7, 'Health', 3, 92, NULL),
('3331256127', 7, 'Health', 4, 90, NULL),
('4441256127', 7, 'Filipino', 1, 95, NULL),
('4441256127', 7, 'Filipino', 2, 90, NULL),
('4441256127', 7, 'Filipino', 3, 94, NULL),
('4441256127', 7, 'Filipino', 4, 95, NULL),
('4441256127', 7, 'English', 1, 92, NULL),
('4441256127', 7, 'English', 2, 89, NULL),
('4441256127', 7, 'English', 3, 75, NULL),
('4441256127', 7, 'English', 4, 93, NULL),
('4441256127', 7, 'Araling Panlipunan', 1, 87, NULL),
('4441256127', 7, 'Araling Panlipunan', 2, 86, NULL),
('4441256127', 7, 'Araling Panlipunan', 3, 91, NULL),
('4441256127', 7, 'Araling Panlipunan', 4, 88, NULL),
('4441256127', 7, 'Math', 1, 72, NULL),
('4441256127', 7, 'Math', 2, 90, NULL),
('4441256127', 7, 'Math', 3, 85, NULL),
('4441256127', 7, 'Math', 4, 81, NULL),
('4441256127', 7, 'Science', 1, 90, NULL),
('4441256127', 7, 'Science', 2, 87, NULL),
('4441256127', 7, 'Science', 3, 91, NULL),
('4441256127', 7, 'Science', 4, 92, NULL),
('4441256127', 7, 'Technology and Livelihood Education', 1, 95, NULL),
('4441256127', 7, 'Technology and Livelihood Education', 2, 90, NULL),
('4441256127', 7, 'Technology and Livelihood Education', 3, 94, NULL),
('4441256127', 7, 'Technology and Livelihood Education', 4, 95, NULL),
('4441256127', 7, 'Edukasyon sa Pagpapakatao', 1, 90, NULL),
('4441256127', 7, 'Edukasyon sa Pagpapakatao', 2, 88, NULL),
('4441256127', 7, 'Edukasyon sa Pagpapakatao', 3, 94, NULL),
('4441256127', 7, 'Edukasyon sa Pagpapakatao', 4, 95, NULL),
('4441256127', 7, 'Music', 1, 90, NULL),
('4441256127', 7, 'Music', 2, 91, NULL),
('4441256127', 7, 'Music', 3, 92, NULL),
('4441256127', 7, 'Music', 4, 93, NULL),
('4441256127', 7, 'Arts', 1, 84, NULL),
('4441256127', 7, 'Arts', 2, 91, NULL),
('4441256127', 7, 'Arts', 3, 92, NULL),
('4441256127', 7, 'Arts', 4, 89, NULL),
('4441256127', 7, 'Physical Education', 1, 87, NULL),
('4441256127', 7, 'Physical Education', 2, 89, NULL),
('4441256127', 7, 'Physical Education', 3, 78, NULL),
('4441256127', 7, 'Physical Education', 4, 85, NULL),
('4441256127', 7, 'Health', 1, 95, NULL),
('4441256127', 7, 'Health', 2, 91, NULL),
('4441256127', 7, 'Health', 3, 92, NULL),
('4441256127', 7, 'Health', 4, 90, NULL),
('5551256127', 7, 'Filipino', 1, 95, NULL),
('5551256127', 7, 'Filipino', 2, 90, NULL),
('5551256127', 7, 'Filipino', 3, 94, NULL),
('5551256127', 7, 'Filipino', 4, 95, NULL),
('5551256127', 7, 'English', 1, 92, NULL),
('5551256127', 7, 'English', 2, 89, NULL),
('5551256127', 7, 'English', 3, 75, NULL),
('5551256127', 7, 'English', 4, 93, NULL),
('5551256127', 7, 'Araling Panlipunan', 1, 87, NULL),
('5551256127', 7, 'Araling Panlipunan', 2, 86, NULL),
('5551256127', 7, 'Araling Panlipunan', 3, 91, NULL),
('5551256127', 7, 'Araling Panlipunan', 4, 88, NULL),
('5551256127', 7, 'Math', 1, 72, NULL),
('5551256127', 7, 'Math', 2, 90, NULL),
('5551256127', 7, 'Math', 3, 85, NULL),
('5551256127', 7, 'Math', 4, 81, NULL),
('5551256127', 7, 'Science', 1, 90, NULL),
('5551256127', 7, 'Science', 2, 90, NULL),
('5551256127', 7, 'Science', 3, 91, NULL),
('5551256127', 7, 'Science', 4, 92, NULL),
('5551256127', 7, 'Technology and Livelihood Education', 1, 95, NULL),
('5551256127', 7, 'Technology and Livelihood Education', 2, 90, NULL),
('5551256127', 7, 'Technology and Livelihood Education', 3, 94, NULL),
('5551256127', 7, 'Technology and Livelihood Education', 4, 95, NULL),
('5551256127', 7, 'Edukasyon sa Pagpapakatao', 1, 90, NULL),
('5551256127', 7, 'Edukasyon sa Pagpapakatao', 2, 92, NULL),
('5551256127', 7, 'Edukasyon sa Pagpapakatao', 3, 94, NULL),
('5551256127', 7, 'Edukasyon sa Pagpapakatao', 4, 95, NULL),
('5551256127', 7, 'Music', 1, 90, NULL),
('5551256127', 7, 'Music', 2, 91, NULL),
('5551256127', 7, 'Music', 3, 92, NULL),
('5551256127', 7, 'Music', 4, 93, NULL),
('5551256127', 7, 'Arts', 1, 84, NULL),
('5551256127', 7, 'Arts', 2, 91, NULL),
('5551256127', 7, 'Arts', 3, 92, NULL),
('5551256127', 7, 'Arts', 4, 89, NULL),
('5551256127', 7, 'Physical Education', 1, 87, NULL),
('5551256127', 7, 'Physical Education', 2, 89, NULL),
('5551256127', 7, 'Physical Education', 3, 88, NULL),
('5551256127', 7, 'Physical Education', 4, 85, NULL),
('5551256127', 7, 'Health', 1, 95, NULL),
('5551256127', 7, 'Health', 2, 91, NULL),
('5551256127', 7, 'Health', 3, 92, NULL),
('5551256127', 7, 'Health', 4, 90, NULL),
('6661256127', 7, 'Filipino', 1, 90, NULL),
('6661256127', 7, 'Filipino', 2, 90, NULL),
('6661256127', 7, 'Filipino', 3, 94, NULL),
('6661256127', 7, 'Filipino', 4, 80, NULL),
('6661256127', 7, 'English', 1, 92, NULL),
('6661256127', 7, 'English', 2, 89, NULL),
('6661256127', 7, 'English', 3, 75, NULL),
('6661256127', 7, 'English', 4, 93, NULL),
('6661256127', 7, 'Araling Panlipunan', 1, 87, NULL),
('6661256127', 7, 'Araling Panlipunan', 2, 86, NULL),
('6661256127', 7, 'Araling Panlipunan', 3, 91, NULL),
('6661256127', 7, 'Araling Panlipunan', 4, 88, NULL),
('6661256127', 7, 'Math', 1, 72, NULL),
('6661256127', 7, 'Math', 2, 90, NULL),
('6661256127', 7, 'Math', 3, 85, NULL),
('6661256127', 7, 'Math', 4, 81, NULL),
('6661256127', 7, 'Science', 1, 90, NULL),
('6661256127', 7, 'Science', 2, 87, NULL),
('6661256127', 7, 'Science', 3, 91, NULL),
('6661256127', 7, 'Science', 4, 92, NULL),
('6661256127', 7, 'Technology and Livelihood Education', 1, 95, NULL),
('6661256127', 7, 'Technology and Livelihood Education', 2, 90, NULL),
('6661256127', 7, 'Technology and Livelihood Education', 3, 94, NULL),
('6661256127', 7, 'Technology and Livelihood Education', 4, 95, NULL),
('6661256127', 7, 'Edukasyon sa Pagpapakatao', 1, 90, NULL),
('6661256127', 7, 'Edukasyon sa Pagpapakatao', 2, 88, NULL),
('6661256127', 7, 'Edukasyon sa Pagpapakatao', 3, 94, NULL),
('6661256127', 7, 'Edukasyon sa Pagpapakatao', 4, 95, NULL),
('6661256127', 7, 'Music', 1, 90, NULL),
('6661256127', 7, 'Music', 2, 91, NULL),
('6661256127', 7, 'Music', 3, 92, NULL),
('6661256127', 7, 'Music', 4, 93, NULL),
('6661256127', 7, 'Arts', 1, 84, NULL),
('6661256127', 7, 'Arts', 2, 91, NULL),
('6661256127', 7, 'Arts', 3, 92, NULL),
('6661256127', 7, 'Arts', 4, 89, NULL),
('6661256127', 7, 'Physical Education', 1, 87, NULL),
('6661256127', 7, 'Physical Education', 2, 89, NULL),
('6661256127', 7, 'Physical Education', 3, 78, NULL),
('6661256127', 7, 'Physical Education', 4, 85, NULL),
('6661256127', 7, 'Health', 1, 95, NULL),
('6661256127', 7, 'Health', 2, 91, NULL),
('6661256127', 7, 'Health', 3, 92, NULL),
('6661256127', 7, 'Health', 4, 90, NULL),
('7771256127', 7, 'Filipino', 1, 95, NULL),
('7771256127', 7, 'Filipino', 2, 88, NULL),
('7771256127', 7, 'Filipino', 3, 94, NULL),
('7771256127', 7, 'Filipino', 4, 95, NULL),
('7771256127', 7, 'English', 1, 92, NULL),
('7771256127', 7, 'English', 2, 76, NULL),
('7771256127', 7, 'English', 3, 75, NULL),
('7771256127', 7, 'English', 4, 93, NULL),
('7771256127', 7, 'Araling Panlipunan', 1, 80, NULL),
('7771256127', 7, 'Araling Panlipunan', 2, 90, NULL),
('7771256127', 7, 'Araling Panlipunan', 3, 91, NULL),
('7771256127', 7, 'Araling Panlipunan', 4, 88, NULL),
('7771256127', 7, 'Math', 1, 72, NULL),
('7771256127', 7, 'Math', 2, 95, NULL),
('7771256127', 7, 'Math', 3, 85, NULL),
('7771256127', 7, 'Math', 4, 78, NULL),
('7771256127', 7, 'Science', 1, 68, NULL),
('7771256127', 7, 'Science', 2, 90, NULL),
('7771256127', 7, 'Science', 3, 91, NULL),
('7771256127', 7, 'Science', 4, 70, NULL),
('7771256127', 7, 'Technology and Livelihood Education', 1, 88, NULL),
('7771256127', 7, 'Technology and Livelihood Education', 2, 90, NULL),
('7771256127', 7, 'Technology and Livelihood Education', 3, 94, NULL),
('7771256127', 7, 'Technology and Livelihood Education', 4, 90, NULL),
('7771256127', 7, 'Edukasyon sa Pagpapakatao', 1, 90, NULL),
('7771256127', 7, 'Edukasyon sa Pagpapakatao', 2, 85, NULL),
('7771256127', 7, 'Edukasyon sa Pagpapakatao', 3, 78, NULL),
('7771256127', 7, 'Edukasyon sa Pagpapakatao', 4, 75, NULL),
('7771256127', 7, 'Music', 1, 88, NULL),
('7771256127', 7, 'Music', 2, 88, NULL),
('7771256127', 7, 'Music', 3, 92, NULL),
('7771256127', 7, 'Music', 4, 96, NULL),
('7771256127', 7, 'Arts', 1, 84, NULL),
('7771256127', 7, 'Arts', 2, 91, NULL),
('7771256127', 7, 'Arts', 3, 90, NULL),
('7771256127', 7, 'Arts', 4, 89, NULL),
('7771256127', 7, 'Physical Education', 1, 87, NULL),
('7771256127', 7, 'Physical Education', 2, 89, NULL),
('7771256127', 7, 'Physical Education', 3, 88, NULL),
('7771256127', 7, 'Physical Education', 4, 85, NULL),
('7771256127', 7, 'Health', 1, 95, NULL),
('7771256127', 7, 'Health', 2, 91, NULL),
('7771256127', 7, 'Health', 3, 92, NULL),
('7771256127', 7, 'Health', 4, 90, NULL),
('8881256127', 7, 'Filipino', 1, 95, NULL),
('8881256127', 7, 'Filipino', 2, 90, NULL),
('8881256127', 7, 'Filipino', 3, 94, NULL),
('8881256127', 7, 'Filipino', 4, 95, NULL),
('8881256127', 7, 'English', 1, 92, NULL),
('8881256127', 7, 'English', 2, 89, NULL),
('8881256127', 7, 'English', 3, 75, NULL),
('8881256127', 7, 'English', 4, 93, NULL),
('8881256127', 7, 'Araling Panlipunan', 1, 87, NULL),
('8881256127', 7, 'Araling Panlipunan', 2, 86, NULL),
('8881256127', 7, 'Araling Panlipunan', 3, 91, NULL),
('8881256127', 7, 'Araling Panlipunan', 4, 88, NULL),
('8881256127', 7, 'Math', 1, 72, NULL),
('8881256127', 7, 'Math', 2, 90, NULL),
('8881256127', 7, 'Math', 3, 85, NULL),
('8881256127', 7, 'Math', 4, 81, NULL),
('8881256127', 7, 'Science', 1, 90, NULL),
('8881256127', 7, 'Science', 2, 90, NULL),
('8881256127', 7, 'Science', 3, 91, NULL),
('8881256127', 7, 'Science', 4, 92, NULL),
('8881256127', 7, 'Technology and Livelihood Education', 1, 95, NULL),
('8881256127', 7, 'Technology and Livelihood Education', 2, 90, NULL),
('8881256127', 7, 'Technology and Livelihood Education', 3, 94, NULL),
('8881256127', 7, 'Technology and Livelihood Education', 4, 95, NULL),
('8881256127', 7, 'Edukasyon sa Pagpapakatao', 1, 90, NULL),
('8881256127', 7, 'Edukasyon sa Pagpapakatao', 2, 92, NULL),
('8881256127', 7, 'Edukasyon sa Pagpapakatao', 3, 94, NULL),
('8881256127', 7, 'Edukasyon sa Pagpapakatao', 4, 95, NULL),
('8881256127', 7, 'Music', 1, 90, NULL),
('8881256127', 7, 'Music', 2, 91, NULL),
('8881256127', 7, 'Music', 3, 92, NULL),
('8881256127', 7, 'Music', 4, 93, NULL),
('8881256127', 7, 'Arts', 1, 84, NULL),
('8881256127', 7, 'Arts', 2, 91, NULL),
('8881256127', 7, 'Arts', 3, 92, NULL),
('8881256127', 7, 'Arts', 4, 89, NULL),
('8881256127', 7, 'Physical Education', 1, 87, NULL),
('8881256127', 7, 'Physical Education', 2, 89, NULL),
('8881256127', 7, 'Physical Education', 3, 88, NULL),
('8881256127', 7, 'Physical Education', 4, 85, NULL),
('8881256127', 7, 'Health', 1, 95, NULL),
('8881256127', 7, 'Health', 2, 91, NULL),
('8881256127', 7, 'Health', 3, 92, NULL),
('8881256127', 7, 'Health', 4, 90, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `grade_per_year`
--

CREATE TABLE `grade_per_year` (
  `LRN` varchar(20) NOT NULL,
  `Year_lvl` int(5) DEFAULT NULL,
  `Section` varchar(50) DEFAULT NULL,
  `Period_1` int(10) DEFAULT NULL,
  `Period_2` int(10) DEFAULT NULL,
  `Period_3` int(10) DEFAULT NULL,
  `Period_4` int(10) DEFAULT NULL,
  `Grade_ave` int(10) DEFAULT NULL,
  `Remarks` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grade_per_year`
--

INSERT INTO `grade_per_year` (`LRN`, `Year_lvl`, `Section`, `Period_1`, `Period_2`, `Period_3`, `Period_4`, `Grade_ave`, `Remarks`) VALUES
('1111256127', 7, 'Rose', 89, 90, 89, 91, 90, 'Passed'),
('2221256127', 7, 'Rose', 84, 88, 87, 85, 86, 'Passed'),
('3331256127', 7, 'Rose', 89, 89, 89, 91, 89, 'Passed'),
('4441256127', 7, 'Rose', 89, 89, 89, 91, 89, 'Passed'),
('5551256127', 7, 'Rose', 89, 90, 89, 91, 90, 'Passed'),
('6661256127', 7, 'Rose', 89, 89, 89, 91, 89, 'Passed'),
('7771256127', 7, 'Rose', 84, 88, 87, 85, 86, 'Passed'),
('8881256127', 7, 'Rose', 89, 90, 89, 91, 90, 'Passed');

-- --------------------------------------------------------

--
-- Table structure for table `profile_img`
--

CREATE TABLE `profile_img` (
  `LRN` varchar(20) NOT NULL,
  `Status` int(11) DEFAULT NULL,
  `file_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile_img`
--

INSERT INTO `profile_img` (`LRN`, `Status`, `file_name`) VALUES
('1111256127', 1, '1111256127.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `quarter_status`
--

CREATE TABLE `quarter_status` (
  `LRN` varchar(20) NOT NULL,
  `Year_lvl` int(5) DEFAULT NULL,
  `Status_Q1` varchar(10) DEFAULT NULL,
  `Status_Q2` varchar(10) DEFAULT NULL,
  `Status_Q3` varchar(10) DEFAULT NULL,
  `Status_Q4` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quarter_status`
--

INSERT INTO `quarter_status` (`LRN`, `Year_lvl`, `Status_Q1`, `Status_Q2`, `Status_Q3`, `Status_Q4`) VALUES
('1111256127', 7, 'Final', 'Final', 'Final', 'Final'),
('2221256127', 7, 'Final', 'Final', 'Final', 'Final'),
('3331256127', 7, 'Final', 'Final', 'Final', 'Final'),
('4441256127', 7, 'Final', 'Final', 'Final', 'Final'),
('5551256127', 7, 'Final', 'Final', 'Final', 'Final'),
('6661256127', 7, 'Final', 'Final', 'Final', 'Final'),
('7771256127', 7, 'Final', 'Final', 'Final', 'Final'),
('8881256127', 7, 'Final', 'Final', 'Final', 'Final');

-- --------------------------------------------------------

--
-- Table structure for table `school_info`
--

CREATE TABLE `school_info` (
  `School_ID` int(11) NOT NULL,
  `School_name` varchar(60) NOT NULL,
  `Division` varchar(50) NOT NULL,
  `District` varchar(50) DEFAULT NULL,
  `Region` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school_info`
--

INSERT INTO `school_info` (`School_ID`, `School_name`, `Division`, `District`, `Region`) VALUES
(304254, 'Dream National High School', 'Davao del Sur', 'First', 'XI');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `Year` varchar(2) DEFAULT NULL,
  `Section` varchar(20) DEFAULT NULL,
  `Advisers` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`Year`, `Section`, `Advisers`) VALUES
('7', 'Rose', 'Reyes'),
('8', 'Dagohoy', 'Brown'),
('9', 'Rizal', 'Hamilton'),
('10', 'Maxwell', 'Park');

-- --------------------------------------------------------

--
-- Table structure for table `sffiles`
--

CREATE TABLE `sffiles` (
  `sfNumber` varchar(50) DEFAULT NULL,
  `sfTitle` varchar(50) DEFAULT NULL,
  `sfdesc` varchar(50) DEFAULT NULL,
  `preppedby` varchar(50) DEFAULT NULL,
  `sfMode` varchar(50) DEFAULT NULL,
  `sfsched` varchar(50) DEFAULT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sffiles`
--

INSERT INTO `sffiles` (`sfNumber`, `sfTitle`, `sfdesc`, `preppedby`, `sfMode`, `sfsched`, `filename`) VALUES
('--', 'Mean Percentage Score Template', 'N/A', 'Class Adviser', 'Manual', 'Quartlerly', 'Mean-Percentage-Score-Template.xlsx'),
('SF3', 'Books Issued and Returned', 'Itâ€™s the list of books (by title) issue to/retur', 'Class Adviser', 'Partially through LIS and Manual', 'BoSY and End of school year (EoSY)', 'SF 3 Books Issued and Returned.pdf'),
('SF4', 'Summary Enrollment and Movement of Learners', 'Enrollment count, transferred in/out and dropout b', 'School Head', 'LIS', 'Monthly', 'SF 4 Monthly Learner Movement and Attendance.pdf'),
('SF5', 'Report on Promotion', 'List of promoted/retained by class', 'Class Adviser', 'LIS', 'EoSY', 'SF 5 Report on Promotion and Learning Progress _ Achievement_0 (1).xlsx'),
('SF6', 'Summary Report on Promotion', 'Number of promoted/retained by grade level (Summar', 'School Head', 'LIS', 'EoSY', 'SF 6 Summarized Report on Promotion and Learning Progress _ Achievement (1).xlsx'),
('SF7', 'Inventory of School Personnel', 'List of school personnel with basic profile and te', 'School Head', 'Manual', 'BoSY and as needed', 'SF 7 School Personnel Assignment List and Basic Profile.pdf'),
('SF8', 'Learner Basic Health and Nutrition Profile', 'Per learner assessment of body mass index', 'Class Adviser', 'LIS', 'BoSY and End of school year (EoSY)', 'SF 8 Learner Basic Health and Nutrition Report.xlsx'),
('SF1', 'School Registry', 'Master list of class enrollment', 'Class Adviser', 'LIS', 'Quarterly', 'SF1_Registration.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `student_contact`
--

CREATE TABLE `student_contact` (
  `LRN` varchar(20) NOT NULL,
  `Street` varchar(50) DEFAULT NULL,
  `Barangay` varchar(50) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `Province` varchar(50) DEFAULT NULL,
  `Tele_num` varchar(20) DEFAULT NULL,
  `Email` varchar(20) DEFAULT NULL,
  `Mobile_num` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_contact`
--

INSERT INTO `student_contact` (`LRN`, `Street`, `Barangay`, `City`, `Province`, `Tele_num`, `Email`, `Mobile_num`) VALUES
('1111256127', 'St1', '11 Brgy Biao Guianga', 'Davao City', 'Davao del Sur', '1234546', 'test@gmail', '09562115657'),
('2221256127', 'St1.5', 'Tibal-og', 'Sto. TOmas', 'Davao del Norte', '123456', 'sams@gmail.com', '09678937115'),
('3331256127', 'St2', 'Brgy. Monbebe', 'San Francisco', 'Agusan Del Sur', '1234546', 'laine@gmail.com', '09562115657'),
('4441256127', 'St3', 'Bolton', 'Davao City', 'Davao del Sur', '1234546', 'mariasg@gmail.com', '09562115657'),
('5551256127', 'St4', 'Mamamoo', 'Bayugan', 'Agusan del norte', '1234546', 'hannanae@gmail.com', '09562115657'),
('6661256127', 'St5', 'Buhangin', 'Davao City', 'Davao del Sur', '1234546', 'chadiwaps@gmail.com', '09562115657'),
('7771256127', 'St6', 'Buhangin', 'Davao City', 'Davao del Sur', '1234546', 'carlos@gmail.com', '09562115657'),
('8881256127', 'St6', 'Buhangin', 'Davao City', 'Davao del Sur', '1234546', 'aaron@gmail.com', '09562115657');

-- --------------------------------------------------------

--
-- Table structure for table `student_guardian_contact`
--

CREATE TABLE `student_guardian_contact` (
  `LRN` varchar(20) NOT NULL,
  `Guardian_name` varchar(50) DEFAULT NULL,
  `Guardian_contact` varchar(15) NOT NULL,
  `Guardian_address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_guardian_contact`
--

INSERT INTO `student_guardian_contact` (`LRN`, `Guardian_name`, `Guardian_contact`, `Guardian_address`) VALUES
('1111256127', 'Lilian Tonacao', '092374228492', '11 Brgy. Biao Guianga, Tugbok Dist., Davao City'),
('2221256127', 'Sergio Dela Cruz', '09232111483', 'Brgy. Sto. Tomas, Davao Del Norte'),
('3331256127', 'Wednesday Rapal', '09859333291', 'blk 2 lt3 Brgy. Monbebe, San Francisco, Agusan Del'),
('4441256127', 'Ash Montelibano', '09052115657', '123 Brgy. Bolton, Davao City'),
('5551256127', 'Jaya Limpag', '09321123853', '11 Brgy. Mamamoo, Bayugan, Agusan del norte'),
('6661256127', 'Regine Bayquen', '09822134883', 'Brgy. Elrio, Buhangin, Davao City'),
('7771256127', 'Marissa Ponce', '09000001111', 'Brgy. Elrio, Buhangin, Davao City'),
('8881256127', 'Mae Sarcos', '09123456788', 'Brgy. Mintal, Tugbok, Davao City');

-- --------------------------------------------------------

--
-- Table structure for table `student_guardian_info`
--

CREATE TABLE `student_guardian_info` (
  `LRN` varchar(20) NOT NULL,
  `Mother_name` varchar(50) DEFAULT NULL,
  `Father_name` varchar(50) DEFAULT NULL,
  `Guardian_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_guardian_info`
--

INSERT INTO `student_guardian_info` (`LRN`, `Mother_name`, `Father_name`, `Guardian_name`) VALUES
('1111256127', 'Reyes, Lilian', 'Reyes, Dante', 'Lilian Reyes'),
('2221256127', 'Francisco, Marimar', 'Francisco, Sergio', 'Sergio Francisco'),
('3331256127', 'Roxas, Monday', 'Roxas, Tuesday', 'Wednesday Roxas'),
('4441256127', 'Montelibano, Rosalie', 'Montelibano, Mario', 'Ash Montelibano'),
('5551256127', 'Limpag, Jaya', 'Limpag, Janno', 'Jaya Limpag'),
('6661256127', 'Bayquen, Regine', 'Bayquen, Ogie', 'Regine Bayquen'),
('7771256127', 'Ponce, Marissa', 'Ponce, Christopher', 'Marissa Ponce'),
('8881256127', 'Sarcos, Mae', 'Sarcos, Miguel', 'Mae Sarcos');

-- --------------------------------------------------------

--
-- Table structure for table `student_health`
--

CREATE TABLE `student_health` (
  `LRN` varchar(20) NOT NULL,
  `Weight` int(11) DEFAULT NULL,
  `Height` int(11) DEFAULT NULL,
  `BodyMass` int(11) DEFAULT NULL,
  `BCategory` varchar(25) DEFAULT NULL,
  `Remarks` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_health`
--

INSERT INTO `student_health` (`LRN`, `Weight`, `Height`, `BodyMass`, `BCategory`, `Remarks`) VALUES
('1111256127', 48, 2, 18, 'Normal', 'Healthy'),
('2221256127', 60, 2, 25, 'Above Normal', 'Healthy'),
('3331256127', 60, 2, 24, 'Normal', 'Healthy'),
('4441256127', 50, 2, 20, 'Normal', 'Healthy'),
('5551256127', 55, 2, 22, 'Normal', 'Healthy'),
('6661256127', 75, 2, 27, 'Above Normal', 'Healthy'),
('7771256127', 65, 2, 24, 'Normal', 'Healthy'),
('8881256127', 70, 2, 27, 'Normal', 'Healthy');

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

CREATE TABLE `student_info` (
  `LRN` varchar(20) NOT NULL,
  `Lastname` varchar(20) NOT NULL,
  `Firstname` varchar(20) NOT NULL,
  `Middlename` varchar(20) DEFAULT NULL,
  `Extension` varchar(10) DEFAULT NULL,
  `Sex` varchar(10) NOT NULL,
  `Birthdate` date NOT NULL,
  `Birthplace` varchar(100) NOT NULL,
  `Mothertongue` varchar(100) DEFAULT NULL,
  `Ethnic` varchar(100) DEFAULT NULL,
  `Religion` varchar(100) DEFAULT NULL,
  `Citizenship` varchar(50) NOT NULL,
  `Status` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`LRN`, `Lastname`, `Firstname`, `Middlename`, `Extension`, `Sex`, `Birthdate`, `Birthplace`, `Mothertongue`, `Ethnic`, `Religion`, `Citizenship`, `Status`, `Password`) VALUES
('1111256127', 'Reyes', 'Samantha Bianca', 'Tores', '', 'Female', '1999-12-08', 'Davao City', 'Cebuano', 'N/A', 'Iglesia Ni Cristo', 'Filipino', 'Single', 'student1'),
('2221256127', 'Francisco', 'Jessica', 'Ramos', '', 'Female', '1999-12-08', 'Davao City', 'Cebuano', 'N/A', 'Christian', 'Filipino', 'Single', 'student2'),
('23456789', 'Kate', 'Leah', 'Apog', '', 'female', '2022-05-03', 'Butuan', 'waray', 'None', 'Catholic', 'Filipino', 'Single', 'LE4Hkate'),
('3331256127', 'Roxas', 'Ellaine', 'Uy', '', 'Female', '1999-12-08', 'Davao City', 'Cebuano', 'N/A', 'Roman Catholic', 'Filipino', 'Single', 'student3'),
('4441256127', 'Montelibano', 'Maria Shairra', 'Rodriguez', '', 'Female', '1999-12-08', 'Davao City', 'Cebuano', 'N/A', 'Roman Catholic', 'Filipino', 'Single', 'student4'),
('5551256127', 'Limpag', 'Hanna', 'Lina', '', 'Female', '1999-12-08', 'Davao City', 'Cebuano', 'N/A', 'Roman Catholic', 'Filipino', 'Single', 'student5'),
('6661256127', 'Bayquen', 'Chad Luis', 'Bulacan', '', 'Male', '1999-12-08', 'Davao City', 'Cebuano', 'N/A', 'Roman Catholic', 'Filipino', 'Single', 'student6'),
('7771256127', 'Ponce', 'Carlos', 'Reyes', '', 'Male', '1999-11-05', 'Davao City', 'Cebuano', 'N/A', 'Christian', 'Filipino', 'Single', 'student7'),
('8881256127', 'Sarcos', 'Aaron', 'Bucog', '', 'Male', '1999-12-25', 'Davao City', 'Cebuano', 'N/A', 'Christian', 'Filipino', 'Single', 'student8');

-- --------------------------------------------------------

--
-- Table structure for table `student_update`
--

CREATE TABLE `student_update` (
  `requestID` int(255) NOT NULL,
  `LRN` varchar(20) DEFAULT NULL,
  `Weight` int(11) DEFAULT NULL,
  `Height` int(11) DEFAULT NULL,
  `Street` varchar(50) DEFAULT NULL,
  `Barangay` varchar(50) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `Province` varchar(50) DEFAULT NULL,
  `Tele_num` varchar(20) DEFAULT NULL,
  `Email` varchar(20) DEFAULT NULL,
  `Mobile_num` varchar(15) DEFAULT NULL,
  `Guardian_contact` varchar(15) DEFAULT NULL,
  `Guardian_address` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_update`
--

INSERT INTO `student_update` (`requestID`, `LRN`, `Weight`, `Height`, `Street`, `Barangay`, `City`, `Province`, `Tele_num`, `Email`, `Mobile_num`, `Guardian_contact`, `Guardian_address`) VALUES
(1, '1111256127', 48, 2, 'Marigold St.', 'Brgy Biao Guianga', 'Davao City', 'Davao del Sur', NULL, 'test@gmail', '09562115657', '092374228492', '11 Brgy. Biao Guianga, Tugbok Dist., Davao City');

-- --------------------------------------------------------

--
-- Table structure for table `student_year`
--

CREATE TABLE `student_year` (
  `LRN` varchar(20) NOT NULL,
  `Section` varchar(20) DEFAULT NULL,
  `Year_lvl` varchar(10) DEFAULT NULL,
  `Adviser_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_year`
--

INSERT INTO `student_year` (`LRN`, `Section`, `Year_lvl`, `Adviser_name`) VALUES
('1111256127', 'Rose', '7', 'Jessica Reyes'),
('2221256127', 'Rose', '7', 'Jessica Reyes'),
('3331256127', 'Rose', '7', 'Jessica Reyes'),
('4441256127', 'Rose', '7', 'Jessica Reyes'),
('5551256127', 'Rose', '7', 'Jessica Reyes'),
('6661256127', 'Rose', '7', 'Jessica Reyes'),
('7771256127', 'Rose', '7', 'Jessica Reyes'),
('8881256127', 'Rose', '7', 'Jessica Reyes');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `subject` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject`) VALUES
(1, 'Filipino'),
(2, 'English'),
(3, 'Araling Panlipunan'),
(4, 'Math'),
(5, 'Science'),
(6, 'Music'),
(7, 'Arts'),
(8, 'Health'),
(9, 'Physical Education'),
(10, 'Technology and Livelihood Education'),
(11, 'Edukasyon sa Pagpapakatao');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `employeenum` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `lastname` varchar(20) DEFAULT NULL,
  `firstname` varchar(20) DEFAULT NULL,
  `position` varchar(20) DEFAULT NULL,
  `year` varchar(10) DEFAULT NULL,
  `advisorysec` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `employeenum`, `password`, `lastname`, `firstname`, `position`, `year`, `advisorysec`) VALUES
(1, '11223344', 'teacher11', 'Reyes', 'Jessica', 'Teacher III', '7', 'Rose'),
(2, '22334455', 'teacher2', 'Brown', 'Dave', 'Teacher II', '8', 'Dagohoy'),
(3, '33445566', 'teacher3', 'Hamilton', 'Alexander', 'Teacher III', '9', 'Rizal'),
(4, '44556677', 'teacher4', 'Park', 'Sandra', 'Teacher III', '10', 'Maxwell'),
(5, '1029393', 'newTeach', 'Quixote', 'Don', 'Teacher III', '10', 'Pearl'),
(6, '2017803153102047', 'ednahalmae220392', 'PEREGRINO ', 'JONAH MAE ', 'Teacher III', '11', 'N/a'),
(7, '2017803153102047', 'ednahalmae220392', 'PEREGRINO ', 'JONAH MAE ', 'Teacher III', '11', 'N/a'),
(8, '1036942', 'Eunice1', 'Chatto', 'Eunice', 'Teacher I', '7', 'Daisy'),
(9, '1036942', 'Eunice1', 'Chatto', 'Eunice', 'Teacher I', '7', 'Daisy'),
(10, '07302021', 'Kish', 'Guma', 'Rosemalyn', 'Master Teacher I', '12', 'None'),
(11, '201811541', '201811541', 'Rapal', 'Emmie', 'Teacher I', '7', 'Rose');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_img`
--

CREATE TABLE `teacher_img` (
  `employeenum` varchar(50) NOT NULL,
  `Status` int(11) DEFAULT NULL,
  `file_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `userprofile`
--

CREATE TABLE `userprofile` (
  `adminpfp` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'administrator', '$2y$10$mDfML7xxsPqS40h0uoMQ5..BQY2/qWXN18vgV10LZP7ctO6DPsnVO', '2022-05-22 08:32:53'),
(2, 'jeon_wonwoo', '$2y$10$a.mZEtPvGCUo.YLTmLH1iu9.ERxiv1knZH1cirGF5X8Pg9/jUZ40G', '2022-05-24 19:23:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD UNIQUE KEY `e_filename` (`e_filename`);

--
-- Indexes for table `grade_per_year`
--
ALTER TABLE `grade_per_year`
  ADD PRIMARY KEY (`LRN`);

--
-- Indexes for table `profile_img`
--
ALTER TABLE `profile_img`
  ADD PRIMARY KEY (`LRN`);

--
-- Indexes for table `quarter_status`
--
ALTER TABLE `quarter_status`
  ADD PRIMARY KEY (`LRN`);

--
-- Indexes for table `sffiles`
--
ALTER TABLE `sffiles`
  ADD UNIQUE KEY `filename` (`filename`);

--
-- Indexes for table `student_contact`
--
ALTER TABLE `student_contact`
  ADD PRIMARY KEY (`LRN`);

--
-- Indexes for table `student_guardian_contact`
--
ALTER TABLE `student_guardian_contact`
  ADD PRIMARY KEY (`LRN`);

--
-- Indexes for table `student_guardian_info`
--
ALTER TABLE `student_guardian_info`
  ADD PRIMARY KEY (`LRN`);

--
-- Indexes for table `student_health`
--
ALTER TABLE `student_health`
  ADD PRIMARY KEY (`LRN`);

--
-- Indexes for table `student_info`
--
ALTER TABLE `student_info`
  ADD PRIMARY KEY (`LRN`);

--
-- Indexes for table `student_update`
--
ALTER TABLE `student_update`
  ADD PRIMARY KEY (`requestID`);

--
-- Indexes for table `student_year`
--
ALTER TABLE `student_year`
  ADD PRIMARY KEY (`LRN`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
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
-- AUTO_INCREMENT for table `student_update`
--
ALTER TABLE `student_update`
  MODIFY `requestID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
