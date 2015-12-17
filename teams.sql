--
-- Dumping data for table `divisions`
--

LOCK TABLES `divisions` WRITE;
/*!40000 ALTER TABLE `divisions` DISABLE KEYS */;
INSERT INTO `divisions` VALUES (1,'AFC','North'),(2,'AFC','South'),(3,'AFC','East'),(4,'AFC','West'),(5,'NFC','North'),(6,'NFC','South'),(7,'NFC','East'),(8,'NFC','West');
/*!40000 ALTER TABLE `divisions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `schedule`
--

LOCK TABLES `schedule` WRITE;
/*!40000 ALTER TABLE `schedule` DISABLE KEYS */;
INSERT INTO `schedule` VALUES (1,1,'2015-09-10 20:30:00','NE',28,'PIT',21,0),(2,1,'2015-09-13 13:00:00','CHI',23,'GB',31,0),(3,1,'2015-09-13 13:00:00','HOU',20,'KC',27,0),(4,1,'2015-09-13 13:00:00','NYJ',31,'CLE',10,0),(5,1,'2015-09-13 13:00:00','BUF',27,'IND',14,0),(6,1,'2015-09-13 13:00:00','WAS',10,'MIA',17,0),(7,1,'2015-09-13 13:00:00','JAX',9,'CAR',20,0),(8,1,'2015-09-13 13:00:00','STL',34,'SEA',31,1),(9,1,'2015-09-13 16:05:00','ARI',31,'NO',19,0),(10,1,'2015-09-13 16:05:00','SD',33,'DET',28,0),(11,1,'2015-09-13 16:25:00','TB',14,'TEN',42,0),(12,1,'2015-09-13 16:25:00','OAK',13,'CIN',33,0),(13,1,'2015-09-13 16:25:00','DEN',19,'BAL',13,0),(14,1,'2015-09-13 20:30:00','DAL',27,'NYG',26,0),(15,1,'2015-09-14 19:10:00','ATL',26,'PHI',24,0),(16,1,'2015-09-14 22:20:00','SF',20,'MIN',3,0),(17,2,'2015-09-17 20:25:00','KC',24,'DEN',31,0),(18,2,'2015-09-20 13:00:00','CAR',24,'HOU',17,0),(19,2,'2015-09-20 13:00:00','PIT',43,'SF',18,0),(20,2,'2015-09-20 13:00:00','NO',19,'TB',26,0),(21,2,'2015-09-20 13:00:00','MIN',26,'DET',16,0),(22,2,'2015-09-20 13:00:00','CHI',23,'ARI',48,0),(23,2,'2015-09-20 13:00:00','BUF',32,'NE',40,0),(24,2,'2015-09-20 13:00:00','CIN',24,'SD',19,0),(25,2,'2015-09-20 13:00:00','CLE',28,'TEN',14,0),(26,2,'2015-09-20 13:00:00','NYG',20,'ATL',24,0),(27,2,'2015-09-20 13:00:00','WAS',24,'STL',10,0),(28,2,'2015-09-20 16:05:00','JAX',23,'MIA',20,0),(29,2,'2015-09-20 16:05:00','OAK',37,'BAL',33,0),(30,2,'2015-09-20 16:25:00','PHI',10,'DAL',20,0),(31,2,'2015-09-20 20:30:00','GB',27,'SEA',17,0),(32,2,'2015-09-21 20:30:00','IND',7,'NYJ',20,0),(33,3,'2015-09-24 20:25:00','NYG',32,'WAS',21,0),(34,3,'2015-09-27 13:00:00','DAL',28,'ATL',39,0),(35,3,'2015-09-27 13:00:00','TEN',33,'IND',35,0),(36,3,'2015-09-27 13:00:00','CLE',20,'OAK',27,0),(37,3,'2015-09-27 13:00:00','BAL',24,'CIN',28,0),(38,3,'2015-09-27 13:00:00','NE',51,'JAX',17,0),(39,3,'2015-09-27 13:00:00','CAR',27,'NO',22,0),(40,3,'2015-09-27 13:00:00','NYJ',17,'PHI',24,0),(41,3,'2015-09-27 13:00:00','HOU',19,'TB',9,0),(42,3,'2015-09-27 13:00:00','MIN',31,'SD',14,0),(43,3,'2015-09-27 13:00:00','STL',6,'PIT',12,0),(44,3,'2015-09-27 16:05:00','ARI',47,'SF',7,0),(45,3,'2015-09-27 16:25:00','MIA',14,'BUF',41,0),(46,3,'2015-09-27 16:25:00','SEA',26,'CHI',0,0),(47,3,'2015-09-27 20:30:00','DET',12,'DEN',24,0),(48,3,'2015-09-28 20:30:00','GB',38,'KC',28,0),(49,4,'2015-10-01 20:25:00','PIT',20,'BAL',23,1),(50,4,'2015-10-04 09:30:00','MIA',14,'NYJ',27,0),(51,4,'2015-10-04 13:00:00','IND',16,'JAX',13,1),(52,4,'2015-10-04 13:00:00','BUF',10,'NYG',24,0),(53,4,'2015-10-04 13:00:00','TB',23,'CAR',37,0),(54,4,'2015-10-04 13:00:00','WAS',23,'PHI',20,0),(55,4,'2015-10-04 13:00:00','CHI',22,'OAK',20,0),(56,4,'2015-10-04 13:00:00','ATL',48,'HOU',21,0),(57,4,'2015-10-04 13:00:00','CIN',36,'KC',21,0),(58,4,'2015-10-04 16:05:00','SD',30,'CLE',27,0),(59,4,'2015-10-04 16:25:00','SF',3,'GB',17,0),(60,4,'2015-10-04 16:25:00','ARI',22,'STL',24,0),(61,4,'2015-10-04 16:25:00','DEN',23,'MIN',20,0),(62,4,'2015-10-04 20:30:00','NO',26,'DAL',20,1),(63,4,'2015-10-05 20:30:00','SEA',13,'DET',10,0),(64,5,'2015-10-08 20:25:00','HOU',20,'IND',27,0),(65,5,'2015-10-11 13:00:00','KC',17,'CHI',18,0),(66,5,'2015-10-11 13:00:00','CIN',27,'SEA',24,1),(67,5,'2015-10-11 13:00:00','ATL',25,'WAS',19,1),(68,5,'2015-10-11 13:00:00','TB',38,'JAX',31,0),(69,5,'2015-10-11 13:00:00','PHI',39,'NO',17,0),(70,5,'2015-10-11 13:00:00','BAL',30,'CLE',33,1),(71,5,'2015-10-11 13:00:00','GB',24,'STL',10,0),(72,5,'2015-10-11 13:00:00','TEN',13,'BUF',14,0),(73,5,'2015-10-11 16:05:00','DET',17,'ARI',42,0),(74,5,'2015-10-11 16:25:00','DAL',6,'NE',30,0),(75,5,'2015-10-11 16:25:00','OAK',10,'DEN',16,0),(76,5,'2015-10-11 20:30:00','NYG',30,'SF',27,0),(77,5,'2015-10-12 20:30:00','SD',20,'PIT',24,0),(78,6,'2015-10-15 20:25:00','NO',31,'ATL',21,0),(79,6,'2015-10-18 13:00:00','NYJ',34,'WAS',20,0),(80,6,'2015-10-18 13:00:00','PIT',25,'ARI',13,0),(81,6,'2015-10-18 13:00:00','MIN',16,'KC',10,0),(82,6,'2015-10-18 13:00:00','BUF',21,'CIN',34,0),(83,6,'2015-10-18 13:00:00','DET',37,'CHI',34,1),(84,6,'2015-10-18 13:00:00','CLE',23,'DEN',26,1),(85,6,'2015-10-18 13:00:00','JAX',20,'HOU',31,0),(86,6,'2015-10-18 13:00:00','TEN',10,'MIA',38,0),(87,6,'2015-10-18 16:05:00','SEA',23,'CAR',27,0),(88,6,'2015-10-18 16:25:00','GB',27,'SD',20,0),(89,6,'2015-10-18 16:25:00','SF',25,'BAL',20,0),(90,6,'2015-10-18 20:30:00','IND',27,'NE',34,0),(91,6,'2015-10-19 20:30:00','PHI',27,'NYG',7,0),(92,7,'2015-10-22 20:25:00','SF',3,'SEA',20,0),(93,7,'2015-10-25 09:30:00','JAX',34,'BUF',31,0),(94,7,'2015-10-25 13:00:00','WAS',31,'TB',30,0),(95,7,'2015-10-25 13:00:00','TEN',7,'ATL',10,0),(96,7,'2015-10-25 13:00:00','IND',21,'NO',27,0),(97,7,'2015-10-25 13:00:00','DET',19,'MIN',28,0),(98,7,'2015-10-25 13:00:00','KC',23,'PIT',13,0),(99,7,'2015-10-25 13:00:00','STL',24,'CLE',6,0),(100,7,'2015-10-25 13:00:00','MIA',44,'HOU',26,0),(101,7,'2015-10-25 13:00:00','NE',30,'NYJ',23,0),(102,7,'2015-10-25 16:05:00','SD',29,'OAK',37,0),(103,7,'2015-10-25 16:25:00','NYG',27,'DAL',20,0),(104,7,'2015-10-25 20:30:00','CAR',27,'PHI',16,0),(105,7,'2015-10-26 20:30:00','ARI',26,'BAL',18,0),(106,8,'2015-10-29 20:25:00','NE',36,'MIA',7,0),(107,8,'2015-11-01 09:30:00','KC',45,'DET',10,0),(108,8,'2015-11-01 13:00:00','ATL',20,'TB',23,1),(109,8,'2015-11-01 13:00:00','CLE',20,'ARI',34,0),(110,8,'2015-11-01 13:00:00','STL',27,'SF',6,0),(111,8,'2015-11-01 13:00:00','NO',52,'NYG',49,0),(112,8,'2015-11-01 13:00:00','CHI',20,'MIN',23,0),(113,8,'2015-11-01 13:00:00','BAL',29,'SD',26,0),(114,8,'2015-11-01 13:00:00','PIT',10,'CIN',16,0),(115,8,'2015-11-01 13:00:00','HOU',20,'TEN',6,0),(116,8,'2015-11-01 16:05:00','OAK',34,'NYJ',20,0),(117,8,'2015-11-01 16:25:00','DAL',12,'SEA',13,0),(118,8,'2015-11-01 20:30:00','DEN',29,'GB',10,0),(119,8,'2015-11-02 20:30:00','CAR',29,'IND',26,1),(120,9,'2015-11-05 20:25:00','CIN',31,'CLE',10,0),(121,9,'2015-11-08 13:00:00','CAR',37,'GB',29,0),(122,9,'2015-11-08 13:00:00','NE',27,'WAS',10,0),(123,9,'2015-11-08 13:00:00','NO',28,'TEN',34,1),(124,9,'2015-11-08 13:00:00','BUF',33,'MIA',17,0),(125,9,'2015-11-08 13:00:00','MIN',21,'STL',18,1),(126,9,'2015-11-08 13:00:00','NYJ',28,'JAX',23,0),(127,9,'2015-11-08 13:00:00','PIT',38,'OAK',35,0),(128,9,'2015-11-08 16:05:00','TB',18,'NYG',32,0),(129,9,'2015-11-08 16:05:00','SF',17,'ATL',16,0),(130,9,'2015-11-08 16:25:00','IND',27,'DEN',24,0),(131,9,'2015-11-08 20:30:00','DAL',27,'PHI',33,1),(132,9,'2015-11-09 20:30:00','SD',19,'CHI',22,0),(133,10,'2015-11-12 20:25:00','NYJ',17,'BUF',22,0),(134,10,'2015-11-15 13:00:00','GB',16,'DET',18,0),(135,10,'2015-11-15 13:00:00','TB',10,'DAL',6,0),(136,10,'2015-11-15 13:00:00','TEN',10,'CAR',27,0),(137,10,'2015-11-15 13:00:00','STL',13,'CHI',37,0),(138,10,'2015-11-15 13:00:00','WAS',47,'NO',14,0),(139,10,'2015-11-15 13:00:00','PHI',19,'MIA',20,0),(140,10,'2015-11-15 13:00:00','PIT',30,'CLE',9,0),(141,10,'2015-11-15 13:00:00','BAL',20,'JAX',22,0),(142,10,'2015-11-15 16:05:00','OAK',14,'MIN',30,0),(143,10,'2015-11-15 16:25:00','NYG',26,'NE',27,0),(144,10,'2015-11-15 16:25:00','DEN',13,'KC',29,0),(145,10,'2015-11-15 20:30:00','SEA',32,'ARI',39,0),(146,10,'2015-11-16 20:30:00','CIN',6,'HOU',10,0),(147,11,'2015-11-19 20:25:00','JAX',19,'TEN',13,0),(148,11,'2015-11-22 13:00:00','DET',18,'OAK',13,0),(149,11,'2015-11-22 13:00:00','ATL',21,'IND',24,0),(150,11,'2015-11-22 13:00:00','HOU',24,'NYJ',17,0),(151,11,'2015-11-22 13:00:00','PHI',17,'TB',45,0),(152,11,'2015-11-22 13:00:00','CHI',15,'DEN',17,0),(153,11,'2015-11-22 13:00:00','MIN',13,'GB',30,0),(154,11,'2015-11-22 13:00:00','BAL',16,'STL',13,0),(155,11,'2015-11-22 13:00:00','MIA',14,'DAL',24,0),(156,11,'2015-11-22 13:00:00','CAR',44,'WAS',16,0),(157,11,'2015-11-22 16:05:00','ARI',34,'CIN',31,0),(158,11,'2015-11-22 16:25:00','SEA',29,'SF',13,0),(159,11,'2015-11-22 20:30:00','SD',3,'KC',33,0),(160,11,'2015-11-23 20:30:00','NE',20,'BUF',13,0),(161,12,'2015-11-26 12:30:00','DET',45,'PHI',14,0),(162,12,'2015-11-26 16:30:00','DAL',14,'CAR',33,0),(163,12,'2015-11-26 20:30:00','GB',13,'CHI',17,0),(164,12,'2015-11-29 13:00:00','TEN',21,'OAK',24,0),(165,12,'2015-11-29 13:00:00','KC',30,'BUF',22,0),(166,12,'2015-11-29 13:00:00','IND',25,'TB',12,0),(167,12,'2015-11-29 13:00:00','WAS',20,'NYG',14,0),(168,12,'2015-11-29 13:00:00','HOU',24,'NO',6,0),(169,12,'2015-11-29 13:00:00','ATL',10,'MIN',20,0),(170,12,'2015-11-29 13:00:00','CIN',31,'STL',7,0),(171,12,'2015-11-29 13:00:00','JAX',25,'SD',31,0),(172,12,'2015-11-29 13:00:00','NYJ',38,'MIA',20,0),(173,12,'2015-11-29 16:05:00','SF',13,'ARI',19,0),(174,12,'2015-11-29 16:25:00','SEA',39,'PIT',30,0),(175,12,'2015-11-29 20:30:00','DEN',30,'NE',24,1),(176,12,'2015-11-30 20:30:00','CLE',27,'BAL',33,0),(177,13,'2015-12-03 20:25:00','DET',23,'GB',27,0),(178,13,'2015-12-06 13:00:00','NYG',20,'NYJ',23,1),(179,13,'2015-12-06 13:00:00','STL',3,'ARI',27,0),(180,13,'2015-12-06 13:00:00','TB',23,'ATL',19,0),(181,13,'2015-12-06 13:00:00','NO',38,'CAR',41,0),(182,13,'2015-12-06 13:00:00','MIN',7,'SEA',38,0),(183,13,'2015-12-06 13:00:00','BUF',30,'HOU',21,0),(184,13,'2015-12-06 13:00:00','MIA',15,'BAL',13,0),(185,13,'2015-12-06 13:00:00','CLE',3,'CIN',37,0),(186,13,'2015-12-06 13:00:00','TEN',42,'JAX',39,0),(187,13,'2015-12-06 13:00:00','CHI',20,'SF',26,1),(188,13,'2015-12-06 16:05:00','SD',3,'DEN',17,0),(189,13,'2015-12-06 16:05:00','OAK',20,'KC',34,0),(190,13,'2015-12-06 16:25:00','NE',28,'PHI',35,0),(191,13,'2015-12-06 20:30:00','PIT',45,'IND',10,0),(192,13,'2015-12-07 20:30:00','WAS',16,'DAL',19,0),(193,14,'2015-12-10 20:25:00','ARI',23,'MIN',20,0),(194,14,'2015-12-13 13:00:00','PHI',23,'BUF',20,0),(195,14,'2015-12-13 13:00:00','CLE',24,'SF',10,0),(196,14,'2015-12-13 13:00:00','STL',21,'DET',14,0),(197,14,'2015-12-13 13:00:00','TB',17,'NO',24,0),(198,14,'2015-12-13 13:00:00','NYJ',30,'TEN',8,0),(199,14,'2015-12-13 13:00:00','CIN',20,'PIT',33,0),(200,14,'2015-12-13 13:00:00','HOU',6,'NE',27,0),(201,14,'2015-12-13 13:00:00','JAX',51,'IND',16,0),(202,14,'2015-12-13 13:00:00','KC',10,'SD',3,0),(203,14,'2015-12-13 13:00:00','CHI',21,'WAS',24,0),(204,14,'2015-12-13 13:00:00','CAR',38,'ATL',0,0),(205,14,'2015-12-13 16:05:00','DEN',12,'OAK',15,0),(206,14,'2015-12-13 16:25:00','GB',28,'DAL',7,0),(207,14,'2015-12-13 20:30:00','BAL',6,'SEA',35,0),(208,14,'2015-12-14 20:30:00','MIA',24,'NYG',31,0),(209,15,'2015-12-17 20:25:00','STL',NULL,'TB',NULL,0),(210,15,'2015-12-19 20:25:00','DAL',NULL,'NYJ',NULL,0),(211,15,'2015-12-20 13:00:00','MIN',NULL,'CHI',NULL,0),(212,15,'2015-12-20 13:00:00','JAX',NULL,'ATL',NULL,0),(213,15,'2015-12-20 13:00:00','IND',NULL,'HOU',NULL,0),(214,15,'2015-12-20 13:00:00','PHI',NULL,'ARI',NULL,0),(215,15,'2015-12-20 13:00:00','NYG',NULL,'CAR',NULL,0),(216,15,'2015-12-20 13:00:00','NE',NULL,'TEN',NULL,0),(217,15,'2015-12-20 13:00:00','WAS',NULL,'BUF',NULL,0),(218,15,'2015-12-20 13:00:00','BAL',NULL,'KC',NULL,0),(219,15,'2015-12-20 16:05:00','SEA',NULL,'CLE',NULL,0),(220,15,'2015-12-20 16:05:00','OAK',NULL,'GB',NULL,0),(221,15,'2015-12-20 16:25:00','PIT',NULL,'DEN',NULL,0),(222,15,'2015-12-20 16:25:00','SD',NULL,'MIA',NULL,0),(223,15,'2015-12-20 20:30:00','SF',NULL,'CIN',NULL,0),(224,15,'2015-12-21 20:30:00','NO',NULL,'DET',NULL,0),(225,16,'2015-12-24 20:25:00','OAK',NULL,'SD',NULL,0),(226,16,'2015-12-26 20:25:00','PHI',NULL,'WAS',NULL,0),(227,16,'2015-12-27 13:00:00','NYJ',NULL,'NE',NULL,0),(228,16,'2015-12-27 13:00:00','TEN',NULL,'HOU',NULL,0),(229,16,'2015-12-27 13:00:00','KC',NULL,'CLE',NULL,0),(230,16,'2015-12-27 13:00:00','MIA',NULL,'IND',NULL,0),(231,16,'2015-12-27 13:00:00','NO',NULL,'JAX',NULL,0),(232,16,'2015-12-27 13:00:00','DET',NULL,'SF',NULL,0),(233,16,'2015-12-27 13:00:00','BUF',NULL,'DAL',NULL,0),(234,16,'2015-12-27 13:00:00','TB',NULL,'CHI',NULL,0),(235,16,'2015-12-27 13:00:00','ATL',NULL,'CAR',NULL,0),(236,16,'2015-12-27 13:00:00','MIN',NULL,'NYG',NULL,0),(237,16,'2015-12-27 16:25:00','SEA',NULL,'STL',NULL,0),(238,16,'2015-12-27 16:25:00','ARI',NULL,'GB',NULL,0),(239,16,'2015-12-27 20:30:00','BAL',NULL,'PIT',NULL,0),(240,16,'2015-12-28 20:30:00','DEN',NULL,'CIN',NULL,0),(241,17,'2016-01-03 13:00:00','BUF',NULL,'NYJ',NULL,0),(242,17,'2016-01-03 13:00:00','MIA',NULL,'NE',NULL,0),(243,17,'2016-01-03 13:00:00','CAR',NULL,'TB',NULL,0),(244,17,'2016-01-03 13:00:00','ATL',NULL,'NO',NULL,0),(245,17,'2016-01-03 13:00:00','CIN',NULL,'BAL',NULL,0),(246,17,'2016-01-03 13:00:00','CLE',NULL,'PIT',NULL,0),(247,17,'2016-01-03 13:00:00','HOU',NULL,'JAX',NULL,0),(248,17,'2016-01-03 13:00:00','IND',NULL,'TEN',NULL,0),(249,17,'2016-01-03 13:00:00','KC',NULL,'OAK',NULL,0),(250,17,'2016-01-03 13:00:00','DAL',NULL,'WAS',NULL,0),(251,17,'2016-01-03 13:00:00','NYG',NULL,'PHI',NULL,0),(252,17,'2016-01-03 13:00:00','CHI',NULL,'DET',NULL,0),(253,17,'2016-01-03 13:00:00','GB',NULL,'MIN',NULL,0),(254,17,'2016-01-03 16:25:00','DEN',NULL,'SD',NULL,0),(255,17,'2016-01-03 16:25:00','ARI',NULL,'SEA',NULL,0),(256,17,'2016-01-03 16:25:00','SF',NULL,'STL',NULL,0);
/*!40000 ALTER TABLE `schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
INSERT INTO `teams` VALUES ('ARI',8,'Arizona','Cardinals',NULL),('ATL',6,'Atlanta','Falcons',NULL),('BAL',1,'Baltimore','Ravens',NULL),('BUF',3,'Buffalo','Bills',NULL),('CAR',6,'Carolina','Panthers',NULL),('CHI',5,'Chicago','Bears',NULL),('CIN',1,'Cincinnati','Bengals',NULL),('CLE',1,'Cleveland','Browns',NULL),('DAL',7,'Dallas','Cowboys',NULL),('DEN',4,'Denver','Broncos',NULL),('DET',5,'Detroit','Lions',NULL),('GB',5,'Green Bay','Packers',NULL),('HOU',2,'Houston','Texans',NULL),('IND',2,'Indianapolis','Colts',NULL),('JAX',2,'Jacksonville','Jaguars',NULL),('KC',4,'Kansas City','Chiefs',NULL),('MIA',3,'Miami','Dolphins',NULL),('MIN',5,'Minnesota','Vikings',NULL),('NE',3,'New England','Patriots',NULL),('NO',6,'New Orleans','Saints',NULL),('NYG',7,'New York','Giants','NY Giants'),('NYJ',3,'New York','Jets','NY Jets'),('OAK',4,'Oakland','Raiders',NULL),('PHI',7,'Philadelphia','Eagles',NULL),('PIT',1,'Pittsburgh','Steelers',NULL),('SD',4,'San Diego','Chargers',NULL),('SEA',8,'Seattle','Seahawks',NULL),('SF',8,'San Francisco','49ers',NULL),('STL',8,'St. Louis','Rams',NULL),('TB',6,'Tampa Bay','Buccaneers',NULL),('TEN',2,'Tennessee','Titans',NULL),('WAS',7,'Washington','Redskins',NULL);
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
UNLOCK TABLES;