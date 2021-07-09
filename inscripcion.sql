-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-07-2021 a las 05:11:58
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inscripcion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcion`
--

CREATE TABLE `inscripcion` (
  `ID_PERIODO` int(11) NOT NULL,
  `ID_ACTIVIDAD` smallint(6) NOT NULL,
  `ID_INSTRUCTOR` smallint(6) NOT NULL,
  `ID_GRUPO` int(11) NOT NULL,
  `ID_AREA` int(11) NOT NULL,
  `NUM_CONTROL` bigint(20) NOT NULL,
  `CALIFICACION` tinyint(4) DEFAULT NULL,
  `ID_CARRERA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `inscripcion`
--

INSERT INTO `inscripcion` (`ID_PERIODO`, `ID_ACTIVIDAD`, `ID_INSTRUCTOR`, `ID_GRUPO`, `ID_AREA`, `NUM_CONTROL`, `CALIFICACION`, `ID_CARRERA`) VALUES
(1, 2, 5, 404, 5, 18930203, 8, 2),
(2, 3, 6, 405, 6, 18930190, 10, 3),
(3, 1, 4, 401, 4, 18930204, 9, 1),
(4, 4, 7, 403, 7, 18930090, 7, 4),
(5, 5, 8, 256, 8, 18931215, 10, 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD KEY `FK_REFERENCE_12` (`ID_PERIODO`),
  ADD KEY `FK_REFERENCE_13` (`ID_ACTIVIDAD`),
  ADD KEY `FK_REFERENCE_14` (`ID_INSTRUCTOR`),
  ADD KEY `FK_REFERENCE_16` (`ID_GRUPO`),
  ADD KEY `FK_REFERENCE_17` (`ID_AREA`),
  ADD KEY `FK_REFERENCE_23` (`NUM_CONTROL`),
  ADD KEY `fk_INSCRIPCION_CARRERA1_idx` (`ID_CARRERA`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
