-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-12-2019 a las 05:10:05
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `chef_gusteau`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `tel1` varchar(14) NOT NULL,
  `tel2` varchar(14) NOT NULL,
  `email` varchar(50) NOT NULL,
  `direccion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `tel1`, `tel2`, `email`, `direccion`) VALUES
(1, 'Luis Iraheta', '+503 7574-7574', '+503 7574-7574', 'liluisjose1@gmail.com', 'Barrio el Centro Chirilagua');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `proveedor` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `id_insumo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cortes_caja`
--

CREATE TABLE `cortes_caja` (
  `id` int(11) NOT NULL,
  `caja` smallint(6) NOT NULL,
  `cortex` decimal(10,2) NOT NULL,
  `cortez` decimal(10,2) DEFAULT NULL,
  `diferencia` decimal(10,2) DEFAULT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas`
--

CREATE TABLE `cuentas` (
  `id` int(11) NOT NULL,
  `mesa` smallint(6) NOT NULL,
  `cliente` varchar(30) NOT NULL,
  `id_receta` int(11) NOT NULL,
  `cantidad` smallint(6) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos`
--

CREATE TABLE `insumos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `existencias` int(15) DEFAULT NULL,
  `unidad` varchar(7) NOT NULL,
  `fecha_ingreso` timestamp NULL DEFAULT NULL,
  `fecha_modificacion` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `insumos`
--

INSERT INTO `insumos` (`id`, `nombre`, `descripcion`, `existencias`, `unidad`, `fecha_ingreso`, `fecha_modificacion`) VALUES
(1, 'Pechuga de pollo', 'Pechuga de pollo grande', 0, 'lb', '2019-12-03 05:18:50', '2019-12-05 04:04:19'),
(2, 'Tomates Cherry', 'Tomates Cherry', 0, '-', '2019-12-03 05:19:26', '2019-12-05 04:04:17'),
(3, 'Pimiento rojo', 'Pimiento rojo', 0, '-', '2019-12-03 05:19:46', NULL),
(4, 'Cebolla', 'Cebolla', 0, '-', '2019-12-03 05:20:06', '2019-12-05 04:04:14'),
(5, 'Limon', 'Limon', 0, '-', '2019-12-03 05:20:27', NULL),
(6, 'Perejil', 'Perejil', 0, '-', '2019-12-03 05:20:37', NULL),
(7, 'Carne de res', 'Carne res', 0, 'lb', '2019-12-03 21:09:44', '2019-12-04 01:42:01'),
(8, 'Coca cola lata', 'Coca cola lata', 0, 'lata', '2019-12-04 15:34:55', NULL);

--
-- Disparadores `insumos`
--
DELIMITER $$
CREATE TRIGGER `TR_INSERT_INSUMOS` BEFORE INSERT ON `insumos` FOR EACH ROW SET NEW.fecha_ingreso:=NOW()
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TR_UPDATE_INSUMOS` BEFORE UPDATE ON `insumos` FOR EACH ROW SET NEW.fecha_modificacion=NOW()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `id` int(11) NOT NULL,
  `tipo` smallint(6) NOT NULL,
  `capacidad` smallint(6) NOT NULL,
  `estado` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`id`, `tipo`, `capacidad`, `estado`) VALUES
(1, 1, 6, 0),
(2, 2, 3, 0),
(3, 2, 2, 0),
(4, 1, 3, 0),
(5, 2, 3, 0),
(6, 1, 3, 0),
(7, 2, 4, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `tel1` varchar(14) NOT NULL,
  `tel2` varchar(14) NOT NULL,
  `email` varchar(50) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `credito` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `nombre`, `tel1`, `tel2`, `email`, `direccion`, `credito`) VALUES
(1, 'Luis Iraheta', '+503 7574-7574', '+503 7574-7574', 'liluisjose1@gmail.com', 'Barrio el Centro Chirilagua', '0.00'),
(3, 'Yenifer Garca', '12345678', '12345678', 'yeni@gmail.com', 'etc', '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recetas`
--

CREATE TABLE `recetas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_modificacion` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `recetas`
--

INSERT INTO `recetas` (`id`, `nombre`, `precio_venta`, `fecha_creacion`, `fecha_modificacion`) VALUES
(1, 'POLLO A LA API', '0.01', '2019-12-04 03:11:13', NULL),
(2, 'Carnita Azada API', '0.01', '2019-12-04 03:11:18', NULL),
(3, 'PRUEBA', '20.00', '2019-12-04 16:37:39', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recetas_detalle`
--

CREATE TABLE `recetas_detalle` (
  `id` int(11) NOT NULL,
  `id_receta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `recetas_detalle`
--

INSERT INTO `recetas_detalle` (`id`, `id_receta`, `id_producto`, `cantidad`) VALUES
(1, 1, 1, 40),
(2, 1, 2, 20),
(3, 1, 3, 3),
(4, 1, 4, 3),
(5, 1, 5, 10),
(6, 1, 6, 2),
(7, 2, 7, 20),
(8, 2, 4, 9),
(9, 3, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resumen_compra`
--

CREATE TABLE `resumen_compra` (
  `id` int(11) NOT NULL,
  `proveedor` int(11) NOT NULL,
  `tipo` smallint(6) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `resumen_compra`
--

INSERT INTO `resumen_compra` (`id`, `proveedor`, `tipo`, `total`, `fecha`) VALUES
(1, 1, 2, '2750.00', '2019-12-04 01:54:14'),
(2, 1, 2, '500.00', '2019-12-04 02:55:21'),
(3, 1, 1, '50.00', '2019-12-05 03:35:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `tel` varchar(14) NOT NULL,
  `nit` varchar(18) NOT NULL,
  `nrc` varchar(8) NOT NULL,
  `address` varchar(70) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `settings`
--

INSERT INTO `settings` (`id`, `name`, `tel`, `nit`, `nrc`, `address`, `icon`, `stock`) VALUES
(1, 'Chef Gusteau', '+503 7574-7554', '1217-161096-102-3', '100001-1', 'Barrio el Centro Chirilagua', 'assets/images/favicon.png', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario` char(15) NOT NULL,
  `tipo` smallint(6) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `fecha` date NOT NULL,
  `estado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario`, `tipo`, `nombre`, `password`, `fecha`, `estado`) VALUES
('admin', 1, 'Luis Iraheta', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2019-12-01', 1),
('cajero', 4, 'cajero', '3ea672a2112aa63512c691fd287996b2d0bb129c', '2019-12-03', 1),
('chef', 2, 'Admin Two', 'd5f2e5c77054c44c2c72a1b017deca06fc637c99', '2019-12-01', 1),
('mesero', 3, 'mesero', '5a280e11dcd2ad934af4dcb24b2fafc527aa550a', '2019-12-03', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `cliente` varchar(50) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `cliente`, `total`, `fecha`) VALUES
(1, 'juan', '40.00', '2019-12-05 03:22:33'),
(2, 'prueba', '20.00', '2019-12-05 03:34:13');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cortes_caja`
--
ALTER TABLE `cortes_caja`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `insumos`
--
ALTER TABLE `insumos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `recetas`
--
ALTER TABLE `recetas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `recetas_detalle`
--
ALTER TABLE `recetas_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_receta` (`id_receta`);

--
-- Indices de la tabla `resumen_compra`
--
ALTER TABLE `resumen_compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cortes_caja`
--
ALTER TABLE `cortes_caja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `insumos`
--
ALTER TABLE `insumos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `recetas`
--
ALTER TABLE `recetas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `recetas_detalle`
--
ALTER TABLE `recetas_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `resumen_compra`
--
ALTER TABLE `resumen_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
