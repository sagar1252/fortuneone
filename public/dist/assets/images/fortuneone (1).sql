-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2026 at 02:22 PM
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
-- Database: `fortuneone`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `module` varchar(100) NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `browser` text DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `user_name`, `role`, `action`, `module`, `ip_address`, `browser`, `status`, `timestamp`) VALUES
(1, 1, 'admin', 'admin', 'User Logout', 'Auth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'Logged', '2026-06-11 14:18:05'),
(2, 1, 'System / Guest', 'Guest', 'User Login', 'Auth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'Logged', '2026-06-11 14:18:07'),
(3, 1, 'System / Guest', 'Guest', 'User Login', 'Auth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'Logged', '2026-06-12 12:40:14'),
(4, 1, 'admin', 'admin', 'User Logout', 'Auth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'Logged', '2026-06-12 14:49:32'),
(5, 1, 'System / Guest', 'Guest', 'User Login', 'Auth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'Logged', '2026-06-12 14:49:34'),
(6, 1, 'admin', 'admin', 'User Logout', 'Auth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'Logged', '2026-06-12 14:49:47'),
(7, 1, 'System / Guest', 'Guest', 'User Login', 'Auth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'Logged', '2026-06-12 14:59:12'),
(8, 1, 'admin', 'admin', 'User Logout', 'Auth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'Logged', '2026-06-12 16:07:34');

-- --------------------------------------------------------

--
-- Table structure for table `ai_leads`
--

CREATE TABLE `ai_leads` (
  `id` bigint(20) NOT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `buyer_type` varchar(100) DEFAULT NULL,
  `goal` varchar(100) DEFAULT NULL,
  `budget` varchar(100) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `timeline` varchar(100) DEFAULT NULL,
  `priority` varchar(100) DEFAULT NULL,
  `property_type` varchar(100) DEFAULT NULL,
  `interest_level` enum('cold','warm','hot','ready') DEFAULT 'cold',
  `lead_score` int(11) DEFAULT 0,
  `last_project_viewed` varchar(255) DEFAULT NULL,
  `last_action` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `project_name` varchar(255) DEFAULT NULL,
  `appointment_type` varchar(100) DEFAULT NULL,
  `appointment_mode` varchar(100) DEFAULT 'Site Visit',
  `preferred_date` date DEFAULT NULL,
  `preferred_time` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Scheduled',
  `source` varchar(100) DEFAULT 'Website',
  `meeting_link` varchar(500) DEFAULT NULL,
  `advisor_name` varchar(255) DEFAULT NULL,
  `advisor_email` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `internal_notes` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `name`, `phone`, `email`, `project_name`, `appointment_type`, `appointment_mode`, `preferred_date`, `preferred_time`, `status`, `source`, `meeting_link`, `advisor_name`, `advisor_email`, `notes`, `internal_notes`, `created_at`, `updated_at`) VALUES
(1, 'sagar', '09022989386', 'chandanesagar@gmail.com', 'Fortune One', NULL, 'Site Visit', '2026-06-11', '10:30 am', 'Scheduled', 'Website', 'https://meet.google.com/zkr-hfzf-tuo', NULL, NULL, '', NULL, '2026-06-10 17:01:17', '2026-06-10 17:01:17');

-- --------------------------------------------------------

--
-- Table structure for table `career_applications`
--

CREATE TABLE `career_applications` (
  `id` bigint(20) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `position_applied` varchar(255) NOT NULL,
  `current_location` varchar(255) DEFAULT NULL,
  `experience` varchar(100) DEFAULT NULL,
  `current_company` varchar(255) DEFAULT NULL,
  `current_designation` varchar(255) DEFAULT NULL,
  `expected_salary` varchar(100) DEFAULT NULL,
  `notice_period` varchar(100) DEFAULT NULL,
  `linkedin_url` varchar(500) DEFAULT NULL,
  `portfolio_url` varchar(500) DEFAULT NULL,
  `resume_url` varchar(500) DEFAULT NULL,
  `status` varchar(100) DEFAULT 'New',
  `source` varchar(100) DEFAULT 'Website Career Page',
  `notes` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `career_applications`
--

INSERT INTO `career_applications` (`id`, `full_name`, `phone`, `email`, `position_applied`, `current_location`, `experience`, `current_company`, `current_designation`, `expected_salary`, `notice_period`, `linkedin_url`, `portfolio_url`, `resume_url`, `status`, `source`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'Sagar Chandane', '+919022989386', 'chandanesagar@gmail.com', 'Front Office Receptionist', 'Not Specified', 'Not Specified', '', '', '', '', '', '', 'uploads/resumes/1781093673_876095194b8893acea97.pdf', 'Interview Scheduled', 'Website Career Page', '', '2026-06-10 17:45:35', '2026-06-10 17:48:42'),
(2, 'Test User', '+919022989386', 'test@example.com', 'Front Office Receptionist', 'Not Specified', 'Not Specified', '', '', '', '', '', '', 'uploads/resumes/1781093762_2d09dd820ea8835774f6.pdf', 'New', 'Website Career Page', NULL, '2026-06-10 17:47:03', '2026-06-10 17:47:03');

-- --------------------------------------------------------

--
-- Table structure for table `company_settings`
--

CREATE TABLE `company_settings` (
  `id` bigint(20) NOT NULL,
  `setting_key` varchar(255) DEFAULT NULL,
  `setting_value` longtext DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company_settings`
--

INSERT INTO `company_settings` (`id`, `setting_key`, `setting_value`, `updated_at`) VALUES
(9, 'company_name', 'Fortune One', '2026-06-09 12:16:28'),
(10, 'tagline', 'Where Vision Creates Legacy', '2026-06-09 12:16:28'),
(11, 'established_year', '2004', '2026-06-09 12:16:28'),
(12, 'website', 'https://www.fortuneone.co', '2026-06-09 12:16:28'),
(13, 'primary_email', 'reach@fortuneone.co', '2026-06-09 12:16:28'),
(14, 'land_email', 'cbo@fortuneone.co', '2026-06-09 12:16:28'),
(15, 'career_email', 'hr@fortuneone.co', '2026-06-09 12:16:28'),
(16, 'primary_phone', '+91 7996000533', '2026-06-09 12:16:28'),
(17, 'headquarters_city', 'Bengaluru', '2026-06-09 12:16:28'),
(18, 'company_type', 'Real Estate Developer', '2026-06-09 12:16:28'),
(19, 'specialization', 'Premium Plotted Developments, Farm Lands, Villa Plots', '2026-06-09 12:16:28'),
(20, 'advisory_style', 'Consultative', '2026-06-09 12:16:28'),
(21, 'customer_focus', 'Investors, End Users, NRIs', '2026-06-09 12:16:28');

-- --------------------------------------------------------

--
-- Table structure for table `conversation_history`
--

CREATE TABLE `conversation_history` (
  `id` bigint(20) NOT NULL,
  `lead_id` bigint(20) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `role` enum('user','assistant') DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `conversation_history`
--

INSERT INTO `conversation_history` (`id`, `lead_id`, `session_id`, `role`, `message`, `created_at`) VALUES
(1, NULL, 'b61b76c8edb0287404cfdc53002b10a4', 'user', '[SYSTEM: Booking successful for 2026-06-11 at 10:30 am]', '2026-06-10 17:01:29'),
(2, NULL, 'b61b76c8edb0287404cfdc53002b10a4', 'assistant', '{\n  \"type\": \"radio\",\n  \"question\": \"Your appointment is confirmed. An expert will guide you through everything. What else would you like to explore?\",\n  \"options\": [\n    \"View Location Details\",\n    \"View Pricing\",\n    \"View Amenities\"\n  ]\n}', '2026-06-10 17:01:42'),
(3, NULL, 'aa893bb5e29a918c349c8a806c717486', 'user', 'I am looking for the plots', '2026-06-11 11:28:27'),
(4, NULL, 'aa893bb5e29a918c349c8a806c717486', 'assistant', '```json\n{\n  \"type\": \"radio\",\n  \"question\": \"I can certainly help you explore our plotted developments. To provide you with the most relevant information, could you share the primary objective behind your search?\",\n  \"options\": [\n    \"Long-term Investment\",\n    \"Weekend or Holiday Home\",\n    \"Future Family Residence\",\n    \"NRI Portfolio Diversification\",\n    \"Just Exploring\"\n  ]\n}\n```', '2026-06-11 11:28:29'),
(5, NULL, 'test_session_123', 'user', 'Hello Kesari', '2026-06-11 14:20:03'),
(6, NULL, 'test_session_123', 'assistant', '```json\n{\n  \"type\": \"radio\",\n  \"question\": \"Hello! I am here to help you make a confident, well-informed decision regarding your real estate journey with Fortune One. To ensure I provide the most relevant information, could you share what brings you to us today?\",\n  \"options\": [\n    \"Long-term Investment\",\n    \"Weekend or Holiday Home\",\n    \"Future Family Residence\",\n    \"NRI Portfolio Diversification\",\n    \"Just Exploring\"\n  ]\n}\n```', '2026-06-11 14:20:04'),
(7, NULL, '77f00754c5994ea098ab722bb807f377', 'user', 'hello', '2026-06-11 14:21:18'),
(8, NULL, '77f00754c5994ea098ab722bb807f377', 'assistant', '```json\n{\n  \"type\": \"radio\",\n  \"question\": \"Welcome to Fortune One. We have been helping families and investors create legacies in Bengaluru for over 20 years. To ensure I provide you with the most relevant guidance, could you share what brings you to us today?\",\n  \"options\": [\n    \"Long-term Investment\",\n    \"Weekend or Holiday Home\",\n    \"Future Family Residence\",\n    \"NRI Portfolio Diversification\",\n    \"Just Exploring\"\n  ]\n}\n```', '2026-06-11 14:21:20'),
(9, NULL, 'eb7408f66c90ae84f51f2030d580c496', 'user', 'HI AM LOOKKING FOR THE FARMALAND', '2026-06-12 11:46:45'),
(10, NULL, 'eb7408f66c90ae84f51f2030d580c496', 'assistant', '```json\n{\n  \"type\": \"radio\",\n  \"question\": \"To help you evaluate the right opportunities, could you share a bit more about your objective and what you envision for the property?\",\n  \"options\": [\n    \"Long-term Investment (Appreciation)\",\n    \"Weekend Retreat / Holiday Home\",\n    \"Future Farmhouse / Legacy\",\n    \"Portfolio Diversification (NRI)\"\n  ]\n}\n```', '2026-06-12 11:46:46'),
(11, NULL, '7a74a6643fc7b2964cf43b74e0a8b6cf', 'user', 'hello', '2026-06-12 14:41:43'),
(12, NULL, '7a74a6643fc7b2964cf43b74e0a8b6cf', 'assistant', '```json\n{\n  \"type\": \"radio\",\n  \"question\": \"Hello! I\'m here to help you make a confident, well-informed decision about your property search. To start, what is the primary purpose behind your interest in real estate?\",\n  \"options\": [\n    \"Long-term Investment\",\n    \"Weekend or Holiday Home\",\n    \"Future Family Residence\",\n    \"NRI Portfolio Diversification\",\n    \"Just Exploring\"\n  ]\n}\n```', '2026-06-12 14:41:44'),
(13, NULL, '7a74a6643fc7b2964cf43b74e0a8b6cf', 'user', 'NRI Portfolio Diversification', '2026-06-12 14:42:09'),
(14, NULL, '7a74a6643fc7b2964cf43b74e0a8b6cf', 'assistant', '```json\n{\n  \"type\": \"radio\",\n  \"question\": \"Understood. For NRI portfolio diversification, selecting the right asset type is key to balancing growth and ease of management. What type of asset are you considering?\",\n  \"options\": [\n    \"Farmland\",\n    \"Villa Plot\",\n    \"Residential Plot\",\n    \"Open to Suggestions\"\n  ]\n}\n```', '2026-06-12 14:42:10'),
(15, NULL, '7a74a6643fc7b2964cf43b74e0a8b6cf', 'user', 'Farmland', '2026-06-12 14:42:17'),
(16, NULL, '7a74a6643fc7b2964cf43b74e0a8b6cf', 'assistant', '```json\n{\n  \"type\": \"radio\",\n  \"question\": \"Farmland can be a unique addition to a portfolio, offering both potential capital appreciation and a tangible legacy asset. How do you envision using this property in the long term?\",\n  \"options\": [\n    \"Long-term Appreciation\",\n    \"Future Farmhouse Development\",\n    \"Legacy for Family\",\n    \"Weekend Retreat\"\n  ]\n}\n```', '2026-06-12 14:42:18'),
(17, NULL, '7a74a6643fc7b2964cf43b74e0a8b6cf', 'user', 'Legacy for Family', '2026-06-12 14:42:26'),
(18, NULL, '7a74a6643fc7b2964cf43b74e0a8b6cf', 'assistant', '```json\n{\n  \"type\": \"radio\",\n  \"question\": \"Creating a legacy for your family through land ownership is a significant step. Based on your interest in farmland for long-term legacy, Fortune One EshaVana in Hesaragatta is an opportunity worth exploring. It is a premium farmland project with plot sizes ranging from 6,000 to 12,000 sqft, starting at ₹93 Lakhs. What would you like to know more about?\",\n  \"options\": [\n    \"Location & Connectivity\",\n    \"Pricing & Investment Potential\",\n    \"Legal & Development Details\",\n    \"Speak With An Advisor\"\n  ]\n}\n```', '2026-06-12 14:42:27'),
(19, NULL, '7a74a6643fc7b2964cf43b74e0a8b6cf', 'user', 'Speak With An Advisor', '2026-06-12 14:42:35'),
(20, NULL, '7a74a6643fc7b2964cf43b74e0a8b6cf', 'assistant', '$$SHOW_BOOKING_POPUP$$', '2026-06-12 14:42:37'),
(21, NULL, 'f3f722df7df61ada34e3cce29ec39e8f', 'user', 'hi', '2026-06-12 14:58:11'),
(22, NULL, 'f3f722df7df61ada34e3cce29ec39e8f', 'assistant', '```json\n{\n  \"type\": \"radio\",\n  \"question\": \"Hello! I am here to help you make a confident decision regarding your real estate journey. To get started, could you share what brings you here today?\",\n  \"options\": [\n    \"Long-term Investment\",\n    \"Weekend or Holiday Home\",\n    \"Future Family Residence\",\n    \"NRI Portfolio Diversification\",\n    \"Just Exploring\"\n  ]\n}\n```', '2026-06-12 14:58:12'),
(23, NULL, 'f3f722df7df61ada34e3cce29ec39e8f', 'user', 'Just Exploring', '2026-06-12 14:58:21'),
(24, NULL, 'f3f722df7df61ada34e3cce29ec39e8f', 'assistant', '```json\n{\n  \"type\": \"radio\",\n  \"question\": \"That\'s a great place to start. Many people exploring real estate look at different asset types before deciding where to focus their interest. What type of property are you currently curious about?\",\n  \"options\": [\n    \"Villa Plots\",\n    \"Farmland\",\n    \"Open to Suggestions\"\n  ]\n}\n```', '2026-06-12 14:58:23'),
(25, NULL, 'f3f722df7df61ada34e3cce29ec39e8f', 'user', 'Open to Suggestions', '2026-06-12 14:58:27'),
(26, NULL, 'f3f722df7df61ada34e3cce29ec39e8f', 'assistant', '```json\n{\n  \"type\": \"radio\",\n  \"question\": \"To help you navigate the options, it is helpful to understand your vision. How do you ultimately envision using the property you might acquire?\",\n  \"options\": [\n    \"Long-term Appreciation\",\n    \"Build a Home\",\n    \"Weekend Retreat\",\n    \"Legacy for Family\",\n    \"Rental Income\"\n  ]\n}\n```', '2026-06-12 14:58:30'),
(27, NULL, 'f3f722df7df61ada34e3cce29ec39e8f', 'user', 'Weekend Retreat', '2026-06-12 14:58:36'),
(28, NULL, 'f3f722df7df61ada34e3cce29ec39e8f', 'assistant', '```json\n{\n  \"type\": \"radio\",\n  \"question\": \"Thank you for sharing that. With your goal of a weekend retreat, you have two distinct paths worth exploring. Fortune One currently has two projects that cater to different lifestyle preferences:\\n\\n1. Fortune One Vistaa (Near Nandi Hills): Boutique villa plots (1200-1500 sqft) designed for convenience and community, starting at ₹33.5 Lakhs.\\n\\n2. Fortune One EshaVana (Hesaragatta): Premium farmlands (6000-12000 sqft) offering space, nature, and tranquility, starting at ₹93 Lakhs.\\n\\nWhich of these would you like to explore further?\",\n  \"options\": [\n    \"Explore Vistaa (Villa Plots)\",\n    \"Explore EshaVana (Farmland)\",\n    \"Compare Both Side by Side\",\n    \"Speak With An Advisor\"\n  ]\n}\n```', '2026-06-12 14:58:38'),
(29, NULL, 'c0cf324934b6608366b9a58d551f1aec', 'user', 'gsgrg', '2026-06-12 17:28:52'),
(30, NULL, 'c0cf324934b6608366b9a58d551f1aec', 'assistant', '{\n  \"type\": \"radio\",\n  \"question\": \"Hello! I\'m here to help you make a confident decision regarding your real estate journey with Fortune One. To get started, what is the primary purpose behind your interest in property right now?\",\n  \"options\": [\n    \"Long-term Investment\",\n    \"Weekend or Holiday Home\",\n    \"Future Family Residence\",\n    \"NRI Portfolio Diversification\",\n    \"Just Exploring\"\n  ]\n}', '2026-06-12 17:28:54');

-- --------------------------------------------------------

--
-- Table structure for table `crm_notifications`
--

CREATE TABLE `crm_notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `type` varchar(50) DEFAULT 'info',
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crm_notifications`
--

INSERT INTO `crm_notifications` (`id`, `user_id`, `title`, `message`, `type`, `is_read`, `created_at`) VALUES
(1, NULL, 'Welcome to Fortune One CRM!', 'Your notification system is now fully active. You will receive important alerts here.', 'success', 1, '2026-06-11 05:42:53');

-- --------------------------------------------------------

--
-- Table structure for table `crm_users`
--

CREATE TABLE `crm_users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `status` varchar(50) DEFAULT 'Active',
  `avatar_url` varchar(500) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `permissions` text DEFAULT NULL,
  `reset_token` varchar(64) DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crm_users`
--

INSERT INTO `crm_users` (`id`, `name`, `email`, `password`, `role`, `status`, `avatar_url`, `created_at`, `updated_at`, `permissions`, `reset_token`, `reset_token_expires_at`) VALUES
(1, 'admin', 'sagarc1252@gmail.com', '$2y$10$pKSiEsiehAEXXfEiBaLqwen9U8VwfddzEy899y9T6hK2BUi5rnooe', 'admin', 'Active', 'https://lh3.googleusercontent.com/aida-public/AB6AXuBKCdo1-F9jYW6cQsyr0gvrCWklceZcZlx2PbYPfULukTIT6gzYPB1i9zOEbAGDCs7F-xUX4MLSuClw7SEVVVi7cuX9aOiLFw4dukjZfZQCu8n-Bn9xznU2fyuXnBPCtH5DCJlig4c52AH8V9g6kwyCyQmprcFoIiTe9H9mvtZh6vLxjohLxcVL5U3xSy5QojRVM8AANN_ixGAsHUqUtHIcvHfCgknyzkeWaKTquq_suauOSAcynxmULlZhRmouHYhjuAdlsgdT_6U', '2026-06-10 11:46:19', '2026-06-11 11:59:18', '[\"dashboard_access\",\"appointments_access\",\"appointments_manage\",\"careers_access\",\"careers_manage\",\"enquiries_access\",\"enquiries_manage\",\"users_manage\"]', NULL, NULL),
(2, 'Land & Collaboration', 'cbo@fortuneone.co', '$2y$10$bIkWb2zP56vzb/byktjrGOyp3fuD1kon1.9nDnDnecCdQN2aFCvQ6', 'Administrator', 'Active', NULL, '2026-06-10 11:46:19', '2026-06-11 09:56:41', '[\"dashboard_access\",\"appointments_access\",\"appointments_manage\",\"careers_manage\",\"enquiries_access\",\"enquiries_manage\",\"users_manage\"]', NULL, NULL),
(3, 'Sales and Support', 'reach@fortuneone.co', '$2y$10$bIkWb2zP56vzb/byktjrGOyp3fuD1kon1.9nDnDnecCdQN2aFCvQ6', 'Sales', 'Active', NULL, '2026-06-10 11:46:19', '2026-06-10 17:37:11', '[\"dashboard_access\",\"appointments_access\",\"appointments_manage\",\"enquiries_access\",\"enquiries_manage\"]', NULL, NULL),
(4, 'Career', 'hr@fortuneone.co', '$2y$10$bIkWb2zP56vzb/byktjrGOyp3fuD1kon1.9nDnDnecCdQN2aFCvQ6', 'HR', 'Active', NULL, '2026-06-10 11:46:19', '2026-06-10 17:37:11', '[\"dashboard_access\",\"careers_access\",\"careers_manage\"]', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` enum('New','Read','Replied','Closed') DEFAULT 'New',
  `source` varchar(100) DEFAULT 'Website Contact Form',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enquiries`
--

INSERT INTO `enquiries` (`id`, `full_name`, `phone`, `email`, `subject`, `message`, `status`, `source`, `created_at`, `updated_at`) VALUES
(1, 'sagar', '09022989386', 'sagarc1252@gmail.com', 'Test', 'Test', 'New', 'Website Contact Form', '2026-06-10 11:54:59', '2026-06-10 11:54:59'),
(2, 'sagar', '09022989386', 'sagarc1252@gmail.com', 'Test', 'Test', 'Read', 'Website Contact Form', '2026-06-10 11:55:01', '2026-06-10 11:55:29'),
(3, 'sagar', '09022989386', 'sagarc1252@gmail.com', 'Test', 'Test', 'Read', 'Website Contact Form', '2026-06-10 11:55:03', '2026-06-11 04:25:49');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `overview` longtext DEFAULT NULL,
  `airport_distance` varchar(100) DEFAULT NULL,
  `city_distance` varchar(100) DEFAULT NULL,
  `growth_factors` longtext DEFAULT NULL,
  `infrastructure` longtext DEFAULT NULL,
  `schools` longtext DEFAULT NULL,
  `hospitals` longtext DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `overview`, `airport_distance`, `city_distance`, `growth_factors`, `infrastructure`, `schools`, `hospitals`, `created_at`, `updated_at`) VALUES
(1, 'Hesaragatta', 'Premium green corridor known for open landscapes, nature-focused developments and long-term land ownership opportunities.', '38 KM', 'Approx 25 KM', 'Metro expansion, STRR connectivity, airport accessibility, tourism and conservation-led growth.', 'STRR, Metro expansion, improved road connectivity.', 'Schools available within driving distance.', 'Hospitals available within driving distance.', '2026-06-09 12:17:05', '2026-06-09 12:17:05'),
(2, 'Nandi Hills', 'One of the most sought-after lifestyle and second-home destinations near Bengaluru.', 'Approx 30-40 Minutes', 'Approx 60 KM', 'Limited land supply, tourism growth, luxury second-home demand, premium lifestyle appeal.', 'Road upgrades, hospitality investments, tourism infrastructure.', 'International schools nearby.', 'Hospitals nearby.', '2026-06-09 12:17:22', '2026-06-09 12:17:22'),
(3, 'Devanahalli', 'Airport-led growth corridor attracting commercial, logistics and residential investment.', 'Near Kempegowda International Airport', 'Approx 40 KM', 'Airport expansion, business parks, aerospace ecosystem, logistics growth.', 'Metro, STRR, Aerospace Park, Business Parks.', 'International schools nearby.', 'Hospitals nearby.', '2026-06-09 12:17:32', '2026-06-09 12:17:32'),
(4, 'Chikkaballapur', 'Emerging growth corridor benefiting from proximity to Nandi Hills and airport-driven development.', 'Approx 30 KM', 'Approx 60 KM', 'Tourism, residential demand, infrastructure expansion and lifestyle-driven investments.', 'Highway connectivity and regional infrastructure projects.', 'Schools available nearby.', 'Hospitals available nearby.', '2026-06-09 12:17:40', '2026-06-09 12:17:40');

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
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2026-06-11-074200', 'App\\Database\\Migrations\\CreateActivityLogs', 'default', 'App', 1781163796, 1);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `project_type` varchar(100) DEFAULT NULL,
  `location_id` bigint(20) DEFAULT NULL,
  `starting_price` decimal(15,2) DEFAULT NULL,
  `max_price` decimal(15,2) DEFAULT NULL,
  `plot_sizes` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `investment_angle` text DEFAULT NULL,
  `target_buyer` text DEFAULT NULL,
  `risk_level` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `brochure_url` varchar(500) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `slug`, `project_type`, `location_id`, `starting_price`, `max_price`, `plot_sizes`, `description`, `investment_angle`, `target_buyer`, `risk_level`, `status`, `brochure_url`, `created_at`, `updated_at`) VALUES
(1, 'EshaVana', 'eshavana', 'Premium Farm Land', 1, 9300000.00, NULL, '6000-12000 Sq Ft', 'Premium farm land community focused on nature, long-term ownership and future farmhouse development.', 'Long-term land ownership and capital appreciation', 'Investors, NRIs, Weekend Home Buyers', 'Moderate', 'Pre Launch', NULL, '2026-06-09 12:18:51', '2026-06-09 12:18:51'),
(2, 'Vistaa', 'vistaa', 'Premium Villa Plot', 4, 3350000.00, NULL, '1200-1500 Sq Ft', 'Premium villa plot development designed for future home construction and long-term ownership.', 'Capital appreciation and future home development', 'Families, Investors, End Users', 'Low', 'Selling Fast', NULL, '2026-06-09 12:19:01', '2026-06-09 12:19:01'),
(3, 'Skylark', 'skylark', 'Agri Plot', 3, NULL, NULL, NULL, 'Agri plot development in the Devanahalli growth corridor.', NULL, NULL, NULL, 'Sold Out', NULL, '2026-06-09 12:19:10', '2026-06-09 12:19:10'),
(4, 'Pyramid', 'pyramid', 'Residential Development', 3, NULL, NULL, NULL, 'Residential real estate development in North Bengaluru.', NULL, NULL, NULL, 'Ongoing', NULL, '2026-06-09 12:19:19', '2026-06-09 12:19:19');

-- --------------------------------------------------------

--
-- Table structure for table `project_amenities`
--

CREATE TABLE `project_amenities` (
  `id` bigint(20) NOT NULL,
  `project_id` bigint(20) DEFAULT NULL,
  `amenity_name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_amenities`
--

INSERT INTO `project_amenities` (`id`, `project_id`, `amenity_name`, `created_at`) VALUES
(1, 1, 'Clubhouse', '2026-06-09 12:20:31'),
(2, 1, 'Swimming Pool', '2026-06-09 12:20:31'),
(3, 1, 'Indoor Games', '2026-06-09 12:20:31'),
(4, 1, 'Kids Play Area', '2026-06-09 12:20:31'),
(5, 1, 'Multipurpose Lawn', '2026-06-09 12:20:31'),
(6, 1, 'Barbecue Area', '2026-06-09 12:20:31'),
(7, 1, 'Gazebo', '2026-06-09 12:20:31'),
(8, 1, 'Yoga Deck', '2026-06-09 12:20:31'),
(9, 1, 'Vegetable Garden', '2026-06-09 12:20:31'),
(10, 1, 'Basketball Court', '2026-06-09 12:20:31'),
(11, 1, 'Cricket Nets', '2026-06-09 12:20:31'),
(12, 2, 'Clubhouse', '2026-06-09 12:20:31'),
(13, 2, 'Swimming Pool', '2026-06-09 12:20:31'),
(14, 2, 'Kids Pool', '2026-06-09 12:20:31'),
(15, 2, 'Gym', '2026-06-09 12:20:31'),
(16, 2, 'Library', '2026-06-09 12:20:31'),
(17, 2, 'Business Centre', '2026-06-09 12:20:31'),
(18, 2, 'Co Working Space', '2026-06-09 12:20:31'),
(19, 2, 'Cafe', '2026-06-09 12:20:31'),
(20, 2, 'Yoga Lawn', '2026-06-09 12:20:31'),
(21, 2, 'Outdoor Gym', '2026-06-09 12:20:31'),
(22, 2, 'Jogging Track', '2026-06-09 12:20:31'),
(23, 2, 'EV Charging', '2026-06-09 12:20:31'),
(24, 2, 'Pet Zone', '2026-06-09 12:20:31'),
(25, 2, 'Banquet Hall', '2026-06-09 12:20:31'),
(26, 2, 'Cricket Nets', '2026-06-09 12:20:31');

-- --------------------------------------------------------

--
-- Table structure for table `project_features`
--

CREATE TABLE `project_features` (
  `id` bigint(20) NOT NULL,
  `project_id` bigint(20) NOT NULL,
  `feature_name` varchar(255) NOT NULL,
  `feature_value` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_features`
--

INSERT INTO `project_features` (`id`, `project_id`, `feature_name`, `feature_value`, `created_at`) VALUES
(1, 1, 'Asset Class', 'Premium Farm Land', '2026-06-09 12:12:16'),
(2, 1, 'Investment Style', 'Land Banking', '2026-06-09 12:12:16'),
(3, 1, 'Ownership Type', 'Freehold', '2026-06-09 12:12:16'),
(4, 1, 'Buyer Profile', 'Investor', '2026-06-09 12:12:16'),
(5, 1, 'Buyer Profile', 'NRI', '2026-06-09 12:12:16'),
(6, 1, 'Buyer Profile', 'Weekend Home Buyer', '2026-06-09 12:12:16'),
(7, 1, 'Investment Horizon', 'Long Term', '2026-06-09 12:12:16'),
(8, 1, 'Primary Benefit', 'Capital Appreciation', '2026-06-09 12:12:16'),
(9, 1, 'Primary Benefit', 'Lifestyle Ownership', '2026-06-09 12:12:16'),
(10, 1, 'Primary Benefit', 'Legacy Creation', '2026-06-09 12:12:16'),
(11, 1, 'Use Case', 'Weekend Retreat', '2026-06-09 12:12:16'),
(12, 1, 'Use Case', 'Future Farmhouse', '2026-06-09 12:12:16'),
(13, 1, 'Use Case', 'Portfolio Diversification', '2026-06-09 12:12:16'),
(14, 1, 'Community Type', 'Low Density', '2026-06-09 12:12:16'),
(15, 1, 'Scarcity Factor', 'Limited Inventory', '2026-06-09 12:12:16'),
(16, 2, 'Asset Class', 'Villa Plot', '2026-06-09 12:12:27'),
(17, 2, 'Investment Style', 'Build Ready', '2026-06-09 12:12:27'),
(18, 2, 'Ownership Type', 'Freehold', '2026-06-09 12:12:27'),
(19, 2, 'Buyer Profile', 'Family', '2026-06-09 12:12:27'),
(20, 2, 'Buyer Profile', 'End User', '2026-06-09 12:12:27'),
(21, 2, 'Buyer Profile', 'Investor', '2026-06-09 12:12:27'),
(22, 2, 'Investment Horizon', 'Medium To Long Term', '2026-06-09 12:12:27'),
(23, 2, 'Primary Benefit', 'Future Home', '2026-06-09 12:12:27'),
(24, 2, 'Primary Benefit', 'Capital Appreciation', '2026-06-09 12:12:27'),
(25, 2, 'Use Case', 'Self Construction', '2026-06-09 12:12:27'),
(26, 2, 'Use Case', 'Retirement Home', '2026-06-09 12:12:27'),
(27, 2, 'Community Type', 'Gated Community', '2026-06-09 12:12:27'),
(28, 1, 'Asset Class', 'Premium Farm Land', '2026-06-09 12:20:48'),
(29, 1, 'Ownership Type', 'Freehold', '2026-06-09 12:20:48'),
(30, 1, 'Project Status', 'Pre Launch', '2026-06-09 12:20:48'),
(31, 1, 'Investment Horizon', 'Long Term', '2026-06-09 12:20:48'),
(32, 1, 'Use Case', 'Weekend Home', '2026-06-09 12:20:48'),
(33, 1, 'Use Case', 'Future Farmhouse', '2026-06-09 12:20:48'),
(34, 1, 'Use Case', 'Land Banking', '2026-06-09 12:20:48'),
(35, 1, 'Target Buyer', 'Investor', '2026-06-09 12:20:48'),
(36, 1, 'Target Buyer', 'NRI', '2026-06-09 12:20:48'),
(37, 1, 'Target Buyer', 'Weekend Home Buyer', '2026-06-09 12:20:48'),
(38, 1, 'Community Type', 'Low Density', '2026-06-09 12:20:48'),
(39, 1, 'Plot Size', '6000-12000 Sq Ft', '2026-06-09 12:20:48'),
(40, 2, 'Asset Class', 'Premium Villa Plot', '2026-06-09 12:20:48'),
(41, 2, 'Ownership Type', 'Freehold', '2026-06-09 12:20:48'),
(42, 2, 'Project Status', 'Selling Fast', '2026-06-09 12:20:48'),
(43, 2, 'Investment Horizon', 'Medium To Long Term', '2026-06-09 12:20:48'),
(44, 2, 'Use Case', 'Future Home', '2026-06-09 12:20:48'),
(45, 2, 'Use Case', 'Investment', '2026-06-09 12:20:48'),
(46, 2, 'Use Case', 'Retirement Home', '2026-06-09 12:20:48'),
(47, 2, 'Target Buyer', 'Family', '2026-06-09 12:20:48'),
(48, 2, 'Target Buyer', 'Investor', '2026-06-09 12:20:48'),
(49, 2, 'Target Buyer', 'End User', '2026-06-09 12:20:48'),
(50, 2, 'Community Type', 'Gated Community', '2026-06-09 12:20:48'),
(51, 2, 'Plot Size', '1200-1500 Sq Ft', '2026-06-09 12:20:48'),
(52, 3, 'Asset Class', 'Agri Plot', '2026-06-09 12:20:48'),
(53, 3, 'Project Status', 'Sold Out', '2026-06-09 12:20:48'),
(54, 4, 'Asset Class', 'Residential Development', '2026-06-09 12:20:48'),
(55, 4, 'Project Status', 'Ongoing', '2026-06-09 12:20:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ai_leads`
--
ALTER TABLE `ai_leads`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `session_id` (`session_id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `career_applications`
--
ALTER TABLE `career_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_settings`
--
ALTER TABLE `company_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting_key` (`setting_key`);

--
-- Indexes for table `conversation_history`
--
ALTER TABLE `conversation_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crm_notifications`
--
ALTER TABLE `crm_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crm_users`
--
ALTER TABLE `crm_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_amenities`
--
ALTER TABLE `project_amenities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_features`
--
ALTER TABLE `project_features`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ai_leads`
--
ALTER TABLE `ai_leads`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `career_applications`
--
ALTER TABLE `career_applications`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `company_settings`
--
ALTER TABLE `company_settings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `conversation_history`
--
ALTER TABLE `conversation_history`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `crm_notifications`
--
ALTER TABLE `crm_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `crm_users`
--
ALTER TABLE `crm_users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `project_amenities`
--
ALTER TABLE `project_amenities`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `project_features`
--
ALTER TABLE `project_features`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
