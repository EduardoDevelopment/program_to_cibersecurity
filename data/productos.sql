-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-07-2023 a las 04:42:35
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `lunchtime`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipo` text NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `descuento` tinyint(4) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `tipo`, `descripcion`, `precio`, `descuento`, `id_categoria`, `activo`) VALUES
(1, 'Quesadilla de jamón', 'Desayuno', '<h2 class=\"text-2xl font-bold my-2\">Ingredientes</h2>\r\n<ul class=\"list-disc ml-5 my-2\">\r\n    <li>Jamón</li>\r\n    <li>Queso</li>\r\n    <li>Tortillas de maíz</li>\r\n</ul>', 26, 0, 1, 1),
(2, 'Quesadilla de queso de puerco', 'Desayuno', '<h2 class=\"text-2xl font-bold my-2\">Ingredientes</h2>\r\n<ul class=\"list-disc ml-5 my-2\">\r\n    <li>Queso de puerco</li>\r\n    <li>Tortillas de maíz</li>\r\n</ul>', 26, 0, 1, 1),
(3, 'Quesadilla de bistec', 'Desayuno', '<h2 class=\"text-2xl font-bold my-2\">Ingredientes</h2>\r\n<ul class=\"list-disc ml-5 my-2\">\r\n    <li>Bistec</li>\r\n    <li>Queso</li>\r\n    <li>Tortillas de maíz</li>\r\n</ul>', 39, 0, 1, 1),
(4, 'Quesadilla de pollo', 'Desayuno', '<h2 class=\"text-2xl font-bold my-2\">Ingredientes</h2>\r\n<ul class=\"list-disc ml-5 my-2\">\r\n    <li>Pollo</li>\r\n    <li>Queso</li>\r\n    <li>Tortillas de maíz</li>\r\n</ul>', 39, 0, 1, 1),
(5, 'Quesadilla de adobada', 'Desayuno', '<h2 class=\"text-2xl font-bold my-2\">Ingredientes</h2>\r\n<ul class=\"list-disc ml-5 my-2\">\r\n    <li>Carne adobada</li>\r\n    <li>Queso</li>\r\n    <li>Tortillas de maíz</li>\r\n</ul>', 39, 0, 1, 1),
(6, 'Torta de jamón', 'Desayuno', '<h2 class=\"text-2xl font-bold my-2\">Ingredientes</h2>\r\n<ul class=\"list-disc ml-5 my-2\">\r\n    <li>Jamón</li>\r\n    <li>Pan para torta</li>\r\n    <li>Vegetales (lechuga, tomate, cebolla, etc.)</li>\r\n    <li>Mayonesa</li>\r\n</ul>', 32, 0, 1, 1),
(7, 'Torta de queso de puerco', 'Desayuno', '<h2 class=\"text-2xl font-bold my-2\">Ingredientes</h2>\r\n<ul class=\"list-disc ml-5 my-2\">\r\n    <li>Queso de puerco</li>\r\n    <li>Pan para torta</li>\r\n    <li>Vegetales (lechuga, tomate, cebolla, etc.)</li>\r\n    <li>Mayonesa</li>\r\n</ul>', 32, 0, 1, 1),
(8, 'Torta de queso de puerco', 'Desayuno', '<h2 class=\"text-2xl font-bold my-2\">Ingredientes</h2>\r\n<ul class=\"list-disc ml-5 my-2\">\r\n    <li>Queso de puerco</li>\r\n    <li>Pan para torta</li>\r\n    <li>Vegetales (lechuga, tomate, cebolla, etc.)</li>\r\n    <li>Mayonesa</li>\r\n</ul>', 42, 0, 1, 1),
(9, 'Torta de adobada', 'Desayuno', '<h2 class=\"text-2xl font-bold my-2\">Ingredientes</h2>\r\n<ul class=\"list-disc ml-5 my-2\">\r\n    <li>Carne adobada</li>\r\n    <li>Pan para torta</li>\r\n    <li>Vegetales (lechuga, tomate, cebolla, etc.)</li>\r\n    <li>Mayonesa</li>\r\n</ul>', 42, 0, 1, 1),
(10, 'Torta de bistec', 'Desayuno', '<h2 class=\"text-2xl font-bold my-2\">Ingredientes</h2>\r\n<ul class=\"list-disc ml-5 my-2\">\r\n    <li>Bistec</li>\r\n    <li>Pan para torta</li>\r\n    <li>Vegetales (lechuga, tomate, cebolla, etc.)</li>\r\n    <li>Mayonesa</li>\r\n</ul>', 42, 0, 1, 1),
(11, 'Torta de pollo', 'Desayuno', '<h2 class=\"text-2xl font-bold my-2\">Ingredientes</h2>\r\n<ul class=\"list-disc ml-5 my-2\">\r\n    <li>Pollo</li>\r\n    <li>Pan para torta</li>\r\n    <li>Vegetales (lechuga, tomate, cebolla, etc.)</li>\r\n    <li>Mayonesa</li>\r\n</ul>', 32, 0, 1, 1),
(12, 'Sandwich de jamón', 'Desayuno', '<h2 class=\"text-2xl font-bold my-2\">Ingredientes</h2>\r\n<ul class=\"list-disc ml-5 my-2\">\r\n    <li>Jamón</li>\r\n    <li>Pan de molde</li>\r\n    <li>Queso</li>\r\n    <li>Vegetales (lechuga, tomate, etc.)</li>\r\n    <li>Mayonesa</li>\r\n    <li>Mostaza (opcional)</li>\r\n</ul>', 29, 0, 1, 1),
(13, 'Sandwich de queso de puerco', 'Desayuno', '<h2 class=\"text-2xl font-bold my-2\">Ingredientes</h2>\r\n<ul class=\"list-disc ml-5 my-2\">\r\n    <li>Queso de puerco</li>\r\n    <li>Pan de molde</li>\r\n    <li>Vegetales (lechuga, tomate, etc.)</li>\r\n    <li>Mayonesa</li>\r\n    <li>Mostaza (opcional)</li>\r\n</ul>', 29, 0, 1, 1),
(14, 'Sandwich de pollo', 'Desayuno', '<h2 class=\"text-2xl font-bold my-2\">Ingredientes</h2>\r\n<ul class=\"list-disc ml-5 my-2\">\r\n    <li>Pollo</li>\r\n    <li>Pan de molde</li>\r\n    <li>Queso</li>\r\n    <li>Vegetales (lechuga, tomate, etc.)</li>\r\n    <li>Mayonesa</li>\r\n    <li>Mostaza (opcional)</li>\r\n</ul>', 41, 0, 1, 1),
(15, 'Sandwich de bistec', 'Desayuno', '<h2 class=\"text-2xl font-bold my-2\">Ingredientes</h2>\r\n<ul class=\"list-disc ml-5 my-2\">\r\n    <li>Bistec</li>\r\n    <li>Pan de molde</li>\r\n    <li>Queso</li>\r\n    <li>Vegetales (lechuga, tomate, etc.)</li>\r\n    <li>Mayonesa</li>\r\n    <li>Mostaza (opcional)</li>\r\n</ul>', 41, 0, 1, 1),
(16, 'Sandwich de adobada', 'Desayuno', '<h2 class=\"text-2xl font-bold my-2\">Ingredientes</h2>\r\n<ul class=\"list-disc ml-5 my-2\">\r\n    <li>Carne adobada</li>\r\n    <li>Pan de molde</li>\r\n    <li>Queso</li>\r\n    <li>Vegetales (lechuga, tomate, etc.)</li>\r\n    <li>Mayonesa</li>\r\n    <li>Mostaza (opcional)</li>\r\n</ul>', 41, 0, 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
