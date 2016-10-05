-- MySQL dump 10.14  Distrib 5.5.39-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: osma
-- ------------------------------------------------------
-- Server version	5.5.39-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `answerTypes`
--

DROP TABLE IF EXISTS `answerTypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `answerTypes` (
  `answerId` int(4) NOT NULL,
  `answerType` varchar(30) NOT NULL,
  `answerValues` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answerTypes`
--

LOCK TABLES `answerTypes` WRITE;
/*!40000 ALTER TABLE `answerTypes` DISABLE KEYS */;
/*!40000 ALTER TABLE `answerTypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `answers` (
  `answerId` int(4) NOT NULL AUTO_INCREMENT,
  `questionId` varchar(4) NOT NULL,
  `clientId` int(4) NOT NULL,
  `answer` int(11) NOT NULL,
  PRIMARY KEY (`answerId`)
) ENGINE=InnoDB AUTO_INCREMENT=148 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answers`
--

LOCK TABLES `answers` WRITE;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
INSERT INTO `answers` VALUES (1,'1',1,1),(2,'2',1,1),(3,'3',1,1),(4,'4',1,1),(5,'5',1,1),(6,'6',1,1),(7,'7',1,1),(8,'8',1,1),(9,'9',1,1),(10,'10',1,1),(11,'11',1,1),(12,'12',1,1),(13,'13',1,1),(14,'14',1,1),(15,'15',1,1),(16,'16',1,1),(17,'17',1,1),(18,'18',1,1),(19,'19',1,1),(20,'20',1,1),(21,'21',1,1),(22,'22',1,1),(23,'23',1,1),(24,'24',1,1),(25,'1',2,1),(26,'2',2,1),(27,'3',2,1),(28,'4',2,1),(29,'5',2,1),(30,'6',2,1),(31,'7',2,1),(32,'8',2,1),(33,'9',2,1),(34,'10',2,1),(35,'11',2,1),(36,'12',2,5),(37,'13',2,5),(38,'14',2,3),(39,'15',2,3),(40,'16',2,4),(41,'17',2,3),(42,'18',2,2),(43,'19',2,2),(44,'20',2,4),(45,'21',2,3),(46,'22',2,1),(47,'23',2,4),(48,'24',2,1),(49,'1',7,1),(50,'2',7,3),(51,'3',7,5),(52,'4',7,4),(53,'5',7,3),(54,'6',7,1),(55,'7',7,2),(56,'8',7,1),(57,'9',7,4),(58,'10',7,4),(59,'11',7,1),(60,'12',7,4),(61,'13',7,3),(62,'14',7,2),(63,'12',7,1),(64,'13',7,4),(65,'14',7,1),(66,'15',7,1),(67,'16',7,1),(68,'17',7,2),(69,'18',7,1),(70,'19',7,1),(71,'20',7,1),(72,'21',7,3),(73,'22',7,1),(74,'23',7,1),(75,'24',7,3),(76,'1',8,2),(77,'2',8,2),(78,'3',8,5),(79,'4',8,4),(80,'5',8,4),(81,'6',8,1),(82,'7',8,1),(83,'8',8,1),(84,'9',8,1),(85,'10',8,1),(86,'11',8,1),(87,'12',8,1),(88,'13',8,1),(89,'14',8,2),(90,'15',8,1),(91,'16',8,1),(92,'17',8,1),(93,'18',8,1),(94,'19',8,1),(95,'20',8,1),(96,'21',8,1),(97,'22',8,1),(98,'23',8,1),(99,'24',8,1),(100,'1',9,1),(101,'2',9,1),(102,'3',9,1),(103,'4',9,1),(104,'5',9,1),(105,'6',9,1),(106,'7',9,1),(107,'8',9,1),(108,'9',9,1),(109,'10',9,1),(110,'11',9,1),(111,'12',9,1),(112,'13',9,1),(113,'14',9,1),(114,'15',9,1),(115,'16',9,1),(116,'17',9,1),(117,'18',9,1),(118,'19',9,1),(119,'20',9,1),(120,'21',9,1),(121,'22',9,1),(122,'23',9,1),(123,'24',9,1),(124,'1',10,3),(125,'2',10,2),(126,'3',10,3),(127,'4',10,3),(128,'5',10,3),(129,'6',10,1),(130,'7',10,1),(131,'8',10,2),(132,'9',10,3),(133,'10',10,2),(134,'11',10,1),(135,'12',10,2),(136,'13',10,1),(137,'14',10,1),(138,'15',10,1),(139,'16',10,1),(140,'17',10,1),(141,'18',10,2),(142,'19',10,1),(143,'20',10,1),(144,'21',10,1),(145,'22',10,1),(146,'23',10,1),(147,'24',10,1);
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientDetails`
--

DROP TABLE IF EXISTS `clientDetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientDetails` (
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientDetails`
--

LOCK TABLES `clientDetails` WRITE;
/*!40000 ALTER TABLE `clientDetails` DISABLE KEYS */;
INSERT INTO `clientDetails` VALUES (1,'ChrisJ','Retail','Chris Jenkins','asd@asd.com','123123','EMEA','2014-08-06 14:56:44','3E7DBE84-94A1-C24E056A3705'),(2,'Test1','Finance','Fred Test','freds@asd.com','123123123','AFRICA','2014-09-01 17:05:59','508B9F5D-CB28-A5817DC94284'),(3,'Test2','Finance','Fred Test','freds@asd.com','123123123','APAC','2014-09-01 17:05:59','508B9F5D-CB28-A5817DC94285'),(4,'Test3','Finance','Fred Test','freds@asd.com','123123123','EMEA','2014-09-01 17:05:59','508B9F5D-CB28-A5817DC94289'),(7,'MyNewCorp','Media','Chris Jenkins','casd@wqe.com','9382842','AFRICA','2014-09-02 07:40:34','48AAC957-EA0E-1B58AFEBB4D5'),(8,'ChrisJTest1','Media','Chris Jenkins','asd@asd.com','123123','EMEA','2014-09-09 09:38:59','7201FE4D-FFD7-7C132630DF10'),(9,'ChrisJ2','Media','Chris Jenkins','asd@asd.com','123123','Africa','2014-09-10 08:51:56','B9388B08-BF0D-173A29F0CD3E'),(10,'Chrisj','Finance','Chris','chrisj@redhat.com','0123123123','EMEA','2015-04-09 08:05:55','EE209D87-77A0-29DA7E68DCCC');
/*!40000 ALTER TABLE `clientDetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `commentId` int(3) NOT NULL AUTO_INCREMENT,
  `clientId` int(3) NOT NULL,
  `categoryId` int(3) NOT NULL,
  `comments` text NOT NULL,
  PRIMARY KEY (`commentId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `maturityLevels`
--

DROP TABLE IF EXISTS `maturityLevels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `maturityLevels` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(40) NOT NULL,
  `level1` varchar(500) NOT NULL,
  `level2` varchar(500) NOT NULL,
  `level3` varchar(500) NOT NULL,
  `level4` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `maturityLevels`
--

LOCK TABLES `maturityLevels` WRITE;
/*!40000 ALTER TABLE `maturityLevels` DISABLE KEYS */;
INSERT INTO `maturityLevels` VALUES (3,'General','Very limited open source adoption (< 10% of new projects). No formal policies on usage, or policies that discourage adoption.','Adoption on an ad-hoc basis (10% - 25% of new projects). No formal policy on usage, or policies that are neutral with regard to adoption.','De facto adoption based on need (25% - 50% of new projects). Formal policy recommends, but does not require, OSS adoption for new projects.','Adoption by default (> 50% of new projects). Formal policy requires OSS adoption with opt-out by exception only.'),(4,'DevelopmentStandardsandTools','Very limited peer reviews and use of agile development processes (< 10% of new projects). No concept of inner source communities. No formal policy on OSS development tools, or policies that discourage adoption. ','Peer reviews and agile development processes on an ad-hoc basis (10% - 25% of new projects). Inner source communities contemplated but not implemented. No formal policy on OSS development tools.','Peer reviews and agile development processes are common (25% - 50% of new projects). Inner source communities implemented, but not on a widespread basis. Formal policy recommends, but does not require, OSS development tools.','Mandated and widespread use of peer reviews, often between different development teams. Widespread use of agile development processes (> 50% of new projects). Inner source communities common. Formal policy requires OSS tools adoption with opt-out by exception only.'),(5,'HorizontalCommunityParticipation','Virtually no participation in horizontal OSS communities. No formal corporate guidelines on participation, or corporate guidelines that discourage participation.','Limited horizontal community participation on an individual basis and primarily in support roles (i.e. testing, documentation, etc.). No formal corporate guidelines on participation.','Horizontal community participation fairly common on an individual basis in both development and support roles. Formal corporate guidelines allow and endorse participation.','Horizontal community participation widespread on an institutional basis in both development and support roles. Formal corporate guidelines encourage active participation.'),(6,'VerticalCommunityParticipation','Virtually no participation in vertical OSS communities. No formal corporate guidelines on participation, or corporate guidelines that discourage participation.','Limited vertical community participation on an individual basis and primarily in support roles (i.e. testing, documentation, etc.). No formal corporate guidelines on participation.','Vertical community participation fairly common on an individual basis in both development and support roles. Formal corporate guidelines allow and endorse participation.','Vertical community participation widespread on an institutional basis in both development and support roles. Formal corporate guidelines encourage active participation.'),(7,'GovernanceandLegalPolicies','No formal OSS governance & legal policies in place. Legal counsel largely unaware of OSS implications and various licensing models (i.e. GPL, LGPL, CDDL, etc.), or aware of implications and licensing models but generally not supportive of OSS.','No formal OSS governance & legal policies in place. Legal counsel aware of OSS implications and various licensing models (i.e. GPL, LGPL, CDDL, etc.) with reviews on a case-by-case basis.','Formal OSS governance & legal policies in place. Legal counsel actively involved in setting clear guidelines for OSS usage, adoption, and community participation that are generally supportive of OSS.','Formal OSS governance & legal policies in place. Legal counsel actively involved in setting clear guidelines for OSS usage, adoption, and community participation that are highly supportive of OSS.'),(8,'SeniorManagementSupport','Senior management either unaware or unsupportive of OSS adoption and community participation.','Senior management aware of OSS adoption and community participation but has a neutral outlook.','Senior management passively supports OSS adoption and community participation.','Senior management actively supports and encourages OSS adoption and community participation with formal time and/or funding allocations. ');
/*!40000 ALTER TABLE `maturityLevels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pageNumbers`
--

DROP TABLE IF EXISTS `pageNumbers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pageNumbers` (
  `page` varchar(30) NOT NULL,
  `prevPage` varchar(30) NOT NULL,
  `nextPage` varchar(30) NOT NULL,
  `progress` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pageNumbers`
--

LOCK TABLES `pageNumbers` WRITE;
/*!40000 ALTER TABLE `pageNumbers` DISABLE KEYS */;
INSERT INTO `pageNumbers` VALUES ('welcome.html','','intro.html',10),('intro.html','welcome.html','clientDetails.php',20),('clientDetails.php','intro.html','1.php',30),('1.php','clientDetails.php','2.php',40),('2.php','1.php','3.php',50),('3.php','2.php','4.php',60),('4.php','3.php','5.php',70),('5.php','4.php','6.php',80),('6.php','5.php','summary.php',90),('summary.php','6.php','assessment.php',100),('assessment.php','summary.php','workshop.php',100),('workshop.php','assessment.php','emailResults.php',100),('emailResults.php','workshop.php','workshop.php',100),('sendEmail.php','sendEmail.php','sendEmail.php',100);
/*!40000 ALTER TABLE `pageNumbers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questionCatagories`
--

DROP TABLE IF EXISTS `questionCatagories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questionCatagories` (
  `categoryId` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(100) NOT NULL,
  `details` text NOT NULL,
  `redhat1` varchar(50) NOT NULL,
  `redhat2` varchar(50) NOT NULL,
  PRIMARY KEY (`categoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questionCatagories`
--

LOCK TABLES `questionCatagories` WRITE;
/*!40000 ALTER TABLE `questionCatagories` DISABLE KEYS */;
INSERT INTO `questionCatagories` VALUES (1,'General','Explore the wider issues and concerns regarding the use of Open Source software within the organisation','Malcolm Herbert','A N Other'),(2,'Development Standards and Tools','Discuss possible tools and open standards that can be successfully deployed within the organisation','Mr Standards Dude','Deputy Standards Dude'),(3,'Horizontal Community Participation','How to create openness between various areas of the organisation and created a sense of unity when it comes to open source participation.','Mr Collaboration Dude','Deputy Mr Collaboration Dude'),(4,'Vertical Community Participation','Discuss the benefits of vertical participation in Open Source Software and ways to achieve it','Mr Collaboration Dude','Deputy Mr Collaboration Dude'),(5,'Governance and Legal Policies','Explore the various options such as GPL, LGPL and legal protection from IP exploitation','Mr Legal Dude','Deputy Mr Legal Dude'),(6,'Senior Management Support ','How to achieve buy-in from Senior Management regarding the use of Open Source Software','Malcolm Herbert','A N Other');
/*!40000 ALTER TABLE `questionCatagories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (1,1,1,'To what extent is Open Source Software being adopted within your organization today?','< 10% of New Projects','10% - 25% of New Projects ','25% - 50% of New Projects ','> 50% of New Projects','X','X',4),(2,2,1,'Which term best describes the highest organizational level of Open Source Software adoption within your organization?','Individual Adoption ','Small-Team Adoption','Large-Team Adoption ','Institutional Adoption','X','X',4),(3,3,1,'Which term best describes how Open Source Software is adopted within your organization?','Secretive','Under-The-Radar ','Ad-hoc','Opportunistic','Management Endorsed ','Strategically Focused',6),(4,4,1,'What level of support do you have for any formal corporate policies regarding the use and adoption of Open Source Software?','Not Supportive','Neutral','Encouraged For New Projects','Encouraged But Not Required','Required For New Projects','X',5),(5,5,1,'Over the next twelve months what do you predict will happen regarding Open Source Software adoption within your organization compared to the last twelve months?','Decrease Significantly','Decrease Somewhat','Stay The Same','Increase Somewhat ','Increase Significantly','X',5),(6,6,2,'To what extent are agile / iterative development methodologies being adopted within your organization today?','< 10% of New Projects ','10% - 25% of New Projects ','25% - 50% of New Projects ','> 50% of New Projects','X','X',4),(7,7,2,'To what extent are formal peer reviews of source code implemented within your organization today?','< 10% of New Projects ','10% - 25% of New Projects ','25% - 50% of New Projects ','> 50% of New Projects','X','X',4),(8,8,2,'Which term best describes the highest organizational level of Open Source development tools adoption within your organization?','Individual Adoption ','Small-Team Adoption','Large-Team Adoption ','Institutional Adoption','X','X',4),(9,9,2,'Which term(s) best describes how Open Source development tools are adopted within your organization?','Secretive','Under-The-Radar ','Ad-hoc','Opportunistic','Management Endorsed ','Strategically Focused',6),(10,10,2,'How would you describe your formal corporate policies regarding the use and adoption of Open Source development?','Not Supportive','Neutral','Encouraged For New Projects',' But Not Required','Required For New Projects','X',5),(11,11,2,'To what extent do inner source communities (i.e. communities between multiple projects that work collectively to develop software that is reusable across the organization) exist within your organization today?','Very Small Extent','Small Extent','Moderate Extent','Large Extent','Very Large Extent','X',5),(12,12,3,'To what extent do employees participate in horizontal Open Source Software communities (i.e. Linux,  Apache etc)?','None','Very Small Extent','Small Extent','Moderate Extent','Large Extent','Very Large Extent',6),(13,13,3,'How would you best describe any formal corporate policies regarding employee participation in horizontal OSS communities?','Not Supportive','Neutral','Encouraged For New Projects',' But Not Required','Required For New Projects','X',5),(14,14,3,'How often do internal project teams fix bugs or contribute new features to horizontal open source components/projects? (i.e. Linux, Apache, etc.)?','<10% of the time','10% - 25% of the time','25% - 50% of the time','> 50% of the time','X','X',4),(15,15,4,'To what extent do employees participate in vertical Open Source Software communities (i.e. Linux, Apache etc)?','Very Small Extent','Small Extent','Moderate Extent','Large Extent','Very Large Extent','X',5),(16,16,4,'How would you best describe any formal corporate policies regarding employee participation in vertical OSS communities?','Not Supportive','Neutral','Encouraged For New Projects',' But Not Required','Required For New Projects','X',5),(17,17,4,'How often are internal technologies/code reviewed for possible creation of vertical open source communities?','10% - 25% of New Projects ','25% - 50% of New Projects ','> 50% of New Projects','X','X','X',4),(18,18,5,'To what extent is your legal department familiar with the implications of open source software and the differences between various open source licensing models (i.e. GPL, LGPL etc)','Very Small Extent','Small Extent','Moderate Extent','Large Extent','Very Large Extent','X',5),(19,19,5,'How involved is your legal department in setting policies and guidelines around open source software adoption and usage?','Not Involved At All','Involved On a Very Limited Basis','Passively but Regularly Involved','Actively Involved','X','X',4),(20,20,5,'What level of support do you have for any formal corporate policies regarding the use and adoption of Open Source Software?','Generally Discourages','Allows On A Case-By-Case Basis','Allows','Supports','Actively Encourages','X',5),(21,21,5,'How would you best describe any formal legal policies in place with regard to open source software usage and adoption?','Generally Discourages','Allows On A Case-By-Case Basis','Allows','Supports','Actively Encourages','X',5),(22,22,6,'To what extent is your senior management team aware of OSS adoption and community participation within the IT organization?','Very Small Extent','Small Extent','Moderate Extent','Large Extent','Very Large Extent','X',5),(23,23,6,'To what extent is your senior management team supportive of OSS adoption and community participation within the IT organization?','Very Small Extent','Small Extent','Moderate Extent','Large Extent','Very Large Extent','X',5),(24,24,6,'To what extent does senior management allocate formal time and/or funding commitments towards participating in open source software community development?','Very Small Extent','Small Extent','Moderate Extent','Large Extent','Very Large Extent','X',5);
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-04-16  8:34:46
