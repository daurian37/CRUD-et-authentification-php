-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 25 juil. 2023 à 16:47
-- Version du serveur :  5.7.26
-- Version de PHP :  7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `digipart`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `idProduct` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `priceTaxIncl` int(11) DEFAULT NULL,
  `priceTaxExcl` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `image` varchar(256) DEFAULT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `categorie_id` int(11) NOT NULL,
  `auteur_id` int(11) NOT NULL,
  PRIMARY KEY (`idProduct`),
  KEY `categorie_id` (`categorie_id`),
  KEY `auteur_id` (`auteur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`idProduct`, `reference`, `description`, `priceTaxIncl`, `priceTaxExcl`, `quantity`, `image`, `date_creation`, `categorie_id`, `auteur_id`) VALUES
(2, 'Timberland', '<p>Je suis une chaussure</p>', 55, NULL, NULL, 'Timberland.jpg', '2023-07-25 11:06:59', 1, 20),
(3, 'Bracelet', '<p>bracelet</p>', 25, NULL, NULL, 'Bracelet.png', '2023-07-25 13:51:48', 5, 20),
(4, 'chemise', '<p>ceci est une chemise</p>', 30, NULL, NULL, 'chemise.jpg', '2023-07-25 13:56:53', 2, 20),
(5, 'chemise bleu', '<p>ceci est une chemise bleu</p>', 45, NULL, NULL, 'chemise bleu.jpg', '2023-07-25 14:00:40', 2, 20),
(7, 'Pantalon', '<p>Ceci est un pantalon</p>', 56, NULL, NULL, 'Pantalon.jpg', '2023-07-25 14:06:20', 4, 20),
(8, 'Nike', '<p>je suis une chaussure Nike</p>', 100, NULL, NULL, 'Nike.jpg', '2023-07-25 14:20:58', 1, 20);

-- --------------------------------------------------------

--
-- Structure de la table `auteur`
--

DROP TABLE IF EXISTS `auteur`;
CREATE TABLE IF NOT EXISTS `auteur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(80) NOT NULL,
  `nom` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `auteur`
--

INSERT INTO `auteur` (`id`, `prenom`, `nom`, `email`, `password`) VALUES
(20, 'vincia daurian', 'BALENVOKOLO', 'digipart@gmail.com', '$2y$10$rRQGAK5GHXYPlTBGIHOpcOL.IxPrxYz6zfU97UCRSUJqusHHOx0Km');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`) VALUES
(1, 'Chaussure'),
(2, 'Chemise'),
(3, 'Tshirt'),
(4, 'Pantalon'),
(5, 'Autres');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`),
  ADD CONSTRAINT `article_ibfk_2` FOREIGN KEY (`auteur_id`) REFERENCES `auteur` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
