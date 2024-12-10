-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 10, 2024 at 09:27 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_online_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(36, 'zara', 'zara', 1, '2024-03-12 00:26:29', '2024-03-12 00:26:29'),
(37, 'H&M', 'h-m', 1, '2024-03-12 00:26:46', '2024-03-12 00:26:46'),
(38, 'archies', 'archies', 1, '2024-03-12 00:26:57', '2024-03-12 00:26:57'),
(39, 'Apple', 'apple', 1, '2024-03-12 01:19:56', '2024-03-12 01:19:56'),
(40, 'Dell', 'dell', 1, '2024-03-12 01:20:06', '2024-03-12 01:20:06'),
(41, 'puma', 'puma', 1, '2024-03-12 01:20:14', '2024-03-12 01:20:14'),
(42, 'onePlus', 'oneplus', 1, '2024-03-12 01:20:24', '2024-03-12 01:20:34'),
(43, 'Samsung', 'samsung', 1, '2024-03-12 01:20:45', '2024-03-12 01:20:45');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `showHome` enum('Yes','No') NOT NULL DEFAULT 'No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `status`, `showHome`, `created_at`, `updated_at`) VALUES
(1, 'clothes', 'clothes', '1-1710175945.png', 1, 'Yes', '2024-03-05 06:11:06', '2024-03-11 11:22:25'),
(194, 'Laptop', 'laptop', '194.jpg', 1, 'Yes', '2024-03-12 01:16:11', '2024-03-12 01:16:11'),
(199, 'sadas', 'sadas', NULL, 1, 'Yes', '2024-04-19 06:47:15', '2024-04-19 06:47:15');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'United States', 'US', NULL, NULL),
(2, 'Canada', 'CA', NULL, NULL),
(3, 'Afghanistan', 'AF', NULL, NULL),
(4, 'Albania', 'AL', NULL, NULL),
(5, 'Algeria', 'DZ', NULL, NULL),
(6, 'American Samoa', 'AS', NULL, NULL),
(7, 'Andorra', 'AD', NULL, NULL),
(8, 'Angola', 'AO', NULL, NULL),
(9, 'Anguilla', 'AI', NULL, NULL),
(10, 'Antarctica', 'AQ', NULL, NULL),
(11, 'Antigua and/or Barbuda', 'AG', NULL, NULL),
(12, 'Argentina', 'AR', NULL, NULL),
(13, 'Armenia', 'AM', NULL, NULL),
(14, 'Aruba', 'AW', NULL, NULL),
(15, 'Australia', 'AU', NULL, NULL),
(16, 'Austria', 'AT', NULL, NULL),
(17, 'Azerbaijan', 'AZ', NULL, NULL),
(18, 'Bahamas', 'BS', NULL, NULL),
(19, 'Bahrain', 'BH', NULL, NULL),
(20, 'Bangladesh', 'BD', NULL, NULL),
(21, 'Barbados', 'BB', NULL, NULL),
(22, 'Belarus', 'BY', NULL, NULL),
(23, 'Belgium', 'BE', NULL, NULL),
(24, 'Belize', 'BZ', NULL, NULL),
(25, 'Benin', 'BJ', NULL, NULL),
(26, 'Bermuda', 'BM', NULL, NULL),
(27, 'Bhutan', 'BT', NULL, NULL),
(28, 'Bolivia', 'BO', NULL, NULL),
(29, 'Bosnia and Herzegovina', 'BA', NULL, NULL),
(30, 'Botswana', 'BW', NULL, NULL),
(31, 'Bouvet Island', 'BV', NULL, NULL),
(32, 'Brazil', 'BR', NULL, NULL),
(33, 'British lndian Ocean Territory', 'IO', NULL, NULL),
(34, 'Brunei Darussalam', 'BN', NULL, NULL),
(35, 'Bulgaria', 'BG', NULL, NULL),
(36, 'Burkina Faso', 'BF', NULL, NULL),
(37, 'Burundi', 'BI', NULL, NULL),
(38, 'Cambodia', 'KH', NULL, NULL),
(39, 'Cameroon', 'CM', NULL, NULL),
(40, 'Cape Verde', 'CV', NULL, NULL),
(41, 'Cayman Islands', 'KY', NULL, NULL),
(42, 'Central African Republic', 'CF', NULL, NULL),
(43, 'Chad', 'TD', NULL, NULL),
(44, 'Chile', 'CL', NULL, NULL),
(45, 'China', 'CN', NULL, NULL),
(46, 'Christmas Island', 'CX', NULL, NULL),
(47, 'Cocos (Keeling) Islands', 'CC', NULL, NULL),
(48, 'Colombia', 'CO', NULL, NULL),
(49, 'Comoros', 'KM', NULL, NULL),
(50, 'Congo', 'CG', NULL, NULL),
(51, 'Cook Islands', 'CK', NULL, NULL),
(52, 'Costa Rica', 'CR', NULL, NULL),
(53, 'Croatia (Hrvatska)', 'HR', NULL, NULL),
(54, 'Cuba', 'CU', NULL, NULL),
(55, 'Cyprus', 'CY', NULL, NULL),
(56, 'Czech Republic', 'CZ', NULL, NULL),
(57, 'Democratic Republic of Congo', 'CD', NULL, NULL),
(58, 'Denmark', 'DK', NULL, NULL),
(59, 'Djibouti', 'DJ', NULL, NULL),
(60, 'Dominica', 'DM', NULL, NULL),
(61, 'Dominican Republic', 'DO', NULL, NULL),
(62, 'East Timor', 'TP', NULL, NULL),
(63, 'Ecudaor', 'EC', NULL, NULL),
(64, 'Egypt', 'EG', NULL, NULL),
(65, 'El Salvador', 'SV', NULL, NULL),
(66, 'Equatorial Guinea', 'GQ', NULL, NULL),
(67, 'Eritrea', 'ER', NULL, NULL),
(68, 'Estonia', 'EE', NULL, NULL),
(69, 'Ethiopia', 'ET', NULL, NULL),
(70, 'Falkland Islands (Malvinas)', 'FK', NULL, NULL),
(71, 'Faroe Islands', 'FO', NULL, NULL),
(72, 'Fiji', 'FJ', NULL, NULL),
(73, 'Finland', 'FI', NULL, NULL),
(74, 'France', 'FR', NULL, NULL),
(75, 'France, Metropolitan', 'FX', NULL, NULL),
(76, 'French Guiana', 'GF', NULL, NULL),
(77, 'French Polynesia', 'PF', NULL, NULL),
(78, 'French Southern Territories', 'TF', NULL, NULL),
(79, 'Gabon', 'GA', NULL, NULL),
(80, 'Gambia', 'GM', NULL, NULL),
(81, 'Georgia', 'GE', NULL, NULL),
(82, 'Germany', 'DE', NULL, NULL),
(83, 'Ghana', 'GH', NULL, NULL),
(84, 'Gibraltar', 'GI', NULL, NULL),
(85, 'Greece', 'GR', NULL, NULL),
(86, 'Greenland', 'GL', NULL, NULL),
(87, 'Grenada', 'GD', NULL, NULL),
(88, 'Guadeloupe', 'GP', NULL, NULL),
(89, 'Guam', 'GU', NULL, NULL),
(90, 'Guatemala', 'GT', NULL, NULL),
(91, 'Guinea', 'GN', NULL, NULL),
(92, 'Guinea-Bissau', 'GW', NULL, NULL),
(93, 'Guyana', 'GY', NULL, NULL),
(94, 'Haiti', 'HT', NULL, NULL),
(95, 'Heard and Mc Donald Islands', 'HM', NULL, NULL),
(96, 'Honduras', 'HN', NULL, NULL),
(97, 'Hong Kong', 'HK', NULL, NULL),
(98, 'Hungary', 'HU', NULL, NULL),
(99, 'Iceland', 'IS', NULL, NULL),
(100, 'India', 'IN', NULL, NULL),
(101, 'Indonesia', 'ID', NULL, NULL),
(102, 'Iran (Islamic Republic of)', 'IR', NULL, NULL),
(103, 'Iraq', 'IQ', NULL, NULL),
(104, 'Ireland', 'IE', NULL, NULL),
(105, 'Israel', 'IL', NULL, NULL),
(106, 'Italy', 'IT', NULL, NULL),
(107, 'Ivory Coast', 'CI', NULL, NULL),
(108, 'Jamaica', 'JM', NULL, NULL),
(109, 'Japan', 'JP', NULL, NULL),
(110, 'Jordan', 'JO', NULL, NULL),
(111, 'Kazakhstan', 'KZ', NULL, NULL),
(112, 'Kenya', 'KE', NULL, NULL),
(113, 'Kiribati', 'KI', NULL, NULL),
(114, 'Korea, Democratic People\'s Republic of', 'KP', NULL, NULL),
(115, 'Korea, Republic of', 'KR', NULL, NULL),
(116, 'Kuwait', 'KW', NULL, NULL),
(117, 'Kyrgyzstan', 'KG', NULL, NULL),
(118, 'Lao People\'s Democratic Republic', 'LA', NULL, NULL),
(119, 'Latvia', 'LV', NULL, NULL),
(120, 'Lebanon', 'LB', NULL, NULL),
(121, 'Lesotho', 'LS', NULL, NULL),
(122, 'Liberia', 'LR', NULL, NULL),
(123, 'Libyan Arab Jamahiriya', 'LY', NULL, NULL),
(124, 'Liechtenstein', 'LI', NULL, NULL),
(125, 'Lithuania', 'LT', NULL, NULL),
(126, 'Luxembourg', 'LU', NULL, NULL),
(127, 'Macau', 'MO', NULL, NULL),
(128, 'Macedonia', 'MK', NULL, NULL),
(129, 'Madagascar', 'MG', NULL, NULL),
(130, 'Malawi', 'MW', NULL, NULL),
(131, 'Malaysia', 'MY', NULL, NULL),
(132, 'Maldives', 'MV', NULL, NULL),
(133, 'Mali', 'ML', NULL, NULL),
(134, 'Malta', 'MT', NULL, NULL),
(135, 'Marshall Islands', 'MH', NULL, NULL),
(136, 'Martinique', 'MQ', NULL, NULL),
(137, 'Mauritania', 'MR', NULL, NULL),
(138, 'Mauritius', 'MU', NULL, NULL),
(139, 'Mayotte', 'TY', NULL, NULL),
(140, 'Mexico', 'MX', NULL, NULL),
(141, 'Micronesia, Federated States of', 'FM', NULL, NULL),
(142, 'Moldova, Republic of', 'MD', NULL, NULL),
(143, 'Monaco', 'MC', NULL, NULL),
(144, 'Mongolia', 'MN', NULL, NULL),
(145, 'Montserrat', 'MS', NULL, NULL),
(146, 'Morocco', 'MA', NULL, NULL),
(147, 'Mozambique', 'MZ', NULL, NULL),
(148, 'Myanmar', 'MM', NULL, NULL),
(149, 'Namibia', 'NA', NULL, NULL),
(150, 'Nauru', 'NR', NULL, NULL),
(151, 'Nepal', 'NP', NULL, NULL),
(152, 'Netherlands', 'NL', NULL, NULL),
(153, 'Netherlands Antilles', 'AN', NULL, NULL),
(154, 'New Caledonia', 'NC', NULL, NULL),
(155, 'New Zealand', 'NZ', NULL, NULL),
(156, 'Nicaragua', 'NI', NULL, NULL),
(157, 'Niger', 'NE', NULL, NULL),
(158, 'Nigeria', 'NG', NULL, NULL),
(159, 'Niue', 'NU', NULL, NULL),
(160, 'Norfork Island', 'NF', NULL, NULL),
(161, 'Northern Mariana Islands', 'MP', NULL, NULL),
(162, 'Norway', 'NO', NULL, NULL),
(163, 'Oman', 'OM', NULL, NULL),
(164, 'Pakistan', 'PK', NULL, NULL),
(165, 'Palau', 'PW', NULL, NULL),
(166, 'Panama', 'PA', NULL, NULL),
(167, 'Papua New Guinea', 'PG', NULL, NULL),
(168, 'Paraguay', 'PY', NULL, NULL),
(169, 'Peru', 'PE', NULL, NULL),
(170, 'Philippines', 'PH', NULL, NULL),
(171, 'Pitcairn', 'PN', NULL, NULL),
(172, 'Poland', 'PL', NULL, NULL),
(173, 'Portugal', 'PT', NULL, NULL),
(174, 'Puerto Rico', 'PR', NULL, NULL),
(175, 'Qatar', 'QA', NULL, NULL),
(176, 'Republic of South Sudan', 'SS', NULL, NULL),
(177, 'Reunion', 'RE', NULL, NULL),
(178, 'Romania', 'RO', NULL, NULL),
(179, 'Russian Federation', 'RU', NULL, NULL),
(180, 'Rwanda', 'RW', NULL, NULL),
(181, 'Saint Kitts and Nevis', 'KN', NULL, NULL),
(182, 'Saint Lucia', 'LC', NULL, NULL),
(183, 'Saint Vincent and the Grenadines', 'VC', NULL, NULL),
(184, 'Samoa', 'WS', NULL, NULL),
(185, 'San Marino', 'SM', NULL, NULL),
(186, 'Sao Tome and Principe', 'ST', NULL, NULL),
(187, 'Saudi Arabia', 'SA', NULL, NULL),
(188, 'Senegal', 'SN', NULL, NULL),
(189, 'Serbia', 'RS', NULL, NULL),
(190, 'Seychelles', 'SC', NULL, NULL),
(191, 'Sierra Leone', 'SL', NULL, NULL),
(192, 'Singapore', 'SG', NULL, NULL),
(193, 'Slovakia', 'SK', NULL, NULL),
(194, 'Slovenia', 'SI', NULL, NULL),
(195, 'Solomon Islands', 'SB', NULL, NULL),
(196, 'Somalia', 'SO', NULL, NULL),
(197, 'South Africa', 'ZA', NULL, NULL),
(198, 'South Georgia South Sandwich Islands', 'GS', NULL, NULL),
(199, 'Spain', 'ES', NULL, NULL),
(200, 'Sri Lanka', 'LK', NULL, NULL),
(201, 'St. Helena', 'SH', NULL, NULL),
(202, 'St. Pierre and Miquelon', 'PM', NULL, NULL),
(203, 'Sudan', 'SD', NULL, NULL),
(204, 'Suriname', 'SR', NULL, NULL),
(205, 'Svalbarn and Jan Mayen Islands', 'SJ', NULL, NULL),
(206, 'Swaziland', 'SZ', NULL, NULL),
(207, 'Sweden', 'SE', NULL, NULL),
(208, 'Switzerland', 'CH', NULL, NULL),
(209, 'Syrian Arab Republic', 'SY', NULL, NULL),
(210, 'Taiwan', 'TW', NULL, NULL),
(211, 'Tajikistan', 'TJ', NULL, NULL),
(212, 'Tanzania, United Republic of', 'TZ', NULL, NULL),
(213, 'Thailand', 'TH', NULL, NULL),
(214, 'Togo', 'TG', NULL, NULL),
(215, 'Tokelau', 'TK', NULL, NULL),
(216, 'Tonga', 'TO', NULL, NULL),
(217, 'Trinidad and Tobago', 'TT', NULL, NULL),
(218, 'Tunisia', 'TN', NULL, NULL),
(219, 'Turkey', 'TR', NULL, NULL),
(220, 'Turkmenistan', 'TM', NULL, NULL),
(221, 'Turks and Caicos Islands', 'TC', NULL, NULL),
(222, 'Tuvalu', 'TV', NULL, NULL),
(223, 'Uganda', 'UG', NULL, NULL),
(224, 'Ukraine', 'UA', NULL, NULL),
(225, 'United Arab Emirates', 'AE', NULL, NULL),
(226, 'United Kingdom', 'GB', NULL, NULL),
(227, 'United States minor outlying islands', 'UM', NULL, NULL),
(228, 'Uruguay', 'UY', NULL, NULL),
(229, 'Uzbekistan', 'UZ', NULL, NULL),
(230, 'Vanuatu', 'VU', NULL, NULL),
(231, 'Vatican City State', 'VA', NULL, NULL),
(232, 'Venezuela', 'VE', NULL, NULL),
(233, 'Vietnam', 'VN', NULL, NULL),
(234, 'Virgin Islands (British)', 'VG', NULL, NULL),
(235, 'Virgin Islands (U.S.)', 'VI', NULL, NULL),
(236, 'Wallis and Futuna Islands', 'WF', NULL, NULL),
(237, 'Western Sahara', 'EH', NULL, NULL),
(238, 'Yemen', 'YE', NULL, NULL),
(239, 'Yugoslavia', 'YU', NULL, NULL),
(240, 'Zaire', 'ZR', NULL, NULL),
(241, 'Zambia', 'ZM', NULL, NULL),
(242, 'Zimbabwe', 'ZW', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_addresses`
--

CREATE TABLE `customer_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `address` text NOT NULL,
  `apartment` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_addresses`
--

INSERT INTO `customer_addresses` (`id`, `user_id`, `first_name`, `last_name`, `mobile`, `email`, `country_id`, `address`, `apartment`, `city`, `state`, `zip`, `created_at`, `updated_at`) VALUES
(7, 15, 'mohit', 'Rajput', '8830641063', 'mohit@gmail.com', 7, 'wadala road\r\nashoka margzxasdxasdasd', NULL, 'nashik', 'Maharashtra', 'DEAD', '2024-04-22 01:13:08', '2024-04-22 01:13:08'),
(8, 14, 'mohit', 'Rajput', '0909090908', 'mohit@gmail.com', 100, 'wadala road, ashoka marg fgfdfgdrgtertertrt', NULL, 'nashik', 'MH', '422006', '2024-04-22 23:31:32', '2024-04-28 23:05:47'),
(9, 16, 'saniya', 'khan', '8830641063', 'saniya@gmail.com', 4, 'wadala road\r\nashoka margcffgfgfdfgd', NULL, 'nashik', 'Maharashtra', 'DEAD', '2024-04-22 23:59:07', '2024-04-22 23:59:07');

-- --------------------------------------------------------

--
-- Table structure for table `discount_coupons`
--

CREATE TABLE `discount_coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `max_uses` int(11) DEFAULT NULL,
  `max_uses_user` int(11) DEFAULT NULL,
  `type` enum('percent','fixed') NOT NULL DEFAULT 'fixed',
  `discount_amount` double(10,2) NOT NULL,
  `min_amount` double(10,2) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `starts_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discount_coupons`
--

INSERT INTO `discount_coupons` (`id`, `code`, `name`, `description`, `max_uses`, `max_uses_user`, `type`, `discount_amount`, `min_amount`, `status`, `starts_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(7, 'ffff', 'first', 'xsZxs', 2, 1, 'percent', 20.00, 10.00, 1, '2024-04-18 11:33:26', '2024-04-19 11:33:30', '2024-04-17 06:03:35', '2024-04-18 00:43:56'),
(8, 'eeee', 'second', 'zxczxc', 2, 4, 'fixed', 20.00, 10.00, 1, '2024-04-18 17:48:42', '2024-04-19 17:48:42', '2024-04-17 12:19:31', '2024-04-18 00:41:11'),
(9, 'ssss', 'third', 'retret', 2, 3, 'fixed', 20.00, 10.00, 1, '2024-04-18 06:15:29', '2024-04-20 06:15:36', '2024-04-18 00:45:50', '2024-04-18 00:45:50'),
(13, '362024AA', '5% Discount', 'sdjsf', 4, 4, 'percent', 5.00, 10.00, 1, '2024-06-04 09:38:04', '2024-06-22 09:38:07', '2024-06-04 04:08:13', '2024-06-04 04:08:13');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_03_04_103850_alter_users_table', 2),
(6, '2024_03_05_070535_create_categories_table', 3),
(7, '2024_03_05_172432_create_temp_images_table', 4),
(8, '2024_03_06_101314_create_sub_categories_table', 5),
(9, '2024_03_07_044933_create_brands_table', 6),
(12, '2024_03_07_071839_create_products_table', 7),
(14, '2024_03_07_071858_create_products_images_table', 8),
(15, '2024_03_08_044150_drop_products_images_table', 9),
(16, '2024_03_10_061543_alter_categories_table', 10),
(17, '2024_03_10_063258_alter_products_table', 11),
(19, '2024_03_10_065600_alter_sub_categories_table', 12),
(20, '2024_03_12_075942_alter_products_table', 13),
(21, '2024_03_22_144118_alter_users_table', 14),
(22, '2024_03_23_072539_create_countries_table', 15),
(23, '2024_03_23_084416_create_orders_table', 16),
(24, '2024_03_23_084522_create_orders_items_table', 16),
(25, '2024_03_23_084628_create_customer_addresses_table', 16),
(26, '2024_03_25_045443_create_shipping_charges_table', 17),
(27, '2024_04_04_071859_create_discount_coupons_table', 18),
(29, '2024_04_18_055931_add_coupon_code_id_to_orders_table', 19),
(30, '2024_04_18_083708_alter_orders_table', 20),
(31, '2024_04_18_115554_alter_orders_table', 21),
(32, '2024_04_19_054745_create_wishlists_table', 22),
(33, '2024_04_20_050544_alter_users_table', 23),
(34, '2024_04_20_095818_create_pages_table', 24),
(35, '2024_04_20_102524_alter_pages_table', 25),
(36, '2024_04_22_072424_create_product_ratings_table', 26);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subtotal` double(10,2) NOT NULL,
  `shipping` double(10,2) NOT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `coupon_code_id` bigint(20) UNSIGNED DEFAULT NULL,
  `discount` double(10,2) DEFAULT NULL,
  `grand_total` double(10,2) NOT NULL,
  `payment_status` enum('paid','unpaid') NOT NULL DEFAULT 'unpaid',
  `status` enum('pending','shipped','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `shipped_date` timestamp NULL DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `address` text NOT NULL,
  `apartment` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `subtotal`, `shipping`, `coupon_code`, `coupon_code_id`, `discount`, `grand_total`, `payment_status`, `status`, `shipped_date`, `first_name`, `last_name`, `mobile`, `email`, `country_id`, `address`, `apartment`, `city`, `state`, `zip`, `notes`, `created_at`, `updated_at`) VALUES
(49, 15, 6050.00, 612.00, '', NULL, 0.00, 6662.00, 'unpaid', 'pending', NULL, 'mohit', 'Rajput', '8830641063', 'mohit@gmail.com', 7, 'wadala road\r\nashoka margzxasdxasdasd', NULL, 'nashik', 'Maharashtra', 'DEAD', NULL, '2024-04-22 01:13:08', '2024-04-22 01:13:08'),
(50, 15, 600.00, 68.00, '', NULL, 0.00, 668.00, 'unpaid', 'pending', NULL, 'mohit', 'Rajput', '8830641063', 'mohit@gmail.com', 7, 'wadala road\r\nashoka margzxasdxasdasd', NULL, 'nashik', 'Maharashtra', 'DEAD', NULL, '2024-04-22 01:13:47', '2024-04-22 01:13:47'),
(51, 14, 376.00, 987.00, '', NULL, 0.00, 1363.00, 'unpaid', 'pending', NULL, 'mohit', 'Rajput', '8830641063', 'mohit@gmail.com', 3, 'wadala roaddscsfsferferferf\r\nashoka marg wadala roaddscsfsferferferf\r\nashoka marg', NULL, 'nashik', 'Maharashtra', 'DEAD', NULL, '2024-04-22 23:45:21', '2024-04-22 23:45:21'),
(52, 16, 1180.00, 1974.00, '', NULL, 0.00, 3154.00, 'unpaid', 'pending', NULL, 'saniya', 'khan', '8830641063', 'saniya@gmail.com', 4, 'wadala road\r\nashoka margcffgfgfdfgd', NULL, 'nashik', 'Maharashtra', 'DEAD', NULL, '2024-04-22 23:59:07', '2024-04-22 23:59:07'),
(53, 16, 588.00, 987.00, '', NULL, 0.00, 1575.00, 'unpaid', 'pending', NULL, 'saniya', 'khan', '8830641063', 'saniya@gmail.com', 4, 'wadala road\r\nashoka margcffgfgfdfgd', NULL, 'nashik', 'Maharashtra', 'DEAD', NULL, '2024-04-23 00:04:12', '2024-04-23 00:04:12'),
(54, 16, 883.00, 987.00, '', NULL, 0.00, 1870.00, 'unpaid', 'pending', NULL, 'saniya', 'khan', '8830641063', 'saniya@gmail.com', 4, 'wadala road\r\nashoka margcffgfgfdfgd', NULL, 'nashik', 'Maharashtra', 'DEAD', NULL, '2024-04-23 00:19:11', '2024-04-23 00:19:11'),
(55, 16, 600.00, 987.00, '23AP2024', 12, 30.00, 1557.00, 'unpaid', 'pending', NULL, 'saniya', 'khan', '8830641063', 'saniya@gmail.com', 4, 'wadala road\r\nashoka margcffgfgfdfgd', NULL, 'nashik', 'Maharashtra', 'DEAD', NULL, '2024-04-23 00:27:20', '2024-04-23 00:27:20'),
(56, 14, 20.00, 987.00, '', NULL, 0.00, 1007.00, 'unpaid', 'pending', NULL, 'mohit', 'Rajput', '8830641063', 'mohit@gmail.com', 3, 'wadala roaddscsfsferferferf\r\nashoka marg wadala roaddscsfsferferferf\r\nashoka marg', NULL, 'nashik', 'Maharashtra', 'DEAD', NULL, '2024-04-23 23:53:02', '2024-04-23 23:53:02'),
(57, 14, 20.00, 987.00, '', NULL, 0.00, 1007.00, 'unpaid', 'pending', NULL, 'mohit', 'Rajput', '8830641063', 'mohit@gmail.com', 3, 'wadala roaddscsfsferferferf\r\nashoka marg wadala roaddscsfsferferferf\r\nashoka marg', NULL, 'nashik', 'Maharashtra', 'DEAD', NULL, '2024-04-23 23:53:44', '2024-04-23 23:53:44'),
(58, 14, 20.00, 987.00, '', NULL, 0.00, 1007.00, 'unpaid', 'pending', NULL, 'mohit', 'Rajput', '8830641063', 'mohit@gmail.com', 3, 'wadala roaddscsfsferferferf\r\nashoka marg wadala roaddscsfsferferferf\r\nashoka marg', NULL, 'nashik', 'Maharashtra', 'DEAD', NULL, '2024-04-23 23:57:46', '2024-04-23 23:57:46'),
(59, 14, 20.00, 987.00, '', NULL, 0.00, 1007.00, 'unpaid', 'pending', NULL, 'mohit', 'Rajput', '8830641063', 'mohit@gmail.com', 3, 'wadala roaddscsfsferferferf\r\nashoka marg wadala roaddscsfsferferferf\r\nashoka marg', NULL, 'nashik', 'Maharashtra', 'DEAD', NULL, '2024-04-24 00:04:19', '2024-04-24 00:04:19'),
(60, 14, 648.00, 3948.00, '', NULL, 0.00, 4596.00, 'unpaid', 'pending', NULL, 'mohit', 'Rajput', '8830641063', 'mohit@gmail.com', 3, 'wadala roaddscsfsferferferf\r\nashoka marg wadala roaddscsfsferferferf\r\nashoka marg', NULL, 'nashik', 'Maharashtra', 'DEAD', NULL, '2024-04-24 00:08:36', '2024-04-24 00:08:36'),
(61, 14, 588.00, 987.00, '', NULL, 0.00, 1575.00, 'unpaid', 'pending', NULL, 'mohit', 'Rajput', '8830641063', 'mohit@gmail.com', 3, 'wadala roaddscsfsferferferf\r\nashoka marg wadala roaddscsfsferferferf\r\nashoka marg', NULL, 'nashik', 'Maharashtra', 'DEAD', NULL, '2024-04-24 00:11:45', '2024-04-24 00:11:45'),
(62, 14, 588.00, 987.00, '', NULL, 0.00, 1575.00, 'unpaid', 'pending', NULL, 'mohit', 'Rajput', '8830641063', 'mohit@gmail.com', 3, 'wadala roaddscsfsferferferf\r\nashoka marg wadala roaddscsfsferferferf\r\nashoka marg', NULL, 'nashik', 'Maharashtra', 'DEAD', NULL, '2024-04-24 00:13:39', '2024-04-24 00:13:39'),
(63, 14, 588.00, 987.00, '', NULL, 0.00, 1575.00, 'unpaid', 'pending', NULL, 'mohit', 'Rajput', '8830641063', 'mohit@gmail.com', 3, 'wadala roaddscsfsferferferf\r\nashoka marg wadala roaddscsfsferferferf\r\nashoka marg', NULL, 'nashik', 'Maharashtra', 'DEAD', NULL, '2024-04-24 00:23:57', '2024-04-24 00:23:57'),
(64, 14, 588.00, 987.00, '', NULL, 0.00, 1575.00, 'unpaid', 'pending', NULL, 'mohit', 'Rajput', '8830641063', 'mohit@gmail.com', 3, 'wadala roaddscsfsferferferf\r\nashoka marg wadala roaddscsfsferferferf\r\nashoka marg', NULL, 'nashik', 'Maharashtra', 'DEAD', NULL, '2024-04-24 00:24:26', '2024-04-24 00:24:26'),
(65, 14, 1764.00, 204.00, '', NULL, 0.00, 1968.00, 'unpaid', 'pending', NULL, 'mohit', 'Rajput', '7788778877', 'mohit@gmail.com', 100, 'wadala road, ashoka marg fdgdgdfhdfhdf', NULL, 'nashik', 'MH', '422006', NULL, '2024-04-27 00:29:48', '2024-04-27 00:29:48'),
(66, 14, 541.00, 68.00, '', NULL, 0.00, 609.00, 'unpaid', 'pending', NULL, 'mohit', 'Rajput', '7788778877', 'mohit@gmail.com', 100, 'wadala road, ashoka marg fdgdgdfhdfhdf', NULL, 'nashik', 'MH', '422006', NULL, '2024-04-27 00:30:18', '2024-04-27 00:30:18'),
(67, 14, 846.00, 136.00, '', NULL, 0.00, 982.00, 'unpaid', 'pending', NULL, 'mohit', 'Rajput', '0909090908', 'mohit@gmail.com', 100, 'wadala road, ashoka marg dfsdfdsfdsfdfsdf', NULL, 'nashik', 'MH', '422006', NULL, '2024-04-27 00:40:08', '2024-04-27 00:40:08'),
(68, 14, 541.00, 68.00, '', NULL, 0.00, 609.00, 'unpaid', 'pending', NULL, 'mohit', 'Rajput', '0909090908', 'mohit@gmail.com', 100, 'wadala road, ashoka marg dfsdfdsfdsfdfsdf', NULL, 'nashik', 'MH', '422006', NULL, '2024-04-27 00:42:23', '2024-04-27 00:42:23'),
(69, 14, 883.00, 68.00, '', NULL, 0.00, 951.00, 'unpaid', 'pending', NULL, 'mohit', 'Rajput', '0909090908', 'mohit@gmail.com', 100, 'wadala road, ashoka marg dfsdfdsfdsfdfsdf', NULL, 'nashik', 'MH', '422006', NULL, '2024-04-27 02:12:39', '2024-04-27 02:12:39'),
(70, 14, 376.00, 68.00, '', NULL, 0.00, 444.00, 'unpaid', 'pending', NULL, 'mohit', 'Rajput', '0909090908', 'mohit@gmail.com', 100, 'wadala road, ashoka marg fgfdfgdrgtertertrt', NULL, 'nashik', 'MH', '422006', NULL, '2024-04-28 23:05:47', '2024-04-28 23:05:47'),
(71, 14, 376.00, 68.00, '', NULL, 0.00, 444.00, 'unpaid', 'pending', NULL, 'mohit', 'Rajput', '0909090908', 'mohit@gmail.com', 100, 'wadala road, ashoka marg fgfdfgdrgtertertrt', NULL, 'nashik', 'MH', '422006', NULL, '2024-05-10 23:08:07', '2024-05-10 23:08:07'),
(72, 14, 883.00, 68.00, '362024AA', 13, 44.15, 906.85, 'unpaid', 'pending', NULL, 'mohit', 'Rajput', '0909090908', 'mohit@gmail.com', 100, 'wadala road, ashoka marg fgfdfgdrgtertertrt', NULL, 'nashik', 'MH', '422006', NULL, '2024-06-04 04:09:33', '2024-06-04 04:09:33');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` double(10,2) NOT NULL,
  `total` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `name`, `qty`, `price`, `total`, `created_at`, `updated_at`) VALUES
(59, 49, 83, 'Sibyl Cummings', 4, 883.00, 3532.00, '2024-04-22 01:13:08', '2024-04-22 01:13:08'),
(60, 49, 67, 'Miss Marina Parisian II', 3, 404.00, 1212.00, '2024-04-22 01:13:08', '2024-04-22 01:13:08'),
(61, 49, 87, 'Mrs. Aglae Conn V', 2, 653.00, 1306.00, '2024-04-22 01:13:08', '2024-04-22 01:13:08'),
(62, 50, 48, 'Womens Clothes', 1, 600.00, 600.00, '2024-04-22 01:13:47', '2024-04-22 01:13:47'),
(63, 51, 89, 'Emilia Mohr', 1, 376.00, 376.00, '2024-04-22 23:45:21', '2024-04-22 23:45:21'),
(64, 52, 62, 'Katelyn Daugherty', 1, 297.00, 297.00, '2024-04-22 23:59:07', '2024-04-22 23:59:07'),
(65, 52, 83, 'Sibyl Cummings', 1, 883.00, 883.00, '2024-04-22 23:59:07', '2024-04-22 23:59:07'),
(66, 53, 73, 'Maudie Miller', 1, 588.00, 588.00, '2024-04-23 00:04:12', '2024-04-23 00:04:12'),
(67, 54, 83, 'Sibyl Cummings', 1, 883.00, 883.00, '2024-04-23 00:19:12', '2024-04-23 00:19:12'),
(68, 55, 48, 'Womens Clothes', 1, 600.00, 600.00, '2024-04-23 00:27:20', '2024-04-23 00:27:20'),
(69, 56, 85, 'Camren Gottlieb', 1, 20.00, 20.00, '2024-04-23 23:53:02', '2024-04-23 23:53:02'),
(70, 57, 85, 'Camren Gottlieb', 1, 20.00, 20.00, '2024-04-23 23:53:44', '2024-04-23 23:53:44'),
(71, 58, 85, 'Camren Gottlieb', 1, 20.00, 20.00, '2024-04-23 23:57:46', '2024-04-23 23:57:46'),
(72, 59, 85, 'Camren Gottlieb', 1, 20.00, 20.00, '2024-04-24 00:04:19', '2024-04-24 00:04:19'),
(73, 60, 85, 'Camren Gottlieb', 3, 20.00, 60.00, '2024-04-24 00:08:36', '2024-04-24 00:08:36'),
(74, 60, 73, 'Maudie Miller', 1, 588.00, 588.00, '2024-04-24 00:08:36', '2024-04-24 00:08:36'),
(75, 61, 73, 'Maudie Miller', 1, 588.00, 588.00, '2024-04-24 00:11:45', '2024-04-24 00:11:45'),
(76, 62, 73, 'Maudie Miller', 1, 588.00, 588.00, '2024-04-24 00:13:39', '2024-04-24 00:13:39'),
(77, 63, 73, 'Maudie Miller', 1, 588.00, 588.00, '2024-04-24 00:23:57', '2024-04-24 00:23:57'),
(78, 64, 73, 'Maudie Miller', 1, 588.00, 588.00, '2024-04-24 00:24:26', '2024-04-24 00:24:26'),
(79, 65, 73, 'Maudie Miller', 3, 588.00, 1764.00, '2024-04-27 00:29:48', '2024-04-27 00:29:48'),
(80, 66, 53, 'Prof. Danial Stamm', 1, 541.00, 541.00, '2024-04-27 00:30:18', '2024-04-27 00:30:18'),
(81, 67, 62, 'Katelyn Daugherty', 1, 297.00, 297.00, '2024-04-27 00:40:08', '2024-04-27 00:40:08'),
(82, 67, 69, 'Prof. Isom Klein', 1, 549.00, 549.00, '2024-04-27 00:40:08', '2024-04-27 00:40:08'),
(83, 68, 53, 'Prof. Danial Stamm', 1, 541.00, 541.00, '2024-04-27 00:42:23', '2024-04-27 00:42:23'),
(84, 69, 83, 'Sibyl Cummings', 1, 883.00, 883.00, '2024-04-27 02:12:39', '2024-04-27 02:12:39'),
(85, 70, 89, 'Emilia Mohr', 1, 376.00, 376.00, '2024-04-28 23:05:47', '2024-04-28 23:05:47'),
(86, 71, 89, 'Emilia Mohr', 1, 376.00, 376.00, '2024-05-10 23:08:07', '2024-05-10 23:08:07'),
(87, 72, 83, 'Sibyl Cummings', 1, 883.00, 883.00, '2024-06-04 04:09:33', '2024-06-04 04:09:33');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `content` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `slug`, `status`, `content`, `created_at`, `updated_at`) VALUES
(3, 'Contact Us', 'contact-us', 1, '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content.</p>\r\n                <address>\r\n                    Cecilia Chapman <br>\r\n                    711-2880 Nulla St.<br> \r\n                    Mankato Mississippi 96522<br>\r\n                    <a href=\"tel:+xxxxxxxx\">(XXX) 555-2368</a><br>\r\n                    <a href=\"mailto:jim@rock.com\">jim@rock.com</a>\r\n                </address>', '2024-04-20 05:45:50', '2024-04-20 11:49:18'),
(5, 'About Us', 'about-us', 1, '<p>WebCipher is a progressive web development firm committed to creating outstanding digital experiences for companies in a variety of sectors. Our expertise lies in developing custom websites and online applications that enhance brands and generate tangible outcomes, driven by a strong dedication to quality and inventiveness. Our talented group of strategists, designers, and developers collaborates to provide specialized solutions that satisfy the particular requirements and objectives of each of our clients. We use the newest technology and industry best practices to guarantee the greatest possible performance, security, and user experience on everything from responsive websites to sophisticated web applications. At WebCipher, we strive to go above and beyond customer expectations with each project we take on. We take pride in our innovation, attention to detail, and client-focused approach.<br></p>', '2024-04-20 06:05:15', '2024-04-20 11:22:42'),
(6, 'Blog', 'blog', 1, '<p>saxas</p>', '2024-04-20 11:34:10', '2024-04-20 11:34:10'),
(7, 'services', 'services', 1, '<p>dhjchdsjfc</p>', '2024-07-30 07:19:30', '2024-07-30 07:19:58');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `shipping` text DEFAULT NULL,
  `related_products` text DEFAULT NULL,
  `price` double(10,2) NOT NULL,
  `compare_price` double(10,2) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_featured` enum('Yes','No') NOT NULL DEFAULT 'No',
  `sku` varchar(255) NOT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `track_qty` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `qty` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `slug`, `description`, `short_description`, `shipping`, `related_products`, `price`, `compare_price`, `category_id`, `sub_category_id`, `brand_id`, `is_featured`, `sku`, `barcode`, `track_qty`, `qty`, `status`, `created_at`, `updated_at`) VALUES
(48, 'Womens Clothes', 'womens-clothes', '<p><br></p>', NULL, NULL, NULL, 600.00, 500.00, 1, 1, 36, 'Yes', 'DD_MM_UU', 'sds', 'Yes', 0, 1, '2024-03-12 00:32:50', '2024-04-23 00:27:20'),
(49, 'Shirts', 'shirts', NULL, NULL, NULL, NULL, 1000.00, 900.00, 1, 40, 37, 'No', 'sf-XXL-Sm', 'dc', 'Yes', 2, 1, '2024-03-12 00:50:11', '2024-03-12 00:50:11'),
(50, 'Kids', 'kids', NULL, NULL, NULL, NULL, 1500.00, 1400.00, 1, 41, 38, 'No', 'KDS_MM_SM', NULL, 'Yes', 1, 1, '2024-03-12 00:56:10', '2024-03-12 00:56:10'),
(51, 'Kenyon Doyle', 'kenyon-doyle', NULL, NULL, NULL, NULL, 485.00, NULL, 1, 40, 36, 'Yes', '6518', NULL, 'Yes', 10, 1, '2024-03-12 01:11:32', '2024-03-12 01:11:32'),
(52, 'Prof. Charity Kuvalis', 'prof-charity-kuvalis', NULL, NULL, NULL, NULL, 978.00, NULL, 1, 40, 36, 'Yes', '44781', NULL, 'Yes', 10, 1, '2024-03-12 01:11:32', '2024-03-12 01:11:32'),
(53, 'Prof. Danial Stamm', 'prof-danial-stamm', NULL, NULL, NULL, NULL, 541.00, NULL, 1, 1, 36, 'Yes', '78302', NULL, 'Yes', 8, 1, '2024-03-12 01:11:32', '2024-04-27 00:42:23'),
(54, 'Josefa Russel', 'josefa-russel', NULL, NULL, NULL, NULL, 458.00, NULL, 1, 40, 37, 'Yes', '15175', NULL, 'Yes', 10, 1, '2024-03-12 01:11:32', '2024-03-12 01:11:32'),
(55, 'Austyn Morar', 'austyn-morar', NULL, NULL, NULL, NULL, 779.00, NULL, 1, 41, 36, 'Yes', '36790', NULL, 'Yes', 10, 1, '2024-03-12 01:11:32', '2024-03-12 01:11:32'),
(56, 'Dax Gerlach IV', 'dax-gerlach-iv', NULL, NULL, NULL, NULL, 823.00, NULL, 1, 40, 37, 'Yes', '30192', NULL, 'Yes', 10, 1, '2024-03-12 01:11:32', '2024-03-12 01:11:32'),
(57, 'Prof. Bonita Bauch Jr.', 'prof-bonita-bauch-jr', NULL, NULL, NULL, NULL, 235.00, NULL, 1, 40, 36, 'Yes', '19297', NULL, 'Yes', 10, 1, '2024-03-12 01:11:32', '2024-03-12 01:11:32'),
(58, 'Prof. Xavier Graham I', 'prof-xavier-graham-i', NULL, NULL, NULL, NULL, 681.00, NULL, 1, 41, 37, 'Yes', '36611', NULL, 'Yes', 10, 1, '2024-03-12 01:11:32', '2024-03-12 01:11:32'),
(59, 'Bertram Price', 'bertram-price', NULL, NULL, NULL, NULL, 487.00, NULL, 1, 1, 37, 'Yes', '7208', NULL, 'Yes', 10, 1, '2024-03-12 01:11:32', '2024-03-12 01:11:32'),
(60, 'Mario Ledner', 'mario-ledner', NULL, NULL, NULL, NULL, 454.00, NULL, 1, 1, 36, 'Yes', '58625', NULL, 'Yes', 10, 1, '2024-03-12 01:11:32', '2024-03-12 01:11:32'),
(61, 'Domenick Reilly', 'domenick-reilly', NULL, NULL, NULL, NULL, 29.00, NULL, 1, 41, 36, 'Yes', '18062', NULL, 'Yes', 10, 1, '2024-03-12 01:11:32', '2024-03-12 01:11:32'),
(62, 'Katelyn Daugherty', 'katelyn-daugherty', NULL, NULL, NULL, NULL, 297.00, NULL, 1, 1, 37, 'Yes', '92592', NULL, 'Yes', 8, 1, '2024-03-12 01:11:32', '2024-04-27 00:40:08'),
(63, 'Mr. Lyric Haley', 'mr-lyric-haley', NULL, NULL, NULL, NULL, 881.00, NULL, 1, 40, 38, 'Yes', '41728', NULL, 'Yes', 10, 1, '2024-03-12 01:11:32', '2024-03-12 01:11:32'),
(64, 'Mrs. Eloisa Harris Sr.', 'mrs-eloisa-harris-sr', NULL, NULL, NULL, NULL, 397.00, NULL, 1, 41, 37, 'Yes', '66461', NULL, 'Yes', 10, 1, '2024-03-12 01:11:32', '2024-03-12 01:11:32'),
(65, 'Caleigh Durgan', 'caleigh-durgan', NULL, NULL, NULL, NULL, 839.00, NULL, 1, 41, 38, 'Yes', '59918', NULL, 'Yes', 10, 1, '2024-03-12 01:11:32', '2024-03-12 01:11:32'),
(66, 'Abbigail Kutch Sr.', 'abbigail-kutch-sr', NULL, NULL, NULL, NULL, 534.00, NULL, 1, 40, 38, 'Yes', '95194', NULL, 'Yes', 9, 1, '2024-03-12 01:11:32', '2024-04-19 09:59:06'),
(67, 'Miss Marina Parisian II', 'miss-marina-parisian-ii', NULL, NULL, NULL, NULL, 404.00, NULL, 1, 41, 37, 'Yes', '28581', NULL, 'Yes', 7, 1, '2024-03-12 01:11:32', '2024-04-22 01:13:08'),
(68, 'Mckayla Ruecker', 'mckayla-ruecker', NULL, NULL, NULL, NULL, 578.00, NULL, 1, 41, 38, 'Yes', '22940', NULL, 'Yes', 10, 1, '2024-03-12 01:11:32', '2024-03-12 01:11:32'),
(69, 'Prof. Isom Klein', 'prof-isom-klein', NULL, NULL, NULL, NULL, 549.00, NULL, 1, 1, 36, 'Yes', '21160', NULL, 'Yes', 9, 1, '2024-03-12 01:11:32', '2024-04-27 00:40:08'),
(70, 'Russell Lindgren', 'russell-lindgren', NULL, NULL, NULL, NULL, 598.00, NULL, 1, 41, 37, 'Yes', '79297', NULL, 'Yes', 10, 1, '2024-03-12 01:11:32', '2024-03-12 01:11:32'),
(71, 'Ms. Layla Hamill IV', 'ms-layla-hamill-iv', NULL, NULL, NULL, NULL, 641.00, NULL, 194, 42, 41, 'Yes', '98094', NULL, 'Yes', 10, 1, '2024-03-12 01:21:27', '2024-03-12 01:21:27'),
(72, 'Tad Daugherty', 'tad-daugherty', NULL, NULL, NULL, NULL, 67.00, NULL, 194, 45, 43, 'Yes', '42873', NULL, 'Yes', 10, 1, '2024-03-12 01:21:27', '2024-03-12 01:21:27'),
(73, 'Maudie Miller', 'maudie-miller', NULL, NULL, NULL, NULL, 588.00, NULL, 194, 42, 41, 'Yes', '72336', NULL, 'Yes', 0, 1, '2024-03-12 01:21:27', '2024-04-27 00:29:48'),
(74, 'Esmeralda Bode', 'esmeralda-bode', NULL, NULL, NULL, NULL, 243.00, NULL, 194, 44, 39, 'Yes', '31351', NULL, 'Yes', 10, 1, '2024-03-12 01:21:27', '2024-03-12 01:21:27'),
(75, 'Milo McCullough', 'milo-mccullough', NULL, NULL, NULL, NULL, 393.00, NULL, 194, 45, 40, 'Yes', '37390', NULL, 'Yes', 10, 1, '2024-03-12 01:21:27', '2024-03-12 01:21:27'),
(76, 'Bradly Lynch', 'bradly-lynch', NULL, NULL, NULL, NULL, 496.00, NULL, 194, 43, 43, 'Yes', '39204', NULL, 'Yes', 10, 1, '2024-03-12 01:21:27', '2024-03-12 01:21:27'),
(77, 'Modesta Rau', 'modesta-rau', NULL, NULL, NULL, NULL, 879.00, NULL, 194, 43, 40, 'Yes', '65936', NULL, 'Yes', 10, 1, '2024-03-12 01:21:27', '2024-03-12 01:21:27'),
(78, 'Roberto Ernser', 'roberto-ernser', NULL, NULL, NULL, NULL, 916.00, NULL, 194, 44, 42, 'Yes', '49913', NULL, 'Yes', 10, 1, '2024-03-12 01:21:27', '2024-03-12 01:21:27'),
(79, 'Abe Pacocha', 'abe-pacocha', NULL, NULL, NULL, NULL, 930.00, NULL, 194, 45, 42, 'Yes', '7214', NULL, 'Yes', 10, 1, '2024-03-12 01:21:27', '2024-03-12 01:21:27'),
(80, 'Helena Champlin', 'helena-champlin', NULL, NULL, NULL, NULL, 326.00, NULL, 194, 44, 41, 'Yes', '79742', NULL, 'Yes', 10, 1, '2024-03-12 01:21:27', '2024-03-12 01:21:27'),
(81, 'Lisa Harris PhD', 'lisa-harris-phd', '<p><span style=\"color: rgb(0, 29, 61); font-family: Poppins;\">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi.</span><br></p>', NULL, NULL, NULL, 706.00, NULL, 194, 45, 43, 'Yes', '37703', NULL, 'Yes', 10, 1, '2024-03-12 01:21:27', '2024-03-12 02:15:02'),
(82, 'Mercedes Vandervort', 'mercedes-vandervort', '<p><span style=\"color: rgb(0, 29, 61); font-family: Poppins;\">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi.</span><br></p>', NULL, NULL, NULL, 79.00, NULL, 194, 44, 43, 'Yes', '67809', NULL, 'Yes', 10, 1, '2024-03-12 01:21:27', '2024-03-12 02:14:38'),
(83, 'Sibyl Cummings', 'sibyl-cummings', '<p><span style=\"color: rgb(0, 29, 61); font-family: Poppins;\">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi.</span><br></p>', NULL, NULL, '', 883.00, NULL, 194, 42, 39, 'Yes', '14314', NULL, 'Yes', 1, 1, '2024-03-12 01:21:27', '2024-06-04 04:09:33'),
(84, 'Scarlett Grant', 'scarlett-grant', '<p><span style=\"color: rgb(0, 29, 61); font-family: Poppins;\">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi.</span><br></p>', NULL, NULL, NULL, 168.00, NULL, 194, 45, 43, 'Yes', '21582', NULL, 'Yes', 10, 1, '2024-03-12 01:21:27', '2024-03-12 02:14:28'),
(85, 'Camren Gottlieb', 'camren-gottlieb', '<p><span style=\"color: rgb(0, 29, 61); font-family: Poppins;\">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi.</span><br></p>', NULL, NULL, NULL, 20.00, NULL, 194, 45, 39, 'Yes', '66684', NULL, 'Yes', 3, 1, '2024-03-12 01:21:27', '2024-04-24 00:08:36'),
(86, 'Cornell Walter', 'cornell-walter', '<p><span style=\"color: rgb(0, 29, 61); font-family: Poppins;\">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi.</span><br></p>', NULL, NULL, NULL, 343.00, NULL, 194, 44, 41, 'Yes', '80741', NULL, 'Yes', 10, 1, '2024-03-12 01:21:27', '2024-03-12 02:14:02'),
(87, 'Mrs. Aglae Conn V', 'mrs-aglae-conn-v', '<p><span style=\"color: rgb(0, 29, 61); font-family: Poppins;\">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi.</span><br></p>', NULL, NULL, NULL, 653.00, NULL, 194, 43, 42, 'Yes', '12190', NULL, 'Yes', 8, 1, '2024-03-12 01:21:27', '2024-04-22 01:13:08'),
(88, 'Abraham Howell', 'abraham-howell', '<p><span style=\"color: rgb(0, 29, 61); font-family: Poppins;\">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi.</span><br></p>', NULL, NULL, NULL, 628.00, NULL, 194, 44, 43, 'Yes', '52077', NULL, 'Yes', 10, 1, '2024-03-12 01:21:27', '2024-03-12 02:13:44'),
(89, 'Emilia Mohr', 'emilia-mohr', '<p><span style=\"color: rgb(0, 29, 61); font-family: Poppins;\">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi.</span><br></p>', NULL, NULL, NULL, 376.00, NULL, 194, 44, 40, 'Yes', '58170', NULL, 'Yes', 6, 1, '2024-03-12 01:21:27', '2024-05-10 23:08:07'),
(90, 'Dr. Arnold Cassin', 'dr-arnold-cassin', '<p><span style=\"color: rgb(0, 29, 61); font-family: Poppins;\">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi.</span><br></p>', '<p><span style=\"color: rgb(0, 29, 61); font-family: Poppins;\">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi.&nbsp;</span><br></p>', '<p><span style=\"color: rgb(0, 29, 61); font-family: Poppins;\">us quaerat, quam sint ab nulla aperiam commodi. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi.</span><br></p>', '83,90', 532.00, NULL, 194, 42, 40, 'Yes', '12438', NULL, 'Yes', 0, 1, '2024-03-12 01:21:27', '2024-04-19 10:22:20');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `sort_order`, `created_at`, `updated_at`) VALUES
(77, 48, '48-77.jpg', NULL, '2024-03-12 00:32:50', '2024-03-12 00:32:50'),
(78, 48, '48-78.jpg', NULL, '2024-03-12 00:32:50', '2024-03-12 00:32:50'),
(79, 48, '48-79.webp', NULL, '2024-03-12 00:41:03', '2024-03-12 00:41:03'),
(80, 48, '48-80.webp', NULL, '2024-03-12 00:41:03', '2024-03-12 00:41:03'),
(81, 48, '48-81.webp', NULL, '2024-03-12 00:41:04', '2024-03-12 00:41:04'),
(82, 48, '48-82.webp', NULL, '2024-03-12 00:41:04', '2024-03-12 00:41:04'),
(83, 49, '49-83.webp', NULL, '2024-03-12 00:50:11', '2024-03-12 00:50:11'),
(84, 49, '49-84.webp', NULL, '2024-03-12 00:50:11', '2024-03-12 00:50:11'),
(85, 49, '49-85.webp', NULL, '2024-03-12 00:50:11', '2024-03-12 00:50:11'),
(86, 49, '49-86.webp', NULL, '2024-03-12 00:50:12', '2024-03-12 00:50:12'),
(87, 49, '49-87.webp', NULL, '2024-03-12 00:50:12', '2024-03-12 00:50:12'),
(88, 49, '49-88.webp', NULL, '2024-03-12 00:50:12', '2024-03-12 00:50:12'),
(89, 50, '50-89.webp', NULL, '2024-03-12 00:56:10', '2024-03-12 00:56:10'),
(90, 50, '50-90.jpg', NULL, '2024-03-12 00:56:11', '2024-03-12 00:56:11'),
(91, 50, '50-91.jpg', NULL, '2024-03-12 00:56:11', '2024-03-12 00:56:11'),
(92, 50, '50-92.jpg', NULL, '2024-03-12 00:56:11', '2024-03-12 00:56:11'),
(93, 50, '50-93.jpg', NULL, '2024-03-12 00:56:11', '2024-03-12 00:56:11'),
(94, 50, '50-94.webp', NULL, '2024-03-12 00:56:12', '2024-03-12 00:56:12'),
(95, 90, '90-95.webp', NULL, '2024-03-12 01:57:42', '2024-03-12 01:57:42'),
(99, 83, '83-99.jpg', NULL, '2024-03-20 03:00:09', '2024-03-20 03:00:09'),
(102, 90, '90-102.png', NULL, '2024-04-19 08:56:07', '2024-04-19 08:56:07');

-- --------------------------------------------------------

--
-- Table structure for table `product_ratings`
--

CREATE TABLE `product_ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `rating` double(3,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_ratings`
--

INSERT INTO `product_ratings` (`id`, `product_id`, `username`, `email`, `comment`, `rating`, `status`, `created_at`, `updated_at`) VALUES
(1, 90, 'first review', 'mohit2@gmail.com', 'amazing project', 4.00, 1, '2024-04-22 03:50:37', '2024-04-22 03:50:37'),
(2, 90, 'second', 'surbhi@gmail.com', 'second amazing review', 5.00, 1, '2024-04-22 03:52:54', '2024-04-22 03:52:54'),
(3, 90, 'third', 'kaveri@example.com', 'third amazing review', 4.00, 1, '2024-04-22 03:54:50', '2024-04-22 05:21:57'),
(4, 90, 'fourth', 'saniya@gmail.com', 'fourth review', 3.00, 0, '2024-04-22 03:57:03', '2024-04-22 05:22:03');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_charges`
--

CREATE TABLE `shipping_charges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` varchar(255) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_charges`
--

INSERT INTO `shipping_charges` (`id`, `country_id`, `amount`, `created_at`, `updated_at`) VALUES
(38, '4', 987.00, '2024-03-30 04:07:14', '2024-03-30 04:07:14'),
(39, '3', 987.00, '2024-03-30 04:16:28', '2024-03-30 04:16:28'),
(40, '10', 678.00, '2024-03-30 04:19:54', '2024-03-30 04:19:54'),
(41, '15', 678.00, '2024-03-30 04:39:07', '2024-03-30 04:39:07'),
(42, 'rest_of_world', 68.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `showHome` enum('Yes','No') NOT NULL DEFAULT 'No',
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`, `slug`, `status`, `showHome`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'womens', 'womens', 1, 'No', 1, '2024-03-06 09:32:10', '2024-03-12 00:42:44'),
(40, 'Men\'s', 'mens', 1, 'Yes', 1, '2024-03-11 10:53:23', '2024-03-12 00:46:08'),
(41, 'Kids Fashion', 'kids-fashion', 1, 'Yes', 1, '2024-03-12 00:54:45', '2024-03-12 00:54:45'),
(42, 'Dell', 'dell', 1, 'Yes', 194, '2024-03-12 01:16:30', '2024-03-12 01:16:30'),
(43, 'ASUS', 'asus', 1, 'Yes', 194, '2024-03-12 01:16:45', '2024-03-12 01:16:45'),
(44, 'Sony', 'sony', 1, 'Yes', 194, '2024-03-12 01:17:03', '2024-03-12 01:17:03'),
(45, 'Mac', 'mac', 1, 'Yes', 194, '2024-03-12 01:17:13', '2024-03-12 01:17:13'),
(47, 'dfvdvfdv', 'dfvdvfdv', 0, 'No', 1, '2024-03-25 06:01:55', '2024-03-25 06:01:55');

-- --------------------------------------------------------

--
-- Table structure for table `temp_images`
--

CREATE TABLE `temp_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `role`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'mohit', 'mohit@example.com', NULL, 2, 1, NULL, '$2y$12$.mCcX6y3aSPJwf.dL2l.vOODEcLavOsqlfnFlS8OS.7QoCfkI3tLm', NULL, '2024-03-04 05:30:39', '2024-09-11 11:00:54'),
(7, 'webcipher', 'webcipher@gmail.com', '9090909088', 1, 1, NULL, '$2y$12$2soPJFJgIkoBMVEJV0aRfu0r7zaWJhbzVniE1rX1Bt6WtaKi4SN3G', NULL, '2024-04-16 00:49:28', '2024-04-16 00:49:28'),
(12, 'kaveri', 'kaveri@gmail.com', '9090902288', 1, 1, NULL, '$2y$12$ifa/HDgbfh0tYOX5amu4Vu25bOB2ls2EXlurxI4ZzluGqSVTAMa1u', NULL, '2024-04-20 04:03:10', '2024-04-20 04:03:10'),
(14, 'mohit', 'mohit@gmail.com', '9090909088', 1, 1, NULL, '$2y$12$zuHysVnJ1MEHOtFSs.SNYOI1AruTRlL0stN09WUscM07mNfQDS0J.', NULL, '2024-04-20 07:31:02', '2024-04-20 07:31:02'),
(15, 'test', 'test@gmail.com', '9090909088', 2, 1, NULL, '$2y$12$DV9PUiQChh.a6/P1qWNMeO1XbM2YVgw7AdBqxBKmARAL1jPugvOFK', NULL, '2024-04-20 13:03:33', '2024-04-22 00:56:52'),
(16, 'saniya', 'saniya@gmail.com', '9090909088', 1, 1, NULL, '$2y$12$5SOm.foadu10oTxAYfex3O2HGRxiTRug45PpjBE0jAItts385D1Lu', NULL, '2024-04-22 23:47:59', '2024-04-22 23:47:59'),
(17, 'mitali', 'mitali@gmail.com', '1122445577', 1, 1, NULL, '$2y$12$XlNTovIUwYdPG3oabKZT7.dg7i3BFg23DZZcAnX28evmm6ee9rL0W', NULL, '2024-07-30 07:18:15', '2024-07-30 07:18:15');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_addresses_user_id_foreign` (`user_id`),
  ADD KEY `customer_addresses_country_id_foreign` (`country_id`);

--
-- Indexes for table `discount_coupons`
--
ALTER TABLE `discount_coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_country_id_foreign` (`country_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_sub_category_id_foreign` (`sub_category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_ratings`
--
ALTER TABLE `product_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_ratings_product_id_foreign` (`product_id`);

--
-- Indexes for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `temp_images`
--
ALTER TABLE `temp_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `discount_coupons`
--
ALTER TABLE `discount_coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `product_ratings`
--
ALTER TABLE `product_ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `temp_images`
--
ALTER TABLE `temp_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD CONSTRAINT `customer_addresses_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customer_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_ratings`
--
ALTER TABLE `product_ratings`
  ADD CONSTRAINT `product_ratings_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
