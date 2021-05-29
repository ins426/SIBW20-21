-- MariaDB dump 10.19  Distrib 10.5.10-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: SIBW
-- ------------------------------------------------------
-- Server version	10.5.9-MariaDB

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
-- Table structure for table `Comentarios`
--

DROP TABLE IF EXISTS `Comentarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Comentarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `autor` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hora` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comentario` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_ev` int(11) DEFAULT NULL,
  `modificado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Comentarios`
--

LOCK TABLES `Comentarios` WRITE;
/*!40000 ALTER TABLE `Comentarios` DISABLE KEYS */;
INSERT INTO `Comentarios` VALUES (1,'Agapito','agapitosemail@gmail.com','22/03/2021','21:21','Etiam consectetur congue feugiat. Duis auctor quis leo a sagittis. Maecenas sit amet erat maximus, accumsan purus at, vehicula nibh. Aenean sed ullamcorper tellus. Praesent aliquet, nulla non varius vehicula, nibh leo placerat metus, sed elementum purus nisi vel magna. Vivamus in turpis ac magna tristique hendrerit.',1,1),(2,'Agapita','agapitasemail@gmail.com','22/03/2021','11:11','\"Aliquam risus sapien, posuere semper tincidunt sit amet, aliquam et nulla. Aenean tortor ex, condimentum non sodales ut, tempor ac arcu. Vivamus elementum dolor quis felis vulputate suscipit. Suspendisse diam sapien, ornare sit amet pretium at, facilisis eget diam.\"holifunsionaporfis',1,NULL),(10,'lalolis','lolis@gmail.com','17/05/2021','09:05','increible yo iba',2,1);
/*!40000 ALTER TABLE `Comentarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Etiquetas`
--

DROP TABLE IF EXISTS `Etiquetas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Etiquetas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `texto` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_ev` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ev` (`id_ev`),
  CONSTRAINT `Etiquetas_ibfk_1` FOREIGN KEY (`id_ev`) REFERENCES `Eventos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Etiquetas`
--

LOCK TABLES `Etiquetas` WRITE;
/*!40000 ALTER TABLE `Etiquetas` DISABLE KEYS */;
INSERT INTO `Etiquetas` VALUES (1,'firmas',1),(2,'meet and greet',1),(9,'firmas',1),(10,'meet and greet',1),(11,' quedadas           ',1),(12,'                    ',2),(13,'                                        ',2);
/*!40000 ALTER TABLE `Etiquetas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Eventos`
--

DROP TABLE IF EXISTS `Eventos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Eventos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organizador` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `horainicio` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `horafin` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` varchar(1500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fechainicio` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fechafin` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icono` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Eventos`
--

LOCK TABLES `Eventos` WRITE;
/*!40000 ALTER TABLE `Eventos` DISABLE KEYS */;
INSERT INTO `Eventos` VALUES (1,'Feria Internacional (Madrid)','LIBER','9:00','22:00','Lorem ipsum dolor sit amet, consectetur adipiscing elit. In maximus vulputate malesuada. Ut vestibulum ullamcorper risus, ultricies accumsan ante eleifend ut. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Sed tincidunt urna nulla, vel mattis mi bibendum id. Maecenas pretium libero at felis sagittis tincidunt. Duis nec justo interdum, fermentum est vel, sagittis magna. Duis vitae odio facilisis, mattis eros eu, malesuada magna. In et arcu vel orci finibus tempus. Nulla at augue in tellus pretium gravida. Cras id sagittis dolor, in dignissim nisi. Vestibulum pharetra est at tortor viverra, vitae rhoncus sapien lobortis. Nunc varius fringilla imperdiet. Nulla orci elit, tincidunt ut euismod vel, iaculis eget leo. Nulla id euismod augue. Nulla semper, orci in suscipit luctus, risus neque faucibus felis, id pellentesque sem mauris a nunc. Sed aliquam magna ipsum, tempor maximus elit lacinia at. ','15 de octubre','20 de octubre','aragon.jpg'),(2,'Feria del Libro Aragonés(Aragón)','','','','Esto es una prueba','21 de mayo','23 de mayo','libro_antiguo.jpg'),(3,'Feria del Libro Antiguo (Madrid)',NULL,NULL,NULL,NULL,'28 de sept','1 de octubre','internacional.jpg'),(4,'Feria del Libro y de la Artesania (Sevilla)',NULL,NULL,NULL,NULL,'12 mayo','15 mayo','libro_artesania.jpg'),(5,'Feria del Libro Antiguo (Córdoba)',NULL,NULL,NULL,NULL,'9 oct','15 oct','bermeo.jpg'),(6,'Feria del Libro (Granada)',NULL,NULL,NULL,NULL,'1 oct','5 oct','granada.jpg'),(7,'Feria del Libro de Caravaca de la Cruz(Murcia)',NULL,NULL,NULL,NULL,'2 junio','7 junio','murcia.jpg'),(8,'Salón del Libro Infantil (Pontevedra)',NULL,NULL,NULL,NULL,'26 abril','1 mayo','pontevedra.jpeg'),(9,'Feria del Libro La Bañeza (León)',NULL,NULL,NULL,NULL,'4 julio','7 julio','leon.jpg');
/*!40000 ALTER TABLE `Eventos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Imagenes`
--

DROP TABLE IF EXISTS `Imagenes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Imagenes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_ev` int(11) NOT NULL,
  `pie` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ev` (`id_ev`),
  CONSTRAINT `Imagenes_ibfk_1` FOREIGN KEY (`id_ev`) REFERENCES `Eventos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Imagenes`
--

LOCK TABLES `Imagenes` WRITE;
/*!40000 ALTER TABLE `Imagenes` DISABLE KEYS */;
INSERT INTO `Imagenes` VALUES (1,'aragon.jpg',1,NULL),(2,'internacional.jpg',1,'Feria del libro internacional de Madrid 2019. Créditos: ifema.es'),(3,'niñas_leyendo.jpg',1,'Niñas leyendo, feria del libro internacional. Créditos:softisia.live'),(4,'libro_antiguo.jpg',2,NULL),(5,'internacional.jpg',2,NULL),(6,'libro_artesania.jpg',4,NULL),(7,'bermeo.jpg',5,NULL),(8,'granada.jpg',6,NULL),(9,'murcia.jpg',7,NULL),(10,'pontevedra.jpeg',8,NULL),(11,'leon.jpg',9,NULL),(12,'galeria1.jpg',1,NULL),(13,'galeria2.jpeg',1,NULL),(14,'galeria3.jpg',1,NULL);
/*!40000 ALTER TABLE `Imagenes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PalabrasProhibidas`
--

DROP TABLE IF EXISTS `PalabrasProhibidas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PalabrasProhibidas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `palabra` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PalabrasProhibidas`
--

LOCK TABLES `PalabrasProhibidas` WRITE;
/*!40000 ALTER TABLE `PalabrasProhibidas` DISABLE KEYS */;
INSERT INTO `PalabrasProhibidas` VALUES (1,'imbecil'),(2,'bocachancla'),(3,'chupacables'),(4,'gorrino'),(5,'parguelas'),(6,'tolai'),(7,'cabezabuque'),(8,'pagafantas'),(9,'desgraciao'),(10,'estupido');
/*!40000 ALTER TABLE `PalabrasProhibidas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Usuarios`
--

DROP TABLE IF EXISTS `Usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Usuarios` (
  `nick` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `super` tinyint(1) DEFAULT NULL,
  `moderador` tinyint(1) DEFAULT NULL,
  `gestor` tinyint(1) DEFAULT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`nick`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Usuarios`
--

LOCK TABLES `Usuarios` WRITE;
/*!40000 ALTER TABLE `Usuarios` DISABLE KEYS */;
INSERT INTO `Usuarios` VALUES ('anabel','$2y$10$iuEBt7/U9noz58oxAM2BYew0dpN0WO2GjA9B6efCtXZWqrfdEX7I.',0,1,0,'anabel@gmail.com'),('ines2','$2y$10$p3fRjJoZ2fzLflpCIZ8M6uouTTdng5jm3YPydiQkwz5q8Vn/JGE9.',0,0,0,'herondale@gmail.com'),('lalolis','$2y$10$oHmILocuUfgAHVxKOOBU2.N4UAp2BWZCMmNeMsVMTD204Llsf72DC',1,1,1,'lolis@gmail.com'),('paola','$2y$10$V.CDJqgpoH8hiNTHlRb/.em6HGAytVscxVy.wToY/6U6MIAuIp8JO',0,0,0,'ana@hotmail.com');
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

-- Dump completed on 2021-05-24 18:57:27
