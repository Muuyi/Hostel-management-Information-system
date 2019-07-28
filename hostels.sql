-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 27, 2018 at 04:02 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hostels`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `acc_id` int(11) NOT NULL,
  `acc_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`acc_id`, `acc_name`) VALUES
(1, 'Assets'),
(2, 'Revenue/Income'),
(3, 'Expenses');

-- --------------------------------------------------------

--
-- Table structure for table `account_name`
--

CREATE TABLE `account_name` (
  `acn_id` int(11) NOT NULL,
  `acc_id` varchar(255) NOT NULL,
  `acn_name` varchar(255) NOT NULL,
  `host_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_name`
--

INSERT INTO `account_name` (`acn_id`, `acc_id`, `acn_name`, `host_id`) VALUES
(15, '3', 'Food', '20'),
(16, '3', 'Transport', '20'),
(17, '2', 'Rentals', '20'),
(18, '1', 'Buildings', '20'),
(20, '1', 'Land', '20'),
(21, '1', 'Cash', '20');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin_user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin_pass` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_user`, `admin_pass`, `admin_image`) VALUES
(1, 'Muabatech Technologies', 'Muabatech', 'MuaBaTech2017', ''),
(5, 'Muuyi Andrew', 'muuyi', 'muuyi', ''),
(7, 'Muuyi Andrew', 'barasa', '533d9b32ce3aaa5b78efcb8fa66e6bc0', 'IMG_20161102_184320.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `admins_messages`
--

CREATE TABLE `admins_messages` (
  `mes_id` int(11) NOT NULL,
  `mes_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins_messages`
--

INSERT INTO `admins_messages` (`mes_id`, `mes_name`, `phone`, `subject`, `message`, `post_date`) VALUES
(3, 'Muuyi Andrew', '724754808', 'Learning Programming', '<p>Programming is so wonderful</p>\n', '2018-08-18 10:18:25'),
(5, 'Muuyi Andrew', '724754808', 'Learning Programming', '<p>We need to post this data</p>\n', '2018-08-18 10:21:32'),
(6, 'Muuyi Andrew', '724754808', 'Learning Programming', '<p>We are very good in programming</p>\n', '2018-08-18 10:22:57'),
(7, 'Muuyi Andrew', '724657809', 'Hacking', '<p>Hacking is so tactical. YOu can hack anyone</p>\n', '2018-08-18 12:09:31'),
(8, 'Muuyi Andrew', '724657809', 'hjhkjhjjh', '<p>hjkjjkhkhjkhkj</p>\n', '2018-08-18 12:11:39'),
(9, 'Michael Jordan', '+25478967654', 'Assists', '<p>hjkjjkhkhjkhkj</p>\n', '2018-08-18 12:18:54'),
(10, 'Muuyi Andrew', '+2547898877', 'PROGRAMMING', '<p>WE NEED A GOOD PROGRAMMER</p>\n', '2018-08-19 08:37:30'),
(11, 'Muuyi Andrew', '333333', 'Food', '', '2018-08-19 08:44:37'),
(12, 'Mike TYson', '+44333333', 'Cooking', '<p>We nees some serious cookers</p>\n', '2018-08-19 08:46:20'),
(13, 'Bill Gates', '333333', 'Creating Microsoft', '<p>Warren Buffet</p>\n', '2018-08-19 08:48:06');

-- --------------------------------------------------------

--
-- Table structure for table `balances`
--

CREATE TABLE `balances` (
  `bal_id` int(11) NOT NULL,
  `yr` varchar(255) NOT NULL,
  `month` varchar(255) NOT NULL,
  `id_no` int(10) NOT NULL,
  `balance` int(10) NOT NULL,
  `host_id` varchar(255) NOT NULL,
  `bal_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `balances`
--

INSERT INTO `balances` (`bal_id`, `yr`, `month`, `id_no`, `balance`, `host_id`, `bal_date`) VALUES
(5, '2018', 'May', 11111111, 1000, '20', '2018-05-27 06:38:05'),
(6, '2018', 'May', 22222222, 4500, '20', '2018-05-27 06:40:29');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `b_id` int(11) NOT NULL,
  `b_title` varchar(255) NOT NULL,
  `b_image` varchar(255) NOT NULL,
  `b_message` varchar(1000) NOT NULL,
  `host_id` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`b_id`, `b_title`, `b_image`, `b_message`, `host_id`, `date`) VALUES
(5, 'OUR FACILITIES', 'State_Bentley_Long_Walk_Crop_1.JPG', 'Foundations:\r\nRole of Information Systems,\r\nInformation Technology, \r\nElectronic business, \r\nEnterprise and global systems.\r\nIS support Technologies:\r\nHardware, \r\nSoftware,\r\nTelecommunications and networks.\r\n Competing with IT: \r\nOpportunities of IS,\r\nCompetitive advantage,\r\nRe-engineering, \r\nTQM. \r\nElectronic Business Systems:\r\nConcepts and Terminology \r\nBusiness models,\r\nSupply chain management,\r\nERP, \r\nInteractive marketing, \r\nPayment Systems, \r\nconsumer protection, \r\nIntegration with legacy systems, \r\nDemonstrations and Case Studies. \r\nDecision support:\r\nDecision structure,\r\nLevels of management decision making, \r\ndecision support systems, \r\nData mining, \r\nOnline analytical processing, \r\nArtificial intelligence techniques. \r\nOffice Information Systems: \r\nDocument Management, \r\nMessage Handling Systems, \r\nconferencing, \r\nKnowledge Management,\r\nOrganizational Learning,\r\nWorkgroup support. Computer Supported Cooperative Work. ', '20', '2018-07-09 06:32:10'),
(6, 'Services', 'lh-challenger605.jpg', '<p style=\"font-size: 20px; font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\" align=\"justify\">orem ipsum dolor sit amet, libero ultricies, leo mollis erat at adipiscing diam. Ut lacinia augue vehicula lectus vehicula cursus. Vel ut neque lacus rutrum maecenas, lacus pede ac vel in lorem. Sem dolor faucibus sit fusce commodo, erat consequat, aliquet nibh tincidunt libero proin dui interdum, ac a in. Curabitur nunc amet in, ipsum rutrum etiam in, dignissim augue urna ut odio tellus, libero eu vivamus a, lacus metus leo. Nunc elit etiam dolor, donec hendrerit, eget dignissim morbi, mauris tristique ullamcorper.</p>\r\n<p style=\"font-size: 12px; font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\" align=\"justify\">Interdum metus sapien, eros malesuada lorem fringilla imperdiet felis lacus, eu lacus pede cras elementum, quam morbi nec ante vivamus. Metus sit odio vestibulum magnis sit odio, aliquam ligula. Est condimentum lacus a turpis dapibus, nam laoreet, vivamus nul', '20', '2018-07-09 06:32:06'),
(7, 'RULES', '', '<p>We have rules to be followed</p>', '20', '2018-07-09 06:32:00'),
(9, 'Money', '', '<p>We need some money</p>', '20', '2018-05-27 21:05:27');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`) VALUES
(1, 'Men\'s Hostels'),
(2, 'Ladies Hostels'),
(3, 'Mixed Hostels'),
(4, 'Rental Houses');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `cl_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `id_no` int(8) NOT NULL,
  `phone` int(15) NOT NULL,
  `uni_id` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pphone` int(10) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `gender` enum('m','f') NOT NULL,
  `passport` varchar(255) NOT NULL,
  `yr_id` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `host_id` varchar(255) NOT NULL,
  `rm_id` varchar(255) NOT NULL,
  `status` enum('in','out') NOT NULL,
  `join_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`cl_id`, `fname`, `lname`, `id_no`, `phone`, `uni_id`, `email`, `pphone`, `pname`, `gender`, `passport`, `yr_id`, `course`, `host_id`, `rm_id`, `status`, `join_date`) VALUES
(1, 'Mike2', 'Rose', 11111111, 724654808, '3', 'mike@gmail.com', 789543635, 'Lorren Philips', '', '', '2', 'BUSINESS INFORMATION TECHNOLOGY', '20', '', '', '2018-08-22 17:24:42'),
(2, 'Bill', 'GATES', 11111111, 7734843, '1', 'bill@gmail.com', 2147483647, 'akjfsak adksdkf', 'm', '', '', '', '20', '', 'in', '2018-08-24 16:37:41'),
(3, 'Kelvin', 'Durant', 33333333, 799999999, '1', 'kelvin@yahoo.com', 789067856, 'Larry Wall', 'm', '-+254 724 654808- 20161122_140908.jpg', '', '', '20', '', '', '2018-08-22 17:24:50'),
(4, 'Peter', 'Hale', 23455432, 789745473, '3', 'peter@gmail.com', 798948547, 'Mary Hale', 'm', '', '', '', '20', '', '', '2018-08-22 17:24:53'),
(5, 'Charles', 'Babbage', 98987667, 724654808, '4', 'charles@gmail.com', 789654332, 'Ada Lovelace', 'm', '', '', '', '20', '', 'out', '2018-08-24 15:38:01'),
(7, 'jkdskjfkf', 'dskjfskjdf', 84538532, 85348394, '3', 'jsjfds@gmail.com', 782423847, 'hasjkfja kjsdaksj', '', '', '', '', '20', '3', 'in', '2018-08-24 08:55:16');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `emp_id` int(11) NOT NULL,
  `emp_phone` int(10) NOT NULL,
  `emp_fname` varchar(255) NOT NULL,
  `emp_lname` varchar(255) NOT NULL,
  `emp_idno` int(8) NOT NULL,
  `emp_email` varchar(255) NOT NULL,
  `emp_salary` int(8) NOT NULL,
  `emp_passport` varchar(255) NOT NULL,
  `host_id` varchar(255) NOT NULL,
  `emp_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`emp_id`, `emp_phone`, `emp_fname`, `emp_lname`, `emp_idno`, `emp_email`, `emp_salary`, `emp_passport`, `host_id`, `emp_date`) VALUES
(1, 76543882, 'Chrispine', 'Paul', 2147483647, 'chrisp@yahoo.com', 500000, '', '20', '2018-07-13 11:54:21'),
(2, 724654808, 'Kelvin', 'Sterling', 2147483647, 'kelvin@gmail.com', 60000, '', '20', '2018-07-13 11:51:29'),
(5, 789345673, 'Larry2', 'Ellison', 1873647783, 'larry@gmail.com', 10000, '', '20', '2018-07-13 11:53:12'),
(6, 2147483647, 'Mark', 'Zuckerberg', 987654321, 'mark@gmail.com', 340000000, '', '', '2018-05-29 15:43:41'),
(7, 0, 'Peter', 'JOhnson', 0, '', 0, '', '20', '2018-08-26 07:43:06');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `g_id` int(11) NOT NULL,
  `g_name` varchar(255) NOT NULL,
  `host_id` varchar(255) NOT NULL,
  `g_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`g_id`, `g_name`, `host_id`, `g_date`) VALUES
(47, 'Kenya-YMCA.jpg', '20', '2018-07-09 08:05:07'),
(48, 'Flora-Hostel.jpg', '20', '2018-07-09 08:05:37'),
(51, 'esgray-westlands.jpg', '20', '2018-07-09 08:23:30'),
(57, 'banner.jpg', '20', '2018-07-09 09:27:03'),
(58, 'esgray1.jpg', '20', '2018-07-09 09:27:03'),
(59, '20_7054.jpg', '20', '2018-07-09 09:27:03'),
(61, '20_76468.jpg', '20', '2018-07-09 09:31:39'),
(62, '20_90508.jpg', '20', '2018-07-09 09:31:39'),
(63, '20_99222.jpg', '20', '2018-07-09 09:31:39'),
(64, '20_4487.jpg', '20', '2018-07-20 05:31:28'),
(65, '20_85323.jpg', '20', '2018-07-20 05:31:29'),
(66, '20_69581.jpg', '20', '2018-07-20 05:31:29'),
(67, '20_49593.jpg', '20', '2018-07-20 05:31:29'),
(68, 'IMG_20130801_174014_0.jpg', '20', '2018-07-20 05:31:29'),
(69, '20_95576.jpg', '20', '2018-07-20 05:31:29'),
(70, '31afeab095911db41ea090210ec8db6f.jpg', '20', '2018-07-20 05:33:11'),
(71, '20_9329.jpg', '20', '2018-07-20 05:33:11'),
(72, '20_56345.jpg', '20', '2018-07-20 05:33:11'),
(73, '20_68211.jpg', '20', '2018-07-20 05:33:11'),
(74, '20_81974.jpg', '20', '2018-07-20 05:33:11'),
(75, '20_52755.jpg', '20', '2018-07-20 05:33:11'),
(76, '20_75582.jpg', '20', '2018-07-20 05:33:11');

-- --------------------------------------------------------

--
-- Table structure for table `help_support`
--

CREATE TABLE `help_support` (
  `help_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `id_attr` varchar(255) NOT NULL,
  `title_summary` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `help_support`
--

INSERT INTO `help_support` (`help_id`, `title`, `id_attr`, `title_summary`, `content`, `post_date`) VALUES
(3, 'skdjkgsjgjxjcz', 'kjczkvjkz', 'zcjzhvjzk', 'lkafafsjalfafhagskgjskjfsk', '2018-08-11 06:19:05'),
(4, '1234kjcjkxj', 'zkvkzjkjv', 'zjxczkjvz', 'jajkajfakvjakjvakkja', '2018-08-11 06:19:24'),
(7, 'jkdjsdkjfj', 'aksalfkal', 'ajkcakkacjkj', 'jckcjjcKcjKJcKcj', '2018-07-29 14:50:56'),
(11, 'Hello', 'Hello', 'Hello there', '', '2018-08-11 06:20:42'),
(12, 'How to book the hostels', 'book_hostel', 'How to book hostel', '', '2018-08-11 06:02:05'),
(13, 'Do this', 'sdkjsfjsjkf', 'skdjfskjfkjs', 'sjakjfakfjakfakfjahfhakjakfjakjfak', '2018-08-11 06:03:48'),
(14, 'Home', 'Do_that', 'skdjfskjfkjs', 'sjakjfakfjakfakfjahfhakjakfjakjfak', '2018-08-11 06:22:52'),
(15, 'ABout us', 'programming', 'About programming', '', '2018-08-15 08:55:55'),
(21, '', '', '', '', '2018-08-15 09:13:12'),
(22, '', '', '', '', '2018-08-15 09:13:14');

-- --------------------------------------------------------

--
-- Table structure for table `hostels`
--

CREATE TABLE `hostels` (
  `host_id` int(11) NOT NULL,
  `host_cat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `host_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hostel_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `postal_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `host_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `host_keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hostel_description` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hostels`
--

INSERT INTO `hostels` (`host_id`, `host_cat`, `location`, `host_name`, `hostel_link`, `contact1`, `contact2`, `email`, `postal_address`, `host_image`, `host_keywords`, `hostel_description`) VALUES
(2, '1', '2', 'Esgray Annex', 'esgray/index.php', '', '', '', '', 'esgray.jpg', '<p>Esgray, Annex, Male, Hostels</p>', ''),
(3, '2', '2', 'Modern Christian Ladies Hostel', 'modernchristianladies/index.php', '', '', '', '', 'mcladies.jpg', '<p>Modern christian, ladies, hostels</p>', ''),
(7, '1', '5', 'Sammar Annex', 'sammaannex/index.php', '<p>none</p>', '', '', '', 'sammarannex.jpg', '<p>none</p>', ''),
(8, '1', '2', 'Ngara mens hostel', 'ngaramens/index.php', '<p>none</p>', '', '', '', 'ngaramens.jpg', '<p>none</p>', ''),
(9, '3', '5', 'Victory Mixed Hostels', 'victory/index.php', '<p>none</p>', '', '', '', 'victory.jpg', '<p>none</p>', ''),
(14, '1', '2', 'Bereri Mens Hostel', 'bereri/index.php', '<p>none</p>', '', '', '', 'bereri.jpg', '<p>none</p>', ''),
(12, '1', '2', 'Olelai Mens Hostel', 'olelai/index.php', '<p>none</p>', '', '', '', 'olelai.jpg', '<p>none</p>', ''),
(13, '2', '5', 'Remix Ladies Hostel', 'remix/index.php', '<p>none</p>', '', '', '', 'remix.jpg', '<p>none</p>', ''),
(15, '2', '8', 'Moreteas Ladies Hostel', 'moreteas/index.php', '<p>none</p>', '', '', '', 'moreteas.jpg', '<p>Hostel, Ladies, Moreteas, Executive</p>', ''),
(16, '1', '9', 'Classique Mens Hostel', 'classique/index.php', '<p>none</p>', '', '', '', 'classique.jpg', '<p>Classique, Men, Nairobi west, Hostels</p>', ''),
(17, '1', '9', 'Topali Mens Hostel', 'topali/index.php', '<p>none</p>', '', '', '', 'topali.jpg', '<p>Topali, Mens, Hostels, Nairobi west</p>', ''),
(18, '3', '10', 'Bereri Westlands', 'bereri-westlands/index.php', '<p>none</p>', '', '', '', 'bereri_mixed.jpg', '<p>none</p>', ''),
(19, '2', '5', 'Esgray Ladies Hostel', 'esgray-ladies/index.php', '<p>none</p>', '', '', '', 'banner1.jpg', '<p>none</p>', ''),
(20, '3', 'Westlands', 'Esgray Westlands Mix Hostel', 'esgray-westlands/index.php', '078959448357', '0746583753', '', 'P.O BOX 28', '20_76323.jpg', '<p>none</p>', '<p>Esgray - Hostel is situated along Westlands Road, Opposite Riverside Estate near Nairobi Institute/Graffins College, a 5 minute walking distance from Westlands Shopping Centre. To get there take &quot;Route 23&quot; matatu at Odeon Cinema to Westlands. Walk down Westlands Road.The hostel is situated 300 metres from Westlands Shopping Centre. Call us if unsure of the location</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `hostels_room_photos`
--

CREATE TABLE `hostels_room_photos` (
  `rm_photo_id` int(11) NOT NULL,
  `cat_id` varchar(255) NOT NULL,
  `host_id` varchar(255) NOT NULL,
  `room_photo` varchar(255) NOT NULL,
  `room_amount` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hostels_room_photos`
--

INSERT INTO `hostels_room_photos` (`rm_photo_id`, `cat_id`, `host_id`, `room_photo`, `room_amount`) VALUES
(6, '1', '20', '6_20.jpg', '10000'),
(7, '2', '20', '7_20.jpg', '9500'),
(8, '8', '20', '8_20.jpg', '6500'),
(9, '10', '20', '9_20.jpg', '6000'),
(10, '7', '20', '10_20.jpg', '6000'),
(11, '', '20', '', ''),
(12, '1', '', '', 'eehfhfsk'),
(13, '5', '20', '', '677323'),
(14, '6', '20', '', '60000'),
(15, '3', '20', '', '7382');

-- --------------------------------------------------------

--
-- Table structure for table `hostels_slideshow`
--

CREATE TABLE `hostels_slideshow` (
  `slide_id` int(11) NOT NULL,
  `slide_image` varchar(255) NOT NULL,
  `slide_header` varchar(255) NOT NULL,
  `slide_content` varchar(255) NOT NULL,
  `host_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hostels_slideshow`
--

INSERT INTO `hostels_slideshow` (`slide_id`, `slide_image`, `slide_header`, `slide_content`, `host_id`) VALUES
(8, '31afeab095911db41ea090210ec8db6f.jpg', 'None', '										NONE', '20'),
(9, 'banner.jpg', 'none', '			none							', '20'),
(10, 'esgray1.jpg', '', '										', '20'),
(11, 'Kenya-YMCA.jpg', '', '										', '20');

-- --------------------------------------------------------

--
-- Table structure for table `hostel_admins`
--

CREATE TABLE `hostel_admins` (
  `admin_id` int(11) NOT NULL,
  `admin_fname` varchar(255) NOT NULL,
  `admin_lname` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_phone` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `host_id` varchar(255) NOT NULL,
  `admin_status` enum('1','0') NOT NULL,
  `user_type` enum('admin','user') NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `activation_code` varchar(255) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hostel_admins`
--

INSERT INTO `hostel_admins` (`admin_id`, `admin_fname`, `admin_lname`, `admin_email`, `admin_phone`, `admin_password`, `host_id`, `admin_status`, `user_type`, `profile_pic`, `activation_code`, `reg_date`) VALUES
(2, 'Larryghghghhggh', 'Ellisonrrrr', 'larry@gmail.com', '72222224', '$2y$10$xb37mBZNUMuT9txytWU0Xu0Y2eMG.ba99nNSoEeBhQhslzXnWjepO', '20', '', 'user', '', 'dacdb36ebc6761e69384d882751d146e', '2018-08-22 07:10:00'),
(4, 'Mark', 'Zuckerberg', 'mark@gmail.com', '7444444', 'ea82410c7a9991816b5eeeebe195e20a', '20', '1', 'admin', 'hacking.jpg', '04d7ee5b0114578139b23a465ac64488', '2018-08-21 11:40:44'),
(6, 'Michael', 'Brian', 'michael@gmail.com', '', '18126e7bd3f84b3f3e4df094def5b7de', '14', '1', 'admin', '', '', '2018-08-11 01:41:12'),
(7, 'Mike', 'Tech', 'miketech@gmail.com', '0667182838383', 'd41d8cd98f00b204e9800998ecf8427e', '20', '1', 'user', '', '', '2018-08-21 11:42:51'),
(8, 'Jeffhhhhh', 'Kennedy', 'kennedy@gmail.com', '23432423424', 'd41d8cd98f00b204e9800998ecf8427e', '20', '1', 'admin', '', '', '2018-08-22 07:09:02');

-- --------------------------------------------------------

--
-- Table structure for table `hostel_services`
--

CREATE TABLE `hostel_services` (
  `hs_id` int(11) NOT NULL,
  `service_id` varchar(255) NOT NULL,
  `host_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hostel_services`
--

INSERT INTO `hostel_services` (`hs_id`, `service_id`, `host_id`) VALUES
(1, '1', '20'),
(2, '2', '20'),
(3, '3', '20'),
(4, '4', '20'),
(7, '5', '20'),
(8, 'Select a service', '20'),
(9, '5', '20');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `mes_id` int(11) NOT NULL,
  `mes_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mes_phone` int(10) NOT NULL,
  `mes_sub` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `host_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mes_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`mes_id`, `mes_name`, `mes_phone`, `mes_sub`, `message`, `host_id`, `mes_date`) VALUES
(2, 'Muuyi Andrew', 724654808, 'Hacking', '<p>THe best hackers in the world</p>\n', '20', '2018-08-20 08:19:00'),
(3, 'Muuyi Andrew', 724654808, 'Hacking', '<p>Hacking the art of exploration</p>\n', '20', '2018-08-20 08:25:25');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `p_id` int(11) NOT NULL,
  `year` varchar(255) NOT NULL,
  `month` varchar(255) NOT NULL,
  `id_no` int(10) NOT NULL,
  `amount` int(10) NOT NULL,
  `host_id` varchar(255) NOT NULL,
  `day` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`p_id`, `year`, `month`, `id_no`, `amount`, `host_id`, `day`) VALUES
(2, '2018', 'May', 22222222, 4000, '20', '2018-05-27 06:40:29');

-- --------------------------------------------------------

--
-- Table structure for table `requirements`
--

CREATE TABLE `requirements` (
  `req_id` int(11) NOT NULL,
  `req_name` varchar(255) NOT NULL,
  `host_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requirements`
--

INSERT INTO `requirements` (`req_id`, `req_name`, `host_id`) VALUES
(1, 'Bedsheets/Blankets/Bedcovers ', '20'),
(2, 'Plate, Spoon, fork, Mug, Flask', '20'),
(4, 'Other commodities (Goods) are personal ', '20'),
(5, 'Basin/Bucket', '20');

-- --------------------------------------------------------

--
-- Table structure for table `room_category`
--

CREATE TABLE `room_category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_category`
--

INSERT INTO `room_category` (`cat_id`, `cat_name`) VALUES
(1, 'Single room'),
(2, 'Double occupancy'),
(3, 'Three sharing'),
(4, 'Four sharing'),
(5, 'Five sharing'),
(6, 'Six sharing'),
(7, 'Seven sharing'),
(8, 'Eight sharing'),
(9, 'Nine sharing'),
(10, 'Ten sharing');

-- --------------------------------------------------------

--
-- Table structure for table `room_numbers`
--

CREATE TABLE `room_numbers` (
  `rm_id` int(11) NOT NULL,
  `cat_id` varchar(255) NOT NULL,
  `rm_no` varchar(255) NOT NULL,
  `rm_amount` int(11) NOT NULL,
  `host_id` varchar(255) NOT NULL,
  `room_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_numbers`
--

INSERT INTO `room_numbers` (`rm_id`, `cat_id`, `rm_no`, `rm_amount`, `host_id`, `room_image`) VALUES
(2, '2', '3456', 8500, '20', ''),
(3, '3', '9876', 8000, '20', ''),
(4, '1', '78675', 50000, '20', ''),
(5, '1', '465545', 80000, '20', ''),
(6, '2', '56048', 8000, '20', ''),
(8, '3', 'adksfhsd', 7500, '20', ''),
(10, '1', 'hkadjs', 10000, '20', ''),
(11, '2', '48385', 9000, '20', ''),
(13, '1', '455', 10000, '20', ''),
(15, '10', '47538457', 6000, '20', ''),
(16, '1', 'hgjhj', 676576, '20', ''),
(17, '', '', 0, '20', ''),
(18, '1', '5000', 0, '', ''),
(19, '5', '6000', 677323, '20', ''),
(20, '6', '473473', 60000, '20', ''),
(21, '5', '8434', 60000, '20', ''),
(22, '3', 'hjsjada', 7382, '20', ''),
(23, '2', '37724', 8332, '20', ''),
(24, '2', '37724', 8332, '20', '');

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `sal_id` int(11) NOT NULL,
  `emp_idno` int(11) NOT NULL,
  `sal_amount` int(11) NOT NULL,
  `sal_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salaries`
--

INSERT INTO `salaries` (`sal_id`, `emp_idno`, `sal_amount`, `sal_date`) VALUES
(1, 345688284, 4000, '2018-01-27 05:38:58'),
(2, 8888888, 0, '2018-05-25 04:52:24'),
(3, 8888888, 10000, '2018-05-25 04:53:19'),
(4, 8888888, 600, '2018-05-29 11:30:57'),
(5, 2147483647, 5000, '2018-05-29 15:56:08'),
(6, 2147483647, 500000, '2018-07-13 12:15:36'),
(7, 2147483647, 500000, '2018-07-13 12:18:43'),
(8, 1873647783, 100000, '2018-07-13 12:19:16'),
(14, 1873647783, 100000, '2018-07-13 12:30:33'),
(15, 1873647783, 100000, '2018-07-13 12:31:42');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_name`) VALUES
(1, 'Free Wi-Fi'),
(2, 'Free DSTV'),
(3, 'Hot showers'),
(4, 'Quiet study room'),
(5, 'Recreational facilities'),
(6, 'Free entertainment');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` int(11) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `id_no` int(8) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(10) NOT NULL,
  `product` varchar(255) NOT NULL,
  `host_id` varchar(255) NOT NULL,
  `s_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `f_name`, `l_name`, `id_no`, `email`, `phone`, `product`, `host_id`, `s_date`) VALUES
(5, 'Charles ', 'Babbage', 98765432, 'babbage@gmail.com', 78956473, 'Maize', '20', '2018-07-15 05:43:12');

-- --------------------------------------------------------

--
-- Table structure for table `supplies`
--

CREATE TABLE `supplies` (
  `spls_id` int(11) NOT NULL,
  `suplier_id` varchar(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `supplies_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplies`
--

INSERT INTO `supplies` (`spls_id`, `suplier_id`, `amount`, `supplies_date`) VALUES
(2, '1', 10000, '2017-11-19 18:27:24'),
(3, '3', 2000, '2018-05-27 08:30:08'),
(4, '2', 100000, '2018-05-27 08:47:10'),
(5, '4', 5000, '2018-07-15 05:43:26'),
(6, '5', 2000, '2018-08-26 17:23:12');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `t_id` int(11) NOT NULL,
  `acn_id` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `amount` int(10) NOT NULL,
  `tra_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`t_id`, `acn_id`, `Description`, `amount`, `tra_date`) VALUES
(22, '13', 'Bought new land', 500000, '2018-07-14 05:36:04'),
(23, '15', 'Rice', 5000, '2018-07-14 05:36:24'),
(24, '16', 'Daily transport', 10000, '2018-08-13 06:52:14'),
(25, '15', 'Maize', 5000, '2018-08-14 02:18:08'),
(27, '15', 'Water', 9000, '2018-08-25 01:59:55'),
(28, '20', 'Bought new land', 100000, '2018-08-25 02:00:35'),
(29, '15', 'Rice', 500, '2018-08-26 01:22:37');

-- --------------------------------------------------------

--
-- Table structure for table `universities`
--

CREATE TABLE `universities` (
  `uni_id` int(11) NOT NULL,
  `uni_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `universities`
--

INSERT INTO `universities` (`uni_id`, `uni_name`) VALUES
(1, 'The Technical University of Kenya'),
(3, 'University of Nairobi'),
(4, 'Zetech University'),
(5, 'Kenya Catholic University');

-- --------------------------------------------------------

--
-- Table structure for table `university_admins`
--

CREATE TABLE `university_admins` (
  `admin_id` int(11) NOT NULL,
  `uni_id` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `university_admins`
--

INSERT INTO `university_admins` (`admin_id`, `uni_id`, `admin_email`, `admin_password`) VALUES
(1, '1', 'andrew@gmail.com', 'd914e3ecf6cc481114a3f534a5faf90b');

-- --------------------------------------------------------

--
-- Table structure for table `vacance`
--

CREATE TABLE `vacance` (
  `vaca_id` int(11) NOT NULL,
  `vaca_title` varchar(255) NOT NULL,
  `vaca_details` varchar(255) NOT NULL,
  `host_id` varchar(255) NOT NULL,
  `vaca_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vacance`
--

INSERT INTO `vacance` (`vaca_id`, `vaca_title`, `vaca_details`, `host_id`, `vaca_date`) VALUES
(2, 'Cook', '<p>We need a cook</p>', '20', '2018-07-09 06:43:06'),
(3, '2 Watchman', '1. We need a watchman with the following qualifications\n2. With a degree in criminology\n3. With experience of five years\n4. With good behavious\n5. Great in his work', '20', '2018-05-29 19:10:40'),
(4, 'Programmer', '<p>We need several programmers</p>\r\n', '20', '2018-08-27 01:48:19'),
(5, 'Hackers', '<p>We need several hackers</p>\r\n', '20', '2018-08-27 01:53:48'),
(6, 'Testing', '<p>We have to test</p>\r\n\r\n<ul>\r\n	<li>Operations</li>\r\n	<li>Hacking</li>\r\n	<li>Maintaining</li>\r\n	<li>Networking</li>\r\n	<li>So fourth</li>\r\n</ul>\r\n', '20', '2018-08-27 01:55:44');

-- --------------------------------------------------------

--
-- Table structure for table `year_of_study`
--

CREATE TABLE `year_of_study` (
  `yr_id` int(11) NOT NULL,
  `yr_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `year_of_study`
--

INSERT INTO `year_of_study` (`yr_id`, `yr_name`) VALUES
(1, '1st year'),
(2, '2nd year'),
(3, '3rd yar'),
(4, '4th year'),
(5, '6th and above'),
(6, 'Not a student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`acc_id`);

--
-- Indexes for table `account_name`
--
ALTER TABLE `account_name`
  ADD PRIMARY KEY (`acn_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_user` (`admin_user`);

--
-- Indexes for table `admins_messages`
--
ALTER TABLE `admins_messages`
  ADD PRIMARY KEY (`mes_id`);

--
-- Indexes for table `balances`
--
ALTER TABLE `balances`
  ADD PRIMARY KEY (`bal_id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`cl_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`g_id`);

--
-- Indexes for table `help_support`
--
ALTER TABLE `help_support`
  ADD PRIMARY KEY (`help_id`);

--
-- Indexes for table `hostels`
--
ALTER TABLE `hostels`
  ADD PRIMARY KEY (`host_id`);

--
-- Indexes for table `hostels_room_photos`
--
ALTER TABLE `hostels_room_photos`
  ADD PRIMARY KEY (`rm_photo_id`);

--
-- Indexes for table `hostels_slideshow`
--
ALTER TABLE `hostels_slideshow`
  ADD PRIMARY KEY (`slide_id`);

--
-- Indexes for table `hostel_admins`
--
ALTER TABLE `hostel_admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_email` (`admin_email`);

--
-- Indexes for table `hostel_services`
--
ALTER TABLE `hostel_services`
  ADD PRIMARY KEY (`hs_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`mes_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `requirements`
--
ALTER TABLE `requirements`
  ADD PRIMARY KEY (`req_id`);

--
-- Indexes for table `room_category`
--
ALTER TABLE `room_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `room_numbers`
--
ALTER TABLE `room_numbers`
  ADD PRIMARY KEY (`rm_id`);

--
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`sal_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `supplies`
--
ALTER TABLE `supplies`
  ADD PRIMARY KEY (`spls_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `universities`
--
ALTER TABLE `universities`
  ADD PRIMARY KEY (`uni_id`);

--
-- Indexes for table `university_admins`
--
ALTER TABLE `university_admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `vacance`
--
ALTER TABLE `vacance`
  ADD PRIMARY KEY (`vaca_id`);

--
-- Indexes for table `year_of_study`
--
ALTER TABLE `year_of_study`
  ADD PRIMARY KEY (`yr_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `account_name`
--
ALTER TABLE `account_name`
  MODIFY `acn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `admins_messages`
--
ALTER TABLE `admins_messages`
  MODIFY `mes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `balances`
--
ALTER TABLE `balances`
  MODIFY `bal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `cl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `g_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `help_support`
--
ALTER TABLE `help_support`
  MODIFY `help_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `hostels`
--
ALTER TABLE `hostels`
  MODIFY `host_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `hostels_room_photos`
--
ALTER TABLE `hostels_room_photos`
  MODIFY `rm_photo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `hostels_slideshow`
--
ALTER TABLE `hostels_slideshow`
  MODIFY `slide_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `hostel_admins`
--
ALTER TABLE `hostel_admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `hostel_services`
--
ALTER TABLE `hostel_services`
  MODIFY `hs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `mes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `requirements`
--
ALTER TABLE `requirements`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `room_category`
--
ALTER TABLE `room_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `room_numbers`
--
ALTER TABLE `room_numbers`
  MODIFY `rm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `sal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `supplies`
--
ALTER TABLE `supplies`
  MODIFY `spls_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `universities`
--
ALTER TABLE `universities`
  MODIFY `uni_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `university_admins`
--
ALTER TABLE `university_admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vacance`
--
ALTER TABLE `vacance`
  MODIFY `vaca_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `year_of_study`
--
ALTER TABLE `year_of_study`
  MODIFY `yr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
