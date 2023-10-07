-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2023 at 08:04 PM
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
(4, 1, 'The Complete 2023 Web Development Bootcamp', 'Udemy', 'Dr. Angela Yu', '62.5 hours', 'https://www.udemy.com/course/the-complete-web-development-bootcamp/', '2023-10-04', '2023-10-03 23:55:15'),
(6, 5, 'The Complete 2023 Web Development Bootcamp', 'Udemy', 'Dr. Angela Yu', '62.5 hours', 'https://www.udemy.com/course/the-complete-web-development-bootcamp/', '2023-10-04', '2023-10-04 00:17:22');

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
(1, 'Priya', 'Singla', 'priyasingla@gmail.com', '123'),
(2, 'Mukesh', 'Sir', 'mukeshsir@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `availability_table`
--

CREATE TABLE `availability_table` (
  `availability_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `campus_name` varchar(100) NOT NULL,
  `availability_date` varchar(50) NOT NULL,
  `availability` varchar(50) NOT NULL,
  `time_from` varchar(50) NOT NULL,
  `time_to` varchar(50) NOT NULL,
  `added_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `availability_table`
--

INSERT INTO `availability_table` (`availability_id`, `user_id`, `campus_name`, `availability_date`, `availability`, `time_from`, `time_to`, `added_on`) VALUES
(3, 1, 'Uncram CA Classes', '2023-10-11', 'Available', '09:00', '21:00', '2023-10-05 12:36:46'),
(5, 5, 'Baba Farid College', '2023-10-12', 'Not Available', '', '', '2023-10-05 13:51:46');

-- --------------------------------------------------------

--
-- Table structure for table `campus_table`
--

CREATE TABLE `campus_table` (
  `campus_id` int(11) NOT NULL,
  `campus_name` varchar(100) NOT NULL,
  `added_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `campus_table`
--

INSERT INTO `campus_table` (`campus_id`, `campus_name`, `added_on`) VALUES
(1, 'Baba Farid College', '2023-10-05 10:32:10'),
(2, 'Uncram CA Classes', '2023-10-05 10:32:19'),
(3, 'Baba Farid Group of Institutions', '2023-10-05 10:32:40');

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
(7, 'IT', 'Web Designing', '2023-10-03 22:09:33'),
(8, 'IT', 'Cyber Security', '2023-10-03 22:09:39'),
(9, 'Business', 'Accounting', '2023-10-07 23:27:46');

-- --------------------------------------------------------

--
-- Table structure for table `course_enrolled`
--

CREATE TABLE `course_enrolled` (
  `enroll_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `enrolled_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_enrolled`
--

INSERT INTO `course_enrolled` (`enroll_id`, `user_id`, `course_id`, `enrolled_on`) VALUES
(1, 1, 3, '2023-10-03 23:17:32'),
(2, 5, 3, '2023-10-04 00:11:28'),
(3, 2, 4, '2023-10-04 00:12:03'),
(4, 5, 4, '2023-10-04 00:15:18');

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
(4, 'IT', '2023-10-03 22:09:10'),
(5, 'Business', '2023-10-03 22:09:16');

-- --------------------------------------------------------

--
-- Table structure for table `course_finished`
--

CREATE TABLE `course_finished` (
  `finished_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `finished_on` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_finished`
--

INSERT INTO `course_finished` (`finished_id`, `user_id`, `course_id`, `finished_on`) VALUES
(1, 1, 3, '2023-10-03 23:55:15'),
(2, 5, 3, '2023-10-04 00:11:14');

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
(3, 'IT', 'Web Designing', 'The Complete 2023 Web Development Bootcamp', 'Udemy', 'Dr. Angela Yu', 'Beginner', 'https://www.udemy.com/course/the-complete-web-development-bootcamp/', '62.5 hours', '2023-10-03 22:10:22'),
(4, 'IT', 'Cyber Security', 'The Complete Cyber Security Course : Hackers Exposed!', 'Udemy', 'Nathan House', 'Beginner', 'https://www.udemy.com/course/the-complete-internet-security-privacy-course-volume-1/', '12 hours', '2023-10-03 22:13:06'),
(5, 'Business', 'Accounting', 'Accounting: From Beginner to Advanced!', 'Udemy', 'Stefan Ignatovski', 'Beginner', 'https://www.udemy.com/course/accounting101/', '10 hours', '2023-10-07 23:29:35');

-- --------------------------------------------------------

--
-- Table structure for table `discussion_groups`
--

CREATE TABLE `discussion_groups` (
  `group_id` int(11) NOT NULL,
  `group_field` varchar(100) NOT NULL,
  `group_domain` varchar(100) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discussion_groups`
--

INSERT INTO `discussion_groups` (`group_id`, `group_field`, `group_domain`, `created_on`) VALUES
(7, 'IT', 'Cyber Security', '2023-10-04 11:49:25');

-- --------------------------------------------------------

--
-- Table structure for table `group_chat`
--

CREATE TABLE `group_chat` (
  `chat_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `message_from` int(11) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `message_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `group_chat`
--

INSERT INTO `group_chat` (`chat_id`, `group_id`, `message_from`, `message`, `message_on`) VALUES
(1, 7, 1, 'Hello', '2023-10-04 15:45:21'),
(2, 7, 5, 'Hii', '2023-10-04 15:45:44'),
(3, 7, 2, 'Hii How are you all..?', '2023-10-04 15:46:26'),
(4, 7, 1, 'I am good... What abt you all..? Welcome to the Cyber Security group discussion...', '2023-10-04 15:58:53');

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
(7, '1', 'IT', 'Web Designing', '2023-10-03 22:13:17'),
(8, '1', 'IT', 'Cyber Security', '2023-10-03 22:13:22'),
(9, '5', 'IT', 'Web Designing', '2023-10-04 00:10:55'),
(10, '2', 'IT', 'Cyber Security', '2023-10-04 00:11:59'),
(11, '5', 'IT', 'Cyber Security', '2023-10-04 00:15:10');

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
-- Indexes for table `availability_table`
--
ALTER TABLE `availability_table`
  ADD PRIMARY KEY (`availability_id`);

--
-- Indexes for table `campus_table`
--
ALTER TABLE `campus_table`
  ADD PRIMARY KEY (`campus_id`);

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
-- Indexes for table `course_enrolled`
--
ALTER TABLE `course_enrolled`
  ADD PRIMARY KEY (`enroll_id`);

--
-- Indexes for table `course_field`
--
ALTER TABLE `course_field`
  ADD PRIMARY KEY (`field_id`);

--
-- Indexes for table `course_finished`
--
ALTER TABLE `course_finished`
  ADD PRIMARY KEY (`finished_id`);

--
-- Indexes for table `course_table`
--
ALTER TABLE `course_table`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `discussion_groups`
--
ALTER TABLE `discussion_groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `group_chat`
--
ALTER TABLE `group_chat`
  ADD PRIMARY KEY (`chat_id`);

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
  MODIFY `achievement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `availability_table`
--
ALTER TABLE `availability_table`
  MODIFY `availability_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `campus_table`
--
ALTER TABLE `campus_table`
  MODIFY `campus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `course_domain`
--
ALTER TABLE `course_domain`
  MODIFY `domain_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `course_enrolled`
--
ALTER TABLE `course_enrolled`
  MODIFY `enroll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `course_field`
--
ALTER TABLE `course_field`
  MODIFY `field_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `course_finished`
--
ALTER TABLE `course_finished`
  MODIFY `finished_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course_table`
--
ALTER TABLE `course_table`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `discussion_groups`
--
ALTER TABLE `discussion_groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `group_chat`
--
ALTER TABLE `group_chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `individual_chat`
--
ALTER TABLE `individual_chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_interest`
--
ALTER TABLE `user_interest`
  MODIFY `interest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
