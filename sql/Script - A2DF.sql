-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 10 Février 2017 à 15:22
-- Version du serveur: 5.5.43-0ubuntu0.14.04.1
-- Version de PHP: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `cfleurance_stage`
--

-- --------------------------------------------------------

--
-- Structure de la table `Charges`
--

CREATE TABLE IF NOT EXISTS `Charges` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `numContrat` varchar(16) NOT NULL,
  `numTel` varchar(10) NOT NULL,
  `date` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `Charges`
--

INSERT INTO `Charges` (`id`, `nom`, `description`, `numContrat`, `numTel`, `date`) VALUES
(1, 'JeSuisUneCharge', 'JeSuisUneDescription', '0123456789101112', '0123456788', 'après le 12'),
(2, 'ChargeTest', 'DescriptionTest', '054564145E789SQ4', '0978451576', 'avant le 12'),
(3, 'Ordi asus', 'JeSuisUneDescription', '0123456789101112', '0123456788', 'après le 12');

-- --------------------------------------------------------

--
-- Structure de la table `Fournisseurs`
--

CREATE TABLE IF NOT EXISTS `Fournisseurs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  `adresseRue` varchar(45) NOT NULL,
  `codePostal` char(5) NOT NULL,
  `ville` varchar(35) NOT NULL,
  `tel` varchar(13) NOT NULL,
  `adresseElectronique` varchar(70) DEFAULT NULL,
  `paiement` char(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `Fournisseurs`
--

INSERT INTO `Fournisseurs` (`id`, `nom`, `adresseRue`, `codePostal`, `ville`, `tel`, `adresseElectronique`, `paiement`) VALUES
(1, 'FournisseurTest', '5rue hgfh Briand', '49876', 'st tropez', '0363036306', 'hfjkhdsf@ghfigif.fr', '548'),
(2, 'FournisseurTest', '5rue hgfh Briand', '49876', 'st tropez', '0363036306', 'hfjkhdsf@ghfigif.fr', '548');

-- --------------------------------------------------------

--
-- Structure de la table `Operations`
--

CREATE TABLE IF NOT EXISTS `Operations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `designation` varchar(45) NOT NULL,
  `prix` varchar(8) NOT NULL,
  `type` varchar(10) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46550 ;

--
-- Contenu de la table `Operations`
--

INSERT INTO `Operations` (`id`, `designation`, `prix`, `type`, `date`) VALUES
(1, 'Ordinateur Portable', '500', 'Vente', '2017-02-08'),
(2, 'test', '49.9', 'Dépannage', '2017-02-10'),
(4, 'test', '490', 'Dépannage', '2017-02-09'),
(3546, 'test', '490', 'Vente', '2017-02-10'),
(46546, 'OrdiTest', '500', 'Vente', '2017-02-10'),
(46548, 'fhbv', '54', 'Dépannage', '2017-02-10');

-- --------------------------------------------------------

--
-- Structure de la table `Synthese`
--

CREATE TABLE IF NOT EXISTS `Synthese` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `compte` varchar(8) NOT NULL,
  `cb` varchar(8) NOT NULL,
  `espece` varchar(8) NOT NULL,
  `cheque` varchar(8) NOT NULL,
  `totalFinMois` varchar(8) NOT NULL,
  `totalMoisPlusUn` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `Synthese`
--

INSERT INTO `Synthese` (`id`, `date`, `compte`, `cb`, `espece`, `cheque`, `totalFinMois`, `totalMoisPlusUn`) VALUES
(1, '2017-02-09', '150', '200', '50', '50', '2533.9', '0');

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `id_3` (`id`),
  KEY `id_2` (`id`),
  KEY `id_4` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Visiteur`
--

INSERT INTO `Visiteur` (`id`, `nom`, `prenom`, `login`, `mdp`) VALUES
('1', 'BARAUD', 'François', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
