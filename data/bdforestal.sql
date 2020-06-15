-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 09-01-2012 a las 15:44:04
-- Versión del servidor: 5.1.58
-- Versión de PHP: 5.3.6-13ubuntu3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `bdforestal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo`
--

CREATE TABLE IF NOT EXISTS `archivo` (
  `idarchivo` int(11) NOT NULL AUTO_INCREMENT,
  `numdoc` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `contenido` longblob NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `idexpediente` int(11) NOT NULL,
  `idrequisito` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechasubida` date DEFAULT NULL,
  `tipomime` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idarchivo`),
  UNIQUE KEY `numdoc_UNIQUE` (`numdoc`),
  KEY `fk_archivo_expediente1` (`idexpediente`),
  KEY `fk_archivo_requisito1` (`idrequisito`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `idcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `titulo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_has_requisito`
--

CREATE TABLE IF NOT EXISTS `categoria_has_requisito` (
  `idcategoria` int(11) NOT NULL,
  `idrequisito` int(11) NOT NULL,
  PRIMARY KEY (`idcategoria`,`idrequisito`),
  KEY `fk_categoria_has_requisito_requisito1` (`idrequisito`),
  KEY `fk_categoria_has_requisito_categoria1` (`idcategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_expediente`
--

CREATE TABLE IF NOT EXISTS `detalle_expediente` (
  `descripcion` text COLLATE utf8_spanish_ci,
  `archivo` int(11) DEFAULT NULL,
  `iditem` int(11) NOT NULL,
  `idrequisito` int(11) NOT NULL,
  `idexpediente` int(11) NOT NULL,
  PRIMARY KEY (`iditem`,`idrequisito`,`idexpediente`),
  KEY `fk_detalle_expediente_expediente1` (`idexpediente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expediente`
--

CREATE TABLE IF NOT EXISTS `expediente` (
  `idexpediente` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `observacion` varchar(400) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `idcategoria` int(11) NOT NULL,
  `idtipoexp` int(11) NOT NULL,
  `titular` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ubicacion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `mapa` mediumblob,
  `timapa` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `extmapa` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idexpediente`),
  UNIQUE KEY `codigo_UNIQUE` (`codigo`),
  KEY `fk_expediente_categoria1` (`idcategoria`),
  KEY `fk_expediente_tipoexp1` (`idtipoexp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `iditem` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `informacion` varchar(254) COLLATE utf8_spanish_ci DEFAULT NULL,
  `idrequisito` int(11) NOT NULL,
  PRIMARY KEY (`iditem`,`idrequisito`),
  KEY `fk_item_requisito1` (`idrequisito`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requisito`
--

CREATE TABLE IF NOT EXISTS `requisito` (
  `idrequisito` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `dependencia` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idrequisito`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoexp`
--

CREATE TABLE IF NOT EXISTS `tipoexp` (
  `idtipoexp` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idtipoexp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `pwd` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `nick` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `login_UNIQUE` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `login`, `pwd`, `nick`, `estado`) VALUES
(1, 'admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Administrador forestal', 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `archivo`
--
ALTER TABLE `archivo`
  ADD CONSTRAINT `fk_archivo_expediente1` FOREIGN KEY (`idexpediente`) REFERENCES `expediente` (`idexpediente`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_archivo_requisito1` FOREIGN KEY (`idrequisito`) REFERENCES `requisito` (`idrequisito`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `categoria_has_requisito`
--
ALTER TABLE `categoria_has_requisito`
  ADD CONSTRAINT `fk_categoria_has_requisito_categoria1` FOREIGN KEY (`idcategoria`) REFERENCES `categoria` (`idcategoria`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_categoria_has_requisito_requisito1` FOREIGN KEY (`idrequisito`) REFERENCES `requisito` (`idrequisito`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_expediente`
--
ALTER TABLE `detalle_expediente`
  ADD CONSTRAINT `fk_detalle_expediente_expediente1` FOREIGN KEY (`idexpediente`) REFERENCES `expediente` (`idexpediente`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_expediente_item1` FOREIGN KEY (`iditem`, `idrequisito`) REFERENCES `item` (`iditem`, `idrequisito`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `expediente`
--
ALTER TABLE `expediente`
  ADD CONSTRAINT `fk_expediente_categoria1` FOREIGN KEY (`idcategoria`) REFERENCES `categoria` (`idcategoria`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_expediente_tipoexp1` FOREIGN KEY (`idtipoexp`) REFERENCES `tipoexp` (`idtipoexp`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `fk_item_requisito1` FOREIGN KEY (`idrequisito`) REFERENCES `requisito` (`idrequisito`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
