-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 24 Janvier 2017 à 10:28
-- Version du serveur: 5.5.43-0ubuntu0.14.04.1
-- Version de PHP: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `a2df_informatique`
--

-- --------------------------------------------------------

--
-- Structure de la table `Charges`
--

CREATE TABLE IF NOT EXISTS `Charges` (
  `id` char(8) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `numContrat` varchar(16) NOT NULL,
  `numTel` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Charges`
--

INSERT INTO `Charges` (`id`, `nom`, `description`, `numContrat`, `numTel`) VALUES
('03507844', 'JeSuisUneCharge', 'JeSuisUneDescription', '0123456789101112', '0123456788'),
('0350785A', 'ChargeTest', 'DescriptionTest', '054564145E789SQ4', '0978451574');

-- --------------------------------------------------------

--
-- Structure de la table `Fournisseurs`
--

CREATE TABLE IF NOT EXISTS `Fournisseurs` (
  `id` char(8) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `adresseRue` varchar(45) NOT NULL,
  `codePostal` char(5) NOT NULL,
  `ville` varchar(35) NOT NULL,
  `tel` varchar(13) NOT NULL,
  `adresseElectronique` varchar(70) DEFAULT NULL,
  `paiement` char(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Fournisseurs`
--

INSERT INTO `Fournisseurs` (`id`, `nom`, `adresseRue`, `codePostal`, `ville`, `tel`, `adresseElectronique`, `paiement`) VALUES
('0350784D', 'FournisseurTest', '5rue hgfh Briand', '49876', 'st tropez', '0363036306', 'hfjkhdsf@ghfigif.fr', '548'),
('0350784F', 'FournisseurTest', '5rue hgfh Briand', '49876', 'st tropez', '0363036306', 'hfjkhdsf@ghfigif.fr', '548'),
('0350784N', 'FournisseurTest', '5rue hgfh Briand', '49876', 'st tropez', '0363036306', 'hfjkhdsf@ghfigif.fr', '548');

-- --------------------------------------------------------

--
-- Structure de la table `Semaine1`
--

CREATE TABLE IF NOT EXISTS `Semaine1` (
  `id` char(2) NOT NULL,
  `designation` varchar(32) NOT NULL,
  `type` varchar(16) NOT NULL,
  `prix` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Semaine1`
--

INSERT INTO `Semaine1` (`id`, `designation`, `type`, `prix`) VALUES
('01', 'Test', 'Vente', '499.99'),
('02', 'Test', 'Dépannage', '49.9'),
('03', 'Test', 'Vente', '654.9'),
('04', 'Test', 'Dépannage', '49.9');

-- --------------------------------------------------------

--
-- Structure de la table `Semaine2`
--

CREATE TABLE IF NOT EXISTS `Semaine2` (
  `id` char(2) NOT NULL,
  `designation` varchar(32) NOT NULL,
  `type` varchar(16) NOT NULL,
  `prix` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Semaine2`
--

INSERT INTO `Semaine2` (`id`, `designation`, `type`, `prix`) VALUES
('01', 'Test', 'Vente', '499.99'),
('02', 'Test', 'Dépannage', '49.9'),
('03', 'Test', 'Vente', '654.9'),
('04', 'Test', 'Dépannage', '49.9');

-- --------------------------------------------------------

--
-- Structure de la table `Semaine3`
--

CREATE TABLE IF NOT EXISTS `Semaine3` (
  `id` char(2) NOT NULL,
  `designation` varchar(32) NOT NULL,
  `type` varchar(16) NOT NULL,
  `prix` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Semaine3`
--

INSERT INTO `Semaine3` (`id`, `designation`, `type`, `prix`) VALUES
('01', 'Test', 'Vente', '499.99'),
('02', 'Test', 'Dépannage', '49.9'),
('03', 'Test', 'Vente', '654.9'),
('04', 'Test', 'Dépannage', '49.9');

-- --------------------------------------------------------

--
-- Structure de la table `Semaine4`
--

CREATE TABLE IF NOT EXISTS `Semaine4` (
  `id` char(2) NOT NULL,
  `designation` varchar(32) NOT NULL,
  `type` varchar(16) NOT NULL,
  `prix` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Semaine4`
--

INSERT INTO `Semaine4` (`id`, `designation`, `type`, `prix`) VALUES
('01', 'Test', 'Vente', '499.99'),
('02', 'Test', 'Dépannage', '49.9'),
('03', 'Test', 'Vente', '654.9'),
('04', 'Test', 'Dépannage', '49.9');

-- --------------------------------------------------------

--
-- Structure de la table `Synthese`
--

CREATE TABLE IF NOT EXISTS `Synthese` (
  `id` char(2) NOT NULL,
  `mois` varchar(9) NOT NULL,
  `compte` varchar(8) NOT NULL,
  `cb` varchar(8) NOT NULL,
  `espece` varchar(8) NOT NULL,
  `cheque` varchar(8) NOT NULL,
  `totalFinMois` varchar(8) NOT NULL,
  `totalMoisPlusUn` varchar(8) NOT NULL,
  `caMoisHt` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Synthese`
--

INSERT INTO `Synthese` (`id`, `mois`, `compte`, `cb`, `espece`, `cheque`, `totalFinMois`, `totalMoisPlusUn`, `caMoisHt`) VALUES
('01', 'Janvier', '54', '8', '87', '7', '156', '156', '0'),
('02', 'Février', '', '', '', '', '', '', ''),
('03', 'Mars', '', '', '', '', '', '', ''),
('04', 'Avril', '', '', '', '', '', '', ''),
('05', 'Mai', '', '', '', '', '', '', ''),
('06', 'Juin', '', '', '', '', '', '', ''),
('07', 'Juillet', '', '', '', '', '', '', ''),
('08', 'Aout', '', '', '', '', '', '', ''),
('09', 'Septembre', '', '', '', '', '', '', ''),
('10', 'Octobre', '', '', '', '', '', '', ''),
('11', 'Novembre', '', '', '', '', '', '', ''),
('12', 'Décembre', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `TotalSemaine1`
--

CREATE TABLE IF NOT EXISTS `TotalSemaine1` (
  `id` char(2) NOT NULL,
  `total` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `TotalSemaine1`
--

INSERT INTO `TotalSemaine1` (`id`, `total`) VALUES
('01', '');

-- --------------------------------------------------------

--
-- Structure de la table `TotalSemaine2`
--

CREATE TABLE IF NOT EXISTS `TotalSemaine2` (
  `id` char(2) NOT NULL,
  `total` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `TotalSemaine2`
--

INSERT INTO `TotalSemaine2` (`id`, `total`) VALUES
('01', '');

-- --------------------------------------------------------

--
-- Structure de la table `TotalSemaine3`
--

CREATE TABLE IF NOT EXISTS `TotalSemaine3` (
  `id` char(2) NOT NULL,
  `total` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `TotalSemaine3`
--

INSERT INTO `TotalSemaine3` (`id`, `total`) VALUES
('01', '');

-- --------------------------------------------------------

--
-- Structure de la table `TotalSemaine4`
--

CREATE TABLE IF NOT EXISTS `TotalSemaine4` (
  `id` char(2) NOT NULL,
  `total` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `TotalSemaine4`
--

INSERT INTO `TotalSemaine4` (`id`, `total`) VALUES
('01', '');

-- --------------------------------------------------------

--
-- Structure de la table `Visiteur`
--

CREATE TABLE IF NOT EXISTS `Visiteur` (
  `id` char(4) NOT NULL,
  `nom` char(30) DEFAULT NULL,
  `prenom` char(30) DEFAULT NULL,
  `login` char(20) DEFAULT NULL,
  `mdp` char(40) DEFAULT NULL,
  `adresse` char(30) DEFAULT NULL,
  `cp` char(5) DEFAULT NULL,
  `ville` char(30) DEFAULT NULL,
  `dateEmbauche` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `id_3` (`id`),
  KEY `id_2` (`id`),
  KEY `id_4` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Visiteur`
--

INSERT INTO `Visiteur` (`id`, `nom`, `prenom`, `login`, `mdp`, `adresse`, `cp`, `ville`, `dateEmbauche`) VALUES
('', 'Admin', 'A2DF', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '', '44330', 'Le Pallet', '0000-00-00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
