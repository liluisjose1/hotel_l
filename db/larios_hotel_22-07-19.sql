-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-07-2019 a las 17:07:17
-- Versión del servidor: 10.3.16-MariaDB
-- Versión de PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `larios_hotel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_habitaciones`
--

CREATE TABLE `cat_habitaciones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cat_habitaciones`
--

INSERT INTO `cat_habitaciones` (`id`, `nombre`) VALUES
(1, 'DELUXE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `check_in`
--

CREATE TABLE `check_in` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_hab` varchar(20) NOT NULL,
  `p_dia` decimal(20,2) NOT NULL,
  `dias` int(11) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `pagado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `check_in`
--

INSERT INTO `check_in` (`id`, `id_cliente`, `id_hab`, `p_dia`, `dias`, `fecha_ingreso`, `pagado`) VALUES
(1, 1, 'HAB-DEX-001', '20.00', 1, '2019-07-20', 1),
(2, 1, 'HAB-DEX-001', '20.00', 1, '2019-07-20', 1),
(3, 1, 'HAB-DEX-001', '25.00', 1, '2019-07-22', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `doc` varchar(50) DEFAULT NULL,
  `tel` varchar(12) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  `hospedado` tinyint(1) DEFAULT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `doc`, `tel`, `estado`, `hospedado`, `fecha`) VALUES
(1, 'Juan Perez', '000255', '76055166', 1, 1, '2019-07-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `ruta_img` varchar(50) NOT NULL,
  `tel` varchar(12) NOT NULL,
  `direccion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `nombre`, `ruta_img`, `tel`, `direccion`) VALUES
(1, 'Hard Rock', 'assets/images/59db6cdf3752880e93e16f13.png', '50376993169', 'Barrio el Centro Chiri');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id_registro` int(11) NOT NULL,
  `id_factura` varchar(9) NOT NULL,
  `tipo_factura` smallint(3) NOT NULL,
  `cliente` varchar(50) NOT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `nit` varchar(15) DEFAULT NULL,
  `n_registro` varchar(9) DEFAULT NULL,
  `cantidad` int(2) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `p_unitario` decimal(6,2) NOT NULL,
  `iva` decimal(6,2) DEFAULT NULL,
  `total` decimal(6,2) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`id_registro`, `id_factura`, `tipo_factura`, `cliente`, `direccion`, `nit`, `n_registro`, `cantidad`, `descripcion`, `p_unitario`, `iva`, `total`, `fecha`) VALUES
(1, '0851', 1, 'SABRITAS Y CIA EN C DE C.V', NULL, NULL, NULL, 1, 'Servicio de Hotel', '25.00', NULL, '25.00', '2019-07-20'),
(2, '0056', 2, 'SABRITAS Y CIA EN C DE C.V', 'Finca Santa Elena Antuguo Cuscatlan', '1614-090694-105', '79894-0', 1, 'Servicio de Hotel', '22.12', '2.88', '25.00', '2019-07-20'),
(4, '0857', 2, 'SABRITAS Y CIA EN C DE C.V	', 'Finca Santa Elena Antuguo Cuscatlan	', '1614-090694-105', '79894', 1, 'Servicio de Hotel	', '300.00', '39.00', '339.00', '2019-07-21'),
(5, '0858', 2, 'SABRITAS Y CIA EN C DE C.V	', 'Finca Santa Elena Antuguo Cuscatlan	', '1614-090694-105', '79894', 1, 'Servicio de Hotel	', '300.00', '39.00', '339.00', '2019-07-21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones`
--

CREATE TABLE `habitaciones` (
  `id` int(11) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `tipo` int(11) NOT NULL,
  `n_personas` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `fecha` date NOT NULL,
  `ocupada` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `habitaciones`
--

INSERT INTO `habitaciones` (`id`, `codigo`, `descripcion`, `tipo`, `n_personas`, `estado`, `fecha`, `ocupada`) VALUES
(1, 'HAB-DEX-001', 'HABITACION DELUXE', 1, 4, 1, '2019-07-20', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario` char(15) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `fecha` date NOT NULL,
  `activo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario`, `nombre`, `password`, `fecha`, `activo`) VALUES
('admin', 'Luis Iraheta M.', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2018-08-03', 1),
('jrivas', 'Francisco Rivas', 'aeab0f3766617ffe9739b2f6d879d47c9d844984', '2018-08-07', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_hab`
--

CREATE TABLE `ventas_hab` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_hab` varchar(20) NOT NULL,
  `p_dia` decimal(20,2) NOT NULL,
  `dias` int(11) NOT NULL,
  `iva` decimal(15,2) NOT NULL,
  `total` decimal(30,2) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ventas_hab`
--

INSERT INTO `ventas_hab` (`id`, `id_cliente`, `id_hab`, `p_dia`, `dias`, `iva`, `total`, `fecha`) VALUES
(1, 1, 'HAB-DEX-001', '20.00', 1, '0.00', '20.00', '2019-07-20'),
(2, 1, 'HAB-DEX-001', '20.00', 1, '0.00', '20.00', '2019-07-21'),
(3, 1, 'HAB-DEX-001', '20.00', 1, '0.00', '20.00', '2019-07-21');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cat_habitaciones`
--
ALTER TABLE `cat_habitaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `check_in`
--
ALTER TABLE `check_in`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cliente` (`id_cliente`),
  ADD KEY `fk_hab` (`id_hab`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `doc` (`doc`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id_registro`);

--
-- Indices de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD KEY `tipo` (`tipo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario`);

--
-- Indices de la tabla `ventas_hab`
--
ALTER TABLE `ventas_hab`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_hab` (`id_hab`),
  ADD KEY `fk_cliente` (`id_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cat_habitaciones`
--
ALTER TABLE `cat_habitaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `check_in`
--
ALTER TABLE `check_in`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ventas_hab`
--
ALTER TABLE `ventas_hab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `check_in`
--
ALTER TABLE `check_in`
  ADD CONSTRAINT `fk_cliente_checkin` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `fk_hab_checkin` FOREIGN KEY (`id_hab`) REFERENCES `habitaciones` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD CONSTRAINT `habitaciones_ibfk_1` FOREIGN KEY (`tipo`) REFERENCES `cat_habitaciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventas_hab`
--
ALTER TABLE `ventas_hab`
  ADD CONSTRAINT `fk_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
