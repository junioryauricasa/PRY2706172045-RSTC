create database db_resteco;
use db_resteco;
-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-06-2017 a las 13:48:14
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
-- Estructura de tabla para la tabla `tb_user`
--

CREATE TABLE `tb_user` (
  `intUserId` int(11) NOT NULL,
  `nchUserMail` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `nvchUserPassword` varchar(1000) COLLATE utf8_spanish2_ci NOT NULL,
  `bitUserEstado` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tb_user`
--

INSERT INTO `tb_user` (`intUserId`, `nchUserMail`, `nvchUserPassword`, `bitUserEstado`) VALUES
(1, 'junioryauricasa@gmail.com', 'b06aae61bf02537aa2f6146d6697e15d', b'0'),
(2, 'hectorvivanco@gmail.com', 'f85097dddc73c0bf16ae8a9371aad425', b'1'),
(3, 'luissanchez@gmail.com', '9bdddfd73d9b5a28816a58bedff2f817', b'0');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tb_articulo`
--
ALTER TABLE `tb_articulo`
  ADD PRIMARY KEY (`intArticuloId`);

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
-- AUTO_INCREMENT de la tabla `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `intUserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
