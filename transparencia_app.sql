-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-04-2018 a las 00:33:16
-- Versión del servidor: 10.1.29-MariaDB
-- Versión de PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `transparencia_app`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombres` text NOT NULL,
  `apellidos` text NOT NULL,
  `usuario` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `foto` text NOT NULL,
  `rol` int(11) NOT NULL,
  `intentos` int(11) NOT NULL,
  `pregunta_seguridad` text NOT NULL,
  `respuesta_seguridad` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `usuario`, `password`, `email`, `foto`, `rol`, `intentos`, `pregunta_seguridad`, `respuesta_seguridad`) VALUES
(1, 'Ariel Fernando', 'Salvador Mejia', 'asalvador', 'mvcpoophp7', 'asalvador@ipm.org.gt', 'https://lh3.googleusercontent.com/E_uwdhqJCgddahv-_WiptqiNgZl1HSIEBXaFXn3TzZ9ZWmhO_FT3S56uXXl5pdgNGw2_Mw2K-Sfbx0x2j3cM9S4h6MuMspTo36shFSRcZfCyziquDHVxk2_Onb6Nv4No8A5U0EkXFnQSCHNBcVcmUqPOpwvzjJYs8nhi-N-B4DuM92sBE2VQQ7lZxawa6MpDVMFOgOEnyK6uPZZ5lMuCK6YljIOqViMC9I4qILeM-xo8JvEmn_K9T3Wa047HtYUtUY3LllePpRfy9zdZj-wRhXchYYKGSv1trckCWETbbLtc7ZtslHk0fPxBMkO2K-A8Kff3I2obugNr4SMDenhWuCQ3r_oizfkODxyiWZ-gT8DR-8Ncm4CMGEhEqESUoYnBMUd3X5bCbj7V10T8TWEa6Z3ie8swmUQKH-1cL10oqiEZiNxvMsLBaLUjp8ZOZhdmDIDyEdsfOlmUGoRSt9MDgvPUMzJzPTN3OwJTw-TdjpY-z9MZrVSOTzwPpSuYqr7MEMZX7GVCbuBFGz_YXmsvUCPmgP2SYAjtRHx2FAa8oPa7G3ArdJFHHXOD_JkAluKDa6_SPeO-mDQeEqHM1abtE1RLvfYKTapaN7v9MQ=w218-h220-no', 2, 0, 'entendí esa ...', 'referencia');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
