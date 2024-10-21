-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: tuassakidila
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `dados`
--

DROP TABLE IF EXISTS `dados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dados` (
                         `contagemLixo` varchar(255) DEFAULT NULL,
                         `peso` varchar(255) DEFAULT NULL,
                         `sensorMetal` varchar(255) DEFAULT NULL,
                         `sensorPlastico` varchar(255) DEFAULT NULL,
                         `baldeCheio` varchar(255) DEFAULT NULL,
                         `uid` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dados`
--

LOCK TABLES `dados` WRITE;
/*!40000 ALTER TABLE `dados` DISABLE KEYS */;
INSERT INTO `dados` (`contagemLixo`, `peso`, `sensorMetal`, `sensorPlastico`, `baldeCheio`, `uid`) VALUES ('5','10.5','tyghn','yun','pomiihbu','12345'),('','0','0','0','0',''),('5','10.5','tyghn','yun','pomiihbu','12345'),('','0','0','0','0',''),('','0','0','0','0',''),('','0','0','0','0',''),('','0','0','0','0',''),('','','','','',''),('','0','0','0','0',''),('','0','0','0','0',''),('','0','0','0','1',''),('','0','0','0','0',''),('','0','0','0','0',''),('','0','0','0','0',''),('','0','0','0','0',''),('','0','0','0','0','');
/*!40000 ALTER TABLE `dados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `endereco`
--

DROP TABLE IF EXISTS `endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `endereco` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `endereco` varchar(255) NOT NULL,
                            `id_municipio` int(11) NOT NULL,
                            PRIMARY KEY (`id`),
                            KEY `id_municipio` (`id_municipio`),
                            CONSTRAINT `endereco_ibfk_1` FOREIGN KEY (`id_municipio`) REFERENCES `municipio` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `endereco`
--

LOCK TABLES `endereco` WRITE;
/*!40000 ALTER TABLE `endereco` DISABLE KEYS */;
INSERT INTO `endereco` (`id`, `endereco`, `id_municipio`) VALUES (1,'Avenida 1 de Maio, 123',1),(2,'Rua da Esperança, 45',2),(3,'Praça do Comércio, 10',3),(4,'Rua das Flores, 25',4),(5,'Avenida da Liberdade, 55',5),(6,'Rua do Mercado, 30',6),(7,'Avenida Principal, 90',7);
/*!40000 ALTER TABLE `endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `municipio`
--

DROP TABLE IF EXISTS `municipio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `municipio` (
                             `id` int(11) NOT NULL AUTO_INCREMENT,
                             `nome` varchar(255) NOT NULL,
                             `id_provincia` int(11) NOT NULL,
                             PRIMARY KEY (`id`),
                             KEY `id_provincia` (`id_provincia`),
                             CONSTRAINT `municipio_ibfk_1` FOREIGN KEY (`id_provincia`) REFERENCES `provincia` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `municipio`
--

LOCK TABLES `municipio` WRITE;
/*!40000 ALTER TABLE `municipio` DISABLE KEYS */;
INSERT INTO `municipio` (`id`, `nome`, `id_provincia`) VALUES (1,'Luanda',1),(2,'Viana',1),(3,'Lubango',2),(4,'Tchivinguiro',2),(5,'Moçâmedes',3),(6,'Benguela',4),(7,'Sumbe',5);
/*!40000 ALTER TABLE `municipio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pais`
--

DROP TABLE IF EXISTS `pais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pais` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `nome` varchar(255) NOT NULL,
                        PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pais`
--

LOCK TABLES `pais` WRITE;
/*!40000 ALTER TABLE `pais` DISABLE KEYS */;
INSERT INTO `pais` (`id`, `nome`) VALUES (1,'Angola');
/*!40000 ALTER TABLE `pais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `provincia`
--

DROP TABLE IF EXISTS `provincia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `provincia` (
                             `id` int(11) NOT NULL AUTO_INCREMENT,
                             `nome` varchar(255) NOT NULL,
                             `id_pais` int(11) NOT NULL,
                             PRIMARY KEY (`id`),
                             KEY `id_pais` (`id_pais`),
                             CONSTRAINT `provincia_ibfk_1` FOREIGN KEY (`id_pais`) REFERENCES `pais` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `provincia`
--

LOCK TABLES `provincia` WRITE;
/*!40000 ALTER TABLE `provincia` DISABLE KEYS */;
INSERT INTO `provincia` (`id`, `nome`, `id_pais`) VALUES (1,'Luanda',1),(2,'Huíla',1),(3,'Namibe',1),(4,'Benguela',1),(5,'Cuanza Sul',1);
/*!40000 ALTER TABLE `provincia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
                           `id` int(11) NOT NULL AUTO_INCREMENT,
                           `nome` varchar(255) NOT NULL,
                           `email` varchar(255) NOT NULL,
                           `email_recuperacao` varchar(255) NOT NULL,
                           `senha` varchar(255) NOT NULL,
                           `telefone` varchar(255) DEFAULT NULL,
                           `rf_id` varchar(255) NOT NULL,
                           `pontos` int(11) DEFAULT 0,
                           PRIMARY KEY (`id`),
                           UNIQUE KEY `email` (`email`),
                           UNIQUE KEY `rf_id` (`rf_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`, `nome`, `email`, `email_recuperacao`, `senha`, `telefone`, `rf_id`, `pontos`) VALUES (1,'d d','d@gmail.com','','w',NULL,'133',0),(4,'José Capewa','capewajose@gmail.com','','1234',NULL,'13',0),(8,'José Capewa','capewajose@gail.com','','1234',NULL,'6',0),(9,'q q','q@gmailc.o','','o',NULL,'81',0),(11,'e e','w@gmail.com','','2',NULL,'24',0),(12,'q k','eq@gmail.com','','o',NULL,'79',0),(14,'q k','eqq@gmail.com','','q',NULL,'88',0),(15,'r j','j@gmail.com','','e',NULL,'58',0),(16,'j j','o@gmail.com','','o',NULL,'31',0),(17,'m m','m@gmail.com','','m',NULL,'63',0),(18,'k k','k@gmail.com','','o',NULL,'39',0),(19,'l l','l@gmail.com','','.',NULL,'2',0),(20,'mmmm','mmmm@gmail.com','','m',NULL,'20',0),(21,'j vrewv','jj@gmail.com','','l',NULL,'57',0),(22,'k k','k@mil.com','k@mail.com','l',NULL,'46',0),(23,'Sílvio Santiago Francisco','santiago43255@gmail.com','santiago43255@gmail.com','o',NULL,'67',0),(24,'teste teste','rs@gmail.com','rs@gmail.com','m',NULL,'16',0);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-10-18 18:21:26
