-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 19 Janvier 2015 à 00:42
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `svedi`
--
CREATE DATABASE IF NOT EXISTS `svedi` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `svedi`;

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

CREATE TABLE IF NOT EXISTS `filiere` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DateFiliere` year(4) NOT NULL,
  `Nom` varchar(25) NOT NULL,
  `ID_Utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_Filiere_ID_Utilisateur` (`ID_Utilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Contenu de la table `filiere`
--

INSERT INTO `filiere` (`ID`, `DateFiliere`, `Nom`, `ID_Utilisateur`) VALUES
(14, 2014, 'L3 MIAGE', 31),
(15, 2014, 'M1 MIAGE', 33),
(16, 2014, 'M2 MIGAE', 34),
(17, 2013, 'L3 MIAGE', 38),
(24, 2016, 'L3 MIAGE', 41),
(26, 2015, 'M1 MIAGE', 47),
(27, 2015, 'Master SI', 46);

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

CREATE TABLE IF NOT EXISTS `inscription` (
  `ID_Inscription` int(11) NOT NULL AUTO_INCREMENT,
  `DateInscription` year(4) DEFAULT NULL,
  `NbHeuresCours` int(11) DEFAULT NULL,
  `NbHeuresTD` int(11) DEFAULT NULL,
  `NbHeuresTP` int(11) DEFAULT NULL,
  `ID_Utilisateur` int(11) NOT NULL,
  `ID_Matiere` int(11) NOT NULL,
  `Conflit` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_Inscription`),
  UNIQUE KEY `ID_Utilisateur_2` (`ID_Utilisateur`,`ID_Matiere`),
  KEY `FK_Inscription_ID_Matiere` (`ID_Matiere`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=137 ;

--
-- Contenu de la table `inscription`
--

INSERT INTO `inscription` (`ID_Inscription`, `DateInscription`, `NbHeuresCours`, `NbHeuresTD`, `NbHeuresTP`, `ID_Utilisateur`, `ID_Matiere`, `Conflit`) VALUES
(106, 2013, 1, 0, 0, 31, 27, 0),
(107, 2013, 0, 1, 0, 31, 28, 0),
(108, 2014, 0, 2, 0, 31, 22, 0),
(109, 2014, 3, 2, 1, 31, 23, 0),
(110, 2014, 3, 2, 3, 31, 24, 0),
(111, 2014, 0, 0, 10, 31, 25, 1),
(113, 2014, 11, 12, 1, 31, 18, 1),
(115, 2015, 0, 0, 1, 31, 45, 0),
(123, 2015, 0, 0, 15, 31, 58, 1),
(126, 2015, 0, 0, 1, 46, 60, 0),
(133, 2015, 0, 0, 14, 31, 59, 1),
(135, 2015, 1, 0, 0, 31, 60, 0),
(136, 2015, 0, 1, 0, 33, 60, 0);

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

CREATE TABLE IF NOT EXISTS `matiere` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) NOT NULL,
  `MaxHeuresCours` int(11) NOT NULL,
  `MaxHeuresTD` int(11) NOT NULL,
  `MaxHeuresTP` int(11) NOT NULL,
  `ID_Filiere` int(11) DEFAULT NULL,
  `Semestre` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`),
  KEY `FK_Matiere_ID_Filiere` (`ID_Filiere`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

--
-- Contenu de la table `matiere`
--

INSERT INTO `matiere` (`ID`, `Nom`, `MaxHeuresCours`, `MaxHeuresTD`, `MaxHeuresTP`, `ID_Filiere`, `Semestre`) VALUES
(18, 'C  ', 10, 12, 13, 14, 1),
(20, 'Droit', 20, 5, 0, 14, 1),
(21, 'PHP', 10, 12, 9, 15, 1),
(22, 'XML', 10, 5, 5, 15, 2),
(23, 'Gestion', 10, 5, 5, 15, 1),
(24, 'MSI', 10, 5, 5, 16, 1),
(25, 'Urbanisation', 20, 5, 5, 16, 1),
(26, 'Archi SI', 25, 5, 5, 16, 1),
(27, 'Urbanisation', 2, 3, 2, 17, 1),
(28, 'Gestion', 10, 2, 10, 17, 1),
(29, 'Math', 2, 2, 2, 14, 1),
(45, 'PHP', 10, 12, 9, 22, 1),
(47, 'Gestion', 10, 5, 5, 22, 1),
(54, 'Anglais', 2, 3, 5, 24, 1),
(55, 'REST', 10, 2, 3, 24, 1),
(58, 'PHP', 10, 12, 9, 26, 1),
(59, 'XML', 10, 5, 5, 26, 2),
(60, 'Gestion', 10, 5, 5, 26, 1),
(61, 'MSI', 10, 12, 10, 27, 1),
(62, 'Urba', 10, 12, 10, 27, 1),
(63, 'Archi', 5, 5, 10, 27, 1),
(64, 'Sécu', 12, 6, 3, 27, 1);

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Texte` text,
  `DateNotification` datetime DEFAULT NULL,
  `Lu` tinyint(1) DEFAULT NULL,
  `ID_Utilisateur` int(11) NOT NULL,
  `TypeNotif` text NOT NULL,
  `ID_Inscription` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_Notification_ID_Utilisateur` (`ID_Utilisateur`),
  KEY `ID_Inscription` (`ID_Inscription`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=386 ;

--
-- Contenu de la table `notification`
--

INSERT INTO `notification` (`ID`, `Texte`, `DateNotification`, `Lu`, `ID_Utilisateur`, `TypeNotif`, `ID_Inscription`) VALUES
(307, 'Inscription', '2014-11-24 10:21:43', 0, 31, 'INS', 108),
(309, 'Inscription', '2014-11-24 10:23:34', 0, 31, 'INS', 110),
(349, 'Inscription', '2015-01-18 14:03:26', 0, 31, 'INS', 123),
(350, 'Conflit détecter concernant la matière PHP', '2015-01-18 14:03:24', 0, 31, 'CON', 123),
(355, 'Inscription', '2015-01-18 14:33:40', 0, 46, 'INS', 126),
(357, 'Conflit détecter concernant la matière Gestion', '2015-01-18 14:33:38', 0, 46, 'CON', 126),
(359, 'Conflit détecter concernant la matière Gestion', '2015-01-18 17:05:08', 0, 46, 'CON', 126),
(361, 'Conflit détecter concernant la matière Gestion', '2015-01-18 17:06:04', 0, 46, 'CON', 126),
(363, 'Conflit détecter concernant la matière Gestion', '2015-01-18 17:10:28', 0, 46, 'CON', 126),
(366, 'Conflit détecter concernant la matière Gestion', '2015-01-18 17:11:00', 0, 46, 'CON', 126),
(368, 'Conflit détecter concernant la matière Gestion', '2015-01-18 17:11:56', 0, 46, 'CON', 126),
(371, 'Conflit détecter concernant la matière Gestion', '2015-01-18 17:14:15', 0, 46, 'CON', 126),
(374, 'Conflit détecter concernant la matière Gestion', '2015-01-18 17:19:25', 0, 46, 'CON', 126),
(379, 'Inscription', '2015-01-18 17:26:37', 0, 31, 'INS', 133),
(380, 'Conflit détecter concernant la matière XML', '2015-01-18 17:26:35', 0, 31, 'CON', 133),
(382, 'Conflit détecter concernant la matière Gestion', '2015-01-18 17:27:51', 0, 46, 'CON', 126),
(384, 'Inscription', '2015-01-18 21:47:32', 0, 31, 'INS', 135),
(385, 'Inscription', '2015-01-18 22:48:45', 0, 33, 'INS', 136);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `role`
--

INSERT INTO `role` (`ID`, `Nom`) VALUES
(1, 'Enseignant'),
(2, 'Responsable'),
(3, 'Administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `typeutilisateur`
--

CREATE TABLE IF NOT EXISTS `typeutilisateur` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Code` varchar(4) NOT NULL,
  `Libelle` varchar(30) NOT NULL,
  `NbHeure` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `typeutilisateur`
--

INSERT INTO `typeutilisateur` (`ID`, `Code`, `Libelle`, `NbHeure`) VALUES
(1, 'VAC', 'Vacataire', 192),
(2, 'SUP', 'Autre', 180);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DateUtilisateur` year(4) NOT NULL,
  `Nom` varchar(25) DEFAULT NULL,
  `Prenom` varchar(25) DEFAULT NULL,
  `Sexe` varchar(1) NOT NULL,
  `Login` varchar(25) NOT NULL,
  `MotDePasse` varchar(25) NOT NULL,
  `Mail` varchar(50) NOT NULL,
  `Tel` varchar(13) NOT NULL,
  `Role` int(11) NOT NULL,
  `Type` varchar(4) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`ID`, `DateUtilisateur`, `Nom`, `Prenom`, `Sexe`, `Login`, `MotDePasse`, `Mail`, `Tel`, `Role`, `Type`) VALUES
(30, 0000, 'Admin', 'Admin', 'M', 'Admin', 'mdp', 'Admin@admin.fr', '600000000', 3, 'SUP'),
(31, 2014, 'Resp1', 'Resp1', 'M', 'Resp1', 'mdp', 'Resp1@hotmail.com', '189452501', 2, 'VAC'),
(33, 2014, 'Resp2', 'Resp2', 'M', 'Resp2', 'mdp', 'Resp2@gmail.com', '147895623', 2, 'SUP'),
(34, 2014, 'Resp3', 'Resp3', 'F', 'Resp3', 'mdp', 'Resp3@gmail.com', '0123568947', 2, 'VAC'),
(35, 2014, 'Ens1', 'Ens1', 'M', 'Ens1', 'mdp', 'Ens1@hotmail.fr', '145236987', 1, 'VAC'),
(36, 2014, 'Ens2', 'Ens2', 'M', 'Ens2', 'mdp', 'Ens2@hotmail.fr', '0125478963', 1, 'SUP'),
(37, 2014, 'Ens3', 'Ens3', 'M', 'Ens3', 'mdp', 'Ens3@hotmail.fr', '0147528693', 1, 'VAC'),
(38, 2013, 'Dupont', 'Pierre', 'M', 'Pierre', 'mdp', 'Pierre@hotmail.fr', '623145879', 2, 'VAC'),
(41, 2016, 'Toti', 'Carole', 'F', 'Carole', 'mdp', 'Carole@hotmail.fr', '145236987', 2, 'SUP'),
(46, 2015, 'Mohamed', 'Belkhir', 'M', 'mohamed', 'mdp', 'm.belkhir@hotmail.fr', '160891235', 2, 'SUP'),
(47, 2015, 'Axel', 'Ajavon', 'M', 'Axel', 'mdp', 'belkmoh@gmail.com', '123584769', 2, 'SUP'),
(54, 2015, 'Dubois', 'martin', 'M', 'Dubois', 'mdp', 'Dubois@gmail.com', '125478963', 1, 'SUP'),
(58, 2015, 'Gharbaoui', 'Youness', 'M', 'Youness', 'mdp', 'youness1307@gmail.com', '0123568947', 1, 'VAC'),
(59, 2016, 'Xavi', 'Alonzo', 'M', 'Alonzo', 'mdp', 'Alonzo@gmail.com', '0147582369', 1, 'SUP');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD CONSTRAINT `refMatiere` FOREIGN KEY (`ID_Matiere`) REFERENCES `matiere` (`ID`) ON DELETE NO ACTION,
  ADD CONSTRAINT `refUser` FOREIGN KEY (`ID_Utilisateur`) REFERENCES `utilisateur` (`ID`) ON DELETE NO ACTION;

--
-- Contraintes pour la table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `FK_Notification_ID_INS` FOREIGN KEY (`ID_Inscription`) REFERENCES `inscription` (`ID_Inscription`),
  ADD CONSTRAINT `FK_Notification_ID_Utilisateur` FOREIGN KEY (`ID_Utilisateur`) REFERENCES `utilisateur` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
