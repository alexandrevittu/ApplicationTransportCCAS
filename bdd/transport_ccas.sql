-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 15 jan. 2018 à 10:11
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `transport_ccas`
--

-- --------------------------------------------------------

--
-- Structure de la table `adherents`
--

DROP TABLE IF EXISTS `adherents`;
CREATE TABLE IF NOT EXISTS `adherents` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `dateAdhesion` date NOT NULL,
  `remarque` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1 COMMENT='en construction';

--
-- Déchargement des données de la table `adherents`
--

INSERT INTO `adherents` (`id`, `nom`, `prenom`, `adresse`, `dateAdhesion`, `remarque`) VALUES
(1, 'vittu', 'alexandre', 'rue tactac', '2018-01-11', 'ee'),
(3, 'gungor', 'salihfdsf', 'tourcoing', '2018-01-03', 'gentil homme'),
(4, 'testest', 'aaa', 'aaa', '2018-01-03', 'aaa'),
(11, 'ezgnzei', 'gg', 'ggj', '2018-01-11', 'gg'),
(12, 'test', 'test', 'testtrajetcourt', '2018-01-02', ''),
(18, 'testajouttrajet', 'etet', 'tete', '2018-01-01', ''),
(19, 'testfacturation', 'final', 'aaaa', '2018-01-02', ''),
(21, 'cdsxvsd', 'vsvds', 'vdvd', '2018-01-01', ''),
(22, 'fff', 'ff', 'fff', '2017-04-05', ''),
(23, 'vittu', 'alexandre', 'aaaa', '2018-01-09', '');

-- --------------------------------------------------------

--
-- Structure de la table `tarifs`
--

DROP TABLE IF EXISTS `tarifs`;
CREATE TABLE IF NOT EXISTS `tarifs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nbTrajet` int(50) NOT NULL,
  `idAdherent` int(100) NOT NULL,
  `idTypetrajet` int(11) NOT NULL,
  `idTrimestre` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idAdherent` (`idAdherent`),
  KEY `idTypetrajet` (`idTypetrajet`) USING BTREE,
  KEY `idTrimestre` (`idTrimestre`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tarifs`
--

INSERT INTO `tarifs` (`id`, `nbTrajet`, `idAdherent`, `idTypetrajet`, `idTrimestre`) VALUES
(3, 4, 1, 4, 1),
(4, 5, 3, 2, 1),
(7, 6, 1, 2, 1),
(8, 8, 4, 2, 1),
(10, 2, 11, 2, 1),
(11, 0, 12, 2, 1),
(12, 0, 18, 2, 1),
(13, 0, 18, 3, 1),
(14, 0, 18, 4, 1),
(15, 2, 1, 3, 1),
(16, 2, 3, 3, 1),
(17, 4, 4, 3, 1),
(19, 10, 11, 3, 1),
(20, 6, 12, 3, 1),
(21, 0, 3, 4, 1),
(22, 3, 4, 4, 1),
(24, 8, 11, 4, 1),
(25, 22, 12, 4, 1),
(26, 1, 3, 5, 3),
(27, 1, 4, 5, 3),
(29, 1, 11, 5, 3),
(30, 1, 12, 5, 3),
(31, 1, 18, 5, 1),
(32, 0, 1, 5, 3),
(33, 0, 19, 2, 1),
(34, 0, 19, 3, 1),
(35, 0, 19, 4, 1),
(36, 1, 19, 5, 1),
(53, 0, 21, 2, 1),
(54, 0, 21, 3, 1),
(55, 0, 21, 4, 1),
(56, 1, 21, 5, 1),
(57, 0, 22, 2, 1),
(58, 0, 22, 3, 1),
(59, 0, 22, 4, 1),
(60, 1, 22, 5, 1),
(61, 0, 1, 2, 1),
(62, 0, 1, 3, 1),
(63, 0, 1, 4, 1),
(64, 1, 1, 5, 1);

-- --------------------------------------------------------

--
-- Structure de la table `trimestre`
--

DROP TABLE IF EXISTS `trimestre`;
CREATE TABLE IF NOT EXISTS `trimestre` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `trimestre`
--

INSERT INTO `trimestre` (`id`, `libelle`) VALUES
(1, 'Janvier/Février/Mars'),
(2, 'Avril/Mai/Juin'),
(3, 'Juillet/Aout/Septembre'),
(4, 'Octobre/Novembre/Décembre');

-- --------------------------------------------------------

--
-- Structure de la table `typetrajet`
--

DROP TABLE IF EXISTS `typetrajet`;
CREATE TABLE IF NOT EXISTS `typetrajet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL,
  `prix` decimal(11,1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `typetrajet`
--

INSERT INTO `typetrajet` (`id`, `libelle`, `prix`) VALUES
(1, 'seuil report', '3.0'),
(2, 'court', '3.5'),
(3, 'moyen', '2.8'),
(4, 'long', '5.0'),
(5, 'adhésion', '14.5');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `tarifs`
--
ALTER TABLE `tarifs`
  ADD CONSTRAINT `tarifs_ibfk_1` FOREIGN KEY (`idAdherent`) REFERENCES `adherents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tarifs_ibfk_2` FOREIGN KEY (`idTypetrajet`) REFERENCES `typetrajet` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tarifs_ibfk_3` FOREIGN KEY (`idTrimestre`) REFERENCES `trimestre` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
