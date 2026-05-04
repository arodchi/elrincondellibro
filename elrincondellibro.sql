-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 04-05-2026 a las 15:11:10
-- Versión del servidor: 8.0.44
-- Versión de PHP: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `elrincondellibro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE `actividad` (
  `id_actividad` int NOT NULL,
  `usuario_id` int NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `referencia_id` int DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`id_actividad`, `usuario_id`, `tipo`, `referencia_id`, `fecha`) VALUES
(1, 1, 'lectura_capitulo', 1, '2026-04-30 22:09:06'),
(2, 1, 'lectura_capitulo', 2, '2026-04-30 22:11:14'),
(3, 1, 'lectura_capitulo', 2, '2026-04-30 22:11:16'),
(4, 1, 'lectura_capitulo', 2, '2026-04-30 22:11:17'),
(5, 1, 'lectura_capitulo', 2, '2026-04-30 22:11:19'),
(6, 1, 'lectura_capitulo', 2, '2026-04-30 22:12:16'),
(7, 1, 'lectura_capitulo', 2, '2026-04-30 22:12:23'),
(8, 1, 'lectura_capitulo', 3, '2026-04-30 22:12:29'),
(9, 1, 'lectura_capitulo', 2, '2026-04-30 22:14:40'),
(10, 2, 'lectura_capitulo', 2, '2026-04-30 22:17:57'),
(11, 2, 'lectura_capitulo', 4, '2026-04-30 22:19:22'),
(12, 2, 'lectura_capitulo', 4, '2026-04-30 22:19:49'),
(13, 2, 'lectura_capitulo', 4, '2026-04-30 22:20:09'),
(14, 1, 'lectura_capitulo', 4, '2026-04-30 22:25:47'),
(15, 1, 'lectura_capitulo', 1, '2026-04-30 22:30:54'),
(16, 1, 'lectura_capitulo', 4, '2026-04-30 22:30:57'),
(17, 1, 'lectura_capitulo', 1, '2026-04-30 22:30:59'),
(18, 1, 'lectura_capitulo', 4, '2026-04-30 22:31:03'),
(19, 1, 'lectura_capitulo', 4, '2026-04-30 22:32:11'),
(20, 1, 'lectura_capitulo', 1, '2026-04-30 22:32:14'),
(21, 1, 'lectura_capitulo', 5, '2026-04-30 22:32:22'),
(22, 1, 'lectura_capitulo', 5, '2026-05-01 09:40:14'),
(23, 1, 'lectura_capitulo', 5, '2026-05-01 09:40:19'),
(24, 1, 'lectura_capitulo', 5, '2026-05-01 09:43:02'),
(25, 1, 'lectura_capitulo', 6, '2026-05-01 09:43:04'),
(26, 1, 'lectura_capitulo', 5, '2026-05-01 09:43:10'),
(27, 1, 'lectura_capitulo', 5, '2026-05-01 09:43:53'),
(28, 1, 'lectura_capitulo', 2, '2026-05-01 11:20:08'),
(29, 1, 'lectura_capitulo', 2, '2026-05-01 11:20:10'),
(30, 1, 'lectura_capitulo', 2, '2026-05-01 11:20:11'),
(31, 1, 'lectura_capitulo', 2, '2026-05-01 11:20:12'),
(32, 1, 'lectura_capitulo', 2, '2026-05-01 11:20:13'),
(33, 1, 'lectura_capitulo', 3, '2026-05-01 11:20:17'),
(34, 1, 'lectura_capitulo', 2, '2026-05-01 11:20:21'),
(35, 1, 'lectura_capitulo', 2, '2026-05-01 11:20:26'),
(36, 1, 'lectura_capitulo', 2, '2026-05-01 11:20:31'),
(37, 1, 'lectura_capitulo', 1, '2026-05-01 11:20:37'),
(38, 1, 'lectura_capitulo', 5, '2026-05-01 11:20:39'),
(39, 1, 'lectura_capitulo', 1, '2026-05-01 11:21:17'),
(40, 1, 'lectura_capitulo', 2, '2026-05-01 11:21:40'),
(41, 1, 'lectura_capitulo', 5, '2026-05-01 11:30:13'),
(42, 1, 'lectura_capitulo', 5, '2026-05-01 11:31:45'),
(43, 1, 'lectura_capitulo', 6, '2026-05-01 11:31:48'),
(44, 2, 'lectura_capitulo', 2, '2026-05-01 11:41:04'),
(45, 2, 'lectura_capitulo', 2, '2026-05-01 11:41:08'),
(46, 3, 'lectura_capitulo', 5, '2026-05-01 13:05:38'),
(47, 3, 'lectura_capitulo', 5, '2026-05-01 13:05:43'),
(48, 3, 'lectura_capitulo', 5, '2026-05-01 13:05:47'),
(49, 3, 'lectura_capitulo', 6, '2026-05-01 13:07:38'),
(50, 3, 'lectura_capitulo', 1, '2026-05-01 13:18:53'),
(51, 3, 'lectura_capitulo', 1, '2026-05-01 13:24:38'),
(52, 3, 'lectura_capitulo', 2, '2026-05-01 13:24:44'),
(53, 3, 'lectura_capitulo', 2, '2026-05-01 13:25:16'),
(54, 2, 'lectura_capitulo', 2, '2026-05-01 13:32:55'),
(55, 2, 'lectura_capitulo', 7, '2026-05-01 13:47:55'),
(56, 2, 'lectura_capitulo', 6, '2026-05-01 13:48:01'),
(57, 2, 'lectura_capitulo', 5, '2026-05-01 13:48:09'),
(58, 2, 'lectura_capitulo', 5, '2026-05-01 13:58:50'),
(59, 2, 'lectura_capitulo', 2, '2026-05-01 13:58:53'),
(60, 2, 'lectura_capitulo', 2, '2026-05-01 14:01:10'),
(61, 2, 'lectura_capitulo', 2, '2026-05-01 14:01:37'),
(62, 2, 'lectura_capitulo', 5, '2026-05-01 14:02:53'),
(63, 2, 'lectura_capitulo', 6, '2026-05-01 14:02:57'),
(64, 2, 'lectura_capitulo', 5, '2026-05-01 14:02:59'),
(65, 2, 'lectura_capitulo', 5, '2026-05-01 14:16:03'),
(66, 2, 'lectura_capitulo', 6, '2026-05-01 14:16:06'),
(67, 2, 'lectura_capitulo', 5, '2026-05-01 14:16:08'),
(68, 2, 'lectura_capitulo', 5, '2026-05-01 14:16:12'),
(69, 4, 'lectura_capitulo', 2, '2026-05-01 14:23:38'),
(70, 4, 'lectura_capitulo', 3, '2026-05-01 14:23:47'),
(71, 4, 'lectura_capitulo', 5, '2026-05-01 14:23:55'),
(72, 4, 'lectura_capitulo', 5, '2026-05-01 14:24:02'),
(73, 1, 'lectura_capitulo', 9, '2026-05-01 14:41:39'),
(74, 1, 'lectura_capitulo', 9, '2026-05-01 14:41:42'),
(75, 1, 'lectura_capitulo', 5, '2026-05-01 14:50:18'),
(76, 1, 'lectura_capitulo', 9, '2026-05-01 15:07:45'),
(77, 1, 'lectura_capitulo', 8, '2026-05-01 15:07:57'),
(78, 1, 'lectura_capitulo', 8, '2026-05-01 15:08:24'),
(79, 1, 'lectura_capitulo', 8, '2026-05-01 15:08:31'),
(80, 4, 'lectura_capitulo', 8, '2026-05-01 15:09:01'),
(81, 1, 'lectura_capitulo', 5, '2026-05-01 15:10:00'),
(82, 1, 'lectura_capitulo', 4, '2026-05-01 15:33:55'),
(83, 1, 'lectura_capitulo', 1, '2026-05-01 15:44:14'),
(84, 1, 'lectura_capitulo', 2, '2026-05-01 15:44:26'),
(85, 1, 'lectura_capitulo', 2, '2026-05-01 15:44:58'),
(86, 1, 'lectura_capitulo', 8, '2026-05-01 15:48:39'),
(87, 1, 'lectura_capitulo', 8, '2026-05-01 15:48:46'),
(88, 1, 'lectura_capitulo', 8, '2026-05-01 15:53:24'),
(89, 1, 'lectura_capitulo', 8, '2026-05-01 15:53:29'),
(90, 1, 'lectura_capitulo', 8, '2026-05-01 15:53:43'),
(91, 1, 'lectura_capitulo', 8, '2026-05-01 15:53:49'),
(92, 1, 'lectura_capitulo', 8, '2026-05-01 15:53:52'),
(93, 1, 'lectura_capitulo', 5, '2026-05-01 15:57:02'),
(94, 1, 'lectura_capitulo', 2, '2026-05-01 16:10:48'),
(95, 1, 'lectura_capitulo', 2, '2026-05-01 16:11:01'),
(96, 1, 'lectura_capitulo', 2, '2026-05-01 16:17:40'),
(97, 1, 'lectura_capitulo', 2, '2026-05-01 16:17:40'),
(98, 1, 'lectura_capitulo', 2, '2026-05-01 16:17:41'),
(99, 1, 'lectura_capitulo', 2, '2026-05-01 16:48:26'),
(100, 1, 'lectura_capitulo', 2, '2026-05-01 16:48:32'),
(101, 1, 'lectura_capitulo', 2, '2026-05-01 16:48:36'),
(102, 1, 'lectura_capitulo', 2, '2026-05-01 16:48:39'),
(103, 1, 'lectura_capitulo', 5, '2026-05-01 16:55:49'),
(104, 1, 'lectura_capitulo', 6, '2026-05-01 16:55:52'),
(105, 1, 'lectura_capitulo', 2, '2026-05-01 16:55:57'),
(106, 1, 'lectura_capitulo', 5, '2026-05-01 16:56:12'),
(107, 1, 'lectura_capitulo', 6, '2026-05-01 16:56:15'),
(108, 1, 'lectura_capitulo', 1, '2026-05-01 16:56:22'),
(109, 1, 'lectura_capitulo', 4, '2026-05-01 16:56:24'),
(110, 1, 'lectura_capitulo', 4, '2026-05-01 16:56:33'),
(111, 1, 'lectura_capitulo', 2, '2026-05-01 17:22:06'),
(112, 1, 'lectura_capitulo', 1, '2026-05-01 17:30:19'),
(113, 1, 'lectura_capitulo', 1, '2026-05-01 17:30:24'),
(114, 1, 'lectura_capitulo', 1, '2026-05-01 17:32:23'),
(115, 1, 'lectura_capitulo', 8, '2026-05-01 17:32:28'),
(116, 1, 'lectura_capitulo', 1, '2026-05-01 17:37:11'),
(117, 1, 'lectura_capitulo', 4, '2026-05-01 17:37:17'),
(118, 1, 'lectura_capitulo', 7, '2026-05-01 17:37:31'),
(119, 1, 'lectura_capitulo', 4, '2026-05-01 17:37:34'),
(120, 1, 'lectura_capitulo', 1, '2026-05-01 17:37:36'),
(121, 1, 'lectura_capitulo', 1, '2026-05-01 17:38:09'),
(122, 1, 'lectura_capitulo', 1, '2026-05-01 17:38:13'),
(123, 1, 'lectura_capitulo', 1, '2026-05-01 17:38:32'),
(124, 1, 'lectura_capitulo', 2, '2026-05-01 17:41:52'),
(125, 1, 'lectura_capitulo', 2, '2026-05-01 17:41:56'),
(126, 1, 'lectura_capitulo', 1, '2026-05-01 17:42:04'),
(127, 1, 'lectura_capitulo', 8, '2026-05-01 17:44:25'),
(128, 1, 'lectura_capitulo', 9, '2026-05-01 17:44:35'),
(129, 1, 'lectura_capitulo', 9, '2026-05-01 17:45:51'),
(130, 1, 'lectura_capitulo', 2, '2026-05-01 17:45:59'),
(131, 1, 'lectura_capitulo', 1, '2026-05-01 17:47:20'),
(132, 1, 'lectura_capitulo', 9, '2026-05-01 17:47:23'),
(133, 1, 'lectura_capitulo', 2, '2026-05-01 17:47:27'),
(134, 1, 'lectura_capitulo', 3, '2026-05-01 17:47:33'),
(135, 1, 'lectura_capitulo', 8, '2026-05-01 17:47:56'),
(136, 1, 'lectura_capitulo', 5, '2026-05-01 17:48:03'),
(137, 1, 'lectura_capitulo', 5, '2026-05-01 17:48:04'),
(138, 1, 'lectura_capitulo', 5, '2026-05-01 17:48:55'),
(139, 1, 'lectura_capitulo', 2, '2026-05-01 17:49:07'),
(140, 1, 'lectura_capitulo', 2, '2026-05-01 17:49:18'),
(141, 1, 'lectura_capitulo', 9, '2026-05-01 17:49:39'),
(142, 1, 'lectura_capitulo', 9, '2026-05-01 17:49:41'),
(143, 1, 'lectura_capitulo', 9, '2026-05-01 17:49:42'),
(144, 1, 'lectura_capitulo', 9, '2026-05-01 17:49:42'),
(145, 1, 'lectura_capitulo', 9, '2026-05-01 17:49:42'),
(146, 1, 'lectura_capitulo', 9, '2026-05-01 17:49:43'),
(147, 1, 'lectura_capitulo', 9, '2026-05-01 17:54:25'),
(148, 1, 'lectura_capitulo', 9, '2026-05-01 17:54:27'),
(149, 1, 'lectura_capitulo', 9, '2026-05-01 17:54:29'),
(150, 1, 'lectura_capitulo', 9, '2026-05-01 17:54:30'),
(151, 1, 'lectura_capitulo', 9, '2026-05-01 17:54:31'),
(152, 1, 'lectura_capitulo', 9, '2026-05-01 17:54:34'),
(153, 1, 'lectura_capitulo', 5, '2026-05-01 17:54:45'),
(154, 1, 'lectura_capitulo', 2, '2026-05-01 17:55:59'),
(155, 1, 'lectura_capitulo', 2, '2026-05-01 17:56:03'),
(156, 1, 'lectura_capitulo', 2, '2026-05-01 17:56:28'),
(157, 1, 'lectura_capitulo', 2, '2026-05-01 17:56:33'),
(158, 1, 'lectura_capitulo', 2, '2026-05-01 17:57:13'),
(159, 1, 'lectura_capitulo', 2, '2026-05-01 17:57:24'),
(160, 1, 'lectura_capitulo', 2, '2026-05-01 17:57:57'),
(161, 4, 'lectura_capitulo', 9, '2026-05-01 18:01:44'),
(162, 4, 'lectura_capitulo', 8, '2026-05-01 18:02:13'),
(163, 4, 'lectura_capitulo', 10, '2026-05-01 18:08:12'),
(164, 4, 'lectura_capitulo', 10, '2026-05-01 18:08:41'),
(165, 4, 'lectura_capitulo', 10, '2026-05-01 18:08:44'),
(166, 4, 'lectura_capitulo', 10, '2026-05-01 18:08:45'),
(167, 4, 'lectura_capitulo', 10, '2026-05-01 18:08:51'),
(168, 4, 'lectura_capitulo', 10, '2026-05-01 18:10:19'),
(169, 4, 'lectura_capitulo', 8, '2026-05-01 18:10:27'),
(170, 4, 'lectura_capitulo', 9, '2026-05-01 18:10:32'),
(171, 4, 'lectura_capitulo', 10, '2026-05-01 18:10:45'),
(172, 4, 'lectura_capitulo', 10, '2026-05-01 18:13:46'),
(173, 4, 'lectura_capitulo', 11, '2026-05-01 18:13:53'),
(174, 1, 'lectura_capitulo', 10, '2026-05-01 18:14:27'),
(175, 1, 'lectura_capitulo', 10, '2026-05-01 18:14:33'),
(176, 1, 'lectura_capitulo', 11, '2026-05-01 18:14:53'),
(177, 1, 'lectura_capitulo', 10, '2026-05-01 18:14:59'),
(178, 1, 'lectura_capitulo', 10, '2026-05-01 18:15:03'),
(179, 1, 'lectura_capitulo', 10, '2026-05-01 18:15:07'),
(180, 1, 'lectura_capitulo', 2, '2026-05-01 18:16:09'),
(181, 1, 'lectura_capitulo', 1, '2026-05-01 18:17:53'),
(182, 1, 'lectura_capitulo', 2, '2026-05-01 18:34:45'),
(183, 1, 'lectura_capitulo', 10, '2026-05-01 18:36:14'),
(184, 1, 'lectura_capitulo', 2, '2026-05-01 18:37:57'),
(185, 1, 'lectura_capitulo', 10, '2026-05-01 18:47:06'),
(186, 1, 'lectura_capitulo', 10, '2026-05-01 18:47:16'),
(187, 1, 'lectura_capitulo', 10, '2026-05-01 18:47:57'),
(188, 1, 'lectura_capitulo', 10, '2026-05-01 18:48:03'),
(189, 1, 'lectura_capitulo', 8, '2026-05-01 18:52:50'),
(190, 1, 'lectura_capitulo', 10, '2026-05-01 18:52:54'),
(191, 1, 'lectura_capitulo', 10, '2026-05-01 18:53:07'),
(192, 1, 'lectura_capitulo', 10, '2026-05-01 18:53:13'),
(193, 1, 'lectura_capitulo', 10, '2026-05-01 18:53:17'),
(194, 1, 'lectura_capitulo', 10, '2026-05-01 18:53:20'),
(195, 1, 'lectura_capitulo', 10, '2026-05-01 18:53:27'),
(196, 1, 'lectura_capitulo', 5, '2026-05-01 18:54:06'),
(197, 1, 'lectura_capitulo', 4, '2026-05-01 18:54:28'),
(198, 1, 'lectura_capitulo', 2, '2026-05-01 18:56:42'),
(199, 1, 'lectura_capitulo', 2, '2026-05-01 18:56:45'),
(200, 1, 'lectura_capitulo', 2, '2026-05-01 18:56:50'),
(201, 1, 'lectura_capitulo', 2, '2026-05-01 18:56:59'),
(202, 1, 'lectura_capitulo', 2, '2026-05-01 18:57:02'),
(203, 1, 'lectura_capitulo', 1, '2026-05-01 18:57:09'),
(204, 1, 'lectura_capitulo', 1, '2026-05-01 18:57:17'),
(205, 1, 'lectura_capitulo', 1, '2026-05-01 18:57:20'),
(206, 1, 'lectura_capitulo', 1, '2026-05-01 18:57:22'),
(207, 1, 'lectura_capitulo', 10, '2026-05-01 18:57:42'),
(208, 1, 'lectura_capitulo', 2, '2026-05-01 19:05:19'),
(209, 1, 'lectura_capitulo', 2, '2026-05-01 19:05:21'),
(210, 1, 'lectura_capitulo', 2, '2026-05-01 19:05:22'),
(211, 1, 'lectura_capitulo', 2, '2026-05-01 19:05:23'),
(212, 1, 'lectura_capitulo', 2, '2026-05-01 19:05:24'),
(213, 1, 'lectura_capitulo', 2, '2026-05-01 19:05:29'),
(214, 1, 'lectura_capitulo', 2, '2026-05-01 19:05:34'),
(215, 1, 'lectura_capitulo', 2, '2026-05-01 19:06:02'),
(216, 1, 'lectura_capitulo', 2, '2026-05-01 19:06:21'),
(217, 1, 'lectura_capitulo', 2, '2026-05-01 19:06:32'),
(218, 1, 'lectura_capitulo', 10, '2026-05-01 19:07:41'),
(219, 1, 'lectura_capitulo', 11, '2026-05-01 19:12:32'),
(220, 1, 'lectura_capitulo', 10, '2026-05-01 19:13:27'),
(221, 1, 'lectura_capitulo', 10, '2026-05-01 19:13:32'),
(222, 2, 'lectura_capitulo', 2, '2026-05-01 19:48:58'),
(223, 2, 'lectura_capitulo', 2, '2026-05-01 19:49:01'),
(224, 2, 'lectura_capitulo', 2, '2026-05-01 19:49:04'),
(225, 2, 'lectura_capitulo', 2, '2026-05-01 19:49:07'),
(226, 4, 'lectura_capitulo', 1, '2026-05-01 20:17:27'),
(227, 4, 'lectura_capitulo', 1, '2026-05-01 20:17:29'),
(228, 4, 'lectura_capitulo', 1, '2026-05-01 20:17:30'),
(229, 1, 'lectura_capitulo', 1, '2026-05-01 20:17:59'),
(230, 1, 'lectura_capitulo', 2, '2026-05-02 14:37:02'),
(231, 1, 'lectura_capitulo', 6, '2026-05-02 14:37:32'),
(232, 1, 'lectura_capitulo', 10, '2026-05-02 14:37:54'),
(233, 1, 'lectura_capitulo', 10, '2026-05-02 14:38:17'),
(234, 1, 'lectura_capitulo', 10, '2026-05-02 14:38:26'),
(235, 1, 'lectura_capitulo', 2, '2026-05-02 16:00:39'),
(236, 1, 'lectura_capitulo', 10, '2026-05-02 16:17:55'),
(237, 1, 'lectura_capitulo', 10, '2026-05-02 16:18:20'),
(238, 1, 'lectura_capitulo', 6, '2026-05-02 21:31:38'),
(239, 1, 'lectura_capitulo', 5, '2026-05-02 21:31:40'),
(240, 1, 'lectura_capitulo', 1, '2026-05-02 21:32:00'),
(241, 1, 'lectura_capitulo', 1, '2026-05-02 21:35:29'),
(242, 1, 'lectura_capitulo', 10, '2026-05-02 21:35:34'),
(243, 1, 'lectura_capitulo', 10, '2026-05-02 21:36:26'),
(244, 1, 'lectura_capitulo', 5, '2026-05-03 17:32:15'),
(245, 1, 'lectura_capitulo', 2, '2026-05-03 17:32:50'),
(246, 1, 'lectura_capitulo', 2, '2026-05-03 17:33:38'),
(247, 1, 'lectura_capitulo', 9, '2026-05-03 17:38:29'),
(248, 2, 'lectura_capitulo', 12, '2026-05-04 13:56:53'),
(249, 2, 'lectura_capitulo', 12, '2026-05-04 14:04:03'),
(250, 2, 'lectura_capitulo', 12, '2026-05-04 14:04:12'),
(251, 1, 'lectura_capitulo', 12, '2026-05-04 14:04:50'),
(252, 1, 'lectura_capitulo', 12, '2026-05-04 14:04:54'),
(253, 1, 'lectura_capitulo', 12, '2026-05-04 14:06:58'),
(254, 4, 'lectura_capitulo', 12, '2026-05-04 14:07:23'),
(255, 4, 'lectura_capitulo', 12, '2026-05-04 14:07:29'),
(256, 4, 'lectura_capitulo', 12, '2026-05-04 14:07:44'),
(257, 4, 'lectura_capitulo', 12, '2026-05-04 14:07:57'),
(258, 4, 'lectura_capitulo', 12, '2026-05-04 14:08:01'),
(259, 4, 'lectura_capitulo', 12, '2026-05-04 14:08:10'),
(260, 4, 'lectura_capitulo', 12, '2026-05-04 14:08:15'),
(261, 4, 'lectura_capitulo', 12, '2026-05-04 14:09:09'),
(262, 4, 'lectura_capitulo', 12, '2026-05-04 14:09:14'),
(263, 4, 'lectura_capitulo', 12, '2026-05-04 14:09:17'),
(264, 4, 'lectura_capitulo', 12, '2026-05-04 14:09:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

CREATE TABLE `archivos` (
  `id_archivos` int NOT NULL,
  `libro_id` int DEFAULT NULL,
  `capitulo_id` int DEFAULT NULL,
  `ruta` varchar(255) NOT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `fecha_subida` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `archivos`
--

INSERT INTO `archivos` (`id_archivos`, `libro_id`, `capitulo_id`, `ruta`, `tipo`, `descripcion`, `fecha_subida`) VALUES
(1, NULL, 4, 'img/uploads/capitulos/chapter_69f3d42d226682.92582414.jpg', 'capitulo_imagen', 'Imagen del capítulo', '2026-04-30 22:14:05'),
(2, NULL, 8, 'img/uploads/capitulos/chapter_69f4b98ec15d91.55447939.jpeg', 'capitulo_imagen', 'Imagen del capítulo', '2026-05-01 14:32:46'),
(3, NULL, 10, 'img/uploads/capitulos/chapter_69f4ebf94e32d4.98871763.jpg', 'capitulo_imagen', 'portada', '2026-05-01 18:07:53'),
(4, NULL, 11, 'img/uploads/capitulos/chapter_69f4ed52b8c709.99037538.jpg', 'capitulo_imagen', 'medio', '2026-05-01 18:13:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bloqueos`
--

CREATE TABLE `bloqueos` (
  `id_bloqueo` int NOT NULL,
  `usuario_id` int NOT NULL,
  `bloqueado_id` int NOT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `bloqueos`
--

INSERT INTO `bloqueos` (`id_bloqueo`, `usuario_id`, `bloqueado_id`, `fecha`) VALUES
(13, 1, 3, '2026-05-03 17:45:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capitulos`
--

CREATE TABLE `capitulos` (
  `id_capitulos` int NOT NULL,
  `libro_id` int NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `contenido` text NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `capitulos`
--

INSERT INTO `capitulos` (`id_capitulos`, `libro_id`, `titulo`, `contenido`, `fecha_creacion`) VALUES
(1, 2, 'Capitulo uno', 'Prueba de libro gratuito', '2026-04-30 22:08:59'),
(2, 3, 'Capítulo 1: El secreto del reloj antiguo', 'Capítulo 1: El secreto del reloj antiguo\r\n\r\nCuando Daniel llegó a casa de su abuelo en el pequeño pueblo de Valdemora, pensó que serían las vacaciones más aburridas de su vida. No había centros comerciales, ni videojuegos rápidos, ni siquiera buena señal de internet. Solo calles empedradas, casas antiguas y un silencio extraño que llenaba cada rincón.\r\n\r\nSu abuelo Ernesto vivía en una enorme casa de madera al final de la colina. Dentro olía a libros viejos y a café recién hecho. Las paredes estaban cubiertas de cuadros antiguos y relojes de todos los tamaños.\r\n\r\n—Cada reloj tiene una historia —decía siempre el abuelo.\r\n\r\nLa primera noche, Daniel no podía dormir. Escuchaba el tic-tac de decenas de relojes sonando al mismo tiempo. Bajó las escaleras en silencio y llegó al salón principal. Allí vio algo raro: uno de los relojes brillaba con una luz azulada.\r\n\r\nSe acercó lentamente. Era un reloj de bolsillo dorado, cubierto de símbolos extraños. Al tocarlo, la tapa se abrió sola y las agujas comenzaron a girar hacia atrás.\r\n\r\nDe repente, el suelo tembló.\r\n\r\nUna puerta apareció en la pared donde antes solo había una estantería. Daniel retrocedió asustado, pero la curiosidad pudo más que el miedo.\r\n\r\nAbrió la puerta con cuidado.\r\n\r\nAl otro lado no había otra habitación.\r\n\r\nHabía una ciudad inmensa iluminada por miles de estrellas, aunque era de día.\r\n\r\nDaniel respiró hondo.\r\n\r\nAcababa de descubrir un secreto que cambiaría su vida para siempre.', '2026-04-30 22:10:21'),
(3, 3, 'Capítulo 2: La plaza de los susurros', 'Daniel cruzó la puerta con el corazón latiendo tan fuerte que pensó que todos podrían escucharlo. Al otro lado, el aire era diferente: más fresco, más ligero, como si cada respiración estuviera llena de energía.\r\n\r\nLa ciudad era enorme. Las calles estaban hechas de piedra plateada y las farolas brillaban sin fuego ni electricidad. Sobre los tejados flotaban pequeñas luces que parecían luciérnagas. Personas vestidas con capas largas caminaban deprisa, mirando a Daniel con sorpresa.\r\n\r\n—No puede ser… un viajero del tiempo —susurró una mujer al verlo.\r\n\r\nDaniel quiso preguntar dónde estaba, pero nadie se detenía. Entonces escuchó una voz detrás de él.\r\n\r\n—Si quieres seguir vivo, será mejor que me acompañes.\r\n\r\nSe giró rápidamente. Frente a él había una chica de su edad, con el pelo oscuro recogido en una trenza y unos ojos grises muy intensos.\r\n\r\n—¿Quién eres? —preguntó Daniel.\r\n\r\n—Me llamo Lía. Y tú acabas de llegar en el peor momento posible.\r\n\r\nSin esperar respuesta, lo agarró del brazo y lo llevó corriendo por callejones estrechos hasta llegar a una gran plaza circular. En el centro había una fuente de cristal que emitía sonidos parecidos a voces lejanas.\r\n\r\n—¿Qué lugar es este? —preguntó Daniel, todavía confundido.\r\n\r\n—La Plaza de los Susurros —respondió Lía—. Aquí la ciudad guarda sus secretos.\r\n\r\nDaniel se acercó a la fuente. Al tocar el agua, escuchó claramente una voz conocida.\r\n\r\n—Daniel… no confíes en nadie…\r\n\r\nEra la voz de su abuelo.\r\n\r\nRetrocedió sobresaltado.\r\n\r\n—¿Cómo puede estar hablando mi abuelo desde una fuente?\r\n\r\nLía lo miró con seriedad.\r\n\r\n—Porque tu abuelo estuvo aquí… y desapareció hace veinte años.\r\n\r\nDaniel sintió que el suelo volvía a moverse bajo sus pies.\r\n\r\nLas vacaciones aburridas acababan de convertirse en una misión imposible.', '2026-04-30 22:10:38'),
(4, 2, 'Capitulo de prueba de pago', 'Este es una prueba de un libro para que sea pagado', '2026-04-30 22:14:05'),
(5, 4, 'Capitulo de prueba de pago', 'Prueba de pago correcta\r\n\r\n\r\n\r\nHa qye comprobar que se vea todo el contenido de los libros, y todos los capítulos que existan en este libro', '2026-04-30 22:31:59'),
(6, 4, 'Capitulo dos', 'Este es el capitulo dos de esta maravillosa historia donde se está comprobando varias cosas. \r\nQue se pueda leer, escribir, que sea de pago, y todo eso Y que se puedan insertar las imágenes dentro de la historia', '2026-05-01 09:42:55'),
(7, 2, 'Capitulo dos', 'se pueden publicar libros?', '2026-05-01 10:44:39'),
(8, 6, 'Cuak 1', 'Cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak cuak', '2026-05-01 14:32:46'),
(9, 5, 'Capítulo 1: El Gran Salto de la Charca', 'La niebla matutina se aferraba a la superficie de la Charca de los Sauces como una manta de algodón descuidada. Para la mayoría de los habitantes del parque, era una mañana de martes cualquiera, pero para los Pérez-Cuaq, era el día del juicio final. O, al menos, el día de aprender a nadar en formación.\r\n\r\nPapá Claudio, un ánade real de cuello verde iridiscente y un sentido del orden algo excesivo, caminaba de un lado a otro sobre el barro fresco.\r\n—¡Disciplina, plumas y determinación! —exclamó, agitando un ala hacia el horizonte—. Hoy no somos simples patos, hoy somos una unidad de élite.\r\n\r\nMamá Berta, por el contrario, estaba más ocupada intentando quitarle un trozo de alga pegajosa de la frente a Pipo, el más pequeño de los cinco hermanos.\r\n—Claudio, por favor, solo vamos al otro lado a comer migas de pan integral —suspiró Berta con una sonrisa paciente—. No vamos a conquistar el Atlántico.\r\n\r\nLa Alineación\r\nLos cinco hermanos formaban una fila que, siendo generosos, parecía un zigzag ebrio:\r\n\r\nLuna: La mayor. Ya practicaba su \"mirada de superioridad\" y se negaba a mojarse las plumas de la cola si el agua estaba demasiado fría.\r\n\r\nRoco: Un patito robusto que creía que cualquier problema se solucionaba embistiendo cosas con el pico.\r\n\r\nSanti y Sara: Los gemelos inseparables que se comunicaban en un lenguaje de graznidos ultra-rápidos que nadie más entendía.\r\n\r\nPipo: El último de la fila, cuyos pies parecían ser dos tallas más grandes de lo que su equilibrio permitía.\r\n\r\nEl Desafío del Tronco\r\nEl primer obstáculo del día era el Viejo Tronco Musgoso. Para un humano, era un pedazo de madera podrida; para un patito de tres semanas, era el Everest.\r\n\r\n—¡En formación de flecha! —ordenó Claudio, lanzándose al agua con un elegante plof.\r\n\r\nBerta lo siguió con la gracia de una bailarina, esperando al otro lado. Luna cruzó con un salto digno de una pasarela. Roco simplemente se lanzó de cabeza, salpicando a todos. Los gemelos cruzaron como un solo ser, sincronizados perfectamente.\r\n\r\nY entonces llegó el turno de Pipo.\r\n\r\nPipo miró el agua. Miró a su familia. Sus pequeñas patas naranjas temblaron sobre la corteza resbaladiza. Justo cuando iba a dar el salto, una mariposa azul pasó volando frente a su pico.\r\n—¡Oh, una amiga! —graznó emocionado.\r\n\r\nEl resultado fue inevitable. Pipo perdió el equilibrio, rebotó contra el tronco, hizo una voltereta accidental en el aire y aterrizó de espaldas con un sonido parecido al de una esponja mojada cayendo al suelo.\r\n\r\nEl Rescate\r\nHubo un silencio tenso. Claudio cerró los ojos, murmurando algo sobre la \"dignidad de la especie\". Pero antes de que nadie pudiera reaccionar, Pipo emergió a la superficie, con una hoja de nenúfar sobre la cabeza como si fuera un sombrero elegante.\r\n\r\n—¡Otra vez! —gritó Pipo, batiendo sus alitas con entusiasmo—. ¡Ha sido como volar, pero hacia abajo!\r\n\r\nBerta soltó una carcajada y nadó hacia él para empujarlo suavemente hacia el grupo.\r\n—Ves, Claudio —dijo ella, guiñándole un ojo a su marido—, tal vez no tengamos disciplina, pero nos sobra estilo.\r\n\r\nBajo el sol que empezaba a calentar el agua, la familia Pérez-Cuaq continuó su camino. No iban en línea recta, ni hacían silencio, y definitivamente no parecían una unidad de élite, pero mientras nadaban juntos, la Charca de los Sauces parecía el mejor lugar del mundo para ser un pato.', '2026-05-01 14:38:42'),
(10, 7, 'Capítulo 1: El estanque de las plumas rebeldes', 'El sol apenas empezaba a calentar el agua de la Laguna del Sauce Llorón, pero para Pipo, el día ya llevaba horas en marcha. Pipo no era el pato más grande de la camada, ni el que tenía el graznido más potente, pero definitivamente era el que tenía las patas más inquietas.\r\n\r\nMientras sus cinco hermanos formaban una fila perfecta detrás de Mamá Pata, siguiendo el ritmo del cuac-cuac reglamentario, Pipo solía quedarse rezagado. No por cansancio, sino por curiosidad.\r\n\r\nUn pequeño soñador con plumas\r\nPipo tenía una mancha de color café justo sobre el ojo izquierdo que le daba un aire de constante asombro. Sus características principales eran claras:\r\n\r\nCuriosidad insaciable: Podía pasar diez minutos observando el rastro de una libélula mientras el resto de la familia buscaba larvas.\r\n\r\nOptimismo ciego: Pipo creía que cada arbusto nuevo escondía un tesoro o un amigo potencial.\r\n\r\nUn poco de despiste: A veces olvidaba que, en el agua, si dejas de pedalear, la corriente decide tu camino por ti.\r\n\r\nLa dinámica familiar\r\nLa vida en la laguna era segura y predecible. Papá Pato, un ejemplar de cuello verde brillante y pecho inflado, se encargaba de vigilar que ninguna sombra extraña cruzara el cielo.\r\n—\"¡Mantengan el pico cerca del agua y los ojos en mi cola!\"— solía decir con voz grave.\r\n\r\nSus hermanos eran como copias exactas unos de otros: obedientes, rápidos y siempre alertas. Pipo, en cambio, se sentía como un verso suelto en un poema muy bien estructurado. Aquella mañana, la familia se dirigía hacia las \"Islas de Junco\", el lugar donde crecía el musgo más tierno del pantano.\r\n\r\nEl presagio\r\nMientras nadaban, Pipo vio algo que le llamó la atención: una pluma de color azul eléctrico flotando cerca de la orilla prohibida. Era un color que nunca había visto en su familia de tonos grises y marrones.\r\n\r\n—\"¡Pipo, no te separes!\"— graznó Mamá Pata, sin girarse, pero con ese instinto maternal que detectaba cualquier cambio en la formación.\r\n\r\n—\"¡Ya voy, mamá!\"— respondió él, dando tres coletazos rápidos para recuperar su posición.\r\n\r\nPipo regresó a la fila, pero su mente se quedó atrás, atrapada en aquel destello azul. El agua estaba tranquila, el sol brillaba y él estaba rodeado de los suyos. Todo parecía perfecto, pero en el fondo de su pequeño corazón de pato, Pipo sentía que el mundo era mucho más grande que aquella laguna... y esa curiosidad sería, muy pronto, su mayor desafío.', '2026-05-01 18:07:53'),
(11, 7, 'Capítulo 2: La danza de los juncos y el silencio', 'El sol de la tarde teñía el agua de un naranja brillante, convirtiendo la laguna en un espejo de fuego. La familia de Pipo avanzaba en una línea perfecta, como pequeños barquitos de plumas grises. Mamá Pata marcaba el ritmo con un cuac rítmico, y Pipo, como siempre, cerraba la fila.\r\n\r\nPero entonces, algo cambió.\r\n\r\nEl destello plateado\r\nBajo la superficie, justo al borde de un banco de algas, Pipo vio un destello. No era la pluma azul de antes, sino algo vivo. Un pequeño pez plateado saltaba y se sumergía, creando ondas que parecían invitarlo a jugar.\r\n\r\nEl primer error: Pipo pensó que solo se alejaría un par de metros.\r\n\r\nLa distracción: El pez era rápido, zigzagueando entre los tallos de los juncos.\r\n\r\nEl olvido: En la emoción de la caza, Pipo dejó de escuchar el cuac-cuac de su madre.\r\n\r\nEl laberinto verde\r\nSin darse cuenta, Pipo entró en la zona de los Juncos Altos. Allí, las plantas crecían tan juntas que formaban paredes verdes que llegaban hasta el cielo. El agua aquí estaba más fría y el aire olía a barro viejo.\r\n\r\nDe repente, el pez plateado dio un último coletazo y desapareció en las profundidades. Pipo se detuvo, con el corazón latiéndole rápido contra el pecho. Por primera vez en el día, el silencio era absoluto.\r\n\r\n—\"¿Mamá?\"— graznó Pipo con timidez.\r\n\r\nNo hubo respuesta. Solo el susurro del viento moviendo las puntas de los juncos.\r\n\r\nLa bruma del crepúsculo\r\nPipo intentó girar para volver por donde había venido, pero el laberinto de plantas era idéntico en todas direcciones. Para empeorar las cosas, una niebla blanca y espesa comenzó a bajar sobre la laguna, borrando el horizonte.\r\n\r\nHacia el norte: Solo había más juncos.\r\n\r\nHacia el sur: El agua se volvía más profunda y oscura.\r\n\r\nHacia el cielo: Las nubes grises ocultaban las estrellas que Papá Pato usaba para guiarse.\r\n\r\nPipo nadó en círculos, cada vez más rápido, sintiendo que sus patas se cansaban. Llamó a sus hermanos, llamó a su padre, pero sus voces se habían esfumado. Estaba solo, y la noche, fría y desconocida, acababa de empezar.', '2026-05-01 18:13:38'),
(12, 8, 'El vínculo', 'El día había sido largo para Kael. Demasiado largo. Caminaba por la ciudad con la sensación de que cada mirada era un juicio, cada paso un recordatorio de que ya no encajaba en ningún sitio. Desde que “aquello” había ocurrido, nada era igual.\r\n\r\nY entonces, la voz volvió a sonar dentro de su cabeza.\r\n\r\nUna voz profunda.\r\nVibrante.\r\nNo humana.\r\n\r\n—Si todo el mundo estuviera en tu contra… —susurró— yo estaría en contra del mundo solo para protegerte a ti.\r\n\r\nKael se detuvo en seco.\r\nNo sabía si esa frase lo tranquilizaba o lo asustaba más.\r\n\r\n—Nox, no digas cosas así —murmuró, mirando al suelo.\r\n\r\n—¿Por qué no? —respondió la voz, ahora más firme—. Ellos no te entienden. No te escuchan. Yo sí. Yo estoy contigo.\r\n\r\nKael apretó los puños. Desde que aquel ser había entrado en su cuerpo, su vida era un caos. Pero también… por primera vez, no se sentía completamente solo.\r\n\r\n—No necesito que me protejas —dijo, aunque ni él mismo se lo creía.\r\n\r\nNox rió, un sonido grave que resonó en su pecho.\r\n\r\n—No es cuestión de necesidad. Es cuestión de elección. Y yo te elijo a ti, Kael.\r\n\r\nEl joven levantó la mirada.\r\nEl mundo seguía siendo hostil, frío, lleno de sombras.\r\nPero dentro de él… había algo dispuesto a enfrentarlo todo.\r\n\r\nY aunque no lo admitiría en voz alta, esa idea le dio fuerzas para seguir caminando.', '2026-05-04 13:54:28'),
(13, 8, 'El Despertar de Nox', 'Kael no había dormido bien desde que Nox llegó a su vida.\r\nEsa noche no fue diferente.\r\n\r\nSe despertó sobresaltado, empapado en sudor, con la sensación de que algo lo observaba desde dentro. No era miedo… era una presencia. Una conciencia que respiraba con él.\r\n\r\n—Estás inquieto —murmuró Nox desde lo profundo de su mente—. Tu cuerpo se adapta. Es normal.\r\n\r\nKael se sentó en la cama, frotándose la cara.\r\n\r\n—Normal no es la palabra que usaría —gruñó.\r\n\r\n—Tú sigues pensando como humano —respondió Nox, casi divertido—. Pero ya no eres solo eso.\r\n\r\nKael sintió un escalofrío recorrerle la columna.\r\nNo sabía si era por la advertencia… o por la verdad que escondía.\r\n\r\nSe levantó y caminó hacia el espejo.\r\nSus ojos, por un instante, se oscurecieron como tinta líquida.\r\nNox estaba probando los límites.\r\n\r\n—No hagas eso —susurró Kael.\r\n\r\n—Necesito conocer tu cuerpo —dijo Nox—. Y tú necesitas conocerme a mí.\r\n\r\nKael tragó saliva.\r\nSabía que tenía razón.\r\nDesde que Nox había entrado en él, había sentido fuerza, reflejos, instintos que no eran suyos. Pero también… impulsos que no sabía controlar.\r\n\r\n—¿Qué eres exactamente? —preguntó Kael, sin esperar realmente una respuesta.\r\n\r\nPero esta vez, Nox sí respondió.\r\n\r\n—Soy un sobreviviente. Un arma. Un compañero.\r\n—Hubo una pausa—\r\nY ahora… soy parte de ti.\r\n\r\nKael sintió un latido extraño en su pecho, como si su corazón respondiera a esas palabras.\r\n\r\n—¿Y qué quieres de mí? —preguntó.\r\n\r\nNox no dudó.\r\n\r\n—Quiero que vivas.\r\nQuiero que luches.\r\nQuiero que dejes de temer al mundo que te dio la espalda.\r\nY si ese mundo intenta destruirte… —la voz se volvió más grave, más profunda— lo destruiré yo primero.\r\n\r\nKael cerró los ojos.\r\nPor primera vez, no sabía si debía sentirse protegido… o peligrosamente poderoso.\r\n\r\nPero una cosa era segura:\r\nSu vida ya no le pertenecía solo a él.', '2026-05-04 13:55:10'),
(14, 8, 'El Primer Descontrol', 'Kael intentó continuar su día como si nada hubiera cambiado, pero era imposible.\r\nCada sonido era más nítido.\r\nCada olor, más intenso.\r\nCada sombra, más amenazante.\r\n\r\nNox estaba despierto.\r\nY eso lo cambiaba todo.\r\n\r\nMientras caminaba por la calle, Kael sintió un zumbido en los oídos. No era dolor… era una advertencia.\r\n\r\n—Alguien te sigue —susurró Nox.\r\n\r\nKael se tensó.\r\n—No empieces.\r\n\r\n—No empiezo. Informo.\r\n\r\nKael aceleró el paso.\r\nEl callejón a su derecha estaba vacío, pero su instinto —o el de Nox— le gritaba que no lo ignorara.\r\n\r\n—Gira —ordenó Nox.\r\n\r\nKael obedeció sin pensar.\r\nApenas dio dos pasos cuando una figura salió de entre las sombras, bloqueándole el camino.\r\n\r\n—Kael, ¿verdad? —dijo el desconocido, con una sonrisa torcida—. Tenemos que hablar.\r\n\r\nKael retrocedió.\r\nEl hombre tenía algo en la mirada… algo que no era humano.\r\n\r\n—No me gusta su olor —gruñó Nox—. Está contaminado.\r\n\r\nKael tragó saliva.\r\n—¿Contaminado con qué?\r\n\r\nPero no obtuvo respuesta.\r\nEl hombre avanzó un paso más.\r\n\r\n—No deberías llevar eso dentro de ti —dijo, señalando el pecho de Kael—. No sabes lo que tienes.\r\n\r\nKael sintió cómo su respiración se aceleraba.\r\nEl miedo subió por su garganta como un nudo.\r\n\r\n—Nox… ¿qué está pasando?\r\n\r\nLa voz del simbionte se volvió más grave, más profunda, más territorial.\r\n\r\n—Déjame protegerte.\r\n\r\nKael negó con la cabeza.\r\n—No. No quiero hacer daño a nadie.\r\n\r\nEl hombre sonrió, mostrando dientes afilados.\r\n—No te preocupes. Yo sí quiero.\r\n\r\nSaltó hacia Kael con una velocidad imposible.\r\n\r\nY entonces, Kael dejó de ser Kael.\r\n\r\nUn impulso oscuro recorrió su cuerpo.\r\nSus brazos se endurecieron, su piel se volvió negra y líquida, como si sombras vivas lo envolvieran.\r\n\r\nNox tomó el control.\r\n\r\nEl impacto nunca llegó.\r\nUna mano —la suya, pero no suya— atrapó al atacante por el cuello con una fuerza brutal.\r\n\r\n—Toca a mi anfitrión otra vez —rugió Nox desde la garganta de Kael— y te arranco la vida.\r\n\r\nEl hombre forcejeó, pero era inútil.\r\nKael sentía todo: la fuerza, la rabia, el poder… y el miedo de perderse dentro de Nox.\r\n\r\n—¡Nox, suéltalo! —gritó Kael desde dentro de su propia mente.\r\n\r\nHubo un silencio tenso.\r\nLuego, lentamente, los dedos se aflojaron.\r\n\r\nEl hombre cayó al suelo, jadeando, y huyó tambaleándose.\r\n\r\nLa oscuridad retrocedió.\r\nKael volvió a ser Kael.\r\n\r\nCayó de rodillas, temblando.\r\n\r\n—¿Ves? —susurró Nox, más suave esta vez—. El mundo no es seguro. Pero yo… yo siempre estaré contigo.\r\n\r\nKael no sabía si debía agradecerle… o temerle.\r\n\r\nPero una cosa era clara:\r\nEse había sido solo el comienzo.', '2026-05-04 13:57:36'),
(15, 8, 'El Otro Huésped', 'Kael no volvió a sentirse tranquilo después del ataque en el callejón.\r\nCada vez que cerraba los ojos, veía la mano de Nox apretando el cuello de aquel hombre.\r\nSentía la fuerza.\r\nSentía la rabia.\r\nSentía… el gusto por dominar.\r\n\r\nY eso lo asustaba más que cualquier enemigo.\r\n\r\n—No deberías temerme —dijo Nox, rompiendo el silencio dentro de su mente—. Yo no soy tu enemigo.\r\n\r\nKael respiró hondo.\r\n—Pero puedo convertirme en algo que no quiero ser.\r\n\r\n—Eso depende de ti —respondió Nox—. Yo solo actúo cuando tú dudas.\r\n\r\nKael no supo qué contestar.\r\n\r\n\r\nEsa tarde, mientras caminaba por una avenida llena de gente, sintió una presencia familiar.\r\nUn olor metálico.\r\nUna vibración en el aire.\r\n\r\nNox se tensó.\r\n\r\n—Él está aquí.\r\n\r\nKael se detuvo.\r\n—¿El del callejón?\r\n\r\n—No.\r\n—La voz de Nox se volvió más grave—\r\nEl otro.\r\n\r\nKael giró lentamente.\r\nEntre la multitud, un hombre alto, de abrigo oscuro, lo observaba sin disimulo.\r\nSus ojos no eran normales: tenían un brillo amarillento, casi reptiliano.\r\n\r\nEl desconocido sonrió.\r\nNo con amabilidad.\r\nCon reconocimiento.\r\n\r\nKael sintió un escalofrío.\r\n\r\n—Ese… no es humano, ¿verdad? —susurró.\r\n\r\n—Lo fue —respondió Nox—. Pero ya no está solo. Como tú.\r\n\r\nEl hombre comenzó a caminar hacia él, abriéndose paso entre la gente sin apartar la mirada.\r\n\r\n—Kael —advirtió Nox—, aléjate.\r\n\r\nPero Kael no se movió.\r\nAlgo en la mirada del desconocido lo paralizaba.\r\n\r\nCuando estuvo a pocos pasos, el hombre habló:\r\n\r\n—Así que tú eres el que lo lleva dentro.\r\n\r\nKael tragó saliva.\r\n—¿Quién eres?\r\n\r\nEl hombre inclinó la cabeza, como si estudiara cada detalle de su rostro.\r\n\r\n—Mi nombre es Varek.\r\nY lo que llevas en tu interior… —sonrió, mostrando dientes afilados— es mío.\r\n\r\nNox rugió dentro de Kael, un sonido tan profundo que le vibró en los huesos.\r\n\r\n—Miente —escupió Nox—. No le creas.\r\n\r\nVarek dio un paso más.\r\n\r\n—No te ha contado la verdad, ¿verdad?\r\n—Sus ojos brillaron—\r\nNo te ha dicho de dónde viene.\r\nNi por qué te eligió.\r\nNi lo que realmente quiere de ti.\r\n\r\nKael sintió que el corazón se le aceleraba.\r\n\r\n—¿Qué estás diciendo?\r\n\r\nVarek levantó una mano, mostrando venas negras que se movían bajo la piel como si algo reptara dentro.\r\n\r\n—Yo también tengo un huésped.\r\nY a diferencia de ti… yo sí sé para qué estamos aquí.\r\n\r\nNox habló con un tono que Kael nunca le había escuchado:\r\nNo era furia.\r\nEra miedo.\r\n\r\n—Kael… corre.\r\n\r\nPero ya era tarde.\r\nVarek sonrió, y algo oscuro comenzó a extenderse por su brazo.\r\n\r\nLa guerra entre huéspedes acababa de empezar.', '2026-05-04 13:59:23'),
(16, 8, 'Ecos del Origen', 'Kael corrió.\r\n\r\nNo sabía hacia dónde, no sabía por qué. Solo sabía que tenía que alejarse de Varek.\r\nLa multitud se volvió ruido, sombras, rostros borrosos.\r\nSu respiración era un golpe constante en sus oídos.\r\n\r\n—A la derecha —ordenó Nox—. Rápido.\r\n\r\nKael giró sin pensar y se metió en un callejón estrecho.\r\nEl eco de sus pasos rebotaba en las paredes húmedas.\r\n\r\n—¿Qué era eso? —jadeó—. ¿Qué es Varek?\r\n\r\nNox tardó en responder.\r\nDemasiado.\r\n\r\n—Un huésped como tú —dijo al fin—. Pero su simbionte… no es como yo.\r\n\r\nKael se apoyó contra la pared, intentando recuperar el aliento.\r\n\r\n—¿Cuántos más hay?\r\n\r\nSilencio.\r\n\r\n—Nox… ¿cuántos?\r\n\r\nLa voz del simbionte se volvió más baja, casi un susurro.\r\n\r\n—Muchos. Demasiados. Y no todos buscan coexistir.\r\n\r\nKael sintió un nudo en el estómago.\r\n\r\n—¿Y tú? ¿Qué buscas?\r\n\r\nNox no respondió de inmediato.\r\nEra extraño: por primera vez, parecía elegir sus palabras.\r\n\r\n—Busco sobrevivir —dijo finalmente—. Y contigo… puedo hacerlo.\r\n\r\nKael apretó los dientes.\r\n\r\n—Eso no me dice nada.\r\n\r\n—Te dice todo —replicó Nox—. Si tú mueres, yo muero. Si tú vives, yo vivo. No tengo razón para traicionarte.\r\n\r\nKael quería creerle.\r\nPero la imagen de su mano transformada, apretando el cuello del hombre del callejón, seguía quemándole la mente.\r\n\r\nUn ruido metálico resonó detrás de él.\r\nKael se giró de golpe.\r\n\r\nNada.\r\n\r\n—No estamos solos —advirtió Nox.\r\n\r\nKael retrocedió, mirando a ambos lados.\r\nEl callejón parecía vacío… pero el aire estaba cargado, pesado, como antes de una tormenta.\r\n\r\n—Kael —susurró Nox—. Escúchame bien.\r\n—La voz se volvió más grave—\r\nNo puedes enfrentarte a Varek. No todavía.\r\n\r\n—¿Y qué hago? ¿Huir para siempre?\r\n\r\n—No.\r\n—Una pausa—\r\nEntrenar.\r\n\r\nKael frunció el ceño.\r\n\r\n—¿Entrenar qué?\r\n\r\nNox respondió con una calma inquietante.\r\n\r\n—Entrenar a controlar lo que somos.\r\n\r\nAntes de que Kael pudiera decir algo, una figura cayó desde un tejado cercano, golpeando el suelo con un impacto seco.\r\n\r\nKael dio un salto hacia atrás.\r\n\r\nLa figura se incorporó lentamente.\r\nEra Varek.\r\n\r\nSus ojos brillaban con un tono enfermizo.\r\nSu piel vibraba, como si algo debajo intentara salir.\r\n\r\n—Te escondes bien —dijo con una sonrisa torcida—. Pero no lo suficiente.\r\n\r\nKael sintió cómo Nox se agitaba dentro de él, como un animal acorralado.\r\n\r\n—Kael —advirtió Nox—. Si pelea, no podrás detenerme.\r\n\r\nVarek dio un paso adelante.\r\n\r\n—No quiero matarte —dijo—. Solo quiero lo que llevas dentro.\r\n\r\nKael sintió el pulso acelerarse.\r\nNox rugió.\r\n\r\n—Sobre mi cadáver.\r\n\r\nVarek sonrió.\r\n\r\n—Eso puede arreglarse.\r\n\r\nLa oscuridad dentro de Kael comenzó a moverse, a subir por sus brazos, a reclamar su cuerpo.\r\n\r\nY Kael entendió algo:\r\nNo era solo una pelea contra Varek.\r\nEra una pelea por sí mismo.', '2026-05-04 14:00:09'),
(17, 8, 'Cuando el Huésped Cede', 'El aire del callejón se volvió pesado, casi eléctrico.\r\nKael sintió cómo su cuerpo reaccionaba antes que su mente: los músculos tensos, la respiración acelerada, la sombra líquida de Nox deslizándose bajo su piel.\r\n\r\nVarek dio un paso adelante, y su propio simbionte se manifestó como un brillo oscuro que recorría sus brazos.\r\n\r\n—No tienes idea de lo que llevas dentro —dijo Varek, con una calma inquietante—. Pero yo sí. Y voy a recuperarlo.\r\n\r\nKael retrocedió un paso.\r\nNox no.\r\n\r\n—No te acerques —advirtió el simbionte desde dentro, su voz resonando en cada latido.\r\n\r\nVarek sonrió, como si disfrutara del miedo ajeno.\r\n\r\n—Tu huésped habla demasiado —dijo—. El mío no necesita palabras.\r\n\r\nUna onda de energía oscura recorrió el brazo de Varek, extendiéndose como una sombra viva. Kael sintió el impulso de esquivar, pero su cuerpo no reaccionó a tiempo.\r\n\r\nNox sí.\r\n\r\nLa oscuridad de Kael brotó de su brazo como un escudo, bloqueando el ataque con un impacto seco que resonó en todo el callejón.\r\n\r\nKael jadeó.\r\nNox rugió.\r\n\r\n—No lo toques.\r\n\r\nVarek arqueó una ceja.\r\n\r\n—Interesante. Ya empezaste a sincronizarte.\r\n\r\nKael sintió un escalofrío.\r\n—¿Sincronizarme? ¿Con qué?\r\n\r\nNox respondió antes que Varek.\r\n\r\n—Conmigo.\r\n\r\nVarek se lanzó hacia adelante.\r\nKael intentó moverse, pero el ataque fue demasiado rápido.\r\nLa sombra del otro huésped lo golpeó en el pecho, lanzándolo contra la pared.\r\n\r\nEl impacto le sacó el aire.\r\nNox reaccionó de inmediato, envolviendo su torso con una capa oscura que amortiguó el golpe.\r\n\r\n—Kael —dijo Nox, firme—. Déjame actuar.\r\n\r\nKael apretó los dientes.\r\n—No quiero perder el control.\r\n\r\n—No lo perderás —respondió Nox—. Lo compartiremos.\r\n\r\nVarek avanzó de nuevo, su simbionte extendiéndose como tentáculos oscuros.\r\n\r\nKael sintió el miedo subirle por la garganta.\r\nSintió la fuerza de Nox empujando desde dentro.\r\nSintió que no podía ganar solo.\r\n\r\nY entonces tomó una decisión.\r\n\r\n—Está bien —susurró—. Hazlo.\r\n\r\nLa oscuridad estalló desde su espalda como un latido vivo.\r\nSus brazos se cubrieron de una capa negra, densa, que se movía como si respirara.\r\nSus ojos se oscurecieron.\r\n\r\nNox habló a través de él, con una voz doble, profunda.\r\n\r\n—Ahora sí… estamos completos.\r\n\r\nVarek retrocedió un paso, sorprendido.\r\n\r\n—Así que por fin te dejas llevar.\r\n\r\nKael sintió la fuerza recorrerlo, pero también sintió algo más:\r\nNox no lo estaba reemplazando.\r\nLo estaba amplificando.\r\n\r\nVarek atacó de nuevo, pero esta vez Kael lo vio venir.\r\nEsquivó con una velocidad que no era humana.\r\nGolpeó con una fuerza que no era suya.\r\n\r\nEl choque entre ambos simbiontes iluminó el callejón con destellos oscuros, como relámpagos sin luz.\r\n\r\nVarek sonrió, incluso mientras retrocedía.\r\n\r\n—Esto apenas empieza.\r\n\r\nY antes de que Kael pudiera reaccionar, Varek se desvaneció entre las sombras, como si su cuerpo se disolviera en el aire.\r\n\r\nKael cayó de rodillas, jadeando.\r\nLa oscuridad retrocedió lentamente, dejando su cuerpo tembloroso.\r\n\r\n—Nox… —susurró— ¿qué somos?\r\n\r\nEl simbionte respondió con una calma inquietante.\r\n\r\n—Algo que ellos no pueden controlar.\r\nAlgo que ellos temen.\r\nAlgo que apenas empieza a despertar.\r\n\r\nKael cerró los ojos.\r\nSabía que Varek volvería.\r\nSabía que no estaba listo.\r\n\r\nPero por primera vez… no estaba solo.', '2026-05-04 14:00:45'),
(18, 8, 'Lo Que Somos', 'Kael no volvió a casa.\r\nNo podía.\r\nDespués del enfrentamiento con Varek, sentía que las paredes de cualquier habitación serían demasiado estrechas, demasiado silenciosas… demasiado vulnerables.\r\n\r\nCaminó hasta un viejo edificio abandonado en las afueras de la ciudad.\r\nEl lugar estaba vacío, lleno de polvo y ecos.\r\nPerfecto para estar solo.\r\nPerfecto para no lastimar a nadie.\r\n\r\n—Aquí —dijo Kael, dejando caer su mochila—. Habla.\r\n\r\nNox permaneció en silencio unos segundos.\r\nEra extraño.\r\nEl simbionte nunca dudaba.\r\n\r\n—¿Qué quieres saber? —preguntó finalmente.\r\n\r\nKael apretó los puños.\r\n\r\n—Todo.\r\n—Respiró hondo—\r\n¿De dónde vienes?\r\n¿Qué eres?\r\n¿Y por qué Varek dice que eres suyo?\r\n\r\nLa voz de Nox se volvió más profunda, más antigua.\r\n\r\n—No soy suyo.\r\n—Una pausa—\r\nPero no soy el único de mi especie.\r\n\r\nKael se sentó en el suelo, apoyando la espalda en una columna rota.\r\n\r\n—¿Especie?\r\n\r\n—Somos simbiontes —explicó Nox—. Seres que necesitan un huésped para sobrevivir. Pero no todos buscamos lo mismo.\r\n\r\nKael frunció el ceño.\r\n\r\n—¿Y qué buscas tú?\r\n\r\nNox respondió sin rodeos.\r\n\r\n—Equilibrio.\r\n\r\nKael no esperaba esa palabra.\r\n\r\n—¿Equilibrio?\r\n\r\n—Sí.\r\n—La voz resonó en su pecho—\r\nTú me das forma. Yo te doy fuerza.\r\nTú me das control. Yo te doy supervivencia.\r\nSomos dos mitades que pueden coexistir… si lo permites.\r\n\r\nKael bajó la mirada.\r\n\r\n—¿Y Varek?\r\n\r\nNox se tensó.\r\n\r\n—El simbionte dentro de él no busca equilibrio. Busca dominio. Control total del huésped. Y si lo consigue… no quedará nada de Varek.\r\n\r\nKael sintió un escalofrío.\r\n\r\n—¿Eso puede pasarte a ti? ¿Puedes… tomarme?\r\n\r\nNox tardó en responder.\r\n\r\n—Si tú me rechazas, sí.\r\n—Una pausa larga—\r\nPero no quiero eso. No contigo.\r\n\r\nKael levantó la cabeza.\r\nHabía sinceridad en la voz de Nox.\r\nO algo que se parecía mucho.\r\n\r\n—Entonces enséñame —dijo Kael—. Enséñame a controlarte. A controlarnos.\r\n\r\nNox pareció sonreír desde dentro.\r\n\r\n—Eso quería escuchar.\r\n\r\nKael se puso de pie.\r\nEl aire del edificio abandonado estaba frío, pero algo dentro de él ardía.\r\n\r\n—¿Qué hago primero?\r\n\r\n—Respira —ordenó Nox—. Y déjame fluir.\r\n\r\nKael cerró los ojos.\r\nSintió cómo la oscuridad se movía bajo su piel, como un río silencioso.\r\nNo lo invadía.\r\nNo lo forzaba.\r\nSolo esperaba.\r\n\r\n—No luches contra mí —susurró Nox—. Guíame.\r\n\r\nKael levantó una mano.\r\nLa sombra se extendió por sus dedos, formando una capa negra que se movía como humo líquido.\r\n\r\nPor primera vez… no sintió miedo.\r\nSintió control.\r\n\r\n—Eso es —dijo Nox—. Estamos aprendiendo.\r\n\r\nKael abrió los ojos.\r\nLa oscuridad se retiró lentamente, obediente.\r\n\r\n—¿Cuánto tiempo tardaremos en dominar esto? —preguntó.\r\n\r\nNox respondió con una calma inquietante.\r\n\r\n—Depende de ti.\r\n—Una pausa—\r\nY del tiempo que tardemos en que Varek nos encuentre de nuevo.\r\n\r\nKael tragó saliva.\r\nSabía que ese momento llegaría.\r\nSabía que no estaban listos.\r\n\r\nPero por primera vez… tenía esperanza.', '2026-05-04 14:01:30'),
(19, 8, 'Somos Uno', 'El edificio abandonado temblaba con cada respiración de Kael.\r\nHabía entrenado durante horas, dejando que Nox fluyera, retrocediera, se adaptara.\r\nPor primera vez, no sentía que el simbionte lo empujaba.\r\nSentía que lo acompañaba.\r\n\r\n—Estás listo —dijo Nox, con una calma que Kael no le había escuchado nunca.\r\n\r\nKael se secó el sudor de la frente.\r\n\r\n—¿Listo para qué?\r\n\r\n—Para enfrentarlo.\r\n—Una pausa—\r\nPara enfrentarnos.\r\n\r\nKael abrió la boca para responder, pero un ruido metálico resonó en el pasillo.\r\nUn paso.\r\nOtro.\r\n\r\nNox se tensó.\r\n\r\n—Es él.\r\n\r\nKael sintió el corazón acelerarse, pero esta vez no retrocedió.\r\nNo huyó.\r\nNo dudó.\r\n\r\nVarek apareció entre las sombras, con su simbionte reptando bajo la piel como un veneno vivo.\r\n\r\n—Veo que has estado practicando —dijo con una sonrisa torcida—. Qué adorable.\r\n\r\nKael dio un paso adelante.\r\n\r\n—No voy a dejar que te lleves a Nox.\r\n\r\nVarek rió, un sonido frío.\r\n\r\n—No quiero llevármelo.\r\n—Sus ojos brillaron—\r\nQuiero liberarlo.\r\n\r\nNox rugió dentro de Kael, pero Kael levantó una mano.\r\n\r\n—Déjame hablar.\r\n\r\nEl simbionte obedeció.\r\n\r\nKael respiró hondo.\r\n\r\n—Nox no es tuyo. No es un arma. No es una herramienta.\r\n—Miró a Varek con firmeza—\r\nEs mi compañero.\r\n\r\nVarek frunció el ceño, como si la palabra le resultara ofensiva.\r\n\r\n—Los simbiontes no son compañeros. Son parásitos.\r\n\r\nKael negó con la cabeza.\r\n\r\n—Solo si los tratas como tal.\r\n\r\nEl aire se volvió denso.\r\nVarek dio un paso adelante, pero Kael no se movió.\r\n\r\n—No voy a pelear contigo —dijo Kael—. No así.\r\n\r\nVarek sonrió.\r\n\r\n—Entonces perderás.\r\n\r\nLa sombra de su simbionte comenzó a extenderse…\r\nPero Kael habló antes de que atacara.\r\n\r\n—Nox.\r\n\r\nLa oscuridad brotó suavemente, no como un estallido, sino como un abrazo.\r\nCubrió sus brazos, su espalda, su pecho.\r\nNo para dominar.\r\nPara proteger.\r\n\r\nKael y Nox hablaron con una sola voz, profunda y firme:\r\n\r\n—No somos tu enemigo.\r\nPero tampoco somos tu presa.\r\n\r\nVarek se detuvo.\r\nPor primera vez, dudó.\r\n\r\nKael dio un paso adelante, tranquilo, seguro.\r\n\r\n—Si quieres destruirme, tendrás que destruirnos a los dos.\r\nY no lo permitiré.\r\n\r\nEl simbionte de Varek vibró, inquieto.\r\nVarek apretó los dientes.\r\n\r\n—Esto no ha terminado.\r\n\r\n—Lo sé —respondió Kael—. Pero hoy… no ganarás.\r\n\r\nVarek retrocedió lentamente, su sombra encogiéndose.\r\nY sin una palabra más, se desvaneció entre las grietas del edificio.\r\n\r\nSilencio.\r\n\r\nKael dejó que la oscuridad se retirara.\r\nCayó de rodillas, agotado, pero no derrotado.\r\n\r\nNox habló con suavidad.\r\n\r\n—Estoy orgulloso de ti.\r\n\r\nKael sonrió, respirando hondo.\r\n\r\n—Somos un buen equipo.\r\n\r\n—Somos uno —corrigió Nox.\r\n\r\nKael se puso de pie, mirando hacia la salida del edificio.\r\nEl mundo seguía siendo peligroso.\r\nVarek seguía ahí fuera.\r\nY el futuro era incierto.\r\n\r\nPero por primera vez… Kael no tenía miedo.\r\n\r\nTenía a Nox.\r\nY Nox lo tenía a él.\r\n\r\nEl comienzo había terminado.\r\nLa historia apenas empezaba.', '2026-05-04 14:02:16'),
(20, 8, 'Herencia de Sombras y Luz', 'Habían pasado años desde la última vez que Kael vio a Varek.\r\nLa ciudad había cambiado.\r\nÉl también.\r\n\r\nEl viejo edificio abandonado donde entrenó con Nox ya no existía; en su lugar había un parque lleno de árboles jóvenes. Kael caminaba por los senderos con paso tranquilo, sintiendo la brisa cálida del atardecer.\r\n\r\n—Nunca pensé que llegaríamos tan lejos —dijo Kael en voz baja.\r\n\r\n—Yo sí —respondió Nox desde dentro, con un tono más suave que en el pasado—. Siempre supe que podíamos construir algo mejor.\r\n\r\nKael sonrió.\r\n\r\nA su lado caminaba un niño de unos siete años, de ojos intensos y curiosos. Se llamaba Eiden. Su cabello oscuro brillaba bajo la luz, y cada tanto, cuando se emocionaba demasiado, un pequeño destello negro recorría sus pupilas.\r\n\r\nKael lo miró con ternura.\r\n\r\n—No corras tanto, Eiden. El suelo está mojado.\r\n\r\nEl niño rió, ignorando la advertencia, y siguió avanzando entre los árboles.\r\n\r\nNox habló de nuevo, con un matiz casi orgulloso.\r\n\r\n—Tiene tu corazón… y un poco de mí.\r\n\r\nKael asintió.\r\n\r\nEiden no era un huésped como él.\r\nNo tenía un simbionte completo dentro.\r\nPero sí había heredado algo: una sensibilidad especial, una conexión natural con la energía oscura que formaba parte de Kael y Nox.\r\nUna chispa.\r\n\r\nUn puente entre dos mundos.\r\n\r\n—¿Crees que algún día…? —preguntó Kael.\r\n\r\n—Cuando llegue el momento —respondió Nox—. Y cuando él lo elija. Nada antes.\r\n\r\nKael se detuvo, observando a su hijo jugar con una rama caída, imaginando que era una espada.\r\nEiden levantó la mirada y sonrió con esa mezcla perfecta de inocencia y fuerza.\r\n\r\nKael sintió el pecho llenarse de algo cálido.\r\n\r\n—Nunca pensé que tendría una familia —susurró.\r\n\r\nNox respondió con una sinceridad que Kael ya conocía bien.\r\n\r\n—Yo tampoco. Pero la vida… cambia cuando eliges a alguien.\r\n\r\nKael rió suavemente.\r\n\r\n—¿Me elegiste a mí?\r\n\r\n—Siempre —dijo Nox—. Y ahora lo elijo a él también.\r\n\r\nEiden corrió hacia Kael y se abrazó a su pierna.\r\n\r\n—Papá, ¿vamos a casa?\r\n\r\nKael lo levantó en brazos.\r\n\r\n—Claro que sí.\r\n\r\nMientras caminaban hacia el final del sendero, Kael sintió a Nox descansar en silencio dentro de él.\r\nNo como un arma.\r\nNo como un parásito.\r\nSino como un compañero.\r\n\r\nUn guardián.\r\n\r\nUn legado.\r\n\r\nY mientras el sol se ocultaba detrás de los edificios, Kael supo que, por primera vez en su vida, el futuro no le daba miedo.\r\n\r\nPorque no estaba solo.\r\nPorque tenía una familia.\r\nPorque su historia —su verdadera historia— apenas comenzaba.', '2026-05-04 14:03:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capitulo_imagenes`
--

CREATE TABLE `capitulo_imagenes` (
  `id` int NOT NULL,
  `capitulo_id` int NOT NULL,
  `ruta` varchar(255) NOT NULL,
  `orden` int DEFAULT '0',
  `fecha_subida` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categorias` int NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categorias`, `nombre`) VALUES
(1, 'Ficcion'),
(2, 'Romance'),
(3, 'Misterio'),
(4, 'Aventura'),
(5, 'Fantasia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chats`
--

CREATE TABLE `chats` (
  `id_chat` int NOT NULL,
  `usuario_a` int NOT NULL,
  `usuario_b` int NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `aprobado` tinyint(1) DEFAULT '0',
  `iniciador_id` int DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `chats`
--

INSERT INTO `chats` (`id_chat`, `usuario_a`, `usuario_b`, `fecha_creacion`, `aprobado`, `iniciador_id`) VALUES
(1, 1, 2, '2026-04-30 22:14:52', 0, NULL),
(2, 2, 3, '2026-05-01 13:25:28', 0, NULL),
(3, 1, 4, '2026-05-01 14:42:01', 0, NULL),
(4, 1, 3, '2026-05-01 16:49:54', 0, NULL),
(5, 2, 4, '2026-05-04 14:22:24', 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentarios` int NOT NULL,
  `usuario_id` int NOT NULL,
  `capitulo_id` int NOT NULL,
  `contenido` text NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `parent_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id_comentarios`, `usuario_id`, `capitulo_id`, `contenido`, `fecha_creacion`, `parent_id`) VALUES
(1, 1, 2, 'El capítulo es entretenido', '2026-04-30 22:12:16', NULL),
(2, 2, 4, 'No se ve que sea de pago ahí que mirarlo', '2026-04-30 22:20:08', NULL),
(3, 1, 2, 'Hola', '2026-05-01 11:20:26', NULL),
(4, 1, 8, 'Cuak cuak cuak', '2026-05-01 15:08:24', NULL),
(6, 1, 8, 'Cuak Cuak?', '2026-05-01 15:53:43', NULL),
(7, 1, 2, 'Te puedo responder?', '2026-05-01 17:57:13', 1),
(8, 1, 2, 'Publico un comentario real', '2026-05-01 17:57:57', NULL),
(10, 1, 10, 'hola', '2026-05-01 18:53:13', NULL),
(11, 1, 10, 'cuak', '2026-05-01 18:53:27', 10),
(13, 1, 2, 'Y contesto el comentario', '2026-05-01 19:06:02', 8),
(15, 1, 12, 'Wow… la frase del simbionte me dejó helado. Qué forma tan brutal y hermosa de mostrar lealtad.', '2026-05-04 14:06:58', NULL),
(16, 4, 12, 'Kael me atrapó desde el primer párrafo. Se nota que carga mucho encima. Quiero saber más de él.', '2026-05-04 14:07:29', NULL),
(18, 4, 12, 'Nox es inquietante pero protector… esa mezcla me encanta.', '2026-05-04 14:08:10', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario_likes`
--

CREATE TABLE `comentario_likes` (
  `id_like` int NOT NULL,
  `usuario_id` int NOT NULL,
  `comentario_id` int NOT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `comentario_likes`
--

INSERT INTO `comentario_likes` (`id_like`, `usuario_id`, `comentario_id`, `fecha`) VALUES
(2, 1, 4, '2026-05-01 15:53:52'),
(3, 1, 1, '2026-05-01 17:49:18'),
(6, 1, 10, '2026-05-01 18:53:17'),
(7, 1, 8, '2026-05-03 17:33:37'),
(8, 4, 16, '2026-05-04 14:09:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comunidad_mensajes`
--

CREATE TABLE `comunidad_mensajes` (
  `id_comunidad` int NOT NULL,
  `usuario_id` int NOT NULL,
  `contenido` text,
  `archivo` varchar(255) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT 'texto',
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `autor_id` int DEFAULT NULL,
  `parent_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `comunidad_mensajes`
--

INSERT INTO `comunidad_mensajes` (`id_comunidad`, `usuario_id`, `contenido`, `archivo`, `tipo`, `fecha`, `autor_id`, `parent_id`) VALUES
(1, 1, 'Hola', NULL, 'texto', '2026-05-01 11:21:49', NULL, NULL),
(2, 4, 'Cuak', NULL, 'texto', '2026-05-01 14:39:23', NULL, NULL),
(3, 1, 'Hola', NULL, 'texto', '2026-05-01 17:58:21', NULL, NULL),
(4, 1, '', 'img/uploads/comunidad/comunidad_69f4ea5212c3d4.24446960.jpg', 'imagen', '2026-05-01 18:00:50', NULL, NULL),
(5, 1, 'Cuak', NULL, 'texto', '2026-05-01 18:38:56', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos`
--

CREATE TABLE `favoritos` (
  `id_favoritos` int NOT NULL,
  `usuario_id` int NOT NULL,
  `libro_id` int DEFAULT NULL,
  `capitulo_id` int DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `favoritos`
--

INSERT INTO `favoritos` (`id_favoritos`, `usuario_id`, `libro_id`, `capitulo_id`, `fecha`) VALUES
(6, 1, 3, NULL, '2026-05-01 19:05:22'),
(7, 4, 2, NULL, '2026-05-01 20:17:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id_libros` int NOT NULL,
  `usuario_id` int NOT NULL,
  `categoria_id` int DEFAULT NULL,
  `titulo` varchar(255) NOT NULL,
  `portada` varchar(255) DEFAULT NULL,
  `precio` decimal(8,2) DEFAULT '0.00',
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `edad_recomendada` int DEFAULT '0',
  `estado` varchar(20) DEFAULT 'en_proceso'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id_libros`, `usuario_id`, `categoria_id`, `titulo`, `portada`, `precio`, `fecha_creacion`, `edad_recomendada`, `estado`) VALUES
(2, 1, 4, 'Prueba', 'img/uploads/covers/cover_69f3d2d499ce92.68028141.jpeg', 0.00, '2026-04-30 22:08:20', 0, 'en_proceso'),
(3, 2, 2, 'La Ciudad Bajo las Estrellas', 'img/uploads/covers/cover_69f3d337e43299.87265376.jpg', 0.00, '2026-04-30 22:09:59', 0, 'en_proceso'),
(4, 1, 1, 'Prueba2', NULL, 0.00, '2026-04-30 22:31:40', 0, 'en_proceso'),
(5, 4, 4, 'Pato', NULL, 0.00, '2026-05-01 14:28:50', 7, 'en_proceso'),
(6, 4, 5, 'Cuak', NULL, 0.00, '2026-05-01 14:29:15', 7, 'completado'),
(7, 4, 3, 'El triste pato', 'img/uploads/covers/cover_69f4ebcebe1858.60458752.jpg', 3.99, '2026-05-01 18:07:10', 13, 'en_proceso'),
(8, 2, 5, 'Contra el Mundo', 'img/uploads/covers/cover_69f8a41d929a11.59041235.jpg', 4.99, '2026-05-04 13:50:21', 16, 'completado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id_mensaje` int NOT NULL,
  `chat_id` int NOT NULL,
  `remitente_id` int NOT NULL,
  `contenido` text NOT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `archivo` varchar(255) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT 'texto'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id_mensaje`, `chat_id`, `remitente_id`, `contenido`, `fecha`, `archivo`, `tipo`) VALUES
(1, 1, 1, 'Hola, vamos a probar si se puede tener una conversación y funciona en perfecto estado', '2026-04-30 22:15:24', NULL, 'texto'),
(2, 1, 1, 'Deberemos ver las notificaciones y de momento no se va a poder enviar archivos por aqui', '2026-04-30 22:16:24', NULL, 'texto'),
(3, 1, 2, 'Debemos las notificaciones del chat ya que no saltan', '2026-04-30 22:18:37', NULL, 'texto'),
(4, 1, 2, 'Y también hay que comprobar que se guardan todo de un dia a otro', '2026-04-30 22:19:10', NULL, 'texto'),
(5, 2, 3, 'Mira que chulo', '2026-05-01 13:25:45', NULL, 'texto'),
(6, 3, 1, '', '2026-05-01 14:42:24', 'img/uploads/chat/chat_69f4bbd0c85bd0.91764424.jpeg', 'imagen'),
(7, 3, 1, 'Cuak', '2026-05-01 14:42:33', NULL, 'texto'),
(8, 3, 1, 'cuak', '2026-05-01 14:43:01', NULL, 'texto'),
(9, 3, 1, 'Cuak', '2026-05-01 14:43:05', NULL, 'texto'),
(10, 3, 1, 'Cuak', '2026-05-01 14:43:26', NULL, 'texto'),
(11, 3, 1, 'Cuak', '2026-05-01 14:43:31', NULL, 'texto'),
(12, 3, 1, 'Cuak', '2026-05-01 14:43:35', NULL, 'texto'),
(13, 3, 1, 'Cuak', '2026-05-01 14:43:41', NULL, 'texto'),
(14, 3, 1, 'Cuak', '2026-05-01 16:49:19', NULL, 'texto'),
(15, 1, 1, '', '2026-05-01 17:02:59', 'img/uploads/chat/chat_69f4dcc3337fe1.52437162.jpg', 'imagen'),
(16, 1, 1, '', '2026-05-01 17:03:31', 'img/uploads/chat/chat_69f4dce3c52dd3.84857182.jpg', 'imagen'),
(17, 1, 1, '', '2026-05-01 17:03:44', 'img/uploads/chat/chat_69f4dcf029d745.91493447.png', 'imagen'),
(18, 1, 1, 'Hola', '2026-05-01 18:01:05', NULL, 'texto'),
(19, 1, 2, 'Hola', '2026-05-01 20:13:07', NULL, 'texto'),
(20, 1, 2, 'Probando lo mensajes', '2026-05-01 20:13:16', NULL, 'texto'),
(21, 1, 2, 'Y las notificaciones', '2026-05-01 20:13:25', NULL, 'texto'),
(22, 1, 2, 'Ha ver si asi no se pasan de donde tiene que estar', '2026-05-01 20:13:47', NULL, 'texto'),
(23, 3, 4, 'Cuak', '2026-05-01 20:14:33', NULL, 'texto'),
(24, 3, 4, 'Cuak', '2026-05-01 20:14:36', NULL, 'texto'),
(25, 3, 4, 'Cuak', '2026-05-01 20:14:39', NULL, 'texto'),
(26, 3, 4, 'Cuak', '2026-05-01 20:14:42', NULL, 'texto'),
(27, 3, 4, 'cuak', '2026-05-01 20:14:46', NULL, 'texto'),
(28, 3, 4, 'Cuak', '2026-05-01 20:14:50', NULL, 'texto'),
(29, 3, 4, 'Cuak', '2026-05-01 20:14:54', NULL, 'texto'),
(30, 3, 4, 'Cuak', '2026-05-01 20:14:57', NULL, 'texto'),
(31, 3, 4, '', '2026-05-01 20:15:06', 'img/uploads/chat/chat_69f509ca3ea013.96946862.jpg', 'imagen'),
(32, 3, 4, 'Cuak', '2026-05-01 20:15:09', NULL, 'texto'),
(33, 3, 4, 'Cuak', '2026-05-01 20:16:58', NULL, 'texto'),
(34, 3, 4, 'Cuak', '2026-05-01 20:17:01', NULL, 'texto'),
(35, 3, 4, 'Cuak', '2026-05-01 20:17:04', NULL, 'texto'),
(36, 3, 4, 'Cuak', '2026-05-01 20:17:07', NULL, 'texto'),
(37, 3, 4, 'Cuak', '2026-05-01 20:17:11', NULL, 'texto'),
(38, 3, 4, 'Cuak', '2026-05-01 20:17:15', NULL, 'texto'),
(39, 3, 4, 'Cuak', '2026-05-01 20:17:18', NULL, 'texto'),
(40, 3, 4, 'Cuak', '2026-05-01 20:17:21', NULL, 'texto'),
(41, 1, 1, 'Hola', '2026-05-02 14:46:47', NULL, 'texto'),
(42, 1, 1, '', '2026-05-02 16:02:04', 'img/uploads/chat/chat_69f61ffc4e1af8.25690891.jpg', 'imagen'),
(43, 1, 1, 'Con un libro', '2026-05-02 16:02:41', 'img/uploads/chat/chat_69f62021aa78a9.16049694.jpg', 'imagen');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id_notificaciones` int NOT NULL,
  `usuario_id` int NOT NULL,
  `mensaje` text NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `leida` tinyint(1) DEFAULT '0',
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`id_notificaciones`, `usuario_id`, `mensaje`, `url`, `leida`, `fecha`) VALUES
(39, 4, 'Tu libro \'El triste pato\' ha sido comprado.', 'perfil.php?user_id=4', 0, '2026-05-01 18:14:33'),
(41, 4, 'Tu libro \'El triste pato\' ha recibido un nuevo comentario.', 'leer.php?id=10', 0, '2026-05-01 18:47:57'),
(42, 4, 'Tu libro \'El triste pato\' ha recibido un nuevo comentario.', 'leer.php?id=10', 0, '2026-05-01 18:53:13'),
(43, 4, 'Tu libro \'El triste pato\' ha recibido un nuevo comentario.', 'leer.php?id=10', 0, '2026-05-01 18:53:27'),
(46, 1, 'El usuario admin ya te sigue.', 'perfil.php?user_id=1', 1, '2026-05-01 18:58:17'),
(47, 2, 'Tu libro \'La Ciudad Bajo las Estrellas\' ha recibido un nuevo favorito.', 'leer.php?id=2', 1, '2026-05-01 19:05:22'),
(48, 2, 'El usuario admin ya te sigue.', 'perfil.php?user_id=1', 1, '2026-05-01 19:05:24'),
(49, 2, 'Tu libro \'La Ciudad Bajo las Estrellas\' ha recibido un nuevo comentario.', 'leer.php?id=2', 1, '2026-05-01 19:06:02'),
(50, 2, 'Tu libro \'La Ciudad Bajo las Estrellas\' ha recibido un nuevo comentario.', 'leer.php?id=2', 1, '2026-05-01 19:06:21'),
(51, 4, 'Tu libro \'El triste pato\' ha sido comprado.', 'perfil.php?user_id=4', 0, '2026-05-01 19:13:32'),
(52, 1, 'Nuevo mensaje de Alba.', 'chat.php?user_id=2', 1, '2026-05-01 20:13:07'),
(53, 1, 'Nuevo mensaje de Alba.', 'chat.php?user_id=2', 1, '2026-05-01 20:13:16'),
(54, 1, 'Nuevo mensaje de Alba.', 'chat.php?user_id=2', 1, '2026-05-01 20:13:25'),
(55, 1, 'Nuevo mensaje de Alba.', 'chat.php?user_id=2', 1, '2026-05-01 20:13:47'),
(56, 1, 'Nuevo mensaje de Pato.', 'chat.php?user_id=4', 1, '2026-05-01 20:14:33'),
(57, 1, 'Nuevo mensaje de Pato.', 'chat.php?user_id=4', 1, '2026-05-01 20:14:36'),
(58, 1, 'Nuevo mensaje de Pato.', 'chat.php?user_id=4', 1, '2026-05-01 20:14:39'),
(59, 1, 'Nuevo mensaje de Pato.', 'chat.php?user_id=4', 1, '2026-05-01 20:14:42'),
(76, 4, 'Tu libro \'El triste pato\' ha sido comprado.', 'perfil.php?user_id=4', 0, '2026-05-02 14:38:26'),
(77, 1, 'El usuario admin ya te sigue.', 'perfil.php?user_id=1', 1, '2026-05-02 14:40:44'),
(78, 2, 'El usuario admin ya te sigue.', 'perfil.php?user_id=1', 0, '2026-05-02 14:46:35'),
(79, 2, 'Nuevo mensaje de admin.', 'chat.php?user_id=1', 0, '2026-05-02 14:46:47'),
(80, 2, 'Nuevo mensaje de admin.', 'chat.php?user_id=1', 0, '2026-05-02 16:02:04'),
(81, 2, 'Nuevo mensaje de admin.', 'chat.php?user_id=1', 0, '2026-05-02 16:02:41'),
(82, 3, 'El autor Alba ha publicado un nuevo libro: Contra el Mundo.', 'catalogo.php?search=Contra+el+Mundo', 0, '2026-05-04 13:50:21'),
(83, 1, 'El autor Alba ha publicado un nuevo libro: Contra el Mundo.', 'catalogo.php?search=Contra+el+Mundo', 0, '2026-05-04 13:50:21'),
(85, 3, 'Tu autor seguido ha publicado un nuevo capítulo en Contra el Mundo.', 'leer.php?id=12', 0, '2026-05-04 13:54:28'),
(86, 1, 'Tu autor seguido ha publicado un nuevo capítulo en Contra el Mundo.', 'leer.php?id=12', 0, '2026-05-04 13:54:28'),
(88, 3, 'Tu autor seguido ha publicado un nuevo capítulo en Contra el Mundo.', 'leer.php?id=13', 0, '2026-05-04 13:55:10'),
(89, 1, 'Tu autor seguido ha publicado un nuevo capítulo en Contra el Mundo.', 'leer.php?id=13', 0, '2026-05-04 13:55:10'),
(91, 3, 'Tu autor seguido ha publicado un nuevo capítulo en Contra el Mundo.', 'leer.php?id=14', 0, '2026-05-04 13:57:36'),
(92, 1, 'Tu autor seguido ha publicado un nuevo capítulo en Contra el Mundo.', 'leer.php?id=14', 0, '2026-05-04 13:57:36'),
(94, 3, 'Tu autor seguido ha publicado un nuevo capítulo en Contra el Mundo.', 'leer.php?id=15', 0, '2026-05-04 13:59:23'),
(95, 1, 'Tu autor seguido ha publicado un nuevo capítulo en Contra el Mundo.', 'leer.php?id=15', 0, '2026-05-04 13:59:23'),
(97, 3, 'Tu autor seguido ha publicado un nuevo capítulo en Contra el Mundo.', 'leer.php?id=16', 0, '2026-05-04 14:00:09'),
(98, 1, 'Tu autor seguido ha publicado un nuevo capítulo en Contra el Mundo.', 'leer.php?id=16', 0, '2026-05-04 14:00:09'),
(100, 3, 'Tu autor seguido ha publicado un nuevo capítulo en Contra el Mundo.', 'leer.php?id=17', 0, '2026-05-04 14:00:45'),
(101, 1, 'Tu autor seguido ha publicado un nuevo capítulo en Contra el Mundo.', 'leer.php?id=17', 0, '2026-05-04 14:00:45'),
(103, 3, 'Tu autor seguido ha publicado un nuevo capítulo en Contra el Mundo.', 'leer.php?id=18', 0, '2026-05-04 14:01:30'),
(104, 1, 'Tu autor seguido ha publicado un nuevo capítulo en Contra el Mundo.', 'leer.php?id=18', 0, '2026-05-04 14:01:30'),
(106, 3, 'Tu autor seguido ha publicado un nuevo capítulo en Contra el Mundo.', 'leer.php?id=19', 0, '2026-05-04 14:02:16'),
(107, 1, 'Tu autor seguido ha publicado un nuevo capítulo en Contra el Mundo.', 'leer.php?id=19', 0, '2026-05-04 14:02:16'),
(109, 3, 'Tu autor seguido ha publicado un nuevo capítulo en Contra el Mundo.', 'leer.php?id=20', 0, '2026-05-04 14:03:35'),
(110, 1, 'Tu autor seguido ha publicado un nuevo capítulo en Contra el Mundo.', 'leer.php?id=20', 0, '2026-05-04 14:03:35'),
(112, 3, 'El libro \'Contra el Mundo\' ha sido actualizado.', 'leer.php?id=12', 0, '2026-05-04 14:03:57'),
(113, 1, 'El libro \'Contra el Mundo\' ha sido actualizado.', 'leer.php?id=12', 0, '2026-05-04 14:03:57'),
(114, 2, 'Tu libro \'Contra el Mundo\' ha recibido un nuevo comentario.', 'leer.php?id=12', 0, '2026-05-04 14:06:58'),
(115, 2, 'Tu libro \'Contra el Mundo\' ha recibido un nuevo comentario.', 'leer.php?id=12', 0, '2026-05-04 14:07:29'),
(116, 2, 'Tu libro \'Contra el Mundo\' ha recibido un nuevo comentario.', 'leer.php?id=12', 0, '2026-05-04 14:07:57'),
(117, 2, 'Tu libro \'Contra el Mundo\' ha recibido un nuevo comentario.', 'leer.php?id=12', 0, '2026-05-04 14:08:10'),
(118, 2, 'Tu libro \'Contra el Mundo\' ha recibido un nuevo comentario.', 'leer.php?id=12', 0, '2026-05-04 14:08:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguidores`
--

CREATE TABLE `seguidores` (
  `id_seguidores` int NOT NULL,
  `seguidor_id` int NOT NULL,
  `seguido_id` int NOT NULL,
  `fecha_seguimiento` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `seguidores`
--

INSERT INTO `seguidores` (`id_seguidores`, `seguidor_id`, `seguido_id`, `fecha_seguimiento`) VALUES
(7, 3, 2, '2026-05-01 13:25:16'),
(13, 1, 4, '2026-05-01 17:54:31'),
(18, 4, 1, '2026-05-01 20:17:28'),
(20, 1, 2, '2026-05-02 14:46:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `soporte`
--

CREATE TABLE `soporte` (
  `id_soporte` int NOT NULL,
  `usuario_id` int NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `asunto` varchar(255) DEFAULT NULL,
  `descripcion` text,
  `estado` varchar(20) DEFAULT 'abierto',
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `soporte`
--

INSERT INTO `soporte` (`id_soporte`, `usuario_id`, `email`, `asunto`, `descripcion`, `estado`, `fecha`) VALUES
(1, 1, 'admin@demo.com', 'Hola', 'Hay algún problema?', 'abierto', '2026-05-01 11:22:16'),
(2, 1, 'admin@demo.com', 'Prueba de errores', 'Esto es una prueba de errores', 'abierto', '2026-05-01 17:10:56'),
(3, 1, 'admin@demo.com', 'Prueba de errores 2', 'Esto es un error?', 'abierto', '2026-05-01 19:09:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transacciones`
--

CREATE TABLE `transacciones` (
  `id_transaccion` int NOT NULL,
  `usuario_id` int NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `referencia_id` int DEFAULT NULL,
  `monto` decimal(8,2) NOT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `transacciones`
--

INSERT INTO `transacciones` (`id_transaccion`, `usuario_id`, `tipo`, `referencia_id`, `monto`, `fecha`) VALUES
(1, 3, 'libro', 4, 0.50, '2026-05-01 13:05:42'),
(2, 2, 'libro', 4, 0.50, '2026-05-01 14:16:12'),
(3, 1, 'recarga', NULL, 1.00, '2026-05-01 15:46:40'),
(4, 1, 'recarga', NULL, 1.00, '2026-05-01 15:46:56'),
(5, 1, 'recarga', NULL, 10.00, '2026-05-01 17:07:16'),
(6, 1, 'recarga', NULL, 10.00, '2026-05-01 17:08:05'),
(7, 1, 'recarga', NULL, 5.00, '2026-05-01 17:08:07'),
(8, 1, 'recarga', NULL, 20.00, '2026-05-01 17:09:29'),
(9, 1, 'recarga', NULL, 1.00, '2026-05-01 18:01:10'),
(11, 1, 'recarga', NULL, 1.00, '2026-05-01 18:14:48'),
(13, 1, 'recarga', NULL, 20.00, '2026-05-02 14:37:48'),
(14, 1, 'libro', 7, 3.99, '2026-05-02 14:38:26'),
(15, 2, 'recarga', NULL, 20.00, '2026-05-04 14:35:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuarios` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `bio` text,
  `activo` tinyint(1) DEFAULT '1',
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `monedas` decimal(10,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuarios`, `nombre`, `email`, `password`, `avatar`, `bio`, `activo`, `fecha_registro`, `monedas`) VALUES
(1, 'admin', 'admin@demo.com', '$2y$10$XK1Z7miTnmbIs453QLZ8gO7.zraoOg/oKX1fur1XwUjcQ99yZMkSm', 'img/uploads/avatars/avatar_69f3d4d53d5741.69726126.jpeg', 'Está es un breve descripción', 1, '2026-04-30 22:06:50', 30.03),
(2, 'Alba', 'alba@demo.com', '$2y$10$008CVAAVQYG.7NuCktLcFulrpvKs/ep/uW5RDbIck8cEXqBkhZKGy', 'img/uploads/avatars/avatar_69f503dc50c8b4.59856527.jpg', 'Amante de las historias que te abrazan y de los libros que te hacen viajar sin moverte del sitio. Siempre con un tomo nuevo entre manos y ganas de descubrir mundos mágicos.', 1, '2026-04-30 22:09:31', 20.00),
(3, 'Usuario', 'user@demo.es', '$2y$10$q3LuQJKLwC2rE8qXq8lCzOcOkUzZ7cgf.HpiCZMTz2dhObpi/dL/6', NULL, NULL, 1, '2026-05-01 13:04:47', 0.00),
(4, 'Pato', 'pato@demo.com', '$2y$10$yF0KkHaAjHBn.0rVwacaMuoGLnf3t.xO3cwmr3R66e4wY9yoFGkcm', NULL, NULL, 1, '2026-05-01 14:23:12', 0.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoraciones`
--

CREATE TABLE `valoraciones` (
  `id_valoracion` int NOT NULL,
  `usuario_id` int NOT NULL,
  `libro_id` int NOT NULL,
  `puntuacion` tinyint NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ;

--
-- Volcado de datos para la tabla `valoraciones`
--

INSERT INTO `valoraciones` (`id_valoracion`, `usuario_id`, `libro_id`, `puntuacion`, `fecha_creacion`) VALUES
(1, 1, 1, 5, '2026-04-30 22:05:59'),
(2, 1, 3, 5, '2026-05-01 19:05:29'),
(8, 1, 5, 1, '2026-05-01 17:54:34'),
(9, 1, 7, 3, '2026-05-01 18:47:16'),
(10, 1, 2, 1, '2026-05-01 18:57:16'),
(12, 2, 8, 5, '2026-05-04 14:04:12'),
(13, 1, 8, 5, '2026-05-04 14:04:54');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`id_actividad`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD PRIMARY KEY (`id_archivos`),
  ADD KEY `libro_id` (`libro_id`),
  ADD KEY `capitulo_id` (`capitulo_id`);

--
-- Indices de la tabla `bloqueos`
--
ALTER TABLE `bloqueos`
  ADD PRIMARY KEY (`id_bloqueo`),
  ADD UNIQUE KEY `unico_bloqueo` (`usuario_id`,`bloqueado_id`),
  ADD KEY `bloqueado_id` (`bloqueado_id`);

--
-- Indices de la tabla `capitulos`
--
ALTER TABLE `capitulos`
  ADD PRIMARY KEY (`id_capitulos`),
  ADD KEY `libro_id` (`libro_id`);

--
-- Indices de la tabla `capitulo_imagenes`
--
ALTER TABLE `capitulo_imagenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `capitulo_id` (`capitulo_id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categorias`);

--
-- Indices de la tabla `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id_chat`),
  ADD UNIQUE KEY `unica_conversacion` (`usuario_a`,`usuario_b`),
  ADD KEY `usuario_b` (`usuario_b`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentarios`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `capitulo_id` (`capitulo_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indices de la tabla `comentario_likes`
--
ALTER TABLE `comentario_likes`
  ADD PRIMARY KEY (`id_like`),
  ADD UNIQUE KEY `unico_like` (`usuario_id`,`comentario_id`),
  ADD KEY `comentario_id` (`comentario_id`);

--
-- Indices de la tabla `comunidad_mensajes`
--
ALTER TABLE `comunidad_mensajes`
  ADD PRIMARY KEY (`id_comunidad`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`id_favoritos`),
  ADD UNIQUE KEY `unico_favorito` (`usuario_id`,`libro_id`,`capitulo_id`),
  ADD KEY `libro_id` (`libro_id`),
  ADD KEY `capitulo_id` (`capitulo_id`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id_libros`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id_mensaje`),
  ADD KEY `chat_id` (`chat_id`),
  ADD KEY `remitente_id` (`remitente_id`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id_notificaciones`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `seguidores`
--
ALTER TABLE `seguidores`
  ADD PRIMARY KEY (`id_seguidores`),
  ADD UNIQUE KEY `unico_seguimiento` (`seguidor_id`,`seguido_id`),
  ADD KEY `seguido_id` (`seguido_id`);

--
-- Indices de la tabla `soporte`
--
ALTER TABLE `soporte`
  ADD PRIMARY KEY (`id_soporte`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  ADD PRIMARY KEY (`id_transaccion`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuarios`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD PRIMARY KEY (`id_valoracion`),
  ADD UNIQUE KEY `unico_valoracion` (`usuario_id`,`libro_id`),
  ADD KEY `libro_id` (`libro_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad`
--
ALTER TABLE `actividad`
  MODIFY `id_actividad` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=265;

--
-- AUTO_INCREMENT de la tabla `archivos`
--
ALTER TABLE `archivos`
  MODIFY `id_archivos` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `bloqueos`
--
ALTER TABLE `bloqueos`
  MODIFY `id_bloqueo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `capitulos`
--
ALTER TABLE `capitulos`
  MODIFY `id_capitulos` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `capitulo_imagenes`
--
ALTER TABLE `capitulo_imagenes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categorias` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `chats`
--
ALTER TABLE `chats`
  MODIFY `id_chat` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentarios` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `comentario_likes`
--
ALTER TABLE `comentario_likes`
  MODIFY `id_like` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `comunidad_mensajes`
--
ALTER TABLE `comunidad_mensajes`
  MODIFY `id_comunidad` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `id_favoritos` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id_libros` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id_mensaje` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id_notificaciones` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT de la tabla `seguidores`
--
ALTER TABLE `seguidores`
  MODIFY `id_seguidores` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `soporte`
--
ALTER TABLE `soporte`
  MODIFY `id_soporte` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  MODIFY `id_transaccion` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuarios` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  MODIFY `id_valoracion` int NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD CONSTRAINT `actividad_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE CASCADE;

--
-- Filtros para la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD CONSTRAINT `archivos_ibfk_1` FOREIGN KEY (`libro_id`) REFERENCES `libros` (`id_libros`) ON DELETE CASCADE,
  ADD CONSTRAINT `archivos_ibfk_2` FOREIGN KEY (`capitulo_id`) REFERENCES `capitulos` (`id_capitulos`) ON DELETE CASCADE;

--
-- Filtros para la tabla `bloqueos`
--
ALTER TABLE `bloqueos`
  ADD CONSTRAINT `bloqueos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE CASCADE,
  ADD CONSTRAINT `bloqueos_ibfk_2` FOREIGN KEY (`bloqueado_id`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE CASCADE;

--
-- Filtros para la tabla `capitulos`
--
ALTER TABLE `capitulos`
  ADD CONSTRAINT `capitulos_ibfk_1` FOREIGN KEY (`libro_id`) REFERENCES `libros` (`id_libros`) ON DELETE CASCADE;

--
-- Filtros para la tabla `capitulo_imagenes`
--
ALTER TABLE `capitulo_imagenes`
  ADD CONSTRAINT `capitulo_imagenes_ibfk_1` FOREIGN KEY (`capitulo_id`) REFERENCES `capitulos` (`id_capitulos`) ON DELETE CASCADE;

--
-- Filtros para la tabla `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `chats_ibfk_1` FOREIGN KEY (`usuario_a`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE CASCADE,
  ADD CONSTRAINT `chats_ibfk_2` FOREIGN KEY (`usuario_b`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE CASCADE;

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE CASCADE,
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`capitulo_id`) REFERENCES `capitulos` (`id_capitulos`) ON DELETE CASCADE,
  ADD CONSTRAINT `comentarios_ibfk_3` FOREIGN KEY (`parent_id`) REFERENCES `comentarios` (`id_comentarios`) ON DELETE CASCADE;

--
-- Filtros para la tabla `comentario_likes`
--
ALTER TABLE `comentario_likes`
  ADD CONSTRAINT `comentario_likes_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE CASCADE,
  ADD CONSTRAINT `comentario_likes_ibfk_2` FOREIGN KEY (`comentario_id`) REFERENCES `comentarios` (`id_comentarios`) ON DELETE CASCADE;

--
-- Filtros para la tabla `comunidad_mensajes`
--
ALTER TABLE `comunidad_mensajes`
  ADD CONSTRAINT `comunidad_mensajes_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE CASCADE;

--
-- Filtros para la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `favoritos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE CASCADE,
  ADD CONSTRAINT `favoritos_ibfk_2` FOREIGN KEY (`libro_id`) REFERENCES `libros` (`id_libros`) ON DELETE CASCADE,
  ADD CONSTRAINT `favoritos_ibfk_3` FOREIGN KEY (`capitulo_id`) REFERENCES `capitulos` (`id_capitulos`) ON DELETE CASCADE;

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE CASCADE,
  ADD CONSTRAINT `libros_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id_categorias`) ON DELETE SET NULL;

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `mensajes_ibfk_1` FOREIGN KEY (`chat_id`) REFERENCES `chats` (`id_chat`) ON DELETE CASCADE,
  ADD CONSTRAINT `mensajes_ibfk_2` FOREIGN KEY (`remitente_id`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE CASCADE;

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `notificaciones_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE CASCADE;

--
-- Filtros para la tabla `seguidores`
--
ALTER TABLE `seguidores`
  ADD CONSTRAINT `seguidores_ibfk_1` FOREIGN KEY (`seguidor_id`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE CASCADE,
  ADD CONSTRAINT `seguidores_ibfk_2` FOREIGN KEY (`seguido_id`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE CASCADE;

--
-- Filtros para la tabla `soporte`
--
ALTER TABLE `soporte`
  ADD CONSTRAINT `soporte_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE CASCADE;

--
-- Filtros para la tabla `transacciones`
--
ALTER TABLE `transacciones`
  ADD CONSTRAINT `transacciones_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE CASCADE;

--
-- Filtros para la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD CONSTRAINT `valoraciones_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE CASCADE,
  ADD CONSTRAINT `valoraciones_ibfk_2` FOREIGN KEY (`libro_id`) REFERENCES `libros` (`id_libros`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
