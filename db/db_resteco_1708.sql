-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-08-2017 a las 00:28:12
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_resteco`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ACTUALIZARPRODUCTO` (IN `_intIdProducto` INT, IN `_nvchCodigoProducto` VARCHAR(25), IN `_nvchCodigoInventario` VARCHAR(10), IN `_nvchNombre` VARCHAR(250), IN `_nvchDescripcion` VARCHAR(500), IN `_dcmPrecioCompra` DECIMAL(11,2), IN `_dcmPrecioVenta` DECIMAL(11,2), IN `_intCantidad` INT, IN `_nvchDescuento` VARCHAR(450), IN `_nvchDireccionImg` VARCHAR(450), IN `_nvchSucursal` VARCHAR(250), IN `_nvchGabinete` VARCHAR(250), IN `_nvchCajon` VARCHAR(250), IN `_dtmFechaIngreso` DATETIME)  BEGIN
		UPDATE tb_producto
		SET
		nvchCodigoProducto = _nvchCodigoProducto,
		nvchCodigoInventario = _nvchCodigoInventario,
		nvchNombre = _nvchNombre,
		nvchDescripcion = _nvchDescripcion,
		dcmPrecioCompra = _dcmPrecioCompra,
		dcmPrecioVenta = _dcmPrecioVenta,
		intCantidad = _intCantidad,
		nvchDescuento = _nvchDescuento,
		nvchDireccionImg = _nvchDireccionImg,
		nvchSucursal = _nvchSucursal,
		nvchGabinete = _nvchGabinete,
		nvchCajon = _nvchCajon,
		dtmFechaIngreso = _dtmFechaIngreso
		WHERE 
		intIdProducto = _intIdProducto;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ACTUALIZARPROVEEDOR` (IN `_intIdProveedor` INT, IN `_nvchDNI` CHAR(8), IN `_nvchRUC` CHAR(11), IN `_nvchRazonSocial` VARCHAR(250), IN `_nvchApellidoPaterno` VARCHAR(120), IN `_nvchApellidoMaterno` VARCHAR(120), IN `_nvchNombres` VARCHAR(250), IN `_intIdTipoPersona` INT)  BEGIN
		UPDATE tb_proveedor
		SET
		nvchDNI = _nvchDNI,
		nvchRUC = _nvchRUC,
		nvchRazonSocial = _nvchRazonSocial,
		nvchApellidoPaterno = _nvchApellidoPaterno,
		nvchApellidoMaterno = _nvchApellidoMaterno,
		nvchNombres = _nvchNombres,
		intIdTipoPersona = _intIdTipoPersona
		WHERE 
		intIdProveedor = _intIdProveedor;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ACTUALIZARUSUARIO` (IN `_intUserId` INT(11), IN `_nvchUserName` VARCHAR(50), IN `_nchUserMail` VARCHAR(25), IN `_nvchUserPassword` VARCHAR(1000), IN `_intIdEmpleado` INT(11), IN `_intTypeUser` INT(11), IN `_bitUserEstado` INT(11))  BEGIN
		UPDATE tb_usuario
		SET
			nvchUserName = _nvchUserName,
			nchUserMail = _nchUserMail,
			nvchUserPassword = _nvchUserPassword,
			intIdEmpleado = _intIdEmpleado,
			intTypeUser = _intTypeUser,
			bitUserEstado = _bitUserEstado 
		WHERE intUserId = _intUserId;
    	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `BUSCARPRODUCTO` (IN `_elemento` VARCHAR(500), IN `_x` INT, IN `_y` INT)  BEGIN
		SELECT * FROM tb_producto 
		WHERE 
		intIdProducto LIKE CONCAT(_elemento,'%') OR
		nvchCodigoProducto LIKE CONCAT(_elemento,'%') OR
		nvchCodigoInventario LIKE CONCAT(_elemento,'%') OR
		nvchNombre LIKE CONCAT(_elemento,'%') OR
		nvchDescripcion LIKE CONCAT(_elemento,'%') OR
		dcmPrecioCompra LIKE CONCAT(_elemento,'%') OR
		dcmPrecioVenta LIKE CONCAT(_elemento,'%') OR
		intCantidad LIKE CONCAT(_elemento,'%') OR
		nvchDescuento LIKE CONCAT(_elemento,'%') OR
		nvchSucursal LIKE CONCAT(_elemento,'%') OR
		nvchGabinete LIKE CONCAT(_elemento,'%') OR 
		nvchCajon LIKE CONCAT(_elemento,'%') OR 
		dtmFechaIngreso LIKE CONCAT(_elemento,'%')
		LIMIT _x,_y;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `BUSCARPRODUCTO_II` (IN `_elemento` VARCHAR(500))  BEGIN
		SELECT * FROM tb_producto 
		WHERE 
		intIdProducto LIKE CONCAT(_elemento,'%') OR
		nvchCodigoProducto LIKE CONCAT(_elemento,'%') OR
		nvchCodigoInventario LIKE CONCAT(_elemento,'%') OR
		nvchNombre LIKE CONCAT(_elemento,'%') OR
		nvchDescripcion LIKE CONCAT(_elemento,'%') OR
		dcmPrecioCompra LIKE CONCAT(_elemento,'%') OR
		dcmPrecioVenta LIKE CONCAT(_elemento,'%') OR
		intCantidad LIKE CONCAT(_elemento,'%') OR
		nvchDescuento LIKE CONCAT(_elemento,'%') OR
		nvchSucursal LIKE CONCAT(_elemento,'%') OR
		nvchGabinete LIKE CONCAT(_elemento,'%') OR 
		nvchCajon LIKE CONCAT(_elemento,'%') OR 
		dtmFechaIngreso LIKE CONCAT(_elemento,'%');
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `BUSCARPROVEEDOR` (IN `_elemento` VARCHAR(250), IN `_x` INT, IN `_y` INT)  BEGIN
		SELECT * FROM tb_proveedor
		WHERE 
		intIdProveedor LIKE CONCAT(_elemento,'%') OR
		nvchDNI LIKE CONCAT(_elemento,'%') OR
		nvchRUC LIKE CONCAT(_elemento,'%') OR
		nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
		nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
		nvchNombres LIKE CONCAT(_elemento,'%') OR
		intIdTipoPersona LIKE CONCAT(_elemento,'%')
		LIMIT _x,_y;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `BUSCARPROVEEDOR_II` (IN `_elemento` VARCHAR(250))  BEGIN
		SELECT * FROM tb_proveedor
		WHERE 
		intIdProveedor LIKE CONCAT(_elemento,'%') OR
		nvchDNI LIKE CONCAT(_elemento,'%') OR
		nvchRUC LIKE CONCAT(_elemento,'%') OR
		nvchRazonSocial LIKE CONCAT(_elemento,'%') OR
		nvchApellidoPaterno LIKE CONCAT(_elemento,'%') OR
		nvchApellidoMaterno LIKE CONCAT(_elemento,'%') OR
		nvchNombres LIKE CONCAT(_elemento,'%') OR
		intIdTipoPersona LIKE CONCAT(_elemento,'%');
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `BUSCARUSUARIO` (IN `_elemento` VARCHAR(500), IN `_x` INT, IN `_y` INT)  BEGIN
		SELECT * FROM tb_usuario 
		WHERE 
			intUserId LIKE CONCAT(_elemento,'%') OR 
			nvchUserName LIKE CONCAT(_elemento,'%') OR 
			nchUserMail LIKE CONCAT(_elemento,'%') OR 
			intIdEmpleado LIKE CONCAT(_elemento,'%') OR 
			intTypeUser LIKE CONCAT(_elemento,'%') OR 
			bitUserEstado LIKE CONCAT(_elemento,'%')
		LIMIT _x,_y;
    	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `BUSCARUSUARIO_II` (IN `_elemento` VARCHAR(500))  BEGIN
		SELECT * FROM tb_usuario 
		WHERE 
			intUserId LIKE CONCAT(_elemento,'%') OR 
			nvchUserName LIKE CONCAT(_elemento,'%') OR 
			nchUserMail LIKE CONCAT(_elemento,'%') OR 
			intIdEmpleado LIKE CONCAT(_elemento,'%') OR 
			intTypeUser LIKE CONCAT(_elemento,'%') OR 
			bitUserEstado LIKE CONCAT(_elemento,'%');
    	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ELIMINARPRODUCTO` (IN `_intIdProducto` INT)  BEGIN
		DELETE FROM tb_producto
		WHERE 
		intIdProducto = _intIdProducto;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ELIMINARPROVEEDOR` (IN `_intIdProveedor` INT)  BEGIN
		DELETE FROM tb_proveedor
		WHERE 
		intIdProveedor = _intIdProveedor;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ELIMINARUSUARIO` (IN `_intUserId` INT)  BEGIN
		DELETE FROM tb_usuario 
		WHERE 
		intUserId = _intUserId;
    	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `INSERTARIMAGENPRODUCTO` (IN `_intIdProducto` INT, IN `_nvchDireccionImg` VARCHAR(450))  BEGIN
		UPDATE tb_producto
		SET
		nvchDireccionImg = _nvchDireccionImg 
		WHERE 
		intIdProducto = _intIdProducto;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `INSERTARPRODUCTO` (IN `_nvchCodigoProducto` VARCHAR(25), IN `_nvchCodigoInventario` VARCHAR(10), IN `_nvchNombre` VARCHAR(250), IN `_nvchDescripcion` VARCHAR(500), IN `_dcmPrecioCompra` DECIMAL(11,2), IN `_dcmPrecioVenta` DECIMAL(11,2), IN `_intCantidad` INT, IN `_nvchDescuento` VARCHAR(450), IN `_nvchDireccionImg` VARCHAR(450), IN `_nvchSucursal` VARCHAR(250), IN `_nvchGabinete` VARCHAR(250), IN `_nvchCajon` VARCHAR(250), IN `_dtmFechaIngreso` DATETIME)  BEGIN
		INSERT INTO tb_producto 
		(nvchCodigoProducto,nvchCodigoInventario,nvchNombre,nvchDescripcion,dcmPrecioCompra,
		dcmPrecioVenta,intCantidad,nvchDescuento,nvchDireccionImg,nvchSucursal,nvchGabinete,nvchCajon,dtmFechaIngreso)
		VALUES
		(_nvchCodigoProducto,_nvchCodigoInventario,_nvchNombre,_nvchDescripcion,_dcmPrecioCompra,
		_dcmPrecioVenta,_intCantidad,_nvchDescuento,_nvchDireccionImg,_nvchSucursal,_nvchGabinete,_nvchCajon,_dtmFechaIngreso);
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `INSERTARPROVEEDOR` (OUT `_intIdProveedor` INT, IN `_nvchDNI` CHAR(8), IN `_nvchRUC` CHAR(11), IN `_nvchRazonSocial` VARCHAR(250), IN `_nvchApellidoPaterno` VARCHAR(120), IN `_nvchApellidoMaterno` VARCHAR(120), IN `_nvchNombres` VARCHAR(250), IN `_intIdTipoPersona` INT)  BEGIN
		INSERT INTO tb_proveedor 
		(nvchDNI,nvchRUC,nvchRazonSocial,nvchApellidoPaterno,nvchApellidoMaterno,nvchNombres,intIdTipoPersona)
		VALUES
		(_nvchDNI,_nvchRUC,_nvchRazonSocial,_nvchApellidoPaterno,_nvchApellidoMaterno,_nvchNombres,_intIdTipoPersona);
		SET _intIdProveedor = LAST_INSERT_ID();
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `INSERTARUSUARIO` (IN `_nvchUserName` VARCHAR(50), IN `_nchUserMail` VARCHAR(25), IN `_nvchUserPassword` VARCHAR(1000), IN `_intIdEmpleado` INT(11), IN `_intTypeUser` INT(11), IN `_bitUserEstado` INT(11))  BEGIN
		INSERT INTO tb_usuario(
			nvchUserName,
			nchUserMail,
			nvchUserPassword,
			intIdEmpleado,
			intTypeUser,
			bitUserEstado
			)
		VALUES(
			_nvchUserName,
			_nchUserMail,
			_nvchUserPassword,
			_intIdEmpleado,
			_intTypeUser,
			_bitUserEstado
			);
    	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `LISTARPRODUCTO` (IN `_x` INT, IN `_y` INT)  BEGIN
		SELECT * FROM tb_producto
 		LIMIT _x,_y;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `LISTARPROVEEDOR` (IN `_x` INT, IN `_y` INT)  BEGIN
		SELECT * FROM tb_proveedor
 		LIMIT _x,_y;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `LISTARUSUARIO` (IN `_x` INT, IN `_y` INT)  BEGIN
		SELECT * FROM tb_usuario  
 		LIMIT _x,_y;
    	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `MOSTRARPRODUCTO` (IN `_intIdProducto` INT)  BEGIN
		SELECT * FROM tb_producto
		WHERE 
		intIdProducto = _intIdProducto;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `MOSTRARPROVEEDOR` (IN `_intIdProveedor` INT)  BEGIN
		SELECT * FROM tb_proveedor
		WHERE 
		intIdProveedor = _intIdProveedor;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `MOSTRARUSUARIO` (IN `_intUserId` INT)  BEGIN
		SELECT * FROM tb_usuario 
		WHERE 
		intUserId = _intUserId;
    	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `TODOPRODUCTO` ()  BEGIN
		SELECT * FROM tb_producto;
    	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `TODOPROVEEDOR` ()  BEGIN
		SELECT * FROM tb_proveedor;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `TODOUSUARIO` ()  BEGIN
		SELECT * FROM tb_usuario;
    	END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_articulo`
--

CREATE TABLE `tb_articulo` (
  `intArticuloId` int(11) NOT NULL,
  `nvchArticuloNombre` varchar(25) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_cargo`
--

CREATE TABLE `tb_cargo` (
  `intIdCargo` int(11) NOT NULL,
  `nvchNombre` varchar(85) COLLATE utf8_spanish2_ci NOT NULL,
  `nvchAbreviatura` char(4) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_cliente`
--

CREATE TABLE `tb_cliente` (
  `intIdCliente` int(11) NOT NULL,
  `nvchDNI` varchar(8) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nvchRUC` varchar(11) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nvchRazonSocial` varchar(250) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nvchApellidoPaterno` varchar(120) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nvchApellidoMaterno` varchar(120) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nvchNombres` varchar(250) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `intIdTipoPersona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_comprobante`
--

CREATE TABLE `tb_comprobante` (
  `intIdComprobante` int(11) NOT NULL,
  `intIdUsuario` int(11) NOT NULL,
  `intIdCliente` int(11) NOT NULL,
  `dtmFechaCreacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_comunicacion_cliente`
--

CREATE TABLE `tb_comunicacion_cliente` (
  `intIdComunicacionCliente` int(11) NOT NULL,
  `intIdCliente` int(11) DEFAULT NULL,
  `nvchMedio` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nvchLugar` varchar(550) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `intIdTipoComunicacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_comunicacion_proveedor`
--

CREATE TABLE `tb_comunicacion_proveedor` (
  `intIdComicacionProveedor` int(11) NOT NULL,
  `intIdProveedor` int(11) DEFAULT NULL,
  `nvchMedio` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nvchLugar` varchar(550) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `intIdTipoComunicacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_cotizacion`
--

CREATE TABLE `tb_cotizacion` (
  `intIdCotizacion` int(11) NOT NULL,
  `intIdUsuario` int(11) NOT NULL,
  `intIdCliente` int(11) NOT NULL,
  `dtm` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_creacion_reporte`
--

CREATE TABLE `tb_creacion_reporte` (
  `intidReporteCreado` int(11) NOT NULL,
  `intUserId` int(11) NOT NULL,
  `nvchNombreReporte` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `dtFechaCreacion` varchar(30) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tb_creacion_reporte`
--

INSERT INTO `tb_creacion_reporte` (`intidReporteCreado`, `intUserId`, `nvchNombreReporte`, `dtFechaCreacion`) VALUES
(35, 23, 'Listado de Usuarios', '25/07/2017, 4:10:45 horas'),
(36, 23, 'Historial de Accesso Completo', '25/07/2017, 4:13:11 horas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_detalle_cotizacion`
--

CREATE TABLE `tb_detalle_cotizacion` (
  `intIdOperacion` int(11) NOT NULL,
  `intIdCotizacion` int(11) NOT NULL,
  `intIdProducto` int(11) NOT NULL,
  `dtmFechaCotizacion` datetime NOT NULL,
  `intCantidad` int(11) NOT NULL,
  `dcmPrecio` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_detalle_guia_interna_entrada`
--

CREATE TABLE `tb_detalle_guia_interna_entrada` (
  `intIdOperacion` int(11) NOT NULL,
  `intIdGuiaInternaEntrada` int(11) NOT NULL,
  `intIdProducto` int(11) NOT NULL,
  `dtmFechaEntrada` datetime NOT NULL,
  `intCantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_detalle_guia_interna_salida`
--

CREATE TABLE `tb_detalle_guia_interna_salida` (
  `intIdOperacion` int(11) NOT NULL,
  `intIdGuiaInternaSalida` int(11) NOT NULL,
  `intIdProducto` int(11) NOT NULL,
  `dtmFechaSalida` datetime NOT NULL,
  `intCantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_detalle_orden_compra`
--

CREATE TABLE `tb_detalle_orden_compra` (
  `intIdOperacion` int(11) NOT NULL,
  `intIdOrdenCompra` int(11) NOT NULL,
  `intIdProducto` int(11) NOT NULL,
  `dtmFechaRecepcion` datetime NOT NULL,
  `intCantidad` int(11) NOT NULL,
  `dcmPrecio` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_detalle_solicitud_compra`
--

CREATE TABLE `tb_detalle_solicitud_compra` (
  `intIdOperacion` int(11) NOT NULL,
  `intIdSolicitudCompra` int(11) NOT NULL,
  `intIdProducto` int(11) NOT NULL,
  `dtmFechaRequerida` datetime NOT NULL,
  `intCantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_domicilio_cliente`
--

CREATE TABLE `tb_domicilio_cliente` (
  `intIdDomicilioCliente` int(11) NOT NULL,
  `intIdCliente` int(11) NOT NULL,
  `nvchPais` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `nvchRegion` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `nvchProvincia` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `nvchDistrito` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `nvchDireccion` varchar(450) COLLATE utf8_spanish2_ci NOT NULL,
  `intIdTelefonoCliente` int(11) NOT NULL,
  `intIdCelularCliente` int(11) NOT NULL,
  `intIdTipoDomicilio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_domicilio_proveedor`
--

CREATE TABLE `tb_domicilio_proveedor` (
  `intIdDomicilioProveedor` int(11) NOT NULL,
  `intIdProveedor` int(11) NOT NULL,
  `nvchPais` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `nvchRegion` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `nvchProvincia` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `nvchDistrito` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `nvchDireccion` varchar(450) COLLATE utf8_spanish2_ci NOT NULL,
  `intIdTipoDomicilio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_empleado`
--

CREATE TABLE `tb_empleado` (
  `intIdEmpleado` int(11) NOT NULL,
  `nchDNI` char(8) COLLATE utf8_spanish2_ci NOT NULL,
  `nchRUC` char(11) COLLATE utf8_spanish2_ci NOT NULL,
  `nvchApellidoPaterno` varchar(120) COLLATE utf8_spanish2_ci NOT NULL,
  `nvchApellidoMaterno` varchar(120) COLLATE utf8_spanish2_ci NOT NULL,
  `nvchNombres` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `intIdCargo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tb_empleado`
--

INSERT INTO `tb_empleado` (`intIdEmpleado`, `nchDNI`, `nchRUC`, `nvchApellidoPaterno`, `nvchApellidoMaterno`, `nvchNombres`, `intIdCargo`) VALUES
(1, '07514639', '10075146393', 'Nozcano', 'lizarzaburu', 'Pedro', 1),
(2, '09814639', '10098146393', 'Meza', 'Lozano', 'Guillermo', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_guia_interna_entrada`
--

CREATE TABLE `tb_guia_interna_entrada` (
  `intIdGuiaInternaEntrada` int(11) NOT NULL,
  `intIdUsuario` int(11) NOT NULL,
  `intIdProveedor` int(11) NOT NULL,
  `dtmFechaCreacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_guia_interna_salida`
--

CREATE TABLE `tb_guia_interna_salida` (
  `intIdGuiaInternaSalida` int(11) NOT NULL,
  `intIdUsuario` int(11) NOT NULL,
  `intIdCliente` int(11) NOT NULL,
  `dtmFechaCreacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_historyaccess`
--

CREATE TABLE `tb_historyaccess` (
  `intIdHistory` int(11) NOT NULL,
  `intIdUser` int(11) NOT NULL,
  `dateDateAccesso` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `nvchIpAccesso` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `nvchBrowser` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tb_historyaccess`
--

INSERT INTO `tb_historyaccess` (`intIdHistory`, `intIdUser`, `dateDateAccesso`, `nvchIpAccesso`, `nvchBrowser`) VALUES
(1, 23, 'Martes 25 de Julio del 2017, 15:07:53 horas', '193.10.14.12', 'Windows 10'),
(2, 23, 'Martes 25 de Julio del 2017, 15:35:22 horas', '193.10.14.12', 'Windows 10'),
(3, 24, 'Jueves 27 de Julio del 2017, 13:41:21 horas', '193.10.14.12', 'Windows 10'),
(4, 24, 'Viernes 28 de Julio del 2017, 7:11:40 horas', '193.10.14.12', 'Windows 10'),
(5, 24, 'SÃ¡bado 29 de Julio del 2017, 14:51:05 horas', '193.10.14.12', 'Windows 10'),
(6, 24, 'Domingo 30 de Julio del 2017, 11:56:58 horas', '193.10.14.12', 'Windows 10'),
(7, 24, 'Martes 01 de Agosto del 2017, 8:08:34 horas', '193.10.14.12', 'Windows 10'),
(8, 24, 'SÃ¡bado 05 de Agosto del 2017, 17:43:26 horas', '193.10.14.12', 'Windows 10'),
(9, 24, 'SÃ¡bado 05 de Agosto del 2017, 10:26:28 horas', '193.10.14.12', 'Windows 10'),
(10, 24, 'Lunes 07 de Agosto del 2017, 8:06:28 horas', '193.10.14.12', 'Windows 10'),
(11, 24, 'Lunes 07 de Agosto del 2017, 13:44:19 horas', '193.10.14.12', 'Windows 10'),
(12, 24, 'Martes 08 de Agosto del 2017, 9:59:42 horas', '193.10.14.12', 'Windows 10'),
(13, 24, 'Miercoles 09 de Agosto del 2017, 10:47:29 horas', '193.10.14.12', 'Windows 10'),
(14, 24, 'Jueves 10 de Agosto del 2017, 10:10:52 horas', '193.10.14.12', 'Windows 10'),
(15, 24, 'Jueves 10 de Agosto del 2017, 14:48:48 horas', '193.10.14.12', 'iPhone'),
(16, 24, 'Viernes 11 de Agosto del 2017, 9:18:36 horas', '193.10.14.12', 'Windows 10'),
(17, 24, 'Viernes 11 de Agosto del 2017, 14:59:53 horas', '193.10.14.12', 'Windows 10'),
(18, 24, 'SÃ¡bado 12 de Agosto del 2017, 11:29:44 horas', '193.10.14.12', 'Windows 10'),
(19, 24, 'SÃ¡bado 12 de Agosto del 2017, 9:17:54 horas', '193.10.14.12', 'Windows 10'),
(20, 24, 'Domingo 13 de Agosto del 2017, 6:09:00 horas', '193.10.14.12', 'Windows 10'),
(21, 24, 'Lunes 14 de Agosto del 2017, 7:05:03 horas', '193.10.14.12', 'Windows 10'),
(22, 24, 'Martes 15 de Agosto del 2017, 9:32:39 horas', '193.10.14.12', 'Windows 10'),
(23, 24, 'Miercoles 16 de Agosto del 2017, 11:26:30 horas', '193.10.14.12', 'Windows 10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_justificacion_solicitud_compra`
--

CREATE TABLE `tb_justificacion_solicitud_compra` (
  `intIdJustificacion` int(11) NOT NULL,
  `intIdSolicitudCompra` int(11) NOT NULL,
  `nvchDescripcion` varchar(450) COLLATE utf8_spanish2_ci NOT NULL,
  `dtmFechaObservacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_observacion_cotizacion`
--

CREATE TABLE `tb_observacion_cotizacion` (
  `intIdObservacion` int(11) NOT NULL,
  `intIdCotizacion` int(11) NOT NULL,
  `nvchDescripcion` varchar(400) COLLATE utf8_spanish2_ci NOT NULL,
  `dtmFechaObservacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_orden_compra`
--

CREATE TABLE `tb_orden_compra` (
  `intIdOrdenCompra` int(11) NOT NULL,
  `intIdUsuario` int(11) NOT NULL,
  `intIdProveedor` int(11) NOT NULL,
  `dtmFechaCreacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_producto`
--

CREATE TABLE `tb_producto` (
  `intIdProducto` int(11) NOT NULL,
  `nvchCodigoProducto` varchar(25) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nvchCodigoInventario` varchar(10) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nvchNombre` varchar(250) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nvchDescripcion` varchar(500) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `dcmPrecioCompra` decimal(11,2) DEFAULT NULL,
  `dcmPrecioVenta` decimal(11,2) DEFAULT NULL,
  `intCantidad` int(11) DEFAULT NULL,
  `nvchDescuento` varchar(10) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nvchDireccionImg` varchar(450) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `intIdUbigeoProducto` int(11) DEFAULT NULL,
  `nvchSucursal` varchar(250) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nvchGabinete` varchar(250) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nvchCajon` varchar(250) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `dtmFechaIngreso` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tb_producto`
--

INSERT INTO `tb_producto` (`intIdProducto`, `nvchCodigoProducto`, `nvchCodigoInventario`, `nvchNombre`, `nvchDescripcion`, `dcmPrecioCompra`, `dcmPrecioVenta`, `intCantidad`, `nvchDescuento`, `nvchDireccionImg`, `intIdUbigeoProducto`, `nvchSucursal`, `nvchGabinete`, `nvchCajon`, `dtmFechaIngreso`) VALUES
(10, NULL, NULL, 'joder tio x1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.', NULL, '0.00', 0, NULL, '170722124319-25-grandes-frases-de-nikola-tesla-para-reflexionar.jpg', 0, NULL, NULL, NULL, NULL),
(11, NULL, NULL, 'China rica', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.', NULL, '345345435.00', 345345345, NULL, '170721101738-18403149_438059576570527_721908336340998427_n.jpg', 0, NULL, NULL, NULL, NULL),
(13, NULL, NULL, '13lo', '', NULL, '1212.00', 120, NULL, '170722125849-velo-en-el-trabajo.png', 0, NULL, NULL, NULL, NULL),
(14, NULL, NULL, '', 'Hola', NULL, '20000.00', 2, NULL, 'img-producto-id-14.png', NULL, NULL, NULL, NULL, NULL),
(15, NULL, NULL, 'Hector x15', 'Holas', NULL, '14.00', 1, NULL, 'hector.jpg', NULL, NULL, NULL, NULL, NULL),
(19, NULL, NULL, 'HectorNyaa', 'Holaa', NULL, '1233.00', 1, NULL, 'hector.jpg', NULL, NULL, NULL, NULL, NULL),
(20, NULL, NULL, 'Hector', 'Hola', NULL, '1233.00', 1, NULL, 'hector.jpg', NULL, NULL, NULL, NULL, NULL),
(21, NULL, NULL, '', 'Hola', NULL, '1233.00', 1, NULL, 'img-producto-id-21.png', NULL, NULL, NULL, NULL, NULL),
(22, '1111111', '111111', 'Dragon', 'Hola', '345.00', '1233.00', 1, '30%', 'img-producto-id-22.png', NULL, 'Huancayo', 'Huancayo', 'Huancayo', '0000-00-00 00:00:00'),
(24, NULL, NULL, '', 'aaaaa', NULL, '1233.00', 1, NULL, 'img-producto-id-24.', NULL, NULL, NULL, NULL, NULL),
(29, NULL, NULL, 'Hola', 'ID 29', NULL, '12.00', 1, NULL, 'hector.jpg', NULL, NULL, NULL, NULL, NULL),
(30, NULL, NULL, 'Hector', 'Bien dado', NULL, '10000.00', 2, NULL, 'hector.jpg', NULL, NULL, NULL, NULL, NULL),
(37, NULL, NULL, 'Hector', 'LuisCantinflas', NULL, '25.00', 1, NULL, 'hector.jpg', NULL, NULL, NULL, NULL, NULL),
(39, NULL, NULL, 'Prueba1', 'Prueba 1', NULL, '5.00', 3, NULL, 'hector.jpg', NULL, NULL, NULL, NULL, NULL),
(40, NULL, NULL, 'Prueba2', 'Prueba 2', NULL, '5.00', 3, NULL, 'hector.jpg', NULL, NULL, NULL, NULL, NULL),
(43, NULL, NULL, 'Prueba 4', 'Pu', NULL, '4.00', 3, NULL, 'hector.jpg', NULL, NULL, NULL, NULL, NULL),
(44, NULL, NULL, 'Prueba 5', 'aaaa', NULL, '5.00', 6, NULL, 'hector.jpg', NULL, NULL, NULL, NULL, NULL),
(45, NULL, NULL, 'Prueba 6', 'Prueba 6', NULL, '6.00', 6, NULL, 'hector.jpg', NULL, NULL, NULL, NULL, NULL),
(46, NULL, NULL, 'Prueba 7', 'Prueba 7', NULL, '7.00', 7, NULL, 'hector.jpg', NULL, NULL, NULL, NULL, NULL),
(47, NULL, NULL, 'Prueba 8', '888', NULL, '8.00', 8, NULL, 'hector.jpg', NULL, NULL, NULL, NULL, NULL),
(48, NULL, NULL, 'Prueba 9', 'Prueba 9', NULL, '9.00', 999, NULL, 'hector.jpg', NULL, NULL, NULL, NULL, NULL),
(49, NULL, NULL, 'Prueba 10', 'Prueba 10', NULL, '10.00', 10, NULL, 'hector.jpg', NULL, NULL, NULL, NULL, NULL),
(54, NULL, NULL, 'Luis', 'Luis sanches', NULL, '45.00', 2, NULL, 'hector.jpg', NULL, NULL, NULL, NULL, NULL),
(55, NULL, NULL, 'Luis', 'Luis sanches', NULL, '45.00', 2, NULL, 'hector.jpg', NULL, NULL, NULL, NULL, NULL),
(56, NULL, NULL, 'Luis', 'Sanchez Sanchez', NULL, '45.00', 2, NULL, 'hector.jpg', NULL, NULL, NULL, NULL, NULL),
(67, NULL, NULL, 'Hector', 'HectorEliminar', NULL, '4.00', 2, NULL, 'hector.jpg', NULL, NULL, NULL, NULL, NULL),
(68, NULL, NULL, 'Hector', 'HectorEliminar', NULL, '4.00', 2, NULL, 'hector.jpg', NULL, NULL, NULL, NULL, NULL),
(69, NULL, NULL, 'Hector', 'HectorEliminar', NULL, '4.00', 2, NULL, 'hector.jpg', NULL, NULL, NULL, NULL, NULL),
(70, NULL, NULL, 'Hector', 'HectorEliminar', NULL, '5.00', 2, NULL, 'hector.jpg', NULL, NULL, NULL, NULL, NULL),
(71, NULL, NULL, 'Hector', 'HectorEliminar', NULL, '5.00', 2, NULL, 'hector.jpg', NULL, NULL, NULL, NULL, NULL),
(72, NULL, NULL, '', '', NULL, '0.00', 0, NULL, 'img-producto-id-72.png', NULL, NULL, NULL, NULL, NULL),
(73, NULL, NULL, NULL, '34343', NULL, '3443.00', 3434, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(74, NULL, NULL, NULL, '1111', NULL, '111.00', 1111, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(75, NULL, NULL, NULL, '1111', NULL, '111.00', 1111, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(76, NULL, NULL, NULL, 'aaa', NULL, '34.00', 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(77, NULL, NULL, NULL, 'aaa', NULL, '34.00', 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(78, NULL, NULL, '', 'Hector Arturo', NULL, '45.00', 45, NULL, '', NULL, NULL, NULL, NULL, NULL),
(79, NULL, NULL, '', 'Hector', NULL, '21323.00', 45, NULL, '', NULL, NULL, NULL, NULL, NULL),
(80, NULL, NULL, '', 'Hector', NULL, '21323.00', 45, NULL, '', NULL, NULL, NULL, NULL, NULL),
(81, NULL, NULL, '', 'Hector', NULL, '21323.00', 45, NULL, '', NULL, NULL, NULL, NULL, NULL),
(82, NULL, NULL, '', '38838', NULL, '34.00', 222, NULL, '', NULL, NULL, NULL, NULL, NULL),
(83, NULL, NULL, '', '38838', NULL, '34.00', 222, NULL, '', NULL, NULL, NULL, NULL, NULL),
(84, NULL, NULL, '', '38838', NULL, '34.00', 222, NULL, '', NULL, NULL, NULL, NULL, NULL),
(85, NULL, NULL, '', '38838', NULL, '34.00', 222, NULL, 'balotelli-meme-kfc.jpg', NULL, NULL, NULL, NULL, NULL),
(86, NULL, NULL, '', '44', NULL, '44.00', 44, NULL, '', NULL, NULL, NULL, NULL, NULL),
(87, NULL, NULL, '', '44', NULL, '44.00', 44, NULL, '', NULL, NULL, NULL, NULL, NULL),
(88, NULL, NULL, '', '44', NULL, '44.00', 44, NULL, '', NULL, NULL, NULL, NULL, NULL),
(89, NULL, NULL, '', '44', NULL, '44.00', 44, NULL, '', NULL, NULL, NULL, NULL, NULL),
(90, NULL, NULL, '', '44', NULL, '44.00', 44, NULL, '', NULL, NULL, NULL, NULL, NULL),
(91, NULL, NULL, '', '44', NULL, '44.00', 44, NULL, '', NULL, NULL, NULL, NULL, NULL),
(92, NULL, NULL, '', '44', NULL, '44.00', 44, NULL, '', NULL, NULL, NULL, NULL, NULL),
(93, NULL, NULL, '', '44', NULL, '44.00', 44, NULL, '', NULL, NULL, NULL, NULL, NULL),
(94, NULL, NULL, '', '44', NULL, '44.00', 44, NULL, '', NULL, NULL, NULL, NULL, NULL),
(95, NULL, NULL, '', '11', NULL, '11.00', 11, NULL, '', NULL, NULL, NULL, NULL, NULL),
(96, NULL, NULL, 'aa', 'aa', NULL, '145.00', 145, NULL, 'aa', NULL, NULL, NULL, NULL, NULL),
(97, NULL, NULL, '', '11', NULL, '11.00', 11, NULL, '', NULL, NULL, NULL, NULL, NULL),
(98, NULL, NULL, '', '11', NULL, '11.00', 11, NULL, '', NULL, NULL, NULL, NULL, NULL),
(99, NULL, NULL, '', '11', NULL, '11.00', 11, NULL, '', NULL, NULL, NULL, NULL, NULL),
(100, NULL, NULL, '', '11', NULL, '11.00', 11, NULL, '', NULL, NULL, NULL, NULL, NULL),
(101, NULL, NULL, '', '11', NULL, '11.00', 11, NULL, '', NULL, NULL, NULL, NULL, NULL),
(102, NULL, NULL, '', '11', NULL, '11.00', 11, NULL, '', NULL, NULL, NULL, NULL, NULL),
(103, NULL, NULL, '', '11', NULL, '11.00', 11, NULL, '', NULL, NULL, NULL, NULL, NULL),
(104, NULL, NULL, '', '11', NULL, '11.00', 11, NULL, '', NULL, NULL, NULL, NULL, NULL),
(105, NULL, NULL, '', '11', NULL, '11.00', 11, NULL, '', NULL, NULL, NULL, NULL, NULL),
(106, NULL, NULL, '', '11', NULL, '11.00', 11, NULL, '', NULL, NULL, NULL, NULL, NULL),
(107, NULL, NULL, '', '11', NULL, '11.00', 11, NULL, '', NULL, NULL, NULL, NULL, NULL),
(108, NULL, NULL, '', '11', NULL, '11.00', 11, NULL, '', NULL, NULL, NULL, NULL, NULL),
(109, NULL, NULL, '', '11', NULL, '11.00', 11, NULL, '', NULL, NULL, NULL, NULL, NULL),
(110, NULL, NULL, '', '11', NULL, '11.00', 11, NULL, '', NULL, NULL, NULL, NULL, NULL),
(111, '', '', '', '11', '0.00', '11.00', 11, '', '20170814080234822362.jpg', NULL, 'lll', 'Ã±ll', 'lll', '0000-00-00 00:00:00'),
(112, NULL, NULL, '', '11', NULL, '11.00', 11, NULL, 'img-producto-id-112.png', NULL, NULL, NULL, NULL, NULL),
(113, NULL, NULL, '', '11111', NULL, '11111.00', 11111, NULL, 'img-producto-id-113.jpg', NULL, NULL, NULL, NULL, NULL),
(114, NULL, NULL, '', '11111', NULL, '11111.00', 11111, NULL, 'img-producto-id-114.jpg', NULL, NULL, NULL, NULL, NULL),
(115, NULL, NULL, '', '11111', NULL, '11111.00', 11111, NULL, 'balotelli-meme-kfc.jpg', NULL, NULL, NULL, NULL, NULL),
(116, NULL, NULL, '', '11111', NULL, '11111.00', 11111, NULL, 'balotelli-meme-kfc.jpg', NULL, NULL, NULL, NULL, NULL),
(117, NULL, NULL, '', '11111', NULL, '11111.00', 11111, NULL, 'balotelli-meme-kfc.jpg', NULL, NULL, NULL, NULL, NULL),
(118, NULL, NULL, '', '444', NULL, '4444.00', 4444, NULL, 'bannerKupi2.jpg', NULL, NULL, NULL, NULL, NULL),
(119, NULL, NULL, '', '4545', NULL, '4545.00', 4545, NULL, 'error.png', NULL, NULL, NULL, NULL, NULL),
(120, NULL, NULL, '', '454545', NULL, '454545.00', 454545, NULL, 'error.png', NULL, NULL, NULL, NULL, NULL),
(121, NULL, NULL, '', '454545', NULL, '454545.00', 454545, NULL, 'cablerj45.jpg', NULL, NULL, NULL, NULL, NULL),
(122, NULL, NULL, '', '454545', NULL, '454545.00', 454545, NULL, 'img-producto-id-122', NULL, NULL, NULL, NULL, NULL),
(123, NULL, NULL, '', '454545', NULL, '454545.00', 454545, NULL, '', NULL, NULL, NULL, NULL, NULL),
(124, NULL, NULL, '', '454545', NULL, '454545.00', 454545, NULL, 'img-producto-id-124', NULL, NULL, NULL, NULL, NULL),
(125, NULL, NULL, '', '454545', NULL, '454545.00', 454545, NULL, 'img-producto-id-125', NULL, NULL, NULL, NULL, NULL),
(126, NULL, NULL, '', '454545', NULL, '454545.00', 454545, NULL, 'img-producto-id-126.jpg', NULL, NULL, NULL, NULL, NULL),
(127, NULL, NULL, '', 'ggggg', NULL, '45.00', 45, NULL, 'img-producto-id-127.png', NULL, NULL, NULL, NULL, NULL),
(128, NULL, NULL, '', 'aaa', NULL, '23.00', 23, NULL, 'img-producto-id-128.png', NULL, NULL, NULL, NULL, NULL),
(129, NULL, NULL, '', 'qqq', NULL, '11.00', 11, NULL, 'img-producto-id-129.png', NULL, NULL, NULL, NULL, NULL),
(130, '', '', '', '', '0.00', '0.00', 0, '', NULL, NULL, '', '', '', NULL),
(131, '12487374636', '2374763', 'TelevisiÃ³n', 'Marca Samsumg', '35.00', '45.00', 3, '34%', '', NULL, 'Huancayo', '23', '22232', NULL),
(132, '1111111', '1111111', '1111111', '1111', '111.00', '111.00', 111, '111', '', NULL, 'Huancayo', '323', '2342', NULL),
(133, 'aaa', 'aaa', 'aaa', 'aa', '1.00', '1.00', 1, '34%', '../../datos/inventario/imgproducto/20170814065306107609.jpg', NULL, 'aaa', 'aaa', 'aaa', NULL),
(134, '74756', '634564', '56474', '4665', '56474.00', '6374.00', 3646, '343', '20170814070056384007.png', NULL, '222', '222', '22', NULL),
(135, 'aaaa', 'aaa', 'aaa', 'aaa', '12.00', '12.00', 1, '34%', '20170814080213743028.png', NULL, '111', '11', '11', '2017-08-14 09:04:53'),
(136, '111', '111', 'Buda', '111', '111.00', '111.00', 111, '111', '20170814071021073467.jpg', NULL, '111', '111', '111', '2017-08-14 09:10:28'),
(137, '222', '222', '222', '222', '222.00', '222.00', 222, '222', '20170814071021073467.jpg', NULL, '222', '222', '222', '2017-08-14 09:11:03'),
(138, '222', '222', '222', '222', '222.00', '222.00', 222, '222', '20170814071111390884.jpg', NULL, '222', '222', '222', '2017-08-14 09:11:12'),
(139, '222', '222', '222', '222', '222.00', '222.00', 222, '222', '20170814071111390884.jpg', NULL, '222', '222', '222', '2017-08-14 09:11:18'),
(140, '4224432', '343253', 'Cable RJ45', 'Cable para interconectar', '23.00', '45.00', 21, '10%', '20170815204401305438.jpg', NULL, 'El Tambo', 'El Tambo', 'El Tambo', '2017-08-15 22:49:50'),
(141, '222', '222', '222', '222', '222.00', '222.00', 222, '222', '20170815205738202566.jpg', NULL, '222', '222', '222', '2017-08-15 22:58:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_proveedor`
--

CREATE TABLE `tb_proveedor` (
  `intIdProveedor` int(11) NOT NULL,
  `nvchDNI` varchar(8) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nvchRUC` varchar(11) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nvchRazonSocial` varchar(250) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nvchApellidoPaterno` varchar(120) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nvchApellidoMaterno` varchar(120) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nvchNombres` varchar(250) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `intIdTipoPersona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tb_proveedor`
--

INSERT INTO `tb_proveedor` (`intIdProveedor`, `nvchDNI`, `nvchRUC`, `nvchRazonSocial`, `nvchApellidoPaterno`, `nvchApellidoMaterno`, `nvchNombres`, `intIdTipoPersona`) VALUES
(1, '70019168', '2018373', 'DEVHUAYRA S.A.C.', 'Vivanco', 'NuÃ±ez', 'Hector Arturo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_solicitud_compra`
--

CREATE TABLE `tb_solicitud_compra` (
  `intIdSolicitudCompra` int(11) NOT NULL,
  `intIdUsuario` int(11) NOT NULL,
  `dtmFechaCreacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_tipo_cliente`
--

CREATE TABLE `tb_tipo_cliente` (
  `intIdTipoCliente` int(11) NOT NULL,
  `nvchNombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `nchAbreviatura` char(4) COLLATE utf8_spanish2_ci NOT NULL,
  `nvchDescripcion` varchar(350) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_tipo_comunicacion`
--

CREATE TABLE `tb_tipo_comunicacion` (
  `intIdTipoComunicacion` int(11) NOT NULL,
  `nvchNombre` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nchAbreviatura` char(5) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tb_tipo_comunicacion`
--

INSERT INTO `tb_tipo_comunicacion` (`intIdTipoComunicacion`, `nvchNombre`, `nchAbreviatura`) VALUES
(1, 'Telefono', 'TCM01'),
(2, 'Celular', 'TCM02'),
(3, 'Email', 'TCM03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_tipo_domicilio`
--

CREATE TABLE `tb_tipo_domicilio` (
  `intIdTipoDomicilio` int(11) NOT NULL,
  `nvchNombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `nchAbreviatura` char(4) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tb_tipo_domicilio`
--

INSERT INTO `tb_tipo_domicilio` (`intIdTipoDomicilio`, `nvchNombre`, `nchAbreviatura`) VALUES
(1, 'Fiscal', 'TD01'),
(2, 'Sede', 'TD02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_tipo_persona`
--

CREATE TABLE `tb_tipo_persona` (
  `intIdTipoPersona` int(11) NOT NULL,
  `nvchNombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `nchAbreviatura` char(4) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tb_tipo_persona`
--

INSERT INTO `tb_tipo_persona` (`intIdTipoPersona`, `nvchNombre`, `nchAbreviatura`) VALUES
(1, 'Persona Jurídica', 'TP01'),
(2, 'Persona Natural', 'TP02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_tipo_usuario`
--

CREATE TABLE `tb_tipo_usuario` (
  `intIdTipoUsuario` int(11) NOT NULL,
  `nvchNombre` varchar(85) COLLATE utf8_spanish2_ci NOT NULL,
  `nchAbreviatura` char(4) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_ubigeo_producto`
--

CREATE TABLE `tb_ubigeo_producto` (
  `intIdUbigeoProducto` int(11) NOT NULL,
  `nvchSucursal` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nvchGabinete` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nvchCajon` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_usuario`
--

CREATE TABLE `tb_usuario` (
  `intUserId` int(11) NOT NULL,
  `nvchUserName` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `nchUserMail` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `nvchUserPassword` varchar(1000) COLLATE utf8_spanish2_ci NOT NULL,
  `intIdEmpleado` int(11) NOT NULL,
  `intTypeUser` int(11) NOT NULL,
  `bitUserEstado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tb_usuario`
--

INSERT INTO `tb_usuario` (`intUserId`, `nvchUserName`, `nchUserMail`, `nvchUserPassword`, `intIdEmpleado`, `intTypeUser`, `bitUserEstado`) VALUES
(23, 'Junior Yauricasa', 'junioryauricasa@gmail.com', 'b06aae61bf02537aa2f6146d6697e15d', 0, 1, 1),
(24, 'Hector Vivanco', 'hctorvivanco@gmail.com', 'caad1ea01694b73af7f62b09b88a55d9', 1, 1, 1),
(31, 'Carlos Montana', 'carlosmontana@gmail.com', 'f60896751844e0e22eebe9471e0354a8', 0, 0, 1),
(32, 'Alberto Ibarra', 'albertoibarra@gmail.com', '7a2b838abf87646e3fe9bc0a6523216a', 0, 0, 0),
(33, 'Pedro Morales Mantaro', 'pedromorales@gmail.com', '3f494d1e359afca1e094f4d658b5d495', 0, 1, 0),
(34, 'Hector Arturo', 'hvivanco@gmail.com', 'elmono122', 1, 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tb_articulo`
--
ALTER TABLE `tb_articulo`
  ADD PRIMARY KEY (`intArticuloId`);

--
-- Indices de la tabla `tb_cargo`
--
ALTER TABLE `tb_cargo`
  ADD PRIMARY KEY (`intIdCargo`);

--
-- Indices de la tabla `tb_cliente`
--
ALTER TABLE `tb_cliente`
  ADD PRIMARY KEY (`intIdCliente`),
  ADD KEY `intIdTipoPersona` (`intIdTipoPersona`);

--
-- Indices de la tabla `tb_comprobante`
--
ALTER TABLE `tb_comprobante`
  ADD PRIMARY KEY (`intIdComprobante`),
  ADD KEY `intIdUsuario` (`intIdUsuario`),
  ADD KEY `intIdCliente` (`intIdCliente`);

--
-- Indices de la tabla `tb_comunicacion_cliente`
--
ALTER TABLE `tb_comunicacion_cliente`
  ADD PRIMARY KEY (`intIdComunicacionCliente`),
  ADD KEY `intIdTipoComunicacion` (`intIdTipoComunicacion`),
  ADD KEY `intIdCliente` (`intIdCliente`);

--
-- Indices de la tabla `tb_comunicacion_proveedor`
--
ALTER TABLE `tb_comunicacion_proveedor`
  ADD PRIMARY KEY (`intIdComicacionProveedor`),
  ADD KEY `intIdProveedor` (`intIdProveedor`),
  ADD KEY `intIdTipoComunicacion` (`intIdTipoComunicacion`);

--
-- Indices de la tabla `tb_cotizacion`
--
ALTER TABLE `tb_cotizacion`
  ADD PRIMARY KEY (`intIdCotizacion`),
  ADD KEY `intIdUsuario` (`intIdUsuario`),
  ADD KEY `intIdCliente` (`intIdCliente`);

--
-- Indices de la tabla `tb_creacion_reporte`
--
ALTER TABLE `tb_creacion_reporte`
  ADD PRIMARY KEY (`intidReporteCreado`);

--
-- Indices de la tabla `tb_detalle_cotizacion`
--
ALTER TABLE `tb_detalle_cotizacion`
  ADD PRIMARY KEY (`intIdOperacion`),
  ADD KEY `intIdCotizacion` (`intIdCotizacion`),
  ADD KEY `intIdProducto` (`intIdProducto`);

--
-- Indices de la tabla `tb_detalle_guia_interna_entrada`
--
ALTER TABLE `tb_detalle_guia_interna_entrada`
  ADD PRIMARY KEY (`intIdOperacion`),
  ADD KEY `intIdGuiaInternaEntrada` (`intIdGuiaInternaEntrada`),
  ADD KEY `intIdProducto` (`intIdProducto`);

--
-- Indices de la tabla `tb_detalle_guia_interna_salida`
--
ALTER TABLE `tb_detalle_guia_interna_salida`
  ADD PRIMARY KEY (`intIdOperacion`),
  ADD KEY `intIdGuiaInternaSalida` (`intIdGuiaInternaSalida`),
  ADD KEY `intIdProducto` (`intIdProducto`);

--
-- Indices de la tabla `tb_detalle_orden_compra`
--
ALTER TABLE `tb_detalle_orden_compra`
  ADD PRIMARY KEY (`intIdOperacion`),
  ADD KEY `intIdProducto` (`intIdProducto`),
  ADD KEY `intIdOrdenCompra` (`intIdOrdenCompra`);

--
-- Indices de la tabla `tb_detalle_solicitud_compra`
--
ALTER TABLE `tb_detalle_solicitud_compra`
  ADD PRIMARY KEY (`intIdOperacion`),
  ADD KEY `intIdProducto` (`intIdProducto`),
  ADD KEY `intIdSolicitudCompra` (`intIdSolicitudCompra`);

--
-- Indices de la tabla `tb_domicilio_cliente`
--
ALTER TABLE `tb_domicilio_cliente`
  ADD PRIMARY KEY (`intIdDomicilioCliente`),
  ADD KEY `intIdTelefonoCliente` (`intIdTelefonoCliente`),
  ADD KEY `intIdCelularCliente` (`intIdCelularCliente`),
  ADD KEY `intIdTipoDomicilio` (`intIdTipoDomicilio`),
  ADD KEY `intIdCliente` (`intIdCliente`);

--
-- Indices de la tabla `tb_domicilio_proveedor`
--
ALTER TABLE `tb_domicilio_proveedor`
  ADD PRIMARY KEY (`intIdDomicilioProveedor`),
  ADD KEY `intIdProveedor` (`intIdProveedor`),
  ADD KEY `intIdTipoDomicilio` (`intIdTipoDomicilio`);

--
-- Indices de la tabla `tb_empleado`
--
ALTER TABLE `tb_empleado`
  ADD PRIMARY KEY (`intIdEmpleado`),
  ADD KEY `intIdCargo` (`intIdCargo`);

--
-- Indices de la tabla `tb_guia_interna_entrada`
--
ALTER TABLE `tb_guia_interna_entrada`
  ADD PRIMARY KEY (`intIdGuiaInternaEntrada`),
  ADD KEY `intIdUsuario` (`intIdUsuario`),
  ADD KEY `intIdProveedor` (`intIdProveedor`);

--
-- Indices de la tabla `tb_guia_interna_salida`
--
ALTER TABLE `tb_guia_interna_salida`
  ADD PRIMARY KEY (`intIdGuiaInternaSalida`),
  ADD UNIQUE KEY `intIdCliente` (`intIdCliente`),
  ADD KEY `intIdUsuario` (`intIdUsuario`);

--
-- Indices de la tabla `tb_historyaccess`
--
ALTER TABLE `tb_historyaccess`
  ADD PRIMARY KEY (`intIdHistory`);

--
-- Indices de la tabla `tb_justificacion_solicitud_compra`
--
ALTER TABLE `tb_justificacion_solicitud_compra`
  ADD PRIMARY KEY (`intIdJustificacion`),
  ADD KEY `intIdSolicitudCompra` (`intIdSolicitudCompra`);

--
-- Indices de la tabla `tb_observacion_cotizacion`
--
ALTER TABLE `tb_observacion_cotizacion`
  ADD PRIMARY KEY (`intIdObservacion`),
  ADD KEY `intIdCotizacion` (`intIdCotizacion`);

--
-- Indices de la tabla `tb_orden_compra`
--
ALTER TABLE `tb_orden_compra`
  ADD PRIMARY KEY (`intIdOrdenCompra`),
  ADD KEY `intIdProveedor` (`intIdProveedor`),
  ADD KEY `intIdUsuario` (`intIdUsuario`);

--
-- Indices de la tabla `tb_producto`
--
ALTER TABLE `tb_producto`
  ADD PRIMARY KEY (`intIdProducto`),
  ADD KEY `intIdUbigeoProducto` (`intIdUbigeoProducto`);

--
-- Indices de la tabla `tb_proveedor`
--
ALTER TABLE `tb_proveedor`
  ADD PRIMARY KEY (`intIdProveedor`),
  ADD KEY `intIdTipoPersona` (`intIdTipoPersona`);

--
-- Indices de la tabla `tb_solicitud_compra`
--
ALTER TABLE `tb_solicitud_compra`
  ADD PRIMARY KEY (`intIdSolicitudCompra`),
  ADD KEY `intIdUsuario` (`intIdUsuario`);

--
-- Indices de la tabla `tb_tipo_cliente`
--
ALTER TABLE `tb_tipo_cliente`
  ADD PRIMARY KEY (`intIdTipoCliente`);

--
-- Indices de la tabla `tb_tipo_comunicacion`
--
ALTER TABLE `tb_tipo_comunicacion`
  ADD PRIMARY KEY (`intIdTipoComunicacion`);

--
-- Indices de la tabla `tb_tipo_domicilio`
--
ALTER TABLE `tb_tipo_domicilio`
  ADD PRIMARY KEY (`intIdTipoDomicilio`);

--
-- Indices de la tabla `tb_tipo_persona`
--
ALTER TABLE `tb_tipo_persona`
  ADD PRIMARY KEY (`intIdTipoPersona`);

--
-- Indices de la tabla `tb_tipo_usuario`
--
ALTER TABLE `tb_tipo_usuario`
  ADD PRIMARY KEY (`intIdTipoUsuario`);

--
-- Indices de la tabla `tb_ubigeo_producto`
--
ALTER TABLE `tb_ubigeo_producto`
  ADD PRIMARY KEY (`intIdUbigeoProducto`);

--
-- Indices de la tabla `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD PRIMARY KEY (`intUserId`),
  ADD KEY `intIdTipoUsuario` (`nvchUserPassword`(255)),
  ADD KEY `intIdEmpleado` (`intIdEmpleado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tb_articulo`
--
ALTER TABLE `tb_articulo`
  MODIFY `intArticuloId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tb_cargo`
--
ALTER TABLE `tb_cargo`
  MODIFY `intIdCargo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tb_cliente`
--
ALTER TABLE `tb_cliente`
  MODIFY `intIdCliente` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tb_comprobante`
--
ALTER TABLE `tb_comprobante`
  MODIFY `intIdComprobante` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tb_comunicacion_cliente`
--
ALTER TABLE `tb_comunicacion_cliente`
  MODIFY `intIdComunicacionCliente` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tb_comunicacion_proveedor`
--
ALTER TABLE `tb_comunicacion_proveedor`
  MODIFY `intIdComicacionProveedor` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tb_cotizacion`
--
ALTER TABLE `tb_cotizacion`
  MODIFY `intIdCotizacion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tb_creacion_reporte`
--
ALTER TABLE `tb_creacion_reporte`
  MODIFY `intidReporteCreado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT de la tabla `tb_detalle_guia_interna_entrada`
--
ALTER TABLE `tb_detalle_guia_interna_entrada`
  MODIFY `intIdOperacion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tb_detalle_guia_interna_salida`
--
ALTER TABLE `tb_detalle_guia_interna_salida`
  MODIFY `intIdOperacion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tb_detalle_orden_compra`
--
ALTER TABLE `tb_detalle_orden_compra`
  MODIFY `intIdOperacion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tb_detalle_solicitud_compra`
--
ALTER TABLE `tb_detalle_solicitud_compra`
  MODIFY `intIdOperacion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tb_domicilio_cliente`
--
ALTER TABLE `tb_domicilio_cliente`
  MODIFY `intIdDomicilioCliente` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tb_domicilio_proveedor`
--
ALTER TABLE `tb_domicilio_proveedor`
  MODIFY `intIdDomicilioProveedor` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tb_empleado`
--
ALTER TABLE `tb_empleado`
  MODIFY `intIdEmpleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tb_guia_interna_entrada`
--
ALTER TABLE `tb_guia_interna_entrada`
  MODIFY `intIdGuiaInternaEntrada` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tb_guia_interna_salida`
--
ALTER TABLE `tb_guia_interna_salida`
  MODIFY `intIdGuiaInternaSalida` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tb_historyaccess`
--
ALTER TABLE `tb_historyaccess`
  MODIFY `intIdHistory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de la tabla `tb_justificacion_solicitud_compra`
--
ALTER TABLE `tb_justificacion_solicitud_compra`
  MODIFY `intIdJustificacion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tb_observacion_cotizacion`
--
ALTER TABLE `tb_observacion_cotizacion`
  MODIFY `intIdObservacion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tb_orden_compra`
--
ALTER TABLE `tb_orden_compra`
  MODIFY `intIdOrdenCompra` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tb_producto`
--
ALTER TABLE `tb_producto`
  MODIFY `intIdProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;
--
-- AUTO_INCREMENT de la tabla `tb_proveedor`
--
ALTER TABLE `tb_proveedor`
  MODIFY `intIdProveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tb_solicitud_compra`
--
ALTER TABLE `tb_solicitud_compra`
  MODIFY `intIdSolicitudCompra` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tb_tipo_comunicacion`
--
ALTER TABLE `tb_tipo_comunicacion`
  MODIFY `intIdTipoComunicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tb_tipo_domicilio`
--
ALTER TABLE `tb_tipo_domicilio`
  MODIFY `intIdTipoDomicilio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tb_tipo_persona`
--
ALTER TABLE `tb_tipo_persona`
  MODIFY `intIdTipoPersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tb_tipo_usuario`
--
ALTER TABLE `tb_tipo_usuario`
  MODIFY `intIdTipoUsuario` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tb_usuario`
--
ALTER TABLE `tb_usuario`
  MODIFY `intUserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
