-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2024 at 02:15 PM
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
-- Database: `shadowx`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Nike', 'Marca líder en ropa y calzado deportivo, conocida por su innovación y estilo.', '2024-11-02 12:56:57', '2024-11-02 12:56:57'),
(2, 'Adidas', 'Reconocida por su calidad y tecnología en calzado, ropa y accesorios deportivos.', '2024-11-02 12:56:57', '2024-11-02 12:56:57'),
(3, 'Puma', 'Marca que combina rendimiento y estilo en su calzado y ropa deportiva.', '2024-11-02 12:56:57', '2024-11-02 12:56:57'),
(4, 'New Balance', 'Conocida por su enfoque en la comodidad y el ajuste en calzado deportivo.', '2024-11-02 12:56:57', '2024-11-02 12:56:57'),
(5, 'Converse', 'Famosa por sus icónicas zapatillas de lona, símbolo de la cultura urbana.', '2024-11-02 12:56:57', '2024-11-02 12:56:57'),
(6, 'Vans', 'Marca emblemática en el mundo del skate, conocida por su estilo casual.', '2024-11-02 12:56:57', '2024-11-02 12:56:57'),
(7, 'Reebok', 'Marca con una rica historia en calzado deportivo, centrada en el fitness y el estilo.', '2024-11-02 12:56:57', '2024-11-02 12:56:57'),
(8, 'Asics', 'Especializada en calzado para correr, conocida por su tecnología de soporte.', '2024-11-02 12:56:57', '2024-11-02 12:56:57'),
(9, 'Jordan', 'Marca icónica vinculada al baloncesto y la moda urbana, conocida por sus diseños únicos.', '2024-11-02 12:56:57', '2024-11-02 12:56:57'),
(10, 'Under Armour', 'Marca innovadora en ropa y calzado deportivo, enfocada en el rendimiento.', '2024-11-02 12:56:57', '2024-11-02 12:56:57');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Running', 'Zapatillas para correr', '2024-11-02 13:02:00', '2024-11-02 13:02:00'),
(2, 'Lifestyle', 'Zapatillas de uso diario', '2024-11-02 13:02:00', '2024-11-02 13:02:00');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `active`) VALUES
(1, 'user', 1),
(2, 'admin', 1),
(3, 'superadmin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` int(11) NOT NULL,
  `size` float NOT NULL,
  `gender` enum('Men','Women') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `size`, `gender`) VALUES
(1, 5, 'Men'),
(2, 5.5, 'Men'),
(3, 6, 'Men'),
(4, 6.5, 'Men'),
(5, 7, 'Men'),
(6, 7.5, 'Men'),
(7, 8, 'Men'),
(8, 8.5, 'Men'),
(9, 9, 'Men'),
(10, 9.5, 'Men'),
(11, 10, 'Men'),
(12, 10.5, 'Men'),
(13, 11, 'Men'),
(14, 11.5, 'Men'),
(15, 12, 'Men'),
(16, 12.5, 'Men'),
(17, 13, 'Men'),
(18, 13.5, 'Men'),
(19, 14, 'Men'),
(20, 14.5, 'Men'),
(21, 15, 'Men'),
(22, 5, 'Women'),
(23, 5.5, 'Women'),
(24, 6, 'Women'),
(25, 6.5, 'Women'),
(26, 7, 'Women'),
(27, 7.5, 'Women'),
(28, 8, 'Women'),
(29, 8.5, 'Women'),
(30, 9, 'Women'),
(31, 9.5, 'Women'),
(32, 10, 'Women'),
(33, 10.5, 'Women'),
(34, 11, 'Women'),
(35, 11.5, 'Women'),
(36, 12, 'Women');

-- --------------------------------------------------------

--
-- Table structure for table `sneakers`
--

CREATE TABLE `sneakers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sneakers`
--

INSERT INTO `sneakers` (`id`, `name`, `description`, `price`, `image`, `brand_id`, `category_id`, `created_at`, `updated_at`) VALUES
(31, 'Nike Air Max 90', 'La Nike Air Max 90 se mantiene fiel a sus raíces OG con la icónica suela Waffle, superposiciones cosidas y acentos clásicos de TPU. Colores frescos dan un aspecto moderno mientras que la amortiguación Max Air añade comodidad a tu recorrido.', 120.00, 'air-max-90.png', 1, 2, '2024-11-21 20:03:12', '2024-11-21 20:03:12'),
(32, 'Adidas Yeezy Boost 350', 'El Adidas Yeezy Boost 350 combina el diseño característico de Kanye West con la tecnología Boost de Adidas para una comodidad y estilo inigualables. Estas zapatillas ofrecen una sensación ligera y un aspecto elegante que atrae miradas.', 350.00, 'yeezy-350.png', 2, 2, '2024-11-21 20:03:12', '2024-11-21 20:03:12'),
(33, 'Puma RS-X3 Puzzle', 'Con su atrevido diseño de bloques de color y diseño futurista, el Puma RS-X3 Puzzle lleva el pasado al futuro. Esta zapatilla cuenta con una amortiguación mejorada para un ajuste más cómodo y elegante.', 90.00, 'puma-rs-x.png', 3, 2, '2024-11-21 20:03:12', '2024-11-21 20:03:12'),
(34, 'New Balance 997H', 'Inspirada en el diseño clásico 997, la New Balance 997H presenta materiales modernos y una entresuela de espuma ligera para una comodidad superior. Esta zapatilla es perfecta para el uso diario y el estilo urbano.', 100.00, 'new-balance-997.png', 4, 2, '2024-11-21 20:03:12', '2024-11-21 20:03:12'),
(35, 'Converse Chuck Taylor All Star', 'Un verdadero clásico, el Converse Chuck Taylor All Star ha permanecido como un elemento básico del estilo casual durante décadas. Su icupper de lona icónica y su suela de goma lo convierten en una elección atemporal para los amantes de las zapatillas.', 60.00, 'converse-chuck.png', 5, 2, '2024-11-21 20:03:12', '2024-11-21 20:03:12'),
(36, 'Vans Old Skool', 'El Vans Old Skool es un símbolo de la cultura del skate y el estilo urbano. Con su duradera parte superior de gamuza y lona y su suela waffle característica, es imprescindible para los entusiastas de las zapatillas.', 85.00, 'vans-old-skool.png', 6, 2, '2024-11-21 20:03:12', '2024-11-21 20:03:12'),
(37, 'Reebok Club C 85', 'El Reebok Club C 85 trae el estilo vintage de la cancha de tenis a la moda moderna. Con una parte superior de cuero suave y una entresuela EVA cómoda, esta zapatilla ofrece estilo y soporte.', 60.00, 'reebok-club-c.png', 7, 2, '2024-11-21 20:03:12', '2024-11-21 20:03:12'),
(38, 'Asics Gel-Lyte III', 'El Asics Gel-Lyte III es conocido por su diseño de lengua dividida y comodidad excepcional. Esta zapatilla ofrece un equilibrio perfecto entre estilo retro y rendimiento de vanguardia.', 110.00, 'asics-gel.png', 8, 1, '2024-11-21 20:03:12', '2024-11-21 20:03:12'),
(39, 'Jordan 1 Retro High OG', 'Un símbolo de la historia del baloncesto y la moda urbana, el Jordan 1 Retro High OG ofrece un diseño atemporal y materiales premium. Con amortiguación Air-Sole, estas zapatillas son tan cómodas como elegantes.', 190.00, 'jordan-1-high-og.png', 9, 2, '2024-11-21 20:03:12', '2024-11-21 20:03:12'),
(40, 'Under Armour HOVR Phantom 2', 'El Under Armour HOVR Phantom 2 está diseñado para la comodidad y el rendimiento. Con amortiguación HOVR y una parte superior de tejido transpirable, estas zapatillas ofrecen un ajuste perfecto para cualquier actividad.', 50.00, 'under-phantom.png', 10, 2, '2024-11-21 20:03:12', '2024-11-21 20:03:12'),
(41, 'Nike React Infinity Run', 'La Nike React Infinity Run es ideal para corredores que buscan una mayor comodidad y soporte. Con una amortiguación React y una parte superior de malla, ofrece un ajuste ceñido y una sensación ligera.', 160.00, 'nike-infinity-run.png', 1, 1, '2024-11-21 20:03:12', '2024-11-21 20:03:12'),
(42, 'Adidas Ultraboost 21', 'El Adidas Ultraboost 21 es conocido por su comodidad excepcional y su estilo moderno. Con una parte superior Primeknit y una entresuela Boost, estas zapatillas son perfectas para cualquier actividad diaria.', 180.00, 'adidas-ultraboost-21.png', 2, 1, '2024-11-21 20:03:12', '2024-11-21 20:03:12'),
(43, 'Puma Future Rider', 'La Puma Future Rider es una combinación de estilo retro y tecnología moderna. Con su diseño ligero y suela de goma, estas zapatillas son ideales para un look casual y deportivo.', 100.00, 'puma-future-rider.png', 3, 1, '2024-11-21 20:03:12', '2024-11-21 20:03:12'),
(48, 'Nike Air Max 97', 'Las Nike Air Max 97 presentan una silueta aerodinámica con líneas fluidas inspiradas en el tren bala japonés. Incorporan la famosa tecnología Air Max para una amortiguación superior, junto con una parte superior de malla y materiales sintéticos para un ajuste cómodo y ventilado.', 180.00, '1732280786.jfif', 1, 2, '2024-11-22 13:04:05', '2024-11-22 13:06:26'),
(49, 'Puma RS-X', 'Las Puma RS-X son una combinación perfecta entre estilo retro y tecnología moderna. Con una suela gruesa y una parte superior de material textil y sintético, estas zapatillas ofrecen comodidad y un diseño llamativo, ideal para quienes buscan un look audaz y vanguardista.', 110.00, '1732280830.webp', 3, 2, '2024-11-22 13:04:05', '2024-11-22 13:07:10');

-- --------------------------------------------------------

--
-- Table structure for table `sneaker_sizes`
--

CREATE TABLE `sneaker_sizes` (
  `sneaker_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `stock` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sneaker_sizes`
--

INSERT INTO `sneaker_sizes` (`sneaker_id`, `size_id`, `stock`) VALUES
(31, 1, 10),
(31, 2, 10),
(31, 3, 10),
(31, 4, 10),
(31, 5, 10),
(31, 6, 10),
(31, 7, 10),
(31, 8, 10),
(31, 9, 10),
(31, 10, 10),
(31, 11, 10),
(31, 12, 10),
(31, 13, 10),
(31, 14, 10),
(31, 15, 10),
(31, 16, 10),
(31, 17, 10),
(31, 18, 10),
(31, 19, 10),
(31, 20, 10),
(31, 21, 10),
(31, 22, 10),
(31, 23, 10),
(31, 24, 10),
(31, 25, 10),
(31, 26, 10),
(31, 27, 10),
(31, 28, 10),
(31, 29, 10),
(32, 1, 10),
(32, 2, 10),
(32, 3, 10),
(32, 4, 10),
(32, 5, 10),
(32, 6, 10),
(32, 7, 10),
(32, 8, 10),
(32, 9, 10),
(32, 10, 10),
(32, 11, 10),
(32, 12, 10),
(32, 13, 10),
(32, 14, 10),
(32, 15, 10),
(32, 16, 10),
(32, 17, 10),
(32, 18, 10),
(32, 19, 10),
(32, 20, 10),
(32, 21, 10),
(32, 22, 10),
(32, 23, 10),
(32, 24, 10),
(32, 25, 10),
(32, 26, 10),
(32, 27, 10),
(32, 28, 10),
(32, 29, 10),
(33, 1, 10),
(33, 2, 10),
(33, 3, 10),
(33, 4, 10),
(33, 5, 10),
(33, 6, 10),
(33, 7, 10),
(33, 8, 10),
(33, 9, 10),
(33, 10, 10),
(33, 11, 10),
(33, 12, 10),
(33, 13, 10),
(33, 14, 10),
(33, 15, 10),
(33, 16, 10),
(33, 17, 10),
(33, 18, 10),
(33, 19, 10),
(33, 20, 10),
(33, 21, 10),
(33, 22, 10),
(33, 23, 10),
(33, 24, 10),
(33, 25, 10),
(33, 26, 10),
(33, 27, 10),
(33, 28, 10),
(33, 29, 10),
(34, 1, 10),
(34, 2, 10),
(34, 3, 10),
(34, 4, 10),
(34, 5, 10),
(34, 6, 10),
(34, 7, 10),
(34, 8, 10),
(34, 9, 10),
(34, 10, 10),
(34, 11, 10),
(34, 12, 10),
(34, 13, 10),
(34, 14, 10),
(34, 15, 10),
(34, 16, 10),
(34, 17, 10),
(34, 18, 10),
(34, 19, 10),
(34, 20, 10),
(34, 21, 10),
(34, 22, 10),
(34, 23, 10),
(34, 24, 10),
(34, 25, 10),
(34, 26, 10),
(34, 27, 10),
(34, 28, 10),
(34, 29, 10),
(35, 1, 10),
(35, 2, 10),
(35, 3, 10),
(35, 4, 10),
(35, 5, 10),
(35, 6, 10),
(35, 7, 10),
(35, 8, 10),
(35, 9, 10),
(35, 10, 10),
(35, 11, 10),
(35, 12, 10),
(35, 13, 10),
(35, 14, 10),
(35, 15, 10),
(35, 16, 10),
(35, 17, 10),
(35, 18, 10),
(35, 19, 10),
(35, 20, 10),
(35, 21, 10),
(35, 22, 10),
(35, 23, 10),
(35, 24, 10),
(35, 25, 10),
(35, 26, 10),
(35, 27, 10),
(35, 28, 10),
(35, 29, 10),
(36, 1, 10),
(36, 2, 10),
(36, 3, 10),
(36, 4, 10),
(36, 5, 10),
(36, 6, 10),
(36, 7, 10),
(36, 8, 10),
(36, 9, 10),
(36, 10, 10),
(36, 11, 10),
(36, 12, 10),
(36, 13, 10),
(36, 14, 10),
(36, 15, 10),
(36, 16, 10),
(36, 17, 10),
(36, 18, 10),
(36, 19, 10),
(36, 20, 10),
(36, 21, 10),
(36, 22, 10),
(36, 23, 10),
(36, 24, 10),
(36, 25, 10),
(36, 26, 10),
(36, 27, 10),
(36, 28, 10),
(36, 29, 10),
(37, 1, 10),
(37, 2, 10),
(37, 3, 10),
(37, 4, 10),
(37, 5, 10),
(37, 6, 10),
(37, 7, 10),
(37, 8, 10),
(37, 9, 10),
(37, 10, 10),
(37, 11, 10),
(37, 12, 10),
(37, 13, 10),
(37, 14, 10),
(37, 15, 10),
(37, 16, 10),
(37, 17, 10),
(37, 18, 10),
(37, 19, 10),
(37, 20, 10),
(37, 21, 10),
(37, 22, 10),
(37, 23, 10),
(37, 24, 10),
(37, 25, 10),
(37, 26, 10),
(37, 27, 10),
(37, 28, 10),
(37, 29, 10),
(38, 1, 10),
(38, 2, 10),
(38, 3, 10),
(38, 4, 10),
(38, 5, 10),
(38, 6, 10),
(38, 7, 10),
(38, 8, 10),
(38, 9, 10),
(38, 10, 10),
(38, 11, 10),
(38, 12, 10),
(38, 13, 10),
(38, 14, 10),
(38, 15, 10),
(38, 16, 10),
(38, 17, 10),
(38, 18, 10),
(38, 19, 10),
(38, 20, 10),
(38, 21, 10),
(38, 22, 10),
(38, 23, 10),
(38, 24, 10),
(38, 25, 10),
(38, 26, 10),
(38, 27, 10),
(38, 28, 10),
(38, 29, 10),
(39, 1, 10),
(39, 2, 10),
(39, 3, 10),
(39, 4, 10),
(39, 5, 10),
(39, 6, 10),
(39, 7, 10),
(39, 8, 10),
(39, 9, 10),
(39, 10, 10),
(39, 11, 10),
(39, 12, 10),
(39, 13, 10),
(39, 14, 10),
(39, 15, 10),
(39, 16, 10),
(39, 17, 10),
(39, 18, 10),
(39, 19, 10),
(39, 20, 10),
(39, 21, 10),
(39, 22, 10),
(39, 23, 10),
(39, 24, 10),
(39, 25, 10),
(39, 26, 10),
(39, 27, 10),
(39, 28, 10),
(39, 29, 10),
(40, 1, 10),
(40, 2, 10),
(40, 3, 10),
(40, 4, 10),
(40, 5, 10),
(40, 6, 10),
(40, 7, 10),
(40, 8, 10),
(40, 9, 10),
(40, 10, 10),
(40, 11, 10),
(40, 12, 10),
(40, 13, 10),
(40, 14, 10),
(40, 15, 10),
(40, 16, 10),
(40, 17, 10),
(40, 18, 10),
(40, 19, 10),
(40, 20, 10),
(40, 21, 10),
(40, 22, 10),
(40, 23, 10),
(40, 24, 10),
(40, 25, 10),
(40, 26, 10),
(40, 27, 10),
(40, 28, 10),
(40, 29, 10),
(41, 1, 10),
(41, 2, 10),
(41, 3, 10),
(41, 4, 10),
(41, 5, 10),
(41, 6, 10),
(41, 7, 10),
(41, 8, 10),
(41, 9, 10),
(41, 10, 10),
(41, 11, 10),
(41, 12, 10),
(41, 13, 10),
(41, 14, 10),
(41, 15, 10),
(41, 16, 10),
(41, 17, 10),
(41, 18, 10),
(41, 19, 10),
(41, 20, 10),
(41, 21, 10),
(41, 22, 10),
(41, 23, 10),
(41, 24, 10),
(41, 25, 10),
(41, 26, 10),
(41, 27, 10),
(41, 28, 10),
(41, 29, 10),
(42, 1, 10),
(42, 2, 10),
(42, 3, 10),
(42, 4, 10),
(42, 5, 10),
(42, 6, 10),
(42, 7, 10),
(42, 8, 10),
(42, 9, 10),
(42, 10, 10),
(42, 11, 10),
(42, 12, 10),
(42, 13, 10),
(42, 14, 10),
(42, 15, 10),
(42, 16, 10),
(42, 17, 10),
(42, 18, 10),
(42, 19, 10),
(42, 20, 10),
(42, 21, 10),
(42, 22, 10),
(42, 23, 10),
(42, 24, 10),
(42, 25, 10),
(42, 26, 10),
(42, 27, 10),
(42, 28, 10),
(42, 29, 10),
(43, 1, 10),
(43, 2, 10),
(43, 3, 10),
(43, 4, 10),
(43, 5, 10),
(43, 6, 10),
(43, 7, 10),
(43, 8, 10),
(43, 9, 10),
(43, 10, 10),
(43, 11, 10),
(43, 12, 10),
(43, 13, 10),
(43, 14, 10),
(43, 15, 10),
(43, 16, 10),
(43, 17, 10),
(43, 18, 10),
(43, 19, 10),
(43, 20, 10),
(43, 21, 10),
(43, 22, 10),
(43, 23, 10),
(43, 24, 10),
(43, 25, 10),
(43, 26, 10),
(43, 27, 10),
(43, 28, 10),
(43, 29, 10),
(48, 1, 3),
(48, 2, 4),
(48, 3, 6),
(48, 4, 0),
(48, 26, 5),
(48, 27, 8),
(48, 28, 1),
(49, 7, 5),
(49, 8, 5),
(49, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'agus-user@hotmail.com', 'agus-user', '$2y$10$QmwCu9JYNYRqm.1L7fUYrOBXaxFaMirWL8qlaTkr/wJqfJo0CTQBC', 1, '2024-11-15 12:35:05', '2024-11-15 13:25:23'),
(2, 'agus-admin@hotmail.com', 'agus-admin', '$2y$10$QTCo1uK.GKGfmruPfxlNFuZRx76DKzGeeAcJiLot0VE1eoEPB3RHG', 2, '2024-11-15 12:35:05', '2024-11-15 13:26:09'),
(3, 'agus-superadmin@hotmail.com', 'agus-superadmin', '$2y$10$n.vQ9xNnWuCWjSGYs5DVceP4TKIP1z9yIcoqQB/sxfTyRaR.aeS06', 3, '2024-11-15 12:35:05', '2024-11-15 13:26:21');

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE `views` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `active` tinyint(1) DEFAULT 1,
  `restricted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `views`
--

INSERT INTO `views` (`id`, `name`, `title`, `active`, `restricted`) VALUES
(1, 'home', 'Inicio', 1, 0),
(2, 'sneaker-list', 'Zapatillas', 1, 0),
(3, 'sneaker-detail', 'Detalle', 1, 0),
(4, 'contact', 'Contacto', 1, 0),
(5, 'student-data', 'Datos del alumno', 1, 0),
(6, '404', 'Pagina no encontrada', 1, 0),
(7, 'dashboard', 'Panel de administración', 1, 2),
(8, 'admin-brands', 'Administrar Marcas', 1, 2),
(9, 'admin-sneakers', 'Administrar Zapatillas', 1, 2),
(10, 'admin-categories', 'Administrar Categorías', 1, 2),
(12, 'edit-sneaker', 'Editar Zapatilla', 1, 2),
(13, 'create-sneaker', 'Crear Zapatilla', 1, 2),
(14, 'delete-sneaker', 'Eliminar Zapatilla', 1, 2),
(15, 'create-brand', 'Crear Marca', 1, 2),
(16, 'edit-brand', 'Editar Marca', 1, 2),
(17, 'delete-brand', 'Eliminar Marca', 1, 2),
(18, 'create-category', 'Crear Categoria', 1, 2),
(19, 'edit-category', 'Editar Categoria', 1, 2),
(20, 'delete-category', 'Eliminar Categoria', 1, 2),
(21, 'login', 'Iniciar Sesion', 1, 0),
(22, 'shipments', 'Envios', 1, 0),
(23, 'sneakers-by-brand', 'Zapatillas por marca', 1, 0),
(24, 'sneakers-by-category', 'Zapatillas por categoria', 1, 0);

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
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sneakers`
--
ALTER TABLE `sneakers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `sneaker_sizes`
--
ALTER TABLE `sneaker_sizes`
  ADD PRIMARY KEY (`sneaker_id`,`size_id`),
  ADD KEY `size_id` (`size_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `sneakers`
--
ALTER TABLE `sneakers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `views`
--
ALTER TABLE `views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sneakers`
--
ALTER TABLE `sneakers`
  ADD CONSTRAINT `sneakers_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `sneakers_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `sneaker_sizes`
--
ALTER TABLE `sneaker_sizes`
  ADD CONSTRAINT `sneaker_sizes_ibfk_1` FOREIGN KEY (`sneaker_id`) REFERENCES `sneakers` (`id`),
  ADD CONSTRAINT `sneaker_sizes_ibfk_2` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
