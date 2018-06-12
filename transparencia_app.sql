-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-06-2018 a las 19:49:51
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
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `id_numeral` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `status` int(11) NOT NULL,
  `aviso` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `id_numeral`, `descripcion`, `status`, `aviso`) VALUES
(26, 13, 'Normativo', 0, ''),
(31, 5, 'situación', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id` int(11) NOT NULL,
  `nombres` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id`, `nombres`) VALUES
(1, 'Informatica'),
(6, 'Inversiones'),
(7, 'Estadística'),
(8, 'Prestaciones'),
(9, 'Legal'),
(10, 'Bienestar Social'),
(11, 'Auditoria'),
(12, 'Administrativo'),
(13, 'Inversiones'),
(14, 'Recursos Humanos'),
(15, 'Planificación'),
(16, 'Proveeduria'),
(17, 'UDAF'),
(18, 'Ingeniería'),
(22, 'situación');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_departamento` int(11) NOT NULL,
  `id_numeral` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `year` int(11) NOT NULL,
  `mes` text NOT NULL,
  `url_doc` text NOT NULL,
  `n_doc` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `justificacion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id` int(11) NOT NULL,
  `remitente` int(11) NOT NULL,
  `receptor` int(11) NOT NULL,
  `contenido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `numerales`
--

CREATE TABLE `numerales` (
  `id` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `status` int(11) NOT NULL,
  `aviso` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `numerales`
--

INSERT INTO `numerales` (`id`, `descripcion`, `status`, `aviso`) VALUES
(5, 'ESTRUCTURA ORGÁNICA Y FUNCIONES', 0, ''),
(6, 'DIRECCIÓN Y TELÉFONOS DE LA ENTIDAD', 0, ''),
(7, 'DIRECTORIO DE EMPLEADOS Y SERVIDORES PÚBLICOS', 0, ''),
(11, 'NÚMERO Y NOMBRE DE FUNCIONARIOS', 0, ''),
(12, 'MISIÓN Y OBJETIVOS DE LA INSTITUCIÓN', 0, ''),
(13, 'MANUALES DE PROCEDIMIENTOS', 0, '');

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
  `rol` text NOT NULL,
  `intentos` int(11) NOT NULL,
  `pregunta_seguridad` text NOT NULL,
  `respuesta_seguridad` text NOT NULL,
  `id_departamento` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `usuario`, `password`, `email`, `foto`, `rol`, `intentos`, `pregunta_seguridad`, `respuesta_seguridad`, `id_departamento`) VALUES
(48, 'Ariel Fernando', 'Salvador Mejia', 'asalvador', '$2y$10$TEdQe7HI5NzIq5pJkBect.ZPpSRWl59pfGfvonT..Nu8AdP4L5H52', 'asalvador@ipm.org.gt', 'views/images/user.png', 'admin', 0, 'entendi la ...', 'referencia', 1),
(51, 'Oscar Ruben', 'Colindres Ochoa', 'ocolindres', '$2y$10$WAoJbSFrXZPbPzknSYell.lXsenkQx7U0JDvEt3aUninIXlJSSBba', 'ocolindres@ipm.org.gt', 'views/images/avatar.png', 'redactor', 0, 'puesto', 'encargadodesoftware', 1),
(52, 'Kevin Andre', 'Carcamo Raudales', 'kcarcamo', '$2y$10$VpRcxYAizGzhC5w.ln2.EeRGJRiFSaqUFmZc1jscCpL4ZIXlsmv9m', 'kcarcamo@ipm.org.gt', 'views/images/avatar.png', 'redactor', 0, 'puesto', 'programador', 1),
(53, 'Oscar', 'Pacheco Tzorin', 'opacheco', '$2y$10$3hXb856l9JqQ.Y8lNC7CRe7SgMDvcR1WUZPI8a3QoW/FqAn2F90.W', 'opacheco@ipm.org.gt', 'views/images/avatar.png', 'redactor', 0, 'puesto', 'dba', 1),
(55, 'Cesar', 'Vargas', 'cvargas', '$2y$10$1I2qx5sKWoHHOU3fkCbIE.HwJ4oZi.QhsDZLPPC7R9RF2T41YoQgG', 'cvargas@ipm.org.gt', 'views/images/avatar.png', 'redactor', 0, 'puesto', 'programador', 1),
(63, 'Marlon Baldemar', 'Martínez Zuñiga', 'mmartinez', '$2y$10$0vrC8JmjS1Wbuy7Qya5jM.3YshP2ybJfatTlkhPbWP0A5VuO4AKV2', 'mmartinez@ipm.org.gt', 'views/images/avatar.png', 'redactor', 0, 'Puesto', 'Programador', 1),
(64, 'Edgar', 'Urizar', 'eurizar', '$2y$10$G61P2fCXwxwm3/oAOmkx5eEV4UdqQzSTBAJHvr1FbPcTfMaoOFRTa', 'eurizar@ipm.org.gt', 'views/images/avatar.png', 'redactor', 0, 'Puesto', 'Jefe de Recursos Humanos', 14),
(65, 'Nelson', 'Boche', 'nboche', '$2y$10$MSuL/9Tj50UK/kALpdEt2eliLjw94HdVWGZ2.O3uasgbH5jpxtmZO', 'nboche@ipm.org.gt', 'views/images/avatar.png', 'jefeRedaccion', 0, 'Puesto', 'Sub jefe de Informatica', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vitacora`
--

CREATE TABLE `vitacora` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `desc_actividad` text NOT NULL,
  `fecha` date NOT NULL,
  `hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_numeral` (`id_numeral`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_numeral` (`id_numeral`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_departamento` (`id_departamento`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `numerales`
--
ALTER TABLE `numerales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_departamento` (`id_departamento`);

--
-- Indices de la tabla `vitacora`
--
ALTER TABLE `vitacora`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `numerales`
--
ALTER TABLE `numerales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT de la tabla `vitacora`
--
ALTER TABLE `vitacora`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `categorias_ibfk_1` FOREIGN KEY (`id_numeral`) REFERENCES `numerales` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `documentos_ibfk_1` FOREIGN KEY (`id_numeral`) REFERENCES `numerales` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `documentos_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `documentos_ibfk_3` FOREIGN KEY (`id_departamento`) REFERENCES `departamentos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_departamento`) REFERENCES `departamentos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `vitacora`
--
ALTER TABLE `vitacora`
  ADD CONSTRAINT `vitacora_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
