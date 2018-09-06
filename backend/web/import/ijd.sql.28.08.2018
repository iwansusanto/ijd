-- MySQL dump 10.16  Distrib 10.3.9-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: ijd
-- ------------------------------------------------------
-- Server version	10.3.9-MariaDB-1:10.3.9+maria~bionic

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
-- Table structure for table `dosen`
--

DROP TABLE IF EXISTS `dosen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dosen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(50) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `user_created` int(11) NOT NULL,
  `user_updated` int(11) DEFAULT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nip` (`nip`),
  UNIQUE KEY `nip-index-dosen` (`nip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dosen`
--

LOCK TABLES `dosen` WRITE;
/*!40000 ALTER TABLE `dosen` DISABLE KEYS */;
/*!40000 ALTER TABLE `dosen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dosen_fakultas`
--

DROP TABLE IF EXISTS `dosen_fakultas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dosen_fakultas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dosen_id` int(11) NOT NULL,
  `fakultas_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `tahun_ajaran_id` int(11) NOT NULL,
  `user_created` int(11) NOT NULL,
  `user_updated` int(11) DEFAULT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-dosen_fakultas-semester_id` (`semester_id`),
  KEY `fk-dosen_fakultas-dosen_id` (`dosen_id`),
  KEY `fk-dosen_fakultas-fakultas_id` (`fakultas_id`),
  KEY `fk-dosen_fakultas-tahun_ajaran_id` (`tahun_ajaran_id`),
  CONSTRAINT `fk-dosen_fakultas-dosen_id` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk-dosen_fakultas-fakultas_id` FOREIGN KEY (`fakultas_id`) REFERENCES `fakultas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk-dosen_fakultas-semester_id` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk-dosen_fakultas-tahun_ajaran_id` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajaran` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dosen_fakultas`
--

LOCK TABLES `dosen_fakultas` WRITE;
/*!40000 ALTER TABLE `dosen_fakultas` DISABLE KEYS */;
/*!40000 ALTER TABLE `dosen_fakultas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dosen_kelas`
--

DROP TABLE IF EXISTS `dosen_kelas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dosen_kelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dosen_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `tahun_ajaran_id` int(11) NOT NULL,
  `user_created` int(11) NOT NULL,
  `user_updated` int(11) DEFAULT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dosen-index-dosen_kelas` (`dosen_id`),
  UNIQUE KEY `kelas-index-dosen_kelas` (`kelas_id`),
  UNIQUE KEY `tahun_ajaran-index-dosen_kelas` (`tahun_ajaran_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dosen_kelas`
--

LOCK TABLES `dosen_kelas` WRITE;
/*!40000 ALTER TABLE `dosen_kelas` DISABLE KEYS */;
/*!40000 ALTER TABLE `dosen_kelas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fakultas`
--

DROP TABLE IF EXISTS `fakultas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fakultas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `user_created` int(11) NOT NULL,
  `user_updated` int(11) DEFAULT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nama` (`nama`),
  UNIQUE KEY `nama-index-fakultas` (`nama`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fakultas`
--

LOCK TABLES `fakultas` WRITE;
/*!40000 ALTER TABLE `fakultas` DISABLE KEYS */;
/*!40000 ALTER TABLE `fakultas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imbal_jasa`
--

DROP TABLE IF EXISTS `imbal_jasa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imbal_jasa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_kegiatan` datetime NOT NULL,
  `dosen_fakultas_id` int(11) NOT NULL,
  `transaksi_id` int(11) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `nama_dosen` varchar(200) DEFAULT NULL,
  `nama_fakultas` varchar(100) DEFAULT NULL,
  `dosen_fakultas_id_digantikan` int(11) DEFAULT NULL,
  `nip_digantikan` varchar(30) DEFAULT NULL,
  `nama_dosen_digantikan` varchar(200) DEFAULT NULL,
  `nama_fakultas_digantikan` varchar(100) DEFAULT NULL,
  `module_tahun_ajaran_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `nama_kelas` varchar(100) DEFAULT NULL,
  `ruangan_id` int(11) NOT NULL,
  `nama_ruangan` varchar(100) DEFAULT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `peran_hitung_id` int(11) NOT NULL,
  `peran_id` int(11) NOT NULL,
  `nama_peran` varchar(100) DEFAULT NULL,
  `jumlah_jam_rumus` int(11) NOT NULL,
  `transport` float DEFAULT NULL,
  `honor` float DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `user_created` int(11) NOT NULL,
  `user_updated` int(11) DEFAULT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-imbal_jasa-kelas_id` (`kelas_id`),
  KEY `fk-imbal_jasa-ruangan_id` (`ruangan_id`),
  KEY `fk-imbal_jasa-peran_hitung_id` (`peran_hitung_id`),
  KEY `fk-imbal_jasa-peran_id` (`peran_id`),
  KEY `fk-imbal_jasa-transaksi_id` (`transaksi_id`),
  KEY `fk-imbal_jasa-module_tahun_ajaran_id` (`module_tahun_ajaran_id`),
  CONSTRAINT `fk-imbal_jasa-kelas_id` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk-imbal_jasa-module_tahun_ajaran_id` FOREIGN KEY (`module_tahun_ajaran_id`) REFERENCES `module_tahun_ajaran` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk-imbal_jasa-peran_hitung_id` FOREIGN KEY (`peran_hitung_id`) REFERENCES `peran_hitung` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk-imbal_jasa-peran_id` FOREIGN KEY (`peran_id`) REFERENCES `peran` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk-imbal_jasa-ruangan_id` FOREIGN KEY (`ruangan_id`) REFERENCES `ruangan` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk-imbal_jasa-transaksi_id` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imbal_jasa`
--

LOCK TABLES `imbal_jasa` WRITE;
/*!40000 ALTER TABLE `imbal_jasa` DISABLE KEYS */;
/*!40000 ALTER TABLE `imbal_jasa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jabatan`
--

DROP TABLE IF EXISTS `jabatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(200) NOT NULL,
  `user_created` int(11) NOT NULL,
  `user_updated` int(11) DEFAULT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jabatan`
--

LOCK TABLES `jabatan` WRITE;
/*!40000 ALTER TABLE `jabatan` DISABLE KEYS */;
/*!40000 ALTER TABLE `jabatan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kelas`
--

DROP TABLE IF EXISTS `kelas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `user_created` int(11) NOT NULL,
  `user_updated` int(11) DEFAULT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nama` (`nama`),
  UNIQUE KEY `nama-index-kelas` (`nama`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kelas`
--

LOCK TABLES `kelas` WRITE;
/*!40000 ALTER TABLE `kelas` DISABLE KEYS */;
/*!40000 ALTER TABLE `kelas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m000000_000000_base',1534755941),('m130524_201442_init',1534755942),('m180426_032627_dosen',1534755942),('m180430_043420_ruangan',1534755942),('m180430_063056_fakultas',1534755942),('m180502_011916_kelas',1534755942),('m180502_020627_module',1534755943),('m180502_024214_tahun_ajaran',1534755943),('m180502_085225_semester',1534755943),('m180503_024141_dosen_kelas',1534755943),('m180503_024156_module_kelas',1534755944),('m180503_031107_peran',1534755944),('m180503_032756_module_tahun_ajaran',1534755945),('m180503_033029_peran_hitung',1534755946),('m180507_020615_dosen_fakultas',1534755947),('m180511_032940_transaksi',1534755947),('m180511_090451_imbal_jasa',1534755949),('m180726_010548_noteijd',1534755949),('m180726_030551_jabatan',1534755949),('m180726_030900_personijd',1534755950);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module`
--

DROP TABLE IF EXISTS `module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(200) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `user_created` int(11) NOT NULL,
  `user_updated` int(11) DEFAULT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module`
--

LOCK TABLES `module` WRITE;
/*!40000 ALTER TABLE `module` DISABLE KEYS */;
/*!40000 ALTER TABLE `module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module_kelas`
--

DROP TABLE IF EXISTS `module_kelas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `module_kelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `tahun_ajaran_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `user_created` int(11) NOT NULL,
  `user_updated` int(11) DEFAULT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-module_kelas-semester_id` (`semester_id`),
  KEY `fk-module_kelas-module_id` (`module_id`),
  KEY `fk-module_kelas-kelas_id` (`kelas_id`),
  KEY `fk-module_kelas-tahun_ajaran_id` (`tahun_ajaran_id`),
  CONSTRAINT `fk-module_kelas-kelas_id` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk-module_kelas-module_id` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk-module_kelas-semester_id` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk-module_kelas-tahun_ajaran_id` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajaran` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module_kelas`
--

LOCK TABLES `module_kelas` WRITE;
/*!40000 ALTER TABLE `module_kelas` DISABLE KEYS */;
/*!40000 ALTER TABLE `module_kelas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module_tahun_ajaran`
--

DROP TABLE IF EXISTS `module_tahun_ajaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `module_tahun_ajaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) NOT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `tahun_ajaran_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `periode` varchar(50) DEFAULT NULL,
  `jumlah_sks` smallint(3) NOT NULL,
  `jumlah_menit_per_sks` smallint(3) NOT NULL DEFAULT 50,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-module_tahun_ajaran-semester_id` (`semester_id`),
  KEY `fk-module_tahun_ajaran-module_id` (`module_id`),
  KEY `fk-module_tahun_ajaran-tahun_ajaran_id` (`tahun_ajaran_id`),
  CONSTRAINT `fk-module_tahun_ajaran-module_id` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk-module_tahun_ajaran-semester_id` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk-module_tahun_ajaran-tahun_ajaran_id` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajaran` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module_tahun_ajaran`
--

LOCK TABLES `module_tahun_ajaran` WRITE;
/*!40000 ALTER TABLE `module_tahun_ajaran` DISABLE KEYS */;
/*!40000 ALTER TABLE `module_tahun_ajaran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `noteijd`
--

DROP TABLE IF EXISTS `noteijd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `noteijd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `tahun_ajaran_id` int(11) NOT NULL,
  `no_urut` tinyint(3) NOT NULL,
  `user_created` int(11) NOT NULL,
  `user_updated` int(11) DEFAULT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-noteijd-tahun_ajaran_id` (`tahun_ajaran_id`),
  CONSTRAINT `fk-noteijd-tahun_ajaran_id` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajaran` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `noteijd`
--

LOCK TABLES `noteijd` WRITE;
/*!40000 ALTER TABLE `noteijd` DISABLE KEYS */;
/*!40000 ALTER TABLE `noteijd` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peran`
--

DROP TABLE IF EXISTS `peran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `peran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `user_created` int(11) NOT NULL,
  `user_updated` int(11) DEFAULT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peran`
--

LOCK TABLES `peran` WRITE;
/*!40000 ALTER TABLE `peran` DISABLE KEYS */;
/*!40000 ALTER TABLE `peran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peran_hitung`
--

DROP TABLE IF EXISTS `peran_hitung`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `peran_hitung` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `peran_id` int(11) NOT NULL,
  `module_tahun_ajaran_id` int(11) NOT NULL,
  `tahun_ajaran_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `bulan` smallint(2) NOT NULL,
  `tahun` smallint(4) NOT NULL,
  `jumlah_menit_hitung` smallint(6) NOT NULL DEFAULT 60 COMMENT 'per jam(dalam satuan menit)',
  `honor_menit_hitung` int(11) NOT NULL COMMENT 'nilai imbal jasa',
  `transport_hitung` int(11) DEFAULT NULL COMMENT 'transport imbal jasa',
  `volume_menit_pertemuan` smallint(3) NOT NULL DEFAULT 120,
  `keterangan` text DEFAULT NULL,
  `user_created` int(11) NOT NULL,
  `user_updated` int(11) DEFAULT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-peran_hitung-semester_id` (`semester_id`),
  KEY `fk-peran_hitung-peran_id` (`peran_id`),
  KEY `fk-peran_hitung-tahun_ajaran_id` (`tahun_ajaran_id`),
  KEY `fk-peran_hitung-module_tahun_ajaran_id` (`module_tahun_ajaran_id`),
  CONSTRAINT `fk-peran_hitung-module_tahun_ajaran_id` FOREIGN KEY (`module_tahun_ajaran_id`) REFERENCES `module_tahun_ajaran` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk-peran_hitung-peran_id` FOREIGN KEY (`peran_id`) REFERENCES `peran` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk-peran_hitung-semester_id` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk-peran_hitung-tahun_ajaran_id` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajaran` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peran_hitung`
--

LOCK TABLES `peran_hitung` WRITE;
/*!40000 ALTER TABLE `peran_hitung` DISABLE KEYS */;
/*!40000 ALTER TABLE `peran_hitung` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personijd`
--

DROP TABLE IF EXISTS `personijd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personijd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dosen_id` int(11) NOT NULL,
  `jabatan_id` int(11) NOT NULL,
  `tahun_ajaran_id` int(11) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `status` tinyint(3) NOT NULL COMMENT '1: aktif, 0: not aktif',
  `user_created` int(11) NOT NULL,
  `user_updated` int(11) DEFAULT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-personijd-jabatan_id` (`jabatan_id`),
  KEY `fk-personijd-dosen_id` (`dosen_id`),
  KEY `fk-personijd-tahun_ajaran_id` (`tahun_ajaran_id`),
  CONSTRAINT `fk-personijd-dosen_id` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk-personijd-jabatan_id` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatan` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk-personijd-tahun_ajaran_id` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajaran` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personijd`
--

LOCK TABLES `personijd` WRITE;
/*!40000 ALTER TABLE `personijd` DISABLE KEYS */;
/*!40000 ALTER TABLE `personijd` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ruangan`
--

DROP TABLE IF EXISTS `ruangan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ruangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `kapasitas` smallint(3) DEFAULT NULL,
  `user_created` int(11) NOT NULL,
  `user_updated` int(11) DEFAULT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ruangan`
--

LOCK TABLES `ruangan` WRITE;
/*!40000 ALTER TABLE `ruangan` DISABLE KEYS */;
/*!40000 ALTER TABLE `ruangan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `semester`
--

DROP TABLE IF EXISTS `semester`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `semester` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `user_created` int(11) NOT NULL,
  `user_updated` int(11) DEFAULT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nama` (`nama`),
  UNIQUE KEY `nama-index-semester` (`nama`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `semester`
--

LOCK TABLES `semester` WRITE;
/*!40000 ALTER TABLE `semester` DISABLE KEYS */;
/*!40000 ALTER TABLE `semester` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tahun_ajaran`
--

DROP TABLE IF EXISTS `tahun_ajaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tahun_ajaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `periode_awal` date NOT NULL,
  `periode_akhir` date NOT NULL,
  `periode` varchar(50) DEFAULT NULL,
  `status` smallint(1) DEFAULT 0,
  `user_created` int(11) NOT NULL,
  `user_updated` int(11) DEFAULT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `periode` (`periode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tahun_ajaran`
--

LOCK TABLES `tahun_ajaran` WRITE;
/*!40000 ALTER TABLE `tahun_ajaran` DISABLE KEYS */;
/*!40000 ALTER TABLE `tahun_ajaran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaksi`
--

DROP TABLE IF EXISTS `transaksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_transaksi` varchar(15) NOT NULL COMMENT 'Ym/IJD/xxx',
  `tgl_transaksi` datetime NOT NULL,
  `tahun_ajaran_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `bulan_tahun` date NOT NULL,
  `keterangan` text DEFAULT NULL,
  `user_created` int(11) NOT NULL,
  `user_updated` int(11) DEFAULT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `no_transaksi` (`no_transaksi`),
  UNIQUE KEY `no_transaksi-index-transaksi` (`no_transaksi`),
  UNIQUE KEY `bulan_tahun-index-transaksi` (`bulan_tahun`,`tahun_ajaran_id`),
  KEY `fk-transaksi-semester_id` (`semester_id`),
  CONSTRAINT `fk-transaksi-semester_id` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaksi`
--

LOCK TABLES `transaksi` WRITE;
/*!40000 ALTER TABLE `transaksi` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaksi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Iwan','eA7QlLuqEqGSDRwIY2ORU3FG82DDE8tw','$2y$13$O.qs7EuvIT7pFiTB/9FS2usnR.maV8PnpIRFx7wSmXpq/lsumr.Om',NULL,'iwandevapps@gmail.com',10,1524620714,1524620714),(2,'Suhandi','zPlPZLM8TzQxOonVEVXs4S11Gy-dPala','$2y$13$raII1xdrwSbiEGuB9HW4GO/vZ5qjuH.ah7KwltQyF12MISi8D2hPW',NULL,'andie.mukhlish04@gmail.com',10,1524710748,1524710748);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-08-20  9:15:49
