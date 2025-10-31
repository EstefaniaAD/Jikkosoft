-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-10-2025 a las 18:10:35
-- Versión del servidor: 10.11.0-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `test`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `biblioteca`
--

CREATE TABLE `biblioteca` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `id_categ` bigint(20) UNSIGNED NOT NULL,
  `estado` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `biblioteca`
--

INSERT INTO `biblioteca` (`id`, `nombre`, `descripcion`, `id_categ`, `estado`) VALUES
(1, 'Biblioteca 1', 'Descripción de la biblioteca 1', 1, 'A'),
(2, 'Biblioteca 2 cambio', 'descripción editada de la biblioteca 2', 2, 'A'),
(3, 'Biblioteca 3', 'Descripción de la biblioteca 3', 2, 'A'),
(4, 'blioteca borrar', 'biblioteca para borrar', 1, 'I');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `estado` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `estado`) VALUES
(1, 'Categoria 1', 'A'),
(2, 'Categoria 2', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE `libro` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_bibli` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `autor` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  `abstract` varchar(500) NOT NULL,
  `archivo` varchar(50) NOT NULL,
  `estado` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`id`, `id_bibli`, `titulo`, `autor`, `fecha`, `abstract`, `archivo`, `estado`) VALUES
(1, 2, '333', '3333', '0000-00-00', '33333', 'uploads/taller1.html', 'A'),
(2, 2, '222', '3333', '2025-10-02', '33333', 'uploads/tipos_de_graficos.pdf', 'A'),
(3, 2, '333', '3333', '0000-00-00', '33333', 'uploads/taller1.html', 'I'),
(4, 2, '333', '3333', '0000-00-00', '33333', 'uploads/taller1.html', 'A'),
(5, 3, 'libro 1', 'autor del libro 1', '0000-00-00', 'resumen del libro 1', 'uploads/taller2.html', 'A'),
(6, 2, 'nuevo', 'ddfaf', '2025-10-09', 'fdsfdasdf', 'uploads/Evidencia AA3-EV02.pdf', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pri_nombre` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seg_nombre` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pri_apell` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seg_apell` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `pri_nombre`, `seg_nombre`, `pri_apell`, `seg_apell`, `email`, `alias`, `fecha`) VALUES
(1, 'dfsadfa', 'adsfsadfsadf', 'false', 'false', 'sadfasd', 'false', '2025-10-31'),
(4, 'erff', 'oiupoip', 'ipo', 'ipi', 'pip', 'ijo', '2025-10-31');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `biblioteca`
--
ALTER TABLE `biblioteca`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_categ` (`id_categ`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_bibli` (`id_bibli`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `alias` (`alias`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `biblioteca`
--
ALTER TABLE `biblioteca`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `libro`
--
ALTER TABLE `libro`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `biblioteca`
--
ALTER TABLE `biblioteca`
  ADD CONSTRAINT `id_categ` FOREIGN KEY (`id_categ`) REFERENCES `biblioteca` (`id`);

--
-- Filtros para la tabla `libro`
--
ALTER TABLE `libro`
  ADD CONSTRAINT `id_bibli` FOREIGN KEY (`id_bibli`) REFERENCES `biblioteca` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
