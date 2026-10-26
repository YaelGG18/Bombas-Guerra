-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-10-2026 a las 17:45:11
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `taller_bombas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_pieza`
--

CREATE TABLE `categoria_pieza` (
  `idCategoria` int(11) NOT NULL,
  `nombreCategoria` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL,
  `nombreCliente` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `garantia`
--

CREATE TABLE `garantia` (
  `idGarantia` int(11) NOT NULL,
  `idOT` int(11) NOT NULL,
  `codigoVerificacion` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fechaInicio` date NOT NULL,
  `vigenciaDias` int(11) NOT NULL,
  `estadoGarantia` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_movimiento`
--

CREATE TABLE `historial_movimiento` (
  `idMovimiento` int(11) NOT NULL,
  `idRefaccion` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `tipoMovimiento` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fechaHora` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `idMarca` int(11) NOT NULL,
  `nombreMarca` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_trabajo`
--

CREATE TABLE `orden_trabajo` (
  `idOT` int(11) NOT NULL,
  `folioOT` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idCliente` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `diagnosticoFalla` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `costoManoObra` decimal(10,2) NOT NULL DEFAULT 0.00,
  `estadoOT` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fechaCreacion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `refaccion`
--

CREATE TABLE `refaccion` (
  `idRefaccion` int(11) NOT NULL,
  `idMarca` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `numeroParte` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ubicacionEstanteria` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precioCompraActual` decimal(10,2) NOT NULL,
  `precioVentaActual` decimal(10,2) NOT NULL,
  `cantidadStock` int(11) NOT NULL DEFAULT 0,
  `stockMinimo` int(11) NOT NULL DEFAULT 0,
  `estatusActivo` tinyint(1) DEFAULT 1,
  `descripcion` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `contrasenaHash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria_pieza`
--
ALTER TABLE `categoria_pieza`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indices de la tabla `garantia`
--
ALTER TABLE `garantia`
  ADD PRIMARY KEY (`idGarantia`),
  ADD UNIQUE KEY `codigoVerificacion` (`codigoVerificacion`),
  ADD KEY `idOT` (`idOT`);

--
-- Indices de la tabla `historial_movimiento`
--
ALTER TABLE `historial_movimiento`
  ADD PRIMARY KEY (`idMovimiento`),
  ADD KEY `idRefaccion` (`idRefaccion`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`idMarca`);

--
-- Indices de la tabla `orden_trabajo`
--
ALTER TABLE `orden_trabajo`
  ADD PRIMARY KEY (`idOT`),
  ADD UNIQUE KEY `folioOT` (`folioOT`),
  ADD KEY `idCliente` (`idCliente`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `refaccion`
--
ALTER TABLE `refaccion`
  ADD PRIMARY KEY (`idRefaccion`),
  ADD KEY `idMarca` (`idMarca`),
  ADD KEY `idCategoria` (`idCategoria`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria_pieza`
--
ALTER TABLE `categoria_pieza`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `garantia`
--
ALTER TABLE `garantia`
  MODIFY `idGarantia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial_movimiento`
--
ALTER TABLE `historial_movimiento`
  MODIFY `idMovimiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `idMarca` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `orden_trabajo`
--
ALTER TABLE `orden_trabajo`
  MODIFY `idOT` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `refaccion`
--
ALTER TABLE `refaccion`
  MODIFY `idRefaccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `garantia`
--
ALTER TABLE `garantia`
  ADD CONSTRAINT `garantia_ibfk_1` FOREIGN KEY (`idOT`) REFERENCES `orden_trabajo` (`idOT`);

--
-- Filtros para la tabla `historial_movimiento`
--
ALTER TABLE `historial_movimiento`
  ADD CONSTRAINT `historial_movimiento_ibfk_1` FOREIGN KEY (`idRefaccion`) REFERENCES `refaccion` (`idRefaccion`),
  ADD CONSTRAINT `historial_movimiento_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `orden_trabajo`
--
ALTER TABLE `orden_trabajo`
  ADD CONSTRAINT `orden_trabajo_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`),
  ADD CONSTRAINT `orden_trabajo_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `refaccion`
--
ALTER TABLE `refaccion`
  ADD CONSTRAINT `refaccion_ibfk_1` FOREIGN KEY (`idMarca`) REFERENCES `marca` (`idMarca`),
  ADD CONSTRAINT `refaccion_ibfk_2` FOREIGN KEY (`idCategoria`) REFERENCES `categoria_pieza` (`idCategoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
