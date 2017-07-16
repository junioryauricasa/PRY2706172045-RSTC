-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-07-2017 a las 01:30:34
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_resteco`
--

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
-- Estructura de tabla para la tabla `tb_celular_cliente`
--

CREATE TABLE `tb_celular_cliente` (
  `intIdCelularCliente` int(11) NOT NULL,
  `intIdCliente` int(11) NOT NULL,
  `nvchCelular` varchar(20) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_celular_proveedor`
--

CREATE TABLE `tb_celular_proveedor` (
  `intIdCelularProveedor` int(11) NOT NULL,
  `intIdProveedor` int(11) NOT NULL,
  `nvchCelular` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_cliente`
--

CREATE TABLE `tb_cliente` (
  `intIdCliente` int(11) NOT NULL,
  `nchDNI` char(8) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nchRUC` char(11) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nvchRazonSocial` varchar(250) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nvchApellidoPaterno` varchar(120) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nvchApellidoMaterno` varchar(120) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nvchNombres` varchar(250) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `intIdTipoPersona` int(11) NOT NULL,
  `intIdTipoCliente` int(11) NOT NULL
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
  `intIdTelefonoProveedor` int(11) NOT NULL,
  `intIdCelularProveedor` int(11) NOT NULL,
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
(2, 2, 'Sábado 15 de Julio del 2017, 1:47:08 horas', '102.10.10.12', 'Android'),
(3, 1, 'Sábado 15 de Julio del 2017, 3:53:35 horas', '193.10.14.124', 'Chrome'),
(4, 1, 'Sábado 15 de Junio del 2016, 3:53:35 horas', '193.10.14.124', 'Ipad');

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
  `nvchNombre` varchar(250) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `dcmPrecio` decimal(11,2) DEFAULT NULL,
  `intCantidad` int(11) DEFAULT NULL,
  `nvchDireccionImg` varchar(450) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nvchDescripcion` varchar(500) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `intIdUbigeoProducto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_proveedor`
--

CREATE TABLE `tb_proveedor` (
  `intIdProveedor` int(11) NOT NULL,
  `nchDNI` char(8) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nchRUC` char(11) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nvchRazonSocial` varchar(250) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nvchApellidoPaterno` varchar(120) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nvchApellidoMaterno` varchar(120) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nvchNombres` varchar(250) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `intIdTipoPersona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

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
-- Estructura de tabla para la tabla `tb_telefono_cliente`
--

CREATE TABLE `tb_telefono_cliente` (
  `intIdTelefonoCliente` int(11) NOT NULL,
  `intIdCliente` int(11) NOT NULL,
  `nvchTelefono` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_telefono_proveedor`
--

CREATE TABLE `tb_telefono_proveedor` (
  `intIdTelefonoProveedor` int(11) NOT NULL,
  `intIdProveedor` int(11) NOT NULL,
  `nvchTelefono` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
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
-- Estructura de tabla para la tabla `tb_tipo_domicilio`
--

CREATE TABLE `tb_tipo_domicilio` (
  `intIdTipoDomicilio` int(11) NOT NULL,
  `nvchNombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `nchAbreviatura` char(4) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_tipo_persona`
--

CREATE TABLE `tb_tipo_persona` (
  `intIdTipoPersona` int(11) NOT NULL,
  `nvchNombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `nchAbreviatura` char(4) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

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
(69, 'Junior Yauricasa', 'junioryauricasa@gmail.com', 'b06aae61bf02537aa2f6146d6697e15d', 0, 0, 1),
(70, 'Hector Vivanco ', 'hvivanco@gmail.com', '60eaf19b52212cae6b0e69f3d4a97bfe', 0, 0, 1),
(71, 'Luis Sanchez', 'luissanchez@gmail.com', '9bdddfd73d9b5a28816a58bedff2f817', 0, 0, 0);

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
-- Indices de la tabla `tb_celular_cliente`
--
ALTER TABLE `tb_celular_cliente`
  ADD PRIMARY KEY (`intIdCelularCliente`),
  ADD KEY `intIdCliente` (`intIdCliente`);

--
-- Indices de la tabla `tb_celular_proveedor`
--
ALTER TABLE `tb_celular_proveedor`
  ADD PRIMARY KEY (`intIdCelularProveedor`),
  ADD KEY `intIdProveedor` (`intIdProveedor`);

--
-- Indices de la tabla `tb_cliente`
--
ALTER TABLE `tb_cliente`
  ADD PRIMARY KEY (`intIdCliente`),
  ADD KEY `intIdTipoPersona` (`intIdTipoPersona`),
  ADD KEY `intIdTipoCliente` (`intIdTipoCliente`);

--
-- Indices de la tabla `tb_comprobante`
--
ALTER TABLE `tb_comprobante`
  ADD PRIMARY KEY (`intIdComprobante`),
  ADD KEY `intIdUsuario` (`intIdUsuario`),
  ADD KEY `intIdCliente` (`intIdCliente`);

--
-- Indices de la tabla `tb_cotizacion`
--
ALTER TABLE `tb_cotizacion`
  ADD PRIMARY KEY (`intIdCotizacion`),
  ADD KEY `intIdUsuario` (`intIdUsuario`),
  ADD KEY `intIdCliente` (`intIdCliente`);

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
  ADD KEY `intIdTelefonoProveedor` (`intIdTelefonoProveedor`),
  ADD KEY `intIdCelularProveedor` (`intIdCelularProveedor`),
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
-- Indices de la tabla `tb_telefono_cliente`
--
ALTER TABLE `tb_telefono_cliente`
  ADD PRIMARY KEY (`intIdTelefonoCliente`),
  ADD KEY `intIdCliente` (`intIdCliente`);

--
-- Indices de la tabla `tb_telefono_proveedor`
--
ALTER TABLE `tb_telefono_proveedor`
  ADD PRIMARY KEY (`intIdTelefonoProveedor`),
  ADD KEY `intIdProveedor` (`intIdProveedor`);

--
-- Indices de la tabla `tb_tipo_cliente`
--
ALTER TABLE `tb_tipo_cliente`
  ADD PRIMARY KEY (`intIdTipoCliente`);

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
-- AUTO_INCREMENT de la tabla `tb_celular_cliente`
--
ALTER TABLE `tb_celular_cliente`
  MODIFY `intIdCelularCliente` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tb_celular_proveedor`
--
ALTER TABLE `tb_celular_proveedor`
  MODIFY `intIdCelularProveedor` int(11) NOT NULL AUTO_INCREMENT;
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
-- AUTO_INCREMENT de la tabla `tb_cotizacion`
--
ALTER TABLE `tb_cotizacion`
  MODIFY `intIdCotizacion` int(11) NOT NULL AUTO_INCREMENT;
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
  MODIFY `intIdHistory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
  MODIFY `intIdProducto` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tb_proveedor`
--
ALTER TABLE `tb_proveedor`
  MODIFY `intIdProveedor` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tb_solicitud_compra`
--
ALTER TABLE `tb_solicitud_compra`
  MODIFY `intIdSolicitudCompra` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tb_tipo_usuario`
--
ALTER TABLE `tb_tipo_usuario`
  MODIFY `intIdTipoUsuario` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tb_usuario`
--
ALTER TABLE `tb_usuario`
  MODIFY `intUserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
