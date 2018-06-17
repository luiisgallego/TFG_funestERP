-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-06-2018 a las 15:07:19
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `funesterp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agenda`
--

CREATE TABLE `agenda` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `start` datetime NOT NULL,
  `allDay` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `agenda`
--

INSERT INTO `agenda` (`id`, `title`, `start`, `allDay`) VALUES
(11, 'EVENTO 1', '2018-05-30 00:00:00', 1),
(12, 'EVENTO 2', '2018-06-12 00:00:00', 1),
(13, 'EVENTO 3', '2018-06-20 12:00:00', 0),
(15, 'EVENTO 4', '2018-06-30 14:00:00', 0),
(16, 'Avisar a ...', '2018-06-09 00:00:00', 1),
(17, 'Llamar a ...', '2018-06-05 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dni` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `poblacion` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigo_postal` varchar(5) COLLATE utf8_unicode_ci DEFAULT '0',
  `telefono` varchar(9) COLLATE utf8_unicode_ci DEFAULT '0',
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT '0',
  `cuenta_bancaria` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `nombre`, `dni`, `direccion`, `poblacion`, `codigo_postal`, `telefono`, `email`, `cuenta_bancaria`) VALUES
(1, 'Alfonso Heredia', '77375026H', 'Salmeron 48', 'Porcuna', '23790', '663791200', 'lgaq@gmail.com', '7777778888'),
(20, 'nombre cliente', '77375025J', 'direccion ', 'poblacion', '23798', '663791205', 'lgaq94@hotmail.com', '2147483647'),
(21, 'prueba 2', '79878979', 'p2', 'p2', '84', '5315616', 'p2p2p2p2@gmaill.com', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `difunto`
--

CREATE TABLE `difunto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dni` text COLLATE utf8_unicode_ci,
  `sexo` enum('Hombre','Mujer') COLLATE utf8_unicode_ci DEFAULT NULL,
  `poblacion` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `provincia` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `calle` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numero` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigo_postal` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `estado_civil` enum('Casado','Viudo','Soltero','') COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre_pareja` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hijo_de` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `poblacion2` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hijo_de2` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `poblacion3` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `difunto`
--

INSERT INTO `difunto` (`id`, `nombre`, `dni`, `sexo`, `poblacion`, `provincia`, `calle`, `numero`, `codigo_postal`, `fecha_nacimiento`, `estado_civil`, `nombre_pareja`, `hijo_de`, `poblacion2`, `hijo_de2`, `poblacion3`) VALUES
(1, 'Manuel Heredia Jurado', '77375066P', 'Hombre', 'Porcuna', 'Jaen', 'Salmerón', '48', '23790', '1964-03-20', 'Viudo', 'Nothing', 'Luis', 'Porcuna', 'Chelo', 'Porcuna'),
(15, 'Prueba', '77375025N', 'Hombre', 'Valenzuela', 'provincia', 'calle', '58', '23790', '2018-05-10', 'Casado', 'nombre pareja', 'hijo de ', 'natural de', ' y de ', 'natural de'),
(26, 'Prueba 2', '77777777', 'Hombre', 'p2', 'p2', 'p2', '48', '23790', '2018-05-10', 'Casado', 'p2', 'p2', 'p2', 'p2', 'p2'),
(28, 'Prueba 3', '', 'Hombre', '', '', '', '0', '0', '0000-00-00', 'Casado', '', '', '', '', ''),
(29, 'Prueba 4', '', 'Hombre', '', '', '', '0', '0', '1111-11-11', 'Casado', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `difunto_cliente`
--

CREATE TABLE `difunto_cliente` (
  `id` int(11) NOT NULL,
  `id_dif` int(11) NOT NULL,
  `id_cli` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `difunto_cliente`
--

INSERT INTO `difunto_cliente` (`id`, `id_dif`, `id_cli`) VALUES
(5, 1, 1),
(19, 15, 20),
(20, 26, 21),
(27, 28, 21),
(31, 29, 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `difunto_facturas`
--

CREATE TABLE `difunto_facturas` (
  `id_fact` int(11) NOT NULL,
  `id_dif` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `total` double NOT NULL,
  `emitida` tinyint(1) NOT NULL DEFAULT '0',
  `cobrada` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `difunto_facturas`
--

INSERT INTO `difunto_facturas` (`id_fact`, `id_dif`, `fecha`, `total`, `emitida`, `cobrada`) VALUES
(8, 1, '2018-06-22', 2500, 1, 1),
(9, 15, '2018-05-22', 2800, 0, 0),
(10, 26, '2018-03-23', 2790, 0, 0),
(11, 28, '2018-06-21', 1850, 0, 0),
(12, 29, '2018-06-06', 1650, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `difunto_familiares`
--

CREATE TABLE `difunto_familiares` (
  `id_fam` int(11) NOT NULL,
  `id_dif` int(11) NOT NULL,
  `esquela` tinyint(1) NOT NULL,
  `r_misa` tinyint(1) NOT NULL,
  `r_sin_misa` tinyint(1) NOT NULL,
  `esquela_emitida` tinyint(1) NOT NULL DEFAULT '0',
  `misa_emitida` tinyint(1) NOT NULL DEFAULT '0',
  `recordatoria_emitida` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `difunto_familiares`
--

INSERT INTO `difunto_familiares` (`id_fam`, `id_dif`, `esquela`, `r_misa`, `r_sin_misa`, `esquela_emitida`, `misa_emitida`, `recordatoria_emitida`) VALUES
(5, 1, 1, 1, 0, 0, 0, 0),
(15, 15, 1, 1, 0, 1, 0, 0),
(19, 26, 1, 1, 0, 1, 1, 0),
(20, 28, 1, 1, 0, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id` int(11) NOT NULL,
  `id_fact` int(11) NOT NULL,
  `concepto` varchar(100) NOT NULL,
  `importe` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`id`, `id_fact`, `concepto`, `importe`) VALUES
(50, 9, 'concepto 1', 100),
(51, 9, 'concepto 2', 200),
(52, 9, 'concepto 3', 300),
(53, 9, 'concepto 4', 400),
(54, 9, 'concepto 5', 500),
(55, 9, 'concepto 6', 600),
(56, 9, 'concepto 7', 700),
(63, 11, 'concep 3', 100),
(64, 11, 'concep 3concep 3concep 3', 250),
(65, 11, 'concep 3concep 3', 300),
(66, 11, 'concep 3concep 3', 150),
(67, 11, 'concep 3', 250),
(68, 11, 'concep 3concep 3', 800),
(69, 10, 'conceptop2', 1100),
(70, 10, 'conceptop2conceptop2', 150),
(71, 10, 'conceptop2', 250),
(72, 10, 'conceptop2conceptop2conceptop2', 50),
(73, 10, 'conceptop2conceptop2', 790),
(74, 10, 'conceptop2', 450),
(75, 12, 'prueba 4 concepto', 150),
(76, 12, 'prueba 4 concepto', 250),
(77, 12, 'prueba 4 concepto', 350),
(78, 12, 'prueba 4 concepto', 400),
(79, 12, 'prueba 4 concepto', 500),
(93, 8, 'Concepto 1', 1000),
(94, 8, 'Concepto 2', 300),
(95, 8, 'Concepto 3', 450),
(96, 8, 'Concepto 4', 600),
(97, 8, 'Concepto 5', 150);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familiares`
--

CREATE TABLE `familiares` (
  `id` int(11) NOT NULL,
  `id_fam` int(11) NOT NULL,
  `rol` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `nombres` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `familiares`
--

INSERT INTO `familiares` (`id`, `id_fam`, `rol`, `nombres`) VALUES
(91, 15, 'rol 1', 'nombre 1, nombre 2, nombre 3'),
(92, 15, 'rol 2', 'nombre 4'),
(93, 15, 'rol 3', 'nombre 5'),
(94, 15, 'rol 4', 'nombre 6'),
(95, 15, 'rol 5', 'nombre 7, nombre 8'),
(104, 19, 'rolp2', 'nomp2'),
(105, 19, 'rolp2rolp2', 'nomp2nomp2'),
(106, 19, 'rolp2rolp2', 'nomp2nomp2nomp2'),
(107, 19, 'rolp2', 'nomp2'),
(108, 19, 'rolp2rolp2', 'nomp2nomp2'),
(109, 20, 'rolp3', 'nomp3'),
(110, 20, 'rolp3rolp3', 'nomp3nomp3'),
(111, 20, 'rolp3', 'nomp3'),
(112, 20, 'rolp3rolp3', 'nomp3nomp3'),
(115, 15, 'DD', 'DD'),
(129, 5, 'Hijos', 'Antonio y Elena Heredia'),
(130, 5, 'Hermanos', 'Jose  y Benito'),
(131, 5, 'Sobrinos', 'Miguel y Maria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id` int(11) NOT NULL,
  `id_dif` int(11) NOT NULL,
  `fecha_defuncion` date DEFAULT NULL,
  `hora_defuncion` time DEFAULT NULL,
  `fecha_entierro` date DEFAULT NULL,
  `hora_entierro` time DEFAULT NULL,
  `poblacion_entierro` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_misa` date DEFAULT NULL,
  `hora_misa` time DEFAULT NULL,
  `tanatorio` enum('No','Sala 1','Sala 2','Sala 3') COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo_servicio` enum('Particular','Compañia','Recepción','Tanatorio') COLLATE utf8_unicode_ci DEFAULT NULL,
  `compañia` enum('Preventiva','Santa Lucía','Mapre','No') COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id`, `id_dif`, `fecha_defuncion`, `hora_defuncion`, `fecha_entierro`, `hora_entierro`, `poblacion_entierro`, `fecha_misa`, `hora_misa`, `tanatorio`, `tipo_servicio`, `compañia`) VALUES
(1, 1, '2018-04-19', '07:15:00', '2018-04-20', '16:00:00', 'Porcuna', '2018-04-25', '18:00:00', 'Sala 3', 'Particular', 'No'),
(8, 15, '2018-05-10', '00:01:00', '2018-05-10', '03:57:00', 'poblacion entierro', '2018-06-16', '00:56:00', 'Sala 2', 'Recepción', 'No'),
(9, 26, '2018-05-10', '22:00:00', '2018-05-11', '23:59:00', 'p2p2', '2018-04-30', '00:59:00', 'No', 'Particular', 'No'),
(11, 28, '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', 'Procuna', '0000-00-00', '00:00:00', 'No', 'Particular', 'No'),
(12, 29, '1111-11-11', '00:00:00', '1111-11-11', '00:00:00', 'Prueba4', '1111-11-11', '00:00:00', 'No', 'Particular', 'No'),
(50, 15, '1111-11-11', '00:00:00', '1111-11-11', '00:00:00', 'DDD', '1111-11-11', '00:00:00', 'No', 'Particular', 'No');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` text,
  `pass` varchar(50) NOT NULL,
  `rol` enum('admin','empleado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `pass`, `rol`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(8, 'luis', '7537e9b36fc21ae60ad6755eac9a5b61', 'empleado');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `difunto`
--
ALTER TABLE `difunto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `difunto_cliente`
--
ALTER TABLE `difunto_cliente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_dif` (`id_dif`),
  ADD KEY `id_cli` (`id_cli`);

--
-- Indices de la tabla `difunto_facturas`
--
ALTER TABLE `difunto_facturas`
  ADD PRIMARY KEY (`id_fact`),
  ADD KEY `id_dif` (`id_dif`);

--
-- Indices de la tabla `difunto_familiares`
--
ALTER TABLE `difunto_familiares`
  ADD PRIMARY KEY (`id_fam`),
  ADD KEY `id_dif` (`id_dif`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_fact` (`id_fact`);

--
-- Indices de la tabla `familiares`
--
ALTER TABLE `familiares`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_fam` (`id_fam`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_dif` (`id_dif`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `difunto`
--
ALTER TABLE `difunto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `difunto_cliente`
--
ALTER TABLE `difunto_cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `difunto_facturas`
--
ALTER TABLE `difunto_facturas`
  MODIFY `id_fact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `difunto_familiares`
--
ALTER TABLE `difunto_familiares`
  MODIFY `id_fam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT de la tabla `familiares`
--
ALTER TABLE `familiares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `difunto_cliente`
--
ALTER TABLE `difunto_cliente`
  ADD CONSTRAINT `difunto_cliente_ibfk_1` FOREIGN KEY (`id_dif`) REFERENCES `difunto` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `difunto_cliente_ibfk_2` FOREIGN KEY (`id_cli`) REFERENCES `cliente` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `difunto_facturas`
--
ALTER TABLE `difunto_facturas`
  ADD CONSTRAINT `difunto_facturas_ibfk_1` FOREIGN KEY (`id_dif`) REFERENCES `difunto` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `difunto_familiares`
--
ALTER TABLE `difunto_familiares`
  ADD CONSTRAINT `difunto_familiares_ibfk_1` FOREIGN KEY (`id_dif`) REFERENCES `difunto` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_ibfk_1` FOREIGN KEY (`id_fact`) REFERENCES `difunto_facturas` (`id_fact`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `familiares`
--
ALTER TABLE `familiares`
  ADD CONSTRAINT `familiares_ibfk_1` FOREIGN KEY (`id_fam`) REFERENCES `difunto_familiares` (`id_fam`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD CONSTRAINT `servicio_ibfk_1` FOREIGN KEY (`id_dif`) REFERENCES `difunto` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
