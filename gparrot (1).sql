-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : jeu. 29 juin 2023 à 09:30
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
-- Base de données : `gparrot`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis_clients`
--

CREATE TABLE `avis_clients` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `commentaire` text NOT NULL,
  `note` int(11) NOT NULL,
  `approved` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `avis_clients`
--

INSERT INTO `avis_clients` (`id`, `nom`, `commentaire`, `note`, `approved`) VALUES
(1, 'John Doe', 'Excellent produit, je recommande vivement', 5, 1),
(2, 'Jane Smith', 'Bon rapport qualité-prix', 4, 1),
(3, 'Mike Adams', 'Service client décevant', 2, 1),
(4, 'Emma Brown', 'Livraison rapide et produit de qualité', 5, 1),
(5, 'John Smith', 'Très bon produit, je suis vraiment satisfait ! Les fonctionnalités sont incroyables.', 5, 1),
(6, 'Laura Johnson', 'J\'ai été déçu par ce produit. La qualité n\'est pas à la hauteur de mes attentes.', 2, 1),
(7, 'Michael Brown', 'Excellent service client ! Ils ont résolu mon problème rapidement et efficacement.', 5, 1),
(8, 'Sarah Davis', 'Ce produit est moyen. Rien de particulièrement impressionnant, mais il fait le travail.', 3, 1),
(9, 'Robert Wilson', 'Livraison très lente, j\'ai dû attendre plus longtemps que prévu pour recevoir le produit.', 3, 1),
(10, 'Jennifer Martinez', 'Produit de qualité supérieure ! Je suis totalement satisfait de mon achat.', 5, 1),
(11, 'David Thompson', 'Le prix de ce produit est trop élevé par rapport à ses fonctionnalités.', 2, 1),
(12, 'Jessica Anderson', 'Ce produit a dépassé mes attentes. Il est facile à utiliser et offre d\'excellentes performances.', 4, 1),
(13, 'Christopher Harris', 'J\'ai rencontré des problèmes avec ce produit dès le premier jour. Le service client n\'a pas pu résoudre mon problème.', 1, 1),
(14, 'Amanda Thompson', 'Je recommande vivement ce produit à tous ceux qui cherchent une solution fiable et abordable.', 5, 1),
(15, 'bbb', 'qsdfq', 2, 0),
(16, 'Sarah Johnson', 'Très déçu de la qualité du produit.', 1, 0),
(17, 'Robert Smith', 'Le service client est inexistant.', 2, 0),
(18, 'Emily Davis', 'Produit arrivé endommagé, mauvaise expérience.', 2, 0),
(19, 'Michael Wilson', 'Livraison très lente, je ne recommande pas.', 1, 0),
(20, 'Jennifer Anderson', 'Le prix est excessif pour la qualité du produit.', 2, 0),
(21, 'Christopher Thomas', 'Je ne suis pas satisfait de mon achat.', 2, 0),
(23, 'David Garcia', 'Service client peu réactif, déçu.', 2, 1),
(26, 'Patrick', 'ssdqfqsf sFs', 3, 1),
(27, 'pascalbdn', 'qsD SWFC QDWXVQS QSDXF SX', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `modele` varchar(255) DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  `annee` int(11) DEFAULT NULL,
  `energie` varchar(50) DEFAULT NULL,
  `kilometrage` int(11) DEFAULT NULL,
  `description` text,
  `securite` text,
  `places` text,
  `options_list` varchar(255) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `cars`
--

INSERT INTO `cars` (`id`, `img`, `modele`, `prix`, `annee`, `energie`, `kilometrage`, `description`, `securite`, `places`, `options_list`, `create_at`) VALUES
(17, 'images/ambreetmoi_64954a352c2913.10296835.jpeg', 'citronopipo', '250.00', 1987, 'Essence', 123, 'SUPERBE', NULL, NULL, NULL, NULL),
(22, 'images/mercedes-1327610_640_64992f8a74f0a9.37070857.jpg', 'Modèle 1', '15000.00', 2022, 'Essence', 10000, 'Description du modèle 1', NULL, NULL, NULL, NULL),
(23, 'images/car-4445171_640_64992f3ebca350.56695919.jpg', 'Modèle 2', '20000.00', 2021, 'Diesel', 5000, 'Description du modèle 2', NULL, NULL, NULL, NULL),
(24, 'images/piaggio-ape-7254648_640_64992f205619d2.67122535.jpg', 'Modèle 3', '18000.00', 2020, 'Essence', 8000, 'Description du modèle 3', NULL, NULL, NULL, NULL),
(25, 'images/alfa-romeo-7968027_640_64992ee4c74200.13162185.jpg', 'Modèle 4', '22000.00', 2019, 'Hybride', 12000, 'Description du modèle 4', NULL, NULL, NULL, NULL),
(26, 'images/car-1661767_640_64992ec4f22df7.94373841.jpg', 'Modèle 5', '25000.00', 2022, 'Essence', 6000, 'Description du modèle 5', NULL, NULL, NULL, NULL),
(27, 'images/opel-5190050_640_64992e9d5ddf87.54952086.jpg', 'Modèle 6', '19000.00', 2020, 'Diesel', 9000, 'Description du modèle 6', NULL, NULL, NULL, NULL),
(28, 'images/automotive-1846910_640_64992e71af58b6.20099651.jpg', 'Modèle 7', '21000.00', 2018, 'Essence', 11000, 'Description du modèle 7', NULL, NULL, NULL, NULL),
(29, 'images/renault-clio-1671405_640_64992e53088e10.25542479.jpg', 'Modèle 8', '24000.00', 2022, 'Hybride', 7000, 'Description du modèle 8', NULL, NULL, NULL, NULL),
(30, 'images/plymouth-796441_640_64992e2a588e80.57136636.jpg', 'Modèle 9', '17000.00', 2021, 'Essence', 10000, 'Description du modèle 9', NULL, NULL, NULL, NULL),
(31, 'images/vw-bulli-1868890_640_64992e057908a0.68653590.jpg', 'Modèle 10', '23000.00', 2019, 'Diesel', 8000, 'Description du modèle 10', NULL, NULL, NULL, NULL),
(32, 'images/car-1890494_640_64992de0ac3976.06203893.jpg', 'Modèle 11', '20000.00', 2020, 'Essence', 12000, 'Description du modèle 11', NULL, NULL, NULL, NULL),
(33, 'images/automobile-1838782_640_64992dafaa49e4.54218850.jpg', 'Modèle 12', '19000.00', 2022, 'Hybride', 5000, 'Description du modèle 12', NULL, NULL, NULL, NULL),
(34, 'images/buick-1400243_640_64992d791634c8.57486595.jpg', 'Modèle 13', '22000.00', 2018, 'Essence', 9000, 'Description du modèle 13', NULL, NULL, NULL, NULL),
(35, 'images/car-1880381_640_64992d596c3543.00257668.jpg', 'Modèle 14', '25000.00', 2021, 'Diesel', 11000, 'Description du modèle 14', NULL, NULL, NULL, NULL),
(36, 'images/car-604019_640_64992d10486e67.87438648.jpg', 'Modèle 15', '18000.00', 2019, 'Essence', 7000, 'Description du modèle 15', NULL, NULL, NULL, NULL),
(37, 'images/renault-juvaquatre-1661009_640_64992cd3aa6d01.72340400.jpg', 'Modèle 16', '24000.00', 2022, 'Hybride', 10000, 'Description du modèle 16', NULL, NULL, NULL, NULL),
(38, 'images/auto-2179220_640_64992caccc7df2.92134810.jpg', 'Modèle 17', '20000.00', 2020, 'Essence', 8000, 'Description du modèle 17', NULL, NULL, NULL, NULL),
(39, 'images/car-1300629_640_64992c87286bc2.70929675.png', 'Modèle 18', '23000.00', 2021, 'Diesel', 6000, 'Description du modèle 18', NULL, NULL, NULL, NULL),
(40, 'images/auto-788747_640_64992c5a2c9964.15517462.jpg', 'Modèle 19', '21000.00', 2018, 'Essence', 12000, 'Description du modèle 19', NULL, NULL, NULL, NULL),
(41, 'images/oldtimer-1197800_640_64992bf9b8b646.31898218.jpg', 'auto pipo', '19000.00', 2019, 'electrique', 9000, 'Description du modèle 20', 'Airbags', '4', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Horaires`
--

CREATE TABLE `Horaires` (
  `id` int(11) NOT NULL,
  `jour` enum('Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche') NOT NULL,
  `ouverture_matin` time NOT NULL,
  `fermeture_matin` time NOT NULL,
  `ouverture_apresmidi` time NOT NULL,
  `fermeture_apresmidi` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Horaires`
--

INSERT INTO `Horaires` (`id`, `jour`, `ouverture_matin`, `fermeture_matin`, `ouverture_apresmidi`, `fermeture_apresmidi`) VALUES
(1, 'Lundi', '00:00:00', '00:00:00', '16:00:00', '19:00:00'),
(2, 'Mardi', '08:00:00', '12:00:00', '14:00:00', '18:00:00'),
(3, 'Mercredi', '08:00:00', '12:00:00', '14:00:00', '18:00:00'),
(4, 'Jeudi', '08:00:00', '12:00:00', '14:00:00', '18:00:00'),
(5, 'Vendredi', '08:00:00', '12:00:00', '14:00:00', '18:00:00'),
(6, 'Samedi', '09:00:00', '12:00:00', '14:00:00', '17:00:00'),
(7, 'Dimanche', '00:00:00', '00:00:00', '00:00:00', '00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `nom`, `description`) VALUES
(1, 'Réparation de carrosserie', 'Un service exceptionnel pour restaurer l\'éclat et la fonctionnalité de votre véhicule. Grâce à nos techniciens qualifiés et nos équipements modernes, nous réparons les dommages de toutes tailles, des petites égratignures aux grosses bosses. Nous utilisons des matériaux de qualité supérieure et des techniques avancées pour garantir un résultat optimal, tout en offrant un service client sans pareil. Faites confiance à Réparation de Carrosserie pour redonner vie à votre véhicule.'),
(2, 'Réparation mécanique', 'votre atelier de confiance pour toutes les interventions liées à la mécanique de votre véhicule. Nos mécaniciens experts sont formés pour diagnostiquer et réparer une vaste gamme de problèmes, allant de l\'entretien de routine aux réparations complexes du moteur. Avec l\'aide de nos équipements à la pointe de la technologie, nous nous engageons à fournir un service rapide, fiable et transparent. Chez Réparation Mécanique, nous veillons à ce que votre voiture roule en toute sécurité et efficacement, comme si elle était neuve.'),
(3, 'Entretien régulier', 'Votre partenaire fiable pour maintenir votre véhicule en parfait état. Nous offrons une gamme complète de services d\'entretien, y compris la vidange d\'huile, le contrôle des freins, la rotation des pneus et bien plus encore. Nos techniciens expérimentés utilisent des outils de diagnostic avancés pour identifier les problèmes potentiels avant qu\'ils ne deviennent des problèmes coûteux. Nous croyons que la prévention est la clé d\'un véhicule durable et performant, et nous nous engageons à vous aider à maximiser la durée de vie et l\'efficacité de votre véhicule.');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','staff') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(26, 'adminUser', '$2y$10$5NziUWcWeyo2fQdZAmN0quG2.ZVsXqmUj7h4B2PCik0jOxf.i5zUG', 'admin'),
(27, 'staff1', '$2y$10$JMhKm9nFWrE9zqQBxmUb8OmIy3C71Wa3Ild53hw2qnL6N6ankGkN6', 'staff'),
(28, 'pascal', '$2y$10$W4mCmYHO0x180z.L5sDx1.lckqp2jQiAFn7grgUhfIzgVxWXZJ54i', 'staff');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `avis_clients`
--
ALTER TABLE `avis_clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Horaires`
--
ALTER TABLE `Horaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `avis_clients`
--
ALTER TABLE `avis_clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `Horaires`
--
ALTER TABLE `Horaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
