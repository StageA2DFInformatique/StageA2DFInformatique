-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 12 Janvier 2017 à 11:24
-- Version du serveur: 5.5.43-0ubuntu0.14.04.1
-- Version de PHP: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

GRANT ALL ON a2df_informatique . * TO 'fbaraud'@'localhost' IDENTIFIED BY 'admin';
--
-- Base de données: `a2df_informatique`
--

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
('0350785N', 'FournisseurTest', '4 rue Aristide Briand', '44330', 'Saint-Malo', '0968547896', 'fournisseur@test.fr', '15');

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
('', 'Admin', 'A2DF', 'admin', '21232f297a57a5a743894a0e4a801fc3', '', '44330', 'Le Pallet', '0000-00-00'),
('a001', 'employe1', 'employe1', 'employe1', '54a51d77ba883e4c77cf681bc70214e5', '', '44330', 'Le Pallet', '0000-00-00'),
('a002', 'employe2', 'employe2', 'employe2', 'db57a2c4455defb2052e690537e2663e', '', '44330', 'Le Pallet', '0000-00-00');

-- --------------------------------------------------------

--
-- Structure de la table `Charges`
--

CREATE TABLE IF NOT EXISTS `Charges` (
  `id` char(8) NOT NULL,
  `nom` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Charges`
--

INSERT INTO `Charges` (`id`, `nom`) VALUES
('0350785A', 'ChargeTest'),
('0350785N', 'ChargeTest'),
('0350785X', 'ChargeTest');


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
