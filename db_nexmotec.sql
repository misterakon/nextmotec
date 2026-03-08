-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 08 mars 2026 à 11:15
-- Version du serveur : 8.0.31
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_nexmotec`
--

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('alertefoncier-cache-admin@example.com|127.0.0.1', 'i:1;', 1772710351),
('alertefoncier-cache-admin@example.com|127.0.0.1:timer', 'i:1772710351;', 1772710351),
('alertefoncier-cache-admin@gmail.com|127.0.0.1', 'i:1;', 1772710389),
('alertefoncier-cache-admin@gmail.com|127.0.0.1:timer', 'i:1772710389;', 1772710389),
('alertefoncier-cache-test@example.com|127.0.0.1', 'i:1;', 1772709945),
('alertefoncier-cache-test@example.com|127.0.0.1:timer', 'i:1772709945;', 1772709945);

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_name_unique` (`name`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'logiciel', 'logiciel', '2026-01-29 17:11:24', '2026-01-29 17:11:24'),
(2, 'formation', 'formation', '2026-01-29 17:11:24', '2026-01-29 17:11:24'),
(3, 'template', 'template', '2026-01-29 17:11:24', '2026-01-29 17:11:24'),
(4, 'assistance', 'assistance', '2026-01-29 17:11:24', '2026-01-29 17:11:24');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `montant_total` double NOT NULL,
  `code_transaction` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `statut` enum('en_attente','payee','annulee') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en_attente',
  `date_commande` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `commandes_customer_id_foreign` (`customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id`, `code`, `customer_id`, `montant_total`, `code_transaction`, `statut`, `date_commande`, `created_at`, `updated_at`) VALUES
(1, 'P6M.20260307.0001', 2, 550000, 'NT.20260308000411123.P006', 'en_attente', '2026-03-07 21:36:39', '2026-03-07 21:36:39', '2026-03-08 00:04:11'),
(11, 'DQB.20260308.0001', 2, 50000, 'NT.20260308092934055.P011', 'en_attente', '2026-03-08 00:51:41', '2026-03-08 00:51:41', '2026-03-08 09:29:34');

-- --------------------------------------------------------

--
-- Structure de la table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customers_email_index` (`email`),
  KEY `customers_phone_index` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `customers`
--

INSERT INTO `customers` (`id`, `name`, `last_name`, `email`, `phone`, `adresse`, `password`, `created_at`, `updated_at`) VALUES
(2, 'Akon', NULL, 'akonperso@gmail.com', '+225 0708646346', 'Songon - Institut pasteur', '$2y$12$gELmVPy4U.hD.CTHiCmCi.fEegdFz6vNisYfhnKWeADCkFimeZ.Ee', '2026-03-07 18:06:16', '2026-03-07 22:43:50');

-- --------------------------------------------------------

--
-- Structure de la table `customer_types`
--

DROP TABLE IF EXISTS `customer_types`;
CREATE TABLE IF NOT EXISTS `customer_types` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customer_types_name_unique` (`name`),
  UNIQUE KEY `customer_types_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `customer_types`
--

INSERT INTO `customer_types` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'promoteur', 'promoteur', '2026-01-29 17:11:24', '2026-01-29 17:11:24'),
(2, 'gestionnaire', 'gestionnaire', '2026-01-29 17:11:24', '2026-01-29 17:11:24'),
(3, 'commercial', 'commercial', '2026-01-29 17:11:24', '2026-01-29 17:11:24'),
(4, 'investisseur', 'investisseur', '2026-01-29 17:11:24', '2026-01-29 17:11:24');

-- --------------------------------------------------------

--
-- Structure de la table `documentations`
--

DROP TABLE IF EXISTS `documentations`;
CREATE TABLE IF NOT EXISTS `documentations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('pdf','link','markdown','video','faq') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'link',
  `url` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `documentations_product_id_foreign` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `documentations`
--

INSERT INTO `documentations` (`id`, `product_id`, `title`, `type`, `url`, `content`, `active`, `created_at`, `updated_at`) VALUES
(1, 4, 'Manuel d\'utilisation', 'pdf', '/docs/manuel-utilisation.pdf', NULL, 1, '2026-01-30 14:23:13', '2026-01-30 14:23:13'),
(2, 4, 'Démonstration vidéo', 'video', 'https://www.youtube.com/watch?v=demo', NULL, 1, '2026-01-30 14:23:13', '2026-01-30 14:23:13'),
(3, 4, 'Guide de prise en main', 'markdown', NULL, '## Introduction\n\nCe guide explique les premières étapes d\'utilisation du service.', 1, '2026-01-30 14:23:13', '2026-01-30 14:23:13');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `features`
--

DROP TABLE IF EXISTS `features`;
CREATE TABLE IF NOT EXISTS `features` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `sort_order` int UNSIGNED NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `features_product_id_foreign` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `features`
--

INSERT INTO `features` (`id`, `product_id`, `title`, `description`, `sort_order`, `active`, `created_at`, `updated_at`) VALUES
(1, 4, 'Recherche d\'opportunités foncières', NULL, 1, 1, '2026-01-30 14:15:43', '2026-01-30 14:23:18'),
(2, 4, 'Vérification des parcelles', NULL, 2, 1, '2026-01-30 14:15:43', '2026-01-30 14:23:18'),
(3, 4, 'Évaluation des coûts de projet', NULL, 3, 1, '2026-01-30 14:15:43', '2026-01-30 14:23:18'),
(4, 4, 'Suivi administratif des dossiers', NULL, 4, 1, '2026-01-30 14:15:43', '2026-01-30 14:23:18'),
(5, 4, 'Support technique 24/7 et mises à jour', NULL, 5, 1, '2026-01-30 14:15:43', '2026-01-30 14:23:18');

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_27_223037_create_categories_table', 1),
(5, '2026_01_27_223802_create_customers_table', 1),
(6, '2026_01_27_231717_create_orders_table', 1),
(7, '2026_01_27_232636_create_payments_table', 1),
(8, '2026_01_29_165850_create_customer_types_table', 1),
(9, '2026_01_29_170012_create_products_table', 1),
(10, '2026_01_29_170250_create_order_items_table', 1),
(11, '2026_01_29_170436_create_features_table', 1),
(12, '2026_01_29_170437_create_documentations_table', 1),
(13, '2026_03_05_211808_create_panier_table', 2);

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint UNSIGNED DEFAULT NULL,
  `transaction_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_status` enum('pending','accepted','failed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_method` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_transaction_id_unique` (`transaction_id`),
  KEY `orders_customer_id_foreign` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `price_at_moment` decimal(10,2) DEFAULT NULL,
  `quantity` int UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_items_order_id_product_id_unique` (`order_id`,`product_id`),
  KEY `order_items_product_id_foreign` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `paiements`
--

DROP TABLE IF EXISTS `paiements`;
CREATE TABLE IF NOT EXISTS `paiements` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `commande_id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `token` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_transaction` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_paiement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `montant` double NOT NULL,
  `telephone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mode_paiement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `statut` enum('en_attente','succes','echec') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en_attente',
  `date_paiement` date DEFAULT NULL,
  `heure_paiement` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `paiements_commande_id_foreign` (`commande_id`),
  KEY `paiements_customer_id_foreign` (`customer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint UNSIGNED DEFAULT NULL,
  `session_id` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `commande_id` int DEFAULT NULL,
  `quantite` int NOT NULL DEFAULT '1',
  `prix_unitaire` double NOT NULL,
  `statut` enum('panier','commande') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'panier',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `panier_customer_id_index` (`customer_id`),
  KEY `panier_session_id_index` (`session_id`),
  KEY `panier_product_id_index` (`product_id`),
  KEY `commande_id` (`commande_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id`, `customer_id`, `session_id`, `product_id`, `commande_id`, `quantite`, `prix_unitaire`, `statut`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 7, NULL, 2, 250000, 'commande', '2026-03-07 19:49:43', '2026-03-07 21:36:39'),
(2, 2, NULL, 1, NULL, 2, 25000, 'commande', '2026-03-07 19:49:43', '2026-03-07 21:36:39'),
(6, 2, NULL, 1, NULL, 1, 25000, 'panier', '2026-03-07 19:49:43', '2026-03-08 09:32:41'),
(7, 2, NULL, 3, NULL, 1, 150000, 'panier', '2026-03-08 02:04:40', '2026-03-08 09:32:41'),
(8, 2, NULL, 2, NULL, 1, 0, 'panier', '2026-03-08 02:43:18', '2026-03-08 09:32:41');

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` bigint UNSIGNED NOT NULL,
  `customer_type_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_desc` text COLLATE utf8mb4_unicode_ci,
  `long_desc` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_customer_type_id_foreign` (`customer_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `category_id`, `customer_type_id`, `name`, `short_desc`, `long_desc`, `image`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 'SUIT FONCIER', 'Solution intégrée pour la gestion foncière professionnelle, de la recherche à l\'administratif.', 'SUIT FONCIER est une solution complète destinée aux lotisseurs, aménageurs et géomètres. Il simplifie les processus administratifs, techniques et juridiques. Il aide à la recherche d\'opportunités, à la vérification des parcelles par rapport aux servitudes d\'urbanisme, à l\'évaluation des coûts et au suivi des dossiers.', 'produits/GZgNyiCFy8oWLzKUyaNae5xSfetOUZ7AZ3Ev41WJ.jpg', 1, '2026-01-29 17:20:42', '2026-02-04 13:54:41'),
(2, 2, 1, 'Masterclass Promotion Immobilière', 'Formation avancée sur la gestion et l\'optimisation des projets de promotion.', 'Cette masterclass est une immersion complète dans le monde de la promotion immobilière. Elle couvre l\'ensemble des étapes, de la conception à la vente, en passant par le financement et la gestion des risques.', 'produits/kKIXuOlpDcImMTkf0vtsddqK7gBEq78gWt02MTDR.jpg', 1, '2026-01-29 17:20:42', '2026-02-04 13:54:41'),
(3, 3, 3, 'Accompagnement Achat & Vente', 'Conseils experts pour l\'achat et la vente de biens immobiliers.', 'Que vous soyez un acheteur à la recherche de la meilleure affaire ou un vendeur qui souhaite maximiser son profit, notre équipe d\'experts vous accompagne à chaque étape du processus.', 'produits/GZgNyiCFy8oWLzKUyaNae5xSfetOUZ7AZ3Ev41WJ.jpg', 1, '2026-01-29 17:20:42', '2026-02-04 13:54:41'),
(4, 4, 1, 'Assistance Juridique & Administrative', 'Assistance pour l\'obtention et la vérification de documents officiels.', 'Ce package vous offre une expertise complète pour sécuriser vos démarches administratives. Nous vous assistons pour tous les documents nécessaires à vos projets, des agréments aux titres de propriété.', 'produits/GZgNyiCFy8oWLzKUyaNae5xSfetOUZ7AZ3Ev41WJ.jpg', 1, '2026-01-29 17:20:42', '2026-02-04 13:54:41'),
(5, 1, 2, 'GESPAT', 'Logiciel de gestion intégrée pour optimiser la gestion locative et immobilière.', 'GESPAT est une solution tout-en-un pour les propriétaires, investisseurs et professionnels de la gestion locative. Son interface intuitive vous permet de gérer efficacement vos biens, les locataires, les loyers et les contrats.', NULL, 1, NULL, NULL),
(6, 3, 2, 'Pack de Courriers de Demande', 'Modèles de courriers administratifs pour toutes vos démarches.', 'Ce pack contient des modèles de courriers professionnels pour diverses démarches administratives. Que ce soit pour une demande de permis, une notification ou une mise en demeure, vous avez le bon document à portée de main.', NULL, 1, NULL, NULL),
(7, 1, 3, 'LOTIGES: Commercialisation & CRM', 'Visualisation graphique, gestion des ventes et des contrats de réservation des lots.', 'Ce module est un outil indispensable pour les professionnels de la vente de biens immobiliers. Il permet de visualiser en temps réel l\'état des lots (réservés, libres), de gérer les ventes et de suivre les contrats de réservation, offrant un tableau de bord complet pour le suivi commercial.', 'produits/kKIXuOlpDcImMTkf0vtsddqK7gBEq78gWt02MTDR.jpg', 1, NULL, NULL),
(8, 3, 3, 'Modèles de Contrats de Réservation', 'contrats de réservation pour vos ventes immobilières.', 'Sécurisez vos transactions avec nos modèles de contrats de réservation professionnels. Conformes à la législation en vigueur, ils sont conçus pour protéger les deux parties et simplifier le processus de vente.', NULL, 1, NULL, NULL),
(9, 3, 3, 'Fiches d\'Adhésion et de Financement', 'Modèles de fiches pour l\'adhésion client et le plan de financement de projets.', 'Optimisez la gestion de vos clients et le suivi financier de vos projets avec nos modèles de fiches prêts à l\'emploi. Conçus par des experts, ils sont faciles à utiliser et personnalisables.', NULL, 1, NULL, NULL),
(10, 2, 3, 'Pack de Formations', 'Formations pour Managers, Équipes Commerciales, et Développeurs Fonciers.', 'Ce package regroupe nos formations les plus demandées pour les professionnels de l\'immobilier. Que vous soyez un manager cherchant à optimiser votre organisation ou un commercial qui veut booster ses ventes, nos formations sont conçues pour vous.', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('vyVoXlSkZxsuDxfHgmnW7XjWfdhQDhEgwqN7kXdC', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNHQ0NVZOSTRRUmd3NWlsY2t4cVFWcjdDWUVCNWllQ3JrS3liM2ZXeiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjEvYWxlcnRlZm9uY2llciI7czo1OiJyb3V0ZSI7czoxNDoicHJvZHVjdHMuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1772967843);

-- --------------------------------------------------------

--
-- Structure de la table `subscription_type`
--

DROP TABLE IF EXISTS `subscription_type`;
CREATE TABLE IF NOT EXISTS `subscription_type` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `product_id` bigint UNSIGNED NOT NULL,
  `type` enum('ANNUEL','MENSUEL') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `titre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `achat_unique` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `subscription_type`
--

INSERT INTO `subscription_type` (`id`, `product_id`, `type`, `titre`, `price`, `description`, `achat_unique`, `created_at`, `updated_at`) VALUES
(1, 1, 'MENSUEL', 'Abonnement mensuel', '25000.00', '- Jusqu\'à 10 biens\n- Support technique', 0, '2026-02-04 14:05:59', '2026-02-04 14:05:59'),
(2, 1, 'ANNUEL', 'Abonnement annuel (15% de réduction)', '255000.00', '- Jusqu\'à 10 biens\n- Support technique', 0, '2026-02-04 14:05:59', '2026-02-04 14:05:59'),
(3, 3, 'ANNUEL', 'Achat unique', '150000.00', '- Analyse du besoin\n- Conseils personnalisés\n- Suivi complet', 1, '2026-02-04 19:27:37', '2026-02-04 19:27:37'),
(4, 10, 'MENSUEL', 'Achat par participant', '0.00', '- Accès complet à la session\r\n- Matériel de cours inclus', 1, NULL, NULL),
(9, 5, 'MENSUEL', 'Abonnement mensuel', '25000.00', '- Jusqu\'à 10 biens\r\n- Support technique', 0, NULL, NULL),
(10, 5, 'ANNUEL', 'Abonnement annuel (15% de réduction)', '0.00', '- Jusqu\'à 10 biens\r\n- Support technique', 0, NULL, NULL),
(11, 7, 'ANNUEL', 'Abonnement Annuel', '250000.00', '- Mises à jour incluses\r\n- Support technique\r\n- 1 utilisateur', 0, NULL, NULL),
(12, 6, 'ANNUEL', 'Achat unique', '30000.00', '- Téléchargement instantané\r\n- Formats Word/PDF', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `temoignages`
--

DROP TABLE IF EXISTS `temoignages`;
CREATE TABLE IF NOT EXISTS `temoignages` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint NOT NULL,
  `titre` varchar(55) NOT NULL,
  `contenue` varchar(255) NOT NULL,
  `notation` int DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `temoignages`
--

INSERT INTO `temoignages` (`id`, `customer_id`, `titre`, `contenue`, `notation`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 'logiscos', 'tres bon logiciel', 1, 1, '2026-01-30 23:53:54', '2026-02-04 15:14:47'),
(2, 1, 'SIGFU', 'EXCELLENTE APPLICATION', 4, 1, '2026-02-04 15:52:25', '2026-02-04 15:52:25'),
(3, 1, 'alert foncier', 'Grâce au guide d\'investissement et aux conseils d\'Alerte Foncier, j\'ai pu sécuriser mon premier achat sans aucun problème. Un service de qualité !', 5, 1, '2026-02-04 19:47:00', '2026-02-04 19:47:00');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', '2026-01-29 17:20:42', '$2y$12$nSbi0tReckSXB0K6ttEMuOMbjF/BUMn7gi2WibfwsxyMy7KpEvQLy', 'GkB3guhd5C', '2026-01-29 17:20:42', '2026-01-29 17:20:42'),
(3, 'coolio', 'coolio@test.sol', NULL, '$2y$12$BW8Sdl4AfY3lrKnt55VEU.vPSSxbdQL6lMf3jwRTV8b2PY4uIYY6K', NULL, '2026-02-01 00:08:59', '2026-02-01 00:08:59'),
(4, 'Paul Akon', 'admin@example.com', NULL, '$2y$12$r1ngdmMrJzPtVTqQZOwfou3m85jv3cF5bP851oNzdTVZDZeowD3yC', NULL, '2026-01-31 12:46:08', '2026-01-31 12:46:08'),
(5, 'akon', 'nano@gmail.com', NULL, '$2y$12$Jst28RTC5XQ2Mg3dYgKEMe7FCtiJ6ns/ahxzw1l6cgKXNSr7dEb0G', NULL, '2026-03-05 11:44:53', '2026-03-05 11:44:53');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `documentations`
--
ALTER TABLE `documentations`
  ADD CONSTRAINT `documentations_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `features`
--
ALTER TABLE `features`
  ADD CONSTRAINT `features_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_customer_type_id_foreign` FOREIGN KEY (`customer_type_id`) REFERENCES `customer_types` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
