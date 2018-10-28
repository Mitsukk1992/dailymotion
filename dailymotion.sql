-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 28 oct. 2018 à 20:53
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dailymotion`
--

-- --------------------------------------------------------

--
-- Structure de la table `playlists`
--

DROP TABLE IF EXISTS `playlists`;
CREATE TABLE IF NOT EXISTS `playlists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `created` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `playlists`
--

INSERT INTO `playlists` (`id`, `name`, `created`) VALUES
(1, 'Décryptages', '2018-10-16'),
(2, 'Fashion Week Paris', '2018-10-03'),
(3, 'Paddington', '2018-10-22');

-- --------------------------------------------------------

--
-- Structure de la table `relations`
--

DROP TABLE IF EXISTS `relations`;
CREATE TABLE IF NOT EXISTS `relations` (
  `id_playlist` int(11) NOT NULL,
  `id_video` int(11) NOT NULL,
  KEY `id_playlist` (`id_playlist`),
  KEY `id_video` (`id_video`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `relations`
--

INSERT INTO `relations` (`id_playlist`, `id_video`) VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 4);

-- --------------------------------------------------------

--
-- Structure de la table `videos`
--

DROP TABLE IF EXISTS `videos`;
CREATE TABLE IF NOT EXISTS `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `thumbnail` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `posted` date NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `videos`
--

INSERT INTO `videos` (`id`, `name`, `thumbnail`, `description`, `posted`, `pseudo`) VALUES
(1, 'Vidéo 01', 'Lien 01', 'Description 01', '2018-10-31', 'Pseudo 01'),
(2, 'Vidéo 02', 'Lien 02', 'Description 02', '2018-10-24', 'Pseudo 02'),
(3, 'Red Dead Redemption 2 - Bande-annonce de lancement', 'https://www.dailymotion.com/video/x6voudz', 'Un bon jeu auquel je ne peux pas encore jouer car j\'effectue ce test.', '2018-10-15', 'Gamekult'),
(4, 'Les chansons pour enfants décryptées ! (feat. SWANN PERISSE) - Parlons peu Mais parlons', 'https://www.dailymotion.com/video/x6v7fv1', 'Pour fêter les 3 ans de la chaîne on voulait faire une super fête ! A la place on a chanté des chansons dégueulasses.', '2018-10-10', 'Parlons Peu Mais Parlons');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `relations`
--
ALTER TABLE `relations`
  ADD CONSTRAINT `relations_ibfk_1` FOREIGN KEY (`id_playlist`) REFERENCES `playlists` (`id`),
  ADD CONSTRAINT `relations_ibfk_2` FOREIGN KEY (`id_video`) REFERENCES `videos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
