-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 03 mars 2025 à 18:05
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
-- Base de données : `ecommerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `command`
--

CREATE TABLE `command` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `command`
--

INSERT INTO `command` (`id`, `user_id`, `total_price`, `created_at`) VALUES
(10, 1, 10.00, '2025-03-03 10:33:17'),
(11, 1, 10.00, '2025-03-03 10:34:43'),
(12, 1, 10.00, '2025-03-03 10:35:28'),
(13, 1, 10.00, '2025-03-03 15:24:52'),
(14, 2, 10.00, '2025-03-03 15:25:41'),
(15, 3, 10.00, '2025-03-03 15:59:56'),
(16, 3, 30.00, '2025-03-03 16:08:58'),
(17, 3, 50.00, '2025-03-03 16:09:45'),
(18, 3, 30.00, '2025-03-03 16:41:09'),
(19, 3, 70.00, '2025-03-03 17:01:56');

-- --------------------------------------------------------

--
-- Structure de la table `payment_details`
--

CREATE TABLE `payment_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `card_name` varchar(255) NOT NULL,
  `card_number` varchar(255) NOT NULL,
  `expiry_date` varchar(10) NOT NULL,
  `cvv` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `payment_details`
--

INSERT INTO `payment_details` (`id`, `user_id`, `card_name`, `card_number`, `expiry_date`, `cvv`) VALUES
(1, 3, 'Caca Boudin', '12345678987456321', '12/28', '777');

-- --------------------------------------------------------

--
-- Structure de la table `product_relation`
--

CREATE TABLE `product_relation` (
  `command_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `product_relation`
--

INSERT INTO `product_relation` (`command_id`, `product_id`, `quantity`, `price`) VALUES
(12, 822119, 1, 10),
(13, 939243, 1, 10),
(14, 939243, 1, 10),
(15, 939243, 1, 10),
(16, 1126166, 3, 10),
(17, 1126166, 2, 10),
(17, 939243, 1, 10),
(17, 822119, 1, 10),
(17, 1084199, 1, 10),
(18, 1126166, 1, 10),
(18, 549509, 1, 10),
(18, 933260, 1, 10),
(19, 1126166, 1, 10),
(19, 939243, 3, 10),
(19, 822119, 2, 10),
(19, 1084199, 1, 10);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('user','admin','superadmin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `phone`, `address_id`, `created_at`, `role`) VALUES
(1, 'f\"rz\"r\"r\"zr', 'thibault.frescaline@gmail.com', '$2y$10$qkNSKqayJHNCSEGFRIE7/edVbpQOE62XnXplXPBiHAnRG0xv6FWGu', NULL, NULL, '2025-03-02 20:30:39', 'user'),
(2, 'FRESCALINE', 'frescafamily@gmail.com', '$2y$10$7CyJYgl96gy45cFAwqZ8wupx4EIAMjlMC2.7HATtru3XgJ5ACz09K', NULL, NULL, '2025-03-03 15:25:26', 'user'),
(3, 'FRESCALINE', 'caca@gmail.com', '$2y$10$g//7W6sBiPlxLhkOPHi9KO9/zygAdO6pDJgz3pt72BuKmxrfRiAJ6', NULL, NULL, '2025-03-03 15:47:01', 'admin');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `command`
--
ALTER TABLE `command`
  ADD PRIMARY KEY (`id`),
  ADD KEY `command_ibfk_1` (`user_id`);

--
-- Index pour la table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `product_relation`
--
ALTER TABLE `product_relation`
  ADD KEY `commande_id` (`command_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `address_id` (`address_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `command`
--
ALTER TABLE `command`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `command`
--
ALTER TABLE `command`
  ADD CONSTRAINT `command_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `payment_details`
--
ALTER TABLE `payment_details`
  ADD CONSTRAINT `payment_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
