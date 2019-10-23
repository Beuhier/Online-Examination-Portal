CREATE DATABASE  IF NOT EXISTS `activ360_certification_system` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */;
USE `activ360_certification_system`;
-- MySQL dump 10.13  Distrib 8.0.15, for Win64 (x86_64)
--
-- Host: localhost    Database: activ360_certification_system
-- ------------------------------------------------------
-- Server version	8.0.15

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin_tb`
--

DROP TABLE IF EXISTS `admin_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `admin_tb` (
  `adminid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(16) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(16) NOT NULL,
  `time_stamp` varchar(45) NOT NULL,
  PRIMARY KEY (`adminid`),
  UNIQUE KEY `adminid_UNIQUE` (`adminid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_tb`
--

LOCK TABLES `admin_tb` WRITE;
/*!40000 ALTER TABLE `admin_tb` DISABLE KEYS */;
INSERT INTO `admin_tb` VALUES (1,'Blessing','Udauk','09087456321','softiris','male','2019-04-16'),(2,'Solomon','Blessing','09087694532','devteam','male','2019-04-16');
/*!40000 ALTER TABLE `admin_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `all_transactions`
--

DROP TABLE IF EXISTS `all_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `all_transactions` (
  `incomeid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `candidateId` int(10) unsigned NOT NULL,
  `transactionAmount` decimal(45,0) NOT NULL,
  `transactionDesc` varchar(45) DEFAULT NULL,
  `transactionType` varchar(45) NOT NULL,
  `transactionLog` varchar(45) NOT NULL,
  PRIMARY KEY (`incomeid`),
  UNIQUE KEY `incomeid_UNIQUE` (`incomeid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `all_transactions`
--

LOCK TABLES `all_transactions` WRITE;
/*!40000 ALTER TABLE `all_transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `all_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_admin`
--

DROP TABLE IF EXISTS `auth_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `auth_admin` (
  `adminId` varchar(80) NOT NULL,
  `adminPwd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_admin`
--

LOCK TABLES `auth_admin` WRITE;
/*!40000 ALTER TABLE `auth_admin` DISABLE KEYS */;
INSERT INTO `auth_admin` VALUES ('c4ca4238a0b923820dcc509a6f75849b','$2y$10$5TlGArQkOtPpvkzRX6M1Vu4zhvF.F1.Xh7b6l/d/EXtK/VQ7qI1Re'),('c81e728d9d4c2f636f067f89cc14862c','$2y$10$XEa1eawQyH4bbhNhNrQjMenLBZJKbzb9VJq6L0mKpnv2PVkLKlCo2');
/*!40000 ALTER TABLE `auth_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_candidate`
--

DROP TABLE IF EXISTS `auth_candidate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `auth_candidate` (
  `candidate_authId` varchar(70) NOT NULL,
  `candidate_pwd` varchar(70) NOT NULL,
  PRIMARY KEY (`candidate_authId`),
  UNIQUE KEY `candidate_authId` (`candidate_authId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_candidate`
--

LOCK TABLES `auth_candidate` WRITE;
/*!40000 ALTER TABLE `auth_candidate` DISABLE KEYS */;
INSERT INTO `auth_candidate` VALUES ('c4ca4238a0b923820dcc509a6f75849b','$2y$10$c1hIaFndaz.CgLX6.aFvHeAOAwhYa7UfiECexX7RIb9NdRRSc3DIe');
/*!40000 ALTER TABLE `auth_candidate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `candidate_test_response`
--

DROP TABLE IF EXISTS `candidate_test_response`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `candidate_test_response` (
  `candidate_testResponseId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `candidate_testId` int(10) unsigned NOT NULL,
  `candidate_testQuestionid` int(10) unsigned NOT NULL,
  `candidate_testQuestionAns` int(10) DEFAULT NULL,
  `candidate_testQuestionResponse` int(10) DEFAULT NULL,
  `candidate_testQuestionResponse_date` varchar(20) DEFAULT NULL,
  `candidate_testQuestionBookmark` varchar(10) DEFAULT NULL,
  `candidate_testQuestionStatus` varchar(10) NOT NULL,
  PRIMARY KEY (`candidate_testResponseId`),
  KEY `candidate_testId` (`candidate_testId`),
  KEY `candidate_testQuestionid` (`candidate_testQuestionid`),
  CONSTRAINT `candidate_test_response_ibfk_1` FOREIGN KEY (`candidate_testId`) REFERENCES `candidate_tests` (`candidate_testId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `candidate_test_response_ibfk_2` FOREIGN KEY (`candidate_testQuestionid`) REFERENCES `test_question` (`test_questionId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `candidate_test_response`
--

LOCK TABLES `candidate_test_response` WRITE;
/*!40000 ALTER TABLE `candidate_test_response` DISABLE KEYS */;
INSERT INTO `candidate_test_response` VALUES (1,1,51,1,1,'2019-05-02 13:15:15','','closed'),(2,1,30,NULL,0,'','','closed'),(3,1,55,NULL,0,'','','closed'),(4,1,37,NULL,0,'','','closed'),(5,1,45,NULL,0,'','','closed'),(6,1,22,NULL,0,'','','closed'),(7,1,58,NULL,0,'','','closed'),(8,1,15,NULL,0,'','','closed'),(9,1,21,NULL,0,'','','closed'),(10,1,35,NULL,0,'','','closed'),(11,1,16,NULL,0,'','','closed'),(12,1,46,NULL,0,'','','closed'),(13,1,42,NULL,0,'','','closed'),(14,1,24,NULL,0,'','','closed'),(15,1,26,NULL,0,'','','closed'),(16,1,13,NULL,0,'','','closed'),(17,1,14,NULL,0,'','','closed'),(18,1,5,NULL,0,'','','closed'),(19,1,40,NULL,0,'','','closed'),(20,1,12,NULL,0,'','','closed'),(21,1,56,NULL,0,'','','closed'),(22,1,50,NULL,0,'','','closed'),(23,1,11,NULL,0,'','','closed'),(24,1,27,NULL,0,'','','closed'),(25,1,36,NULL,0,'','','closed'),(26,1,47,NULL,0,'','','closed'),(27,1,32,NULL,0,'','','closed'),(28,1,54,NULL,0,'','','closed'),(29,1,2,NULL,0,'','','closed'),(30,1,8,NULL,0,'','','closed'),(31,1,48,NULL,0,'','','closed'),(32,1,44,NULL,0,'','','closed'),(33,1,10,NULL,0,'','','closed'),(34,1,60,NULL,0,'','','closed'),(35,1,59,NULL,0,'','','closed'),(36,1,57,NULL,0,'','','closed'),(37,1,49,NULL,0,'','','closed'),(38,1,33,NULL,0,'','','closed'),(39,1,38,3,1,'2019-05-02 13:08:31','','closed'),(40,1,34,4,1,'2019-05-02 14:36:49','','closed');
/*!40000 ALTER TABLE `candidate_test_response` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `candidate_tests`
--

DROP TABLE IF EXISTS `candidate_tests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `candidate_tests` (
  `candidate_testId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `candidate_id` int(10) unsigned NOT NULL,
  `candidate_certificateTestid` int(10) NOT NULL,
  `candidate_certificateTestRegDate` varchar(40) NOT NULL,
  `candidate_certificateTestStartDateTime` varchar(40) DEFAULT NULL,
  `candidate_certificateTestEndDateTime` varchar(40) DEFAULT NULL,
  `candidate_certificateTestExpiryDate` varchar(40) NOT NULL,
  `candidate_certificateTestScore` int(10) DEFAULT '0',
  `candidate_certificateTestStatus` varchar(20) NOT NULL,
  PRIMARY KEY (`candidate_testId`),
  KEY `candidate_certificateTestid` (`candidate_certificateTestid`),
  KEY `candidate_id` (`candidate_id`),
  CONSTRAINT `candidate_tests_ibfk_2` FOREIGN KEY (`candidate_id`) REFERENCES `candidates_details` (`candidate_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `candidate_tests`
--

LOCK TABLES `candidate_tests` WRITE;
/*!40000 ALTER TABLE `candidate_tests` DISABLE KEYS */;
INSERT INTO `candidate_tests` VALUES (1,1,1,'2019-05-02','2019-05-02 14:36:45','2019-05-02 14:36:51','2019-05-16',1,'completed');
/*!40000 ALTER TABLE `candidate_tests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `candidates_details`
--

DROP TABLE IF EXISTS `candidates_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `candidates_details` (
  `candidate_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `last_name` varchar(40) NOT NULL,
  `first_name` varchar(40) NOT NULL,
  `other_name` varchar(40) DEFAULT NULL,
  `phone_number` varchar(30) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `reg_date` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `candidate_status` varchar(20) NOT NULL DEFAULT 'active',
  PRIMARY KEY (`candidate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `candidates_details`
--

LOCK TABLES `candidates_details` WRITE;
/*!40000 ALTER TABLE `candidates_details` DISABLE KEYS */;
INSERT INTO `candidates_details` VALUES (1,'John','Kelvin','Uduak','09085499871','male','2019-05-02','softmail@gmail.com','active');
/*!40000 ALTER TABLE `candidates_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `certification_tests`
--

DROP TABLE IF EXISTS `certification_tests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `certification_tests` (
  `certification_testid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `certification_testName` varchar(40) NOT NULL,
  `certification_testDuration` varchar(30) NOT NULL,
  `certification_testPassScore` int(10) unsigned NOT NULL,
  `certification_cost` int(45) NOT NULL DEFAULT '10000',
  `certification_testStatus` varchar(20) NOT NULL DEFAULT 'active',
  PRIMARY KEY (`certification_testid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `certification_tests`
--

LOCK TABLES `certification_tests` WRITE;
/*!40000 ALTER TABLE `certification_tests` DISABLE KEYS */;
INSERT INTO `certification_tests` VALUES (1,'Activ360 Front Desk','30 minutes',60,10000,'active'),(2,'Activ360 Point Of Sales','30 minutes',60,10000,'active'),(3,'Activ360 Master','30 minutes',60,16000,'active'),(4,'Activ360 Front master','1 hour',24,10000,'active');
/*!40000 ALTER TABLE `certification_tests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_question`
--

DROP TABLE IF EXISTS `test_question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `test_question` (
  `test_questionId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `test_questionCertificationId` int(10) unsigned NOT NULL,
  `test_question` text NOT NULL,
  `test_questionOption1` text NOT NULL,
  `test_questionOption2` text NOT NULL,
  `test_questionOption3` text NOT NULL,
  `test_questionOption4` text,
  `test_questionOption5` text,
  `test_questionAnswer` int(10) unsigned NOT NULL,
  `test_questionStatus` varchar(10) NOT NULL DEFAULT 'active',
  `test_questionImageURL` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`test_questionId`),
  KEY `test_question_ibfk_1` (`test_questionCertificationId`),
  CONSTRAINT `test_question_ibfk_1` FOREIGN KEY (`test_questionCertificationId`) REFERENCES `certification_tests` (`certification_testid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_question`
--

LOCK TABLES `test_question` WRITE;
/*!40000 ALTER TABLE `test_question` DISABLE KEYS */;
INSERT INTO `test_question` VALUES (1,1,'What must be included during the check-in greeting?','Introduce yourself by name, use an energetic and pleasing tone of voice, and use a clear and pleasant greeting with |How may I assist you?|','Introduce yourself by name, use an energetic and pleasing tone of voice, use a clear and pleasant greeting with |How may I assist you?|,use the property name in the greeting','Use an energetic and pleasing tone of voice, use a clear and pleasant greeting with |How may I assist you?|, use the property name in the greeting','Use an energetic and pleasing tone of voice, use a clear and pleasant greeting with |How may I assist you?|,use the property name in the greeting,and shake the guests hand','',2,'active',''),(2,1,'If you receive a call while at the front desk, what should you do?','Direct the call to the back office','Politely ask the guest in front of you to wait while you take the phone call briefly and redirect caller if necessary,','Answer the phone and place the caller on hold','Ignore the call','',2,'active',''),(3,1,'The reservation must be located within?','5 seconds','10 seconds','20 seconds','30 seconds','1 minute',3,'active',''),(4,1,'The check-in must be completed within ____ minutes.','3','4','5','6','7',1,'active',''),(5,1,'For a group check-in or during peak check-in times, additional staff needs to be deployed to tag luggage which must then be delivered to the room within ___ minutes.','5','10','15','20','30',1,'active',''),(6,1,'If the guest room is not ready at the time of check-in, you should do all of the following, EXCEPT:','Provide the guest with alternatives such as spa or other activities if arrival is before guaranteed check-in time','Offer to book the guest a room at a hotel nearby','Offer an appropriate complimentary amenity such as complimentary drink in the bar or breakfast the following morning if room is not ready by guaranteed check-in time','Provide a sincere apology to guest','Determine the best options for guest based on empathic listening',2,'active',''),(7,1,'Which of the following is an example of the correct way to end the check-in process?','Thank you for choosing to stay with us. I hope you enjoy your stay. Is there anything else I can assist you with?','Thank you for choosing to stay with us. Is there anything else I can assist you with?','Have a nice stay. My name is Bob. Let me know if you have any questions.','','',1,'active',''),(8,1,'Which of the following is NOT necessary when opening the interaction for check-out?','Open the interaction with eye contact, a smile, and greeting','Use a clear, pleasant, and energetic tone of voice','Make a discreet inquiry about the guest?s satisfaction with their stay','Use the hotel name in your greeting','',4,'active',''),(9,1,'What should you do if you have a guest that lost their room key?','Ask for the guest?s name, room number, home address or telephone number to confirm guest?s identity. Also, ask for a photo ID.','Ask the guest for the name on the room and the room number','Ask for the guest?s name, home address or telephone number to confirm guest?s identity.','Ask the guest for the name on the room, the room number, and the room rate','',1,'active',''),(10,1,'You need to summon additional staff members if there are more than ___ guests waiting in line/queue.','1','2','3','4','5',3,'active',''),(11,1,'Guests should wait less than ___ minutes if they are waiting in line.','2','4','6','8','10',2,'active',''),(12,1,'If you have a sign at the front desk, it should be:','Neatly handwritten and on thick paper','Professionally made','Neat, clear, and clean','','',3,'active',''),(13,1,'What types of objects can we have behind our ears?','A communication earpiece','A communication earpiece, a pen, or a pencil','A communication earpiece, a pen, a pencil, or a cigarette','','',2,'active',''),(14,1,'When in the presence of guests?','Stand near your co-workers, so that you can communicate easily','Turn your back to guests if you are talking to a co-worker, so that they do not hear your conversation','Be located in visible sections or spread out to assist guests, rather than huddled together talking','','',3,'active',''),(15,1,'What are appropriate things to say to guests?','Please, thank you and may I suggest','Please, thank you and hey, how are you?','Please, thank you and cool','','',1,'active',''),(16,1,'When dealing with a difficult guest you should NOT?','Use empathic listening','Explain why they are wrong','Seek to first understand, then to be understood and reflect statements and feelings back to guest','Follow through with the resolution (the guest should not be passed off onto another employee)','Make a follow up call to guest to confirm that concerns expressed were resolved to the guest?s satisfaction',2,'active',''),(17,1,'Using Activ360, how do I ensure that bills should no longer be posted to a guest room on the guest instruction.','Open the guest folio, scroll down and select EDIT OCCUPANT INFO AND PREFERENCES and click on NO POST and select YES and scroll down and click update guest information.','Open the billing account, scroll down and select EDIT OCCUPANT INFO AND PREFERENCES and click on NO POST and select YES and scroll down and click update guest information.','Open the billing account, then guest folio, scroll down and select EDIT OCCUPANT INFO AND PREFERENCES and write the instruction','Open the guest folio, scroll down and select EDIT OCCUPANT INFO AND PREFERENCES and write the instruction','',2,'active',''),(18,1,'On Activ360, here do I go to change a guest room?','Guest Billing Account','The guest folio','Request my manager to effect the change','None of the above','',2,'active',''),(19,1,'Using Activ360, what do I do when I find out I cannot perform some functions?','I assign myself the permission','I use my colleagues account','I write it down on paper','I refer it to my superior','',2,'active',''),(20,1,'Which of the following can you do with a billing account but not with a folio','Check in a guest','Deposit guest payment','Clear multiple guest bills','View guest bills','',2,'active',''),(21,1,'How do you make use of a guest credit balance in a folio to pay for another guest bill?','Deposit money into the other guest folio to clear the debit on the other folio','Debit one folio and credit the other manually','Refer to your superior','Make a refund of the credit balance in the guest folio to the guests billing account and then allocate the funds to the folio in debit','',4,'active',''),(22,1,'At which two points can you create a secondary billing account','From configuration and Folio','From Account setup and Configuration','From Guest Folio and While Checking in a guest','From Set up and while checking in a guest','',3,'active',''),(23,1,'From which to points can one create a billing account','Configuration and Folio','Account setup and Configuration','Guest Folio and While Checking in a guest','Set up and while checking in a guest','While Checking in a guest or going through Accounts where you can access the existing billing account and cli on New Account',5,'active',''),(24,1,'Which three ways can you check a guest in or make reservations','From the red check in button at the top left, through the system set up or directly from the room map selecting the particular room','From the configuration setting, through the system set up or directly from the room map selecting the particular room','From the configuration setting, from the folio or directly from the room map selecting the particular room','From the red check in button at the top left, through the reservation chat or directly from the room map selecting the particular room','',4,'active',''),(25,1,'What are the two ways you can make a refund to a guest','Refund to billing account or request accounts department to initiate transfer','Cash to guest or refund to billing account','Cash to guest or request accounts department to initiate it','Not possible','',2,'active',''),(26,1,'In a large full-service hotel, the front office manager reports to the:','General Manager.','Chief engineer.','Room division manager.','Security director','',1,'active',''),(27,1,'Which of the following front office sections in Activ360 software, monitors predetermined guest-credit limits?','Reservations module','Billing accounting module','Rooms management module.','Point-of-sale module','',2,'active',''),(28,1,'Mr. X checks into room 207 for a one-night stay and Mr Z checked into room 307 for two nights. Early the next morning, Mr. X leaves the hotel with an instruction from Mr Z that all Mr X?s bills should be transferred to him. How will you check out Mr X?','Insist that Mr X pays his bills before check out','Ask Mr X to get a written confirmation before check out','Check out Mr X and select transfer bill to Mr Z?s room at the point of check out','Check out Mr X and print his receipt for delivery to Mr Z?s room','',3,'active',''),(29,1,'Mr Z decides to check out and after paying, requests to have his receipts emailed to him, how do you do this on Activ360?','Print the receipt and scan via email','Request that your manager handles that','Tell Mr Z to wait and collect the printed copy as the receipt can?t be sent via email','Click on print receipt on Mr Zs folio and insert his email in the white bar and click send mail','',4,'active',''),(30,1,'Which of the following departments employs the largest staff in the rooms division?','The front office','Reservations','Uniformed services','Housekeeping','',4,'active',''),(31,1,'Mr. Barnes made a reservation at the Metro Hotel for 12/03//207. He arrived at 10 am on the same day. How many hours ahead of the check in time did he arrive?','3','2','1','4','',2,'active',''),(32,1,'Which of the following reservation system reports would help managers assess the volume of reservations activity on a daily basis?','An expected arrivals and departures report','A rooms availability report','A regret and denial report','A reservations transaction report','',2,'active',''),(33,1,'The report that indicates which rooms are occupied and which guests are expected to check out the following day is called the:','Registration record.','Occupancy report.','Housekeeping status report','Room status discrepancy report.','',2,'active',''),(34,1,'Which of the following results from a communication problem between housekeeping and the front office?','Lock-out situations','Late check-outs','Room change','Room status discrepancies','',4,'active',''),(35,1,'Which of the following front office forms typically contains personal guest data, the length of stay, and the method of settlement?','Room rack slip','Registration card','Information rack slip','Credit card voucher','',2,'active',''),(36,1,'What time is the universal check in and check out time','12noon','2pm','1pm','10pm','11am',1,'active',''),(37,1,'What is a Late check out time?','Official check out time','Maximum amount of time a guest is allowed to stay after check out time without being billed for an extra day','Late night check out','Time required to check in a guest at night','',2,'active',''),(38,1,'Why do you need a secondary billing account?','To post other bills aside room charges','It?s just an extra billing account','In case there is a need to share or split bills','For official use only','',3,'active',''),(39,1,'What is a billing account?','An account for the accountant to check all bills','An account for front office','An account that contains all of a guest?s information about all related historical transactions, which is needed for billing','The same as a folio','',3,'active',''),(40,1,'What is a guest folio?','A guest folio is a file that contains all of a guest?s information, stay records and financial transactions of both cash and credit accrued by a resident guest per visit.','An account for the accountant to check all bills','An account for front office','An account that contains all of a guest?s information about all related historical transactions, which is needed for billing','',1,'active',''),(41,1,'How do you split bills in a folio?','Cannot split bills in a folio.','Refer to supervisor','Create a secondary billing account and initiate a transfer from the guest bills and charges','Inform accounts','',3,'active',''),(42,1,'At which two points can you apply discounts for a guest','At the point of check in or by clicking on the bill you want to apply the discount on in the guest bills and charges found in the guest folio','by clicking on the bill you want to apply the discount on in the guest bills and charges found in the guest folio or refer to accounts','refer to accounts or record it manually','none of the above','',1,'active',''),(43,1,'What is a full hotel business day time cycle?','12 noon to 12 midnight','12 midnight to 12 noon','12 midnight to 12 midnight','12 noon to 12 noon','',4,'active',''),(44,1,'Mrs. Jane had a delayed flight so had to leave the hotel at 2:30pm so she was checked out at 2:32pm from the system. Peter the Front Desk officer discovered that the system did not bill her for an extra day since she left after 12 noon. He needs to know why the system did not bill automatically?','Late check out time was not exceeded','The manager helped check him out','The bill was supposed to be inserted manually','System error','',1,'active',''),(45,1,'An in house guest requests for a service that is not set up in the system, how do u bill the guest using the activ360 platform?','Not possible','Request admin to create it','Create a manual bill from the folio','Refer to your manager','',3,'active',''),(46,1,'Peter the front desk officer noticed that the system did not bill folios for a particular day, direct him on how to trigger the billing.','Not possible','Click on Rooms and Guests, on the top right of the dashboard, click on the billing enter in green button and run billing cycle','Report to supervisor','Go through the configuration','',2,'active',''),(47,1,'What is the full meaning of O.T.A?','Online Traders Association','Offline Transaction Account','Online Travel Agency','None of the above','',3,'active',''),(48,1,'What is the relationship between OTAs and Hotels?','OTAs are a 3rd party who often sell a hotel?s room inventory on their behalf in exchange for a commission fee.','They are official hotel bankers','They are considered hotel consultants','Its an association of hotel workers.','',1,'active',''),(49,1,'What is a Check In process?','The process by which a guests registers their arrival at a hotel and receives their key/keycards.','When a guest arrives the hotel','When a guest has a reservation','The process of acquiring guests.','',1,'active',''),(50,1,'What is a Check Out process?','When a guest arrives the hotel','When a guest has a reservation','The process of acquiring guests','The process by which a guest settles their bill and hands back any key/keycards.','',4,'active',''),(51,1,'What is F&B?','Food and Beverages','Files and Books','Finance and Banking','Food and Beer','',1,'active',''),(52,1,'What is Full Board?','Rate that does not include bed, breakfast, lunch and dinner.','Rate that includes bed, breakfast, but not includelunch and dinner.','Rate that includes only bed and breakfast','Rate that includes bed, breakfast, lunch and dinner.','',4,'active',''),(53,1,'What is a Half Board?','Rate that includes bed, breakfast and either lunch or dinner.','Rate that does not includes bed, breakfast and either lunch or dinner.','Rate that includes only bed and breakfast','Rate that includes bed, breakfast, lunch and dinner.','',1,'active',''),(54,1,'What is KPI?','Key Product Indicator. A target against which product can be measured.','Key Performance Indicator. A target against which success can be measured.','Key Price Indicator. A target against which price can be measured.','Key privacy Indicator. A target against which privacy can be measured.','',2,'active',''),(55,1,'What is Late Arrival?','Guests that did not advise they will be later than the agreed time of arrival.','Guests that advise they will be earlier than the agreed time of arrival.','Guests that advise they will be later than the agreed time of arrival.','Guests that likes arriving late.','',3,'active',''),(56,1,'What is Late Charge?','Charges that may be passed on to a guest before their departure from a hotel.','Charges that may never be passed on to a guest','Charges that may be passed on to a guest at request.','Charges that may be passed on to a guest after their departure from a hotel.','',4,'active',''),(57,1,'What is Late Check Out?','When a guest leaves the hotel earlier than the agreed time of departure.','When a guest leaves the hotel at the agreed time of departure.','When a guest refuses to leave the hotel at the agreed time of departure.','When a guest leaves the hotel later than the agreed time of departure.','',4,'active',''),(58,1,'What is Late Show?','A guest who arrives at the agreed time of their reservation.','A guest who arrives earlier than the agreed time of their reservation.','A guest who arrives later than the agreed time of their reservation.','A guest who does not usually arrive at the agreed time of their reservation.','',4,'active',''),(59,1,'What is No Show?','A guest who habitually doesn?t show up, despite having a reservation','A guest who doesn?t show up, despite having a reservation','A guest who shows up early, despite having a reservation','A guest who show up late despite having a reservation','',2,'active',''),(60,1,'What is a Hotel Front Office','It refers to the reception area where guests go when they arrive at the hotel.','It refers to the place reserved for executives at the hotel.','It refers to the VIP section of the hotel.','It refers to the office of the Manger of the hotel.','',2,'active',''),(61,2,'jghgfdss','dfghjkljhgcfxd','zsdfdghjk','hgfds','dfyghjugfd','sdcfghjg',5,'active',NULL);
/*!40000 ALTER TABLE `test_question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `transactions` (
  `transactionId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `candidateId` int(10) unsigned NOT NULL,
  `transactionAmount` decimal(45,0) NOT NULL,
  `transactionDesc` varchar(45) NOT NULL,
  `transactionType` varchar(45) NOT NULL,
  `transactionLog` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`transactionId`),
  UNIQUE KEY `transactionId_UNIQUE` (`transactionId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'activ360_certification_system'
--

--
-- Dumping routines for database 'activ360_certification_system'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-10-23 16:22:03
