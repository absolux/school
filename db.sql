
-- MySQL dump 10.13  Distrib 5.5.50, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: db_ecole
-- ------------------------------------------------------
-- Server version	5.5.50-0ubuntu0.12.04.1

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
-- Table structure for table `inscriptions`
--

DROP TABLE IF EXISTS `inscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `date` date NOT NULL,
  `id_etudiant` int(11) NOT NULL,
  `id_filiere` int(11) NOT NULL,
  `id_niveau` int(11) NOT NULL,
  `id_annee` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_inscriptions_etudiants` (`id_etudiant`),
  KEY `FK_inscriptions_filieres` (`id_filiere`),
  KEY `FK_inscriptions_niveaux` (`id_niveau`),
  KEY `FK_inscriptions_annee_scolaires` (`id_annee`),
  CONSTRAINT `FK_inscriptions_annee_scolaires` FOREIGN KEY (`id_annee`) REFERENCES `annee_scolaires` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_inscriptions_etudiants` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_inscriptions_filieres` FOREIGN KEY (`id_filiere`) REFERENCES `filieres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_inscriptions_niveaux` FOREIGN KEY (`id_niveau`) REFERENCES `niveaux` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `semestres`
--

DROP TABLE IF EXISTS `semestres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `semestres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_annee` int(11) NOT NULL,
  `label` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_semestres_annee_scolaires` (`id_annee`),
  CONSTRAINT `FK_semestres_annee_scolaires` FOREIGN KEY (`id_annee`) REFERENCES `annee_scolaires` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `filieres`
--

DROP TABLE IF EXISTS `filieres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `filieres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL DEFAULT '',
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `absences`
--

DROP TABLE IF EXISTS `absences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `absences` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_seance` int(11) NOT NULL,
  `id_etudiant` int(11) NOT NULL,
  `statut` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_absences_seances` (`id_seance`),
  KEY `FK_absences_etudiants` (`id_etudiant`),
  CONSTRAINT `FK_absences_etudiants` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_absences_seances` FOREIGN KEY (`id_seance`) REFERENCES `seances` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `groupes`
--

DROP TABLE IF EXISTS `groupes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groupes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL,
  `id_niveau` int(11) DEFAULT NULL,
  `id_annee` int(11) NOT NULL,
  `id_filiere` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_groupes_1` (`id_niveau`),
  KEY `fk_groupes_2` (`id_annee`),
  KEY `fk_groupes_3` (`id_filiere`),
  CONSTRAINT `fk_groupes_1` FOREIGN KEY (`id_niveau`) REFERENCES `niveaux` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_groupes_2` FOREIGN KEY (`id_annee`) REFERENCES `annee_scolaires` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_groupes_3` FOREIGN KEY (`id_filiere`) REFERENCES `filieres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `annee_scolaires`
--

DROP TABLE IF EXISTS `annee_scolaires`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `annee_scolaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `label` varchar(50) NOT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `seances`
--

DROP TABLE IF EXISTS `seances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) DEFAULT NULL,
  `date_debut` datetime DEFAULT NULL,
  `date_fin` datetime DEFAULT NULL,
  `id_matiere` int(11) NOT NULL,
  `id_prof` int(11) DEFAULT NULL,
  `id_semestre` int(11) DEFAULT NULL,
  `id_group` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_seances_matieres` (`id_matiere`),
  KEY `FK_seances_professeurs` (`id_prof`),
  KEY `FK_seances_groups` (`id_group`),
  KEY `FK_seances_semestres` (`id_semestre`),
  CONSTRAINT `FK_seances_semestres` FOREIGN KEY (`id_semestre`) REFERENCES `semestres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_seances_groups` FOREIGN KEY (`id_group`) REFERENCES `groupes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_seances_matieres` FOREIGN KEY (`id_matiere`) REFERENCES `matieres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_seances_professeurs` FOREIGN KEY (`id_prof`) REFERENCES `professeurs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `filieres_matieres`
--

DROP TABLE IF EXISTS `filieres_matieres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `filieres_matieres` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_filiere` int(11) NOT NULL DEFAULT '0',
  `id_matiere` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_filiere` (`id_filiere`),
  KEY `FK_filieres_matieres_matieres` (`id_matiere`),
  CONSTRAINT `FK_filieres_matieres_filieres` FOREIGN KEY (`id_filiere`) REFERENCES `filieres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_filieres_matieres_matieres` FOREIGN KEY (`id_matiere`) REFERENCES `matieres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `etudiants`
--

DROP TABLE IF EXISTS `etudiants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `etudiants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `adresse` varchar(50) DEFAULT NULL,
  `zipcode` varchar(50) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `tel` varchar(50) DEFAULT NULL,
  `cin` varchar(50) DEFAULT NULL,
  `date_naiss` date DEFAULT NULL,
  `lieu_naiss` varchar(50) DEFAULT NULL,
  `sexe` varchar(50) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `index2` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

ALTER TABLE `etudiants` ADD `tel_parent` VARCHAR(50) NULL DEFAULT NULL AFTER `tel`;

--
-- Table structure for table `etudiants_groups`
--

DROP TABLE IF EXISTS `etudiants_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `etudiants_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_etudiant` int(11) NOT NULL DEFAULT '0',
  `id_group` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_etudiants_groups_etudiants` (`id_etudiant`),
  KEY `FK_etudiants_groups_groups` (`id_group`),
  CONSTRAINT `FK_etudiants_groups_etudiants` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_etudiants_groups_groups` FOREIGN KEY (`id_group`) REFERENCES `groupes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

ALTER TABLE `db_ecole`.`etudiants_groups` DROP INDEX `UK_id_etudiant_id_group`, ADD UNIQUE `UK_id_etudiant_id_group` (`id_etudiant`, `id_group`) USING BTREE;

--
-- Table structure for table `niveaux`
--

DROP TABLE IF EXISTS `niveaux`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `niveaux` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `matieres`
--

DROP TABLE IF EXISTS `matieres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `matieres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `professeurs`
--

DROP TABLE IF EXISTS `professeurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `professeurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `cin` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `sexe` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `groupes_details`
--

DROP TABLE IF EXISTS `groupes_details`;
/*!50001 DROP VIEW IF EXISTS `groupes_details`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `groupes_details` (
  `id` tinyint NOT NULL,
  `label` tinyint NOT NULL,
  `id_niveau` tinyint NOT NULL,
  `id_annee` tinyint NOT NULL,
  `id_filiere` tinyint NOT NULL,
  `annee` tinyint NOT NULL,
  `filiere` tinyint NOT NULL,
  `niveau` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `groupes_details`
--

/*!50001 DROP TABLE IF EXISTS `groupes_details`*/;
/*!50001 DROP VIEW IF EXISTS `groupes_details`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `groupes_details` AS select `groupes`.`id` AS `id`,`groupes`.`label` AS `label`,`groupes`.`id_niveau` AS `id_niveau`,`groupes`.`id_annee` AS `id_annee`,`groupes`.`id_filiere` AS `id_filiere`,`annees`.`label` AS `annee`,`filieres`.`label` AS `filiere`,`niveaux`.`label` AS `niveau` from (((`groupes` join `annee_scolaires` `annees` on((`annees`.`id` = `groupes`.`id_annee`))) join `niveaux` on((`niveaux`.`id` = `groupes`.`id_niveau`))) join `filieres` on((`filieres`.`id` = `groupes`.`id_filiere`))) order by `groupes`.`label` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Export de la structure de table db_ecole. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Export de données de la table db_ecole.users : ~0 rows (environ)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
  (1, 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

-- Dump completed on 2016-08-23  1:34:56