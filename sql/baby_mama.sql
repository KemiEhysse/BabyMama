-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 16 jan. 2026 à 18:27
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `baby_mama`
--

-- --------------------------------------------------------

--
-- Structure de la table `conseils`
--

CREATE TABLE `conseils` (
  `id` int(11) NOT NULL,
  `intitule` varchar(100) DEFAULT NULL,
  `contenu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `conseils`
--

INSERT INTO `conseils` (`id`, `intitule`, `contenu`) VALUES
(1, 'Conseil Nausées', 'Essayez de manger des petites quantités plus souvent et évitez les plats trop gras.'),
(2, 'Conseil Fatigue', 'C’est normal au 1er et 3ème trimestre. Reposez-vous dès que possible.'),
(3, 'Conseil Seins sensible', 'C’est normal durant la grossesse . Ne vous stressez pas pour ca . Profiter de votre grossesse.'),
(4, 'Conseil Montée de lait fortes', 'La forte montée de lait tous les jours ne convient pas . Contactez immédiatement votre médecin.'),
(5, 'Conseil Douleurs', 'Reposez-vous immédiatement. Si la douleur persiste, contactez votre médecin.'),
(6, 'Conseil Envie frequente', 'C est du à la pression de l utérus sur la vessie.'),
(7, 'Conseil Jambes lourdes', 'Problème de circulation sanguine. Mentionnez-le lors de votre prochaine consultation.'),
(8, 'Conseil Saignements', 'Risque de complications. Contactez et consulter votre médecin.'),
(9, 'Conseil Constipation', 'Du au ralentissement du système digestif. Notifiez-le à votre médecin lors du prochain controle.'),
(10, 'Conseil Remontées', 'Vous etes surement en fin de grossesse ce qui est normal. Sinon contactez votre médecin.'),
(11, 'Conseil Absence mouvement', 'Bébé en danger . Contactez immediatement votre médecin.'),
(12, 'Conseil Perte', 'Ceci est un signe d accouchement imminent. Contactez votre médecin et rendez-vous de suite à l hopital.'),
(13, 'Conseil Maux de tete ou trouble', 'Risque de pré-éclampsie. Contactez immediatement votre médecin.'),
(14, 'Conseil Fièvre élevée', 'Peut etre le signe d une infection pouvant affecter le bébé. Contactez d urgence votre médecin.');

-- --------------------------------------------------------

--
-- Structure de la table `journal`
--

CREATE TABLE `journal` (
  `id` int(11) NOT NULL,
  `id_utilisatrice` int(11) DEFAULT NULL,
  `note_libre` text DEFAULT NULL,
  `mouvements_bebe` int(11) DEFAULT 0,
  `date_enregistrement` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `medecins`
--

CREATE TABLE `medecins` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `specialite` varchar(100) DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `hopital` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `medecins`
--

INSERT INTO `medecins` (`id`, `nom`, `specialite`, `contact`, `hopital`) VALUES
(1, 'Dr. Traoré', 'Gynécologue-Obstétricien', '+229 01 00 00 00 00', 'Hôpital Mère-Enfant');

-- --------------------------------------------------------

--
-- Structure de la table `rappels`
--

CREATE TABLE `rappels` (
  `id` int(11) NOT NULL,
  `id_utilisatrice` int(11) NOT NULL,
  `titre` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `date_rappel` datetime DEFAULT NULL,
  `est_termine` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `symptomes`
--

CREATE TABLE `symptomes` (
  `id` int(11) NOT NULL,
  `libelle` varchar(100) DEFAULT NULL,
  `niveau_alerte` int(11) DEFAULT NULL,
  `id_conseil` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `symptomes`
--

INSERT INTO `symptomes` (`id`, `libelle`, `niveau_alerte`, `id_conseil`) VALUES
(1, 'Nausées', 1, 1),
(2, 'Fatigue intense', 2, 2),
(3, 'Seins sensibles', 1, 3),
(4, 'Montée de lait fortes', 3, 4),
(5, 'Douleurs abdominales fortes', 3, 5),
(6, 'Envie fréquente d uriner', 1, 6),
(7, 'Jambes lourdes/Gonflement (oedèmes)', 2, 7),
(8, 'Saignements vaginaux', 3, 8),
(9, 'Constipation', 2, 9),
(10, 'Remontées acides(Brulures d estomac)', 2, 10),
(11, 'Absence de mouvements du bébé', 3, 11),
(12, 'Perte de liquide(Rupture des eaux)', 3, 12),
(13, 'Maux de tete violents/ Troubles de la vue', 3, 13),
(14, 'Fièvre élevée', 3, 14);

-- --------------------------------------------------------

--
-- Structure de la table `utilisatrices`
--

CREATE TABLE `utilisatrices` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `numero` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mot_de_passe` varchar(255) DEFAULT NULL,
  `id_medecin` int(11) DEFAULT NULL,
  `etat_grossesse` date DEFAULT NULL,
  `groupe_sanguin` varchar(5) DEFAULT NULL,
  `hopital_suivi` varchar(100) DEFAULT NULL,
  `est_admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `conseils`
--
ALTER TABLE `conseils`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `journal`
--
ALTER TABLE `journal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_utilisatrice` (`id_utilisatrice`);

--
-- Index pour la table `medecins`
--
ALTER TABLE `medecins`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `rappels`
--
ALTER TABLE `rappels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_utilisatrice` (`id_utilisatrice`);

--
-- Index pour la table `symptomes`
--
ALTER TABLE `symptomes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_conseil` (`id_conseil`);

--
-- Index pour la table `utilisatrices`
--
ALTER TABLE `utilisatrices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_medecin` (`id_medecin`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `conseils`
--
ALTER TABLE `conseils`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `journal`
--
ALTER TABLE `journal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `medecins`
--
ALTER TABLE `medecins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `rappels`
--
ALTER TABLE `rappels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `symptomes`
--
ALTER TABLE `symptomes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `utilisatrices`
--
ALTER TABLE `utilisatrices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `journal`
--
ALTER TABLE `journal`
  ADD CONSTRAINT `journal_ibfk_1` FOREIGN KEY (`id_utilisatrice`) REFERENCES `utilisatrices` (`id`);

--
-- Contraintes pour la table `rappels`
--
ALTER TABLE `rappels`
  ADD CONSTRAINT `rappels_ibfk_1` FOREIGN KEY (`id_utilisatrice`) REFERENCES `utilisatrices` (`id`);

--
-- Contraintes pour la table `symptomes`
--
ALTER TABLE `symptomes`
  ADD CONSTRAINT `symptomes_ibfk_1` FOREIGN KEY (`id_conseil`) REFERENCES `conseils` (`id`);

--
-- Contraintes pour la table `utilisatrices`
--
ALTER TABLE `utilisatrices`
  ADD CONSTRAINT `utilisatrices_ibfk_1` FOREIGN KEY (`id_medecin`) REFERENCES `medecins` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
