-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 06 Février 2017 à 11:26
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
  `date` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Charges`
--

INSERT INTO `Charges` (`id`, `nom`, `description`, `numContrat`, `numTel`, `date`) VALUES
('03507844', 'JeSuisUneCharge', 'JeSuisUneDescription', '0123456789101112', '0123456788', 'après le 12'),
('0350785A', 'ChargeTest', 'DescriptionTest', '054564145E789SQ4', '0978451576', 'avant le 12'),
('45645641', 'Ordi asus', 'JeSuisUneDescription', '0123456789101112', '0123456788', 'après le 12');

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
-- Structure de la table `Operations`
--

CREATE TABLE IF NOT EXISTS `Operations` (
  `id` char(8) NOT NULL,
  `designation` varchar(45) NOT NULL,
  `prix` varchar(8) NOT NULL,
  `type` varchar(10) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Operations`
--

INSERT INTO `Operations` (`id`, `designation`, `prix`, `type`, `date`) VALUES
('00000001', 'Ordinateur', '490.9', 'Vente', '2017-02-01'),
('00000002', 'Tablette', '49.9', 'Dépannage', '2017-02-01');

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
('10', 'Ordi', 'Vente', '52'),
('11', 'Ordi', 'Vente', '52'),
('12', 'Ordi', 'Vente', '52'),
('13', 'Ordi', 'Vente', '52'),
('14', 'Ordi', 'Vente', '52'),
('15', 'Ordi', 'Vente', '52'),
('16', 'Ordi', 'Vente', '52'),
('17', 'Ordi', 'Vente', '52'),
('19', 'Ordi', 'Vente', '52'),
('20', 'Ordi', 'Vente', '52'),
('21', 'Ordi', 'Vente', '52'),
('22', 'Ordi', 'Vente', '52'),
('23', 'Ordi', 'Vente', '52'),
('25', 'Ordi', 'Vente', '52'),
('27', 'Tablette', 'Vente', '350');

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
('01', 'Tablette', 'Dépannage', '50'),
('02', 'Tour d''ordi', 'Vente', '350'),
('03', 'Ordi portable', 'Dépannage', '50'),
('04', 'Ordi portable', 'Dépannage', '50'),
('05', 'Tour d''ordi', 'Vente', '800'),
('07', 'Pb virus', 'Dépannage', '50'),
('08', 'Autre', 'Vente', '500'),
('09', 'Ordi portable', 'Dépannage', '50'),
('10', 'Imprimante', 'Vente', '50'),
('11', 'Ordi portable', 'Dépannage', '50'),
('12', 'Ordi portable', 'Dépannage', '50'),
('13', 'Ordi portable', 'Vente', '500'),
('14', 'Tablette', 'Vente', '250'),
('15', 'Imprimante', 'Vente', '70'),
('16', 'Autre', 'Vente', '490.9');

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
('10', 'Ordi', 'Vente', '52'),
('11', 'Ordi', 'Vente', '52'),
('12', 'Ordi', 'Vente', '52'),
('13', 'Ordi', 'Vente', '52'),
('14', 'Ordi', 'Vente', '52'),
('15', 'Ordi', 'Vente', '52'),
('16', 'Ordi', 'Vente', '52'),
('17', 'Ordi', 'Vente', '52'),
('18', 'Ordi', 'Vente', '52'),
('19', 'Ordi', 'Vente', '52'),
('20', 'Ordi', 'Vente', '52'),
('21', 'Ordi', 'Vente', '52'),
('22', 'Ordi', 'Vente', '52'),
('23', 'Ordi', 'Vente', '52'),
('25', 'Ordi', 'Vente', '52'),
('26', 'Ordi', 'Vente', '52'),
('27', 'Tablette', 'Vente', '350');

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
('10', 'Ordi', 'Vente', '52'),
('11', 'Ordi', 'Vente', '52'),
('12', 'Ordi', 'Vente', '52'),
('13', 'Ordi', 'Vente', '52'),
('14', 'Ordi', 'Vente', '52'),
('15', 'Ordi', 'Vente', '52'),
('16', 'Ordi', 'Vente', '52'),
('17', 'Ordi', 'Vente', '52'),
('18', 'Ordi', 'Vente', '52'),
('19', 'Ordi', 'Vente', '52'),
('20', 'Ordi', 'Vente', '52'),
('21', 'Ordi', 'Vente', '52'),
('22', 'Ordi', 'Vente', '52'),
('23', 'Ordi', 'Vente', '52'),
('25', 'Ordi', 'Vente', '52'),
('26', 'Ordi', 'Vente', '52'),
('27', 'Tablette', 'Vente', '350');

-- --------------------------------------------------------

--
-- Structure de la table `Semaine5`
--

CREATE TABLE IF NOT EXISTS `Semaine5` (
  `id` char(2) NOT NULL,
  `designation` varchar(32) NOT NULL,
  `type` varchar(16) NOT NULL,
  `prix` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Semaine5`
--

INSERT INTO `Semaine5` (`id`, `designation`, `type`, `prix`) VALUES
('03', 'Tablette', 'Dépannage', '87'),
('04', 'Test', 'Vente', '505'),
('10', 'Ordi', 'Vente', '52'),
('11', 'Ordi', 'Vente', '52'),
('13', 'Ordi', 'Vente', '52'),
('15', 'Ordi', 'Vente', '52'),
('16', 'Ordi', 'Vente', '52'),
('17', 'Ordi', 'Vente', '52'),
('18', 'Ordi', 'Vente', '52'),
('19', 'Ordi', 'Vente', '52'),
('20', 'Ordi', 'Vente', '52'),
('21', 'Ordi', 'Vente', '52'),
('22', 'Ordi', 'Vente', '52'),
('23', 'Ordi', 'Vente', '52'),
('24', '5fghfg', 'Dépannage', '54'),
('25', 'Ordi', 'Vente', '52'),
('26', 'Ordi', 'Vente', '52'),
('65', 'Tablette', 'Vente', '12');

-- --------------------------------------------------------

--
-- Structure de la table `Synthese`
--

CREATE TABLE IF NOT EXISTS `Synthese` (
  `id` char(5) NOT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `compte` varchar(8) NOT NULL,
  `cb` varchar(8) NOT NULL,
  `espece` varchar(8) NOT NULL,
  `cheque` varchar(8) NOT NULL,
  `totalFinMois` varchar(8) NOT NULL,
  `totalMoisPlusUn` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Synthese`
--

INSERT INTO `Synthese` (`id`, `date`, `compte`, `cb`, `espece`, `cheque`, `totalFinMois`, `totalMoisPlusUn`) VALUES
('00001', '2017-02-01', '150', '200', '7902.9', '15305.8', '30361.6', '1386');

-- --------------------------------------------------------

--
-- Structure de la table `TotalEnCours`
--

CREATE TABLE IF NOT EXISTS `TotalEnCours` (
  `id` char(2) NOT NULL,
  `total` varchar(32) NOT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `TotalEnCours`
--

INSERT INTO `TotalEnCours` (`id`, `total`, `date`) VALUES
('1', '540.8', '2017-02-03');

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
('1', '1078');

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
('1', '3360.9');

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
('1', '1182');

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
('1', '1182');

-- --------------------------------------------------------

--
-- Structure de la table `TotalSemaine5`
--

CREATE TABLE IF NOT EXISTS `TotalSemaine5` (
  `id` char(2) NOT NULL,
  `total` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `TotalSemaine5`
--

INSERT INTO `TotalSemaine5` (`id`, `total`) VALUES
('1', '1386');

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