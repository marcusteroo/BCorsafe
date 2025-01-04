-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: localhost    Database: db_prueba
-- ------------------------------------------------------
-- Server version	9.0.1

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
-- Table structure for table `Comentarios_Resenas`
--

DROP TABLE IF EXISTS `Comentarios_Resenas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Comentarios_Resenas` (
  `id_comentario` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int DEFAULT NULL,
  `id_producto` int DEFAULT NULL,
  `comentario` text,
  `calificacion` int DEFAULT NULL,
  `fecha_comentario` datetime NOT NULL,
  PRIMARY KEY (`id_comentario`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `Comentarios_Resenas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `Usuarios` (`id_usuario`),
  CONSTRAINT `Comentarios_Resenas_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `Productos` (`id_producto`),
  CONSTRAINT `Comentarios_Resenas_chk_1` CHECK ((`calificacion` between 1 and 5))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Comentarios_Resenas`
--

LOCK TABLES `Comentarios_Resenas` WRITE;
/*!40000 ALTER TABLE `Comentarios_Resenas` DISABLE KEYS */;
/*!40000 ALTER TABLE `Comentarios_Resenas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Detalles_Pedido`
--

DROP TABLE IF EXISTS `Detalles_Pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Detalles_Pedido` (
  `id_detalle` int NOT NULL AUTO_INCREMENT,
  `id_pedido` int DEFAULT NULL,
  `id_producto` int DEFAULT NULL,
  `cantidad` int NOT NULL,
  `precio_pedido` decimal(10,0) DEFAULT NULL,
  `ingredientes_custom` text,
  PRIMARY KEY (`id_detalle`),
  KEY `id_pedido` (`id_pedido`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `Detalles_Pedido_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `Pedidos` (`id_pedido`),
  CONSTRAINT `Detalles_Pedido_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `Productos` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Detalles_Pedido`
--

LOCK TABLES `Detalles_Pedido` WRITE;
/*!40000 ALTER TABLE `Detalles_Pedido` DISABLE KEYS */;
INSERT INTO `Detalles_Pedido` VALUES (60,7,1,1,8,'Tomate,Queso,Bacon'),(65,8,1,1,4,'Queso'),(66,8,2,2,15,'Tomate,Cebolla,Lechuga,Bacon,Huevo'),(68,10,2,1,15,'Tomate,Cebolla,Lechuga,Bacon,Huevo'),(69,10,1,1,8,'Tomate,Queso,Pulled Pork'),(70,11,1,1,10,'Tomate,Lechuga,Bacon,Pulled Pork'),(71,11,1,6,12,'Tomate,Queso,Lechuga,Bacon,Pulled Pork'),(82,15,1,1,12,'Tomate,Queso,Lechuga,Bacon,Pulled Pork'),(85,17,2,1,15,'Tomate,Cebolla,Lechuga,Bacon,Huevo'),(86,18,2,1,15,'Tomate,Cebolla,Lechuga,Bacon,Huevo'),(87,19,2,1,15,'Tomate,Cebolla,Lechuga,Bacon,Huevo'),(88,20,1,1,12,'Tomate,Queso,Lechuga,Bacon,Pulled Pork'),(91,21,1,1,12,'Tomate,Queso,Lechuga,Bacon,Pulled Pork'),(92,14,1,1,12,'Tomate,Queso,Lechuga,Bacon,Pulled Pork'),(93,22,1,1,12,'Tomate,Queso,Lechuga,Bacon,Pulled Pork');
/*!40000 ALTER TABLE `Detalles_Pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Direcciones`
--

DROP TABLE IF EXISTS `Direcciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Direcciones` (
  `id_direccion` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int DEFAULT NULL,
  `calle` varchar(255) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `codigo_postal` varchar(10) DEFAULT NULL,
  `pais` varchar(100) NOT NULL,
  PRIMARY KEY (`id_direccion`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `Direcciones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `Usuarios` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Direcciones`
--

LOCK TABLES `Direcciones` WRITE;
/*!40000 ALTER TABLE `Direcciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `Direcciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Ingredientes`
--

DROP TABLE IF EXISTS `Ingredientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Ingredientes` (
  `id_ingrediente` int NOT NULL AUTO_INCREMENT,
  `nombre_ingrediente` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_ingrediente`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Ingredientes`
--

LOCK TABLES `Ingredientes` WRITE;
/*!40000 ALTER TABLE `Ingredientes` DISABLE KEYS */;
INSERT INTO `Ingredientes` VALUES (1,'Tomate',2.00),(2,'Cebolla',2.00),(3,'Queso',2.00),(4,'Lechuga',2.00),(5,'Bacon',2.00),(6,'Pulled Pork',2.00),(7,'Huevo',2.00),(8,'Aros Led',2.00),(9,'Sugus',2.00),(10,'Cebolla Caramelizada',2.00);
/*!40000 ALTER TABLE `Ingredientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Metodos_Pago`
--

DROP TABLE IF EXISTS `Metodos_Pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Metodos_Pago` (
  `id_pago` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int DEFAULT NULL,
  `tipo_pago` varchar(50) NOT NULL,
  `numero_tarjeta` varchar(20) DEFAULT NULL,
  `fecha_expiracion` text,
  `codigo_seguridad` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id_pago`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `Metodos_Pago_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `Usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Metodos_Pago`
--

LOCK TABLES `Metodos_Pago` WRITE;
/*!40000 ALTER TABLE `Metodos_Pago` DISABLE KEYS */;
INSERT INTO `Metodos_Pago` VALUES (2,1,'Visa','4389238293823232','23/23','234'),(4,20,'Visa','4343434343434343','08/12','234'),(5,22,'Visa','4324324423423453','23/23','534');
/*!40000 ALTER TABLE `Metodos_Pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Pedidos`
--

DROP TABLE IF EXISTS `Pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Pedidos` (
  `id_pedido` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int DEFAULT NULL,
  `fecha_pedido` date DEFAULT NULL,
  `monto_total` decimal(10,2) NOT NULL,
  `id_pago` int DEFAULT NULL,
  `estado` enum('pendiente','completado','cancelado') DEFAULT 'pendiente',
  PRIMARY KEY (`id_pedido`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `Pedidos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `Usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Pedidos`
--

LOCK TABLES `Pedidos` WRITE;
/*!40000 ALTER TABLE `Pedidos` DISABLE KEYS */;
INSERT INTO `Pedidos` VALUES (7,1,'2024-12-10',0.00,NULL,'completado'),(8,1,'2024-12-10',0.00,NULL,'completado'),(10,1,'2024-12-12',0.00,NULL,'completado'),(11,1,'2024-12-12',0.00,NULL,'completado'),(14,1,'2024-12-17',0.00,NULL,'completado'),(15,14,'2025-01-03',0.00,NULL,'pendiente'),(17,19,'2025-01-04',0.00,NULL,'pendiente'),(18,20,'2025-01-04',0.00,NULL,'completado'),(19,21,'2025-01-04',0.00,NULL,'pendiente'),(20,22,'2025-01-04',0.00,NULL,'completado'),(21,22,'2025-01-04',0.00,NULL,'pendiente'),(22,1,'2025-01-04',0.00,NULL,'pendiente');
/*!40000 ALTER TABLE `Pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Pedidos_Comprados`
--

DROP TABLE IF EXISTS `Pedidos_Comprados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Pedidos_Comprados` (
  `id_compra` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int DEFAULT NULL,
  `id_pedido` int DEFAULT NULL,
  `id_pago` int DEFAULT NULL,
  `direccion` varchar(255) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `codigo_postal` varchar(10) NOT NULL,
  `pais` varchar(100) NOT NULL,
  PRIMARY KEY (`id_compra`),
  KEY `fk_pedidos_comprados_usuario` (`id_usuario`),
  KEY `fk_pedidos_comprados_pedido` (`id_pedido`),
  KEY `fk_pedidos_comprados_pago` (`id_pago`),
  CONSTRAINT `fk_pedidos_comprados_pago` FOREIGN KEY (`id_pago`) REFERENCES `Metodos_Pago` (`id_pago`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_pedidos_comprados_pedido` FOREIGN KEY (`id_pedido`) REFERENCES `Pedidos` (`id_pedido`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_pedidos_comprados_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `Usuarios` (`id_usuario`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Pedidos_Comprados`
--

LOCK TABLES `Pedidos_Comprados` WRITE;
/*!40000 ALTER TABLE `Pedidos_Comprados` DISABLE KEYS */;
INSERT INTO `Pedidos_Comprados` VALUES (6,1,7,2,'Carrer Castell del Ben Viure, 65, Castellbisbal','Castellbisbal','08755','España'),(7,1,8,2,'Carrer Castell del Ben Viure, 65, Castellbisbal','Castellbisbal','08755','España'),(8,1,NULL,2,'Carrer Castell del Ben Viure, 65, Castellbisbal','Castellbisbal','08755','España'),(9,1,10,2,'Carrer Castell del Ben Viure, 65, Castellbisbal','Castellbisbal','08755','España'),(10,1,11,2,'Carrer Castell del Ben Viure, 65, Castellbisbal','Castellbisbal','08755','España'),(11,1,NULL,2,'Carrer Castell del Ben Viure, 65, Castellbisbal','Castellbisbal','08755','España'),(12,1,NULL,2,'Carrer Castell del Ben Viure, 65, Castellbisbal','Castellbisbal','08755','España'),(13,19,NULL,NULL,'Carrer Castell del Ben Viure, 65, Castellbisbal','Castellbisbal','08755','España'),(14,20,18,4,'Carrer Castell del Ben Viure, 65, Castellbisbal','Castellbisbal','08755','España'),(15,22,20,5,'Carrer Castell del Ben Viure, 65, Castellbisbal','Castellbisbal','08755','España'),(16,1,14,2,'Carrer Castell del Ben Viure, 65, Castellbisbal','Castellbisbal','08755','España');
/*!40000 ALTER TABLE `Pedidos_Comprados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Productos`
--

DROP TABLE IF EXISTS `Productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Productos` (
  `id_producto` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `id_tipo` int DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `id_tipo` (`id_tipo`),
  CONSTRAINT `Productos_ibfk_1` FOREIGN KEY (`id_tipo`) REFERENCES `Tipos_Productos` (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Productos`
--

LOCK TABLES `Productos` WRITE;
/*!40000 ALTER TABLE `Productos` DISABLE KEYS */;
INSERT INTO `Productos` VALUES (1,'Xburger',12.00,1,'/BCorsafe/assets/img/Xburguer.webp','Hamburguesa inspirada en Xbox: sabor épico para gamers auténticos.'),(2,'Ledburger',15.00,1,'/BCorsafe/assets/img/Ledburguer.webp','¡Brilla con estilo y disfruta del sabor gamer único!'),(3,'MetalBurger',19.00,1,'/BCorsafe/assets/img/Metal.webp','El toque futurista con sabor de otro nivel.'),(4,'BurgerLaser',15.00,1,'/BCorsafe/assets/img/Laser.webp','La hamburguesa definitiva para auténticos gamers.'),(5,'BurguerPixel',12.00,1,'/BCorsafe/assets/img/Pixel.webp','La reina de las hamburguesas gamer, ¡supera todas las expectativas!'),(6,'BlueBurger',19.00,1,'/BCorsafe/assets/img/Blue.webp','Su toque de sabor electrizante te llevará a una nueva dimensión'),(17,'TecnoBurger',15.00,1,'/BCorsafe/assets/img/producto_677975325a127.png','La TecnoBurger: innovación y sabor unidos en la hamburguesa perfecta.'),(18,'FortniteBurger',19.00,1,'/BCorsafe/assets/img/producto_677977bc14238.webp','Una hamburguesa gaming inspirada en el videojuego Fortnite'),(19,'DragonBurger',18.00,1,'/BCorsafe/assets/img/producto_677979b6c1582.webp','Una hamburguesa gaming inspirada en Dragon Ball');
/*!40000 ALTER TABLE `Productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Productos_Ingredientes`
--

DROP TABLE IF EXISTS `Productos_Ingredientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Productos_Ingredientes` (
  `id_producto` int NOT NULL,
  `id_ingrediente` int NOT NULL,
  `cantidad` int DEFAULT '1',
  PRIMARY KEY (`id_producto`,`id_ingrediente`),
  KEY `id_ingrediente` (`id_ingrediente`),
  CONSTRAINT `Productos_Ingredientes_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `Productos` (`id_producto`) ON DELETE CASCADE,
  CONSTRAINT `Productos_Ingredientes_ibfk_2` FOREIGN KEY (`id_ingrediente`) REFERENCES `Ingredientes` (`id_ingrediente`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Productos_Ingredientes`
--

LOCK TABLES `Productos_Ingredientes` WRITE;
/*!40000 ALTER TABLE `Productos_Ingredientes` DISABLE KEYS */;
INSERT INTO `Productos_Ingredientes` VALUES (1,1,1),(1,3,1),(1,4,1),(1,5,1),(1,6,1),(2,1,1),(2,2,1),(2,4,1),(2,5,1),(2,7,1),(3,1,1),(3,2,1),(3,3,1),(3,8,1),(3,10,1),(4,2,1),(4,3,1),(4,4,1),(4,6,1),(4,8,1),(5,2,1),(5,3,1),(5,4,1),(5,8,1),(5,9,1),(6,1,1),(6,2,1),(6,3,1),(6,5,1),(6,9,1),(17,3,1),(17,4,1),(17,6,1),(17,8,1),(17,10,1),(18,1,1),(18,2,1),(18,3,1),(18,4,1),(18,8,1),(19,1,1),(19,2,1),(19,4,1),(19,5,1),(19,6,1);
/*!40000 ALTER TABLE `Productos_Ingredientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Tipos_Productos`
--

DROP TABLE IF EXISTS `Tipos_Productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Tipos_Productos` (
  `id_tipo` int NOT NULL AUTO_INCREMENT,
  `nombre_tipo` varchar(50) NOT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Tipos_Productos`
--

LOCK TABLES `Tipos_Productos` WRITE;
/*!40000 ALTER TABLE `Tipos_Productos` DISABLE KEYS */;
INSERT INTO `Tipos_Productos` VALUES (1,'Hamburguesa'),(2,'Café');
/*!40000 ALTER TABLE `Tipos_Productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Usuarios`
--

DROP TABLE IF EXISTS `Usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `contrasena` varchar(100) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Usuarios`
--

LOCK TABLES `Usuarios` WRITE;
/*!40000 ALTER TABLE `Usuarios` DISABLE KEYS */;
INSERT INTO `Usuarios` VALUES (1,'ustero','marc8100@hotmail.com','232 424 242','$2y$10$CN3iu3hF4bZT29huVWaygO4Gzd/wNcMFrjF/UBlPqeSFAsVlJ8Vd2','/BCorsafe/assets/img/perfil_1.png'),(3,'ustero','marc9100@hotmail.com','242 424 242','$2y$10$QZWB7vlrRY9T.E9/phkzpeJJOD6jq2YX.TYtkQBWGXrGfS.sp5odK',NULL),(4,'ustero','marc7100@hotmail.com','342 435 224','$2y$10$VdfOmfZs9/02Q0/PS.CCuejKMrvhvd4mBz/h9LqGqR6t/0AuRxAku',NULL),(5,'fran','marc2100@hotmail.com','123 45','$2y$10$zmMpzxiR4eMYlO3.JSWg5ubUU6mtqZJE2pvFEmGBJRHG21FU0ljDm',NULL),(6,'ustero','marc81000@hotmail.com','12345','$2y$10$hPys9Vi8kXrKnklLEmZ4rOgcIZoZCPrlYf1ipXRUJMHe2z3T3ZnAy',NULL),(7,'ustero','marc1100@hotmail.com','123 45','$2y$10$RVppr.2Z3MQjqhL3bg0XLeyU5PqXOSO2maHEO610usndr5vrzW7ey',NULL),(8,'ustero','marc5100@hotmail.com','123 434 343','$2y$10$YjLuDRmNzZvBugL8VYkjleS2j7PwyUx9q23B60zTH2wuD5qwaTxP2',NULL),(14,'admin','admin@hotmail.com','909 090 909','$2y$10$0Sqyj08THNR0uNPNzWqExup3McEAWh1VtDsmjHKHYEmhHBrM45Fa2','/BCorsafe/assets/img/Default.webp'),(19,'africa','africa@gmail.com','232 322 424','$2y$10$rJ7o50DAA/9wJ6kFq94q.OgZBxijI25z0AQAZUaWmaLew0iBBhgJ.','/BCorsafe/assets/img/Default.webp'),(20,'prueba','j@hotmail.com','232 242 424','$2y$10$lu0.REfwA82LT5zya0BMIuOxAHykXpwEudnp3endt1Vrlc62WX5Ai','/BCorsafe/assets/img/Default.webp'),(21,'re','re@gmail.com','123 4','$2y$10$p3HLOKlRxAuwpEC.0c/dweoWt1Iwc4RM5K8KgfrFiEebsyD96Xq2u','/BCorsafe/assets/img/Default.webp'),(22,'adrian','a@hotmail.com','352 332 523','$2y$10$6OW4lfL8FqNJ/S.vCFWJYOhjl.v0NA8MWCIkgJ802WMu5OaB7w1Zi','/BCorsafe/assets/img/Default.webp');
/*!40000 ALTER TABLE `Usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cupones`
--

DROP TABLE IF EXISTS `cupones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cupones` (
  `id_cupon` int NOT NULL AUTO_INCREMENT,
  `nombre_cupon` varchar(255) NOT NULL,
  `descuento` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id_cupon`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cupones`
--

LOCK TABLES `cupones` WRITE;
/*!40000 ALTER TABLE `cupones` DISABLE KEYS */;
INSERT INTO `cupones` VALUES (1,'Black Friday',50.00),(2,'PRIMERA',20.00),(3,'SEGUNDA',10.00),(4,'AMIGO',30.00);
/*!40000 ALTER TABLE `cupones` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-04 19:51:07
