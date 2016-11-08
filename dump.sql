CREATE DATABASE  IF NOT EXISTS `db_sistema` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `db_sistema`;
-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: db_sistema
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.16-MariaDB

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
-- Temporary view structure for view `comentario`
--

DROP TABLE IF EXISTS `comentario`;
/*!50001 DROP VIEW IF EXISTS `comentario`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `comentario` AS SELECT 
 1 AS `nome`,
 1 AS `comentario`,
 1 AS `idcomentario`,
 1 AS `foto`,
 1 AS `dataComentario`,
 1 AS `statusEdicao`,
 1 AS `email`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `coments`
--

DROP TABLE IF EXISTS `coments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coments` (
  `idcoments` int(11) NOT NULL AUTO_INCREMENT,
  `dscomentario` mediumtext NOT NULL,
  `dtcomentario` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_edicao` tinyint(1) DEFAULT '0',
  `idusers` int(11) NOT NULL,
  PRIMARY KEY (`idcoments`),
  KEY `fk_coments_users` (`idusers`),
  CONSTRAINT `fk_coments_users` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coments`
--

LOCK TABLES `coments` WRITE;
/*!40000 ALTER TABLE `coments` DISABLE KEYS */;
INSERT INTO `coments` VALUES (1,'Vamos ver no que vai dar, espero que seja bom...','2016-11-07 02:51:32',0,1),(2,'Mal vejo a hora de comprar hehe','2016-11-07 02:51:32',0,2),(3,'Tenho que comprar um, com certeza vou comprar um','2016-11-07 02:51:32',0,3),(4,'Razoável, não é grande coisa, esperava mais','2016-11-07 02:51:32',0,4),(5,'Pra que vou comprar isso? não vejo a necessidade kkk','2016-11-07 02:51:32',0,5);
/*!40000 ALTER TABLE `coments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `editions`
--

DROP TABLE IF EXISTS `editions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `editions` (
  `idedition` int(11) NOT NULL AUTO_INCREMENT,
  `idcoments` int(11) NOT NULL,
  `dtedition` datetime DEFAULT CURRENT_TIMESTAMP,
  `dsedition` mediumtext,
  `status_edition` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idedition`),
  KEY `fk_edition_coments` (`idcoments`),
  CONSTRAINT `fk_edition_coments` FOREIGN KEY (`idcoments`) REFERENCES `coments` (`idcoments`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `editions`
--

LOCK TABLES `editions` WRITE;
/*!40000 ALTER TABLE `editions` DISABLE KEYS */;
/*!40000 ALTER TABLE `editions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `idusers` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(155) NOT NULL,
  `email` varchar(75) NOT NULL,
  `senha` varchar(75) NOT NULL,
  `foto` varchar(45) DEFAULT 'perfil-default.png',
  PRIMARY KEY (`idusers`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Mayara Moraes','may_moraes@hotmail.com','2913e97a6dcbe306660e458887b2158bb477c531','perfil-default.png'),(2,'Gustavo Lima','gustavolima@outlook.com','de84ebe5e3e733199a8817aa40b2a0394fccab60','perfil-default.png'),(3,'Dafne Souza','dada.souza100@hotmail.com','619b59d6d910606a667f896562a26540d2164909','perfil-default.png'),(4,'Ana Mariana','anajoana@outlook.com','5fdb524ca469cb8d089df30365f320fcb68e50f9','perfil-default.png'),(5,'Kevin Oliveira','kevinkevin.ol@gmail.com','69b5e80779906a63ef0526b7f5e8457a1ab64f27','perfil-default.png'),(6,'Administrador','admin@sistema.com','10470c3b4b1fed12c3baac014be15fac67c6e815','perfil-default.png');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `comentario`
--

/*!50001 DROP VIEW IF EXISTS `comentario`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `comentario` AS select `u`.`nome` AS `nome`,`c`.`dscomentario` AS `comentario`,`c`.`idcoments` AS `idcomentario`,`u`.`foto` AS `foto`,`c`.`dtcomentario` AS `dataComentario`,`c`.`status_edicao` AS `statusEdicao`,`u`.`email` AS `email` from (`coments` `c` join `users` `u`) where (`c`.`idusers` = `u`.`idusers`) order by `c`.`dtcomentario` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-07  3:03:53
