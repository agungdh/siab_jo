-- mysqldump-php https://github.com/ifsnop/mysqldump-php
--
-- Host: 127.0.0.1	Database: siab_jo
-- ------------------------------------------------------
-- Server version 	5.5.5-10.1.38-MariaDB
-- Date: Wed, 08 May 2019 10:50:15 +0200

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
-- Table structure for table `hari_libur`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hari_libur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `keterangan` varchar(191) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tanggal` (`tanggal`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hari_libur`
--

LOCK TABLES `hari_libur` WRITE;
/*!40000 ALTER TABLE `hari_libur` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `hari_libur` VALUES (18,'2018-01-01','Hari Tahun Baru'),(19,'2018-02-16','Tahun Baru Imlek'),(20,'2018-03-17','Hari Raya Nyepi (Tahun Baru Saka)'),(21,'2018-03-30','Wafat Isa Almasih'),(22,'2018-04-01','Hari Paskah'),(23,'2018-04-14','Isra Mi\'raj Nabi Muhammad'),(24,'2018-05-01','Hari Buruh Internasional/Pekerja'),(25,'2018-05-10','Kenaikan Yesus Kristus'),(26,'2018-05-29','Hari Raya Waisak'),(27,'2018-06-01','Hari Lahir Pancasila'),(28,'2018-06-11','Cuti Bersama'),(29,'2018-06-12','Cuti Bersama'),(30,'2018-06-13','Cuti Bersama'),(31,'2018-06-14','Cuti Bersama'),(32,'2018-06-15','Idul Fitri (Lebaran Mudik)'),(33,'2018-06-16','Idul Fitri (Lebaran Mudik)'),(34,'2018-06-18','Cuti Bersama'),(35,'2018-06-19','Cuti Bersama'),(36,'2018-06-20','Cuti Bersama'),(37,'2018-06-27','Pilkada Serentak'),(38,'2018-08-17','Hari Proklamasi Kemerdekaan R.I.'),(39,'2018-08-22','Idul Adha (Lebaran Haji)'),(40,'2018-09-11','Satu Muharam/Tahun Baru Hijriyah'),(41,'2018-11-07','Diwali/Deepavali'),(42,'2018-11-20','Maulid Nabi Muhammad'),(43,'2018-12-24','Cuti Bersama (Malam Natal)'),(44,'2018-12-25','Hari Natal'),(45,'2018-12-31','Malam Tahun Baru'),(46,'2019-01-01','Hari Tahun Baru'),(47,'2019-02-05','Tahun Baru Imlek'),(48,'2019-03-07','Hari Raya Nyepi (Tahun Baru Saka)'),(49,'2019-04-03','Isra Mi\'raj Nabi Muhammad'),(50,'2019-04-17','Election Day'),(51,'2019-04-19','Wafat Isa Almasih'),(52,'2019-04-21','Hari Paskah'),(53,'2019-05-01','Hari Buruh Internasional/Pekerja'),(54,'2019-05-19','Hari Raya Waisak'),(55,'2019-05-30','Kenaikan Yesus Kristus'),(56,'2019-06-01','Hari Lahir Pancasila'),(57,'2019-06-03','Cuti Bersama'),(58,'2019-06-04','Cuti Bersama'),(59,'2019-06-05','Idul Fitri (Lebaran Mudik)'),(60,'2019-06-06','Idul Fitri (Lebaran Mudik)'),(61,'2019-06-07','Cuti Bersama'),(62,'2019-08-11','Idul Adha (Lebaran Haji)'),(63,'2019-08-17','Hari Proklamasi Kemerdekaan R.I.'),(64,'2019-09-01','Satu Muharam/Tahun Baru Hijriyah'),(65,'2019-10-27','Diwali/Deepavali'),(66,'2019-11-09','Maulid Nabi Muhammad'),(67,'2019-12-24','Cuti Bersama (Malam Natal)'),(68,'2019-12-25','Hari Natal'),(69,'2019-12-31','Malam Tahun Baru'),(70,'2020-01-01','Hari Tahun Baru'),(71,'2020-01-25','Tahun Baru Imlek'),(72,'2020-03-22','Isra Mi\'raj Nabi Muhammad'),(73,'2020-03-25','Hari Raya Nyepi (Tahun Baru Saka)'),(74,'2020-04-10','Wafat Isa Almasih'),(75,'2020-04-12','Hari Paskah'),(76,'2020-05-01','Hari Buruh Internasional/Pekerja'),(77,'2020-05-07','Hari Raya Waisak'),(78,'2020-05-21','Kenaikan Yesus Kristus'),(79,'2020-05-24','Idul Fitri (Lebaran Mudik)'),(80,'2020-05-25','Idul Fitri (Lebaran Mudik)'),(81,'2020-06-01','Hari Lahir Pancasila'),(82,'2020-07-31','Idul Adha (Lebaran Haji)'),(83,'2020-08-17','Hari Proklamasi Kemerdekaan R.I.'),(84,'2020-08-20','Satu Muharam/Tahun Baru Hijriyah'),(85,'2020-10-29','Maulid Nabi Muhammad'),(86,'2020-11-14','Diwali/Deepavali'),(87,'2020-12-24','Malam Natal'),(88,'2020-12-25','Hari Natal'),(89,'2020-12-31','Malam Tahun Baru');
/*!40000 ALTER TABLE `hari_libur` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `hari_libur` with 72 row(s)
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
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

-- Dump completed on: Wed, 08 May 2019 10:50:15 +0200
