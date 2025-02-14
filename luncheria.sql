DROP DATABASE luncheria_db;

CREATE DATABASE IF NOT EXISTS `luncheria_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;

USE luncheria_db;

DROP TABLE IF EXISTS `estados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estados` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_estado` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `iso_3166-2` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

LOCK TABLES `estados` WRITE;
INSERT INTO `estados`  VALUES (1,'Amazonas','VE-X'),(2,'Anzoátegui','VE-B'),(3,'Apure','VE-C'),(4,'Aragua','VE-D'),(5,'Barinas','VE-E'),(6,'Bolívar','VE-F'),(7,'Carabobo','VE-G'),(8,'Cojedes','VE-H'),(9,'Delta Amacuro','VE-Y'),(10,'Falcón','VE-I'),(11,'Guárico','VE-J'),(12,'Lara','VE-K'),(13,'Mérida','VE-L'),(14,'Miranda','VE-M'),(15,'Monagas','VE-N'),(16,'Nueva Esparta','VE-O'),(17,'Portuguesa','VE-P'),(18,'Sucre','VE-R'),(19,'Táchira','VE-S'),(20,'Trujillo','VE-T'),(21,'La Guaira','VE-W'),(22,'Yaracuy','VE-U'),(23,'Zulia','VE-V'),(24,'Distrito Capital','VE-A'),(25,'Dependencias Federales','VE-Z');
UNLOCK TABLES;


DROP TABLE IF EXISTS `municipios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `municipios` (
  `id_municipio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_municipio` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `observacion_municipio` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `id_estado` int(11) NOT NULL,
  PRIMARY KEY (`id_municipio`),
  KEY `id_estado` (`id_estado`),
  CONSTRAINT `fk_estado_municip` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id_estado`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=463 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

LOCK TABLES `municipios` WRITE;
INSERT INTO `municipios` VALUES (1,'Alto Orinoco','',1),(2,'Atabapo','',1),(3,'Atures','',1),(4,'Autana','',1),(5,'Manapiare','',1),(6,'Maroa','',1),(7,'Río Negro','',1),(8,'Anaco','',2),(9,'Aragua','',2),(10,'Manuel Ezequiel Bruzual','',2),(11,'Diego Bautista Urbaneja','',2),(12,'Fernando Peñalver','',2),(13,'Francisco Del Carmen Carvajal','',2),(14,'General Sir Arthur McGregor','',2),(15,'Guanta','',2),(16,'Independencia','',2),(17,'José Gregorio Monagas','',2),(18,'Juan Antonio Sotillo','',2),(19,'Juan Manuel Cajigal','',2),(20,'Libertad','',2),(21,'Francisco de Miranda','',2),(22,'Pedro María Freites','',2),(23,'Píritu','',2),(24,'San José de Guanipa','',2),(25,'San Juan de Capistrano','',2),(26,'Santa Ana','',2),(27,'Simón Bolívar','',2),(28,'Simón Rodríguez','',2),(29,'Achaguas','',3),(30,'Biruaca','',3),(31,'Muñóz','',3),(32,'Páez','',3),(33,'Pedro Camejo','',3),(34,'Rómulo Gallegos','',3),(35,'San Fernando','',3),(36,'Atanasio Girardot','',4),(37,'Bolívar','',4),(38,'Camatagua','',4),(39,'Francisco Linares Alcántara','',4),(40,'José Ángel Lamas','',4),(41,'José Félix Ribas','',4),(42,'José Rafael Revenga','',4),(43,'Libertador','',4),(44,'Mario Briceño Iragorry','',4),(45,'Ocumare de la Costa de Oro','',4),(46,'San Casimiro','',4),(47,'San Sebastián','',4),(48,'Santiago Mariño','',4),(49,'Santos Michelena','',4),(50,'Sucre','',4),(51,'Tovar','',4),(52,'Urdaneta','',4),(53,'Zamora','',4),(54,'Alberto Arvelo Torrealba','',5),(55,'Andrés Eloy Blanco','',5),(56,'Antonio José de Sucre','',5),(57,'Arismendi','',5),(58,'Barinas','',5),(59,'Bolívar','',5),(60,'Cruz Paredes','',5),(61,'Ezequiel Zamora','',5),(62,'Obispos','',5),(63,'Pedraza','',5),(64,'Rojas','',5),(65,'Sosa','',5),(66,'Caroní','',6),(67,'Cedeño','',6),(68,'El Callao','',6),(69,'Gran Sabana','',6),(70,'Heres','',6),(71,'Piar','',6),(72,'Angostura (Raúl Leoni)','',6),(73,'Roscio','',6),(74,'Sifontes','',6),(75,'Sucre','',6),(76,'Padre Pedro Chien','',6),(77,'Bejuma','',7),(78,'Carlos Arvelo','',7),(79,'Diego Ibarra','',7),(80,'Guacara','',7),(81,'Juan José Mora','',7),(82,'Libertador','',7),(83,'Los Guayos','',7),(84,'Miranda','',7),(85,'Montalbán','',7),(86,'Naguanagua','',7),(87,'Puerto Cabello','',7),(88,'San Diego','',7),(89,'San Joaquín','',7),(90,'Valencia','',7),(91,'Anzoátegui','',8),(92,'Tinaquillo','',8),(93,'Girardot','',8),(94,'Lima Blanco','',8),(95,'Pao de San Juan Bautista','',8),(96,'Ricaurte','',8),(97,'Rómulo Gallegos','',8),(98,'San Carlos','',8),(99,'Tinaco','',8),(100,'Antonio Díaz','',9),(101,'Casacoima','',9),(102,'Pedernales','',9),(103,'Tucupita','',9),(104,'Acosta','',10),(105,'Bolívar','',10),(106,'Buchivacoa','',10),(107,'Cacique Manaure','',10),(108,'Carirubana','',10),(109,'Colina','',10),(110,'Dabajuro','',10),(111,'Democracia','',10),(112,'Falcón','',10),(113,'Federación','',10),(114,'Jacura','',10),(115,'José Laurencio Silva','',10),(116,'Los Taques','',10),(117,'Mauroa','',10),(118,'Miranda','',10),(119,'Monseñor Iturriza','',10),(120,'Palmasola','',10),(121,'Petit','',10),(122,'Píritu','',10),(123,'San Francisco','',10),(124,'Sucre','',10),(125,'Tocópero','',10),(126,'Unión','',10),(127,'Urumaco','',10),(128,'Zamora','',10),(129,'Camaguán','',11),(130,'Chaguaramas','',11),(131,'El Socorro','',11),(132,'José Félix Ribas','',11),(133,'José Tadeo Monagas','',11),(134,'Juan Germán Roscio','',11),(135,'Julián Mellado','',11),(136,'Las Mercedes','',11),(137,'Leonardo Infante','',11),(138,'Pedro Zaraza','',11),(139,'Ortíz','',11),(140,'San Gerónimo de Guayabal','',11),(141,'San José de Guaribe','',11),(142,'Santa María de Ipire','',11),(143,'Sebastián Francisco de Miranda','',11),(144,'Andrés Eloy Blanco','',12),(145,'Crespo','',12),(146,'Iribarren','',12),(147,'Jiménez','',12),(148,'Morán','',12),(149,'Palavecino','',12),(150,'Simón Planas','',12),(151,'Torres','',12),(152,'Urdaneta','',12),(179,'Alberto Adriani','',13),(180,'Andrés Bello','',13),(181,'Antonio Pinto Salinas','',13),(182,'Aricagua','',13),(183,'Arzobispo Chacón','',13),(184,'Campo Elías','',13),(185,'Caracciolo Parra Olmedo','',13),(186,'Cardenal Quintero','',13),(187,'Guaraque','',13),(188,'Julio César Salas','',13),(189,'Justo Briceño','',13),(190,'Libertador','',13),(191,'Miranda','',13),(192,'Obispo Ramos de Lora','',13),(193,'Padre Noguera','',13),(194,'Pueblo Llano','',13),(195,'Rangel','',13),(196,'Rivas Dávila','',13),(197,'Santos Marquina','',13),(198,'Sucre','',13),(199,'Tovar','',13),(200,'Tulio Febres Cordero','',13),(201,'Zea','',13),(223,'Acevedo','',14),(224,'Andrés Bello','',14),(225,'Baruta','',14),(226,'Brión','',14),(227,'Buroz','',14),(228,'Carrizal','',14),(229,'Chacao','',14),(230,'Cristóbal Rojas','',14),(231,'El Hatillo','',14),(232,'Guaicaipuro','',14),(233,'Independencia','',14),(234,'Lander','',14),(235,'Los Salias','',14),(236,'Páez','',14),(237,'Paz Castillo','',14),(238,'Pedro Gual','',14),(239,'Plaza','',14),(240,'Simón Bolívar','',14),(241,'Sucre','',14),(242,'Urdaneta','',14),(243,'Zamora','',14),(258,'Acosta','',15),(259,'Aguasay','',15),(260,'Bolívar','',15),(261,'Caripe','',15),(262,'Cedeño','',15),(263,'Ezequiel Zamora','',15),(264,'Libertador','',15),(265,'Maturín','',15),(266,'Piar','',15),(267,'Punceres','',15),(268,'Santa Bárbara','',15),(269,'Sotillo','',15),(270,'Uracoa','',15),(271,'Antolín del Campo','',16),(272,'Arismendi','',16),(273,'García','',16),(274,'Gómez','',16),(275,'Maneiro','',16),(276,'Marcano','',16),(277,'Mariño','',16),(278,'Península de Macanao','',16),(279,'Tubores','',16),(280,'Villalba','',16),(281,'Díaz','',16),(282,'Agua Blanca','',17),(283,'Araure','',17),(284,'Esteller','',17),(285,'Guanare','',17),(286,'Guanarito','',17),(287,'Monseñor José Vicente de Unda','',17),(288,'Ospino','',17),(289,'Páez','',17),(290,'Papelón','',17),(291,'San Genaro de Boconoíto','',17),(292,'San Rafael de Onoto','',17),(293,'Santa Rosalía','',17),(294,'Sucre','',17),(295,'Turén','',17),(296,'Andrés Eloy Blanco','',18),(297,'Andrés Mata','',18),(298,'Arismendi','',18),(299,'Benítez','',18),(300,'Bermúdez','',18),(301,'Bolívar','',18),(302,'Cajigal','',18),(303,'Cruz Salmerón Acosta','',18),(304,'Libertador','',18),(305,'Mariño','',18),(306,'Mejía','',18),(307,'Montes','',18),(308,'Ribero','',18),(309,'Sucre','',18),(310,'Valdéz','',18),(341,'Andrés Bello','',19),(342,'Antonio Rómulo Costa','',19),(343,'Ayacucho','',19),(344,'Bolívar','',19),(345,'Cárdenas','',19),(346,'Córdoba','',19),(347,'Fernández Feo','',19),(348,'Francisco de Miranda','',19),(349,'García de Hevia','',19),(350,'Guásimos','',19),(351,'Independencia','',19),(352,'Jáuregui','',19),(353,'José María Vargas','',19),(354,'Junín','',19),(355,'Libertad','',19),(356,'Libertador','',19),(357,'Lobatera','',19),(358,'Michelena','',19),(359,'Panamericano','',19),(360,'Pedro María Ureña','',19),(361,'Rafael Urdaneta','',19),(362,'Samuel Darío Maldonado','',19),(363,'San Cristóbal','',19),(364,'Seboruco','',19),(365,'Simón Rodríguez','',19),(366,'Sucre','',19),(367,'Torbes','',19),(368,'Uribante','',19),(369,'San Judas Tadeo','',19),(370,'Andrés Bello','',20),(371,'Boconó','',20),(372,'Bolívar','',20),(373,'Candelaria','',20),(374,'Carache','',20),(375,'Escuque','',20),(376,'José Felipe Márquez Cañizalez','',20),(377,'Juan Vicente Campos Elías','',20),(378,'La Ceiba','',20),(379,'Miranda','',20),(380,'Monte Carmelo','',20),(381,'Motatán','',20),(382,'Pampán','',20),(383,'Pampanito','',20),(384,'Rafael Rangel','',20),(385,'San Rafael de Carvajal','',20),(386,'Sucre','',20),(387,'Trujillo','',20),(388,'Urdaneta','',20),(389,'Valera','',20),(390,'Vargas','',21),(391,'Arístides Bastidas','',22),(392,'Bolívar','',22),(407,'Bruzual','',22),(408,'Cocorote','',22),(409,'Independencia','',22),(410,'José Antonio Páez','',22),(411,'La Trinidad','',22),(412,'Manuel Monge','',22),(413,'Nirgua','',22),(414,'Peña','',22),(415,'San Felipe','',22),(416,'Sucre','',22),(417,'Urachiche','',22),(418,'José Joaquín Veroes','',22),(441,'Almirante Padilla','',23),(442,'Baralt','',23),(443,'Cabimas','',23),(444,'Catatumbo','',23),(445,'Colón','',23),(446,'Francisco Javier Pulgar','',23),(447,'Páez','',23),(448,'Jesús Enrique Losada','',23),(449,'Jesús María Semprún','',23),(450,'La Cañada de Urdaneta','',23),(451,'Lagunillas','',23),(452,'Machiques de Perijá','',23),(453,'Mara','',23),(454,'Maracaibo','',23),(455,'Miranda','',23),(456,'Rosario de Perijá','',23),(457,'San Francisco','',23),(458,'Santa Rita','',23),(459,'Simón Bolívar','',23),(460,'Sucre','',23),(461,'Valmore Rodríguez','',23),(462,'Libertador','',24);
UNLOCK TABLES;


DROP TABLE IF EXISTS `ciudades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ciudades` (
  `id_ciudad` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_ciudad` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `observac_ciudad` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `id_estado` int(11) NOT NULL,
  `capital` tinyint(1) NOT NULL DEFAULT '0',
  `id_municipio` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_ciudad`),
  KEY `id_estado` (`id_estado`),
  KEY `fk_ciudad_municip` (`id_municipio`),
  CONSTRAINT `fk_ciudad_edo` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id_estado`),
  CONSTRAINT `fk_ciudad_municip` FOREIGN KEY (`id_municipio`) REFERENCES `municipios` (`id_municipio`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=529 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

LOCK TABLES `ciudades` WRITE;
INSERT INTO `ciudades` VALUES (1,'Maroa','',1,0,6),(2,'Puerto Ayacucho','',1,1,3),(3,'San Fernando de Atabapo','',1,0,2),(4,'Anaco','',2,0,8),(5,'Aragua de Barcelona','',2,0,9),(6,'Barcelona','',2,1,27),(7,'Boca de Uchire','',2,0,25),(8,'Cantaura','',2,0,22),(9,'Clarines','',2,0,10),(10,'El Chaparro','',2,0,14),(11,'El Pao Anzoátegui','',2,0,21),(12,'El Tigre','',2,0,28),(13,'El Tigrito','',2,0,24),(14,'Guanape','',2,0,10),(15,'Guanta','',2,0,15),(16,'Lechería','',2,0,11),(17,'Onoto','',2,0,19),(18,'Pariaguán','',2,0,21),(19,'Píritu','',2,0,23),(20,'Puerto La Cruz','',2,0,18),(21,'Puerto Píritu','',2,0,12),(22,'Sabana de Uchire','',2,0,10),(23,'San Mateo Anzoátegui','',2,0,20),(24,'San Pablo Anzoátegui','',2,0,19),(25,'San Tomé','',2,0,22),(26,'Santa Ana de Anzoátegui','',2,0,26),(27,'Santa Fe Anzoátegui','',2,0,22),(28,'Santa Rosa','',2,0,22),(29,'Soledad','',2,0,16),(30,'Urica','',2,0,22),(31,'Valle de Guanape','',2,0,13),(43,'Achaguas','',3,0,29),(44,'Biruaca','',3,0,30),(45,'Bruzual','',3,0,31),(46,'El Amparo','',3,0,32),(47,'El Nula','',3,0,32),(48,'Elorza','',3,0,34),(49,'Guasdualito','',3,0,32),(50,'Mantecal','',3,0,31),(51,'Puerto Páez','',3,0,33),(52,'San Fernando de Apure','',3,1,35),(53,'San Juan de Payara','',3,0,33),(54,'Barbacoas','',4,0,52),(55,'Cagua','',4,0,50),(56,'Camatagua','',4,0,38),(58,'Choroní','',4,0,36),(59,'Colonia Tovar','',4,0,51),(60,'El Consejo','',4,0,42),(61,'La Victoria','',4,0,41),(62,'Las Tejerías','',4,0,49),(63,'Magdaleno','',4,0,53),(64,'Maracay','',4,1,36),(65,'Ocumare de La Costa','',4,0,45),(66,'Palo Negro','',4,0,43),(67,'San Casimiro','',4,0,46),(68,'San Mateo','',4,0,37),(69,'San Sebastián','',4,0,47),(70,'Santa Cruz de Aragua','',4,0,40),(71,'Tocorón','',4,0,53),(72,'Turmero','',4,0,48),(73,'Villa de Cura','',4,0,53),(74,'Zuata','',4,0,41),(75,'Barinas','',5,1,58),(76,'Barinitas','',5,0,59),(77,'Barrancas','',5,0,60),(78,'Calderas','',5,0,59),(79,'Capitanejo','',5,0,61),(80,'Ciudad Bolivia','',5,0,63),(81,'El Cantón','',5,0,55),(82,'Las Veguitas','',5,0,54),(83,'Libertad de Barinas','',5,0,64),(84,'Sabaneta','',5,0,54),(85,'Santa Bárbara de Barinas','',5,0,61),(86,'Socopó','',5,0,56),(87,'Caicara del Orinoco','',6,0,67),(88,'Canaima','',6,0,69),(89,'Ciudad Bolívar','',6,1,70),(90,'Ciudad Piar','',6,0,72),(91,'El Callao','',6,0,68),(92,'El Dorado','',6,0,74),(93,'El Manteco','',6,0,71),(94,'El Palmar','',6,0,76),(95,'El Pao','',6,0,71),(96,'Guasipati','',6,0,73),(97,'Guri','',6,0,72),(98,'La Paragua','',6,0,72),(99,'Matanzas','',6,0,66),(100,'Puerto Ordaz','',6,0,66),(101,'San Félix','',6,0,66),(102,'Santa Elena de Uairén','',6,0,69),(103,'Tumeremo','',6,0,74),(104,'Unare','',6,0,66),(105,'Upata','',6,0,71),(106,'Bejuma','',7,0,77),(107,'Belén','',7,0,78),(108,'Campo de Carabobo','',7,0,82),(109,'Canoabo','',7,0,77),(110,'Central Tacarigua','',7,0,78),(111,'Chirgua','',7,0,77),(112,'Ciudad Alianza','',7,0,80),(113,'El Palito','',7,0,87),(114,'Guacara','',7,0,80),(115,'Güigüe','',7,0,78),(116,'Las Trincheras','',7,0,86),(117,'Los Guayos','',7,0,83),(118,'Mariara','',7,0,79),(119,'Miranda','',7,0,84),(120,'Montalbán','',7,0,85),(121,'Morón','',7,0,81),(122,'Naguanagua','',7,0,86),(123,'Puerto Cabello','',7,0,NULL),(124,'San Joaquín','',7,0,NULL),(125,'Tocuyito','',7,0,NULL),(126,'Urama','',7,0,NULL),(127,'Valencia','',7,1,NULL),(128,'Vigirimita','',7,0,NULL),(129,'Aguirre','',8,0,NULL),(130,'Apartaderos Cojedes','',8,0,NULL),(131,'Arismendi','',8,0,NULL),(132,'Camuriquito','',8,0,NULL),(133,'El Baúl','',8,0,NULL),(134,'El Limón','',8,0,NULL),(135,'El Pao Cojedes','',8,0,NULL),(136,'El Socorro','',8,0,NULL),(137,'La Aguadita','',8,0,NULL),(138,'Las Vegas','',8,0,NULL),(139,'Libertad de Cojedes','',8,0,NULL),(140,'Mapuey','',8,0,NULL),(141,'Piñedo','',8,0,NULL),(142,'Samancito','',8,0,NULL),(143,'San Carlos','',8,1,NULL),(144,'Sucre','',8,0,NULL),(145,'Tinaco','',8,0,NULL),(146,'Tinaquillo','',8,0,NULL),(147,'Vallecito','',8,0,NULL),(148,'Tucupita','',9,1,NULL),(149,'Caracas','',24,1,NULL),(150,'El Junquito','',24,0,NULL),(151,'Adícora','',10,0,NULL),(152,'Boca de Aroa','',10,0,NULL),(153,'Cabure','',10,0,NULL),(154,'Capadare','',10,0,NULL),(155,'Capatárida','',10,0,NULL),(156,'Chichiriviche','',10,0,NULL),(157,'Churuguara','',10,0,NULL),(158,'Coro','',10,1,NULL),(159,'Cumarebo','',10,0,NULL),(160,'Dabajuro','',10,0,NULL),(161,'Judibana','',10,0,NULL),(162,'La Cruz de Taratara','',10,0,NULL),(163,'La Vela de Coro','',10,0,NULL),(164,'Los Taques','',10,0,NULL),(165,'Maparari','',10,0,NULL),(166,'Mene de Mauroa','',10,0,NULL),(167,'Mirimire','',10,0,NULL),(168,'Pedregal','',10,0,NULL),(169,'Píritu Falcón','',10,0,NULL),(170,'Pueblo Nuevo Falcón','',10,0,NULL),(171,'Puerto Cumarebo','',10,0,NULL),(172,'Punta Cardón','',10,0,NULL),(173,'Punto Fijo','',10,0,NULL),(174,'San Juan de Los Cayos','',10,0,NULL),(175,'San Luis','',10,0,NULL),(176,'Santa Ana Falcón','',10,0,NULL),(177,'Santa Cruz De Bucaral','',10,0,NULL),(178,'Tocopero','',10,0,NULL),(179,'Tocuyo de La Costa','',10,0,NULL),(180,'Tucacas','',10,0,NULL),(181,'Yaracal','',10,0,NULL),(182,'Altagracia de Orituco','',11,0,NULL),(183,'Cabruta','',11,0,NULL),(184,'Calabozo','',11,0,NULL),(185,'Camaguán','',11,0,NULL),(196,'Chaguaramas Guárico','',11,0,NULL),(197,'El Socorro','',11,0,NULL),(198,'El Sombrero','',11,0,NULL),(199,'Las Mercedes de Los Llanos','',11,0,NULL),(200,'Lezama','',11,0,NULL),(201,'Onoto','',11,0,NULL),(202,'Ortíz','',11,0,NULL),(203,'San José de Guaribe','',11,0,NULL),(204,'San Juan de Los Morros','',11,1,NULL),(205,'San Rafael de Laya','',11,0,NULL),(206,'Santa María de Ipire','',11,0,NULL),(207,'Tucupido','',11,0,NULL),(208,'Valle de La Pascua','',11,0,NULL),(209,'Zaraza','',11,0,NULL),(210,'Aguada Grande','',12,0,NULL),(211,'Atarigua','',12,0,NULL),(212,'Barquisimeto','',12,1,NULL),(213,'Bobare','',12,0,NULL),(214,'Cabudare','',12,0,NULL),(215,'Carora','',12,0,NULL),(216,'Cubiro','',12,0,NULL),(217,'Cují','',12,0,NULL),(218,'Duaca','',12,0,NULL),(219,'El Manzano','',12,0,NULL),(220,'El Tocuyo','',12,0,NULL),(221,'Guaríco','',12,0,NULL),(222,'Humocaro Alto','',12,0,NULL),(223,'Humocaro Bajo','',12,0,NULL),(224,'La Miel','',12,0,NULL),(225,'Moroturo','',12,0,NULL),(226,'Quíbor','',12,0,NULL),(227,'Río Claro','',12,0,NULL),(228,'Sanare','',12,0,NULL),(229,'Santa Inés','',12,0,NULL),(230,'Sarare','',12,0,NULL),(231,'Siquisique','',12,0,NULL),(232,'Tintorero','',12,0,NULL),(233,'Apartaderos Mérida','',13,0,NULL),(234,'Arapuey','',13,0,NULL),(235,'Bailadores','',13,0,NULL),(236,'Caja Seca','',13,0,NULL),(237,'Canaguá','',13,0,NULL),(238,'Chachopo','',13,0,NULL),(239,'Chiguara','',13,0,NULL),(240,'Ejido','',13,0,NULL),(241,'El Vigía','',13,0,NULL),(242,'La Azulita','',13,0,NULL),(243,'La Playa','',13,0,NULL),(244,'Lagunillas Mérida','',13,0,NULL),(245,'Mérida','',13,1,NULL),(246,'Mesa de Bolívar','',13,0,NULL),(247,'Mucuchíes','',13,0,NULL),(248,'Mucujepe','',13,0,NULL),(249,'Mucuruba','',13,0,NULL),(250,'Nueva Bolivia','',13,0,NULL),(251,'Palmarito','',13,0,NULL),(252,'Pueblo Llano','',13,0,NULL),(253,'Santa Cruz de Mora','',13,0,NULL),(254,'Santa Elena de Arenales','',13,0,NULL),(255,'Santo Domingo','',13,0,NULL),(256,'Tabáy','',13,0,NULL),(257,'Timotes','',13,0,NULL),(258,'Torondoy','',13,0,NULL),(259,'Tovar','',13,0,NULL),(260,'Tucani','',13,0,NULL),(261,'Zea','',13,0,NULL),(262,'Araguita','',14,0,NULL),(263,'Carrizal','',14,0,NULL),(264,'Caucagua','',14,0,NULL),(265,'Chaguaramas Miranda','',14,0,NULL),(266,'Charallave','',14,0,NULL),(267,'Chirimena','',14,0,NULL),(268,'Chuspa','',14,0,NULL),(269,'Cúa','',14,0,NULL),(270,'Cupira','',14,0,NULL),(271,'Curiepe','',14,0,NULL),(272,'El Guapo','',14,0,NULL),(273,'El Jarillo','',14,0,NULL),(274,'Filas de Mariche','',14,0,NULL),(275,'Guarenas','',14,0,NULL),(276,'Guatire','',14,0,NULL),(277,'Higuerote','',14,0,NULL),(278,'Los Anaucos','',14,0,NULL),(279,'Los Teques','',14,1,NULL),(280,'Ocumare del Tuy','',14,0,NULL),(281,'Panaquire','',14,0,NULL),(282,'Paracotos','',14,0,NULL),(283,'Río Chico','',14,0,NULL),(284,'San Antonio de Los Altos','',14,0,NULL),(285,'San Diego de Los Altos','',14,0,NULL),(286,'San Fernando del Guapo','',14,0,NULL),(287,'San Francisco de Yare','',14,0,NULL),(288,'San José de Los Altos','',14,0,NULL),(289,'San José de Río Chico','',14,0,NULL),(290,'San Pedro de Los Altos','',14,0,NULL),(291,'Santa Lucía','',14,0,NULL),(292,'Santa Teresa','',14,0,NULL),(293,'Tacarigua de La Laguna','',14,0,NULL),(294,'Tacarigua de Mamporal','',14,0,NULL),(295,'Tácata','',14,0,NULL),(296,'Turumo','',14,0,NULL),(297,'Aguasay','',15,0,NULL),(298,'Aragua de Maturín','',15,0,NULL),(299,'Barrancas del Orinoco','',15,0,NULL),(300,'Caicara de Maturín','',15,0,NULL),(301,'Caripe','',15,0,NULL),(302,'Caripito','',15,0,NULL),(303,'Chaguaramal','',15,0,NULL),(305,'Chaguaramas Monagas','',15,0,NULL),(307,'El Furrial','',15,0,NULL),(308,'El Tejero','',15,0,NULL),(309,'Jusepín','',15,0,NULL),(310,'La Toscana','',15,0,NULL),(311,'Maturín','',15,1,NULL),(312,'Miraflores','',15,0,NULL),(313,'Punta de Mata','',15,0,NULL),(314,'Quiriquire','',15,0,NULL),(315,'San Antonio de Maturín','',15,0,NULL),(316,'San Vicente Monagas','',15,0,NULL),(317,'Santa Bárbara','',15,0,NULL),(318,'Temblador','',15,0,NULL),(319,'Teresen','',15,0,NULL),(320,'Uracoa','',15,0,NULL),(321,'Altagracia','',16,0,NULL),(322,'Boca de Pozo','',16,0,NULL),(323,'Boca de Río','',16,0,NULL),(324,'El Espinal','',16,0,NULL),(325,'El Valle del Espíritu Santo','',16,0,NULL),(326,'El Yaque','',16,0,NULL),(327,'Juangriego','',16,0,NULL),(328,'La Asunción','',16,1,NULL),(329,'La Guardia','',16,0,NULL),(330,'Pampatar','',16,0,NULL),(331,'Porlamar','',16,0,NULL),(332,'Puerto Fermín','',16,0,NULL),(333,'Punta de Piedras','',16,0,NULL),(334,'San Francisco de Macanao','',16,0,NULL),(335,'San Juan Bautista','',16,0,NULL),(336,'San Pedro de Coche','',16,0,NULL),(337,'Santa Ana de Nueva Esparta','',16,0,NULL),(338,'Villa Rosa','',16,0,NULL),(339,'Acarigua','',17,0,NULL),(340,'Agua Blanca','',17,0,NULL),(341,'Araure','',17,0,NULL),(342,'Biscucuy','',17,0,NULL),(343,'Boconoito','',17,0,NULL),(344,'Campo Elías','',17,0,NULL),(345,'Chabasquén','',17,0,NULL),(346,'Guanare','',17,1,NULL),(347,'Guanarito','',17,0,NULL),(348,'La Aparición','',17,0,NULL),(349,'La Misión','',17,0,NULL),(350,'Mesa de Cavacas','',17,0,NULL),(351,'Ospino','',17,0,NULL),(352,'Papelón','',17,0,NULL),(353,'Payara','',17,0,NULL),(354,'Pimpinela','',17,0,NULL),(355,'Píritu de Portuguesa','',17,0,NULL),(356,'San Rafael de Onoto','',17,0,NULL),(357,'Santa Rosalía','',17,0,NULL),(358,'Turén','',17,0,NULL),(359,'Altos de Sucre','',18,0,NULL),(360,'Araya','',18,0,NULL),(361,'Cariaco','',18,0,NULL),(362,'Carúpano','',18,0,NULL),(363,'Casanay','',18,0,NULL),(364,'Cumaná','',18,1,NULL),(365,'Cumanacoa','',18,0,NULL),(366,'El Morro Puerto Santo','',18,0,NULL),(367,'El Pilar','',18,0,NULL),(368,'El Poblado','',18,0,NULL),(369,'Guaca','',18,0,NULL),(370,'Guiria','',18,0,NULL),(371,'Irapa','',18,0,NULL),(372,'Manicuare','',18,0,NULL),(373,'Mariguitar','',18,0,NULL),(374,'Río Caribe','',18,0,NULL),(375,'San Antonio del Golfo','',18,0,NULL),(376,'San José de Aerocuar','',18,0,NULL),(377,'San Vicente de Sucre','',18,0,NULL),(378,'Santa Fe de Sucre','',18,0,NULL),(379,'Tunapuy','',18,0,NULL),(380,'Yaguaraparo','',18,0,NULL),(381,'Yoco','',18,0,NULL),(382,'Abejales','',19,0,NULL),(383,'Borota','',19,0,NULL),(384,'Bramon','',19,0,NULL),(385,'Capacho','',19,0,NULL),(386,'Colón','',19,0,NULL),(387,'Coloncito','',19,0,NULL),(388,'Cordero','',19,0,NULL),(389,'El Cobre','',19,0,NULL),(390,'El Pinal','',19,0,NULL),(391,'Independencia','',19,0,NULL),(392,'La Fría','',19,0,NULL),(393,'La Grita','',19,0,NULL),(394,'La Pedrera','',19,0,NULL),(395,'La Tendida','',19,0,NULL),(396,'Las Delicias','',19,0,NULL),(397,'Las Hernández','',19,0,NULL),(398,'Lobatera','',19,0,NULL),(399,'Michelena','',19,0,NULL),(400,'Palmira','',19,0,NULL),(401,'Pregonero','',19,0,NULL),(402,'Queniquea','',19,0,NULL),(403,'Rubio','',19,0,NULL),(404,'San Antonio del Tachira','',19,0,NULL),(405,'San Cristobal','',19,1,NULL),(406,'San José de Bolívar','',19,0,NULL),(407,'San Josecito','',19,0,NULL),(408,'San Pedro del Río','',19,0,NULL),(409,'Santa Ana Táchira','',19,0,NULL),(410,'Seboruco','',19,0,NULL),(411,'Táriba','',19,0,NULL),(412,'Umuquena','',19,0,NULL),(413,'Ureña','',19,0,NULL),(414,'Batatal','',20,0,NULL),(415,'Betijoque','',20,0,NULL),(416,'Boconó','',20,0,NULL),(417,'Carache','',20,0,NULL),(418,'Chejende','',20,0,NULL),(419,'Cuicas','',20,0,NULL),(420,'El Dividive','',20,0,NULL),(421,'El Jaguito','',20,0,NULL),(422,'Escuque','',20,0,NULL),(423,'Isnotú','',20,0,NULL),(424,'Jajó','',20,0,NULL),(425,'La Ceiba','',20,0,NULL),(426,'La Concepción de Trujllo','',20,0,NULL),(427,'La Mesa de Esnujaque','',20,0,NULL),(428,'La Puerta','',20,0,NULL),(429,'La Quebrada','',20,0,NULL),(430,'Mendoza Fría','',20,0,NULL),(431,'Meseta de Chimpire','',20,0,NULL),(432,'Monay','',20,0,NULL),(433,'Motatán','',20,0,NULL),(434,'Pampán','',20,0,NULL),(435,'Pampanito','',20,0,NULL),(436,'Sabana de Mendoza','',20,0,NULL),(437,'San Lázaro','',20,0,NULL),(438,'Santa Ana de Trujillo','',20,0,NULL),(439,'Tostós','',20,0,NULL),(440,'Trujillo','',20,1,NULL),(441,'Valera','',20,0,NULL),(442,'Carayaca','',21,0,NULL),(443,'Litoral','',21,0,NULL),(444,'Archipiélago Los Roques','',25,0,NULL),(445,'Aroa','',22,0,NULL),(446,'Boraure','',22,0,NULL),(447,'Campo Elías de Yaracuy','',22,0,NULL),(448,'Chivacoa','',22,0,NULL),(449,'Cocorote','',22,0,NULL),(450,'Farriar','',22,0,NULL),(451,'Guama','',22,0,NULL),(452,'Marín','',22,0,NULL),(453,'Nirgua','',22,0,NULL),(454,'Sabana de Parra','',22,0,NULL),(455,'Salom','',22,0,NULL),(456,'San Felipe','',22,1,NULL),(457,'San Pablo de Yaracuy','',22,0,NULL),(458,'Urachiche','',22,0,NULL),(459,'Yaritagua','',22,0,NULL),(460,'Yumare','',22,0,NULL),(461,'Bachaquero','',23,0,NULL),(462,'Bobures','',23,0,NULL),(463,'Cabimas','',23,0,NULL),(464,'Campo Concepción','',23,0,NULL),(465,'Campo Mara','',23,0,NULL),(466,'Campo Rojo','',23,0,NULL),(467,'Carrasquero','',23,0,NULL),(468,'Casigua','',23,0,NULL),(469,'Chiquinquirá','',23,0,NULL),(470,'Ciudad Ojeda','',23,0,NULL),(471,'El Batey','',23,0,NULL),(472,'El Carmelo','',23,0,NULL),(473,'El Chivo','',23,0,NULL),(474,'El Guayabo','',23,0,NULL),(475,'El Mene','',23,0,NULL),(476,'El Venado','',23,0,NULL),(477,'Encontrados','',23,0,NULL),(478,'Gibraltar','',23,0,NULL),(479,'Isla de Toas','',23,0,NULL),(480,'La Concepción del Zulia','',23,0,NULL),(481,'La Paz','',23,0,NULL),(482,'La Sierrita','',23,0,NULL),(483,'Lagunillas del Zulia','',23,0,NULL),(484,'Las Piedras de Perijá','',23,0,NULL),(485,'Los Cortijos','',23,0,NULL),(486,'Machiques','',23,0,NULL),(487,'Maracaibo','',23,1,NULL),(488,'Mene Grande','',23,0,NULL),(489,'Palmarejo','',23,0,NULL),(490,'Paraguaipoa','',23,0,NULL),(491,'Potrerito','',23,0,NULL),(492,'Pueblo Nuevo del Zulia','',23,0,NULL),(493,'Puertos de Altagracia','',23,0,NULL),(494,'Punta Gorda','',23,0,NULL),(495,'Sabaneta de Palma','',23,0,NULL),(496,'San Francisco','',23,0,NULL),(497,'San José de Perijá','',23,0,NULL),(498,'San Rafael del Moján','',23,0,NULL),(499,'San Timoteo','',23,0,NULL),(500,'Santa Bárbara Del Zulia','',23,0,NULL),(501,'Santa Cruz de Mara','',23,0,NULL),(502,'Santa Cruz del Zulia','',23,0,NULL),(503,'Santa Rita','',23,0,NULL),(504,'Sinamaica','',23,0,NULL),(505,'Tamare','',23,0,NULL),(506,'Tía Juana','',23,0,NULL),(507,'Villa del Rosario','',23,0,NULL),(508,'La Guaira','',21,1,NULL),(509,'Catia La Mar','',21,0,NULL),(510,'Macuto','',21,0,NULL),(511,'Naiguatá','',21,0,NULL),(512,'Archipiélago Los Monjes','',25,0,NULL),(513,'Isla La Tortuga y Cayos adyacentes','',25,0,NULL),(514,'Isla La Sola','',25,0,NULL),(515,'Islas Los Testigos','',25,0,NULL),(516,'Islas Los Frailes','',25,0,NULL),(517,'Isla La Orchila','',25,0,NULL),(518,'Archipiélago Las Aves','',25,0,NULL),(519,'Isla de Aves','',25,0,NULL),(520,'Isla La Blanquilla','',25,0,NULL),(521,'Isla de Patos','',25,0,NULL),(522,'Islas Los Hermanos','',25,0,NULL),(523,'El Limón','',4,0,44),(524,'Arismendi','',5,0,57),(525,'Ciudad de Nutrias','',5,0,65),(526,'Obispos','',5,0,62),(527,'La Esmeralda','',1,0,1),(528,'Ciudad Orínoco','',2,0,16);
UNLOCK TABLES;



DROP TABLE IF EXISTS `parroquias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parroquias` (
  `id_parroquia` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_parroquia` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `observac_parroq` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_municipio` int(11) NOT NULL,
  `id_ciudad` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_parroquia`),
  KEY `id_municipio` (`id_municipio`),
  KEY `fk_ciudad_parroq` (`id_ciudad`),
  CONSTRAINT `fk_ciudad_parroq` FOREIGN KEY (`id_ciudad`) REFERENCES `ciudades` (`id_ciudad`) ON UPDATE CASCADE,
  CONSTRAINT `fk_parroq_munic` FOREIGN KEY (`id_municipio`) REFERENCES `municipios` (`id_municipio`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1139 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

LOCK TABLES `parroquias` WRITE;
INSERT INTO `parroquias` VALUES (1,'Alto Orinoco',NULL,1,527),(2,'Huachamacare Acanaña',NULL,1,527),(3,'Marawaka Toky Shamanaña',NULL,1,527),(4,'Mavaka Mavaka',NULL,1,527),(5,'Sierra Parima Parimabé',NULL,1,527),(6,'Ucata Laja Lisa',NULL,2,3),(7,'Yapacana Macuruco',NULL,2,3),(8,'Caname Guarinuma',NULL,2,3),(9,'Fernando Girón Tovar',NULL,3,2),(10,'Luis Alberto Gómez',NULL,3,2),(11,'Pahueña Limón de Parhueña',NULL,3,2),(12,'Platanillal Platanillal',NULL,3,2),(13,'Samariapo',NULL,4,NULL),(14,'Sipapo',NULL,4,NULL),(15,'Munduapo',NULL,4,NULL),(16,'Guayapo',NULL,4,NULL),(17,'Alto Ventuari',NULL,5,NULL),(18,'Medio Ventuari',NULL,5,NULL),(19,'Bajo Ventuari',NULL,5,NULL),(20,'Victorino',NULL,6,NULL),(21,'Comunidad',NULL,6,NULL),(22,'Casiquiare',NULL,7,NULL),(23,'Cocuy',NULL,7,NULL),(24,'San Carlos de Río Negro',NULL,7,NULL),(25,'Solano',NULL,7,NULL),(26,'Anaco',NULL,8,4),(27,'San Joaquín',NULL,8,4),(28,'Cachipo',NULL,9,5),(29,'Aragua de Barcelona',NULL,9,5),(30,'Lechería',NULL,11,16),(31,'El Morro',NULL,11,16),(32,'Puerto Píritu',NULL,12,21),(33,'San Miguel',NULL,12,21),(34,'Sucre',NULL,12,21),(35,'Valle de Guanape',NULL,13,31),(36,'Santa Bárbara',NULL,13,31),(37,'El Chaparro',NULL,14,10),(38,'Tomás Alfaro Calatrava',NULL,14,10),(39,'Calatrava',NULL,14,NULL),(40,'Guanta',NULL,15,15),(41,'Chorrerón',NULL,15,15),(42,'Mamo',NULL,16,528),(43,'Soledad',NULL,16,528),(44,'Mapire',NULL,17,NULL),(45,'Piar',NULL,17,NULL),(46,'Santa Clara',NULL,17,NULL),(47,'San Diego de Cabrutica',NULL,17,NULL),(48,'Uverito',NULL,17,NULL),(49,'Zuata',NULL,17,NULL),(50,'Puerto La Cruz',NULL,18,NULL),(51,'Pozuelos',NULL,18,NULL),(52,'Onoto',NULL,19,NULL),(53,'San Pablo',NULL,19,NULL),(54,'San Mateo',NULL,20,NULL),(55,'El Carito',NULL,20,NULL),(56,'Santa Inés',NULL,20,NULL),(57,'La Romereña',NULL,20,NULL),(58,'Atapirire',NULL,21,NULL),(59,'Boca del Pao',NULL,21,NULL),(60,'El Pao',NULL,21,NULL),(61,'Pariaguán',NULL,21,NULL),(62,'Cantaura',NULL,22,NULL),(63,'Libertador',NULL,22,NULL),(64,'Santa Rosa',NULL,22,NULL),(65,'Urica',NULL,22,NULL),(66,'Píritu',NULL,23,NULL),(67,'San Francisco',NULL,23,NULL),(68,'San José de Guanipa',NULL,24,NULL),(69,'Boca de Uchire',NULL,25,NULL),(70,'Boca de Chávez',NULL,25,NULL),(71,'Pueblo Nuevo',NULL,26,NULL),(72,'Santa Ana',NULL,26,NULL),(73,'Bergantín',NULL,27,NULL),(74,'Caigua',NULL,27,NULL),(75,'El Carmen',NULL,27,NULL),(76,'El Pilar',NULL,27,NULL),(77,'Naricual',NULL,27,NULL),(78,'San Cristóbal',NULL,27,NULL),(79,'Edmundo Barrios',NULL,28,12),(80,'Miguel Otero Silva',NULL,28,12),(81,'Achaguas',NULL,29,NULL),(82,'Apurito',NULL,29,NULL),(83,'El Yagual',NULL,29,NULL),(84,'Guachara',NULL,29,NULL),(85,'Mucuritas',NULL,29,NULL),(86,'Queseras del medio',NULL,29,NULL),(87,'Biruaca',NULL,30,NULL),(88,'Bruzual',NULL,31,NULL),(89,'Mantecal',NULL,31,NULL),(90,'Quintero',NULL,31,NULL),(91,'Rincón Hondo',NULL,31,NULL),(92,'San Vicente',NULL,31,NULL),(93,'Guasdualito',NULL,32,NULL),(94,'Aramendi',NULL,32,NULL),(95,'El Amparo',NULL,32,NULL),(96,'San Camilo',NULL,32,NULL),(97,'Urdaneta',NULL,32,NULL),(98,'San Juan de Payara',NULL,33,NULL),(99,'Codazzi',NULL,33,NULL),(100,'Cunaviche',NULL,33,NULL),(101,'Elorza',NULL,34,NULL),(102,'La Trinidad',NULL,34,NULL),(103,'San Fernando',NULL,35,NULL),(104,'El Recreo',NULL,35,NULL),(105,'Peñalver',NULL,35,NULL),(106,'San Rafael de Atamaica',NULL,35,NULL),(107,'Pedro José Ovalles',NULL,36,NULL),(108,'Joaquín Crespo',NULL,36,NULL),(109,'José Casanova Godoy',NULL,36,NULL),(110,'Madre María de San José',NULL,36,NULL),(111,'Andrés Eloy Blanco',NULL,36,NULL),(112,'Los Tacarigua',NULL,36,NULL),(113,'Las Delicias',NULL,36,NULL),(114,'Choroní',NULL,36,NULL),(115,'Bolívar',NULL,37,NULL),(116,'Camatagua',NULL,38,NULL),(117,'Carmen de Cura',NULL,38,NULL),(118,'Santa Rita',NULL,39,NULL),(119,'Francisco de Miranda',NULL,39,NULL),(120,'Moseñor Feliciano González',NULL,39,NULL),(121,'Santa Cruz',NULL,40,NULL),(122,'José Félix Ribas',NULL,41,NULL),(123,'Castor Nieves Ríos',NULL,41,NULL),(124,'Las Guacamayas',NULL,41,NULL),(125,'Pao de Zárate',NULL,41,NULL),(126,'Zuata',NULL,41,NULL),(127,'José Rafael Revenga',NULL,42,NULL),(128,'Palo Negro',NULL,43,NULL),(129,'San Martín de Porres',NULL,43,NULL),(130,'El Limón',NULL,44,NULL),(131,'Caña de Azúcar',NULL,44,NULL),(132,'Ocumare de la Costa',NULL,45,NULL),(133,'San Casimiro',NULL,46,NULL),(134,'Güiripa',NULL,46,NULL),(135,'Ollas de Caramacate',NULL,46,NULL),(136,'Valle Morín',NULL,46,NULL),(137,'San Sebastían',NULL,47,NULL),(138,'Turmero',NULL,48,NULL),(139,'Arevalo Aponte',NULL,48,NULL),(140,'Chuao',NULL,48,NULL),(141,'Samán de Güere',NULL,48,NULL),(142,'Alfredo Pacheco Miranda',NULL,48,NULL),(143,'Santos Michelena',NULL,49,NULL),(144,'Tiara',NULL,49,NULL),(145,'Cagua',NULL,50,NULL),(146,'Bella Vista',NULL,50,NULL),(147,'Tovar',NULL,51,NULL),(148,'Urdaneta',NULL,52,NULL),(149,'Las Peñitas',NULL,52,NULL),(150,'San Francisco de Cara',NULL,52,NULL),(151,'Taguay',NULL,52,NULL),(152,'Zamora',NULL,53,NULL),(153,'Magdaleno',NULL,53,NULL),(154,'San Francisco de Asís',NULL,53,NULL),(155,'Valles de Tucutunemo',NULL,53,NULL),(156,'Augusto Mijares',NULL,53,NULL),(157,'Sabaneta',NULL,54,NULL),(158,'Juan Antonio Rodríguez Domínguez',NULL,54,NULL),(159,'El Cantón',NULL,55,NULL),(160,'Santa Cruz de Guacas',NULL,55,NULL),(161,'Puerto Vivas',NULL,55,NULL),(162,'Ticoporo',NULL,56,NULL),(163,'Nicolás Pulido',NULL,56,NULL),(164,'Andrés Bello',NULL,56,NULL),(165,'Arismendi',NULL,57,NULL),(166,'Guadarrama',NULL,57,NULL),(167,'La Unión',NULL,57,NULL),(168,'San Antonio',NULL,57,NULL),(169,'Barinas',NULL,58,NULL),(170,'Alberto Arvelo Larriva',NULL,58,NULL),(171,'San Silvestre',NULL,58,NULL),(172,'Santa Inés',NULL,58,NULL),(173,'Santa Lucía',NULL,58,NULL),(174,'Torumos',NULL,58,NULL),(175,'El Carmen',NULL,58,NULL),(176,'Rómulo Betancourt',NULL,58,NULL),(177,'Corazón de Jesús',NULL,58,NULL),(178,'Ramón Ignacio Méndez',NULL,58,NULL),(179,'Alto Barinas',NULL,58,NULL),(180,'Manuel Palacio Fajardo',NULL,58,NULL),(181,'Juan Antonio Rodríguez Domínguez',NULL,58,NULL),(182,'Dominga Ortiz de Páez',NULL,58,NULL),(183,'Barinitas',NULL,59,NULL),(184,'Altamira de Cáceres',NULL,59,NULL),(185,'Calderas',NULL,59,NULL),(186,'Barrancas',NULL,60,NULL),(187,'El Socorro',NULL,60,NULL),(188,'Mazparrito',NULL,60,NULL),(189,'Santa Bárbara',NULL,61,NULL),(190,'Pedro Briceño Méndez',NULL,61,NULL),(191,'Ramón Ignacio Méndez',NULL,61,NULL),(192,'José Ignacio del Pumar',NULL,61,NULL),(193,'Obispos',NULL,62,NULL),(194,'Guasimitos',NULL,62,NULL),(195,'El Real',NULL,62,NULL),(196,'La Luz',NULL,62,NULL),(197,'Ciudad Bolívia',NULL,63,NULL),(198,'José Ignacio Briceño',NULL,63,NULL),(199,'José Félix Ribas',NULL,63,NULL),(200,'Páez',NULL,63,NULL),(201,'Libertad',NULL,64,NULL),(202,'Dolores',NULL,64,NULL),(203,'Santa Rosa',NULL,64,NULL),(204,'Palacio Fajardo',NULL,64,NULL),(205,'Ciudad de Nutrias',NULL,65,NULL),(206,'El Regalo',NULL,65,NULL),(207,'Puerto Nutrias',NULL,65,NULL),(208,'Santa Catalina',NULL,65,NULL),(209,'Cachamay',NULL,66,NULL),(210,'Chirica',NULL,66,NULL),(211,'Dalla Costa',NULL,66,NULL),(212,'Once de Abril',NULL,66,NULL),(213,'Simón Bolívar',NULL,66,NULL),(214,'Unare',NULL,66,NULL),(215,'Universidad',NULL,66,NULL),(216,'Vista al Sol',NULL,66,NULL),(217,'Pozo Verde',NULL,66,NULL),(218,'Yocoima',NULL,66,NULL),(219,'5 de Julio',NULL,66,NULL),(220,'Cedeño',NULL,67,NULL),(221,'Altagracia',NULL,67,NULL),(222,'Ascensión Farreras',NULL,67,NULL),(223,'Guaniamo',NULL,67,NULL),(224,'La Urbana',NULL,67,NULL),(225,'Pijiguaos',NULL,67,NULL),(226,'El Callao',NULL,68,NULL),(227,'Gran Sabana',NULL,69,NULL),(228,'Ikabarú',NULL,69,NULL),(229,'Catedral',NULL,70,NULL),(230,'Zea',NULL,70,NULL),(231,'Orinoco',NULL,70,NULL),(232,'José Antonio Páez',NULL,70,NULL),(233,'Marhuanta',NULL,70,NULL),(234,'Agua Salada',NULL,70,NULL),(235,'Vista Hermosa',NULL,70,NULL),(236,'La Sabanita',NULL,70,NULL),(237,'Panapana',NULL,70,NULL),(238,'Andrés Eloy Blanco',NULL,71,NULL),(239,'Pedro Cova',NULL,71,NULL),(240,'Raúl Leoni',NULL,72,NULL),(241,'Barceloneta',NULL,72,NULL),(242,'Santa Bárbara',NULL,72,NULL),(243,'San Francisco',NULL,72,NULL),(244,'Roscio',NULL,73,NULL),(245,'Salóm',NULL,73,NULL),(246,'Sifontes',NULL,74,NULL),(247,'Dalla Costa',NULL,74,NULL),(248,'San Isidro',NULL,74,NULL),(249,'Sucre',NULL,75,NULL),(250,'Aripao',NULL,75,NULL),(251,'Guarataro',NULL,75,NULL),(252,'Las Majadas',NULL,75,NULL),(253,'Moitaco',NULL,75,NULL),(254,'Padre Pedro Chien',NULL,76,NULL),(255,'Río Grande',NULL,76,NULL),(256,'Bejuma',NULL,77,NULL),(257,'Canoabo',NULL,77,NULL),(258,'Simón Bolívar',NULL,77,NULL),(259,'Güigüe',NULL,78,NULL),(260,'Carabobo',NULL,78,NULL),(261,'Tacarigua',NULL,78,NULL),(262,'Mariara',NULL,79,NULL),(263,'Aguas Calientes',NULL,79,NULL),(264,'Ciudad Alianza',NULL,80,NULL),(265,'Guacara',NULL,80,NULL),(266,'Yagua',NULL,80,NULL),(267,'Morón',NULL,81,NULL),(268,'Yagua',NULL,81,NULL),(269,'Tocuyito',NULL,82,NULL),(270,'Independencia',NULL,82,NULL),(271,'Los Guayos',NULL,83,NULL),(272,'Miranda',NULL,84,NULL),(273,'Montalbán',NULL,85,NULL),(274,'Naguanagua',NULL,86,NULL),(275,'Bartolomé Salóm',NULL,87,NULL),(276,'Democracia',NULL,87,NULL),(277,'Fraternidad',NULL,87,NULL),(278,'Goaigoaza',NULL,87,NULL),(279,'Juan José Flores',NULL,87,NULL),(280,'Unión',NULL,87,NULL),(281,'Borburata',NULL,87,NULL),(282,'Patanemo',NULL,87,NULL),(283,'San Diego',NULL,88,NULL),(284,'San Joaquín',NULL,89,NULL),(285,'Candelaria',NULL,90,NULL),(286,'Catedral',NULL,90,NULL),(287,'El Socorro',NULL,90,NULL),(288,'Miguel Peña',NULL,90,NULL),(289,'Rafael Urdaneta',NULL,90,NULL),(290,'San Blas',NULL,90,NULL),(291,'San José',NULL,90,NULL),(292,'Santa Rosa',NULL,90,NULL),(293,'Negro Primero',NULL,90,NULL),(294,'Cojedes',NULL,91,NULL),(295,'Juan de Mata Suárez',NULL,91,NULL),(296,'Tinaquillo',NULL,92,NULL),(297,'El Baúl',NULL,93,NULL),(298,'Sucre',NULL,93,NULL),(299,'La Aguadita',NULL,94,NULL),(300,'Macapo',NULL,94,NULL),(301,'El Pao',NULL,95,NULL),(302,'El Amparo',NULL,96,NULL),(303,'Libertad de Cojedes',NULL,96,NULL),(304,'Rómulo Gallegos',NULL,97,NULL),(305,'San Carlos de Austria',NULL,98,NULL),(306,'Juan Ángel Bravo',NULL,98,NULL),(307,'Manuel Manrique',NULL,98,NULL),(308,'General en Jefe José Laurencio Silva',NULL,99,NULL),(309,'Curiapo',NULL,100,NULL),(310,'Almirante Luis Brión',NULL,100,NULL),(311,'Francisco Aniceto Lugo',NULL,100,NULL),(312,'Manuel Renaud',NULL,100,NULL),(313,'Padre Barral',NULL,100,NULL),(314,'Santos de Abelgas',NULL,100,NULL),(315,'Imataca',NULL,101,NULL),(316,'Cinco de Julio',NULL,101,NULL),(317,'Juan Bautista Arismendi',NULL,101,NULL),(318,'Manuel Piar',NULL,101,NULL),(319,'Rómulo Gallegos',NULL,101,NULL),(320,'Pedernales',NULL,102,NULL),(321,'Luis Beltrán Prieto Figueroa',NULL,102,NULL),(322,'San José (Delta Amacuro)',NULL,103,NULL),(323,'José Vidal Marcano',NULL,103,NULL),(324,'Juan Millán',NULL,103,NULL),(325,'Leonardo Ruíz Pineda',NULL,103,NULL),(326,'Mariscal Antonio José de Sucre',NULL,103,NULL),(327,'Monseñor Argimiro García',NULL,103,NULL),(328,'San Rafael (Delta Amacuro)',NULL,103,NULL),(329,'Virgen del Valle',NULL,103,NULL),(330,'Clarines',NULL,10,NULL),(331,'Guanape',NULL,10,NULL),(332,'Sabana de Uchire',NULL,10,NULL),(333,'Capadare',NULL,104,NULL),(334,'La Pastora',NULL,104,NULL),(335,'Libertador',NULL,104,NULL),(336,'San Juan de los Cayos',NULL,104,NULL),(337,'Aracua',NULL,105,NULL),(338,'La Peña',NULL,105,NULL),(339,'San Luis',NULL,105,NULL),(340,'Bariro',NULL,106,NULL),(341,'Borojó',NULL,106,NULL),(342,'Capatárida',NULL,106,NULL),(343,'Guajiro',NULL,106,NULL),(344,'Seque',NULL,106,NULL),(345,'Zazárida',NULL,106,NULL),(346,'Valle de Eroa',NULL,106,NULL),(347,'Cacique Manaure',NULL,107,NULL),(348,'Norte',NULL,108,NULL),(349,'Carirubana',NULL,108,NULL),(350,'Santa Ana',NULL,108,NULL),(351,'Urbana Punta Cardón',NULL,108,NULL),(352,'La Vela de Coro',NULL,109,NULL),(353,'Acurigua',NULL,109,NULL),(354,'Guaibacoa',NULL,109,NULL),(355,'Las Calderas',NULL,109,NULL),(356,'Macoruca',NULL,109,NULL),(357,'Dabajuro',NULL,110,NULL),(358,'Agua Clara',NULL,111,NULL),(359,'Avaria',NULL,111,NULL),(360,'Pedregal',NULL,111,NULL),(361,'Piedra Grande',NULL,111,NULL),(362,'Purureche',NULL,111,NULL),(363,'Adaure',NULL,112,NULL),(364,'Adícora',NULL,112,NULL),(365,'Baraived',NULL,112,NULL),(366,'Buena Vista',NULL,112,NULL),(367,'Jadacaquiva',NULL,112,NULL),(368,'El Vínculo',NULL,112,NULL),(369,'El Hato',NULL,112,NULL),(370,'Moruy',NULL,112,NULL),(371,'Pueblo Nuevo',NULL,112,NULL),(372,'Agua Larga',NULL,113,NULL),(373,'El Paují',NULL,113,NULL),(374,'Independencia',NULL,113,NULL),(375,'Mapararí',NULL,113,NULL),(376,'Agua Linda',NULL,114,NULL),(377,'Araurima',NULL,114,NULL),(378,'Jacura',NULL,114,NULL),(379,'Tucacas',NULL,115,NULL),(380,'Boca de Aroa',NULL,115,NULL),(381,'Los Taques',NULL,116,NULL),(382,'Judibana',NULL,116,NULL),(383,'Mene de Mauroa',NULL,117,NULL),(384,'San Félix',NULL,117,NULL),(385,'Casigua',NULL,117,NULL),(386,'Guzmán Guillermo',NULL,118,NULL),(387,'Mitare',NULL,118,NULL),(388,'Río Seco',NULL,118,NULL),(389,'Sabaneta',NULL,118,NULL),(390,'San Antonio',NULL,118,NULL),(391,'San Gabriel',NULL,118,NULL),(392,'Santa Ana',NULL,118,NULL),(393,'Boca del Tocuyo',NULL,119,NULL),(394,'Chichiriviche',NULL,119,NULL),(395,'Tocuyo de la Costa',NULL,119,NULL),(396,'Palmasola',NULL,120,NULL),(397,'Cabure',NULL,121,NULL),(398,'Colina',NULL,121,NULL),(399,'Curimagua',NULL,121,NULL),(400,'San José de la Costa',NULL,122,NULL),(401,'Píritu',NULL,122,NULL),(402,'San Francisco',NULL,123,NULL),(403,'Sucre',NULL,124,NULL),(404,'Pecaya',NULL,124,NULL),(405,'Tocópero',NULL,125,NULL),(406,'El Charal',NULL,126,NULL),(407,'Las Vegas del Tuy',NULL,126,NULL),(408,'Santa Cruz de Bucaral',NULL,126,NULL),(409,'Bruzual',NULL,127,NULL),(410,'Urumaco',NULL,127,NULL),(411,'Puerto Cumarebo',NULL,128,NULL),(412,'La Ciénaga',NULL,128,NULL),(413,'La Soledad',NULL,128,NULL),(414,'Pueblo Cumarebo',NULL,128,NULL),(415,'Zazárida',NULL,128,NULL),(416,'Churuguara',NULL,113,NULL),(417,'Camaguán',NULL,129,NULL),(418,'Puerto Miranda',NULL,129,NULL),(419,'Uverito',NULL,129,NULL),(420,'Chaguaramas',NULL,130,NULL),(421,'El Socorro',NULL,131,NULL),(422,'Tucupido',NULL,132,NULL),(423,'San Rafael de Laya',NULL,132,NULL),(424,'Altagracia de Orituco',NULL,133,NULL),(425,'San Rafael de Orituco',NULL,133,NULL),(426,'San Francisco Javier de Lezama',NULL,133,NULL),(427,'Paso Real de Macaira',NULL,133,NULL),(428,'Carlos Soublette',NULL,133,NULL),(429,'San Francisco de Macaira',NULL,133,NULL),(430,'Libertad de Orituco',NULL,133,NULL),(431,'Cantaclaro',NULL,134,NULL),(432,'San Juan de los Morros',NULL,134,NULL),(433,'Parapara',NULL,134,NULL),(434,'El Sombrero',NULL,135,NULL),(435,'Sosa',NULL,135,NULL),(436,'Las Mercedes',NULL,136,NULL),(437,'Cabruta',NULL,136,NULL),(438,'Santa Rita de Manapire',NULL,136,NULL),(439,'Valle de la Pascua',NULL,137,NULL),(440,'Espino',NULL,137,NULL),(441,'San José de Unare',NULL,138,NULL),(442,'Zaraza',NULL,138,NULL),(443,'San José de Tiznados',NULL,139,NULL),(444,'San Francisco de Tiznados',NULL,139,NULL),(445,'San Lorenzo de Tiznados',NULL,139,NULL),(446,'Ortiz',NULL,139,NULL),(447,'Guayabal',NULL,140,NULL),(448,'Cazorla',NULL,140,NULL),(449,'San José de Guaribe',NULL,141,NULL),(450,'Uveral',NULL,141,NULL),(451,'Santa María de Ipire',NULL,142,NULL),(452,'Altamira',NULL,142,NULL),(453,'El Calvario',NULL,143,NULL),(454,'El Rastro',NULL,143,NULL),(455,'Guardatinajas',NULL,143,NULL),(456,'Capital Urbana Calabozo',NULL,143,NULL),(457,'Quebrada Honda de Guache',NULL,144,NULL),(458,'Pío Tamayo',NULL,144,NULL),(459,'Yacambú',NULL,144,NULL),(460,'Fréitez',NULL,145,NULL),(461,'José María Blanco',NULL,145,NULL),(462,'Catedral',NULL,146,NULL),(463,'Concepción',NULL,146,NULL),(464,'El Cují',NULL,146,NULL),(465,'Juan de Villegas',NULL,146,NULL),(466,'Santa Rosa',NULL,146,NULL),(467,'Tamaca',NULL,146,NULL),(468,'Unión',NULL,146,NULL),(469,'Aguedo Felipe Alvarado',NULL,146,NULL),(470,'Buena Vista',NULL,146,NULL),(471,'Juárez',NULL,146,NULL),(472,'Juan Bautista Rodríguez',NULL,147,NULL),(473,'Cuara',NULL,147,NULL),(474,'Diego de Lozada',NULL,147,NULL),(475,'Paraíso de San José',NULL,147,NULL),(476,'San Miguel',NULL,147,NULL),(477,'Tintorero',NULL,147,NULL),(478,'José Bernardo Dorante',NULL,147,NULL),(479,'Coronel Mariano Peraza ',NULL,147,NULL),(480,'Bolívar',NULL,148,NULL),(481,'Anzoátegui',NULL,148,NULL),(482,'Guarico',NULL,148,NULL),(483,'Hilario Luna y Luna',NULL,148,NULL),(484,'Humocaro Alto',NULL,148,NULL),(485,'Humocaro Bajo',NULL,148,NULL),(486,'La Candelaria',NULL,148,NULL),(487,'Morán',NULL,148,NULL),(488,'Cabudare',NULL,149,NULL),(489,'José Gregorio Bastidas',NULL,149,NULL),(490,'Agua Viva',NULL,149,NULL),(491,'Sarare',NULL,150,NULL),(492,'Buría',NULL,150,NULL),(493,'Gustavo Vegas León',NULL,150,NULL),(494,'Trinidad Samuel',NULL,151,NULL),(495,'Antonio Díaz',NULL,151,NULL),(496,'Camacaro',NULL,151,NULL),(497,'Castañeda',NULL,151,NULL),(498,'Cecilio Zubillaga',NULL,151,NULL),(499,'Chiquinquirá',NULL,151,NULL),(500,'El Blanco',NULL,151,NULL),(501,'Espinoza de los Monteros',NULL,151,NULL),(502,'Lara',NULL,151,NULL),(503,'Las Mercedes',NULL,151,NULL),(504,'Manuel Morillo',NULL,151,NULL),(505,'Montaña Verde',NULL,151,NULL),(506,'Montes de Oca',NULL,151,NULL),(507,'Torres',NULL,151,NULL),(508,'Heriberto Arroyo',NULL,151,NULL),(509,'Reyes Vargas',NULL,151,NULL),(510,'Altagracia',NULL,151,NULL),(511,'Siquisique',NULL,152,NULL),(512,'Moroturo',NULL,152,NULL),(513,'San Miguel',NULL,152,NULL),(514,'Xaguas',NULL,152,NULL),(515,'Presidente Betancourt',NULL,179,NULL),(516,'Presidente Páez',NULL,179,NULL),(517,'Presidente Rómulo Gallegos',NULL,179,NULL),(518,'Gabriel Picón González',NULL,179,NULL),(519,'Héctor Amable Mora',NULL,179,NULL),(520,'José Nucete Sardi',NULL,179,NULL),(521,'Pulido Méndez',NULL,179,NULL),(522,'La Azulita',NULL,180,NULL),(523,'Santa Cruz de Mora',NULL,181,NULL),(524,'Mesa Bolívar',NULL,181,NULL),(525,'Mesa de Las Palmas',NULL,181,NULL),(526,'Aricagua',NULL,182,NULL),(527,'San Antonio',NULL,182,NULL),(528,'Canagua',NULL,183,NULL),(529,'Capurí',NULL,183,NULL),(530,'Chacantá',NULL,183,NULL),(531,'El Molino',NULL,183,NULL),(532,'Guaimaral',NULL,183,NULL),(533,'Mucutuy',NULL,183,NULL),(534,'Mucuchachí',NULL,183,NULL),(535,'Fernández Peña',NULL,184,NULL),(536,'Matriz',NULL,184,NULL),(537,'Montalbán',NULL,184,NULL),(538,'Acequias',NULL,184,NULL),(539,'Jají',NULL,184,NULL),(540,'La Mesa',NULL,184,NULL),(541,'San José del Sur',NULL,184,NULL),(542,'Tucaní',NULL,185,NULL),(543,'Florencio Ramírez',NULL,185,NULL),(544,'Santo Domingo',NULL,186,NULL),(545,'Las Piedras',NULL,186,NULL),(546,'Guaraque',NULL,187,NULL),(547,'Mesa de Quintero',NULL,187,NULL),(548,'Río Negro',NULL,187,NULL),(549,'Arapuey',NULL,188,NULL),(550,'Palmira',NULL,188,NULL),(551,'San Cristóbal de Torondoy',NULL,189,NULL),(552,'Torondoy',NULL,189,NULL),(553,'Antonio Spinetti Dini',NULL,190,NULL),(554,'Arias',NULL,190,NULL),(555,'Caracciolo Parra Pérez',NULL,190,NULL),(556,'Domingo Peña',NULL,190,NULL),(557,'El Llano',NULL,190,NULL),(558,'Gonzalo Picón Febres',NULL,190,NULL),(559,'Jacinto Plaza',NULL,190,NULL),(560,'Juan Rodríguez Suárez',NULL,190,NULL),(561,'Lasso de la Vega',NULL,190,NULL),(562,'Mariano Picón Salas',NULL,190,NULL),(563,'Milla',NULL,190,NULL),(564,'Osuna Rodríguez',NULL,190,NULL),(565,'Sagrario',NULL,190,NULL),(566,'El Morro',NULL,190,NULL),(567,'Los Nevados',NULL,190,NULL),(568,'Andrés Eloy Blanco',NULL,191,NULL),(569,'La Venta',NULL,191,NULL),(570,'Piñango',NULL,191,NULL),(571,'Timotes',NULL,191,NULL),(572,'Eloy Paredes',NULL,192,NULL),(573,'San Rafael de Alcázar',NULL,192,NULL),(574,'Santa Elena de Arenales',NULL,192,NULL),(575,'Santa María de Caparo',NULL,193,NULL),(576,'Pueblo Llano',NULL,194,NULL),(577,'Cacute',NULL,195,NULL),(578,'La Toma',NULL,195,NULL),(579,'Mucuchíes',NULL,195,NULL),(580,'Mucurubá',NULL,195,NULL),(581,'San Rafael',NULL,195,NULL),(582,'Gerónimo Maldonado',NULL,196,NULL),(583,'Bailadores',NULL,196,NULL),(584,'Tabay',NULL,197,NULL),(585,'Chiguará',NULL,198,NULL),(586,'Estánquez',NULL,198,NULL),(587,'Lagunillas',NULL,198,NULL),(588,'La Trampa',NULL,198,NULL),(589,'Pueblo Nuevo del Sur',NULL,198,NULL),(590,'San Juan',NULL,198,NULL),(591,'El Amparo',NULL,199,NULL),(592,'El Llano',NULL,199,NULL),(593,'San Francisco',NULL,199,NULL),(594,'Tovar',NULL,199,NULL),(595,'Independencia',NULL,200,NULL),(596,'María de la Concepción Palacios Blanco',NULL,200,NULL),(597,'Nueva Bolivia',NULL,200,NULL),(598,'Santa Apolonia',NULL,200,NULL),(599,'Caño El Tigre',NULL,201,NULL),(600,'Zea',NULL,201,NULL),(601,'Aragüita',NULL,223,NULL),(602,'Arévalo González',NULL,223,NULL),(603,'Capaya',NULL,223,NULL),(604,'Caucagua',NULL,223,NULL),(605,'Panaquire',NULL,223,NULL),(606,'Ribas',NULL,223,NULL),(607,'El Café',NULL,223,NULL),(608,'Marizapa',NULL,223,NULL),(609,'Cumbo',NULL,224,NULL),(610,'San José de Barlovento',NULL,224,NULL),(611,'El Cafetal',NULL,225,NULL),(612,'Las Minas',NULL,225,NULL),(613,'Nuestra Señora del Rosario',NULL,225,NULL),(614,'Higuerote',NULL,226,NULL),(615,'Curiepe',NULL,226,NULL),(616,'Tacarigua de Brión',NULL,226,NULL),(617,'Mamporal',NULL,227,NULL),(618,'Carrizal',NULL,228,NULL),(619,'Chacao',NULL,229,NULL),(620,'Charallave',NULL,230,NULL),(621,'Las Brisas',NULL,230,NULL),(622,'El Hatillo',NULL,231,NULL),(623,'Altagracia de la Montaña',NULL,232,NULL),(624,'Cecilio Acosta',NULL,232,NULL),(625,'Los Teques',NULL,232,NULL),(626,'El Jarillo',NULL,232,NULL),(627,'San Pedro',NULL,232,NULL),(628,'Tácata',NULL,232,NULL),(629,'Paracotos',NULL,232,NULL),(630,'Cartanal',NULL,233,NULL),(631,'Santa Teresa del Tuy',NULL,233,NULL),(632,'La Democracia',NULL,234,NULL),(633,'Ocumare del Tuy',NULL,234,NULL),(634,'Santa Bárbara',NULL,234,NULL),(635,'San Antonio de los Altos',NULL,235,NULL),(636,'Río Chico',NULL,236,NULL),(637,'El Guapo',NULL,236,NULL),(638,'Tacarigua de la Laguna',NULL,236,NULL),(639,'Paparo',NULL,236,NULL),(640,'San Fernando del Guapo',NULL,236,NULL),(641,'Santa Lucía del Tuy',NULL,237,NULL),(642,'Cúpira',NULL,238,NULL),(643,'Machurucuto',NULL,238,NULL),(644,'Guarenas',NULL,239,NULL),(645,'San Antonio de Yare',NULL,240,NULL),(646,'San Francisco de Yare',NULL,240,NULL),(647,'Leoncio Martínez',NULL,241,NULL),(648,'Petare',NULL,241,NULL),(649,'Caucagüita',NULL,241,NULL),(650,'Filas de Mariche',NULL,241,NULL),(651,'La Dolorita',NULL,241,NULL),(652,'Cúa',NULL,242,NULL),(653,'Nueva Cúa',NULL,242,NULL),(654,'Guatire',NULL,243,NULL),(655,'Bolívar',NULL,243,NULL),(656,'San Antonio de Maturín',NULL,258,NULL),(657,'San Francisco de Maturín',NULL,258,NULL),(658,'Aguasay',NULL,259,NULL),(659,'Caripito',NULL,260,NULL),(660,'El Guácharo',NULL,261,NULL),(661,'La Guanota',NULL,261,NULL),(662,'Sabana de Piedra',NULL,261,NULL),(663,'San Agustín',NULL,261,NULL),(664,'Teresen',NULL,261,NULL),(665,'Caripe',NULL,261,NULL),(666,'Areo',NULL,262,NULL),(667,'Capital Cedeño',NULL,262,NULL),(668,'San Félix de Cantalicio',NULL,262,NULL),(669,'Viento Fresco',NULL,262,NULL),(670,'El Tejero',NULL,263,NULL),(671,'Punta de Mata',NULL,263,NULL),(672,'Chaguaramas',NULL,264,NULL),(673,'Las Alhuacas',NULL,264,NULL),(674,'Tabasca',NULL,264,NULL),(675,'Temblador',NULL,264,NULL),(676,'Alto de los Godos',NULL,265,NULL),(677,'Boquerón',NULL,265,NULL),(678,'Las Cocuizas',NULL,265,NULL),(679,'La Cruz',NULL,265,NULL),(680,'San Simón',NULL,265,NULL),(681,'El Corozo',NULL,265,NULL),(682,'El Furrial',NULL,265,NULL),(683,'Jusepín',NULL,265,NULL),(684,'La Pica',NULL,265,NULL),(685,'San Vicente',NULL,265,NULL),(686,'Aparicio',NULL,266,NULL),(687,'Aragua de Maturín',NULL,266,NULL),(688,'Chaguamal',NULL,266,NULL),(689,'El Pinto',NULL,266,NULL),(690,'Guanaguana',NULL,266,NULL),(691,'La Toscana',NULL,266,NULL),(692,'Taguaya',NULL,266,NULL),(693,'Cachipo',NULL,267,NULL),(694,'Quiriquire',NULL,267,NULL),(695,'Santa Bárbara',NULL,268,NULL),(696,'Barrancas',NULL,269,NULL),(697,'Los Barrancos de Fajardo',NULL,269,NULL),(698,'Uracoa',NULL,270,NULL),(699,'Antolín del Campo',NULL,271,NULL),(700,'Arismendi',NULL,272,NULL),(701,'García',NULL,273,NULL),(702,'Francisco Fajardo',NULL,273,NULL),(703,'Bolívar',NULL,274,NULL),(704,'Guevara',NULL,274,NULL),(705,'Matasiete',NULL,274,NULL),(706,'Santa Ana',NULL,274,NULL),(707,'Sucre',NULL,274,NULL),(708,'Aguirre',NULL,275,NULL),(709,'Maneiro',NULL,275,NULL),(710,'Adrián',NULL,276,NULL),(711,'Juan Griego',NULL,276,NULL),(712,'Yaguaraparo',NULL,276,NULL),(713,'Porlamar',NULL,277,NULL),(714,'San Francisco de Macanao',NULL,278,NULL),(715,'Boca de Río',NULL,278,NULL),(716,'Tubores',NULL,279,NULL),(717,'Los Baleales',NULL,279,NULL),(718,'Vicente Fuentes',NULL,280,NULL),(719,'Villalba',NULL,280,NULL),(720,'San Juan Bautista',NULL,281,NULL),(721,'Zabala',NULL,281,NULL),(722,'Capital Araure',NULL,283,NULL),(723,'Río Acarigua',NULL,283,NULL),(724,'Capital Esteller',NULL,284,NULL),(725,'Uveral',NULL,284,NULL),(726,'Guanare',NULL,285,NULL),(727,'Córdoba',NULL,285,NULL),(728,'San José de la Montaña',NULL,285,NULL),(729,'San Juan de Guanaguanare',NULL,285,NULL),(730,'Virgen de la Coromoto',NULL,285,NULL),(731,'Guanarito',NULL,286,NULL),(732,'Trinidad de la Capilla',NULL,286,NULL),(733,'Divina Pastora',NULL,286,NULL),(734,'Monseñor José Vicente de Unda',NULL,287,NULL),(735,'Peña Blanca',NULL,287,NULL),(736,'Capital Ospino',NULL,288,NULL),(737,'Aparición',NULL,288,NULL),(738,'La Estación',NULL,288,NULL),(739,'Páez',NULL,289,NULL),(740,'Payara',NULL,289,NULL),(741,'Pimpinela',NULL,289,NULL),(742,'Ramón Peraza',NULL,289,NULL),(743,'Papelón',NULL,290,NULL),(744,'Caño Delgadito',NULL,290,NULL),(745,'San Genaro de Boconoito',NULL,291,NULL),(746,'Antolín Tovar',NULL,291,NULL),(747,'San Rafael de Onoto',NULL,292,NULL),(748,'Santa Fe',NULL,292,NULL),(749,'Thermo Morles',NULL,292,NULL),(750,'Santa Rosalía',NULL,293,NULL),(751,'Florida',NULL,293,NULL),(752,'Sucre',NULL,294,NULL),(753,'Concepción',NULL,294,NULL),(754,'San Rafael de Palo Alzado',NULL,294,NULL),(755,'Uvencio Antonio Velásquez',NULL,294,NULL),(756,'San José de Saguaz',NULL,294,NULL),(757,'Villa Rosa',NULL,294,NULL),(758,'Turén',NULL,295,NULL),(759,'Canelones',NULL,295,NULL),(760,'Santa Cruz',NULL,295,NULL),(761,'San Isidro Labrador',NULL,295,NULL),(762,'Mariño',NULL,296,NULL),(763,'Rómulo Gallegos',NULL,296,NULL),(764,'San José de Aerocuar',NULL,297,NULL),(765,'Tavera Acosta',NULL,297,NULL),(766,'Río Caribe',NULL,298,NULL),(767,'Antonio José de Sucre',NULL,298,NULL),(768,'El Morro de Puerto Santo',NULL,298,NULL),(769,'Puerto Santo',NULL,298,NULL),(770,'San Juan de las Galdonas',NULL,298,NULL),(771,'El Pilar',NULL,299,NULL),(772,'El Rincón',NULL,299,NULL),(773,'General Francisco Antonio Váquez',NULL,299,NULL),(774,'Guaraúnos',NULL,299,NULL),(775,'Tunapuicito',NULL,299,NULL),(776,'Unión',NULL,299,NULL),(777,'Santa Catalina',NULL,300,NULL),(778,'Santa Rosa',NULL,300,NULL),(779,'Santa Teresa',NULL,300,NULL),(780,'Bolívar',NULL,300,NULL),(781,'Maracapana',NULL,300,NULL),(782,'Libertad',NULL,302,NULL),(783,'El Paujil',NULL,302,NULL),(784,'Yaguaraparo',NULL,302,NULL),(785,'Cruz Salmerón Acosta',NULL,303,NULL),(786,'Chacopata',NULL,303,NULL),(787,'Manicuare',NULL,303,NULL),(788,'Tunapuy',NULL,304,NULL),(789,'Campo Elías',NULL,304,NULL),(790,'Irapa',NULL,305,NULL),(791,'Campo Claro',NULL,305,NULL),(792,'Maraval',NULL,305,NULL),(793,'San Antonio de Irapa',NULL,305,NULL),(794,'Soro',NULL,305,NULL),(795,'Mejía',NULL,306,NULL),(796,'Cumanacoa',NULL,307,NULL),(797,'Arenas',NULL,307,NULL),(798,'Aricagua',NULL,307,NULL),(799,'Cogollar',NULL,307,NULL),(800,'San Fernando',NULL,307,NULL),(801,'San Lorenzo',NULL,307,NULL),(802,'Villa Frontado (Muelle de Cariaco)',NULL,308,NULL),(803,'Catuaro',NULL,308,NULL),(804,'Rendón',NULL,308,NULL),(805,'San Cruz',NULL,308,NULL),(806,'Santa María',NULL,308,NULL),(807,'Altagracia',NULL,309,NULL),(808,'Santa Inés',NULL,309,NULL),(809,'Valentín Valiente',NULL,309,NULL),(810,'Ayacucho',NULL,309,NULL),(811,'San Juan',NULL,309,NULL),(812,'Raúl Leoni',NULL,309,NULL),(813,'Gran Mariscal',NULL,309,NULL),(814,'Cristóbal Colón',NULL,310,NULL),(815,'Bideau',NULL,310,NULL),(816,'Punta de Piedras',NULL,310,NULL),(817,'Güiria',NULL,310,NULL),(818,'Andrés Bello',NULL,341,NULL),(819,'Antonio Rómulo Costa',NULL,342,NULL),(820,'Ayacucho',NULL,343,NULL),(821,'Rivas Berti',NULL,343,NULL),(822,'San Pedro del Río',NULL,343,NULL),(823,'Bolívar',NULL,344,NULL),(824,'Palotal',NULL,344,NULL),(825,'General Juan Vicente Gómez',NULL,344,NULL),(826,'Isaías Medina Angarita',NULL,344,NULL),(827,'Cárdenas',NULL,345,NULL),(828,'Amenodoro Ángel Lamus',NULL,345,NULL),(829,'La Florida',NULL,345,NULL),(830,'Córdoba',NULL,346,NULL),(831,'Fernández Feo',NULL,347,NULL),(832,'Alberto Adriani',NULL,347,NULL),(833,'Santo Domingo',NULL,347,NULL),(834,'Francisco de Miranda',NULL,348,NULL),(835,'García de Hevia',NULL,349,NULL),(836,'Boca de Grita',NULL,349,NULL),(837,'José Antonio Páez',NULL,349,NULL),(838,'Guásimos',NULL,350,NULL),(839,'Independencia',NULL,351,NULL),(840,'Juan Germán Roscio',NULL,351,NULL),(841,'Román Cárdenas',NULL,351,NULL),(842,'Jáuregui',NULL,352,NULL),(843,'Emilio Constantino Guerrero',NULL,352,NULL),(844,'Monseñor Miguel Antonio Salas',NULL,352,NULL),(845,'José María Vargas',NULL,353,NULL),(846,'Junín',NULL,354,NULL),(847,'La Petrólea',NULL,354,NULL),(848,'Quinimarí',NULL,354,NULL),(849,'Bramón',NULL,354,NULL),(850,'Libertad',NULL,355,NULL),(851,'Cipriano Castro',NULL,355,NULL),(852,'Manuel Felipe Rugeles',NULL,355,NULL),(853,'Libertador',NULL,356,NULL),(854,'Doradas',NULL,356,NULL),(855,'Emeterio Ochoa',NULL,356,NULL),(856,'San Joaquín de Navay',NULL,356,NULL),(857,'Lobatera',NULL,357,NULL),(858,'Constitución',NULL,357,NULL),(859,'Michelena',NULL,358,NULL),(860,'Panamericano',NULL,359,NULL),(861,'La Palmita',NULL,359,NULL),(862,'Pedro María Ureña',NULL,360,NULL),(863,'Nueva Arcadia',NULL,360,NULL),(864,'Delicias',NULL,361,NULL),(865,'Pecaya',NULL,361,NULL),(866,'Samuel Darío Maldonado',NULL,362,NULL),(867,'Boconó',NULL,362,NULL),(868,'Hernández',NULL,362,NULL),(869,'La Concordia',NULL,363,NULL),(870,'San Juan Bautista',NULL,363,NULL),(871,'Pedro María Morantes',NULL,363,NULL),(872,'San Sebastián',NULL,363,NULL),(873,'Dr. Francisco Romero Lobo',NULL,363,NULL),(874,'Seboruco',NULL,364,NULL),(875,'Simón Rodríguez',NULL,365,NULL),(876,'Sucre',NULL,366,NULL),(877,'Eleazar López Contreras',NULL,366,NULL),(878,'San Pablo',NULL,366,NULL),(879,'Torbes',NULL,367,NULL),(880,'Uribante',NULL,368,NULL),(881,'Cárdenas',NULL,368,NULL),(882,'Juan Pablo Peñalosa',NULL,368,NULL),(883,'Potosí',NULL,368,NULL),(884,'San Judas Tadeo',NULL,369,NULL),(885,'Araguaney',NULL,370,NULL),(886,'El Jaguito',NULL,370,NULL),(887,'La Esperanza',NULL,370,NULL),(888,'Santa Isabel',NULL,370,NULL),(889,'Boconó',NULL,371,NULL),(890,'El Carmen',NULL,371,NULL),(891,'Mosquey',NULL,371,NULL),(892,'Ayacucho',NULL,371,NULL),(893,'Burbusay',NULL,371,NULL),(894,'General Ribas',NULL,371,NULL),(895,'Guaramacal',NULL,371,NULL),(896,'Vega de Guaramacal',NULL,371,NULL),(897,'Monseñor Jáuregui',NULL,371,NULL),(898,'Rafael Rangel',NULL,371,NULL),(899,'San Miguel',NULL,371,NULL),(900,'San José',NULL,371,NULL),(901,'Sabana Grande',NULL,372,NULL),(902,'Cheregüé',NULL,372,NULL),(903,'Granados',NULL,372,NULL),(904,'Arnoldo Gabaldón',NULL,373,NULL),(905,'Bolivia',NULL,373,NULL),(906,'Carrillo',NULL,373,NULL),(907,'Cegarra',NULL,373,NULL),(908,'Chejendé',NULL,373,NULL),(909,'Manuel Salvador Ulloa',NULL,373,NULL),(910,'San José',NULL,373,NULL),(911,'Carache',NULL,374,NULL),(912,'La Concepción',NULL,374,NULL),(913,'Cuicas',NULL,374,NULL),(914,'Panamericana',NULL,374,NULL),(915,'Santa Cruz',NULL,374,NULL),(916,'Escuque',NULL,375,NULL),(917,'La Unión',NULL,375,NULL),(918,'Santa Rita',NULL,375,NULL),(919,'Sabana Libre',NULL,375,NULL),(920,'El Socorro',NULL,376,NULL),(921,'Los Caprichos',NULL,376,NULL),(922,'Antonio José de Sucre',NULL,376,NULL),(923,'Campo Elías',NULL,377,NULL),(924,'Arnoldo Gabaldón',NULL,377,NULL),(925,'Santa Apolonia',NULL,378,NULL),(926,'El Progreso',NULL,378,NULL),(927,'La Ceiba',NULL,378,NULL),(928,'Tres de Febrero',NULL,378,NULL),(929,'El Dividive',NULL,379,NULL),(930,'Agua Santa',NULL,379,NULL),(931,'Agua Caliente',NULL,379,NULL),(932,'El Cenizo',NULL,379,NULL),(933,'Valerita',NULL,379,NULL),(934,'Monte Carmelo',NULL,380,NULL),(935,'Buena Vista',NULL,380,NULL),(936,'Santa María del Horcón',NULL,380,NULL),(937,'Motatán',NULL,381,NULL),(938,'El Baño',NULL,381,NULL),(939,'Jalisco',NULL,381,NULL),(940,'Pampán',NULL,382,NULL),(941,'Flor de Patria',NULL,382,NULL),(942,'La Paz',NULL,382,NULL),(943,'Santa Ana',NULL,382,NULL),(944,'Pampanito',NULL,383,NULL),(945,'La Concepción',NULL,383,NULL),(946,'Pampanito II',NULL,383,NULL),(947,'Betijoque',NULL,384,NULL),(948,'José Gregorio Hernández',NULL,384,NULL),(949,'La Pueblita',NULL,384,NULL),(950,'Los Cedros',NULL,384,NULL),(951,'Carvajal',NULL,385,NULL),(952,'Campo Alegre',NULL,385,NULL),(953,'Antonio Nicolás Briceño',NULL,385,NULL),(954,'José Leonardo Suárez',NULL,385,NULL),(955,'Sabana de Mendoza',NULL,386,NULL),(956,'Junín',NULL,386,NULL),(957,'Valmore Rodríguez',NULL,386,NULL),(958,'El Paraíso',NULL,386,NULL),(959,'Andrés Linares',NULL,387,NULL),(960,'Chiquinquirá',NULL,387,NULL),(961,'Cristóbal Mendoza',NULL,387,NULL),(962,'Cruz Carrillo',NULL,387,NULL),(963,'Matriz',NULL,387,NULL),(964,'Monseñor Carrillo',NULL,387,NULL),(965,'Tres Esquinas',NULL,387,NULL),(966,'Cabimbú',NULL,388,NULL),(967,'Jajó',NULL,388,NULL),(968,'La Mesa de Esnujaque',NULL,388,NULL),(969,'Santiago',NULL,388,NULL),(970,'Tuñame',NULL,388,NULL),(971,'La Quebrada',NULL,388,NULL),(972,'Juan Ignacio Montilla',NULL,389,NULL),(973,'La Beatriz',NULL,389,NULL),(974,'La Puerta',NULL,389,NULL),(975,'Mendoza del Valle de Momboy',NULL,389,NULL),(976,'Mercedes Díaz',NULL,389,NULL),(977,'San Luis',NULL,389,NULL),(978,'Caraballeda',NULL,390,NULL),(979,'Carayaca',NULL,390,NULL),(980,'Carlos Soublette',NULL,390,NULL),(981,'Caruao Chuspa',NULL,390,NULL),(982,'Catia La Mar',NULL,390,NULL),(983,'El Junko',NULL,390,NULL),(984,'La Guaira',NULL,390,NULL),(985,'Macuto',NULL,390,NULL),(986,'Maiquetía',NULL,390,NULL),(987,'Naiguatá',NULL,390,NULL),(988,'Urimare',NULL,390,NULL),(989,'Arístides Bastidas',NULL,391,NULL),(990,'Bolívar',NULL,392,NULL),(991,'Chivacoa',NULL,407,NULL),(992,'Campo Elías',NULL,407,NULL),(993,'Cocorote',NULL,408,NULL),(994,'Independencia',NULL,409,NULL),(995,'José Antonio Páez',NULL,410,NULL),(996,'La Trinidad',NULL,411,NULL),(997,'Manuel Monge',NULL,412,NULL),(998,'Salóm',NULL,413,NULL),(999,'Temerla',NULL,413,NULL),(1000,'Nirgua',NULL,413,NULL),(1001,'San Andrés',NULL,414,NULL),(1002,'Yaritagua',NULL,414,NULL),(1003,'San Javier',NULL,415,NULL),(1004,'Albarico',NULL,415,NULL),(1005,'San Felipe',NULL,415,NULL),(1006,'Sucre',NULL,416,NULL),(1007,'Urachiche',NULL,417,NULL),(1008,'El Guayabo',NULL,418,NULL),(1009,'Farriar',NULL,418,NULL),(1010,'Isla de Toas',NULL,441,NULL),(1011,'Monagas',NULL,441,NULL),(1012,'San Timoteo',NULL,442,NULL),(1013,'General Urdaneta',NULL,442,NULL),(1014,'Libertador',NULL,442,NULL),(1015,'Marcelino Briceño',NULL,442,NULL),(1016,'Pueblo Nuevo',NULL,442,NULL),(1017,'Manuel Guanipa Matos',NULL,442,NULL),(1018,'Ambrosio',NULL,443,NULL),(1019,'Carmen Herrera',NULL,443,NULL),(1020,'La Rosa',NULL,443,NULL),(1021,'Germán Ríos Linares',NULL,443,NULL),(1022,'San Benito',NULL,443,NULL),(1023,'Rómulo Betancourt',NULL,443,NULL),(1024,'Jorge Hernández',NULL,443,NULL),(1025,'Punta Gorda',NULL,443,NULL),(1026,'Arístides Calvani',NULL,443,NULL),(1027,'Encontrados',NULL,444,NULL),(1028,'Udón Pérez',NULL,444,NULL),(1029,'Moralito',NULL,445,NULL),(1030,'San Carlos del Zulia',NULL,445,NULL),(1031,'Santa Cruz del Zulia',NULL,445,NULL),(1032,'Santa Bárbara',NULL,445,NULL),(1033,'Urribarrí',NULL,445,NULL),(1034,'Carlos Quevedo',NULL,446,NULL),(1035,'Francisco Javier Pulgar',NULL,446,NULL),(1036,'Simón Rodríguez',NULL,446,NULL),(1037,'Guamo-Gavilanes',NULL,446,NULL),(1038,'La Concepción',NULL,448,NULL),(1039,'San José',NULL,448,NULL),(1040,'Mariano Parra León',NULL,448,NULL),(1041,'José Ramón Yépez',NULL,448,NULL),(1042,'Jesús María Semprún',NULL,449,NULL),(1043,'Barí',NULL,449,NULL),(1044,'Concepción',NULL,450,NULL),(1045,'Andrés Bello',NULL,450,NULL),(1046,'Chiquinquirá',NULL,450,NULL),(1047,'El Carmelo',NULL,450,NULL),(1048,'Potreritos',NULL,450,NULL),(1049,'Libertad',NULL,451,NULL),(1050,'Alonso de Ojeda',NULL,451,NULL),(1051,'Venezuela',NULL,451,NULL),(1052,'Eleazar López Contreras',NULL,451,NULL),(1053,'Campo Lara',NULL,451,NULL),(1054,'Bartolomé de las Casas',NULL,452,NULL),(1055,'Libertad',NULL,452,NULL),(1056,'Río Negro',NULL,452,NULL),(1057,'San José de Perijá',NULL,452,NULL),(1058,'San Rafael',NULL,453,NULL),(1059,'La Sierrita',NULL,453,NULL),(1060,'Las Parcelas',NULL,453,NULL),(1061,'Luis de Vicente',NULL,453,NULL),(1062,'Monseñor Marcos Sergio Godoy',NULL,453,NULL),(1063,'Ricaurte',NULL,453,NULL),(1064,'Tamare',NULL,453,NULL),(1065,'Antonio Borjas Romero',NULL,454,NULL),(1066,'Bolívar',NULL,454,NULL),(1067,'Cacique Mara',NULL,454,NULL),(1068,'Carracciolo Parra Pérez',NULL,454,NULL),(1069,'Cecilio Acosta',NULL,454,NULL),(1070,'Cristo de Aranza',NULL,454,NULL),(1071,'Coquivacoa',NULL,454,NULL),(1072,'Chiquinquirá',NULL,454,NULL),(1073,'Francisco Eugenio Bustamante',NULL,454,NULL),(1074,'Idelfonzo Vásquez',NULL,454,NULL),(1075,'Juana de Ávila',NULL,454,NULL),(1076,'Luis Hurtado Higuera',NULL,454,NULL),(1077,'Manuel Dagnino',NULL,454,NULL),(1078,'Olegario Villalobos',NULL,454,NULL),(1079,'Raúl Leoni',NULL,454,NULL),(1080,'Santa Lucía',NULL,454,NULL),(1081,'Venancio Pulgar',NULL,454,NULL),(1082,'San Isidro',NULL,454,NULL),(1083,'Altagracia',NULL,455,NULL),(1084,'Faría',NULL,455,NULL),(1085,'Ana María Campos',NULL,455,NULL),(1086,'San Antonio',NULL,455,NULL),(1087,'San José',NULL,455,NULL),(1088,'Donaldo García',NULL,456,NULL),(1089,'El Rosario',NULL,456,NULL),(1090,'Sixto Zambrano',NULL,456,NULL),(1091,'San Francisco',NULL,457,NULL),(1092,'El Bajo',NULL,457,NULL),(1093,'Domitila Flores',NULL,457,NULL),(1094,'Francisco Ochoa',NULL,457,NULL),(1095,'Los Cortijos',NULL,457,NULL),(1096,'Marcial Hernández',NULL,457,NULL),(1097,'Santa Rita',NULL,458,NULL),(1098,'El Mene',NULL,458,NULL),(1099,'Pedro Lucas Urribarrí',NULL,458,NULL),(1100,'José Cenobio Urribarrí',NULL,458,NULL),(1101,'Rafael Maria Baralt',NULL,459,NULL),(1102,'Manuel Manrique',NULL,459,NULL),(1103,'Rafael Urdaneta',NULL,459,NULL),(1104,'Bobures',NULL,460,NULL),(1105,'Gibraltar',NULL,460,NULL),(1106,'Heras',NULL,460,NULL),(1107,'Monseñor Arturo Álvarez',NULL,460,NULL),(1108,'Rómulo Gallegos',NULL,460,NULL),(1109,'El Batey',NULL,460,NULL),(1110,'Rafael Urdaneta',NULL,461,NULL),(1111,'La Victoria',NULL,461,NULL),(1112,'Raúl Cuenca',NULL,461,NULL),(1113,'Sinamaica',NULL,447,NULL),(1114,'Alta Guajira',NULL,447,NULL),(1115,'Elías Sánchez Rubio',NULL,447,NULL),(1116,'Guajira',NULL,447,NULL),(1117,'Altagracia',NULL,462,NULL),(1118,'Antímano',NULL,462,NULL),(1119,'Caricuao',NULL,462,NULL),(1120,'Catedral',NULL,462,NULL),(1121,'Coche',NULL,462,NULL),(1122,'El Junquito',NULL,462,NULL),(1123,'El Paraíso',NULL,462,NULL),(1124,'El Recreo',NULL,462,NULL),(1125,'El Valle',NULL,462,NULL),(1126,'La Candelaria',NULL,462,NULL),(1127,'La Pastora',NULL,462,NULL),(1128,'La Vega',NULL,462,NULL),(1129,'Macarao',NULL,462,NULL),(1130,'San Agustín',NULL,462,NULL),(1131,'San Bernardino',NULL,462,NULL),(1132,'San José',NULL,462,NULL),(1133,'San Juan',NULL,462,NULL),(1134,'San Pedro',NULL,462,NULL),(1135,'Santa Rosalía',NULL,462,NULL),(1136,'Santa Teresa',NULL,462,NULL),(1137,'Sucre (Catia)',NULL,462,NULL),(1138,'23 de enero',NULL,462,NULL);
UNLOCK TABLES;


DROP TABLE IF EXISTS `direcciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `direcciones` (
  `id_direccion` int(11) NOT NULL AUTO_INCREMENT,
  `cod_postal` smallint(4) unsigned NOT NULL,
  `sector` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `calle` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `ca_edf` varchar(8) COLLATE utf8_spanish_ci NOT NULL,
  `n_vivienda` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pto_ref` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_parroquia` int(11) NOT NULL,
  PRIMARY KEY (`id_direccion`),
  KEY `id_parroquia` (`id_parroquia`),
  CONSTRAINT `fk_parroq_direcc` FOREIGN KEY (`id_parroquia`) REFERENCES `parroquias` (`id_parroquia`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


DROP TABLE IF EXISTS `telefonos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `telefonos` (
  `id_telefono` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` enum('F','M','O') COLLATE utf8_spanish_ci NOT NULL,
  `cod_area` int(4) unsigned zerofill NOT NULL,
  `numero` int(7) unsigned zerofill NOT NULL,
  PRIMARY KEY (`id_telefono`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


DROP TABLE IF EXISTS `correos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `correos` (
  `id_correo` int(11) NOT NULL AUTO_INCREMENT,
  `direccion_correo` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_correo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

LOCK TABLES `roles` WRITE;
INSERT INTO `roles` VALUES (1,'Administrador'),(2,'Asistente');
UNLOCK TABLES;



DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `avatar` varchar(70) DEFAULT NULL,
  `id_rol` int(11) NOT NULL,
  `fecha_IN` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY (`usuario`),
  KEY `id_rol_user` (`id_rol`),
  CONSTRAINT `fk_id_rol_user` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


LOCK TABLES `usuarios` WRITE;
INSERT INTO `usuarios` VALUES (1,'admin','$2y$10$DwpvwARM3mET65jbM1BO/OqPqNmL1/9ET4zb07dribFdjuzvG8.vG',NULL,1, NULL);
UNLOCK TABLES;

  

DROP TABLE IF EXISTS `personas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personas` (
  `id_persona` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_ci` enum('V','E') DEFAULT 'V',
  `ci` int(8) unsigned zerofill DEFAULT NULL,
  `nombre1` varchar(20) NOT NULL,
  `nombre2` varchar(20) DEFAULT NULL,
  `nombre3` varchar(20) DEFAULT NULL,
  `apellido1` varchar(20) NOT NULL,
  `apellido2` varchar(20) DEFAULT NULL,
  `fecha_nac` date DEFAULT NULL,
  `sexo` enum('M','F') DEFAULT NULL,
  `edo_civil` enum('S','C','D','V') DEFAULT 'S',
  `id_direccion` int(11) DEFAULT NULL,
  `id_telefono` int(11) DEFAULT NULL,
  `id_correo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_persona`),
  UNIQUE KEY (`ci`),
  KEY `id_direccion_pers` (`id_direccion`),
  KEY `id_telefono_pers` (`id_telefono`),
  KEY `id_correo_pers` (`id_correo`),
  CONSTRAINT `fk_direcc_pers` FOREIGN KEY (`id_direccion`) REFERENCES `direcciones` (`id_direccion`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_tlf_pers` FOREIGN KEY (`id_telefono`) REFERENCES `telefonos` (`id_telefono`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_email_pers` FOREIGN KEY (`id_correo`) REFERENCES `correos` (`id_correo`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


LOCK TABLES `personas` WRITE;
INSERT INTO `personas` VALUES (1,'V',12345678,'Pedro',NULL,NULL,'Pérez',NULL,'1989-01-01','M','S',NULL,NULL,NULL);
UNLOCK TABLES;


DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `fecha_IN` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_cliente`),
  KEY `id_pers_client` (`id_cliente`),
  CONSTRAINT `fk_id_pers_client` FOREIGN KEY (`id_cliente`) REFERENCES `personas` (`id_persona`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



DROP TABLE IF EXISTS `empleados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empleados` (
  `id_empleado` int(11) NOT NULL,
  `cargo` varchar(20) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `fecha_IN` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` int(11) DEFAULT NULL,
  `eliminado` ENUM('0', '1') DEFAULT '0',
  PRIMARY KEY (`id_empleado`),
  KEY `id_pers_emple` (`id_empleado`),
  KEY `id_user_emple` (`id_usuario`),
  CONSTRAINT `fk_id_pers_emple` FOREIGN KEY (`id_empleado`) REFERENCES `personas` (`id_persona`) ON UPDATE CASCADE,
  CONSTRAINT `fk_id_user_emple` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


LOCK TABLES `empleados` WRITE;
INSERT INTO `empleados` VALUES (1,'GERENTE','2012-05-10','2024-09-27 00:03:34',1, '0');
UNLOCK TABLES;


DROP TABLE IF EXISTS `recuperarpassword`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recuperarpassword` (
  `id_recovery` int(11) NOT NULL AUTO_INCREMENT,
  `pregunta1` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `pregunta2` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `pregunta3` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `respuesta1` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `respuesta2` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `respuesta3` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_recovery`),
  KEY `id_user_recovery` (`id_usuario`),
  CONSTRAINT `fk_id_user_recov` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


LOCK TABLES `recuperarpassword` WRITE;
INSERT INTO `recuperarpassword` VALUES (1,'Color Favorito','Bebida Favorita','Deporte Favorito','verde','malta','futbol',1);
UNLOCK TABLES;


DROP TABLE IF EXISTS `empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresas` (
  `id_empresa` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_rif` enum('V', 'E', 'P', 'G', 'J') NOT NULL,
  `rif` int(10) unsigned NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `id_direccion` int(11) DEFAULT NULL,
  `id_telefono` int(11) DEFAULT NULL,
  `id_correo` int(11) DEFAULT NULL,
  `fecha_IN` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_empresa`),
  KEY `id_direccion_empre` (`id_direccion`),
  KEY `id_telefono_empre` (`id_telefono`),
  KEY `id_correo_empre` (`id_correo`),
  CONSTRAINT `fk_direcc_empre` FOREIGN KEY (`id_direccion`) REFERENCES `direcciones` (`id_direccion`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_tlf_empre` FOREIGN KEY (`id_telefono`) REFERENCES `telefonos` (`id_telefono`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_email_empre` FOREIGN KEY (`id_correo`) REFERENCES `correos` (`id_correo`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

LOCK TABLES `empresas` WRITE;
INSERT INTO `empresas` VALUES (1,'J',505092847,'La Sazón de La Primera C.A', NULL, NULL, NULL, NULL);
UNLOCK TABLES;



DROP TABLE IF EXISTS `proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proveedores` (
  `id_proveedor` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_rif` enum('V', 'E', 'P', 'G', 'J') NOT NULL,
  `rif` int(9) unsigned NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `id_direccion` int(11) DEFAULT NULL,
  `id_telefono` int(11) DEFAULT NULL,
  `id_correo` int(11) DEFAULT NULL,
  `id_empresa` int(11) NOT NULL,
  `fecha_IN` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_proveedor`),
  KEY `id_direccion_provee` (`id_direccion`),
  KEY `id_telefono_provee` (`id_telefono`),
  KEY `id_correo_provee` (`id_correo`),
  KEY `id_empre_provee` (`id_empresa`),
  CONSTRAINT `fk_direcc_provee` FOREIGN KEY (`id_direccion`) REFERENCES `direcciones` (`id_direccion`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_tlf_provee` FOREIGN KEY (`id_telefono`) REFERENCES `telefonos` (`id_telefono`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_email_provee` FOREIGN KEY (`id_correo`) REFERENCES `correos` (`id_correo`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_empre_provee` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_empresa`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


LOCK TABLES `categorias` WRITE;
INSERT INTO categorias (id_categoria, nombre, descripcion) VALUES (NULL, 'Víveres', NULL),(NULL, 'Alimentos', NULL),(NULL, 'Bebidas', NULL);
UNLOCK TABLES;


DROP TABLE IF EXISTS `tasas_cambio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasas_cambio` (
  `id_tasa` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `valor` decimal(10,2) unsigned NOT NULL,
  `fecha_UP` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_tasa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


LOCK TABLES `tasas_cambio` WRITE;
INSERT INTO tasas_cambio (id_tasa, nombre, valor, fecha_UP) VALUES (NULL, 'Banco Central de Venezuela (BCV)', 53.85, NULL);
UNLOCK TABLES;



DROP TABLE IF EXISTS `suministros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suministros` (
  `id_suministro` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` bigint(15) unsigned NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_IN` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`id_suministro`),
  KEY `id_catego_sumini` (`id_categoria`),
  CONSTRAINT `fk_catego_sumini` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `precio_usd` decimal(10, 2) unsigned NOT NULL,
  `fecha_IN` timestamp DEFAULT CURRENT_TIMESTAMP,
  `fecha_UP` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_categoria` int(11) NOT NULL,
  `eliminado` ENUM('0', '1') DEFAULT '0',
  PRIMARY KEY (`id_producto`),
  KEY `id_catego_produc` (`id_categoria`),
  CONSTRAINT `fk_catego_product` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


DROP TABLE IF EXISTS `compras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compras` (
  `id_compra` int(11) NOT NULL AUTO_INCREMENT,
  `metodo_pago` ENUM('B', 'E', 'P', 'T', 'M') NOT NULL,
  `fecha_compra` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_cliente` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `condicion` ENUM('CO', 'CR') DEFAULT 'CO',
  `pagado` ENUM('0', '1') DEFAULT '1',
  PRIMARY KEY (`id_compra`),
  KEY `id_cliente_compra` (`id_cliente`),
  KEY `id_emple_compra` (`id_empleado`),
  CONSTRAINT `fk_cliente_compra` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON UPDATE CASCADE,
  CONSTRAINT `fk_emple_compra` FOREIGN KEY (`id_empleado`) REFERENCES `empleados` (`id_empleado`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;




DROP TABLE IF EXISTS `compras_contienen_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compras_contienen_productos` (
  `id_compra` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` smallint(3) unsigned NOT NULL,
  `precio_usd` decimal(10,2) unsigned NOT NULL,
  `precio_bs` decimal(10,2) unsigned NOT NULL,
  PRIMARY KEY (`id_compra`, `id_producto`),
  KEY `id_compra_produc` (`id_compra`),
  KEY `id_produc_compra` (`id_producto`),
  CONSTRAINT `fk_compra_con_sumi` FOREIGN KEY (`id_compra`) REFERENCES `compras` (`id_compra`) ON UPDATE CASCADE,
  CONSTRAINT `fk_sumi_con_compra` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



DROP TABLE IF EXISTS `proveedores_abastecen_suministros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proveedores_abastecen_suministros` (
  `id_abastecimiento` int(11) NOT NULL AUTO_INCREMENT,
  `id_proveedor` int(11) NOT NULL,
  `id_suministro` int(11) NOT NULL,
  `fecha_compra` date NOT NULL,  
  `fecha_pago` date NULL,  
  `fecha_vencimiento_suministro` date NULL,  
  `cantidad` smallint unsigned NOT NULL,
  `condicion_pago` ENUM('CO', 'CR') DEFAULT 'CO',  
  `pagado_usd` decimal(10,2) unsigned NOT NULL,
  `pagado_bs` decimal(10,2) unsigned NOT NULL,
  PRIMARY KEY (`id_abastecimiento`),
  KEY `id_sumi_a_provee` (`id_proveedor`),
  KEY `id_provee_a_sumi` (`id_suministro`),
  CONSTRAINT `fk_sumi_a_provee` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`) ON UPDATE CASCADE,
  CONSTRAINT `fk_provee_a_sumi` FOREIGN KEY (`id_suministro`) REFERENCES `suministros` (`id_suministro`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



