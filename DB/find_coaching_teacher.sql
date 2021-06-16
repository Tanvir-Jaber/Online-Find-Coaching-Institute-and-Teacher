-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Jun 16, 2021 at 07:01 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `find_coaching_teacher`
--
CREATE DATABASE IF NOT EXISTS `find_coaching_teacher` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `find_coaching_teacher`;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `message_no` int(11) NOT NULL,
  `teachers_id` int(11) DEFAULT NULL,
  `students_id` int(11) DEFAULT NULL,
  `teachers_name` text DEFAULT NULL,
  `students_name` text DEFAULT NULL,
  `message_from` text DEFAULT NULL,
  `message_to` text DEFAULT NULL,
  `messageRead` varchar(7) DEFAULT 'unseen',
  `message` varchar(7) DEFAULT 'unseen',
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`message_no`, `teachers_id`, `students_id`, `teachers_name`, `students_name`, `message_from`, `message_to`, `messageRead`, `message`, `date`, `time`) VALUES
(12, 21, 19, 'Jubair Ahmed', 'Salek Uddin', 'hi 2', NULL, 'seen', 'unseen', '2021-06-16', '20:29:47'),
(13, 21, 19, 'Jubair Ahmed', 'Salek Uddin', 'what?', NULL, 'seen', 'unseen', '2021-06-16', '20:30:10');

-- --------------------------------------------------------

--
-- Table structure for table `institute_offer`
--

CREATE TABLE `institute_offer` (
  `institute_offer_no` int(11) NOT NULL,
  `Title` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `offer_details` text DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_no` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `post` text DEFAULT NULL,
  `commentNo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_no`, `user_id`, `name`, `date`, `time`, `post`, `commentNo`) VALUES
(18, 60, 'dipu', '2021-06-01', '16:17:19', ' In a free hour, when our power of choice is untrammelled and when nothing prevents our being able', NULL),
(20, 27, 'arman ', '2021-06-03', '18:12:50', ' the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example,', NULL),
(21, 27, 'arman ', '2021-06-03', '18:16:23', 'In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated ', NULL),
(22, 41, 'Jesin', '2021-06-03', '18:38:19', 'নতুন ফ্লাট বাসা ভাড়া হবে\r\n\r\n**(৪ বেড রুম,২ বাথরুম, বড় ডাইনিং ও ড্রয়িং, ৪ বারান্দা, ১ রান্নাঘর, ১ স্টোর রুম)\r\n\r\nহাতির ঝিল এর পাশে মধুবাগ নতুন রাস্তা\r\n\r\n(মেইন রোড থেকে ২/৩ মিনিটে লাগে)\r\n\r\n২য় তলায়। ।\r\n\r\n#ঠিকানাঃ\r\n\r\n357/12/A/C\r\n\r\nModhubag 3 no goli\r\n\r\n2nd floor দক্ষিণ পাশ\r\n\r\nযোগাযোগ:০১৭৫২৪৮০৮৮২\r\n\r\nগ্যাস সংযোগ নেই, সিলেন্ডার ব্যাবহার করতে হবে।\r\n\r\n#ভাড়াঃ ২৭০০০ টাকা ( পানি, কারেন্ট বাদে)\r\n', NULL),
(23, 21, 'Jubair Ahmed', '2021-06-15', '20:15:02', 'নতুন ফ্লাট বাসা ভাড়া হবে \r\n\r\n**(৪ বেড রুম,২ বাথরুম, বড় ডাইনিং ও ড্রয়িং, ৪ বারান্দা, ১ রান্নাঘর, ১ স্টোর রুম) হাতির ঝিল এর পাশে', NULL),
(24, 21, 'Jubair Ahmed', '2021-06-15', '20:15:16', 'ggg', 23),
(25, 21, 'Jubair Ahmed', '2021-06-15', '20:17:26', 'h', 20);

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `payment_no` int(11) NOT NULL,
  `payment_token` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `amount` text DEFAULT NULL,
  `subscription` text DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `no` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `gender` text DEFAULT NULL,
  `study` text DEFAULT NULL,
  `medium` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `address2` text DEFAULT NULL,
  `ssc_institute` text DEFAULT NULL,
  `ssc_yearpassing` text DEFAULT NULL,
  `ssc_group` text DEFAULT NULL,
  `ssc_gpa` text DEFAULT NULL,
  `hsc_institute` text DEFAULT NULL,
  `hsc_yearpassing` text DEFAULT NULL,
  `hsc_group` text DEFAULT NULL,
  `hsc_gpa` text DEFAULT NULL,
  `honours_institute` text DEFAULT NULL,
  `honours_yearadmission` text DEFAULT NULL,
  `dept` text DEFAULT NULL,
  `honours_cgpa` text DEFAULT NULL,
  `tuition_area` text DEFAULT NULL,
  `tuition_medium` text DEFAULT NULL,
  `tuition_subject` text DEFAULT NULL,
  `tuition_class` text DEFAULT NULL,
  `tuition_week` text DEFAULT NULL,
  `tuition_shift` text DEFAULT NULL,
  `tuition_salary` text DEFAULT NULL,
  `tuition_style` text DEFAULT NULL,
  `nid` text DEFAULT NULL,
  `std_card` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`no`, `name`, `email`, `gender`, `study`, `medium`, `address`, `address2`, `ssc_institute`, `ssc_yearpassing`, `ssc_group`, `ssc_gpa`, `hsc_institute`, `hsc_yearpassing`, `hsc_group`, `hsc_gpa`, `honours_institute`, `honours_yearadmission`, `dept`, `honours_cgpa`, `tuition_area`, `tuition_medium`, `tuition_subject`, `tuition_class`, `tuition_week`, `tuition_shift`, `tuition_salary`, `tuition_style`, `nid`, `std_card`) VALUES
(7, 'Jubair Ahmed', 'j@mail.com', 'Male', 'BSC in CSE', 'English', 'GEC Cirlce,CTG', 'Patiya,CTG', ' Muslim Hight School', ' 2011', ' Science', ' 5.00', ' Chittagong College', ' 2013', '  Science', ' 5.00', ' Port City International University', ' 2014', ' CSE', ' 4.00', 'Chawbazar, Bahadderhat,Lalkhan Bazar', 'English,Bangla', 'Science', 'Class-8,7,6', '3/4/5', 'Morning', '5000', 'Private', '../../assets/upload/1219light_after_rain_by_bisbiswas_degme19.jpg', '../../assets/upload/8692a_summer_evening_by_bisbiswas_deffa9l.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `no` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `pnumber` text DEFAULT NULL,
  `nid` text DEFAULT NULL,
  `position` text DEFAULT NULL,
  `cname` text DEFAULT NULL,
  `pass` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `emailtoken` varchar(6) NOT NULL DEFAULT 'no',
  `recover` text DEFAULT NULL,
  `checkActive` varchar(3) NOT NULL DEFAULT 'no',
  `status` text NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`no`, `name`, `email`, `pnumber`, `nid`, `position`, `cname`, `pass`, `address`, `emailtoken`, `recover`, `checkActive`, `status`) VALUES
(12, 'Tanvir Jaber', 'rotane9158@xhypm.com', '01850751714', NULL, 'Admin', 'Bangladesh E-commerce Industry', '123456', 'Bahadderhat,Chittagong', 'yes', NULL, 'yes', '0'),
(19, 'Salek Uddin', 'salek@mail.com', '01850751714', NULL, 'Guardian', NULL, '123456', 'Muradpur,CTG', 'yes', NULL, 'yes', '0'),
(20, 'Hasan Mahmud', 'h@mail.com', '01850751714', NULL, 'InstructingInstitute', 'SVM Institute', '123456', 'Chawkbazar,CTG', 'yes', NULL, 'no', '0'),
(21, 'Jubair Ahmed', 'j@mail.com', '01850751714', '../../assets/upload/3520Screenshot (117).png', 'Teacher', NULL, '123456', 'GEC Cirlce,CTG', 'yes', NULL, 'yes', '0'),
(22, 'Imteaz Uddin', 'im@mail.com', '01850751714', NULL, 'Admin', NULL, '123456', 'GEC Circle,CTG', 'yes', NULL, 'no', '0'),
(23, 'Imteaz Ahmed', 'Imteaz@mail.com', '01850751714', NULL, 'Admin', NULL, '123456', 'GEC Circle,CTG', 'yes', NULL, 'no', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`message_no`);

--
-- Indexes for table `institute_offer`
--
ALTER TABLE `institute_offer`
  ADD PRIMARY KEY (`institute_offer_no`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_no`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`payment_no`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `message_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `institute_offer`
--
ALTER TABLE `institute_offer`
  MODIFY `institute_offer_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `payment_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
