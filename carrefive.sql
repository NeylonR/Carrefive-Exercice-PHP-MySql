-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 16 mars 2022 à 15:36
-- Version du serveur : 10.4.20-MariaDB
-- Version de PHP : 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `carrefive`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `categories_id` int(11) NOT NULL,
  `label` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`categories_id`, `label`) VALUES
(6, 'Entretien Nettoyage'),
(3, 'Epicerie salée'),
(2, 'Epicerie sucrée'),
(4, 'Espace Culturel'),
(5, 'Frais'),
(1, 'Fruits'),
(7, 'Surgelés');

-- --------------------------------------------------------

--
-- Structure de la table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `product_ordered_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `order`
--

INSERT INTO `order` (`order_id`, `amount`, `buyer_id`, `product_ordered_id`) VALUES
(2, 113, 5, 2),
(4, 113, 5, 2),
(5, 113, 5, 2),
(6, 113, 5, 2),
(7, 113, 5, 2),
(8, 113, 5, 2),
(9, 46, 5, 2),
(10, 46, 5, 2),
(11, 45, 5, 2),
(12, 86, 5, 5),
(13, 464, 5, 13),
(14, 104, 5, 5),
(18, 96, 6, 2),
(22, 54, 5, 33),
(23, 217, 5, 13),
(24, 5000, 5, 13),
(25, 14, 8, 5),
(26, 1, 8, 5),
(27, 1, 8, 4),
(28, 1, 8, 4),
(29, 1, 8, 4),
(30, 13, 8, 2),
(31, 13, 8, 2),
(32, 13, 8, 2),
(33, 13, 8, 2),
(34, 1, 8, 5),
(35, 5, 8, 4),
(36, 16, 8, 4),
(37, 13, 8, 2),
(38, 23, 8, 4),
(39, 88, 5, 53),
(40, 316, 5, 53);

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `image` varchar(512) DEFAULT 'public/uploads/noimg.png',
  `dlc` date DEFAULT NULL,
  `stock_quantity` int(11) NOT NULL DEFAULT 0,
  `seller_id` int(11) DEFAULT NULL,
  `modifier_id` int(11) DEFAULT NULL,
  `modifier_date` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`product_id`, `category_id`, `name`, `description`, `price`, `image`, `dlc`, `stock_quantity`, `seller_id`, `modifier_id`, `modifier_date`) VALUES
(2, 2, 'MAGNUM Classic x4', 'Boite de 4 magnums classic', 2.34, 'public/uploads/6231da0eaeb14/magnum.png', '2022-05-09', 532, 2, 5, '2022-03-16 13:37:34'),
(4, 6, 'PAIC Citron', 'Du liquide vaisselle', 1.76, 'public/uploads/6231da19e4eb6/paic.jpeg', NULL, 1, 4, 5, '2022-03-16 13:37:45'),
(5, 2, 'Chocapic', 'Paquet de 430g.', 1.75, 'public/uploads/6231da034572c/chocapic.png', NULL, 65160, 3, 5, '2022-03-16 13:37:23'),
(6, 1, 'Pomme Verte', '100g de Pomme verte', 1.3, 'public/uploads/noimg.png', '2022-05-19', 0, 5, 5, '2022-03-16 13:37:57'),
(7, 1, 'Pomme Rouge', '100g de pomme rouge', 1.4, 'public/uploads/noimg.png', '2022-07-14', 6516, 5, 5, '2022-03-16 14:10:58'),
(13, 2, 'Ice Tea Citron Vert 1.5L', 'Bouteille d&#039;ice tea citron vert de 1.5 litre.', 1.25, 'public/uploads/6231da42b258a/icetea.jpg', '2022-06-09', 2997, 4, 5, '2022-03-16 13:38:26'),
(33, 4, 'CARREFIVE Papier A4', 'Rame de papier format A4', 4.01, 'public/uploads/6231d9e136536/feuille_a4.jpg', NULL, 941, 6, 5, '2022-03-16 13:36:49'),
(53, 3, 'PANZANI Coquillettes', 'Des coquillettes panzani !', 0.76, 'public/uploads/6231d9f93cd6c/panzani.png', '2022-10-21', 0, 5, 5, '2022-03-16 13:54:40');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(2, 'pomme1', '$2y$10$Hh6DzEt9NlE5WOFd9CY3n.GkL5vcCgr3Z3W9lc40wbVWyCIXjm9Na'),
(3, 'pomme', '$2y$10$chFDNXSF3XxtCH9WR59gTuQE8c92oPy3uID/hjAgzAojFYDE2wrwu'),
(4, 'pommedeterre', '$2y$10$M4w6mSxjN8aFpPcBI6.FRengwSpNB6AWzMcoJiyku4hi.9yCVZtPa'),
(5, 'admin', '$2y$10$Tj.QnZLWYTijUz8HY00Oj.eTD3mj3lGbbbmjk5fp5TvQQrOjHvNVq'),
(6, 'randomdude', '$2y$10$DlODyKTIJi2fBds.XTzXHOTABFDY9qf0eZpEKrMXWZ.ugqbdiWmuu'),
(7, '654987', '$2y$10$O5Zqbz5cqV9DTTGCPMr4f.8catvBBsc7HXf/eZ1IRQ4gmIStlQUpW'),
(8, 'testtest', '$2y$10$dL7HdO0jez26UI8S0WpoEeGYXYAe5xqq.RK9fxIckk373NB1f8Vre');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categories_id`),
  ADD UNIQUE KEY `label` (`label`);

--
-- Index pour la table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_buyer_id` (`buyer_id`),
  ADD KEY `fk_product_id` (`product_ordered_id`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `fk_category_id` (`category_id`),
  ADD KEY `fk_seller_id` (`seller_id`),
  ADD KEY `fk_modifier_id` (`modifier_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `categories_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_buyer_id` FOREIGN KEY (`buyer_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `fk_product_id` FOREIGN KEY (`product_ordered_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`categories_id`),
  ADD CONSTRAINT `fk_modifier_id` FOREIGN KEY (`modifier_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `fk_seller_id` FOREIGN KEY (`seller_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
