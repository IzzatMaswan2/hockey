-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 10, 2024 at 09:54 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `real_time_sport`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `article_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `summary` text NOT NULL,
  `date_news` date NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('draft','published','archived') DEFAULT 'draft'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`article_id`, `title`, `img`, `content`, `summary`, `date_news`, `author_id`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Young Tigers lose all their matches in Australian-tower.', NULL, 'KUALA LUMPUR: The national youth hockey team, known as the Young Tigers, recently embarked on a playing tour in Australia, where they faced a tough series of matches against the Australian junior team. Unfortunately for the Young Tigers, the tour ended in disappointment as they lost all four of their friendly matches.\r\n\r\n\r\nIn their time in Brisbane, the Malaysian side struggled against their Australian counterparts. The first three matches saw the Young Tigers defeated with scores of 4-2, 5-2, and 2-0. The trend continued with a final heavy loss of 5-1 in their most recent game.\r\n\r\n\r\nLed by coach I. Vickneswaran, the Young Tigers encountered formidable opponents and were unable to secure any victories. The results of these matches raise concerns about their readiness for the upcoming Sultan of Johor Cup, scheduled to take place from October 19-26. This prestigious tournament will feature teams from Australia, India, Britain, Japan, and New Zealand.\r\n\r\n\r\nDespite the challenges faced during the tour, the Young Tigers will need to regroup and address their shortcomings in preparation for the Sultan of Johor Cup.', 'The Young Tigers\' recent tour of Australia ended in a series of crushing defeats, leaving the national youth hockey team reeling. With a string of losses to the Australian junior squad, including a heavy 5-1 thrashing in their final match, questions arise about their readiness for the upcoming Sultan of Johor Cup. As they prepare to face top international teams, will the Young Tigers bounce back or continue their struggle?', '2024-08-18', NULL, '2024-09-04 17:15:06', '2024-09-04 17:19:52', 'published');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `id` int(11) NOT NULL,
  `card_type` varchar(50) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`id`, `card_type`, `count`) VALUES
(1, 'red', 4),
(2, 'yellow', 3),
(3, 'green', 5);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(1) NOT NULL DEFAULT '1',
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `location`) VALUES
(1, 'Stadium Hoki Tun Razak, 2, Persiaran Tuanku Syed Sirajuddin, Bukit Tunku, 50480 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur');

-- --------------------------------------------------------

--
-- Table structure for table `contactemail`
--

CREATE TABLE `contactemail` (
  `email_id` int(1) NOT NULL,
  `contact_id` int(1) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contactemail`
--

INSERT INTO `contactemail` (`email_id`, `contact_id`, `email`) VALUES
(1, 1, 'arenahoki@gmail.com'),
(2, 1, 'sturtsy@hoki.com');

-- --------------------------------------------------------

--
-- Table structure for table `contactphone`
--

CREATE TABLE `contactphone` (
  `phone_id` int(1) NOT NULL,
  `contact_id` int(1) NOT NULL,
  `phone_number` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contactphone`
--

INSERT INTO `contactphone` (`phone_id`, `contact_id`, `phone_number`) VALUES
(1, 1, '+6012-3456789'),
(2, 1, '+6019-8765432');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(100) NOT NULL,
  `country_code` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `country_languages`
--

CREATE TABLE `country_languages` (
  `country_language_id` int(11) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `language_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `goals`
--

CREATE TABLE `goals` (
  `id` int(11) NOT NULL,
  `player_id` int(11) DEFAULT NULL,
  `match_id` int(11) DEFAULT NULL,
  `scored_goals` int(11) DEFAULT NULL,
  `penalty_corner` int(11) DEFAULT NULL,
  `goal_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `goals`
--

INSERT INTO `goals` (`id`, `player_id`, `match_id`, `scored_goals`, `penalty_corner`, `goal_time`) VALUES
(1, 1, 1, 3, 1, '13:58:12'),
(2, 2, 1, 4, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `GroupID` int(11) NOT NULL,
  `TournamentID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`GroupID`, `TournamentID`, `Name`, `Description`) VALUES
(1, 1, 'Group A', 'This is Group A in Tournament 1'),
(2, 1, 'Group B', 'This is Group B in Tournament 1'),
(3, 1, 'Group C', 'This is Group C in Tournament 2'),
(4, 1, 'Group D', 'This is Group D in Tournament 2'),
(5, 1, 'Group E', 'This is Group E in Tournament 3'),
(6, 1, 'Group F', 'This is Group F in Tournament 3'),
(7, 1, 'Group G', 'This is Group G in Tournament 1'),
(8, 1, 'Group H', 'This is Group H in Tournament 1'),
(9, 2, 'Group A', 'This is Group A in Tournament 2'),
(10, 2, 'Group B', 'This is Group B in Tournament 2'),
(11, 2, 'Group C', 'This is Group C in Tournament 2'),
(12, 2, 'Group D', 'This is Group D in Tournament 2'),
(13, 2, 'Group E', 'This is Group E in Tournament 2'),
(14, 2, 'Group F', 'This is Group F in Tournament 2'),
(15, 2, 'Group G', 'This is Group G in Tournament 2'),
(16, 2, 'Group H', 'This is Group H in Tournament 2'),
(17, 3, 'Group A', 'This is Group A in Tournament 3'),
(18, 3, 'Group B', 'This is Group B in Tournament 3'),
(19, 3, 'Group C', 'This is Group C in Tournament 3'),
(20, 3, 'Group D', 'This is Group D in Tournament 3'),
(21, 3, 'Group E', 'This is Group E in Tournament 3'),
(22, 3, 'Group F', 'This is Group F in Tournament 3'),
(23, 3, 'Group G', 'This is Group G in Tournament 3'),
(24, 3, 'Group H', 'This is Group H in Tournament 3');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `judge`
--

CREATE TABLE `judge` (
  `JudgeID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `judge`
--

INSERT INTO `judge` (`JudgeID`, `Name`, `Role`) VALUES
(1, 'John Doe', 'Scoring Judge'),
(2, 'Jane Smith', 'Timing Judge'),
(3, 'Michael Brown', 'Scoring Judge'),
(4, 'Emily Davis', 'Timing Judge'),
(5, 'Robert Wilson', 'Scoring Judge'),
(6, 'Linda Taylor', 'Timing Judge');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `language_id` int(11) NOT NULL,
  `language_name` varchar(100) NOT NULL,
  `language_code` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `team_id` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `state` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`id`, `name`, `team_id`, `age`, `state`) VALUES
(1, 'Manan', 1, 50, 'Selangor'),
(2, 'Gojo', 2, 40, 'Selangor'),
(3, 'Levi', 3, 35, 'Selangor'),
(4, 'Aizawa', 4, 40, 'Selangor');

-- --------------------------------------------------------

--
-- Table structure for table `match_group`
--

CREATE TABLE `match_group` (
  `Match_groupID` int(11) NOT NULL,
  `TournamentID` int(11) NOT NULL,
  `TeamAID` int(11) NOT NULL,
  `TeamBID` int(11) NOT NULL,
  `GroupID` int(11) DEFAULT NULL,
  `match_status` int(1) NOT NULL DEFAULT '0',
  `Date` datetime NOT NULL,
  `Category` varchar(50) NOT NULL,
  `ScoreA` int(11) NOT NULL DEFAULT '0',
  `ScoreB` int(11) NOT NULL DEFAULT '0',
  `Venue` varchar(255) NOT NULL,
  `ScoringJudgeID` int(11) DEFAULT NULL,
  `TimingJudgeID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `match_group`
--

INSERT INTO `match_group` (`Match_groupID`, `TournamentID`, `TeamAID`, `TeamBID`, `GroupID`, `match_status`, `Date`, `Category`, `ScoreA`, `ScoreB`, `Venue`, `ScoringJudgeID`, `TimingJudgeID`) VALUES
(1, 1, 1, 2, 1, 1, '2024-04-05 15:00:00', 'Group Stage', 2, 1, 'FIELD A, STADIUM KUALA LUMPUR', 1, 2),
(2, 1, 3, 4, 2, 1, '2024-04-06 17:00:00', 'Group Stage', 1, 2, 'FIELD B, STADIUM KUALA LUMPUR', 1, 2),
(3, 2, 5, 6, 3, 0, '2024-05-12 16:00:00', 'Group Stage', 3, 1, 'FIELD C, CITY STADIUM PENANG', 1, 2),
(4, 2, 1, 2, 4, 0, '2024-05-13 18:00:00', 'Group Stage', 0, 0, 'FIELD D, CITY STADIUM PENANG', 1, 2),
(5, 3, 3, 4, 5, 0, '2024-06-20 14:00:00', 'Group Stage', 4, 2, 'FIELD E, JOHOR BAHRU SPORTS COMPLEX', 1, 2),
(6, 3, 5, 6, 6, 2, '2024-06-21 16:00:00', 'Group Stage', 2, 3, 'FIELD F, JOHOR BAHRU SPORTS COMPLEX', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `name`, `phone_number`, `email`, `message`) VALUES
(1, 'WAN MUHAMAD IZZAT BIN WAN ABU OSMAN', '+60 11-5671 8047', 'test@gmail.com', 'hello'),
(2, 'wan Izzat', '01156718047', 'king@gmail.com', 'Hello World of Chaos');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(13, '0001_01_01_000001_create_cache_table', 1),
(14, '0001_01_01_000002_create_jobs_table', 1),
(15, '2014_10_12_000000_create_users_table', 1),
(16, '2024_08_20_111023_create_personal_access_tokens_table', 1),
(17, '2024_08_23_030521_create_team_table', 1),
(18, '2024_08_23_030533_create_group_table', 1),
(19, '2024_08_23_030543_create_judge_table', 1),
(20, '2024_08_23_030553_create_match_group_table', 1),
(21, '2024_08_23_030603_create_player_table', 1),
(22, '2024_08_23_030613_create_playerstatmatch_table', 1),
(23, '2024_08_23_030623_create_stat_table', 1),
(24, '2024_08_23_030631_create_tournament_table', 1),
(25, '2024_08_27_061400_create_sessions_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `PlayerID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `TeamID` int(11) NOT NULL,
  `field_status` int(1) NOT NULL,
  `Position` varchar(50) DEFAULT NULL,
  `jerseyNumber` int(3) NOT NULL,
  `Birthdate` date DEFAULT NULL,
  `Nationality` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`PlayerID`, `Name`, `fullname`, `TeamID`, `field_status`, `Position`, `jerseyNumber`, `Birthdate`, `Nationality`) VALUES
(1, 'Alice Johnson', '', 1, 1, 'Forward', 1, '1995-02-15', 'Malaysian'),
(2, 'Bob Lee', '', 1, 1, 'Defender', 2, '1994-11-22', 'Malaysian'),
(3, 'Charlie Kim', '', 2, 1, 'Goalkeeper', 2, '1996-06-30', 'Malaysian'),
(4, 'Diana Wong', '', 3, 0, 'Forward', 1, '1993-04-10', 'Thai'),
(5, 'Eric Tan', '', 4, 0, 'Midfielder', 4, '1992-08-05', 'Thai'),
(6, 'Fiona Liu', '', 5, 0, 'Defender', 5, '1995-12-20', 'Japanese'),
(7, 'George Wang', '', 6, 0, 'Forward', 7, '1997-09-12', 'Japanese'),
(8, 'Arif Zakaria', '', 1, 1, 'Forward', 8, '1995-02-18', 'Malaysian'),
(9, 'Siti Aishah', '', 1, 1, 'Defender', 9, '1997-11-05', 'Malaysian'),
(10, 'Ali Hassan', '', 1, 2, 'Midfielder', 7, '1996-03-25', 'Malaysian'),
(11, 'Rizal Ahmad', '', 1, 2, 'Goalkeeper', 11, '1994-08-22', 'Malaysian'),
(12, 'Nina Abdul', '', 2, 1, 'Forward', 12, '1993-09-15', 'Malaysian'),
(13, 'Hafiz Omar', '', 2, 1, 'Defender', 13, '1995-12-04', 'Malaysian'),
(14, 'Laila Ismail', '', 2, 1, 'Midfielder', 14, '1994-07-30', 'Malaysian'),
(15, 'Zainal Abidin', '', 2, 1, 'Goalkeeper', 15, '1992-11-11', 'Malaysian');

-- --------------------------------------------------------

--
-- Table structure for table `playerstatmatch`
--

CREATE TABLE `playerstatmatch` (
  `PlayerStatMatchID` int(11) NOT NULL,
  `PlayerID` int(11) NOT NULL,
  `Match_groupID` int(11) NOT NULL,
  `Time` time DEFAULT NULL,
  `StatID` int(11) NOT NULL,
  `Reason` varchar(100) DEFAULT NULL,
  `Score` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `playerstatmatch`
--

INSERT INTO `playerstatmatch` (`PlayerStatMatchID`, `PlayerID`, `Match_groupID`, `Time`, `StatID`, `Reason`, `Score`) VALUES
(1, 1, 1, '00:15:00', 1, NULL, 1),
(2, 2, 1, '00:30:00', 3, NULL, 1),
(3, 3, 2, '00:45:00', 3, NULL, 1),
(4, 4, 2, '00:10:00', 4, 'Foul', 0),
(5, 5, 4, '00:20:00', 5, NULL, 1),
(6, 6, 5, '00:35:00', 6, 'Misconduct', 0),
(7, 7, 6, '00:40:00', 6, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ply_field`
--

CREATE TABLE `ply_field` (
  `ply_fieldID` int(1) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ply_field`
--

INSERT INTO `ply_field` (`ply_fieldID`, `name`, `description`) VALUES
(0, 'member', 'member of team. '),
(1, 'Starting', 'Represents primary or starting participants in an event or match.'),
(2, 'Reserve', 'Represents backup or reserve participants who might take the place of starters if needed.');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `id` int(11) NOT NULL,
  `team_id` int(11) DEFAULT NULL,
  `opponent_team_id` int(11) DEFAULT NULL,
  `result` enum('win','loss','draw') NOT NULL,
  `date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `venue` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`id`, `team_id`, `opponent_team_id`, `result`, `date`, `start_time`, `end_time`, `venue`) VALUES
(1, 1, 3, 'draw', '2024-08-25', '10:59:02', '13:59:04', 'National Arena, City'),
(5, 2, 3, 'win', '2024-09-03', '10:51:55', '11:51:55', 'National Arena, City'),
(6, 2, 4, 'loss', '2024-09-04', '12:54:55', '13:54:55', 'National Arena, City'),
(7, 1, 4, 'win', '2024-09-05', '10:56:38', '11:56:38', 'National Arena, City');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('KhoxXAL9NuuROuq9yJbZVoMsb5e4LUpLhvhGe3fw', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoic0lmTVdpeDA1YXN3c1FnZ1ZSdE9RMFAyVFRqSmtFMTlhd0xVcXBubSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1725263560),
('mXQ5oP0sAnyjsPuBvhLL4bsl2MRiQ7MVzcosp94I', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUkI4Q1VMeERnMzBxeldXVHJJbFpHcVJwaW1McUJHNDk0eXVlUnNXOSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90b3VybmFtZW50Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1725962009);

-- --------------------------------------------------------

--
-- Table structure for table `stat`
--

CREATE TABLE `stat` (
  `StatID` int(11) NOT NULL,
  `Type` varchar(20) NOT NULL,
  `Description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stat`
--

INSERT INTO `stat` (`StatID`, `Type`, `Description`) VALUES
(1, 'Goal', 'Field Goal'),
(2, 'Goal', 'Penalty Goal'),
(3, 'Goal', 'Corner Goal'),
(4, 'Card', 'Green Card'),
(5, 'Card', 'Yellow Card'),
(6, 'Card', 'Red Card');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `TeamID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `country` varchar(50) NOT NULL,
  `LogoURL` varchar(255) DEFAULT NULL,
  `Description` text,
  `CoachName` varchar(100) DEFAULT NULL,
  `total_player` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`TeamID`, `Name`, `country`, `LogoURL`, `Description`, `CoachName`, `total_player`) VALUES
(1, 'Tropical Titans', 'Malaysia', 'img/teamAlogo.png', 'A top team from Malaysia', 'John Doe', 5),
(2, 'Malayan Mavericks', 'Malaysia', 'img/teamBlogo.png', 'Another strong team from Malaysia', 'Jane Smith', 6),
(3, 'Chiang Mai Chameleons', 'Thailand', 'img/teamClogo.png', 'A leading team from Thailand', 'David Brown', 4),
(4, 'Phuket Phantoms', 'Thailand', 'img/teamDlogo.png', 'A competitive team from Thailand', 'Emily White', 6),
(5, 'Sakura Spirits', 'Japan', 'img/teamElogo.png', 'A powerful team from Japan', 'Michael Green', 5),
(6, 'J-Phoenix', 'Japan', 'img/teamFlogo.png', 'A promising team from Japan', 'Sarah Black', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tournaments`
--

CREATE TABLE `tournaments` (
  `TournamentID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `Location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tournaments`
--

INSERT INTO `tournaments` (`TournamentID`, `Name`, `StartDate`, `EndDate`, `Location`) VALUES
(1, 'MALAYSIA OPEN 2024', '2024-03-01', '2024-03-15', 'STADIUM NEGARA, KUALA LUMPUR'),
(2, 'PENANG CUP 2024', '2024-07-01', '2024-07-20', 'CITY STADIUM, PENANG'),
(3, 'JOHOR INVITATIONAL 2024', '2024-09-10', '2024-09-25', 'JOHOR BAHRU SPORTS COMPLEX, JOHOR');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_roleID` int(11) NOT NULL DEFAULT '3',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `teamName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Img_User` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_roleID`, `email`, `email_verified_at`, `teamName`, `country`, `Img_User`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'WAN MUHAMAD IZZAT BIN WAN ABU OSMAN', 3, 'test@gmail.com', NULL, 'TEST TEAM', 'Malaysia', '', '$2y$12$sQzGEs7tiBYASWg9XQsFiu2rBB80yLRsrCilVRjtoT0nHrtW1.ts.', NULL, '2024-08-26 23:53:04', '2024-08-26 23:53:04'),
(2, 'king', 3, 'king@gmail.com', NULL, 'king', 'Malaysia', '', '$2y$12$teIfFcUX3fXzutuaRxBsH.vOwYdopCGP1RUqctI1g.uNOweTeBOWK', NULL, '2024-09-09 21:53:00', '2024-09-09 21:53:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `roles_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`article_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `contactemail`
--
ALTER TABLE `contactemail`
  ADD PRIMARY KEY (`email_id`),
  ADD KEY `contact_id` (`contact_id`);

--
-- Indexes for table `contactphone`
--
ALTER TABLE `contactphone`
  ADD PRIMARY KEY (`phone_id`),
  ADD KEY `contact_id` (`contact_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`country_id`),
  ADD UNIQUE KEY `country_code` (`country_code`);

--
-- Indexes for table `country_languages`
--
ALTER TABLE `country_languages`
  ADD PRIMARY KEY (`country_language_id`),
  ADD KEY `country_id` (`country_id`),
  ADD KEY `language_id` (`language_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`GroupID`),
  ADD KEY `TournamentID` (`TournamentID`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `judge`
--
ALTER TABLE `judge`
  ADD PRIMARY KEY (`JudgeID`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`language_id`),
  ADD UNIQUE KEY `language_code` (`language_code`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `match_group`
--
ALTER TABLE `match_group`
  ADD PRIMARY KEY (`Match_groupID`),
  ADD KEY `GroupID` (`GroupID`),
  ADD KEY `TournamentID` (`TournamentID`),
  ADD KEY `TeamAID` (`TeamAID`),
  ADD KEY `TeamBID` (`TeamBID`),
  ADD KEY `fk_scoring_judge` (`ScoringJudgeID`),
  ADD KEY `fk_timing_judge` (`TimingJudgeID`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`PlayerID`),
  ADD KEY `TeamID` (`TeamID`),
  ADD KEY `field_status` (`field_status`);

--
-- Indexes for table `playerstatmatch`
--
ALTER TABLE `playerstatmatch`
  ADD PRIMARY KEY (`PlayerStatMatchID`),
  ADD KEY `PlayerID` (`PlayerID`),
  ADD KEY `Match_groupID` (`Match_groupID`),
  ADD KEY `StatID` (`StatID`);

--
-- Indexes for table `ply_field`
--
ALTER TABLE `ply_field`
  ADD PRIMARY KEY (`ply_fieldID`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `stat`
--
ALTER TABLE `stat`
  ADD PRIMARY KEY (`StatID`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`TeamID`);

--
-- Indexes for table `tournaments`
--
ALTER TABLE `tournaments`
  ADD PRIMARY KEY (`TournamentID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`roles_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `country_languages`
--
ALTER TABLE `country_languages`
  MODIFY `country_language_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `GroupID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `judge`
--
ALTER TABLE `judge`
  MODIFY `JudgeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `language_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `match_group`
--
ALTER TABLE `match_group`
  MODIFY `Match_groupID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `PlayerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `playerstatmatch`
--
ALTER TABLE `playerstatmatch`
  MODIFY `PlayerStatMatchID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ply_field`
--
ALTER TABLE `ply_field`
  MODIFY `ply_fieldID` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stat`
--
ALTER TABLE `stat`
  MODIFY `StatID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `TeamID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tournaments`
--
ALTER TABLE `tournaments`
  MODIFY `TournamentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `roles_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contactemail`
--
ALTER TABLE `contactemail`
  ADD CONSTRAINT `contactemail_ibfk_1` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`contact_id`);

--
-- Constraints for table `contactphone`
--
ALTER TABLE `contactphone`
  ADD CONSTRAINT `contactphone_ibfk_1` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`contact_id`);

--
-- Constraints for table `country_languages`
--
ALTER TABLE `country_languages`
  ADD CONSTRAINT `country_languages_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`country_id`),
  ADD CONSTRAINT `country_languages_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`language_id`);

--
-- Constraints for table `group`
--
ALTER TABLE `group`
  ADD CONSTRAINT `group_ibfk_1` FOREIGN KEY (`TournamentID`) REFERENCES `tournaments` (`TournamentID`);

--
-- Constraints for table `match_group`
--
ALTER TABLE `match_group`
  ADD CONSTRAINT `match_group_ibfk_1` FOREIGN KEY (`GroupID`) REFERENCES `group` (`GroupID`),
  ADD CONSTRAINT `match_group_ibfk_2` FOREIGN KEY (`TeamAID`) REFERENCES `teams` (`TeamID`),
  ADD CONSTRAINT `match_group_ibfk_3` FOREIGN KEY (`TeamBID`) REFERENCES `teams` (`TeamID`),
  ADD CONSTRAINT `match_group_ibfk_4` FOREIGN KEY (`ScoringJudgeID`) REFERENCES `judge` (`JudgeID`),
  ADD CONSTRAINT `match_group_ibfk_5` FOREIGN KEY (`TimingJudgeID`) REFERENCES `judge` (`JudgeID`);

--
-- Constraints for table `players`
--
ALTER TABLE `players`
  ADD CONSTRAINT `players_ibfk_1` FOREIGN KEY (`TeamID`) REFERENCES `teams` (`TeamID`),
  ADD CONSTRAINT `players_ibfk_2` FOREIGN KEY (`field_status`) REFERENCES `ply_field` (`ply_fieldID`);

--
-- Constraints for table `playerstatmatch`
--
ALTER TABLE `playerstatmatch`
  ADD CONSTRAINT `playerstatmatch_ibfk_1` FOREIGN KEY (`StatID`) REFERENCES `stat` (`StatID`),
  ADD CONSTRAINT `playerstatmatch_ibfk_2` FOREIGN KEY (`PlayerID`) REFERENCES `players` (`PlayerID`),
  ADD CONSTRAINT `playerstatmatch_ibfk_3` FOREIGN KEY (`Match_groupID`) REFERENCES `match_group` (`Match_groupID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
