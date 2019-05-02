-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2019 at 12:08 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0


-- LOGIN
-- ADMIN = admin
-- ADMIN PASSWORD = password
-- USER = user
-- USER PASSWORD = password


SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yourprogressvsmine`
--
CREATE DATABASE IF NOT EXISTS `yourprogressvsmine` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `yourprogressvsmine`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `ad_url` text NOT NULL,
  PRIMARY KEY (`admin_id`),
  KEY `admin_fk_users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `user_id`, `ad_url`) VALUES
(1, 2, 'http://www.bodybuilding.com'),
(2, 3, 'http://www.vitalstrength.com');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
  `chat_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `chat_message` text NOT NULL,
  `chat_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`chat_id`),
  KEY `chat_fk_users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chat_id`, `user_id`, `chat_message`, `chat_timestamp`) VALUES
(1, 1, 'Hello?', '2019-04-26 16:09:25'),
(2, 2, 'Hey, what\'s up.', '2019-04-26 16:10:50'),
(3, 1, 'Nice app!', '2019-04-26 16:11:20'),
(4, 2, 'Thanks!', '2019-04-26 16:12:58'),
(5, 3, 'Hey everyone!', '2019-04-27 18:02:44');

-- --------------------------------------------------------

--
-- Table structure for table `exe_details`
--

DROP TABLE IF EXISTS `exe_details`;
CREATE TABLE IF NOT EXISTS `exe_details` (
  `exe_id` int(11) NOT NULL AUTO_INCREMENT,
  `wrk_id` int(11) NOT NULL,
  `exe_name` tinytext NOT NULL,
  `exe_equip` tinytext NOT NULL,
  `exe_sets` int(11) DEFAULT NULL,
  `exe_reps` int(11) DEFAULT NULL,
  `exe_time` time DEFAULT NULL,
  PRIMARY KEY (`exe_id`),
  KEY `exe_details_fk_workout_desc` (`wrk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exe_details`
--

INSERT INTO `exe_details` (`exe_id`, `wrk_id`, `exe_name`, `exe_equip`, `exe_sets`, `exe_reps`, `exe_time`) VALUES
(1, 3, 'Split Snatch', 'Dumbbells', 0, 3, '00:00:00'),
(2, 3, 'Push Press', 'Dumbbells', 0, 3, '00:00:00'),
(3, 3, 'One Arm Bench Press', 'Dumbbell', 0, 5, '00:00:00'),
(4, 3, 'Push ups ', '', 0, 8, '00:00:00'),
(5, 3, 'Wall Squats', '', 0, 0, '00:01:00'),
(6, 3, 'Squat jumps', '', 0, 10, '00:00:00'),
(7, 3, 'Rest', '', 0, 0, '00:01:00'),
(8, 4, 'Burpees', '', 0, 0, '00:00:30'),
(9, 4, 'Jumping jacks', '', 0, 0, '00:00:30'),
(10, 4, 'High knee dumbbells ', 'Dumbbells', 0, 0, '00:00:30'),
(11, 4, 'Shadow box', '', 0, 0, '00:00:30'),
(12, 5, 'Snatches', 'Dumbbells', 0, 5, '00:00:00'),
(13, 5, 'Swings', 'Dumbbells', 0, 5, '00:00:00'),
(14, 5, 'Burpees ', '', 0, 10, '00:00:00'),
(15, 5, 'Rest', '', 0, 0, '00:01:00'),
(16, 6, 'Sprint', '', 0, 0, '00:00:20'),
(17, 6, 'Rest', '', 0, 0, '00:00:10'),
(18, 7, 'Clean and Press', 'Dumbbell', 0, 3, '00:00:00'),
(19, 7, 'Snatch', 'Dumbbell', 0, 4, '00:00:00'),
(20, 7, 'Rest', '', 0, 0, '00:01:00'),
(21, 7, 'One legg squats ', '', 0, 5, '00:00:00'),
(22, 7, 'Glute ham raise', '', 0, 5, '00:00:00'),
(23, 7, 'Rest', '', 0, 0, '00:01:00'),
(24, 7, 'Pull ups', '', 0, 5, '00:00:00'),
(25, 7, 'Push ups', '', 0, 15, '00:00:00'),
(26, 7, 'Rest', '', 0, 0, '00:01:00'),
(27, 9, 'Bicep Curls', 'Barbell', 3, 12, '00:00:00'),
(28, 9, 'Tricep Extensions ', 'Dumbbells', 3, 12, '00:00:00'),
(29, 9, 'Rest', '', 0, 0, '00:01:30');

-- --------------------------------------------------------

--
-- Table structure for table `goal`
--

DROP TABLE IF EXISTS `goal`;
CREATE TABLE IF NOT EXISTS `goal` (
  `goal_id` int(11) NOT NULL AUTO_INCREMENT,
  `goal_name` tinytext NOT NULL,
  PRIMARY KEY (`goal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `goal`
--

INSERT INTO `goal` (`goal_id`, `goal_name`) VALUES
(1, 'Build Muscle'),
(2, 'Lose Fat'),
(3, 'Transform'),
(4, 'Improve'),
(5, 'Endurance'),
(6, 'Flexibility'),
(7, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `pwd_reset`
--

DROP TABLE IF EXISTS `pwd_reset`;
CREATE TABLE IF NOT EXISTS `pwd_reset` (
  `reset_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `reset_selector` text NOT NULL,
  `reset_token` longtext NOT NULL,
  `reset_expires` datetime NOT NULL,
  PRIMARY KEY (`reset_id`),
  KEY `pwd_reset_fk_users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` tinytext NOT NULL,
  `user_email` tinytext NOT NULL,
  `user_date` date NOT NULL,
  `goal_id` int(11) NOT NULL,
  `user_pwd` longtext NOT NULL,
  `user_login` datetime NOT NULL,
  `user_level` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  KEY `users_fk_user_goal` (`goal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_date`, `goal_id`, `user_pwd`, `user_login`, `user_level`) VALUES
(1, 'user', 'user@email.com', '2019-04-26', 1, '$2y$10$WzWQrdBKBSMPZbBL0ijjX.8zCBLHRHeSLhWUa3EzXBylGI/w/Qlvm', '0000-00-00 00:00:00', 0),
(2, 'admin', 'admin@email.com', '2019-04-26', 3, '$2y$10$AJ18QgAdnVRsE9K2YbIj7ewYdJAcFcePUMFKhQICWNW20jbWPWcBC', '0000-00-00 00:00:00', 1),
(3, 'admin2', 'admin2@email.com', '2019-04-27', 4, '$2y$10$wzL8cgZGSjH3VnRDFO9p2eeR2aCUyUCJbRIj3uTSu25yDQ1TxvUPO', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `workout_desc`
--

DROP TABLE IF EXISTS `workout_desc`;
CREATE TABLE IF NOT EXISTS `workout_desc` (
  `wrk_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `wrk_name` tinytext NOT NULL,
  `type_id` int(11) NOT NULL,
  `wrk_sets` int(11) NOT NULL,
  `wrk_desc` text NOT NULL,
  `day` int(1) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`wrk_id`),
  KEY `workout_desc_fk_users` (`user_id`),
  KEY `workout_desc_fk_workout_type` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workout_desc`
--

INSERT INTO `workout_desc` (`wrk_id`, `user_id`, `wrk_name`, `type_id`, `wrk_sets`, `wrk_desc`, `day`, `active`) VALUES
(1, 2, 'Rest', 6, 0, '', 1, 0),
(2, 2, 'Rest', 6, 0, '', 7, 0),
(3, 2, 'Speed / Strength ', 4, 4, 'Good workout doesn\\\'t take long.', 2, 0),
(4, 2, 'Gpp 1', 2, 5, 'High intensity workout with no break!', 3, 0),
(5, 2, 'Magic 50', 5, 5, 'This day is a warrior challenge. Give it your all!', 4, 0),
(6, 2, 'Tabata ', 2, 8, 'Tabata workouts are hard, but also short and sweet!', 5, 0),
(7, 2, 'Max Strength', 1, 4, 'Make sure you are lifting heavy today. Less reps but max load.', 6, 1),
(8, 3, 'Rest', 6, 0, '', 1, 0),
(9, 3, 'My First Workout', 1, 3, 'My first workout. Hope everyone likes it!', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `workout_type`
--

DROP TABLE IF EXISTS `workout_type`;
CREATE TABLE IF NOT EXISTS `workout_type` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` tinytext NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workout_type`
--

INSERT INTO `workout_type` (`type_id`, `type_name`) VALUES
(1, 'Strength'),
(2, 'Cardio'),
(3, 'Stretching'),
(4, 'Plyometrics'),
(5, 'Other'),
(6, 'Rest');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_fk_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_fk_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `exe_details`
--
ALTER TABLE `exe_details`
  ADD CONSTRAINT `exe_details_fk_workout_desc` FOREIGN KEY (`wrk_id`) REFERENCES `workout_desc` (`wrk_id`);

--
-- Constraints for table `pwd_reset`
--
ALTER TABLE `pwd_reset`
  ADD CONSTRAINT `pwd_reset_fk_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_fk_user_goal` FOREIGN KEY (`goal_id`) REFERENCES `goal` (`goal_id`);

--
-- Constraints for table `workout_desc`
--
ALTER TABLE `workout_desc`
  ADD CONSTRAINT `workout_desc_fk_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `workout_desc_fk_workout_type` FOREIGN KEY (`type_id`) REFERENCES `workout_type` (`type_id`);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
