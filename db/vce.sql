-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2023 at 10:47 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vce`
--

-- --------------------------------------------------------

--
-- Table structure for table `achievement_table`
--

CREATE TABLE `achievement_table` (
  `achievement_id` int(11) NOT NULL,
  `achievement_userid` int(11) NOT NULL,
  `achievement_course` varchar(100) NOT NULL,
  `achievement_platform` varchar(100) NOT NULL,
  `achievement_tutor` varchar(100) NOT NULL,
  `achievement_courseduration` varchar(20) NOT NULL,
  `achievement_courselink` varchar(200) NOT NULL,
  `achievement_completedon` varchar(20) NOT NULL,
  `added_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `achievement_table`
--

INSERT INTO `achievement_table` (`achievement_id`, `achievement_userid`, `achievement_course`, `achievement_platform`, `achievement_tutor`, `achievement_courseduration`, `achievement_courselink`, `achievement_completedon`, `added_on`) VALUES
(1, 1, 'MA Economics', 'Punjabi University', 'Multiple', '2 years', '', 'May 2020', '2023-09-19 15:03:33'),
(2, 1, 'HTML Tutorial for Beginners | Complete HTML with Notes & Code', 'Youtube', 'Apna College', '2 hours', 'https://www.youtube.com/watch?v=HcOc7P5BMi4', '2023-09-18', '2023-09-19 15:29:06'),
(3, 5, 'HTML Tutorial for Beginners | Complete HTML with Notes & Code', 'Youtube', 'Apna College', '2 hours', 'https://www.youtube.com/watch?v=HcOc7P5BMi4', '2023-09-07', '2023-09-19 16:41:37');

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `admin_id` int(11) NOT NULL,
  `admin_first_name` varchar(100) NOT NULL,
  `admin_last_name` varchar(100) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`admin_id`, `admin_first_name`, `admin_last_name`, `admin_email`, `admin_password`) VALUES
(1, 'Priya', 'Singla', 'priyasingla@gmail.com', '123456789'),
(2, 'Mukesh', 'Sir', 'mukeshsir@gmail.com', '123456789');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `chat_id` int(11) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  `dt` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`chat_id`, `uname`, `msg`, `dt`) VALUES
(1, 'Priya', 'Hii			', '23-09-16 10:40pm'),
(2, 'Chatu', '		Hello	', '23-09-16 10:41pm'),
(3, 'Lavish', '		Hii	', '23-09-16 10:41pm'),
(4, 'Himanshi', 'aala re aala ghajini aalaa		', '23-09-16 10:42pm');

-- --------------------------------------------------------

--
-- Table structure for table `course_domain`
--

CREATE TABLE `course_domain` (
  `domain_id` int(11) NOT NULL,
  `domain_field` varchar(100) NOT NULL,
  `domain_name` varchar(100) NOT NULL,
  `added_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_domain`
--

INSERT INTO `course_domain` (`domain_id`, `domain_field`, `domain_name`, `added_on`) VALUES
(1, 'IT', 'Cyber Security', '2023-09-18 09:55:02'),
(2, 'IT', 'Web Designing', '2023-09-18 09:55:23'),
(3, 'Accountancy', 'Cost Accounting', '2023-09-18 09:55:43'),
(4, 'Business', 'Business Management', '2023-09-18 09:56:06');

-- --------------------------------------------------------

--
-- Table structure for table `course_field`
--

CREATE TABLE `course_field` (
  `field_id` int(11) NOT NULL,
  `field_name` varchar(100) NOT NULL,
  `added_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_field`
--

INSERT INTO `course_field` (`field_id`, `field_name`, `added_on`) VALUES
(1, 'IT', '2023-09-18 09:39:25'),
(2, 'Accountancy', '2023-09-18 09:39:38'),
(3, 'Business', '2023-09-18 09:39:47');

-- --------------------------------------------------------

--
-- Table structure for table `course_table`
--

CREATE TABLE `course_table` (
  `course_id` int(11) NOT NULL,
  `course_field` varchar(100) NOT NULL,
  `course_domain` varchar(100) NOT NULL,
  `course_name` varchar(200) NOT NULL,
  `platform_name` varchar(100) NOT NULL,
  `tutor_name` varchar(100) NOT NULL,
  `course_level` varchar(20) NOT NULL,
  `course_link` varchar(200) NOT NULL,
  `course_duration` varchar(20) NOT NULL,
  `added_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_table`
--

INSERT INTO `course_table` (`course_id`, `course_field`, `course_domain`, `course_name`, `platform_name`, `tutor_name`, `course_level`, `course_link`, `course_duration`, `added_on`) VALUES
(1, 'IT', 'Web Designing', 'The Complete 2023 Web Development Bootcamp', 'Udemy', 'Dr. Angela Yu', 'Beginner', 'https://www.udemy.com/course/the-complete-web-development-bootcamp/', '62.5 hours', '2023-09-18 10:37:04'),
(2, 'IT', 'Cyber Security', 'The Complete Cyber Security Course : Hackers Exposed!', 'Udemy', 'Nathan House', 'Intemediate', 'https://www.udemy.com/course/the-complete-internet-security-privacy-course-volume-1/', '12 hours', '2023-09-19 10:43:29');

-- --------------------------------------------------------

--
-- Table structure for table `individual_chat`
--

CREATE TABLE `individual_chat` (
  `chat_id` int(11) NOT NULL,
  `message_from` int(11) NOT NULL,
  `message_to` int(11) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `message_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `individual_chat`
--

INSERT INTO `individual_chat` (`chat_id`, `message_from`, `message_to`, `message`, `message_time`) VALUES
(1, 1, 5, 'Hey Lavish', '2023-09-20 13:40:35'),
(2, 1, 5, 'How are you..?', '2023-09-20 13:41:06'),
(3, 5, 1, 'Hi Priya, M good... U tell..?', '2023-09-20 14:01:43'),
(4, 1, 5, 'm good too... I have seen your interests and we share same interests... If you don\'t mind can we discuss about the same over here..?', '2023-09-20 14:04:39'),
(5, 1, 2, 'Hello Sir', '2023-09-20 14:07:33'),
(6, 5, 1, 'Sure priya we can discuss over the things here... no problem at all', '2023-09-20 14:11:54'),
(7, 1, 5, 'Thanks lavish', '2023-09-20 14:16:13');

-- --------------------------------------------------------

--
-- Table structure for table `user_interest`
--

CREATE TABLE `user_interest` (
  `interest_id` int(11) NOT NULL,
  `user_id` varchar(11) NOT NULL,
  `field_name` varchar(100) NOT NULL,
  `domain_name` varchar(100) NOT NULL,
  `added_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_interest`
--

INSERT INTO `user_interest` (`interest_id`, `user_id`, `field_name`, `domain_name`, `added_on`) VALUES
(1, '1', 'IT', 'Web Designing', '2023-09-18 12:19:05'),
(2, '1', 'IT', 'Cyber Security', '2023-09-18 12:19:29'),
(3, '2', 'IT', 'Web Designing', '2023-09-19 16:39:04'),
(4, '5', 'IT', 'Cyber Security', '2023-09-19 16:40:58'),
(5, '5', 'IT', 'Web Designing', '2023-09-19 17:32:33');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(11) NOT NULL,
  `user_firstname` varchar(100) NOT NULL,
  `user_lastname` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_phone` varchar(10) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_createdon` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `user_firstname`, `user_lastname`, `user_type`, `user_email`, `user_phone`, `user_password`, `user_createdon`) VALUES
(1, 'Priya', 'Singla', 'Student', 'priya@gmail.com', '9877298497', '123', '2023-09-08 18:55:39'),
(2, 'Mukesh', 'Sir', 'Student', 'mukeshSirG@gmail.com', '9501100000', '123', '2023-09-13 13:34:13'),
(3, 'Priya', 'Singla', 'Student', 'abc@bfgi.com', '7778889990', '123', '2023-09-13 13:40:19'),
(4, 'Lavish', 'Singla', 'Industrialist', 'lavish@gmail.com', '9090909090', '123', '2023-09-17 21:26:39'),
(5, 'Lavish', 'Bhai', 'Student', 'lavidon@gmail.com', '7777788888', '123', '2023-09-19 16:40:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achievement_table`
--
ALTER TABLE `achievement_table`
  ADD PRIMARY KEY (`achievement_id`);

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `course_domain`
--
ALTER TABLE `course_domain`
  ADD PRIMARY KEY (`domain_id`);

--
-- Indexes for table `course_field`
--
ALTER TABLE `course_field`
  ADD PRIMARY KEY (`field_id`);

--
-- Indexes for table `course_table`
--
ALTER TABLE `course_table`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `individual_chat`
--
ALTER TABLE `individual_chat`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `user_interest`
--
ALTER TABLE `user_interest`
  ADD PRIMARY KEY (`interest_id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achievement_table`
--
ALTER TABLE `achievement_table`
  MODIFY `achievement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `course_domain`
--
ALTER TABLE `course_domain`
  MODIFY `domain_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `course_field`
--
ALTER TABLE `course_field`
  MODIFY `field_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `course_table`
--
ALTER TABLE `course_table`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `individual_chat`
--
ALTER TABLE `individual_chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_interest`
--
ALTER TABLE `user_interest`
  MODIFY `interest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
