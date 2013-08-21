-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 21, 2013 at 07:23 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.17

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=407 ;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`answerId`, `questionId`, `clientId`, `answer`) VALUES
(23, '1', 2, 3),
(24, '2', 2, 4),
(25, '3', 2, 1),
(26, '4', 2, 1),
(27, '5', 2, 2),
(28, '6', 2, 2),
(29, '7', 2, 2),
(30, '8', 2, 1),
(31, '9', 2, 1),
(32, '10', 2, 1),
(33, '11', 2, 1),
(34, '12', 2, 1),
(35, '13', 2, 1),
(36, '14', 2, 1),
(37, '15', 2, 2),
(38, '16', 2, 1),
(39, '17', 2, 1),
(40, '18', 2, 5),
(41, '19', 2, 5),
(42, '20', 2, 1),
(43, '21', 2, 1),
(44, '22', 2, 3),
(70, '1', 6, 4),
(71, '2', 6, 1),
(72, '3', 6, 1),
(73, '4', 6, 1),
(74, '5', 6, 1),
(75, '6', 6, 4),
(76, '7', 6, 1),
(77, '8', 6, 1),
(78, '9', 6, 1),
(79, '10', 6, 4),
(80, '11', 6, 1),
(81, '12', 6, 3),
(82, '13', 6, 1),
(83, '14', 6, 3),
(84, '15', 6, 1),
(85, '16', 6, 1),
(86, '17', 6, 3),
(87, '18', 6, 1),
(88, '19', 6, 3),
(89, '20', 6, 1),
(90, '21', 6, 1),
(91, '22', 6, 1),
(126, '1', 9, 3),
(127, '2', 9, 1),
(128, '3', 9, 5),
(129, '4', 9, 1),
(130, '5', 9, 4),
(131, '6', 9, 1),
(132, '7', 9, 3),
(133, '8', 9, 1),
(134, '9', 9, 5),
(135, '10', 9, 1),
(136, '11', 9, 3),
(137, '12', 9, 4),
(138, '13', 9, 4),
(139, '14', 9, 4),
(140, '15', 9, 5),
(141, '16', 9, 4),
(142, '17', 9, 1),
(143, '18', 9, 4),
(144, '19', 9, 5),
(145, '20', 9, 1),
(146, '21', 9, 3),
(147, '22', 9, 1),
(148, '1', 10, 2),
(149, '2', 10, 1),
(150, '3', 10, 1),
(151, '4', 10, 1),
(152, '5', 10, 3),
(153, '6', 10, 3),
(154, '7', 10, 3),
(155, '8', 10, 1),
(156, '9', 10, 5),
(157, '10', 10, 1),
(158, '11', 10, 4),
(159, '12', 10, 5),
(160, '13', 10, 2),
(161, '14', 10, 3),
(162, '15', 10, 1),
(163, '16', 10, 1),
(164, '17', 10, 1),
(165, '18', 10, 1),
(166, '19', 10, 1),
(167, '20', 10, 1),
(168, '21', 10, 1),
(169, '22', 10, 1),
(170, '23', 10, 1),
(171, '24', 10, 1),
(172, '1', 11, 1),
(173, '2', 11, 1),
(174, '3', 11, 1),
(175, '4', 11, 1),
(176, '5', 11, 1),
(177, '6', 11, 1),
(178, '7', 11, 1),
(179, '8', 11, 1),
(180, '9', 11, 1),
(181, '10', 11, 1),
(182, '11', 11, 1),
(183, '12', 11, 6),
(184, '13', 11, 5),
(185, '14', 11, 1),
(186, '15', 11, 5),
(187, '16', 11, 5),
(188, '17', 11, 3),
(189, '18', 11, 5),
(190, '19', 11, 4),
(191, '20', 11, 5),
(192, '21', 11, 5),
(193, '22', 11, 5),
(194, '23', 11, 5),
(195, '24', 11, 5),
(196, '1', 12, 3),
(197, '2', 12, 4),
(198, '3', 12, 4),
(199, '4', 12, 1),
(200, '5', 12, 1),
(201, '6', 12, 1),
(202, '7', 12, 3),
(203, '8', 12, 1),
(204, '9', 12, 1),
(205, '10', 12, 3),
(206, '11', 12, 2),
(207, '12', 12, 2),
(208, '13', 12, 2),
(209, '14', 12, 3),
(210, '15', 12, 1),
(211, '16', 12, 1),
(212, '17', 12, 1),
(213, '18', 12, 1),
(214, '19', 12, 1),
(215, '20', 12, 1),
(216, '21', 12, 1),
(217, '22', 12, 1),
(218, '23', 12, 1),
(219, '24', 12, 1),
(220, '1', 13, 1),
(221, '2', 13, 1),
(222, '3', 13, 1),
(223, '4', 13, 1),
(224, '5', 13, 1),
(225, '6', 13, 3),
(226, '7', 13, 3),
(227, '8', 13, 3),
(228, '9', 13, 5),
(229, '10', 13, 4),
(230, '11', 13, 1),
(231, '12', 13, 1),
(232, '13', 13, 1),
(233, '14', 13, 1),
(234, '15', 13, 4),
(235, '16', 13, 3),
(236, '17', 13, 3),
(237, '18', 13, 1),
(238, '19', 13, 1),
(239, '20', 13, 1),
(240, '21', 13, 1),
(241, '22', 13, 1),
(242, '23', 13, 1),
(243, '24', 13, 1),
(244, '1', 14, 1),
(245, '2', 14, 1),
(246, '3', 14, 1),
(247, '4', 14, 1),
(248, '5', 14, 1),
(249, '6', 14, 1),
(250, '7', 14, 1),
(251, '8', 14, 1),
(252, '9', 14, 1),
(253, '10', 14, 1),
(254, '11', 14, 1),
(255, '12', 14, 1),
(256, '13', 14, 1),
(257, '14', 14, 1),
(258, '15', 14, 1),
(259, '16', 14, 1),
(260, '17', 14, 1),
(261, '18', 14, 1),
(262, '19', 14, 1),
(263, '20', 14, 1),
(264, '21', 14, 1),
(265, '22', 14, 1),
(266, '23', 14, 1),
(267, '24', 14, 1),
(268, '1', 15, 4),
(269, '2', 15, 4),
(270, '3', 15, 5),
(271, '4', 15, 5),
(272, '5', 15, 1),
(273, '6', 15, 3),
(274, '7', 15, 2),
(275, '8', 15, 2),
(276, '9', 15, 4),
(277, '10', 15, 3),
(278, '11', 15, 3),
(279, '12', 15, 5),
(280, '13', 15, 5),
(281, '14', 15, 3),
(282, '15', 15, 1),
(283, '16', 15, 1),
(284, '17', 15, 1),
(285, '18', 15, 1),
(286, '19', 15, 4),
(287, '20', 15, 5),
(288, '21', 15, 4),
(289, '22', 15, 1),
(290, '23', 15, 1),
(291, '24', 15, 1),
(311, '1', 19, 3),
(312, '2', 19, 4),
(313, '3', 19, 5),
(314, '4', 19, 4),
(315, '5', 19, 4),
(316, '6', 19, 1),
(317, '7', 19, 1),
(318, '8', 19, 1),
(319, '9', 19, 1),
(320, '10', 19, 1),
(321, '11', 19, 1),
(322, '12', 19, 1),
(323, '13', 19, 1),
(324, '14', 19, 1),
(325, '15', 19, 1),
(326, '16', 19, 1),
(327, '17', 19, 1),
(328, '18', 19, 3),
(329, '19', 19, 2),
(330, '20', 19, 4),
(331, '21', 19, 4),
(332, '22', 19, 1),
(333, '23', 19, 1),
(334, '24', 19, 1),
(359, '1', 23, 3),
(360, '2', 23, 3),
(361, '3', 23, 4),
(362, '4', 23, 4),
(363, '5', 23, 4),
(364, '6', 23, 4),
(365, '7', 23, 4),
(366, '8', 23, 4),
(367, '9', 23, 6),
(368, '10', 23, 5),
(369, '11', 23, 5),
(370, '12', 23, 1),
(371, '13', 23, 1),
(372, '14', 23, 1),
(373, '15', 23, 1),
(374, '16', 23, 1),
(375, '17', 23, 1),
(376, '18', 23, 3),
(377, '19', 23, 2),
(378, '20', 23, 3),
(379, '21', 23, 2),
(380, '22', 23, 3),
(381, '23', 23, 1),
(382, '24', 23, 1),
(383, '1', 24, 1),
(384, '2', 24, 1),
(385, '3', 24, 1),
(386, '4', 24, 1),
(387, '5', 24, 1),
(388, '6', 24, 3),
(389, '7', 24, 2),
(390, '8', 24, 1),
(391, '9', 24, 3),
(392, '10', 24, 3),
(393, '11', 24, 3),
(394, '12', 24, 1),
(395, '13', 24, 1),
(396, '14', 24, 1),
(397, '15', 24, 5),
(398, '16', 24, 5),
(399, '17', 24, 3),
(400, '18', 24, 1),
(401, '19', 24, 1),
(402, '20', 24, 1),
(403, '21', 24, 1),
(404, '22', 24, 3),
(405, '23', 24, 2),
(406, '24', 24, 3);

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
  PRIMARY KEY (`clientId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `clientDetails`
--

INSERT INTO `clientDetails` (`clientId`, `clientName`, `clientDomain`, `clientContactDetailsName`, `clientContactDetailsEmail`, `clientContactDetailsPhone`, `clientLocation`, `lastUpdated`) VALUES
(2, 'Santandar', 'Finance', 'Fred Bloggs', 'fred@as.com', '0284773', 'EMEA', '2013-07-30 08:05:33'),
(6, 'Lloyds', 'Manufacturing', 'asd', 'asd', 'cad@ads', 'EMEA', '2013-07-29 08:43:58'),
(9, 'SarahJ', 'Retail', 'Sarah', 'asd@asd.com', '0284773', 'EMEA', '2013-07-29 09:20:13'),
(10, 'ChrisJ', 'Government', 'Chris', 'chrisj@redhat.com', '0284773', 'EMEA', '2013-08-01 08:57:54'),
(11, 'Halifax', 'Finance', 'Chris', 'chrisj@redhat.com', '0123445656', 'EMEA', '2013-07-30 10:59:33'),
(12, 'GoodCo', 'Finance', 'Fred Bloggs', 'fred@as.com', '07777777111', 'EMEA', '2013-08-01 08:57:54'),
(13, 'The Obtuse Lamp Telecoms Company', 'Telecoms', 'Olanda Lamp', 'olanda@otc.com', '+4471212121', 'EMEA', '2013-08-01 08:57:54'),
(14, 'Intelligent Moose Medicine', 'Health', 'Canadian Chappie', 'qwe@asd.com', '3233223', 'NA', '2013-08-01 08:57:54'),
(15, 'Grey Scarf Drugs', 'Health', 'Andy Grey', 'agrey@gsd.com', '3232323', 'NA', '2013-08-01 08:58:08'),
(19, 'Malc And Nick Inc', 'Retail', 'Chris', 'chrisj@redhat.com', '0284773', 'EMEA', '2013-08-01 09:49:50'),
(23, 'Orange Lime Theatre Company', 'Media', 'Mr Actor', 'lime@oltc.co.uk', '019283747', 'APAC', '2013-08-02 08:22:17'),
(24, 'Cj Solutions', 'Finance', 'Chris', 'chrisj@redhat.com', '0123445', 'EMEA', '2013-08-16 07:36:21');

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
