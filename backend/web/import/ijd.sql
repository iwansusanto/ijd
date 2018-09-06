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
-- Table structure for table `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `auth_assignment_user_id_idx` (`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_assignment`
--

LOCK TABLES `auth_assignment` WRITE;
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
INSERT INTO `auth_assignment` VALUES ('Admin','1',1534993623),('Akademik','3',1534993613),('Remun','4',1534995889);
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item`
--

LOCK TABLES `auth_item` WRITE;
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
INSERT INTO `auth_item` VALUES ('/*',2,NULL,NULL,NULL,1534990560,1534990560),('/admin/*',2,NULL,NULL,NULL,1534990558,1534990558),('/admin/assignment/*',2,NULL,NULL,NULL,1534990557,1534990557),('/admin/assignment/assign',2,NULL,NULL,NULL,1534990557,1534990557),('/admin/assignment/index',2,NULL,NULL,NULL,1534990557,1534990557),('/admin/assignment/revoke',2,NULL,NULL,NULL,1534990557,1534990557),('/admin/assignment/view',2,NULL,NULL,NULL,1534990557,1534990557),('/admin/default/*',2,NULL,NULL,NULL,1534990557,1534990557),('/admin/default/index',2,NULL,NULL,NULL,1534990557,1534990557),('/admin/menu/*',2,NULL,NULL,NULL,1534990557,1534990557),('/admin/menu/create',2,NULL,NULL,NULL,1534990557,1534990557),('/admin/menu/delete',2,NULL,NULL,NULL,1534990557,1534990557),('/admin/menu/index',2,NULL,NULL,NULL,1534990557,1534990557),('/admin/menu/update',2,NULL,NULL,NULL,1534990557,1534990557),('/admin/menu/view',2,NULL,NULL,NULL,1534990557,1534990557),('/admin/permission/*',2,NULL,NULL,NULL,1534990557,1534990557),('/admin/permission/assign',2,NULL,NULL,NULL,1534990557,1534990557),('/admin/permission/create',2,NULL,NULL,NULL,1534990557,1534990557),('/admin/permission/delete',2,NULL,NULL,NULL,1534990557,1534990557),('/admin/permission/index',2,NULL,NULL,NULL,1534990557,1534990557),('/admin/permission/remove',2,NULL,NULL,NULL,1534990557,1534990557),('/admin/permission/update',2,NULL,NULL,NULL,1534990557,1534990557),('/admin/permission/view',2,NULL,NULL,NULL,1534990557,1534990557),('/admin/role/*',2,NULL,NULL,NULL,1534990557,1534990557),('/admin/role/assign',2,NULL,NULL,NULL,1534990557,1534990557),('/admin/role/create',2,NULL,NULL,NULL,1534990557,1534990557),('/admin/role/delete',2,NULL,NULL,NULL,1534990557,1534990557),('/admin/role/index',2,NULL,NULL,NULL,1534990557,1534990557),('/admin/role/remove',2,NULL,NULL,NULL,1534990557,1534990557),('/admin/role/update',2,NULL,NULL,NULL,1534990557,1534990557),('/admin/role/view',2,NULL,NULL,NULL,1534990557,1534990557),('/admin/route/*',2,NULL,NULL,NULL,1534990557,1534990557),('/admin/route/assign',2,NULL,NULL,NULL,1534990557,1534990557),('/admin/route/create',2,NULL,NULL,NULL,1534990557,1534990557),('/admin/route/index',2,NULL,NULL,NULL,1534990557,1534990557),('/admin/route/refresh',2,NULL,NULL,NULL,1534990557,1534990557),('/admin/route/remove',2,NULL,NULL,NULL,1534990557,1534990557),('/admin/rule/*',2,NULL,NULL,NULL,1534990558,1534990558),('/admin/rule/create',2,NULL,NULL,NULL,1534990557,1534990557),('/admin/rule/delete',2,NULL,NULL,NULL,1534990558,1534990558),('/admin/rule/index',2,NULL,NULL,NULL,1534990557,1534990557),('/admin/rule/update',2,NULL,NULL,NULL,1534990557,1534990557),('/admin/rule/view',2,NULL,NULL,NULL,1534990557,1534990557),('/admin/user/*',2,NULL,NULL,NULL,1534990558,1534990558),('/admin/user/activate',2,NULL,NULL,NULL,1534990558,1534990558),('/admin/user/change-password',2,NULL,NULL,NULL,1534990558,1534990558),('/admin/user/delete',2,NULL,NULL,NULL,1534990558,1534990558),('/admin/user/index',2,NULL,NULL,NULL,1534990558,1534990558),('/admin/user/login',2,NULL,NULL,NULL,1534990558,1534990558),('/admin/user/logout',2,NULL,NULL,NULL,1534990558,1534990558),('/admin/user/request-password-reset',2,NULL,NULL,NULL,1534990558,1534990558),('/admin/user/reset-password',2,NULL,NULL,NULL,1534990558,1534990558),('/admin/user/signup',2,NULL,NULL,NULL,1534990558,1534990558),('/admin/user/view',2,NULL,NULL,NULL,1534990558,1534990558),('/debug/*',2,NULL,NULL,NULL,1534990558,1534990558),('/debug/default/*',2,NULL,NULL,NULL,1534990558,1534990558),('/debug/default/db-explain',2,NULL,NULL,NULL,1534990558,1534990558),('/debug/default/download-mail',2,NULL,NULL,NULL,1534990558,1534990558),('/debug/default/index',2,NULL,NULL,NULL,1534990558,1534990558),('/debug/default/toolbar',2,NULL,NULL,NULL,1534990558,1534990558),('/debug/default/view',2,NULL,NULL,NULL,1534990558,1534990558),('/debug/user/*',2,NULL,NULL,NULL,1534990558,1534990558),('/debug/user/reset-identity',2,NULL,NULL,NULL,1534990558,1534990558),('/debug/user/set-identity',2,NULL,NULL,NULL,1534990558,1534990558),('/dosen/*',2,NULL,NULL,NULL,1534990558,1534990558),('/dosen/create',2,NULL,NULL,NULL,1534990558,1534990558),('/dosen/delete',2,NULL,NULL,NULL,1534990558,1534990558),('/dosen/download',2,NULL,NULL,NULL,1534990558,1534990558),('/dosen/import',2,NULL,NULL,NULL,1534990558,1534990558),('/dosen/index',2,NULL,NULL,NULL,1534990558,1534990558),('/dosen/update',2,NULL,NULL,NULL,1534990558,1534990558),('/dosen/view',2,NULL,NULL,NULL,1534990558,1534990558),('/dosenfakultas/*',2,NULL,NULL,NULL,1534990558,1534990558),('/dosenfakultas/adddosenrow',2,NULL,NULL,NULL,1534990558,1534990558),('/dosenfakultas/create',2,NULL,NULL,NULL,1534990558,1534990558),('/dosenfakultas/createtemplate',2,NULL,NULL,NULL,1534990558,1534990558),('/dosenfakultas/delete',2,NULL,NULL,NULL,1534990558,1534990558),('/dosenfakultas/index',2,NULL,NULL,NULL,1534990558,1534990558),('/dosenfakultas/sessiontemplate',2,NULL,NULL,NULL,1534990558,1534990558),('/dosenfakultas/update',2,NULL,NULL,NULL,1534990558,1534990558),('/dosenfakultas/view',2,NULL,NULL,NULL,1534990558,1534990558),('/export/*',2,NULL,NULL,NULL,1534990558,1534990558),('/export/pdfijd',2,NULL,NULL,NULL,1534990558,1534990558),('/export/pdfpivotdosen',2,NULL,NULL,NULL,1534990558,1534990558),('/export/pdfpivotfakultas',2,NULL,NULL,NULL,1534990558,1534990558),('/export/pdfpivotmodule',2,NULL,NULL,NULL,1534990558,1534990558),('/fakultas/*',2,NULL,NULL,NULL,1534990558,1534990558),('/fakultas/create',2,NULL,NULL,NULL,1534990558,1534990558),('/fakultas/delete',2,NULL,NULL,NULL,1534990558,1534990558),('/fakultas/import',2,NULL,NULL,NULL,1534990558,1534990558),('/fakultas/index',2,NULL,NULL,NULL,1534990558,1534990558),('/fakultas/update',2,NULL,NULL,NULL,1534990558,1534990558),('/fakultas/view',2,NULL,NULL,NULL,1534990558,1534990558),('/gii/*',2,NULL,NULL,NULL,1534990558,1534990558),('/gii/default/*',2,NULL,NULL,NULL,1534990558,1534990558),('/gii/default/action',2,NULL,NULL,NULL,1534990558,1534990558),('/gii/default/diff',2,NULL,NULL,NULL,1534990558,1534990558),('/gii/default/index',2,NULL,NULL,NULL,1534990558,1534990558),('/gii/default/preview',2,NULL,NULL,NULL,1534990558,1534990558),('/gii/default/view',2,NULL,NULL,NULL,1534990558,1534990558),('/imbaljasa/*',2,NULL,NULL,NULL,1534990558,1534990558),('/imbaljasa/create',2,NULL,NULL,NULL,1534990558,1534990558),('/imbaljasa/delete',2,NULL,NULL,NULL,1534990558,1534990558),('/imbaljasa/index',2,NULL,NULL,NULL,1534990558,1534990558),('/imbaljasa/update',2,NULL,NULL,NULL,1534990558,1534990558),('/imbaljasa/view',2,NULL,NULL,NULL,1534990558,1534990558),('/jabatan/*',2,NULL,NULL,NULL,1534990558,1534990558),('/jabatan/create',2,NULL,NULL,NULL,1534990558,1534990558),('/jabatan/delete',2,NULL,NULL,NULL,1534990558,1534990558),('/jabatan/index',2,NULL,NULL,NULL,1534990558,1534990558),('/jabatan/update',2,NULL,NULL,NULL,1534990558,1534990558),('/jabatan/view',2,NULL,NULL,NULL,1534990558,1534990558),('/kelas/*',2,NULL,NULL,NULL,1534990559,1534990559),('/kelas/create',2,NULL,NULL,NULL,1534990558,1534990558),('/kelas/delete',2,NULL,NULL,NULL,1534990558,1534990558),('/kelas/download',2,NULL,NULL,NULL,1534990559,1534990559),('/kelas/import',2,NULL,NULL,NULL,1534990559,1534990559),('/kelas/index',2,NULL,NULL,NULL,1534990558,1534990558),('/kelas/update',2,NULL,NULL,NULL,1534990558,1534990558),('/kelas/view',2,NULL,NULL,NULL,1534990558,1534990558),('/module/*',2,NULL,NULL,NULL,1534990559,1534990559),('/module/create',2,NULL,NULL,NULL,1534990559,1534990559),('/module/delete',2,NULL,NULL,NULL,1534990559,1534990559),('/module/index',2,NULL,NULL,NULL,1534990559,1534990559),('/module/update',2,NULL,NULL,NULL,1534990559,1534990559),('/module/view',2,NULL,NULL,NULL,1534990559,1534990559),('/modulekelas/*',2,NULL,NULL,NULL,1534990559,1534990559),('/modulekelas/create',2,NULL,NULL,NULL,1534990559,1534990559),('/modulekelas/delete',2,NULL,NULL,NULL,1534990559,1534990559),('/modulekelas/deleteall',2,NULL,NULL,NULL,1534990559,1534990559),('/modulekelas/index',2,NULL,NULL,NULL,1534990559,1534990559),('/modulekelas/update',2,NULL,NULL,NULL,1534990559,1534990559),('/modulekelas/view',2,NULL,NULL,NULL,1534990559,1534990559),('/moduletahunajaran/*',2,NULL,NULL,NULL,1534990559,1534990559),('/moduletahunajaran/create',2,NULL,NULL,NULL,1534990559,1534990559),('/moduletahunajaran/delete',2,NULL,NULL,NULL,1534990559,1534990559),('/moduletahunajaran/index',2,NULL,NULL,NULL,1534990559,1534990559),('/moduletahunajaran/update',2,NULL,NULL,NULL,1534990559,1534990559),('/moduletahunajaran/view',2,NULL,NULL,NULL,1534990559,1534990559),('/noteijd/*',2,NULL,NULL,NULL,1534990559,1534990559),('/noteijd/create',2,NULL,NULL,NULL,1534990559,1534990559),('/noteijd/delete',2,NULL,NULL,NULL,1534990559,1534990559),('/noteijd/index',2,NULL,NULL,NULL,1534990559,1534990559),('/noteijd/update',2,NULL,NULL,NULL,1534990559,1534990559),('/noteijd/view',2,NULL,NULL,NULL,1534990559,1534990559),('/peran/*',2,NULL,NULL,NULL,1534990559,1534990559),('/peran/create',2,NULL,NULL,NULL,1534990559,1534990559),('/peran/delete',2,NULL,NULL,NULL,1534990559,1534990559),('/peran/index',2,NULL,NULL,NULL,1534990559,1534990559),('/peran/update',2,NULL,NULL,NULL,1534990559,1534990559),('/peran/view',2,NULL,NULL,NULL,1534990559,1534990559),('/peranhitung/*',2,NULL,NULL,NULL,1534990559,1534990559),('/peranhitung/create',2,NULL,NULL,NULL,1534990559,1534990559),('/peranhitung/delete',2,NULL,NULL,NULL,1534990559,1534990559),('/peranhitung/index',2,NULL,NULL,NULL,1534990559,1534990559),('/peranhitung/update',2,NULL,NULL,NULL,1534990559,1534990559),('/peranhitung/view',2,NULL,NULL,NULL,1534990559,1534990559),('/personijd/*',2,NULL,NULL,NULL,1534990559,1534990559),('/personijd/create',2,NULL,NULL,NULL,1534990559,1534990559),('/personijd/delete',2,NULL,NULL,NULL,1534990559,1534990559),('/personijd/index',2,NULL,NULL,NULL,1534990559,1534990559),('/personijd/update',2,NULL,NULL,NULL,1534990559,1534990559),('/personijd/view',2,NULL,NULL,NULL,1534990559,1534990559),('/report/*',2,NULL,NULL,NULL,1534990559,1534990559),('/report/gabung',2,NULL,NULL,NULL,1534990559,1534990559),('/report/jsondosen',2,NULL,NULL,NULL,1534990559,1534990559),('/report/jsonreportgabung',2,NULL,NULL,NULL,1534990559,1534990559),('/report/jsonreportpivotdosen',2,NULL,NULL,NULL,1534990559,1534990559),('/report/jsonreportpivotfakultas',2,NULL,NULL,NULL,1534990559,1534990559),('/report/jsonreportpivotmodule',2,NULL,NULL,NULL,1534990559,1534990559),('/report/pivotdosen',2,NULL,NULL,NULL,1534990559,1534990559),('/report/pivotfakultas',2,NULL,NULL,NULL,1534990559,1534990559),('/report/pivotmodule',2,NULL,NULL,NULL,1534990559,1534990559),('/ruangan/*',2,NULL,NULL,NULL,1534990559,1534990559),('/ruangan/create',2,NULL,NULL,NULL,1534990559,1534990559),('/ruangan/delete',2,NULL,NULL,NULL,1534990559,1534990559),('/ruangan/download',2,NULL,NULL,NULL,1534990559,1534990559),('/ruangan/import',2,NULL,NULL,NULL,1534990559,1534990559),('/ruangan/index',2,NULL,NULL,NULL,1534990559,1534990559),('/ruangan/update',2,NULL,NULL,NULL,1534990559,1534990559),('/ruangan/view',2,NULL,NULL,NULL,1534990559,1534990559),('/site/*',2,NULL,NULL,NULL,1534990559,1534990559),('/site/error',2,NULL,NULL,NULL,1534990559,1534990559),('/site/index',2,NULL,NULL,NULL,1534990559,1534990559),('/site/login',2,NULL,NULL,NULL,1534990559,1534990559),('/site/logout',2,NULL,NULL,NULL,1534990559,1534990559),('/site/signup',2,NULL,NULL,NULL,1534990559,1534990559),('/tahunajaran/*',2,NULL,NULL,NULL,1534990485,1534990485),('/tahunajaran/create',2,NULL,NULL,NULL,1534990485,1534990485),('/tahunajaran/delete',2,NULL,NULL,NULL,1534990485,1534990485),('/tahunajaran/index',2,NULL,NULL,NULL,1534990485,1534990485),('/tahunajaran/update',2,NULL,NULL,NULL,1534990485,1534990485),('/tahunajaran/view',2,NULL,NULL,NULL,1534990485,1534990485),('/transaksi/*',2,NULL,NULL,NULL,1534990560,1534990560),('/transaksi/create',2,NULL,NULL,NULL,1534990560,1534990560),('/transaksi/delete',2,NULL,NULL,NULL,1534990560,1534990560),('/transaksi/dosenfakultas',2,NULL,NULL,NULL,1534990560,1534990560),('/transaksi/hitungimbaljasa',2,NULL,NULL,NULL,1534990560,1534990560),('/transaksi/imbaljasa',2,NULL,NULL,NULL,1534990560,1534990560),('/transaksi/index',2,NULL,NULL,NULL,1534990559,1534990559),('/transaksi/jsonimbaljasa',2,NULL,NULL,NULL,1534990560,1534990560),('/transaksi/jsonkelas',2,NULL,NULL,NULL,1534990560,1534990560),('/transaksi/jsonlihatkelas',2,NULL,NULL,NULL,1534990560,1534990560),('/transaksi/jsonmodule',2,NULL,NULL,NULL,1534990560,1534990560),('/transaksi/jsonperan',2,NULL,NULL,NULL,1534990560,1534990560),('/transaksi/jsonruang',2,NULL,NULL,NULL,1534990560,1534990560),('/transaksi/save',2,NULL,NULL,NULL,1534990560,1534990560),('/transaksi/update',2,NULL,NULL,NULL,1534990560,1534990560),('/transaksi/view',2,NULL,NULL,NULL,1534990559,1534990559),('Admin',1,'This is user admin application',NULL,NULL,1534993379,1534993806),('Akademik',1,'Role for user akademik to input data akademik while to used by user remun',NULL,NULL,1534990577,1534993780),('Akses Admin IJD',2,'Access for all menu, be carefully to change this permission',NULL,NULL,1534996312,1534996312),('Akses Data Master',2,'Persmission for user input data master',NULL,NULL,1534995944,1534995944),('Akses Hitung Peran',2,'Access for user input data hitung peran',NULL,NULL,1534996127,1534996127),('Akses Remun',2,'Access for menu remun ',NULL,NULL,1534994132,1534996176),('Akses Report',2,'Access menu report ',NULL,NULL,1534994325,1534996196),('Akses Tahun Ajaran',2,'Access tahun  ajaran for user',NULL,NULL,1535083477,1535083477),('Remun',1,'Role for insert data to Simbajadik UI',NULL,NULL,1534993683,1534994539);
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item_child`
--

LOCK TABLES `auth_item_child` WRITE;
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
INSERT INTO `auth_item_child` VALUES ('Admin','Akses Admin IJD'),('Akademik','Akses Data Master'),('Akademik','Akses Hitung Peran'),('Akademik','Akses Remun'),('Akademik','Akses Tahun Ajaran'),('Akses Admin IJD','/*'),('Akses Admin IJD','/admin/*'),('Akses Admin IJD','/admin/assignment/*'),('Akses Admin IJD','/admin/assignment/assign'),('Akses Admin IJD','/admin/assignment/index'),('Akses Admin IJD','/admin/assignment/revoke'),('Akses Admin IJD','/admin/assignment/view'),('Akses Admin IJD','/admin/default/*'),('Akses Admin IJD','/admin/default/index'),('Akses Admin IJD','/admin/menu/*'),('Akses Admin IJD','/admin/menu/create'),('Akses Admin IJD','/admin/menu/delete'),('Akses Admin IJD','/admin/menu/index'),('Akses Admin IJD','/admin/menu/update'),('Akses Admin IJD','/admin/menu/view'),('Akses Admin IJD','/admin/permission/*'),('Akses Admin IJD','/admin/permission/assign'),('Akses Admin IJD','/admin/permission/create'),('Akses Admin IJD','/admin/permission/delete'),('Akses Admin IJD','/admin/permission/index'),('Akses Admin IJD','/admin/permission/remove'),('Akses Admin IJD','/admin/permission/update'),('Akses Admin IJD','/admin/permission/view'),('Akses Admin IJD','/admin/role/*'),('Akses Admin IJD','/admin/role/assign'),('Akses Admin IJD','/admin/role/create'),('Akses Admin IJD','/admin/role/delete'),('Akses Admin IJD','/admin/role/index'),('Akses Admin IJD','/admin/role/remove'),('Akses Admin IJD','/admin/role/update'),('Akses Admin IJD','/admin/role/view'),('Akses Admin IJD','/admin/route/*'),('Akses Admin IJD','/admin/route/assign'),('Akses Admin IJD','/admin/route/create'),('Akses Admin IJD','/admin/route/index'),('Akses Admin IJD','/admin/route/refresh'),('Akses Admin IJD','/admin/route/remove'),('Akses Admin IJD','/admin/rule/*'),('Akses Admin IJD','/admin/rule/create'),('Akses Admin IJD','/admin/rule/delete'),('Akses Admin IJD','/admin/rule/index'),('Akses Admin IJD','/admin/rule/update'),('Akses Admin IJD','/admin/rule/view'),('Akses Admin IJD','/admin/user/*'),('Akses Admin IJD','/admin/user/activate'),('Akses Admin IJD','/admin/user/change-password'),('Akses Admin IJD','/admin/user/delete'),('Akses Admin IJD','/admin/user/index'),('Akses Admin IJD','/admin/user/login'),('Akses Admin IJD','/admin/user/logout'),('Akses Admin IJD','/admin/user/request-password-reset'),('Akses Admin IJD','/admin/user/reset-password'),('Akses Admin IJD','/admin/user/signup'),('Akses Admin IJD','/admin/user/view'),('Akses Admin IJD','/debug/*'),('Akses Admin IJD','/debug/default/*'),('Akses Admin IJD','/debug/default/db-explain'),('Akses Admin IJD','/debug/default/download-mail'),('Akses Admin IJD','/debug/default/index'),('Akses Admin IJD','/debug/default/toolbar'),('Akses Admin IJD','/debug/default/view'),('Akses Admin IJD','/debug/user/*'),('Akses Admin IJD','/debug/user/reset-identity'),('Akses Admin IJD','/debug/user/set-identity'),('Akses Admin IJD','/dosen/*'),('Akses Admin IJD','/dosen/create'),('Akses Admin IJD','/dosen/delete'),('Akses Admin IJD','/dosen/download'),('Akses Admin IJD','/dosen/import'),('Akses Admin IJD','/dosen/index'),('Akses Admin IJD','/dosen/update'),('Akses Admin IJD','/dosen/view'),('Akses Admin IJD','/dosenfakultas/*'),('Akses Admin IJD','/dosenfakultas/adddosenrow'),('Akses Admin IJD','/dosenfakultas/create'),('Akses Admin IJD','/dosenfakultas/createtemplate'),('Akses Admin IJD','/dosenfakultas/delete'),('Akses Admin IJD','/dosenfakultas/index'),('Akses Admin IJD','/dosenfakultas/sessiontemplate'),('Akses Admin IJD','/dosenfakultas/update'),('Akses Admin IJD','/dosenfakultas/view'),('Akses Admin IJD','/export/*'),('Akses Admin IJD','/export/pdfijd'),('Akses Admin IJD','/export/pdfpivotdosen'),('Akses Admin IJD','/export/pdfpivotfakultas'),('Akses Admin IJD','/export/pdfpivotmodule'),('Akses Admin IJD','/fakultas/*'),('Akses Admin IJD','/fakultas/create'),('Akses Admin IJD','/fakultas/delete'),('Akses Admin IJD','/fakultas/import'),('Akses Admin IJD','/fakultas/index'),('Akses Admin IJD','/fakultas/update'),('Akses Admin IJD','/fakultas/view'),('Akses Admin IJD','/gii/*'),('Akses Admin IJD','/gii/default/*'),('Akses Admin IJD','/gii/default/action'),('Akses Admin IJD','/gii/default/diff'),('Akses Admin IJD','/gii/default/index'),('Akses Admin IJD','/gii/default/preview'),('Akses Admin IJD','/gii/default/view'),('Akses Admin IJD','/imbaljasa/*'),('Akses Admin IJD','/imbaljasa/create'),('Akses Admin IJD','/imbaljasa/delete'),('Akses Admin IJD','/imbaljasa/index'),('Akses Admin IJD','/imbaljasa/update'),('Akses Admin IJD','/imbaljasa/view'),('Akses Admin IJD','/jabatan/*'),('Akses Admin IJD','/jabatan/create'),('Akses Admin IJD','/jabatan/delete'),('Akses Admin IJD','/jabatan/index'),('Akses Admin IJD','/jabatan/update'),('Akses Admin IJD','/jabatan/view'),('Akses Admin IJD','/kelas/*'),('Akses Admin IJD','/kelas/create'),('Akses Admin IJD','/kelas/delete'),('Akses Admin IJD','/kelas/download'),('Akses Admin IJD','/kelas/import'),('Akses Admin IJD','/kelas/index'),('Akses Admin IJD','/kelas/update'),('Akses Admin IJD','/kelas/view'),('Akses Admin IJD','/module/*'),('Akses Admin IJD','/module/create'),('Akses Admin IJD','/module/delete'),('Akses Admin IJD','/module/index'),('Akses Admin IJD','/module/update'),('Akses Admin IJD','/module/view'),('Akses Admin IJD','/modulekelas/*'),('Akses Admin IJD','/modulekelas/create'),('Akses Admin IJD','/modulekelas/delete'),('Akses Admin IJD','/modulekelas/deleteall'),('Akses Admin IJD','/modulekelas/index'),('Akses Admin IJD','/modulekelas/update'),('Akses Admin IJD','/modulekelas/view'),('Akses Admin IJD','/moduletahunajaran/*'),('Akses Admin IJD','/moduletahunajaran/create'),('Akses Admin IJD','/moduletahunajaran/delete'),('Akses Admin IJD','/moduletahunajaran/index'),('Akses Admin IJD','/moduletahunajaran/update'),('Akses Admin IJD','/moduletahunajaran/view'),('Akses Admin IJD','/noteijd/*'),('Akses Admin IJD','/noteijd/create'),('Akses Admin IJD','/noteijd/delete'),('Akses Admin IJD','/noteijd/index'),('Akses Admin IJD','/noteijd/update'),('Akses Admin IJD','/noteijd/view'),('Akses Admin IJD','/peran/*'),('Akses Admin IJD','/peran/create'),('Akses Admin IJD','/peran/delete'),('Akses Admin IJD','/peran/index'),('Akses Admin IJD','/peran/update'),('Akses Admin IJD','/peran/view'),('Akses Admin IJD','/peranhitung/*'),('Akses Admin IJD','/peranhitung/create'),('Akses Admin IJD','/peranhitung/delete'),('Akses Admin IJD','/peranhitung/index'),('Akses Admin IJD','/peranhitung/update'),('Akses Admin IJD','/peranhitung/view'),('Akses Admin IJD','/personijd/*'),('Akses Admin IJD','/personijd/create'),('Akses Admin IJD','/personijd/delete'),('Akses Admin IJD','/personijd/index'),('Akses Admin IJD','/personijd/update'),('Akses Admin IJD','/personijd/view'),('Akses Admin IJD','/report/*'),('Akses Admin IJD','/report/gabung'),('Akses Admin IJD','/report/jsondosen'),('Akses Admin IJD','/report/jsonreportgabung'),('Akses Admin IJD','/report/jsonreportpivotdosen'),('Akses Admin IJD','/report/jsonreportpivotfakultas'),('Akses Admin IJD','/report/jsonreportpivotmodule'),('Akses Admin IJD','/report/pivotdosen'),('Akses Admin IJD','/report/pivotfakultas'),('Akses Admin IJD','/report/pivotmodule'),('Akses Admin IJD','/ruangan/*'),('Akses Admin IJD','/ruangan/create'),('Akses Admin IJD','/ruangan/delete'),('Akses Admin IJD','/ruangan/download'),('Akses Admin IJD','/ruangan/import'),('Akses Admin IJD','/ruangan/index'),('Akses Admin IJD','/ruangan/update'),('Akses Admin IJD','/ruangan/view'),('Akses Admin IJD','/site/*'),('Akses Admin IJD','/site/error'),('Akses Admin IJD','/site/index'),('Akses Admin IJD','/site/login'),('Akses Admin IJD','/site/logout'),('Akses Admin IJD','/site/signup'),('Akses Admin IJD','/tahunajaran/*'),('Akses Admin IJD','/tahunajaran/create'),('Akses Admin IJD','/tahunajaran/delete'),('Akses Admin IJD','/tahunajaran/index'),('Akses Admin IJD','/tahunajaran/update'),('Akses Admin IJD','/tahunajaran/view'),('Akses Admin IJD','/transaksi/*'),('Akses Admin IJD','/transaksi/create'),('Akses Admin IJD','/transaksi/delete'),('Akses Admin IJD','/transaksi/dosenfakultas'),('Akses Admin IJD','/transaksi/hitungimbaljasa'),('Akses Admin IJD','/transaksi/imbaljasa'),('Akses Admin IJD','/transaksi/index'),('Akses Admin IJD','/transaksi/jsonimbaljasa'),('Akses Admin IJD','/transaksi/jsonkelas'),('Akses Admin IJD','/transaksi/jsonlihatkelas'),('Akses Admin IJD','/transaksi/jsonmodule'),('Akses Admin IJD','/transaksi/jsonperan'),('Akses Admin IJD','/transaksi/jsonruang'),('Akses Admin IJD','/transaksi/save'),('Akses Admin IJD','/transaksi/update'),('Akses Admin IJD','/transaksi/view'),('Akses Data Master','/dosen/*'),('Akses Data Master','/dosen/create'),('Akses Data Master','/dosen/delete'),('Akses Data Master','/dosen/download'),('Akses Data Master','/dosen/import'),('Akses Data Master','/dosen/index'),('Akses Data Master','/dosen/update'),('Akses Data Master','/dosen/view'),('Akses Data Master','/fakultas/*'),('Akses Data Master','/fakultas/create'),('Akses Data Master','/fakultas/delete'),('Akses Data Master','/fakultas/import'),('Akses Data Master','/fakultas/index'),('Akses Data Master','/fakultas/update'),('Akses Data Master','/fakultas/view'),('Akses Data Master','/jabatan/*'),('Akses Data Master','/jabatan/create'),('Akses Data Master','/jabatan/delete'),('Akses Data Master','/jabatan/index'),('Akses Data Master','/jabatan/update'),('Akses Data Master','/jabatan/view'),('Akses Data Master','/kelas/*'),('Akses Data Master','/kelas/create'),('Akses Data Master','/kelas/delete'),('Akses Data Master','/kelas/download'),('Akses Data Master','/kelas/import'),('Akses Data Master','/kelas/index'),('Akses Data Master','/kelas/update'),('Akses Data Master','/kelas/view'),('Akses Data Master','/module/*'),('Akses Data Master','/module/create'),('Akses Data Master','/module/delete'),('Akses Data Master','/module/index'),('Akses Data Master','/module/update'),('Akses Data Master','/module/view'),('Akses Data Master','/peran/*'),('Akses Data Master','/peran/create'),('Akses Data Master','/peran/delete'),('Akses Data Master','/peran/index'),('Akses Data Master','/peran/update'),('Akses Data Master','/peran/view'),('Akses Data Master','/ruangan/*'),('Akses Data Master','/ruangan/create'),('Akses Data Master','/ruangan/delete'),('Akses Data Master','/ruangan/download'),('Akses Data Master','/ruangan/import'),('Akses Data Master','/ruangan/index'),('Akses Data Master','/ruangan/update'),('Akses Data Master','/ruangan/view'),('Akses Data Master','/tahunajaran/*'),('Akses Data Master','/tahunajaran/create'),('Akses Data Master','/tahunajaran/delete'),('Akses Data Master','/tahunajaran/index'),('Akses Data Master','/tahunajaran/update'),('Akses Data Master','/tahunajaran/view'),('Akses Hitung Peran','/peranhitung/*'),('Akses Hitung Peran','/peranhitung/create'),('Akses Hitung Peran','/peranhitung/delete'),('Akses Hitung Peran','/peranhitung/index'),('Akses Hitung Peran','/peranhitung/update'),('Akses Hitung Peran','/peranhitung/view'),('Akses Remun','/transaksi/*'),('Akses Remun','/transaksi/create'),('Akses Remun','/transaksi/delete'),('Akses Remun','/transaksi/dosenfakultas'),('Akses Remun','/transaksi/hitungimbaljasa'),('Akses Remun','/transaksi/imbaljasa'),('Akses Remun','/transaksi/index'),('Akses Remun','/transaksi/jsonimbaljasa'),('Akses Remun','/transaksi/jsonkelas'),('Akses Remun','/transaksi/jsonlihatkelas'),('Akses Remun','/transaksi/jsonmodule'),('Akses Remun','/transaksi/jsonperan'),('Akses Remun','/transaksi/jsonruang'),('Akses Remun','/transaksi/save'),('Akses Remun','/transaksi/update'),('Akses Remun','/transaksi/view'),('Akses Report','/report/*'),('Akses Report','/report/gabung'),('Akses Report','/report/jsondosen'),('Akses Report','/report/jsonreportgabung'),('Akses Report','/report/jsonreportpivotdosen'),('Akses Report','/report/jsonreportpivotfakultas'),('Akses Report','/report/jsonreportpivotmodule'),('Akses Report','/report/pivotdosen'),('Akses Report','/report/pivotfakultas'),('Akses Report','/report/pivotmodule'),('Akses Tahun Ajaran','/dosenfakultas/*'),('Akses Tahun Ajaran','/dosenfakultas/adddosenrow'),('Akses Tahun Ajaran','/dosenfakultas/create'),('Akses Tahun Ajaran','/dosenfakultas/createtemplate'),('Akses Tahun Ajaran','/dosenfakultas/delete'),('Akses Tahun Ajaran','/dosenfakultas/index'),('Akses Tahun Ajaran','/dosenfakultas/sessiontemplate'),('Akses Tahun Ajaran','/dosenfakultas/update'),('Akses Tahun Ajaran','/dosenfakultas/view'),('Akses Tahun Ajaran','/modulekelas/*'),('Akses Tahun Ajaran','/modulekelas/create'),('Akses Tahun Ajaran','/modulekelas/delete'),('Akses Tahun Ajaran','/modulekelas/deleteall'),('Akses Tahun Ajaran','/modulekelas/index'),('Akses Tahun Ajaran','/modulekelas/update'),('Akses Tahun Ajaran','/modulekelas/view'),('Akses Tahun Ajaran','/moduletahunajaran/*'),('Akses Tahun Ajaran','/moduletahunajaran/create'),('Akses Tahun Ajaran','/moduletahunajaran/delete'),('Akses Tahun Ajaran','/moduletahunajaran/index'),('Akses Tahun Ajaran','/moduletahunajaran/update'),('Akses Tahun Ajaran','/moduletahunajaran/view'),('Akses Tahun Ajaran','/noteijd/*'),('Akses Tahun Ajaran','/noteijd/create'),('Akses Tahun Ajaran','/noteijd/delete'),('Akses Tahun Ajaran','/noteijd/index'),('Akses Tahun Ajaran','/noteijd/update'),('Akses Tahun Ajaran','/noteijd/view'),('Akses Tahun Ajaran','/personijd/*'),('Akses Tahun Ajaran','/personijd/create'),('Akses Tahun Ajaran','/personijd/delete'),('Akses Tahun Ajaran','/personijd/index'),('Akses Tahun Ajaran','/personijd/update'),('Akses Tahun Ajaran','/personijd/view'),('Akses Tahun Ajaran','/transaksi/dosenfakultas'),('Remun','Akses Remun'),('Remun','Akses Report');
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_rule`
--

LOCK TABLES `auth_rule` WRITE;
/*!40000 ALTER TABLE `auth_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_rule` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'Master',NULL,NULL,2,'database'),(2,'Tahun Ajaran',1,'/tahunajaran/index',1,'hourglass-3'),(3,'Dosen',1,'/dosen/index',2,'user'),(4,'Ruangan',1,'/ruangan/index',3,'building'),(5,'Fakultas',1,'/fakultas/index',4,'graduation-cap'),(6,'Kelas',1,'/kelas/index',5,'window-maximize'),(7,'Module',1,'/module/index',6,'file-text'),(8,'Peran',1,'/peran/index',7,'blind'),(9,'Jabatan',1,'/jabatan/index',8,'handshake-o'),(10,'Setting',NULL,NULL,1,'gears'),(11,'User',10,'/admin/user/index',1,'user-md'),(12,'Assignment',10,'/admin/assignment/index',2,'american-sign-language-interpreting'),(13,'Route',10,'/admin/route/index',3,'exchange'),(14,'Permission',10,'/admin/permission/index',4,'handshake-o'),(15,'Menu',10,'/admin/menu/index',5,'bars'),(16,'Role',10,'/admin/role/index',6,'unlock-alt'),(17,'Gii',10,'/gii/default/index',7,'file-code-o'),(18,'Tahun Ajaran',NULL,NULL,3,'calendar'),(19,'Dosen dan Fakultas',18,'/dosenfakultas/index',1,'sitemap'),(20,'Module dan Tahun Ajaran',18,'/moduletahunajaran/index',2,'table'),(21,'Module dan Kelas',18,'/modulekelas/index',3,'cubes'),(22,'Note Ijd',18,'/noteijd/index',4,'sticky-note-o'),(23,'Person Ijd',18,'/personijd/index',5,'user-md'),(24,'Transaction',NULL,NULL,4,'window-restore'),(25,'Hitung Peran',24,'/peranhitung/index',1,'calculator'),(26,'Hitung Imbal Jasa',24,'/transaksi/index',2,'th'),(27,'Report',NULL,NULL,5,'file-text-o'),(28,'Gabung',27,'/report/gabung',1,'file-text'),(29,'Pivot Dosen',27,'/report/pivotdosen',2,'files-o'),(30,'Pivot Fakultas',27,'/report/pivotfakultas',3,'file-powerpoint-o'),(31,'Pivot Module',27,'/report/pivotmodule',4,'file-o');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
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
INSERT INTO `migration` VALUES ('m000000_000000_base',1534755941),('m130524_201442_init',1534755942),('m140506_102106_rbac_init',1534987012),('m140506_102106_rbac_init.deleted',1534842677),('m140602_111327_create_menu_table',1534842540),('m160312_050000_create_user',1534842540),('m170907_052038_rbac_add_index_on_auth_assignment_user_id',1534987012),('m170907_052038_rbac_add_index_on_auth_assignment_user_id.deleted',1534842677),('m180426_032627_dosen',1534755942),('m180430_043420_ruangan',1534755942),('m180430_063056_fakultas',1534755942),('m180502_011916_kelas',1534755942),('m180502_020627_module',1534755943),('m180502_024214_tahun_ajaran',1534755943),('m180502_085225_semester',1534755943),('m180503_024141_dosen_kelas',1534755943),('m180503_024156_module_kelas',1534755944),('m180503_031107_peran',1534755944),('m180503_032756_module_tahun_ajaran',1534755945),('m180503_033029_peran_hitung',1534755946),('m180507_020615_dosen_fakultas',1534755947),('m180511_032940_transaksi',1534755947),('m180511_090451_imbal_jasa',1534755949),('m180726_010548_noteijd',1534755949),('m180726_030551_jabatan',1534755949),('m180726_030900_personijd',1534755950);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Iwan','eA7QlLuqEqGSDRwIY2ORU3FG82DDE8tw','$2y$13$O.qs7EuvIT7pFiTB/9FS2usnR.maV8PnpIRFx7wSmXpq/lsumr.Om',NULL,'iwandevapps@gmail.com',10,1524620714,1524620714),(3,'Igo','CmZIgLmXRvWWirwevnxcsz9cX65pEroY','$2y$13$VqAluOwxlZs5Tm5mYbDwdOYs4AWL8CxEgYiLh7Phu9hPe5aExhE5O',NULL,'igo@gmail.com',10,1534986584,1534986584),(4,'Suhandi','Z0GKKRDFe_unf48jQ16vTgRTC0pKxah7','$2y$13$5DgAtjWVV0YNKfZG7OTLleuynhGDfzYcKTfYrg4.Vxt5Ls/7/4JKC',NULL,'andie.mukhlish04@gmail.com',10,1534988905,1534988905);
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

-- Dump completed on 2018-08-28  1:59:30
