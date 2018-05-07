-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 07-05-2018 a las 06:39:09
-- Versión del servidor: 10.1.29-MariaDB
-- Versión de PHP: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prode`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `id` int(11) NOT NULL,
  `cod` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bandera` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `grupo` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`id`, `cod`, `nombre`, `bandera`, `grupo`) VALUES
(1, 'rus', 'Rusia', 'rusia.png', 'a'),
(2, 'egp', 'Egipto', 'egipto.png', 'a'),
(3, 'ara', 'Arabia Saudita', 'arabia.png', 'a'),
(4, 'uru', 'Uruguay', 'uruguay.png', 'a'),
(5, 'ira', 'Irán', 'iran.png', 'b'),
(6, 'mar', 'Marruecos', 'marruecos.png', 'b'),
(7, 'por', 'Portugal', 'portugal.png', 'b'),
(8, 'esp', 'España', 'españa.png', 'b'),
(9, 'aus', 'Australia', 'australia.png', 'c'),
(10, 'din', 'Dinamarca', 'dinamarca.png', 'c'),
(11, 'fra', 'Francia', 'francia.png', 'c'),
(12, 'per', 'Perú', 'peru.png', 'c'),
(13, 'arg', 'Argentina', 'argentina.png', 'd'),
(14, 'cro', 'Croacia', 'croacia.png', 'd'),
(15, 'isl', 'Islandia', 'islandia.png', 'd'),
(16, 'nig', 'Nigeria', 'nigeria.png', 'd'),
(17, 'bra', 'Brasil', 'brasil.png', 'e'),
(18, 'crc', 'Costa Rica', 'costa.png', 'e'),
(19, 'sui', 'Suiza', 'suiza.png', 'e'),
(20, 'ser', 'Serbia', 'serbia.png', 'e'),
(21, 'ale', 'Alemania', 'alemania.png', 'f'),
(22, 'cor', 'Corea del Sur', 'corea.png', 'f'),
(23, 'mex', 'México', 'mexico.png', 'f'),
(24, 'sue', 'Suecia', 'suecia.png', 'f'),
(25, 'bel', 'Bélgica', 'belgica.png', 'g'),
(26, 'ing', 'Inglaterra', 'inglaterra.png', 'g'),
(27, 'pan', 'Panamá', 'panama.png', 'g'),
(28, 'tnz', 'Túnez', 'tunez.png', 'g'),
(29, 'col', 'Colombia', 'colombia.png', 'h'),
(30, 'jpn', 'Japón', 'japon.png', 'h'),
(31, 'pol', 'Polonia', 'polonia.png', 'h'),
(32, 'sen', 'Senegal', 'senegal.png', 'h');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fos_user`
--

CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `equipo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `legajo` int(11) NOT NULL,
  `fech_alta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `nombre`, `apellido`, `equipo`, `legajo`, `fech_alta`) VALUES
(1, 'beto', 'beto', 'a@a.com', 'a@a.com', 1, 'lbf0skypstcg8wsgo0owoc0w4048oww', '$2y$13$lbf0skypstcg8wsgo0owoOK28Dg7/pIo2.IYupMShAm/t9vnsWU9C', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'vasella', 'vasella', 'tito', 22222, '0000-00-00'),
(2, 'tito', 'tito', 'a@aa.com', 'a@aa.com', 1, 'bnh4bd55dag4gck4w884c44808ck8kg', '$2y$13$bnh4bd55dag4gck4w884cu6qSLCMHJtOMC5yCW91frse1hN/0/AXi', '2018-05-07 02:25:40', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'tito', 'tito', 'pincha', 333, '2018-05-05'),
(25, 'tata', 'tata', 'ta@ta.com', 'ta@ta.com', 1, 'q40bgpkdvlwgg8440wsogwcsokw04g0', '$2y$13$q40bgpkdvlwgg8440wsogud0MTMtdEK5buxDprWMk48tSjOSMQ6Nm', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'tata', 'tata', 'ta', 3, '2018-05-07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partido`
--

CREATE TABLE `partido` (
  `id` int(11) NOT NULL,
  `equipo1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `resultado1` int(11) DEFAULT NULL,
  `equipo2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `resultado2` int(11) DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `grupo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `partido`
--

INSERT INTO `partido` (`id`, `equipo1`, `resultado1`, `equipo2`, `resultado2`, `fecha`, `grupo`) VALUES
(1, 'rus', 0, 'ara', 0, '2018-06-14 12:00:00', 'A'),
(2, 'egp', 0, 'uru', 0, '2018-06-15 09:00:00', 'A'),
(3, 'mar', 0, 'ira', 0, '2018-06-15 12:00:00', 'B'),
(4, 'por', 0, 'esp', 0, '2018-06-15 15:00:00', 'B'),
(5, 'fra', 0, 'aus', 0, '2018-06-16 07:00:00', 'C'),
(6, 'arg', 0, 'isl', 0, '2018-06-16 10:00:00', 'D'),
(7, 'per', 0, 'din', 0, '2018-06-16 13:00:00', 'C'),
(8, 'cro', 0, 'nig', 0, '2018-06-16 16:00:00', 'D'),
(9, 'crc', 0, 'ser', 0, '2018-06-17 09:00:00', 'E'),
(10, 'ale', 0, 'mex', 0, '2018-06-17 12:00:00', 'F'),
(11, 'bra', 0, 'sui', 0, '2018-06-17 15:00:00', 'E'),
(12, 'sue', 0, 'cor', 0, '2018-06-18 09:00:00', 'F'),
(13, 'bel', 0, 'pan', 0, '2018-06-18 12:00:00', 'G'),
(14, 'tnz', 0, 'ing', 0, '2018-06-18 15:00:00', 'G'),
(15, 'col', 0, 'jpn', 0, '2018-06-19 09:00:00', 'H'),
(16, 'pol', 0, 'sen', 0, '2018-06-19 12:00:00', 'H'),
(17, 'rus', 0, 'egp', 0, '2018-06-19 15:00:00', 'A'),
(18, 'por', 0, 'mar', 0, '2018-06-20 09:00:00', 'B'),
(19, 'uru', 0, 'ara', 0, '2018-06-20 12:00:00', 'A'),
(20, 'ira', 0, 'esp', 0, '2018-06-20 15:00:00', 'B'),
(21, 'din', 0, 'aus', 0, '2018-06-21 09:00:00', 'C'),
(22, 'fra', 0, 'per', 0, '2018-06-21 12:00:00', 'C'),
(23, 'arg', 0, 'cro', 0, '2018-06-21 15:00:00', 'D'),
(24, 'bra', 0, 'crc', 0, '2018-06-22 09:00:00', 'E'),
(25, 'nig', 0, 'isl', 0, '2018-06-22 12:00:00', 'D'),
(26, 'ser', 0, 'sui', 0, '2018-06-22 15:00:00', 'E'),
(27, 'bel', 0, 'tnz', 0, '2018-06-23 09:00:00', 'G'),
(28, 'cor', 0, 'mex', 0, '2018-06-23 12:00:00', 'F'),
(29, 'ale', 0, 'sue', 0, '2018-06-23 15:00:00', 'F'),
(30, 'ing', 0, 'pan', 0, '2018-06-24 09:00:00', 'G'),
(31, 'jpn', 0, 'sen', 0, '2018-06-24 12:00:00', 'H'),
(32, 'pol', 0, 'col', 0, '2018-06-24 15:00:00', 'H'),
(33, 'uru', 0, 'rus', 0, '2018-06-25 11:00:00', 'A'),
(34, 'ara', 0, 'egp', 0, '2018-06-25 11:00:00', 'A'),
(35, 'esp', 0, 'mar', 0, '2018-06-25 15:00:00', 'B'),
(36, 'ira', 0, 'por', 0, '2018-06-25 15:00:00', 'B'),
(37, 'din', 0, 'fra', 0, '2018-06-26 11:00:00', 'C'),
(38, 'aus', 0, 'per', 0, '2018-06-26 11:00:00', 'C'),
(39, 'isl', 0, 'cro', 0, '2018-06-26 15:00:00', 'D'),
(40, 'nig', 0, 'arg', 0, '2018-06-26 15:00:00', 'D'),
(41, 'mex', 0, 'sue', 0, '2018-06-27 11:00:00', 'F'),
(42, 'cor', 0, 'ale', 0, '2018-06-27 11:00:00', 'F'),
(43, 'ser', 0, 'bra', 0, '2018-06-27 15:00:00', 'E'),
(44, 'sui', 0, 'crc', 0, '2018-06-27 15:00:00', 'E'),
(45, 'jpn', 0, 'pol', 0, '2018-06-28 11:00:00', 'H'),
(46, 'sen', 0, 'col', 0, '2018-06-28 11:00:00', 'H'),
(47, 'ing', 0, 'bel', 0, '2018-06-28 15:00:00', 'G'),
(48, 'pan', 0, 'tnz', 0, '2018-06-28 15:00:00', 'G'),
(49, '', 0, NULL, 0, '2018-06-30 11:00:00', 'Octavos'),
(50, '', 0, NULL, 0, '2018-06-30 15:00:00', 'Octavos'),
(51, '', 0, NULL, 0, '2018-07-01 11:00:00', 'Octavos'),
(52, '', 0, NULL, 0, '2018-07-01 15:00:00', 'Octavos'),
(53, '', 0, NULL, 0, '2018-07-02 11:00:00', 'Octavos'),
(54, '', 0, NULL, 0, '2018-07-02 15:00:00', 'Octavos'),
(55, '', 0, NULL, 0, '2018-07-03 11:00:00', 'Octavos'),
(56, '', 0, NULL, 0, '2018-07-03 15:00:00', 'Octavos'),
(57, '', 0, NULL, 0, '2018-07-06 11:00:00', 'Cuartos'),
(58, '', 0, NULL, 0, '2018-07-06 15:00:00', 'Cuartos'),
(59, '', 0, NULL, 0, '2018-07-07 11:00:00', 'Cuartos'),
(60, '', 0, NULL, 0, '2018-07-07 15:00:00', 'Cuartos'),
(61, '', 0, NULL, 0, '2018-10-07 15:00:00', 'Semifinales'),
(62, '', 0, NULL, 0, '2018-10-07 15:00:00', 'Semifinales'),
(63, '', 0, NULL, 0, '2018-07-04 11:00:00', 'Tercer Puesto'),
(64, '', 0, NULL, 0, '2018-07-15 12:00:00', 'Final');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pronostico`
--

CREATE TABLE `pronostico` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `resultado1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `resultado2` int(11) NOT NULL,
  `sp` tinyint(1) NOT NULL,
  `pron` tinyint(1) DEFAULT NULL,
  `res` tinyint(1) NOT NULL,
  `id_partido_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fos_user`
--
ALTER TABLE `fos_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`);

--
-- Indices de la tabla `partido`
--
ALTER TABLE `partido`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pronostico`
--
ALTER TABLE `pronostico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_21DF249BB40FEE63` (`id_partido_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `fos_user`
--
ALTER TABLE `fos_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `partido`
--
ALTER TABLE `partido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `pronostico`
--
ALTER TABLE `pronostico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pronostico`
--
ALTER TABLE `pronostico`
  ADD CONSTRAINT `FK_21DF249BB40FEE63` FOREIGN KEY (`id_partido_id`) REFERENCES `partido` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
