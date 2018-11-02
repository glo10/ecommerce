-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 02 nov. 2018 à 00:23
-- Version du serveur :  5.7.21
-- Version de PHP :  5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `commerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `achat`
--

DROP TABLE IF EXISTS `achat`;
CREATE TABLE IF NOT EXISTS `achat` (
  `id_client` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  PRIMARY KEY (`id_client`,`id_produit`),
  KEY `fk_produit` (`id_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `email_admin` varchar(120) NOT NULL,
  `mdp_admin` varchar(60) NOT NULL,
  PRIMARY KEY (`email_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`email_admin`, `mdp_admin`) VALUES
('admin@admin.com', '$2y$10$YVMfOubgVwFoYTm4youDguBlD1kg7rXuFTNKkma9VAQGPFc.pjora');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id_client` int(11) NOT NULL AUTO_INCREMENT,
  `nom_client` varchar(80) NOT NULL,
  `prenom_client` varchar(80) NOT NULL,
  `age_client` int(3) NOT NULL,
  `email_client` varchar(100) NOT NULL,
  `mdp_client` varchar(60) NOT NULL,
  PRIMARY KEY (`id_client`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `nom_client`, `prenom_client`, `age_client`, `email_client`, `mdp_client`) VALUES
(1, 'tshimini', 'glodie', 25, 'glodie.tshimini@gmail.com', '$2y$10$Sgst0m31jpkmXZF8Uo8TMucAw7ZW/6PoLFyKnkZMSuUQ53TE37nEe'),
(2, 'tshimini', 'glodie', 25, 'g@g.fr', '$2y$10$Yr2NtpeGH0pIizxWgyHlpeS4diOmt8rBrDU2JsCq.9swq2IXwsGOq');

-- --------------------------------------------------------

--
-- Structure de la table `gestion`
--

DROP TABLE IF EXISTS `gestion`;
CREATE TABLE IF NOT EXISTS `gestion` (
  `email_admin` varchar(120) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  PRIMARY KEY (`email_admin`,`id_produit`),
  KEY `fk_produit_gestion` (`id_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `gestion`
--

INSERT INTO `gestion` (`email_admin`, `id_produit`, `stock`) VALUES
('admin@admin.com', 12, 8),
('admin@admin.com', 14, 200),
('admin@admin.com', 39, 20),
('admin@admin.com', 40, 20),
('admin@admin.com', 41, 20),
('admin@admin.com', 42, 5),
('admin@admin.com', 43, 20),
('admin@admin.com', 44, 1),
('admin@admin.com', 45, 8);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id_produit` int(11) NOT NULL AUTO_INCREMENT,
  `nom_produit` varchar(120) NOT NULL,
  `description_produit` varchar(500) NOT NULL,
  `prix_produit` decimal(5,2) NOT NULL,
  `photo` varchar(255) NOT NULL DEFAULT '3.jpg',
  PRIMARY KEY (`id_produit`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `nom_produit`, `description_produit`, `prix_produit`, `photo`) VALUES
(1, 'poule', 'mololo', '20.00', '3.jpg'),
(2, 'pouletrrr', 'rg-uuyueeeeeeujjuyiku', '20.00', '2.jpg'),
(3, 'pouletrrr', 'rg-uuyueeeeeeujjuyiku', '15.00', '4.jpg'),
(5, 'pouletrrr', 'rg-uuyueeeeeeujjuyiku', '15.00', '1.jpg'),
(12, 'poulet', 'hello world bobolojjjk,;', '150.00', '6.jpg'),
(14, 'riz', 'long parfumé', '15.00', '9.jpg'),
(39, 'pol', 'hhjhh', '15.00', '5.jpg'),
(40, 'pol', 'non flemme', '15.00', '10.jpg'),
(41, 'pol', 'hhjhh toti', '15.00', '7.jpg'),
(42, 'chr', 'kkllk', '5.00', '8.jpg'),
(43, 'pol', 'hhjhh,;;,', '15.00', '3.jpg'),
(44, 'hello', 'fkfkfk', '25.00', '3.jpg'),
(45, 'poulet', 'hello world bobolojjj', '150.00', '3.jpg');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `achat`
--
ALTER TABLE `achat`
  ADD CONSTRAINT `fk_client` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`),
  ADD CONSTRAINT `fk_produit` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`);

--
-- Contraintes pour la table `gestion`
--
ALTER TABLE `gestion`
  ADD CONSTRAINT `fk_admin_gestion` FOREIGN KEY (`email_admin`) REFERENCES `admin` (`email_admin`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_produit_gestion` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
