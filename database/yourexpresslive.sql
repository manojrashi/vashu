-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2019 at 06:32 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yourexpresslive`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `user_type` enum('superadmin','admin','emp') NOT NULL,
  `roles` varchar(255) NOT NULL,
  `register_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,
  `material` varchar(100) NOT NULL,
  `min_quantity` varchar(10) NOT NULL,
  `packaing_detail` varchar(100) NOT NULL,
  `size_of_peice` varchar(10) NOT NULL,
  `cartion_box` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `username`, `password`, `email`, `full_name`, `mobile`, `user_type`, `roles`, `register_date`, `status`, `material`, `min_quantity`, `packaing_detail`, `size_of_peice`, `cartion_box`) VALUES
(1, 'admin', 'admin', 'manojk.pal@gmail.com', 'Manoj Pal', '9818670052', 'superadmin', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50', '2014-10-08 00:00:00', 1, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_area`
--

CREATE TABLE `tbl_area` (
  `id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `area` varchar(255) NOT NULL,
  `pincode` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_area`
--

INSERT INTO `tbl_area` (`id`, `city_id`, `area`, `pincode`, `status`) VALUES
(1, 2, 'Mohannagar', '201010', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attribute`
--

CREATE TABLE `tbl_attribute` (
  `id` int(11) NOT NULL,
  `attribute` varchar(255) NOT NULL,
  `attribute_type` varchar(255) NOT NULL,
  `enable_searching` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attributegroup`
--

CREATE TABLE `tbl_attributegroup` (
  `id` int(11) NOT NULL,
  `attributegroup` varchar(255) NOT NULL,
  `attribute_ids` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attributevalue`
--

CREATE TABLE `tbl_attributevalue` (
  `id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `attributevalue` varchar(255) NOT NULL,
  `display_value` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_banner`
--

CREATE TABLE `tbl_banner` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `target_url` text NOT NULL,
  `show_on_home` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_banner`
--

INSERT INTO `tbl_banner` (`id`, `title`, `photo`, `description`, `target_url`, `show_on_home`, `status`) VALUES
(4, 'banner', '1553969404banner-5.jpg', '', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `subcat_id` int(11) DEFAULT NULL,
  `logo` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`id`, `cat_id`, `subcat_id`, `logo`, `brand`, `slug`, `status`) VALUES
(1, 1, 2, '1563551662w.jpg', 'Dealskraft', '', 1),
(2, 5, 70, '1561808710o.png', 'CELLO', '', 1),
(4, 13, NULL, '01.jpg', 'Testing0123', 'It Piller', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `cimage` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `meta_tags` blob NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `category`, `cimage`, `slug`, `meta_tags`, `status`) VALUES
(1, 'Mobiles, Computers', '15531597199.JPG', 'mobiles-computers', '', 1),
(2, 'TV, Appliances, Electronics', '', 'tv-appliances-electronics', '', 1),
(3, 'Men\'s Fashion', '', 'men\'s-fashion', '', 1),
(4, 'Women\'s Fashion', '', '', '', 1),
(5, 'Home & Kitchen', '', 'home-kitchen', '', 1),
(6, 'Beauty, Health, Grocery', '', '', '', 1),
(7, 'Sports, Fitness, Bags, Luggage', '', '', '', 1),
(8, 'Toys, Baby Products', '', 'toys-baby-products', '', 1),
(9, 'Car, Motorbike, Industrial', '', '', '', 1),
(10, 'Office Supplies & Stationery ', '', 'office-supplies-stationery', '', 1),
(11, 'Gifts & Promotional Products', '', 'gifts-promotional-products', '', 1),
(12, 'Kid\'s Fashion', '', '', '', 1),
(13, 'Testing', 'Awars-02.jpg', 'Testing', 0x54657374696e67, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categoryimage`
--

CREATE TABLE `tbl_categoryimage` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_city`
--

CREATE TABLE `tbl_city` (
  `id` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_city`
--

INSERT INTO `tbl_city` (`id`, `city`, `status`) VALUES
(1, 'Delhi', 1),
(2, 'Ghaziabad', 1),
(3, 'Faridabad', 1),
(4, 'Gurgaon', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_color`
--

CREATE TABLE `tbl_color` (
  `id` int(11) NOT NULL,
  `color_name` varchar(20) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_color`
--

INSERT INTO `tbl_color` (`id`, `color_name`, `image`) VALUES
(1, 'Black', 'black.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comment`
--

CREATE TABLE `tbl_comment` (
  `id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `website` text NOT NULL,
  `comment` text NOT NULL,
  `posted_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_content`
--

CREATE TABLE `tbl_content` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `meta_title` text NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_content`
--

INSERT INTO `tbl_content` (`id`, `title`, `content`, `meta_title`, `meta_keywords`, `meta_description`, `status`) VALUES
(1, 'About Us', '', '', '', '', 1),
(2, 'Career\r\n', '', '', '', '', 1),
(3, 'Contact Us', 'twest', '', '', '', 1),
(4, 'Delivery & Returns', '', '', '', '', 1),
(5, 'Terms & Conditions', '', '', '', '', 1),
(6, 'Privacy Policy', '', '', '', '', 1),
(7, 'Faq', '', '', '', '', 1),
(8, 'Pressroom', '', '', '', '', 1),
(9, 'Footer Content', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_country`
--

CREATE TABLE `tbl_country` (
  `id` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `phone_code` varchar(10) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_country`
--

INSERT INTO `tbl_country` (`id`, `country`, `phone_code`, `status`) VALUES
(1, 'India', '+91', 1),
(2, 'Afghanistan', '+93', 1),
(3, 'Albania', '+355', 1),
(4, 'Algeria', '+213', 1),
(5, 'American Samoa', '+684', 1),
(6, 'Andorra', '+376', 1),
(7, 'Angola', '+244', 1),
(8, 'Anguilla', '+264', 1),
(9, 'Antarctica', '+672', 1),
(10, 'Antigua', '+268', 1),
(11, 'Argentina', '+54', 1),
(12, 'Armenia', '+374', 1),
(13, 'Aruba', '+297', 1),
(14, 'Ascension Island', '+247', 1),
(15, 'Australia', '+61', 1),
(16, 'Austria', '+43', 1),
(17, 'Azerbaijan', '+994', 1),
(18, 'Bahamas', '+242', 1),
(19, 'Bahrain', '+973', 1),
(20, 'Bangladesh', '+880', 1),
(21, 'Barbados', '+246', 1),
(22, 'Barbuda', '+268', 1),
(23, 'Belarus', '+375', 1),
(24, 'Belgium', '+32', 1),
(25, 'Belize', '+501', 1),
(26, 'Benin', '+229', 1),
(27, 'Bermuda', '+441', 1),
(28, 'Bhutan', '+975', 1),
(29, 'Bolivia', '+591', 1),
(30, 'Bosnia & Herzogovin', '+387', 1),
(31, 'Botswana', '+267', 1),
(32, 'Brazil', '+55', 1),
(33, 'British Virgin Islands', '+284', 1),
(34, 'Brunei', '+673', 1),
(35, 'Bulgaria', '+359', 1),
(36, 'Burkina Faso', '+226', 1),
(37, 'Burma (Myanmar)', '+95', 1),
(38, 'Burundi', '+257', 1),
(39, 'Cambodia', '+855', 1),
(40, 'Cameroon', '+237', 1),
(41, 'Canada', '+1', 1),
(42, 'Cape Verde Islands', '+238', 1),
(43, 'Cayman Islands', '+345', 1),
(44, 'Central African Republic', '+236', 1),
(45, 'Chad', '+235', 1),
(46, 'Chatham Island (New Zealand)', '+64', 1),
(47, 'Chile', '+56', 1),
(48, 'China (PRC)', '+86', 1),
(49, 'Christmas Island', '+61', 1),
(50, 'Cocos-Keeling Islands', '+61', 1),
(51, 'Colombia', '+57', 1),
(52, 'Comoros', '+269', 1),
(53, 'Congo', '+242', 1),
(54, 'Congo, Dem. Rep. of (former Zaire)', '+243', 1),
(55, 'Cook Islands', '+682', 1),
(56, 'Costa Rica', '+506', 1),
(57, 'Croatia', '+385', 1),
(58, 'Cuba', '+53', 1),
(59, 'Cuba (Guantanamo Bay)', '+5399', 1),
(60, 'Cyprus', '+357', 1),
(61, 'Czech Republic', '+420', 1),
(62, 'Denmark', '+45', 1),
(63, 'Diego Garcia', '+246', 1),
(64, 'Djibouti', '+253', 1),
(65, 'Dominica', '+767', 1),
(66, 'Dominican Republic', '+809', 1),
(67, 'Easter Island', '+56', 1),
(68, 'Ecuador', '+593', 1),
(69, 'Egypt', '+20', 1),
(70, 'El Salvador', '+503', 1),
(71, 'Equatorial Guinea', '+240', 1),
(72, 'Eritrea', '+291', 1),
(73, 'Estonia', '+372', 1),
(74, 'Ethiopia', '+251', 1),
(75, 'Faeroe Islands', '+298', 1),
(76, 'Falkland Islands', '+500', 1),
(77, 'Fiji Islands', '+679', 1),
(78, 'Finland', '+358', 1),
(79, 'France', '+33', 1),
(80, 'French Antilles', '+596', 1),
(81, 'French Guiana', '+594', 1),
(82, 'French Polynesia', '+689', 1),
(83, 'Gabon', '+241', 1),
(84, 'Gambia', '+220', 1),
(85, 'Georgia', '+995', 1),
(86, 'Germany', '+49', 1),
(87, 'Ghana', '+233', 1),
(88, 'Gibraltar', '+350', 1),
(89, 'Greece', '+30', 1),
(90, 'Greenland', '+299', 1),
(91, 'Grenada', '+473', 1),
(92, 'Guadeloupe', '+590', 1),
(93, 'Guam', '+670', 1),
(94, 'Guantanamo Bay', '+5399', 1),
(95, 'Guatemala', '+502', 1),
(96, 'Guinea-Bissau', '+245', 1),
(97, 'Guinea (PRP)', '+224', 1),
(98, 'Guyana', '+592', 1),
(99, 'Haiti', '+509', 1),
(100, 'Honduras', '+504', 1),
(101, 'Hong Kong', '+852', 1),
(102, 'Hungary', '+36', 1),
(103, 'Iceland', '+354', 1),
(104, 'Indonesia', '+62', 1),
(105, 'Iran', '+98', 1),
(106, 'Iraq', '+964', 1),
(107, 'Ireland', '+353', 1),
(108, 'Israel', '+972', 1),
(109, 'Italy', '+39', 1),
(110, 'Ivory Coast (CÃ´te d\'Ivoire)', '+225', 1),
(111, 'Jamaica', '+876', 1),
(112, 'Japan', '+81', 1),
(113, 'Jordan', '+962', 1),
(114, 'Kazakhstan', '+7', 1),
(115, 'Kenya', '+254', 1),
(116, 'Kiribati', '+686', 1),
(117, 'Korea (North)', '+850', 1),
(118, 'Korea (South)', '+82', 1),
(119, 'Kuwait', '+965', 1),
(120, 'Kyrgyz Republic', '+996', 1),
(121, 'Laos', '+856', 1),
(122, 'Latvia', '+371', 1),
(123, 'Lebanon', '+961', 1),
(124, 'Lesotho', '+266', 1),
(125, 'Liberia', '+231', 1),
(126, 'Libya', '+218', 1),
(127, 'Liechtenstein', '+41', 1),
(128, 'Lithuania', '+370', 1),
(129, 'Luxembourg', '+352', 1),
(130, 'Macau', '+853', 1),
(131, 'Macedonia (former Yugoslav Rep.)', '+389', 1),
(132, 'Madagascar', '+261', 1),
(133, 'Malawi', '+265', 1),
(134, 'Malaysia', '+60', 1),
(135, 'Maldives', '+960', 1),
(136, 'Mali Republic', '+223', 1),
(137, 'Malta', '+356', 1),
(138, 'Marshall Islands', '+692', 1),
(139, 'Martinique', '+596', 1),
(140, 'Mauritania', '+222', 1),
(141, 'Mauritius', '+230', 1),
(142, 'Mayotte Island', '+269', 1),
(143, 'Mexico', '+52', 1),
(144, 'Micronesia', '+691', 1),
(145, 'Midway Island', '+808', 1),
(146, 'Moldova', '+373', 1),
(147, 'Monaco', '+377', 1),
(148, 'Mongolia', '+976', 1),
(149, 'Montserrat', '+664', 1),
(150, 'Morocco', '+212', 1),
(151, 'Mozambique', '+258', 1),
(152, 'Myanmar', '+95', 1),
(153, 'Namibia', '+264', 1),
(154, 'Nauru', '+674', 1),
(155, 'Nepal', '+977', 1),
(156, 'Netherlands', '+31', 1),
(157, 'Netherlands Antilles', '+599', 1),
(158, 'Nevis', '+869', 1),
(159, 'New Caledonia', '+687', 1),
(160, 'New Zealand', '+64', 1),
(161, 'Nicaragua', '+505', 1),
(162, 'Niger', '+227', 1),
(163, 'Nigeria', '+234', 1),
(164, 'Niue', '+683', 1),
(165, 'Norfolk Island', '+672', 1),
(166, 'North Korea', '+850', 1),
(167, 'Norway', '+47', 1),
(168, 'Oman', '+968', 1),
(169, 'Pakistan', '+92', 1),
(170, 'Palau', '+680', 1),
(171, 'Panama', '+507', 1),
(172, 'Papua New Guinea', '+675', 1),
(173, 'Paraguay', '+595', 1),
(174, 'Peru', '+51', 1),
(175, 'Philippines', '+63', 1),
(176, 'Poland', '+48', 1),
(177, 'Portugal', '+351', 1),
(178, 'Puerto Rico', '+787', 1),
(179, 'Qatar', '+974', 1),
(180, 'RÃ©union Island', '+262', 1),
(181, 'Romania', '+40', 1),
(182, 'Rota Island', '+670', 1),
(183, 'Russia', '+7', 1),
(184, 'Rwanda', '+250', 1),
(185, 'St. Helena', '+290', 1),
(186, 'St. Kitts/Nevis', '+869', 1),
(187, 'St. Lucia', '+758', 1),
(188, 'St. Pierre & Miquelon', '+508', 1),
(189, 'St. Vincent & Grenadines', '+809', 1),
(190, 'Saipan Island', '+670', 1),
(191, 'San Marino', '+378', 1),
(192, 'SÃ£o TomÃ© and Principe', '+239', 1),
(193, 'Saudi Arabia', '+966', 1),
(194, 'Senegal', '+221', 1),
(195, 'Serbia', '+381', 1),
(196, 'Seychelles Islands', '+248', 1),
(197, 'Sierra Leone', '+232', 1),
(198, 'Singapore', '+65', 1),
(199, 'Slovak Republic', '+421', 1),
(200, 'Slovenia', '+386', 1),
(201, 'Solomon Islands', '+677', 1),
(202, 'Somalia', '+252', 1),
(203, 'South Africa', '+27', 1),
(204, 'South Korea', '+82', 1),
(205, 'Spain', '+34', 1),
(206, 'Sri Lanka', '+94', 1),
(207, 'Sudan', '+249', 1),
(208, 'Suriname', '+597', 1),
(209, 'Swaziland', '+268', 1),
(210, 'Sweden', '+46', 1),
(211, 'Switzerland', '+41', 1),
(212, 'Syria', '+963', 1),
(213, 'Taiwan', '+886', 1),
(214, 'Tajikistan', '+7', 1),
(215, 'Tanzania', '+255', 1),
(216, 'Thailand', '+66', 1),
(217, 'Tinian Island', '+970', 1),
(218, 'Togo', '+228', 1),
(219, 'Tokelau', '+690', 1),
(220, 'Tonga Islands', '+676', 1),
(221, 'Trinidad & Tobago', '+868', 1),
(222, 'Tunisia', '+216', 1),
(223, 'Turkey', '+90', 1),
(224, 'Turkmenistan', '+993', 1),
(225, 'Turks and Caicos Islands', '+649', 1),
(226, 'Tuvalu', '+688', 1),
(227, 'Uganda', '+256', 1),
(228, 'Ukraine', '+380', 1),
(229, 'United Arab Emirates', '+971', 1),
(230, 'United Kingdom', '+44', 1),
(231, 'United States of America', '+1', 1),
(232, 'US Virgin Islands', '+1', 1),
(233, 'Uruguay', '+598', 1),
(234, 'Uzbekistan', '+998', 1),
(235, 'Vanuatu', '+678', 1),
(236, 'Vatican City', '+376', 1),
(237, 'Venezuela', '+58', 1),
(238, 'Vietnam', '+84', 1),
(239, 'Wake Island', '+808', 1),
(240, 'Wallis and Futuna Islands', '+681', 1),
(241, 'Western Samoa', '+685', 1),
(242, 'Yemen', '+967', 1),
(243, 'Yugoslavia', '+381', 1),
(244, 'Zambia', '+260', 1),
(245, 'Zimbabwe', '+263', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_coupon`
--

CREATE TABLE `tbl_coupon` (
  `id` int(11) NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `valid_for` enum('All','Particular') NOT NULL,
  `discount_type` enum('Percent','Direct') NOT NULL,
  `discount` double NOT NULL,
  `minimum_purchase` double NOT NULL,
  `to_email` varchar(255) NOT NULL,
  `expire_date` date NOT NULL,
  `generate_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_enquiry`
--

CREATE TABLE `tbl_enquiry` (
  `id` int(11) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `subject` varchar(500) NOT NULL,
  `uemail` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `enq_message` text NOT NULL,
  `ip` varchar(255) NOT NULL,
  `send_date` varchar(100) NOT NULL,
  `type` int(2) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_enquiry`
--

INSERT INTO `tbl_enquiry` (`id`, `uname`, `product_id`, `subject`, `uemail`, `contact`, `enq_message`, `ip`, `send_date`, `type`, `status`) VALUES
(4, 'ThomasHoorn', 0, '', 'thomasswasp@gmail.com', '144381152', 'We offer you the opportunity to advertise your products and services. \r\nGood man! Here is  a good offering for you. I want to offer the possibility of sending your commercial offers or messages through feedback forms. The advantage of this method is that the messages sent through the feedback forms are included in the white list. This method increases the chance that your message will be read. Mailing is made in the same way as you received this message. \r\n \r\nSending via Feedback Forms to any domain zones of the world. (more than 1000 domain zones.). \r\n \r\nThe cost of sending 1 million messages is $ 49 instead of $ 99. \r\nAll us sites that have a feedback form. (10 million messages sent) - $349 instead of $649 \r\nDomain zone .com - (12 million messages sent) - $399 instead of $699 \r\nAll domain zones in Europe- (8 million messages sent) - $ 299 instead of $599 \r\nAll sites in the world (25 million messages sent) - $499 instead of $999 \r\n \r\nDiscounts are valid until April 7! \r\nFeedback and warranty! \r\nDelivery report! \r\n \r\nIn the process of sending messages, we do not violate the rules of GDRP. \r\nThis message is created automatically use our contacts for communication. \r\n \r\nContact us. \r\nTelegram - @FeedbackFormEU \r\nSkype â€“ FeedbackForm2019 \r\nEmail - feedbackform@make-success.com \r\n \r\nThanks for reading.', '', '', 0, 1),
(5, 'Sivatheriinae', 0, '', 'gregorBreesepleary@gmail.com', '12241029551', 'We offer you the opportunity to advertise your products and services. \r\n \r\nDear Sir / Madam Here is  nice offer for you. I can send your commercial offers or messages through feedback forms. The advantage of this method is that the messages sent through the feedback forms are included in the white list. This method increases the chance that your message will be read. The same way as you received this message. \r\nSending via Feedback Forms to any domain zones of the world. (more than 1000 domain zones.). \r\nThe cost of sending 1 million messages is $ 49 instead of $ 99. \r\nDomain zone .com - (12 million messages sent) - $399 instead of $699 \r\nAll us sites that have a feedback form. (10 million messages sent) - $349 instead of $649 \r\nAll domain zones in Europe- (8 million messages sent) - $ 299 instead of $599 \r\nAll sites in the world (25 million messages sent) - $499 instead of $999 \r\n \r\n \r\nDiscounts are valid until April 7. \r\nFeedback and warranty! \r\nDelivery report! \r\n \r\nIn the process of sending messages, we do not violate the rules of GDRP. \r\nThis message is created automatically use our contacts for communication. \r\n \r\n \r\n \r\nContact us. \r\nTelegram - @FeedbackFormEU \r\nSkype â€“ FeedbackForm2019 \r\nEmail - FeedbackForm@make-success.com \r\n \r\nThank you for your attention. \r\n \r\nThis message is created automatically use our contacts for communication.', '', '', 0, 1),
(6, 'LarryMon', 0, '', 'feedbackformeu@gmail.com', '313618174', 'While on your great website I felt that my outstanding offer could be a good fit for you. \r\n \r\nIâ€™m happy to say that Iâ€™ve come up with a way for you to get your feet wet in \r\nforex without investing 10k or more right away. 3000â‚¬ will do it here. \r\n \r\nEver seen such proven profits on MyFxBook? Youâ€™ve got to see them with your own eyes. Just go through the links below â€“ opt-in and download a detailed presentation-pdf. \r\n \r\nhttp://bestforexprofits.com \r\nhttp://www.fxstat.com/en/performances/view/Daytona-98173 \r\nhttps://www.outlierfx.com \r\nhttp://bit.ly/OpenMyAccount', '', '', 0, 1),
(7, 'Achaemenid', 0, '', 'gregorBreesepleary@gmail.com', '16145337192', 'We offer you the opportunity to advertise your products and services. \r\n \r\nGood day! There is a fine offering for you. I want to offer the possibility of sending your commercial offers or messages through feedback forms. The advantage of this method is that the messages sent through the feedback forms are included in the white list. This method increases the chance that your message will be read. The same way as you received this message. \r\nSending via Feedback Forms to any domain zones of the world. (more than 1000 domain zones.). \r\nThe cost of sending 1 million messages is $ 49 instead of $ 99. \r\nDomain zone .com - (12 million messages sent) - $399 instead of $699 \r\nAll us sites that have a feedback form. (10 million messages sent) - $349 instead of $649 \r\nAll domain zones in Europe- (8 million messages sent) - $ 299 instead of $599 \r\nAll sites in the world (25 million messages sent) - $499 instead of $999 \r\n \r\n \r\nDiscounts are valid until April 11. \r\nFeedback and warranty! \r\nDelivery report! \r\n \r\nIn the process of sending messages, we do not violate the rules of GDRP. \r\nThis message is created automatically use our contacts for communication. \r\n \r\n \r\n \r\nContact us. \r\nTelegram - @FeedbackFormEU \r\nSkype â€“ FeedbackForm2019 \r\nEmail - FeedbackForm@make-success.com \r\n \r\nSorry to bother you. \r\n \r\nThis message is created automatically use our contacts for communication.', '', '', 0, 1),
(8, 'Eduardobam', 0, '', 'svetlanacol0sova@yandex.ua', '374275834', 'Hi dealskraft.com \r\nGrow your bitcoins by 10% per 2 days. \r\nProfit comes to your btc wallet automatically. \r\n \r\nTry  http://bm-syst.xyz \r\nit takes 2 minutes only and let your btc works for you! \r\n \r\nGuaranteed by the blockchain technology!', '', '', 0, 1),
(9, 'Carmentot', 0, '', 'gunrussia@scryptmail.com', '378376156', '25 charging traumatic pistols shooting automatic fire! Modified Makarov pistols with a silencer! Combat Glock 17 original or with a silencer! And many other types of firearms without a license, without documents, without problems! \r\nDetailed video reviews of our products you can see on our website. \r\nhttp://Gunrussia.pw \r\nIf the site is unavailable or blocked, email us at - Gunrussia@secmail.pro   or  Gunrussia@elude.in \r\nAnd we will send you the address of the backup site!', '', '', 0, 1),
(10, 'Geraldrom', 0, '', 'michaeldance@gmail.com', '363276652', ' Hey What we be subjected to here is , a pureoffers \r\n Are you in?  \r\n \r\nhttps://drive.google.com/file/d/1Cr84xypetB47rbA4fOLbxEYdC2V_OpKF/preview', '', '', 0, 1),
(11, 'dealskraft.com', 0, '', 'micgyhaeldance@gmail.com', '278475736', 'dealskraft.com  Hi Complimentary front-page news ! an importantpresent \r\n Well-founded click \r\nhttps://drive.google.com/file/d/1kHg7EFwVnnCbXyIFVT6Fox-3CVbwUpvA/preview', '', '', 0, 1),
(12, 'ContactForm', 0, '', 'raphaeBreesepleary@gmail.com', '375627528', 'Hi!  dealskraft.com \r\n \r\nWe present \r\n \r\nSending your business proposition through the feedback form which can be found on the sites in the contact section. Contact form are filled in by our software and the captcha is solved. The advantage of this method is that messages sent through feedback forms are whitelisted. This method increases the probability that your message will be read. \r\n \r\nOur database contains more than 25 million sites around the world to which we can send your message. \r\n \r\nThe cost of one million messages 49 USD \r\n \r\nFREE TEST mailing of 50,000 messages to any country of your choice. \r\n \r\n \r\nThis message is automatically generated to use our contacts for communication. \r\n \r\n \r\n \r\nContact us. \r\nTelegram - @FeedbackFormEU \r\nSkype  FeedbackForm2019 \r\nEmail - FeedbackForm@make-success.com \r\nWhatsApp - +44 7598 509161', '', '', 0, 1),
(13, 'dealskraft.com', 0, '', 'micgyhaeldance@gmail.com', '254611127', 'Here is  an important  promotion for victory. dealskraft.com \r\nhttp://bit.ly/2KzAO2e', '', '', 0, 1),
(14, 'dealskraft.com', 0, '', 'micgyhaeldance@gmail.com', '217448616', 'Please note an amazing  offers for win. dealskraft.com \r\nhttp://bit.ly/2KyKMkl', '', '', 0, 1),
(15, 'Charlestaisk', 0, '', 'gulfsrv94@gmail.com', '281666713', 'Good day!, dealskraft.com \r\n \r\nOur client want to speculate your region for good value. \r\n \r\nPlease contact us for more information on  +973 650 09688 or mh@indobsc.com \r\n \r\nBest regards \r\nMr. Mat Hernandez', '', '', 0, 1),
(16, 'ContactForm', 0, '', 'raphaeBreesepleary@gmail.com', '375627528', 'Good day!  dealskraft.com \r\n \r\nWe suggest \r\n \r\nSending your message through the Contact us form which can be found on the sites in the Communication partition. Contact form are filled in by our application and the captcha is solved. The profit of this method is that messages sent through feedback forms are whitelisted. This method increases the probability that your message will be read. \r\n \r\nOur database contains more than 25 million sites around the world to which we can send your message. \r\n \r\nThe cost of one million messages 49 USD \r\n \r\nFREE TEST mailing of 50,000 messages to any country of your choice. \r\n \r\n \r\nThis message is automatically generated to use our contacts for communication. \r\n \r\n \r\n \r\nContact us. \r\nTelegram - @FeedbackFormEU \r\nSkype  FeedbackForm2019 \r\nWhatsApp - +44 7598 509161 \r\nEmail - FeedbackForm@make-success.com', '', '', 0, 1),
(17, 'ContactForm', 0, '', 'raphaeBreesepleary@gmail.com', '375627528', 'Good day!  dealskraft.com \r\n \r\nWe present oneself \r\n \r\nSending your business proposition through the Contact us form which can be found on the sites in the contact section. Feedback forms are filled in by our application and the captcha is solved. The superiority of this method is that messages sent through feedback forms are whitelisted. This method increases the probability that your message will be open. \r\n \r\nOur database contains more than 25 million sites around the world to which we can send your message. \r\n \r\nThe cost of one million messages 49 USD \r\n \r\nFREE TEST mailing of 50,000 messages to any country of your choice. \r\n \r\n \r\nThis message is automatically generated to use our contacts for communication. \r\n \r\n \r\n \r\nContact us. \r\nTelegram - @FeedbackFormEU \r\nSkype  FeedbackForm2019 \r\nWhatsApp - +44 7598 509161 \r\nEmail - FeedbackForm@make-success.com', '', '', 0, 1),
(18, 'dealskraft.com', 0, '', 'micgyhaeldance@gmail.com', '217448616', 'That is a okay  contribution after win. dealskraft.com \r\nhttp://bit.ly/2KxZGaM', '', '', 0, 1),
(19, 'dealskraft.com', 0, '', 'micgyhaeldance@gmail.com', '217448616', 'That is enjoyably  offers as a substitute inasmuch as of you. dealskraft.com \r\nhttp://bit.ly/2NIrwnR', '', '', 0, 1),
(20, 'dealskraft.com', 0, '', 'micgyhaeldance@gmail.com', '217448616', 'Here is  an frightful  relinquishment in stand behind of victory. dealskraft.com \r\nhttp://bit.ly/2NJ1Mrq', '', '', 0, 1),
(21, 'BusinessCapitalAdvisors', 0, '', 'noreply@business-capital-advisors.com', '87212561313', 'Hi, letting you know that http://Business-Capital-Advisors.com can find your business a SBA or private loan for $2,000 - $350K Without high credit or collateral. \r\n \r\nFind Out how much you qualify for by clicking here: \r\n \r\nhttp://Business-Capital-Advisors.com \r\n \r\nMinimum requirements include your company being established for at least a year and with current gross revenue of at least 120K. Eligibility and funding can be completed in as fast as 48hrs. Terms are personalized for each business so I suggest applying to find out exactly how much you can get on various terms. \r\n \r\nThis is a free service from a qualified lender and the approval will be based on the annual revenue of your business. These funds are Non-Restrictive, allowing you to spend the full amount in any way you require including business debt consolidation, hiring, marketing, or Absolutely Any Other expense. \r\n \r\nIf you need fast and easy business funding take a look at these programs now as there is limited availability: \r\n \r\nhttp://Business-Capital-Advisors.com \r\n \r\nHave a great day, \r\nThe Business Capital Advisors Team \r\n \r\nunsubscribe/remove - http://business-capital-advisors.com/r.php?url=theglitzworld.com&id=e164', '', '', 0, 1),
(22, 'Williamupdak', 0, '', 'raphaeBreesepleary@gmail.com', '277241778', 'Good day!  theglitzworld.com \r\n \r\nWe put up of the sale \r\n \r\nSending your commercial proposal through the feedback form which can be found on the sites in the Communication partition. Feedback forms are filled in by our software and the captcha is solved. The superiority of this method is that messages sent through feedback forms are whitelisted. This method improve the probability that your message will be open. \r\n \r\nOur database contains more than 25 million sites around the world to which we can send your message. \r\n \r\nThe cost of one million messages 49 USD \r\n \r\nFREE TEST mailing of 50,000 messages to any country of your choice. \r\n \r\n \r\nThis message is automatically generated to use our contacts for communication. \r\n \r\n \r\n \r\nContact us. \r\nTelegram - @FeedbackFormEU \r\nSkype  FeedbackForm2019 \r\nEmail - FeedbackForm@make-success.com \r\nWhatsApp - +44 7598 509161', '', '', 0, 1),
(23, 'WilliamteK', 0, '', 'raphaeBreesepleary@gmail.com', '83313167158', 'Hi!  dealskraft.in \r\n \r\nWe make offer for you \r\n \r\nSending your commercial offer through the feedback form which can be found on the sites in the Communication partition. Contact form are filled in by our application and the captcha is solved. The advantage of this method is that messages sent through feedback forms are whitelisted. This method improve the odds that your message will be read. \r\n \r\nOur database contains more than 25 million sites around the world to which we can send your message. \r\n \r\nThe cost of one million messages 49 USD \r\n \r\nFREE TEST mailing of 50,000 messages to any country of your choice. \r\n \r\n \r\nThis message is automatically generated to use our contacts for communication. \r\n \r\n \r\n \r\nContact us. \r\nTelegram - @FeedbackFormEU \r\nSkype  FeedbackForm2019 \r\nEmail - FeedbackForm@make-success.com \r\nWhatsApp - +44 7598 509161', '', '', 0, 1),
(24, 'BusinessCapital247', 0, '', 'noreply@businesscapital247.com', '84396436682', 'Hi, letting you know that http://BusinessCapital247.com can find your business a SBA or private loan for $2,000 - $350K Without high credit or collateral. \r\n \r\nFind Out how much you qualify for by clicking here: \r\n \r\nhttp://BusinessCapital247.com \r\n \r\nMinimum requirements include your company being established for at least a year and with current gross revenue of at least 120K. Eligibility and funding can be completed in as fast as 48hrs. Terms are personalized for each business so I suggest applying to find out exactly how much you can get on various terms. \r\n \r\nThis is a free service from a qualified lender and the approval will be based on the annual revenue of your business. These funds are Non-Restrictive, allowing you to spend the full amount in any way you require including business debt consolidation, hiring, marketing, or Absolutely Any Other expense. \r\n \r\nIf you need fast and easy business funding take a look at these programs now as there is limited availability: \r\n \r\nhttp://BusinessCapital247.com \r\n \r\nHave a great day, \r\nThe Business Capital 247 Team \r\n \r\nunsubscribe/remove - http://businesscapital247.com/r.php?url=theglitzworld.com&id=e164', '', '', 0, 1),
(25, 'FrankJus', 0, '', 'frankzer@gmail.com', '82768491891', 'That is an intriguing  depredate chop ambiguous best as a medication seeking your team. dealskraft.com  http://penseverli.tk/lsag', '', '', 0, 1),
(26, 'WilliamVet', 0, '', 'raphaeBreesepleary@gmail.com', '81119178927', 'Hi!  glitzworld.in \r\n \r\nWe put up of the sale \r\n \r\nSending your message through the feedback form which can be found on the sites in the Communication section. Contact form are filled in by our software and the captcha is solved. The superiority of this method is that messages sent through feedback forms are whitelisted. This method improve the chances that your message will be read. \r\n \r\nOur database contains more than 25 million sites around the world to which we can send your message. \r\n \r\nThe cost of one million messages 49 USD \r\n \r\nFREE TEST mailing of 50,000 messages to any country of your choice. \r\n \r\n \r\nThis message is automatically generated to use our contacts for communication. \r\n \r\n \r\n \r\nContact us. \r\nTelegram - @FeedbackFormEU \r\nSkype  FeedbackForm2019 \r\nEmail - FeedbackForm@make-success.com', '', '', 0, 1),
(27, 'WilliamGeque', 0, '', 'raphaeBreesepleary@gmail.com', '82675679627', 'Hi!  dealscraft.in \r\n \r\nWe offer \r\n \r\nSending your commercial offer through the Contact us form which can be found on the sites in the contact section. Contact form are filled in by our program and the captcha is solved. The profit of this method is that messages sent through feedback forms are whitelisted. This method improve the chances that your message will be read. \r\n \r\nOur database contains more than 25 million sites around the world to which we can send your message. \r\n \r\nThe cost of one million messages 49 USD \r\n \r\nFREE TEST mailing of 50,000 messages to any country of your choice. \r\n \r\n \r\nThis message is automatically generated to use our contacts for communication. \r\n \r\n \r\n \r\nContact us. \r\nTelegram - @FeedbackFormEU \r\nSkype  FeedbackForm2019 \r\nEmail - FeedbackForm@make-success.com', '', '', 0, 1),
(28, 'WilliamUniop', 0, '', 'raphaeBreesepleary@gmail.com', '87234492235', 'Ciao!  dealskraft.com \r\n \r\nWe offer \r\n \r\nSending your commercial offer through the Contact us form which can be found on the sites in the Communication partition. Contact form are filled in by our program and the captcha is solved. The superiority of this method is that messages sent through feedback forms are whitelisted. This method increases the odds that your message will be open. \r\n \r\nOur database contains more than 25 million sites around the world to which we can send your message. \r\n \r\nThe cost of one million messages 49 USD \r\n \r\nFREE TEST mailing of 50,000 messages to any country of your choice. \r\n \r\n \r\nThis message is automatically generated to use our contacts for communication. \r\n \r\n \r\n \r\nContact us. \r\nTelegram - @FeedbackFormEU \r\nSkype  FeedbackForm2019 \r\nEmail - FeedbackForm@make-success.com', '', '', 0, 1),
(29, 'KennethKet', 0, '', 'chaguzman@gmail.com', '89334882432', ' Hy there,  What we hold here is , nicedonation  http://tuomesorlars.tk/z3c6', '', '', 0, 1),
(30, 'ThomasOners', 0, '', 'thomasChelo@gmail.com', '85744519482', 'Having a better Alexa for your website will increase sales and visibility \r\n \r\nOur service is intended to improve the Global Alexa traffic rank of a website. It usually takes seven days to see the primary change and one month to achieve your desired three-month average Alexa Rank. The three-month average Alexa traffic rank is the one that Alexa.com shows on the Alexaâ€™s toolbar. \r\n \r\nFor more information visit our website \r\nhttps://monkeydigital.co/product/alexa-rank-service/ \r\n \r\nthanks and regards \r\nMike \r\nmonkeydigital.co@gmail.com', '', '', 0, 1),
(31, 'WilliamVef', 0, '', 'ravis_rangla@hotmail.com', '82966442862', 'That is an importantoffers recompense you. http://rachnewsvenla.tk/ps8u', '', '', 0, 1),
(32, 'Manoj Singh', 0, '', 'manojthemanager@yahoo.com', '9907145555', 'I want your complete product details along with their respective prices and MOQ to be purchased respectively. Also, I want to know about your interest in Developing business in Chhattisgarh.', '', '', 0, 1),
(33, 'Frankwex', 0, '', 'barleyclymertak@aol.com', '82987489329', 'Behold is  an fabulousdonation someone is concerned you. http://dilosubza.gq/mi434', '', '', 0, 1),
(34, 'Luciana Warfe', 0, '', 'noreply@thewordpressclub7788.space', '201-658-7488', 'Hello There,\r\n\r\nAre you currently using Wordpress/Woocommerce or maybe will you want to implement it in the future ? We currently provide around 2500 premium plugins and additionally themes fully free to download : http://urluk.xyz/2Noog\r\n\r\nThank You,\r\n\r\nLuciana', '', '', 0, 1),
(35, 'AveryDooff', 0, '', 'raphaeBreesepleary@gmail.com', '85739588337', 'Hello!  dealskraft.com \r\n \r\nHave you ever heard of sending messages via feedback forms? \r\n \r\nThink of that your offer will be readseen by hundreds of thousands of your potential future userscustomers. \r\nYour message will not go to the spam folder because people will send the message to themselves. As an example, we have sent you our offer  in the same way. \r\n \r\nWe have a database of more than 30 million sites to which we can send your letter. Sites are sorted by country. Unfortunately, you can only select a country when sending a offer. \r\n \r\nThe price of one million messages 49 USD. \r\nThere is a discount program when you buy  more than two million message packages. \r\n \r\n \r\nFree proof mailing of 50,000 messages to any country of your selection. \r\n \r\n \r\nThis offer is created automatically. Please use the contact details below to contact us. \r\n \r\n \r\n \r\nContact us. \r\nTelegram - @FeedbackFormEU \r\nSkype  FeedbackForm2019 \r\nEmail - feedbackform@make-success.com', '', '', 0, 1),
(36, 'Mikeaveta', 0, '', 'noreplymn@gmail.com', '89128565932', 'When you order 1000 backlinks with this service you get 1000 unique domains, Only receive 1 backlinks from each domain. All domains come with DA above 15-20 and with actual page high PA values. Simple yet very effective service to improve your linkbase and SEO metrics. \r\n \r\nOrder this great service from here today: \r\nhttps://monkeydigital.co/product/unique-domains-backlinks/ \r\n \r\nMultiple offers available \r\n \r\nthanks and regards \r\nMike \r\nmonkeydigital.co@gmail.com', '', '', 0, 1),
(37, 'Pedro Molina', 0, '', 'pedrom@uicinsuk.com', '81156716389', 'Dear Sir, \r\nAm contacting you to partner with me to secure the life insurance of my late client, to avoid it being confiscated. For more information, please contact me on + 447452275874 or pedrom@uicinuk.com \r\nRegards \r\nPedro Molina', '', '', 0, 1),
(38, 'Lawerence Windsor', 0, '', 'noreply@gplforest1646.com', '077 0691 4842', 'Hi,\r\n\r\nAre you currently operating Wordpress/Woocommerce or do you think to work with it later ? We provide more than 2500 premium plugins and also themes completely free to download : http://lowty.xyz/tMxoP\r\n\r\nThanks,\r\n\r\nLawerence', '', '', 0, 1),
(39, 'YourBusinessFundingNow', 0, '', 'noreply@yourbusinessfundingnow.com', '', 'Hi, letting you know that http://YourBusinessFundingNow.com/?id=124 can find your business a SBA or private loan for $2,000 - $350K Without high credit or collateral. \r\n \r\nFind Out how much you qualify for by clicking here: \r\n \r\nhttp://YourBusinessFundingNow.com/?id=124 \r\n \r\nMinimum requirements include your company being established for at least a year and with current gross revenue of at least 120K. Eligibility and funding can be completed in as fast as 48hrs. Terms are personalized for each business so I suggest applying to find out exactly how much you can get on various terms. \r\n \r\nThis is a free service from a qualified lender and the approval will be based on the annual revenue of your business. These funds are Non-Restrictive, allowing you to spend the full amount in any way you require including business debt consolidation, hiring, marketing, or Absolutely Any Other expense. \r\n \r\nIf you need fast and easy business funding take a look at these programs now as there is limited availability: \r\n \r\nhttp://YourBusinessFundingNow.com/?id=124 \r\n \r\nHave a great day, \r\nThe Your Business Funding Now Team \r\n \r\nunsubscribe/remove - http://yourbusinessfundingnow.com/r.php?url=theglitzworld.com&id=e178', '', '', 0, 1),
(40, 'JosephIntow', 0, '', 'af.antocrespo@consultant.com', '86952824314', 'Dear friend, \r\n \r\nMy names are Mr. Razali Rubin Nawawi, a Malaysian lawyer base in Kuala Lumpur - Malaysia. I have previously sent you an email regarding a transaction of US$9.2 Million left behind by my late client before his tragic death. \r\n \r\nHowever, I am contacting you once again because after going through your profile, I strongly believe that you will be in a better position to execute this business transaction with me. Please if you are interested to proceed with me, kindly respond to my email urgently for more detail. \r\n \r\nThis transaction is 100% risk free and I Look forward to your response. \r\n \r\nRegards, \r\nMr. Razali Rubin Nawawi \r\nEmail: info@razalinawawiassociates.com-my.com \r\nTelephone: 011 601 760 41 490', '', '', 0, 1),
(41, 'Ultimate', 0, '', 'noreply@get-more-leads-now.com', '346-851-5428', 'Hi, would you like more business leads at a lower cost? Currently http://Get-More-Leads-Now.com is offering our popular unlimited lead generation software package - at a reduced price for a limited time. \r\n \r\nDownload and install now to be building databases of leads in minutes: \r\n \r\nhttp://Get-More-Leads-Now.com \r\n \r\nThe Ultimate Lead Generation Pack works by automatically visting yellow page directories and building a database according to your search terms. Other software in the pack then finds emails, phone numbers, and other details for that database. The results can be used for email, cold-calling, direct mail, or to sell immediately - priced per lead. Runs on Windows, Mac, and Linux with multiple job and VPN/proxy support. Similar software retails for over $100 with less features. \r\n \r\nThis pack is only available on sale as a short promotional offer, please download now if at all interested. \r\n \r\nClick Here: http://Get-More-Leads-Now.com \r\n \r\nHave a Great Day, \r\nThe Ultimate Lead Generation Pack Team \r\n \r\nunsubscribe/remove Here: http://get-more-leads-now.com/r.php?url=theglitzworld.com&id=ulg14e', '', '', 0, 1),
(42, 'BenitoAcads', 0, '', 'cbu@cyberdude.com', '85353633153', 'Hi dealskraft.com admin, \r\n \r\n \r\nSee, ClickBank is going to BREAK the Internet. \r\nTheyâ€™re doing something SO CRAZY, it might just tear the Internet at its seams. \r\n \r\nInstead of selling our 3-Part â€œClickBank Breaks The Internetâ€ Extravaganza Seriesâ€¦ Theyâ€™re giving it to you at no cost but you need to get it now or it will be gone! \r\n \r\nWatch Top Online Earners Reveal How They Can Make THOUSANDS IN JUST HOURS: https://millionairesfilm.com \r\n \r\nHereâ€™s to kicking off the Fall season right!', '', '', 0, 1),
(43, 'Kevinref', 0, '', 'rodgerblate@outlook.com', '87713761926', 'hi there \r\nI have just checked dealskraft.com for the ranking keywords and to see your SEO metrics and found that you website could use a boost. \r\n \r\nWe will improve your SEO metrics and ranks organically and safely, using only whitehat methods \r\n \r\nPlease check our pricelist here, we offer SEO at cheap rates. \r\nhttps://www.hilkom-digital.de/cheap-seo-packages/ \r\n \r\nStart boosting your business sales and leads with us, today! \r\n \r\nregards \r\nHilkom Digital Team \r\nsupport@hilkom-digital.de', '', '', 0, 1),
(44, 'Ultimate', 0, '', 'noreply@get-more-leads-now.com', '944-198-6433', 'Hi, would you like more business leads at a lower cost? Currently http://Get-More-Leads-Now.com is offering our popular unlimited lead generation software package - at a reduced price for a limited time. \r\n \r\nDownload and install now to be building databases of leads in minutes: \r\n \r\nhttp://Get-More-Leads-Now.com \r\n \r\nThe Ultimate Lead Generation Pack works by automatically visting yellow page directories and building a database according to your search terms. Other software in the pack then finds emails, phone numbers, and other details for that database. The results can be used for email, cold-calling, direct mail, or to sell immediately - priced per lead. Runs on Windows, Mac, and Linux with multiple job and VPN/proxy support. Similar software retails for over $100 with less features. \r\n \r\nThis pack is only available on sale as a short promotional offer, please download now if at all interested. \r\n \r\nClick Here: http://Get-More-Leads-Now.com \r\n \r\nHave a Great Day, \r\nThe Ultimate Lead Generation Pack Team \r\n \r\nunsubscribe/remove Here: http://get-more-leads-now.com/r.php?url=theglitzworld.com&id=ulg15', '', '', 0, 1),
(45, 'RobertTic', 0, '', 'robertCon@gmail.com', '83344478212', 'Get + 10% of personal investments! \r\nThe period of waiting for profit is only 2 days! \r\nMultilevel incentive system - big bonuses! International Fund \"Crypto MMM\" \r\n \r\nregistration on the official website: \r\nhttps://www.crypto-mmm.com/?source=engbtc \r\n', '', '', 0, 1),
(46, 'Zara Hamlin', 0, '', 'zara.hamlin@gmail.com', '05.31.44.31.77', 'Hello\r\n\r\nI would like to give you my coupons, i do not use them anyway,\r\nhttp://item.pictures/vipcoupons\r\nhave fun shopping.\r\n\r\ngreetings\r\n\r\n\"Sent from my iPhone\"', '', '', 0, 1),
(47, 'YourBusinessFundingNow', 0, '', 'noreply@your-business-funding-now.info', '', 'Hi, letting you know that http://Your-Business-Funding-Now.info?url=theglitzworld.com can find your business a SBA or private loan for $2,000 - $350K Without high credit or collateral. \r\n \r\nFind Out how much you qualify for by clicking here: \r\n \r\nhttp://Your-Business-Funding-Now.info?url=theglitzworld.com \r\n \r\nMinimum requirements include your company being established for at least a year and with current gross revenue of at least 120K. Eligibility and funding can be completed in as fast as 48hrs. Terms are personalized for each business so I suggest applying to find out exactly how much you can get on various terms. \r\n \r\nThis is a free service from a qualified lender and the approval will be based on the annual revenue of your business. These funds are Non-Restrictive, allowing you to spend the full amount in any way you require including business debt consolidation, hiring, marketing, or Absolutely Any Other expense. \r\n \r\nIf you need fast and easy business funding take a look at these programs now as there is limited availability: \r\n \r\nhttp://Your-Business-Funding-Now.info?url=theglitzworld.com \r\n \r\nHave a great day, \r\nThe Your Business Funding Now Team \r\n \r\nunsubscribe/remove - http://your-business-funding-now.info/r.php?url=theglitzworld.com&id=e180', '', '', 0, 1),
(48, 'AveryDooff', 0, '', 'raphaeCace@gmail.com', '86124829336', 'Hi!  dealskraft.com \r\n \r\nHave you ever heard of sending messages via feedback forms? \r\n \r\nImagine that your offer will be readseen by hundreds of thousands of your probable future userscustomers. \r\nYour message will not go to the spam folder because people will send the message to themselves. As an example, we have sent you our offer  in the same way. \r\n \r\nWe have a database of more than 35 million sites to which we can send your message. Sites are sorted by country. Unfortunately, you can only select a country when sending a letter. \r\n \r\nThe cost of one million messages 49 USD. \r\nThere is a discount program when you buy  more than two million message packages. \r\n \r\n \r\nFree test mailing of 50,000 messages to any country of your selection. \r\n \r\n(We also provide other services. \r\n1. Mailing email message to corporate addresses of any country \r\n2. Selling the email database of any country in the world) \r\n \r\nThis offer is created automatically. Please use the contact details below to contact us. \r\n \r\n \r\n \r\nContact us. \r\nTelegram - @FeedbackFormEU \r\nSkype  FeedbackForm2019 \r\nEmail - feedbackform@make-success.com', '', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faq`
--

CREATE TABLE `tbl_faq` (
  `id` int(11) NOT NULL,
  `faq_cat` varchar(255) DEFAULT NULL,
  `question` text,
  `answer` text,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_faq`
--

INSERT INTO `tbl_faq` (`id`, `faq_cat`, `question`, `answer`, `status`) VALUES
(1, '1', 'Why do we use it\r\n', '<p style=\"text-align:justify\"><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p>&nbsp;</p>\r\n', 1),
(2, '2', 'What is Lorem Ipsum', '<p style=\"text-align:justify\"><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p>&nbsp;</p>\r\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faqcat`
--

CREATE TABLE `tbl_faqcat` (
  `id` int(11) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_faqcat`
--

INSERT INTO `tbl_faqcat` (`id`, `category`, `status`) VALUES
(1, 'Prelims Category', 1),
(2, 'Prelims1 Category', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_features`
--

CREATE TABLE `tbl_features` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `feature_value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fiesta_banner`
--

CREATE TABLE `tbl_fiesta_banner` (
  `id` int(11) NOT NULL,
  `title_en` varchar(500) DEFAULT NULL,
  `title_ar` varchar(500) DEFAULT NULL,
  `short_description_en` text NOT NULL,
  `short_description_ar` text NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `price` double(10,2) NOT NULL,
  `target_url` text,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_fiesta_banner`
--

INSERT INTO `tbl_fiesta_banner` (`id`, `title_en`, `title_ar`, `short_description_en`, `short_description_ar`, `photo`, `price`, `target_url`, `status`) VALUES
(1, 'Bose Bluetooth Wireless Headphones', 'Ø¨ÙØ³ Ø¨Ù„ÙˆØªÙˆØ« ÙˆÙŠØ±Ù„Ø¹Ø³ Ø­Ø¹Ù¹ÙÙÙ†', 'Crisp powerful sound from the best sounding wireless headphone in its class', 'ØµÙˆØª Ù‚ÙˆÙŠ ÙˆØ§Ø¶Ø­ Ù…Ù† Ø£ÙØ¶Ù„ Ø³Ù…Ø§Ø¹Ø§Øª Ø±Ø£Ø³ Ù„Ø§Ø³Ù„ÙƒÙŠØ© ÙÙŠ ØµÙÙ‡Ø§', '1547210837headphone.png', 260.50, 'http://122.176.54.2/development/dev2016/phpdevelopment/yourExpress/details/bose-bluetooth-wireless-headphones', 1),
(2, 'Bose Bluetooth Wireless Headphones', 'weewewe', 'adsf', 'cxvv', '1547449480maruti-suzuki-baleno.jpg', 300.00, 'http://122.176.54.2/development/dev2016/phpdevelopment/yourExpress/details/bose-bluetooth-wireless-headphones', 1),
(3, 'sony LED table', 'Ø·Ø§ÙˆÙ„Ø© Ø³ÙˆÙ†ÙŠ', '20 W Speaker Output\r\n1366 x 768 HD Ready - Great picture quality\r\n60 Hz : Standard refresh rate for blur-free picture quality\r\n3 x HDMI : For set top box, consoles and Blu-ray players\r\n2 x USB : Easily connect your digital camera, camcorder or USB device', '20 ÙˆØ§Ø· Ø¥Ø®Ø±Ø§Ø¬ Ù…ÙƒØ¨Ø± Ø§Ù„ØµÙˆØª\r\n1366 x 768 HD Ø¬Ø§Ù‡Ø² - Ø¬ÙˆØ¯Ø© ØµÙˆØ±Ø© Ø±Ø§Ø¦Ø¹Ø©\r\n60 Ù‡Ø±ØªØ²: Ù…Ø¹Ø¯Ù„ ØªØ­Ø¯ÙŠØ« Ù‚ÙŠØ§Ø³ÙŠ Ù„Ø¬ÙˆØ¯Ø© Ø§Ù„ØµÙˆØ±Ø© Ø®Ø§Ù„ÙŠØ© Ù…Ù† Ø§Ù„ØªØ´ÙˆÙŠØ´\r\n3 x HDMI: Ø¨Ø§Ù„Ù†Ø³Ø¨Ø© Ù„Ø¬Ù‡Ø§Ø² ÙÙƒ Ø§Ù„ØªØ´ÙÙŠØ± ÙˆÙˆØ­Ø¯Ø§Øª Ø§Ù„ØªØ­ÙƒÙ… ÙˆÙ…Ø´ØºÙ„Ø§Øª Blu-ray\r\n2 Ã— USB: ÙŠÙ…ÙƒÙ†Ùƒ ØªÙˆØµÙŠÙ„ Ø§Ù„ÙƒØ§Ù…ÙŠØ±Ø§ Ø§Ù„Ø±Ù‚Ù…ÙŠØ© Ø£Ùˆ ÙƒØ§Ù…ÙŠØ±Ø§ Ø§Ù„ÙÙŠØ¯ÙŠÙˆ Ø£Ùˆ Ø¬Ù‡Ø§Ø² USB Ø¨Ø³Ù‡ÙˆÙ„Ø©', '1549602680samsung_un40j6200afxza_j6200_series_40_class_full_1122034.jpg', 25000.00, 'https://www.amazon.in/gp/product/B0742JCJYZ/ref=s9_acsd_al_bw_c_x_1_w?pf_rd_m=A1K21FY43GMZF8&pf_rd_s=merchandised-search-5&pf_rd_r=3PZ42PTQPYA5J92C199Q&pf_rd_t=101&pf_rd_p=bb70afd5-e389-49f7-b62c-c9a03c37fbf8&pf_rd_i=5903486031', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_images`
--

CREATE TABLE `tbl_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `color_id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_news`
--

CREATE TABLE `tbl_news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text,
  `photo` varchar(255) DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_news`
--

INSERT INTO `tbl_news` (`id`, `title`, `slug`, `content`, `photo`, `status`) VALUES
(1, 'Technology', 'technology', '<p><strong>Lorem Ipsum</strong><span style=\"color:rgb(0, 0, 0); font-family:open sans,arial,sans-serif; font-size:14px\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</span></p>\r\n', '1540987522download (1).jpeg', 1),
(2, 'Entertaiment, Technology', 'entertaiment-technology', '<p><span style=\"color:rgb(0, 0, 0); font-family:open sans,arial,sans-serif; font-size:14px\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like)</span></p>\r\n', '1540987532gettyimages-976728880.jpg', 1),
(3, 'Life Style, Others', 'life-style-others', '<p><span style=\"color:rgb(0, 0, 0); font-family:open sans,arial,sans-serif; font-size:14px\">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc</span></p>\r\n', '1540987543hang-time-knotts-berry-farm-NEWRIDES0118.jpg', 1),
(5, 'abc', 'abc', '<p>dfgdg gdfgf</p>\r\n', '154746242053110049.cms', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_newsletter`
--

CREATE TABLE `tbl_newsletter` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subscribe_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_newsletter`
--

INSERT INTO `tbl_newsletter` (`id`, `email`, `subscribe_date`, `status`) VALUES
(1, 'stacyrichards95@gmail.com', '0000-00-00 00:00:00', 0),
(2, 'tamud@web.de', '0000-00-00 00:00:00', 0),
(3, 'tamud@web.de', '0000-00-00 00:00:00', 0),
(4, 'prtort@cox.net', '0000-00-00 00:00:00', 0),
(5, 'pruzzo7373@gmail.com', '0000-00-00 00:00:00', 0),
(6, 'bellemar@comcast.net', '0000-00-00 00:00:00', 0),
(7, 'jannahuber@gmail.com', '0000-00-00 00:00:00', 0),
(8, 'm-habis@hotmail.com', '0000-00-00 00:00:00', 0),
(9, 'm40@finz.ch', '0000-00-00 00:00:00', 0),
(10, 'm40@finz.ch', '0000-00-00 00:00:00', 0),
(11, 'alicia_clucas@yahoo.co.uk', '0000-00-00 00:00:00', 0),
(12, 'ferryshana@gmail.com', '0000-00-00 00:00:00', 0),
(13, 'mbr2465@windstream.net', '0000-00-00 00:00:00', 0),
(14, 'mbr2465@windstream.net', '0000-00-00 00:00:00', 0),
(15, 'swtest2lips@gmail.com', '0000-00-00 00:00:00', 0),
(16, 'twinbaileye@gmail.com', '0000-00-00 00:00:00', 0),
(17, 'lcollier16@cfl.rr.com', '0000-00-00 00:00:00', 0),
(18, 'hedi.boufaied@free.fr', '0000-00-00 00:00:00', 0),
(19, 'muthuchudar@gmail.com', '0000-00-00 00:00:00', 0),
(20, 'robertwillis@msn.com', '0000-00-00 00:00:00', 0),
(21, 'pg3456@aol.com', '0000-00-00 00:00:00', 0),
(22, 'gilat.orna@gmail.com', '0000-00-00 00:00:00', 0),
(23, 'ÐšÐ¾ÑÑ† https://dealskraft.com/ 1', '0000-00-00 00:00:00', 0),
(24, 'sara_oquin@hotmail.com', '0000-00-00 00:00:00', 0),
(25, 'natalie@arizonamediation.com', '0000-00-00 00:00:00', 0),
(26, 'robertwillis@msn.com', '0000-00-00 00:00:00', 0),
(27, 'jayglenn143@gmail.com', '0000-00-00 00:00:00', 0),
(28, 'fusadair@hotmail.com', '0000-00-00 00:00:00', 0),
(29, 'tiajenaebyrd@gmail.com', '0000-00-00 00:00:00', 0),
(30, 'tiajenaebyrd@gmail.com', '0000-00-00 00:00:00', 0),
(31, 'bassepe@nv.ccsd.net', '0000-00-00 00:00:00', 0),
(32, 'sanjib.org@gmail.com', '0000-00-00 00:00:00', 0),
(33, 'joe@joearras.com', '0000-00-00 00:00:00', 0),
(34, 'cm.cordova89@gmail.com', '0000-00-00 00:00:00', 0),
(35, 'mandimorgen@gmail.com', '0000-00-00 00:00:00', 0),
(36, 'jeremymarr27@cox.net', '0000-00-00 00:00:00', 0),
(37, 'christchon@gmail.com', '0000-00-00 00:00:00', 0),
(38, 'brickellleasingconsultants@camdenliving.com', '0000-00-00 00:00:00', 0),
(39, 'haileylavergne@yahoo.com', '0000-00-00 00:00:00', 0),
(40, 'brickellleasingconsultants@camdenliving.com', '0000-00-00 00:00:00', 0),
(41, 'sam@govirtualhub.com', '0000-00-00 00:00:00', 0),
(42, 'susan-johnstone@comcast.net', '0000-00-00 00:00:00', 0),
(43, 'nicki7l20@hotmail.com', '0000-00-00 00:00:00', 0),
(44, 'crespohernandez.lucia@gmail.com', '0000-00-00 00:00:00', 0),
(45, 'crespohernandez.lucia@gmail.com', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_newsletter_template`
--

CREATE TABLE `tbl_newsletter_template` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `posted_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(11) NOT NULL,
  `orderno` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `user_id` int(11) DEFAULT '0',
  `order_via` varchar(255) CHARACTER SET latin1 DEFAULT 'Website',
  `amount` double(10,2) DEFAULT '0.00',
  `discount_via` varchar(255) CHARACTER SET latin1 DEFAULT 'Coupon',
  `discount` double(10,2) DEFAULT '0.00',
  `other_discount` double(10,2) DEFAULT '0.00',
  `shipping_amount` double(10,2) DEFAULT '0.00',
  `payment_method` varchar(255) CHARACTER SET latin1 DEFAULT NULL COMMENT 'cod,payumoney,wallet,credit/debit',
  `total_amount` double(10,2) DEFAULT '0.00',
  `coupon_code` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `ship_address` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `ip` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `order_status` int(11) DEFAULT '1' COMMENT '1="New",2="Processing",3="Delivered",4="Cancelled"',
  `payment_status` int(11) DEFAULT '0',
  `delivered_user_id` int(11) DEFAULT NULL,
  `delivered_date` datetime DEFAULT NULL,
  `status` int(1) DEFAULT '1' COMMENT '1="Unpacked",2="Packed",3="Done"'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `orderno`, `user_id`, `order_via`, `amount`, `discount_via`, `discount`, `other_discount`, `shipping_amount`, `payment_method`, `total_amount`, `coupon_code`, `ship_address`, `order_date`, `ip`, `order_status`, `payment_status`, `delivered_user_id`, `delivered_date`, `status`) VALUES
(1, 'YE180120190', 12, 'Website', 1252.50, 'Coupon', 0.00, 0.00, 40.00, 'cod', 1292.50, NULL, 'M-102, New Friends Colony, Sec-23, Sanjay nagar Ghaziabad', '2019-01-18 13:09:00', NULL, 3, 1, 1, '2019-02-07 15:40:32', 1),
(3, 'YE180120191', 13, 'Website', 852.50, 'Coupon', 0.00, 0.00, 40.00, 'cod', 892.50, NULL, 'delhi', '2019-01-18 15:20:00', NULL, 3, 1, 1, '2019-07-19 21:28:00', 1),
(4, 'YE180120192', 9, 'Website', 852.50, 'Coupon', 2040.50, 0.00, 40.00, 'cod', -1148.00, 'XBX7GK', NULL, '2019-01-18 15:35:00', NULL, 4, 0, 1, '2019-02-07 15:48:25', 1),
(5, 'YE180120193', 9, 'Website', 3500.00, 'Coupon', 2476.60, 0.00, 40.00, 'cod', 1063.40, 'XBX7GK', NULL, '2019-01-18 15:59:00', NULL, 3, 1, 1, '2019-07-19 21:31:32', 1),
(6, 'YE180120194', 9, 'Website', 3302.50, 'Coupon', 2338.35, 0.00, 40.00, 'cod', 1004.15, 'XBX7GK', NULL, '2019-01-18 16:00:00', NULL, 1, 0, NULL, NULL, 1),
(7, 'YE180120195', 9, 'Website', 4818.00, 'Coupon', 3400.60, 0.00, 40.00, 'cod', 1457.40, 'XBX7GK', NULL, '2019-01-18 16:01:00', NULL, 4, 0, 1, '2019-07-19 21:32:27', 1),
(8, 'YE180120196', 0, 'Website', 1890.50, 'Coupon', 0.00, 0.00, 40.00, 'cod', 1930.50, NULL, NULL, '2019-01-18 18:37:00', NULL, 1, 0, NULL, NULL, 1),
(9, 'YE190120190', 0, 'Website', 1177.50, 'Coupon', 0.00, 0.00, 40.00, 'cod', 1217.50, NULL, NULL, '2019-01-19 12:03:00', NULL, 1, 0, NULL, NULL, 1),
(10, 'YE190120191', 13, 'Website', 725.00, 'Coupon', 0.00, 0.00, 40.00, 'cod', 765.00, NULL, 'delhi', '2019-01-19 12:05:00', NULL, 1, 0, NULL, NULL, 1),
(11, 'YE190120192', 0, 'Website', 250.00, 'Coupon', 0.00, 0.00, 40.00, 'cod', 290.00, NULL, NULL, '2019-01-19 12:11:00', NULL, 1, 0, NULL, NULL, 1),
(12, 'YE280120190', 13, 'Website', 377.50, 'Coupon', 0.00, 0.00, 40.00, 'cod', 417.50, NULL, 'delhi', '2019-01-28 13:15:00', NULL, 3, 0, 1, '2019-02-08 10:19:27', 1),
(13, 'YE300120190', 5, 'Website', 3025.00, 'Coupon', 0.00, 0.00, 40.00, 'cod', 3065.00, NULL, NULL, '2019-01-30 11:34:00', NULL, 1, 0, NULL, NULL, 1),
(14, 'YE070220190', 23, 'Website', 3082.50, 'Coupon', 0.00, 0.00, 40.00, 'cod', 3122.50, NULL, '1234', '2019-02-07 10:39:00', NULL, 1, 0, NULL, NULL, 1),
(15, 'YE070220191', 23, 'Website', 900.00, 'Coupon', 0.00, 0.00, 40.00, 'cod', 940.00, NULL, '1234', '2019-02-07 12:53:00', NULL, 1, 0, NULL, NULL, 1),
(16, 'YE070220192', 23, 'Website', 7200.00, 'Coupon', 0.00, 0.00, 40.00, 'cod', 7240.00, NULL, '1234', '2019-02-07 15:02:00', NULL, 1, 0, NULL, NULL, 1),
(17, 'YE070220193', 23, 'Website', 1800.00, 'Coupon', 0.00, 0.00, 40.00, 'cod', 1840.00, NULL, '1234', '2019-02-07 15:25:00', NULL, 1, 0, NULL, NULL, 1),
(18, 'YE070220194', 0, 'Website', 400.00, 'Coupon', 0.00, 0.00, 35.00, 'cod', 435.00, NULL, NULL, '2019-02-07 17:55:00', NULL, 1, 0, NULL, NULL, 1),
(19, 'YE080220190', 30, 'Website', 14216.40, 'Coupon', 0.00, 0.00, 35.00, 'cod', 14251.40, NULL, 'noida', '2019-02-08 13:30:00', NULL, 1, 0, NULL, NULL, 1),
(20, 'YE080220191', 13, 'Website', 3500.00, 'Coupon', 0.00, 0.00, 35.00, 'cod', 3535.00, NULL, 'delhi', '2019-02-08 13:34:00', NULL, 1, 0, NULL, NULL, 1),
(21, 'YE080220192', 13, 'Website', 980.00, 'Coupon', 0.00, 0.00, 35.00, 'cod', 1015.00, NULL, 'delhi', '2019-02-08 13:35:00', NULL, 1, 0, NULL, NULL, 1),
(22, 'YE080220193', 33, 'Website', 1252.50, 'Coupon', 0.00, 0.00, 35.00, 'cod', 1287.50, NULL, 'noida', '2019-02-08 13:39:00', NULL, 1, 0, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_comments`
--

CREATE TABLE `tbl_order_comments` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT '0',
  `order_status` int(11) DEFAULT '0',
  `comments` text,
  `posted_date` datetime DEFAULT NULL,
  `posted_by` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order_comments`
--

INSERT INTO `tbl_order_comments` (`id`, `order_id`, `order_status`, `comments`, `posted_date`, `posted_by`) VALUES
(1, 1, 3, 'Test', '2018-12-26 15:36:14', 17),
(2, 1, 3, 'Test', '2018-12-26 15:51:14', 17),
(3, 1, 3, 'Test', '2018-12-26 15:55:33', 17),
(4, 2, 4, 'Test', '2018-12-26 16:22:15', 17),
(5, 3, 1, 'Test', '2018-12-26 16:49:08', 17),
(6, 8, 1, 'dfhff', '2019-01-14 12:24:58', 17),
(7, 6, 3, NULL, '2019-01-14 12:27:51', 17),
(8, 7, 3, NULL, '2019-01-14 12:28:47', 17),
(9, 6, 4, NULL, '2019-01-14 12:29:14', 17),
(10, 1, 3, 'test', '2019-02-07 15:40:32', 1),
(11, 4, 4, 'test', '2019-02-07 15:48:25', 1),
(12, 12, 3, NULL, '2019-02-08 10:19:27', 1),
(0, 3, 3, NULL, '2019-07-19 21:28:00', 1),
(0, 5, 2, 'demo', '2019-07-19 21:29:22', 1),
(0, 5, 3, 'demo', '2019-07-19 21:31:32', 1),
(0, 7, 4, 'demo', '2019-07-19 21:32:27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_itmes`
--

CREATE TABLE `tbl_order_itmes` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT '0',
  `product_id` int(11) DEFAULT '0',
  `price_id` int(11) DEFAULT '0',
  `product_name` varchar(255) DEFAULT NULL,
  `price` double(10,2) DEFAULT '0.00',
  `qty` int(11) DEFAULT '0',
  `cdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT '0' COMMENT '0="OutStock",1="InStock",2="ReadyDelivered", 3="Cancel",4="Delivered",5="Back"'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order_itmes`
--

INSERT INTO `tbl_order_itmes` (`id`, `order_id`, `product_id`, `price_id`, `product_name`, `price`, `qty`, `cdate`, `status`) VALUES
(1, 1, 1, 1, 'crocks', 127.50, 1, '2019-01-18 07:39:58', 1),
(2, 1, 2, 39, 'Red Bull', 475.00, 1, '2019-01-18 07:39:58', 0),
(3, 1, 3, 4, 'NIOCITRAN', 250.00, 1, '2019-01-18 07:39:58', 1),
(4, 1, 4, 6, 'Hiball Energy ', 400.00, 1, '2019-01-18 07:39:58', 1),
(5, 3, 1, 1, 'crocks', 127.50, 1, '2019-01-18 09:50:40', 1),
(6, 3, 2, 39, 'Red Bull', 475.00, 1, '2019-01-18 09:50:40', 0),
(7, 3, 3, 4, 'NIOCITRAN', 250.00, 1, '2019-01-18 09:50:40', 1),
(8, 4, 2, 39, 'Red Bull', 475.00, 1, '2019-01-18 10:05:16', 0),
(9, 4, 1, 1, 'crocks', 127.50, 1, '2019-01-18 10:05:16', 1),
(10, 4, 3, 4, 'NIOCITRAN', 250.00, 1, '2019-01-18 10:05:16', 1),
(11, 5, 2, 39, 'Red Bull', 475.00, 1, '2019-01-18 10:29:39', 0),
(12, 5, 3, 4, 'NIOCITRAN', 250.00, 1, '2019-01-18 10:29:39', 1),
(13, 5, 4, 6, 'Hiball Energy ', 400.00, 1, '2019-01-18 10:29:39', 1),
(14, 5, 6, 8, 'roti maker', 2375.00, 1, '2019-01-18 10:29:39', 1),
(15, 6, 4, 6, 'Hiball Energy ', 400.00, 2, '2019-01-18 10:30:50', 1),
(16, 6, 6, 8, 'roti maker', 2375.00, 1, '2019-01-18 10:30:50', 1),
(17, 6, 1, 1, 'crocks', 127.50, 1, '2019-01-18 10:30:50', 1),
(18, 7, 1, 1, 'crocks', 127.50, 1, '2019-01-18 10:31:55', 1),
(19, 7, 4, 6, 'Hiball Energy ', 400.00, 1, '2019-01-18 10:31:55', 1),
(20, 7, 5, 7, 'body lotion', 1425.00, 1, '2019-01-18 10:31:55', 1),
(21, 7, 6, 8, 'roti maker', 2375.00, 1, '2019-01-18 10:31:55', 1),
(22, 7, 7, 9, 'Foundation', 490.50, 1, '2019-01-18 10:31:55', 1),
(23, 8, 7, 9, 'Foundation', 490.50, 1, '2019-01-18 13:07:45', 1),
(24, 8, 4, 6, 'Hiball Energy ', 400.00, 1, '2019-01-18 13:07:45', 1),
(25, 8, 3, 4, 'NIOCITRAN', 250.00, 4, '2019-01-18 13:07:45', 1),
(26, 9, 1, 1, 'crocks', 127.50, 1, '2019-01-19 06:33:25', 1),
(27, 9, 3, 4, 'NIOCITRAN', 250.00, 1, '2019-01-19 06:33:25', 1),
(28, 9, 4, 6, 'Hiball Energy ', 400.00, 2, '2019-01-19 06:33:25', 1),
(29, 10, 2, 39, 'Red Bull', 475.00, 1, '2019-01-19 06:35:13', 0),
(30, 10, 3, 4, 'NIOCITRAN', 250.00, 1, '2019-01-19 06:35:13', 1),
(31, 11, 3, 4, 'NIOCITRAN', 250.00, 1, '2019-01-19 06:41:54', 1),
(32, 12, 3, 4, 'watch', 250.00, 1, '2019-01-28 07:45:51', 1),
(33, 12, 1, 1, 'crocks', 127.50, 1, '2019-01-28 07:45:51', 1),
(34, 13, 6, 8, 'roti maker', 2375.00, 1, '2019-01-30 06:04:30', 1),
(35, 13, 4, 6, 'Hiball Energy ', 400.00, 1, '2019-01-30 06:04:30', 1),
(36, 13, 3, 4, 'watch', 250.00, 1, '2019-01-30 06:04:30', 1),
(37, 14, 20, 58, 'No cost EMI â‚¹501/month. Standard EMI also availableView Plans  Bank OfferExtra 5% off* with Axis Bank Buzz Credit CardT&C', 2700.00, 1, '2019-02-07 05:09:41', 0),
(38, 14, 1, 1, 'crocks', 127.50, 3, '2019-02-07 05:09:41', 1),
(39, 15, 21, 59, 'tshirt', 900.00, 1, '2019-02-07 07:23:29', 0),
(40, 16, 21, 59, 'tshirt', 900.00, 5, '2019-02-07 09:32:52', 0),
(41, 16, 20, 58, 'No cost EMI â‚¹501/month. Standard EMI also availableView Plans  Bank OfferExtra 5% off* with Axis Bank Buzz Credit CardT&C', 2700.00, 1, '2019-02-07 09:32:52', 0),
(42, 17, 21, 59, 'tshirt', 900.00, 2, '2019-02-07 09:55:31', 0),
(43, 18, 4, 6, 'Hiball Energy ', 400.00, 1, '2019-02-07 12:25:54', 1),
(44, 19, 2, 39, 'Red Bull', 475.00, 2, '2019-02-08 08:00:14', 0),
(45, 19, 3, 4, 'watch', 250.00, 2, '2019-02-08 08:00:14', 1),
(46, 19, 4, 6, 'wrist watch', 400.00, 2, '2019-02-08 08:00:14', 1),
(47, 19, 6, 8, 'roti maker', 2375.00, 1, '2019-02-08 08:00:14', 1),
(48, 19, 5, 7, 'body lotion', 1425.00, 1, '2019-02-08 08:00:14', 1),
(49, 19, 8, 10, 'gel', 410.40, 1, '2019-02-08 08:00:14', 1),
(50, 19, 9, 11, 'lipistic', 7756.00, 1, '2019-02-08 08:00:14', 1),
(51, 20, 2, 39, 'Red Bull', 475.00, 1, '2019-02-08 08:04:16', 0),
(52, 20, 3, 4, 'watch', 250.00, 1, '2019-02-08 08:04:16', 1),
(53, 20, 4, 6, 'wrist watch', 400.00, 1, '2019-02-08 08:04:16', 1),
(54, 20, 6, 8, 'roti maker', 2375.00, 1, '2019-02-08 08:04:16', 1),
(55, 21, 1, 1, 'roti maker', 127.50, 2, '2019-02-08 08:05:19', 1),
(56, 21, 2, 39, 'Red Bull', 475.00, 1, '2019-02-08 08:05:19', 0),
(57, 21, 3, 4, 'watch', 250.00, 1, '2019-02-08 08:05:19', 1),
(58, 22, 1, 1, 'roti maker', 127.50, 1, '2019-02-08 08:09:32', 1),
(59, 22, 2, 39, 'Red Bull', 475.00, 1, '2019-02-08 08:09:32', 0),
(60, 22, 3, 4, 'watch', 250.00, 1, '2019-02-08 08:09:32', 1),
(61, 22, 4, 6, 'wrist watch', 400.00, 1, '2019-02-08 08:09:32', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_status`
--

CREATE TABLE `tbl_order_status` (
  `id` int(11) NOT NULL,
  `order_status` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order_status`
--

INSERT INTO `tbl_order_status` (`id`, `order_status`, `status`) VALUES
(1, 'New', 1),
(2, 'Processing', 1),
(3, 'Delivered', 1),
(4, 'Cancelled', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_photo`
--

CREATE TABLE `tbl_photo` (
  `id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `cat_id` int(11) NOT NULL,
  `subcat_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `product_code` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `short_description` text NOT NULL,
  `description` text NOT NULL,
  `meta_tags` text NOT NULL,
  `latest` int(11) NOT NULL,
  `new_release` int(2) DEFAULT NULL,
  `display_order` int(11) NOT NULL DEFAULT '20',
  `posted_by` int(11) NOT NULL,
  `posted_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `material` varchar(100) DEFAULT NULL,
  `min_quantity` varchar(20) DEFAULT NULL,
  `packaing_detail` varchar(50) DEFAULT NULL,
  `size_of_peice` varchar(10) DEFAULT NULL,
  `cartion_box` varchar(50) DEFAULT NULL,
  `vendor` varchar(100) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `sub_category` varchar(100) DEFAULT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `mrp` int(6) DEFAULT NULL,
  `actual_price` int(6) DEFAULT NULL,
  `discount` int(6) DEFAULT NULL,
  `sell_price` int(6) DEFAULT NULL,
  `info_care` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `vendor_id`, `cat_id`, `subcat_id`, `brand_id`, `product_name`, `slug`, `product_code`, `photo`, `short_description`, `description`, `meta_tags`, `latest`, `new_release`, `display_order`, `posted_by`, `posted_date`, `status`, `material`, `min_quantity`, `packaing_detail`, `size_of_peice`, `cartion_box`, `vendor`, `category`, `sub_category`, `brand`, `mrp`, `actual_price`, `discount`, `sell_price`, `info_care`) VALUES
(4, 1, 1, 2, 1, 'SHOWER GEL MUSCLE RELAXANT - NO SULFATE', 'shower-gel-muscle-relaxant-no-sulfate', 'Zobha-08', '01.jpg', 'kjkk', '', 'jkjk', 1, 1, 2, 1, '2019-11-11 18:14:07', 1, '121', '32', '323', '32', '232', 'Jatin Malhotra', 'Mobiles, Computers', 'All Mobile Accessories', 'Dealskraft', 100, 100, 10, 90, ''),
(3, 1, 1, 2, 1, 'SHOWER GEL MUSCLE RELAXANT - NO SULFATE', 'ytyt', 'Zobha-08', 'Rajeev.png', 'eee', 'eee', 'ee', 1, 1, 2, 0, '0000-00-00 00:00:00', 1, '121', '32', '323', '32', '232', 'Jatin Malhotra', 'Mobiles, Computers', 'All Mobile Accessories', 'Dealskraft', 100, 100, 10, 90, 'erer');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_productprice`
--

CREATE TABLE `tbl_productprice` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(255) NOT NULL,
  `unit_id` int(2) DEFAULT NULL,
  `color` varchar(50) NOT NULL,
  `actual_price` double NOT NULL,
  `mrp_price` double NOT NULL,
  `discount` double NOT NULL,
  `sell_price` double NOT NULL,
  `in_stock` tinyint(4) NOT NULL,
  `totqty` int(11) NOT NULL,
  `instockqty` int(11) NOT NULL,
  `pphoto` varchar(255) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `barcode_number` varchar(255) NOT NULL,
  `video` text NOT NULL,
  `display_order` int(11) NOT NULL DEFAULT '5',
  `last_updated_by` int(11) DEFAULT NULL,
  `last_update_date` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_productprice`
--

INSERT INTO `tbl_productprice` (`id`, `product_id`, `size`, `unit_id`, `color`, `actual_price`, `mrp_price`, `discount`, `sell_price`, `in_stock`, `totqty`, `instockqty`, `pphoto`, `barcode`, `barcode_number`, `video`, `display_order`, `last_updated_by`, `last_update_date`, `status`) VALUES
(4, 4, '1', 1, '1', 90, 100, 5, 95, 0, 1, 0, '9721573476247.jpg', '', '', '', 5, 1, '2019-11-12 10:59:19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_psizes`
--

CREATE TABLE `tbl_psizes` (
  `id` int(11) NOT NULL,
  `psize` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_recommended`
--

CREATE TABLE `tbl_recommended` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `recommended` varchar(500) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_review`
--

CREATE TABLE `tbl_review` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `comments` text NOT NULL,
  `rating` int(2) NOT NULL,
  `posted_date` varchar(100) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `id` int(11) NOT NULL,
  `landline` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `minimum_purchase` double NOT NULL,
  `delivery_charge` double NOT NULL,
  `rewardamount` double NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_setting`
--

INSERT INTO `tbl_setting` (`id`, `landline`, `mobile`, `minimum_purchase`, `delivery_charge`, `rewardamount`, `email`, `address`, `status`) VALUES
(1, '', '8898898119', 0, 0, 0, 'jatin@dealskraft.com', 'DealsKrafts\r\nKarol Bagh,\r\nNew Delhi', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shipping_method`
--

CREATE TABLE `tbl_shipping_method` (
  `id` int(11) NOT NULL,
  `shipping_method` varchar(255) NOT NULL,
  `ship_price` double NOT NULL,
  `ship_days` int(11) NOT NULL,
  `default_val` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_social`
--

CREATE TABLE `tbl_social` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `social_url` text NOT NULL,
  `show_front` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_social`
--

INSERT INTO `tbl_social` (`id`, `title`, `social_url`, `show_front`, `status`) VALUES
(1, 'Facebook', 'https://www.facebook.com/', 0, 1),
(2, 'Twitter', 'https://twitter.com/', 0, 1),
(3, 'You Tube', 'https://www.youtube.com/', 0, 1),
(4, 'Pinterest', 'https://www.pinterest.com/', 0, 1),
(5, 'Google+', 'https://plus.google.com/', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock`
--

CREATE TABLE `tbl_stock` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price_id` int(11) NOT NULL,
  `totqty` int(11) DEFAULT NULL,
  `type` enum('Cr','Dr') DEFAULT NULL,
  `cdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_stock`
--

INSERT INTO `tbl_stock` (`id`, `product_id`, `price_id`, `totqty`, `type`, `cdate`, `status`) VALUES
(2, 1, 1, 15, 'Cr', '2019-03-22 17:48:00', 1),
(3, 2, 2, 10, 'Cr', '2019-03-25 16:43:48', 1),
(4, 1, 1, 1, 'Dr', '2019-07-19 15:58:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subcategory`
--

CREATE TABLE `tbl_subcategory` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `subcategory` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `cimage` varchar(255) DEFAULT NULL,
  `meta_tags` blob NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_subcategory`
--

INSERT INTO `tbl_subcategory` (`id`, `cat_id`, `subcategory`, `slug`, `cimage`, `meta_tags`, `status`) VALUES
(1, 1, 'All Mobile Phones', 'all-mobile-phones', '4091553237830.jpg', '', 1),
(2, 1, 'All Mobile Accessories', 'all-mobile-accessories', '', '', 1),
(3, 1, 'Cases & Covers', '', '', '', 1),
(4, 1, 'Screen Protectors', '', '', '', 1),
(5, 1, 'Power Banks', '', '', '', 1),
(6, 1, 'Tablets', 'tablets', '', '', 1),
(7, 1, 'Software', '', '', '', 1),
(8, 1, 'All Computers & Accessories', '', '', '', 1),
(9, 1, 'Laptops', '', '', '', 1),
(10, 1, 'Drives & Storage', '', '', '', 1),
(11, 1, 'Printers & Ink', '', '', '', 1),
(12, 1, 'Networking Devices', '', '', '', 1),
(13, 1, 'Computer Accessories', '', '', '', 1),
(14, 1, 'Game Zone', '', '', '', 1),
(15, 1, 'Monitors', '', '', '', 1),
(16, 1, 'Desktops', '', '', '', 1),
(17, 1, 'Components', '', '', '', 1),
(18, 1, 'All Electronics', '', '', '', 1),
(19, 2, 'Televisions', '', '', '', 1),
(20, 2, 'Home Entertainment Systems', '', '', '', 1),
(21, 2, 'Headphones', '', '', '', 1),
(22, 2, 'Speakers', '', '', '', 1),
(23, 2, 'Home Audio & Theater', '', '', '', 1),
(24, 2, 'Cameras', '', '', '', 1),
(25, 2, 'DSLR Cameras', '', '', '', 1),
(26, 2, 'Security Cameras', '', '', '', 1),
(27, 2, 'Camera Accessories', '', '', '', 1),
(28, 2, 'Musical Instruments & Professional Audio', '', '', '', 1),
(29, 2, 'Gaming Consoles', '', '', '', 1),
(30, 2, 'All Electronics', '', '', '', 1),
(31, 2, 'Air Conditioners', 'air-conditioners', '', '', 1),
(32, 2, 'Refrigerators', 'refrigerators', '', '', 1),
(33, 2, 'Washing Machines', 'washing-machines', '', '', 1),
(34, 2, 'Kitchen & Home Appliances', '', '', '', 1),
(35, 2, 'Heating & Cooling Appliances', '', '', '', 1),
(36, 2, 'All Appliances', '', '', '', 1),
(37, 3, 'Clothing', '', '', '', 1),
(38, 3, 'T-shirts & Polos', '', '', '', 1),
(39, 3, 'Shirts', '', '', '', 1),
(40, 3, 'Jeans', '', '', '', 1),
(41, 3, 'Innerwear', '', '', '', 1),
(42, 3, 'Watches', '', '', '', 1),
(43, 3, 'Bags & Luggage', '', '', '', 1),
(44, 3, 'Sunglasses', '', '', '', 1),
(45, 3, 'Jewellery', '', '', '', 1),
(46, 3, 'Wallets', '', '', '', 1),
(47, 3, 'Shoes', '', '', '', 1),
(48, 3, 'Sports Shoes', '', '', '', 1),
(49, 3, 'Formal Shoes', '', '', '', 1),
(50, 3, 'Casual Shoes', '', '', '', 1),
(51, 3, 'Sportswear', '', '', '', 1),
(52, 3, 'The Designer Boutique', '', '', '', 1),
(53, 4, 'Clothing', '', '', '', 1),
(54, 4, 'Western Wear', '', '', '', 1),
(55, 4, 'Ethnic Wear', '', '', '', 1),
(56, 4, 'Lingerie & Nightwear', '', '', '', 1),
(57, 4, 'Watches', '', '', '', 1),
(58, 4, 'Handbags & Clutches', '', '', '', 1),
(59, 4, 'Gold & Diamond Jewellery', '', '', '', 1),
(60, 4, 'Fashion & Silver Jewellery', '', '', '', 1),
(61, 4, 'Sunglasses', '', '', '', 1),
(62, 4, 'Shoes', '', '', '', 1),
(63, 4, 'Fashion Sandals', '', '', '', 1),
(64, 4, 'Ballerinas', '', '', '', 1),
(65, 4, 'The Designer Boutique', '', '', '', 1),
(66, 4, 'Handloom & Handicraft Store', '', '', '', 1),
(67, 4, 'Sportswear', '', '', '', 1),
(82, 6, 'Beauty & Grooming', '', '', '', 1),
(69, 5, 'Kitchen & Dining', 'kitchen-dining', '', '', 1),
(70, 5, 'Kitchen Storage & Containers', 'kitchen-storage-containers', '', '', 1),
(71, 5, 'Furniture', 'furniture', '', '', 1),
(72, 5, 'Fine Art', 'fine-art', '', '', 1),
(73, 5, 'Home Furnishing', '', '', '', 1),
(74, 5, 'Bedroom Linen', '', '', '', 1),
(75, 5, 'Home DÃ©cor', '', '', '', 1),
(76, 5, 'Garden & Outdoors', '', '', '', 1),
(77, 5, 'Home Storage', '', '', '', 1),
(78, 5, 'Indoor Lighting', '', '', '', 1),
(79, 5, 'Home Improvement', '', '', '', 1),
(80, 5, 'Sewing & Craft Supplies', '', '', '', 1),
(81, 5, 'Housekeeping & Laundry', '', '', '', 1),
(83, 6, 'Luxury Beauty', '', '', '', 1),
(84, 6, 'Make-up', '', '', '', 1),
(85, 6, 'Health & Personal Care', '', '', '', 1),
(86, 6, 'Household Supplies', '', '', '', 1),
(87, 6, 'Personal Care Appliances', '', '', '', 1),
(88, 6, 'Diet & Nutrition', '', '', '', 1),
(89, 6, 'All Grocery & Gourmet Foods', '', '', '', 1),
(90, 6, 'Coffee, Tea & Beverages', '', '', '', 1),
(91, 6, 'Snack Foods', '', '', '', 1),
(92, 7, 'Cricket', '', '', '', 1),
(93, 7, 'Badminton', '', '', '', 1),
(94, 7, 'Cycling', '', '', '', 1),
(95, 7, 'Football', '', '', '', 1),
(96, 7, 'Running', '', '', '', 1),
(97, 7, 'Camping & Hiking', '', '', '', 1),
(98, 7, 'Fitness Accessories', '', '', '', 1),
(99, 7, 'Yoga', '', '', '', 1),
(100, 7, 'Strength Training', '', '', '', 1),
(101, 7, 'Cardio Equipment', '', '', '', 1),
(102, 7, 'Sports Collectibles', '', '', '', 1),
(103, 7, 'All Exercise & Fitness', '', '', '', 1),
(104, 7, 'All Sports, Fitness & Outdoors', '', '', '', 1),
(105, 7, 'Backpacks', '', '', '', 1),
(106, 7, 'Rucksacks', '', '', '', 1),
(107, 7, 'Suitcases & Trolley Bags', '', '', '', 1),
(108, 7, 'Travel Duffles', '', '', '', 1),
(109, 7, 'Travel Accessories', '', '', '', 1),
(110, 8, 'Toys & Games', '', '', '', 1),
(111, 8, 'Baby Products', '', '', '', 1),
(112, 8, 'Diapers', '', '', '', 1),
(113, 8, 'Baby Wish List', '', '', '', 1),
(114, 8, 'Baby Bath, Skin & Grooming', '', '', '', 1),
(115, 8, 'Strollers & Prams', '', '', '', 1),
(116, 8, 'Nursing & Feeding', '', '', '', 1),
(117, 12, 'Kids\' Clothing', '', '', '', 1),
(118, 12, 'Kids\' Shoes', '', '', '', 1),
(119, 12, 'School Bags', '', '', '', 1),
(120, 12, 'Kids\' Watches', '', '', '', 1),
(121, 12, 'Kids\' Fashion', 'kids\'-fashion', '', '', 1),
(122, 8, 'Baby Fashion', '', '', '', 1),
(123, 9, 'Motorbike Accessories & Parts', '', '', '', 1),
(124, 9, 'Car Accessories', '', '', '', 1),
(125, 9, 'Car Electronics', '', '', '', 1),
(126, 9, 'Car Parts', '', '', '', 1),
(127, 9, 'Car & Bike Care', '', '', '', 1),
(128, 9, 'All Car & Motorbike Products', '', '', '', 1),
(129, 9, 'Industrial & Scientific Supplies', '', '', '', 1),
(130, 9, 'Test, Measure & Inspect', '', '', '', 1),
(131, 9, 'Lab & Scientific', '', '', '', 1),
(132, 10, 'School Stationery', '', '', '', 1),
(133, 10, 'Notebook & Daybook', '', '', '', 1),
(134, 10, 'Writing Instrument', '', '', '', 1),
(135, 10, 'File & Folders', '', '', '', 1),
(136, 10, 'Office Supplies', '', '', '', 1),
(137, 10, 'Account Supplies', '', '', '', 1),
(138, 10, 'Office Equipment', '', '', '', 1),
(139, 10, 'Consumable', '', '', '', 1),
(140, 10, 'Drawing & Art Set', '', '', '', 1),
(141, 10, 'Mapping Supplies', '', '', '', 1),
(142, 10, 'Apparatus & Materials', '', '', '', 1),
(143, 10, 'Craftwork', '', '', '', 1),
(144, 10, 'All Office Supplies', '', '', '', 1),
(145, 10, 'All Stationery', '', '', '', 1),
(146, 11, 'Apparel', '', '', '', 1),
(147, 11, 'Awards & Recognition', 'awards-recognition', '', '', 1),
(148, 11, 'Badge & Buttons', '', '', '', 1),
(149, 11, 'Calendars', '', '', '', 1),
(150, 11, 'Bags', '', '', '', 1),
(151, 11, 'Caps & Hats', '', '', '', 1),
(152, 11, 'Clock and Watches', '', '', '', 1),
(153, 11, 'Corporate Gifts', '', '', '', 1),
(154, 11, 'Desk Products', '', '', '', 1),
(155, 11, 'Drinkware', '', '', '', 1),
(156, 11, 'Key Chains', '', '', '', 1),
(157, 11, 'Luggage & Travel', '', '', '', 1),
(158, 11, 'Mugs & Glasses', '', '', '', 1),
(159, 11, 'Photo Frames', '', '', '', 1),
(160, 11, 'Diaries', '', '', '', 1),
(161, 11, 'Umbrella\'s', '', '', '', 1),
(162, 11, 'All Gifts & Promotional Products', '', '', '', 1),
(163, 13, 'Skirt123', 'Skirt', '02.jpg', 0x536b697274, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subscriber`
--

CREATE TABLE `tbl_subscriber` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subscribd_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_testimonial`
--

CREATE TABLE `tbl_testimonial` (
  `id` int(11) NOT NULL,
  `testimonial` text NOT NULL,
  `posted_by` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `posted_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_topic`
--

CREATE TABLE `tbl_topic` (
  `id` int(11) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `postedby` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `posted_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_unit`
--

CREATE TABLE `tbl_unit` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_unit`
--

INSERT INTO `tbl_unit` (`id`, `name`, `status`) VALUES
(1, 'Kilo Gram', 1),
(2, 'Grams', 1),
(3, 'ML', 1),
(4, 'Litre', 1),
(5, 'pair', 1),
(6, 'No.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `user_type` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_2` varchar(100) NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `pincode` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `contact2` varchar(100) NOT NULL,
  `country` int(11) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gst` varchar(100) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `account_no` varchar(100) DEFAULT NULL,
  `ifsccode` varchar(50) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `code` varchar(100) NOT NULL,
  `gst_copy` varchar(100) NOT NULL,
  `pan_copy` varchar(100) NOT NULL,
  `pan_number` varchar(10) NOT NULL,
  `cancle_cheque` varchar(100) NOT NULL,
  `categories` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `user_type`, `name`, `surname`, `email`, `email_2`, `contact_person`, `password`, `pincode`, `mobile`, `contact2`, `country`, `state`, `city`, `address`, `gst`, `bank_name`, `account_no`, `ifsccode`, `status`, `code`, `gst_copy`, `pan_copy`, `pan_number`, `cancle_cheque`, `categories`) VALUES
(1, 2, 'Jatin', 'Malhotra', 'jatin@dealskraft.com', '', '', '123456', '', '8898898119', '', 0, '', 'New Delhi', 'M/S. SM Trading Co.\r\n8/97, 2nd Floor,  Front Portion, \r\nDayal Ram, Opp/ Punjab & Sindh Bank,\r\nGeeta Colony,\r\nNew Delhi - 110031', '07BDUPM9337G2ZV', 'Yes Bank Ltd', '020363300001588', 'YESB0000203', 1, 'ROH1032', '', '', '', '0', ''),
(2, 0, 'Lakshya', 'Wadhera', 'coollakshya2011@gmail.com', '', '', 'chunnu12345', '', '', '', 0, '', '', '', NULL, NULL, NULL, NULL, 0, '', '', '', '', '0', ''),
(3, 2, 'Darshana', 'S', 'darshana.shegaonkar@celloworld.com', '', '', '123456', '', '9892740182', '', 0, '', 'Mumbai', 'M/S CELLO HOUSEHOLD PRODUCTS\r\nBuilding \"A,B,C\" Plot No.710,711,714 to 717\r\nSidcul, Ranipur,Somanath Road,\r\nDabhel, Daman - 396210', '25AAJFC5405C1ZY', 'HDFC Bank', '02128640000392', 'HDFC0000212', 1, 'DAR2182', '', '', '', '0', ''),
(4, 0, 'Rohit', 'Chahal', 'r.rohit.chahal@gmail.com', '', '', '123456', '', '', '', 0, '', '', '', NULL, NULL, NULL, NULL, 0, '', '', '', '', '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_useraddress`
--

CREATE TABLE `tbl_useraddress` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT '0',
  `address` text,
  `main_id` int(11) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_useraddress`
--

INSERT INTO `tbl_useraddress` (`id`, `user_id`, `address`, `main_id`, `status`) VALUES
(23, 13, 'kanpur', 0, 1),
(22, 13, 'delhi', 1, 1),
(21, 13, 'varanasi', 1, 1),
(20, 13, 'goa', 0, 1),
(19, 13, 'delhi', 0, 1),
(27, 12, 'M-102, New Friends Colony, Sec-23, Sanjay nagar Ghaziabad', 1, 1),
(28, 9, 'kanpur', 0, 1),
(29, 23, '1234', 1, 1),
(30, 18, 'LAXMI NAGAR  DELHI', 1, 1),
(31, 25, 'test', 1, 1),
(32, 30, 'noida', 0, 1),
(33, 33, 'noida', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_comments`
--

CREATE TABLE `tbl_user_comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT '0',
  `user_group` int(11) DEFAULT '0',
  `comments` text,
  `posted_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `posted_by` int(11) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_comments`
--

INSERT INTO `tbl_user_comments` (`id`, `user_id`, `user_group`, `comments`, `posted_date`, `posted_by`) VALUES
(1, 11, 0, 'test', '2017-11-28 11:42:38', 50),
(2, 11, 0, 'tt', '2017-11-28 11:43:10', 50),
(3, 2, 3, 'test', '2017-11-28 12:40:52', 50),
(4, 2, 3, 'test', '2017-11-28 12:55:22', 50),
(5, 5, 0, '', '2017-11-29 09:50:05', 50),
(6, 2, 3, 'test', '2017-11-29 10:07:17', 50),
(7, 2, 3, 'test', '2017-11-29 11:36:45', 50),
(8, 8, 2, 'good behaviour ', '2017-11-29 12:03:59', 50),
(9, 13, 10, 'good behaviour\r\n', '2017-11-29 14:58:25', 50),
(10, 5, 0, '', '2017-11-30 05:39:04', 50),
(11, 5, 0, '', '2017-11-30 05:40:11', 50),
(12, 5, 0, '', '2017-11-30 05:40:37', 50),
(13, 5, 0, '', '2017-11-30 05:40:58', 50),
(14, 11, 0, '', '2017-11-30 05:41:15', 50),
(15, 2, 3, 'test', '2017-11-30 05:42:48', 50),
(16, 18, 0, '', '2017-12-01 09:59:04', 50),
(17, 11, 0, '', '2017-12-01 10:01:40', 50),
(18, 13, 10, 'good behaviour\r\n', '2017-12-02 13:06:45', 50),
(19, 2, 3, 'test', '2017-12-05 06:01:22', 50),
(20, 11, 0, 'good behaviour\n', '2017-12-05 06:04:51', 50),
(21, 2, 3, 'test', '2017-12-08 10:17:39', 50),
(22, 6, 10, 'very good behaviour\r\n\r\n', '2017-12-12 11:09:31', 50),
(23, 1, 1, '', '2017-12-13 05:45:05', 17),
(24, 6, 10, 'very good behaviour\r\n\r\n', '2017-12-13 12:27:22', 50),
(25, 8, 2, 'good behaviour ', '2017-12-13 12:27:53', 50),
(26, 2, 3, 'test', '2017-12-13 12:28:13', 50),
(27, 5, 0, 'fhj', '2017-12-15 13:33:13', 50),
(28, 5, 0, '', '2017-12-15 13:50:53', 50),
(29, 5, 0, '', '2017-12-15 13:56:26', 50),
(30, 5, 0, '', '2017-12-15 14:01:34', 50),
(31, 2, 3, 'test', '2017-12-16 12:04:02', 50),
(32, 5, 0, 'good behaviour', '2017-12-16 12:05:31', 50),
(33, 5, 0, 'good behaviour', '2017-12-16 12:06:00', 50),
(34, 2, 3, 'test', '2017-12-20 13:01:34', 50),
(35, 10, 0, '', '2017-12-20 13:38:53', 50),
(36, 31, 10, 'Good', '2017-12-21 09:31:57', 50),
(37, 5, 0, 'done', '2017-12-28 10:37:11', 69),
(38, 5, 0, '', '2017-12-28 10:43:09', 69),
(39, 5, 0, 'test', '2017-12-28 10:49:14', 69),
(40, 100, 5, 'Good Nature', '2017-12-28 13:35:06', 69),
(41, 118, 3, 'Defaulter', '2017-12-30 05:57:04', 17),
(42, 2, 3, 'test', '2018-01-03 11:57:54', 69),
(43, 75, 0, 'good', '2018-01-04 12:48:57', 69),
(44, 26, 0, '', '2018-01-23 07:28:15', 69),
(45, 317, 0, '', '2018-01-26 08:08:42', 69),
(46, 5, 0, '', '2018-01-27 05:51:46', 69),
(47, 336, 0, '', '2018-01-30 15:25:43', 69),
(48, 336, 0, '', '2018-01-31 09:00:35', 69),
(49, 383, 0, '', '2018-01-31 10:11:08', 69),
(50, 377, 0, '', '2018-01-31 10:59:26', 69),
(51, 209, 0, '', '2018-02-01 08:03:58', 69),
(52, 406, 0, '', '2018-02-01 11:17:33', 69),
(53, 385, 0, '', '2018-02-01 11:19:04', 69),
(54, 365, 0, '', '2018-02-01 11:19:54', 69),
(55, 344, 0, '', '2018-02-01 11:56:00', 69),
(56, 388, 0, '', '2018-02-02 04:03:00', 69),
(57, 388, 0, '', '2018-02-02 13:20:36', 69),
(58, 434, 0, '', '2018-02-03 05:24:09', 69),
(59, 5, 0, 'ffjj\n', '2018-02-03 06:36:17', 69),
(60, 5, 0, 'done', '2018-02-03 06:48:13', 69),
(61, 1, 0, '', '2018-02-03 06:50:08', 1),
(62, 1, 0, '', '2018-02-03 06:52:35', 1),
(63, 5, 0, 'done', '2018-02-03 06:55:27', 69),
(64, 5, 0, 'done', '2018-02-03 06:56:27', 69),
(65, 5, 0, 'done', '2018-02-03 06:56:56', 69),
(66, 5, 0, 'done', '2018-02-03 06:57:54', 69),
(67, 5, 0, 'done', '2018-02-03 06:58:50', 69),
(68, 5, 0, 'done', '2018-02-03 06:59:30', 69),
(69, 5, 0, 'done', '2018-02-03 07:00:29', 69),
(70, 5, 0, 'done', '2018-02-03 07:04:04', 69),
(71, 5, 0, 'done', '2018-02-03 07:04:51', 69),
(72, 5, 0, 'done', '2018-02-03 07:08:30', 69),
(73, 5, 0, 'done', '2018-02-03 07:12:14', 69),
(74, 428, 0, '', '2018-02-03 10:50:03', 69),
(75, 388, 0, '', '2018-02-03 10:50:58', 69),
(76, 383, 0, '', '2018-02-03 10:52:07', 69),
(77, 355, 0, '', '2018-02-03 15:44:31', 69),
(78, 342, 0, '', '2018-02-04 09:29:49', 69),
(79, 451, 0, '', '2018-02-04 10:10:09', 69),
(80, 481, 0, '', '2018-02-07 10:17:30', 69),
(81, 480, 0, '', '2018-02-07 15:33:15', 69),
(82, 515, 0, '', '2018-02-08 10:58:56', 69),
(83, 487, 10, 'Good Behaviour, 2 Products were not delivered. refund of 117 to be credited to customers wallet.', '2018-02-08 12:33:23', 69),
(84, 505, 10, 'Good Behaviour  V & S SEA AIR LOGISTICS PVT.LTD', '2018-02-08 12:34:27', 69),
(85, 355, 0, '', '2018-02-08 18:25:11', 69),
(86, 514, 0, '', '2018-02-08 18:25:49', 69),
(87, 521, 10, 'Delivered', '2018-02-09 05:47:09', 69),
(88, 351, 0, '', '2018-02-09 05:55:37', 69),
(89, 529, 0, '', '2018-02-09 07:43:55', 69),
(90, 512, 0, '', '2018-02-09 12:26:33', 69),
(91, 479, 0, '', '2018-02-09 15:29:45', 69),
(92, 473, 0, '', '2018-02-10 09:37:58', 69),
(93, 385, 0, '', '2018-02-11 04:41:31', 69),
(94, 388, 0, '', '2018-02-11 04:41:45', 69),
(95, 5, 0, 'delivered', '2018-02-11 06:01:03', 69),
(96, 26, 0, '', '2018-02-11 06:38:44', 69),
(97, 2, 3, 'test', '2018-02-11 09:47:51', 69),
(98, 365, 0, '', '2018-02-13 04:40:24', 69),
(99, 517, 0, '', '2018-02-13 04:40:53', 69),
(100, 426, 0, '', '2018-02-13 04:41:10', 69),
(101, 336, 0, '', '2018-02-13 10:37:41', 69),
(102, 383, 0, '', '2018-02-13 11:53:49', 69),
(103, 12, 3, '', '2018-02-13 12:36:27', 17),
(104, 586, 0, '', '2018-02-14 13:07:47', 69),
(105, 336, 0, '', '2018-02-14 13:08:30', 69),
(106, 470, 0, '', '2018-02-14 13:40:31', 69),
(107, 587, 0, '', '2018-02-15 05:26:17', 69),
(108, 323, 0, '', '2018-02-15 10:43:28', 69),
(109, 470, 0, '', '2018-02-15 14:15:02', 69),
(110, 598, 0, '', '2018-02-23 09:46:10', 69),
(111, 656, 0, '', '2018-02-24 11:35:41', 69),
(112, 722, 0, '', '2018-02-24 11:48:01', 69),
(113, 671, 0, '', '2018-02-24 11:48:14', 69),
(114, 607, 0, '', '2018-02-24 15:25:47', 69),
(115, 2, 3, 'test', '2018-02-25 06:35:18', 69),
(116, 659, 0, '', '2018-02-25 09:55:42', 69),
(117, 796, 0, '', '2018-02-25 15:53:05', 69),
(118, 548, 0, '', '2018-02-26 02:32:21', 69),
(119, 548, 0, '', '2018-02-26 05:57:11', 69),
(120, 664, 0, '', '2018-02-26 05:57:29', 69),
(121, 858, 0, '', '2018-02-27 10:29:43', 69),
(122, 793, 0, '', '2018-02-27 10:47:18', 69),
(123, 385, 0, '', '2018-02-27 12:49:55', 69),
(124, 545, 0, '', '2018-02-27 13:09:38', 69),
(125, 137, 0, '', '2018-02-27 13:11:40', 69),
(126, 517, 0, '', '2018-02-27 14:40:10', 69),
(127, 847, 0, '', '2018-02-27 14:40:27', 69),
(128, 383, 0, '', '2018-02-28 11:10:17', 69),
(129, 768, 0, '', '2018-02-28 17:17:02', 69),
(130, 888, 0, '', '2018-02-28 17:17:34', 69),
(131, 875, 0, '', '2018-02-28 17:18:50', 69),
(132, 846, 0, '', '2018-02-28 17:22:19', 69),
(133, 795, 0, '', '2018-02-28 17:22:53', 69),
(134, 481, 0, '', '2018-03-01 15:45:41', 69),
(135, 517, 0, 'Good  ', '2018-03-07 16:09:05', 69),
(136, 947, 0, '', '2018-03-08 11:29:21', 69),
(137, 211, 0, '', '2018-03-09 09:40:45', 69),
(138, 976, 0, '', '2018-03-09 12:42:45', 69),
(139, 403, 0, '', '2018-03-09 13:25:56', 69),
(140, 46, 0, '', '2018-03-09 14:22:59', 69),
(141, 327, 0, '', '2018-03-09 14:23:13', 69),
(142, 598, 0, '', '2018-03-10 10:24:10', 69),
(143, 981, 0, '', '2018-03-10 12:38:50', 69),
(144, 978, 0, '', '2018-03-10 13:19:25', 69),
(145, 365, 0, '', '2018-03-11 10:49:41', 69),
(146, 702, 0, '', '2018-03-11 11:05:55', 69),
(147, 211, 0, '', '2018-03-11 11:37:06', 69),
(148, 796, 0, '', '2018-03-11 12:53:21', 69),
(149, 8, 2, 'good behaviour ', '2018-03-11 15:51:28', 69),
(150, 473, 0, '', '2018-03-13 15:29:57', 69),
(151, 517, 0, '', '2018-03-13 16:21:06', 69),
(152, 988, 0, '', '2018-03-14 03:19:01', 69),
(153, 447, 0, '', '2018-03-14 12:07:13', 69),
(154, 473, 0, '', '2018-03-14 12:07:39', 69),
(155, 999, 0, '', '2018-03-14 12:08:21', 69),
(156, 992, 0, '', '2018-03-14 12:09:02', 69),
(157, 137, 0, '', '2018-03-14 13:15:05', 69),
(158, 875, 0, '', '2018-03-14 13:52:08', 69),
(159, 490, 0, '', '2018-03-15 14:06:26', 69),
(160, 337, 0, '', '2018-03-15 14:32:17', 69),
(161, 1000, 0, '', '2018-03-15 15:57:49', 69),
(162, 517, 0, '', '2018-03-15 16:24:31', 69),
(163, 978, 0, '', '2018-03-16 09:29:29', 69),
(164, 702, 0, '', '2018-03-16 10:09:25', 69),
(165, 545, 0, '', '2018-03-17 10:14:37', 69),
(166, 517, 0, '', '2018-03-18 13:05:55', 69),
(167, 517, 0, '', '2018-03-18 13:07:31', 69),
(168, 648, 0, '', '2018-03-18 13:08:08', 69),
(169, 351, 0, '', '2018-03-18 13:59:41', 69),
(170, 659, 0, '', '2018-03-18 14:15:19', 69),
(171, 1010, 0, '', '2018-03-18 15:26:49', 69),
(172, 385, 0, '', '2018-03-20 10:22:15', 69),
(173, 768, 0, '', '2018-03-20 10:22:41', 69),
(174, 325, 0, '', '2018-03-20 13:10:33', 69),
(175, 137, 0, '', '2018-03-20 13:11:10', 69),
(176, 475, 0, '', '2018-03-20 13:37:59', 69),
(177, 883, 0, '', '2018-03-21 14:37:09', 69),
(178, 517, 0, '', '2018-03-22 13:57:33', 69),
(179, 1000, 0, '', '2018-03-22 14:51:26', 69),
(180, 976, 0, '', '2018-03-23 12:34:27', 69),
(181, 517, 0, '', '2018-03-24 13:36:47', 69),
(182, 26, 0, '', '2018-03-25 05:20:43', 69),
(183, 26, 0, '', '2018-03-25 05:20:59', 69),
(184, 7, 0, '', '2018-03-25 05:51:19', 69),
(185, 8, 2, 'good behaviour ', '2018-03-27 07:57:09', 69),
(186, 8, 2, 'good behaviour ', '2018-03-27 08:06:06', 69),
(187, 851, 0, '', '2018-03-27 10:38:52', 69),
(188, 11, 0, '', '2018-03-27 12:58:15', 69),
(189, 322, 0, '', '2018-03-29 09:27:18', 69),
(190, 397, 0, '', '2018-03-29 10:57:42', 69),
(191, 1038, 0, '', '2018-03-29 12:13:18', 69),
(192, 888, 0, '', '2018-03-29 12:32:32', 69),
(193, 363, 0, '', '2018-03-29 14:32:58', 69),
(194, 1044, 1, '', '2018-03-30 07:22:45', 46),
(195, 1044, 1, '500 nhi milte but muje rate kam lge but kahu nhi likha 50 milte h', '2018-03-30 07:23:26', 46),
(196, 659, 0, '', '2018-03-30 14:04:20', 69),
(197, 517, 0, '', '2018-03-30 14:05:33', 69),
(198, 1016, 10, 'mam apki voice clear nhi aa rhi again call lia call diconnect krdia', '2018-04-01 08:22:53', 46),
(199, 429, 1, 'haan ji mam mai apse baad mai baat kru', '2018-04-01 08:24:50', 46),
(200, 303, 1, 'call pick kia bol nhi rha tha koi phir call cut krdia', '2018-04-01 08:26:14', 46),
(201, 1048, 1, 'nop', '2018-04-01 08:28:23', 46),
(202, 221, 1, 'nop', '2018-04-01 08:29:30', 46),
(203, 209, 1, 'haan order krte rhta h aisa h abhi kuch prblm h', '2018-04-01 08:32:00', 46),
(204, 208, 1, 'nop', '2018-04-01 08:35:40', 46),
(205, 197, 1, 'mam mai khud lana psnd krti hu ab agar muje krna hoga krdungi', '2018-04-01 08:37:53', 46),
(206, 107, 1, 'nop', '2018-04-01 08:38:05', 46),
(207, 54, 1, 'nop', '2018-04-01 08:38:15', 46),
(208, 966, 0, '', '2018-04-01 10:34:32', 69),
(209, 1047, 0, '', '2018-04-01 10:35:09', 69),
(210, 517, 0, '', '2018-04-01 12:46:45', 69),
(211, 751, 0, '', '2018-04-01 12:47:27', 69),
(212, 1021, 0, '', '2018-04-01 14:53:56', 69),
(213, 6, 10, 'very good behaviour\r\n\r\n', '2018-04-02 06:24:28', 69),
(214, 26, 0, '', '2018-04-02 06:38:31', 69),
(215, 11, 0, '', '2018-04-02 09:50:53', 69),
(216, 11, 0, '', '2018-04-02 09:51:06', 69),
(217, 11, 0, '', '2018-04-02 09:51:15', 69),
(218, 26, 0, '', '2018-04-03 05:44:25', 69),
(219, 355, 0, '', '2018-04-03 10:19:26', 69),
(220, 875, 0, '', '2018-04-03 10:32:20', 69),
(221, 644, 0, '', '2018-04-03 12:46:45', 69),
(222, 517, 0, '', '2018-04-03 13:35:55', 69),
(223, 702, 0, '', '2018-04-04 10:22:18', 69),
(224, 26, 0, '', '2018-04-04 12:11:52', 69),
(225, 490, 0, '', '2018-04-05 02:34:05', 69),
(226, 836, 0, '', '2018-04-05 11:13:53', 69),
(227, 470, 0, '', '2018-04-05 12:22:21', 69),
(228, 927, 0, '', '2018-04-06 10:56:58', 69),
(229, 978, 0, '', '2018-04-06 11:00:35', 69),
(230, 435, 0, '', '2018-04-06 13:07:03', 69),
(231, 375, 0, '', '2018-04-06 13:19:15', 69),
(232, 517, 0, '', '2018-04-06 14:47:52', 69),
(233, 648, 0, '', '2018-04-06 15:10:55', 69),
(234, 659, 0, '', '2018-04-07 10:55:29', 69),
(235, 1064, 0, '', '2018-04-07 11:26:48', 69),
(236, 1021, 0, '', '2018-04-07 12:32:50', 69),
(237, 365, 0, '', '2018-04-08 11:31:37', 69),
(238, 1068, 0, '', '2018-04-08 13:16:35', 69),
(239, 447, 0, '', '2018-04-08 14:03:40', 69),
(240, 796, 0, '', '2018-04-08 14:09:54', 69),
(241, 517, 0, '', '2018-04-08 14:32:28', 69),
(242, 11, 0, 'tt', '2018-04-10 07:04:31', 69),
(243, 470, 0, '', '2018-04-10 12:33:48', 69),
(244, 517, 0, '', '2018-04-10 12:34:48', 69),
(245, 751, 0, '', '2018-04-10 12:36:05', 69),
(246, 1021, 0, '', '2018-04-10 14:27:50', 69),
(247, 1064, 0, '', '2018-04-11 11:29:35', 69),
(248, 327, 0, '', '2018-04-11 11:29:58', 69),
(249, 26, 0, '', '2018-04-11 11:30:28', 69),
(250, 26, 0, '', '2018-04-11 11:30:50', 69),
(251, 26, 0, '', '2018-04-11 11:31:03', 69),
(252, 26, 0, '', '2018-04-11 11:31:24', 69),
(253, 717, 0, '', '2018-04-11 12:51:36', 69),
(254, 517, 0, '', '2018-04-12 12:46:54', 69),
(255, 487, 10, 'Good Behaviour, 2 Products were not delivered. refund of 117 to be credited to customers wallet.', '2018-04-12 12:48:38', 69),
(256, 1028, 0, '', '2018-04-12 14:14:57', 69),
(257, 338, 0, '', '2018-04-12 14:15:34', 69),
(258, 875, 0, '', '2018-04-13 05:45:22', 69),
(259, 8, 2, 'good behaviour ', '2018-04-13 05:45:41', 69),
(260, 1094, 0, '', '2018-04-13 05:47:10', 69),
(261, 927, 0, '', '2018-04-13 11:20:26', 69),
(262, 875, 0, '', '2018-04-14 05:46:13', 69),
(263, 1094, 0, '', '2018-04-14 05:47:55', 69),
(264, 659, 0, '', '2018-04-15 10:26:03', 69),
(265, 584, 1, 'Products given by grocio were of inferior quality.\\nI used to order from groffers, however some advertising agent convinced me to do shopping from grocio and assured me of better quality and service but to my surprise product are not even as good as provided by other online apps.\\nI again switched to groffers', '2018-04-15 12:31:28', 17),
(266, 1100, 0, '', '2018-04-15 14:00:02', 69),
(267, 1047, 1, 'haan mam maine order kia tha nhi last order mai koi problm nhi thi mai next order krta hu 5 din baad', '2018-04-17 05:49:04', 46),
(268, 1000, 1, 'mam mai order krti thi but apke yha pr saman kam milta kya fyda theek h ab mai order krungi pura saman ayga toh', '2018-04-17 06:03:27', 46),
(269, 999, 1, 'not reachable', '2018-04-17 06:05:49', 46),
(270, 988, 1, 'theek h hoga toh phir btynge', '2018-04-17 06:10:20', 46),
(271, 981, 1, 'mam muje first tym order kia tha 50 mile ab nhi mile check karo wallet 50 rs mai', '2018-04-17 06:14:39', 46),
(272, 976, 1, 'call disconnect', '2018-04-17 06:16:51', 46),
(273, 966, 1, 'call disconnect', '2018-04-17 06:18:03', 46),
(274, 950, 10, 'sorry mam mai abhi out off city hu abhi bilkul discuss nhi sk skti hu', '2018-04-17 06:20:10', 46),
(275, 943, 1, 'not reachable', '2018-04-17 06:21:45', 46),
(276, 907, 10, 'haan maine ek bar order kia tha maine order krti hu tab ka saman abtk chl rha h', '2018-04-17 06:26:40', 46),
(277, 902, 1, 'grocio ka naam suna call disconnect', '2018-04-17 06:28:24', 46),
(278, 888, 1, 'maine 2 bar order kia h apke yha pr side pr show hota h phir aap bolte ho nhi h out of stock h ab nhi kruna nhi krunga', '2018-04-17 06:33:47', 46),
(279, 883, 1, 'call disconnect', '2018-04-17 06:37:24', 46),
(280, 858, 1, 'mam maine order kia tha mai grofers sai order krta hu apke product ki quality achi nhi thi plus app slow aur problm thi mam dekho insan rate campare nhi krta 2 yh 4 rs sai koi fark nhi pdhta quality best honi chahiye plus services achi honi chahiye', '2018-04-17 06:42:40', 46),
(281, 846, 1, 'mam maine ek bar order kia tha poha expery date tha mai kaise order kru phle poha replace karo', '2018-04-17 06:47:13', 46),
(282, 793, 1, 'nop', '2018-04-17 06:50:35', 46),
(283, 786, 10, 'call disconnect', '2018-04-17 06:55:29', 46),
(284, 769, 1, 'call disconnect', '2018-04-17 06:59:10', 46),
(285, 722, 1, 'abhi busy hu baad mai call krna', '2018-04-17 07:01:44', 46),
(286, 718, 1, '', '2018-04-17 07:03:53', 46),
(287, 718, 1, 'mere husband ka transfer hogye h pune', '2018-04-17 07:07:12', 46),
(288, 713, 10, 'mam maine ek bar order kia tha but apke rate jyda h campare grofers toh mai dusri jgh sai krunga ', '2018-04-17 07:10:43', 46),
(289, 706, 10, 'mam apke app mai bhut problm rate jyda plus saman nhi milta kya fyda', '2018-04-17 07:13:36', 46),
(290, 700, 10, 'mam apki service achi nhi h mai ghra pr hu baad mai baat krna', '2018-04-17 07:17:57', 46),
(291, 689, 10, 'nop', '2018-04-17 07:23:32', 46),
(292, 689, 10, 'nop', '2018-04-17 07:24:31', 46),
(293, 679, 1, 'mam mai order krta hu apke yha sai theek h krta hu mai', '2018-04-17 07:28:50', 46),
(294, 677, 1, 'acha mam aap home delivery krte ho theek h mam krte h hum', '2018-04-17 07:31:46', 46),
(295, 673, 1, 'call disconnect', '2018-04-17 07:33:56', 46),
(296, 671, 1, 'grocio ka naam suna call disconnect', '2018-04-17 07:35:07', 46),
(297, 669, 1, 'mam abhi hum bhar h jab aynge tb order krdunga', '2018-04-17 07:38:00', 46),
(298, 664, 1, 'nhi mam aisi koi problm nhi h grocio sai haan saman hoga tbhi order nhi kia krnge ', '2018-04-17 07:40:25', 46),
(299, 658, 10, 'nhi mam muje bola tha 500 mila tha but nhi mile ap apna aata dekho 330 ka sale kr rhe ho ', '2018-04-17 07:48:42', 46),
(300, 622, 1, 'mam ab mai noida nhi rh rha hu ab mai mumbai shift ho gai hu', '2018-04-17 07:50:45', 46),
(301, 616, 10, 'family abhi gyi hui h jo order kia tha wo saman aise rkha h family april ka last tk aa jygi phir krta hu order', '2018-04-17 07:52:44', 46),
(302, 765, 0, '', '2018-04-17 11:22:29', 69),
(303, 717, 0, '', '2018-04-17 13:12:02', 69),
(304, 796, 0, '', '2018-04-17 16:17:15', 69),
(305, 606, 10, 'mai abhi busy hu baad mai call krti hu', '2018-04-18 05:51:08', 46),
(306, 598, 1, 'mam maine phle order kia tha but grofers sai apke rate jyda h unke pass offer bhi acha h', '2018-04-18 05:57:02', 46),
(307, 587, 1, 'kuch bol nhi rha tha', '2018-04-18 06:01:44', 46),
(308, 586, 1, 'mam mera noida sai tranfer hogye h', '2018-04-18 06:03:18', 46),
(309, 584, 1, 'nop', '2018-04-18 06:05:24', 46),
(310, 567, 1, 'mam apko mera number kaha sai mila theek h mai order krunga mam', '2018-04-18 06:12:13', 46),
(311, 566, 1, 'nop', '2018-04-18 06:16:56', 46),
(312, 559, 10, 'nop', '2018-04-18 06:18:30', 46),
(313, 1094, 1, 'mail ayi thi apple ki apple khrab the sunna rha tha apple bhar sai ache h ander sai kharab tha sunna rha tha', '2018-04-18 06:31:01', 46),
(314, 548, 1, 'nop', '2018-04-18 06:35:52', 46),
(315, 545, 1, 'nhi mam koi prblm nhi thi last order mai mai krti hu next order', '2018-04-18 06:39:04', 46),
(316, 527, 1, 'nhi abhi toh nhi h hogi toh btungi', '2018-04-18 06:40:52', 46),
(317, 514, 1, 'yh bol rhe h aapne muje patanjali face wash lka refund nhi kia jo refund kia h wo Johnson ka kia h toh mai order kyu kru', '2018-04-18 07:02:41', 46),
(318, 512, 1, 'nop', '2018-04-18 07:06:35', 46),
(319, 511, 2, 'call disconnect / don,t call it\'s goldi sister', '2018-04-18 07:06:47', 46),
(320, 481, 1, 'call disconnect', '2018-04-18 07:11:00', 46),
(321, 473, 1, 'maine rice order kuch kia tha but aya kuch aur', '2018-04-18 07:34:02', 46),
(322, 444, 1, 'call disconnect', '2018-04-18 07:39:17', 46),
(323, 434, 1, 'mam jinka ph h yh wo bhar gia hai', '2018-04-18 07:41:05', 46),
(324, 429, 1, 'call disconnect', '2018-04-18 07:42:39', 46),
(325, 426, 1, 'nop', '2018-04-18 07:43:33', 46),
(326, 403, 1, 'mam ek bill mai prblm thi dusri apke yh koi product nhi milta chalo aap bol rhe ho toh ek bar order krta hu', '2018-04-18 07:51:11', 46),
(327, 397, 1, 'call disconnect', '2018-04-18 07:52:38', 46),
(328, 385, 1, 'mai abhi thoda busy hu baad mai call krna', '2018-04-18 07:54:25', 46),
(329, 383, 1, 'theek h mam mai krta hu apke rate jyda the grofers sai', '2018-04-18 07:59:26', 46),
(330, 363, 1, 'call disconnect', '2018-04-18 08:02:02', 46),
(331, 357, 1, 'haan mam mai krta hu order abhi kuch need nhi thi islie nhi kia order', '2018-04-18 08:28:35', 46),
(332, 351, 1, 'ph pick krlia but bol nhi rha', '2018-04-18 09:21:19', 46),
(333, 336, 2, 'nop', '2018-04-18 09:22:40', 46),
(334, 336, 2, '', '2018-04-18 09:22:42', 46),
(335, 336, 2, '', '2018-04-18 09:22:43', 46),
(336, 323, 1, 'busy hu baad mai call krna', '2018-04-18 09:25:40', 46),
(337, 322, 1, 'nop', '2018-04-18 09:26:46', 46),
(338, 311, 1, 'nop', '2018-04-18 09:28:27', 46),
(339, 303, 1, 'nop', '2018-04-18 09:29:58', 46),
(340, 221, 1, 'mam ek jgh sai koi nhi lungi jaha muje acha lgega waha sai lungi', '2018-04-18 09:32:36', 46),
(341, 211, 1, 'nop', '2018-04-18 09:34:27', 46),
(342, 209, 1, 'haan theek h mam mai krta hu order', '2018-04-18 09:39:47', 46),
(343, 211, 1, 'mam aap logo patanjali product mrp pr dte tha ab mai kahi aur sai purchase krta hu chalo aap bol rhe ho toh mai dekhta hu', '2018-04-18 09:46:46', 46),
(344, 208, 1, 'mam ab mere ghar ki khud ki shop h', '2018-04-18 09:49:43', 46),
(345, 1114, 10, 'mam but 500 bola tha 500 nhi mila chalo theek h mai krta hu order', '2018-04-18 11:00:01', 46),
(346, 1113, 10, 'mam aap logo nai app itna ganda bnya h maine subha order kr rha tha but milk nhi tha', '2018-04-18 11:07:48', 46),
(347, 1112, 10, 'Non veg nhi milta kya', '2018-04-18 11:11:16', 46),
(348, 1111, 10, 'switch off', '2018-04-18 11:12:12', 46),
(349, 1110, 10, 'apko mera number kaha sai mila theek h muje need hogi toh mai order krti hu', '2018-04-18 11:15:03', 46),
(350, 1109, 10, 'nop', '2018-04-18 11:18:57', 46),
(351, 1108, 10, 'switch off', '2018-04-18 11:19:25', 46),
(352, 1107, 1, 'mam maine check kia tha apkr rate jyda h grofers ka compare mai', '2018-04-18 11:22:57', 46),
(353, 1104, 10, 'not reachable', '2018-04-18 11:34:28', 46),
(354, 1103, 10, 'nop', '2018-04-18 11:35:41', 46),
(355, 1102, 1, 'nhi humko nhi chahiye thanku thanku', '2018-04-18 11:37:29', 46),
(356, 1099, 10, 'nop', '2018-04-18 11:41:02', 46),
(357, 1098, 10, 'mam abhi baad mai baat krna plss', '2018-04-18 11:41:57', 46),
(358, 1096, 10, 'nop', '2018-04-18 11:45:01', 46),
(359, 1095, 1, 'ph pick krlia but apne frnds sai baat kr rha tha', '2018-04-18 11:48:22', 46),
(360, 1093, 1, 'switch off', '2018-04-18 11:50:14', 46),
(361, 682, 10, 'call back aya durga traders sai bol rha hu', '2018-04-18 12:36:04', 46),
(362, 1128, 0, '', '2018-04-20 10:43:13', 69),
(363, 1121, 0, '', '2018-04-20 12:27:16', 69),
(364, 691, 0, '', '2018-04-20 12:27:51', 69),
(365, 447, 0, '', '2018-04-21 14:48:22', 69),
(366, 1135, 0, '', '2018-04-22 10:39:23', 69),
(367, 1136, 0, '', '2018-04-22 11:05:01', 69),
(368, 365, 0, '', '2018-04-22 12:04:15', 69),
(369, 1116, 0, '', '2018-04-22 12:25:07', 69),
(370, 927, 0, '', '2018-04-22 13:41:46', 69),
(371, 1130, 0, '', '2018-04-22 14:14:57', 69),
(372, 1137, 0, '', '2018-04-22 14:27:18', 69),
(373, 33, 10, 'mam abhi muje jarurat nai hai jab hogi to m kar lungi', '2018-04-23 07:53:42', 76),
(374, 46, 1, 'maine jo order kiya tha muje wo nai mila or sabjiya to bhut purani thi 3.4 bar order kar chuka hu', '2018-04-23 07:56:00', 76),
(375, 54, 1, 'haan mam mujhe pta h grocio ke bare me order b kiya dubarajarurat hogi to oeder krubgi', '2018-04-23 08:04:37', 76),
(376, 100, 3, 'mam m bta dunga apko', '2018-04-23 08:07:32', 76),
(377, 107, 1, 'call disconnect', '2018-04-23 08:12:56', 76),
(378, 108, 3, 'mam abhi office me hu', '2018-04-23 08:13:18', 76),
(379, 117, 1, 'nop', '2018-04-23 08:16:09', 76),
(380, 118, 1, 'grocio sunkar call disconnect', '2018-04-23 08:17:38', 76),
(381, 120, 10, 'nop', '2018-04-23 08:19:10', 76),
(382, 121, 10, 'nop', '2018-04-23 08:19:22', 76),
(383, 137, 1, 'mam hum noida se bhatinda shift ho gye hai hai', '2018-04-23 08:20:58', 76),
(384, 185, 1, 'not interested', '2018-04-23 08:28:16', 76),
(385, 186, 1, 'grocio sunkar call disconnect', '2018-04-23 08:29:13', 76),
(386, 190, 1, 'nop', '2018-04-23 08:30:17', 76),
(387, 190, 1, 'mam hmari khud ki shop hai', '2018-04-23 08:31:08', 76),
(388, 197, 1, 'no mam', '2018-04-23 08:39:32', 76),
(389, 200, 1, 'nop', '2018-04-23 08:39:46', 76),
(390, 203, 3, 'not reachable', '2018-04-23 08:40:07', 76),
(391, 209, 2, 'abhi mam jarurat nai hai', '2018-04-23 08:40:56', 76),
(392, 211, 1, 'mam next month krunga', '2018-04-23 08:41:26', 76),
(393, 221, 1, 'switch off', '2018-04-23 08:41:48', 76),
(394, 241, 1, 'mam sham ko bat karta hu', '2018-04-23 08:42:34', 76),
(395, 246, 10, 'nop', '2018-04-23 09:31:24', 76),
(396, 299, 10, 'no mam', '2018-04-23 09:31:44', 76),
(397, 302, 10, 'nop', '2018-04-23 09:33:07', 76),
(398, 303, 1, 'interested hai and order bhi krna h aaj apna Ferrell code msg krdo ', '2018-04-23 09:37:37', 76),
(399, 305, 1, 'mam abhi m big basket ya grofers se purchase karta hu ok m dekhta hu', '2018-04-23 09:45:57', 76),
(400, 318, 1, 'not reachable', '2018-04-23 09:47:20', 76),
(401, 319, 1, 'not reacable', '2018-04-23 09:48:44', 76),
(402, 323, 1, 'mam abhi m busy hu call disconnect', '2018-04-23 09:51:45', 76),
(403, 325, 1, 'nop', '2018-04-23 09:56:11', 76),
(404, 330, 1, 'm grocio se hi purchase krta hu koi issue nai h', '2018-04-23 10:00:49', 76),
(405, 331, 1, 'nop', '2018-04-23 10:02:17', 76),
(406, 332, 10, 'mam m grocio se hi order krta hu', '2018-04-23 10:06:33', 76),
(407, 344, 1, 'nop', '2018-04-23 10:11:38', 76),
(408, 340, 1, 'not reachable', '2018-04-23 10:12:06', 76),
(409, 340, 1, '', '2018-04-23 10:12:08', 76),
(410, 355, 0, '', '2018-04-24 11:13:01', 69),
(411, 851, 0, '', '2018-04-24 11:31:53', 69),
(412, 1184, 0, '', '2018-04-24 15:12:44', 69),
(413, 11, 0, 'ibi', '2018-04-25 06:52:12', 69),
(414, 517, 0, '', '2018-04-27 14:20:15', 69),
(415, 1215, 0, '', '2018-04-27 15:46:31', 69),
(416, 5, 0, '', '2018-04-28 07:22:12', 69),
(417, 5, 0, '', '2018-04-28 07:44:32', 69),
(418, 1208, 0, '', '2018-04-28 13:19:43', 69),
(419, 1133, 0, '', '2018-04-28 14:52:33', 69),
(420, 1222, 0, '', '2018-04-29 12:14:16', 69),
(421, 1219, 0, '', '2018-04-29 14:14:50', 69),
(422, 1242, 0, '', '2018-05-01 13:15:25', 69),
(423, 1226, 0, '', '2018-05-01 15:17:56', 69),
(424, 1223, 0, '', '2018-05-01 15:19:37', 69),
(425, 435, 0, '', '2018-05-01 15:26:54', 69),
(426, 1230, 0, '', '2018-05-01 15:54:55', 69),
(427, 978, 0, '', '2018-05-02 11:46:43', 69),
(428, 1135, 0, '', '2018-05-02 12:32:05', 69),
(429, 1021, 0, '', '2018-05-02 15:30:36', 69),
(430, 907, 10, 'haan maine ek bar order kia tha maine order krti hu tab ka saman abtk chl rha h', '2018-05-03 07:32:07', 76),
(431, 671, 1, 'mam maine apke yha order kiya hua h but muje pasand nai aai apki service kyuki sabse phle apka saman pura nai hota h apke yha or quality issue b rhta hai', '2018-05-03 07:35:45', 76),
(432, 888, 1, 'not reachable', '2018-05-03 07:37:25', 76),
(433, 846, 1, 'no thank u mam', '2018-05-03 07:38:53', 76),
(434, 768, 1, 'automatic call disconnect', '2018-05-03 08:43:25', 76),
(435, 383, 1, 'mam m abhi grofers se leta hu apka bhi dekha tha rate kam h apke chlo m dekhta hu', '2018-05-03 08:46:03', 76),
(436, 847, 1, 'mam maine phle apke yha se order kia tha ab m grofers se leta hu chlo m dubara order krunga', '2018-05-03 08:51:44', 76),
(437, 137, 1, 'nop', '2018-05-03 08:53:25', 76),
(438, 385, 1, 'voice not clear', '2018-05-03 08:55:32', 76),
(439, 545, 1, 'nop', '2018-05-03 08:56:47', 76),
(440, 858, 1, 'mam maine apka aap downlod kiya bhut apka aap kafi tough h grofers ka bhut easy hai  ', '2018-05-03 09:10:24', 76),
(441, 481, 1, 'rought busy', '2018-05-03 09:41:38', 76),
(442, 793, 1, 'maine apke yha se order kia tha but 1 saal purana saman dia apne muje isliye mujhe pasand nai aaya', '2018-05-03 09:45:22', 76),
(443, 786, 10, 'call disconnect', '2018-05-03 09:49:31', 76),
(444, 664, 1, 'nop', '2018-05-03 09:50:30', 76),
(445, 796, 1, 'nai chaiye kuch b', '2018-05-03 09:52:02', 76),
(446, 355, 1, 'mam m order krta rhta hu', '2018-05-03 09:54:16', 76),
(447, 548, 1, 'rought busy', '2018-05-03 10:14:12', 76),
(448, 514, 0, '', '2018-05-03 12:47:22', 69),
(449, 1184, 0, '', '2018-05-03 13:37:14', 69),
(450, 797, 0, '', '2018-05-03 14:14:07', 69),
(451, 1235, 0, '', '2018-05-03 14:35:26', 69),
(452, 1068, 0, '', '2018-05-03 15:47:16', 69),
(453, 302, 10, 'nop', '2018-05-03 17:08:53', 17),
(454, 302, 10, 'nop', '2018-05-03 17:09:09', 17),
(455, 769, 1, 'call disconnect', '2018-05-04 05:52:15', 76),
(456, 598, 1, 'mam m phle apke yha se order krta tha or mujhe phle discount acha milta tha but beach me rate apke jyada ho gye the to m dubara campier kr letu then order krta hu', '2018-05-04 05:56:46', 76),
(457, 700, 10, 'mam apki service achi nhi h mai ghra pr hu baad mai baat krna', '2018-05-04 05:58:25', 76),
(458, 16, 0, '', '2018-05-04 06:24:05', 69),
(459, 587, 1, 'grocio sunkar call disconnect', '2018-05-04 09:53:15', 76),
(460, 470, 1, 'mam m bhut busy hu', '2018-05-04 09:55:30', 76),
(461, 323, 1, 'mam kal bat krte hai', '2018-05-04 09:55:55', 76),
(462, 587, 1, 'nop', '2018-05-04 09:56:38', 76),
(463, 336, 2, 'nop', '2018-05-04 09:57:04', 76),
(464, 586, 1, 'not reachable', '2018-05-04 09:57:35', 76),
(465, 567, 1, 'mam abhi office hu', '2018-05-04 09:58:03', 76),
(466, 566, 1, 'not reachable', '2018-05-04 09:58:34', 76),
(467, 473, 1, 'mam apki quality achi ni h', '2018-05-04 09:59:18', 76),
(468, 365, 1, 'nop', '2018-05-04 09:59:38', 76),
(469, 426, 1, 'nop', '2018-05-04 10:00:06', 76),
(470, 434, 1, 'mam sham ko bat krta hu', '2018-05-04 10:00:48', 76),
(471, 388, 1, 'nop', '2018-05-04 10:01:15', 76),
(472, 385, 1, 'call disconnect', '2018-05-04 10:01:45', 76),
(473, 490, 1, 'mam abhi drive kr rha hu', '2018-05-04 10:03:06', 76),
(474, 1048, 1, 'mam m grofers se leta hu apke rate jyada h phle order kia tha ', '2018-05-04 10:04:14', 76),
(475, 355, 1, 'mam m customer hu apka', '2018-05-04 10:04:52', 76),
(476, 517, 0, '', '2018-05-04 14:16:00', 69),
(477, 1249, 0, '', '2018-05-04 14:40:46', 69),
(478, 1252, 0, '', '2018-05-04 16:12:31', 69),
(479, 1252, 0, '', '2018-05-04 16:18:17', 69),
(480, 383, 0, '', '2018-05-04 16:19:01', 69),
(481, 8, 2, 'good behaviour ', '2018-05-05 09:08:47', 69),
(482, 514, 0, '', '2018-05-08 11:53:54', 69),
(483, 649, 10, 'order many time canseled', '2018-05-08 14:16:55', 69),
(484, 1282, 0, '', '2018-05-08 14:46:07', 69),
(485, 1290, 0, '', '2018-05-08 15:10:17', 69),
(486, 11, 0, 'jfu', '2018-05-10 10:35:40', 69),
(487, 1258, 0, '', '2018-05-10 13:04:06', 69),
(488, 447, 0, '', '2018-05-10 13:26:37', 69),
(489, 91, 0, '', '2018-05-12 10:32:47', 69),
(490, 1322, 0, '', '2018-05-12 11:42:54', 69),
(491, 1319, 0, '', '2018-05-12 12:23:49', 69),
(492, 381, 0, '', '2018-05-16 13:15:19', 69),
(493, 5, 0, '', '2018-05-16 13:37:12', 69),
(494, 5, 0, '', '2018-05-16 13:41:55', 69),
(495, 5, 0, '', '2018-05-16 13:58:57', 69),
(496, 1136, 0, '', '2018-05-16 14:33:23', 69),
(497, 1282, 0, '', '2018-05-16 15:31:15', 69),
(498, 1028, 0, '', '2018-05-17 09:58:20', 69),
(499, 1236, 0, '', '2018-05-17 10:36:28', 69),
(500, 1235, 0, '', '2018-05-17 11:22:16', 69),
(501, 1317, 0, '', '2018-05-17 15:41:07', 69),
(502, 699, 0, '', '2018-05-17 15:41:31', 69),
(503, 1377, 0, '', '2018-05-18 11:40:43', 69),
(504, 1236, 0, '', '2018-05-18 12:58:14', 69),
(505, 797, 0, '', '2018-05-18 14:01:10', 69),
(506, 702, 0, '', '2018-05-18 14:55:48', 69),
(507, 796, 0, '', '2018-05-18 15:32:47', 69),
(508, 1381, 0, '', '2018-05-19 11:23:30', 69),
(509, 1382, 0, '', '2018-05-19 11:24:13', 69),
(510, 1389, 0, '', '2018-05-19 12:38:34', 69),
(511, 1387, 0, '', '2018-05-20 11:39:07', 69),
(512, 1408, 0, '', '2018-05-20 14:01:59', 69),
(513, 949, 0, '', '2018-05-20 16:12:36', 69),
(514, 1235, 0, '', '2018-05-20 16:12:52', 69),
(515, 8, 2, 'good behaviour ', '2018-05-21 11:43:11', 69),
(516, 851, 0, '', '2018-05-22 12:32:34', 69),
(517, 1379, 0, '', '2018-05-22 13:01:32', 69),
(518, 699, 0, '', '2018-05-22 14:36:33', 69),
(519, 483, 0, '', '2018-05-22 14:38:13', 69),
(520, 91, 0, '', '2018-05-22 15:16:34', 69),
(521, 1260, 0, '', '2018-05-23 12:00:55', 69),
(522, 949, 0, '', '2018-05-23 12:01:52', 69),
(523, 1235, 0, '', '2018-05-23 12:02:23', 69),
(524, 381, 0, '', '2018-05-23 12:02:52', 69),
(525, 1445, 0, '', '2018-05-25 10:52:27', 69),
(526, 1437, 0, '', '2018-05-25 11:10:43', 69),
(527, 8, 2, 'good behaviour ', '2018-05-25 12:06:23', 69),
(528, 1447, 0, '', '2018-05-26 10:32:31', 69),
(529, 1116, 0, '', '2018-05-26 11:33:25', 69),
(530, 1476, 0, '', '2018-05-29 10:56:07', 69),
(531, 1479, 0, '', '2018-05-29 12:31:51', 69),
(532, 971, 0, '', '2018-05-30 15:31:12', 69),
(533, 447, 0, '', '2018-05-30 15:32:06', 69),
(534, 1343, 0, '', '2018-05-30 15:33:23', 69),
(535, 1477, 0, '', '2018-05-30 15:35:03', 69),
(536, 1485, 10, 'good\r\n', '2018-05-31 10:56:14', 69),
(537, 1379, 0, 'good', '2018-05-31 12:51:48', 69),
(538, 1235, 0, 'good', '2018-05-31 12:53:24', 69),
(539, 447, 0, '', '2018-06-01 10:27:54', 69),
(540, 1256, 0, '', '2018-06-03 15:31:14', 69),
(541, 1528, 0, '', '2018-06-03 15:32:39', 69),
(542, 331, 0, 'payment done by paumoney ', '2018-06-03 15:36:49', 69),
(543, 1498, 0, '', '2018-06-03 16:33:27', 69),
(544, 1236, 0, '', '2018-06-05 11:27:58', 69),
(545, 1539, 0, '', '2018-06-05 13:47:17', 69),
(546, 1371, 0, '', '2018-06-05 13:47:51', 69),
(547, 1087, 0, '', '2018-06-05 13:48:45', 69),
(548, 1552, 0, '', '2018-06-05 13:50:31', 69),
(549, 1235, 0, '', '2018-06-05 13:50:55', 69),
(550, 945, 0, '', '2018-06-05 13:51:17', 69),
(551, 1547, 0, '', '2018-06-05 15:01:51', 69),
(552, 796, 0, '', '2018-06-06 09:02:05', 69),
(553, 1464, 0, '', '2018-06-06 11:36:27', 69),
(554, 514, 0, '', '2018-06-06 12:22:40', 69),
(555, 1476, 0, '', '2018-06-08 09:28:45', 69),
(556, 1235, 0, '', '2018-06-08 11:07:06', 69),
(557, 1447, 0, '', '2018-06-08 11:12:15', 69),
(558, 1498, 0, '', '2018-06-08 16:54:48', 69),
(559, 1549, 0, '', '2018-06-08 16:57:47', 69),
(560, 1428, 0, '', '2018-06-09 11:08:56', 69),
(561, 1576, 0, '', '2018-06-09 11:09:29', 69),
(562, 1479, 0, '', '2018-06-09 11:11:59', 69),
(563, 1465, 0, '', '2018-06-09 14:21:23', 69),
(564, 548, 0, '', '2018-06-09 15:01:40', 69),
(565, 517, 0, '', '2018-06-10 02:58:22', 69),
(566, 1568, 0, '', '2018-06-10 10:27:57', 69),
(567, 1133, 0, '', '2018-06-10 12:33:59', 69),
(568, 1579, 0, '', '2018-06-10 13:18:16', 69),
(569, 1476, 0, '', '2018-06-10 13:47:11', 69),
(570, 1593, 0, '', '2018-06-12 15:36:41', 69),
(571, 1469, 0, '', '2018-06-12 15:38:08', 69),
(572, 1479, 0, '', '2018-06-16 12:36:54', 69),
(573, 1479, 0, '', '2018-06-16 12:48:12', 69),
(574, 1632, 11, 'her say mane koi order nahi kiya. jhut bol rahi hai mera no nahi hai but pick same no.loss 1000 rs.', '2018-06-21 12:12:12', 17),
(575, 702, 0, '', '2018-06-22 09:39:57', 69),
(576, 1655, 0, '', '2018-06-26 14:30:51', 69),
(577, 1484, 0, '', '2018-06-26 16:13:27', 69),
(578, 1476, 0, '', '2018-06-26 16:13:57', 69),
(579, 1282, 0, '', '2018-06-26 16:16:22', 69),
(580, 1366, 0, '', '2018-06-26 16:49:33', 69),
(581, 1562, 0, '', '2018-06-29 07:13:30', 69),
(582, 1562, 0, '', '2018-06-29 08:19:20', 69),
(583, 1562, 0, '', '2018-06-29 08:19:50', 69),
(584, 1562, 0, '', '2018-06-29 08:20:36', 69),
(585, 1562, 0, '', '2018-06-29 08:21:16', 69),
(586, 1476, 0, '', '2018-06-29 10:33:12', 69),
(587, 1662, 0, '', '2018-06-29 14:21:38', 69),
(588, 1476, 0, '', '2018-06-30 10:16:02', 69),
(589, 1681, 0, '', '2018-07-01 11:09:52', 69),
(590, 365, 0, '', '2018-07-01 12:33:36', 69),
(591, 1484, 0, '', '2018-07-01 13:24:43', 69),
(592, 90, 0, '', '2018-07-01 14:58:39', 69),
(593, 1684, 0, '', '2018-07-01 15:45:34', 69),
(594, 1087, 0, '', '2018-07-03 10:55:54', 69),
(595, 1235, 0, '', '2018-07-03 11:18:29', 69),
(596, 1620, 0, '', '2018-07-03 11:51:24', 69),
(597, 1702, 0, '', '2018-07-06 06:59:23', 69),
(598, 1705, 0, '', '2018-07-07 10:49:00', 69),
(599, 1518, 0, '', '2018-07-07 10:49:40', 69),
(600, 1684, 0, '', '2018-07-07 15:39:15', 69),
(601, 1185, 0, '', '2018-07-07 15:40:36', 69),
(602, 1235, 0, '', '2018-07-07 15:41:33', 69),
(603, 1133, 0, '', '2018-07-10 10:13:31', 69),
(604, 1048, 0, '', '2018-07-10 10:13:51', 69),
(605, 1484, 0, '', '2018-07-10 11:17:22', 69),
(606, 1498, 0, '', '2018-07-10 12:46:54', 69),
(607, 447, 0, '', '2018-07-11 10:09:58', 69),
(608, 1094, 0, '', '2018-07-14 11:03:08', 69),
(609, 1235, 0, '', '2018-07-15 10:09:30', 69),
(610, 1705, 0, '', '2018-07-15 10:22:59', 69),
(611, 1744, 0, '', '2018-07-15 10:36:44', 69),
(612, 796, 0, '', '2018-07-15 10:56:46', 69),
(613, 1727, 0, '', '2018-07-15 12:13:17', 69),
(614, 1409, 0, '', '2018-07-17 09:42:02', 69),
(615, 1087, 0, '', '2018-07-17 10:04:54', 69),
(616, 1757, 0, '', '2018-07-17 10:51:16', 69),
(617, 851, 0, '', '2018-07-17 13:30:42', 69),
(618, 1235, 0, '', '2018-07-17 13:30:58', 69),
(619, 1744, 0, '', '2018-07-17 13:31:28', 69),
(620, 1757, 0, '', '2018-07-18 10:48:17', 69),
(621, 1133, 0, '', '2018-07-18 12:44:19', 69),
(622, 383, 0, '', '2018-07-18 12:46:57', 69),
(623, 383, 0, '', '2018-07-18 13:58:40', 69),
(624, 1771, 0, '', '2018-07-19 10:41:54', 69),
(625, 1235, 0, '', '2018-07-21 12:34:20', 69),
(626, 1562, 0, 'good ', '2018-07-22 06:01:19', 69),
(627, 1583, 2, 'good ', '2018-07-22 06:06:22', 69),
(628, 1583, 2, 'good ', '2018-07-22 06:07:10', 69),
(629, 1562, 0, 'd', '2018-07-22 06:11:26', 69),
(630, 1783, 0, '', '2018-07-22 06:12:54', 69),
(631, 1793, 10, 'good ', '2018-07-22 09:02:42', 69),
(632, 1784, 10, 'good ', '2018-07-22 10:07:03', 69),
(633, 1757, 0, '', '2018-07-24 10:08:35', 69),
(634, 1260, 0, '', '2018-07-24 10:09:39', 69),
(635, 1235, 0, '', '2018-07-24 10:10:40', 69),
(636, 1476, 0, '', '2018-07-24 10:57:46', 69),
(637, 1087, 0, '', '2018-07-24 13:24:58', 69),
(638, 1476, 0, '', '2018-07-25 05:19:03', 69),
(639, 1379, 0, '', '2018-07-25 12:22:14', 69),
(640, 796, 0, '', '2018-07-25 12:56:56', 69),
(641, 1356, 0, '', '2018-07-25 13:15:02', 69),
(642, 1817, 0, '', '2018-07-26 09:53:33', 69),
(643, 1814, 0, '', '2018-07-26 10:42:50', 69),
(644, 1825, 10, 'good', '2018-07-27 10:36:54', 69),
(645, 1235, 0, '', '2018-07-27 11:54:53', 69),
(646, 5, 1, 'check date expiry', '2018-07-28 07:59:21', 17),
(647, 1705, 0, 'good .....ðŸ˜ƒðŸ˜ƒ', '2018-07-28 10:55:07', 69),
(648, 1705, 0, '', '2018-07-28 10:55:39', 69),
(649, 1568, 0, '', '2018-07-28 11:35:44', 69),
(650, 365, 0, '', '2018-07-28 11:36:34', 69),
(651, 8, 2, 'good behaviour ', '2018-07-28 12:18:08', 69),
(652, 487, 0, '', '2018-07-28 12:20:53', 69),
(653, 1579, 0, '', '2018-07-28 13:12:04', 69),
(654, 1718, 0, '', '2018-07-29 05:54:30', 69),
(655, 1235, 0, '', '2018-07-31 08:56:04', 69),
(656, 1412, 0, '', '2018-07-31 08:56:19', 69),
(657, 1852, 0, '', '2018-07-31 09:28:06', 69),
(658, 1702, 0, '', '2018-07-31 09:29:49', 69),
(659, 1447, 0, '', '2018-07-31 09:52:29', 69),
(660, 1588, 0, '', '2018-07-31 10:36:53', 69),
(661, 1137, 0, '', '2018-07-31 11:21:01', 69),
(662, 1859, 0, '', '2018-07-31 11:50:04', 69),
(663, 1866, 0, '', '2018-08-01 11:25:54', 69),
(664, 1558, 0, '', '2018-08-01 12:34:49', 69),
(665, 1817, 0, '', '2018-08-02 10:52:39', 69),
(666, 1864, 0, '', '2018-08-02 11:13:43', 69),
(667, 1852, 0, '', '2018-08-02 11:14:03', 69),
(668, 1379, 0, '', '2018-08-02 11:35:05', 69),
(669, 383, 0, '', '2018-08-02 12:50:15', 69),
(670, 1830, 0, '', '2018-08-03 10:33:18', 69),
(671, 1021, 0, '', '2018-08-03 11:20:29', 69),
(672, 1705, 0, '', '2018-08-03 15:12:26', 69),
(673, 1094, 0, '', '2018-08-04 11:03:01', 69),
(674, 1891, 10, 'good ', '2018-08-04 11:47:34', 69),
(675, 447, 0, '', '2018-08-04 12:53:16', 69),
(676, 1235, 0, '', '2018-08-04 13:04:21', 69),
(677, 487, 0, '', '2018-08-04 13:33:36', 69),
(678, 1892, 0, '', '2018-08-05 10:42:09', 69),
(679, 1861, 0, '', '2018-08-05 11:43:40', 69),
(680, 1579, 0, '', '2018-08-07 10:32:02', 69),
(681, 1864, 0, '', '2018-08-07 11:20:50', 69),
(682, 796, 0, '', '2018-08-07 11:50:24', 69),
(683, 1235, 0, '', '2018-08-08 10:26:17', 69),
(684, 1814, 0, '', '2018-08-10 09:57:10', 69),
(685, 1498, 0, '', '2018-08-10 10:32:43', 69),
(686, 1694, 0, '', '2018-08-10 11:28:31', 69),
(687, 1705, 0, '', '2018-08-10 12:18:33', 69),
(688, 945, 0, '', '2018-08-10 12:37:58', 69),
(689, 1926, 0, '', '2018-08-10 13:04:56', 69),
(690, 1282, 0, '', '2018-08-10 15:18:22', 69),
(691, 1518, 0, '', '2018-08-11 11:26:54', 69),
(692, 1048, 0, '', '2018-08-11 11:27:25', 69),
(693, 1579, 0, '', '2018-08-11 11:27:52', 69),
(694, 1047, 0, '', '2018-08-11 11:28:15', 69),
(695, 1235, 0, '', '2018-08-11 11:28:40', 69),
(696, 1821, 0, '', '2018-08-11 12:30:41', 69),
(697, 1694, 0, '', '2018-08-11 12:31:01', 69),
(698, 1085, 0, '', '2018-08-12 11:38:09', 69),
(699, 1947, 0, '', '2018-08-12 11:39:04', 69),
(700, 1939, 0, '', '2018-08-12 11:40:04', 69),
(701, 1957, 0, '', '2018-08-14 09:11:27', 69),
(702, 1817, 0, '', '2018-08-14 09:42:11', 69),
(703, 1379, 0, '', '2018-08-14 10:58:52', 69),
(704, 796, 0, '', '2018-08-14 11:37:14', 69),
(705, 1676, 0, '', '2018-08-17 10:45:20', 69),
(706, 1514, 0, '', '2018-08-18 09:49:56', 69),
(707, 1465, 0, '', '2018-08-18 10:19:25', 69),
(708, 1872, 0, '', '2018-08-18 11:17:17', 69),
(709, 1980, 0, '', '2018-08-18 12:30:27', 69),
(710, 1094, 0, '', '2018-08-18 13:03:48', 69),
(711, 1694, 0, '', '2018-08-18 13:43:55', 69),
(712, 1235, 0, '', '2018-08-19 11:00:43', 69),
(713, 796, 0, '', '2018-08-19 11:10:20', 69),
(714, 1993, 0, '', '2018-08-21 09:42:54', 69),
(715, 1998, 0, '', '2018-08-21 10:22:23', 69),
(716, 1814, 0, '', '2018-08-21 10:49:10', 69),
(717, 1705, 0, '', '2018-08-21 11:20:36', 69),
(718, 1235, 0, '', '2018-08-21 11:38:40', 69),
(719, 2004, 0, '', '2018-08-21 13:16:40', 69),
(720, 1085, 0, '', '2018-08-21 14:04:16', 69),
(721, 2001, 0, '', '2018-08-21 14:45:06', 69),
(722, 1465, 0, '', '2018-08-22 10:09:11', 69),
(723, 322, 0, '', '2018-08-22 11:05:35', 69),
(724, 1817, 0, '', '2018-08-22 12:09:26', 69),
(725, 1087, 0, '', '2018-08-22 12:34:16', 69),
(726, 1465, 0, '', '2018-08-23 10:49:23', 69),
(727, 1235, 0, '', '2018-08-23 10:50:00', 69),
(728, 381, 0, '', '2018-08-23 11:03:07', 69),
(729, 1884, 0, '', '2018-08-23 12:37:51', 69),
(730, 1082, 0, '', '2018-08-24 09:11:21', 69),
(731, 2024, 0, '', '2018-08-24 09:38:55', 69),
(732, 2029, 0, '', '2018-08-24 10:06:40', 69),
(733, 2029, 0, '', '2018-08-24 10:07:06', 69),
(734, 517, 0, '', '2018-08-24 11:00:57', 69),
(735, 1975, 0, '', '2018-08-24 11:41:29', 69),
(736, 1498, 0, '', '2018-08-25 10:02:39', 69),
(737, 1235, 0, '', '2018-08-25 12:21:20', 69),
(738, 1945, 0, '', '2018-08-25 13:41:11', 69),
(739, 447, 0, '', '2018-08-26 10:12:37', 69),
(740, 1465, 0, '', '2018-08-26 10:26:16', 69),
(741, 447, 0, '', '2018-08-26 10:44:56', 69),
(742, 447, 0, '', '2018-08-26 10:59:47', 69),
(743, 447, 0, '', '2018-08-26 10:59:51', 69),
(744, 447, 0, '', '2018-08-26 10:59:59', 69),
(745, 447, 0, '', '2018-08-26 11:00:10', 69),
(746, 447, 0, '', '2018-08-26 11:00:15', 69),
(747, 447, 0, '', '2018-08-26 11:00:20', 69),
(748, 447, 0, '', '2018-08-26 11:00:30', 69),
(749, 447, 0, '', '2018-08-26 11:00:36', 69),
(750, 447, 0, 'ehejrj', '2018-08-26 11:00:42', 69),
(751, 447, 0, 'ehejrj', '2018-08-26 11:00:45', 69),
(752, 1379, 0, '10\n', '2018-08-28 09:48:06', 69),
(753, 1379, 0, '10\n', '2018-08-28 09:48:09', 69),
(754, 1379, 0, '10', '2018-08-28 09:48:34', 69),
(755, 1379, 0, '', '2018-08-28 09:48:42', 69),
(756, 1379, 0, '', '2018-08-28 09:48:56', 69),
(757, 1379, 0, '', '2018-08-28 09:49:08', 69),
(758, 1379, 0, '', '2018-08-28 09:49:12', 69),
(759, 1379, 0, '', '2018-08-28 09:49:15', 69),
(760, 1379, 0, '', '2018-08-28 09:49:17', 69),
(761, 1235, 0, '', '2018-08-28 10:12:09', 69),
(762, 1235, 0, '', '2018-08-28 10:12:15', 69),
(763, 1705, 0, '', '2018-08-28 10:42:16', 69),
(764, 1705, 0, '', '2018-08-28 10:42:21', 69),
(765, 1705, 0, '', '2018-08-28 10:42:29', 69),
(766, 1325, 0, '', '2018-08-28 11:26:12', 69),
(767, 1479, 0, '', '2018-08-30 07:37:27', 69),
(768, 1479, 0, '', '2018-08-30 07:37:36', 69),
(769, 1479, 0, '', '2018-08-30 07:37:46', 69),
(770, 1814, 0, '', '2018-08-30 08:00:49', 69),
(771, 2071, 0, '', '2018-08-31 11:29:34', 69),
(772, 1884, 0, '', '2018-08-31 14:33:14', 69),
(773, 1884, 0, '', '2018-08-31 14:33:19', 69),
(774, 1465, 0, '', '2018-09-01 08:37:34', 69),
(775, 1705, 0, '', '2018-09-01 09:09:34', 69),
(776, 1705, 0, '', '2018-09-01 09:09:58', 69),
(777, 1705, 0, '', '2018-09-01 09:10:15', 69),
(778, 1705, 0, '', '2018-09-01 09:10:30', 69),
(779, 2074, 0, '', '2018-09-01 09:49:59', 69),
(780, 2078, 0, '', '2018-09-01 10:31:56', 69),
(781, 1817, 0, '508', '2018-09-02 11:01:41', 69),
(782, 1518, 0, '', '2018-09-02 11:52:24', 69),
(783, 1518, 0, '', '2018-09-02 11:52:52', 69),
(784, 1366, 0, '', '2018-09-02 12:59:53', 69),
(785, 383, 0, '', '2018-09-02 13:00:40', 69),
(786, 1235, 0, '509', '2018-09-04 09:32:29', 69),
(787, 1235, 0, '509', '2018-09-04 09:32:32', 69),
(788, 1235, 0, '509', '2018-09-04 09:32:35', 69),
(789, 1235, 0, '509', '2018-09-04 09:32:42', 69),
(790, 1235, 0, '509', '2018-09-04 09:32:56', 69),
(791, 1235, 0, '509', '2018-09-04 09:35:09', 69),
(792, 702, 0, '468', '2018-09-04 09:46:33', 69),
(793, 702, 0, '468', '2018-09-04 09:46:47', 69),
(794, 702, 0, '468', '2018-09-04 09:46:58', 69),
(795, 702, 0, '468', '2018-09-04 09:47:01', 69),
(796, 702, 0, '468', '2018-09-04 09:47:05', 69),
(797, 2090, 0, '589', '2018-09-04 09:59:44', 69),
(798, 2029, 0, '', '2018-09-04 10:07:49', 69),
(799, 2029, 0, '', '2018-09-04 10:07:52', 69),
(800, 1137, 0, '2076', '2018-09-04 11:04:43', 69),
(801, 1137, 0, '2076', '2018-09-04 11:04:46', 69),
(802, 1137, 0, '2076', '2018-09-04 11:04:49', 69),
(803, 1137, 0, '2076', '2018-09-04 11:04:51', 69),
(804, 1137, 0, '2076', '2018-09-04 11:05:02', 69),
(805, 796, 0, '1611', '2018-09-04 11:31:36', 69),
(806, 796, 0, '1611', '2018-09-04 11:31:39', 69),
(807, 796, 0, '1611', '2018-09-04 11:31:45', 69),
(808, 796, 0, '1611', '2018-09-04 11:31:51', 69),
(809, 1840, 0, '3974', '2018-09-04 13:50:52', 69),
(810, 1840, 0, '3975\n', '2018-09-04 13:51:10', 69),
(811, 1840, 0, '3975\n', '2018-09-04 13:51:16', 69),
(812, 2092, 0, '', '2018-09-04 14:49:53', 69),
(813, 2092, 0, '', '2018-09-04 14:49:58', 69),
(814, 2104, 0, '3280\n', '2018-09-05 09:19:48', 69),
(815, 2105, 0, '1921', '2018-09-05 09:52:36', 69),
(816, 1744, 0, '943', '2018-09-05 10:28:59', 69),
(817, 1744, 0, '943', '2018-09-05 10:29:05', 69),
(818, 1744, 0, '943', '2018-09-05 10:29:10', 69),
(819, 1588, 0, '533', '2018-09-05 10:45:10', 69),
(820, 1814, 0, '251', '2018-09-05 11:21:02', 69),
(821, 2106, 0, '', '2018-09-05 12:39:24', 69),
(822, 1715, 0, '', '2018-09-06 09:23:52', 69),
(823, 1715, 0, '', '2018-09-06 09:23:57', 69),
(824, 1892, 0, '', '2018-09-06 10:12:35', 69),
(825, 1072, 0, '4711', '2018-09-06 10:43:21', 69),
(826, 1705, 0, '', '2018-09-07 10:06:59', 69),
(827, 1705, 0, '', '2018-09-07 10:08:21', 69),
(828, 1021, 0, '', '2018-09-07 11:16:25', 69),
(829, 1094, 0, '', '2018-09-09 07:02:22', 69),
(830, 1094, 0, '', '2018-09-15 07:03:31', 80),
(831, 649, 10, 'order many time canseled', '2018-09-16 08:45:05', 80),
(832, 2171, 0, '', '2018-09-18 07:50:25', 80),
(833, 2075, 0, '', '2018-09-18 08:20:56', 80),
(834, 2153, 0, '', '2018-09-18 08:21:11', 80),
(835, 2195, 0, '', '2018-09-18 08:21:28', 80),
(836, 2126, 0, '', '2018-09-18 08:21:40', 80),
(837, 2202, 0, '', '2018-09-18 12:06:59', 80),
(838, 1085, 0, '', '2018-09-18 12:40:09', 80),
(839, 1817, 0, '', '2018-09-18 13:34:47', 80),
(840, 2092, 0, '', '2018-09-18 13:35:53', 80),
(841, 1892, 0, '', '2018-09-18 14:26:19', 80),
(842, 2199, 0, '', '2018-09-18 15:13:23', 80),
(843, 2187, 10, 'ye expire date and rate chek krti hai', '2018-09-18 16:31:11', 80),
(844, 1694, 0, '', '2018-09-18 16:31:26', 80),
(845, 2205, 0, '', '2018-09-19 06:47:56', 80),
(846, 2222, 0, '', '2018-09-20 06:10:52', 80),
(847, 2202, 0, '', '2018-09-20 07:12:53', 80),
(848, 2222, 0, '', '2018-09-20 07:53:14', 80),
(849, 1235, 0, '', '2018-09-20 08:17:17', 80),
(850, 649, 10, 'order many time canseled', '2018-09-20 08:17:37', 80),
(851, 2222, 0, '', '2018-09-20 08:22:51', 80),
(852, 796, 0, '899', '2018-09-20 08:56:54', 80),
(853, 713, 0, '', '2018-09-22 08:15:24', 80),
(854, 2167, 0, '', '2018-09-22 09:51:55', 80),
(855, 2158, 0, '', '2018-09-22 10:52:52', 80),
(856, 2238, 0, '', '2018-09-22 11:47:01', 80),
(857, 1133, 0, '', '2018-09-22 13:44:54', 80),
(858, 2186, 0, '', '2018-09-22 13:45:15', 80),
(859, 2221, 0, '', '2018-09-22 14:40:12', 80),
(860, 322, 0, '', '2018-09-22 14:40:39', 80),
(861, 1827, 0, '', '2018-09-22 15:36:15', 80),
(862, 2239, 0, '', '2018-09-25 09:03:13', 80),
(863, 1235, 0, '', '2018-09-25 09:21:53', 80),
(864, 1744, 0, '', '2018-09-25 09:52:45', 80),
(865, 1047, 0, '', '2018-09-25 09:53:04', 80),
(866, 1498, 0, '', '2018-09-25 10:22:22', 80),
(867, 2189, 0, '', '2018-09-25 11:27:57', 80),
(868, 2278, 0, '', '2018-09-25 13:05:25', 80),
(869, 1884, 0, '', '2018-09-25 14:53:10', 80),
(870, 1705, 0, '', '2018-09-25 15:30:01', 80),
(871, 2301, 0, '', '2018-09-27 12:03:30', 80),
(872, 2189, 0, '', '2018-09-28 07:13:31', 80),
(873, 2311, 0, '', '2018-09-28 07:44:13', 80),
(874, 2328, 0, '', '2018-09-29 10:46:28', 80),
(875, 2199, 0, '', '2018-09-29 10:46:51', 80),
(876, 2326, 0, '', '2018-09-29 11:08:15', 80),
(877, 2330, 0, '', '2018-09-29 11:55:47', 80),
(878, 2252, 0, '', '2018-09-30 11:34:11', 80),
(879, 713, 0, '', '2018-09-30 11:34:40', 80),
(880, 2203, 0, '', '2018-09-30 11:35:08', 80),
(881, 2167, 0, '', '2018-09-30 13:12:29', 80),
(882, 2202, 0, '', '2018-09-30 14:20:20', 80),
(883, 2075, 0, '', '2018-10-03 06:35:19', 80),
(884, 2252, 0, '', '2018-10-03 07:14:06', 80),
(885, 2394, 0, '', '2018-10-03 07:27:36', 80),
(886, 1814, 0, '', '2018-10-03 10:55:03', 80),
(887, 2186, 0, '', '2018-10-03 15:01:47', 80),
(888, 875, 0, '', '2018-10-03 15:02:18', 80),
(889, 875, 0, '', '2018-10-03 15:02:23', 80),
(890, 875, 0, '', '2018-10-03 15:02:27', 80),
(891, 875, 0, '', '2018-10-03 15:03:00', 80),
(892, 1133, 0, '', '2018-10-03 15:03:48', 80),
(893, 2189, 0, '', '2018-10-03 15:32:25', 80),
(894, 239, 0, '', '2018-10-04 07:20:03', 80),
(895, 1094, 0, '', '2018-10-04 08:10:42', 80),
(896, 1094, 0, '', '2018-10-04 08:10:48', 80),
(897, 1094, 0, '', '2018-10-04 08:10:58', 80),
(898, 1235, 0, '', '2018-10-04 08:12:07', 80),
(899, 1817, 0, '', '2018-10-04 09:03:24', 80),
(900, 2185, 0, '683', '2018-10-05 05:38:01', 80),
(901, 1235, 0, '', '2018-10-05 12:01:05', 80),
(902, 2134, 0, '', '2018-10-05 12:44:29', 80),
(903, 1814, 0, '', '2018-10-06 10:09:06', 80),
(904, 322, 0, '', '2018-10-06 10:39:01', 80),
(905, 649, 10, 'order many time canseled', '2018-10-06 11:23:14', 80),
(906, 1872, 0, '', '2018-10-06 11:59:53', 80),
(907, 2152, 0, '', '2018-10-06 12:21:17', 80),
(908, 2427, 0, '', '2018-10-06 12:50:48', 80),
(909, 1514, 0, '', '2018-10-06 13:59:58', 80),
(910, 2202, 0, '', '2018-10-07 10:01:13', 80),
(911, 649, 10, 'order many time canseled', '2018-10-07 10:31:22', 80),
(912, 717, 0, '', '2018-10-07 10:57:37', 80),
(913, 2448, 0, '', '2018-10-07 11:29:24', 80),
(914, 2304, 0, '', '2018-10-07 12:00:48', 80),
(915, 2206, 0, '', '2018-10-07 12:15:30', 80),
(916, 2310, 0, '', '2018-10-07 14:48:10', 80),
(917, 2454, 0, '174', '2018-10-09 09:43:31', 80),
(918, 2158, 0, '507\n', '2018-10-09 10:12:37', 80),
(919, 2180, 0, '1190', '2018-10-09 10:45:49', 80),
(920, 1085, 0, '', '2018-10-09 11:00:28', 80),
(921, 1498, 0, '', '2018-10-09 11:18:34', 80),
(922, 2469, 0, '', '2018-10-09 12:09:25', 80),
(923, 2366, 0, '', '2018-10-09 12:47:07', 80),
(924, 2366, 0, '', '2018-10-09 12:47:26', 80),
(925, 1694, 0, '', '2018-10-09 12:51:14', 80),
(926, 2460, 0, '', '2018-10-09 13:27:40', 80),
(927, 1442, 0, '380', '2018-10-09 13:48:02', 80),
(928, 2465, 0, '', '2018-10-09 14:40:52', 80),
(929, 1588, 0, '', '2018-10-10 09:27:14', 80),
(930, 2450, 0, '1200', '2018-10-10 12:31:22', 80),
(931, 1814, 0, '', '2018-10-12 12:06:16', 80),
(932, 2199, 0, '', '2018-10-12 12:08:51', 80),
(933, 1132, 0, '', '2018-10-12 12:49:29', 80),
(934, 2092, 0, '', '2018-10-12 14:43:48', 80),
(935, 1419, 0, '', '2018-10-12 14:44:05', 80),
(936, 2137, 0, '', '2018-10-13 08:19:45', 80),
(937, 1694, 0, '', '2018-10-13 08:19:58', 80),
(938, 2167, 0, '', '2018-10-13 09:04:56', 80),
(939, 2238, 0, '459', '2018-10-13 11:55:39', 80),
(940, 2412, 0, '1311', '2018-10-13 12:24:58', 80),
(941, 2239, 0, '', '2018-10-14 04:13:30', 80),
(942, 2450, 0, '', '2018-10-14 10:06:38', 80),
(943, 1282, 0, '', '2018-10-14 10:27:28', 80),
(944, 1235, 0, '', '2018-10-14 10:45:54', 80),
(945, 1235, 0, '', '2018-10-16 07:35:11', 80),
(946, 2189, 0, '710', '2018-10-16 09:40:34', 80),
(947, 1817, 0, '', '2018-10-16 10:03:23', 80),
(948, 2211, 0, '882', '2018-10-16 10:05:19', 80),
(949, 2427, 0, '549', '2018-10-16 10:35:08', 80);
INSERT INTO `tbl_user_comments` (`id`, `user_id`, `user_group`, `comments`, `posted_date`, `posted_by`) VALUES
(950, 1666, 0, '2890', '2018-10-17 06:50:33', 80),
(951, 2366, 0, '522', '2018-10-17 10:02:46', 80),
(952, 2189, 0, '1419', '2018-10-17 10:30:23', 80),
(953, 796, 0, '', '2018-10-21 12:31:47', 80),
(954, 322, 0, '', '2018-10-21 12:49:48', 80),
(955, 1840, 0, '', '2018-10-21 13:10:52', 80);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_ratting`
--

CREATE TABLE `tbl_user_ratting` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT '0',
  `order_id` int(11) DEFAULT NULL,
  `d_id` int(11) DEFAULT '0',
  `ratting` int(2) DEFAULT '0',
  `status` int(2) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_user_ratting`
--

INSERT INTO `tbl_user_ratting` (`id`, `user_id`, `order_id`, `d_id`, `ratting`, `status`) VALUES
(1, 11, NULL, 50, 2, 1),
(2, 11, NULL, 50, 2, 1),
(3, 2, NULL, 50, 3, 1),
(4, 2, NULL, 50, 2, 1),
(5, 5, 9, 50, 5, 1),
(6, 2, 8, 50, 3, 1),
(7, 2, 5, 50, 5, 1),
(8, 8, 7, 50, 5, 1),
(9, 13, 18, 50, 5, 1),
(10, 5, 11, 50, 4, 1),
(11, 5, 12, 50, 5, 1),
(12, 5, 13, 50, 5, 1),
(13, 5, 14, 50, 4, 1),
(14, 11, 16, 50, 4, 1),
(15, 2, 20, 50, 5, 1),
(16, 18, 44, 50, 5, 1),
(17, 11, 46, 50, 5, 1),
(18, 13, 56, 50, 5, 1),
(19, 2, 60, 50, 5, 1),
(20, 11, 66, 50, 5, 1),
(21, 2, 88, 50, 5, 1),
(22, 6, 99, 50, 5, 1),
(23, 6, 100, 50, 4, 1),
(24, 8, 106, 50, 4, 1),
(25, 2, 108, 50, 4, 1),
(26, 5, 121, 50, 4, 1),
(27, 5, 122, 50, 1, 1),
(28, 5, 123, 50, 3, 1),
(29, 5, 124, 50, 3, 1),
(30, 2, 128, 50, 5, 1),
(31, 5, 119, 50, 5, 1),
(32, 5, 120, 50, 5, 1),
(33, 2, 132, 50, 3, 1),
(34, 10, 135, 50, 2, 1),
(35, 31, 139, 50, 4, 1),
(36, 5, 159, 69, 4, 1),
(37, 5, 160, 69, 5, 1),
(38, 5, 161, 69, 2, 1),
(39, 100, 162, 69, 4, 1),
(40, 2, 201, 69, 4, 1),
(41, 75, 202, 69, 4, 1),
(42, 26, 298, 69, 5, 1),
(43, 317, 334, 69, 5, 1),
(44, 5, 344, 69, 2, 1),
(45, 336, 380, 69, 5, 1),
(46, 336, 385, 69, 5, 1),
(47, 383, 386, 69, 2, 1),
(48, 377, 383, 69, 1, 1),
(49, 209, 391, 69, 2, 1),
(50, 406, 393, 69, 5, 1),
(51, 385, 390, 69, 5, 1),
(52, 365, 389, 69, 5, 1),
(53, 344, 395, 69, 3, 1),
(54, 388, 400, 69, 4, 1),
(55, 388, 408, 69, 4, 1),
(56, 434, 417, 69, 5, 1),
(57, 5, 422, 69, 5, 1),
(58, 5, 424, 69, 3, 1),
(59, 1, 1, 1, 4, 1),
(60, 1, 1, 1, 4, 1),
(61, 5, 425, 69, 4, 1),
(62, 5, 425, 69, 4, 1),
(63, 5, 425, 69, 4, 1),
(64, 5, 425, 69, 4, 1),
(65, 5, 425, 69, 4, 1),
(66, 5, 425, 69, 4, 1),
(67, 5, 425, 69, 4, 1),
(68, 5, 425, 69, 4, 1),
(69, 5, 425, 69, 4, 1),
(70, 5, 426, 69, 3, 1),
(71, 5, 425, 69, 4, 1),
(72, 428, 427, 69, 5, 1),
(73, 388, 415, 69, 2, 1),
(74, 383, 413, 69, 5, 1),
(75, 355, 423, 69, 5, 1),
(76, 342, 419, 69, 5, 1),
(77, 451, 432, 69, 4, 1),
(78, 481, 451, 69, 5, 1),
(79, 480, 450, 69, 5, 1),
(80, 515, 455, 69, 4, 1),
(81, 487, 458, 69, 4, 1),
(82, 505, 453, 69, 4, 1),
(83, 355, 456, 69, 5, 1),
(84, 514, 454, 69, 5, 1),
(85, 521, 460, 69, 4, 1),
(86, 351, 464, 69, 3, 1),
(87, 529, 465, 69, 5, 1),
(88, 512, 473, 69, 5, 1),
(89, 479, 467, 69, 5, 1),
(90, 473, 471, 69, 5, 1),
(91, 385, 476, 69, 5, 1),
(92, 388, 479, 69, 5, 1),
(93, 5, 486, 69, 3, 1),
(94, 26, 489, 69, 5, 1),
(95, 2, 491, 69, 4, 1),
(96, 365, 490, 69, 5, 1),
(97, 517, 484, 69, 5, 1),
(98, 426, 488, 69, 5, 1),
(99, 336, 503, 69, 5, 1),
(100, 383, 501, 69, 2, 1),
(101, 586, 508, 69, 5, 1),
(102, 336, 509, 69, 5, 1),
(103, 470, 510, 69, 5, 1),
(104, 587, 511, 69, 5, 1),
(105, 323, 513, 69, 5, 1),
(106, 470, 515, 69, 4, 1),
(107, 598, 571, 69, 5, 1),
(108, 656, 574, 69, 5, 1),
(109, 722, 575, 69, 5, 1),
(110, 671, 578, 69, 5, 1),
(111, 607, 577, 69, 5, 1),
(112, 2, 585, 69, 5, 1),
(113, 659, 561, 69, 5, 1),
(114, 796, 582, 69, 5, 1),
(115, 548, 580, 69, 5, 1),
(116, 548, 581, 69, 5, 1),
(117, 664, 583, 69, 5, 1),
(118, 858, 588, 69, 5, 1),
(119, 793, 586, 69, 5, 1),
(120, 385, 593, 69, 5, 1),
(121, 545, 591, 69, 5, 1),
(122, 137, 595, 69, 5, 1),
(123, 517, 592, 69, 5, 1),
(124, 847, 599, 69, 5, 1),
(125, 383, 600, 69, 5, 1),
(126, 768, 604, 69, 5, 1),
(127, 888, 607, 69, 5, 1),
(128, 875, 605, 69, 5, 1),
(129, 846, 606, 69, 5, 1),
(130, 795, 611, 69, 5, 1),
(131, 481, 619, 69, 5, 1),
(132, 517, 650, 69, 5, 1),
(133, 947, 653, 69, 5, 1),
(134, 211, 661, 69, 5, 1),
(135, 976, 658, 69, 5, 1),
(136, 403, 659, 69, 5, 1),
(137, 46, 660, 69, 5, 1),
(138, 327, 662, 69, 5, 1),
(139, 598, 665, 69, 5, 1),
(140, 981, 670, 69, 5, 1),
(141, 978, 669, 69, 5, 1),
(142, 365, 685, 69, 5, 1),
(143, 702, 684, 69, 4, 1),
(144, 211, 688, 69, 5, 1),
(145, 796, 686, 69, 4, 1),
(146, 8, 666, 69, 5, 1),
(147, 473, 693, 69, 5, 1),
(148, 517, 691, 69, 5, 1),
(149, 988, 689, 69, 5, 1),
(150, 447, 708, 69, 5, 1),
(151, 473, 706, 69, 5, 1),
(152, 999, 705, 69, 5, 1),
(153, 992, 690, 69, 5, 1),
(154, 137, 703, 69, 5, 1),
(155, 875, 692, 69, 5, 1),
(156, 490, 715, 69, 5, 1),
(157, 337, 718, 69, 5, 1),
(158, 1000, 719, 69, 5, 1),
(159, 517, 709, 69, 5, 1),
(160, 978, 725, 69, 5, 1),
(161, 702, 727, 69, 5, 1),
(162, 545, 729, 69, 5, 1),
(163, 517, 743, 69, 4, 1),
(164, 517, 728, 69, 5, 1),
(165, 648, 742, 69, 5, 1),
(166, 351, 737, 69, 5, 1),
(167, 659, 726, 69, 5, 1),
(168, 1010, 744, 69, 5, 1),
(169, 385, 746, 69, 5, 1),
(170, 768, 745, 69, 5, 1),
(171, 325, 753, 69, 5, 1),
(172, 137, 752, 69, 5, 1),
(173, 475, 754, 69, 5, 1),
(174, 883, 750, 69, 5, 1),
(175, 517, 751, 69, 5, 1),
(176, 1000, 762, 69, 5, 1),
(177, 976, 763, 69, 5, 1),
(178, 517, 770, 69, 5, 1),
(179, 26, 774, 69, 5, 1),
(180, 26, 775, 69, 5, 1),
(181, 7, 778, 69, 5, 1),
(182, 8, 787, 69, 3, 1),
(183, 8, 788, 69, 3, 1),
(184, 851, 784, 69, 5, 1),
(185, 11, 791, 69, 1, 1),
(186, 322, 793, 69, 2, 1),
(187, 397, 822, 69, 5, 1),
(188, 1038, 825, 69, 5, 1),
(189, 888, 794, 69, 5, 1),
(190, 363, 826, 69, 5, 1),
(191, 659, 820, 69, 5, 1),
(192, 517, 838, 69, 5, 1),
(193, 966, 857, 69, 5, 1),
(194, 1047, 856, 69, 5, 1),
(195, 517, 859, 69, 0, 1),
(196, 751, 860, 69, 4, 1),
(197, 1021, 862, 69, 5, 1),
(198, 6, 864, 69, 0, 1),
(199, 26, 866, 69, 5, 1),
(200, 11, 869, 69, 0, 1),
(201, 11, 867, 69, 0, 1),
(202, 11, 868, 69, 0, 1),
(203, 26, 871, 69, 5, 1),
(204, 355, 870, 69, 5, 1),
(205, 875, 863, 69, 5, 1),
(206, 644, 874, 69, 0, 1),
(207, 517, 872, 69, 5, 1),
(208, 702, 879, 69, 5, 1),
(209, 26, 881, 69, 4, 1),
(210, 490, 882, 69, 5, 1),
(211, 836, 890, 69, 5, 1),
(212, 470, 891, 69, 5, 1),
(213, 927, 911, 69, 5, 1),
(214, 978, 909, 69, 5, 1),
(215, 435, 920, 69, 0, 1),
(216, 375, 918, 69, 5, 1),
(217, 517, 912, 69, 0, 1),
(218, 648, 915, 69, 5, 1),
(219, 659, 885, 69, 5, 1),
(220, 1064, 929, 69, 5, 1),
(221, 1021, 887, 69, 5, 1),
(222, 365, 930, 69, 5, 1),
(223, 1068, 936, 69, 5, 1),
(224, 447, 935, 69, 0, 1),
(225, 796, 933, 69, 5, 1),
(226, 517, 932, 69, 5, 1),
(227, 11, 960, 69, 3, 1),
(228, 470, 956, 69, 4, 1),
(229, 517, 958, 69, 5, 1),
(230, 751, 957, 69, 5, 1),
(231, 1021, 955, 69, 5, 1),
(232, 1064, 969, 69, 5, 1),
(233, 327, 963, 69, 5, 1),
(234, 26, 970, 69, 5, 1),
(235, 26, 968, 69, 5, 1),
(236, 26, 967, 69, 5, 1),
(237, 26, 966, 69, 5, 1),
(238, 717, 962, 69, 5, 1),
(239, 517, 991, 69, 5, 1),
(240, 487, 993, 69, 5, 1),
(241, 1028, 989, 69, 5, 1),
(242, 338, 992, 69, 5, 1),
(243, 875, 999, 69, 3, 1),
(244, 8, 1001, 69, 0, 1),
(245, 1094, 1000, 69, 0, 1),
(246, 927, 998, 69, 5, 1),
(247, 875, 999, 69, 0, 1),
(248, 1094, 1000, 69, 0, 1),
(249, 659, 1006, 69, 5, 1),
(250, 1100, 1014, 69, 5, 1),
(251, 765, 1020, 69, 0, 1),
(252, 717, 1032, 69, 0, 1),
(253, 796, 1036, 69, 0, 1),
(254, 1128, 1067, 69, 0, 1),
(255, 1121, 1065, 69, 0, 1),
(256, 691, 1068, 69, 0, 1),
(257, 447, 1073, 69, 0, 1),
(258, 1135, 1076, 69, 0, 1),
(259, 1136, 1074, 69, 0, 1),
(260, 365, 1078, 69, 0, 1),
(261, 1116, 1077, 69, 0, 1),
(262, 927, 1079, 69, 5, 1),
(263, 1130, 1066, 69, 0, 1),
(264, 1137, 1071, 69, 0, 1),
(265, 355, 1084, 69, 0, 1),
(266, 851, 1096, 69, 0, 1),
(267, 1184, 1099, 69, 0, 1),
(268, 11, 1105, 69, 4, 1),
(269, 517, 1103, 69, 0, 1),
(270, 1215, 1113, 69, 0, 1),
(271, 5, 1120, 69, 0, 1),
(272, 5, 1121, 69, 0, 1),
(273, 1208, 1122, 69, 0, 1),
(274, 1133, 1101, 69, 0, 1),
(275, 1222, 1124, 69, 0, 1),
(276, 1219, 1123, 69, 0, 1),
(277, 1242, 1133, 69, 0, 1),
(278, 1226, 1131, 69, 0, 1),
(279, 1223, 1132, 69, 0, 1),
(280, 435, 1127, 69, 0, 1),
(281, 1230, 1129, 69, 0, 1),
(282, 978, 1139, 69, 0, 1),
(283, 1135, 1136, 69, 0, 1),
(284, 1021, 1138, 69, 0, 1),
(285, 514, 1145, 69, 0, 1),
(286, 1184, 1140, 69, 0, 1),
(287, 797, 1142, 69, 0, 1),
(288, 1235, 1144, 69, 0, 1),
(289, 1068, 1143, 69, 0, 1),
(290, 16, 1154, 69, 0, 1),
(291, 517, 1151, 69, 0, 1),
(292, 1249, 1149, 69, 0, 1),
(293, 1252, 1150, 69, 0, 1),
(294, 1252, 1148, 69, 0, 1),
(295, 383, 1155, 69, 0, 1),
(296, 8, 1161, 69, 0, 1),
(297, 514, 1183, 69, 0, 1),
(298, 649, 1170, 69, 0, 1),
(299, 1282, 1175, 69, 0, 1),
(300, 1290, 1182, 69, 0, 1),
(301, 11, 1197, 69, 3, 1),
(302, 1258, 1189, 69, 0, 1),
(303, 447, 1192, 69, 0, 1),
(304, 91, 1212, 69, 0, 1),
(305, 1322, 1213, 69, 0, 1),
(306, 1319, 1211, 69, 0, 1),
(307, 381, 1235, 69, 0, 1),
(308, 5, 1247, 69, 3, 1),
(309, 5, 1248, 69, 0, 1),
(310, 5, 1249, 69, 0, 1),
(311, 1136, 1233, 69, 0, 1),
(312, 1282, 1239, 69, 0, 1),
(313, 1028, 1251, 69, 0, 1),
(314, 1236, 1244, 69, 4, 1),
(315, 1235, 1240, 69, 0, 1),
(316, 1317, 1252, 69, 0, 1),
(317, 699, 1253, 69, 0, 1),
(318, 1377, 1258, 69, 0, 1),
(319, 1236, 1256, 69, 0, 1),
(320, 797, 1254, 69, 0, 1),
(321, 702, 1259, 69, 0, 1),
(322, 796, 1262, 69, 0, 1),
(323, 1381, 1263, 69, 0, 1),
(324, 1382, 1264, 69, 0, 1),
(325, 1389, 1271, 69, 0, 1),
(326, 1387, 1278, 69, 0, 1),
(327, 1408, 1280, 69, 0, 1),
(328, 949, 1277, 69, 0, 1),
(329, 1235, 1279, 69, 0, 1),
(330, 8, 1288, 69, 3, 1),
(331, 851, 1286, 69, 0, 1),
(332, 1379, 1283, 69, 0, 1),
(333, 699, 1292, 69, 0, 1),
(334, 483, 1293, 69, 0, 1),
(335, 91, 1285, 69, 0, 1),
(336, 1260, 1294, 69, 0, 1),
(337, 949, 1296, 69, 0, 1),
(338, 1235, 1298, 69, 0, 1),
(339, 381, 1295, 69, 0, 1),
(340, 1445, 1314, 69, 0, 1),
(341, 1437, 1312, 69, 0, 1),
(342, 8, 1320, 69, 0, 1),
(343, 1447, 1316, 69, 0, 1),
(344, 1116, 1322, 69, 0, 1),
(345, 1476, 1353, 69, 0, 1),
(346, 1479, 1359, 69, 0, 1),
(347, 971, 1363, 69, 4, 1),
(348, 447, 1364, 69, 4, 1),
(349, 1343, 1362, 69, 5, 1),
(350, 1477, 1356, 69, 4, 1),
(351, 1485, 1368, 69, 0, 1),
(352, 1379, 1370, 69, 0, 1),
(353, 1235, 1365, 69, 0, 1),
(354, 447, 1374, 69, 0, 1),
(355, 1256, 1397, 69, 0, 1),
(356, 1528, 1396, 69, 0, 1),
(357, 331, 1394, 69, 0, 1),
(358, 1498, 1398, 69, 0, 1),
(359, 1236, 1407, 69, 0, 1),
(360, 1539, 1405, 69, 0, 1),
(361, 1371, 1408, 69, 0, 1),
(362, 1087, 1414, 69, 0, 1),
(363, 1552, 1416, 69, 0, 1),
(364, 1235, 1413, 69, 0, 1),
(365, 945, 1412, 69, 0, 1),
(366, 1547, 1409, 69, 0, 1),
(367, 796, 1420, 69, 0, 1),
(368, 1464, 1419, 69, 0, 1),
(369, 514, 1421, 69, 0, 1),
(370, 1476, 1432, 69, 0, 1),
(371, 1235, 1429, 69, 0, 1),
(372, 1447, 1431, 69, 0, 1),
(373, 1498, 1434, 69, 4, 1),
(374, 1549, 1411, 69, 0, 1),
(375, 1428, 1441, 69, 5, 1),
(376, 1576, 1446, 69, 5, 1),
(377, 1479, 1440, 69, 5, 1),
(378, 1465, 1426, 69, 0, 1),
(379, 548, 1444, 69, 0, 1),
(380, 517, 1447, 69, 5, 1),
(381, 1568, 1449, 69, 5, 1),
(382, 1133, 1450, 69, 5, 1),
(383, 1579, 1451, 69, 5, 1),
(384, 1476, 1454, 69, 5, 1),
(385, 1593, 1469, 69, 0, 1),
(386, 1469, 1471, 69, 2, 1),
(387, 1479, 1530, 69, 0, 1),
(388, 1479, 1531, 69, 0, 1),
(389, 702, 1556, 69, 0, 1),
(390, 1655, 1585, 69, 0, 1),
(391, 1484, 1584, 69, 0, 1),
(392, 1476, 1593, 69, 0, 1),
(393, 1282, 1576, 69, 0, 1),
(394, 1366, 1590, 69, 0, 1),
(395, 1562, 1625, 69, 0, 1),
(396, 1562, 1628, 69, 0, 1),
(397, 1562, 1626, 69, 0, 1),
(398, 1562, 1629, 69, 0, 1),
(399, 1562, 1627, 69, 0, 1),
(400, 1476, 1623, 69, 0, 1),
(401, 1662, 1622, 69, 0, 1),
(402, 1476, 1635, 69, 3, 1),
(403, 1681, 1648, 69, 4, 1),
(404, 365, 1649, 69, 0, 1),
(405, 1484, 1652, 69, 0, 1),
(406, 90, 1647, 69, 0, 1),
(407, 1684, 1650, 69, 0, 1),
(408, 1087, 1657, 69, 0, 1),
(409, 1235, 1654, 69, 0, 1),
(410, 1620, 1660, 69, 5, 1),
(411, 1702, 1681, 69, 5, 1),
(412, 1705, 1683, 69, 5, 1),
(413, 1518, 1686, 69, 5, 1),
(414, 1684, 1685, 69, 0, 1),
(415, 1185, 1688, 69, 0, 1),
(416, 1235, 1693, 69, 0, 1),
(417, 1133, 1705, 69, 4, 1),
(418, 1048, 1707, 69, 4, 1),
(419, 1484, 1708, 69, 5, 1),
(420, 1498, 1710, 69, 2, 1),
(421, 447, 1715, 69, 4, 1),
(422, 1094, 1753, 69, 1, 1),
(423, 1235, 1759, 69, 1, 1),
(424, 1705, 1762, 69, 5, 1),
(425, 1744, 1763, 69, 1, 1),
(426, 796, 1760, 69, 1, 1),
(427, 1727, 1761, 69, 5, 1),
(428, 1409, 1778, 69, 3, 1),
(429, 1087, 1774, 69, 3, 1),
(430, 1757, 1773, 69, 4, 1),
(431, 851, 1781, 69, 2, 1),
(432, 1235, 1780, 69, 5, 1),
(433, 1744, 1772, 69, 4, 1),
(434, 1757, 1791, 69, 0, 1),
(435, 1133, 1789, 69, 3, 1),
(436, 383, 1793, 69, 3, 1),
(437, 383, 1793, 69, 3, 1),
(438, 1771, 1800, 69, 4, 1),
(439, 1235, 1811, 69, 4, 1),
(440, 1562, 1818, 69, 5, 1),
(441, 1583, 1819, 69, 4, 1),
(442, 1583, 1819, 69, 0, 1),
(443, 1562, 1821, 69, 4, 1),
(444, 1783, 1820, 69, 4, 1),
(445, 1793, 1817, 69, 3, 1),
(446, 1784, 1815, 69, 4, 1),
(447, 1757, 1826, 69, 4, 1),
(448, 1260, 1829, 69, 4, 1),
(449, 1235, 1830, 69, 4, 1),
(450, 1476, 1831, 69, 4, 1),
(451, 1087, 1835, 69, 0, 1),
(452, 1476, 1844, 69, 4, 1),
(453, 1379, 1843, 69, 4, 1),
(454, 796, 1845, 69, 4, 1),
(455, 1356, 1827, 69, 5, 1),
(456, 1817, 1851, 69, 4, 1),
(457, 1814, 1850, 69, 4, 1),
(458, 1825, 1858, 69, 3, 1),
(459, 1235, 1856, 69, 0, 1),
(460, 1705, 1863, 69, 5, 1),
(461, 1705, 1867, 69, 5, 1),
(462, 1568, 1859, 69, 2, 1),
(463, 365, 1866, 69, 2, 1),
(464, 8, 1870, 69, 0, 1),
(465, 487, 1862, 69, 4, 1),
(466, 1579, 1868, 69, 5, 1),
(467, 1718, 1871, 69, 4, 1),
(468, 1235, 1876, 69, 3, 1),
(469, 1412, 1874, 69, 4, 1),
(470, 1852, 1878, 69, 3, 1),
(471, 1702, 1884, 69, 4, 1),
(472, 1447, 1873, 69, 4, 1),
(473, 1588, 1875, 69, 4, 1),
(474, 1137, 1882, 69, 5, 1),
(475, 1859, 1886, 69, 5, 1),
(476, 1866, 1894, 69, 0, 1),
(477, 1558, 1892, 69, 4, 1),
(478, 1817, 1896, 69, 2, 1),
(479, 1864, 1895, 69, 5, 1),
(480, 1852, 1897, 69, 4, 1),
(481, 1379, 1898, 69, 4, 1),
(482, 383, 1899, 69, 3, 1),
(483, 1830, 1904, 69, 4, 1),
(484, 1021, 1912, 69, 4, 1),
(485, 1705, 1911, 69, 4, 1),
(486, 1094, 1923, 69, 3, 1),
(487, 1891, 1924, 69, 5, 1),
(488, 447, 1921, 69, 3, 1),
(489, 1235, 1925, 69, 3, 1),
(490, 487, 1917, 69, 5, 1),
(491, 1892, 1931, 69, 4, 1),
(492, 1861, 1940, 69, 5, 1),
(493, 1579, 1947, 69, 0, 1),
(494, 1864, 1948, 69, 4, 1),
(495, 796, 1950, 69, 4, 1),
(496, 1235, 1957, 69, 4, 1),
(497, 1814, 1974, 69, 4, 1),
(498, 1498, 1973, 69, 0, 1),
(499, 1694, 1972, 69, 4, 1),
(500, 1705, 1969, 69, 4, 1),
(501, 945, 1975, 69, 4, 1),
(502, 1926, 1968, 69, 4, 1),
(503, 1282, 1971, 69, 4, 1),
(504, 1518, 1982, 69, 4, 1),
(505, 1048, 1981, 69, 4, 1),
(506, 1579, 1980, 69, 4, 1),
(507, 1047, 1979, 69, 4, 1),
(508, 1235, 1978, 69, 4, 1),
(509, 1821, 1983, 69, 4, 1),
(510, 1694, 1984, 69, 4, 1),
(511, 1085, 1989, 69, 4, 1),
(512, 1947, 1991, 69, 4, 1),
(513, 1939, 1990, 69, 4, 1),
(514, 1957, 2000, 69, 4, 1),
(515, 1817, 1995, 69, 3, 1),
(516, 1379, 1999, 69, 4, 1),
(517, 796, 1993, 69, 3, 1),
(518, 1676, 2008, 69, 4, 1),
(519, 1514, 2012, 69, 4, 1),
(520, 1465, 2009, 69, 4, 1),
(521, 1872, 2010, 69, 4, 1),
(522, 1980, 2022, 69, 4, 1),
(523, 1094, 2017, 69, 4, 1),
(524, 1694, 2023, 69, 4, 1),
(525, 1235, 2025, 69, 4, 1),
(526, 796, 2029, 69, 0, 1),
(527, 1993, 2035, 69, 2, 1),
(528, 1998, 2041, 69, 4, 1),
(529, 1814, 2031, 69, 3, 1),
(530, 1705, 2033, 69, 3, 1),
(531, 1235, 2038, 69, 3, 1),
(532, 2004, 2043, 69, 3, 1),
(533, 1085, 2037, 69, 3, 1),
(534, 2001, 2042, 69, 3, 1),
(535, 1465, 2048, 69, 3, 1),
(536, 322, 2047, 69, 5, 1),
(537, 1817, 2049, 69, 4, 1),
(538, 1087, 2046, 69, 0, 1),
(539, 1465, 2052, 69, 0, 1),
(540, 1235, 2054, 69, 4, 1),
(541, 381, 2055, 69, 4, 1),
(542, 1884, 2056, 69, 4, 1),
(543, 1082, 2062, 69, 4, 1),
(544, 2024, 2060, 69, 4, 1),
(545, 2029, 2063, 69, 4, 1),
(546, 2029, 2064, 69, 4, 1),
(547, 517, 2051, 69, 4, 1),
(548, 1975, 2011, 69, 4, 1),
(549, 1498, 2068, 69, 4, 1),
(550, 1235, 2070, 69, 4, 1),
(551, 1945, 2069, 69, 4, 1),
(552, 447, 2075, 69, 4, 1),
(553, 1465, 2076, 69, 4, 1),
(554, 447, 2079, 69, 0, 1),
(555, 447, 2080, 69, 0, 1),
(556, 447, 2080, 69, 0, 1),
(557, 447, 2080, 69, 4, 1),
(558, 447, 2080, 69, 4, 1),
(559, 447, 2080, 69, 4, 1),
(560, 447, 2080, 69, 4, 1),
(561, 447, 2080, 69, 4, 1),
(562, 447, 2080, 69, 4, 1),
(563, 447, 2080, 69, 5, 1),
(564, 447, 2080, 69, 5, 1),
(565, 1379, 2082, 69, 4, 1),
(566, 1379, 2082, 69, 4, 1),
(567, 1379, 2082, 69, 4, 1),
(568, 1379, 2082, 69, 4, 1),
(569, 1379, 2082, 69, 4, 1),
(570, 1379, 2082, 69, 4, 1),
(571, 1379, 2082, 69, 4, 1),
(572, 1379, 2082, 69, 4, 1),
(573, 1379, 2082, 69, 4, 1),
(574, 1235, 2084, 69, 4, 1),
(575, 1235, 2084, 69, 4, 1),
(576, 1705, 2083, 69, 4, 1),
(577, 1705, 2083, 69, 4, 1),
(578, 1705, 2083, 69, 4, 1),
(579, 1325, 2085, 69, 4, 1),
(580, 1479, 2091, 69, 0, 1),
(581, 1479, 2091, 69, 4, 1),
(582, 1479, 2091, 69, 4, 1),
(583, 1814, 2094, 69, 4, 1),
(584, 2071, 2099, 69, 0, 1),
(585, 1884, 2098, 69, 5, 1),
(586, 1884, 2098, 69, 5, 1),
(587, 1465, 2103, 69, 4, 1),
(588, 1705, 2097, 69, 4, 1),
(589, 1705, 2097, 69, 4, 1),
(590, 1705, 2097, 69, 4, 1),
(591, 1705, 2097, 69, 4, 1),
(592, 2074, 2101, 69, 4, 1),
(593, 2078, 2104, 69, 4, 1),
(594, 1817, 2106, 69, 4, 1),
(595, 1518, 2107, 69, 4, 1),
(596, 1518, 2107, 69, 4, 1),
(597, 1366, 2108, 69, 3, 1),
(598, 383, 2109, 69, 0, 1),
(599, 1235, 2112, 69, 4, 1),
(600, 1235, 2112, 69, 4, 1),
(601, 1235, 2112, 69, 4, 1),
(602, 1235, 2112, 69, 4, 1),
(603, 1235, 2112, 69, 4, 1),
(604, 1235, 2112, 69, 4, 1),
(605, 702, 2117, 69, 4, 1),
(606, 702, 2117, 69, 4, 1),
(607, 702, 2117, 69, 4, 1),
(608, 702, 2117, 69, 4, 1),
(609, 702, 2117, 69, 4, 1),
(610, 2090, 2114, 69, 4, 1),
(611, 2029, 2120, 69, 4, 1),
(612, 2029, 2120, 69, 4, 1),
(613, 1137, 2118, 69, 4, 1),
(614, 1137, 2118, 69, 4, 1),
(615, 1137, 2118, 69, 4, 1),
(616, 1137, 2118, 69, 4, 1),
(617, 1137, 2118, 69, 4, 1),
(618, 796, 2119, 69, 4, 1),
(619, 796, 2119, 69, 4, 1),
(620, 796, 2119, 69, 4, 1),
(621, 796, 2119, 69, 4, 1),
(622, 1840, 2111, 69, 4, 1),
(623, 1840, 2111, 69, 4, 1),
(624, 1840, 2111, 69, 4, 1),
(625, 2092, 2115, 69, 4, 1),
(626, 2092, 2115, 69, 4, 1),
(627, 2104, 2123, 69, 4, 1),
(628, 2105, 2124, 69, 4, 1),
(629, 1744, 2127, 69, 4, 1),
(630, 1744, 2127, 69, 4, 1),
(631, 1744, 2127, 69, 4, 1),
(632, 1588, 2131, 69, 4, 1),
(633, 1814, 2134, 69, 4, 1),
(634, 2106, 2128, 69, 4, 1),
(635, 1715, 2138, 69, 4, 1),
(636, 1715, 2138, 69, 4, 1),
(637, 1892, 2132, 69, 4, 1),
(638, 1072, 2139, 69, 4, 1),
(639, 1705, 2143, 69, 4, 1),
(640, 1705, 2144, 69, 4, 1),
(641, 1021, 2145, 69, 4, 1),
(642, 1094, 2155, 69, 4, 1),
(643, 1094, 2268, 80, 4, 1),
(644, 649, 2273, 80, 4, 1),
(645, 2171, 2301, 80, 4, 1),
(646, 2075, 2291, 80, 4, 1),
(647, 2153, 2294, 80, 4, 1),
(648, 2195, 2298, 80, 4, 1),
(649, 2126, 2299, 80, 4, 1),
(650, 2202, 2305, 80, 4, 1),
(651, 1085, 2303, 80, 0, 1),
(652, 1817, 2302, 80, 4, 1),
(653, 2092, 2293, 80, 4, 1),
(654, 1892, 2310, 80, 4, 1),
(655, 2199, 2304, 80, 4, 1),
(656, 2187, 2289, 80, 4, 1),
(657, 1694, 2296, 80, 4, 1),
(658, 2205, 2315, 80, 4, 1),
(659, 2222, 2348, 80, 0, 1),
(660, 2202, 2341, 80, 4, 1),
(661, 2222, 2351, 80, 0, 1),
(662, 1235, 2344, 80, 4, 1),
(663, 649, 2342, 80, 4, 1),
(664, 2222, 2352, 80, 0, 1),
(665, 796, 2343, 80, 4, 1),
(666, 713, 2384, 80, 4, 1),
(667, 2167, 2388, 80, 4, 1),
(668, 2158, 2385, 80, 4, 1),
(669, 2238, 2380, 80, 4, 1),
(670, 1133, 2391, 80, 4, 1),
(671, 2186, 2398, 80, 4, 1),
(672, 2221, 2387, 80, 4, 1),
(673, 322, 2372, 80, 4, 1),
(674, 1827, 2397, 80, 4, 1),
(675, 2239, 2536, 80, 4, 1),
(676, 1235, 2529, 80, 4, 1),
(677, 1744, 2538, 80, 4, 1),
(678, 1047, 2539, 80, 4, 1),
(679, 1498, 2545, 80, 4, 1),
(680, 2189, 2542, 80, 4, 1),
(681, 2278, 2548, 80, 4, 1),
(682, 1884, 2540, 80, 4, 1),
(683, 1705, 2541, 80, 4, 1),
(684, 2301, 2568, 80, 4, 1),
(685, 2189, 2576, 80, 4, 1),
(686, 2311, 2578, 80, 4, 1),
(687, 2328, 2598, 80, 4, 1),
(688, 2199, 2596, 80, 4, 1),
(689, 2326, 2597, 80, 4, 1),
(690, 2330, 2600, 80, 4, 1),
(691, 2252, 2619, 80, 4, 1),
(692, 713, 2621, 80, 4, 1),
(693, 2203, 2641, 80, 4, 1),
(694, 2167, 2624, 80, 4, 1),
(695, 2202, 2627, 80, 4, 1),
(696, 2075, 2690, 80, 4, 1),
(697, 2252, 2677, 80, 4, 1),
(698, 2394, 2694, 80, 4, 1),
(699, 1814, 2697, 80, 4, 1),
(700, 2186, 2693, 80, 4, 1),
(701, 875, 2689, 80, 4, 1),
(702, 875, 2689, 80, 4, 1),
(703, 875, 2689, 80, 4, 1),
(704, 875, 2689, 80, 4, 1),
(705, 1133, 2702, 80, 4, 1),
(706, 2189, 2704, 80, 5, 1),
(707, 239, 2699, 80, 5, 1),
(708, 1094, 2705, 80, 4, 1),
(709, 1094, 2705, 80, 4, 1),
(710, 1094, 2705, 80, 4, 1),
(711, 1235, 2707, 80, 4, 1),
(712, 1817, 2710, 80, 5, 1),
(713, 2185, 2713, 80, 4, 1),
(714, 1235, 2718, 80, 4, 1),
(715, 2134, 2721, 80, 4, 1),
(716, 1814, 2731, 80, 4, 1),
(717, 322, 2725, 80, 4, 1),
(718, 649, 2736, 80, 4, 1),
(719, 1872, 2729, 80, 4, 1),
(720, 2152, 2732, 80, 4, 1),
(721, 2427, 2723, 80, 4, 1),
(722, 1514, 2727, 80, 4, 1),
(723, 2202, 2748, 80, 4, 1),
(724, 649, 2749, 80, 4, 1),
(725, 717, 2754, 80, 4, 1),
(726, 2448, 2746, 80, 4, 1),
(727, 2304, 2750, 80, 4, 1),
(728, 2206, 2752, 80, 4, 1),
(729, 2310, 2756, 80, 4, 1),
(730, 2454, 2769, 80, 4, 1),
(731, 2158, 2770, 80, 4, 1),
(732, 2180, 2773, 80, 4, 1),
(733, 1085, 2757, 80, 4, 1),
(734, 1498, 2776, 80, 4, 1),
(735, 2469, 2779, 80, 4, 1),
(736, 2366, 2765, 80, 4, 1),
(737, 2366, 2777, 80, 4, 1),
(738, 1694, 2775, 80, 4, 1),
(739, 2460, 2782, 80, 4, 1),
(740, 1442, 2786, 80, 4, 1),
(741, 2465, 2781, 80, 4, 1),
(742, 1588, 2795, 80, 4, 1),
(743, 2450, 2796, 80, 4, 1),
(744, 1814, 2845, 80, 3, 1),
(745, 2199, 2842, 80, 4, 1),
(746, 1132, 2843, 80, 4, 1),
(747, 2092, 2839, 80, 5, 1),
(748, 1419, 2844, 80, 4, 1),
(749, 2137, 2838, 80, 4, 1),
(750, 1694, 2841, 80, 4, 1),
(751, 2167, 2852, 80, 4, 1),
(752, 2238, 2853, 80, 4, 1),
(753, 2412, 2856, 80, 4, 1),
(754, 2239, 2865, 80, 1, 1),
(755, 2450, 2860, 80, 3, 1),
(756, 1282, 2872, 80, 4, 1),
(757, 1235, 2874, 80, 4, 1),
(758, 1235, 2901, 80, 4, 1),
(759, 2189, 2898, 80, 4, 1),
(760, 1817, 2897, 80, 4, 1),
(761, 2211, 2909, 80, 4, 1),
(762, 2427, 2910, 80, 4, 1),
(763, 1666, 2927, 80, 4, 1),
(764, 2366, 2925, 80, 4, 1),
(765, 2189, 2929, 80, 4, 1),
(766, 796, 2960, 80, 4, 1),
(767, 322, 2963, 80, 4, 1),
(768, 1840, 2962, 80, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wishlist`
--

CREATE TABLE `tbl_wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_price_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_area`
--
ALTER TABLE `tbl_area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_attribute`
--
ALTER TABLE `tbl_attribute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_attributegroup`
--
ALTER TABLE `tbl_attributegroup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_attributevalue`
--
ALTER TABLE `tbl_attributevalue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_banner`
--
ALTER TABLE `tbl_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_categoryimage`
--
ALTER TABLE `tbl_categoryimage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_city`
--
ALTER TABLE `tbl_city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_color`
--
ALTER TABLE `tbl_color`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_content`
--
ALTER TABLE `tbl_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_country`
--
ALTER TABLE `tbl_country`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`country`);

--
-- Indexes for table `tbl_coupon`
--
ALTER TABLE `tbl_coupon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_enquiry`
--
ALTER TABLE `tbl_enquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_faq`
--
ALTER TABLE `tbl_faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_faqcat`
--
ALTER TABLE `tbl_faqcat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_features`
--
ALTER TABLE `tbl_features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_fiesta_banner`
--
ALTER TABLE `tbl_fiesta_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_images`
--
ALTER TABLE `tbl_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_news`
--
ALTER TABLE `tbl_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_newsletter`
--
ALTER TABLE `tbl_newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_newsletter_template`
--
ALTER TABLE `tbl_newsletter_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_photo`
--
ALTER TABLE `tbl_photo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_productprice`
--
ALTER TABLE `tbl_productprice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_psizes`
--
ALTER TABLE `tbl_psizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_recommended`
--
ALTER TABLE `tbl_recommended`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_review`
--
ALTER TABLE `tbl_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_shipping_method`
--
ALTER TABLE `tbl_shipping_method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_social`
--
ALTER TABLE `tbl_social`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_subscriber`
--
ALTER TABLE `tbl_subscriber`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_testimonial`
--
ALTER TABLE `tbl_testimonial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_topic`
--
ALTER TABLE `tbl_topic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_unit`
--
ALTER TABLE `tbl_unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_useraddress`
--
ALTER TABLE `tbl_useraddress`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_comments`
--
ALTER TABLE `tbl_user_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_ratting`
--
ALTER TABLE `tbl_user_ratting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_area`
--
ALTER TABLE `tbl_area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_attribute`
--
ALTER TABLE `tbl_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_attributegroup`
--
ALTER TABLE `tbl_attributegroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_attributevalue`
--
ALTER TABLE `tbl_attributevalue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_banner`
--
ALTER TABLE `tbl_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_categoryimage`
--
ALTER TABLE `tbl_categoryimage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_city`
--
ALTER TABLE `tbl_city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_color`
--
ALTER TABLE `tbl_color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_content`
--
ALTER TABLE `tbl_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_country`
--
ALTER TABLE `tbl_country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT for table `tbl_coupon`
--
ALTER TABLE `tbl_coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_enquiry`
--
ALTER TABLE `tbl_enquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tbl_faq`
--
ALTER TABLE `tbl_faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_faqcat`
--
ALTER TABLE `tbl_faqcat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_features`
--
ALTER TABLE `tbl_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_fiesta_banner`
--
ALTER TABLE `tbl_fiesta_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_images`
--
ALTER TABLE `tbl_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_news`
--
ALTER TABLE `tbl_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_newsletter`
--
ALTER TABLE `tbl_newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tbl_newsletter_template`
--
ALTER TABLE `tbl_newsletter_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_photo`
--
ALTER TABLE `tbl_photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_productprice`
--
ALTER TABLE `tbl_productprice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_psizes`
--
ALTER TABLE `tbl_psizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_recommended`
--
ALTER TABLE `tbl_recommended`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_review`
--
ALTER TABLE `tbl_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_shipping_method`
--
ALTER TABLE `tbl_shipping_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_social`
--
ALTER TABLE `tbl_social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT for table `tbl_subscriber`
--
ALTER TABLE `tbl_subscriber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_testimonial`
--
ALTER TABLE `tbl_testimonial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_topic`
--
ALTER TABLE `tbl_topic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_unit`
--
ALTER TABLE `tbl_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_useraddress`
--
ALTER TABLE `tbl_useraddress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_user_comments`
--
ALTER TABLE `tbl_user_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=956;

--
-- AUTO_INCREMENT for table `tbl_user_ratting`
--
ALTER TABLE `tbl_user_ratting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=769;

--
-- AUTO_INCREMENT for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
