-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2020 at 02:54 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `voting`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `name`) VALUES
(1, 'admin', 'admin', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `archived_voters`
--

CREATE TABLE `archived_voters` (
  `id` int(11) NOT NULL,
  `student_number` varchar(9) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `section_id` int(11) NOT NULL,
  `voters_code` varchar(9) NOT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comelec`
--

CREATE TABLE `comelec` (
  `id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comelec`
--

INSERT INTO `comelec` (`id`, `username`, `password`, `name`) VALUES
(1, 'comelec', 'comelec', 'Comelec');

-- --------------------------------------------------------

--
-- Table structure for table `manage_grade`
--

CREATE TABLE `manage_grade` (
  `grade` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manage_grade`
--

INSERT INTO `manage_grade` (`grade`) VALUES
('11'),
('12');

-- --------------------------------------------------------

--
-- Table structure for table `manage_section`
--

CREATE TABLE `manage_section` (
  `id` int(20) NOT NULL,
  `grade` varchar(100) NOT NULL,
  `strand` varchar(100) NOT NULL,
  `section` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manage_section`
--

INSERT INTO `manage_section` (`id`, `grade`, `strand`, `section`) VALUES
(1, '11', 'ICT', 'Messenger'),
(4, '11', 'ICT', 'Skype'),
(5, '11', 'ICT', 'Viber'),
(6, '12', 'ICT', 'Hangouts'),
(7, '12', 'ICT', 'Kakaotalk'),
(8, '12', 'ICT', 'Facetime'),
(9, '11', 'STEM', 'Vine'),
(10, '11', 'STEM', 'Twitter'),
(11, '11', 'STEM', 'Facebook'),
(12, '12', 'STEM', 'G Maps'),
(13, '12', 'STEM', 'Waze'),
(14, '11', 'H.E', 'Itunes'),
(15, '11', 'H.E', 'Spinnr'),
(16, '11', 'H.E', 'WinAmp'),
(17, '12', 'H.E', 'LinkedIn'),
(18, '12', 'H.E', 'Slingshot'),
(19, '12', 'H.E', 'Snapshot'),
(20, '11', 'ABM', 'Instagram'),
(21, '11', 'ABM', 'Tumblr'),
(22, '11', 'ABM', 'Pinterest'),
(23, '12', 'ABM', 'Microsoft Edge'),
(24, '12', 'ABM', 'Safari'),
(25, '12', 'ABM', 'Mozilla Firefox'),
(26, '12', 'ABM', 'Google Chrome'),
(27, '11', 'HUMSS', 'MetaCafe'),
(28, '11', 'HUMSS', 'Youtube'),
(29, '11', 'HUMSS', 'Twitch'),
(30, '11', 'HUMSS', 'Daily Motion'),
(31, '12', 'HUMSS', 'Photoscape'),
(32, '12', 'HUMSS', 'Photopea'),
(34, '11', 'GAS', 'Vimeo'),
(35, '12', 'GAS', 'Blizzard');

-- --------------------------------------------------------

--
-- Table structure for table `manage_strand`
--

CREATE TABLE `manage_strand` (
  `strand` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manage_strand`
--

INSERT INTO `manage_strand` (`strand`) VALUES
('ICT'),
('STEM'),
('H.E'),
('ABM'),
('HUMSS');

-- --------------------------------------------------------

--
-- Table structure for table `nominees`
--

CREATE TABLE `nominees` (
  `id` int(11) NOT NULL,
  `img` varchar(200) NOT NULL,
  `partylist` varchar(60) NOT NULL,
  `pos` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `strand` varchar(60) NOT NULL,
  `grade` varchar(3) NOT NULL,
  `section` varchar(40) NOT NULL,
  `student_number` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nominees`
--

INSERT INTO `nominees` (`id`, `img`, `partylist`, `pos`, `last_name`, `first_name`, `middle_name`, `strand`, `grade`, `section`, `student_number`) VALUES
(1, 'LIKE-President.jpg', 'LIKE', 'President', 'Rouello', 'Jaen', 'AbRR', 'ICT', '12', 'G', '529366753'),
(2, 'OPPA-President.jpg', 'OPPA', 'President', 'Romero', 'Angeline', '', 'ICT', '12', 'A', '379532492'),
(3, 'LIKE-VicePresident.jpg', 'LIKE', 'Vice President', 'Partosa', 'Sebastian', '', 'ICT', '12', 'A', '575779252'),
(4, 'OPPA-VicePresident.jpg', 'OPPA', 'Vice President', 'Mendoza', 'Ace Louie', '', 'ICT', '12', 'A', '292846790'),
(6, 'LIKE-Secretary.jpg', 'LIKE', 'Secretary', 'Beltran', 'Jazmine', '', 'ICT', '12', 'A', '355589652'),
(7, 'OPPA-Secretary.jpg', 'OPPA', 'Secretary', 'Mendez', 'Niecel', '', 'ICT', '12', 'A', '219372345'),
(8, 'LIKE-Auditor.jpg', 'LIKE', 'Auditor', 'Bandala', 'Katrina', '', 'ICT', '12', 'A', '913403295'),
(9, 'OPPA-Auditor.jpg', 'OPPA', 'Auditor', 'Ibay', 'Wendell', '', 'ICT', '12', 'A', '728836984'),
(10, 'LIKE-Treasurer.jpg', 'LIKE', 'Treasurer', 'Aquino', 'Raizza', '', 'ICT', '11', 'A', '811832192'),
(11, 'OPPA-Treasurer.jpg', 'OPPA', 'Treasurer', 'Rona', 'Joshua Carlos', '', 'ICT', '12', 'A', '141883549'),
(12, '', 'LIKE', 'Peace Officer', 'Tabian', 'Benice', '', 'ICT', '12', 'A', '902539357'),
(13, 'OPPA-PeaceOfficer.jpg', 'OPPA', 'Peace Officer', 'Jaldo', 'Arnan Hipolito', '', 'ICT', '12', 'A', '21145869'),
(14, '', 'LIKE', 'P.I.O', 'Parungao', 'Patrick', '', 'ICT', '12', 'A', '247080167'),
(15, 'OPPA-PIO.jpg', 'OPPA', 'P.I.O', 'Garcia', 'Leanne Joyce', '', 'ICT', '12', 'A', '519745966');

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `id` int(11) NOT NULL,
  `partylist` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`id`, `partylist`) VALUES
(1, 'LIKE'),
(2, 'OPPA'),
(3, 'SAMPLE');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `partylist` varchar(60) NOT NULL,
  `pos` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `partylist`, `pos`) VALUES
(1, 'LIKE', 'President'),
(2, 'LIKE', 'Vice President'),
(3, 'LIKE', 'Secretary'),
(4, 'LIKE', 'Auditor'),
(5, 'LIKE', 'Treasurer'),
(6, 'LIKE', 'Peace Officer'),
(7, 'LIKE', 'P.I.O'),
(18, 'OPPA', 'President'),
(19, 'OPPA', 'Vice President'),
(20, 'OPPA', 'Secretary'),
(21, 'OPPA', 'Auditor'),
(22, 'OPPA', 'Treasurer'),
(23, 'OPPA', 'Peace Officer'),
(24, 'OPPA', 'P.I.O');

-- --------------------------------------------------------

--
-- Table structure for table `voters`
--

CREATE TABLE `voters` (
  `id` int(11) NOT NULL,
  `student_number` varchar(9) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `section_id` int(11) NOT NULL,
  `voters_code` varchar(9) NOT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `partylist` varchar(60) NOT NULL,
  `pos` varchar(60) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `voters_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `partylist`, `pos`, `candidate_id`, `voters_id`) VALUES
(1, 'LIKE', 'President', 1, 2),
(2, 'OPPA', 'Vice President', 4, 2),
(3, 'LIKE', 'Secretary', 6, 2),
(4, 'OPPA', 'Auditor', 9, 2),
(5, 'LIKE', 'Treasurer', 10, 2),
(6, 'OPPA', 'Peace Officer', 13, 2),
(7, 'OPPA', 'P.I.O', 15, 2),
(8, 'LIKE', 'President', 1, 3),
(9, 'LIKE', 'Vice President', 3, 3),
(10, 'LIKE', 'Secretary', 6, 3),
(11, 'OPPA', 'Auditor', 9, 3),
(12, 'OPPA', 'Treasurer', 11, 3),
(13, 'OPPA', 'Peace Officer', 13, 3),
(14, 'OPPA', 'P.I.O', 15, 3),
(15, 'LIKE', 'President', 1, 4),
(16, 'LIKE', 'Vice President', 3, 4),
(17, 'OPPA', 'Secretary', 7, 4),
(18, 'OPPA', 'Auditor', 9, 4),
(19, 'OPPA', 'Treasurer', 11, 4),
(20, 'OPPA', 'Peace Officer', 13, 4),
(21, 'LIKE', 'P.I.O', 14, 4),
(22, 'OPPA', 'President', 2, 5),
(23, 'OPPA', 'Vice President', 4, 5),
(24, 'OPPA', 'Secretary', 7, 5),
(25, 'OPPA', 'Auditor', 9, 5),
(26, 'OPPA', 'Treasurer', 11, 5),
(27, 'OPPA', 'Peace Officer', 13, 5),
(28, 'OPPA', 'P.I.O', 15, 5),
(29, 'OPPA', 'President', 2, 20),
(30, 'OPPA', 'Vice President', 4, 20),
(31, 'OPPA', 'Secretary', 7, 20),
(32, 'OPPA', 'Auditor', 9, 20),
(33, 'OPPA', 'Treasurer', 11, 20),
(34, 'OPPA', 'Peace Officer', 13, 20),
(35, 'OPPA', 'P.I.O', 15, 20),
(36, 'LIKE', 'President', 1, 38),
(37, 'LIKE', 'Vice President', 3, 38),
(38, 'LIKE', 'Secretary', 6, 38),
(39, 'LIKE', 'Auditor', 8, 38),
(40, 'LIKE', 'Treasurer', 10, 38),
(41, 'LIKE', 'Peace Officer', 12, 38),
(42, 'OPPA', 'P.I.O', 15, 38),
(43, 'LIKE', 'President', 1, 7),
(44, 'OPPA', 'Vice President', 4, 7),
(45, 'LIKE', 'Secretary', 6, 7),
(46, 'OPPA', 'Auditor', 9, 7),
(47, 'OPPA', 'Treasurer', 11, 7),
(48, 'LIKE', 'Peace Officer', 12, 7),
(49, 'LIKE', 'P.I.O', 14, 7),
(50, 'OPPA', 'President', 2, 8),
(51, 'LIKE', 'Vice President', 3, 8),
(52, 'LIKE', 'Secretary', 6, 8),
(53, 'OPPA', 'Auditor', 9, 8),
(54, 'LIKE', 'Treasurer', 10, 8),
(55, 'LIKE', 'Peace Officer', 12, 8),
(56, 'OPPA', 'P.I.O', 15, 8),
(57, 'OPPA', 'President', 2, 10),
(58, 'OPPA', 'Vice President', 4, 10),
(59, 'OPPA', 'Secretary', 7, 10),
(60, 'OPPA', 'Auditor', 9, 10),
(61, 'LIKE', 'Treasurer', 10, 10),
(62, 'OPPA', 'Peace Officer', 13, 10),
(63, 'OPPA', 'P.I.O', 15, 10);

-- --------------------------------------------------------

--
-- Table structure for table `votingpage`
--

CREATE TABLE `votingpage` (
  `id` int(20) NOT NULL,
  `status` varchar(50) NOT NULL,
  `strtyear` int(5) NOT NULL,
  `endyear` int(5) NOT NULL,
  `voting` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `votingpage`
--

INSERT INTO `votingpage` (`id`, `status`, `strtyear`, `endyear`, `voting`) VALUES
(1, 'ACTIVE', 2019, 2020, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archived_voters`
--
ALTER TABLE `archived_voters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comelec`
--
ALTER TABLE `comelec`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_section`
--
ALTER TABLE `manage_section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nominees`
--
ALTER TABLE `nominees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voters`
--
ALTER TABLE `voters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votingpage`
--
ALTER TABLE `votingpage`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `archived_voters`
--
ALTER TABLE `archived_voters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `comelec`
--
ALTER TABLE `comelec`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `manage_section`
--
ALTER TABLE `manage_section`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `nominees`
--
ALTER TABLE `nominees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE `organization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `voters`
--
ALTER TABLE `voters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `votingpage`
--
ALTER TABLE `votingpage`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
