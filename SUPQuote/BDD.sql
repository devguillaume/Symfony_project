-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 14 Juin 2015 à 19:10
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `supquote`
--

-- --------------------------------------------------------

--
-- Structure de la table `fos_user`
--

CREATE TABLE IF NOT EXISTS `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`) VALUES
(1, 'Oriol', 'oriol', 'oriol.guihtguhtyuors@gmail.com', 'oriol.guihtguhtyuors@gmail.com', 1, 'k9swb4jyxlsgockkog0c8k8sogco8co', 'ON/PQkWSVb8qWmQnLDz2yS/8EuBGs/U5Z8yTEtO37iHS4O+/pwGlaM9jOGI5wnLp2i6hu+cfjDr0tvlrho1uaQ==', '2015-06-14 15:49:39', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', 0, NULL),
(2, 'guigui', 'guigui', 'igt@gmail.com', 'igt@gmail.com', 1, 'k7mg9zjynhssggg48ssk8gks4ggoows', '5pE7lZ4IwJ2srj9dS5IZSRm4T0PhD+75qXEXcNHrdNFPJnngBbCiFNj6Hgi5Bw6b3BWMftNEOeeN046fFv4xlQ==', '2015-06-14 15:43:05', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `quote`
--

CREATE TABLE IF NOT EXISTS `quote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `createAt` datetime NOT NULL,
  `published` tinyint(1) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6B71CBF4A76ED395` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Contenu de la table `quote`
--

INSERT INTO `quote` (`id`, `content`, `createAt`, `published`, `user_id`) VALUES
(2, 'LOL', '2015-06-08 00:00:00', 1, 1),
(3, 'New article : \r\n\r\nTest pour le a href des articles dans une autre page \r\nVenez voir mon article pour avoir plus d''informations ! \r\n\r\n', '0000-00-00 00:00:00', 1, 1),
(8, 'Ceci est un test Numero2', '2015-06-14 15:50:03', 0, 1),
(9, 'Dernier test avant enfin du projet!', '2015-06-14 18:34:16', 0, 1);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `quote`
--
ALTER TABLE `quote`
  ADD CONSTRAINT `FK_6B71CBF4A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
