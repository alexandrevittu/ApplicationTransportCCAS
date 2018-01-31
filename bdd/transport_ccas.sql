-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 31 jan. 2018 à 07:42
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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1 COMMENT='en construction';

--
-- Déchargement des données de la table `adherents`
--

INSERT INTO `adherents` (`id`, `nom`, `prenom`, `adresse`, `dateAdhesion`, `remarque`) VALUES
(25, 'testtableutrimestre', 'test', 'aaaa', '2017-01-11', ''),
(27, 'Vittu', 'Alexandre', 'wasquehal', '2017-04-15', ''),
(28, 'Gungor', 'saleeh', 'tourcoing', '2017-04-12', 'gentil homme'),
(30, 'vittu', 'aaa', 'aze', '2018-01-15', '');

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
  `dateDernierTrajet` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idAdherent` (`idAdherent`),
  KEY `idTypetrajet` (`idTypetrajet`) USING BTREE,
  KEY `idTrimestre` (`idTrimestre`)
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tarifs`
--

INSERT INTO `tarifs` (`id`, `nbTrajet`, `idAdherent`, `idTypetrajet`, `idTrimestre`, `dateDernierTrajet`) VALUES
(69, 0, 25, 2, 1, NULL),
(70, 0, 25, 3, 1, NULL),
(71, 0, 25, 4, 1, NULL),
(72, 0, 25, 2, 2, NULL),
(73, 0, 25, 3, 2, NULL),
(74, 0, 25, 4, 2, NULL),
(75, 0, 25, 2, 3, NULL),
(76, 0, 25, 3, 3, NULL),
(77, 0, 25, 4, 3, NULL),
(78, 0, 25, 2, 4, NULL),
(79, 0, 25, 3, 4, NULL),
(80, 0, 25, 4, 4, NULL),
(81, 1, 25, 5, 1, '2018-01-23'),
(95, 24, 27, 2, 1, '2018-01-23'),
(96, 5, 27, 3, 1, '2018-01-23'),
(97, 4, 27, 4, 1, '2018-01-23'),
(98, 0, 27, 2, 2, NULL),
(99, 0, 27, 3, 2, NULL),
(100, 0, 27, 4, 2, NULL),
(101, 0, 27, 2, 3, NULL),
(102, 0, 27, 3, 3, NULL),
(103, 0, 27, 4, 3, NULL),
(104, 0, 27, 2, 4, NULL),
(105, 0, 27, 3, 4, NULL),
(106, 0, 27, 4, 4, NULL),
(107, 1, 27, 5, 1, '2018-01-23'),
(108, 6, 28, 2, 1, '2018-01-30'),
(109, 10, 28, 3, 1, '2018-01-30'),
(110, 12, 28, 4, 1, '2018-01-30'),
(111, 13, 28, 2, 2, '2018-01-25'),
(112, 5, 28, 3, 2, '2018-01-25'),
(113, 9, 28, 4, 2, '2018-01-25'),
(114, 0, 28, 2, 3, NULL),
(115, 0, 28, 3, 3, NULL),
(116, 0, 28, 4, 3, NULL),
(117, 0, 28, 2, 4, NULL),
(118, 0, 28, 3, 4, NULL),
(119, 0, 28, 4, 4, NULL),
(120, 1, 28, 5, 1, '2018-01-23'),
(134, 0, 30, 2, 1, NULL),
(135, 0, 30, 3, 1, NULL),
(136, 0, 30, 4, 1, NULL),
(137, 0, 30, 2, 2, NULL),
(138, 0, 30, 3, 2, NULL),
(139, 0, 30, 4, 2, NULL),
(140, 0, 30, 2, 3, NULL),
(141, 0, 30, 3, 3, NULL),
(142, 0, 30, 4, 3, NULL),
(143, 0, 30, 2, 4, NULL),
(144, 0, 30, 3, 4, NULL),
(145, 0, 30, 4, 4, NULL),
(146, 1, 30, 5, 1, '2018-01-23');

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
(1, 'seuil report', '15.0'),
(2, 'court', '3.5'),
(3, 'moyen', '5.0'),
(4, 'long', '8.0'),
(5, 'adhésion', '12.0');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Pseudo` varchar(255) NOT NULL,
  `Mdp` varchar(255) NOT NULL,
  `Mail` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Pseudo` (`Pseudo`),
  UNIQUE KEY `Mail` (`Mail`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `Pseudo`, `Mdp`, `Mail`) VALUES
(14, 'd', '18ac3e7343f016890c510e93f935261169d9e3f565436429830faf0934f4f8e4', 'd'),
(11, 'a', 'ca978112ca1bbdcafac231b39a23dc4da786eff8147c4e72b9807785afee48bb', 'a'),
(13, 'c', '2e7d2c03a9507ae265ecf5b5356885a53393a2029d241394997265a1a25aefc6', 'c'),
(12, 'b', '3e23e8160039594a33894f6564e1b1348bbd7a0088d42c4acb73eeaed59c009d', 'b'),
(1, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'aaaaaaa'),
(20, 'alex', '4135aa9dc1b842a653dea846903ddb95bfb8c5a10c504a7fa16e10bc31d1fdf0', 'alex');

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
