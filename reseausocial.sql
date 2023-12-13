-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mer. 13 déc. 2023 à 13:32
-- Version du serveur : 5.7.39
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `reseausocial`
--

-- --------------------------------------------------------

--
-- Structure de la table `follow`
--

CREATE TABLE `follow` (
  `id` int(11) NOT NULL,
  `id_follower` int(11) NOT NULL,
  `id_following` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `follow`
--

INSERT INTO `follow` (`id`, `id_follower`, `id_following`) VALUES
(156, 6, 4),
(157, 7, 1),
(159, 7, 5),
(160, 7, 3),
(161, 7, 4),
(165, 6, 5),
(196, 6, 7),
(198, 7, 6);

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE `membres` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `photo_profil` text NOT NULL,
  `description` text,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `metier` varchar(255) DEFAULT NULL,
  `ville` varchar(100) DEFAULT NULL,
  `pays` varchar(100) DEFAULT NULL,
  `formation` text,
  `experience` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`id`, `nom`, `prenom`, `pseudo`, `email`, `mot_de_passe`, `admin`, `photo_profil`, `description`, `date_creation`, `metier`, `ville`, `pays`, `formation`, `experience`) VALUES
(1, 'allain', 'Clément', '', 'clemallain363@gmail.com', '$2y$10$7Tf0M.URaIr7y5I.dJmN1ehMS0wsUGHwciXyZm6EBRAAHJvyC7v7K', NULL, '', '', '2023-12-06 11:10:25', NULL, '', '', NULL, NULL),
(3, 'test', 'test', 'ok', 'test@gmail.com', '$2y$10$j5z83If2dw3E13QxfNbCiOY842zVDAIPOF7.pC/kLaTCgBfaLid8.', NULL, '', '', '2023-12-06 11:10:25', NULL, '', '', NULL, NULL),
(4, 'allain', 'dedz', 'da', 'test1@gmail.com', '$2y$10$fJeRprz8GDKpHFf.V.B4jOWMqTRkbZrN644KMOVk7ccZaRJVhVB56', 1, '', '', '2023-12-06 11:10:25', NULL, '', '', NULL, NULL),
(5, 'azerty', 'azerty', 'azerty', 'azerty@gmail.com', '$2y$10$N9BvZz1iaBoJ0aEuIZKw3usUJ3zUP/HpwvqOQ744747YH4YCmebpW', NULL, '5.png', NULL, '2023-12-09 17:25:07', NULL, '', '', NULL, NULL),
(6, 'azer', 'azer', 'azer', 'azer@gmail.com', '$2y$10$tr/Iq93QjGqfijGsNiucnu2K6TOzv3oQYYTTwLVd3iSauSj/9Vu9u', NULL, '6.png', NULL, '2023-12-09 18:29:35', NULL, '', '', NULL, NULL),
(7, 'titouan', 'andre', 'titouandre', 'titou@gmail.com', '$2y$10$Y/GYMz1qR684MApstChpb.ntSPHxSxHDGCW.zyljr2691zRE47AyS', NULL, '7.jpg', NULL, '2023-12-13 10:52:44', NULL, NULL, NULL, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `follow`
--
ALTER TABLE `follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT pour la table `membres`
--
ALTER TABLE `membres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
