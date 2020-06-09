-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 09 juin 2020 à 01:05
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
-- Base de données :  `giv`
--

-- --------------------------------------------------------

--
-- Structure de la table `giv_alerte`
--

DROP TABLE IF EXISTS `giv_alerte`;
CREATE TABLE IF NOT EXISTS `giv_alerte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `accident` varchar(3) NOT NULL,
  `probleme_technique` varchar(3) NOT NULL,
  `changer_piece` varchar(3) NOT NULL,
  `contact_technicien` varchar(3) NOT NULL,
  `contact_superieur` varchar(3) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `fait` varchar(3) NOT NULL DEFAULT 'off',
  `id_vehicule` int(11) DEFAULT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `giv_alerte`
--

INSERT INTO `giv_alerte` (`id`, `name`, `date`, `accident`, `probleme_technique`, `changer_piece`, `contact_technicien`, `contact_superieur`, `description`, `fait`, `id_vehicule`, `id_utilisateur`) VALUES
(1, 'La mettre en route', '2019-06-16', 'on', 'on', 'on', 'on', 'on', 'La voiture de Sophie n\'a pas tournÃ© depuis un moment.\r\nVeuillez la faire tourner', 'off', 1, 1),
(2, 'Controle technique', '2019-06-01', 'on', 'off', 'off', 'on', 'on', 'Doit passer au contrÃ´le technique le mois prochain', 'on', 1, 1),
(3, '@', '2019-06-16', 'on', 'off', 'off', 'on', 'on', '@', 'off', 2, 1),
(4, 'ContrÃ´le Technique EffectuÃ©', '2019-07-15', 'off', 'off', 'off', 'on', 'on', 'Le ContrÃ´le effectuÃ© a 106 600 km', 'on', 1, 1),
(5, 'Courroie de distribution changÃ©', '2019-07-10', 'off', 'off', 'off', 'on', 'on', 'Courroie de distribution changÃ© Ã  106 600 km', 'on', 1, 1),
(6, 'Elle dÃ©conne', '2019-08-05', 'off', 'off', 'off', 'on', 'on', 'Sophie tu dÃ©connes :)', 'off', 1, 17),
(7, 'Clio de Sophie', '2019-09-13', 'on', 'on', 'on', 'on', 'on', 'Blabla ', 'off', 2, 1),
(8, 'Grande Punto de Mathias', '2019-09-13', 'on', 'on', 'on', 'on', 'on', 'Blabla', 'off', 1, 1),
(9, 'Lavage effectuÃ©', '2019-09-20', 'on', 'on', 'on', 'on', 'on', 'Lavage effectuÃ©', 'on', 1, 1),
(10, 'VÃ©rifier la pression des pneux', '2019-09-27', 'on', 'on', 'on', 'on', 'on', 'Pression des pneux', 'on', 1, 1),
(11, 'YMCA', '2019-09-29', 'on', 'on', 'on', 'on', 'on', 'Blabla', 'on', 2, 1),
(12, 'blabla', '2019-09-30', 'on', 'on', 'on', 'on', 'on', 'blbla', 'on', 2, 1),
(13, 'blabla', '2019-09-30', 'on', 'on', 'on', 'on', 'on', 'Insert', 'on', 1, 1),
(14, 'blabla', '2019-09-20', 'on', 'on', 'on', 'on', 'on', '$_POST[\'id\']', 'off', 2, 1),
(15, 'blabla', '2019-09-20', 'on', 'on', 'on', 'on', 'on', '$_POST[\'id\']', 'off', 2, 1),
(16, 'test', '2019-09-30', 'on', 'on', 'on', 'on', 'on', 'test', 'on', 1, 1),
(17, 'blabla', '2019-09-30', 'on', 'on', 'on', 'on', 'on', 'sdqf', 'off', 2, 1),
(18, 'blabla', '2019-09-30', 'on', 'on', 'on', 'on', 'on', 'fds', 'off', 1, 1),
(19, 'blabla', '2019-09-12', 'on', 'on', 'on', 'on', 'on', 'cx', 'off', 1, 1),
(20, 'blabla', '2019-09-18', 'on', 'on', 'on', 'on', 'on', 'ddddddd', 'on', 2, 1),
(21, 'test', '2019-10-01', 'off', 'off', 'off', 'off', 'off', 'dd', 'on', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `giv_alerte_utilisateur`
--

DROP TABLE IF EXISTS `giv_alerte_utilisateur`;
CREATE TABLE IF NOT EXISTS `giv_alerte_utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_alerte` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=156 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `giv_alerte_utilisateur`
--

INSERT INTO `giv_alerte_utilisateur` (`id`, `id_alerte`, `id_utilisateur`) VALUES
(155, 2, 1),
(154, 3, 1),
(153, 1, 1),
(152, 6, 1),
(151, 19, 1),
(150, 8, 1),
(149, 7, 1),
(148, 20, 1),
(147, 14, 1),
(146, 15, 1),
(145, 11, 1),
(144, 13, 1),
(143, 18, 1),
(142, 12, 1),
(141, 17, 1),
(140, 16, 1),
(139, 21, 1);

-- --------------------------------------------------------

--
-- Structure de la table `giv_calendar`
--

DROP TABLE IF EXISTS `giv_calendar`;
CREATE TABLE IF NOT EXISTS `giv_calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `color` varchar(7) NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `repeat_day` varchar(250) DEFAULT NULL,
  `repeat_week` varchar(250) DEFAULT '0',
  `repeat_mouth` varchar(250) DEFAULT NULL,
  `repeat_year` varchar(250) DEFAULT '0',
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `giv_calendar`
--

INSERT INTO `giv_calendar` (`id`, `title`, `color`, `date_start`, `date_end`, `repeat_day`, `repeat_week`, `repeat_mouth`, `repeat_year`, `id_utilisateur`) VALUES
(45, 'Aujourd\'hui', '#c0c0c0', '2020-02-19 07:50:37', '2020-02-19 07:50:37', '', '', '', '', 1),
(44, 'Jeudi 13', '#c0c0c0', '2020-02-13 00:00:00', '2020-02-13 00:00:00', '', '', '', '', 1),
(46, 'Aujourd\'hui', '#c0c0c0', '2020-02-19 07:53:07', '2020-02-19 07:53:07', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Structure de la table `giv_carburant`
--

DROP TABLE IF EXISTS `giv_carburant`;
CREATE TABLE IF NOT EXISTS `giv_carburant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) DEFAULT NULL,
  `value` decimal(5,3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `giv_carburant`
--

INSERT INTO `giv_carburant` (`id`, `name`, `value`) VALUES
(1, 'Gazole', '1.500'),
(2, 'SP98', '1.700'),
(3, 'SP95-E10', '1.600'),
(4, 'SP95', '1.700'),
(5, 'GPLc', '0.800'),
(6, 'E85', '0.800');

-- --------------------------------------------------------

--
-- Structure de la table `giv_categorie`
--

DROP TABLE IF EXISTS `giv_categorie`;
CREATE TABLE IF NOT EXISTS `giv_categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `giv_categorie`
--

INSERT INTO `giv_categorie` (`id`, `name`) VALUES
(1, 'Huile moteur'),
(2, 'Direction / Suspension / Train'),
(3, 'Freinage'),
(4, 'Filtration'),
(5, 'Visibilit&eacute;'),
(6, 'Pi&egrave;ces Thermiques et Climatisation'),
(7, 'Embrayage et Bo&icirc;te de vitesse'),
(8, 'Echappement'),
(9, 'D&eacute;marrage et Charge'),
(10, 'Accessoires et Equipements'),
(11, 'Pi&egrave;ces Habitacle'),
(12, 'Attelage et Portage'),
(13, 'Outillage'),
(14, 'Pneus et Equipements Roue'),
(15, 'Entretien et Nettoyage'),
(16, 'Carrosserie et peinture'),
(17, 'Jeux &eacute;ducatifs');

-- --------------------------------------------------------

--
-- Structure de la table `giv_connexion`
--

DROP TABLE IF EXISTS `giv_connexion`;
CREATE TABLE IF NOT EXISTS `giv_connexion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_week` int(2) NOT NULL,
  `num_connexion` int(9) NOT NULL,
  `years` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `giv_connexion`
--

INSERT INTO `giv_connexion` (`id`, `num_week`, `num_connexion`, `years`, `id_utilisateur`) VALUES
(21, 32, 1, 2019, 17),
(20, 32, 23, 2019, 1),
(19, 30, 10, 2019, 1),
(10, 31, 32, 2019, 1),
(7, 32, 0, 2019, 0),
(15, 33, 1, 2019, 18),
(18, 31, 3, 2019, 17),
(22, 36, 3, 2019, 1),
(23, 37, 7, 2019, 1),
(24, 38, 16, 2019, 1),
(25, 39, 23, 2019, 1),
(26, 40, 40, 2019, 1),
(27, 41, 45, 2019, 1),
(28, 41, 1, 2019, 17),
(29, 41, 2, 2019, 18),
(30, 42, 4, 2019, 1),
(31, 45, 6, 2019, 1),
(32, 2, 1, 2020, 1),
(33, 4, 13, 2020, 1),
(34, 4, 1, 2020, 19),
(35, 5, 27, 2020, 1),
(36, 5, 2, 2020, 17),
(37, 5, 1, 2020, 20),
(38, 6, 26, 2020, 1),
(39, 6, 1, 2020, 20),
(40, 7, 1, 2020, 1),
(41, 8, 1, 2020, 1),
(42, 10, 1, 2020, 1),
(43, 20, 1, 2020, 1),
(44, 22, 4, 2020, 1);

-- --------------------------------------------------------

--
-- Structure de la table `giv_epaisseur`
--

DROP TABLE IF EXISTS `giv_epaisseur`;
CREATE TABLE IF NOT EXISTS `giv_epaisseur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` decimal(5,3) DEFAULT NULL,
  `id_intervention` int(11) DEFAULT NULL,
  `id_composant` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `giv_etat`
--

DROP TABLE IF EXISTS `giv_etat`;
CREATE TABLE IF NOT EXISTS `giv_etat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` decimal(5,3) DEFAULT NULL,
  `id_intervention` int(11) DEFAULT NULL,
  `id_composant` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `giv_intervention`
--

DROP TABLE IF EXISTS `giv_intervention`;
CREATE TABLE IF NOT EXISTS `giv_intervention` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kilometre` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `date` date NOT NULL,
  `id_vehicule` int(11) NOT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `giv_intervention`
--

INSERT INTO `giv_intervention` (`id`, `kilometre`, `name`, `description`, `date`, `id_vehicule`, `id_utilisateur`) VALUES
(45, 125115, 'Niveau d\'huile', 'Le plein d\'huile a Ã©tÃ© fait', '2020-01-10', 1, 1),
(46, 125001, 'VÃ©rification niveau d\'huile + Batterie ', 'La vÃ©rification du niveau d\'huile a Ã©tÃ© effectuÃ©', '2020-01-01', 2, 1),
(47, 95000, '4 Bougies d\'allumage', '4 Bougies d\'allumage', '2020-05-27', 2, 1),
(48, 117000, 'Pression des pneus + VÃ©rification d\'huiles  ', 'Pression des pneus + VÃ©rification d\'huiles  ', '2020-05-27', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `giv_marque`
--

DROP TABLE IF EXISTS `giv_marque`;
CREATE TABLE IF NOT EXISTS `giv_marque` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `giv_message`
--

DROP TABLE IF EXISTS `giv_message`;
CREATE TABLE IF NOT EXISTS `giv_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `message` text NOT NULL,
  `visible` varchar(3) NOT NULL,
  `now` datetime DEFAULT NULL,
  `id_destinataire` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `giv_message`
--

INSERT INTO `giv_message` (`id`, `name`, `message`, `visible`, `now`, `id_destinataire`, `id_utilisateur`) VALUES
(16, 'test', 'test', 'on', NULL, 1, 1),
(15, 'test', '158753', 'on', NULL, 1, 1),
(14, 'test', '123', 'off', NULL, 18, 1),
(13, 'Boud', '123@', 'on', NULL, 1, 17),
(12, 'Salut', 'Aurais-tu l\'amabilitÃ© de m\'amenez mes devoirs ?', 'on', NULL, 1, 1),
(17, 'Hi', 'Hello', 'on', NULL, 1, 18),
(18, 'Regarde la tv', 'Stp regarde la tÃ©lÃ©', 'on', NULL, 1, 18),
(19, '12 Octobre 2019', 'salut', 'on', '2019-10-12 17:21:33', 1, 1),
(20, '', '', 'on', '2019-10-16 16:22:42', 1, 1),
(21, 'mat', 'mat', 'on', '2019-10-16 16:26:09', 1, 1),
(22, 'test', 'test', 'on', '2019-11-07 13:20:04', 1, 1),
(23, 'plop', ')', 'on', '2019-11-07 18:51:53', 1, 1),
(24, '', '', 'on', '2019-11-08 16:07:56', 1, 1),
(25, '', '', 'on', '2019-11-08 16:11:16', 1, 1),
(26, '', '', 'on', '2019-11-08 16:13:35', 1, 1),
(27, '12', '34', 'on', '2020-01-21 00:38:15', 1, 1),
(28, 'Tesr', 'Test', 'on', '2020-01-29 18:19:40', 1, 1),
(29, 'RÃ©pare la fiat', 'Salut peux tu rÃ©parer la fiat', 'on', '2020-01-30 00:28:57', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `giv_message_utilisateur`
--

DROP TABLE IF EXISTS `giv_message_utilisateur`;
CREATE TABLE IF NOT EXISTS `giv_message_utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `id_message` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `giv_modele`
--

DROP TABLE IF EXISTS `giv_modele`;
CREATE TABLE IF NOT EXISTS `giv_modele` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `id_marque` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `giv_niveau`
--

DROP TABLE IF EXISTS `giv_niveau`;
CREATE TABLE IF NOT EXISTS `giv_niveau` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` decimal(5,3) DEFAULT NULL,
  `id_intervention` int(11) DEFAULT NULL,
  `id_composant` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `giv_pneu`
--

DROP TABLE IF EXISTS `giv_pneu`;
CREATE TABLE IF NOT EXISTS `giv_pneu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `hiver` tinyint(1) DEFAULT NULL,
  `type` varchar(6) DEFAULT NULL,
  `largeur` int(11) DEFAULT NULL,
  `hauteur` int(11) DEFAULT NULL,
  `contruction` varchar(6) DEFAULT NULL,
  `diametre_roue` int(11) DEFAULT NULL,
  `indice_charge` int(11) DEFAULT NULL,
  `indiice_vitesse` int(11) DEFAULT NULL,
  `min_hiver` int(11) DEFAULT NULL,
  `min_ete` int(11) DEFAULT NULL,
  `id_composant` int(11) DEFAULT NULL,
  `id_vitesse` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `giv_pression`
--

DROP TABLE IF EXISTS `giv_pression`;
CREATE TABLE IF NOT EXISTS `giv_pression` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` decimal(5,3) DEFAULT NULL,
  `id_intervention` int(11) DEFAULT NULL,
  `id_composant` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `giv_privilege`
--

DROP TABLE IF EXISTS `giv_privilege`;
CREATE TABLE IF NOT EXISTS `giv_privilege` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `display_cars_mod` int(1) NOT NULL,
  `display_cars_del` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `giv_privilege`
--

INSERT INTO `giv_privilege` (`id`, `name`, `display_cars_mod`, `display_cars_del`) VALUES
(1, 'super-admin', 1, 1),
(2, 'admin', 1, 1),
(3, 'utilisateur', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `giv_serrage`
--

DROP TABLE IF EXISTS `giv_serrage`;
CREATE TABLE IF NOT EXISTS `giv_serrage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` decimal(5,3) DEFAULT NULL,
  `id_intervention` int(11) DEFAULT NULL,
  `id_composant` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `giv_sous_categorie`
--

DROP TABLE IF EXISTS `giv_sous_categorie`;
CREATE TABLE IF NOT EXISTS `giv_sous_categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=187 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `giv_sous_categorie`
--

INSERT INTO `giv_sous_categorie` (`id`, `name`, `id_categorie`) VALUES
(1, 'Pompe &agrave; eau + kit de courroie de distribution', 1),
(2, 'Kit de courroie d\'accessoire', 1),
(3, 'Injecteur', 1),
(4, 'Kit de distribution', 1),
(5, 'Bougie d\'allumage', 1),
(6, 'Turbocompresseur', 1),
(7, 'Support moteur', 1),
(8, 'Courroie trap&eacute;zo&iuml;dale &agrave; nervures', 1),
(9, 'Pompe &agrave; eau', 1),
(10, 'Jeu de 2 amortisseurs avant', 2),
(11, 'Triangle de suspension', 2),
(12, 'Jeu de 2 amortisseurs arri&egrave;re', 2),
(13, 'Roulement de roue', 2),
(14, 'Rotule de direction', 2),
(15, 'Biellette de barre stabilisatrice', 2),
(16, 'Cardan', 2),
(17, 'Silent bloc de suspension', 2),
(18, 'But&eacute;e d\'amortisseur', 2),
(19, 'Rotule de suspension', 2),
(20, 'Jeu de 4 plaquettes de frein avant', 3),
(21, 'Jeu de 2 disques de frein avant', 3),
(22, 'Jeu de 4 plaquettes de frein arri&egrave;re', 3),
(23, 'Jeu de 2 disques de frein arri&egrave;re', 3),
(24, '&Eacute;trier de frein', 3),
(25, 'Kit de freins &agrave; tambours arri&egrave;re', 3),
(26, 'Flexible de frein', 3),
(27, 'Capteur ABS', 3),
(28, 'Ma&icirc;tre-cylindre de frein', 3),
(29, 'C&acirc;ble de frein &agrave; main', 3),
(50, 'Filtre &agrave; huile', 4),
(51, 'Filtre &agrave; air', 4),
(52, 'Filtre &agrave; carburant', 4),
(53, 'Filtre d\'habitacle', 4),
(54, 'Filtre hydraulique, direction', 4),
(55, 'Joint d\'&eacute;tanch&eacute;it&eacute;, bo&icirc;tier de filtre &agrave; huile', 4),
(56, 'Couvercle, bo&icirc;tier du filtre d\'huile', 4),
(57, 'Kit de filtres hydrauliques, bo&icirc;te automatique', 4),
(58, 'Bo&icirc;tier, filtre de carburant', 4),
(59, 'Support, bo&icirc;tier de filtre &agrave; air', 4),
(60, 'Balai d\'essuie-glace', 5),
(61, 'Phare avant', 5),
(62, 'Feu arri&egrave;re', 5),
(63, 'R&eacute;troviseur ext&eacute;rieur', 5),
(64, 'Ampoule, projecteur principal', 5),
(65, 'Verre de r&eacute;troviseur, r&eacute;troviseur ext&eacute;rieur', 5),
(66, 'Phare antibrouillard', 5),
(67, 'Feu clignotant', 5),
(68, 'Pompe de lave-glace', 5),
(69, 'Ampoule, feu stop/feu arri&egrave;re', 5),
(70, 'Compresseur, climatisation', 6),
(71, 'Condenseur, climatisation', 6),
(72, 'Radiateur moteur', 6),
(73, 'Thermostat d\'eau', 6),
(74, 'Sonde de temp&eacute;rature, liquide de refroidissement', 6),
(75, 'Liquide de refroidissement', 6),
(76, 'Durite de radiateur', 6),
(77, 'Ventilateur de refroidissement du moteur', 6),
(78, 'R&eacute;sistance, pulseur d\'air habitacle', 6),
(79, 'Pulseur d\'air habitacle', 6),
(80, 'Kit d\'embrayage', 7),
(81, 'Kit d\'embrayage + Volant moteur', 7),
(82, 'Kit de montage, embrayage/volant de moteur', 7),
(83, 'Volant moteur', 7),
(84, 'Emetteur d\'embrayage', 7),
(85, 'Huile bo&icirc;te de vitesses', 7),
(86, 'R&eacute;cepteur d\'embrayage', 7),
(87, 'C&acirc;ble d\'embrayage', 7),
(88, 'Support de bo&icirc;te de vitesse', 7),
(89, 'Bague d\'&eacute;tanch&eacute;it&eacute;, bo&icirc;te de vitesse manuel', 7),
(90, 'Vanne EGR', 8),
(91, 'Silencieux arri&egrave;re', 8),
(92, 'Catalyseur', 8),
(93, 'Filtre &agrave; particules / FAP', 8),
(94, 'Sonde lambda', 8),
(95, 'Tuyau d\'&eacute;chappement', 8),
(96, 'Silencieux central', 8),
(97, 'silentbloc de suspension d\'&eacute;chappement', 8),
(98, 'Joint d\'&eacute;tanch&eacute;it&eacute;, collecteur d\'&eacute;chappement', 8),
(99, 'Collier de serrage, &eacute;chappement', 8),
(100, 'Batterie', 9),
(101, 'Alternateur', 9),
(102, 'D&eacute;marreur', 9),
(103, 'Relais, d&eacute;marreur', 9),
(104, 'Poulie roue libre, alternateur', 9),
(105, 'R&eacute;gulateur d\'alternateur', 9),
(106, 'Interrupteur d\'allumage/de d&eacute;marreur', 9),
(107, 'Contacteur, d&eacute;marreur', 9),
(108, 'Poulie, alternateur', 9),
(109, 'Batterie 6V', 9),
(110, 'Tapis de sol sur mesure', 10),
(111, 'Tapis de sol semi sur mesure', 10),
(112, 'Protection des pare-chocs', 10),
(113, 'Haut-parleurs', 10),
(114, 'Housse de si&egrave;ge sur mesure', 10),
(115, 'Radar de recul', 10),
(116, 'Pare-soleil', 10),
(117, 'Tapis de bord', 10),
(118, 'Housse de si&egrave;ge universelle', 10),
(119, 'Autoradio', 10),
(120, 'M&eacute;canisme de l&egrave;ve-vitre', 11),
(121, 'V&eacute;rin de hayon, de coffre', 11),
(122, 'Comodo, colonne de direction', 11),
(123, 'Interrupteur', 11),
(124, 'Bouchon, r&eacute;servoir de carburant', 11),
(125, 'Serrure de porte', 11),
(126, 'Comodo de clignotant', 11),
(127, 'Interrupteur de commande, r&eacute;gulateur de vitesse', 11),
(128, 'Interrupteur, l&egrave;ve-vitre', 11),
(129, 'V&eacute;rin, capot-moteur', 11),
(130, 'Attelage', 12),
(131, 'Barres de toit', 12),
(132, 'Kit attelage et faisceau', 12),
(133, 'Porte-v&eacute;los', 12),
(134, 'Faisceau d\'attelage', 12),
(135, 'Coffre de toit', 12),
(136, 'Prise attelage et remorque', 12),
(137, 'Catadioptre', 12),
(138, 'Plaque de signalisation', 12),
(139, 'Feux de signalisation universels', 12),
(140, 'Lot vidange', 13),
(141, 'Repousse piston &eacute;trier', 13),
(142, 'Cl&eacute; dynamom&eacute;trique', 13),
(143, 'Cric', 13),
(144, 'Chandelle', 13),
(145, 'Compresseur', 13),
(146, 'Cloche 3/8 pour filtre &agrave; huile', 13),
(147, 'Compresseur de ressort', 13),
(148, 'Cl&eacute; &agrave; filtre r&eacute;glable', 13),
(149, 'Jeu de cl&eacute;s torx', 13),
(150, 'Pneu', 14),
(151, 'Enjoliveur', 14),
(152, 'Boulon de roue', 14),
(153, 'Antivol de roue', 14),
(154, 'Capteur de roue TPMS, syst de contr&ocirc;le de pression des pneus', 14),
(155, '&Eacute;crou de roue', 14),
(156, '&Eacute;crou, roue conique', 14),
(157, 'Piston de but&eacute;e, jante', 14),
(158, 'Chaines neige', 14),
(159, 'Nettoyant Vanne EGR', 15),
(160, 'Additif Carburant Diesel', 15),
(161, 'Kit r&eacute;novateur d\'optiques', 15),
(162, 'Nettoyant Climatisation', 15),
(163, 'Nettoyant Freins', 15),
(164, 'Revue technique auto', 15),
(165, 'AdBlue&reg;', 15),
(166, 'Nettoyant Moteur', 15),
(167, 'Nettoyant Filtre &agrave; particules', 15),
(168, 'R&eacute;g&eacute;n&eacute;rant Filtres &agrave; particules', 15),
(169, 'Stylo de retouche auto', 16),
(170, 'Bombe de peinture auto', 16),
(171, 'Peinture universelle', 16),
(172, 'Vernis de finition', 16),
(173, 'Enjoliveur, pare-chocs', 16),
(174, 'Appr&ecirc;t', 16),
(175, 'Kit de montage, choc avant', 16),
(176, 'Support de lampe, feu arri&egrave;re', 16),
(177, 'Baguette et bande protectrice, pare-chocs', 16),
(178, 'Baguette et bande protectrice, porte', 16),
(179, 'Circuits voitures &eacute;lectriques', 17),
(180, 'Voitures t&eacute;l&eacute;command&eacute;es', 17),
(181, 'Jeux de construction', 17),
(182, 'Loisirs cr&eacute;atifs', 17),
(183, 'Jeux scientifiques', 17),
(184, 'Camions, tracteurs, pompiers et petites voitures', 17),
(185, 'Jeux d\'imitation', 17),
(186, 'Voitures pour circuits &eacute;lectriques', 17);

-- --------------------------------------------------------

--
-- Structure de la table `giv_sous_categorie_intervention`
--

DROP TABLE IF EXISTS `giv_sous_categorie_intervention`;
CREATE TABLE IF NOT EXISTS `giv_sous_categorie_intervention` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_intervention` int(11) NOT NULL,
  `id_sous_categorie` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `giv_sous_categorie_intervention`
--

INSERT INTO `giv_sous_categorie_intervention` (`id`, `id_intervention`, `id_sous_categorie`) VALUES
(1, 1, 16),
(2, 1, 1),
(3, 33, 3),
(4, 35, 3),
(5, 36, 12),
(6, 37, 11),
(7, 37, 12),
(8, 38, 11),
(9, 38, 12),
(10, 38, 13),
(11, 38, 14),
(12, 39, 1),
(13, 39, 2),
(14, 39, 3),
(15, 39, 4),
(16, 40, 1),
(17, 41, 51),
(18, 41, 52),
(19, 41, 53),
(20, 42, 12),
(21, 42, 13),
(22, 42, 14),
(23, 43, 1),
(24, 43, 2),
(25, 44, 1),
(26, 44, 2),
(27, 44, 3),
(28, 45, 1),
(29, 45, 50),
(30, 46, 1),
(31, 46, 2),
(32, 46, 3),
(33, 47, 17),
(34, 47, 77),
(35, 47, 78),
(36, 48, 10),
(37, 48, 12),
(38, 47, 5),
(39, 50, 150),
(40, 52, 1),
(41, 55, 1),
(42, 60, 1);

-- --------------------------------------------------------

--
-- Structure de la table `giv_trajet`
--

DROP TABLE IF EXISTS `giv_trajet`;
CREATE TABLE IF NOT EXISTS `giv_trajet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `background_color` varchar(7) NOT NULL,
  `start` varchar(250) NOT NULL,
  `end` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `giv_trajet`
--

INSERT INTO `giv_trajet` (`id`, `name`, `date`, `date_debut`, `date_fin`, `background_color`, `start`, `end`) VALUES
(33, '', '2020-05-18', '2020-05-18 13:00:00', '2020-05-18 21:00:00', '#f52574', 'Mirecourt', 'ContrexÃ©ville'),
(32, '', '2020-05-18', '2020-05-18 12:49:30', '2020-05-18 20:00:00', '#73a87b', 'Mirecourt', 'ContrexÃ©ville'),
(31, 'Essai', '2020-02-14', '2020-02-14 16:45:00', '2020-02-14 18:45:00', '#73a87b', 'Mirecourt', 'ContrexÃ©ville'),
(30, 'Essai', '2020-02-13', '2020-02-13 00:00:00', '2020-02-13 00:00:00', '#73a87b', 'Mirecourt', 'ContrexÃ©ville'),
(29, 'neufchateau', '2019-10-05', '2019-10-05 11:25:30', '2019-10-05 12:25:30', '#73a87b', 'Neufchateau, rue Jules d\'hotel', 'ContrexÃ©ville, 283 rue de bretagne'),
(28, 'Me2she', '2019-10-01', '2019-10-01 11:25:45', '2019-10-01 13:25:45', '#73a87b', 'Neufchateau, rue Jules d\'hotel', 'ContrexÃ©ville, 283 rue de bretagne'),
(27, 'She2me', '2019-09-30', '2019-09-30 13:29:15', '2019-09-30 14:15:15', '#73a87b', 'Neufchateau', 'ContrexÃ©ville'),
(24, 'Mirecourt Contrexeville samedi', '2019-10-05', '2019-10-05 09:00:00', '2019-10-05 16:00:00', '#73a87b', 'Mirecourt', 'ContrexÃ©ville'),
(26, 'Contrexeville Mirecourt  samedi', '2019-10-05', '2019-10-05 11:00:00', '2019-10-05 16:00:00', '#73a87b', 'ContrexÃ©ville', 'Mirecourt');

-- --------------------------------------------------------

--
-- Structure de la table `giv_usure`
--

DROP TABLE IF EXISTS `giv_usure`;
CREATE TABLE IF NOT EXISTS `giv_usure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` decimal(5,3) DEFAULT NULL,
  `id_intervention` int(11) DEFAULT NULL,
  `id_composant` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `giv_utilisateur`
--

DROP TABLE IF EXISTS `giv_utilisateur`;
CREATE TABLE IF NOT EXISTS `giv_utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(500) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `function` varchar(250) DEFAULT NULL,
  `id_privilege` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `giv_utilisateur`
--

INSERT INTO `giv_utilisateur` (`id`, `email`, `password`, `name`, `function`, `id_privilege`) VALUES
(1, 'm.boheme@gmail.com', '335775daa65d389ead90ec668a2e75e0', 'Mathias BohÃªme', 'Informaticien', 1),
(17, 'sophielay1901@gmail.com', '335775daa65d389ead90ec668a2e75e0', 'Sophie LaÃ¿', 'Directrice', 3),
(20, 'test@gmail.com', '335775daa65d389ead90ec668a2e75e0', 'test', 'test', 3);

-- --------------------------------------------------------

--
-- Structure de la table `giv_vehicule`
--

DROP TABLE IF EXISTS `giv_vehicule`;
CREATE TABLE IF NOT EXISTS `giv_vehicule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `mark` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `plaque` varchar(25) DEFAULT NULL,
  `litre_cent` decimal(10,3) DEFAULT NULL,
  `kilometre` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `id_modele` int(11) DEFAULT NULL,
  `id_carburant` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `giv_vehicule`
--

INSERT INTO `giv_vehicule` (`id`, `name`, `mark`, `model`, `plaque`, `litre_cent`, `kilometre`, `date`, `id_modele`, `id_carburant`) VALUES
(1, 'Grande Punto de Mathias', 'Fiat', 'Grande Punto', 'F EP 286 WP 88', '5.000', 110000, '2019-09-10', NULL, 2),
(2, 'Clio de Sophie', 'Renault', 'Clio', 'BX 600 WJ', '4.000', 85000, '2011-10-01', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `giv_ville`
--

DROP TABLE IF EXISTS `giv_ville`;
CREATE TABLE IF NOT EXISTS `giv_ville` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start` varchar(250) NOT NULL,
  `end` varchar(250) NOT NULL,
  `id_trajet` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
