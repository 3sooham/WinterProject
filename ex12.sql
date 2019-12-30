-- MySQL dump 10.13  Distrib 8.0.15, for Win64 (x86_64)
--
-- Host: localhost    Database: project
-- ------------------------------------------------------
-- Server version	8.0.15

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8mb4 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `관심기업`
--

DROP TABLE IF EXISTS `관심기업`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `관심기업` (
  `회원ID` varchar(10) NOT NULL,
  `기업번호` int(11) NOT NULL,
  PRIMARY KEY (`회원ID`,`기업번호`),
  KEY `기업번호` (`기업번호`),
  CONSTRAINT `관심기업_ibfk_1` FOREIGN KEY (`기업번호`) REFERENCES `기업` (`기업번호`),
  CONSTRAINT `관심기업_ibfk_2` FOREIGN KEY (`회원ID`) REFERENCES `회원` (`회원ID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `관심기업`
--

LOCK TABLES `관심기업` WRITE;
/*!40000 ALTER TABLE `관심기업` DISABLE KEYS */;
INSERT INTO `관심기업` VALUES ('jhseo40',1),('user3',1),('user4',1),('송창석',1),('채수현',1),('jhseo40',3),('jhseo40',4);
/*!40000 ALTER TABLE `관심기업` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `기업`
--

DROP TABLE IF EXISTS `기업`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `기업` (
  `기업번호` int(10) NOT NULL AUTO_INCREMENT,
  `기업명` varchar(30) NOT NULL,
  `지역` varchar(15) NOT NULL,
  `합격점수` int(11) NOT NULL,
  `요구학점` float NOT NULL,
  `연봉` int(11) NOT NULL,
  `시작날짜` date DEFAULT NULL,
  `종료날짜` date DEFAULT NULL,
  PRIMARY KEY (`기업번호`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `기업`
--

LOCK TABLES `기업` WRITE;
/*!40000 ALTER TABLE `기업` DISABLE KEYS */;
INSERT INTO `기업` VALUES (1,'현대','서울',72,3.8,3000,'2019-06-09','2019-06-21'),(2,'삼성전자','서울',80,3.9,3200,'2019-06-07','2019-06-15'),(3,'sk','경기 고양시',40,3.6,3100,'2019-06-04','2019-06-17'),(4,'GS','경기 수원시',40,3.5,2900,'2019-06-03','2019-06-11'),(5,'포스코','서울 강남구',60,3.7,2600,'2019-06-01','2019-06-22'),(6,'KT','경기 분당',50,3.2,3300,'2019-06-07','2019-06-19'),(7,'롯데','인천시 ',45,3.5,2950,'2019-06-13','2019-06-28'),(8,'대우','경기도 수원시 ',40,3.3,2800,'2019-06-15','2019-06-29'),(9,'농협','서울시 중구',35,3,2600,'2019-06-19','2019-06-29'),(10,'한진','인천시 계양구',45,3.4,2500,'2019-06-05','2019-06-17'),(11,'KB','서울시 양서구',43,3.4,2800,'2019-06-15','2019-06-26'),(12,'한국도로공사','서울시 광진구',48,3.2,2700,'2019-06-08','2019-06-19'),(13,'한화','서울시 동대문구',53,3.4,2600,'2019-06-04','2019-06-18'),(14,'대림','서울시 영등포구',51,2.9,2100,'2019-06-08','2019-06-23'),(15,'효성','서울시 금천구',47,3.1,2800,'2019-06-18','2019-06-28'),(16,'메리츠','경기도 구리시',49,3.3,2700,'2019-06-10','2019-06-24'),(17,'신한','서울시 강서구',68,3.7,3100,'2019-06-04','2019-06-17'),(18,'흥국생명','서울시 성북구',48,3.5,2700,'2019-06-07','2019-06-19'),(19,'LG','서울시 서대문구',71,3.5,2500,'2019-06-19','2019-06-30'),(20,'아시아나항공','서울시 구로구',41,3.4,2800,'2019-06-08','2019-06-25'),(21,'두산','서울시 노원구',67,3.3,2500,'2019-06-01','2019-06-11'),(22,'르노','경기도 시흥시',21,3,2400,'2019-06-07','2019-06-14'),(23,'ING','경기도 안산시',43,3.2,2100,'2019-06-17','2019-06-27'),(24,'동양생명','경기도 안성시',49,2.8,2100,'2019-06-05','2019-06-12'),(25,'CJ','경기도 오산시',58,3.4,2300,'2019-06-07','2019-06-24'),(26,'금호','경기도 과천시',58,3.3,2300,'2019-06-17','2019-06-26'),(27,'쌍용','경기도 용인시',58,2.7,2600,'2019-06-20','2019-06-28'),(28,'네이버','경기도 판교',75,3.6,2900,'2019-06-08','2019-06-16'),(29,'다음','경기도 판교',74,3.7,3100,'2019-06-19','2019-06-25'),(30,'STX','경기도 안산시',24,3.2,2600,'2019-06-23','2019-06-30');
/*!40000 ALTER TABLE `기업` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `대외활동`
--

DROP TABLE IF EXISTS `대외활동`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `대외활동` (
  `이력서번호` int(11) NOT NULL,
  `활동번호` int(11) NOT NULL AUTO_INCREMENT,
  `활동종류` varchar(15) NOT NULL,
  `기관명` varchar(30) NOT NULL,
  `활동기간` int(11) NOT NULL,
  PRIMARY KEY (`활동번호`,`이력서번호`),
  KEY `이력서번호` (`이력서번호`),
  CONSTRAINT `대외활동_ibfk_1` FOREIGN KEY (`이력서번호`) REFERENCES `이력서` (`이력서번호`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `대외활동`
--

LOCK TABLES `대외활동` WRITE;
/*!40000 ALTER TABLE `대외활동` DISABLE KEYS */;
INSERT INTO `대외활동` VALUES (24,27,'인턴','삼성',666);
/*!40000 ALTER TABLE `대외활동` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `소유자격증`
--

DROP TABLE IF EXISTS `소유자격증`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `소유자격증` (
  `이력서번호` int(10) NOT NULL,
  `자격증번호` int(10) NOT NULL,
  PRIMARY KEY (`이력서번호`,`자격증번호`),
  KEY `자격증번호` (`자격증번호`),
  CONSTRAINT `소유자격증_ibfk_1` FOREIGN KEY (`자격증번호`) REFERENCES `자격증` (`자격증번호`),
  CONSTRAINT `소유자격증_ibfk_2` FOREIGN KEY (`이력서번호`) REFERENCES `이력서` (`이력서번호`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `소유자격증`
--

LOCK TABLES `소유자격증` WRITE;
/*!40000 ALTER TABLE `소유자격증` DISABLE KEYS */;
INSERT INTO `소유자격증` VALUES (29,1),(24,2),(24,3),(29,3),(24,4),(29,4),(24,7);
/*!40000 ALTER TABLE `소유자격증` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `어학`
--

DROP TABLE IF EXISTS `어학`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `어학` (
  `어학시험이름` varchar(15) NOT NULL,
  PRIMARY KEY (`어학시험이름`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `어학`
--

LOCK TABLES `어학` WRITE;
/*!40000 ALTER TABLE `어학` DISABLE KEYS */;
INSERT INTO `어학` VALUES ('DELE'),('DELF'),('DSH'),('HSK'),('HSKK'),('JLPT'),('JPT'),('오픽'),('텝스'),('토익'),('토플');
/*!40000 ALTER TABLE `어학` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `어학가산점`
--

DROP TABLE IF EXISTS `어학가산점`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `어학가산점` (
  `기업번호` int(11) NOT NULL,
  `어학시험이름` varchar(15) NOT NULL,
  `점수` int(11) DEFAULT NULL,
  `급수` int(11) DEFAULT NULL,
  `가산점` int(11) NOT NULL,
  PRIMARY KEY (`기업번호`,`어학시험이름`),
  KEY `어학시험이름` (`어학시험이름`),
  CONSTRAINT `어학가산점_ibfk_1` FOREIGN KEY (`기업번호`) REFERENCES `기업` (`기업번호`),
  CONSTRAINT `어학가산점_ibfk_2` FOREIGN KEY (`어학시험이름`) REFERENCES `어학` (`어학시험이름`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `어학가산점`
--

LOCK TABLES `어학가산점` WRITE;
/*!40000 ALTER TABLE `어학가산점` DISABLE KEYS */;
INSERT INTO `어학가산점` VALUES (1,'HSK',0,1,4),(1,'토익',800,0,2),(1,'토플',750,0,3),(2,'DSH',0,1,2),(2,'JLPT',0,2,4),(2,'토익',750,0,2),(3,'JLPT',0,1,3),(3,'오픽',0,1,4),(3,'텝스',450,0,4),(4,'DELF',0,2,3),(4,'HSKK',0,1,2),(4,'JPT',0,1,3),(5,'DSH',0,1,300),(5,'텝스',500,0,5),(5,'토익',850,0,3),(6,'DSH',0,1,4),(6,'JLPT',0,1,3),(6,'토플',900,0,5),(7,'HSK',0,1,4),(7,'토익',900,0,4),(7,'토플',750,0,3),(8,'HSKK',0,3,1),(8,'JLPT',0,1,5),(8,'토익',700,0,2),(9,'DELF',0,1,3),(9,'오픽',0,2,1),(9,'토익',750,0,2),(10,'HSKK',0,2,3),(10,'JLPT',0,3,1),(10,'토익',700,0,1),(11,'DELE',0,1,5),(11,'JPT',0,1,2),(11,'토플',750,0,2),(12,'DELF',0,1,3),(12,'HSK',0,2,2),(12,'토익',800,0,2),(13,'DSH',0,3,1),(13,'JLPT',0,1,4),(13,'토익',750,0,3),(14,'DELF',0,2,3),(14,'DSH',0,2,3),(14,'토플',750,0,3),(15,'HSK',0,2,1),(15,'오픽',0,2,2),(15,'텝스',550,0,3),(16,'DSH',0,1,3),(16,'HSKK',0,2,2),(16,'JPT',0,1,3),(17,'DELF',0,2,4),(17,'HSK',0,1,3),(17,'JPT',0,1,3),(18,'HSK',0,1,2),(18,'JLPT',0,3,1),(18,'토익',850,0,3),(19,'DELE',0,1,2),(19,'JPT',0,1,3),(19,'토익',650,0,1),(20,'HSK',0,1,2),(20,'HSKK',0,1,3),(20,'토익',900,0,5),(21,'DSH',0,2,3),(21,'HSKK',0,1,4),(21,'JLPT',0,1,3),(22,'HSK',0,1,5),(22,'JPT',0,1,2),(22,'텝스',550,0,5),(23,'DELE',0,1,4),(23,'DELF',0,1,5),(23,'HSK',0,1,4),(24,'DELF',0,1,4),(24,'JPT',0,1,4),(24,'토플',750,0,3),(25,'DSH',0,1,2),(25,'JLPT',0,1,3),(25,'토익',850,0,3),(26,'HSKK',0,2,2),(26,'JLPT',0,2,4),(26,'텝스',450,0,2),(27,'DELF',0,1,5),(27,'JPT',0,2,2),(27,'오픽',0,1,4),(28,'DELF',0,1,4),(28,'JPT',0,1,2),(28,'토플',900,0,5),(29,'DSH',0,2,3),(29,'HSKK',0,2,1),(29,'토익',800,0,2),(30,'DELE',0,2,1),(30,'DELF',0,2,1),(30,'DSH',0,1,4);
/*!40000 ALTER TABLE `어학가산점` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `어학능력`
--

DROP TABLE IF EXISTS `어학능력`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `어학능력` (
  `어학번호` int(11) NOT NULL AUTO_INCREMENT,
  `이력서번호` int(11) NOT NULL,
  `어학시험이름` varchar(15) NOT NULL,
  `점수` int(11) DEFAULT NULL,
  `등급` int(11) DEFAULT NULL,
  PRIMARY KEY (`어학번호`),
  KEY `이력서번호` (`이력서번호`),
  KEY `어학시험이름` (`어학시험이름`),
  CONSTRAINT `어학능력_ibfk_1` FOREIGN KEY (`이력서번호`) REFERENCES `이력서` (`이력서번호`) ON DELETE CASCADE,
  CONSTRAINT `어학능력_ibfk_2` FOREIGN KEY (`어학시험이름`) REFERENCES `어학` (`어학시험이름`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `어학능력`
--

LOCK TABLES `어학능력` WRITE;
/*!40000 ALTER TABLE `어학능력` DISABLE KEYS */;
INSERT INTO `어학능력` VALUES (39,24,'토익',500,0);
/*!40000 ALTER TABLE `어학능력` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `예상점수`
--

DROP TABLE IF EXISTS `예상점수`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `예상점수` (
  `이력서번호` int(11) NOT NULL,
  `기업번호` int(11) NOT NULL,
  `취득점수` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`이력서번호`,`기업번호`),
  KEY `기업번호` (`기업번호`),
  CONSTRAINT `예상점수_ibfk_1` FOREIGN KEY (`이력서번호`) REFERENCES `이력서` (`이력서번호`) ON DELETE CASCADE,
  CONSTRAINT `예상점수_ibfk_2` FOREIGN KEY (`기업번호`) REFERENCES `기업` (`기업번호`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `예상점수`
--

LOCK TABLES `예상점수` WRITE;
/*!40000 ALTER TABLE `예상점수` DISABLE KEYS */;
INSERT INTO `예상점수` VALUES (24,1,39),(24,2,15),(24,3,31),(24,4,40),(24,5,33),(24,6,36),(24,7,30),(24,8,41),(24,9,35),(24,10,40),(24,11,35),(24,12,30),(24,13,39),(24,14,27),(24,15,36),(24,16,36),(24,17,31),(24,18,30),(24,19,36),(24,20,30),(24,21,37),(24,22,35),(24,23,33),(24,24,30),(24,25,39),(24,26,33),(24,27,30),(24,28,34),(24,29,44),(24,30,35),(25,1,5),(25,2,5),(25,3,5),(25,4,5),(25,5,5),(25,6,5),(25,7,5),(25,8,5),(25,9,25),(25,10,5),(25,11,5),(25,12,5),(25,13,5),(25,14,25),(25,15,5),(25,16,5),(25,17,5),(25,18,5),(25,19,5),(25,20,5),(25,21,5),(25,22,25),(25,23,5),(25,24,25),(25,25,5),(25,26,5),(25,27,25),(25,28,5),(25,29,5),(25,30,5),(26,1,25),(26,2,25),(26,3,25),(26,4,25),(26,5,25),(26,6,25),(26,7,25),(26,8,25),(26,9,25),(26,10,25),(26,11,25),(26,12,25),(26,13,25),(26,14,25),(26,15,25),(26,16,25),(26,17,25),(26,18,25),(26,19,25),(26,20,25),(26,21,25),(26,22,25),(26,23,25),(26,24,25),(26,25,25),(26,26,25),(26,27,25),(26,28,25),(26,29,25),(26,30,25),(27,1,5),(27,2,5),(27,3,5),(27,4,5),(27,5,5),(27,6,5),(27,7,5),(27,8,5),(27,9,5),(27,10,5),(27,11,5),(27,12,5),(27,13,5),(27,14,5),(27,15,5),(27,16,5),(27,17,5),(27,18,5),(27,19,5),(27,20,5),(27,21,5),(27,22,5),(27,23,5),(27,24,5),(27,25,5),(27,26,5),(27,27,5),(27,28,5),(27,29,5),(27,30,5),(28,1,25),(28,2,25),(28,3,25),(28,4,25),(28,5,25),(28,6,25),(28,7,25),(28,8,25),(28,9,25),(28,10,25),(28,11,25),(28,12,25),(28,13,25),(28,14,25),(28,15,25),(28,16,25),(28,17,25),(28,18,25),(28,19,25),(28,20,25),(28,21,25),(28,22,25),(28,23,25),(28,24,25),(28,25,25),(28,26,25),(28,27,25),(28,28,25),(28,29,25),(28,30,25),(29,1,9),(29,2,11),(29,3,12),(29,4,11),(29,5,8),(29,6,10),(29,7,5),(29,8,10),(29,9,17),(29,10,12),(29,11,6),(29,12,5),(29,13,11),(29,14,5),(29,15,13),(29,16,5),(29,17,11),(29,18,5),(29,19,7),(29,20,5),(29,21,8),(29,22,10),(29,23,5),(29,24,5),(29,25,11),(29,26,6),(29,27,5),(29,28,6),(29,29,12),(29,30,12),(30,1,5),(30,2,5),(30,3,5),(30,4,5),(30,5,5),(30,6,25),(30,7,5),(30,8,25),(30,9,25),(30,10,5),(30,11,5),(30,12,25),(30,13,5),(30,14,25),(30,15,25),(30,16,25),(30,17,5),(30,18,5),(30,19,5),(30,20,5),(30,21,25),(30,22,25),(30,23,25),(30,24,25),(30,25,5),(30,26,25),(30,27,25),(30,28,5),(30,29,5),(30,30,25),(31,1,5),(31,2,5),(31,3,5),(31,4,5),(31,5,5),(31,6,5),(31,7,5),(31,8,5),(31,9,5),(31,10,5),(31,11,5),(31,12,5),(31,13,5),(31,14,5),(31,15,5),(31,16,5),(31,17,5),(31,18,5),(31,19,5),(31,20,5),(31,21,5),(31,22,5),(31,23,5),(31,24,5),(31,25,5),(31,26,5),(31,27,5),(31,28,5),(31,29,5),(31,30,5),(32,1,25),(32,2,25),(32,3,25),(32,4,25),(32,5,25),(32,6,25),(32,7,25),(32,8,25),(32,9,25),(32,10,25),(32,11,25),(32,12,25),(32,13,25),(32,14,25),(32,15,25),(32,16,25),(32,17,25),(32,18,25),(32,19,25),(32,20,25),(32,21,25),(32,22,25),(32,23,25),(32,24,25),(32,25,25),(32,26,25),(32,27,25),(32,28,25),(32,29,25),(32,30,25),(33,1,25),(33,2,25),(33,3,25),(33,4,25),(33,5,25),(33,6,25),(33,7,25),(33,8,25),(33,9,25),(33,10,25),(33,11,25),(33,12,25),(33,13,25),(33,14,25),(33,15,25),(33,16,25),(33,17,25),(33,18,25),(33,19,25),(33,20,25),(33,21,25),(33,22,25),(33,23,25),(33,24,25),(33,25,25),(33,26,25),(33,27,25),(33,28,25),(33,29,25),(33,30,25);
/*!40000 ALTER TABLE `예상점수` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `우대대외활동`
--

DROP TABLE IF EXISTS `우대대외활동`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `우대대외활동` (
  `기업번호` int(11) NOT NULL,
  `활동종류` varchar(15) NOT NULL,
  `활동기간` int(11) NOT NULL,
  `가산점` int(11) NOT NULL,
  PRIMARY KEY (`기업번호`,`활동종류`),
  CONSTRAINT `우대대외활동_ibfk_1` FOREIGN KEY (`기업번호`) REFERENCES `기업` (`기업번호`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `우대대외활동`
--

LOCK TABLES `우대대외활동` WRITE;
/*!40000 ALTER TABLE `우대대외활동` DISABLE KEYS */;
INSERT INTO `우대대외활동` VALUES (1,'교내활동',2,5),(1,'인턴',6,5),(1,'자원봉사',8,5),(2,'교내활동',2,1),(2,'인턴',3,4),(2,'자원봉사',12,1),(3,'교내활동',3,2),(3,'인턴',6,2),(3,'자원봉사',2,2),(4,'교내활동',1,2),(4,'인턴',3,4),(4,'자원봉사',11,2),(5,'교내활동',3,4),(5,'인턴',5,5),(5,'자원봉사',10,5),(6,'교내활동',3,2),(6,'인턴',2,3),(6,'자원봉사',1,1),(7,'교내활동',3,4),(7,'인턴',6,2),(7,'자원봉사',8,2),(8,'교내활동',2,5),(8,'인턴',5,3),(8,'자원봉사',12,4),(9,'교내활동',2,3),(9,'인턴',2,1),(9,'자원봉사',11,1),(10,'교내활동',3,1),(10,'인턴',6,5),(10,'자원봉사',4,2),(11,'교내활동',1,5),(11,'인턴',1,5),(11,'자원봉사',2,5),(12,'교내활동',3,2),(12,'인턴',4,3),(12,'자원봉사',5,5),(13,'교내활동',1,3),(13,'인턴',6,1),(13,'자원봉사',10,5),(14,'교내활동',3,5),(14,'인턴',2,2),(14,'자원봉사',3,3),(15,'교내활동',1,2),(15,'인턴',2,5),(15,'자원봉사',1,4),(16,'교내활동',3,1),(16,'인턴',3,2),(16,'자원봉사',7,5),(17,'교내활동',3,5),(17,'인턴',3,3),(17,'자원봉사',1,4),(18,'교내활동',3,3),(18,'인턴',6,4),(18,'자원봉사',6,4),(19,'교내활동',2,4),(19,'인턴',4,3),(19,'자원봉사',12,2),(20,'교내활동',3,3),(20,'인턴',2,1),(20,'자원봉사',5,5),(21,'교내활동',2,4),(21,'인턴',1,1),(21,'자원봉사',11,4),(22,'교내활동',1,5),(22,'인턴',6,5),(22,'자원봉사',10,3),(23,'교내활동',1,1),(23,'인턴',4,4),(23,'자원봉사',11,3),(24,'교내활동',2,1),(24,'인턴',1,5),(24,'자원봉사',1,5),(25,'교내활동',3,1),(25,'인턴',2,5),(25,'자원봉사',6,2),(26,'교내활동',3,5),(26,'인턴',6,3),(26,'자원봉사',4,4),(27,'교내활동',1,2),(27,'인턴',2,2),(27,'자원봉사',2,2),(28,'교내활동',2,3),(28,'인턴',3,1),(28,'자원봉사',9,5),(29,'교내활동',3,2),(29,'인턴',1,4),(29,'자원봉사',10,5),(30,'교내활동',1,4),(30,'인턴',5,3),(30,'자원봉사',12,3);
/*!40000 ALTER TABLE `우대대외활동` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `이력서`
--

DROP TABLE IF EXISTS `이력서`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `이력서` (
  `이력서번호` int(10) NOT NULL AUTO_INCREMENT,
  `회원ID` varchar(10) NOT NULL,
  `학점` float NOT NULL,
  `병역` varchar(10) NOT NULL,
  `장애` varchar(10) NOT NULL,
  `기본가산점` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`이력서번호`),
  KEY `회원ID` (`회원ID`),
  CONSTRAINT `이력서_ibfk_1` FOREIGN KEY (`회원ID`) REFERENCES `회원` (`회원ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `이력서`
--

LOCK TABLES `이력서` WRITE;
/*!40000 ALTER TABLE `이력서` DISABLE KEYS */;
INSERT INTO `이력서` VALUES (24,'jhseo40',3.8,'군필','X',5),(25,'user2',3,'군필','X',5),(26,'user3',4.2,'군필','X',5),(27,'user1',2,'군필','X',5),(28,'user4',3.9,'군필','X',5),(29,'user5',1.7,'군필','X',5),(30,'user6',3.3,'군필','X',5),(31,'갓재홍',2,'군필','X',5),(32,'채수현',4.4,'군필','X',5),(33,'송창석',4,'군필','X',5);
/*!40000 ALTER TABLE `이력서` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `자격증`
--

DROP TABLE IF EXISTS `자격증`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `자격증` (
  `자격증번호` int(10) NOT NULL AUTO_INCREMENT,
  `자격증이름` varchar(45) NOT NULL,
  PRIMARY KEY (`자격증번호`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `자격증`
--

LOCK TABLES `자격증` WRITE;
/*!40000 ALTER TABLE `자격증` DISABLE KEYS */;
INSERT INTO `자격증` VALUES (1,'정보처리기사'),(2,'PMP'),(3,'컴활1급'),(4,'정보관리기술사'),(5,'리눅스마스터'),(6,'정보보호전문가'),(7,'정보보안기사'),(8,'무선설비기사'),(9,'ESDP'),(10,'ITIL'),(11,'CCSP'),(12,'CCNP'),(13,'SSCP'),(14,'SCBCD'),(15,'OCJD'),(16,'OCM'),(17,'RHCE'),(18,'MCSD'),(19,'MCSE'),(20,'CCDA');
/*!40000 ALTER TABLE `자격증` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `자격증가산점`
--

DROP TABLE IF EXISTS `자격증가산점`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `자격증가산점` (
  `기업번호` int(11) NOT NULL,
  `자격증번호` int(11) NOT NULL,
  `가산점` int(11) NOT NULL,
  PRIMARY KEY (`기업번호`,`자격증번호`),
  KEY `자격증번호` (`자격증번호`),
  CONSTRAINT `자격증가산점_ibfk_1` FOREIGN KEY (`기업번호`) REFERENCES `기업` (`기업번호`),
  CONSTRAINT `자격증가산점_ibfk_2` FOREIGN KEY (`자격증번호`) REFERENCES `자격증` (`자격증번호`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `자격증가산점`
--

LOCK TABLES `자격증가산점` WRITE;
/*!40000 ALTER TABLE `자격증가산점` DISABLE KEYS */;
INSERT INTO `자격증가산점` VALUES (1,4,4),(1,7,3),(1,10,6),(1,16,4),(1,20,6),(2,1,6),(2,5,2),(2,9,7),(2,12,5),(2,19,3),(3,1,6),(3,4,1),(3,5,1),(3,6,5),(3,20,3),(4,4,6),(4,7,5),(4,10,1),(4,12,4),(4,19,2),(5,3,1),(5,4,2),(5,14,2),(5,17,6),(5,20,4),(6,4,5),(6,11,5),(6,17,5),(6,18,1),(6,20,5),(7,2,3),(7,6,3),(7,9,2),(7,10,6),(7,19,4),(8,2,1),(8,4,5),(8,10,2),(8,13,6),(8,14,7),(9,1,5),(9,3,7),(9,5,3),(9,14,1),(9,15,2),(10,1,5),(10,3,2),(10,7,6),(10,11,2),(10,17,1),(11,1,1),(11,2,5),(11,8,1),(11,9,5),(11,19,3),(12,9,6),(12,11,5),(12,12,1),(12,18,2),(12,19,2),(13,3,6),(13,8,2),(13,9,6),(13,13,5),(13,15,5),(14,6,3),(14,9,4),(14,12,7),(14,13,6),(14,18,1),(15,1,2),(15,3,6),(15,8,4),(15,11,2),(15,16,1),(16,2,4),(16,5,3),(16,7,5),(16,12,2),(16,14,6),(17,1,6),(17,2,3),(17,6,1),(17,10,6),(17,12,4),(18,8,1),(18,10,7),(18,11,7),(18,14,4),(18,16,1),(19,2,2),(19,3,2),(19,7,3),(19,14,1),(19,16,2),(20,6,4),(20,7,4),(20,10,7),(20,13,6),(20,14,5),(21,2,5),(21,3,3),(21,6,1),(21,11,3),(21,13,4),(22,3,5),(22,5,3),(22,6,5),(22,9,2),(22,17,1),(23,7,4),(23,8,1),(23,9,1),(23,14,7),(23,17,7),(24,5,7),(24,9,1),(24,12,5),(24,18,3),(24,19,3),(25,4,6),(25,6,7),(25,13,7),(25,14,6),(26,4,1),(26,6,7),(26,9,6),(26,14,5),(26,15,3),(26,20,7),(27,7,3),(27,8,6),(27,10,6),(27,11,4),(27,20,6),(28,2,1),(28,3,1),(28,7,6),(28,12,1),(28,17,4),(29,4,7),(29,7,6),(29,13,4),(29,16,3),(29,18,3),(30,4,7),(30,9,7),(30,11,6),(30,14,1),(30,15,1);
/*!40000 ALTER TABLE `자격증가산점` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `회원`
--

DROP TABLE IF EXISTS `회원`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `회원` (
  `회원ID` varchar(10) NOT NULL,
  `이름` varchar(10) NOT NULL,
  `나이` int(5) NOT NULL,
  `거주지` varchar(20) NOT NULL,
  `회원pwd` varchar(15) NOT NULL,
  PRIMARY KEY (`회원ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `회원`
--

LOCK TABLES `회원` WRITE;
/*!40000 ALTER TABLE `회원` DISABLE KEYS */;
INSERT INTO `회원` VALUES ('jhseo40','서정현',24,'서울시 강서구','1111'),('user1','유저1',32,'경기도','1111'),('user2','김동익',24,'서울시 마포구','2222'),('user3','조한국',25,'서울시 은평구','3333'),('user4','유저4',20,'강원도 철원군','4444'),('user5','유저5',27,'서울시 관악구','5555'),('user6','최태호',25,'경기도 분당','6666'),('갓재홍','김재홍',24,'경기도 파주시','0000'),('송창석','송창석',24,'서울시 강서구','1111'),('채수현','채수현',24,'경기도 분당','1111');
/*!40000 ALTER TABLE `회원` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-12-30 16:01:29
