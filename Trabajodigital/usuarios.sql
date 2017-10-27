-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: localhost    Database: usuarios
-- ------------------------------------------------------
-- Server version	5.6.35

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
-- Table structure for table `Usuarios`
--

DROP TABLE IF EXISTS `Usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Usuarios` (
  `Usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) NOT NULL,
  `Apellido` varchar(45) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Password` varchar(60) NOT NULL,
  `Genero` varchar(45) NOT NULL,
  PRIMARY KEY (`Usuario_id`,`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Usuarios`
--

LOCK TABLES `Usuarios` WRITE;
/*!40000 ALTER TABLE `Usuarios` DISABLE KEYS */;
INSERT INTO `Usuarios` VALUES (1,'tomas','posse','poss@osps.com','$2y$10$W8yQEceUzsnE7cSxCzVIHOyOMjqOKySs/HFy5D','masculino'),(2,'Tomás','Posse','posseotomas@hotmail.com','$2y$10$GZIs.vZ0pAitPojPDrrvSeoSl2aaqprIGLQiHk','masculino'),(3,'Tomás','Posse','possetomas@hotmail.com','$2y$10$1.9N2PS2N.lF116P/6yWsOswvgar46LcfHjA89','masculino'),(4,'lala','lala','a@a.com','$2y$10$RyIQS3rG4qzhksWKIge9zuPKXvnm0Y34Sxqfrv','masculino'),(5,'a','a','a@a.a','$2y$10$A/QfE2XdEv13OVU6L4Dmn.o2ZMFd5uxyJaaVti','masculino'),(6,'a','a','b@b.b','$2y$10$bxjc.816SjVZOIqXjowv.eFnXPwavBAF4ukliI','masculino'),(7,'Tomás','Posse','tomasposse@hotmail.com','$2y$10$Z68OIh.Lf6v2mAUh7S6ndeiaNJPbY/ua1nA.vS','masculino'),(8,'tomas','posse','tomas@tomas.com','$2y$10$3pag5pLt3TXKKIP8XalDWu/A9SS3QMg19wh3OY','masculino'),(9,'t','p','t@p.com','$2y$10$shkahxkQBdNiSqX.sVaigukMX54R/pAGVF8VhzbDWT5WShQ83QqZS','masculino');
/*!40000 ALTER TABLE `Usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-17 14:43:59
