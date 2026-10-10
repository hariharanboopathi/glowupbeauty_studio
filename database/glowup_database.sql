-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2026 at 08:43 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `glowup_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_settings`
--

CREATE TABLE `about_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `hero_title` varchar(255) NOT NULL DEFAULT 'The Art of Mindful Beauty',
  `hero_subtitle` text DEFAULT NULL,
  `genesis_eyebrow` varchar(100) NOT NULL DEFAULT 'The Genesis',
  `genesis_title` varchar(255) NOT NULL DEFAULT 'Born From a Reverence For Stillness',
  `genesis_copy1` text DEFAULT NULL,
  `genesis_copy2` text DEFAULT NULL,
  `stat1_value` varchar(50) NOT NULL DEFAULT '7+',
  `stat1_label` varchar(100) NOT NULL DEFAULT 'Years of Mastery',
  `stat2_value` varchar(50) NOT NULL DEFAULT '15K+',
  `stat2_label` varchar(100) NOT NULL DEFAULT 'Radiant Patrons',
  `stat3_value` varchar(50) NOT NULL DEFAULT '850+',
  `stat3_label` varchar(100) NOT NULL DEFAULT 'Certified Alumni',
  `genesis_image` varchar(500) NOT NULL DEFAULT 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=1000&q=80',
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about_settings`
--

INSERT INTO `about_settings` (`id`, `hero_title`, `hero_subtitle`, `genesis_eyebrow`, `genesis_title`, `genesis_copy1`, `genesis_copy2`, `stat1_value`, `stat1_label`, `stat2_value`, `stat2_label`, `stat3_value`, `stat3_label`, `genesis_image`, `updated_at`) VALUES
(1, 'The Art of Mindful Beauty', 'An architectural sanctuary founded to restore biological harmony, empower individual grace, and mentor future masters of the craft.', 'The Genesis', 'Born From a Reverence For Stillness', 'Founded in the cultural heart of Madurai, Glowup was conceived not simply as a salon, but as a temple of rejuvenation where the frenzy of modern pace dissolve into calm luxury.', 'We recognized that true beauty therapy transcends standard cosmetic procedures. It begins with microscopic scalp diagnosis, cellular hydration, non-toxic bio-actives, and deeply restorative touch. Every treatment in our studio is calibrated to enhance your unique structural elegance.', '7+', 'Years of Mastery', '15K+', 'Radiant Patrons', '850+', 'Certified Alumni', 'uploads/about/1790789720_9c0f5e1b52dd0f92ad92.jpeg', '2026-09-30 17:35:20');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `profile_image`, `created_at`, `modified_at`) VALUES
(1, 'Spark_machnistz', 'admin@glowup.com', '$2y$10$ILPy7riST46AxozlumWV9uxWXRSDrAS.y0rl2R6MYoTIZshVvVTpu', 'uploads/avatars/1791032403_67a3dbea0a122d2e6648.jpg', '2026-09-29 08:28:41', '2026-10-03 13:00:03');

-- --------------------------------------------------------

--
-- Table structure for table `automation_rules`
--

CREATE TABLE `automation_rules` (
  `id` int(10) UNSIGNED NOT NULL,
  `event_trigger` varchar(100) NOT NULL,
  `title` varchar(200) NOT NULL,
  `channels` varchar(100) NOT NULL DEFAULT '["email"]',
  `email_template_key` varchar(100) NOT NULL,
  `is_enabled` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `automation_rules`
--

INSERT INTO `automation_rules` (`id`, `event_trigger`, `title`, `channels`, `email_template_key`, `is_enabled`, `created_at`, `updated_at`) VALUES
(1, 'new_booking', 'Instant Booking Confirmation', '[\"email\", \"whatsapp\"]', 'booking_confirmation', 1, '2026-09-30 15:37:50', '2026-09-30 15:37:50'),
(2, 'service_completed', 'Service Completion, Invoice & Review Prompt', '[\"email\"]', 'service_completed', 1, '2026-09-30 15:37:50', '2026-09-30 15:37:50'),
(3, 'booking_reminder_24h', '24-Hour Prior Appointment Reminder', '[\"whatsapp\", \"sms\"]', 'booking_confirmation', 1, '2026-09-30 15:37:50', '2026-09-30 15:37:50');

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(120) NOT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `name`, `slug`, `description`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Haute Bridal Insights', 'haute-bridal-insights', 'Trends, teardrop draping, long-wear matte formulas, and heirloom jewellery coordination.', 1, 1, '2026-09-30 15:12:16', '2026-09-30 15:12:16'),
(3, 'Academy & Masterclasses', 'academy-masterclasses', 'Student spotlight, curriculum announcements, and editorial beauty workshops.', 1, 3, '2026-09-30 15:12:16', '2026-09-30 15:12:16'),
(4, 'teesterr', 'ashwanthtrades', 'heellos', 1, 2, '2026-09-30 16:20:45', '2026-09-30 16:20:45');

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `category_name` varchar(100) NOT NULL DEFAULT 'Artistry Insights',
  `author_name` varchar(100) NOT NULL DEFAULT 'Priya Varma (Creative Director)',
  `summary` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `featured_image` varchar(500) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `views_count` int(11) NOT NULL DEFAULT 0,
  `published_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `title`, `slug`, `category_id`, `category_name`, `author_name`, `summary`, `content`, `featured_image`, `is_featured`, `is_published`, `views_count`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 'The Science of Molecular Keratin: Rebuilding Porous Disulfide Bonds', 'science-molecular-keratin-porous-disulfide-bonds', 2, 'Clinical Skin & Trichology', 'Chef de Beaute Elena', 'Discover how cold-pressed botanical peptides seal hyper-damaged cuticles without flattening natural volume.', '<p>Hair vitality is fundamentally an architectural inquiry into disulfide and hydrogen bonds. At Glowup, our signature molecular smoothing system delivers nanometer-scale keratin precursors directly into the hair cortex...</p>', 'https://images.unsplash.com/photo-1522336572468-97b06e8ef143?w=800&q=80', 1, 1, 342, '2026-09-25 15:12:16', '2026-09-30 15:12:16', '2026-09-30 15:12:16'),
(2, 'Temptu Airbrush vs Traditional HD: Choosing Your Bridal Foundation', 'temptu-airbrush-vs-traditional-hd-bridal-foundation', 1, 'Haute Bridal Insights', 'Priya Varma', 'A comprehensive technical comparison between micro-silicon air dispersion and brush-blended high-pigment creams for South Indian humid climates.', '<p>During high-humidity South Indian weddings, bridal makeup must endure up to 16 hours of temple lights, rituals, and high-resolution camera flashes without separating...</p>', 'images/slide-bridal.jpg', 1, 1, 589, '2026-09-28 15:12:16', '2026-09-30 15:12:16', '2026-09-30 15:12:16');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(10) UNSIGNED NOT NULL,
  `booking_code` varchar(30) NOT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `customer_name` varchar(120) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_phone` varchar(30) NOT NULL,
  `service_id` int(10) UNSIGNED DEFAULT NULL,
  `service_name` varchar(150) NOT NULL,
  `service_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `service_duration` varchar(50) NOT NULL DEFAULT '60 Min',
  `specialist` varchar(100) DEFAULT NULL,
  `booking_date` date NOT NULL,
  `time_slot` varchar(30) NOT NULL,
  `notes` text DEFAULT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'pending',
  `invoice_id` int(10) UNSIGNED DEFAULT NULL,
  `invoice_created` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `booking_code`, `customer_id`, `customer_name`, `customer_email`, `customer_phone`, `service_id`, `service_name`, `service_price`, `service_duration`, `specialist`, `booking_date`, `time_slot`, `notes`, `status`, `invoice_id`, `invoice_created`, `created_at`, `updated_at`) VALUES
(1, 'GLOW-4499F8', NULL, 'Priyanka Ramaswamy', 'priyanka.r@gmail.com', '+91 99401 98765', NULL, 'Hydra Facial Ritual', 3500.00, '75 Min', 'Elena Vance (Master Aesthetician)', '2026-10-01', '11:00 AM', 'Sensitive skin consultation requested.', 'confirmed', NULL, 0, '2026-09-30 08:54:12', '2026-09-30 08:54:12'),
(2, 'GLOW-449A16', NULL, 'Swetha Jayaraman', 'swetha.j@gmail.com', '+91 98402 11223', NULL, 'K-Gloss Hair Smoothing Alchemy', 6200.00, '120 Min', 'Aarav Patel (Senior Trichologist)', '2026-10-02', '02:30 PM', 'First-time smoothing treatment.', 'pending', NULL, 0, '2026-09-29 13:54:12', '2026-09-29 13:54:12'),
(3, 'GLOW-449A20', NULL, 'Kavitha Natarajan', 'kavitha.n@yahoo.com', '+91 97891 33445', NULL, '24K Imperial Gold Facial', 4800.00, '90 Min', 'Kavitha Selvan (Director)', '2026-09-28', '04:00 PM', 'Completed with collagen micro-infusion.', 'completed', NULL, 0, '2026-09-27 13:54:12', '2026-09-28 13:54:12'),
(4, 'BK-20260930-4C56', 13, 'Radhika Singhania', 'radhika_1790784678@luxurypatron.in', '+91 99887 58379', NULL, 'Royal Heritage Temple Bridal Package', 18500.00, '180 mins', 'Elena Vance', '2026-09-30', '04:00 PM', 'High-profile wedding bride. Silk saree draping & gold leaf base.', 'completed', 3, 1, '2026-09-30 16:11:21', '2026-09-30 16:11:22'),
(5, 'BK-20260930-1C64', 14, 'Radhika Singhania', 'radhika_1790784957@luxurypatron.in', '+91 99887 51553', NULL, 'Royal Heritage Temple Bridal Package', 18500.00, '180 mins', 'Elena Vance', '2026-09-30', '04:00 PM', 'High-profile wedding bride. Silk saree draping & gold leaf base.', 'completed', 4, 1, '2026-09-30 16:16:00', '2026-09-30 16:16:01'),
(6, 'BK-20260930-25A0', 15, 'Radhika Singhania', 'radhika_1790785001@luxurypatron.in', '+91 99887 83525', NULL, 'Royal Heritage Temple Bridal Package', 18500.00, '180 mins', 'Elena Vance', '2026-09-30', '04:00 PM', 'High-profile wedding bride. Silk saree draping & gold leaf base.', 'completed', 5, 1, '2026-09-30 16:16:44', '2026-09-30 16:16:45'),
(7, 'BK-20260930-BA88', 16, 'Radhika Singhania', 'radhika_1790785123@luxurypatron.in', '+91 99887 16391', NULL, 'Royal Heritage Temple Bridal Package', 18500.00, '180 mins', 'Elena Vance', '2026-09-30', '04:00 PM', 'High-profile wedding bride. Silk saree draping & gold leaf base.', 'completed', 6, 1, '2026-09-30 16:18:46', '2026-09-30 16:18:47'),
(8, 'GLOW-79982A', 17, 'Sanjana Reddy', 'sanjana.reddy@gmail.com', '+91 99123 44556', NULL, 'Signature Bridal Makeup', 18500.00, '180 Min', 'Priya Chandran (Lead Bridal Couturier)', '2026-10-05', '11:00 AM', 'Traditional South Indian bridal look with fresh jasmine floral styling.', 'completed', 7, 1, '2026-09-30 16:54:31', '2026-09-30 16:54:32'),
(9, 'GLOW-62642D', 17, 'Sanjana Reddy', 'sanjana.reddy@gmail.com', '+91 99123 44556', NULL, 'Signature Bridal Makeup', 18500.00, '180 Min', 'Priya Chandran (Lead Bridal Couturier)', '2026-10-05', '11:00 AM', 'Traditional South Indian bridal look with fresh jasmine floral styling.', 'completed', 8, 1, '2026-09-30 16:57:26', '2026-09-30 16:57:27'),
(10, 'GLOW-F8184D', 17, 'Sanjana Reddy', 'sanjana.reddy@gmail.com', '+91 99123 44556', NULL, 'Signature Bridal Makeup', 18500.00, '180 Min', 'Priya Chandran (Lead Bridal Couturier)', '2026-10-05', '11:00 AM', 'Traditional South Indian bridal look with fresh jasmine floral styling.', 'completed', 9, 1, '2026-09-30 16:58:23', '2026-09-30 16:58:24'),
(11, 'GLOW-355B7A', 17, 'Sanjana Reddy', 'sanjana.reddy@gmail.com', '+91 99123 44556', NULL, 'Signature Bridal Makeup', 18500.00, '180 Min', 'Priya Chandran (Lead Bridal Couturier)', '2026-10-05', '11:00 AM', 'Traditional South Indian bridal look with fresh jasmine floral styling.', 'completed', 10, 1, '2026-09-30 17:09:55', '2026-09-30 17:09:57'),
(12, 'GLOW-CADDCC', 17, 'Sanjana Reddy', 'sanjana.reddy@gmail.com', '+91 99123 44556', NULL, 'Signature Bridal Makeup', 18500.00, '180 Min', 'Priya Chandran (Lead Bridal Couturier)', '2026-10-05', '11:00 AM', 'Traditional South Indian bridal look with fresh jasmine floral styling.', 'completed', 11, 1, '2026-09-30 17:12:12', '2026-09-30 17:12:13'),
(13, 'GLOW-5ABF4E', 20, 'Ananya Sundaram 2200', 'ananya_2200@example.com', '987652200', NULL, 'Haute Royal Bridal Artistry', 15000.00, '180 Minutes', 'Priya Chandran (Lead Bridal Couturier)', '2026-10-05', '11:00 AM', 'Trial session for wedding reception', 'completed', 17, 1, '2026-09-30 18:28:53', '2026-10-03 20:17:48'),
(14, 'GLOW-C88AF3', 23, 'Priya Test', 'priya.test@example.com', '9876543210', NULL, 'Haute Royal Bridal Artistry', 15000.00, '180 Minutes', 'Any Master Specialist', '2026-10-07', '11:00 AM', NULL, 'pending', NULL, 0, '2026-09-30 18:34:04', '2026-09-30 18:34:04'),
(15, 'GLOW-E642FD', 25, 'Ananya Sundaram 4484', 'ananya_4484@example.com', '987654484', NULL, 'Haute Royal Bridal Artistry', 15000.00, '180 Minutes', 'Priya Chandran (Lead Bridal Couturier)', '2026-12-13', '02:00 PM', 'Trial session for wedding reception', 'pending', NULL, 0, '2026-09-30 18:39:10', '2026-09-30 18:39:10'),
(16, 'GLOW-3CEF6A', 26, 'Ananya Sundaram 5480', 'ananya_5480@example.com', '987655480', NULL, 'Haute Royal Bridal Artistry', 15000.00, '180 Minutes', 'Priya Chandran (Lead Bridal Couturier)', '2026-10-29', '02:00 PM', 'Trial session for wedding reception', 'pending', NULL, 0, '2026-09-30 19:17:07', '2026-09-30 19:17:07'),
(17, 'GLOW-0496F8', 27, 'Ananya Sundaram 5546', 'ananya_5546@example.com', '987655546', NULL, 'Haute Royal Bridal Artistry', 15000.00, '180 Minutes', 'Priya Chandran (Lead Bridal Couturier)', '2026-10-23', '02:00 PM', 'Trial session for wedding reception', 'pending', NULL, 0, '2026-09-30 19:17:20', '2026-09-30 19:17:20'),
(18, 'GLOW-D487C4', 29, 'Sujata AutomatedTest', 'sujata.test@example.com', '9876543999', NULL, 'Hydra Facial Ritual', 3500.00, '75 Minutes', 'Any Master Specialist', '2026-10-30', '06:30 PM', NULL, 'pending', NULL, 0, '2026-09-30 19:36:45', '2026-09-30 19:36:45'),
(19, 'GLOW-D1449A', 30, 'Sujata AutomatedTest', 'sujata.1790797212@example.com', '9876541364', NULL, 'Hydra Facial Ritual', 3500.00, '75 Minutes', 'Any Master Specialist', '2026-11-15', '02:00 PM', NULL, 'pending', NULL, 0, '2026-09-30 19:40:13', '2026-09-30 19:40:13'),
(20, 'GLOW-B989BF', 31, 'Senthil Kumar R', 'r.senthilkumar22bca106@gmail.com', '1234567890', NULL, 'Hydra Facial Ritual', 3500.00, '75 Minutes', 'Any Master Specialist', '2026-10-03', '10:00 AM', 'Beverage: Organic Matcha Latte | test', 'completed', 14, 1, '2026-10-03 19:26:03', '2026-10-03 20:10:05'),
(21, 'GLOW-219621', 31, 'Senthil Kumar R', 'r.senthilkumar22bca106@gmail.com', '+919080984655', NULL, 'Precision Thermal Straightening', 3500.00, '150 Minutes', 'Any Master Specialist', '2026-10-03', '11:00 AM', 'Beverage: Organic Matcha Latte | test', 'completed', 13, 1, '2026-10-03 19:34:42', '2026-10-03 20:07:40'),
(22, 'GLOW-490AD2', 33, 'Senthil Kumar R', 'senthil@gmail.com', '1234567890', NULL, 'Precision Thermal Straightening', 3500.00, '150 Minutes', 'Any Master Specialist', '2026-10-16', '12:30 PM', NULL, 'pending', NULL, 0, '2026-10-10 17:46:44', '2026-10-10 17:46:44'),
(23, 'GLOW-59519A', 33, 'Senthil Kumar R', 'senthil@gmail.com', '1234567890', NULL, 'Botox Capillary Reconstruction', 3500.00, '90 Minutes', 'Any Master Specialist', '2026-10-10', '11:00 AM', 'Beverage: Organic Matcha Latte |', 'pending', NULL, 0, '2026-10-10 17:50:13', '2026-10-10 17:50:13'),
(30, 'GLOW-68CC15', 33, 'Senthil Kumar R', 'senthil@gmail.com', '1234567890', NULL, 'Hydra Facial Ritual', 3500.00, '75 Minutes', 'Any Master Specialist', '2026-10-10', '02:00 PM', 'Beverage: Organic Matcha Latte |', 'completed', 18, 1, '2026-10-10 17:58:14', '2026-10-10 18:01:24'),
(31, 'GLOW-3DB930', 33, 'Senthil Kumar R', 'senthil@gmail.com', '+919080984655', NULL, 'Precision Thermal Straightening', 3500.00, '150 Minutes', 'Any Master Specialist', '2026-10-10', '12:30 PM', 'Beverage: Organic Matcha Latte |', 'pending', NULL, 0, '2026-10-10 18:00:35', '2026-10-10 18:00:35'),
(32, 'GLOW-9EF6F5', 31, 'admin', 'admin@demo.com', '1234567890', NULL, 'Precision Thermal Straightening', 3500.00, '150 Minutes', 'Any Master Specialist', '2026-10-10', '10:00 AM', 'Beverage: Organic Matcha Latte |', 'pending', NULL, 0, '2026-10-10 18:36:09', '2026-10-10 18:36:09');

-- --------------------------------------------------------

--
-- Table structure for table `bridal_packages`
--

CREATE TABLE `bridal_packages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `tier` varchar(100) NOT NULL DEFAULT 'Standard',
  `price` decimal(10,2) NOT NULL DEFAULT 25000.00,
  `duration` varchar(100) NOT NULL DEFAULT 'Full Day',
  `description` text DEFAULT NULL,
  `inclusions` text DEFAULT NULL,
  `badge` varchar(100) DEFAULT NULL,
  `image_url` varchar(500) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bridal_packages`
--

INSERT INTO `bridal_packages` (`id`, `title`, `tier`, `price`, `duration`, `description`, `inclusions`, `badge`, `image_url`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Classic Traditional Muhurtham', 'Silver', 18000.00, '4 Hours', 'HD Kryolan/MAC base, traditional Madurai jasmine flower styling, silk saree pleat sculpting, and jewel pinning.', 'HD Waterproof Makeup, Traditional Hair Braiding, Saree Draping, Jewelry Placement', 'Popular', 'https://images.unsplash.com/photo-1583391733956-3750e0ff4e8b?w=800&q=80', 1, 1, '2026-09-30 14:33:56', '2026-09-30 14:33:56'),
(2, 'Haute Royal Airbrush Matrimonial', 'Gold', 32000.00, 'Full Day (2 Looks)', 'Temptu Silicon Airbrush makeup, pre-wedding hydra facial glow session, reception glamour hair sculpt, and dedicated touch-up attendant.', '2 Complete Bridal Looks (Muhurtham + Reception), Temptu Airbrush Base, Pre-Bridal Hydra Facial, Dedicated Assistant', 'Signature', 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=800&q=80', 2, 1, '2026-09-30 14:33:56', '2026-09-30 14:33:56'),
(3, 'The Imperial Empress Concierge', 'Haute Royal', 55000.00, '3-Day Wedding Celebration', 'Complete couture beauty stewardship for Mehendi, Sangeet, Muhurtham, and Grand Reception with senior master artist Maya Sundaram.', '4 Event Makeovers, Senior Master Artist, Full Family Touchups (2 pax), Luxury Body Polish, 24/7 Concierge', 'Luxury VIP', 'https://images.unsplash.com/photo-1610030469983-98e550d6193c?w=800&q=80', 3, 1, '2026-09-30 14:33:56', '2026-09-30 14:33:56');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(150) NOT NULL,
  `slug` varchar(150) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Aesthetic Facials', 'facials', '2026-10-02 16:52:40', '2026-10-02 16:52:40'),
(2, 'Hair Alchemy', 'hair', '2026-10-02 16:52:40', '2026-10-02 16:52:40'),
(3, 'Bridal Couture', 'bridal', '2026-10-02 16:52:40', '2026-10-02 16:52:40'),
(4, 'Nails & Lashes', 'nails', '2026-10-02 16:52:40', '2026-10-02 16:52:40'),
(5, 'Scalp & Wellness', 'wellness', '2026-10-02 16:52:40', '2026-10-02 16:52:40'),
(9, 'test', 'test', '2026-10-03 19:23:48', '2026-10-03 19:23:48');

-- --------------------------------------------------------

--
-- Table structure for table `communication_logs`
--

CREATE TABLE `communication_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `lead_id` int(10) UNSIGNED DEFAULT NULL,
  `recipient_name` varchar(150) NOT NULL,
  `recipient_contact` varchar(150) NOT NULL,
  `channel` varchar(30) NOT NULL DEFAULT 'email',
  `template_key` varchar(100) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message_content` text NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'sent',
  `error_message` text DEFAULT NULL,
  `sent_by_admin` varchar(100) NOT NULL DEFAULT 'Alex Vance',
  `sent_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `communication_logs`
--

INSERT INTO `communication_logs` (`id`, `customer_id`, `lead_id`, `recipient_name`, `recipient_contact`, `channel`, `template_key`, `subject`, `message_content`, `status`, `error_message`, `sent_by_admin`, `sent_at`, `created_at`) VALUES
(1, NULL, NULL, 'Radhika Singhania', '', 'system', NULL, 'Invoice Generated: INV-2026-0004', '', 'sent', NULL, 'Alex Vance', '2026-09-30 16:16:01', '2026-09-30 16:16:01'),
(2, NULL, NULL, 'Radhika Singhania', '', 'system', NULL, 'Payment Received: ₹21,830.00 for Invoice #INV-2026-0004', '', 'sent', NULL, 'Alex Vance', '2026-09-30 16:16:01', '2026-09-30 16:16:01'),
(3, NULL, NULL, 'Radhika Singhania', '', 'system', NULL, 'Invoice Generated: INV-2026-0005', '', 'sent', NULL, 'Alex Vance', '2026-09-30 16:16:45', '2026-09-30 16:16:45'),
(4, NULL, NULL, 'Radhika Singhania', '', 'system', NULL, 'Payment Received: ₹21,830.00 for Invoice #INV-2026-0005', '', 'sent', NULL, 'Alex Vance', '2026-09-30 16:16:46', '2026-09-30 16:16:46'),
(5, NULL, NULL, 'Radhika Singhania', '', 'system', NULL, 'Invoice Generated: INV-2026-0006', '', 'sent', NULL, 'Alex Vance', '2026-09-30 16:18:47', '2026-09-30 16:18:47'),
(6, NULL, NULL, 'Radhika Singhania', '', 'system', NULL, 'Payment Received: ₹21,830.00 for Invoice #INV-2026-0006', '', 'sent', NULL, 'Alex Vance', '2026-09-30 16:18:48', '2026-09-30 16:18:48'),
(7, NULL, NULL, 'Sanjana Reddy', '', 'system', NULL, 'Invoice Generated: INV-2026-0007', '', 'sent', NULL, 'Alex Vance', '2026-09-30 16:54:32', '2026-09-30 16:54:32'),
(8, NULL, NULL, 'Sanjana Reddy', '', 'system', NULL, 'Payment Received: ₹21,830.00 for Invoice #INV-2026-0007', '', 'sent', NULL, 'Alex Vance', '2026-09-30 16:54:33', '2026-09-30 16:54:33'),
(9, NULL, NULL, 'Sanjana Reddy', '', 'system', NULL, 'Invoice Generated: INV-2026-0008', '', 'sent', NULL, 'Alex Vance', '2026-09-30 16:57:27', '2026-09-30 16:57:27'),
(10, NULL, NULL, 'Sanjana Reddy', '', 'system', NULL, 'Payment Received: ₹21,830.00 for Invoice #INV-2026-0008', '', 'sent', NULL, 'Alex Vance', '2026-09-30 16:57:28', '2026-09-30 16:57:28'),
(11, NULL, NULL, 'Sanjana Reddy', '', 'system', NULL, 'Invoice Generated: INV-2026-0009', '', 'sent', NULL, 'Alex Vance', '2026-09-30 16:58:24', '2026-09-30 16:58:24'),
(12, NULL, NULL, 'Sanjana Reddy', '', 'system', NULL, 'Payment Received: ₹21,830.00 for Invoice #INV-2026-0009', '', 'sent', NULL, 'Alex Vance', '2026-09-30 16:58:25', '2026-09-30 16:58:25'),
(13, NULL, NULL, 'Sanjana Reddy', '', 'system', NULL, 'Invoice Generated: INV-2026-0010', '', 'sent', NULL, 'Alex Vance', '2026-09-30 17:09:57', '2026-09-30 17:09:57'),
(14, NULL, NULL, 'Sanjana Reddy', '', 'system', NULL, 'Payment Received: ₹21,830.00 for Invoice #INV-2026-0010', '', 'sent', NULL, 'Alex Vance', '2026-09-30 17:09:58', '2026-09-30 17:09:58'),
(15, NULL, NULL, 'Sanjana Reddy', '', 'system', NULL, 'Invoice Generated: INV-2026-0011', '', 'sent', NULL, 'Alex Vance', '2026-09-30 17:12:13', '2026-09-30 17:12:13'),
(16, NULL, NULL, 'Sanjana Reddy', '', 'system', NULL, 'Payment Received: ₹21,830.00 for Invoice #INV-2026-0011', '', 'sent', NULL, 'Alex Vance', '2026-09-30 17:12:14', '2026-09-30 17:12:14'),
(17, NULL, NULL, 'Senthil Kumar R', '', 'system', NULL, 'Invoice Generated: INV-2026-0001', '', 'sent', NULL, 'Alex Vance', '2026-10-03 20:07:40', '2026-10-03 20:07:40'),
(18, NULL, NULL, 'Senthil Kumar R', '', 'system', NULL, 'Invoice Generated: INV-2026-0002', '', 'sent', NULL, 'Alex Vance', '2026-10-03 20:10:05', '2026-10-03 20:10:05'),
(19, NULL, NULL, 'Senthil Kumar R', '', 'system', NULL, 'Payment Received: ₹4,130.00 for Invoice #INV-2026-0002', '', 'sent', NULL, 'Alex Vance', '2026-10-03 20:10:22', '2026-10-03 20:10:22'),
(20, NULL, NULL, 'test', '', 'system', NULL, 'Payment Received: ₹689.84 for Invoice #INV-2026-0002', '', 'sent', NULL, 'Alex Vance', '2026-10-03 20:11:53', '2026-10-03 20:11:53'),
(21, NULL, NULL, 'test', '', 'system', NULL, 'Payment Received: ₹900.00 for Invoice #INV-2026-0003', '', 'sent', NULL, 'Alex Vance', '2026-10-03 20:14:51', '2026-10-03 20:14:51'),
(22, NULL, NULL, 'test', '', 'system', NULL, 'Payment Received: ₹500.00 for Invoice #INV-2026-0003', '', 'sent', NULL, 'Alex Vance', '2026-10-03 20:15:57', '2026-10-03 20:15:57'),
(23, NULL, NULL, 'Ananya Sundaram 2200', '', 'system', NULL, 'Invoice Generated: INV-2026-0004', '', 'sent', NULL, 'Alex Vance', '2026-10-03 20:17:48', '2026-10-03 20:17:48'),
(24, NULL, NULL, 'Ananya Sundaram 2200', '', 'system', NULL, 'Payment Received: ₹17,700.00 for Invoice #INV-2026-0004', '', 'sent', NULL, 'Alex Vance', '2026-10-03 20:17:56', '2026-10-03 20:17:56'),
(25, NULL, NULL, 'Senthil Kumar R', '', 'system', NULL, 'Invoice Generated: INV-2026-0005', '', 'sent', NULL, 'Alex Vance', '2026-10-10 18:01:24', '2026-10-10 18:01:24');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `duration` varchar(100) NOT NULL DEFAULT '3 Months',
  `level` varchar(100) NOT NULL DEFAULT 'All Levels',
  `badge` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 45000.00,
  `description` text DEFAULT NULL,
  `image_url` varchar(500) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `duration`, `level`, `badge`, `price`, `description`, `image_url`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Master Diploma in Bridal & Fashion Artistry', '6 Months', 'All Levels', 'Flagship Course', 75000.00, 'Complete training in HD Airbrush makeup, South Indian traditional bridal styling, draping, contouring, and international fashion shoot backstage prep.', 'https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?w=800&q=80', 1, 1, '2026-09-30 14:33:56', '2026-09-30 14:33:56'),
(2, 'Advanced Hair Chemistry & Color Alchemy', '3 Months', 'Intermediate', 'Masterclass', 45000.00, 'Trichological porosity diagnostics, molecular keratin formulation, dimensional balayage, and Japanese precision rebonding protocols.', 'https://images.unsplash.com/photo-1562322140-8baeececf3df?w=800&q=80', 2, 1, '2026-09-30 14:33:56', '2026-09-30 14:33:56'),
(3, 'Clinical Cosmetology & Aesthetic Skin Science', '4 Months', 'All Levels', 'CIDESCO Aligned', 55000.00, 'Advanced dermal anatomy, vacuum hydra resurfacing, ultrasonic peeling, chemical exfoliation, and non-invasive bio-lifting technologies.', 'https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?w=800&q=80', 3, 1, '2026-09-30 14:33:56', '2026-09-30 14:33:56'),
(4, 'Professional Nail Architecture & Extensions', '2 Months', 'Beginner to Pro', 'Trending', 30000.00, 'Russian e-file dry manicuring, dual-form polygel sculpting, BIAB apex reinforcement, and luxury minimalist editorial nail art.', 'https://images.unsplash.com/photo-1604654894610-df63bc536371?w=800&q=80', 4, 1, '2026-09-30 14:33:56', '2026-09-30 14:33:56');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `whatsapp_number` varchar(30) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `address` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `tags` varchar(255) DEFAULT 'Patron',
  `lead_source` varchar(100) DEFAULT 'Website',
  `password` varchar(255) DEFAULT NULL,
  `google_id` varchar(100) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `login_provider` varchar(30) NOT NULL DEFAULT 'local',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = Active, 0 = Inactive/Blocked',
  `customer_status` varchar(50) DEFAULT 'active',
  `preferred_services` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `whatsapp_number`, `dob`, `address`, `notes`, `tags`, `lead_source`, `password`, `google_id`, `profile_image`, `login_provider`, `status`, `customer_status`, `preferred_services`, `created_at`, `updated_at`) VALUES
(1, 'Ananya Krishnan', 'ananya@gmail.com', '+91 98765 43210', '+91 98765 43210', '1996-08-14', '42 South Veli Street, Madurai', 'High-profile bride. Prefers matte airbrush base and jasmine garland styling.', 'VIP, Haute Bridal, Regular Patron', 'Instagram', '$2y$10$4J/fel15qRvVN3OTecK6O.gXOgAhLOmG4Fh3jIYBwv1JfxxIwshEa', NULL, NULL, 'local', 1, 'vip', 'Royal Heritage Temple Bride, Keratin Gloss', '2026-08-01 17:51:13', '2026-09-30 17:51:13'),
(2, 'Meera Ramachandran', 'meera.r@gmail.com', '+91 94421 77654', '+91 94421 77654', '1992-11-20', '15 KK Nagar, Madurai', 'Sensitive scalp. Always use sulfate-free organic rinse.', 'Hair Alchemy, Trichology', 'Referral', '$2y$10$4MOSyhNSed37bcJrce7OCe42MsduZMqvPxAGfydPFpCVNrkoT3htS', NULL, NULL, 'local', 1, 'active', 'Japanese Straightening & Scalp Detox', '2026-08-16 17:51:13', '2026-09-30 17:51:13'),
(3, 'Pooja Sundaram', 'pooja.sundaram@gmail.com', '+91 98401 23456', '+91 98401 23456', '1998-04-05', '7 West Masi Street, Madurai', 'Converted lead from Instagram Festive 2026 campaign.', 'Bridal, Converted Lead', 'Instagram Campaign', '$2y$10$0CkPY7vm/PqmmFnvt2GT6.jHjWhyPgUeClu2taRIO0Q07eLz9UFay', NULL, NULL, 'local', 1, 'active', 'Haute Bridal Couture Package', '2026-09-15 17:51:14', '2026-09-30 17:51:13'),
(13, 'Radhika Singhania', 'radhika_1790784678@luxurypatron.in', '+91 99887 58379', '+91 99887 58379', NULL, NULL, 'Converted from Lead #4 (Instagram Campaign). Campaign: Diwali Bridal Showcase 2026. Notes: Looking for 3-day wedding package including muhurtham and sangeet aesthetics.', 'Converted Lead, New Patron', 'Instagram Campaign', '$2y$10$IeR6AGRsRbpIpDYI1fu6FevCId1uZ96JGsjW10sX3VCXbttYY.viO', NULL, NULL, 'local', 1, 'active', 'Royal Heritage Temple Bridal Package', '2026-09-30 16:11:20', '2026-09-30 16:11:20'),
(14, 'Radhika Singhania', 'radhika_1790784957@luxurypatron.in', '+91 99887 51553', '+91 99887 51553', NULL, NULL, 'Converted from Lead #5 (Instagram Campaign). Campaign: Diwali Bridal Showcase 2026. Notes: Looking for 3-day wedding package including muhurtham and sangeet aesthetics.', 'Converted Lead, New Patron', 'Instagram Campaign', '$2y$10$e0ihrvIhStvUQsO/NfXA..8v0fw492OQgPZVC/0szld5Kk0ghfLG.', NULL, NULL, 'local', 1, 'active', 'Royal Heritage Temple Bridal Package', '2026-09-30 16:15:58', '2026-09-30 16:16:01'),
(15, 'Radhika Singhania', 'radhika_1790785001@luxurypatron.in', '+91 99887 83525', '+91 99887 83525', NULL, NULL, 'Converted from Lead #6 (Instagram Campaign). Campaign: Diwali Bridal Showcase 2026. Notes: Looking for 3-day wedding package including muhurtham and sangeet aesthetics.', 'Converted Lead, New Patron', 'Instagram Campaign', '$2y$10$osqcnQ3/u9//Fvc5qDEFwOkRTFyGuN.hHfC5KietoSxGuPpLT0ZJW', NULL, NULL, 'local', 1, 'active', 'Royal Heritage Temple Bridal Package', '2026-09-30 16:16:42', '2026-09-30 16:16:46'),
(16, 'Radhika Singhania', 'radhika_1790785123@luxurypatron.in', '+91 99887 16391', '+91 99887 16391', NULL, NULL, 'Converted from Lead #7 (Instagram Campaign). Campaign: Diwali Bridal Showcase 2026. Notes: Looking for 3-day wedding package including muhurtham and sangeet aesthetics.', 'Converted Lead, New Patron', 'Instagram Campaign', '$2y$10$Lf2RWfGH2FzsU1Q/Ter6LeXhEg86s.jDol0a7IKsDjRMuUoqXwjRq', NULL, NULL, 'local', 1, 'active', 'Royal Heritage Temple Bridal Package', '2026-09-30 16:18:45', '2026-09-30 16:18:48'),
(17, 'Sanjana Reddy (VIP Patron)', 'sanjana.reddy@gmail.com', '+91 99123 44556', '+91 99123 44556', '1996-08-14', 'Villa 42, Palm Meadows, Madurai', NULL, 'Patron', 'Online Booking', '$2y$10$.5kX9ShUJGPUPTtNImAxveLX1wN/HJ6Qmo2/4eE8q4gnagPyG6kHm', NULL, NULL, 'local', 1, 'active', 'Signature Bridal Makeup, Hydra Facials', '2026-09-30 16:54:31', '2026-09-30 17:12:18'),
(18, 'HariHaran B', 'bhariharan741@gmail.com', '8524974685', NULL, NULL, NULL, NULL, 'Patron', 'Website', '$2y$10$5SMLqn/jb0bMy7bZOIVUHOcBsZHC4FD3C620JX5ugz6Nj6zQHGKe6', NULL, NULL, 'local', 1, 'active', NULL, '2026-09-30 17:39:11', '2026-09-30 17:39:11'),
(31, 'Senthil Kumar R', 'r.senthilkumar22bca106@gmail.com', '1234567890', '1234567890', NULL, NULL, NULL, 'Patron', 'Online Booking', '$2y$10$ojxZmFvDIk0mD4l8J5MPyOGYeMXKKQqPvw8fzOPXmB8IneBRNfX/u', NULL, NULL, 'local', 1, 'active', 'Hydra Facial Ritual', '2026-10-03 19:26:03', '2026-10-03 20:10:22'),
(32, 'Priya Patel', 'priya.patel@gmail.com', NULL, NULL, NULL, NULL, NULL, 'Patron', 'Website', NULL, 'google_demo_c5ae6681360521c2aea2066b34c42222', 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=400&q=80', 'google', 1, 'active', NULL, '2026-10-03 19:28:04', '2026-10-03 19:28:04'),
(33, 'Senthil Kumar R', 'senthil@gmail.com', '1234567890', NULL, NULL, NULL, NULL, 'Patron', 'Website', '$2y$10$DIb70do9FC5WkYGvsDFRROZl8bB/u/5epxGSdnRLl/qNUXSlAuVf6', NULL, NULL, 'local', 1, 'active', NULL, '2026-10-10 17:45:11', '2026-10-10 18:01:24');

-- --------------------------------------------------------

--
-- Table structure for table `customer_notes`
--

CREATE TABLE `customer_notes` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `admin_name` varchar(100) NOT NULL DEFAULT 'Alex Vance',
  `note_text` text NOT NULL,
  `is_pinned` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_notes`
--

INSERT INTO `customer_notes` (`id`, `customer_id`, `admin_name`, `note_text`, `is_pinned`, `created_at`) VALUES
(1, 1, 'Priya Varma', 'Client has allergy to synthetic fragrance. Use pure sandalwood and rose extracts only.', 1, '2026-09-30 17:51:13'),
(2, 1, 'Alex Vance', 'Scheduled pre-bridal skin analysis session for next Friday at 10 AM.', 0, '2026-09-30 17:51:13'),
(3, 2, 'Elena Vance', 'Recommended 2-month interval for botanical keratin gloss touchup.', 1, '2026-09-30 17:51:13');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `template_key` varchar(100) NOT NULL,
  `title` varchar(200) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body_html` longtext NOT NULL,
  `variables_hint` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `template_key`, `title`, `subject`, `body_html`, `variables_hint`, `is_active`, `updated_at`) VALUES
(1, 'welcome_email', 'Welcome Email', 'Welcome to {{business_name}}, {{customer_name}}', '<p>Dear {{customer_name}},</p><p>Welcome to <strong>{{business_name}}</strong>. Your sanctuary for bespoke beauty and master academy training is now at your service.</p><p>Warmest regards,<br>The Glowup Team</p>', '{{customer_name}}, {{business_name}}', 1, '2026-09-30 17:59:40'),
(2, 'booking_confirmation', 'Booking Confirmation', 'Appointment Confirmed: {{service_name}} on {{booking_date}}', '<p>Dear {{customer_name}},</p><p>Your appointment for <strong>{{service_name}}</strong> has been confirmed.</p><p><strong>Date:</strong> {{booking_date}}<br><strong>Time:</strong> {{booking_time}}<br><strong>Reference Code:</strong> {{booking_code}}</p><p>We look forward to hosting you!</p>', '{{customer_name}}, {{service_name}}, {{booking_date}}, {{booking_time}}, {{booking_code}}, {{business_name}}', 1, '2026-09-30 17:59:40'),
(3, 'service_completed', 'Service Completed', 'Thank You for Visiting {{business_name}}, {{customer_name}}', '<p>Dear {{customer_name}},</p><p>It was a pleasure serving you for your <strong>{{service_name}}</strong> today.</p><p>Your invoice <strong>{{invoice_number}}</strong> for ₹{{invoice_total}} is available in your patron portal.</p><p>We look forward to welcoming you back soon!</p>', '{{customer_name}}, {{service_name}}, {{invoice_number}}, {{invoice_total}}, {{business_name}}', 1, '2026-09-30 17:59:40'),
(4, 'invoice_created', 'Invoice Created', 'Invoice {{invoice_number}} from {{business_name}}', '<p>Dear {{customer_name}},</p><p>Your invoice <strong>{{invoice_number}}</strong> amounting to <strong>₹{{invoice_total}}</strong> has been generated.</p><p><strong>Balance Due:</strong> ₹{{balance_due}}</p><p>Thank you for choosing {{business_name}}.</p>', '{{customer_name}}, {{invoice_number}}, {{invoice_total}}, {{balance_due}}, {{business_name}}', 1, '2026-09-30 17:59:40'),
(5, 'offer_promotion', 'Offer / Promotion', 'Exclusive Special Privilege for You: {{offer_title}}', '<p>Dear {{customer_name}},</p><p>We are delighted to share an exclusive offer: <strong>{{offer_title}}</strong>.</p><p>{{offer_description}}</p><p>Use coupon code <strong>{{coupon_code}}</strong> upon booking to claim your privilege.</p>', '{{customer_name}}, {{offer_title}}, {{offer_description}}, {{coupon_code}}, {{business_name}}', 1, '2026-09-30 17:59:40'),
(6, 'booking_reminder', 'Booking Reminder', 'Reminder: Your Appointment for {{service_name}} Tomorrow', '<p>Dear {{customer_name}},</p><p>This is a gentle reminder regarding your upcoming appointment for <strong>{{service_name}}</strong> tomorrow at <strong>{{booking_time}}</strong>.</p><p>Location: {{business_name}}, Jubilee Hills, Hyderabad.</p>', '{{customer_name}}, {{service_name}}, {{booking_date}}, {{booking_time}}, {{business_name}}', 1, '2026-09-30 17:59:40'),
(7, 'booking_cancellation', 'Booking Cancellation', 'Booking Cancelled: #{{booking_code}} - {{business_name}}', '<p>Dear {{customer_name}},</p><p>Your appointment for <strong>{{service_name}}</strong> on {{booking_date}} has been cancelled as requested.</p><p>You are welcome to rebook with us anytime at your convenience.</p>', '{{customer_name}}, {{service_name}}, {{booking_date}}, {{booking_code}}, {{business_name}}', 1, '2026-09-30 17:59:40'),
(8, 'invoice_paid', 'Invoice Paid', 'Payment Received for Invoice {{invoice_number}} - {{business_name}}', '<p>Dear {{customer_name}},</p><p>We have successfully received your payment of <strong>₹{{invoice_total}}</strong> for Invoice <strong>{{invoice_number}}</strong>.</p><p>Your receipt is stored in your customer portal. Thank you!</p>', '{{customer_name}}, {{invoice_number}}, {{invoice_total}}, {{business_name}}', 1, '2026-09-30 17:59:40'),
(9, 'invoice_overdue', 'Invoice Overdue', 'Payment Reminder: Overdue Invoice {{invoice_number}}', '<p>Dear {{customer_name}},</p><p>This is a polite reminder that invoice <strong>{{invoice_number}}</strong> with balance due <strong>₹{{balance_due}}</strong> is currently past its scheduled payment date.</p><p>Please settle the outstanding balance at your earliest convenience.</p>', '{{customer_name}}, {{invoice_number}}, {{balance_due}}, {{business_name}}', 1, '2026-09-30 17:59:40'),
(10, 'enquiry_received', 'Enquiry Received', 'Thank You for Reaching Out to {{business_name}}', '<p>Dear {{customer_name}},</p><p>We have received your enquiry regarding our salon and academy offerings. Our team will reach out to you within 24 business hours.</p>', '{{customer_name}}, {{business_name}}', 1, '2026-09-30 17:59:40'),
(11, 'followup_reminder', 'Follow-up Reminder', 'Following Up Regarding Your Beauty Inquiry - {{business_name}}', '<p>Dear {{customer_name}},</p><p>We are following up regarding your interest in <strong>{{service_name}}</strong>. Our specialists would be delighted to assist with any questions or schedule your consultation.</p>', '{{customer_name}}, {{service_name}}, {{business_name}}', 1, '2026-09-30 17:59:40'),
(12, 'academy_enquiry', 'Academy Enquiry', 'Glowup Academy: Course Details & Syllabus', '<p>Dear {{customer_name}},</p><p>Thank you for expressing interest in our professional mastercourses at <strong>Glowup Academy</strong>.</p><p>Our academic counselor will contact you shortly with the complete syllabus and schedule.</p>', '{{customer_name}}, {{business_name}}', 1, '2026-09-30 17:59:40'),
(13, 'bridal_enquiry', 'Bridal Enquiry', 'Your Bespoke Bridal Consultation with {{business_name}}', '<p>Dear {{customer_name}},</p><p>Congratulations on your upcoming celebration! We have received your bridal package inquiry.</p><p>Our senior bridal stylist will connect with you to curate your custom wedding aesthetic lookbook.</p>', '{{customer_name}}, {{business_name}}', 1, '2026-09-30 17:59:40'),
(14, 'password_reset', 'Password Reset', 'Reset Your Password - {{business_name}}', '<p>Dear {{customer_name}},</p><p>We received a request to reset your password. Click the link below to set a new password:</p><p><a href=\"{{reset_url}}\">Reset Password</a></p><p>If you did not request this, please ignore this email.</p>', '{{customer_name}}, {{reset_url}}, {{business_name}}', 1, '2026-09-30 17:59:40');

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `subject` varchar(200) NOT NULL DEFAULT 'General Inquiry',
  `message` text NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'new',
  `admin_notes` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enquiries`
--

INSERT INTO `enquiries` (`id`, `name`, `email`, `phone`, `subject`, `message`, `status`, `admin_notes`, `created_at`, `updated_at`) VALUES
(1, 'Ananya Sundaram', 'ananya.sundaram@gmail.com', '+91 98401 23456', 'Bridal Couture Booking', 'Inquiring about bespoke bridal makeover packages for a wedding on December 14th in Madurai.', 'new', NULL, '2026-09-30 11:54:12', '2026-09-30 11:54:12'),
(2, 'Deepa Krishnan', 'deepa.k@yahoo.com', '+91 97890 54321', 'Academy Admission', 'Would like to know the upcoming batch schedule and fee structure for the Advanced Cosmetology Masterclass.', 'read', NULL, '2026-09-29 13:54:12', '2026-09-29 13:54:12'),
(3, 'Meera Nambiar', 'meera.nambiar@outlook.com', '+91 98200 87654', 'Treatment Reservation', 'Looking to book a 24K Gold Facial and K-Gloss Keratin treatment for this Saturday afternoon.', 'replied', NULL, '2026-09-27 13:54:12', '2026-09-27 13:54:12'),
(4, 'Meera Nambiar', 'meera.nambiar@gmail.com', '+91 98451 22334', 'Bridal Couture Booking', 'Interested in the Couture Royal Bridal Package for my wedding on December 15th.', 'new', NULL, '2026-09-30 16:54:30', '2026-09-30 16:54:30'),
(5, 'Pooja Sundaram', 'pooja.sundaram@gmail.com', '+91 97654 88990', 'Academy Admission: Master Diploma in Bridal Makeup', 'Program: Master Diploma in Bridal Makeup\nBatch: Weekend Master Batch\nExperience: Self-Taught / Practicing Artist\nAspirations: Planning to open a bridal makeover studio in Coimbatore.', 'new', NULL, '2026-09-30 16:54:31', '2026-09-30 16:54:31'),
(6, 'Meera Nambiar', 'meera.nambiar@gmail.com', '+91 98451 22334', 'Bridal Couture Booking', 'Interested in the Couture Royal Bridal Package for my wedding on December 15th.', 'new', NULL, '2026-09-30 16:57:25', '2026-09-30 16:57:25'),
(7, 'Pooja Sundaram', 'pooja.sundaram@gmail.com', '+91 97654 88990', 'Academy Admission: Master Diploma in Bridal Makeup', 'Program: Master Diploma in Bridal Makeup\nBatch: Weekend Master Batch\nExperience: Self-Taught / Practicing Artist\nAspirations: Planning to open a bridal makeover studio in Coimbatore.', 'new', NULL, '2026-09-30 16:57:25', '2026-09-30 16:57:25'),
(8, 'Meera Nambiar', 'meera.nambiar@gmail.com', '+91 98451 22334', 'Bridal Couture Booking', 'Interested in the Couture Royal Bridal Package for my wedding on December 15th.', 'new', NULL, '2026-09-30 16:58:22', '2026-09-30 16:58:22'),
(9, 'Pooja Sundaram', 'pooja.sundaram@gmail.com', '+91 97654 88990', 'Academy Admission: Master Diploma in Bridal Makeup', 'Program: Master Diploma in Bridal Makeup\nBatch: Weekend Master Batch\nExperience: Self-Taught / Practicing Artist\nAspirations: Planning to open a bridal makeover studio in Coimbatore.', 'new', NULL, '2026-09-30 16:58:23', '2026-09-30 16:58:23'),
(10, 'Meera Nambiar', 'meera.nambiar@gmail.com', '+91 98451 22334', 'Bridal Couture Booking', 'Interested in the Couture Royal Bridal Package for my wedding on December 15th.', 'new', NULL, '2026-09-30 17:09:54', '2026-09-30 17:09:54'),
(11, 'Pooja Sundaram', 'pooja.sundaram@gmail.com', '+91 97654 88990', 'Academy Admission: Master Diploma in Bridal Makeup', 'Program: Master Diploma in Bridal Makeup\nBatch: Weekend Master Batch\nExperience: Self-Taught / Practicing Artist\nAspirations: Planning to open a bridal makeover studio in Coimbatore.', 'new', NULL, '2026-09-30 17:09:54', '2026-09-30 17:09:54'),
(12, 'Meera Nambiar', 'meera.nambiar@gmail.com', '+91 98451 22334', 'Bridal Couture Booking', 'Interested in the Couture Royal Bridal Package for my wedding on December 15th.', 'new', NULL, '2026-09-30 17:12:11', '2026-09-30 17:12:11'),
(13, 'Pooja Sundaram', 'pooja.sundaram@gmail.com', '+91 97654 88990', 'Academy Admission: Master Diploma in Bridal Makeup', 'Program: Master Diploma in Bridal Makeup\nBatch: Weekend Master Batch\nExperience: Self-Taught / Practicing Artist\nAspirations: Planning to open a bridal makeover studio in Coimbatore.', 'new', NULL, '2026-09-30 17:12:12', '2026-09-30 17:12:12'),
(14, 'Senthil Kumar R', 'test9@gmail.com', '1234567890', 'Academy Admission: Master Diploma in Bridal Makeup', 'Program: Master Diploma in Bridal Makeup\nBatch: Weekday Morning\nExperience: Beginner\nAspirations: ', 'new', NULL, '2026-10-03 20:01:33', '2026-10-03 20:01:33');

-- --------------------------------------------------------

--
-- Table structure for table `follow_ups`
--

CREATE TABLE `follow_ups` (
  `id` int(10) UNSIGNED NOT NULL,
  `lead_id` int(10) UNSIGNED DEFAULT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `contact_name` varchar(150) NOT NULL,
  `contact_phone` varchar(50) DEFAULT NULL,
  `service_interested` varchar(200) DEFAULT NULL,
  `follow_up_date` date NOT NULL,
  `follow_up_time` varchar(30) NOT NULL DEFAULT '10:00 AM',
  `notes` text DEFAULT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'pending',
  `reminder_sent` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `follow_ups`
--

INSERT INTO `follow_ups` (`id`, `lead_id`, `customer_id`, `contact_name`, `contact_phone`, `service_interested`, `follow_up_date`, `follow_up_time`, `notes`, `status`, `reminder_sent`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Pooja Sundaram', '+91 98401 23456', 'Royal Heritage Temple Bride', '2026-10-01', '11:00 AM', 'Send bridal lookbook catalog & invite for airbrush patch test.', 'pending', 0, '2026-09-30 15:37:50', '2026-09-30 15:37:50'),
(2, 2, NULL, 'Deepika Ranganathan', '+91 97910 88231', 'Diploma in Haute Bridal Artistry', '2026-10-03', '02:30 PM', 'Confirm lab tour appointment & explain installment fee structure.', 'pending', 0, '2026-09-30 15:37:50', '2026-09-30 15:37:50'),
(3, NULL, NULL, 'Radhika Singhania', '+91 99887 58379', 'Bridal Package Consultation', '2026-09-30', '03:00 PM', 'Conduct bespoke bridal lookbook preview.', 'completed', 0, '2026-09-30 16:11:20', '2026-10-03 20:04:14'),
(4, NULL, NULL, 'Radhika Singhania', '+91 99887 51553', 'Bridal Package Consultation', '2026-09-30', '03:00 PM', 'Conduct bespoke bridal lookbook preview.', 'pending', 0, '2026-09-30 16:15:59', '2026-09-30 16:15:59'),
(5, NULL, NULL, 'Radhika Singhania', '+91 99887 83525', 'Bridal Package Consultation', '2026-09-30', '03:00 PM', 'Conduct bespoke bridal lookbook preview.', 'pending', 0, '2026-09-30 16:16:43', '2026-09-30 16:16:43'),
(6, NULL, NULL, 'Radhika Singhania', '+91 99887 16391', 'Bridal Package Consultation', '2026-09-30', '03:00 PM', 'Conduct bespoke bridal lookbook preview.', 'pending', 0, '2026-09-30 16:18:45', '2026-09-30 16:18:45');

-- --------------------------------------------------------

--
-- Table structure for table `footer_links`
--

CREATE TABLE `footer_links` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_name` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `footer_links`
--

INSERT INTO `footer_links` (`id`, `group_name`, `title`, `url`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(2, 'quick_links', 'Services', 'services', 2, 1, '2026-09-29 14:40:28', '2026-10-03 18:51:37'),
(3, 'quick_links', 'About Us', 'about', 3, 1, '2026-09-29 14:40:28', '2026-10-03 18:51:37'),
(4, 'quick_links', 'Academy', 'academy', 4, 1, '2026-09-29 14:40:28', '2026-10-03 18:51:37'),
(5, 'quick_links', 'Gallery', 'gallery', 5, 1, '2026-09-29 14:40:28', '2026-10-03 18:51:37'),
(7, 'quick_links', 'Reviews', 'review', 7, 1, '2026-09-29 14:40:28', '2026-10-03 18:51:37'),
(9, 'popular_treatments', 'Hydra Facial Ritual', 'services', 1, 1, '2026-09-29 14:40:28', '2026-09-29 14:40:28'),
(10, 'popular_treatments', 'Keratin Infusion Therapy', 'services', 2, 1, '2026-09-29 14:40:28', '2026-09-29 14:40:28'),
(11, 'popular_treatments', 'Aesthetic Botox Treatment', 'services', 3, 1, '2026-09-29 14:40:28', '2026-09-29 14:40:28'),
(12, 'popular_treatments', 'Couture Hair Straightening', 'services', 4, 1, '2026-09-29 14:40:28', '2026-09-29 14:40:28'),
(13, 'popular_treatments', 'Silk Hair Smoothing', 'services', 5, 1, '2026-09-29 14:40:28', '2026-09-29 14:40:28'),
(14, 'popular_treatments', 'Bridal Diploma Course', 'academy', 6, 1, '2026-09-29 14:40:28', '2026-09-29 14:40:28'),
(16, 'quick_links', 'Home', '/', 1, 1, '2026-09-29 20:26:00', '2026-10-03 18:51:37'),
(17, 'quick_links', 'Contact', 'contact', 6, 1, '2026-09-29 20:26:58', '2026-10-03 18:51:37'),
(18, 'quick_links', 'Book Online', 'booking', 8, 1, '2026-09-29 20:26:58', '2026-10-03 18:51:37');

-- --------------------------------------------------------

--
-- Table structure for table `footer_settings`
--

CREATE TABLE `footer_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `brand_name` varchar(255) NOT NULL DEFAULT 'Glowup',
  `brand_subtitle` varchar(255) NOT NULL DEFAULT 'Beauty Studio & Academy',
  `brand_logo` varchar(255) DEFAULT NULL,
  `brand_description` text DEFAULT NULL,
  `newsletter_title` varchar(255) NOT NULL DEFAULT 'Private Journal',
  `newsletter_desc` text DEFAULT NULL,
  `newsletter_btn_text` varchar(100) NOT NULL DEFAULT 'Join',
  `concierge_title` varchar(255) NOT NULL DEFAULT 'Academy Concierge',
  `concierge_address` text DEFAULT NULL,
  `concierge_phone` varchar(100) NOT NULL DEFAULT '+91 98200 12345',
  `concierge_whatsapp` varchar(100) DEFAULT '+91 98200 12345',
  `concierge_email` varchar(150) NOT NULL DEFAULT 'glowup@gmail.com',
  `concierge_hours` varchar(255) NOT NULL DEFAULT 'Tue – Sun: 10:00 AM – 8:00 PM',
  `social_instagram` varchar(255) NOT NULL DEFAULT '#',
  `social_pinterest` varchar(255) NOT NULL DEFAULT '#',
  `social_facebook` varchar(255) NOT NULL DEFAULT '#',
  `social_youtube` varchar(255) NOT NULL DEFAULT '#',
  `social_location` varchar(255) NOT NULL DEFAULT '#',
  `copyright_text` varchar(255) NOT NULL DEFAULT '© 2025 Glowup Beauty Studio & Academy. All rights reserved.',
  `additional_text` varchar(255) NOT NULL DEFAULT 'Price varies based on hair length & texture.',
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `footer_settings`
--

INSERT INTO `footer_settings` (`id`, `brand_name`, `brand_subtitle`, `brand_logo`, `brand_description`, `newsletter_title`, `newsletter_desc`, `newsletter_btn_text`, `concierge_title`, `concierge_address`, `concierge_phone`, `concierge_whatsapp`, `concierge_email`, `concierge_hours`, `social_instagram`, `social_pinterest`, `social_facebook`, `social_youtube`, `social_location`, `copyright_text`, `additional_text`, `updated_at`) VALUES
(1, 'Glowup', 'Beauty Studio & Academy', 'uploads/footer/1790958846_632c1465824d5accaf39.png', 'An academy of mindful beauty, bespoke haircare, and transformative aesthetic therapies crafted for your natural radiance.', 'Private Journal', 'Receive curated beauty journals and bespoke privileges.', 'Join', 'Academy Concierge', '5/563,subhashini complex, Sivaganga Rd, Bharathipuram, Karuppayurani, Madurai, Tamil Nadu 625020, India', '+91 78670 07575', '+91 78670 07575', 'glowupbeautystudio@gmail.com', 'Tue – Sun: 10:00 AM – 8:00 PM', '#', '#', '#', '#', '#', '© 2025 Glowup Beauty Studio & Academy. All rights reserved.', 'Price varies based on hair length & texture.', '2026-10-03 18:58:23');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_items`
--

CREATE TABLE `gallery_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL DEFAULT 'bridal',
  `image_url` varchar(500) NOT NULL,
  `description` text DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_before_after` tinyint(1) NOT NULL DEFAULT 0,
  `before_image` varchar(500) DEFAULT NULL,
  `after_image` varchar(500) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery_items`
--

INSERT INTO `gallery_items` (`id`, `title`, `category`, `image_url`, `description`, `is_featured`, `is_before_after`, `before_image`, `after_image`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Royal Heritage Temple Bride', 'bridal', 'images/slide-bridal.jpg', 'Traditional matte airbrush finish with gold temple jewelry and micro-jasmine braiding.', 0, 0, NULL, NULL, 1, 1, '2026-09-30 14:48:15', '2026-09-30 19:16:37'),
(2, 'Glass Hair Molecular Keratin Alignment', 'hair', 'images/slide-hair.jpg', 'High-porosity frizz sealed with cold-pressed botanical keratin and mirror thermal iron.', 0, 0, NULL, NULL, 2, 1, '2026-09-30 14:48:15', '2026-09-30 19:16:36'),
(3, 'Clinical Dermal Hydra Glow', 'facials', 'images/slide-facial.jpg', 'Deep cellular vacuum vortex infusion delivering peptide luminescence.', 0, 0, NULL, NULL, 3, 1, '2026-09-30 14:48:15', '2026-09-30 19:16:34'),
(4, 'Live Masterclass Draping Demo', 'academy', 'images/academy-tour.jpg', 'Dean Priya Varma instructing diploma students on pleated Kanchipuram silk architecture.', 0, 0, NULL, NULL, 4, 1, '2026-09-30 14:48:15', '2026-09-30 14:48:15'),
(5, 'Minimalist Russian BIAB Cuticle Detailing', 'nails', 'https://images.unsplash.com/photo-1604654894610-df63bc536371?w=800&q=80', 'Precision diamond e-file cuticle detailing followed by builder gel reinforcement.', 0, 0, NULL, NULL, 5, 1, '2026-09-30 14:48:15', '2026-09-30 14:48:15');

-- --------------------------------------------------------

--
-- Table structure for table `homepage_sections`
--

CREATE TABLE `homepage_sections` (
  `id` int(10) UNSIGNED NOT NULL,
  `section_key` varchar(50) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `meta_data` text DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `homepage_sections`
--

INSERT INTO `homepage_sections` (`id`, `section_key`, `title`, `subtitle`, `content`, `meta_data`, `updated_at`) VALUES
(1, 'hero', 'Experience True Natural Radiance', 'Luxury personalized aesthetics and molecular alchemy.', NULL, '{\"pill_text\":\"BEAUTY • WELLNESS\",\"primary_btn_text\":\"Book Consultation\",\"primary_btn_url\":\"booking\",\"secondary_btn_text\":\"Explore Services\",\"secondary_btn_url\":\"services\"}', '2026-10-03 17:48:50'),
(2, 'philosophy', 'Beauty, Care & Confidence', 'The Glowup Philosophy', 'Experience personalized beauty treatments delivered with care, expertise and attention to every detail. We believe self-renewal is an essential discipline, not an indulgence.', '{\"secondary_content\":\"Step through arched colonnades sculpted in travertine and warm lavender limestone. Each visit begins with an intimate diagnostic consultation analyzing your hair porosity and dermis health before pairing with organic cold-pressed serums and clinically calibrated therapies.\",\"stat1_value\":\"100%\",\"stat1_label\":\"Bespoke Formulas\",\"stat2_value\":\"14+\",\"stat2_label\":\"Master Artists\",\"stat3_value\":\"4.98\",\"stat3_label\":\"Academy Score\",\"btn_text\":\"Discover Our Story\",\"btn_url\":\"about.html\",\"image_url\":\"https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?w=900&q=80\",\"award_title\":\"Vogue Wellness\",\"award_desc\":\"Best Luxury Wellness Academy 2024\"}', '2026-10-03 17:55:08');

-- --------------------------------------------------------

--
-- Table structure for table `homepage_services`
--

CREATE TABLE `homepage_services` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `price` varchar(50) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(500) DEFAULT NULL,
  `button_text` varchar(100) NOT NULL DEFAULT 'Book Now',
  `button_url` varchar(255) NOT NULL DEFAULT 'booking.html',
  `display_order` int(11) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `homepage_services`
--

INSERT INTO `homepage_services` (`id`, `title`, `category`, `price`, `duration`, `description`, `image_url`, `button_text`, `button_url`, `display_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Hydra Facial Ritual', 'Aesthetic Facial', '₹3,500', '75 Minutes', 'Multi-step resurfacing treatment infusing patented peptides and botanical hydration for an instant, dewy glass-skin luminosity.', 'https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?w=800&q=80', 'Book Now', 'booking', 1, 1, '2026-09-29 10:53:19', '2026-10-03 17:59:07'),
(2, 'Keratin Treatment', 'Hair Alchemy', '₹3,500', '120 Minutes', 'Intensive botanical protein smoothing infusion that eliminates frizz, restores molecular bonds, and locks in mirror shine.', 'https://images.unsplash.com/photo-1595476108010-b4d1f102b1b1?w=800&q=80', 'Book Now', 'booking', 2, 1, '2026-09-29 10:53:19', '2026-09-29 10:53:19'),
(3, 'Botox Treatment', 'Deep Repair', '₹3,500', '90 Minutes', 'Deep-conditioning capillary hair botox formula packed with hyaluronic acid and caviar extract to resurrect damaged strands.', 'https://images.unsplash.com/photo-1519699047748-de8e457a634e?w=800&q=80', 'Book Now', 'booking', 3, 1, '2026-09-29 10:53:19', '2026-09-29 10:53:19'),
(4, 'Hair Straightening', 'Thermal Styling', '₹3,500', '150 Minutes', 'Japanese-inspired precision thermal reconditioning for impeccably sleek, pin-straight hair with silky featherlight movement.', 'https://images.unsplash.com/photo-1560869713-7d0a29430803?w=800&q=80', 'Book Now', 'booking', 4, 1, '2026-09-29 10:53:19', '2026-09-29 10:53:19'),
(5, 'Hair Smoothing', 'Cysteine Ritual', '₹3,500', '120 Minutes', 'Gentle organic cysteine treatment relaxing unruly curls into effortless, manageable, touchably soft satin waves.', 'https://images.unsplash.com/photo-1522336572468-97b06e8ef143?w=800&q=80', 'Book Now', 'booking', 5, 1, '2026-09-29 10:53:19', '2026-09-29 10:53:19');

-- --------------------------------------------------------

--
-- Table structure for table `homepage_slides`
--

CREATE TABLE `homepage_slides` (
  `id` int(10) UNSIGNED NOT NULL,
  `chapter_title` varchar(255) NOT NULL,
  `badge_text` varchar(100) DEFAULT NULL,
  `time_text` varchar(50) DEFAULT NULL,
  `image_url` varchar(500) NOT NULL,
  `display_order` int(11) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `homepage_slides`
--

INSERT INTO `homepage_slides` (`id`, `chapter_title`, `badge_text`, `time_text`, `image_url`, `display_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Chapter I: The Architecture of Radiance', 'Aesthetic Sanctum', '00:01 / 00:05', 'images/academy-tour.jpg', 1, 1, '2026-09-29 10:53:19', '2026-09-29 12:03:35'),
(2, 'Chapter II: Clinical Glass-Skin Radiance', 'Aesthetic Facial', '00:04 / 00:08', 'images/slide-facial.jpg', 2, 1, '2026-09-29 10:53:19', '2026-09-29 10:53:19'),
(3, 'Chapter III: Molecular Hair Alchemy', 'Hair Alchemy', '00:06 / 00:08', 'images/slide-hair.jpg', 3, 1, '2026-09-29 10:53:19', '2026-09-29 10:53:19'),
(4, 'Chapter IV: Haute Royal Bridal Artistry', 'Bridal Couture', '00:08 / 00:08', 'images/slide-bridal.jpg', 4, 1, '2026-09-29 10:53:19', '2026-09-29 10:53:19'),
(5, 'Chapter V: Celestial Evening Glow', 'Evening Ritual', '00:10 / 00:10', 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=800&q=80', 5, 1, '2026-09-29 10:56:12', '2026-09-29 10:56:12'),
(6, 'Test', 'test', '', 'https://static.vecteezy.com/system/resources/thumbnails/065/632/132/small/background-pink-cosmetic-accessories-scattered-across-pastel-makeup-highlighting-sparkling-artistry-and-feminine-beauty-essentials-photo.jpeg', 10, 1, '2026-10-03 17:50:50', '2026-10-03 17:51:21');

-- --------------------------------------------------------

--
-- Table structure for table `integrations_config`
--

CREATE TABLE `integrations_config` (
  `id` int(10) UNSIGNED NOT NULL,
  `provider_key` varchar(50) NOT NULL,
  `provider_name` varchar(100) NOT NULL,
  `config_data` longtext NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'not_configured',
  `last_tested_at` datetime DEFAULT NULL,
  `last_test_result` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `integrations_config`
--

INSERT INTO `integrations_config` (`id`, `provider_key`, `provider_name`, `config_data`, `status`, `last_tested_at`, `last_test_result`, `created_at`, `updated_at`) VALUES
(1, 'whatsapp', 'WhatsApp Business Cloud API (Meta)', '{\"phone_number_id\":\"\",\"business_account_id\":\"\",\"meta_app_id\":\"\",\"meta_app_secret\":\"\",\"access_token\":\"\",\"webhook_verify_token\":\"glowup_meta_webhook_2026\",\"api_version\":\"v19.0\",\"enabled\":false,\"status\":\"not_configured\",\"last_tested_at\":\"2026-09-30 16:18:49\",\"last_test_result\":\"API credentials missing. Please configure Access Token and Phone Number ID.\"}', 'not_configured', '2026-09-30 17:12:24', 'API credentials missing. Please configure Access Token and Phone Number ID.', '2026-09-30 15:37:50', '2026-09-30 17:12:24'),
(2, 'sms', 'SMS Gateway (Twilio / Msg91 / Fast2SMS)', '{\"provider\":\"Fast2SMS\",\"api_url\":\"https:\\/\\/www.fast2sms.com\\/dev\\/bulkV2\",\"api_key\":\"\",\"sender_id\":\"GLOWUP\",\"username\":\"\",\"password\":\"\",\"enabled\":false,\"status\":\"not_configured\",\"last_tested_at\":\"2026-09-30 17:52:38\",\"last_test_result\":\"API Key missing.\"}', 'not_configured', '2026-09-30 17:52:40', 'API Key missing.', '2026-09-30 15:37:50', '2026-09-30 17:52:40'),
(3, 'email_smtp', 'Transactional Email (SMTP / Mailgun / SES)', '{\"smtp_host\":\"smtp.gmail.com\",\"smtp_port\":587,\"smtp_user\":\"\",\"smtp_pass\":\"\",\"smtp_crypto\":\"tls\",\"from_email\":\"concierge@glowup.com\",\"from_name\":\"Glowup Studio & Academy\",\"enabled\":false,\"status\":\"not_configured\",\"last_tested_at\":\"2026-09-30 16:18:50\",\"last_test_result\":\"SMTP Host and Username are required.\"}', 'not_configured', '2026-09-30 17:52:43', 'SMTP Host and Username are required.', '2026-09-30 15:37:50', '2026-09-30 17:52:43'),
(4, 'facebook_meta', 'Meta Lead Ads & Page Sync', '{\"app_id\":\"\",\"app_secret\":\"\",\"page_id\":\"\",\"page_access_token\":\"\",\"webhook_verify_token\":\"glowup_meta_leads_2026\",\"enabled\":false,\"status\":\"not_configured\",\"last_tested_at\":null,\"last_test_result\":null}', 'not_configured', '2026-09-30 17:52:45', 'Meta App ID & Secret missing.', '2026-09-30 15:37:50', '2026-09-30 17:52:45'),
(5, 'instagram', 'Instagram Professional API', '{\"instagram_account_id\":\"\",\"meta_app_id\":\"\",\"meta_app_secret\":\"\",\"access_token\":\"\",\"enabled\":false,\"status\":\"not_configured\",\"last_tested_at\":null,\"last_test_result\":null}', 'not_configured', '2026-09-30 17:52:47', 'Instagram Access Token missing.', '2026-09-30 15:37:50', '2026-09-30 17:52:47'),
(6, 'google_maps', 'Google Maps Platform', '{\"api_key\":\"\",\"enabled\":false,\"status\":\"not_configured\",\"last_tested_at\":null,\"last_test_result\":null}', 'not_configured', '2026-09-30 17:52:50', 'Google Maps API Key missing.', '2026-09-30 15:37:50', '2026-09-30 17:52:50');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_number` varchar(50) NOT NULL,
  `booking_id` int(10) UNSIGNED DEFAULT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_email` varchar(150) DEFAULT NULL,
  `customer_phone` varchar(50) DEFAULT NULL,
  `customer_address` text DEFAULT NULL,
  `invoice_date` date NOT NULL,
  `due_date` date NOT NULL,
  `subtotal` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount_type` varchar(20) NOT NULL DEFAULT 'fixed',
  `discount_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tax_rate` decimal(5,2) NOT NULL DEFAULT 18.00,
  `tax_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `amount_paid` decimal(10,2) NOT NULL DEFAULT 0.00,
  `balance_due` decimal(10,2) NOT NULL DEFAULT 0.00,
  `payment_method` varchar(50) NOT NULL DEFAULT 'UPI',
  `status` varchar(30) NOT NULL DEFAULT 'draft',
  `notes` text DEFAULT NULL,
  `terms` text DEFAULT NULL,
  `sent_at` datetime DEFAULT NULL,
  `paid_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_number`, `booking_id`, `customer_id`, `customer_name`, `customer_email`, `customer_phone`, `customer_address`, `invoice_date`, `due_date`, `subtotal`, `discount_type`, `discount_amount`, `tax_rate`, `tax_amount`, `total_amount`, `amount_paid`, `balance_due`, `payment_method`, `status`, `notes`, `terms`, `sent_at`, `paid_at`, `created_at`, `updated_at`) VALUES
(13, 'INV-2026-0001', 21, 31, 'Senthil Kumar R', 'r.senthilkumar22bca106@gmail.com', '+919080984655', 'Glowup Studio, Suite 402, Jubilee Hills, Hyderabad', '2026-10-03', '2026-10-06', 3500.00, 'none', 0.00, 18.00, 630.00, 4130.00, 4130.00, 0.00, 'UPI / Cash / Card', 'paid', 'Generated automatically on service completion for Precision Thermal Straightening', 'Invoices are payable upon receipt. Services once rendered are non-refundable. Thank you for choosing Glowup!', '2026-10-03 20:07:40', '2026-10-03 20:08:11', '2026-10-03 20:07:40', '2026-10-03 20:08:11'),
(15, 'INV-2026-0002', NULL, NULL, 'test', '', '', 'Jubilee Hills, Hyderabad', '2026-10-03', '2026-10-06', 5788.00, 'none', 0.00, 18.00, 1041.84, 6829.84, 6829.84, 0.00, 'UPI', 'paid', '', 'Invoices are payable upon receipt. Glowup Beauty Studio appreciates your valued patronage.', NULL, '2026-10-03 20:12:20', '2026-10-03 20:11:35', '2026-10-03 20:12:20'),
(16, 'INV-2026-0003', NULL, NULL, 'test', '', '', 'Jubilee Hills, Hyderabad', '2026-10-03', '2026-10-06', 5000.00, 'none', 0.00, 18.00, 900.00, 5900.00, 5900.00, 0.00, 'UPI', 'paid', '', 'Invoices are payable upon receipt. Glowup Beauty Studio appreciates your valued patronage.', NULL, '2026-10-03 20:16:25', '2026-10-03 20:14:39', '2026-10-03 20:16:25'),
(17, 'INV-2026-0004', 13, 20, 'Ananya Sundaram 2200', 'ananya_2200@example.com', '987652200', 'Glowup Studio, Suite 402, Jubilee Hills, Hyderabad', '2026-10-03', '2026-10-06', 15000.00, 'none', 0.00, 18.00, 2700.00, 17700.00, 17700.00, 0.00, 'UPI / Cash / Card', 'paid', 'Generated automatically on service completion for Haute Royal Bridal Artistry', 'Invoices are payable upon receipt. Services once rendered are non-refundable. Thank you for choosing Glowup!', '2026-10-03 20:17:48', '2026-10-03 20:17:56', '2026-10-03 20:17:48', '2026-10-03 20:17:56'),
(18, 'INV-2026-0005', 30, 33, 'Senthil Kumar R', 'senthil@gmail.com', '1234567890', 'Glowup Studio, Suite 402, Jubilee Hills, Hyderabad', '2026-10-10', '2026-10-13', 3500.00, 'none', 0.00, 18.00, 630.00, 4130.00, 0.00, 4130.00, 'UPI / Cash / Card', 'sent', 'Generated automatically on service completion for Hydra Facial Ritual', 'Invoices are payable upon receipt. Services once rendered are non-refundable. Thank you for choosing Glowup!', '2026-10-10 18:01:24', NULL, '2026-10-10 18:01:24', '2026-10-10 18:01:24');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(10) UNSIGNED NOT NULL,
  `item_type` varchar(50) NOT NULL DEFAULT 'service',
  `item_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `unit_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice_items`
--

INSERT INTO `invoice_items` (`id`, `invoice_id`, `item_type`, `item_name`, `description`, `quantity`, `unit_price`, `total_price`, `created_at`) VALUES
(1, 1, 'service', 'Royal Heritage Haute Bridal Makeover', 'Complete Temptu HD airbrush, hair sculpt & teardrop saree draping', 1, 35000.00, 35000.00, '2026-09-30 15:37:50'),
(2, 2, 'service', 'Japanese Straightening & Scalp Detox', 'Keratin realignment and acoustic scalp lymphatic drainage', 1, 8500.00, 8500.00, '2026-09-30 15:37:50'),
(3, 3, 'service', 'Royal Heritage Temple Bridal Package', 'Appointment on 30 Sep 2026 at 04:00 PM with Elena Vance', 1, 18500.00, 18500.00, '2026-09-30 16:11:22'),
(4, 4, 'service', 'Royal Heritage Temple Bridal Package', 'Appointment on 30 Sep 2026 at 04:00 PM with Elena Vance', 1, 18500.00, 18500.00, '2026-09-30 16:16:01'),
(5, 5, 'service', 'Royal Heritage Temple Bridal Package', 'Appointment on 30 Sep 2026 at 04:00 PM with Elena Vance', 1, 18500.00, 18500.00, '2026-09-30 16:16:45'),
(6, 6, 'service', 'Royal Heritage Temple Bridal Package', 'Appointment on 30 Sep 2026 at 04:00 PM with Elena Vance', 1, 18500.00, 18500.00, '2026-09-30 16:18:47'),
(7, 7, 'service', 'Signature Bridal Makeup', 'Appointment on 05 Oct 2026 at 11:00 AM with Priya Chandran (Lead Bridal Couturier)', 1, 18500.00, 18500.00, '2026-09-30 16:54:32'),
(8, 8, 'service', 'Signature Bridal Makeup', 'Appointment on 05 Oct 2026 at 11:00 AM with Priya Chandran (Lead Bridal Couturier)', 1, 18500.00, 18500.00, '2026-09-30 16:57:27'),
(9, 9, 'service', 'Signature Bridal Makeup', 'Appointment on 05 Oct 2026 at 11:00 AM with Priya Chandran (Lead Bridal Couturier)', 1, 18500.00, 18500.00, '2026-09-30 16:58:24'),
(13, 13, 'service', 'Precision Thermal Straightening', 'Appointment on 03 Oct 2026 at 11:00 AM with Any Master Specialist', 1, 3500.00, 3500.00, '2026-10-03 20:07:40'),
(15, 15, 'service', 'test', 'Custom client styling / treatment', 1, 5788.00, 5788.00, NULL),
(16, 16, 'service', 'test', 'Custom client styling / treatment', 1, 5000.00, 5000.00, NULL),
(17, 17, 'service', 'Haute Royal Bridal Artistry', 'Appointment on 05 Oct 2026 at 11:00 AM with Priya Chandran (Lead Bridal Couturier)', 1, 15000.00, 15000.00, '2026-10-03 20:17:48'),
(18, 18, 'service', 'Hydra Facial Ritual', 'Appointment on 10 Oct 2026 at 02:00 PM with Any Master Specialist', 1, 3500.00, 3500.00, '2026-10-10 18:01:24');

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `whatsapp` varchar(50) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `service_interested` varchar(200) DEFAULT NULL,
  `source` varchar(100) NOT NULL DEFAULT 'Website Enquiry',
  `campaign` varchar(100) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'new',
  `assigned_staff` varchar(100) NOT NULL DEFAULT 'Elena Vance',
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`id`, `name`, `phone`, `whatsapp`, `email`, `service_interested`, `source`, `campaign`, `notes`, `status`, `assigned_staff`, `customer_id`, `created_at`, `updated_at`) VALUES
(1, 'Pooja Sundaram', '+91 98401 23456', '+91 98401 23456', 'pooja.sundaram@gmail.com', 'Royal Heritage Temple Bride', 'Instagram Campaign', 'Festive Bride 2026', 'Wedding planned for late November at Meenakshi Temple. Inquired about airbrush trial.', 'follow_up', 'Priya Varma', NULL, '2026-09-28 15:37:50', '2026-09-29 15:37:50'),
(2, 'Deepika Ranganathan', '+91 97910 88231', '+91 97910 88231', 'deepika.r@outlook.com', 'Diploma in Haute Bridal Artistry', 'Academy Enquiry Form', 'Autumn Batch Admission', 'Wants to inspect studio training labs on Saturday.', 'contacted', 'Elena Vance', NULL, '2026-09-29 15:37:50', '2026-09-30 11:37:50'),
(3, 'Kavitha Murugesan', '+91 94432 11980', '+91 94432 11980', 'kavitha.m@yahoo.com', 'Glass Skin Hydra Resurfacing', 'Website Contact', 'Organic Search', 'Dealing with hyperpigmentation. Wants specialist consultation.', 'new', 'Alex Vance', NULL, '2026-09-30 10:37:50', '2026-09-30 10:37:50'),
(4, 'Radhika Singhania', '+91 99887 58379', '+91 99887 58379', 'radhika_1790784678@luxurypatron.in', 'Royal Heritage Temple Bridal Package', 'Instagram Campaign', 'Diwali Bridal Showcase 2026', 'Looking for 3-day wedding package including muhurtham and sangeet aesthetics.', 'converted', 'Elena Vance', 13, '2026-09-30 16:11:19', '2026-09-30 16:11:20'),
(5, 'Radhika Singhania', '+91 99887 51553', '+91 99887 51553', 'radhika_1790784957@luxurypatron.in', 'Royal Heritage Temple Bridal Package', 'Instagram Campaign', 'Diwali Bridal Showcase 2026', 'Looking for 3-day wedding package including muhurtham and sangeet aesthetics.', 'converted', 'Elena Vance', 14, '2026-09-30 16:15:57', '2026-09-30 16:15:58'),
(6, 'Radhika Singhania', '+91 99887 83525', '+91 99887 83525', 'radhika_1790785001@luxurypatron.in', 'Royal Heritage Temple Bridal Package', 'Instagram Campaign', 'Diwali Bridal Showcase 2026', 'Looking for 3-day wedding package including muhurtham and sangeet aesthetics.', 'converted', 'Elena Vance', 15, '2026-09-30 16:16:41', '2026-09-30 16:16:42'),
(7, 'Radhika Singhania', '+91 99887 16391', '+91 99887 16391', 'radhika_1790785123@luxurypatron.in', 'Royal Heritage Temple Bridal Package', 'Instagram Campaign', 'Diwali Bridal Showcase 2026', 'Looking for 3-day wedding package including muhurtham and sangeet aesthetics.', 'converted', 'Elena Vance', 16, '2026-09-30 16:18:44', '2026-09-30 16:18:45'),
(8, 'Meera Nambiar', '+91 98451 22334', '+91 98451 22334', 'meera.nambiar@gmail.com', 'Bridal Couture Booking', 'Bridal Enquiry', 'Website Contact Form', 'Client Message: Interested in the Couture Royal Bridal Package for my wedding on December 15th.', 'new', 'Elena Vance', NULL, '2026-09-30 16:54:30', '2026-09-30 16:54:30'),
(9, 'Pooja Sundaram', '+91 97654 88990', '+91 97654 88990', 'pooja.sundaram@gmail.com', 'Master Diploma in Bridal Makeup', 'Academy Enquiry', 'Academy Enrollment Form', 'Batch: Weekend Master Batch | Experience: Self-Taught / Practicing Artist | Notes: Planning to open a bridal makeover studio in Coimbatore.', 'new', 'Elena Vance', NULL, '2026-09-30 16:54:31', '2026-09-30 16:54:31'),
(10, 'Sanjana Reddy', '+91 99123 44556', '+91 99123 44556', 'sanjana.reddy@gmail.com', 'Signature Bridal Makeup', 'Bridal Booking', 'Website Booking Wizard', 'Appointment: 2026-10-05 at 11:00 AM with Priya Chandran (Lead Bridal Couturier). Notes: Traditional South Indian bridal look with fresh jasmine floral styling.', 'booking_confirmed', 'Elena Vance', 17, '2026-09-30 16:54:31', '2026-09-30 16:54:31'),
(11, 'Meera Nambiar', '+91 98451 22334', '+91 98451 22334', 'meera.nambiar@gmail.com', 'Bridal Couture Booking', 'Bridal Enquiry', 'Website Contact Form', 'Client Message: Interested in the Couture Royal Bridal Package for my wedding on December 15th.', 'new', 'Elena Vance', NULL, '2026-09-30 16:57:25', '2026-09-30 16:57:25'),
(12, 'Pooja Sundaram', '+91 97654 88990', '+91 97654 88990', 'pooja.sundaram@gmail.com', 'Master Diploma in Bridal Makeup', 'Academy Enquiry', 'Academy Enrollment Form', 'Batch: Weekend Master Batch | Experience: Self-Taught / Practicing Artist | Notes: Planning to open a bridal makeover studio in Coimbatore.', 'new', 'Elena Vance', NULL, '2026-09-30 16:57:25', '2026-09-30 16:57:25'),
(13, 'Sanjana Reddy', '+91 99123 44556', '+91 99123 44556', 'sanjana.reddy@gmail.com', 'Signature Bridal Makeup', 'Bridal Booking', 'Website Booking Wizard', 'Appointment: 2026-10-05 at 11:00 AM with Priya Chandran (Lead Bridal Couturier). Notes: Traditional South Indian bridal look with fresh jasmine floral styling.', 'booking_confirmed', 'Elena Vance', 17, '2026-09-30 16:57:26', '2026-09-30 16:57:26'),
(14, 'Meera Nambiar', '+91 98451 22334', '+91 98451 22334', 'meera.nambiar@gmail.com', 'Bridal Couture Booking', 'Bridal Enquiry', 'Website Contact Form', 'Client Message: Interested in the Couture Royal Bridal Package for my wedding on December 15th.', 'new', 'Elena Vance', NULL, '2026-09-30 16:58:22', '2026-09-30 16:58:22'),
(15, 'Pooja Sundaram', '+91 97654 88990', '+91 97654 88990', 'pooja.sundaram@gmail.com', 'Master Diploma in Bridal Makeup', 'Academy Enquiry', 'Academy Enrollment Form', 'Batch: Weekend Master Batch | Experience: Self-Taught / Practicing Artist | Notes: Planning to open a bridal makeover studio in Coimbatore.', 'new', 'Elena Vance', NULL, '2026-09-30 16:58:23', '2026-09-30 16:58:23'),
(16, 'Sanjana Reddy', '+91 99123 44556', '+91 99123 44556', 'sanjana.reddy@gmail.com', 'Signature Bridal Makeup', 'Bridal Booking', 'Website Booking Wizard', 'Appointment: 2026-10-05 at 11:00 AM with Priya Chandran (Lead Bridal Couturier). Notes: Traditional South Indian bridal look with fresh jasmine floral styling.', 'booking_confirmed', 'Elena Vance', 17, '2026-09-30 16:58:23', '2026-09-30 16:58:23'),
(17, 'Meera Nambiar', '+91 98451 22334', '+91 98451 22334', 'meera.nambiar@gmail.com', 'Bridal Couture Booking', 'Bridal Enquiry', 'Website Contact Form', 'Client Message: Interested in the Couture Royal Bridal Package for my wedding on December 15th.', 'new', 'Elena Vance', NULL, '2026-09-30 17:09:54', '2026-09-30 17:09:54'),
(18, 'Pooja Sundaram', '+91 97654 88990', '+91 97654 88990', 'pooja.sundaram@gmail.com', 'Master Diploma in Bridal Makeup', 'Academy Enquiry', 'Academy Enrollment Form', 'Batch: Weekend Master Batch | Experience: Self-Taught / Practicing Artist | Notes: Planning to open a bridal makeover studio in Coimbatore.', 'new', 'Elena Vance', NULL, '2026-09-30 17:09:54', '2026-09-30 17:09:54'),
(19, 'Sanjana Reddy', '+91 99123 44556', '+91 99123 44556', 'sanjana.reddy@gmail.com', 'Signature Bridal Makeup', 'Bridal Booking', 'Website Booking Wizard', 'Appointment: 2026-10-05 at 11:00 AM with Priya Chandran (Lead Bridal Couturier). Notes: Traditional South Indian bridal look with fresh jasmine floral styling.', 'booking_confirmed', 'Elena Vance', 17, '2026-09-30 17:09:55', '2026-09-30 17:09:55'),
(20, 'Meera Nambiar', '+91 98451 22334', '+91 98451 22334', 'meera.nambiar@gmail.com', 'Bridal Couture Booking', 'Bridal Enquiry', 'Website Contact Form', 'Client Message: Interested in the Couture Royal Bridal Package for my wedding on December 15th.', 'new', 'Elena Vance', NULL, '2026-09-30 17:12:11', '2026-09-30 17:12:11'),
(21, 'Pooja Sundaram', '+91 97654 88990', '+91 97654 88990', 'pooja.sundaram@gmail.com', 'Master Diploma in Bridal Makeup', 'Academy Enquiry', 'Academy Enrollment Form', 'Batch: Weekend Master Batch | Experience: Self-Taught / Practicing Artist | Notes: Planning to open a bridal makeover studio in Coimbatore.', 'new', 'Elena Vance', NULL, '2026-09-30 17:12:12', '2026-09-30 17:12:12'),
(22, 'Sanjana Reddy', '+91 99123 44556', '+91 99123 44556', 'sanjana.reddy@gmail.com', 'Signature Bridal Makeup', 'Bridal Booking', 'Website Booking Wizard', 'Appointment: 2026-10-05 at 11:00 AM with Priya Chandran (Lead Bridal Couturier). Notes: Traditional South Indian bridal look with fresh jasmine floral styling.', 'booking_confirmed', 'Elena Vance', 17, '2026-09-30 17:12:12', '2026-09-30 17:12:12'),
(23, 'Ananya Sundaram 2200', '987652200', '987652200', 'ananya_2200@example.com', 'Haute Royal Bridal Artistry', 'Bridal Booking', 'Website Booking Wizard', 'Appointment: 2026-10-05 at 11:00 AM with Priya Chandran (Lead Bridal Couturier). Notes: Trial session for wedding reception', 'booking_confirmed', 'Elena Vance', 20, '2026-09-30 18:28:53', '2026-09-30 18:28:53'),
(24, 'Priya Test', '9876543210', '9876543210', 'priya.test@example.com', 'Haute Royal Bridal Artistry', 'Bridal Booking', 'Website Booking Wizard', 'Appointment: 2026-10-07 at 11:00 AM with Any Master Specialist. Notes: ', 'booking_confirmed', 'Elena Vance', 23, '2026-09-30 18:34:04', '2026-09-30 18:34:04'),
(25, 'Ananya Sundaram 4484', '987654484', '987654484', 'ananya_4484@example.com', 'Haute Royal Bridal Artistry', 'Bridal Booking', 'Website Booking Wizard', 'Appointment: 2026-12-13 at 02:00 PM with Priya Chandran (Lead Bridal Couturier). Notes: Trial session for wedding reception', 'booking_confirmed', 'Elena Vance', 25, '2026-09-30 18:39:10', '2026-09-30 18:39:10'),
(26, 'Ananya Sundaram 5480', '987655480', '987655480', 'ananya_5480@example.com', 'Haute Royal Bridal Artistry', 'Bridal Booking', 'Website Booking Wizard', 'Appointment: 2026-10-29 at 02:00 PM with Priya Chandran (Lead Bridal Couturier). Notes: Trial session for wedding reception', 'booking_confirmed', 'Elena Vance', 26, '2026-09-30 19:17:07', '2026-09-30 19:17:07'),
(27, 'Ananya Sundaram 5546', '987655546', '987655546', 'ananya_5546@example.com', 'Haute Royal Bridal Artistry', 'Bridal Booking', 'Website Booking Wizard', 'Appointment: 2026-10-23 at 02:00 PM with Priya Chandran (Lead Bridal Couturier). Notes: Trial session for wedding reception', 'booking_confirmed', 'Elena Vance', 27, '2026-09-30 19:17:20', '2026-09-30 19:17:20'),
(28, 'Sujata AutomatedTest', '9876543999', '9876543999', 'sujata.test@example.com', 'Hydra Facial Ritual', 'Booking Form', 'Website Booking Wizard', 'Appointment: 2026-10-30 at 06:30 PM with Any Master Specialist. Notes: ', 'booking_confirmed', 'Elena Vance', 29, '2026-09-30 19:36:45', '2026-09-30 19:36:45'),
(29, 'Sujata AutomatedTest', '9876541364', '9876541364', 'sujata.1790797212@example.com', 'Hydra Facial Ritual', 'Booking Form', 'Website Booking Wizard', 'Appointment: 2026-11-15 at 02:00 PM with Any Master Specialist. Notes: ', 'booking_confirmed', 'Elena Vance', 30, '2026-09-30 19:40:13', '2026-09-30 19:40:13'),
(30, 'Senthil Kumar R', '1234567890', '1234567890', 'r.senthilkumar22bca106@gmail.com', 'Hydra Facial Ritual', 'Booking Form', 'Website Booking Wizard', 'Appointment: 2026-10-03 at 10:00 AM with Any Master Specialist. Notes: Beverage: Organic Matcha Latte | test', 'booking_confirmed', 'Elena Vance', 31, '2026-10-03 19:26:03', '2026-10-03 19:26:03'),
(31, 'Senthil Kumar R', '+919080984655', '+919080984655', 'r.senthilkumar22bca106@gmail.com', 'Precision Thermal Straightening', 'Booking Form', 'Website Booking Wizard', 'Appointment: 2026-10-03 at 11:00 AM with Any Master Specialist. Notes: Beverage: Organic Matcha Latte | test', 'booking_confirmed', 'Elena Vance', 31, '2026-10-03 19:34:42', '2026-10-03 19:34:42'),
(32, 'Senthil Kumar R', '1234567890', '1234567890', 'test9@gmail.com', 'Master Diploma in Bridal Makeup', 'Academy Enquiry', 'Academy Enrollment Form', 'Batch: Weekday Morning | Experience: Beginner | Notes: ', 'converted', 'Elena Vance', 31, '2026-10-03 20:01:33', '2026-10-03 20:04:58'),
(33, 'Senthil Kumar R', '1234567890', '1234567890', 'senthil@gmail.com', 'Precision Thermal Straightening', 'Booking Form', 'Website Booking Wizard', 'Appointment: 2026-10-16 at 12:30 PM with Any Master Specialist. Notes: ', 'booking_confirmed', 'Elena Vance', 33, '2026-10-10 17:46:44', '2026-10-10 17:46:44'),
(34, 'Senthil Kumar R', '1234567890', '1234567890', 'senthil@gmail.com', 'Botox Capillary Reconstruction', 'Booking Form', 'Website Booking Wizard', 'Appointment: 2026-10-10 at 11:00 AM with Any Master Specialist. Notes: Beverage: Organic Matcha Latte |', 'booking_confirmed', 'Elena Vance', 33, '2026-10-10 17:50:13', '2026-10-10 17:50:13'),
(41, 'Senthil Kumar R', '1234567890', '1234567890', 'senthil@gmail.com', 'Hydra Facial Ritual', 'Booking Form', 'Website Booking Wizard', 'Appointment: 2026-10-10 at 02:00 PM with Any Master Specialist. Notes: Beverage: Organic Matcha Latte |', 'booking_confirmed', 'Elena Vance', 33, '2026-10-10 17:58:14', '2026-10-10 17:58:14'),
(42, 'Senthil Kumar R', '+919080984655', '+919080984655', 'senthil@gmail.com', 'Precision Thermal Straightening', 'Booking Form', 'Website Booking Wizard', 'Appointment: 2026-10-10 at 12:30 PM with Any Master Specialist. Notes: Beverage: Organic Matcha Latte |', 'booking_confirmed', 'Elena Vance', 33, '2026-10-10 18:00:35', '2026-10-10 18:00:35'),
(43, 'admin', '1234567890', '1234567890', 'admin@demo.com', 'Precision Thermal Straightening', 'Booking Form', 'Website Booking Wizard', 'Appointment: 2026-10-10 at 10:00 AM with Any Master Specialist. Notes: Beverage: Organic Matcha Latte |', 'booking_confirmed', 'Elena Vance', 31, '2026-10-10 18:36:09', '2026-10-10 18:36:09');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(2, '2026-09-29-082155', 'App\\Database\\Migrations\\CreateAdminsTable', 'default', 'App', 1790670512, 1),
(3, '2026-09-29-105113', 'App\\Database\\Migrations\\CreateHomepageContentTables', 'default', 'App', 1790679178, 2),
(4, '2026-09-29-201500', 'App\\Database\\Migrations\\CreateFooterCmsTables', 'default', 'App', 1790692828, 3),
(5, '2026-09-29-233000', 'App\\Database\\Migrations\\CreateCustomersTable', 'default', 'App', 1790704703, 4),
(6, '2026-09-30-040000', 'App\\Database\\Migrations\\CreateReviewsTable', 'default', 'App', 1790718988, 5),
(7, '2026-09-30-193000', 'App\\Database\\Migrations\\CreateEnquiriesAndBookingsTables', 'default', 'App', 1790776452, 6),
(8, '2026-09-30-200000', 'App\\Database\\Migrations\\CreateAboutAndServicesTables', 'default', 'App', 1790777831, 7),
(9, '2026-09-30-210000', 'App\\Database\\Migrations\\CreateBusinessAndAcademyTables', 'default', 'App', 1790778836, 8),
(10, '2026-09-30-220000', 'App\\Database\\Migrations\\CreateGalleryAndEventsTables', 'default', 'App', 1790779695, 9),
(11, '2026-09-30-230000', 'App\\Database\\Migrations\\CreateBlogTables', 'default', 'App', 1790781136, 10),
(12, '2026-09-30-240000', 'App\\Database\\Migrations\\CreateBusinessAndCrmTables', 'default', 'App', 1790782670, 11),
(13, '2026-10-02-220000', 'App\\Database\\Migrations\\CreateCategoriesTable', 'default', 'App', 1790959960, 12),
(14, '2026-10-03-173000', 'App\\Database\\Migrations\\CreateSeoMetadataTable', 'default', 'App', 1791028598, 13);

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `banner_image` varchar(500) DEFAULT NULL,
  `discount_type` varchar(20) NOT NULL DEFAULT 'percentage',
  `discount_value` decimal(10,2) NOT NULL DEFAULT 15.00,
  `coupon_code` varchar(50) DEFAULT NULL,
  `target_service` varchar(150) NOT NULL DEFAULT 'All Treatments',
  `target_segment` varchar(50) NOT NULL DEFAULT 'all',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `featured_on_frontend` tinyint(1) NOT NULL DEFAULT 1,
  `usage_count` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `name`, `title`, `description`, `banner_image`, `discount_type`, `discount_value`, `coupon_code`, `target_service`, `target_segment`, `start_date`, `end_date`, `is_active`, `featured_on_frontend`, `usage_count`, `created_at`, `updated_at`) VALUES
(1, 'Diwali Haute Bridal Special', 'Diwali Bridal Radiance Ritual — 20% Privilege', 'Complimentary 24K pure gold pre-draping facial with every Haute Bridal Couture package reserved this festive season.', 'images/slide-bridal.jpg', 'percentage', 20.00, 'BRIDALGLOW20', 'Haute Bridal Packages', 'bridal', '2026-09-30', '2026-11-14', 1, 1, 14, '2026-09-30 15:37:50', '2026-09-30 15:37:50'),
(2, 'Keratin Reconditioning Treat', 'Glass Hair Molecular Keratin — ₹1,500 Off', 'Bespoke cold-pressed botanical smoothing sealed with mirror thermal iron and ultrasonic peptide misting.', 'images/slide-hair.jpg', 'fixed', 1500.00, 'KERATIN1500', 'Molecular Hair Alchemy', 'all', '2026-09-30', '2026-10-30', 1, 1, 28, '2026-09-30 15:37:50', '2026-09-30 15:37:50'),
(5, 'Diwali Radiance Privilege', 'Diwali Radiance Privilege – 20% OFF', 'Experience any bespoke facial ritual with 20% privilege credit.', NULL, 'percentage', 20.00, 'DIWALI20', 'Facials & Skin', 'all', '2026-09-29', '2026-10-30', 1, 1, 0, '2026-09-30 17:12:22', '2026-10-03 19:06:30');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `payment_number` varchar(50) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL DEFAULT 'UPI',
  `transaction_ref` varchar(100) DEFAULT NULL,
  `payment_date` datetime NOT NULL,
  `notes` text DEFAULT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'successful',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `invoice_id`, `customer_id`, `payment_number`, `amount`, `payment_method`, `transaction_ref`, `payment_date`, `notes`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'PAY-2026-0001', 37170.00, 'UPI', 'UPI-4892019401', '2026-09-27 15:37:50', 'Full payment received.', 'successful', '2026-09-30 15:37:50', '2026-09-30 15:37:50'),
(2, 2, 2, 'PAY-2026-0002', 5000.00, 'Card', 'CARD-TXN-9021', '2026-09-29 15:37:50', 'Part payment of ₹5,000 received.', 'successful', '2026-09-30 15:37:50', '2026-09-30 15:37:50'),
(3, 3, 13, 'PAY-2026-0003', 21830.00, 'UPI (Google Pay)', 'UPI-SETTLE-88992', '2026-09-30 00:00:00', 'Full payment received via UPI.', 'completed', '2026-09-30 16:11:23', '2026-09-30 16:11:23'),
(4, 4, 14, 'PAY-2026-0004', 21830.00, 'UPI (Google Pay)', 'UPI-SETTLE-88992', '2026-09-30 00:00:00', 'Full payment received via UPI.', 'completed', '2026-09-30 16:16:01', '2026-09-30 16:16:01'),
(5, 5, 15, 'PAY-2026-0005', 21830.00, 'UPI (Google Pay)', 'UPI-SETTLE-88992', '2026-09-30 00:00:00', 'Full payment received via UPI.', 'completed', '2026-09-30 16:16:46', '2026-09-30 16:16:46'),
(6, 6, 16, 'PAY-2026-0006', 21830.00, 'UPI (Google Pay)', 'UPI-SETTLE-88992', '2026-09-30 00:00:00', 'Full payment received via UPI.', 'completed', '2026-09-30 16:18:48', '2026-09-30 16:18:48'),
(7, 7, 17, 'PAY-2026-0007', 21830.00, 'UPI (Google Pay / PhonePe)', 'UPI-GLW-1790787273', '2026-09-30 00:00:00', 'Full settlement received via salon counter QR code.', 'completed', '2026-09-30 16:54:33', '2026-09-30 16:54:33'),
(8, 8, 17, 'PAY-2026-0008', 21830.00, 'UPI (Google Pay / PhonePe)', 'UPI-GLW-1790787448', '2026-09-30 00:00:00', 'Full settlement received via salon counter QR code.', 'completed', '2026-09-30 16:57:28', '2026-09-30 16:57:28'),
(9, 9, 17, 'PAY-2026-0009', 21830.00, 'UPI (Google Pay / PhonePe)', 'UPI-GLW-1790787505', '2026-09-30 00:00:00', 'Full settlement received via salon counter QR code.', 'completed', '2026-09-30 16:58:25', '2026-09-30 16:58:25'),
(12, 13, 31, 'PAY-2026-0010', 4130.00, 'UPI / Cash Settlement', 'SETTLE-B7D501', '2026-10-03 00:00:00', 'Full balance settlement confirmed by admin.', 'completed', '2026-10-03 20:08:11', '2026-10-03 20:08:11'),
(14, 15, NULL, 'PAY-2026-0011', 689.84, 'UPI', 'TXN-996916', '2026-10-03 00:00:00', '', 'completed', '2026-10-03 20:11:53', '2026-10-03 20:11:53'),
(15, 15, NULL, 'PAY-2026-0012', 6140.00, 'UPI / Cash Settlement', 'SETTLE-482C36', '2026-10-03 00:00:00', 'Full balance settlement confirmed by admin.', 'completed', '2026-10-03 20:12:20', '2026-10-03 20:12:20'),
(16, 16, NULL, 'PAY-2026-0013', 900.00, 'UPI', 'TXN-BD3B27', '2026-10-03 00:00:00', '', 'completed', '2026-10-03 20:14:51', '2026-10-03 20:14:51'),
(17, 16, NULL, 'PAY-2026-0014', 500.00, 'UPI', 'TXN-DE596C', '2026-10-03 00:00:00', '', 'completed', '2026-10-03 20:15:57', '2026-10-03 20:15:57'),
(18, 16, NULL, 'PAY-2026-0015', 4500.00, 'UPI / Cash Settlement', 'SETTLE-9EA765', '2026-10-03 00:00:00', 'Full balance settlement confirmed by admin.', 'completed', '2026-10-03 20:16:25', '2026-10-03 20:16:25'),
(19, 17, 20, 'PAY-2026-0016', 17700.00, 'UPI', 'TXN-4BBEE5', '2026-10-03 00:00:00', '', 'completed', '2026-10-03 20:17:56', '2026-10-03 20:17:56');

-- --------------------------------------------------------

--
-- Table structure for table `photoshoot_packages`
--

CREATE TABLE `photoshoot_packages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `package_type` varchar(100) NOT NULL DEFAULT 'Bridal Portfolio',
  `price` decimal(10,2) NOT NULL DEFAULT 20000.00,
  `duration` varchar(100) NOT NULL DEFAULT '4 Hours',
  `description` text DEFAULT NULL,
  `image_url` varchar(500) DEFAULT NULL,
  `inclusions` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `photoshoot_packages`
--

INSERT INTO `photoshoot_packages` (`id`, `title`, `package_type`, `price`, `duration`, `description`, `image_url`, `inclusions`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Editorial Bridal Lookbook Shoot', 'Bridal Lookbook', 28000.00, '5 Hours', 'High-fashion editorial photoshoot featuring 3 bespoke couture looks with master hair sculpt and HD airbrush makeup.', 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=800&q=80', '3 Bridal Makeover Looks, 15 Retouched Editorial High-Res Photos, Studio Lighting & Backdrop, Attendant', 1, 1, '2026-09-30 14:48:15', '2026-09-30 14:48:15'),
(2, 'Creative Portrait & Model Folio', 'Model Portfolio', 16000.00, '3 Hours', 'Professional modeling portfolio development with high-fashion hair textures and dewy glass-skin aesthetics.', 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=800&q=80', '2 Glamour Hair & Makeup Changes, 10 Color-Graded Retouched Images, Moodboard Consultation', 1, 2, '2026-09-30 14:48:15', '2026-09-30 14:48:15');

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

CREATE TABLE `rentals` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL DEFAULT 'Jewellery',
  `rental_price` decimal(10,2) NOT NULL DEFAULT 3500.00,
  `deposit_amount` decimal(10,2) NOT NULL DEFAULT 5000.00,
  `description` text DEFAULT NULL,
  `image_url` varchar(500) DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rentals`
--

INSERT INTO `rentals` (`id`, `name`, `category`, `rental_price`, `deposit_amount`, `description`, `image_url`, `is_available`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Temple Nakshi Kemp Choker Set', 'Jewellery', 3500.00, 5000.00, 'Antique 22k matte gold finish handcrafted temple jewellery with real ruby kemp stones and green emerald drops.', 'https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?w=800&q=80', 1, 1, '2026-09-30 14:33:56', '2026-09-30 14:33:56'),
(2, 'Kundan Jadau Mathapatti & Maang Tikka', 'Jewellery', 2200.00, 3000.00, 'Artisan hand-set kundan pearls bridal head ornament for royal reception hair framing.', 'https://images.unsplash.com/photo-1535632066927-ab7c9ab60908?w=800&q=80', 1, 2, '2026-09-30 14:33:56', '2026-09-30 14:33:56'),
(3, 'Rose Gold Zardozi Velvet Bridal Lehenga', 'Couture Lehenga', 8500.00, 15000.00, 'Heavy heritage zardozi metallic wire embroidery with double cancan flare and organza dupatta.', 'https://images.unsplash.com/photo-1610030469983-98e550d6193c?w=800&q=80', 1, 3, '2026-09-30 14:33:56', '2026-09-30 14:33:56');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_name` varchar(120) NOT NULL,
  `customer_photo` varchar(255) DEFAULT NULL,
  `rating` tinyint(1) NOT NULL DEFAULT 5,
  `headline` varchar(255) DEFAULT NULL,
  `review_text` text NOT NULL,
  `service_name` varchar(150) DEFAULT NULL,
  `category` varchar(50) NOT NULL DEFAULT 'all',
  `specialist_name` varchar(120) DEFAULT NULL,
  `location` varchar(100) NOT NULL DEFAULT 'Madurai',
  `phone` varchar(30) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'published' COMMENT 'published or hidden',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_verified` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `customer_name`, `customer_photo`, `rating`, `headline`, `review_text`, `service_name`, `category`, `specialist_name`, `location`, `phone`, `status`, `sort_order`, `is_verified`, `created_at`, `updated_at`) VALUES
(1, 'Sneha Parthiban', NULL, 5, 'A royal experience that stayed flawless for 14 hours!', 'Lead Couturier Priya sculpted my traditional temple bridal look with airbrush perfection. From the fresh jasmine garland placement to the lightweight foundation that didn\'t crease during the muhurtham, everything felt like royalty.', 'Couture Royal Bridal Package', 'bridal', 'Priya Chandran', 'Madurai', '+91 98765 43210', 'published', 1, 1, '2026-09-15 21:56:28', '2026-09-29 22:05:44'),
(2, 'Rohini Mukherjee', NULL, 5, 'Mirror shine restored without losing natural volume!', 'I was terrified of chemical damage, but Founder Maya performed a microscopic porosity analysis first. The Keratin Infusion completely tamed my postpartum frizz while keeping my hair touchably soft and bouncy. 10/10!', 'Keratin Infusion Therapy', 'hair', 'Maya Sundaram', 'Chennai / Madurai', '+91 98401 23456', 'published', 2, 1, '2026-08-30 21:56:28', '2026-09-29 21:56:28'),
(3, 'Ananya Karthik', NULL, 5, 'Transformed my passion into a 6-figure bridal studio business.', 'The 6-month Master Bridal Diploma gave me hands-on training with 25+ real brides and a photoshoot portfolio that immediately booked me 18 weddings this season. Glowup Academy is the best investment I ever made.', 'Bridal & Fashion Artistry Diploma', 'academy', 'Priya & Maya', 'Academy Graduate \'24', '+91 97910 87654', 'published', 3, 1, '2026-08-15 21:56:28', '2026-09-29 21:56:28'),
(4, 'Dr. Meera Ramaswamy', NULL, 5, 'Medical-grade hygiene and instant glass skin glow.', 'As a physician, I am extremely particular about sterilization and dermal protocols. Dr. Elena Ross\'s clinical Hydra Facial operates on hospital-grade standards. My congested pores were cleared with zero redness.', 'Hydra Facial Ritual', 'facials', 'Dr. Elena Ross', 'Madurai', '+91 94432 11223', 'published', 4, 1, '2026-09-08 21:56:28', '2026-09-29 21:56:28'),
(5, 'Divya Natarajan', NULL, 5, 'Japanese thermal straightening that actually lasts.', 'Senior Stylist Aarav Mehta spent 3 hours perfecting each section with precision heat calibration. Even after monsoon humidity, my hair remains silky straight without a flat iron. Worth every single rupee!', 'Japanese Hair Straightening', 'hair', 'Aarav Mehta', 'Tirunelveli', '+91 98840 99887', 'published', 5, 1, '2026-08-25 21:56:28', '2026-09-29 21:56:28'),
(6, 'Shalini Sundar', NULL, 5, 'The 24K gold ions made my skin look luminous in photos!', 'I booked this 48 hours before my sister\'s wedding. The soothing private acoustic suite with lavender aromatherapy alone was worth it, but the lift in my cheekbones and golden glow was unbelievable.', '24K Gold Cellular Facial', 'facials', 'Dr. Elena Ross', 'Madurai', '+91 97890 33445', 'published', 6, 1, '2026-07-31 21:56:28', '2026-09-29 21:56:28'),
(15, 'Aishwarya Raman', NULL, 5, 'Exceptional hair transformation!', 'The botanical keratin ritual gave my hair unbelievable mirror shine without any harsh fumes.', 'Keratin Infusion Therapy', 'hair', 'Elena Vance', 'Madurai', '+91 98765 11223', 'published', 0, 1, '2026-09-30 17:12:20', '2026-09-30 17:12:21');

-- --------------------------------------------------------

--
-- Table structure for table `seo_metadata`
--

CREATE TABLE `seo_metadata` (
  `id` int(10) UNSIGNED NOT NULL,
  `page_key` varchar(100) NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `seo_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `canonical_url` varchar(500) DEFAULT NULL,
  `og_title` varchar(255) DEFAULT NULL,
  `og_description` text DEFAULT NULL,
  `og_image` varchar(500) DEFAULT NULL,
  `robots` varchar(100) NOT NULL DEFAULT 'index, follow',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seo_metadata`
--

INSERT INTO `seo_metadata` (`id`, `page_key`, `page_name`, `seo_title`, `meta_description`, `meta_keywords`, `canonical_url`, `og_title`, `og_description`, `og_image`, `robots`, `created_at`, `updated_at`) VALUES
(1, 'home', 'Homepage', 'Glowup Beauty Studio & Academy | Luxury Wellness & Haircare', 'Premium beauty treatments, clinical facials, and transformative hair alchemy curated within an architectural academy of stillness in Madurai.', 'beauty studio, luxury salon, haircare, facial, aesthetics, bridal makeover, Madurai', '', 'Glowup Beauty Studio & Academy | Luxury Wellness & Haircare', 'Premium beauty treatments, clinical facials, and transformative hair alchemy curated within an architectural academy of stillness.', 'assets/images/Glowup_Logo_Black_White.png', 'index, follow', '2026-10-03 11:56:38', '2026-10-03 11:56:38'),
(2, 'about', 'About Us', 'Glowup Beauty Studio & Academy | Luxurious About Us Experience', 'Discover the legacy of bridal artistry, bespoke skincare, and master academy courses in Madurai at Glowup.', 'madurai bridal studio, luxury beauty academy, glowup story, bespoke beauty', 'https://glowupbeautystudio.com/about', 'The Glowup Story — Luxury Salon & Bridal', 'Bridal artistry and elite cosmetic styling in Madurai.', 'https://glowupbeautystudio.com/images/og-about.jpg', 'index, follow, max-image-preview:large', '2026-10-03 11:56:38', '2026-10-03 12:18:56'),
(3, 'services', 'Services & Treatments', 'Treatment Menu & Services | Glowup Beauty Studio & Academy', 'Explore our bespoke menu of restorative facials, master hair therapies, and transformative beauty rituals.', 'salon services, aesthetic facials, hair alchemy, keratin, hydrafacial, bridal couture', '', 'Treatment Menu & Services | Glowup Beauty Studio & Academy', 'Explore our bespoke menu of restorative facials, master hair therapies, and transformative beauty rituals.', 'assets/images/Glowup_Logo_Black_White.png', 'index, follow', '2026-10-03 11:56:38', '2026-10-03 11:56:38'),
(4, 'academy', 'Academy & Courses', 'Academy of Beauty Arts & Courses | Glowup', 'Professional beauty education, masterclasses, and certified courses in cosmetology, hair design, and aesthetic artistry.', 'beauty academy, cosmetology course, hair styling diploma, makeup certification, Madurai', '', 'Academy of Beauty Arts & Courses | Glowup', 'Professional beauty education, masterclasses, and certified courses in cosmetology, hair design, and aesthetic artistry.', 'assets/images/Glowup_Logo_Black_White.png', 'index, follow', '2026-10-03 11:56:38', '2026-10-03 11:56:38'),
(5, 'bridal', 'Bridal Packages', 'Bridal Couture Packages & Makeover Tiers | Glowup', 'Signature bridal packages, destination bridal transformations, and bespoke pre-wedding rituals crafted for your radiance.', 'bridal makeup, bridal package, wedding makeover, bridal jewelry styling', '', 'Bridal Couture Packages & Makeover Tiers | Glowup', 'Signature bridal packages, destination bridal transformations, and bespoke pre-wedding rituals crafted for your radiance.', 'assets/images/Glowup_Logo_Black_White.png', 'index, follow', '2026-10-03 11:56:38', '2026-10-03 11:56:38'),
(6, 'rentals', 'Rentals & Jewellery', 'Luxury Jewellery & Costume Rentals | Glowup', 'Exquisite bridal jewellery sets, costume ornaments, and premium designer accessories available for bespoke hire.', 'bridal jewellery rental, temple jewelry hire, photoshoot costume rental', '', 'Luxury Jewellery & Costume Rentals | Glowup', 'Exquisite bridal jewellery sets, costume ornaments, and premium designer accessories available for bespoke hire.', 'assets/images/Glowup_Logo_Black_White.png', 'index, follow', '2026-10-03 11:56:38', '2026-10-03 11:56:38'),
(7, 'photoshoot', 'Photoshoot Sessions', 'Editorial Photoshoot Sessions & Styling | Glowup', 'High-fashion editorial photoshoot sessions, portfolio shoots, and specialized bridal styling in our studio.', 'photoshoot studio, model portfolio, bridal photoshoot, editorial styling', '', 'Editorial Photoshoot Sessions & Styling | Glowup', 'High-fashion editorial photoshoot sessions, portfolio shoots, and specialized bridal styling in our studio.', 'assets/images/Glowup_Logo_Black_White.png', 'index, follow', '2026-10-03 11:56:38', '2026-10-03 11:56:38'),
(8, 'events', 'Studio Events & Workshops', 'Masterclasses & Studio Events | Glowup Academy', 'Upcoming masterclasses, seasonal beauty workshops, and exclusive artistic gatherings at Glowup Studio.', 'beauty workshops, makeup masterclass, styling seminars', '', 'Masterclasses & Studio Events | Glowup Academy', 'Upcoming masterclasses, seasonal beauty workshops, and exclusive artistic gatherings at Glowup Studio.', 'assets/images/Glowup_Logo_Black_White.png', 'index, follow', '2026-10-03 11:56:38', '2026-10-03 11:56:38'),
(9, 'gallery', 'Visual Gallery & Lookbook', 'Gallery & Portfolio | Glowup Beauty Studio & Academy', 'A visual curated anthology of haute couture hair artistry, transformative skin therapies, and editorial craftsmanship.', 'beauty studio portfolio, lookbook, hair transformations, before and after', '', 'Gallery & Portfolio | Glowup Beauty Studio & Academy', 'A visual curated anthology of haute couture hair artistry, transformative skin therapies, and editorial craftsmanship.', 'assets/images/Glowup_Logo_Black_White.png', 'index, follow', '2026-10-03 11:56:38', '2026-10-03 11:56:38'),
(10, 'reviews', 'Patron Reviews & Testimonials', 'Patron Reviews & Testimonials | Glowup Beauty Studio & Academy', 'Read verified client testimonials and patron reviews of Glowup Beauty Studio & Academy luxury hair, skin, and wellness rituals.', 'client reviews, salon testimonials, customer feedback, verified reviews', '', 'Patron Reviews & Testimonials | Glowup Beauty Studio & Academy', 'Read verified client testimonials and patron reviews of Glowup Beauty Studio & Academy luxury hair, skin, and wellness rituals.', 'assets/images/Glowup_Logo_Black_White.png', 'index, follow', '2026-10-03 11:56:38', '2026-10-03 11:56:38'),
(11, 'blog', 'Editorial Journal & Blog', 'Beauty Journal & Editorial Articles | Glowup', 'Insightful beauty reflections, aesthetic trends, haircare science, and bridal guidance from Glowup masters.', 'beauty blog, skincare tips, hair care trends, bridal advice', '', 'Beauty Journal & Editorial Articles | Glowup', 'Insightful beauty reflections, aesthetic trends, haircare science, and bridal guidance from Glowup masters.', 'assets/images/Glowup_Logo_Black_White.png', 'index, follow', '2026-10-03 11:56:38', '2026-10-03 11:56:38'),
(12, 'contact', 'Contact & Concierge', 'Contact & Concierge | Glowup Beauty Studio & Academy', 'Get in touch with Glowup Beauty Studio & Academy. Book appointments, enquire about academy admissions, or visit our flagship studio in Madurai.', 'contact salon, studio address, appointment phone, salon madurai', '', 'Contact & Concierge | Glowup Beauty Studio & Academy', 'Get in touch with Glowup Beauty Studio & Academy. Book appointments, enquire about academy admissions, or visit our flagship studio in Madurai.', 'assets/images/Glowup_Logo_Black_White.png', 'index, follow', '2026-10-03 11:56:38', '2026-10-03 11:56:38'),
(13, 'booking', 'Online Appointment Booking', 'Online Appointment Booking | Glowup Beauty Studio & Academy', 'Reserve your bespoke beauty, hair, or wellness appointment online at Glowup Beauty Studio & Academy.', 'book salon appointment, schedule appointment, online salon booking', '', 'Online Appointment Booking | Glowup Beauty Studio & Academy', 'Reserve your bespoke beauty, hair, or wellness appointment online at Glowup Beauty Studio & Academy.', 'assets/images/Glowup_Logo_Black_White.png', 'index, follow', '2026-10-03 11:56:38', '2026-10-03 11:56:38'),
(14, 'profile', 'Patron Profile & Sanctuary Pass', 'Patron Portal & Sanctuary Pass | Glowup Beauty Studio & Academy', 'Manage your personal appointments, billing history, and membership privileges at Glowup Beauty Studio.', 'customer portal, appointment history, sanctuary pass', '', 'Patron Portal & Sanctuary Pass | Glowup Beauty Studio & Academy', 'Manage your personal appointments, billing history, and membership privileges at Glowup Beauty Studio.', 'assets/images/Glowup_Logo_Black_White.png', 'noindex, nofollow', '2026-10-03 11:56:38', '2026-10-03 11:56:38'),
(15, 'register', 'Customer Registration', 'Register | Glowup Beauty Studio & Academy', 'Register your patron membership at Glowup Beauty Studio & Academy.', 'register account, patron signup, member registration', '', 'Register | Glowup Beauty Studio & Academy', 'Register your patron membership at Glowup Beauty Studio & Academy.', 'assets/images/Glowup_Logo_Black_White.png', 'index, follow', '2026-10-03 11:56:38', '2026-10-03 11:56:38'),
(16, 'login', 'Customer Sign In', 'Sign In | Glowup Beauty Studio & Academy', 'Access your patron account and appointment dashboard at Glowup Beauty Studio & Academy.', 'customer login, sign in, patron portal', '', 'Sign In | Glowup Beauty Studio & Academy', 'Access your patron account and appointment dashboard at Glowup Beauty Studio & Academy.', 'assets/images/Glowup_Logo_Black_White.png', 'index, follow', '2026-10-03 11:56:38', '2026-10-03 11:56:38');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL DEFAULT 'facials',
  `price` decimal(10,2) NOT NULL DEFAULT 3500.00,
  `duration` varchar(100) NOT NULL DEFAULT '60 Minutes',
  `description` text DEFAULT NULL,
  `image_url` varchar(500) DEFAULT NULL,
  `button_text` varchar(100) NOT NULL DEFAULT 'Book Now',
  `button_url` varchar(255) NOT NULL DEFAULT 'booking',
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `category`, `price`, `duration`, `description`, `image_url`, `button_text`, `button_url`, `is_featured`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Hydra Facial Ritual', 'facials', 3500.00, '75 Minutes', 'Multi-step resurfacing treatment infusing patented peptides and botanical hydration for an instant, dewy glass-skin luminosity.', 'https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?w=800&q=80', 'Book Now', 'booking', 1, 1, 1, '2026-09-30 14:17:11', '2026-09-30 14:17:11'),
(2, 'Keratin Infusion Therapy', 'hair', 3500.00, '120 Minutes', 'Intensive botanical protein smoothing infusion that eliminates frizz, restores molecular bonds, and locks in mirror shine.', 'https://images.unsplash.com/photo-1595476108010-b4d1f102b1b1?w=800&q=80', 'Book Now', 'booking', 1, 1, 2, '2026-09-30 14:17:11', '2026-10-02 16:33:06'),
(3, 'Botox Capillary Reconstruction', 'hair', 3500.00, '90 Minutes', 'Deep-conditioning capillary hair botox formula packed with hyaluronic acid and caviar extract to resurrect damaged strands.', 'https://images.unsplash.com/photo-1519699047748-de8e457a634e?w=800&q=80', 'Book Now', 'booking', 1, 1, 3, '2026-09-30 14:17:11', '2026-09-30 14:17:11'),
(4, 'Precision Thermal Straightening', 'hair', 3500.00, '150 Minutes', 'Japanese-inspired precision thermal reconditioning for impeccably sleek, pin-straight hair with silky featherlight movement.', 'https://images.unsplash.com/photo-1560869713-7d0a29430803?w=800&q=80', 'Book Now', 'booking', 1, 1, 4, '2026-09-30 14:17:11', '2026-09-30 14:17:11'),
(5, 'Organic Cysteine Smoothing', 'hair', 3500.00, '120 Minutes', 'Gentle organic cysteine treatment relaxing unruly curls into effortless, manageable, touchably soft satin waves.', 'https://images.unsplash.com/photo-1522336572468-97b06e8ef143?w=800&q=80', 'Book Now', 'booking', 1, 1, 5, '2026-09-30 14:17:11', '2026-09-30 14:17:11'),
(6, 'Haute Royal Bridal Artistry', 'bridal', 15000.00, '180 Minutes', 'Bespoke bridal makeover complete with HD airbrush foundation, saree draping, floral hair architecture, and jewel placement.', 'https://images.unsplash.com/photo-1583391733956-3750e0ff4e8b?w=800&q=80', 'Reserve Date', 'booking', 1, 1, 6, '2026-09-30 14:17:11', '2026-09-30 14:17:11'),
(7, 'Russian Dry Manicure & BIAB', 'nails', 2800.00, '75 Minutes', 'Clinical diamond e-file cuticle detailing followed by builder gel reinforcement and minimalist editorial nail art.', 'https://images.unsplash.com/photo-1604654894610-df63bc536371?w=800&q=80', 'Book Now', 'booking', 0, 1, 7, '2026-09-30 14:17:11', '2026-10-03 19:38:29'),
(8, 'Japanese Head Spa & Scalp Detox', 'wellness', 4200.00, '90 Minutes', 'Micro-mist aromatic herbal scalp detox with warm rainfall waterfall cascade, lymphatic drainage, and shiatsu neck massage.', 'https://images.unsplash.com/photo-1544161515-4ab6ce6db874?w=800&q=80', 'Book Now', 'booking', 1, 1, 8, '2026-09-30 14:17:11', '2026-09-30 14:17:11');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `course_id` int(10) UNSIGNED DEFAULT NULL,
  `course_name` varchar(255) DEFAULT NULL,
  `batch` varchar(100) NOT NULL DEFAULT 'Autumn 2025',
  `status` varchar(50) NOT NULL DEFAULT 'enrolled',
  `notes` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_name`, `email`, `phone`, `course_id`, `course_name`, `batch`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'Kavitha Natarajan', 'kavitha.n@gmail.com', '+91 98412 44321', 1, 'Master Diploma in Bridal & Fashion Artistry', 'Autumn 2025', 'enrolled', 'Completed module 1 (Airbrush & Draping). Excellent score.', '2026-09-30 14:33:56', '2026-09-30 14:33:56'),
(2, 'Deepa Shanmugam', 'deepa.s@yahoo.com', '+91 94431 88762', 2, 'Advanced Hair Chemistry & Color Alchemy', 'Autumn 2025', 'enrolled', 'Preparing for certification exam.', '2026-09-30 14:33:56', '2026-09-30 14:33:56'),
(3, 'Ananya Balakrishnan', 'ananya.b@outlook.com', '+91 98940 12890', 3, 'Clinical Cosmetology & Aesthetic Skin Science', 'Summer 2025', 'completed', 'Graduated with Distinction. Awarded CIDESCO internship.', '2026-09-30 14:33:56', '2026-09-30 14:33:56');

-- --------------------------------------------------------

--
-- Table structure for table `studio_events`
--

CREATE TABLE `studio_events` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `event_type` varchar(100) NOT NULL DEFAULT 'Masterclass',
  `event_date` date DEFAULT NULL,
  `event_time` varchar(100) NOT NULL DEFAULT '10:00 AM - 04:00 PM',
  `location` varchar(255) NOT NULL DEFAULT 'Glowup Academy Sanctum, Madurai',
  `fee` decimal(10,2) NOT NULL DEFAULT 4999.00,
  `capacity` int(11) NOT NULL DEFAULT 25,
  `enrolled_count` int(11) NOT NULL DEFAULT 12,
  `description` text DEFAULT NULL,
  `image_url` varchar(500) DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'upcoming',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studio_events`
--

INSERT INTO `studio_events` (`id`, `title`, `event_type`, `event_date`, `event_time`, `location`, `fee`, `capacity`, `enrolled_count`, `description`, `image_url`, `status`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Haute Royal Airbrush Masterclass with Maya Sundaram', 'Masterclass', '2026-10-14', '10:00 AM - 05:00 PM', 'Glowup Academy Sanctum, Madurai', 6500.00, 30, 18, 'Hands-on intensive masterclass mastering Temptu silicon airbrush pressure calibration, speed contouring, and teardrop saree pinning.', 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=800&q=80', 'upcoming', 1, '2026-09-30 14:48:15', '2026-09-30 14:48:15'),
(2, 'Japanese Head Spa & Trichology Workshop', 'Workshop', '2026-10-28', '11:00 AM - 04:00 PM', 'Acoustic Suite 2, Glowup Studio', 4200.00, 20, 11, 'Clinical workshop covering 200x microscope scalp scanning, Ayurvedic herbal steam infusion, and acupressure lymphatic drainage.', 'https://images.unsplash.com/photo-1544161515-4ab6ce6db874?w=800&q=80', 'upcoming', 2, '2026-09-30 14:48:15', '2026-09-30 14:48:15');

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

CREATE TABLE `team_members` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `role` varchar(150) NOT NULL,
  `bio` text DEFAULT NULL,
  `badge` varchar(100) DEFAULT NULL,
  `image_url` varchar(500) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_members`
--

INSERT INTO `team_members` (`id`, `name`, `role`, `bio`, `badge`, `image_url`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Maya Sundaram', 'Founder & Master Trichologist', '15+ years formulating bespoke hair chemistry and regenerative capillary therapies.', 'Paris Certified', 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=500&q=80', 1, 1, '2026-09-30 14:17:11', '2026-09-30 14:17:11'),
(2, 'Dr. Elena Ross', 'Clinical Aesthetic Director', 'Dermatological surgeon specializing in non-invasive hydra resurfacing and peptide infusions.', 'Geneva Diploma', 'https://images.unsplash.com/photo-1594744803329-e58b31de8bf5?w=500&q=80', 2, 1, '2026-09-30 14:17:11', '2026-09-30 14:17:11'),
(3, 'Aarav Mehta', 'Haute Bridal Couturier', 'Celebrity bridal artist blending traditional Indian royal jewellery adornment with modern dewy minimalism.', 'Vogue Featured', 'https://images.unsplash.com/photo-1622253692010-333f2da6031d?w=500&q=80', 3, 1, '2026-09-30 14:17:11', '2026-09-30 14:17:11'),
(4, 'Priya Varma', 'Dean of Academy & Education', 'CIDESCO accredited educator mentoring the next generation of salon owners, hair chemists, and aesthetic artists.', 'CIDESCO Master', 'https://images.unsplash.com/photo-1580489944761-15a19d654956?w=500&q=80', 4, 1, '2026-09-30 14:17:11', '2026-09-30 14:17:11'),
(5, 'test', 'test', 'test', 'test', NULL, 1, 1, '2026-10-03 19:49:22', '2026-10-03 19:49:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_settings`
--
ALTER TABLE `about_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `automation_rules`
--
ALTER TABLE `automation_rules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `event_trigger` (`event_trigger`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `booking_code` (`booking_code`);

--
-- Indexes for table `bridal_packages`
--
ALTER TABLE `bridal_packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `communication_logs`
--
ALTER TABLE `communication_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `google_id` (`google_id`);

--
-- Indexes for table `customer_notes`
--
ALTER TABLE `customer_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `template_key` (`template_key`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `follow_ups`
--
ALTER TABLE `follow_ups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footer_links`
--
ALTER TABLE `footer_links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_name` (`group_name`),
  ADD KEY `sort_order` (`sort_order`);

--
-- Indexes for table `footer_settings`
--
ALTER TABLE `footer_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_items`
--
ALTER TABLE `gallery_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homepage_sections`
--
ALTER TABLE `homepage_sections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `section_key` (`section_key`);

--
-- Indexes for table `homepage_services`
--
ALTER TABLE `homepage_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homepage_slides`
--
ALTER TABLE `homepage_slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `integrations_config`
--
ALTER TABLE `integrations_config`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `provider_key` (`provider_key`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice_number` (`invoice_number`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payment_number` (`payment_number`);

--
-- Indexes for table `photoshoot_packages`
--
ALTER TABLE `photoshoot_packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`),
  ADD KEY `category` (`category`),
  ADD KEY `sort_order` (`sort_order`);

--
-- Indexes for table `seo_metadata`
--
ALTER TABLE `seo_metadata`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `page_key` (`page_key`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studio_events`
--
ALTER TABLE `studio_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_members`
--
ALTER TABLE `team_members`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_settings`
--
ALTER TABLE `about_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `automation_rules`
--
ALTER TABLE `automation_rules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `bridal_packages`
--
ALTER TABLE `bridal_packages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `communication_logs`
--
ALTER TABLE `communication_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `customer_notes`
--
ALTER TABLE `customer_notes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `follow_ups`
--
ALTER TABLE `follow_ups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `footer_links`
--
ALTER TABLE `footer_links`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `footer_settings`
--
ALTER TABLE `footer_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gallery_items`
--
ALTER TABLE `gallery_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `homepage_sections`
--
ALTER TABLE `homepage_sections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `homepage_services`
--
ALTER TABLE `homepage_services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `homepage_slides`
--
ALTER TABLE `homepage_slides`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `integrations_config`
--
ALTER TABLE `integrations_config`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `photoshoot_packages`
--
ALTER TABLE `photoshoot_packages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rentals`
--
ALTER TABLE `rentals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `seo_metadata`
--
ALTER TABLE `seo_metadata`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `studio_events`
--
ALTER TABLE `studio_events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `team_members`
--
ALTER TABLE `team_members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
