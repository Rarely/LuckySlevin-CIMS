-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 23, 2014 at 08:36 PM
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
(2, 'Program Referral', 'Even at an early stage in an idea''s developmet, there may be a clear connection to a Centre program or CBEL opportunity that we know of.  If so, please indicate.', 1, 0, 1),
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `userid`, `ideaid`, `message`, `created`) VALUES
(1, 3, 1, 'Feedback was that Grad students not likely to want to do this work if not receiving an honorarium or pay of some sort. Waiting for Deanne to get back to me about an honorarium…if yes, will post with GSA', '2014-01-25 08:00:00'),
(2, 2, 2, 'waiting for project request form', '2014-02-18 08:00:00'),
(3, 1, 3, 'meeting late November to scope', '2014-01-01 08:00:00'),
(4, 2, 5, 'project almost complete', '2014-01-05 08:00:00'),
(5, 3, 6, 'Hermeen has researched organizations and together with CP they are prioritizing and scheduling meetings  with these organizations', '2014-01-14 08:00:00'),
(6, 3, 7, 'As above, next step will be develop a plan of action with the prioritized partners', '2014-01-03 08:00:00'),
(7, 2, 8, 'started ', '2014-02-05 08:00:00'),
(8, 3, 9, 'AIP JD completed for January- still looking to see if anyone else wants to be involved - may be something for Natasha once she is done with QA', '2014-01-24 08:00:00'),
(9, 3, 10, 'interested, needs to talk to her manager; will follow-up', '2014-02-09 08:00:00'),
(10, 1, 11, 'planning work being down with FHNH, Arvin and Vino and a local artist to create the event', '2014-01-11 08:00:00'),
(11, 2, 12, 'FHNH has a UBC student volunteer that approached them through Kyle'' s reaching out.  She may not take the entire project on so if not, Lily is going to talk to Tara about an AIP', '2014-02-05 08:00:00'),
(12, 2, 13, 'away until end of August; follow-up emails sent early September - nothing back yet ', '2014-01-29 08:00:00'),
(13, 2, 14, 'almost done', '2014-01-25 08:00:00'),
(14, 3, 15, 'met to discuss;  shared with CLI staff; will look at a marketing course with Matthew - materials sent to Mt Pleasant for marketing course', '2014-01-22 08:00:00'),
(15, 2, 16, 'tried to follow-up, no response', '2014-01-26 08:00:00'),
(16, 4, 17, 'follow-up once Trek teams in place', '2014-02-10 08:00:00'),
(17, 3, 18, 'in progress', '2014-01-21 08:00:00'),
(18, 2, 20, 'in progress', '2014-02-07 08:00:00'),
(19, 2, 27, 'in progress', '2014-01-21 08:00:00'),
(20, 4, 28, 'followed up with Kim but no response on any of the three ideas she submitted', '2014-02-13 08:00:00'),
(21, 2, 29, 'followed up with Kim but no response on any of the three ideas she submitted', '2014-02-17 08:00:00'),
(22, 1, 30, 'followed up with Kim but no response on any of the three ideas she submitted', '2014-01-30 08:00:00'),
(23, 4, 31, 'still scoping; referred to Faculty of Education - may impact timeline', '2014-02-01 08:00:00'),
(24, 2, 34, 'Just one random idea that came from an initial conversation (Oct 30, 2013) with the MLA and staf about possibilities of engaging students.', '2014-01-22 08:00:00'),
(25, 3, 35, 'Just one random idea that came from an initial conversation (Oct 30, 2013) with the MLA and staf about possibilities of engaging students.', '2014-01-18 08:00:00'),
(26, 2, 36, 'Just one random idea that came from an initial conversation (Oct 30, 2013) with the MLA and staf about possibilities of engaging students.', '2014-02-08 08:00:00'),
(27, 3, 37, 'Just one random idea that came from an initial conversationthat Susan and I had (Oct 16, 2013) with three Foundation staff.  If an idea can be explored further, please connect with Justin so that I may make an eIntroduction, as Barbara may not be the right person to talk to, but can pathfind to who might be.', '2014-02-13 08:00:00'),
(28, 2, 38, 'Just one random idea that came from an initial conversationthat Susan and I had (Oct 16, 2013) with three Foundation staff.  If an idea can be explored further, please connect with Justin so that I may make an eIntroduction, as Barbara may not be the right person to talk to, but can pathfind to who might be.', '2014-01-25 08:00:00'),
(29, 2, 39, 'Just one random idea that came from an initial conversationthat Susan and I had (Oct 16, 2013) with three Foundation staff.  If an idea can be explored further, please connect with Justin so that I may make an eIntroduction, as Barbara may not be the right person to talk to, but can pathfind to who might be.', '2014-01-21 08:00:00'),
(30, 4, 40, 'Just one random idea that came from an initial conversationthat Susan and I had (Oct 16, 2013) with three Foundation staff.  If an idea can be explored further, please connect with Justin so that I may make an eIntroduction, as Barbara may not be the right person to talk to, but can pathfind to who might be.', '2014-02-16 08:00:00'),
(31, 3, 41, 'Just one random idea that came from an initial conversationthat Susan and I had (Oct 16, 2013) with three Foundation staff.  If an idea can be explored further, please connect with Justin so that I may make an eIntroduction, as Barbara may not be the right person to talk to, but can pathfind to who might be.', '2014-02-11 08:00:00'),
(32, 3, 42, 'Just one random idea that came from an initial conversationthat Susan and I had (Oct 16, 2013) with three Foundation staff.  If an idea can be explored further, please connect with Justin so that I may make an eIntroduction, as Barbara may not be the right person to talk to, but can pathfind to who might be.', '2014-01-21 08:00:00'),
(33, 2, 43, 'Just one random idea that came from an initial conversationthat Susan and I had (Oct 16, 2013) with three Foundation staff.  If an idea can be explored further, please connect with Justin so that I may make an eIntroduction, as Barbara may not be the right person to talk to, but can pathfind to who might be.', '2014-01-15 08:00:00'),
(34, 4, 44, 'Just one random idea that came from an initial conversationthat Susan and I had (Oct 16, 2013) with three Foundation staff.  If an idea can be explored further, please connect with Justin so that I may make an eIntroduction, as Barbara may not be the right person to talk to, but can pathfind to who might be.', '2014-01-30 08:00:00'),
(35, 2, 45, 'Just one random idea that came from an initial conversationthat Susan and I had (Oct 16, 2013) with three Foundation staff.  If an idea can be explored further, please connect with Justin so that I may make an eIntroduction, as Barbara may not be the right person to talk to, but can pathfind to who might be.', '2014-01-04 08:00:00'),
(36, 2, 46, 'Just one random idea that came from an initial conversationthat Susan and I had (Oct 16, 2013) with three Foundation staff.  If an idea can be explored further, please connect with Justin so that I may make an eIntroduction, as Barbara may not be the right person to talk to, but can pathfind to who might be.', '2014-02-09 08:00:00'),
(37, 3, 47, 'Just one random idea that came from an initial conversationthat Susan and I had (Oct 16, 2013) with three Foundation staff.  If an idea can be explored further, please connect with Justin so that I may make an eIntroduction, as Barbara may not be the right person to talk to, but can pathfind to who might be.', '2014-01-23 08:00:00'),
(38, 2, 48, 'Just one random idea that came from an initial conversationthat Susan and I had (Oct 16, 2013) with three Foundation staff.  If an idea can be explored further, please connect with Justin so that I may make an eIntroduction, as Barbara may not be the right person to talk to, but can pathfind to who might be.', '2014-01-09 08:00:00'),
(39, 1, 4, 'test comment', '2014-03-06 22:15:20'),
(40, 1, 4, 'test comment', '2014-03-06 22:16:05'),
(41, 1, 4, 'test comment', '2014-03-06 22:17:00'),
(42, 1, 4, 'test comment', '2014-03-06 22:19:34'),
(43, 1, 4, 'testdsf', '2014-03-06 22:23:09'),
(44, 1, 4, 'tesfdsfdsfds', '2014-03-06 22:25:28'),
(45, 2, 4, 'Jill''s Comment', '2014-03-06 22:49:30'),
(46, 2, 4, 'commenting', '2014-03-06 23:41:56'),
(47, 1, 4, 'new comment', '2014-03-06 23:45:04'),
(48, 1, 4, 'this project is going well', '2014-03-06 23:45:18'),
(49, 1, 4, 'Jill, take a look at this.', '2014-03-07 05:09:55'),
(50, 1, 3, 'leaving a comments', '2014-03-08 21:11:54'),
(51, 1, 2, ' Leaving a comment', '2014-03-22 23:57:40'),
(52, 1, 2, ' test', '2014-03-22 23:59:19'),
(53, 15, 60, ' This is a cool idea, I''d like to help Cody!', '2014-03-23 06:29:34'),
(54, 1, 71, ' Assigning this to Cody', '2014-03-23 20:18:26'),
(55, 14, 71, ' I''ll look into this right away!', '2014-03-23 20:32:35');

-- --------------------------------------------------------

--
-- Table structure for table `helps`
--

CREATE TABLE IF NOT EXISTS `helps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `help_content` text NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `helps`
--

INSERT INTO `helps` (`id`, `name`, `help_content`, `admin`, `updated`) VALUES
(1, 'Overview', '<h1>Overview</h1>\r\n<hr />\r\n<h1>&nbsp;</h1>\r\n<h4>&nbsp;</h4>\r\n<h2>Home</h2>\r\n<p>Active Ideas</p>\r\n<p>Recently Created Ideas</p>\r\n<p>Community Partner Ideas</p>\r\n<p>Inactive Ideas</p>\r\n<p>&nbsp;</p>\r\n<hr />\r\n<h2>My Page</h2>\r\n<p>Owned Ideas</p>\r\n<p>Tracked Ideas</p>\r\n<p>&nbsp;</p>\r\n<hr />\r\n<h2>Search</h2>\r\n<p>Description of the Search page</p>\r\n<p>&nbsp;</p>\r\n<hr />\r\n<p>&nbsp;</p>\r\n<h2>Help</h2>\r\n<p>Description of the Help Page</p>', 0, '2014-03-21 17:24:21'),
(2, 'Adding, Editing, and Splitting ideas', '<h1>Adding, Editing, and Splitting ideas</h1>\r\n<hr />\r\n<h1>&nbsp;</h1>\r\n<h1>&nbsp;</h1>\r\n<h2>Adding ideas</h2>\r\n<p>Description of how to add an idea and what each field is</p>\r\n<p>&nbsp;</p>\r\n<hr />\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<h2>Editing ideas</h2>\r\n<p>Description of how to edit an idea</p>\r\n<p>&nbsp;</p>\r\n<hr />\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<h2>Splitting Ideas</h2>\r\n<p>Description of how to split an idea</p>\r\n<p>&nbsp;</p>', 0, '2014-03-21 17:25:15'),
(3, '', '<p>I;m creating a new page, its gonna fail</p>', 0, '0000-00-00 00:00:00'),
(6, 'Tracking ideas', '<h1>Tracking Ideas</h1>\r\n<hr />\r\n<h1>&nbsp;</h1>\r\n<p>&nbsp;</p>\r\n<p>Description of how to Track/Untrack ideas.</p>\r\n<p>What it means when you are tracking an idea.</p>', 0, '2014-03-21 17:25:24'),
(8, 'Comments, Sharing, and Notifications', '<h1>Comments, Sharing, and Notifications</h1>\r\n<hr />\r\n<h1>&nbsp;</h1>\r\n<h2>Commenting</h2>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<hr />\r\n<h2>Sharing</h2>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<hr />\r\n<p>&nbsp;</p>\r\n<h2>Notifications</h2>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<hr />\r\n<p>&nbsp;</p>', 0, '2014-03-21 17:26:55'),
(9, 'Searching, Filtering, and Sorting', '<h1>Searching, Filtering, and Sorting</h1>\r\n<hr />\r\n<h1>&nbsp;</h1>\r\n<h2>Searching</h2>\r\n<p>Description of searching</p>\r\n<p>&nbsp;</p>\r\n<hr />\r\n<h2>&nbsp;</h2>\r\n<h2>Filtering</h2>\r\n<p>description of filtering</p>\r\n<p>&nbsp;</p>\r\n<hr />\r\n<h2>&nbsp;</h2>\r\n<h2>Sorting</h2>\r\n<p>description of sorting</p>\r\n<p>&nbsp;</p>\r\n<hr />\r\n<h2>&nbsp;</h2>', 0, '0000-00-00 00:00:00'),
(10, 'Community partner ideas', '<h1>Community partner ideas</h1>\r\n<hr />\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>Description of how and where community partners create ideas, and where those end up in the application.</p>\r\n<h1>&nbsp;</h1>', 0, '0000-00-00 00:00:00'),
(11, 'Resetting your password', '<h1>Resetting your password</h1>\r\n<hr />\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>Description of how to reset your password.</p>', 0, '0000-00-00 00:00:00'),
(12, 'Deleting and exporting ideas', '<h1>Deleting and exporting ideas</h1>\r\n<hr />\r\n<h1>&nbsp;</h1>\r\n<h2>Deleting ideas</h2>\r\n<p>Description of how to delete ideas</p>\r\n<p>&nbsp;</p>\r\n<hr />\r\n<p>&nbsp;</p>\r\n<h2>Exporting ideas</h2>\r\n<p>Description of how to export ideas</p>\r\n<p>&nbsp;</p>\r\n<hr />\r\n<p>&nbsp;</p>', 1, '0000-00-00 00:00:00'),
(13, 'Category management', '<h1>Category management</h1>\r\n<hr />\r\n<h1>&nbsp;</h1>\r\n<p>&nbsp;</p>\r\n<p>Description of how to manage categories</p>', 1, '0000-00-00 00:00:00'),
(14, 'User management', '<h1>User management</h1>\r\n<hr />\r\n<h2>Creating/Editing users</h2>\r\n<p>Description of how to manage users</p>\r\n<p>&nbsp;</p>\r\n<hr />\r\n<p>&nbsp;</p>\r\n<h2>Deactivating and Reactivating users</h2>\r\n<p>Description of how to deactive and reactivate users</p>\r\n<p>&nbsp;</p>', 1, '0000-00-00 00:00:00'),
(15, 'Idea management', '<h1>Idea management</h1>\r\n<hr />\r\n<h1>&nbsp;</h1>\r\n<p>&nbsp;</p>\r\n<p>Description of how this is the same as the Search page, and the user should look to <strong>Searching, Filtering, and Sorting</strong>, or <strong>Deleting and Exporting ideas</strong> for more details.</p>', 1, '2014-03-21 17:43:21'),
(16, 'Editing help pages', '<h1>Editing help pages</h1>\r\n<hr />\r\n<h1>&nbsp;</h1>\r\n<p>&nbsp;</p>\r\n<p>Description of how to edit the help pages, including how to add images.</p>', 1, '0000-00-00 00:00:00');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=72 ;

--
-- Dumping data for table `ideas`
--

INSERT INTO `ideas` (`id`, `name`, `description`, `start_date`, `end_date`, `community_partner`, `contact_name`, `contact_email`, `contact_phone`, `created`, `updated`, `userid`, `isdeleted`) VALUES
(1, 'Psychology professor at UBC', 'Psychology professor at UBC, Dr ****** ****** has approval for funding to work on a Youth in Transitions research project with Community Partner 1. There is a PhD student overseeing the project and there may be an opportunity for 1-2 grad students to help with data collection / subject identification and interviews, etc.  ', '2014-04-08', '0000-00-00', 'Community Partner 1', 'Jane Smith', 'janesmith@cp1.ca', '', '2014-03-02 00:59:06', '2014-03-22 23:59:46', 1, 1),
(2, 'Engagement Studios part 2', 'Engagement Studios part 2: to carry on the work of a previous group of CHD students who created a plan for a sustainable health and fitness program for individuals with developmental disabilities who are accessing the 4 Day Programs delivered by Community Partner 1; students will develop and implement new group fitness activities to support the long term goal of a sustainable program that can be delivered by staff open', '0000-00-00', '0000-00-00', 'Community Partner 1', 'Jane Smith', 'janesmith@cp1.ca', '', '2014-03-02 00:59:06', '2014-03-22 23:59:19', 1, 0),
(3, 'Follow-up to Project Impact plan', 'Follow-up to Project Impact plan: Community Partner 1 partnering with CNH on multi-cultural project targeted at families with children with developmental disabilities;  CNH will provide space for sessions as will the Community Partner 1 office on **** near ****. They both have staff that will deliver the workshops/activities but would like a student to help develop the plan for outreach and consultation & identify what activities and will bring certain members of the community out to engage.  ', '2014-02-19', '0000-00-00', 'Community Partner 1', 'John Dumas', 'johndumas@cp1.ca', '', '2014-03-02 00:59:06', '2014-03-10 15:08:32', 1, 0),
(4, 'John would like to revisit the other goals', 'New Description alert test', '0000-00-00', '2014-02-04', 'Community Partner 1', 'John Dumas', 'johndumas@cp1.ca', '', '2014-03-02 00:59:06', '2014-03-08 17:39:42', 1, 0),
(5, 'A brochure detailing community services', 'A brochure detailing community services and supports for the  Community Schools Team (CST) and Community Partner 3 and developed for use by teachers who don''t live in the area and are unaware of local resources that can support their students and families. ', '2014-03-02', '0000-00-00', 'Community Partner 3', 'Mary Jones', 'mjones@ilikecommunity.ca', '', '2014-03-02 00:59:06', '2014-02-25 00:59:06', 1, 0),
(6, 'Research community organizations in Richmond', '1. Research community organizations in Richmond and the populations they serve and then identify which ones serve populations that are likely not accessing the Foodbank but could benefit from it', '0000-00-00', '0000-00-00', 'Community Partner 2', 'Edward Chang', 'edc@food.ca', '', '2014-03-02 00:59:06', '2014-02-09 00:59:06', 2, 0),
(7, 'Develop a plan with the community partner', '2. Develop a plan with the community partner to reach out to individuals and  distribute food whether it be at Community Partner 2 (preferred) or at the organization site', '0000-00-00', '2014-02-22', 'Community Partner 2', 'Cherry Blue', 'Cherryb@food.ca', '', '2014-03-02 00:59:06', '2014-03-02 00:59:06', 2, 0),
(8, ' open house', 'Agency focused open house at Community Partner 2', '0000-00-00', '0000-00-00', 'Community Partner 2', 'Cherry Blue', 'cherryb@food.ca', '', '2014-03-02 00:59:06', '2014-02-03 00:59:06', 2, 1),
(9, 'new social media trends', 'Still needs more development: Research, test, assess, and recommend any new social media trends and tools for future application; Monitor/track similar social media activity and respond in a timely manner; Help develop a sustainable social media plan', '2014-03-14', '0000-00-00', 'Community Partner 4', 'Luke Warmwater', 'lukewarmwater@media.com', '', '2014-03-02 00:59:06', '2014-02-16 00:59:06', 3, 0),
(10, 'Open house in March', 'Open house in March for community to learn more about the organization', '0000-00-00', '0000-00-00', 'Community Partner 5...ON HOLD, WILL REVISIT IN JANUARY', 'Laura Jones', 'laura.jones@firstnationshealth.com', '', '2014-03-02 00:59:06', '2014-02-09 00:59:06', 3, 0),
(11, 'showcase art created by residents', 'Have students work with staff to create a plan to showcase art created by residents in all Community Partner 6 program areas. For example: Photography Club, Galliano Camping Trip working with 2 artists (jewellery & water colour), Garden Boxes with, portraits/graffiti with human rights/values, ceramics making teapots, plantar holders, & mugs, upcyling Art with recyclable materials, makeup Artists for Haunted House', '0000-00-00', '0000-00-00', 'Community Partner 6', 'Huey, Louis, Dewey', 'huey@neighbourhood.ca, louis@neighbourhood.ca, dewey@neighbourhood.ca', '', '2014-03-02 00:59:06', '2014-02-28 00:59:06', 3, 0),
(12, 'Generating Citizenship Community', 'students to help plan for Community Partner 6''s  Generating Citizenship Community Form to take place Spring 2014', '0000-00-00', '0000-00-00', 'Community Partner 6', 'Marshall Ericson', 'marshall@neighbourhood.ca', '', '2014-03-02 00:59:06', '2014-02-23 00:59:06', 1, 0),
(13, 'Maintenance of website', 'Still needs to be developed: Maintenance of  website (ongoing? One time project?)', '2014-04-24', '0000-00-00', 'Community Partner 7', 'Ginger Rogers, Fred Astaire', 'ginger@dance.com, fred@dance.com', '', '2014-03-02 00:59:06', '2014-01-31 00:59:06', 2, 0),
(14, 'school website', 'marketing or computer science student to help with the development of their school website; they use the *** platform right now which is mandatory but they want to make theirs look more interesting and vibrant to reflect the fine arts focus they have.', '0000-00-00', '0000-00-00', 'Community Partner 8', 'Groucho Marx', 'groucho@it.com', '457-123-4563', '2014-03-02 00:59:06', '2014-02-23 00:59:06', 3, 0),
(15, 'City and the Parks board', 'a student to volunteer a couple of hours per week to do a little bit of research and provide recommendations and a list of potential partners to source funds. Possible conversations with the City and the Parks board.  The *** will do all the tendering but before they do they want to see the funds in place so the school has a deadline of June 2014 to raise the money.  The student helping them would not be required to do the actually fundraising.', '0000-00-00', '2014-05-28', 'Community Partner 9', 'Audrey Hepburn', 'audrey@dance.com', '', '2014-03-02 00:59:06', '2014-02-25 00:59:06', 4, 0),
(16, 'open-house in March', 'Still needs to be developed: The community partner has been thinking about hosting an open-house in March to invite community members and local business to find out more about their work.', '0000-00-00', '0000-00-00', 'Community Partner 10', 'Elvis Presley', 'elvis@dance.com', '', '2014-03-02 00:59:06', '2014-03-15 15:58:50', 1, 0),
(17, 'day camp', 'Work with the Trek nutrition team to create a day camp that contains two parts: 1) Nutrition: Choosing the right food & drink 2) Stretching & At-home exercises. ', '0000-00-00', '0000-00-00', 'Community Partner 11', 'Marilyn Monroe', 'mmonroe@idigcommunity.com', '', '2014-03-02 00:59:06', '2014-02-17 00:59:06', 2, 0),
(18, 'identify needs of immigrant families', 'Assist in the development and implementation/facilitation of community dialogue tables  to help Community Partner 12 identify needs of immigrant families with young children; assist with research questions', '0000-00-00', '0000-00-00', 'Community Partner 12', 'Peter Mansbridge', 'Pete@kidsrule.ca', '', '2014-03-02 00:59:06', '2014-02-13 00:59:06', 3, 0),
(19, 'Identify barriers for immigrant parents', 'Identify barriers for immigrant parents to be involved in PACs and develop strategies to enhance Community Partner 12 outreach activities ', '2014-04-21', '0000-00-00', 'Community Partner 12', 'Peter Mansbridge', 'Pete@kidsrule.ca', '', '2014-03-02 00:59:06', '2014-02-15 00:59:06', 3, 0),
(20, 'engage newcomers in green initiatives', 'Conduct research and identify strategies to engage newcomers in green initiatives', '0000-00-00', '0000-00-00', 'Community Partner 12', 'Peter Mansbridge', 'Pete@kidsrule.ca', '', '2014-03-02 00:59:06', '2014-02-04 00:59:06', 4, 0),
(21, 'clearer picture of DTs involvement', 'Not only has the community schools team worked with UBC over the years, other staff, teachers, and clubs have as well.  They would like a clearer picture of DTs involvement and partnership with UBC so they can be more strategic in their work. They would like an asset map of all the work and projects being done.', '0000-00-00', '0000-00-00', 'Community Partner 13', 'Hannah Montana', 'hmontana@dance.com', '', '2014-03-02 00:59:06', '2014-02-07 00:59:06', 1, 0),
(22, 'social media activities', 'no!', '0000-00-00', '0000-00-00', 'Community Partner 14', 'Humphrey Bogart', 'katherine.MacIntyre@options.bc.ca ', '', '2014-03-02 00:59:06', '2014-03-15 15:59:16', 2, 0),
(23, 'evaluation process of our programming', 'Help with our evaluation process of our programming (focus groups, assistance with surveys (multiple languages; 4 different locations, 6 days a week on last 2 weeks of October 2013 (approximately 200 surveys or more) – you don’t have to be there for all, they are just looking for some help', '0000-00-00', '0000-00-00', 'Community Partner 14', 'Humphrey Bogart', 'hbog@eel.ca', '', '2014-03-02 00:59:06', '2014-02-24 00:59:06', 4, 0),
(24, 'Outdoor musical instruments', 'Outdoor musical instruments and other interactive pieces for exploratory play – they are interested in doing something different with their playground– something more natural that gets kids outdoors and playing.  This may be a research role.', '2014-02-18', '0000-00-00', 'Community Partner 14', 'Humphrey Bogart', 'hbog@eel.ca', '', '2014-03-02 00:59:06', '2014-03-01 00:59:06', 4, 0),
(25, 'engage with local business and politicians', 'develop a strategy to engage with local business and politicians, that will help with fundraising efforts and also be used as a regular way to keep regular contact with partners and explore ways to support their needs as well.', '0000-00-00', '0000-00-00', 'Community Partner 14', 'Humphrey Bogart', 'hbog@eel.ca', '', '2014-03-02 00:59:06', '2014-02-14 00:59:06', 4, 1),
(26, 'You tube video to tell our story', 'We want to capture a short You tube video to tell our story. We would also like to find a way to record Community Partner 14''s history; preserve the story and the feeling of grassroots, as we grow and people retire', '0000-00-00', '2014-04-23', 'Community Partner 14', 'Humphrey Bogart', 'hbog@eel.ca', '475-563-8475', '2014-03-02 00:59:06', '2014-02-11 00:59:06', 1, 0),
(27, 'youth friendly application form', 'Content analysis of comparable youth agencies volunteer application forms, volunteer agreements, orientation handbooks/process; redevelop and create a youth friendly application form that is accessible, linked & available online;', '0000-00-00', '0000-00-00', 'Community Partner 15', 'Frank Sinatra', 'Frank@volunteer.ca', '', '2014-03-02 00:59:06', '2014-02-13 00:59:06', 2, 0),
(28, 'new Board members', 'seeking new Board members, most especially a treasurer', '2014-03-27', '0000-00-00', 'Community Partner 16', 'Aretha Franklin', 'respect@comm.com', '', '2014-03-02 00:59:06', '2014-01-31 00:59:06', 2, 0),
(29, 'help with social media', 'help with social media - specifically Twitter and Facebook', '0000-00-00', '0000-00-00', 'Community Partner 16', 'Aretha Franklin', 'respect@comm.com', '', '2014-03-02 00:59:06', '2014-02-23 00:59:06', 3, 0),
(30, 'videos made at Community Partner 16', 'we would like a series of videos made at Community Partner 16 about our school and its culture and we would love to have lip dub done as well', '0000-00-00', '0000-00-00', 'Community Partner 16', 'Aretha Franklin', 'respect@comm.com', '', '2014-03-02 00:59:06', '2014-02-26 00:59:06', 4, 0),
(31, 'students working together to tell stories', 'Following up on the initial project impact goals of raising awareness of the strengths and wisdom of inner city children, we are looking at a week of UBC and Community Partner 17 students working together to tell stories', '0000-00-00', '0000-00-00', 'Community Partner 17', 'Monica Geller', 'mon@geller.ca', '', '2014-01-08 00:59:06', '2014-02-02 00:59:06', 1, 0),
(32, 'exploring business models for program delivery', 'still scoping but she has a couple of project ideas coming - one about exploring business models for program delivery', '2014-03-05', '0000-00-00', 'Community Partner 18', 'Rachel Green', 'rachel.green@communitybusiness.ca', '460-194-3856', '2014-03-02 00:59:06', '2014-02-21 00:59:06', 1, 0),
(33, 'fresh, healthy food in Vancouver’s West End', 'Assess the availability and affordability of fresh, healthy food in Vancouver’s West End. Design a representative “Shopping List,” representing the dietary needs of one adult for one week; survey each market in the neighbourhood and record the availability and price of each item on that list.  These results will be compiled, and overlaid on a map of the area, enabling us to identify areas of the West End where food is either unavailable or unaffordable to residents.  ', '0000-00-00', '0000-00-00', 'Community Partner 19', 'Chandler Bing', 'mschenandlerbong@gmail.com', '', '2014-03-02 00:59:06', '2014-02-09 00:59:06', 1, 0),
(34, 'gallery to showcase local art', 'Having a student come in and activate the space as a gallery to showcase local art from residents from the constituency.', '0000-00-00', '0000-00-00', 'Community Partner 20', 'Pheobe Buffet', 'Pheobe.buffet@art.com', '', '2014-03-02 00:59:06', '2014-02-13 00:59:06', 3, 0),
(35, 'why businesses are not thriving', 'Lots of businesses in the area do not succeed.  Some research on uncovering some of this data and analyzing it for some understanding as to why businesses are not thriving in this constituency.', '0000-00-00', '0000-00-00', 'Community Partner 20', 'Pheobe Buffet', 'Pheobe.buffet@art.com', '', '2014-02-04 00:59:06', '2014-02-07 00:59:06', 3, 0),
(36, 'start and support various community committees', 'The community office is starting from scractch and would like to get some support in understanding how to start and support various community committees (they have an arts one that has started) and develop infrastructure to support this work, including things like volunteer management infrastructure.', '0000-00-00', '0000-00-00', 'Community Partner 20', 'Pheobe Buffet', 'Pheobe.buffet@art.com', '', '2014-03-02 00:59:06', '2014-02-26 00:59:06', 3, 0),
(37, 'HR satisfaction survey.', 'Conducting an HR satisfaction survey.', '0000-00-00', '0000-00-00', 'Community Partner 21', 'Joey Tribiani, CEO', 'joe.tribiani@hr.ca', '', '2014-03-02 00:59:06', '2014-02-20 00:59:06', 3, 0),
(38, 'HR policy framework', 'Supporting the development of an HR policy framework.', '0000-00-00', '0000-00-00', 'Community Partner 21', 'Joey Tribiani, CEO', 'joe.tribiani@hr.ca', '', '2014-03-02 00:59:06', '2014-02-23 00:59:06', 3, 0),
(39, 'small c corporate governance.', 'Supporting some work at the foundation around "small c" corporate governance.', '0000-00-00', '0000-00-00', 'Community Partner 21', 'Joey Tribiani, CEO', 'joe.tribiani@hr.ca', '', '2014-03-02 00:59:06', '2014-03-23 18:00:17', 4, 0),
(40, 'An IT overhaul at the Foundation', 'An IT overhaul at the Foundation is needed.  A start would be a business case prepared (higher level student help - maybe MBA) - doing some business analysis to show how better IT might free up time to do some capital planning and other business care work.', '0000-00-00', '0000-00-00', 'Community Partner 21', 'Joey Tribiani, CEO', 'joe.tribiani@hr.ca', '', '2014-03-02 00:59:06', '2014-02-23 00:59:06', 4, 0),
(41, 'developing a framework', 'Whole area of prospect research, perhaps developing a framework and key business processes on how to proactively seek out fund development prospects.', '2014-03-21', '2014-04-12', 'Community Partner 21', 'Joey Tribiani, CEO', 'joe.tribiani@hr.ca', '', '2014-03-02 00:59:06', '2014-02-10 00:59:06', 4, 0),
(42, 'Analytics of our databases', 'Analytics of our databases, maybe some statistical modeling, to help us better understand the donors we currently have and what does the data tell us to help us make better decisions.', '0000-00-00', '0000-00-00', 'Community Partner 21', 'Joey Tribiani, CEO', 'joe.tribiani@hr.ca', '', '2014-03-02 00:59:06', '2014-03-12 23:59:06', 4, 0),
(43, 'Marketing and communications help', 'Marketing and communications help - a comprehensive contact strategy would be really helpful.  Perhaps a starting point would be an audit of what we do now.', '0000-00-00', '0000-00-00', 'Community Partner 21', 'Joey Tribiani, CEO', 'joe.tribiani@hr.ca', '', '2014-03-02 00:59:06', '2014-01-31 00:59:06', 2, 0),
(44, 'donor relations strategy', 'Similar to a comprehensive contact strategy, one for a donor relations strategy, again looking at what we do now might be a good starting point.', '0000-00-00', '0000-00-00', 'Community Partner 21', 'Joey Tribiani, CEO', 'joe.tribiani@hr.ca', '', '2014-03-18 23:59:06', '2014-03-17 23:59:06', 2, 0),
(45, 'The Foundation Name', 'The Foundation Name is a holdover on when the two foundations merged.  Dealing with a name change is something they would like to do, but perhaps a good starting point would be to do a study (maybe focus groups?) on the topic.', '0000-00-00', '0000-00-00', 'Community Partner 21', 'Joey Tribiani, CEO', 'joe.tribiani@hr.ca', '', '2014-03-02 00:59:06', '2014-02-09 00:59:06', 2, 1),
(46, 'studying social media', 'Really studying social media in terms of fundraising and demographics - what does this mean for us? - We can''t NOT be there, but how much resources should we be spending on this?  And in what areas?', '0000-00-00', '2014-03-29', 'Community Partner 21', 'Joey Tribiani, CEO', 'joe.tribiani@hr.ca', '', '2014-03-02 00:59:06', '2014-02-26 00:59:06', 2, 0),
(47, 'developing IT systems', 'Follow-up work after some of the other initial auditing and research ideas, but developing IT systems around fund management and donor communications/emails.', '0000-00-00', '0000-00-00', 'Community Partner 21', 'Joey Tribiani, CEO', 'joe.tribiani@hr.ca', '', '2014-03-02 00:59:06', '2014-02-13 00:59:06', 1, 0),
(48, 'support patients', 'Some very initial idea on how to support patients to communicate with the health system from home.  This idea I''m very fuzzy on, but there did appear to be some energy in this idea, so I''ve documented it here.', '0000-00-00', '0000-00-00', 'Community Partner 21', 'Joey Tribiani, CEO', 'joe.tribiani@hr.ca', '', '2014-03-02 00:59:06', '2014-02-16 00:59:06', 1, 0),
(49, 'tour organizing committee', '"**** tour organizing committee.  This provides a tour of the refugee hearing space and meeting with a refugee board official to explain the system and answer questions.  We provide an extensive guide, interpretation and do a pre and post tour questionnaire.the flyer, he evaluation, the post tour questionnaire,the questionnaire answer key (almost identical to the post tour)"', '2014-05-22', '0000-00-00', 'Community Partner 22', 'Ross Geller', 'ilovemarcel@communicate.com', '', '2014-03-02 00:59:06', '2014-02-14 00:59:06', 1, 0),
(54, '', 'The Foundation Name is a holdover on when the two foundations merged. Dealing with a name change is something they would like to do, but perhaps a good starting point would be to do a study (maybe focus groups?) on the topic.', NULL, NULL, '', 'Peter', 'Peter@communitypartner.com', '', '2014-03-23 04:55:10', '2014-03-23 04:55:10', NULL, 0),
(55, '', 'Really studying social media in terms of fundraising and demographics - what does this mean for us? - We can''t NOT be there, but how much resources should we be spending on this? And in what areas?', NULL, NULL, '', 'Peter', 'peter@communitypartner.com', '', '2014-03-23 04:55:42', '2014-03-23 04:55:42', NULL, 0),
(56, '', 'Follow-up work after some of the other initial auditing and research ideas, but developing IT systems around fund management and donor communications/emails.\r\n', NULL, NULL, '', 'Jon', 'jon@communitypartner.com', '', '2014-03-23 04:56:00', '2014-03-23 04:56:00', NULL, 0),
(57, '', 'Some very initial idea on how to support patients to communicate with the health system from home. This idea I''m very fuzzy on, but there did appear to be some energy in this idea, so I''ve documented it here.\r\n', NULL, NULL, '', 'Will', 'will@communitypartner.com', '', '2014-03-23 05:35:53', '2014-03-23 05:35:53', NULL, 0),
(58, '', 'Similar to a comprehensive contact strategy, one for a donor relations strategy, again looking at what we do now might be a good starting point.', NULL, NULL, '', 'Will', 'will@communitypartner.com', '', '2014-03-23 05:36:15', '2014-03-23 05:36:15', NULL, 0),
(59, 'Create a brochure for the CST', 'A brochure detailing community services and supports for the Community Schools Team (CST) and Community Partner 3 and developed for use by teachers who don''t live in the area and are unaware of local resources that can support their students and families.', '2014-03-05', '2014-05-17', 'Community Schools Team', 'George', 'george@gmail.com', '', '2014-02-03 07:26:54', '2014-02-19 07:26:54', 14, 0),
(60, 'Richmond Community Organizations', '1. Research community organizations in Richmond and the populations they serve and then identify which ones serve populations that are likely not accessing the Foodbank but could benefit from it\r\n', NULL, NULL, 'Foodbank', 'Roger', 'roger@hotmail.com', '', '2014-03-23 06:28:35', '2014-03-23 06:29:34', 14, 0),
(61, 'Host fundraiser', 'Host a fundraiser to raise money for an issue.', NULL, NULL, 'Community Partner 3', 'Pete', 'pete@gmail.com', '', '2014-03-23 16:36:50', '2014-03-23 17:44:18', 1, 0),
(62, 'test', 'jghfnf', NULL, NULL, '', '', '', '', '2014-03-23 17:45:20', '2014-03-23 17:45:36', 1, 1),
(63, 'Showcase art created by residents', 'Have students work with staff to create a plan to showcase art created by residents in all Community Partner 6 program areas. For example: Photography Club, Galliano Camping Trip working with 2 artists (jewellery & water colour), Garden Boxes with, portraits/graffiti with human rights/values, ceramics making teapots, plantar holders, & mugs, upcyling Art with recyclable materials, makeup Artists for Haunted House', '2014-03-07', '2014-05-24', 'Community Partner 6', 'Tim', 'tim@communitypartner.com', '', '2014-03-23 18:51:23', '2014-03-23 18:51:23', 15, 0),
(64, 'School website', 'marketing or computer science student to help with the development of their school website; they use the *** platform right now which is mandatory but they want to make theirs look more interesting and vibrant to reflect the fine arts focus they have.', NULL, NULL, 'Community Partner 3', 'Bob', 'bob@communitypartner.com', '', '2014-02-01 21:06:53', '2014-02-18 21:06:53', 15, 0),
(65, 'Raise awareness for inner city children', 'Following up on the initial project impact goals of raising awareness of the strengths and wisdom of inner city children, we are looking at a week of UBC and Community Partner 17 students working together to tell stories', NULL, NULL, 'Community Partner 17 ', 'Frank', 'frank@communitypartner.com', '', '2014-03-10 20:08:13', '2014-03-23 20:08:13', 15, 0),
(66, 'Fresh, healthy food in Vancouverâ€™s West End', 'Assess the availability and affordability of fresh, healthy food in Vancouverâ€™s West End. Design a representative â€œShopping List,â€ representing the dietary needs of one adult for one week; survey each market in the neighbourhood and record the availability and price of each item on that list. These results will be compiled, and overlaid on a map of the area, enabling us to identify areas of the West End where food is either unavailable or unaffordable to residents. ', NULL, NULL, 'Community Partner 11', '', '', '', '2014-03-23 20:09:15', '2014-03-23 20:09:15', 15, 0),
(67, 'Maintain The Foundation''s Website', 'The Foundation is also looking for people to look after and maintain the website as an on-going project.  Looking for computer science students that are interested in learning to maintain and update large scale web applications.', NULL, NULL, 'The Foundation', 'Graeme', 'graeme@thefoundation.com', '', '2014-03-23 20:10:57', '2014-03-23 20:10:57', 14, 0),
(68, 'Get partners to source funds', 'a student to volunteer a couple of hours per week to do a little bit of research and provide recommendations and a list of potential partners to source funds. Possible conversations with the City and the Parks board. The *** will do all the tendering but before they do they want to see the funds in place so the school has a deadline of June 2014 to raise the money.  The student helping them would not be required to do the actually fundraising.', NULL, NULL, '', 'Jane', 'jane@communitypartner.com', '', '2014-03-23 20:12:12', '2014-03-23 20:12:12', 14, 0),
(69, 'Community schools team', 'Not only has the community schools team worked with UBC over the years, other staff, teachers, and clubs have as well. They would like a clearer picture of DTs involvement and partnership with UBC so they can be more strategic in their work. They would like an asset map of all the work and projects being done.', '2014-04-03', NULL, 'community Partner 3', 'Pat', 'pat@communitypartner.com', '', '2014-02-10 21:13:35', '2014-03-11 20:13:35', 14, 0),
(70, 'Musical instruments for kids', 'Outdoor musical instruments and other interactive pieces for exploratory play â€“ they are interested in doing something different with their playgroundâ€“ something more natural that gets kids outdoors and playing.  This may be a research role.', NULL, NULL, 'Community partner 7', '', '', '', '2014-02-02 21:14:14', '2014-03-11 20:14:14', 14, 0),
(71, 'Website for The Foundation', 'The Foundation needs a new website.  They''re looking for HCI students to create a UI that''s intuitive and innovative.  This is a one time project to create a new website, but once this project is completed, The Foundation is also looking for people to look after and maintain the website as an on-going project (see referenced idea).', NULL, NULL, 'The Foundation', 'Graeme', 'graeme@thefoundation.com', '', '2014-03-05 21:16:13', '2014-03-23 20:32:35', 14, 0);

-- --------------------------------------------------------

--
-- Table structure for table `idea_references`
--

CREATE TABLE IF NOT EXISTS `idea_references` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ideaid` int(11) NOT NULL,
  `refers_to` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `idea_references`
--

INSERT INTO `idea_references` (`id`, `ideaid`, `refers_to`) VALUES
(1, 59, 0),
(2, 63, 0),
(3, 64, 0),
(4, 65, 0),
(5, 66, 0),
(6, 67, 0),
(7, 68, 0),
(8, 69, 0),
(9, 70, 0),
(10, 71, 67);

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

--
-- Dumping data for table `idea_values`
--

INSERT INTO `idea_values` (`ideaid`, `valueid`) VALUES
(1, 1),
(1, 10),
(1, 34),
(1, 37),
(1, 46),
(1, 49),
(1, 51),
(1, 59),
(1, 79),
(1, 85),
(1, 86),
(1, 88),
(1, 89),
(1, 90),
(2, 6),
(2, 7),
(2, 10),
(2, 14),
(2, 27),
(2, 30),
(2, 42),
(2, 44),
(2, 52),
(2, 82),
(2, 95),
(3, 2),
(3, 10),
(3, 11),
(3, 13),
(3, 16),
(3, 18),
(3, 25),
(3, 30),
(3, 37),
(3, 46),
(3, 48),
(3, 49),
(3, 55),
(3, 73),
(3, 80),
(3, 81),
(3, 96),
(3, 103),
(4, 1),
(4, 2),
(4, 36),
(4, 57),
(4, 108),
(5, 10),
(5, 12),
(5, 15),
(5, 19),
(5, 21),
(5, 38),
(5, 39),
(5, 40),
(5, 41),
(5, 49),
(5, 53),
(5, 66),
(5, 68),
(5, 70),
(5, 76),
(5, 84),
(5, 93),
(5, 101),
(5, 106),
(6, 1),
(6, 5),
(6, 22),
(6, 24),
(6, 81),
(6, 110),
(7, 2),
(7, 9),
(7, 17),
(7, 19),
(7, 22),
(7, 57),
(7, 60),
(7, 69),
(7, 84),
(7, 95),
(7, 96),
(7, 102),
(7, 104),
(8, 3),
(8, 5),
(8, 18),
(8, 22),
(8, 35),
(8, 40),
(8, 42),
(8, 53),
(8, 71),
(8, 89),
(8, 103),
(9, 4),
(9, 27),
(9, 52),
(9, 64),
(9, 90),
(9, 96),
(9, 107),
(10, 3),
(10, 37),
(10, 48),
(10, 50),
(10, 60),
(10, 62),
(10, 71),
(10, 81),
(10, 88),
(11, 19),
(11, 48),
(11, 51),
(11, 89),
(12, 22),
(12, 35),
(12, 43),
(12, 44),
(12, 45),
(12, 56),
(12, 72),
(12, 86),
(12, 89),
(12, 92),
(12, 97),
(13, 11),
(13, 12),
(13, 15),
(13, 16),
(13, 17),
(13, 33),
(13, 72),
(13, 74),
(13, 96),
(13, 97),
(14, 10),
(14, 23),
(14, 37),
(14, 94),
(15, 15),
(15, 26),
(15, 38),
(15, 94),
(16, 72),
(16, 78),
(16, 80),
(17, 26),
(17, 27),
(17, 54),
(17, 62),
(17, 70),
(17, 82),
(18, 6),
(18, 20),
(18, 27),
(18, 51),
(18, 103),
(19, 8),
(19, 25),
(19, 62),
(19, 82),
(19, 99),
(20, 10),
(20, 28),
(20, 36),
(20, 39),
(20, 45),
(20, 62),
(20, 63),
(20, 76),
(20, 82),
(20, 86),
(20, 89),
(20, 90),
(20, 97),
(20, 101),
(21, 6),
(21, 24),
(21, 41),
(21, 42),
(21, 44),
(21, 46),
(21, 52),
(21, 81),
(21, 85),
(22, 11),
(22, 109),
(23, 9),
(23, 12),
(23, 16),
(23, 23),
(23, 25),
(23, 30),
(23, 35),
(23, 43),
(23, 54),
(23, 55),
(23, 56),
(23, 61),
(23, 62),
(23, 63),
(23, 66),
(23, 67),
(23, 74),
(23, 76),
(23, 78),
(23, 88),
(23, 103),
(23, 107),
(23, 109),
(23, 110),
(24, 70),
(25, 1),
(25, 4),
(25, 11),
(25, 23),
(25, 50),
(25, 53),
(25, 55),
(25, 72),
(25, 75),
(25, 76),
(25, 81),
(26, 1),
(26, 5),
(26, 21),
(26, 24),
(26, 27),
(26, 60),
(26, 62),
(26, 65),
(26, 86),
(27, 18),
(27, 19),
(27, 25),
(27, 27),
(27, 35),
(27, 42),
(27, 61),
(27, 63),
(27, 67),
(27, 88),
(27, 98),
(27, 99),
(27, 107),
(28, 23),
(28, 30),
(28, 31),
(28, 43),
(28, 62),
(28, 65),
(28, 68),
(28, 93),
(28, 94),
(28, 98),
(29, 15),
(29, 18),
(29, 36),
(29, 44),
(29, 47),
(29, 49),
(29, 72),
(29, 73),
(29, 95),
(29, 109),
(29, 110),
(30, 14),
(30, 25),
(30, 26),
(30, 38),
(30, 53),
(30, 57),
(30, 63),
(30, 85),
(30, 92),
(30, 93),
(31, 3),
(31, 37),
(31, 89),
(31, 97),
(32, 21),
(32, 45),
(32, 56),
(32, 62),
(32, 94),
(32, 95),
(32, 96),
(32, 97),
(33, 16),
(33, 34),
(33, 65),
(33, 67),
(33, 95),
(33, 101),
(33, 104),
(34, 12),
(34, 20),
(34, 22),
(34, 23),
(34, 40),
(34, 62),
(34, 95),
(34, 103),
(35, 6),
(35, 16),
(35, 19),
(35, 22),
(35, 25),
(35, 38),
(35, 47),
(35, 64),
(35, 66),
(35, 70),
(35, 92),
(35, 98),
(35, 99),
(35, 101),
(35, 106),
(36, 16),
(36, 23),
(36, 24),
(36, 28),
(36, 39),
(36, 43),
(36, 46),
(36, 73),
(36, 75),
(36, 78),
(36, 79),
(36, 82),
(36, 89),
(36, 92),
(36, 94),
(36, 97),
(36, 101),
(36, 103),
(36, 104),
(36, 108),
(37, 2),
(37, 6),
(37, 12),
(37, 47),
(37, 49),
(37, 65),
(37, 70),
(37, 80),
(37, 90),
(37, 92),
(37, 93),
(38, 37),
(38, 41),
(38, 55),
(38, 60),
(38, 98),
(39, 2),
(39, 20),
(39, 24),
(39, 34),
(39, 43),
(39, 66),
(39, 72),
(39, 81),
(39, 94),
(40, 21),
(40, 22),
(40, 45),
(40, 48),
(40, 51),
(40, 73),
(40, 92),
(41, 1),
(41, 11),
(41, 14),
(41, 30),
(41, 66),
(41, 67),
(41, 70),
(41, 76),
(41, 82),
(41, 98),
(41, 108),
(42, 6),
(42, 8),
(42, 19),
(42, 20),
(42, 28),
(42, 38),
(42, 41),
(42, 43),
(42, 55),
(42, 69),
(42, 95),
(43, 9),
(43, 19),
(43, 22),
(43, 28),
(43, 34),
(43, 47),
(43, 49),
(43, 52),
(44, 11),
(44, 18),
(44, 22),
(44, 30),
(44, 32),
(44, 60),
(44, 66),
(44, 67),
(44, 79),
(44, 102),
(44, 103),
(44, 104),
(45, 1),
(45, 4),
(45, 21),
(45, 25),
(45, 59),
(46, 23),
(46, 37),
(46, 41),
(46, 46),
(46, 52),
(46, 54),
(46, 59),
(46, 89),
(46, 101),
(47, 4),
(47, 5),
(47, 25),
(47, 34),
(47, 48),
(47, 71),
(48, 31),
(48, 43),
(48, 46),
(48, 63),
(49, 16),
(49, 26),
(49, 54),
(49, 55),
(49, 64),
(49, 71),
(59, 1),
(59, 5),
(59, 18),
(59, 47),
(59, 75),
(59, 98),
(60, 4),
(60, 8),
(60, 9),
(60, 25),
(60, 32),
(60, 38),
(60, 45),
(60, 71),
(60, 76),
(60, 99),
(61, 2),
(61, 6),
(61, 7),
(61, 15),
(61, 28),
(61, 41),
(61, 44),
(61, 54),
(61, 56),
(61, 75),
(62, 2),
(62, 6),
(62, 9),
(62, 17),
(62, 19),
(62, 54),
(62, 74),
(62, 102),
(63, 4),
(63, 5),
(63, 12),
(63, 16),
(63, 25),
(63, 75),
(63, 99),
(64, 1),
(64, 71),
(64, 88),
(64, 89),
(64, 101),
(65, 4),
(65, 7),
(65, 8),
(65, 15),
(65, 75),
(65, 98),
(66, 1),
(66, 9),
(66, 17),
(66, 19),
(66, 44),
(66, 71),
(66, 76),
(66, 101),
(67, 4),
(67, 5),
(67, 46),
(67, 89),
(67, 101),
(68, 4),
(68, 14),
(68, 29),
(68, 30),
(68, 31),
(68, 41),
(68, 75),
(68, 79),
(68, 99),
(69, 1),
(69, 52),
(69, 99),
(70, 1),
(70, 102),
(71, 1),
(71, 5),
(71, 13),
(71, 22),
(71, 46),
(71, 71),
(71, 89),
(71, 99);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `message`, `created`, `ideaid`, `userid`, `isread`) VALUES
(1, 'Title', 'Someone has shared an idea with you', '2013-06-25 07:00:00', 23, 1, 0),
(2, 'Title', 'Someone has shared an idea with you', '2013-07-08 07:00:00', 19, 2, 1),
(3, 'Title', 'Someone has shared an idea with you', '2013-04-03 07:00:00', 8, 3, 0),
(4, 'Title', 'Someone has shared an idea with you', '2013-06-16 07:00:00', 20, 4, 1),
(5, 'Title', 'Someone has shared an idea with you', '2013-12-25 08:00:00', 47, 3, 0),
(6, 'Title', 'Someone has shared an idea with you', '2013-12-12 08:00:00', 2, 2, 0),
(7, 'Title', 'Someone has shared an idea with you', '2013-11-16 08:00:00', 5, 4, 0),
(8, 'Title', 'Someone has shared an idea with you', '2013-09-19 07:00:00', 46, 1, 0),
(9, 'Title', 'Someone has shared an idea with you', '2013-06-19 07:00:00', 3, 3, 0),
(10, 'Title', 'Someone updated your idea', '2013-01-25 08:00:00', 49, 4, 0),
(11, 'Title', 'Someone updated your idea', '2013-07-25 07:00:00', 41, 2, 1),
(12, 'Title', 'Someone updated your idea', '2013-10-04 07:00:00', 18, 3, 0),
(13, 'Title', 'Someone updated your idea', '2013-04-12 07:00:00', 46, 4, 0),
(14, 'Title', 'Someone updated your idea', '2013-12-17 08:00:00', 11, 1, 0),
(15, 'Title', 'Someone updated your idea', '2013-08-12 07:00:00', 23, 2, 0),
(16, 'Title', 'Someone updated your idea', '2013-12-16 08:00:00', 40, 3, 0),
(17, 'Title', 'Someone updated your idea', '2013-07-23 07:00:00', 12, 4, 0),
(18, 'Title', 'Someone updated your idea', '2013-06-21 07:00:00', 12, 1, 1),
(19, 'Title', 'Someone updated your idea', '2013-07-12 07:00:00', 33, 4, 0),
(20, 'Title', 'Someone updated your idea', '2013-12-28 08:00:00', 2, 2, 1),
(21, 'Title', 'Someone updated your idea', '2013-11-10 08:00:00', 35, 3, 0),
(22, 'Title', 'Someone updated your idea', '2013-01-25 08:00:00', 10, 1, 1),
(23, 'Title', 'Someone DELETED your idea :O (just kidding)', '2013-05-26 07:00:00', 35, 4, 0),
(24, 'Title', 'Someone DELETED your idea :O (just kidding)', '2013-02-18 08:00:00', 10, 1, 1),
(25, 'Title', 'Someone DELETED your idea :O (just kidding)', '2013-08-29 07:00:00', 6, 2, 1),
(26, 'Title', 'Someone DELETED your idea :O (just kidding)', '2013-04-11 07:00:00', 42, 4, 0),
(27, 'Title', 'Admin commented on an idea you''re tracking', '2014-03-06 22:23:08', 4, 1, 1),
(28, 'Title', 'Admin commented on an idea you''re tracking', '2014-03-06 22:23:08', 4, 4, 0),
(29, 'Title', 'Admin commented on an idea you''re tracking', '2014-03-06 22:25:28', 4, 4, 0),
(30, 'Title', 'Jill commented on an idea you''re tracking', '2014-03-06 22:49:30', 4, 1, 1),
(31, 'Title', 'Jill commented on an idea you''re tracking', '2014-03-06 22:49:30', 4, 4, 0),
(32, 'Title', 'John would like to revisit the other goals has been updated.', '2014-03-06 22:50:28', 4, 2, 1),
(33, 'Title', 'John would like to revisit the other goals has been updated.', '2014-03-06 22:50:28', 4, 4, 0),
(34, 'Title', 'Jill commented on an idea you''re tracking', '2014-03-06 23:41:56', 4, 1, 1),
(35, 'Title', 'Jill commented on an idea you''re tracking', '2014-03-06 23:41:56', 4, 4, 0),
(36, 'Title', 'new comment', '2014-03-06 23:45:04', 4, 2, 1),
(37, 'Title', 'new comment', '2014-03-06 23:45:04', 4, 4, 0),
(38, 'Title', 'this project is going well', '2014-03-06 23:45:18', 4, 2, 1),
(39, 'Title', 'this project is going well', '2014-03-06 23:45:18', 4, 4, 0),
(40, 'Admin commented on John would like to revisit the other goals', 'Jill, take a look at this.', '2014-03-07 05:09:55', 4, 2, 1),
(41, 'Admin commented on John would like to revisit the other goals', 'Jill, take a look at this.', '2014-03-07 05:09:55', 4, 4, 0),
(42, 'An Idea you''re tracking has been updated', 'John would like to revisit the other goals', '2014-03-07 05:10:40', 4, 1, 1),
(43, 'An Idea you''re tracking has been updated', 'John would like to revisit the other goals', '2014-03-07 05:10:40', 4, 4, 0),
(44, 'An Idea you''re tracking has been updated', 'John would like to revisit the other goals', '2014-03-08 17:39:42', 4, 2, 0),
(45, 'An Idea you''re tracking has been updated', 'John would like to revisit the other goals', '2014-03-08 17:39:42', 4, 4, 0),
(46, 'Admin commented on Follow-up to Project Impact plan', 'leaving a comments', '2014-03-08 21:11:54', 3, 2, 0),
(47, 'An Idea you''re tracking has been updated', 'Engagement Studios part 2', '2014-03-10 15:07:59', 2, 2, 0),
(48, 'An Idea you''re tracking has been updated', 'Engagement Studios part 2', '2014-03-10 15:07:59', 2, 3, 0),
(49, 'An Idea you''re tracking has been updated', 'Follow-up to Project Impact plan', '2014-03-10 15:08:32', 3, 2, 0),
(50, 'An Idea you''re tracking has been updated', 'open-house in March', '2014-03-15 15:58:50', 16, 1, 0),
(51, 'An Idea you''re tracking has been updated', 'social media activities', '2014-03-15 15:59:16', 22, 2, 0),
(52, 'An Idea you''re tracking has been updated', 'Engagement Studios part 2', '2014-03-16 21:49:07', 2, 1, 0),
(53, 'Raghev commented on Richmond Community Organizations', ' This is a cool idea, I''d like to help Cody!', '2014-03-23 06:29:34', 60, 14, 0),
(54, 'Raghev shared an idea with you.', 'Follow-up to Project Impact plan', '2014-03-23 06:29:50', 3, 14, 1),
(55, 'Raghev shared an idea with you.', 'Follow-up to Project Impact plan', '2014-03-23 06:29:50', 3, 2, 0),
(56, 'An Idea you''re tracking has been updated', 'small c corporate governance.', '2014-03-23 18:00:17', 39, 4, 0),
(57, 'An Idea you''re tracking has been updated', 'small c corporate governance.', '2014-03-23 18:00:17', 39, 2, 0),
(58, 'An Idea you''re tracking has been updated', 'small c corporate governance.', '2014-03-23 18:00:17', 39, 3, 0),
(59, 'Admin commented on Website for The Foundation', ' Assigning this to Cody', '2014-03-23 20:18:26', 71, 14, 1),
(60, 'Admin shared an idea with you.', '', '2014-03-23 20:18:40', 54, 14, 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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

--
-- Dumping data for table `trackings`
--

INSERT INTO `trackings` (`userid`, `ideaid`) VALUES
(1, 2),
(1, 4),
(1, 8),
(1, 25),
(1, 27),
(1, 32),
(1, 41),
(1, 49),
(1, 60),
(1, 69),
(1, 70),
(2, 2),
(2, 3),
(2, 4),
(2, 7),
(2, 23),
(2, 36),
(2, 39),
(3, 2),
(3, 5),
(3, 14),
(3, 23),
(3, 25),
(3, 39),
(4, 4),
(4, 16),
(4, 23),
(4, 37),
(4, 45),
(14, 3),
(14, 6),
(14, 31);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `role`, `isdeleted`, `created`, `modified`) VALUES
(1, 'Admin', 'admin@cims.com', '3ce52092a3886e7e974658bb55cfa9c03689061c', 'admin', 0, '2014-02-18 18:04:37', '2014-02-18 18:04:37'),
(2, 'Jill', 'jill@cims.com', '3ce52092a3886e7e974658bb55cfa9c03689061c', 'author', 0, '2014-02-18 18:37:02', '2014-02-18 18:37:02'),
(3, 'Heather', 'heather@cims.com', '3ce52092a3886e7e974658bb55cfa9c03689061c', 'author', 0, '2014-02-18 18:37:35', '2014-02-18 18:37:35'),
(4, 'Justin', 'justin@cims.com', '3ce52092a3886e7e974658bb55cfa9c03689061c', 'author', 0, '2014-02-18 18:37:58', '2014-02-18 18:37:58'),
(9, 'New User', 'new@cims.com', '1a80a59a95dc7246f92aead9f3a1cd57840cc7b4', 'author', 0, '2014-03-10 20:02:31', '2014-03-10 20:02:31'),
(10, 'New Admin', 'newAdmin@cims.com', '1a80a59a95dc7246f92aead9f3a1cd57840cc7b4', 'admin', 0, '2014-03-10 20:03:03', '2014-03-10 20:03:03'),
(14, 'Cody', 'cody@cims.com', '3ce52092a3886e7e974658bb55cfa9c03689061c', 'standard', 0, '2014-03-22 18:05:07', '2014-03-22 18:05:07'),
(15, 'Raghev', 'raghev@cims.com', '3ce52092a3886e7e974658bb55cfa9c03689061c', 'standard', 0, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=132 ;

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
