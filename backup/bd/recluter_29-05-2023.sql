-- MySQL dump 10.13  Distrib 8.0.33, for Linux (x86_64)
--
-- Host: localhost    Database: recluter
-- ------------------------------------------------------
-- Server version	8.0.33-0ubuntu0.22.10.2

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
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `companies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `companies_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` VALUES (1,'Grupo Tecnolog','1676866184.png',0,'2023-03-17 02:07:36','2023-03-17 02:07:36','Maquinaria pesada'),(2,'Mercado Libre','1676930884.png',1,'2023-03-17 02:07:36','2023-03-17 02:07:36','Marketplace más grande de Latam'),(3,'Welivery','1679018880.png',0,'2023-03-17 02:08:00','2023-03-17 02:08:00','Empresa de logística de última milla.'),(5,'SOLVERY SRL','1679071013.jpg',0,'2023-03-17 16:36:53','2023-03-17 16:36:53','Solvery es una empresa hermosa'),(7,'Mercado Livre','1679327083.png',0,'2023-03-20 15:44:43','2023-03-20 15:44:43','Mercado Libre es una empresa multinacional argentina con sede en Buenos Aires y Montevideo y dedicada al comercio electrónico en Latinoamérica.'),(8,'Argus Diagnostico Medico','1679518996.jpeg',0,'2023-03-22 21:03:16','2023-03-22 21:03:16','Argus Diagnóstico Médico es una empresa orientada al cuidado de la salud cuyo propósito es lograr preferencia permanente por parte de los pacientes, brindando un servicio dotado de la última tecnología en Diagnóstico por imágenes como también la atención de personal altamente capacitado'),(9,'Gray Matter','1679652564.png',0,'2023-03-24 10:09:24','2023-03-24 10:09:24','AI startup builder'),(10,'Marco partners','1680277058.jpg',0,'2023-03-31 15:37:38','2023-03-31 15:37:38','Customer service'),(11,'The Collider','1680710228.png',0,'2023-04-05 15:57:08','2023-04-05 15:57:08','Programa de transferencia tecnológica y venture building que apoya a científicos con todo lo necesario para transformar ciencia y tecnología de laboratorio en startups deeptech listas para salir a mercado.'),(12,'TALENTO H','1681928802.png',0,'2023-04-19 18:26:42','2023-04-19 18:26:42','Empresa de reclutamiento para grandes corporaciones.'),(13,'RUANCO Consultora de RRHH','1682019811.png',0,'2023-04-20 19:43:31','2023-04-20 19:43:31','Consultora de RRHH');
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `interviews`
--

DROP TABLE IF EXISTS `interviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `interviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `position` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(1500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `company_id` bigint unsigned NOT NULL,
  `time_to_think` smallint NOT NULL,
  `time_to_reply` smallint NOT NULL,
  `goodbye` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `interviews_user_id_foreign` (`user_id`),
  KEY `interviews_company_id_foreign` (`company_id`),
  CONSTRAINT `interviews_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `interviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `interviews`
--

LOCK TABLES `interviews` WRITE;
/*!40000 ALTER TABLE `interviews` DISABLE KEYS */;
INSERT INTO `interviews` VALUES (1,'PHP Developer','Somos una consultora de Servicios IT con más de 14 años de experiencia en el mercado. Acompañamos a empresas líderes del mundo a conseguir soluciones de negocios a través de la innovación tecnológica. Asentados en la transformación Digital y Cultural ofrecemos nuestros servicios 100% remotos desde Argentina para el mundo. Te comparto nuestra web para que puedas conocernos un poco más: https://rh-t.com/es/inicio/\n            Actualmente nos encontramos en búsqueda de un Desarrollador PHP/Magento Semi Senior / Senior \n            📍 BUENOS AIRES, ARGENTINA.\n            👩🏻‍💻 Esquema Híbrido (Se asiste a las oficinas por reuniones esporádicas 1 vez cada 15 días)',2,1,12,12,'Gracias por responder el cuestionario! Cualquier novedad te la comunicaremos.','2023-03-17 02:07:36','2023-03-17 02:07:36'),(2,'Solution Sales','🚀¿Querés formar parte de la transformación digital y ser parte de proyectos desafiantes e innovadores?\n            💻 Nuestro equipo de Cloud Operations es responsable de los aspectos técnicos de la entrega e implementación de soluciones, hasta el éxito de las operaciones en vivo.\n            Buscamos profesionales que quieran acompañarnos en la realización y el mantenimiento de las operaciones, implementando soluciones de alojamiento escalables y de alto rendimiento utilizando tecnologías de nube pública y privada.',3,2,12,120,'Muchas Gracias! Te comunicaermos a la brevedad cualquier novedad acerca de tu aplicación.','2023-03-17 02:07:36','2023-03-17 02:07:36'),(4,'Prueba','Prueba',2,1,5,120,'PruebaPruebaPruebaPruebaPruebaPruebaPruebaPrueba','2023-03-17 19:06:23','2023-03-17 19:06:23'),(5,'Programador PHP','Desarrollador full stack full time 9 a 18hs.',14,7,5,30,'Felicitaciones, has completado la entrevista. Nos contactemos pronto.','2023-03-20 15:48:08','2023-03-20 15:48:08'),(6,'Recepcionista','Recepcion y admisión de pacientes',21,8,5,30,'Muchas gracias por participar en la primer etapa del proceso de selección','2023-03-22 21:10:28','2023-03-22 21:10:28'),(7,'Business Developer','Principales tareas:\r\n- Generación de leads\r\n- Prospección\r\n- Llamadas en fío\r\n- Reuniones con potenciales clientes\r\n- Generar continuamente nuevas oportunidades comerciales.\r\n- Evaluar y desarrollar nuevas unidades de negocio.\r\n- Confeccionar reportes comerciales y colaborar en los procesos vinculados a la gestión comercial.',6,3,5,120,'Muchas gracias, en caso de avanzar a la siguiente instancia, nos estaremos contactando.','2023-04-12 15:32:46','2023-04-12 15:32:46'),(8,'Analista de atención al cliente','Analista de atención al cliente',43,12,5,30,'Muchas gracias por tu tiempo!','2023-04-24 14:11:57','2023-04-24 14:11:57'),(9,'Business Developer / Ventas','Nos encontramos en la búsqueda de una persona para que nos ayude a concretar nuevas ventas B2B, tendrás el desafío de llevar a lo más alto el crecimiento de la empresa en Colombia.\r\n\r\nPrincipales tareas:\r\n\r\n- Generación de leads\r\n- Prospección\r\n- Llamadas en fío\r\n- Reuniones con potenciales clientes\r\n- Generar continuamente nuevas oportunidades comerciales.\r\n- Evaluar y desarrollar nuevas unidades de negocio.\r\n- Confeccionar reportes comerciales y colaborar en los procesos vinculados a la gestión comercial.',6,3,5,120,'Muchas gracias, en caso de avanzar a la siguiente instancia, nos estaremos contactando.','2023-04-24 14:42:24','2023-04-24 14:42:24');
/*!40000 ALTER TABLE `interviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2023_02_14_020606_create_companies_table',1),(6,'2023_02_14_020618_create_interviews_table',1),(7,'2023_02_14_020709_create_questions_table',1),(8,'2023_02_14_020733_create_question_answereds_table',1),(9,'2023_02_16_163008_add_description_to_companies_table',1),(10,'2023_02_16_205010_create_permission_tables',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1),(2,'App\\Models\\User',2),(2,'App\\Models\\User',3),(3,'App\\Models\\User',4),(3,'App\\Models\\User',5),(2,'App\\Models\\User',6),(2,'App\\Models\\User',7),(2,'App\\Models\\User',9),(2,'App\\Models\\User',10),(2,'App\\Models\\User',11),(2,'App\\Models\\User',14),(2,'App\\Models\\User',20),(2,'App\\Models\\User',21),(2,'App\\Models\\User',22),(2,'App\\Models\\User',23),(3,'App\\Models\\User',24),(3,'App\\Models\\User',25),(2,'App\\Models\\User',26),(2,'App\\Models\\User',27),(2,'App\\Models\\User',28),(2,'App\\Models\\User',29),(3,'App\\Models\\User',31),(3,'App\\Models\\User',32),(2,'App\\Models\\User',36),(3,'App\\Models\\User',37),(3,'App\\Models\\User',38),(3,'App\\Models\\User',41),(3,'App\\Models\\User',42),(2,'App\\Models\\User',43),(2,'App\\Models\\User',44),(2,'App\\Models\\User',48),(2,'App\\Models\\User',49),(2,'App\\Models\\User',56),(3,'App\\Models\\User',76),(3,'App\\Models\\User',77),(3,'App\\Models\\User',78),(3,'App\\Models\\User',79),(3,'App\\Models\\User',80),(3,'App\\Models\\User',81),(3,'App\\Models\\User',82),(3,'App\\Models\\User',83),(3,'App\\Models\\User',84),(3,'App\\Models\\User',85),(3,'App\\Models\\User',86),(3,'App\\Models\\User',87),(3,'App\\Models\\User',88),(3,'App\\Models\\User',89),(3,'App\\Models\\User',90),(3,'App\\Models\\User',91),(3,'App\\Models\\User',92),(3,'App\\Models\\User',93),(3,'App\\Models\\User',94),(3,'App\\Models\\User',95),(3,'App\\Models\\User',96),(3,'App\\Models\\User',97),(3,'App\\Models\\User',98),(2,'App\\Models\\User',99),(3,'App\\Models\\User',100);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('braia@argus.com.ar','$2y$10$UgfE06f6bR6/RpzPG6M/IuuZe09Mob9dWuQei30paH9O9dZvF0W8G','2023-03-27 16:14:38');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'admin.usuarios.index','web','2023-03-17 02:07:35','2023-03-17 02:07:35'),(2,'admin.usuarios.create','web','2023-03-17 02:07:35','2023-03-17 02:07:35'),(3,'admin.usuarios.edit','web','2023-03-17 02:07:35','2023-03-17 02:07:35'),(4,'admin.usuarios.destroy','web','2023-03-17 02:07:35','2023-03-17 02:07:35'),(5,'admin.empresas.index','web','2023-03-17 02:07:35','2023-03-17 02:07:35'),(6,'admin.empresas.create','web','2023-03-17 02:07:35','2023-03-17 02:07:35'),(7,'admin.empresas.edit','web','2023-03-17 02:07:35','2023-03-17 02:07:35'),(8,'admin.empresas.destroy','web','2023-03-17 02:07:35','2023-03-17 02:07:35'),(9,'admin.entrevistas.index','web','2023-03-17 02:07:35','2023-03-17 02:07:35'),(10,'admin.entrevistas.create','web','2023-03-17 02:07:35','2023-03-17 02:07:35'),(11,'admin.entrevistas.edit','web','2023-03-17 02:07:35','2023-03-17 02:07:35'),(12,'admin.entrevistas.destroy','web','2023-03-17 02:07:35','2023-03-17 02:07:35'),(13,'admin.cuestionarios.index','web','2023-03-17 02:07:35','2023-03-17 02:07:35'),(14,'admin.cuestionarios.create','web','2023-03-17 02:07:35','2023-03-17 02:07:35'),(15,'admin.cuestionarios.edit','web','2023-03-17 02:07:35','2023-03-17 02:07:35'),(16,'admin.cuestionarios.destroy','web','2023-03-17 02:07:36','2023-03-17 02:07:36');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question_answereds`
--

DROP TABLE IF EXISTS `question_answereds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `question_answereds` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `question_id` bigint unsigned NOT NULL,
  `answer` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `question_answereds_user_id_foreign` (`user_id`),
  KEY `question_answereds_question_id_foreign` (`question_id`),
  CONSTRAINT `question_answereds_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `question_answereds_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=230 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question_answereds`
--

LOCK TABLES `question_answereds` WRITE;
/*!40000 ALTER TABLE `question_answereds` DISABLE KEYS */;
INSERT INTO `question_answereds` VALUES (28,24,26,'1679950771.webm','2023-03-27 20:59:56','2023-03-27 20:59:56'),(29,24,27,'1679950796.webm','2023-03-27 21:00:26','2023-03-27 21:00:26'),(30,24,28,'1679950826.webm','2023-03-27 21:01:06','2023-03-27 21:01:06'),(31,24,29,'1679950866.webm','2023-03-27 21:01:49','2023-03-27 21:01:49'),(32,24,30,'1679950909.webm','2023-03-27 21:02:31','2023-03-27 21:02:31'),(33,24,26,'1679952293.webm','2023-03-27 21:25:19','2023-03-27 21:25:19'),(34,24,27,'1679952319.webm','2023-03-27 21:25:57','2023-03-27 21:25:57'),(35,24,28,'1679952357.webm','2023-03-27 21:26:37','2023-03-27 21:26:37'),(36,24,29,'1679952397.webm','2023-03-27 21:27:20','2023-03-27 21:27:20'),(37,24,30,'1679952440.webm','2023-03-27 21:27:57','2023-03-27 21:27:57'),(38,25,26,'1679962003.webm','2023-03-28 00:07:08','2023-03-28 00:07:08'),(39,25,27,'1679962028.webm','2023-03-28 00:07:35','2023-03-28 00:07:35'),(40,25,28,'1679962055.webm','2023-03-28 00:08:12','2023-03-28 00:08:12'),(41,25,29,'1679962092.webm','2023-03-28 00:08:46','2023-03-28 00:08:46'),(45,25,30,'1679962269.webm','2023-03-28 00:11:45','2023-03-28 00:11:45'),(64,11,31,'1681834399.webm','2023-04-18 16:13:40','2023-04-18 16:13:40'),(65,11,32,'1681834420.webm','2023-04-18 16:14:02','2023-04-18 16:14:02'),(124,76,41,'1683322896.webm','2023-05-05 21:43:54','2023-05-05 21:43:54'),(125,76,42,'1683323034.webm','2023-05-05 21:46:08','2023-05-05 21:46:08'),(126,76,43,'1683323168.webm','2023-05-05 21:48:23','2023-05-05 21:48:23'),(127,76,44,'1683323303.webm','2023-05-05 21:50:39','2023-05-05 21:50:39'),(128,76,45,'1683323439.webm','2023-05-05 21:52:55','2023-05-05 21:52:55'),(129,78,41,'1683328219.webm','2023-05-05 23:12:02','2023-05-05 23:12:02'),(130,78,42,'1683328322.webm','2023-05-05 23:12:37','2023-05-05 23:12:37'),(131,78,43,'1683328357.webm','2023-05-05 23:14:15','2023-05-05 23:14:15'),(132,78,44,'1683328455.webm','2023-05-05 23:15:36','2023-05-05 23:15:36'),(133,78,45,'1683328536.webm','2023-05-05 23:16:36','2023-05-05 23:16:36'),(134,77,41,'1683330011.webm','2023-05-05 23:41:11','2023-05-05 23:41:11'),(135,79,41,'1683330042.webm','2023-05-05 23:41:34','2023-05-05 23:41:34'),(136,77,42,'1683330071.webm','2023-05-05 23:42:01','2023-05-05 23:42:01'),(137,77,43,'1683330121.webm','2023-05-05 23:42:53','2023-05-05 23:42:53'),(138,77,44,'1683330173.webm','2023-05-05 23:43:47','2023-05-05 23:43:47'),(139,77,45,'1683330227.webm','2023-05-05 23:44:34','2023-05-05 23:44:34'),(140,80,41,'1683330339.webm','2023-05-05 23:46:45','2023-05-05 23:46:45'),(141,80,42,'1683330406.webm','2023-05-05 23:47:45','2023-05-05 23:47:45'),(142,80,43,'1683330465.webm','2023-05-05 23:48:55','2023-05-05 23:48:55'),(143,80,44,'1683330535.webm','2023-05-05 23:50:10','2023-05-05 23:50:10'),(144,80,45,'1683330610.webm','2023-05-05 23:51:31','2023-05-05 23:51:31'),(145,81,41,'1683331989.webm','2023-05-06 00:14:31','2023-05-06 00:14:31'),(146,81,42,'1683332071.webm','2023-05-06 00:15:36','2023-05-06 00:15:36'),(147,81,43,'1683332136.webm','2023-05-06 00:17:02','2023-05-06 00:17:02'),(148,81,44,'1683332222.webm','2023-05-06 00:18:41','2023-05-06 00:18:41'),(149,81,45,'1683332321.webm','2023-05-06 00:20:23','2023-05-06 00:20:23'),(150,82,41,'1683336224.webm','2023-05-06 01:26:23','2023-05-06 01:26:23'),(151,82,42,'1683336383.webm','2023-05-06 01:27:52','2023-05-06 01:27:52'),(152,82,43,'1683336472.webm','2023-05-06 01:30:02','2023-05-06 01:30:02'),(153,82,44,'1683336602.webm','2023-05-06 01:32:05','2023-05-06 01:32:05'),(154,82,45,'1683336725.webm','2023-05-06 01:33:16','2023-05-06 01:33:16'),(155,83,41,'1683390933.webm','2023-05-06 16:36:28','2023-05-06 16:36:28'),(156,83,42,'1683390988.webm','2023-05-06 16:37:19','2023-05-06 16:37:19'),(157,83,43,'1683391039.webm','2023-05-06 16:38:08','2023-05-06 16:38:08'),(158,83,44,'1683391088.webm','2023-05-06 16:38:48','2023-05-06 16:38:48'),(159,83,45,'1683391128.webm','2023-05-06 16:39:31','2023-05-06 16:39:31'),(160,84,41,'1683392389.webm','2023-05-06 17:01:41','2023-05-06 17:01:41'),(161,84,42,'1683392501.webm','2023-05-06 17:03:33','2023-05-06 17:03:33'),(162,84,43,'1683392613.webm','2023-05-06 17:05:45','2023-05-06 17:05:45'),(163,84,44,'1683392745.webm','2023-05-06 17:06:56','2023-05-06 17:06:56'),(164,84,45,'1683392816.webm','2023-05-06 17:08:28','2023-05-06 17:08:28'),(165,85,41,'1683427931.webm','2023-05-07 02:54:19','2023-05-07 02:54:19'),(166,85,42,'1683428059.webm','2023-05-07 02:55:16','2023-05-07 02:55:16'),(167,85,43,'1683428116.webm','2023-05-07 02:57:19','2023-05-07 02:57:19'),(168,85,44,'1683428239.webm','2023-05-07 02:59:10','2023-05-07 02:59:10'),(169,85,45,'1683428350.webm','2023-05-07 03:01:16','2023-05-07 03:01:16'),(170,87,41,'1683490667.webm','2023-05-07 20:18:49','2023-05-07 20:18:49'),(171,87,42,'1683490729.webm','2023-05-07 20:19:33','2023-05-07 20:19:33'),(172,88,41,'1683552694.webm','2023-05-08 13:33:19','2023-05-08 13:33:19'),(173,88,42,'1683552799.webm','2023-05-08 13:34:13','2023-05-08 13:34:13'),(174,88,43,'1683552853.webm','2023-05-08 13:35:42','2023-05-08 13:35:42'),(175,88,44,'1683552942.webm','2023-05-08 13:37:31','2023-05-08 13:37:31'),(176,88,45,'1683553051.webm','2023-05-08 13:39:27','2023-05-08 13:39:27'),(177,89,41,'1683555302.webm','2023-05-08 14:16:53','2023-05-08 14:16:53'),(178,89,42,'1683555413.webm','2023-05-08 14:17:50','2023-05-08 14:17:50'),(179,86,41,'1683566007.webm','2023-05-08 17:14:00','2023-05-08 17:14:00'),(180,86,42,'1683566040.webm','2023-05-08 17:14:33','2023-05-08 17:14:33'),(181,90,41,'1683569118.webm','2023-05-08 18:07:34','2023-05-08 18:07:34'),(182,90,42,'1683569254.webm','2023-05-08 18:08:30','2023-05-08 18:08:30'),(183,90,43,'1683569310.webm','2023-05-08 18:10:41','2023-05-08 18:10:41'),(184,90,44,'1683569441.webm','2023-05-08 18:11:48','2023-05-08 18:11:48'),(185,90,45,'1683569508.webm','2023-05-08 18:13:27','2023-05-08 18:13:27'),(186,91,41,'1683572282.webm','2023-05-08 19:01:00','2023-05-08 19:01:00'),(187,91,42,'1683572460.webm','2023-05-08 19:02:28','2023-05-08 19:02:28'),(188,91,43,'1683572548.webm','2023-05-08 19:04:12','2023-05-08 19:04:12'),(189,91,44,'1683572652.webm','2023-05-08 19:06:02','2023-05-08 19:06:02'),(190,91,45,'1683572762.webm','2023-05-08 19:07:35','2023-05-08 19:07:35'),(191,92,41,'1683578529.webm','2023-05-08 20:43:50','2023-05-08 20:43:50'),(192,92,42,'1683578630.webm','2023-05-08 20:44:31','2023-05-08 20:44:31'),(193,92,43,'1683578671.webm','2023-05-08 20:45:15','2023-05-08 20:45:15'),(194,92,44,'1683578715.webm','2023-05-08 20:45:49','2023-05-08 20:45:49'),(195,92,45,'1683578749.webm','2023-05-08 20:46:37','2023-05-08 20:46:37'),(196,93,41,'1683579828.webm','2023-05-08 21:04:22','2023-05-08 21:04:22'),(197,93,42,'1683579862.webm','2023-05-08 21:05:36','2023-05-08 21:05:36'),(198,93,43,'1683579936.webm','2023-05-08 21:07:11','2023-05-08 21:07:11'),(199,93,44,'1683580031.webm','2023-05-08 21:08:51','2023-05-08 21:08:51'),(200,94,41,'1683651987.webm','2023-05-09 17:07:18','2023-05-09 17:07:18'),(201,94,42,'1683652038.webm','2023-05-09 17:08:42','2023-05-09 17:08:42'),(202,94,43,'1683652122.webm','2023-05-09 17:10:37','2023-05-09 17:10:37'),(203,94,44,'1683652237.webm','2023-05-09 17:12:32','2023-05-09 17:12:32'),(204,94,45,'1683652352.webm','2023-05-09 17:14:20','2023-05-09 17:14:20'),(205,95,41,'1683681460.webm','2023-05-10 01:21:14','2023-05-10 01:21:14'),(206,95,42,'1683681674.webm','2023-05-10 01:23:55','2023-05-10 01:23:55'),(207,95,43,'1683681835.webm','2023-05-10 01:27:35','2023-05-10 01:27:35'),(208,95,44,'1683682055.webm','2023-05-10 01:30:49','2023-05-10 01:30:49'),(209,95,45,'1683682249.webm','2023-05-10 01:33:21','2023-05-10 01:33:21'),(210,96,41,'1683688101.webm','2023-05-10 03:09:26','2023-05-10 03:09:26'),(211,96,42,'1683688166.webm','2023-05-10 03:10:15','2023-05-10 03:10:15'),(212,96,43,'1683688215.webm','2023-05-10 03:11:38','2023-05-10 03:11:38'),(213,96,44,'1683688298.webm','2023-05-10 03:12:42','2023-05-10 03:12:42'),(214,96,45,'1683688362.webm','2023-05-10 03:14:00','2023-05-10 03:14:00'),(215,97,41,'1683731888.webm','2023-05-10 15:19:02','2023-05-10 15:19:02'),(216,97,42,'1683731942.webm','2023-05-10 15:19:32','2023-05-10 15:19:32'),(217,97,43,'1683731972.webm','2023-05-10 15:20:24','2023-05-10 15:20:24'),(218,97,44,'1683732024.webm','2023-05-10 15:20:49','2023-05-10 15:20:49'),(219,97,45,'1683732049.webm','2023-05-10 15:21:27','2023-05-10 15:21:27'),(220,98,41,'1683734021.webm','2023-05-10 15:54:16','2023-05-10 15:54:16'),(221,98,42,'1683734056.webm','2023-05-10 15:54:59','2023-05-10 15:54:59'),(222,98,43,'1683734099.webm','2023-05-10 15:56:02','2023-05-10 15:56:02'),(223,98,44,'1683734162.webm','2023-05-10 15:56:49','2023-05-10 15:56:49'),(224,98,45,'1683734209.webm','2023-05-10 15:57:41','2023-05-10 15:57:41'),(225,100,41,'1684359988.webm','2023-05-17 21:47:17','2023-05-17 21:47:17'),(226,100,42,'1684360037.webm','2023-05-17 21:47:53','2023-05-17 21:47:53'),(227,100,43,'1684360073.webm','2023-05-17 21:48:46','2023-05-17 21:48:46'),(228,100,44,'1684360126.webm','2023-05-17 21:49:47','2023-05-17 21:49:47'),(229,100,45,'1684360187.webm','2023-05-17 21:50:58','2023-05-17 21:50:58');
/*!40000 ALTER TABLE `question_answereds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `questions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `interview_id` bigint unsigned NOT NULL,
  `video` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `questions_interview_id_foreign` (`interview_id`),
  CONSTRAINT `questions_interview_id_foreign` FOREIGN KEY (`interview_id`) REFERENCES `interviews` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (1,'Cuéntanos un poco de tí.',1,1,'2023-03-17 02:07:36','2023-03-17 02:07:36'),(2,'¿Tienes experiencia en PHP? Nombre los frameworks que ha utilizado.',1,1,'2023-03-17 02:07:36','2023-03-17 02:07:36'),(3,'¿Sabes lo que es PHP Unit?',1,0,'2023-03-17 02:07:36','2023-03-17 02:07:36'),(4,'¿Qué otros lenguajes conoces?',1,0,'2023-03-17 02:07:36','2023-03-17 02:07:36'),(5,'¿Tienes estudios?',1,0,'2023-03-17 02:07:36','2023-03-17 02:07:36'),(6,'¿Tenés experiencia en el rubro?',2,0,'2023-03-17 02:07:36','2023-03-17 02:07:36'),(7,'Vendeme un lápiz.',2,1,'2023-03-17 02:07:36','2023-03-17 02:07:36'),(8,'¿Qué es la oferta y demanda?',2,1,'2023-03-17 02:07:36','2023-03-17 02:07:36'),(9,'Remuneración pretendida:',2,0,'2023-03-17 02:07:36','2023-03-17 02:07:36'),(10,'¿Por qué deberíamos contratarte?',2,1,'2023-03-17 02:07:36','2023-03-17 02:07:36'),(16,'Prueba',4,1,'2023-03-17 19:06:23','2023-03-17 19:06:23'),(17,'PruebaPrueba',4,0,'2023-03-17 19:06:23','2023-03-17 19:06:23'),(18,'PruebaPruebaPrueba',4,1,'2023-03-17 19:06:23','2023-03-17 19:06:23'),(19,'PruebaPruebaPruebaPrueba',4,0,'2023-03-17 19:06:23','2023-03-17 19:06:23'),(20,'PruebaPruebaPruebaPruebaPrueba',4,1,'2023-03-17 19:06:23','2023-03-17 19:06:23'),(21,'Háblame de ti.',5,1,'2023-03-20 15:48:08','2023-03-20 15:48:08'),(22,'Remuneración bruta pretendida',5,0,'2023-03-20 15:48:08','2023-03-20 15:48:08'),(23,'Escribir codigo \"Hola Mundo\" en java script',5,0,'2023-03-20 15:48:08','2023-03-20 15:48:08'),(24,'Cuantos dedos tengo',5,1,'2023-03-20 15:48:08','2023-03-20 15:48:08'),(25,'Nombre perro favorito',5,1,'2023-03-20 15:48:08','2023-03-20 15:48:08'),(26,'Participaste en algun proceso de selección en Argus Diagnostico Medico?',6,1,'2023-03-22 21:10:28','2023-03-22 21:10:28'),(27,'Cual es tu formación academica actual?',6,1,'2023-03-22 21:10:28','2023-03-22 21:10:28'),(28,'Que caracteristica tuya consideras que te hace el candidato ideal?',6,1,'2023-03-22 21:10:28','2023-03-22 21:10:28'),(29,'Qué rol ocupas en tu grupo de amigos?',6,1,'2023-03-22 21:10:28','2023-03-22 21:10:28'),(30,'Cuales son tus expectativas laborales?',6,1,'2023-03-22 21:10:28','2023-03-22 21:10:28'),(31,'Háblame de ti.',7,1,'2023-04-12 15:32:46','2023-04-12 15:32:46'),(32,'¿Por qué se encuentra interesado en una posición part-time (20hs semanales)?',7,1,'2023-04-12 15:32:46','2023-04-12 15:32:46'),(33,'¿Por qué un extranjero debería visitar su país? Venda su país a un potencial turista.',7,1,'2023-04-12 15:32:46','2023-04-12 15:32:46'),(34,'¿Cuáles piensa que son las principales aptitudes de un buen vendedor?',7,1,'2023-04-12 15:32:46','2023-04-12 15:32:46'),(35,'¿Qué te hace diferente de otros candidatos?',7,1,'2023-04-12 15:32:46','2023-04-12 15:32:46'),(36,'La posicion puede tener un parte a cubrir con horarios rotativos, ¿esto supondria algun inconveniente para ti?',8,0,'2023-04-24 14:11:57','2023-04-24 14:11:57'),(37,'¿Qué habilidades crees que son esenciales para tener éxito en un papel de Customer Experience?',8,1,'2023-04-24 14:11:57','2023-04-24 14:11:57'),(38,'¿Cómo manejarías una situación en la que un cliente está insatisfecho con el servicio?',8,1,'2023-04-24 14:11:57','2023-04-24 14:11:57'),(39,'¿Que nivel tienes en el manejo de herramientas informaticas?',8,0,'2023-04-24 14:11:57','2023-04-24 14:11:57'),(40,'¿Cuentas con toda la documentacion en regla para comenzar a trabajar?',8,0,'2023-04-24 14:11:57','2023-04-24 14:11:57'),(41,'Háblame de ti.',9,1,'2023-04-24 14:42:24','2023-04-24 14:42:24'),(42,'¿Por qué se encuentra interesado en una posición part-time (20hs semanales)?',9,1,'2023-04-24 14:42:24','2023-04-24 14:42:24'),(43,'¿Por qué un extranjero debería visitar su país? Venda su país a un potencial turista.',9,1,'2023-04-24 14:42:24','2023-04-24 14:42:24'),(44,'¿Cuáles piensa que son las principales aptitudes de un buen vendedor?',9,1,'2023-04-24 14:42:24','2023-04-24 14:42:24'),(45,'¿Qué te hace diferente de otros candidatos?',9,1,'2023-04-24 14:42:24','2023-04-24 14:42:24');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(12,1),(13,1),(14,1),(15,1),(16,1),(5,2),(7,2),(9,2),(10,2),(11,2),(12,2),(13,2),(14,2),(15,2),(16,2);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin','web','2023-03-17 02:07:35','2023-03-17 02:07:35'),(2,'Recluter','web','2023-03-17 02:07:35','2023-03-17 02:07:35'),(3,'Candidate','web','2023-03-17 02:07:35','2023-03-17 02:07:35');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domicile` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `company_id` bigint unsigned DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Administrator',NULL,NULL,NULL,NULL,NULL,'admin@example.com',NULL,'$2y$10$0uYRnJYUZcyF4q1nU0328Ocg6vCDbMt6J5OWUvPYigpRHJAyjAEK2','aY0NfcmEk3suMyVnwe0CSKICUCfY7uinwDJApSXjbAQZkOGRqwH4SmIXnx52','2023-03-17 02:07:36','2023-03-17 02:07:36'),(2,'Recluter',NULL,NULL,NULL,NULL,1,'recluter@example.com',NULL,'$2y$10$ANVeQsXjc/9hCuxqcq6vEu/CMf5Z8G7sUCez2kPkp57Y36p6jIs9.','K24BBJiT8WYvdIGfQaMjdb6BgUjpAa9xXmj4OzgmI8zo7JvpLKvwyNwLkr6r','2023-03-17 02:07:36','2023-03-17 02:07:36'),(3,'Recluter2',NULL,NULL,NULL,NULL,2,'recluter2@example.com',NULL,'$2y$10$6ZwoQlGAI.s.hSNrDq09YuzPTXkmFSgAoRtw/WBciPpgNc6etp.2W',NULL,'2023-03-17 02:07:36','2023-03-17 02:07:36'),(4,'Candidate',NULL,NULL,NULL,NULL,NULL,'candidate@example.com',NULL,'$2y$10$J8eHuPtMWPE10.ctT1wiwu.nDDQXcH7GKBQeNW0ytZVCi10MDerjG',NULL,'2023-03-17 02:07:36','2023-03-17 02:07:36'),(5,'Candidate2',NULL,NULL,NULL,NULL,NULL,'candidate2@example.com',NULL,'$2y$10$PWxZNia0bbS6HJ4LnM9f8.a7dK99yZscYqKSs2OmIhFbOObsENk8q',NULL,'2023-03-17 02:07:36','2023-03-17 02:07:36'),(6,'Welivery',NULL,NULL,NULL,NULL,3,'admin@welivery.com.ar',NULL,'$2y$10$BwlKaPmGUGCMxEmF17unouzwE2fd14JUU0RhUvWB17WNHj0pWUlp.',NULL,'2023-03-17 02:07:41','2023-03-17 02:08:00'),(9,'JUAN BARREIRO',NULL,NULL,NULL,NULL,NULL,'juanbarreiro@welivery.com.ar',NULL,'$2y$10$OpZe6m33shyk91um0yDZbOkrODudRfuIt1K9JJgdqkwIMjlnXrS1G',NULL,'2023-03-17 16:27:48','2023-03-17 16:27:48'),(10,'JUAN BARREIRO',NULL,NULL,NULL,NULL,5,'juanbarreiro@solvery.com.ar',NULL,'$2y$10$zExRK8pv4SS96i2ZnM5HDOyVwyQZUx1Tcsek27vO98xBU4YKdp9Na',NULL,'2023-03-17 16:34:11','2023-03-17 16:36:53'),(11,'Pedro prueba','probando','Amenabar 661 3B CABA',NULL,NULL,3,'pedrog@gmail.com',NULL,'$2y$10$yGAuB.1ONE5qux.qCyM3COtQ0ye/hjM8lBOyZNP1l4O.jc9J.XV9m',NULL,'2023-03-17 16:34:25','2023-04-18 16:13:19'),(14,'Marcos Galperin',NULL,NULL,NULL,NULL,7,'marcos@mercadolibre.com',NULL,'$2y$10$VLV.6ICF2LsEGZk8TL2cP.sfkyOu9i65F0VDS1NsjKRf0PEblwFta',NULL,'2023-03-20 15:41:03','2023-03-20 15:44:43'),(20,'Fiorella',NULL,NULL,NULL,NULL,NULL,'fiorella.avegliano@gmail.com',NULL,'$2y$10$fENfcYzHRLr/8hI9qTfZYuFFe.g2p4f0gMDOZ/2/W6iQwshsmHFWe',NULL,'2023-03-22 14:50:41','2023-03-22 14:50:41'),(21,'Barbara Raia',NULL,NULL,NULL,NULL,8,'braia@argus.com.ar',NULL,'$2y$10$zOoDh3P8dC5mx.r0Wrr98.BK7mBQCJQIbmG3UkvuwpgySGxqenhe6',NULL,'2023-03-22 21:02:00','2023-03-22 21:03:16'),(22,'Joaquin Torroba',NULL,NULL,NULL,NULL,9,'joaquintorroba@gmail.com',NULL,'$2y$10$2YGJQXUrkDW90vksJGS4M.ahZld03FfSiGAF4IrTLM6SLmf8gCpUa',NULL,'2023-03-24 10:08:40','2023-03-24 10:09:24'),(23,'mwnDjNJVFcg',NULL,NULL,NULL,NULL,NULL,'KerilynBorelli86@aol.com',NULL,'$2y$10$zro9mBY5vtS5B6/.O7VB7ujoQ59MBDpAR6gEUWGDVuMxRjAB6Su7u',NULL,'2023-03-27 05:41:17','2023-03-27 05:41:17'),(24,'JORGE LUIS','GONZALEZ','Tomas Anchorena 543 CABA','1139576169','1994-11-03',8,'jorge_gonzalez0394@hotmail.com',NULL,NULL,NULL,'2023-03-27 20:59:31','2023-03-27 21:24:53'),(25,'Tomás','Quesada','Moldes 2032','1169389724','1996-11-02',8,'tomasquesada4@gmail.com',NULL,NULL,NULL,'2023-03-28 00:06:43','2023-03-28 00:06:43'),(26,'Marco',NULL,NULL,NULL,NULL,10,'marcobuscetti@gmail.com',NULL,'$2y$10$Cfxv8UJ4DVEhqnZNmlkgkO2NZ5bfWel29W84M5U5lxz4E/80CozWm',NULL,'2023-03-31 15:36:31','2023-03-31 15:37:38'),(27,'ZXJaGzQgubLeIk',NULL,NULL,NULL,NULL,NULL,'malyerafod@outlook.com',NULL,'$2y$10$G8cKdnEGhYkVbBZCg7hj1..gKAizr/i.VjHRI.z2T5tr3a4caZ5kW',NULL,'2023-04-03 05:25:54','2023-04-03 05:25:54'),(28,'Suyai Michelet',NULL,NULL,NULL,NULL,NULL,'suyai.michelet@powen.es',NULL,'$2y$10$AYN1qea6RqZ2qy8tIAuwIO2laaaIkGMPjkXc232E.9OtjX9GUNrJK',NULL,'2023-04-04 12:34:25','2023-04-04 12:34:25'),(29,'Consuelo Rebolledo',NULL,NULL,NULL,NULL,11,'consuelo.mcrl@gmail.com',NULL,'$2y$10$BBHk4ehgzTzXNcwCmYpNmeDyMHJJ5IM15BtTUs64xO/6uLooAUO12',NULL,'2023-04-05 15:52:01','2023-04-05 15:57:08'),(36,'KRDNmHTEW',NULL,NULL,NULL,NULL,NULL,'NeelyCoward799@yahoo.com',NULL,'$2y$10$.3eqwoJs0lUBrfEGFUcgmezgPGr.bE0npPLJh70xjpJVMAxlRLNRu',NULL,'2023-04-18 16:19:32','2023-04-18 16:19:32'),(43,'Marco AXA',NULL,NULL,NULL,NULL,12,'marcobuscetti+1@gmail.com',NULL,'$2y$10$SiR8tmRkcSAtfnJU2L8Kw.qObz6uncKbtxquJEMrZmdsePSox4.Lu',NULL,'2023-04-19 18:25:10','2023-04-19 18:26:42'),(44,'Agustina',NULL,NULL,NULL,NULL,13,'agustina@ruanco.com.ar',NULL,'$2y$10$wtDT/PQ/zTUFs4uTdp/XWOiqs.kuc4.6AZKeq6igqouAUcjm3PTyK',NULL,'2023-04-20 19:41:21','2023-04-20 19:43:31'),(48,'sjKtlbdp',NULL,NULL,NULL,NULL,NULL,'yukbetotaw@outlook.com',NULL,'$2y$10$NzxUyeSRVRumcET5w7ojP.tkPeyKdMNLblV5ZXdUb9qgNwu6BH24u',NULL,'2023-04-27 14:50:16','2023-04-27 14:50:16'),(49,'aOjxcyoiV',NULL,NULL,NULL,NULL,NULL,'KatheCastleberry360@aol.com',NULL,'$2y$10$ZbCoYayc2hB2MAE.ZzMZ5ugJImwaf18/tAdega8t8VkcnG2SLp.om',NULL,'2023-05-01 19:43:03','2023-05-01 19:43:03'),(56,'David Muñoz',NULL,NULL,NULL,NULL,NULL,'rauldavidnacional10@gmail.com',NULL,'$2y$10$L6fbik4tqTcETNbrnYWMvewVOA91w7ZE8JjSys4MZfsn59meow7n2',NULL,'2023-05-03 09:18:52','2023-05-03 09:18:52'),(76,'Ana Sofia','Aparicio Amaya','calarca- Quindio. Colombia','3012023028','2003-06-23',3,'anasofiaaparicioamaya@gmail.com',NULL,NULL,NULL,'2023-05-05 21:41:36','2023-05-05 21:41:36'),(77,'Johan Santiago','Jimenez Buitrago','Carrera 12 bis # 34 c 17 sur','3023917080','1998-05-26',3,'santiagojimenez2698@gmail.com',NULL,NULL,NULL,'2023-05-05 23:00:58','2023-05-05 23:00:58'),(78,'Karen Daniela','Gomez Tobo','Cra 79 #19A-56','3103066078','2002-06-03',3,'danigomez291013@hotmail.com',NULL,NULL,NULL,'2023-05-05 23:10:19','2023-05-05 23:10:19'),(79,'Marcela','Duque Zuluaga','calle 17 # 8 04 este','3023054429','1988-03-12',3,'mduquezulu@gmail.com',NULL,NULL,NULL,'2023-05-05 23:40:42','2023-05-05 23:40:42'),(80,'genesis','gonzalez','calle 87 #77c-95','3188136974','1997-07-18',3,'cmgenesisgonzalez@gmail.com',NULL,NULL,NULL,'2023-05-05 23:45:39','2023-05-05 23:45:39'),(81,'Jessica','Guerrero','Carrera 11 #140-41','573228699948','1985-11-20',3,'jessiguerreromarketing@gmail.com',NULL,NULL,NULL,'2023-05-06 00:13:09','2023-05-06 00:13:09'),(82,'Dana','Porras','Bogotá','3227493596','1999-04-30',3,'danapoma@unisabana.edu.co',NULL,NULL,NULL,'2023-05-06 01:23:44','2023-05-06 01:23:44'),(83,'lina maria','martinez plata','carrera 8 n 9 53','3175950548','1992-12-15',3,'linammplata@gmail.com',NULL,NULL,NULL,'2023-05-06 16:35:33','2023-05-06 16:35:33'),(84,'Daniel Felipe','Rojas Martinez','calle 151 #56a-70','3128377483','2001-09-02',3,'dfrm2001@gmail.com',NULL,NULL,NULL,'2023-05-06 16:58:55','2023-05-06 16:58:55'),(85,'Julian David','Garzon Ramirez','Calle 15a # 0 - 57 este Soacha, Cundinamarca, Colombia','3135057330','2000-08-20',3,'julian.g4rzon@gmail.com',NULL,NULL,NULL,'2023-05-07 02:52:10','2023-05-07 02:52:10'),(86,'Jorge','González','carrera 78c sur 65f - 16','3125692571','2004-03-14',3,'gonj254@gmail.com',NULL,NULL,NULL,'2023-05-07 19:27:50','2023-05-08 17:13:27'),(87,'YESSICA','GOMEZ','Cra79b #6a-29','573144533745','1996-10-08',3,'jessicagomez552@gmail.com',NULL,NULL,NULL,'2023-05-07 20:17:47','2023-05-07 20:17:47'),(88,'Miguel Angel','Sierra','Bogotá D.C','3214459011','1994-05-07',3,'sierraacosta08@gmail.com',NULL,NULL,NULL,'2023-05-08 13:31:33','2023-05-08 13:31:33'),(89,'Alejandro','Lopez Bautista','carrera 4 este # 36-88','3175786503','1994-05-28',3,'alopezb94@gmail.com',NULL,NULL,NULL,'2023-05-08 14:09:58','2023-05-08 14:09:58'),(90,'JOSE MAURICIO','TINJACA NIÑO','Bogota-Colombia','3166929944','1994-11-25',3,'jmtn1994@hotmail.com',NULL,NULL,NULL,'2023-05-08 18:05:18','2023-05-08 18:05:18'),(91,'raul david','Muñoz Ramos','Bogota cra 92 71 a 53','3106482779','2000-04-27',3,'rauldavid2704@gmail.com',NULL,NULL,NULL,'2023-05-08 18:49:55','2023-05-08 18:49:55'),(92,'Daniel','Fernandez chavez','calle 22h # 104b 51','3244625887','1996-01-20',3,'Daniel.f.ch@outlook.com',NULL,NULL,NULL,'2023-05-08 20:42:09','2023-05-08 20:42:09'),(93,'Daniel Mauricio','Sabogal Ocampo','Calle 137 88 76 In 1 408','3027755928','1986-01-01',3,'danielmauriciosabogal1@gmail.com',NULL,NULL,NULL,'2023-05-08 21:03:48','2023-05-08 21:03:48'),(94,'Daniel Mauricio','Sabogal Ocampo','Calle 137 88 76 In 1 408','3027755928','1986-01-01',3,'danielmauriciosaboga1@gmail.com',NULL,NULL,NULL,'2023-05-09 17:06:27','2023-05-09 17:06:27'),(95,'Mery Yuliana','Cárdenas Durango','Parque Industrial, Pereira.','3226207006','1992-02-19',3,'yulianac.d@hotmail.com',NULL,NULL,NULL,'2023-05-10 01:14:47','2023-05-10 01:14:47'),(96,'Carlina Yaneth','Pérez Noriega','Barranquilla - Colombia','573014441098','1991-01-07',3,'carlinaperez13@gmail.com',NULL,NULL,NULL,'2023-05-10 03:08:21','2023-05-10 03:08:21'),(97,'Laura Andrea','González García','Carrera 32 # 30A - 67 piso 2','3217049527','1994-05-06',3,'gonzalezlaura.0694@gmail.com',NULL,NULL,NULL,'2023-05-10 15:17:34','2023-05-10 15:17:34'),(98,'Melisa ¿','Londoño','Rio vivo','3107196601','1992-12-28',3,'melisalondono12@gmail.com',NULL,NULL,NULL,'2023-05-10 15:53:41','2023-05-10 15:53:41'),(99,'hvTZnoYCkswNBKL',NULL,NULL,NULL,NULL,NULL,'qiwtewesen@outlook.com',NULL,'$2y$10$Ok17dKhCbevX5azKUbmKNuBNMM.l7K9EL5Rb3P8sQvIUn46rVYtIC',NULL,'2023-05-13 13:42:18','2023-05-13 13:42:18'),(100,'Manuela','Álvarez Acevedo','Carrera 78 A #52 sue 76, torre 5, apto 101','3022723991','1997-03-20',3,'manuela.alvarez.0320@gmail.com',NULL,NULL,NULL,'2023-05-17 21:45:36','2023-05-17 21:45:36');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-05-29 14:32:30
