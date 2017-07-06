-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-07-2017 a las 11:28:24
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
-- Estructura de tabla para la tabla `tb_historyaccess`
--

CREATE TABLE `tb_historyaccess` (
  `intIdHistory` int(11) NOT NULL,
  `intIdUser` int(11) NOT NULL,
  `dateDateAccesso` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `nvchIpAccesso` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `nvchBrowser` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_user`
--

CREATE TABLE `tb_user` (
  `intUserId` int(11) NOT NULL,
  `nvchUserName` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `nchUserMail` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `nvchUserPassword` varchar(1000) COLLATE utf8_spanish2_ci NOT NULL,
  `intTypeUser` int(11) NOT NULL COMMENT ' ',
  `bitUserEstado` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tb_user`
--

INSERT INTO `tb_user` (`intUserId`, `nvchUserName`, `nchUserMail`, `nvchUserPassword`, `intTypeUser`, `bitUserEstado`) VALUES
(1, 'Junior Yauricasa', 'junioryauricasa@gmail.com', 'b06aae61bf02537aa2f6146d6697e15d', 0, b'1'),
(2, 'Hector Vivanco', 'hectorvivanco@gmail.com', 'f85097dddc73c0bf16ae8a9371aad425', 0, b'1'),
(3, 'Luis Sanchez', 'luissanchez@gmail.com', '9bdddfd73d9b5a28816a58bedff2f817', 0, b'0');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tb_articulo`
--
ALTER TABLE `tb_articulo`
  ADD PRIMARY KEY (`intArticuloId`);

--
-- Indices de la tabla `tb_historyaccess`
--
ALTER TABLE `tb_historyaccess`
  ADD PRIMARY KEY (`intIdHistory`);

--
-- Indices de la tabla `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`intUserId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tb_articulo`
--
ALTER TABLE `tb_articulo`
  MODIFY `intArticuloId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tb_historyaccess`
--
ALTER TABLE `tb_historyaccess`
  MODIFY `intIdHistory` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `intUserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
