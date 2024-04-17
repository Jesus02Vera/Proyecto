-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: condominio_v2
-- ------------------------------------------------------
-- Server version	8.3.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `areas_comunitarias`
--

DROP TABLE IF EXISTS `areas_comunitarias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `areas_comunitarias` (
  `areas_comunitarias_id` int unsigned NOT NULL AUTO_INCREMENT,
  `areas_comunitarias_nombre` varchar(45) NOT NULL,
  `areas_comunitarias_direccion` varchar(80) NOT NULL,
  PRIMARY KEY (`areas_comunitarias_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `areas_comunitarias`
--

LOCK TABLES `areas_comunitarias` WRITE;
/*!40000 ALTER TABLE `areas_comunitarias` DISABLE KEYS */;
/*!40000 ALTER TABLE `areas_comunitarias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comunicados`
--

DROP TABLE IF EXISTS `comunicados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comunicados` (
  `comunicados_id` int unsigned NOT NULL AUTO_INCREMENT,
  `comunicados_contenido` varchar(2000) NOT NULL,
  `comunicados_fecha_publicacion` date NOT NULL,
  `personas_personas_id` int unsigned NOT NULL,
  PRIMARY KEY (`comunicados_id`,`personas_personas_id`),
  KEY `fk_comunicados_personas1_idx` (`personas_personas_id`),
  CONSTRAINT `fk_comunicados_personas1` FOREIGN KEY (`personas_personas_id`) REFERENCES `personas` (`personas_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comunicados`
--

LOCK TABLES `comunicados` WRITE;
/*!40000 ALTER TABLE `comunicados` DISABLE KEYS */;
/*!40000 ALTER TABLE `comunicados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresas_guardias`
--

DROP TABLE IF EXISTS `empresas_guardias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empresas_guardias` (
  `empresas_guardias_id` int unsigned NOT NULL AUTO_INCREMENT,
  `empresas_guardias_nombre` varchar(120) NOT NULL,
  `empresas_guardias_direccion` varchar(150) NOT NULL,
  `empresas_guardias_telefono` varchar(15) NOT NULL,
  `empresas_guardias_correo` varchar(120) NOT NULL,
  PRIMARY KEY (`empresas_guardias_id`),
  UNIQUE KEY `empresas_guardias_correo_UNIQUE` (`empresas_guardias_correo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresas_guardias`
--

LOCK TABLES `empresas_guardias` WRITE;
/*!40000 ALTER TABLE `empresas_guardias` DISABLE KEYS */;
INSERT INTO `empresas_guardias` VALUES (1,'GodKiler','La esmeralda av15','3203782918','empresa@empresa.com');
/*!40000 ALTER TABLE `empresas_guardias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresas_guardias_personas`
--

DROP TABLE IF EXISTS `empresas_guardias_personas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empresas_guardias_personas` (
  `empresas_guardias_empresas_guardias_id` int unsigned NOT NULL,
  `personas_personas_id` int unsigned NOT NULL,
  PRIMARY KEY (`empresas_guardias_empresas_guardias_id`,`personas_personas_id`),
  KEY `fk_empresas_guardias_has_personas_personas1_idx` (`personas_personas_id`),
  KEY `fk_empresas_guardias_has_personas_empresas_guardias1_idx` (`empresas_guardias_empresas_guardias_id`),
  CONSTRAINT `fk_empresas_guardias_has_personas_empresas_guardias1` FOREIGN KEY (`empresas_guardias_empresas_guardias_id`) REFERENCES `empresas_guardias` (`empresas_guardias_id`),
  CONSTRAINT `fk_empresas_guardias_has_personas_personas1` FOREIGN KEY (`personas_personas_id`) REFERENCES `personas` (`personas_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresas_guardias_personas`
--

LOCK TABLES `empresas_guardias_personas` WRITE;
/*!40000 ALTER TABLE `empresas_guardias_personas` DISABLE KEYS */;
/*!40000 ALTER TABLE `empresas_guardias_personas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eventos`
--

DROP TABLE IF EXISTS `eventos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `eventos` (
  `eventos_id` int unsigned NOT NULL AUTO_INCREMENT,
  `eventos_nombre` varchar(100) DEFAULT NULL,
  `eventos_tipo` enum('Publico','Privado','Social') NOT NULL,
  `areas_comunitarias_areas_comunitarias_id` int unsigned NOT NULL,
  PRIMARY KEY (`eventos_id`),
  KEY `fk_eventos_areas_comunitarias1_idx` (`areas_comunitarias_areas_comunitarias_id`),
  CONSTRAINT `fk_eventos_areas_comunitarias1` FOREIGN KEY (`areas_comunitarias_areas_comunitarias_id`) REFERENCES `areas_comunitarias` (`areas_comunitarias_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eventos`
--

LOCK TABLES `eventos` WRITE;
/*!40000 ALTER TABLE `eventos` DISABLE KEYS */;
/*!40000 ALTER TABLE `eventos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notificaciones`
--

DROP TABLE IF EXISTS `notificaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notificaciones` (
  `notificaciones_id` int unsigned NOT NULL AUTO_INCREMENT,
  `notificaciones_continido` varchar(200) NOT NULL,
  `notificaciones_fecha_publicacion` date NOT NULL,
  `notificaciones_estado` enum('Publicado','Leido','Inactivo') NOT NULL DEFAULT 'Publicado',
  PRIMARY KEY (`notificaciones_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificaciones`
--

LOCK TABLES `notificaciones` WRITE;
/*!40000 ALTER TABLE `notificaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `notificaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfil`
--

DROP TABLE IF EXISTS `perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perfil` (
  `perfil_id` int unsigned NOT NULL AUTO_INCREMENT,
  `perfil_administrador` varchar(45) DEFAULT NULL,
  `perfil_propietario` varchar(45) DEFAULT NULL,
  `perfil_arrendatario` varchar(45) DEFAULT NULL,
  `perfil_guardia` varchar(45) DEFAULT NULL,
  `perfil_contratista` varchar(45) DEFAULT NULL,
  `perfil_visitante` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`perfil_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfil`
--

LOCK TABLES `perfil` WRITE;
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personas`
--

DROP TABLE IF EXISTS `personas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personas` (
  `personas_id` int unsigned NOT NULL AUTO_INCREMENT,
  `personas_nombre` varchar(50) NOT NULL,
  `personas_apellido` varchar(40) NOT NULL,
  `personas_fecha_nacimiento` date NOT NULL,
  `personas_telefono` varchar(15) DEFAULT NULL,
  `personas_tipo_documento` enum('CC','CE','PPT') NOT NULL DEFAULT 'CC',
  `personas_numero_documento` int NOT NULL,
  `personas_email` varchar(120) NOT NULL,
  `personas_direccion` varchar(45) NOT NULL,
  PRIMARY KEY (`personas_id`),
  UNIQUE KEY `personas_numero_documento_UNIQUE` (`personas_numero_documento`),
  UNIQUE KEY `personas_email_UNIQUE` (`personas_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personas`
--

LOCK TABLES `personas` WRITE;
/*!40000 ALTER TABLE `personas` DISABLE KEYS */;
/*!40000 ALTER TABLE `personas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personas_notificaciones`
--

DROP TABLE IF EXISTS `personas_notificaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personas_notificaciones` (
  `notificaciones_notificaciones_id` int unsigned NOT NULL,
  `personas_personas_id` int unsigned NOT NULL,
  PRIMARY KEY (`notificaciones_notificaciones_id`,`personas_personas_id`),
  KEY `fk_personas_has_notificaciones_notificaciones1_idx` (`notificaciones_notificaciones_id`),
  KEY `fk_personas_has_notificaciones_personas1_idx` (`personas_personas_id`),
  CONSTRAINT `fk_personas_has_notificaciones_notificaciones1` FOREIGN KEY (`notificaciones_notificaciones_id`) REFERENCES `notificaciones` (`notificaciones_id`),
  CONSTRAINT `fk_personas_has_notificaciones_personas1` FOREIGN KEY (`personas_personas_id`) REFERENCES `personas` (`personas_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personas_notificaciones`
--

LOCK TABLES `personas_notificaciones` WRITE;
/*!40000 ALTER TABLE `personas_notificaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `personas_notificaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pqrs`
--

DROP TABLE IF EXISTS `pqrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pqrs` (
  `pqrs_id` int unsigned NOT NULL AUTO_INCREMENT,
  `pqrs_fecha` date NOT NULL,
  `pqrs_contenido` varchar(1500) NOT NULL,
  `personas_personas_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`pqrs_id`),
  KEY `fk_pqrs_personas1_idx` (`personas_personas_id`),
  CONSTRAINT `fk_pqrs_personas1` FOREIGN KEY (`personas_personas_id`) REFERENCES `personas` (`personas_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pqrs`
--

LOCK TABLES `pqrs` WRITE;
/*!40000 ALTER TABLE `pqrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `pqrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `propiedades`
--

DROP TABLE IF EXISTS `propiedades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `propiedades` (
  `propiedades_id` int unsigned NOT NULL AUTO_INCREMENT,
  `propiedades_nombre` varchar(70) DEFAULT NULL,
  `propiedades_direccion` varchar(80) NOT NULL,
  `personas_personas_id` int unsigned NOT NULL,
  PRIMARY KEY (`propiedades_id`,`personas_personas_id`),
  KEY `fk_propiedades_personas1_idx` (`personas_personas_id`),
  CONSTRAINT `fk_propiedades_personas1` FOREIGN KEY (`personas_personas_id`) REFERENCES `personas` (`personas_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `propiedades`
--

LOCK TABLES `propiedades` WRITE;
/*!40000 ALTER TABLE `propiedades` DISABLE KEYS */;
/*!40000 ALTER TABLE `propiedades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reportes_daños`
--

DROP TABLE IF EXISTS `reportes_daños`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reportes_daños` (
  `reportes_daños_id` int unsigned NOT NULL AUTO_INCREMENT,
  `reportes_daños_fecha` date NOT NULL,
  `reportes_daños_motivo` varchar(1000) NOT NULL,
  `personas_personas_id` int unsigned NOT NULL,
  PRIMARY KEY (`reportes_daños_id`,`personas_personas_id`),
  KEY `fk_reportes_daños_personas1_idx` (`personas_personas_id`),
  CONSTRAINT `fk_reportes_daños_personas1` FOREIGN KEY (`personas_personas_id`) REFERENCES `personas` (`personas_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reportes_daños`
--

LOCK TABLES `reportes_daños` WRITE;
/*!40000 ALTER TABLE `reportes_daños` DISABLE KEYS */;
/*!40000 ALTER TABLE `reportes_daños` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservas`
--

DROP TABLE IF EXISTS `reservas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservas` (
  `reservas_id` int unsigned NOT NULL AUTO_INCREMENT,
  `reservas_dia` date NOT NULL,
  `reservas_hora_inicio` time NOT NULL,
  `reservas_hora_fin` datetime NOT NULL,
  `personas_personas_id` int unsigned NOT NULL,
  `areas_comunitarias_areas_comunitarias_id` int unsigned NOT NULL,
  PRIMARY KEY (`reservas_id`,`personas_personas_id`,`areas_comunitarias_areas_comunitarias_id`),
  KEY `fk_reservas_personas1_idx` (`personas_personas_id`),
  KEY `fk_reservas_areas_comunitarias1_idx` (`areas_comunitarias_areas_comunitarias_id`),
  CONSTRAINT `fk_reservas_areas_comunitarias1` FOREIGN KEY (`areas_comunitarias_areas_comunitarias_id`) REFERENCES `areas_comunitarias` (`areas_comunitarias_id`),
  CONSTRAINT `fk_reservas_personas1` FOREIGN KEY (`personas_personas_id`) REFERENCES `personas` (`personas_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservas`
--

LOCK TABLES `reservas` WRITE;
/*!40000 ALTER TABLE `reservas` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `usuario_id` int unsigned NOT NULL AUTO_INCREMENT,
  `usuario_nombre` varchar(70) NOT NULL,
  `usuario_email` varchar(60) NOT NULL,
  `usuario_clave` varchar(100) NOT NULL,
  `intentos` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (5,'Jesus','jesus@gmail.com','$2a$07$asxx54ahjppf45sd87a5au/bRkEtzMadYk3LpalOhKSsvaTLKzxfK',0),(8,'Admin','admin@admin.com','$2a$07$asxx54ahjppf45sd87a5au6j9eypLe6FsP6bmJVo1bdmx8yGcCGAq',0),(9,'Astrid','astrid@gmail.com','$2a$07$asxx54ahjppf45sd87a5auPhnw/RDNSJpq8AvcsuH8f.1ojAmOWD6',0);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visitas`
--

DROP TABLE IF EXISTS `visitas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `visitas` (
  `invitados_id` int unsigned NOT NULL AUTO_INCREMENT,
  `invitados_fecha_llegada` date NOT NULL,
  `invitados_fecha_salida` date DEFAULT NULL,
  `personas_personas_id` int unsigned NOT NULL,
  `propiedades_propiedades_id` int unsigned NOT NULL,
  `personas_perfil_personas_perfil_id` int unsigned NOT NULL,
  PRIMARY KEY (`invitados_id`,`propiedades_propiedades_id`,`personas_perfil_personas_perfil_id`),
  KEY `fk_visitas_personas1_idx` (`personas_personas_id`),
  KEY `fk_visitas_propiedades1_idx` (`propiedades_propiedades_id`),
  KEY `fk_visitas_personas_has_perfil1_idx` (`personas_perfil_personas_perfil_id`),
  CONSTRAINT `fk_visitas_personas1` FOREIGN KEY (`personas_personas_id`) REFERENCES `personas` (`personas_id`),
  CONSTRAINT `fk_visitas_personas_has_perfil1` FOREIGN KEY (`personas_perfil_personas_perfil_id`) REFERENCES `personas_perfil` (`personas_perfil_id`),
  CONSTRAINT `fk_visitas_propiedades1` FOREIGN KEY (`propiedades_propiedades_id`) REFERENCES `propiedades` (`propiedades_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visitas`
--

LOCK TABLES `visitas` WRITE;
/*!40000 ALTER TABLE `visitas` DISABLE KEYS */;
/*!40000 ALTER TABLE `visitas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-16 21:48:02
