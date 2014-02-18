-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 18, 2014 at 08:11 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

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
  `multiselect` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `multiselect`) VALUES
(1, 'Kind of Idea', 0),
(2, 'Type of Project', 0),
(3, 'Type of Partner', 1),
(4, 'Theme or Focus Area', 1),
(5, 'Project Type', 1),
(6, 'Appropriate Disciplines', 1),
(7, 'Timeframe for Implementation', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `ideaid` int(11) NOT NULL,
  `message` varchar(5000) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `ideaid` (`ideaid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

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
(38, 2, 48, 'Just one random idea that came from an initial conversationthat Susan and I had (Oct 16, 2013) with three Foundation staff.  If an idea can be explored further, please connect with Justin so that I may make an eIntroduction, as Barbara may not be the right person to talk to, but can pathfind to who might be.', '2014-01-09 08:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ideas`
--

CREATE TABLE IF NOT EXISTS `ideas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `description` text NOT NULL,
  `status` enum('Open','InProgress','Matched') NOT NULL DEFAULT 'Open',
  `community_partner` text NOT NULL,
  `contact_name` text NOT NULL,
  `contact_email` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `ideas`
--

INSERT INTO `ideas` (`id`, `name`, `description`, `status`, `community_partner`, `contact_name`, `contact_email`, `created`, `updated`, `userid`) VALUES
(1, 'Psychology professor at UBC ', 'Psychology professor at UBC, Dr ****** ****** has approval for funding to work on a Youth in Transitions research project with Community Partner 1. There is a PhD student overseeing the project and there may be an opportunity for 1-2 grad students to help with data collection / subject identification and interviews, etc.   ', 'Matched', 'Community Partner 1 ', 'Jane Smith ', 'janesmith@cp1.ca ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 1),
(2, 'Engagement Studios part 2 ', 'Engagement Studios part 2: to carry on the work of a previous group of CHD students who created a plan for a sustainable health and fitness program for individuals with developmental disabilities who are accessing the 4 Day Programs delivered by Community Partner 1; students will develop and implement new group fitness activities to support the long term goal of a sustainable program that can be delivered by staff ', 'Open', 'Community Partner 1 ', 'Jane Smith ', 'janesmith@cp1.ca ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 1),
(3, 'Follow-up to Project Impact plan ', 'Follow-up to Project Impact plan: Community Partner 1 partnering with CNH on multi-cultural project targeted at families with children with developmental disabilities;  CNH will provide space for sessions as will the Community Partner 1 office on **** near ****. They both have staff that will deliver the workshops/activities but would like a student to help develop the plan for outreach and consultation & identify what activities and will bring certain members of the community out to engage.   ', 'InProgress', 'Community Partner 1 ', 'John Dumas ', 'johndumas@cp1.ca ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 1),
(4, 'John would like to revisit the other goals ', 'John would like to revisit the other goals coming from the PI plan…specifically,  develop a plan for the Vietnamese community to access resources and engage with services in their community…this will include identifying how and where to reach out to the community  ', 'Open', 'Community Partner 1 ', 'John Dumas ', 'johndumas@cp1.ca ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 1),
(5, 'A brochure detailing community services ', 'A brochure detailing community services and supports for the  Community Schools Team (CST) and Community Partner 3 and developed for use by teachers who don''t live in the area and are unaware of local resources that can support their students and families.  ', 'Matched', 'Community Partner 3 ', 'Mary Jones ', 'mjones@ilikecommunity.ca ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 1),
(6, 'Research community organizations in Richmond ', '1. Research community organizations in Richmond and the populations they serve and then identify which ones serve populations that are likely not accessing the Foodbank but could benefit from it ', 'Open', 'Community Partner 2 ', 'Edward Chang ', 'edc@food.ca ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 2),
(7, 'Develop a plan with the community partner ', '2. Develop a plan with the community partner to reach out to individuals and  distribute food whether it be at Community Partner 2 (preferred) or at the organization site ', 'Matched', 'Community Partner 2 ', 'Cherry Blue ', 'Cherryb@food.ca ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 2),
(8, ' open house ', 'Agency focused open house at Community Partner 2 ', 'Open', 'Community Partner 2 ', 'Cherry Blue ', 'cherryb@food.ca ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 2),
(9, 'new social media trends ', 'Still needs more development: Research, test, assess, and recommend any new social media trends and tools for future application; Monitor/track similar social media activity and respond in a timely manner; Help develop a sustainable social media plan ', 'Open', 'Community Partner 4 ', 'Luke Warmwater ', 'lukewarmwater@media.com ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 3),
(10, 'Open house in March ', 'Open house in March for community to learn more about the organization ', 'InProgress', 'Community Partner 5...ON HOLD, WILL REVISIT IN JANUARY ', 'Laura Jones ', 'laura.jones@firstnationshealth.com ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 3),
(11, 'showcase art created by residents ', 'Have students work with staff to create a plan to showcase art created by residents in all Community Partner 6 program areas. For example: Photography Club, Galliano Camping Trip working with 2 artists (jewellery & water colour), Garden Boxes with, portraits/graffiti with human rights/values, ceramics making teapots, plantar holders, & mugs, upcyling Art with recyclable materials, makeup Artists for Haunted House ', 'Open', 'Community Partner 6 ', 'Huey, Louis, Dewey ', 'huey@neighbourhood.ca, louis@neighbourhood.ca, dewey@neighbourhood.ca ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 3),
(12, 'Generating Citizenship Community ', 'students to help plan for Community Partner 6''s  Generating Citizenship Community Form to take place Spring 2014 ', 'Open', 'Community Partner 6 ', 'Marshall Ericson ', 'marshall@neighbourhood.ca ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 1),
(13, 'Maintenance of website ', 'Still needs to be developed: Maintenance of  website (ongoing? One time project?) ', 'Matched', 'Community Partner 7 ', 'Ginger Rogers, Fred Astaire ', 'ginger@dance.com, fred@dance.com ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 2),
(14, 'school website ', 'marketing or computer science student to help with the development of their school website; they use the *** platform right now which is mandatory but they want to make theirs look more interesting and vibrant to reflect the fine arts focus they have. ', 'InProgress', 'Community Partner 8 ', 'Groucho Marx ', 'groucho@it.com ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 3),
(15, 'City and the Parks board ', 'a student to volunteer a couple of hours per week to do a little bit of research and provide recommendations and a list of potential partners to source funds. Possible conversations with the City and the Parks board.  The *** will do all the tendering but before they do they want to see the funds in place so the school has a deadline of June 2014 to raise the money.  The student helping them would not be required to do the actually fundraising. ', 'Matched', 'Community Partner 9 ', 'Audrey Hepburn ', 'audrey@dance.com ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 4),
(16, ' open-house in March ', 'Still needs to be developed: The community partner has been thinking about hosting an open-house in March to invite community members and local business to find out more about their work. ', 'Open', 'Community Partner 10 ', 'Elvis Presley ', 'elvis@dance.com ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 1),
(17, 'day camp ', 'Work with the Trek nutrition team to create a day camp that contains two parts: 1) Nutrition: Choosing the right food & drink 2) Stretching & At-home exercises.  ', 'Open', 'Community Partner 11 ', 'Marilyn Monroe ', 'mmonroe@idigcommunity.com ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 2),
(18, 'identify needs of immigrant families ', 'Assist in the development and implementation/facilitation of community dialogue tables  to help Community Partner 12 identify needs of immigrant families with young children; assist with research questions ', 'Open', 'Community Partner 12 ', 'Peter Mansbridge ', 'Pete@kidsrule.ca ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 3),
(19, 'Identify barriers for immigrant parents ', 'Identify barriers for immigrant parents to be involved in PACs and develop strategies to enhance Community Partner 12 outreach activities  ', 'Open', 'Community Partner 12 ', 'Peter Mansbridge ', 'Pete@kidsrule.ca ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 3),
(20, 'engage newcomers in green initiatives ', 'Conduct research and identify strategies to engage newcomers in green initiatives ', 'InProgress', 'Community Partner 12 ', 'Peter Mansbridge ', 'Pete@kidsrule.ca ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 4),
(21, 'clearer picture of DTs involvement ', 'Not only has the community schools team worked with UBC over the years, other staff, teachers, and clubs have as well.  They would like a clearer picture of DTs involvement and partnership with UBC so they can be more strategic in their work. They would like an asset map of all the work and projects being done. ', 'Open', 'Community Partner 13 ', 'Hannah Montana ', 'hmontana@dance.com ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 1),
(22, ' social media activities ', 'come up with a better plan for their current social media activities – they aren’t reaching their full potential ', 'Open', 'Community Partner 14 ', 'Humphrey Bogart ', 'katherine.MacIntyre@options.bc.ca  ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 2),
(23, 'evaluation process of our programming ', 'Help with our evaluation process of our programming (focus groups, assistance with surveys (multiple languages; 4 different locations, 6 days a week on last 2 weeks of October 2013 (approximately 200 surveys or more) – you don’t have to be there for all, they are just looking for some help ', 'Open', 'Community Partner 14 ', 'Humphrey Bogart ', 'hbog@eel.ca ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 4),
(24, 'Outdoor musical instruments ', 'Outdoor musical instruments and other interactive pieces for exploratory play – they are interested in doing something different with their playground– something more natural that gets kids outdoors and playing.  This may be a research role. ', 'InProgress', 'Community Partner 14 ', 'Humphrey Bogart ', 'hbog@eel.ca ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 4),
(25, 'engage with local business and politicians ', 'develop a strategy to engage with local business and politicians, that will help with fundraising efforts and also be used as a regular way to keep regular contact with partners and explore ways to support their needs as well. ', 'Open', 'Community Partner 14 ', 'Humphrey Bogart ', 'hbog@eel.ca ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 4),
(26, 'You tube video to tell our story ', 'We want to capture a short You tube video to tell our story. We would also like to find a way to record Community Partner 14''s history; preserve the story and the feeling of grassroots, as we grow and people retire ', 'Open', 'Community Partner 14 ', 'Humphrey Bogart ', 'hbog@eel.ca ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 1),
(27, 'youth friendly application form ', 'Content analysis of comparable youth agencies volunteer application forms, volunteer agreements, orientation handbooks/process; redevelop and create a youth friendly application form that is accessible, linked & available online; ', 'Open', 'Community Partner 15 ', 'Frank Sinatra ', 'Frank@volunteer.ca ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 2),
(28, 'new Board members ', 'seeking new Board members, most especially a treasurer ', 'InProgress', 'Community Partner 16 ', 'Aretha Franklin ', 'respect@comm.com ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 2),
(29, 'help with social media ', 'help with social media - specifically Twitter and Facebook ', 'Open', 'Community Partner 16 ', 'Aretha Franklin ', ' ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 3),
(30, 'videos made at Community Partner 16 ', 'we would like a series of videos made at Community Partner 16 about our school and its culture and we would love to have lip dub done as well ', 'Open', 'Community Partner 16 ', 'Aretha Franklin ', ' ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 4),
(31, 'students working together to tell stories ', 'Following up on the initial project impact goals of raising awareness of the strengths and wisdom of inner city children, we are looking at a week of UBC and Community Partner 17 students working together to tell stories ', 'Open', 'Community Partner 17 ', 'Monica Geller ', 'mon@geller.ca ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 1),
(32, 'exploring business models for program delivery ', 'still scoping but she has a couple of project ideas coming - one about exploring business models for program delivery ', 'InProgress', 'Community Partner 18 ', 'Rachel Green ', 'rachel.green@communitybusiness.ca ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 1),
(33, 'fresh, healthy food in Vancouver’s West End ', 'Assess the availability and affordability of fresh, healthy food in Vancouver’s West End. Design a representative “Shopping List,” representing the dietary needs of one adult for one week; survey each market in the neighbourhood and record the availability and price of each item on that list.  These results will be compiled, and overlaid on a map of the area, enabling us to identify areas of the West End where food is either unavailable or unaffordable to residents.   ', 'Matched', 'Community Partner 19 ', 'Chandler Bing ', 'mschenandlerbong@gmail.com ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 1),
(34, 'gallery to showcase local art ', 'Having a student come in and activate the space as a gallery to showcase local art from residents from the constituency. ', 'Open', 'Community Partner 20 ', 'Pheobe Buffet ', 'Pheobe.buffet@art.com ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 3),
(35, 'why businesses are not thriving ', 'Lots of businesses in the area do not succeed.  Some research on uncovering some of this data and analyzing it for some understanding as to why businesses are not thriving in this constituency. ', 'Open', 'Community Partner 20 ', 'Pheobe Buffet ', 'Pheobe.buffet@art.com ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 3),
(36, 'start and support various community committees ', 'The community office is starting from scractch and would like to get some support in understanding how to start and support various community committees (they have an arts one that has started) and develop infrastructure to support this work, including things like volunteer management infrastructure. ', 'InProgress', 'Community Partner 20 ', 'Pheobe Buffet ', 'Pheobe.buffet@art.com ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 3),
(37, 'HR satisfaction survey. ', 'Conducting an HR satisfaction survey. ', 'Open', 'Community Partner 21 ', 'Joey Tribiani, CEO ', 'joe.tribiani@hr.ca ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 3),
(38, 'HR policy framework ', 'Supporting the development of an HR policy framework. ', 'Open', 'Community Partner 21 ', 'Joey Tribiani, CEO ', 'joe.tribiani@hr.ca ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 3),
(39, '"small c" corporate governance. ', 'Supporting some work at the foundation around "small c" corporate governance. ', 'InProgress', 'Community Partner 21 ', 'Joey Tribiani, CEO ', 'joe.tribiani@hr.ca ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 4),
(40, 'An IT overhaul at the Foundation ', 'An IT overhaul at the Foundation is needed.  A start would be a business case prepared (higher level student help - maybe MBA) - doing some business analysis to show how better IT might free up time to do some capital planning and other business care work. ', 'Open', 'Community Partner 21 ', 'Joey Tribiani, CEO ', 'joe.tribiani@hr.ca ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 4),
(41, 'developing a framework ', 'Whole area of prospect research, perhaps developing a framework and key business processes on how to proactively seek out fund development prospects. ', 'Open', 'Community Partner 21 ', 'Joey Tribiani, CEO ', 'joe.tribiani@hr.ca ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 4),
(42, 'Analytics of our databases ', 'Analytics of our databases, maybe some statistical modeling, to help us better understand the donors we currently have and what does the data tell us to help us make better decisions. ', 'Open', 'Community Partner 21 ', 'Joey Tribiani, CEO ', 'joe.tribiani@hr.ca ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 4),
(43, 'Marketing and communications help ', 'Marketing and communications help - a comprehensive contact strategy would be really helpful.  Perhaps a starting point would be an audit of what we do now. ', 'InProgress', 'Community Partner 21 ', 'Joey Tribiani, CEO ', 'joe.tribiani@hr.ca ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 2),
(44, 'donor relations strategy ', 'Similar to a comprehensive contact strategy, one for a donor relations strategy, again looking at what we do now might be a good starting point. ', 'Open', 'Community Partner 21 ', 'Joey Tribiani, CEO ', 'joe.tribiani@hr.ca ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 2),
(45, 'The Foundation Name ', 'The Foundation Name is a holdover on when the two foundations merged.  Dealing with a name change is something they would like to do, but perhaps a good starting point would be to do a study (maybe focus groups?) on the topic. ', 'Open', 'Community Partner 21 ', 'Joey Tribiani, CEO ', 'joe.tribiani@hr.ca ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 2),
(46, 'studying social media ', 'Really studying social media in terms of fundraising and demographics - what does this mean for us? - We can''t NOT be there, but how much resources should we be spending on this?  And in what areas? ', 'InProgress', 'Community Partner 21 ', 'Joey Tribiani, CEO ', 'joe.tribiani@hr.ca ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 2),
(47, 'developing IT systems ', 'Follow-up work after some of the other initial auditing and research ideas, but developing IT systems around fund management and donor communications/emails. ', 'Open', 'Community Partner 21 ', 'Joey Tribiani, CEO ', 'joe.tribiani@hr.ca ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 1),
(48, 'support patients ', 'Some very initial idea on how to support patients to communicate with the health system from home.  This idea I''m very fuzzy on, but there did appear to be some energy in this idea, so I''ve documented it here. ', 'Matched', 'Community Partner 21 ', 'Joey Tribiani, CEO ', 'joe.tribiani@hr.ca ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 1),
(49, 'tour organizing committee ', '"**** tour organizing committee.  This provides a tour of the refugee hearing space and meeting with a refugee board official to explain the system and answer questions.  We provide an extensive guide, interpretation and do a pre and post tour questionnaire.the flyer, the evaluation, the post tour questionnaire,the questionnaire answer key (almost identical to the post tour)" ', 'Open', 'Community Partner 22 ', 'Ross Geller ', 'ilovemarcel@communicate.com ', '2014-02-18 19:05:47', '2014-02-18 19:05:47', 1);

-- --------------------------------------------------------

--
-- Table structure for table `idea_values`
--

CREATE TABLE IF NOT EXISTS `idea_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ideaid` int(11) NOT NULL,
  `valueid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ideaid` (`ideaid`),
  KEY `valueid` (`valueid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=153 ;

--
-- Dumping data for table `idea_values`
--

INSERT INTO `idea_values` (`id`, `ideaid`, `valueid`) VALUES
(1, 1, 47),
(2, 1, 7),
(3, 1, 35),
(4, 1, 17),
(5, 1, 47),
(6, 2, 43),
(7, 2, 32),
(8, 3, 27),
(9, 3, 28),
(10, 4, 32),
(11, 4, 22),
(12, 5, 4),
(13, 5, 1),
(14, 5, 37),
(15, 5, 44),
(16, 5, 39),
(17, 5, 30),
(18, 5, 10),
(19, 6, 11),
(20, 7, 31),
(21, 7, 5),
(22, 7, 50),
(23, 7, 38),
(24, 7, 18),
(25, 8, 6),
(26, 8, 49),
(27, 8, 16),
(28, 9, 30),
(29, 9, 5),
(30, 9, 2),
(31, 10, 4),
(32, 10, 22),
(33, 10, 18),
(34, 10, 19),
(35, 11, 42),
(36, 12, 39),
(37, 12, 34),
(38, 13, 25),
(39, 13, 19),
(40, 13, 40),
(41, 14, 7),
(42, 16, 44),
(43, 17, 46),
(44, 17, 24),
(45, 18, 6),
(46, 18, 35),
(47, 19, 8),
(48, 19, 47),
(49, 20, 31),
(50, 20, 41),
(51, 20, 43),
(52, 20, 35),
(53, 20, 2),
(54, 21, 45),
(55, 21, 12),
(56, 23, 49),
(57, 23, 11),
(58, 23, 17),
(59, 23, 39),
(60, 23, 9),
(61, 23, 19),
(62, 23, 21),
(63, 23, 21),
(64, 23, 27),
(65, 23, 13),
(66, 23, 21),
(67, 25, 10),
(68, 25, 41),
(69, 25, 25),
(70, 25, 22),
(71, 26, 21),
(72, 26, 38),
(73, 26, 48),
(74, 27, 41),
(75, 27, 39),
(76, 27, 26),
(77, 27, 8),
(78, 28, 3),
(79, 28, 5),
(80, 28, 27),
(81, 28, 43),
(82, 29, 7),
(83, 29, 42),
(84, 29, 10),
(85, 30, 42),
(86, 30, 7),
(87, 30, 13),
(88, 30, 24),
(89, 31, 32),
(90, 31, 48),
(91, 32, 46),
(92, 32, 32),
(93, 33, 25),
(94, 33, 46),
(95, 33, 20),
(96, 34, 24),
(97, 34, 39),
(98, 34, 45),
(99, 35, 50),
(100, 35, 9),
(101, 35, 49),
(102, 35, 19),
(103, 36, 22),
(104, 36, 50),
(105, 36, 3),
(106, 36, 46),
(107, 36, 8),
(108, 36, 48),
(109, 36, 25),
(110, 36, 41),
(111, 36, 12),
(112, 36, 40),
(113, 37, 9),
(114, 37, 13),
(115, 37, 13),
(116, 37, 30),
(117, 37, 49),
(118, 38, 7),
(119, 38, 15),
(120, 39, 19),
(121, 39, 19),
(122, 39, 51),
(123, 39, 21),
(124, 40, 42),
(125, 40, 2),
(126, 40, 4),
(127, 41, 7),
(128, 41, 33),
(129, 41, 2),
(130, 41, 48),
(131, 42, 29),
(132, 42, 33),
(133, 42, 9),
(134, 43, 46),
(135, 43, 10),
(136, 44, 7),
(137, 44, 2),
(138, 44, 6),
(139, 44, 24),
(140, 44, 22),
(141, 45, 10),
(142, 46, 21),
(143, 46, 49),
(144, 46, 10),
(145, 47, 35),
(146, 47, 40),
(147, 47, 40),
(148, 48, 35),
(149, 48, 43),
(150, 49, 45),
(151, 49, 14),
(152, 49, 49);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(150) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ideaid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `ideaid` (`ideaid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `message`, `created`, `ideaid`, `userid`) VALUES
(1, 'Someone has shared an idea with you', '2013-06-25 07:00:00', 23, 1),
(2, 'Someone has shared an idea with you', '2013-07-08 07:00:00', 19, 2),
(3, 'Someone has shared an idea with you', '2013-04-03 07:00:00', 8, 3),
(4, 'Someone has shared an idea with you', '2013-06-16 07:00:00', 20, 4),
(5, 'Someone has shared an idea with you', '2013-12-25 08:00:00', 47, 3),
(6, 'Someone has shared an idea with you', '2013-12-12 08:00:00', 2, 2),
(7, 'Someone has shared an idea with you', '2013-11-16 08:00:00', 5, 4),
(8, 'Someone has shared an idea with you', '2013-09-19 07:00:00', 46, 1),
(9, 'Someone has shared an idea with you', '2013-06-19 07:00:00', 3, 3),
(10, 'Someone updated your idea', '2013-01-25 08:00:00', 49, 4),
(11, 'Someone updated your idea', '2013-07-25 07:00:00', 41, 2),
(12, 'Someone updated your idea', '2013-10-04 07:00:00', 18, 3),
(13, 'Someone updated your idea', '2013-04-12 07:00:00', 46, 4),
(14, 'Someone updated your idea', '2013-12-17 08:00:00', 11, 1),
(15, 'Someone updated your idea', '2013-08-12 07:00:00', 23, 2),
(16, 'Someone updated your idea', '2013-12-16 08:00:00', 40, 3),
(17, 'Someone updated your idea', '2013-07-23 07:00:00', 12, 4),
(18, 'Someone updated your idea', '2013-06-21 07:00:00', 12, 1),
(19, 'Someone updated your idea', '2013-07-12 07:00:00', 33, 4),
(20, 'Someone updated your idea', '2013-12-28 08:00:00', 2, 2),
(21, 'Someone updated your idea', '2013-11-10 08:00:00', 35, 3),
(22, 'Someone updated your idea', '2013-01-25 08:00:00', 10, 1),
(23, 'Someone DELETED your idea :O (just kidding)', '2013-05-26 07:00:00', 35, 4),
(24, 'Someone DELETED your idea :O (just kidding)', '2013-02-18 08:00:00', 10, 1),
(25, 'Someone DELETED your idea :O (just kidding)', '2013-08-29 07:00:00', 6, 2),
(26, 'Someone DELETED your idea :O (just kidding)', '2013-04-11 07:00:00', 42, 4);

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
(1, 1),
(1, 2),
(1, 8),
(1, 25),
(1, 27),
(1, 41),
(2, 2),
(2, 3),
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
(4, 45);

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
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `role`, `created`, `modified`) VALUES
(1, 'Admin', 'admin@cims.com', '3ce52092a3886e7e974658bb55cfa9c03689061c', 'admin', '2014-02-18 18:04:37', '2014-02-18 18:04:37'),
(2, 'Jill', 'jill@cims.com', '3ce52092a3886e7e974658bb55cfa9c03689061c', 'author', '2014-02-18 18:37:02', '2014-02-18 18:37:02'),
(3, 'Heather', 'heather@cims.com', '3ce52092a3886e7e974658bb55cfa9c03689061c', 'author', '2014-02-18 18:37:35', '2014-02-18 18:37:35'),
(4, 'Justin', 'justin@cims.com', '3ce52092a3886e7e974658bb55cfa9c03689061c', 'author', '2014-02-18 18:37:58', '2014-02-18 18:37:58');

-- --------------------------------------------------------

--
-- Table structure for table `values`
--

CREATE TABLE IF NOT EXISTS `values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `categoryid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categoryid` (`categoryid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `values`
--

INSERT INTO `values` (`id`, `name`, `categoryid`) VALUES
(1, 'On-going1', 1),
(2, 'Project', 1),
(3, 'Community Service Learning', 2),
(4, 'Community Based Research', 2),
(5, 'Co-Curricular Service Learning', 2),
(6, 'Campus Service Learning', 2),
(7, 'Community Engagement (Not Project-Based)', 2),
(8, 'Aboriginal Engagement', 3),
(9, 'Arts - Culture - Heritage', 3),
(10, 'Civic Participation - Politics - Democracy', 3),
(11, 'Community and Economic Development', 3),
(12, 'Education - Research', 3),
(13, 'Health - Human Services', 3),
(14, 'Inclusion - Diversity', 3),
(15, 'International', 3),
(16, 'IT - Media - Communication', 3),
(17, 'Legal - Justice - Human Rights', 3),
(18, 'Recreation - Sport', 3),
(19, 'Social Services', 3),
(20, 'Sustainability - Environment - Animals', 3),
(21, 'Other', 3),
(22, 'Other - Specify', 3),
(23, 'Aboriginal Engagement', 4),
(24, 'Arts - Culture - Heritage', 4),
(25, 'Civic Participation - Politics - Democracy', 4),
(26, 'Community and Economic Development', 4),
(27, 'Education - Research', 4),
(28, 'Health - Human Services', 4),
(29, 'Inclusion - Diversity', 4),
(30, 'International', 4),
(31, 'IT - Media - Communication', 4),
(32, 'Legal - Justice - Human Rights', 4),
(33, 'Recreation - Sport', 4),
(34, 'Social Services', 4),
(35, 'Sustainability - Environment - Animals', 4),
(36, 'Other', 4),
(37, 'Other - Specify', 4),
(38, 'Consultation', 5),
(39, 'Data Gathering', 5),
(40, '', 5),
(41, 'Event', 5),
(42, 'Fund Development', 5),
(43, 'IT', 5),
(44, 'Marketing and Communications', 5),
(45, 'Research - Literature Review', 5),
(46, 'Curriculum Development', 5),
(47, 'Research - Evaluation and Assessment', 5),
(48, 'Research - Data Collection', 5),
(49, 'Program Development', 5),
(50, 'Flexible', 7),
(51, 'Specific - If so, please specify', 7);

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
