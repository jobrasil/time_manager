-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.40


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema time_manager
--

CREATE DATABASE IF NOT EXISTS time_manager;
USE time_manager;

--
-- Definition of table `tm_activities`
--

DROP TABLE IF EXISTS `tm_activities`;
CREATE TABLE `tm_activities` (
  `acti_id` int(11) NOT NULL AUTO_INCREMENT,
  `acti_description` varchar(45) NOT NULL,
  `acti_phas_id` int(11) NOT NULL,
  `acti_date_start` datetime NOT NULL,
  `acti_date_end` datetime DEFAULT NULL,
  `acti_stat_id` int(11) NOT NULL,
  PRIMARY KEY (`acti_id`),
  KEY `FK_tm_activities_1` (`acti_phas_id`) USING BTREE,
  KEY `FK_tm_activities_2` (`acti_stat_id`),
  CONSTRAINT `FK_tm_activities_1` FOREIGN KEY (`acti_phas_id`) REFERENCES `tm_phases` (`phas_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tm_activities_2` FOREIGN KEY (`acti_stat_id`) REFERENCES `tm_status` (`stat_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tm_activities`
--

/*!40000 ALTER TABLE `tm_activities` DISABLE KEYS */;
/*!40000 ALTER TABLE `tm_activities` ENABLE KEYS */;


--
-- Definition of table `tm_difficulties`
--

DROP TABLE IF EXISTS `tm_difficulties`;
CREATE TABLE `tm_difficulties` (
  `diff_id` int(11) NOT NULL AUTO_INCREMENT,
  `diff_tydi_id` int(11) NOT NULL,
  `diff_description` varchar(45) NOT NULL,
  PRIMARY KEY (`diff_id`),
  KEY `FK_tm_difficulties_1` (`diff_tydi_id`),
  CONSTRAINT `FK_tm_difficulties_1` FOREIGN KEY (`diff_tydi_id`) REFERENCES `tm_type_difficulties` (`tydi_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tm_difficulties`
--

/*!40000 ALTER TABLE `tm_difficulties` DISABLE KEYS */;
/*!40000 ALTER TABLE `tm_difficulties` ENABLE KEYS */;


--
-- Definition of table `tm_occupation`
--

DROP TABLE IF EXISTS `tm_occupation`;
CREATE TABLE `tm_occupation` (
  `occu_id` int(11) NOT NULL AUTO_INCREMENT,
  `occu_tyoc_id` int(11) NOT NULL,
  `occu_acti_id` int(11) DEFAULT NULL,
  `occu_ocsu_id` int(11) DEFAULT NULL,
  `occu_hour` time NOT NULL,
  `occu_date` date NOT NULL,
  PRIMARY KEY (`occu_id`),
  KEY `FK_tm_occupation_1` (`occu_tyoc_id`),
  KEY `FK_tm_occupation_2` (`occu_acti_id`),
  KEY `FK_tm_occupation_3` (`occu_ocsu_id`),
  CONSTRAINT `FK_tm_occupation_1` FOREIGN KEY (`occu_tyoc_id`) REFERENCES `tm_type_occupation` (`tyoc_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tm_occupation_2` FOREIGN KEY (`occu_acti_id`) REFERENCES `tm_activities` (`acti_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tm_occupation_3` FOREIGN KEY (`occu_ocsu_id`) REFERENCES `tm_occupation_subcategories` (`ocsu_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tm_occupation`
--

/*!40000 ALTER TABLE `tm_occupation` DISABLE KEYS */;
/*!40000 ALTER TABLE `tm_occupation` ENABLE KEYS */;


--
-- Definition of table `tm_occupation_categories`
--

DROP TABLE IF EXISTS `tm_occupation_categories`;
CREATE TABLE `tm_occupation_categories` (
  `occa_id` int(11) NOT NULL AUTO_INCREMENT,
  `occa_description` varchar(45) NOT NULL,
  PRIMARY KEY (`occa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tm_occupation_categories`
--

/*!40000 ALTER TABLE `tm_occupation_categories` DISABLE KEYS */;
INSERT INTO `tm_occupation_categories` (`occa_id`,`occa_description`) VALUES 
 (1,'NECESSICADES PRIMÁRIAS'),
 (2,'TRABALHO'),
 (3,'RELACIONAMENTO'),
 (4,'ESPIRITULIDADE'),
 (5,'INVESTIMENTO'),
 (6,'SAÚDE'),
 (7,'ENTRETENIMENTO'),
 (8,'PRATICAS');
/*!40000 ALTER TABLE `tm_occupation_categories` ENABLE KEYS */;


--
-- Definition of table `tm_occupation_subcategories`
--

DROP TABLE IF EXISTS `tm_occupation_subcategories`;
CREATE TABLE `tm_occupation_subcategories` (
  `ocsu_id` int(11) NOT NULL AUTO_INCREMENT,
  `ocsu_occa_id` int(11) NOT NULL,
  `ocsu_description` varchar(45) NOT NULL,
  PRIMARY KEY (`ocsu_id`),
  KEY `FK_tm_occupation_subcategories_1` (`ocsu_occa_id`),
  CONSTRAINT `FK_tm_occupation_subcategories_1` FOREIGN KEY (`ocsu_occa_id`) REFERENCES `tm_occupation_categories` (`occa_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tm_occupation_subcategories`
--

/*!40000 ALTER TABLE `tm_occupation_subcategories` DISABLE KEYS */;
INSERT INTO `tm_occupation_subcategories` (`ocsu_id`,`ocsu_occa_id`,`ocsu_description`) VALUES 
 (1,1,'COMER'),
 (2,1,'HIGIENE PESSOAL'),
 (3,1,'DORMIR'),
 (4,2,'TURNO NORMAL'),
 (5,2,'HORA EXTRA'),
 (6,2,'FAZENDO BICO'),
 (7,3,'FAMÍLIA'),
 (8,3,'AMIGOS'),
 (9,3,'ESPOSA/ NAMORADA'),
 (10,4,'IR A IGREJA'),
 (11,4,'IR AOS ESTUDOS'),
 (12,4,'TRABALHOS VOLUNTÁRIOS'),
 (13,5,'FACULDADE/ ESTUDOS'),
 (14,5,'CURSO/ TREINAMENTO'),
 (15,6,'EXAMES DE ROTINA'),
 (16,6,'DOENTE'),
 (17,7,'PASSEIO DIURNO'),
 (18,7,'CINEMAS, SHOWS, BALADAS'),
 (19,7,'ESPORTES, ACADEMIA, CORRIDA'),
 (20,7,'JOGOS ELETRONICOS'),
 (21,7,'CELULAR'),
 (22,8,'DIRIGINDO'),
 (23,8,'EM UMA LIGAÇÃO'),
 (24,8,'RESPONDENDO EMAILS'),
 (25,8,'CONSERTANDO ALGO'),
 (26,8,'INDO PARA ALGUM LUGAR'),
 (27,8,'AFAZERES DOMÉSTICOS');
/*!40000 ALTER TABLE `tm_occupation_subcategories` ENABLE KEYS */;


--
-- Definition of table `tm_phases`
--

DROP TABLE IF EXISTS `tm_phases`;
CREATE TABLE `tm_phases` (
  `phas_id` int(11) NOT NULL AUTO_INCREMENT,
  `phas_date_start` datetime DEFAULT NULL,
  `phas_date_end` datetime DEFAULT NULL,
  `phas_name` varchar(45) NOT NULL,
  `phas_description` text,
  `phas_proj_id` int(11) NOT NULL,
  `phas_end` tinyint(1) DEFAULT NULL,
  `phas_stat_id` int(11) NOT NULL,
  PRIMARY KEY (`phas_id`),
  KEY `FK_tm_phases_1` (`phas_proj_id`),
  KEY `FK_tm_phases_2` (`phas_stat_id`),
  CONSTRAINT `FK_tm_phases_1` FOREIGN KEY (`phas_proj_id`) REFERENCES `tm_projects` (`proj_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tm_phases_2` FOREIGN KEY (`phas_stat_id`) REFERENCES `tm_status` (`stat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tm_phases`
--

/*!40000 ALTER TABLE `tm_phases` DISABLE KEYS */;
/*!40000 ALTER TABLE `tm_phases` ENABLE KEYS */;


--
-- Definition of table `tm_projects`
--

DROP TABLE IF EXISTS `tm_projects`;
CREATE TABLE `tm_projects` (
  `proj_id` int(11) NOT NULL AUTO_INCREMENT,
  `proj_date_start` datetime DEFAULT NULL,
  `proj_date_end` datetime DEFAULT NULL,
  `proj_name` varchar(45) NOT NULL,
  `proj_objective` varchar(100) DEFAULT NULL,
  `proj_stat_id` int(11) NOT NULL,
  `proj_user_id` int(11) NOT NULL,
  `proj_time_manager` tinyint(1) NOT NULL,
  PRIMARY KEY (`proj_id`),
  KEY `FK_tm_projects_1` (`proj_stat_id`),
  KEY `FK_tm_projects_2` (`proj_user_id`),
  CONSTRAINT `FK_tm_projects_1` FOREIGN KEY (`proj_stat_id`) REFERENCES `tm_status` (`stat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tm_projects_2` FOREIGN KEY (`proj_user_id`) REFERENCES `tm_users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tm_projects`
--

/*!40000 ALTER TABLE `tm_projects` DISABLE KEYS */;
/*!40000 ALTER TABLE `tm_projects` ENABLE KEYS */;


--
-- Definition of table `tm_status`
--

DROP TABLE IF EXISTS `tm_status`;
CREATE TABLE `tm_status` (
  `stat_id` int(11) NOT NULL AUTO_INCREMENT,
  `stat_description` varchar(45) NOT NULL,
  PRIMARY KEY (`stat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tm_status`
--

/*!40000 ALTER TABLE `tm_status` DISABLE KEYS */;
INSERT INTO `tm_status` (`stat_id`,`stat_description`) VALUES 
 (1,'Iniciado'),
 (2,'Em andamento'),
 (3,'Interrompido'),
 (4,'Cancelado'),
 (5,'Concluído');
/*!40000 ALTER TABLE `tm_status` ENABLE KEYS */;


--
-- Definition of table `tm_type_difficulties`
--

DROP TABLE IF EXISTS `tm_type_difficulties`;
CREATE TABLE `tm_type_difficulties` (
  `tydi_id` int(11) NOT NULL AUTO_INCREMENT,
  `tydi_description` varchar(45) NOT NULL,
  PRIMARY KEY (`tydi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tm_type_difficulties`
--

/*!40000 ALTER TABLE `tm_type_difficulties` DISABLE KEYS */;
INSERT INTO `tm_type_difficulties` (`tydi_id`,`tydi_description`) VALUES 
 (1,'FALTA DE DINHEIRO'),
 (2,'FALTA DE CONHECIMENTO'),
 (3,'FALTA DE DISPOSIÇÃO'),
 (4,'INTERROMPIDO POR AMIGOS'),
 (5,'INTERROMPIDO POR FAMÍLIA'),
 (6,'INTERROMPIDO POR TRABALHO');
/*!40000 ALTER TABLE `tm_type_difficulties` ENABLE KEYS */;


--
-- Definition of table `tm_type_occupation`
--

DROP TABLE IF EXISTS `tm_type_occupation`;
CREATE TABLE `tm_type_occupation` (
  `tyoc_id` int(11) NOT NULL AUTO_INCREMENT,
  `tyoc_description` varchar(45) NOT NULL,
  PRIMARY KEY (`tyoc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tm_type_occupation`
--

/*!40000 ALTER TABLE `tm_type_occupation` DISABLE KEYS */;
INSERT INTO `tm_type_occupation` (`tyoc_id`,`tyoc_description`) VALUES 
 (1,'Projetos'),
 (2,'Outras Ocupações');
/*!40000 ALTER TABLE `tm_type_occupation` ENABLE KEYS */;


--
-- Definition of table `tm_users`
--

DROP TABLE IF EXISTS `tm_users`;
CREATE TABLE `tm_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(45) NOT NULL,
  `user_login` varchar(9) NOT NULL,
  `user_password` text NOT NULL,
  `user_email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tm_users`
--

/*!40000 ALTER TABLE `tm_users` DISABLE KEYS */;
INSERT INTO `tm_users` (`user_id`,`user_name`,`user_login`,`user_password`,`user_email`) VALUES 
 (1,'João Paulo','jobrasil','asdasdasd','jo_brasil@hotmail.com');
/*!40000 ALTER TABLE `tm_users` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
