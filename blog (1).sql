-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 01 juil. 2022 à 10:48
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `categorie` varchar(50) NOT NULL,
  `description` varchar(120) NOT NULL,
  `image` varchar(500) NOT NULL,
  `users` varchar(50) NOT NULL,
  `dateCreation` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `titre`, `categorie`, `description`, `image`, `users`, `dateCreation`) VALUES
(4, 'Baston', 'test', 'Chacun pour soi', './uploadimg/burma-gc4d02aec5_1280.jpg', '0', '2022-06-29 08:57:24'),
(6, 'cat', 'cat', 'cat', './uploadimg/cat-gc42ba49a1_1280.jpg', '0', '2022-06-29 08:59:55'),
(10, 'tacos', 'bouffe', 'a table', './uploadimg/image4-tacos-de-grenoble.png', '0', '2022-06-29 09:39:42'),
(12, 'Montréal', 'Ville', 'Ville de Montréal', './uploadimg/fb-montreal-cdc.1601168.jpg', '0', '2022-06-30 11:12:58'),
(13, 'Cerf', 'animal', 'test', './uploadimg/deer-gd77339cb7_1280.jpg', '0', '2022-06-30 14:01:31'),
(16, 'test', 'test', 'test', './uploadimg/famous-buildings-round-the-world-travel-wallpaper.jpg', 'Test', '2022-07-01 09:27:49'),
(17, 'SSJ Goruto', 'Humain', 'test', './uploadimg/téléchargementnar.jpeg', 'Lol', '2022-07-01 09:29:19'),
(19, 'Bar', 'Alcool', 'SOS Village', './uploadimg/sos-villages-un-bar-tabac-pmu-a-moreac-cherche-un-repreneur-20190322-1530-2cb341-0@1x.jpeg', 'robert baratheton', '2022-07-01 09:59:08');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `passeword` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `passeword`, `email`) VALUES
(26, 'Captcha', '$argon2i$v=19$m=65536,t=4,p=1$aWxvWTZwckRidWlIbXFJdA$nueY8Bo3KXzF8IpHBG/UDoHVjY94BcMDPVb0uFioVAs', 'email@email.com'),
(30, 'Test', '$argon2i$v=19$m=65536,t=4,p=1$Ym5GZVRseDZKcHFLZFAwYg$OVtBZkwGHbUln/XIkj4I208nnMBsjOe/RLUNAhpvMaI', 'test@test.fr'),
(32, 'Lol', '$argon2i$v=19$m=65536,t=4,p=1$NzBLa2o4SE1ocXlWd3B0bg$m5QWRlYEYdOHBXnmyguGPYM9hkjAXF40kfhmTRSDwFU', 'lol@lol.fr'),
(36, 'robert baratheton', '$argon2i$v=19$m=65536,t=4,p=1$eVpNYzRMUUFsMkZ5c1RISw$aB1mSqygz+6hqv0mV0t+OvfIUs4TBc0MSh0PKn/MGLI', 'toto@toto.fr');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
