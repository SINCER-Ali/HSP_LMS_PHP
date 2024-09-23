-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 23 sep. 2024 à 14:51
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `hsp_lms`
--

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

DROP TABLE IF EXISTS `entreprise`;
CREATE TABLE IF NOT EXISTS `entreprise` (
  `id_entreprise` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `site_web` varchar(100) NOT NULL,
  `ref_user` int NOT NULL,
  PRIMARY KEY (`id_entreprise`),
  UNIQUE KEY `site_web` (`site_web`),
  KEY `fk_entreprise_utilisateur` (`ref_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `etablissement`
--

DROP TABLE IF EXISTS `etablissement`;
CREATE TABLE IF NOT EXISTS `etablissement` (
  `id_etablissement` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `site_web` varchar(100) NOT NULL,
  PRIMARY KEY (`id_etablissement`),
  UNIQUE KEY `site_web` (`site_web`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `id_utilisateur` int NOT NULL,
  `cv` text,
  `formation` varchar(100) DEFAULT NULL,
  `id_etablissement` int DEFAULT NULL,
  `ref_utilisateur` int NOT NULL,
  PRIMARY KEY (`id_utilisateur`),
  KEY `id_etablissement` (`id_etablissement`),
  KEY `fk_etudiant_utilisateur` (`ref_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE IF NOT EXISTS `evenement` (
  `id_evement` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `description` text,
  `lieu` varchar(255) DEFAULT NULL,
  `nb_places` int DEFAULT NULL,
  PRIMARY KEY (`id_evement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `hopital`
--

DROP TABLE IF EXISTS `hopital`;
CREATE TABLE IF NOT EXISTS `hopital` (
  `id_hopital` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `commune` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_hopital`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `medecin`
--

DROP TABLE IF EXISTS `medecin`;
CREATE TABLE IF NOT EXISTS `medecin` (
  `id_medecin` int NOT NULL,
  `specialite` varchar(100) DEFAULT NULL,
  `id_hopital` int NOT NULL,
  `ref_utilisateur` int NOT NULL,
  PRIMARY KEY (`id_medecin`),
  KEY `fk_medecin_utilisateur` (`ref_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `offre`
--

DROP TABLE IF EXISTS `offre`;
CREATE TABLE IF NOT EXISTS `offre` (
  `id_offre` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `description` text,
  `missions` text,
  `salaire` decimal(10,2) DEFAULT NULL,
  `type` enum('stage','alternance','CDD','CDI') NOT NULL,
  `etat` enum('ouvert','cloture') NOT NULL,
  `id_entreprise` int DEFAULT NULL,
  PRIMARY KEY (`id_offre`),
  KEY `id_entreprise` (`id_entreprise`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `partenaire`
--

DROP TABLE IF EXISTS `partenaire`;
CREATE TABLE IF NOT EXISTS `partenaire` (
  `id_partenaire` int NOT NULL,
  `poste` varchar(100) DEFAULT NULL,
  `id_entreprise` int DEFAULT NULL,
  `ref_utilisateur` int NOT NULL,
  PRIMARY KEY (`id_partenaire`),
  KEY `id_entreprise` (`id_entreprise`),
  KEY `fk_partenaire_utilistateur` (`ref_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `participe`
--

DROP TABLE IF EXISTS `participe`;
CREATE TABLE IF NOT EXISTS `participe` (
  `ref_utilisateur` int NOT NULL,
  `ref_evenement` int NOT NULL,
  KEY `fk_utilisateur_evenement` (`ref_evenement`),
  KEY `fk_evenement_utilisateur` (`ref_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `canal` enum('general','medecins','etudiants') NOT NULL,
  `titre` varchar(100) NOT NULL,
  `contenu` text,
  `date_publication` date DEFAULT NULL,
  `heure_publication` time DEFAULT NULL,
  `id_utilisateur` int DEFAULT NULL,
  `ref_user` int NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `id_utilisateur` (`id_utilisateur`),
  KEY `fk_post_utilisateur` (`ref_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `postule`
--

DROP TABLE IF EXISTS `postule`;
CREATE TABLE IF NOT EXISTS `postule` (
  `ref_utilisateur` int NOT NULL,
  `ref_offre` int NOT NULL,
  KEY `fk_utilisateur_offre` (`ref_utilisateur`),
  KEY `fk_offre_utilisateur` (`ref_offre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

DROP TABLE IF EXISTS `reponse`;
CREATE TABLE IF NOT EXISTS `reponse` (
  `id_reponse` int NOT NULL AUTO_INCREMENT,
  `contenu` text,
  `date_reponse` date DEFAULT NULL,
  `heure_reponse` time DEFAULT NULL,
  `ref_post` int DEFAULT NULL,
  PRIMARY KEY (`id_reponse`),
  KEY `fk_reponse_post` (`ref_post`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `profil` enum('etudiant','medecin','partenaire','gestionnaire') NOT NULL,
  `ref_etablissement` int NOT NULL,
  `ref_hopital` int NOT NULL,
  `ref_entreprise` int NOT NULL,
  `ref_partenaire` int NOT NULL,
  PRIMARY KEY (`id_utilisateur`),
  KEY `fk_utilisateur_etablissement` (`ref_etablissement`),
  KEY `fk_utilisateur_hopital` (`ref_hopital`),
  KEY `fk_utilisateur_entreprise` (`ref_entreprise`),
  KEY `fk_utilisateur_partenaire` (`ref_partenaire`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD CONSTRAINT `fk_entreprise_utilisateur` FOREIGN KEY (`ref_user`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `fk_etudiant_utilisateur` FOREIGN KEY (`ref_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `medecin`
--
ALTER TABLE `medecin`
  ADD CONSTRAINT `fk_medecin_utilisateur` FOREIGN KEY (`ref_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `partenaire`
--
ALTER TABLE `partenaire`
  ADD CONSTRAINT `fk_partenaire_utilistateur` FOREIGN KEY (`ref_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `participe`
--
ALTER TABLE `participe`
  ADD CONSTRAINT `fk_evenement_utilisateur` FOREIGN KEY (`ref_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_utilisateur_evenement` FOREIGN KEY (`ref_evenement`) REFERENCES `evenement` (`id_evement`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `fk_post_utilisateur` FOREIGN KEY (`ref_user`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `postule`
--
ALTER TABLE `postule`
  ADD CONSTRAINT `fk_offre_utilisateur` FOREIGN KEY (`ref_offre`) REFERENCES `offre` (`id_offre`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_utilisateur_offre` FOREIGN KEY (`ref_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `fk_reponse_post` FOREIGN KEY (`ref_post`) REFERENCES `post` (`id_post`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `fk_utilisateur_entreprise` FOREIGN KEY (`ref_entreprise`) REFERENCES `entreprise` (`id_entreprise`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_utilisateur_etablissement` FOREIGN KEY (`ref_etablissement`) REFERENCES `etablissement` (`id_etablissement`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_utilisateur_hopital` FOREIGN KEY (`ref_hopital`) REFERENCES `hopital` (`id_hopital`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_utilisateur_partenaire` FOREIGN KEY (`ref_partenaire`) REFERENCES `partenaire` (`id_partenaire`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
