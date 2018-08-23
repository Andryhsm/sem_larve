-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Jeu 23 Août 2018 à 21:58
-- Version du serveur :  5.5.42
-- Version de PHP :  7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ouinflib`
--

-- --------------------------------------------------------

--
-- Structure de la table `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE `location` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(255) NOT NULL,
  `location_code` varchar(255) NOT NULL,
  `criteron_id` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `location`
--

INSERT INTO `location` (`location_id`, `location_name`, `location_code`, `criteron_id`) VALUES
(1, 'location_name', 'location_code', 'criteron_id'),
(2, 'Arabic', 'ar', '1019'),
(3, 'Bengali', 'bn', '1056'),
(4, 'Bulgarian', 'bg', '1020'),
(5, 'Catalan', 'ca', '1038'),
(6, 'Chinese (simplified)', 'zh_CN', '1017'),
(7, 'Chinese (traditional)', 'zh_TW', '1018'),
(8, 'Croatian', 'hr', '1039'),
(9, 'Czech', 'cs', '1021'),
(10, 'Danish', 'da', '1009'),
(11, 'Dutch', 'nl', '1010'),
(12, 'English', 'en', '1000'),
(13, 'Estonian', 'et', '1043'),
(14, 'Filipino', 'tl', '1042'),
(15, 'Finnish', 'fi', '1011'),
(16, 'French', 'fr', '1002'),
(17, 'German', 'de', '1001'),
(18, 'Greek', 'el', '1022'),
(19, 'Hebrew', 'iw', '1027'),
(20, 'Hindi', 'hi', '1023'),
(21, 'Hungarian', 'hu', '1024'),
(22, 'Icelandic', 'is', '1026'),
(23, 'Indonesian', 'id', '1025'),
(24, 'Italian', 'it', '1004'),
(25, 'Japanese', 'ja', '1005'),
(26, 'Korean', 'ko', '1012'),
(27, 'Latvian', 'lv', '1028'),
(28, 'Lithuanian', 'lt', '1029'),
(29, 'Malay', 'ms', '1102'),
(30, 'Norwegian', 'no', '1013'),
(31, 'Persian', 'fa', '1064'),
(32, 'Polish', 'pl', '1030'),
(33, 'Portuguese', 'pt', '1014'),
(34, 'Romanian', 'ro', '1032'),
(35, 'Russian', 'ru', '1031'),
(36, 'Serbian', 'sr', '1035'),
(37, 'Slovak', 'sk', '1033'),
(38, 'Slovenian', 'sl', '1034'),
(39, 'Spanish', 'es', '1003'),
(40, 'Swedish', 'sv', '1015'),
(41, 'Tamil', 'ta', '1130'),
(42, 'Telugu', 'te', '1131'),
(43, 'Thai', 'th', '1044'),
(44, 'Turkish', 'tr', '1037'),
(45, 'Ukrainian', 'uk', '1036'),
(46, 'Urdu', 'ur', '1041'),
(47, 'Vietnamese', 'vi', '1040');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
