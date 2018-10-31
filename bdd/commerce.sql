-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 31 oct. 2018 à 16:40
-- Version du serveur :  10.1.36-MariaDB
-- Version de PHP :  7.2.11

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

CREATE TABLE `achat` (
  `id_client` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `email_admin` varchar(120) NOT NULL,
  `mdp_admin` varchar(60) NOT NULL
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

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `nom_client` varchar(80) NOT NULL,
  `prenom_client` varchar(80) NOT NULL,
  `age_client` int(3) NOT NULL,
  `email_client` varchar(100) NOT NULL,
  `mdp_client` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `gestion`
--

CREATE TABLE `gestion` (
  `email_admin` varchar(120) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `gestion`
--

INSERT INTO `gestion` (`email_admin`, `id_produit`, `stock`) VALUES
('admin@admin.com', 12, 15),
('admin@admin.com', 14, 200),
('admin@admin.com', 15, 10),
('admin@admin.com', 35, 140);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id_produit` int(11) NOT NULL,
  `nom_produit` varchar(120) NOT NULL,
  `description_produit` varchar(500) NOT NULL,
  `prix_produit` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `nom_produit`, `description_produit`, `prix_produit`) VALUES
(1, 'poulet', 'rg-uuyuujjuyiku', '20.00'),
(2, 'pouletrrr', 'rg-uuyueeeeeeujjuyiku', '20.00'),
(3, 'pouletrrr', 'rg-uuyueeeeeeujjuyiku', '15.00'),
(5, 'pouletrrr', 'rg-uuyueeeeeeujjuyiku', '15.00'),
(12, 'ggg', 'ggghhhhh', '15.00'),
(14, 'dd', 'sdkdjjkd', '15.00'),
(15, 'testtest', 'hello world', '25.00'),
(35, 'champion', 'hello world', '50.00');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `achat`
--
ALTER TABLE `achat`
  ADD PRIMARY KEY (`id_client`,`id_produit`),
  ADD KEY `fk_produit` (`id_produit`);

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`email_admin`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Index pour la table `gestion`
--
ALTER TABLE `gestion`
  ADD PRIMARY KEY (`email_admin`,`id_produit`),
  ADD KEY `fk_produit_gestion` (`id_produit`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

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
