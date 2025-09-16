-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 16, 2025 at 04:29 AM
-- Server version: 9.3.0
-- PHP Version: 8.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tenantclient1`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `earnings`
--

CREATE TABLE `earnings` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `sale_id` bigint UNSIGNED NOT NULL,
  `commission_rate` decimal(5,2) NOT NULL,
  `sale_amount` decimal(15,2) NOT NULL,
  `commission_amount` decimal(15,2) NOT NULL,
  `status` enum('pending','paid','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `earned_date` date NOT NULL,
  `paid_date` date DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `start_date_time` datetime NOT NULL,
  `end_date_time` datetime NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `description`, `start_date_time`, `end_date_time`, `location`, `created_at`, `updated_at`) VALUES
(3, 'gone', 'eeebbe', '2025-07-20 09:00:00', '2025-07-27 09:01:00', 'warri', '2025-07-17 16:24:37', '2025-07-19 11:46:24');

-- --------------------------------------------------------

--
-- Table structure for table `event_bookings`
--

CREATE TABLE `event_bookings` (
  `id` bigint UNSIGNED NOT NULL,
  `event_id` bigint UNSIGNED DEFAULT NULL,
  `event_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `how_heard` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inviter_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inviter_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `referred_by_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `generated_reports`
--

CREATE TABLE `generated_reports` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `file_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metadata` json DEFAULT NULL,
  `status` enum('generating','completed','failed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'generating',
  `generated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `home_section`
--

CREATE TABLE `home_section` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` json NOT NULL,
  `is_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_section`
--

INSERT INTO `home_section` (`id`, `name`, `data`, `is_enabled`, `created_at`, `updated_at`) VALUES
(1, 'hero', '{\"hero_banner\": \"public/hero_banners/idUG4pqltoo6DE4GLUz2rhgNU3QHWagJz1x99un9.jpg\", \"carousel_count\": 2, \"carousel_items\": [{\"id\": \"undefined\", \"cta_button\": \"Explore Listings\", \"hero_title\": \"Your gateway to secure real estate\", \"signature_img\": \"/storage/carousel_images/hc_68a0a8ec06ed0.jpg\", \"signature_writeup\": \"Verified Lands & Properties\"}, {\"id\": \"1755356805269\", \"cta_button\": \"Contact Us\", \"hero_title\": \"Find Your Perfect Plot or Elegant Home\", \"signature_img\": \"/storage/carousel_images/hc_68a0a8ec08b75.png\", \"signature_writeup\": \"Buy or Sell with Confidence\"}]}', 1, '2025-07-18 13:19:47', '2025-08-16 14:51:08'),
(2, 'latest for sale', '{\"label\": \"Latest For Sale\", \"limit\": \"4\", \"title\": \"Latest For Sale\", \"selected\": [\"5\", {\"added_at\": \"2025-08-06 16:53:55\", \"property_id\": 1}, {\"added_at\": \"2025-08-06 16:53:58\", \"property_id\": 2}]}', 1, '2025-07-18 13:22:11', '2025-08-06 16:58:17'),
(3, 'featured', '{\"limit\": \"6\", \"title\": \"Featured Property\", \"selected\": [{\"added_at\": \"2025-08-03 16:16:46\", \"property_id\": 3}, {\"added_at\": \"2025-08-06 14:42:11\", \"property_id\": 5}, {\"added_at\": \"2025-08-06 14:42:15\", \"property_id\": 6}, {\"added_at\": \"2025-08-06 15:19:47\", \"property_id\": 4}, {\"added_at\": \"2025-08-06 15:20:09\", \"property_id\": 7}, {\"added_at\": \"2025-08-08 11:02:32\", \"property_id\": 9}], \"selected_properties\": []}', 1, '2025-07-18 14:46:47', '2025-08-16 13:24:50'),
(4, 'testimonials', '{\"items\": [{\"id\": \"t_689ead893862f\", \"name\": \"Chuks\", \"image\": \"/storage/testimonials/689f0a3bebe74.png\", \"description\": \"Professional, reliable, and truly caring – they made finding my dream home stress-free\", \"_resolved_image\": \"http://client1.central.test/storage/tenantclient1/testimonials/689f0a3bebe74.png\"}, {\"id\": \"t_68a05fcf96f4c\", \"name\": \"Jane\", \"image\": \"/storage/testimonials/68a05fcf96f77.png\", \"description\": \"Great customer service\", \"_resolved_image\": \"http://client1.central.test/storage/tenantclient1/testimonials/68a05fcf96f77.png\"}], \"limit\": \"2\"}', 1, '2025-07-19 14:19:17', '2025-08-16 13:24:19'),
(6, 'cities', '{\"cities\": [\"Asaba\", \"Ughelli\"]}', 1, '2025-07-19 16:10:34', '2025-08-16 13:23:25'),
(7, 'properties', '{\"limit\": 6, \"selected\": [{\"added_at\": \"2025-08-06 19:58:25\", \"property_id\": 3}, {\"added_at\": \"2025-08-06 20:03:33\", \"property_id\": 2}, {\"added_at\": \"2025-08-07 14:38:28\", \"property_id\": 1}], \"selected_properties\": []}', 1, '2025-08-06 16:47:23', '2025-08-16 13:24:48'),
(8, 'realtor', '{\"limit\": \"4\", \"title\": \"Realtors\", \"selected\": [{\"realtor_id\": 3}, {\"realtor_id\": 2}]}', 1, '2025-08-08 08:19:53', '2025-08-16 13:23:47');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `landing_pages`
--

CREATE TABLE `landing_pages` (
  `id` bigint UNSIGNED NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `property_id` bigint UNSIGNED NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_06_26_151456_create_events_table', 1),
(5, '2025_06_26_164737_create_event_bookings_table', 1),
(6, '2025_07_13_122237_create_properties_table', 1),
(7, '2025_07_13_122238_create_landing_pages_table', 1),
(8, '2025_07_13_184711_add_referal_fields_to_users_table', 1),
(9, '2025_07_18_115455_create_home_section_table', 2),
(10, '2025_07_17_131516_create_sales_table', 3),
(11, '2025_07_17_131530_create_sales_templates_table', 3),
(12, '2025_07_17_131541_create_earnings_table', 3),
(13, '2025_07_17_132505_add_price_to_properties_table', 3),
(14, '2025_07_17_142747_create_wallets_table', 3),
(15, '2025_07_17_142814_create_transactions_table', 3),
(16, '2025_07_17_155941_add_referral_id_to_sales_table', 3),
(17, '2025_07_17_161856_add_personal_details_to_users_table', 3),
(18, '2025_07_17_164416_create_payment_plans_table', 3),
(19, '2025_07_17_164457_create_payment_installments_table', 3),
(20, '2025_07_17_164535_add_payment_plan_to_sales_table', 3),
(21, '2025_07_17_231453_create_property_inspections_table', 3),
(22, '2025_07_17_231528_add_property_details_to_properties_table', 4),
(23, '2025_07_18_000000_create_generated_reports_table', 4),
(24, '2025_07_29_082900_add_user_id_to_properties_table', 5),
(25, '2025_08_05_100013_create_realtors_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_installments`
--

CREATE TABLE `payment_installments` (
  `id` bigint UNSIGNED NOT NULL,
  `sale_id` bigint UNSIGNED NOT NULL,
  `payment_plan_id` bigint UNSIGNED NOT NULL,
  `installment_number` int NOT NULL,
  `amount_due` decimal(15,2) NOT NULL,
  `amount_paid` decimal(15,2) NOT NULL DEFAULT '0.00',
  `late_fee` decimal(15,2) NOT NULL DEFAULT '0.00',
  `due_date` date NOT NULL,
  `paid_date` date DEFAULT NULL,
  `status` enum('pending','paid','overdue','partially_paid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_reference` text COLLATE utf8mb4_unicode_ci,
  `payment_details` json DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_plans`
--

CREATE TABLE `payment_plans` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `duration_months` int NOT NULL,
  `interest_rate` decimal(5,2) NOT NULL DEFAULT '0.00',
  `installments_count` int NOT NULL DEFAULT '1',
  `down_payment_percentage` decimal(5,2) NOT NULL DEFAULT '0.00',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `terms_conditions` json DEFAULT NULL,
  `grace_period_days` int NOT NULL DEFAULT '0',
  `late_fee_percentage` decimal(5,2) NOT NULL DEFAULT '5.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `property_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'house',
  `listing_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'sale',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'available',
  `description` text COLLATE utf8mb4_unicode_ci,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Nigeria',
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `bedrooms` int DEFAULT NULL,
  `bathrooms` int DEFAULT NULL,
  `parking_spaces` int DEFAULT NULL,
  `land_size` decimal(10,2) DEFAULT NULL,
  `built_area` decimal(10,2) DEFAULT NULL,
  `year_built` int DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `price_per_sqm` decimal(10,2) DEFAULT NULL,
  `features` json DEFAULT NULL,
  `amenities` json DEFAULT NULL,
  `images` json DEFAULT NULL,
  `videos` json DEFAULT NULL,
  `virtual_tour_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `floor_plan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `listed_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_per_plot` decimal(15,2) NOT NULL DEFAULT '100000.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `user_id`, `name`, `property_type`, `listing_type`, `status`, `description`, `slug`, `address`, `city`, `state`, `postal_code`, `country`, `latitude`, `longitude`, `bedrooms`, `bathrooms`, `parking_spaces`, `land_size`, `built_area`, `year_built`, `price`, `price_per_sqm`, `features`, `amenities`, `images`, `videos`, `virtual_tour_url`, `floor_plan`, `meta_description`, `meta_keywords`, `listed_at`, `expires_at`, `deleted_at`, `image`, `price_per_plot`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Property one', 'house', 'sale', 'available', 'House description', NULL, '10 pti juction', 'Warri', NULL, NULL, 'Nigeria', 12.30000000, 11.40000000, 2, 2, 4, 1000.00, 104.00, 2003, 10000.00, NULL, NULL, NULL, '[\"properties/images/10l9QnGC89AG6dKPjUw8eM4ThP7Z7Jxd9spTurSa.jpg\", \"properties/images/ThDkK9j3dXrDgnvXqQOUjsRtyjiLQQqMSdfHQe8T.jpg\"]', NULL, 'https://tour.com', NULL, 'House description', 'House keywords', '2025-08-14 23:00:00', '2025-08-19 23:00:00', NULL, '/storage/properties/property1.jpg', 100000.00, '2025-07-15 09:50:27', '2025-08-03 10:07:54'),
(2, NULL, 'Property Two', 'house', 'sale', 'available', 'Property Two description', NULL, NULL, 'Abraka', NULL, NULL, 'Nigeria', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/storage/properties/property2.jpg', 100000.00, '2025-07-15 09:50:27', '2025-08-01 08:26:15'),
(3, NULL, 'Property Three', 'house', 'sale', 'available', 'test description', NULL, NULL, 'Agbor', NULL, NULL, 'Nigeria', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5005.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-13 23:00:00', '2025-08-27 23:00:00', NULL, '/storage/properties/property3.jpg', 100000.00, '2025-07-15 09:50:27', '2025-08-01 08:10:12'),
(4, NULL, 'Property Four', 'house', 'sale', 'available', 'Property Four Description', NULL, NULL, 'Asaba', NULL, NULL, 'Nigeria', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/storage/properties/property4.jpg', 100000.00, '2025-07-15 09:50:27', '2025-08-01 08:10:33'),
(5, NULL, 'Property Five', 'house', 'sale', 'available', 'House description done', NULL, NULL, 'Ughelli', NULL, NULL, 'Nigeria', NULL, NULL, 1, 4, NULL, 100.00, 105.00, NULL, 200.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-20 23:00:00', NULL, NULL, '/storage/properties/property5.jpg', 100000.00, '2025-07-15 09:50:27', '2025-08-01 08:09:59'),
(6, 1, 'Test Property', 'house', 'sale', 'available', 'This is a test property', 'test-property', NULL, NULL, NULL, NULL, 'Nigeria', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-29 22:10:20', NULL, '2025-07-29 22:10:20', NULL, 100000.00, '2025-07-29 22:10:20', '2025-07-29 22:10:20'),
(7, NULL, 'Test Property no', 'house', 'sale', 'available', 'Test property created ', 'test-property-for-api', NULL, NULL, NULL, NULL, 'Nigeria', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 750000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-29 22:12:32', NULL, '2025-07-29 22:12:32', NULL, 100000.00, '2025-07-29 22:12:32', '2025-07-29 22:12:32'),
(8, 1, 'Property Six', 'errrg', 'eeggrg', 'cdd', 'Test description for house', 'vvvv-slug', 'dcyvcyyc', 'Sapele', 'ffjfj', '4647474', 'NIgeria', 6.52440000, 3.37920000, NULL, 2, 2, 2.00, 2.00, 2000, 2.00, 2.00, '[\"ccgyyyd\", \"wdd77wgud\"]', '[\"susyfsuys\", \"s8s8w88w\", \"dydydyhd\", \"wtwtwt\"]', '[\"properties/images/10l9QnGC89AG6dKPjUw8eM4ThP7Z7Jxd9spTurSa.jpg\", \"properties/images/e34i73yVMG6nx8Umz91RGcnFytU9aIJ1jo09agII.jpg\", \"properties/images/Su394l3MwnEsVjj7mVhG3vAmCQW7eaQ8T6pwWXPz.jpg\", \"properties/images/AHyr83jOuEYQ5EtyjNWby2PcomXbKq5AQkfmfuQx.jpg\"]', '[\"properties/videos/aZj6eCoZ9pUZ24cvMWK6tuTG4CqU2FAsmpDbTUtv.mp4\"]', 'https://test.com', 'properties/floor-plans/pej6qZs8tYcFbmysN8nr1AdGKAp2L0dTjtw02ROa.jpg', 'frgrhhr', 'dyf7d', '2025-07-01 23:00:00', '2025-07-28 23:00:00', NULL, NULL, 2.00, '2025-07-30 16:55:07', '2025-08-01 08:31:08'),
(9, 1, 'Property 9', 'house', 'Sale', 'Active', 'House 9 description', 'House-9-slug', 'No 12 mainland', 'Ikeja', 'Lagos', '10543', 'Nigeria', 12.30000000, 12.20000000, 1, 1, 1, 1.00, 1003.00, 2003, 10000.00, 1.00, '[\"Pool\", \"Security\"]', '[\"Elevator\", \"Parking\"]', '[\"properties/images/bq81i0nOo1FEWIRMfMJ0iuoouCRY9QBAzmJtFkbE.jpg\", \"properties/images/ZKZZoYi8hNxyGrxt7dKVJcXbCJrrbjJ1fJzydon5.jpg\", \"properties/images/rGdTGpEAOmpzKoA2EWB14cuz0H4CCq4gn6A9iveL.jpg\", \"properties/images/MXoj56BfIydpJnaFkY9FZHk39ZFyL82nRIgjs5r9.jpg\", \"properties/images/gBtBsj78CfQ3AgOIe2oPeyMf1JvmqW81IUJMCqmF.jpg\", \"properties/images/H6xF69vRJBvrUdcp7vrNBudSh67CPcRIXN5E5lm2.jpg\"]', '[\"properties/videos/OGD6ePz9xXAtw6xgn7WsQs6oi0voQe9IrNyR1lvY.mp4\"]', 'https://test.com', 'properties/floor-plans/n6BNfuXQXnbWOySNgVNSte2bvCTl5Cp2imLoB8TE.jpg', 'House Meta', 'House Keywords', '2025-08-28 23:00:00', '2025-12-25 23:00:00', NULL, NULL, 1.00, '2025-08-01 12:54:27', '2025-08-01 12:54:27');

-- --------------------------------------------------------

--
-- Table structure for table `property_inspections`
--

CREATE TABLE `property_inspections` (
  `id` bigint UNSIGNED NOT NULL,
  `property_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preferred_date` date NOT NULL,
  `preferred_time` time NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','confirmed','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `realtor_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `realtors`
--

CREATE TABLE `realtors` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_other` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `marital_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marital_status_other` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state_of_origin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lga` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hometown` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `residential_address` text COLLATE utf8mb4_unicode_ci,
  `zip_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `realtors`
--

INSERT INTO `realtors` (`id`, `user_id`, `first_name`, `last_name`, `phone`, `image_url`, `title`, `title_other`, `gender`, `date_of_birth`, `marital_status`, `marital_status_other`, `nationality`, `state_of_origin`, `lga`, `hometown`, `residential_address`, `zip_code`, `description`, `created_at`, `updated_at`, `status`) VALUES
(2, 3, 'Chuks', 'Codm', '09030862539', 'realtors/images/realtor_1754620967_68956427f011f.jpeg', 'Mr', NULL, 'male', '2025-04-11', 'Single', NULL, 'Nigerian', 'Delta', 'Aniocha North', 'Asaba', 'No 12 Asaba', '1000', 'Test realtor add', '2025-08-05 16:38:43', '2025-08-08 08:08:08', 'active'),
(3, 6, 'Dave', 'Cons', '111111111', 'realtors/images/realtor_1754600973_6895160d6ad78.jpg', 'Mr', NULL, 'male', '2025-07-30', 'Married', NULL, 'NIgerian', 'Delta', 'Oshimili South', 'Ibusa', 'no 12 ibusa road', '1000', 'Dave cons a reliable realtor', '2025-08-07 20:09:33', '2025-09-15 09:40:22', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `referral_id` bigint UNSIGNED DEFAULT NULL,
  `client_type` enum('new','existing') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `property_id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_other` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `marital_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marital_status_other` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `occupation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state_of_origin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lga` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hometown` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `residential_address` text COLLATE utf8mb4_unicode_ci,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commercial_plots` int NOT NULL DEFAULT '0',
  `commercial_plots_other` int DEFAULT NULL,
  `residential_plots` int NOT NULL DEFAULT '0',
  `residential_plots_other` int DEFAULT NULL,
  `payment_mode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `next_of_kin_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `next_of_kin_relationship` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `next_of_kin_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `next_of_kin_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `next_of_kin_address` text COLLATE utf8mb4_unicode_ci,
  `subscriber_type` enum('Individual','Organization') COLLATE utf8mb4_unicode_ci NOT NULL,
  `organization_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signatories` json DEFAULT NULL,
  `terms_accepted` tinyint(1) NOT NULL DEFAULT '0',
  `client_signature` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signature_date` date NOT NULL,
  `witness_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `witness_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `witness_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `witness_address` text COLLATE utf8mb4_unicode_ci,
  `witness_signature` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `witness_date` date DEFAULT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `total_amount` decimal(15,2) DEFAULT NULL,
  `amount_paid` decimal(15,2) NOT NULL DEFAULT '0.00',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_plan_id` bigint UNSIGNED DEFAULT NULL,
  `base_amount` decimal(15,2) DEFAULT NULL,
  `interest_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `down_payment` decimal(15,2) NOT NULL DEFAULT '0.00',
  `payment_start_date` date DEFAULT NULL,
  `payment_status` enum('not_started','in_progress','completed','overdue','defaulted') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not_started'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_templates`
--

CREATE TABLE `sales_templates` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `template_data` json NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('HoTFCmzBMvzWJGGZkIxnVutKW5stj7nsBDSkKfL6', 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:143.0) Gecko/20100101 Firefox/143.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWm9YNDVIeENaZkN4NGw1WkNQemdpMUV5UFZsYjJKVEdwOXRyVHNEeCI7czoxMDoiX3RlbmFudF9pZCI7czo3OiJjbGllbnQxIjtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0OToiaHR0cDovL2NsaWVudDEuY2VudHJhbC50ZXN0L21hbmFnZW1lbnQvcHJvcGVydHkvNSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTM6ImxvZ2luX3RlbmFudF81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1757996861),
('SuGecxQFjlF976kL1Yui6iuexOc23yvArqFQ1p4e', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:143.0) Gecko/20100101 Firefox/143.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNWRXeXpJdnFXeEE5bEE5b3N2YVFrRHY0RmtuRWlMT1k0WWpzczBLTSI7czoxMDoiX3RlbmFudF9pZCI7czo3OiJjbGllbnQxIjtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNzoiaHR0cDovL2NsaWVudDEuY2VudHJhbC50ZXN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1757958067),
('X4LsSMAHrjldiYUJUdlClSFIEmdPrBUt7RHBdlCa', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:143.0) Gecko/20100101 Firefox/143.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSEM0cTJWaXVPdEU3V1RIUUxLV1hpYTZObzFYZDVFUGZqUG5BYkhSYSI7czoxMDoiX3RlbmFudF9pZCI7czo3OiJjbGllbnQxIjtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNzoiaHR0cDovL2NsaWVudDEuY2VudHJhbC50ZXN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MzoibG9naW5fdGVuYW50XzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9', 1757946708);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `wallet_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direction` enum('credit','debit') COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `currency` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NGN',
  `status` enum('pending','processing','completed','failed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `description` text COLLATE utf8mb4_unicode_ci,
  `metadata` json DEFAULT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `external_reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transactionable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transactionable_id` bigint UNSIGNED NOT NULL,
  `balance_before` decimal(15,2) NOT NULL,
  `balance_after` decimal(15,2) NOT NULL,
  `processed_at` timestamp NULL DEFAULT NULL,
  `processed_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `failure_reason` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_other` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `marital_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marital_status_other` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `occupation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state_of_origin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lga` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hometown` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `residential_address` text COLLATE utf8mb4_unicode_ci,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `referral_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `referred_by_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `title`, `title_other`, `gender`, `date_of_birth`, `marital_status`, `marital_status_other`, `occupation`, `nationality`, `state_of_origin`, `lga`, `hometown`, `residential_address`, `email_verified_at`, `password`, `type`, `remember_token`, `created_at`, `updated_at`, `phone`, `image_url`, `referral_code`, `referred_by_code`) VALUES
(1, 'client1', 'client1@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$12$eInpcPHd8gHcl.clRTKHiOkS1yqnOQ9USd..vcYTiiSKE3bDmSiY.', 'admin', NULL, '2025-07-15 09:56:53', '2025-07-15 09:56:53', '11111111', 'tenant_client1/users/mS92fxHBdEUQKvtEwslENMBLZpUwr2yd2nvk8Qag.jpg', 'Uron2JqFSP', NULL),
(3, 'Chuks Codm', 'chukscodm@gmail.com', 'Mr', NULL, 'male', '2025-04-11', 'Single', NULL, NULL, 'Nigerian', 'Delta', 'Aniocha North', 'Asaba', 'No 12 Asaba', NULL, '$2y$12$bJ41RHqDbXep.1T2Lw1sCePxRva3cIj7eyBA9zM7iOJgQHQLO.H/G', 'user', NULL, '2025-08-05 16:38:43', '2025-08-08 01:42:47', '09030862539', 'realtors/images/realtor_1754620967_68956427f011f.jpeg', 'J8J5IXNKY3', NULL),
(6, 'Dave Cons', 'davecons@gmail.com', 'Mr', NULL, 'male', '2025-07-30', 'Married', NULL, NULL, 'NIgerian', 'Delta', 'Oshimili South', 'Ibusa', 'no 12 ibusa road', NULL, '$2y$12$7FRdD8b4SpUtcS3UIQPZu.tf.ZVEPEeyj8wPEZV/QkXs4UwmK/5gi', 'realtor', NULL, '2025-08-07 20:09:33', '2025-08-07 20:09:33', '111111111', 'realtors/images/realtor_1754600973_6895160d6ad78.jpg', 'WFK3SZFXVM', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `balance` decimal(15,2) NOT NULL DEFAULT '0.00',
  `available_balance` decimal(15,2) NOT NULL DEFAULT '0.00',
  `pending_balance` decimal(15,2) NOT NULL DEFAULT '0.00',
  `currency` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NGN',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `last_transaction_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `user_id`, `balance`, `available_balance`, `pending_balance`, `currency`, `is_active`, `last_transaction_at`, `created_at`, `updated_at`) VALUES
(2, 3, 0.00, 0.00, 0.00, 'NGN', 1, NULL, '2025-08-05 16:38:43', '2025-08-05 16:38:43'),
(3, 6, 0.00, 0.00, 0.00, 'NGN', 1, NULL, '2025-08-07 20:09:33', '2025-08-07 20:09:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `earnings`
--
ALTER TABLE `earnings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `earnings_user_id_foreign` (`user_id`),
  ADD KEY `earnings_sale_id_foreign` (`sale_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_bookings`
--
ALTER TABLE `event_bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `event_bookings_referral_code_unique` (`referral_code`),
  ADD UNIQUE KEY `event_bookings_event_id_phone_unique` (`event_id`,`phone`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `generated_reports`
--
ALTER TABLE `generated_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `generated_reports_user_id_type_created_at_index` (`user_id`,`type`,`created_at`);

--
-- Indexes for table `home_section`
--
ALTER TABLE `home_section`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `home_section_name_unique` (`name`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `landing_pages`
--
ALTER TABLE `landing_pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `landing_pages_link_unique` (`link`),
  ADD UNIQUE KEY `landing_pages_user_id_property_id_unique` (`user_id`,`property_id`),
  ADD KEY `landing_pages_property_id_foreign` (`property_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_installments`
--
ALTER TABLE `payment_installments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_installments_payment_plan_id_foreign` (`payment_plan_id`),
  ADD KEY `payment_installments_sale_id_status_index` (`sale_id`,`status`),
  ADD KEY `payment_installments_due_date_status_index` (`due_date`,`status`);

--
-- Indexes for table `payment_plans`
--
ALTER TABLE `payment_plans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payment_plans_code_unique` (`code`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `properties_slug_unique` (`slug`),
  ADD KEY `properties_status_listing_type_index` (`status`,`listing_type`),
  ADD KEY `properties_city_state_index` (`city`,`state`),
  ADD KEY `properties_property_type_status_index` (`property_type`,`status`),
  ADD KEY `properties_price_index` (`price`),
  ADD KEY `properties_bedrooms_bathrooms_index` (`bedrooms`,`bathrooms`),
  ADD KEY `properties_listed_at_index` (`listed_at`),
  ADD KEY `properties_user_id_foreign` (`user_id`);

--
-- Indexes for table `property_inspections`
--
ALTER TABLE `property_inspections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_inspections_status_preferred_date_index` (`status`,`preferred_date`),
  ADD KEY `property_inspections_email_index` (`email`),
  ADD KEY `property_inspections_property_id_foreign` (`property_id`),
  ADD KEY `property_inspections_realtor_id_foreign` (`realtor_id`);

--
-- Indexes for table `realtors`
--
ALTER TABLE `realtors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `realtors_phone_unique` (`phone`),
  ADD KEY `realtors_user_id_foreign` (`user_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_user_id_foreign` (`user_id`),
  ADD KEY `sales_property_id_foreign` (`property_id`),
  ADD KEY `sales_referral_id_foreign` (`referral_id`),
  ADD KEY `sales_payment_plan_id_foreign` (`payment_plan_id`);

--
-- Indexes for table `sales_templates`
--
ALTER TABLE `sales_templates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_templates_user_id_created_at_index` (`user_id`,`created_at`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transactions_reference_unique` (`reference`),
  ADD KEY `transactions_transactionable_type_transactionable_id_index` (`transactionable_type`,`transactionable_id`),
  ADD KEY `transactions_wallet_id_created_at_index` (`wallet_id`,`created_at`),
  ADD KEY `transactions_user_id_type_status_index` (`user_id`,`type`,`status`),
  ADD KEY `transactions_status_created_at_index` (`status`,`created_at`),
  ADD KEY `transactions_reference_index` (`reference`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD UNIQUE KEY `users_image_url_unique` (`image_url`),
  ADD UNIQUE KEY `users_referral_code_unique` (`referral_code`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wallets_user_id_unique` (`user_id`),
  ADD KEY `wallets_user_id_is_active_index` (`user_id`,`is_active`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `earnings`
--
ALTER TABLE `earnings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `event_bookings`
--
ALTER TABLE `event_bookings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `generated_reports`
--
ALTER TABLE `generated_reports`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home_section`
--
ALTER TABLE `home_section`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `landing_pages`
--
ALTER TABLE `landing_pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `payment_installments`
--
ALTER TABLE `payment_installments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_plans`
--
ALTER TABLE `payment_plans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `property_inspections`
--
ALTER TABLE `property_inspections`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `realtors`
--
ALTER TABLE `realtors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_templates`
--
ALTER TABLE `sales_templates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `earnings`
--
ALTER TABLE `earnings`
  ADD CONSTRAINT `earnings_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `earnings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event_bookings`
--
ALTER TABLE `event_bookings`
  ADD CONSTRAINT `event_bookings_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `generated_reports`
--
ALTER TABLE `generated_reports`
  ADD CONSTRAINT `generated_reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `landing_pages`
--
ALTER TABLE `landing_pages`
  ADD CONSTRAINT `landing_pages_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `landing_pages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `payment_installments`
--
ALTER TABLE `payment_installments`
  ADD CONSTRAINT `payment_installments_payment_plan_id_foreign` FOREIGN KEY (`payment_plan_id`) REFERENCES `payment_plans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payment_installments_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `property_inspections`
--
ALTER TABLE `property_inspections`
  ADD CONSTRAINT `property_inspections_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `property_inspections_realtor_id_foreign` FOREIGN KEY (`realtor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `realtors`
--
ALTER TABLE `realtors`
  ADD CONSTRAINT `realtors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_payment_plan_id_foreign` FOREIGN KEY (`payment_plan_id`) REFERENCES `payment_plans` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `sales_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_referral_id_foreign` FOREIGN KEY (`referral_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `sales_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales_templates`
--
ALTER TABLE `sales_templates`
  ADD CONSTRAINT `sales_templates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_wallet_id_foreign` FOREIGN KEY (`wallet_id`) REFERENCES `wallets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wallets`
--
ALTER TABLE `wallets`
  ADD CONSTRAINT `wallets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
