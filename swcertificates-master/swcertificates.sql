-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2021 at 08:55 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `swcertificates`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` char(4) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `account_type` varchar(10) NOT NULL,
  `created_by` varchar(15) NOT NULL DEFAULT 'admin',
  `created_at` varchar(30) NOT NULL DEFAULT current_timestamp(),
  `password_changed_at` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `account_type`, `created_by`, `created_at`, `password_changed_at`) VALUES
('US01', 'admin_faculty', '54f9c3750d844a9901ecd3581a8d1d2b', 'super', 'admin', '04-05-2021 at 01:00:55 PM', ''),
('US02', 'admin_student', '54f9c3750d844a9901ecd3581a8d1d2b', 'user', 'admin', '04-05-2021 at 01:00:20 PM', ''),
('US11', 'dsw', '6c86a08a6001d96360496f62f03c0d08', 'super', 'admin', '04-05-2021 at 12:58:17 PM', ''),
('US12', 'adsw', '1e5d878c6849a7f7c993aa6c53e30271', 'super', 'admin', '04-05-2021 at 12:54:59 PM', ''),
('US13', 'culsec', '64d535185b05175f46f0f6a4a561164c', 'user', 'admin', '04-05-2021 at 12:55:46 PM', ''),
('US14', 'culexec', '8d730ab4be4f0dc1893163972f5e384f', 'user', 'admin', '04-05-2021 at 12:56:54 PM', '');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` char(7) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `event_organiser` varchar(100) NOT NULL,
  `event_date` date NOT NULL,
  `guest` tinyint(1) NOT NULL DEFAULT 0,
  `internal_participant` tinyint(1) NOT NULL DEFAULT 0,
  `internal_winner` tinyint(1) NOT NULL DEFAULT 0,
  `external_participant` tinyint(1) NOT NULL DEFAULT 0,
  `external_winner` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` varchar(15) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `event_id` char(7) NOT NULL,
  `guest_id` char(6) NOT NULL,
  `guest_name` varchar(100) NOT NULL,
  `guest_email` varchar(100) NOT NULL,
  `request_status` tinyint(1) NOT NULL DEFAULT 0,
  `requested_by` varchar(15) NOT NULL,
  `requested_at` varchar(30) NOT NULL,
  `approval_status` tinyint(1) NOT NULL DEFAULT 0,
  `approved_by` varchar(15) NOT NULL,
  `approved_at` varchar(30) NOT NULL,
  `generate_status` tinyint(1) NOT NULL DEFAULT 0,
  `generated_by` varchar(15) NOT NULL,
  `generated_at` varchar(30) NOT NULL,
  `mail_status` tinyint(1) NOT NULL DEFAULT 0,
  `mailed_by` varchar(15) NOT NULL,
  `mailed_at` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `organisers`
--

CREATE TABLE `organisers` (
  `id` char(5) NOT NULL,
  `organiser_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `organisers`
--

INSERT INTO `organisers` (`id`, `organiser_name`) VALUES
('CC115', 'Alpha Bio Cell (ABC)'),
('CC113', 'Anchoring Club'),
('CC100', 'Animation Club'),
('CC146', 'Anokha '),
('CC116', 'Apple Developers Group (ADG)'),
('CC117', 'Archi-Tech'),
('CC147', 'Ayuda\r\n'),
('CC112', 'Beat Boxing Club'),
('CC148', 'Becoming I Foundation'),
('CC175', 'Bengali Literary Association (Aikyataan-BLA)'),
('CC163', 'Board Gamers Club -BGC'),
('CC118', 'Bulls and\r\nBears '),
('CC119', 'Centre for Social Entrepreneurship Development (CSED)'),
('CC120', 'CODECHEF'),
('CC111', 'Comedy Club - VIT'),
('CC122', 'Community Radio'),
('CC121', 'Creation Lab'),
('CC133', 'Creativity Club'),
('CC164', 'Cubing Club'),
('CC167', 'Cycling Club'),
('CC144', 'Dance Club'),
('CC155', 'Debate Society'),
('CC123', 'Developers Student Club (DSC)'),
('CC141', 'Digit Squad'),
('CC177', 'Dramatics Club'),
('CC124', 'Dream Merchants'),
('CC125', 'Energy and Environment Protection Club (E2 PC)'),
('CC176', 'English Literary Association (ELA)'),
('CC126', 'Entrepreneurs Cell (E-cell)'),
('CC149', 'FEP-SI'),
('CC150', 'Fifth (5th) Pillar '),
('CC168', 'Fitness n Beyond'),
('CC189', 'French Literary Association (FLA)'),
('CC190', 'German Literary Association (DLA)'),
('CC191', 'Gujarati Literary Association (GLA)'),
('CC127', 'Gurutva - The Physics Club'),
('CC169', 'Health Club'),
('CC160', 'HEARTS Club -UHET'),
('CC102', 'Hertitage Club'),
('CC178', 'Hindi Literary Association (HLA)'),
('CC128', 'Innovator\'s Quest'),
('CC129', 'Internet of Things Community (IoThinC)'),
('CC151', 'Juvenile Care '),
('CC179', 'Kannada Literary Association (Kannada Kasthuri-KLA)'),
('CC152', 'Leo Club '),
('CC130', 'Linux User\'s Group'),
('CC153', 'Make A Difference (M A D)'),
('CC180', 'Malayalam Literary Association (Thanima-MLA)'),
('CC181', 'Marathi Literature Association (Yuva Marathi)'),
('CC142', 'Matrix-Multimedia Club'),
('CC131', 'Mozilla Firefox '),
('CC103', 'Music Club'),
('CC154', 'National Cadet Corps (NCC)'),
('CC182', 'National Digital Library Club'),
('CC156', 'National Service Scheme (NSS) '),
('CC104', 'Nature Lover’s Club'),
('CC170', 'Nutrition Club'),
('CC193', 'Office of the Students\' Welfare'),
('CC114', 'Otaku-Anime Fan Club'),
('CC105', 'Photography Club'),
('CC166', 'Pixelate-Design Club'),
('CC192', 'Punjabi Literary Association (PLA)'),
('CC106', 'Quiz Club'),
('CC132', 'RoboVITics'),
('CC157', 'Rotaract Club '),
('CC173', 'Skating Club'),
('CC174', 'Smile Over Stress(SOS)'),
('CC134', 'Solai Club'),
('CC107', 'SPIC MACAY'),
('CC135', 'Students’ Association of Bio-Engineering Science and Technology (SABEST)'),
('CC183', 'Tamil Literary Association (TLA)'),
('CC136', 'Technology and Gaming (TAG)'),
('CC108', 'TEDxVIT'),
('CC184', 'Telugu Literary Association (Sahiti)'),
('CC145', 'The AI & MI Club -TAM'),
('CC137', 'The Catalyst Club'),
('CC165', 'The Culinary Club'),
('CC186', 'The Deccan Chronicle Club'),
('CC138', 'The Electronics Club (TEC)'),
('CC101', 'The Fine Arts Club-TFAC'),
('CC187', 'The Hindu Education Plus Club'),
('CC185', 'The Next Chapter-The Book Club'),
('CC158', 'The Red Ribbon '),
('CC171', 'Trekking Club'),
('CC159', 'Uddeshya '),
('CC139', 'Visual Blogger\'s Club-VBC'),
('CC188', 'VIT Film Society-VFS'),
('CC109', 'VIT Model United Nations Society'),
('CC110', 'VIT Spartans'),
('CC143', 'VIT Stellar -Astronomy Club'),
('CC162', 'Vrisksh'),
('CC172', 'Yoga Club '),
('CC161', 'Youth Red Cross Association (YRC)'),
('CC140', 'Zero Waste Management Club-ZWM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`guest_id`);

--
-- Indexes for table `organisers`
--
ALTER TABLE `organisers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `organiser_name` (`organiser_name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
