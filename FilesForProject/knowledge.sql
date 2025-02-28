-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 28 fév. 2025 à 15:26
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `knowledge`
--

-- --------------------------------------------------------

--
-- Structure de la table `cursus`
--

DROP TABLE IF EXISTS `cursus`;
CREATE TABLE IF NOT EXISTS `cursus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `formation_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_255A0C35200282E` (`formation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cursus`
--

INSERT INTO `cursus` (`id`, `formation_id`, `created_at`, `updated_at`, `title`, `type`, `image`, `price`) VALUES
(1, 1, '2025-02-28 14:58:18', NULL, 'Cursus d\'initiation à la guitare', 'Musique', 'Musique.png', '50'),
(2, 1, '2025-02-28 15:00:10', NULL, 'Cursus d\'initiation au piano', 'Musique', 'Musique.png', '50'),
(3, 2, '2025-02-28 15:00:48', NULL, 'Cursus d\'initiation au développement web', 'Technology', 'informatique.png', '60'),
(4, 3, '2025-02-28 15:01:34', NULL, 'Cursus d\'initiation au jardinage', 'Gardening', 'jardinage.png', '30'),
(5, 4, '2025-02-28 15:02:05', NULL, 'Cursus d\'initiation à la cuisine', 'Kitchen', 'Cuisinier.png', '44'),
(6, 4, '2025-02-28 15:02:38', NULL, 'Cursus d\'initiation au dréssage culinaire', 'Kitchen', 'Cuisinier.png', '48');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20250224183848', '2025-02-24 19:40:13', 79),
('DoctrineMigrations\\Version20250224185813', '2025-02-24 19:58:19', 13),
('DoctrineMigrations\\Version20250224190143', '2025-02-24 20:01:48', 38),
('DoctrineMigrations\\Version20250224190636', '2025-02-24 20:06:39', 11),
('DoctrineMigrations\\Version20250224192427', '2025-02-24 20:24:34', 27),
('DoctrineMigrations\\Version20250224192553', '2025-02-24 20:25:56', 12),
('DoctrineMigrations\\Version20250224193919', '2025-02-24 20:39:24', 46),
('DoctrineMigrations\\Version20250224194832', '2025-02-24 20:49:00', 20),
('DoctrineMigrations\\Version20250224195031', '2025-02-24 20:50:36', 12),
('DoctrineMigrations\\Version20250224195345', '2025-02-24 20:53:54', 14),
('DoctrineMigrations\\Version20250224205923', '2025-02-24 21:59:41', 103),
('DoctrineMigrations\\Version20250224213310', '2025-02-24 22:33:13', 12),
('DoctrineMigrations\\Version20250224220045', '2025-02-24 23:00:50', 11),
('DoctrineMigrations\\Version20250224220306', '2025-02-24 23:03:09', 16),
('DoctrineMigrations\\Version20250225194228', '2025-02-25 20:42:45', 35),
('DoctrineMigrations\\Version20250225200511', '2025-02-26 14:51:12', 60),
('DoctrineMigrations\\Version20250226135818', '2025-02-26 14:58:33', 10),
('DoctrineMigrations\\Version20250226163236', '2025-02-26 17:33:19', 256),
('DoctrineMigrations\\Version20250227130719', '2025-02-27 14:07:23', 209),
('DoctrineMigrations\\Version20250227131100', '2025-02-27 14:11:05', 12),
('DoctrineMigrations\\Version20250227131453', '2025-02-27 14:14:56', 14),
('DoctrineMigrations\\Version20250228113911', '2025-02-28 12:41:01', 93),
('DoctrineMigrations\\Version20250228114945', '2025-02-28 12:49:48', 9),
('DoctrineMigrations\\Version20250228144917', '2025-02-28 15:49:24', 117);

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

DROP TABLE IF EXISTS `formation`;
CREATE TABLE IF NOT EXISTS `formation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`id`, `title`, `desc`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Musique', 'Cursus d’initiation à la guitare 50 €\r\nLeçon n°1 : Découverte de l’instrument 26 €\r\nLeçon n°2 : Les accords et les gammes 26 €\r\nCursus d’initiation au piano 50 €\r\nLeçon n°1 : Découverte de l’instrument 26 €\r\nLeçon n°2 : Les accords et les gammes 26 €', 'musique.png', '2025-02-27 14:11:58', '2025-02-27 14:12:16'),
(2, 'Informatique', 'Cursus d’initiation au développement web 60 €\r\nLeçon n°1 : Les langages Html et CSS 32 €\r\nLeçon n°2 : Dynamiser votre site avec Javascript 32 €', 'informatique.png', '2025-02-27 14:12:08', '2025-02-27 14:12:20'),
(3, 'Jardinage', 'Cursus d’initiation au jardinage 30 €\r\nLeçon n°1 : Les outils du jardinier 16 €\r\nLeçon n°2 : Jardiner avec la lune 16 €', 'jardinage.png', '2025-02-27 14:12:06', '2025-02-27 14:12:22'),
(4, 'Cuisine', 'Cursus d’initiation à la cuisine 44 €\r\nLeçon n°1 : Les modes de cuisson 23 €\r\nLeçon n°2 : Les saveurs 23 €\r\nCursus d’initiation à l’art du dressage culinaire 48 €\r\nLeçon n°1 : Mettre en œuvre le style dans l’assiette 26 €\r\nLeçon n°2 : Harmoniser un repas ', 'cuisinier.png', '2025-02-27 14:12:11', '2025-02-27 14:12:24');

-- --------------------------------------------------------

--
-- Structure de la table `initiation`
--

DROP TABLE IF EXISTS `initiation`;
CREATE TABLE IF NOT EXISTS `initiation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `initiation`
--

INSERT INTO `initiation` (`id`, `title`, `type`, `price`) VALUES
(1, 'Cursus d’initiation à la guitare', 'Music', '50'),
(2, 'Cursus d’initiation au piano', 'Music', '50'),
(3, 'Cursus d’initiation au jardinage', 'Gardening', '30'),
(4, 'Cursus d’initiation au développement web', 'Technology', '60'),
(5, 'Cursus d’initiation à la cuisine', 'Kitchen', '44'),
(6, 'Cursus d’initiation à l’art du dressage culinaire', 'Kitchen', '48');

-- --------------------------------------------------------

--
-- Structure de la table `lesson`
--

DROP TABLE IF EXISTS `lesson`;
CREATE TABLE IF NOT EXISTS `lesson` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `formation_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F87474F35200282E` (`formation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `lesson`
--

INSERT INTO `lesson` (`id`, `title`, `type`, `price`, `image`, `formation_id`, `created_at`, `updated_at`) VALUES
(1, 'Leçon n°1 : Découverte de l’instrument ', 'guitar', '26', 'musique.png', 1, '2025-02-27 14:18:17', '2025-02-27 14:18:35'),
(2, 'Leçon n°2 : Les accords et les gammes', 'guitar', '26', 'musique.png', 1, '2025-02-27 14:18:20', '2025-02-27 14:18:37'),
(3, 'Leçon n°1 : Découverte de l’instrument ', 'piano', '26', 'musique.png', 1, '2025-02-27 14:18:21', '2025-02-27 14:18:41'),
(4, 'Leçon n°2 : Les accords et les gammes ', 'piano', '26', 'musique.png', 1, '2025-02-27 14:18:23', NULL),
(5, 'Leçon n°1 : Les langages Html et CSS', 'technology', '32', 'informatique.png', 2, '2025-02-27 14:18:25', NULL),
(6, 'Leçon n°2 : Dynamiser votre site avec Javascript', 'technology', '32', 'informatique.png', 2, '2025-02-27 14:18:27', '2025-02-27 14:18:43'),
(7, 'Leçon n°1 : Les outils du jardinier ', 'gardening', '16', 'jardinage.png', 3, '2025-02-27 14:18:28', NULL),
(8, 'Leçon n°2 : Jardiner avec la lune', 'gardening', '16', 'jardinage.png', 3, '2025-02-27 14:18:29', NULL),
(9, 'Leçon n°1 : Les modes de cuisson ', 'kitchen', '23', 'cuisinier.png', 4, '2025-02-27 14:18:30', '2025-02-27 14:18:44'),
(10, 'Leçon n°2 : Les saveurs', 'kitchen', '23', 'cuisinier.png', 4, '2025-02-27 14:18:31', '2025-02-27 14:18:46'),
(11, 'Leçon n°1 : Mettre en oeuvre le style de l’assiette', 'kitchen', '26', 'cuisinier.png', 4, '2025-02-27 14:18:32', '2025-02-27 14:18:45'),
(12, 'Leçon n°2 : Harmoser un repas à quatres plats', 'kitchen', '26', 'cuisinier.png', 4, '2025-02-27 14:18:34', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `id` int NOT NULL AUTO_INCREMENT,
  `purchase_date` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchaser` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `article` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `username`, `is_verified`, `created_at`, `updated_at`) VALUES
(4, 'student@dev.com', '[\"ROLE_STUDENT\", \"ROLE_INFORMATIQUE\", \"ROLE_VERIFIED\"]', '$2y$13$at.npGri9BXV6znDxC4lFefyq/G4gC1gk/BoU0UHR.0fVjb.M1Kim', 'STUDENT', 1, '2025-02-24 14:17:13', '2025-02-27 14:18:00'),
(5, 'admin@dev.com', '[\"ROLE_ADMIN\", \"ROLE_VERIFIED\", \"ROLE_FINISHEDLESSON\", \"ROLE_CUISINIER\"]', '$2y$13$LfXOwYO.e9f0qOAqt0d52eNJPhLitwFk1sj.K/GEaNI4j0TsP8iOG', 'ADMIN', 1, '2025-02-24 14:17:19', '2025-02-27 14:17:56'),
(6, 'user@dev.com', '[]', '$2y$13$MFCGP1GsxVJQ6uCOt1HcUuAWfEHbvPwnXVcmrKxkrPuA9a21MUovi', 'User', 0, '2025-02-24 14:17:23', '2025-02-27 14:17:51'),
(23, 'yoannlecavelier18@gmail.com', '[\"ROLE_USER\", \"ROLE_VERIFIED\"]', '$2y$13$vDGKWEgTUQrIIqaCUU7LT.BOKvsL7EmJ9KdHV5cUS6iIlC7flQXha', 'Yoann', 1, '2025-02-28 10:06:28', NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cursus`
--
ALTER TABLE `cursus`
  ADD CONSTRAINT `FK_255A0C35200282E` FOREIGN KEY (`formation_id`) REFERENCES `formation` (`id`);

--
-- Contraintes pour la table `lesson`
--
ALTER TABLE `lesson`
  ADD CONSTRAINT `FK_F87474F35200282E` FOREIGN KEY (`formation_id`) REFERENCES `formation` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
