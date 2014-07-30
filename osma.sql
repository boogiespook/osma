-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 30, 2014 at 12:14 PM
-- Server version: 5.5.36-MariaDB
-- PHP Version: 5.5.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `osma`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `answerId` int(4) NOT NULL AUTO_INCREMENT,
  `questionId` varchar(4) NOT NULL,
  `clientId` int(4) NOT NULL,
  `answer` int(11) NOT NULL,
  PRIMARY KEY (`answerId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `answerTypes`
--

CREATE TABLE IF NOT EXISTS `answerTypes` (
  `answerId` int(4) NOT NULL,
  `answerType` varchar(30) NOT NULL,
  `answerValues` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clientDetails`
--

CREATE TABLE IF NOT EXISTS `clientDetails` (
  `clientId` int(3) NOT NULL AUTO_INCREMENT,
  `clientName` varchar(50) NOT NULL,
  `clientDomain` varchar(100) NOT NULL,
  `clientContactDetailsName` varchar(50) NOT NULL,
  `clientContactDetailsEmail` varchar(50) NOT NULL,
  `clientContactDetailsPhone` varchar(20) NOT NULL,
  `clientLocation` varchar(50) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `uuid` varchar(50) NOT NULL,
  PRIMARY KEY (`clientId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `commentId` int(3) NOT NULL AUTO_INCREMENT,
  `clientId` int(3) NOT NULL,
  `categoryId` int(3) NOT NULL,
  `comments` text NOT NULL,
  PRIMARY KEY (`commentId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `maturityLevels`
--

CREATE TABLE IF NOT EXISTS `maturityLevels` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(40) NOT NULL,
  `level1` varchar(500) NOT NULL,
  `level2` varchar(500) NOT NULL,
  `level3` varchar(500) NOT NULL,
  `level4` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `maturityLevels`
--

INSERT INTO `maturityLevels` (`id`, `categoryName`, `level1`, `level2`, `level3`, `level4`) VALUES
(3, 'General', 'Very limited open source adoption (< 10% of new projects). No formal policies on usage, or policies that discourage adoption.', 'Adoption on an ad-hoc basis (10% - 25% of new projects). No formal policy on usage, or policies that are neutral with regard to adoption.', 'De facto adoption based on need (25% - 50% of new projects). Formal policy recommends, but does not require, OSS adoption for new projects.', 'Adoption by default (> 50% of new projects). Formal policy requires OSS adoption with opt-out by exception only.'),
(4, 'DevelopmentStandardsandTools', 'Very limited peer reviews and use of agile development processes (< 10% of new projects). No concept of inner source communities. No formal policy on OSS development tools, or policies that discourage adoption. ', 'Peer reviews and agile development processes on an ad-hoc basis (10% - 25% of new projects). Inner source communities contemplated but not implemented. No formal policy on OSS development tools.', 'Peer reviews and agile development processes are common (25% - 50% of new projects). Inner source communities implemented, but not on a widespread basis. Formal policy recommends, but does not require, OSS development tools.', 'Mandated and widespread use of peer reviews, often between different development teams. Widespread use of agile development processes (> 50% of new projects). Inner source communities common. Formal policy requires OSS tools adoption with opt-out by exception only.'),
(5, 'HorizontalCommunityParticipation', 'Virtually no participation in horizontal OSS communities. No formal corporate guidelines on participation, or corporate guidelines that discourage participation.', 'Limited horizontal community participation on an individual basis and primarily in support roles (i.e. testing, documentation, etc.). No formal corporate guidelines on participation.', 'Horizontal community participation fairly common on an individual basis in both development and support roles. Formal corporate guidelines allow and endorse participation.', 'Horizontal community participation widespread on an institutional basis in both development and support roles. Formal corporate guidelines encourage active participation.'),
(6, 'VerticalCommunityParticipation', 'Virtually no participation in vertical OSS communities. No formal corporate guidelines on participation, or corporate guidelines that discourage participation.', 'Limited vertical community participation on an individual basis and primarily in support roles (i.e. testing, documentation, etc.). No formal corporate guidelines on participation.', 'Vertical community participation fairly common on an individual basis in both development and support roles. Formal corporate guidelines allow and endorse participation.', 'Vertical community participation widespread on an institutional basis in both development and support roles. Formal corporate guidelines encourage active participation.'),
(7, 'GovernanceandLegalPolicies', 'No formal OSS governance & legal policies in place. Legal counsel largely unaware of OSS implications and various licensing models (i.e. GPL, LGPL, CDDL, etc.), or aware of implications and licensing models but generally not supportive of OSS.', 'No formal OSS governance & legal policies in place. Legal counsel aware of OSS implications and various licensing models (i.e. GPL, LGPL, CDDL, etc.) with reviews on a case-by-case basis.', 'Formal OSS governance & legal policies in place. Legal counsel actively involved in setting clear guidelines for OSS usage, adoption, and community participation that are generally supportive of OSS.', 'Formal OSS governance & legal policies in place. Legal counsel actively involved in setting clear guidelines for OSS usage, adoption, and community participation that are highly supportive of OSS.'),
(8, 'SeniorManagementSupport', 'Senior management either unaware or unsupportive of OSS adoption and community participation.', 'Senior management aware of OSS adoption and community participation but has a neutral outlook.', 'Senior management passively supports OSS adoption and community participation.', 'Senior management actively supports and encourages OSS adoption and community participation with formal time and/or funding allocations. ');

-- --------------------------------------------------------

--
-- Table structure for table `pageNumbers`
--

CREATE TABLE IF NOT EXISTS `pageNumbers` (
  `page` varchar(30) NOT NULL,
  `prevPage` varchar(30) NOT NULL,
  `nextPage` varchar(30) NOT NULL,
  `progress` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pageNumbers`
--

INSERT INTO `pageNumbers` (`page`, `prevPage`, `nextPage`, `progress`) VALUES
('welcome.html', '', 'intro.html', 10),
('intro.html', 'welcome.html', 'clientDetails.php', 20),
('clientDetails.php', 'intro.html', '1.php', 30),
('1.php', 'clientDetails.php', '2.php', 40),
('2.php', '1.php', '3.php', 50),
('3.php', '2.php', '4.php', 60),
('4.php', '3.php', '5.php', 70),
('5.php', '4.php', '6.php', 80),
('6.php', '5.php', 'summary.php', 90),
('summary.php', '6.php', 'assessment.php', 100),
('assessment.php', 'summary.php', 'workshop.php', 100),
('workshop.php', 'assessment.php', 'workshop.php', 100);

-- --------------------------------------------------------

--
-- Table structure for table `questionCatagories`
--

CREATE TABLE IF NOT EXISTS `questionCatagories` (
  `categoryId` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(100) NOT NULL,
  `details` text NOT NULL,
  `redhat1` varchar(50) NOT NULL,
  `redhat2` varchar(50) NOT NULL,
  PRIMARY KEY (`categoryId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `questionCatagories`
--

INSERT INTO `questionCatagories` (`categoryId`, `categoryName`, `details`, `redhat1`, `redhat2`) VALUES
(1, 'General', 'Explore the wider issues and concerns regarding the use of Open Source software within the organisation', 'Malcolm Herbert', 'A N Other'),
(2, 'Development Standards and Tools', 'Discuss possible tools and open standards that can be successfully deployed within the organisation', 'Mr Standards Dude', 'Deputy Standards Dude'),
(3, 'Horizontal Community Participation', 'How to create openness between various areas of the organisation and created a sense of unity when it comes to open source participation.', 'Mr Collaboration Dude', 'Deputy Mr Collaboration Dude'),
(4, 'Vertical Community Participation', 'Discuss the benefits of vertical participation in Open Source Software and ways to achieve it', 'Mr Collaboration Dude', 'Deputy Mr Collaboration Dude'),
(5, 'Governance and Legal Policies', 'Explore the various options such as GPL, LGPL and legal protection from IP exploitation', 'Mr Legal Dude', 'Deputy Mr Legal Dude'),
(6, 'Senior Management Support ', 'How to achieve buy-in from Senior Management regarding the use of Open Source Software', 'Malcolm Herbert', 'A N Other');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `questionId` int(4) NOT NULL AUTO_INCREMENT,
  `questionNumber` int(3) NOT NULL,
  `categoryId` int(3) NOT NULL,
  `questionText` text NOT NULL,
  `option1` varchar(100) NOT NULL,
  `option2` varchar(100) NOT NULL,
  `option3` varchar(100) NOT NULL,
  `option4` varchar(100) NOT NULL,
  `option5` varchar(100) NOT NULL,
  `option6` varchar(100) NOT NULL,
  `maxScore` int(2) NOT NULL,
  PRIMARY KEY (`questionId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`questionId`, `questionNumber`, `categoryId`, `questionText`, `option1`, `option2`, `option3`, `option4`, `option5`, `option6`, `maxScore`) VALUES
(1, 1, 1, 'To what extent is Open Source Software being adopted within your organization today?', '< 10% of New Projects', '10% - 25% of New Projects ', '25% - 50% of New Projects ', '> 50% of New Projects', 'X', 'X', 4),
(2, 2, 1, 'Which term best describes the highest organizational level of Open Source Software adoption within your organization?', 'Individual Adoption ', 'Small-Team Adoption', 'Large-Team Adoption ', 'Institutional Adoption', 'X', 'X', 4),
(3, 3, 1, 'Which term best describes how Open Source Software is adopted within your organization?', 'Secretive', 'Under-The-Radar ', 'Ad-hoc', 'Opportunistic', 'Management Endorsed ', 'Strategically Focused', 6),
(4, 4, 1, 'What level of support do you have for any formal corporate policies regarding the use and adoption of Open Source Software?', 'Not Supportive', 'Neutral', 'Encouraged For New Projects', 'Encouraged But Not Required', 'Required For New Projects', 'X', 5),
(5, 5, 1, 'Over the next twelve months what do you predict will happen regarding Open Source Software adoption within your organization compared to the last twelve months?', 'Decrease Significantly', 'Decrease Somewhat', 'Stay The Same', 'Increase Somewhat ', 'Increase Significantly', 'X', 5),
(6, 6, 2, 'To what extent are agile / iterative development methodologies being adopted within your organization today?', '< 10% of New Projects ', '10% - 25% of New Projects ', '25% - 50% of New Projects ', '> 50% of New Projects', 'X', 'X', 4),
(7, 7, 2, 'To what extent are formal peer reviews of source code implemented within your organization today?', '< 10% of New Projects ', '10% - 25% of New Projects ', '25% - 50% of New Projects ', '> 50% of New Projects', 'X', 'X', 4),
(8, 8, 2, 'Which term best describes the highest organizational level of Open Source development tools adoption within your organization?', 'Individual Adoption ', 'Small-Team Adoption', 'Large-Team Adoption ', 'Institutional Adoption', 'X', 'X', 4),
(9, 9, 2, 'Which term(s) best describes how Open Source development tools are adopted within your organization?', 'Secretive', 'Under-The-Radar ', 'Ad-hoc', 'Opportunistic', 'Management Endorsed ', 'Strategically Focused', 6),
(10, 10, 2, 'How would you describe your formal corporate policies regarding the use and adoption of Open Source development?', 'Not Supportive', 'Neutral', 'Encouraged For New Projects', ' But Not Required', 'Required For New Projects', 'X', 5),
(11, 11, 2, 'To what extent do inner source communities (i.e. communities between multiple projects that work collectively to develop software that is reusable across the organization) exist within your organization today?', 'Very Small Extent', 'Small Extent', 'Moderate Extent', 'Large Extent', 'Very Large Extent', 'X', 5),
(12, 12, 3, 'To what extent do employees participate in horizontal Open Source Software communities (i.e. Linux,  Apache etc)?', 'None', 'Very Small Extent', 'Small Extent', 'Moderate Extent', 'Large Extent', 'Very Large Extent', 6),
(13, 13, 3, 'How would you best describe any formal corporate policies regarding employee participation in horizontal OSS communities?', 'Not Supportive', 'Neutral', 'Encouraged For New Projects', ' But Not Required', 'Required For New Projects', 'X', 5),
(14, 14, 3, 'How often do internal project teams fix bugs or contribute new features to horizontal open source components/projects? (i.e. Linux, Apache, etc.)?', '<10% of the time', '10% - 25% of the time', '25% - 50% of the time', '> 50% of the time', 'X', 'X', 4),
(15, 15, 4, 'To what extent do employees participate in vertical Open Source Software communities (i.e. Linux, Apache etc)?', 'Very Small Extent', 'Small Extent', 'Moderate Extent', 'Large Extent', 'Very Large Extent', 'X', 5),
(16, 16, 4, 'How would you best describe any formal corporate policies regarding employee participation in horizontal OSS communities?', 'Not Supportive', 'Neutral', 'Encouraged For New Projects', ' But Not Required', 'Required For New Projects', 'X', 5),
(17, 17, 4, 'How often are internal technologies/code reviewed for possible creation of vertical open source communities?', '10% - 25% of New Projects ', '25% - 50% of New Projects ', '> 50% of New Projects', 'X', 'X', 'X', 4),
(18, 18, 5, 'To what extent is your legal department familiar with the implications of open source software and the differences between various open source licensing models (i.e. GPL, LGPL etc)', 'Very Small Extent', 'Small Extent', 'Moderate Extent', 'Large Extent', 'Very Large Extent', 'X', 5),
(19, 19, 5, 'How involved is your legal department in setting policies and guidelines around open source software adoption and usage?', 'Not Involved At All', 'Involved On a Very Limited Basis', 'Passively but Regularly Involved', 'Actively Involved', 'X', 'X', 4),
(20, 20, 5, 'What level of support do you have for any formal corporate policies regarding the use and adoption of Open Source Software?', 'Generally Discourages', 'Allows On A Case-By-Case Basis', 'Allows', 'Supports', 'Actively Encourages', 'X', 5),
(21, 21, 5, 'How would you best describe any formal legal policies in place with regard to open source software usage and adoption?', 'Generally Discourages', 'Allows On A Case-By-Case Basis', 'Allows', 'Supports', 'Actively Encourages', 'X', 5),
(22, 22, 6, 'To what extent is your senior management team aware of OSS adoption and community participation within the IT organization?', 'Very Small Extent', 'Small Extent', 'Moderate Extent', 'Large Extent', 'Very Large Extent', 'X', 5),
(23, 23, 6, 'To what extent is your senior management team supportive of OSS adoption and community participation within the IT organization?', 'Very Small Extent', 'Small Extent', 'Moderate Extent', 'Large Extent', 'Very Large Extent', 'X', 5),
(24, 24, 6, 'To what extent does senior management allocate formal time and/or funding commitments towards participating in open source software community development?', 'Very Small Extent', 'Small Extent', 'Moderate Extent', 'Large Extent', 'Very Large Extent', 'X', 5);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
