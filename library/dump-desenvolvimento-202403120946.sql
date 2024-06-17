-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: desenvolvimento
-- ------------------------------------------------------
-- Server version	8.0.34-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categoria`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoria` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categoria` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'administrador'),(2,'Analista'),(3,'Gerencia');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enderecos`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enderecos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pessoa_id` int NOT NULL,
  `cep` int NOT NULL,
  `endereco` varchar(45) NOT NULL,
  `numero` int NOT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `uf` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_endereco_usuarios_cad_usuarios1_idx` (`pessoa_id`),
  CONSTRAINT `fk_endereco_usuarios_cad_usuarios1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enderecos`
--

LOCK TABLES `enderecos` WRITE;
/*!40000 ALTER TABLE `enderecos` DISABLE KEYS */;
INSERT INTO `enderecos` VALUES (1,1,2417140,'Rua General Nestor Passos',170,'apto 28B','Jardim Paraíso','São Paulo','São Paulo','SP'),(2,1,2417140,'Rua General Nestor Passos',170,'apto 28b','Jardim Paraíso','São Paulo','São Paulo','SP'),(3,2,2417140,'Rua General Nestor Passos',170,'apto 28B','Jardim Paraíso','São Paulo','São Paulo','SP'),(4,3,2417140,'Rua General Nestor Passos',170,'apto 28b','Jardim Paraíso','São Paulo','São Paulo','SP');
/*!40000 ALTER TABLE `enderecos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `login` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuarios_id` int NOT NULL,
  `data_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_login_usuarios1_idx` (`usuarios_id`),
  CONSTRAINT `fk_login_usuarios1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pessoas`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pessoas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cpf` varchar(45) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `data_nasc` date NOT NULL,
  `ativo` enum('S','N') NOT NULL DEFAULT 'S',
  `categoria_id` int NOT NULL,
  `data_cadastro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_cad_usuarios_categoria_usuario_idx` (`categoria_id`),
  CONSTRAINT `fk_cad_usuarios_categoria_usuario` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pessoas`
--

LOCK TABLES `pessoas` WRITE;
/*!40000 ALTER TABLE `pessoas` DISABLE KEYS */;
INSERT INTO `pessoas` VALUES (1,'44013435810','Francisco Alecrim Tamberi','1995-02-18','S',1,'2023-12-26 11:17:20'),(2,'11111111111','Administrador','1995-02-18','S',1,'2023-12-26 11:17:44'),(3,'42233515838','Carolina Tamberi Alecrim','1994-03-02','S',1,'2023-12-26 11:18:04'),(4,'44013435811','Francisco Alecrim Tamberi','1995-02-18','S',1,'2024-02-29 18:07:59');
/*!40000 ALTER TABLE `pessoas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registros`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registros` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `pessoa_id` int NOT NULL,
  `data_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_cad_registros_cad_usuarios1_idx` (`pessoa_id`),
  CONSTRAINT `fk_cad_registros_cad_usuarios1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registros`
--

LOCK TABLES `registros` WRITE;
/*!40000 ALTER TABLE `registros` DISABLE KEYS */;
INSERT INTO `registros` VALUES (1,1,'2023-12-26 12:04:29'),(2,1,'2023-12-26 12:04:35'),(3,1,'2023-12-26 12:04:35'),(4,1,'2023-12-26 12:04:36'),(5,1,'2023-12-26 12:04:36'),(6,1,'2023-12-26 12:04:36'),(7,2,'2023-12-26 12:05:07'),(8,1,'2024-02-29 18:07:36'),(9,1,'2024-02-29 18:16:33'),(10,2,'2024-02-29 18:17:34');
/*!40000 ALTER TABLE `registros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pessoa_id` int NOT NULL,
  `cpf` varchar(45) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_cadastro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ativo` enum('S','N') NOT NULL DEFAULT 'S',
  PRIMARY KEY (`id`),
  KEY `fk_cad_operadores_cad_usuarios1_idx` (`pessoa_id`),
  CONSTRAINT `fk_cad_operadores_cad_usuarios1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,1,'44013435810','francisco_crim@hotmail.com','RWNsZXRpY2Ex','2023-12-26 11:18:38','S'),(2,3,'42233515838','carol.tamberi@gmail.com','dGVzdGUxMjM=','2023-12-26 11:19:09','S'),(3,2,'11111111111','admin@admin.com','YWRtaW4=','2023-12-26 11:19:20','S');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'desenvolvimento'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-12  9:46:37
