-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2022 at 05:15 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codeigniter_boilerplate`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_groups`
--

DROP TABLE IF EXISTS `admin_groups`;
CREATE TABLE `admin_groups` (
  `admin_group_id` int(11) NOT NULL,
  `group_name` varchar(50) NOT NULL DEFAULT '0',
  `group_color` varchar(100) NOT NULL DEFAULT 'info',
  `view_permissions` text DEFAULT NULL,
  `modify_permissions` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_groups`
--

INSERT INTO `admin_groups` (`admin_group_id`, `group_name`, `group_color`, `view_permissions`, `modify_permissions`) VALUES
(1, 'Administrators', 'primary', '{\"users\":true,\"permissions\":true,\"groups\":true,\"visitors\":true,\"team\":true,\"videos\":true,\"photos\":true,\"footer\":true,\"blog\":true,\"slider\":true,\"menu\":true,\"seo\":true,\"pages\":true,\"siteoptions\":true,\"portfolio\":true}', '{\"users\":true,\"permissions\":true,\"groups\":true,\"team\":true,\"videos\":true,\"photos\":true,\"footer\":true,\"blog\":true,\"slider\":true,\"menu\":true,\"seo\":true,\"pages\":true,\"siteoptions\":true,\"visitors\":true,\"portfolio\":true}'),
(2, 'Owners', 'success', '{\"siteoptions\":true}', '{\"siteoptions\":true}'),
(3, 'Bloggers', 'info', '[]', '[]');

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users` (
  `admin_id` int(11) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_password` varchar(100) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_photo` varchar(50) NOT NULL DEFAULT 'default.jpg',
  `admin_hash_for_email_verification` varchar(50) DEFAULT NULL,
  `admin_hash_for_password_reset` varchar(50) DEFAULT NULL,
  `admin_remember_me_token` varchar(200) DEFAULT NULL,
  `admin_group` int(11) NOT NULL,
  `author_name` varchar(500) DEFAULT NULL,
  `author_short_description` text DEFAULT NULL,
  `author_facebook_link` varchar(500) DEFAULT NULL,
  `author_twitter_link` varchar(500) DEFAULT NULL,
  `admin_email_verified` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`admin_id`, `admin_email`, `admin_password`, `admin_name`, `admin_photo`, `admin_hash_for_email_verification`, `admin_hash_for_password_reset`, `admin_remember_me_token`, `admin_group`, `author_name`, `author_short_description`, `author_facebook_link`, `author_twitter_link`, `admin_email_verified`) VALUES
(1, 'admin@domain.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Admin User', 'admin.jpg', '8b8389f20e57a86940754a82a6aac0df', '3c20283047f4ff5a8ce7b72a1fcc9b0217f52193', '44ccbfafa35a5001a2f1d8b8a80dbc849d3637ab', 1, 'Ankur Singh', 'Ankur is the developer and creator of this blog.', 'http://facebook.com/ankursinghagra/', 'http://twitter.com/ankursinghagra/', '1'),
(2, 'owner@domain.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Owner User', 'owner.jpg', '541b3601efeccf4baa5ee88c6670a588', NULL, '4939cd62c18660846d6e84660ad6d3203ce46a4f', 2, '', '', '', '', '1'),
(3, 'blogger@domain.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Blogger User 1', 'blogger.jpg', NULL, NULL, NULL, 3, '', '', '', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `cms_menu`
--

DROP TABLE IF EXISTS `cms_menu`;
CREATE TABLE `cms_menu` (
  `menu_id` int(11) NOT NULL,
  `menu_slug` varchar(255) DEFAULT NULL,
  `menu_title` varchar(255) NOT NULL,
  `menu_parent` int(11) DEFAULT NULL,
  `menu_sort_order` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_menu`
--

INSERT INTO `cms_menu` (`menu_id`, `menu_slug`, `menu_title`, `menu_parent`, `menu_sort_order`) VALUES
(1, 'http://cms.sapricami.com/', 'Home', NULL, 1),
(2, 'http://cms.sapricami.com/about', 'About', NULL, 2),
(3, 'http://cms.sapricami.com/work', 'Work', NULL, 3),
(4, 'http://cms.sapricami.com/team', 'Team', NULL, 4),
(5, '#', 'Gallery', NULL, 5),
(6, 'http://cms.sapricami.com/photos', 'Photos', 5, 1),
(7, 'http://cms.sapricami.com/videos', 'Videos', 5, 2),
(8, 'http://cms.sapricami.com/blog', 'Blog', NULL, 6),
(9, 'http://cms.sapricami.com/contact', 'Contact', NULL, 7);

-- --------------------------------------------------------

--
-- Table structure for table `cms_modules`
--

DROP TABLE IF EXISTS `cms_modules`;
CREATE TABLE `cms_modules` (
  `module_id` int(11) NOT NULL,
  `module_slug` varchar(100) NOT NULL,
  `module_title` varchar(100) NOT NULL,
  `module_status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_modules`
--

INSERT INTO `cms_modules` (`module_id`, `module_slug`, `module_title`, `module_status`) VALUES
(1, 'slider', 'Slider (Home Page)', '0'),
(2, 'blog', 'Blog', '0'),
(3, 'portfolio', 'Portfolio', '0'),
(4, 'photos', 'Photos Gallery', '0'),
(5, 'videos', 'Videos Gallery', '0'),
(6, 'team', 'Team', '0'),
(7, 'visitors', 'Visitors', '0');

-- --------------------------------------------------------

--
-- Table structure for table `cms_options`
--

DROP TABLE IF EXISTS `cms_options`;
CREATE TABLE `cms_options` (
  `id` int(11) NOT NULL,
  `site_name` varchar(20) DEFAULT NULL,
  `site_description` varchar(200) DEFAULT NULL,
  `theme_desktop` varchar(25) DEFAULT NULL,
  `theme_mobile` varchar(25) DEFAULT NULL,
  `maintainence_mode` enum('OFF','ON') NOT NULL DEFAULT 'OFF',
  `email_function` enum('mail','smtp') NOT NULL DEFAULT 'mail',
  `email_smtp_from` varchar(50) NOT NULL,
  `email_smtp_hostname` varchar(50) DEFAULT NULL,
  `email_smtp_port` varchar(10) DEFAULT NULL,
  `email_smtp_username` varchar(50) DEFAULT NULL,
  `email_smtp_password` varchar(50) DEFAULT NULL,
  `address_1` varchar(500) DEFAULT NULL,
  `address_2` varchar(500) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_options`
--

INSERT INTO `cms_options` (`id`, `site_name`, `site_description`, `theme_desktop`, `theme_mobile`, `maintainence_mode`, `email_function`, `email_smtp_from`, `email_smtp_hostname`, `email_smtp_port`, `email_smtp_username`, `email_smtp_password`, `address_1`, `address_2`, `phone_number`) VALUES
(1, 'Security Company', 'Security Management System', 'mdb', 'mdb', 'OFF', 'smtp', 'email@domain.com', 'ssl://domain.com', '25', 'username', 'password', '25 Baker Street', 'London', '+91 8888800000');

-- --------------------------------------------------------

--
-- Table structure for table `cms_pages`
--

DROP TABLE IF EXISTS `cms_pages`;
CREATE TABLE `cms_pages` (
  `page_id` int(11) NOT NULL,
  `page_slug` varchar(255) DEFAULT NULL,
  `page_title` varchar(255) DEFAULT NULL,
  `page_subtitle` varchar(500) DEFAULT NULL,
  `page_content_json` text DEFAULT NULL,
  `page_content_html` text DEFAULT NULL,
  `page_active` enum('1','0') NOT NULL DEFAULT '1',
  `page_reserved` enum('1','0') NOT NULL DEFAULT '0',
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `og_title` varchar(70) DEFAULT NULL,
  `og_type` varchar(20) DEFAULT 'website',
  `og_image` varchar(20) DEFAULT 'default.jpg',
  `og_description` varchar(200) DEFAULT NULL,
  `tw_title` varchar(70) DEFAULT NULL,
  `tw_card` varchar(20) DEFAULT 'summary',
  `tw_image` varchar(20) DEFAULT 'default.jpg',
  `tw_description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_pages`
--

INSERT INTO `cms_pages` (`page_id`, `page_slug`, `page_title`, `page_subtitle`, `page_content_json`, `page_content_html`, `page_active`, `page_reserved`, `meta_title`, `meta_keywords`, `meta_description`, `og_title`, `og_type`, `og_image`, `og_description`, `tw_title`, `tw_card`, `tw_image`, `tw_description`) VALUES
(1, NULL, 'Home', 'A CMS made to ascend', '{\"data\":[{\"type\":\"columns\",\"data\":{\"columns\":[{\"width\":6,\"blocks\":[{\"type\":\"heading\",\"data\":{\"text\":\"This is Homepage\"}},{\"type\":\"text\",\"data\":{\"text\":\"Lorem Ispum\\n\"}}]},{\"width\":6,\"blocks\":[{\"type\":\"image_extended\",\"data\":{\"file\":{\"url\":\"http://localhost/projects_my/cms/uploads/pages/1541609927_5b283449a0240484e5864c020a5115c4ab53a027.jpg\",\"filename\":\"1541609927_5b283449a0240484e5864c020a5115c4ab53a027.jpg\"},\"caption\":\"\",\"source\":\"\"}}]}],\"preset\":\"columns-6-6\"}}]}', '<div class=\'row\'><div class=\'col-md-6\'><h2>This is Homepage</h2>\n<p>Lorem Ispum</p>\n</div><div class=\'col-md-6\'><img class=\"img-responsive\" src=\"http://localhost/projects_my/cms/uploads/pages/1541609927_5b283449a0240484e5864c020a5115c4ab53a027.jpg\" alt=\"\" />\n</div></div>', '1', '1', 'AscendCMS | Home', 'CMS; ascend cms; codeingiter cms;', 'A content Managemnt System Built on Codeigniter', NULL, 'website', 'default.jpg', NULL, NULL, 'summary', 'default.jpg', NULL),
(2, 'about', 'About', 'About the best CMS ever', NULL, NULL, '1', '1', 'Ascend CMS | About', NULL, NULL, NULL, 'website', 'default.jpg', NULL, NULL, 'summary', 'default.jpg', NULL),
(3, 'work', 'Portfolio', 'Our Work Samples', NULL, NULL, '0', '1', 'Ascend CMS | Work Portfolio', NULL, NULL, NULL, 'website', 'default.jpg', NULL, NULL, 'summary', 'default.jpg', NULL),
(4, 'team', 'Team', 'Our Team Members', NULL, NULL, '0', '1', 'Ascend CMS | Team Members', NULL, NULL, NULL, 'website', 'default.jpg', NULL, NULL, 'summary', 'default.jpg', NULL),
(5, 'photos', 'Photo Gallery', 'Photo Gallery', NULL, NULL, '0', '1', 'Ascend CMS | Photo Gallery', NULL, NULL, NULL, 'website', 'default.jpg', NULL, NULL, 'summary', 'default.jpg', NULL),
(6, 'videos', 'Video Gallery', 'Video Gallery', NULL, NULL, '0', '1', 'Ascend CMS | Video Gallery', NULL, NULL, NULL, 'website', 'default.jpg', NULL, NULL, 'summary', 'default.jpg', NULL),
(7, 'blog', 'Blog', 'Our Blog', NULL, NULL, '0', '1', 'Ascend CMS | Blog', NULL, NULL, NULL, 'website', 'default.jpg', NULL, NULL, 'summary', 'default.jpg', NULL),
(8, 'contact', 'Contact Us', 'Contact Us', NULL, NULL, '1', '1', 'Ascend CMS | Contact Us', NULL, NULL, NULL, 'website', 'default.jpg', NULL, NULL, 'summary', 'default.jpg', NULL),
(9, 'sample-page', 'Sample Page', 'for demo purposes', 'Hello World', NULL, '1', '0', 'Ascend CMS | Sample Page', NULL, NULL, NULL, 'website', 'default.jpg', NULL, NULL, 'summary', 'default.jpg', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_groups`
--
ALTER TABLE `admin_groups`
  ADD PRIMARY KEY (`admin_group_id`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cms_menu`
--
ALTER TABLE `cms_menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `cms_modules`
--
ALTER TABLE `cms_modules`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `cms_options`
--
ALTER TABLE `cms_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_pages`
--
ALTER TABLE `cms_pages`
  ADD PRIMARY KEY (`page_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_groups`
--
ALTER TABLE `admin_groups`
  MODIFY `admin_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cms_menu`
--
ALTER TABLE `cms_menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cms_modules`
--
ALTER TABLE `cms_modules`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cms_options`
--
ALTER TABLE `cms_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cms_pages`
--
ALTER TABLE `cms_pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
