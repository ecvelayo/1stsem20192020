-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2019 at 11:30 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `swmis`
--

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Stark, Hirthe and Ryan', '2019-03-02 22:32:20', '2019-03-02 22:32:20'),
(2, 'Gibson, Rau and Weissnat', '2019-03-02 22:32:20', '2019-03-02 22:32:20'),
(3, 'Volkman, Barrows and Mitchell', '2019-03-02 22:32:20', '2019-03-02 22:32:20'),
(4, 'Bogan Group', '2019-03-02 22:32:21', '2019-03-02 22:32:21'),
(5, 'Terry, Waelchi and Effertz', '2019-03-02 22:32:21', '2019-03-02 22:32:21'),
(6, 'Macejkovic PLC', '2019-03-02 22:32:21', '2019-03-02 22:32:21'),
(7, 'Schoen-Turcotte', '2019-03-02 22:32:21', '2019-03-02 22:32:21'),
(8, 'Emard PLC', '2019-03-02 22:32:21', '2019-03-02 22:32:21'),
(9, 'Carter, Tremblay and Kiehn', '2019-03-02 22:32:21', '2019-03-02 22:32:21'),
(10, 'Murphy-Smitham', '2019-03-02 22:32:21', '2019-03-02 22:32:21'),
(11, 'Batz Inc', '2019-03-02 22:32:21', '2019-03-02 22:32:21'),
(12, 'Torphy Inc', '2019-03-02 22:32:21', '2019-03-02 22:32:21'),
(13, 'Fahey-Halvorson', '2019-03-02 22:32:21', '2019-03-02 22:32:21'),
(14, 'Cummings, Schaden and Ernser', '2019-03-02 22:32:21', '2019-03-02 22:32:21'),
(15, 'Weissnat and Sons', '2019-03-02 22:32:21', '2019-03-02 22:32:21'),
(16, 'McLaughlin-Wuckert', '2019-03-02 22:32:21', '2019-03-02 22:32:21'),
(17, 'Ratke, Toy and Ruecker', '2019-03-02 22:32:21', '2019-03-02 22:32:21'),
(18, 'Gulgowski, Daugherty and Braun', '2019-03-02 22:32:21', '2019-03-02 22:32:21'),
(19, 'Lind Ltd', '2019-03-02 22:32:21', '2019-03-02 22:32:21'),
(20, 'D\'Amore, Boehm and Strosin', '2019-03-02 22:32:21', '2019-03-02 22:32:21'),
(21, 'Hamill-Friesen', '2019-03-02 22:32:21', '2019-03-02 22:32:21'),
(22, 'Koss-Gottlieb', '2019-03-02 22:32:21', '2019-03-02 22:32:21'),
(23, 'O\'Kon, Kris and Hudson', '2019-03-02 22:32:21', '2019-03-02 22:32:21'),
(25, 'Parker Group', '2019-03-02 22:32:21', '2019-03-02 22:32:21'),
(26, 'Stoltenberg Ltd', '2019-03-02 22:32:21', '2019-03-02 22:32:21'),
(27, 'Smitham, Veum and Tremblay', '2019-03-02 22:32:21', '2019-03-02 22:32:21'),
(28, 'Zemlak, Walsh and Koch', '2019-03-02 22:32:21', '2019-03-02 22:32:21'),
(29, 'Boyle Ltd', '2019-03-02 22:32:21', '2019-03-02 22:32:21'),
(30, 'Mohr PLC', '2019-03-02 22:32:22', '2019-03-02 22:32:22'),
(31, 'Wehner-Roberts', '2019-03-02 22:32:22', '2019-03-02 22:32:22'),
(32, 'Schaefer-Feeney', '2019-03-02 22:32:22', '2019-03-02 22:32:22'),
(33, 'Casper-Zieme', '2019-03-02 22:32:22', '2019-03-02 22:32:22'),
(34, 'Jones-Gaylord', '2019-03-02 22:32:22', '2019-03-02 22:32:22'),
(35, 'Wintheiser Group', '2019-03-02 22:32:22', '2019-03-02 22:32:22'),
(36, 'McLaughlin and Sons', '2019-03-02 22:32:22', '2019-03-02 22:32:22'),
(37, 'Kilback-Hand', '2019-03-02 22:32:22', '2019-03-02 22:32:22'),
(38, 'Rolfson, Cormier and Towne', '2019-03-02 22:32:22', '2019-03-02 22:32:22'),
(39, 'Ferry-Treutel', '2019-03-02 22:32:22', '2019-03-02 22:32:22'),
(40, 'Koch-Feest', '2019-03-02 22:32:22', '2019-03-02 22:32:22'),
(41, 'Feil, Hills and Boehm', '2019-03-02 22:32:22', '2019-03-02 22:32:22'),
(42, 'McLaughlin, Johnston and Graham', '2019-03-02 22:32:22', '2019-03-02 22:32:22'),
(43, 'Daniel-Zulauf', '2019-03-02 22:32:22', '2019-03-02 22:32:22'),
(44, 'Mann, Williamson and Shanahan', '2019-03-02 22:32:22', '2019-03-02 22:32:22'),
(45, 'Cremin, Hayes and Turner', '2019-03-02 22:32:22', '2019-03-02 22:32:22'),
(46, 'Bode, Stark and Pouros', '2019-03-02 22:32:22', '2019-03-02 22:32:22'),
(47, 'Runolfsdottir-Towne', '2019-03-02 22:32:22', '2019-03-02 22:32:22'),
(48, 'Wisozk, McKenzie and Ondricka', '2019-03-02 22:32:22', '2019-03-02 22:32:22'),
(50, 'Eichmann-Powlowski', '2019-03-02 22:32:22', '2019-03-02 22:32:22'),
(51, 'Price Inc', '2019-03-02 22:32:22', '2019-03-02 22:32:22'),
(52, 'Koepp-Mueller', '2019-03-02 22:32:22', '2019-03-02 22:32:22'),
(53, 'Schimmel-Huels', '2019-03-02 22:32:22', '2019-03-02 22:32:22'),
(54, 'Collier-Witting', '2019-03-02 22:32:22', '2019-03-02 22:32:22'),
(55, 'Russel LLC', '2019-03-02 22:32:22', '2019-03-02 22:32:22'),
(56, 'Stokes, Corwin and Wisozk', '2019-03-02 22:32:22', '2019-03-02 22:32:22'),
(57, 'Heathcote Ltd', '2019-03-02 22:32:22', '2019-03-02 22:32:22'),
(58, 'Gislason PLC', '2019-03-02 22:32:23', '2019-03-02 22:32:23'),
(59, 'Boyer Ltd', '2019-03-02 22:32:23', '2019-03-02 22:32:23'),
(60, 'Gibson, Zulauf and Barrows', '2019-03-02 22:32:23', '2019-03-02 22:32:23'),
(61, 'Pollich-Dibbert', '2019-03-02 22:32:23', '2019-03-02 22:32:23'),
(62, 'Haag Inc', '2019-03-02 22:32:23', '2019-03-02 22:32:23'),
(63, 'Huel, Gaylord and Kunze', '2019-03-02 22:32:23', '2019-03-02 22:32:23'),
(64, 'Wehner-Runte', '2019-03-02 22:32:23', '2019-03-02 22:32:23'),
(65, 'Leuschke Ltd', '2019-03-02 22:32:23', '2019-03-02 22:32:23'),
(66, 'O\'Hara and Sons', '2019-03-02 22:32:23', '2019-03-02 22:32:23'),
(67, 'Welch-Skiles', '2019-03-02 22:32:23', '2019-03-02 22:32:23'),
(68, 'Pouros Ltd', '2019-03-02 22:32:23', '2019-03-02 22:32:23'),
(69, 'Bauch LLC', '2019-03-02 22:32:23', '2019-03-02 22:32:23'),
(70, 'VonRueden-Greenfelder', '2019-03-02 22:32:23', '2019-03-02 22:32:23'),
(71, 'Beer, Beer and Cole', '2019-03-02 22:32:23', '2019-03-02 22:32:23'),
(72, 'Mayert, Beier and Ondricka', '2019-03-02 22:32:23', '2019-03-02 22:32:23'),
(73, 'Bechtelar LLC', '2019-03-02 22:32:23', '2019-03-02 22:32:23'),
(74, 'Bednar-Keeling', '2019-03-02 22:32:23', '2019-03-02 22:32:23'),
(75, 'Fay Inc', '2019-03-02 22:32:23', '2019-03-02 22:32:23'),
(76, 'Luettgen LLC', '2019-03-02 22:32:23', '2019-03-02 22:32:23'),
(77, 'DuBuque, Herzog and Thompson', '2019-03-02 22:32:23', '2019-03-02 22:32:23'),
(78, 'Blick PLC', '2019-03-02 22:32:23', '2019-03-02 22:32:23'),
(79, 'Krajcik-Bashirian', '2019-03-02 22:32:23', '2019-03-02 22:32:23'),
(80, 'Gislason Ltd', '2019-03-02 22:32:23', '2019-03-02 22:32:23'),
(81, 'Smith-Marks', '2019-03-02 22:32:23', '2019-03-02 22:32:23'),
(82, 'Ledner, Ebert and Altenwerth', '2019-03-02 22:32:23', '2019-03-02 22:32:23'),
(83, 'Ruecker-Zieme', '2019-03-02 22:32:23', '2019-03-02 22:32:23'),
(84, 'Schowalter Group', '2019-03-02 22:32:23', '2019-03-02 22:32:23'),
(85, 'Koepp-Gottlieb', '2019-03-02 22:32:23', '2019-03-02 22:32:23'),
(86, 'Toy-Anderson', '2019-03-02 22:32:24', '2019-03-02 22:32:24'),
(87, 'Pfeffer PLC', '2019-03-02 22:32:24', '2019-03-02 22:32:24'),
(88, 'Hermiston, Kilback and Hettinger', '2019-03-02 22:32:24', '2019-03-02 22:32:24'),
(89, 'Stracke, Fay and Koelpin', '2019-03-02 22:32:24', '2019-03-02 22:32:24'),
(90, 'Parisian-Kutch', '2019-03-02 22:32:24', '2019-03-02 22:32:24'),
(91, 'Pacocha-Monahan', '2019-03-02 22:32:24', '2019-03-02 22:32:24'),
(92, 'Mosciski, Konopelski and Bahringer', '2019-03-02 22:32:24', '2019-03-02 22:32:24'),
(93, 'Shanahan Inc', '2019-03-02 22:32:24', '2019-03-02 22:32:24'),
(94, 'Berge, Streich and Kozey', '2019-03-02 22:32:24', '2019-03-02 22:32:24'),
(95, 'Eichmann-Tremblay', '2019-03-02 22:32:24', '2019-03-02 22:32:24'),
(96, 'Hirthe-Hand', '2019-03-02 22:32:24', '2019-03-02 22:32:24'),
(97, 'Padberg PLC', '2019-03-02 22:32:24', '2019-03-02 22:32:24'),
(98, 'Daniel Inc', '2019-03-02 22:32:24', '2019-03-02 22:32:24'),
(99, 'Schmidt Ltd', '2019-03-02 22:32:24', '2019-03-02 22:32:24'),
(100, 'Feil, Schneider and Rippin', '2019-03-02 22:32:24', '2019-03-02 22:32:24'),
(101, 'Why', '2019-04-15 03:11:53', '2019-04-15 03:11:53');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_03_03_004117_create_areas_table', 1),
(3, '2019_03_03_022859_create_projects_table', 1),
(4, '2019_03_03_034846_create_project_panel_table', 1),
(5, '2019_03_31_052118_create_project_authors_table', 2),
(6, '2019_03_31_052235_create_project_authors_forein_keys', 2),
(7, '2019_03_31_054323_remove_author_column_from_projects_table', 2),
(8, '2019_03_31_065141_add_project_status_column_to_project_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `doi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abstract` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `adviser_id` int(10) UNSIGNED NOT NULL,
  `area_id` int(10) UNSIGNED NOT NULL,
  `call_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_submitted` date DEFAULT NULL,
  `keywords` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pages` int(10) UNSIGNED NOT NULL,
  `year_published` year(4) NOT NULL,
  `project_status` enum('approved','pending','rejected','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `uploaded_file_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `doi`, `title`, `abstract`, `adviser_id`, `area_id`, `call_number`, `date_submitted`, `keywords`, `pages`, `year_published`, `project_status`, `uploaded_file_path`, `created_at`, `updated_at`) VALUES
(17, NULL, 'This is a Thesis 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam non efficitur magna, vel imperdiet nisi. Quisque mollis magna felis, in finibus justo sagittis rutrum. Suspendisse potenti. Praesent ornare aliquam lectus et accumsan. Nam porttitor luctus turpis. Nullam sed maximus ante. Mauris convallis justo varius dolor bibendum luctus. Aenean at erat non eros pretium semper.', 64, 45, '', NULL, 'Health, Education, Governance', 100, 2019, 'approved', '66/oGUuw2aFYSBBRjziH0EsU6uE4KV6ckGYm0o8gyF2.pdf', '2019-03-31 01:15:22', '2019-03-31 01:18:20'),
(18, NULL, 'Student Work Management Information System', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ullamcorper nibh et ipsum elementum ultrices. Ut sollicitudin fermentum fringilla. Mauris aliquam, enim in auctor volutpat, enim urna interdum lacus, in condimentum massa felis vel diam. Pellentesque elementum dictum mauris vel convallis. Sed ut feugiat est, sed posuere dolor. Nulla facilisi. Maecenas non tortor turpis. Vestibulum sed augue sit amet libero viverra interdum. Fusce non cursus augue. Vestibulum a arcu mi. Ut euismod, nisi sit amet eleifend pretium, sapien justo lobortis metus, eget vestibulum nibh augue eu magna. Ut maximus nunc et mauris mattis elementum. Quisque vitae ex nec nulla efficitur feugiat euismod sed dui. Donec vestibulum fringilla commodo. Integer in lacus dignissim sem gravida efficitur eget eget est. Cras porttitor, ligula ac vehicula ornare, justo urna accumsan quam, tincidunt volutpat elit orci sed felis.', 64, 33, '', NULL, 'Title, Happy, ICT,Love', 140, 2019, 'approved', '69/S4wZp6fe1buaB28O02YkmrJ5E1yTjGZZx0GxPceW.pdf', '2019-03-31 10:22:36', '2019-03-31 10:26:30'),
(19, NULL, 'The Thesis for DCIS', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent convallis facilisis pretium. Mauris tempus faucibus lacinia. Donec finibus tristique convallis. Fusce at mollis nulla, nec rhoncus risus. Nam vitae dui at urna consequat venenatis. In elit orci, vehicula nec tempor vitae, euismod ac mi. Aenean venenatis ac dui sit amet vestibulum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ultrices quam ac ex vehicula mollis. Vivamus nec orci ac arcu pulvinar scelerisque. Duis volutpat sollicitudin enim et congue.', 64, 18, '', NULL, 'Education, Environment, Technology', 190, 2019, 'approved', '70/WfSoYngYtptWtMNykG4ezw4oRztiOjMKnQSq5GpV.pdf', '2019-04-02 06:55:02', '2019-04-02 06:57:43'),
(20, NULL, 'the north face', 'cdasjbdfkasajfs daskjbdhjasgdfhna sdnasvcfhjavsbnd asdb asuasb n,sa kahsbfa sndvasdknd na dvkasvd', 64, 11, '', NULL, 'struggle, laban, hahaha', 200, 2019, 'approved', '70/4jeGdkQhsabzNFGDLa8NJpOt9ggIqKrpKvF5SpnE.pdf', '2019-04-02 07:20:59', '2019-04-02 07:27:11'),
(21, NULL, 'jkjfjkfbuasbf', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent convallis facilisis pretium. Mauris tempus faucibus lacinia. Donec finibus tristique convallis. Fusce at mollis nulla, nec rhoncus risus. Nam vitae dui at urna consequat venenatis. In elit orci, vehicula nec tempor vitae, euismod ac mi. Aenean venenatis ac dui sit amet vestibulum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ultrices quam ac ex vehicula mollis. Vivamus nec orci ac arcu pulvinar scelerisque. Duis volutpat sollicitudin enim et congue.', 64, 50, '', NULL, 'Hope, Love, Win', 200, 2019, 'approved', '70/3jl7UxMHop1xf1mVG78d0CTTXWxYekxyF1YY4KYz.pdf', '2019-04-02 08:13:48', '2019-04-02 08:14:44'),
(22, NULL, 'The Lorem Ipsum Dolor', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent convallis facilisis pretium. Mauris tempus faucibus lacinia. Donec finibus tristique convallis. Fusce at mollis nulla, nec rhoncus risus. Nam vitae dui at urna consequat venenatis. In elit orci, vehicula nec tempor vitae, euismod ac mi. Aenean venenatis ac dui sit amet vestibulum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ultrices quam ac ex vehicula mollis. Vivamus nec orci ac arcu pulvinar scelerisque. Duis volutpat sollicitudin enim et congue.', 64, 19, '', NULL, 'this, is, it, pancit', 160, 2019, 'approved', '52/CXdfb4MGUGJEFH3piNKqpLSq6iidEuQpgH1bsaZk.pdf', '2019-04-02 19:49:36', '2019-04-02 19:52:14'),
(23, NULL, 'example', 'ofhusfas dasdhuashdbasd asdabskd', 72, 50, '', NULL, 'testing, center, lmao', 100, 2019, 'approved', '71/M8y8KYOu8cHDwTwE19H3DwQDPGsa9DBoSQEDOLsu.pdf', '2019-04-02 19:58:45', '2019-04-02 19:59:50'),
(24, NULL, 'This is a test 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sed aliquam sem. Suspendisse volutpat quis metus non egestas. Nullam sed libero erat. In hac habitasse platea dictumst. Vestibulum ut lacus ac erat volutpat pretium sed sollicitudin massa. Pellentesque porta consectetur sem, sed aliquet metus venenatis eget. Fusce congue nibh at purus aliquet aliquet. Nunc ullamcorper iaculis mi, non aliquam augue iaculis quis. Sed consequat in orci at vulputate. Nulla lorem elit, feugiat et consequat non, tempus vitae metus. Praesent id nulla nibh.', 74, 99, '', NULL, 'test, example', 199, 2019, 'approved', '80/gxMLp49B6g8vOKZptiqDfwFEQfDaayM2bgkPYWeP.pdf', '2019-04-02 22:19:07', '2019-04-02 22:20:38'),
(25, NULL, 'The study of aliens', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sed aliquam sem. Suspendisse volutpat quis metus non egestas. Nullam sed libero erat. In hac habitasse platea dictumst. Vestibulum ut lacus ac erat volutpat pretium sed sollicitudin massa. Pellentesque porta consectetur sem, sed aliquet metus venenatis eget. Fusce congue nibh at purus aliquet aliquet. Nunc ullamcorper iaculis mi, non aliquam augue iaculis quis. Sed consequat in orci at vulputate. Nulla lorem elit, feugiat et consequat non, tempus vitae metus. Praesent id nulla nibh.', 77, 69, NULL, NULL, 'Health, Education, Governance', 150, 2019, 'approved', '86/bcCY5OgKeXQyPZFVaqtRLnf9RafXLSN8PhXxsPph.pdf', '2019-04-03 00:35:57', '2019-04-15 02:54:47'),
(26, NULL, 'Study of Human', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sed aliquam sem. Suspendisse volutpat quis metus non egestas. Nullam sed libero erat. In hac habitasse platea dictumst. Vestibulum ut lacus ac erat volutpat pretium sed sollicitudin massa. Pellentesque porta consectetur sem, sed aliquet metus venenatis eget. Fusce congue nibh at purus aliquet aliquet. Nunc ullamcorper iaculis mi, non aliquam augue iaculis quis. Sed consequat in orci at vulputate. Nulla lorem elit, feugiat et consequat non, tempus vitae metus. Praesent id nulla nibh.', 74, 59, NULL, NULL, 'Health, Education, Governance', 123, 2019, 'pending', '86/vlJ4jG8YblX0MxCiJuiMqiIioNyrhoCLBLYCcCue.pdf', '2019-04-03 00:43:23', '2019-04-03 00:43:23'),
(27, NULL, 'This is a thesis', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sed aliquam sem. Suspendisse volutpat quis metus non egestas. Nullam sed libero erat. In hac habitasse platea dictumst. Vestibulum ut lacus ac erat volutpat pretium sed sollicitudin massa. Pellentesque porta consectetur sem, sed aliquet metus venenatis eget. Fusce congue nibh at purus aliquet aliquet. Nunc ullamcorper iaculis mi, non aliquam augue iaculis quis. Sed consequat in orci at vulputate. Nulla lorem elit, feugiat et consequat non, tempus vitae metus. Praesent id nulla nibh.', 75, 94, NULL, NULL, 'Health, Education, Governance', 100, 2019, 'approved', '90/aAk19WbY4Up8CFcwhIBSI7ODSkrYn5qwuf2l4Vg7.pdf', '2019-04-03 01:03:38', '2019-04-03 01:05:10'),
(28, '12345662412414', 'This is a Journal', 'This is an example of a journal. How much wood would the wood pecker peck if the wood pecker would peck wood.', 76, 29, NULL, NULL, 'Health, Education, Governance', 150, 2019, 'approved', '90/lMPnJs2pU0DdF2qgaGlIpiuzdvYEfzOgeYxe97Hn.pdf', '2019-04-03 04:27:00', '2019-04-03 04:28:43'),
(29, NULL, 'dahsdjhasj', 'asdsdas', 74, 74, NULL, NULL, 'test, example', 100, 2019, 'pending', '65/2RFK4jA5t9JQUmW4ZDOr6rtn27gSuJvCocLL845l.pdf', '2019-04-15 03:53:07', '2019-04-15 03:53:07'),
(30, NULL, 'This is a demo', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In condimentum velit in magna sagittis facilisis. Praesent eu mattis ante, id aliquet felis. Nulla fringilla sem orci, vitae egestas lectus varius ac. Integer et quam nisl. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras cursus faucibus sem a maximus. Curabitur fringilla, nisl eu varius euismod, mi arcu posuere quam, non sollicitudin diam urna et eros.', 75, 37, NULL, NULL, 'Health, Education, Governance', 190, 2019, 'approved', '94/TOR35Pyh9Rwf8BWQhIVRmzdAuo44JlFpSVX0RvLN.pdf', '2019-04-15 05:55:55', '2019-04-15 05:57:44'),
(31, NULL, 'JOF', 'sdjaskdkjsakdjasdlakjsdas', 64, 47, NULL, NULL, 'brokerage', 150, 2019, 'approved', '95/VElmALMEMpIfgii63LONhYYb6kxbooIjuKusbTtq.pdf', '2019-09-16 23:57:48', '2019-09-17 00:21:52'),
(32, NULL, 'Online Dental Appointment Hub', 'Maynta makapasar please Miss Pena', 76, 9, NULL, NULL, 'Health, Education, Governance', 80, 2019, 'approved', '96/Y6UHzwsFxqHfU7njvN2ealhf3k7NmayA6KMld4xf.pdf', '2019-09-17 23:21:25', '2019-09-17 23:25:05'),
(33, NULL, 'Fire Notification System', 'dkjasd asdnjakskdn;lsd sadjasndaslm dasndjkasdnasd sdjasdnas', 64, 2, NULL, NULL, 'Title, Happy, ICT', 12, 2019, 'approved', '52/Pl50VOyVQiSQlXeM6gZ6qCQXMbPn92MXjM9lJXFX.pdf', '2019-09-18 01:06:00', '2019-09-18 01:08:39');

-- --------------------------------------------------------

--
-- Table structure for table `project_authors`
--

CREATE TABLE `project_authors` (
  `id` int(10) UNSIGNED NOT NULL,
  `author_id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_authors`
--

INSERT INTO `project_authors` (`id`, `author_id`, `project_id`, `created_at`, `updated_at`) VALUES
(5, 2, 17, NULL, NULL),
(6, 9, 17, NULL, NULL),
(7, 62, 17, NULL, NULL),
(8, 66, 17, NULL, NULL),
(9, 2, 18, NULL, NULL),
(10, 63, 18, NULL, NULL),
(11, 69, 18, NULL, NULL),
(12, 2, 19, NULL, NULL),
(13, 9, 19, NULL, NULL),
(14, 14, 19, NULL, NULL),
(15, 70, 19, NULL, NULL),
(16, 2, 20, NULL, NULL),
(17, 5, 20, NULL, NULL),
(18, 18, 20, NULL, NULL),
(19, 70, 20, NULL, NULL),
(20, 1, 21, NULL, NULL),
(21, 3, 21, NULL, NULL),
(22, 48, 21, NULL, NULL),
(23, 70, 21, NULL, NULL),
(24, 52, 22, NULL, NULL),
(25, 69, 22, NULL, NULL),
(26, 70, 22, NULL, NULL),
(27, 71, 22, NULL, NULL),
(28, 52, 23, NULL, NULL),
(29, 56, 23, NULL, NULL),
(31, 71, 23, NULL, NULL),
(32, 69, 23, NULL, NULL),
(33, 78, 24, NULL, NULL),
(34, 79, 24, NULL, NULL),
(35, 80, 24, NULL, NULL),
(36, 81, 24, NULL, NULL),
(37, 82, 25, NULL, NULL),
(38, 84, 25, NULL, NULL),
(39, 85, 25, NULL, NULL),
(40, 86, 25, NULL, NULL),
(41, 82, 26, NULL, NULL),
(42, 84, 26, NULL, NULL),
(43, 85, 26, NULL, NULL),
(44, 86, 26, NULL, NULL),
(45, 87, 27, NULL, NULL),
(46, 88, 27, NULL, NULL),
(47, 89, 27, NULL, NULL),
(48, 90, 27, NULL, NULL),
(49, 87, 28, NULL, NULL),
(50, 88, 28, NULL, NULL),
(51, 89, 28, NULL, NULL),
(52, 90, 28, NULL, NULL),
(53, 2, 29, NULL, NULL),
(54, 5, 29, NULL, NULL),
(55, 8, 29, NULL, NULL),
(56, 87, 30, NULL, NULL),
(57, 88, 30, NULL, NULL),
(58, 89, 30, NULL, NULL),
(59, 94, 30, NULL, NULL),
(60, 94, 31, NULL, NULL),
(61, 95, 31, NULL, NULL),
(62, 13, 32, NULL, NULL),
(63, 52, 32, NULL, NULL),
(64, 96, 32, NULL, NULL),
(65, 52, 33, NULL, NULL),
(66, 71, 33, NULL, NULL),
(67, 94, 33, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_panel`
--

CREATE TABLE `project_panel` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `panel_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_panel`
--

INSERT INTO `project_panel` (`id`, `project_id`, `panel_id`, `created_at`, `updated_at`) VALUES
(46, 17, 20, NULL, NULL),
(47, 17, 12, NULL, NULL),
(48, 17, 32, NULL, NULL),
(49, 18, 38, NULL, NULL),
(50, 18, 40, NULL, NULL),
(51, 18, 47, NULL, NULL),
(52, 19, 50, NULL, NULL),
(53, 19, 58, NULL, NULL),
(54, 19, 20, NULL, NULL),
(55, 19, 47, NULL, NULL),
(56, 20, 58, NULL, NULL),
(57, 20, 20, NULL, NULL),
(58, 20, 26, NULL, NULL),
(59, 20, 43, NULL, NULL),
(60, 21, 23, NULL, NULL),
(61, 21, 59, NULL, NULL),
(62, 21, 7, NULL, NULL),
(63, 21, 41, NULL, NULL),
(64, 22, 58, NULL, NULL),
(65, 22, 38, NULL, NULL),
(66, 22, 12, NULL, NULL),
(67, 22, 41, NULL, NULL),
(68, 23, 64, NULL, NULL),
(69, 23, 4, NULL, NULL),
(70, 23, 43, NULL, NULL),
(71, 23, 41, NULL, NULL),
(72, 24, 72, NULL, NULL),
(73, 24, 77, NULL, NULL),
(75, 24, 75, NULL, NULL),
(76, 25, 74, NULL, NULL),
(77, 25, 31, NULL, NULL),
(78, 25, 64, NULL, NULL),
(79, 26, 26, NULL, NULL),
(80, 26, 64, NULL, NULL),
(81, 26, 41, NULL, NULL),
(82, 27, 74, NULL, NULL),
(83, 27, 31, NULL, NULL),
(84, 27, 25, NULL, NULL),
(85, 28, 34, NULL, NULL),
(86, 28, 43, NULL, NULL),
(87, 28, 41, NULL, NULL),
(88, 29, 58, NULL, NULL),
(89, 29, 77, NULL, NULL),
(90, 29, 64, NULL, NULL),
(91, 30, 58, NULL, NULL),
(92, 30, 20, NULL, NULL),
(93, 30, 74, NULL, NULL),
(94, 31, 72, NULL, NULL),
(95, 31, 34, NULL, NULL),
(96, 31, 92, NULL, NULL),
(97, 32, 77, NULL, NULL),
(98, 33, 74, NULL, NULL),
(99, 33, 23, NULL, NULL),
(100, 33, 31, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_initial` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `contact_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_role` enum('admin','student','adviser') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `middle_initial`, `birthdate`, `contact_number`, `username`, `password`, `user_role`, `created_at`, `updated_at`) VALUES
(1, 'Sabrina', 'Bergnaum', 'T', '2005-07-29', '+2970728183983', 'bstiedemann', '518d5f3401534f5c6c21977f12f60989', 'student', '2019-03-02 22:32:18', '2019-03-02 22:32:18'),
(2, 'Avis', 'Lesch', 'O', '2007-01-19', '+3041593037177', 'runte.marcellus', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'student', '2019-03-02 22:32:18', '2019-03-02 22:32:18'),
(3, 'Gregg', 'Hauck', 'L', '2018-08-13', '+5177721814327', 'name.quitzon', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'student', '2019-03-02 22:32:18', '2019-03-02 22:32:18'),
(4, 'Robert', 'Pfannerstill', 'N', '2014-12-02', '+3563063606519', 'marjorie38', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'adviser', '2019-03-02 22:32:19', '2019-03-02 22:32:19'),
(5, 'Gavin', 'Tremblay', 'E', '1989-12-25', '+8859199538124', 'ryley36', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'student', '2019-03-02 22:32:19', '2019-03-02 22:32:19'),
(6, 'Yoshiko', 'Gerhold', 'P', '1976-11-20', '+9162241118586', 'kieran.nitzsche', '5d41402abc4b2a76b9719d911017c592', 'adviser', '2019-03-02 22:32:19', '2019-03-02 22:32:19'),
(7, 'Theo', 'Ratke', 'X', '1979-04-14', '+9162735071204', 'russell.jones', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'adviser', '2019-03-02 22:32:19', '2019-03-02 22:32:19'),
(8, 'Vicente', 'Lind', 'H', '1970-08-13', '+2572852390545', 'boehm.vella', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'student', '2019-03-02 22:32:19', '2019-03-02 22:32:19'),
(9, 'Heaven', 'McClure', 'M', '1979-01-10', '+7646083729177', 'wolff.octavia', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'student', '2019-03-02 22:32:19', '2019-03-02 22:32:19'),
(10, 'Dorian', 'Gutkowski', 'N', '1985-03-21', '+2039146385056', 'buckridge.frederique', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'adviser', '2019-03-02 22:32:19', '2019-03-02 22:32:19'),
(11, 'Laury', 'Dickinson', 'E', '1998-12-18', '+3028955345971', 'kayley01', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'adviser', '2019-03-02 22:32:19', '2019-03-02 22:32:19'),
(12, 'Ivory', 'Rempel', 'T', '2016-08-15', '+5668029584652', 'prohaska.doris', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'adviser', '2019-03-02 22:32:19', '2019-03-02 22:32:19'),
(13, 'Crystal', 'Paucek', 'U', '1986-09-06', '+7757082256727', 'estella.thiel', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'student', '2019-03-02 22:32:19', '2019-03-02 22:32:19'),
(14, 'Frida', 'Simonis', 'P', '1989-06-11', '+5038961617401', 'leatha.kub', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'student', '2019-03-02 22:32:19', '2019-03-02 22:32:19'),
(15, 'Josianne', 'Bruen', 'B', '1987-10-08', '+7513550778940', 'nickolas03', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'student', '2019-03-02 22:32:19', '2019-03-02 22:32:19'),
(16, 'Gennaro', 'D\'Amore', 'U', '2001-08-10', '+2490529713382', 'deangelo.tremblay', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'student', '2019-03-02 22:32:19', '2019-03-02 22:32:19'),
(17, 'Charlene', 'Gorczany', 'H', '2005-04-22', '+3617675545160', 'otto.okuneva', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'adviser', '2019-03-02 22:32:19', '2019-03-02 22:32:19'),
(18, 'Kyleigh', 'Kutch', 'T', '1971-09-26', '+5480714025419', 'jolie74', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'student', '2019-03-02 22:32:19', '2019-03-02 22:32:19'),
(19, 'Tre', 'Dickens', 'R', '1994-01-06', '+4585774066462', 'nick.hills', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'student', '2019-03-02 22:32:19', '2019-03-02 22:32:19'),
(20, 'Braeden', 'Cartwright', 'Q', '2013-04-17', '+1573568141703', 'lavern10', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'adviser', '2019-03-02 22:32:19', '2019-03-02 22:32:19'),
(21, 'Orie', 'Little', 'K', '1977-04-05', '+2199685496615', 'winfield.johnston', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'student', '2019-03-02 22:32:19', '2019-03-02 22:32:19'),
(22, 'Rosetta', 'Connelly', 'K', '1980-12-31', '+2885922812264', 'howell.roob', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'adviser', '2019-03-02 22:32:19', '2019-03-02 22:32:19'),
(23, 'Christiana', 'Christiansen', 'U', '2012-03-17', '+3530717560667', 'bernier.evalyn', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'adviser', '2019-03-02 22:32:19', '2019-03-02 22:32:19'),
(25, 'Deon', 'Jaskolski', 'I', '2000-02-09', '+5164168945938', 'edgar.wiza', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'adviser', '2019-03-02 22:32:19', '2019-03-02 22:32:19'),
(26, 'Cory', 'Nienow', 'M', '2015-05-24', '+1297623488160', 'marilyne54', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'adviser', '2019-03-02 22:32:19', '2019-03-02 22:32:19'),
(27, 'Cary', 'Stanton', 'B', '1990-09-17', '+1453267164502', 'berry.hodkiewicz', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'student', '2019-03-02 22:32:19', '2019-03-02 22:32:19'),
(28, 'Sofia', 'Gaylord', 'Q', '2005-04-11', '+4228864117748', 'becker.joannie', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'student', '2019-03-02 22:32:20', '2019-03-02 22:32:20'),
(29, 'Brandi', 'Sawayn', 'U', '1979-02-19', '+5756049294491', 'lillian31', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'student', '2019-03-02 22:32:20', '2019-03-02 22:32:20'),
(30, 'Abbey', 'Rice', 'C', '1999-06-01', '+6356433752053', 'rosemary.tromp', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'student', '2019-03-02 22:32:20', '2019-03-02 22:32:20'),
(31, 'Samantha', 'Dare', 'A', '1978-07-10', '+9520688943990', 'qdurgan', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'adviser', '2019-03-02 22:32:20', '2019-03-02 22:32:20'),
(32, 'Ken', 'VonRueden', 'U', '2007-07-05', '+8723177437837', 'rchristiansen', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'adviser', '2019-03-02 22:32:20', '2019-03-02 22:32:20'),
(33, 'Ubaldo', 'Olson', 'C', '1979-06-18', '+4288619750404', 'tanner68', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'student', '2019-03-02 22:32:20', '2019-03-02 22:32:20'),
(34, 'Marilyne', 'Lockman', 'B', '2007-08-21', '+2330802387385', 'xoreilly', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'adviser', '2019-03-02 22:32:20', '2019-03-02 22:32:20'),
(35, 'Triston', 'Boehm', 'W', '1982-11-27', '+2255456236150', 'colton.murazik', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'adviser', '2019-03-02 22:32:20', '2019-03-02 22:32:20'),
(36, 'Carmel', 'Larkin', 'I', '1978-01-11', '+1231599236566', 'darby38', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'adviser', '2019-03-02 22:32:20', '2019-03-02 22:32:20'),
(37, 'Eleazar', 'Terry', 'J', '1972-05-12', '+7047156424765', 'jast.ewald', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'student', '2019-03-02 22:32:20', '2019-03-02 22:32:20'),
(38, 'Grady', 'Morissette', 'V', '2018-09-23', '+6889653057557', 'obogan', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'adviser', '2019-03-02 22:32:20', '2019-03-02 22:32:20'),
(39, 'Claudine', 'Sporer', 'L', '2000-05-11', '+1086917655667', 'oconnell.haylie', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'student', '2019-03-02 22:32:20', '2019-03-02 22:32:20'),
(40, 'Kasandra', 'Ortiz', 'K', '1999-09-20', '+5220892724633', 'gschowalter', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'adviser', '2019-03-02 22:32:20', '2019-03-02 22:32:20'),
(41, 'Samanta', 'Stokes', 'E', '1978-09-08', '+6720254415797', 'gabrielle38', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'adviser', '2019-03-02 22:32:20', '2019-03-02 22:32:20'),
(42, 'Lucy', 'Steuber', 'Q', '1970-01-05', '+9241932526404', 'meggie15', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'student', '2019-03-02 22:32:20', '2019-03-02 22:32:20'),
(43, 'Isabella', 'Senger', 'W', '1976-10-21', '+9448840717873', 'kassandra.gaylord', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'adviser', '2019-03-02 22:32:20', '2019-03-02 22:32:20'),
(44, 'Trystan', 'McLaughlin', 'F', '1989-12-18', '+4991144143969', 'tyrese06', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'student', '2019-03-02 22:32:20', '2019-03-02 22:32:20'),
(45, 'Nestor', 'Smith', 'M', '2002-11-26', '+4596346139671', 'stoltenberg.della', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'student', '2019-03-02 22:32:20', '2019-03-02 22:32:20'),
(46, 'Patricia', 'McLaughlin', 'U', '1978-07-01', '+7065899364402', 'green.adell', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'student', '2019-03-02 22:32:20', '2019-03-02 22:32:20'),
(47, 'Dennis', 'Schamberger', 'R', '2001-01-11', '+8673757134262', 'stehr.briana', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'adviser', '2019-03-02 22:32:20', '2019-03-02 22:32:20'),
(48, 'Jovanny', 'Paucek', 'B', '1977-03-21', '+7181119023962', 'beth.schmitt', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'student', '2019-03-02 22:32:20', '2019-03-02 22:32:20'),
(49, 'Augustus', 'Volkman', 'T', '1983-05-29', '+1170383361913', 'terrill.rohan', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'student', '2019-03-02 22:32:20', '2019-03-02 22:32:20'),
(50, 'kdkksdf', 'aaaa', 'P', '1989-12-02', '+1330055388018', 'bridget23', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'adviser', '2019-03-02 22:32:20', '2019-03-30 21:53:29'),
(52, 'Jonah', 'Labrador', 'J', '2019-02-27', '09923357881', 'jonah', '$2y$10$W8GDjmBCEz78qIWkyrx0ZO9hOLIkpEkwQThiL3tEYixCMTQuZiB1e', 'student', '2019-03-03 20:02:29', '2019-03-03 20:02:29'),
(56, 'Momo', 'challenge', 'm', '2019-03-22', '09090909090', 'momo', '$2y$10$veHxMANq74z3dVk1Jslm2eWVLnw72tFAhGw9XgjlagJT6rzaGZKNC', 'student', '2019-03-03 23:40:21', '2019-03-03 23:40:21'),
(57, 'Jan', 'Doe', 'S', '2019-03-14', '99753710933', 'jan', '$2y$10$6RNeGv4YgY1whCiMU6jzjuM.ipPPOwBgmsOxKtyEObdNXVFVmSh02', 'student', '2019-03-04 00:24:06', '2019-03-04 00:24:06'),
(58, 'jojo', 'binay', 'j', NULL, NULL, 'jojoo', '$2y$10$LlrK7ujeNiTdG4oAvRTwC.Jn345IlX7vir4CVsLBnxkwmKeY8tqDe', 'adviser', '2019-03-04 00:30:21', '2019-03-04 00:30:21'),
(59, 'aupdatd', 'na', 'j', NULL, NULL, 'huhuhu', '$2y$10$4fjWb5bWGl7PpkX3NJzb7etRTHZ/NACqPzBnzipGf/2EiHqJOSDq.', 'adviser', '2019-03-18 03:05:16', '2019-03-29 01:12:47'),
(60, 'testing', 'testing', 't', '2019-03-22', '09090909090', 'testing', '$2y$10$EqFJAbM9fxa9Ajmd3BbXluDfIc3CKRIQ4xPpCfWPGYpnpg2miSzeW', 'student', '2019-03-19 23:51:11', '2019-03-19 23:51:11'),
(62, 'testing', 'testing', 't', '2019-03-06', '99753710933', 'testing1', '$2y$10$Z0lycAc3I6P.qv0onfwTAeRaQq8vqKC0zB5XpNfx1MY/1ixT/Jdn2', 'student', '2019-03-19 23:59:24', '2019-03-19 23:59:24'),
(63, 'Adlai', 'Buday', 'D', '2019-03-19', '99753710933', 'adlai', '$2y$10$wpnr5naoIt23mq0EpqrlxOre6S9fmTQ7sHc2x3vklCS8XfwVXFMEW', 'student', '2019-03-21 00:13:38', '2019-03-21 00:13:38'),
(64, 'Glenn', 'Pepito', 'G', NULL, NULL, 'glenn', '$2y$10$VglfTT4uJdZgNzR4sczgteV70mHMLj5Ipg7npn1Ca3gNJcay2SXMy', 'adviser', '2019-03-29 01:09:56', '2019-03-29 05:58:34'),
(65, 'Arnel', 'Amorgiente', 'p', '2019-03-06', '09979346572', 'admin', '$2y$10$NUP5xuPinqGwU.vf8Et6XOngnz3Ky1/DPXLzt00RCrDSFgFCpCgoq', 'admin', '2019-03-31 00:57:55', '2019-03-31 00:57:55'),
(66, 'John', 'Doe', 'G', '2019-03-23', '09979346572', 'johnD', '$2y$10$CdVgRb33q8A1S1nfm1dSOeuD4nGO/jql0k0DDFnPiTj/HYaOqxjO6', 'student', '2019-03-31 00:59:41', '2019-03-31 00:59:41'),
(67, 'Glenn', 'Pepito', 'B', '2019-03-14', '99753710933', 'gpepito', '$2y$10$adNHCFB7kmYeDQzHB.S3CuiG1Wq5jGjVvqWo1vtbgWA16ekoq02hS', 'student', '2019-03-31 01:02:45', '2019-03-31 01:02:45'),
(69, 'Adlai', 'Johann', 'T', '2019-04-19', '11111111111', 'honey', '$2y$10$ldaniNBaN4X4cO9fnfedUu65yxO7YKOusTIDEYTGrATj4tMHvxrRa', 'student', '2019-03-31 10:19:41', '2019-03-31 10:19:41'),
(70, 'Van Henry', 'Talicug', 'V', '2019-01-08', '09123456789', 'student', '$2y$10$BwDb.WPL1Rslyumutr55JuFDk3AEDXTST12Mt6Jdu9I7LKCDVXQ1m', 'student', '2019-04-02 06:50:44', '2019-04-02 06:50:44'),
(71, 'Mary Joy', 'Labandiro', 'A', '2019-04-11', '09123678961', 'maria', '$2y$10$cn/5BrazjJQuEiPYGbYYf.ekLeh6b.LYigfJzegCQJAcxu4aJptYu', 'student', '2019-04-02 19:45:47', '2019-04-02 19:45:47'),
(72, 'Ken', 'Gorro', 'L', NULL, NULL, 'ken', '$2y$10$VRMvpgXQO3VwiqYuZo7.8OQytzmFuA1Mf55fZ7obvg/TD0TaJUHua', 'adviser', '2019-04-02 19:48:24', '2019-04-02 19:48:24'),
(73, 'Ariel', 'Amorgiente', 'P', '2019-10-22', '09187621456', 'ariel', '$2y$10$gMsSvYP54BwFPG987L05MeDwfxwkCcWLkYx26da06MAZvtJU/dGU6', 'student', '2019-04-02 21:07:31', '2019-04-02 21:07:31'),
(74, 'Angie', 'Ceniza', 'C', NULL, NULL, 'angie', '$2y$10$5pUaf7AbzEx6IR2oG70bOu5uxg7puoSEzoDiP7vfreeh/XjcjuzAq', 'adviser', '2019-04-02 21:11:43', '2019-04-02 21:11:43'),
(75, 'Archival', 'Sebial', 'S', NULL, NULL, 'archival', '$2y$10$sNCcnr/N4.YRnMLaWbJ6AewX6B43Dr6vCjDcrI6xjptYYEjP6qeWG', 'adviser', '2019-04-02 21:12:22', '2019-04-02 21:12:22'),
(76, 'Godwin', 'Moserate', 'M', NULL, NULL, 'godwin', '$2y$10$I7qrQtoyrqFwbkr1J/pwiO3jhXlNWrrIF3/tYRIlbb28KOLO3sWSS', 'adviser', '2019-04-02 21:12:51', '2019-04-02 21:12:51'),
(77, 'Christian', 'Maderazo', 'm', NULL, NULL, 'christian', '$2y$10$1tkGpLXsJM8ubIcWJWI6gu3u8O5YaUe1eWlpC7wiiz2LlB4ybVzka', 'adviser', '2019-04-02 21:13:15', '2019-04-02 21:13:15'),
(78, 'Stella', 'Broke', 'H', '2019-02-02', '09068660763', 'stella', '$2y$10$VifqVFsYX82rHEJq7pDvH.txblXEsAJVvFwHQhztM4VPGsfROyFnS', 'student', '2019-04-02 22:10:14', '2019-04-02 22:10:14'),
(79, 'Marky', 'Green', 'B', '2019-04-04', '09979346572', 'marky', '$2y$10$joRmTKzD7oWrUcp6acO/y.KvcGmiuEoDElA98iWcdipsjPnho9cLW', 'student', '2019-04-02 22:11:10', '2019-04-02 22:11:10'),
(80, 'Elizabeth', 'Queen', 'K', '2019-06-04', '09765491876', 'elizabeth', '$2y$10$wqBbVbDSr7zrNdQUz62nHO5SzZmRpwG9gda8AyuU2nDsUJcKHennS', 'student', '2019-04-02 22:12:29', '2019-04-02 22:12:29'),
(81, 'Stephen', 'Mars', 'M', '2019-05-27', '09876542718', 'stephen', '$2y$10$dpBeMHUPnYo9mGdHySRYbehPrcfGgcMZ8dcQKbMZxYylbotGDK3xe', 'student', '2019-04-02 22:13:39', '2019-04-02 22:13:39'),
(82, 'Juan', 'Dela Cruz', 'T', '1997-04-03', '09757265167', 'juan', '$2y$10$J32Z4wAodY4Uqnn36ggK3.nuRZ51toQXx5AJPbxbwAf0Qpp27NwWS', 'student', '2019-04-03 00:25:50', '2019-04-03 00:25:50'),
(84, 'Juan', 'Tamad', 'w', '2019-04-02', '09875572881', 'tamad', '$2y$10$uf.7mOChVquMJ4rB.EpR8.p9U82sQ/wtkk4rw8GrA3Ri7b1Ik8ZGK', 'student', '2019-04-03 00:27:27', '2019-04-03 00:27:27'),
(85, 'Angelina', 'July', 'G', '1994-02-01', '09875651787', 'angelina', '$2y$10$U3LfvNdgcbaoDK1fNrleT.yzMrd3RAo8Ls134GrgGJdpPm5WIyBiK', 'student', '2019-04-03 00:28:18', '2019-04-03 00:28:18'),
(86, 'Pit', 'Brad', 'P', '1994-11-21', '09987655461', 'alien', '$2y$10$gSjRl8ANetkK5sSe/aVfFumEeeeTaDoWhrsFT24RsRlIaHAgCAxfG', 'student', '2019-04-03 00:31:10', '2019-04-03 00:31:10'),
(87, 'Ariana', 'Grande', 'V', '1991-06-04', '09726518917', 'ariana', '$2y$10$fYcS9iaCJ/fC2riIeFaTeO4XrtyEUgeeweYnnpELxh60r4ZCG94ZW', 'student', '2019-04-03 00:46:39', '2019-04-03 00:46:39'),
(88, 'Princess', 'Duterte', 'A', '1998-01-29', '09187615718', 'princess', '$2y$10$Mnpyv.2oelKrPtEUgLLg4.r3sMcPsb7WKOA7Tcos78ndiuDY6TAWa', 'student', '2019-04-03 00:47:48', '2019-04-03 00:47:48'),
(89, 'Nikki', 'Caldero', 'T', '2001-11-09', '09876542316', 'nikki', '$2y$10$o6R9kLmqRHQavMhG9jThdOcv7KqKI2WZY9xB2lugDbK9jG4VjL5Mu', 'student', '2019-04-03 00:48:42', '2019-04-03 00:48:42'),
(90, 'Tony', 'Stark', 'O', '1999-05-27', '09862571871', 'tony', '$2y$10$sSB8Rv1YpBWFAR27abBMCOEOjZJg6Fw0qr8rqJjvbU24ztp.UazKy', 'student', '2019-04-03 00:50:09', '2019-04-03 00:50:09'),
(91, 'Mary Joy', 'Labandiro', 'L', NULL, NULL, 'mjlabandiro', '$2y$10$UGLViKe96PxdywOxIFoLSOoEjQNN0kEeBP1M0t5qe5/oouRNlQroi', 'adviser', '2019-04-08 02:30:27', '2019-04-08 02:30:27'),
(92, 'Kenth', 'Ozawa', 'K', NULL, NULL, 'kenth', '$2y$10$WFeKthnFk0uy45yzFwErSO.mltD8r7Z2W/ovGznMphCzY19ECQNZ2', 'adviser', '2019-04-10 02:00:15', '2019-04-10 02:00:15'),
(93, 'Test', 'Tesst', 'E', NULL, NULL, 'Test', '$2y$10$xo7yunNtRx8LKLjpcm9fHu1/I89jOOGxB8bWapuDhgBP0WXRk.FwK', 'adviser', '2019-04-15 03:12:37', '2019-04-15 03:12:37'),
(94, 'Jose', 'Heno', 'L', '1996-04-03', '09876542312', 'jose', '$2y$10$.sFNPRcE3CyV7ZLz6box9ei9Hsn8KYEw4RA/88jG8g3n.uX7CfrfO', 'student', '2019-04-15 05:54:24', '2019-04-15 05:54:24'),
(95, 'Wendy', 'Satinitigan', 'C', '1999-04-08', '09342452332', 'wendysati', '$2y$10$xvCBjgP7YyGzO0K2vZNHDeqXZMD5uNhUrgMmopAz89ckagyANcUDi', 'student', '2019-09-16 23:53:33', '2019-09-16 23:53:33'),
(96, 'Ian', 'Laroga', NULL, '1997-06-11', '09208092073', 'insthlrga', '$2y$10$3pW1JEV2OOoiQ9zIYwn.5.mhu7wJgBleARUp2boGUED6jkmvcgvBy', 'student', '2019-09-17 23:17:42', '2019-09-17 23:17:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `areas_name_unique` (`name`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_adviser_id_foreign` (`adviser_id`),
  ADD KEY `projects_area_id_foreign` (`area_id`);

--
-- Indexes for table `project_authors`
--
ALTER TABLE `project_authors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_authors_author_id_foreign` (`author_id`),
  ADD KEY `project_authors_project_id_foreign` (`project_id`);

--
-- Indexes for table `project_panel`
--
ALTER TABLE `project_panel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_panel_panel_id_foreign` (`panel_id`),
  ADD KEY `project_panel_project_id_foreign` (`project_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `project_authors`
--
ALTER TABLE `project_authors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `project_panel`
--
ALTER TABLE `project_panel`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_adviser_id_foreign` FOREIGN KEY (`adviser_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `projects_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `project_authors`
--
ALTER TABLE `project_authors`
  ADD CONSTRAINT `project_authors_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `project_authors_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `project_panel`
--
ALTER TABLE `project_panel`
  ADD CONSTRAINT `project_panel_panel_id_foreign` FOREIGN KEY (`panel_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `project_panel_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
