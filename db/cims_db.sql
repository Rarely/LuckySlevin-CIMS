-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 06, 2014 at 01:42 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cims`
--
CREATE DATABASE IF NOT EXISTS `cims` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cims`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL DEFAULT 'No description',
  `multiselect` tinyint(1) NOT NULL DEFAULT '0',
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `specifiable` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `multiselect`, `required`, `specifiable`) VALUES
(1, 'Type', 'Give a general sense of the kind of idea this might be - from a one-time project to an on-going activity.', 0, 0, 0),
(2, 'Program Referral', 'Even at an early stage in an idea''s development, there may be a clear connection to a Centre program or CBEL opportunity that we know of.  If so, please indicate.', 1, 0, 1),
(3, 'Organization''s Mandate', 'Select all the categories that describe the mandate of the organization that has proposed this idea.', 1, 0, 1),
(4, 'Focus Areas', 'Select all the categories that describe the community priority area that the project/placement hopes to address.  This might be the same or different from the organization''s mandate.', 1, 1, 1),
(5, 'Main Activities', 'Select the categories that best describe the main activities that would be done in this placement/project.', 1, 1, 1),
(6, 'Delivery Location', 'Please select the location(s) where the project/placement would take place.', 1, 0, 0),
(7, 'Disciplines', 'Please select any faculties/departments/disciplines that this idea is best suited for.', 1, 0, 1),
(8, 'Current Status', 'Please indicate/update the status of this idea.', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `ideaid` int(11) NOT NULL,
  `message` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `ideaid` (`ideaid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;

-- --------------------------------------------------------

--
-- Table structure for table `ideas`
--

CREATE TABLE IF NOT EXISTS `ideas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `description` text NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `community_partner` varchar(255) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `contact_phone` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userid` int(11) DEFAULT NULL,
  `isdeleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=76 ;

-- --------------------------------------------------------

--
-- Table structure for table `idea_references`
--

CREATE TABLE IF NOT EXISTS `idea_references` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ideaid` int(11) NOT NULL,
  `refers_to` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Table structure for table `idea_values`
--

CREATE TABLE IF NOT EXISTS `idea_values` (
  `ideaid` int(11) NOT NULL,
  `valueid` int(11) NOT NULL,
  PRIMARY KEY (`ideaid`,`valueid`),
  KEY `ideaid` (`ideaid`),
  KEY `valueid` (`valueid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) DEFAULT NULL,
  `message` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ideaid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `isread` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `ideaid` (`ideaid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=70 ;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hash` varchar(255) DEFAULT NULL,
  `data` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash` (`hash`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `hash`, `data`, `created`, `expires`) VALUES
(12, 'b95d5f31bd7dd4f1378640bf60daefea', 'graeme.dg.corrin@gmail.com', '2014-04-05 18:38:26', '2014-04-06 18:38:26');

-- --------------------------------------------------------

--
-- Table structure for table `trackings`
--

CREATE TABLE IF NOT EXISTS `trackings` (
  `userid` int(11) NOT NULL,
  `ideaid` int(11) NOT NULL,
  PRIMARY KEY (`userid`,`ideaid`),
  KEY `userid` (`userid`),
  KEY `ideaid` (`ideaid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role` varchar(20) NOT NULL,
  `isdeleted` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `role`, `isdeleted`, `created`, `modified`) VALUES
(1, 'Admin', 'admin@cims.com', '6660eddfdc10b5ccb8697cef2c6dd982cee2cf7c', 'admin', 0, '2014-02-18 18:04:37', '2014-02-18 18:04:37');

-- --------------------------------------------------------

--
-- Table structure for table `values`
--

CREATE TABLE IF NOT EXISTS `values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `specified` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `categoryid` (`categoryid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=117 ;

--
-- Dumping data for table `values`
--

INSERT INTO `values` (`id`, `name`, `categoryid`, `specified`) VALUES
(1, 'One-Time Project', 1, 0),
(2, 'Recurring Project', 1, 0),
(3, 'Part of a Multi-Phase Project', 1, 0),
(4, 'On-Going Activity', 1, 0),
(5, 'Course-Based Opportunity', 2, 0),
(6, 'Trek Program', 2, 0),
(7, 'Reading Week Project', 2, 0),
(8, 'Community Projects', 2, 0),
(9, 'Community-Based Research', 2, 0),
(10, 'ISL Pre-Departure', 2, 0),
(11, 'BEd. Community Field Study', 2, 0),
(12, 'Arts Internship Program', 2, 0),
(13, 'Hackathon', 2, 0),
(14, 'Aboriginal Engagement', 3, 0),
(15, 'Arts - Culture - Heritage', 3, 0),
(16, 'Civic Participation - Politics - Democracy', 3, 0),
(17, 'Community and Economic Development', 3, 0),
(18, 'Education - Research', 3, 0),
(19, 'Health - Human Services', 3, 0),
(20, 'Inclusion - Diversity', 3, 0),
(21, 'International', 3, 0),
(22, 'IT - Media - Communication', 3, 0),
(23, 'Legal - Justice - Human Rights', 3, 0),
(24, 'Recreation - Sport', 3, 0),
(25, 'Social Services', 3, 0),
(26, 'Sustainability - Environment - Animals', 3, 0),
(27, 'Aboriginal Engagement', 4, 0),
(28, 'Arts - Culture - Heritage', 4, 0),
(29, 'Civic Participation - Politics - Democracy', 4, 0),
(30, 'Community and Economic Development', 4, 0),
(31, 'Education - Research', 4, 0),
(32, 'Health - Human Services', 4, 0),
(33, 'Inclusion - Diversity', 4, 0),
(34, 'International', 4, 0),
(35, 'IT - Media - Communication', 4, 0),
(36, 'Legal - Justice - Human Rights', 4, 0),
(37, 'Recreation - Sport', 4, 0),
(38, 'Social Services', 4, 0),
(39, 'Sustainability - Environment - Animals', 4, 0),
(40, 'Consultation', 5, 0),
(41, 'Curriculum Development', 5, 0),
(42, 'Data Gathering and Mapping', 5, 0),
(43, 'Direct service delivery', 5, 0),
(44, 'Event', 5, 0),
(45, 'Fund Development', 5, 0),
(46, 'IT', 5, 0),
(47, 'Marketing and Communications', 5, 0),
(48, 'Program Development', 5, 0),
(49, 'Research - Evaluation and Assessment', 5, 0),
(50, 'Research - Literature Review', 5, 0),
(51, 'Research - More formalized data collection', 5, 0),
(52, 'Village of Anmore', 6, 0),
(53, 'Village of Belcarra', 6, 0),
(54, 'Bowen Island Municipality', 6, 0),
(55, 'City of Burnaby', 6, 0),
(56, 'City of Coquitlam', 6, 0),
(57, 'Corporation of Delta', 6, 0),
(58, 'City of Langley', 6, 0),
(59, 'Township of Langley', 6, 0),
(60, 'Village of Lions Bay', 6, 0),
(61, 'District of Maple Ridge', 6, 0),
(62, 'City of New Westminster', 6, 0),
(63, 'City of North Vancouver', 6, 0),
(64, 'District of North Vancouver', 6, 0),
(65, 'City of Pitt Meadows', 6, 0),
(66, 'City of Port Coquitlam', 6, 0),
(67, 'City of Port Moody', 6, 0),
(68, 'City of Richmond', 6, 0),
(69, 'City of Surrey', 6, 0),
(70, 'Tsawwassen First Nation', 6, 0),
(71, 'City of Vancouver', 6, 0),
(72, 'District of West Vancouver', 6, 0),
(73, 'City of White Rock', 6, 0),
(74, 'Faculty of Applied Science (Engineering)', 7, 0),
(75, 'Faculty of Arts', 7, 0),
(76, 'Faculty of Arts/School of Social Work and Family Studies', 7, 0),
(78, 'Faculty of Dentistry', 7, 0),
(79, 'Faculty of Education', 7, 0),
(80, 'Faculty of Forestry', 7, 0),
(81, 'Faculty of Land and Food Systems', 7, 0),
(82, 'Faculty of Law', 7, 0),
(84, 'Faculty of Medicine', 7, 0),
(85, 'Faculty of Pharmaceutical Sciences', 7, 0),
(86, 'Faculty of Science', 7, 0),
(88, 'Sauder School of Business', 7, 0),
(89, 'Department of Computer Science', 7, 0),
(90, 'School of Architecture and Landscape Architecture', 7, 0),
(92, 'School of Journalism', 7, 0),
(93, 'School of Kinesiology', 7, 0),
(94, 'School of Music', 7, 0),
(95, 'School of Nursing', 7, 0),
(96, 'School of Rehabilitation Sciences', 7, 0),
(97, 'School of Social Work', 7, 0),
(98, 'Initial Idea Inputted', 8, 0),
(99, 'Assigned Ownership', 8, 0),
(101, 'Active development - Project request for sent', 8, 0),
(102, 'Active development - Referred to partner information session', 8, 0),
(103, 'Active development - Referred to partner scoping session', 8, 0),
(104, 'Active development - In discussions', 8, 0),
(106, 'Idea Referred (Pending Confirmation)', 8, 0),
(107, 'Referral Confirmed', 8, 0),
(108, 'Project/Placement Being Implemented', 8, 0),
(109, 'Project/Placement Completed (Ready for Archiving)', 8, 0),
(110, 'Archived', 8, 0),
(114, 'Outside of lower mainland', 6, 0),
(115, 'International', 6, 0),
(116, 'School of Community and Regional Planning', 7, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`ideaid`) REFERENCES `ideas` (`id`);

--
-- Constraints for table `ideas`
--
ALTER TABLE `ideas`
  ADD CONSTRAINT `ideas_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);

--
-- Constraints for table `idea_values`
--
ALTER TABLE `idea_values`
  ADD CONSTRAINT `idea_values_ibfk_1` FOREIGN KEY (`ideaid`) REFERENCES `ideas` (`id`),
  ADD CONSTRAINT `idea_values_ibfk_2` FOREIGN KEY (`valueid`) REFERENCES `values` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`ideaid`) REFERENCES `ideas` (`id`),
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);

--
-- Constraints for table `trackings`
--
ALTER TABLE `trackings`
  ADD CONSTRAINT `trackings_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `trackings_ibfk_2` FOREIGN KEY (`ideaid`) REFERENCES `ideas` (`id`);

--
-- Constraints for table `values`
--
ALTER TABLE `values`
  ADD CONSTRAINT `values_ibfk_1` FOREIGN KEY (`categoryid`) REFERENCES `categories` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
