-- mysqldump-php https://github.com/ifsnop/mysqldump-php
--
-- Host: 127.0.0.1	Database: siab_jo
-- ------------------------------------------------------
-- Server version 	5.5.5-10.1.38-MariaDB
-- Date: Mon, 06 May 2019 06:58:28 +0200

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
-- Table structure for table `absensi`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `absensi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) NOT NULL,
  `waktu` datetime NOT NULL,
  `tipe` enum('b','p') NOT NULL COMMENT 'b => berangkat,p => pulang',
  `lat` varchar(191) NOT NULL,
  `lng` varchar(191) NOT NULL,
  `lokasi` enum('d','l') NOT NULL COMMENT 'd => dalam,l => luar',
  PRIMARY KEY (`id`),
  KEY `id_karyawan` (`id_karyawan`),
  CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `absensi`
--

LOCK TABLES `absensi` WRITE;
/*!40000 ALTER TABLE `absensi` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `absensi` VALUES (5,10,'2019-04-25 09:42:27','b','-5.093354','105.283969','d'),(6,10,'2019-04-25 09:42:44','p','-5.093354','105.283969','d'),(7,10,'2019-05-06 03:53:13','b','-5.0931899','105.2840523','d'),(8,10,'2019-05-06 03:53:24','p','-5.0931899','105.2840523','d');
/*!40000 ALTER TABLE `absensi` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `absensi` with 4 row(s)
--

--
-- Table structure for table `karyawan`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(191) NOT NULL,
  `nama` varchar(191) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nip` (`nip`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `karyawan`
--

LOCK TABLES `karyawan` WRITE;
/*!40000 ALTER TABLE `karyawan` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `karyawan` VALUES (10,'15753003','Agung Sapto Margono Dh'),(11,'15753016','Bintang AFFS'),(12,'15753067','Tika YK'),(13,'15753001','Dewaks'),(14,'15753002','Diah');
/*!40000 ALTER TABLE `karyawan` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `karyawan` with 5 row(s)
--

--
-- Table structure for table `user`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) NOT NULL,
  `password` varchar(191) NOT NULL,
  `level` enum('a','k') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_karyawan` (`id_karyawan`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `user` VALUES (4,11,'$2y$10$ZBDR5y11FP9UrG5uFsfoXOMB3xwSNgALDP.7W4nMk2nOVxKjPyjBW','k'),(6,10,'$2y$10$uKp4/uLuA4GAXBCiInpxvuTy30bZbd6dQzE3eEis1OlmRREcySr3K','a');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `user` with 2 row(s)
--

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on: Mon, 06 May 2019 06:58:28 +0200
