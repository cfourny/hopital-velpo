-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 11 avr. 2023 à 10:23
-- Version du serveur : 8.0.31
-- Version de PHP : 7.4.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `hopital_velpo`
--

-- --------------------------------------------------------

--
-- Structure de la table `archive_op`
--

CREATE TABLE `archive_op` (
  `opno` int NOT NULL,
  `docname` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `patno` int NOT NULL,
  `roomno` int DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `archive_op`
--

INSERT INTO `archive_op` (`opno`, `docname`, `patno`, `roomno`, `date`) VALUES
(1591, 'Leo', 853454, 123, '2022-12-12'),
(2147, 'Gabrielle', 853127, 124, '2022-12-10'),
(3200, 'Martin', 324125, 111, '2022-01-01');

-- --------------------------------------------------------

--
-- Structure de la table `chambres`
--

CREATE TABLE `chambres` (
  `roomno` int NOT NULL,
  `building` int NOT NULL,
  `floor` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `chambres`
--

INSERT INTO `chambres` (`roomno`, `building`, `floor`) VALUES
(111, 1, 1),
(112, 1, 1),
(113, 1, 1),
(114, 1, 1),
(121, 1, 2),
(122, 1, 2),
(123, 1, 2),
(124, 1, 2),
(211, 2, 1),
(212, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `maladies`
--

CREATE TABLE `maladies` (
  `sickness` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `maladies`
--

INSERT INTO `maladies` (`sickness`, `type`) VALUES
('Brulure', 'Blessure'),
('Coupure', 'Blessure'),
('Covid', 'Virus'),
('Ebola', 'Virus'),
('Empoisonnement', 'Blessure'),
('Fracture', 'Blessure'),
('Grippe', 'Virus'),
('Pneumonie', 'Virus'),
('VIH', 'Virus');

-- --------------------------------------------------------

--
-- Structure de la table `medecins`
--

CREATE TABLE `medecins` (
  `docname` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `hiredate` date NOT NULL,
  `mail` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` int NOT NULL,
  `spec` varchar(20) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `medecins`
--

INSERT INTO `medecins` (`docname`, `hiredate`, `mail`, `phone`, `spec`) VALUES
('Bernard', '2002-08-13', 'm.bernard@velpo.fr', 675486525, 'Pneumonie'),
('Daniel', '2020-04-29', 'j.daniel@velpo.fr', 741658862, 'Covid'),
('Frédérique', '2015-01-20', 'm.fred@velpo.fr', 624538715, 'Ebola'),
('Gabrielle', '2020-04-29', 'v.gabrielle@velpo.fr', 756471948, 'Covid'),
('Jules', '2005-02-09', 't.jules@velpo.fr', 638556912, 'Grippe'),
('Laurent', '2012-11-09', 'd.laurent@velpo.fr', 668523501, 'Brulure'),
('Leo', '2020-04-30', 'p.leo@velpo.fr', 702002314, 'Covid'),
('Martin', '2015-03-14', 'l.martin@velpo.fr', 7354555, 'Fracture'),
('Monique', '2002-08-15', 'd.monique@velpo.fr', 612354456, 'VIH'),
('Moore', '2008-12-04', 'd.moore@velpo.fr', 614657836, 'Fracture'),
('Olivier', '2007-09-03', 'l.olivier@velpo.fr', 689548523, 'Empoisonnement');

-- --------------------------------------------------------

--
-- Structure de la table `operation`
--

CREATE TABLE `operation` (
  `opno` int NOT NULL,
  `docname` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `patno` int NOT NULL,
  `roomno` int DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `operation`
--

INSERT INTO `operation` (`opno`, `docname`, `patno`, `roomno`, `date`) VALUES
(1591, 'Leo', 853454, 123, '2022-12-12'),
(3426, 'Jules', 642541, 123, '2022-04-12');

--
-- Déclencheurs `operation`
--
DELIMITER $$
CREATE TRIGGER `archivage` BEFORE DELETE ON `operation` FOR EACH ROW INSERT INTO archive_op VALUES (OLD.opno,OLD.docname,OLD.patno,OLD.roomno,OLD.date)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `patients`
--

CREATE TABLE `patients` (
  `patno` int NOT NULL,
  `patname` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `sickness` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `docname` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `joindate` date NOT NULL,
  `phone` int NOT NULL,
  `mail` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `roomno` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `patients`
--

INSERT INTO `patients` (`patno`, `patname`, `sickness`, `docname`, `joindate`, `phone`, `mail`, `roomno`) VALUES
(324125, 'Bastien', 'Fracture', 'Moore', '2018-08-15', 6324458, 'v.bastien@gmail.com', 211),
(496358, 'Kevin', 'Brulure', 'Laurent', '2022-04-16', 6539475, 'p.kevin@gmail.com', 114),
(642541, 'Thomas', 'Grippe', 'Jules', '2021-10-12', 6421585, 'a.thomas@gmail.com', 113),
(743651, 'Terry', 'Empoisonnement', 'Olivier', '2019-12-26', 6335865, 'm.terry@gmail.com', 114),
(826582, 'Léo', 'Fracture', 'Moore', '2022-12-13', 145682541, 'l.ggrasset@gmail.com', 124),
(853127, 'Marie', 'Covid', 'Gabrielle', '2021-11-29', 7485236, 'f.marie@gmail.com', 121),
(853224, 'Carl', 'Covid', 'Daniel', '2021-11-27', 6873325, 'u.carl@gmail.com', 123),
(853454, 'Jeremy', 'Covid', 'Daniel', '2020-12-29', 7846625, 'l.jeremy@gmail.com', 122),
(853476, 'Marc', 'Covid', 'Gabrielle', '2022-04-07', 6443258, 'v.marc@gmail.com', 121),
(853942, 'Benjamin', 'Covid', 'Daniel', '2022-06-14', 6342279, 'h.benjamin@gmail.com', 122);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `archive_op`
--
ALTER TABLE `archive_op`
  ADD KEY `docname` (`docname`),
  ADD KEY `patno` (`patno`),
  ADD KEY `roomno` (`roomno`);

--
-- Index pour la table `chambres`
--
ALTER TABLE `chambres`
  ADD PRIMARY KEY (`roomno`);

--
-- Index pour la table `maladies`
--
ALTER TABLE `maladies`
  ADD PRIMARY KEY (`sickness`);

--
-- Index pour la table `medecins`
--
ALTER TABLE `medecins`
  ADD PRIMARY KEY (`docname`),
  ADD KEY `sickness` (`spec`);

--
-- Index pour la table `operation`
--
ALTER TABLE `operation`
  ADD PRIMARY KEY (`opno`),
  ADD KEY `docname` (`docname`),
  ADD KEY `patno` (`patno`),
  ADD KEY `roomno` (`roomno`);

--
-- Index pour la table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patno`),
  ADD KEY `docname` (`docname`),
  ADD KEY `roomno` (`roomno`),
  ADD KEY `sickness` (`sickness`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `archive_op`
--
ALTER TABLE `archive_op`
  ADD CONSTRAINT `archive_op_ibfk_1` FOREIGN KEY (`docname`) REFERENCES `medecins` (`docname`),
  ADD CONSTRAINT `archive_op_ibfk_2` FOREIGN KEY (`patno`) REFERENCES `patients` (`patno`),
  ADD CONSTRAINT `archive_op_ibfk_3` FOREIGN KEY (`roomno`) REFERENCES `chambres` (`roomno`);

--
-- Contraintes pour la table `medecins`
--
ALTER TABLE `medecins`
  ADD CONSTRAINT `medecins_ibfk_1` FOREIGN KEY (`spec`) REFERENCES `maladies` (`sickness`);

--
-- Contraintes pour la table `operation`
--
ALTER TABLE `operation`
  ADD CONSTRAINT `operation_ibfk_1` FOREIGN KEY (`docname`) REFERENCES `medecins` (`docname`),
  ADD CONSTRAINT `operation_ibfk_2` FOREIGN KEY (`patno`) REFERENCES `patients` (`patno`),
  ADD CONSTRAINT `operation_ibfk_3` FOREIGN KEY (`roomno`) REFERENCES `chambres` (`roomno`);

--
-- Contraintes pour la table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_ibfk_1` FOREIGN KEY (`docname`) REFERENCES `medecins` (`docname`),
  ADD CONSTRAINT `patients_ibfk_2` FOREIGN KEY (`roomno`) REFERENCES `chambres` (`roomno`),
  ADD CONSTRAINT `patients_ibfk_3` FOREIGN KEY (`sickness`) REFERENCES `maladies` (`sickness`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
