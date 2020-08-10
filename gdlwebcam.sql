-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 08-08-2020 a las 21:52:28
-- Versión del servidor: 5.7.31-0ubuntu0.18.04.1
-- Versión de PHP: 7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gdlwebcam`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` tinyint(4) NOT NULL,
  `categoria` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `icono` varchar(15) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `categoria`, `icono`) VALUES
(1, 'Seminarios', 'fa-university'),
(2, 'Conferencias', 'fa-comment'),
(3, 'Talleres', 'fa-code');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `id_evento` tinyint(4) NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `clave` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `id_categoria` tinyint(4) NOT NULL,
  `id_invitado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `evento`
--

INSERT INTO `evento` (`id_evento`, `nombre`, `fecha`, `hora`, `clave`, `id_categoria`, `id_invitado`) VALUES
(2, 'HTML5, CSS, JavaScript', '2020-07-09', '15:00:00', 'ta_01', 3, 2),
(3, 'Responsive Web Desing', '2020-07-10', '17:10:00', 'ta_02', 3, 4),
(4, 'Como ser Freelancer', '2020-07-09', '18:10:00', 'co_01', 2, 1),
(5, 'Tecnologías del Futuro', '2020-07-10', '18:10:00', 'co_02', 2, 6),
(6, 'UI/UX para móviles', '2020-07-12', '17:10:00', 'se_01', 1, 5),
(7, 'Mecanografía de 0 a experto', '2020-07-12', '16:00:00', 'se_02', 1, 2),
(8, 'Responsive Web Design', '2016-12-09', '10:00:00', 'taller_01', 3, 1),
(9, 'Flexbox', '2016-12-09', '12:00:00', 'taller_02', 3, 2),
(10, 'HTML5 y CSS3', '2016-12-09', '14:00:00', 'taller_03', 3, 3),
(11, 'Drupal', '2016-12-09', '17:00:00', 'taller_04', 3, 4),
(12, 'WordPress', '2016-12-09', '19:00:00', 'taller_05', 3, 5),
(13, 'Como ser freelancer', '2016-12-09', '10:00:00', 'conf_01', 2, 6),
(14, 'Tecnologías del Futuro', '2016-12-09', '17:00:00', 'conf_02', 2, 1),
(15, 'Seguridad en la Web', '2016-12-09', '19:00:00', 'conf_03', 2, 2),
(16, 'Diseño UI y UX para móviles', '2016-12-09', '10:00:00', 'sem_01', 1, 6),
(17, 'AngularJS', '2016-12-10', '10:00:00', 'taller_06', 3, 1),
(18, 'PHP y MySQL', '2016-12-10', '12:00:00', 'taller_07', 3, 2),
(19, 'JavaScript Avanzado', '2016-12-10', '14:00:00', 'taller_08', 3, 3),
(20, 'SEO en Google', '2016-12-10', '17:00:00', 'taller_09', 3, 4),
(21, 'De Photoshop a HTML5 y CSS3', '2016-12-10', '19:00:00', 'taller_10', 3, 5),
(22, 'PHP Intermedio y Avanzado', '2016-12-10', '21:00:00', 'taller_11', 3, 6),
(23, 'Responsive Web Design', '2016-12-09', '10:00:00', 'taller_01', 3, 1),
(24, 'Flexbox', '2016-12-09', '12:00:00', 'taller_02', 3, 2),
(25, 'HTML5 y CSS3', '2016-12-09', '14:00:00', 'taller_03', 3, 3),
(26, 'Drupal', '2016-12-09', '17:00:00', 'taller_04', 3, 4),
(27, 'WordPress', '2016-12-09', '19:00:00', 'taller_05', 3, 5),
(28, 'Como ser freelancer', '2016-12-09', '10:00:00', 'conf_01', 2, 6),
(29, 'Tecnologías del Futuro', '2016-12-09', '17:00:00', 'conf_02', 2, 1),
(30, 'Seguridad en la Web', '2016-12-09', '19:00:00', 'conf_03', 2, 2),
(31, 'Diseño UI y UX para móviles', '2016-12-09', '10:00:00', 'sem_01', 1, 6),
(32, 'AngularJS', '2016-12-10', '10:00:00', 'taller_06', 3, 1),
(33, 'PHP y MySQL', '2016-12-10', '12:00:00', 'taller_07', 3, 2),
(34, 'JavaScript Avanzado', '2016-12-10', '14:00:00', 'taller_08', 3, 3),
(35, 'SEO en Google', '2016-12-10', '17:00:00', 'taller_09', 3, 4),
(36, 'De Photoshop a HTML5 y CSS3', '2016-12-10', '19:00:00', 'taller_10', 3, 5),
(37, 'PHP Intermedio y Avanzado', '2016-12-10', '21:00:00', 'taller_11', 3, 6),
(38, 'Responsive Web Design', '2016-12-09', '10:00:00', 'taller_01', 3, 1),
(39, 'Flexbox', '2016-12-09', '12:00:00', 'taller_02', 3, 2),
(40, 'HTML5 y CSS3', '2016-12-09', '14:00:00', 'taller_03', 3, 3),
(41, 'Drupal', '2016-12-09', '17:00:00', 'taller_04', 3, 4),
(42, 'WordPress', '2016-12-09', '19:00:00', 'taller_05', 3, 5),
(43, 'Como ser freelancer', '2016-12-09', '10:00:00', 'conf_01', 2, 6),
(44, 'Tecnologías del Futuro', '2016-12-09', '17:00:00', 'conf_02', 2, 1),
(45, 'Seguridad en la Web', '2016-12-09', '19:00:00', 'conf_03', 2, 2),
(46, 'Diseño UI y UX para móviles', '2016-12-09', '10:00:00', 'sem_01', 1, 6),
(47, 'AngularJS', '2016-12-10', '10:00:00', 'taller_06', 3, 1),
(48, 'PHP y MySQL', '2016-12-10', '12:00:00', 'taller_07', 3, 2),
(49, 'JavaScript Avanzado', '2016-12-10', '14:00:00', 'taller_08', 3, 3),
(50, 'SEO en Google', '2016-12-10', '17:00:00', 'taller_09', 3, 4),
(51, 'De Photoshop a HTML5 y CSS3', '2016-12-10', '19:00:00', 'taller_10', 3, 5),
(52, 'PHP Intermedio y Avanzado', '2016-12-10', '21:00:00', 'taller_11', 3, 6),
(53, 'Como crear una tienda online que venda millones en pocos días', '2016-12-10', '10:00:00', 'conf_04', 2, 6),
(54, 'Los mejores lugares para encontrar trabajo', '2016-12-10', '17:00:00', 'conf_05', 2, 1),
(55, 'Pasos para crear un negocio rentable ', '2016-12-10', '19:00:00', 'conf_06', 2, 2),
(56, 'Aprende a Programar en una mañana', '2016-12-10', '10:00:00', 'sem_02', 1, 3),
(57, 'Diseño UI y UX para móviles', '2016-12-10', '17:00:00', 'sem_03', 1, 5),
(58, 'Laravel', '2016-12-11', '10:00:00', 'taller_12', 3, 1),
(59, 'Crea tu propia API', '2016-12-11', '12:00:00', 'taller_13', 3, 2),
(60, 'JavaScript y jQuery', '2016-12-11', '14:00:00', 'taller_14', 3, 3),
(61, 'Creando Plantillas para WordPress', '2016-12-11', '17:00:00', 'taller_15', 3, 4),
(62, 'Tiendas Virtuales en Magento', '2016-12-11', '19:00:00', 'taller_16', 3, 5),
(63, 'Como hacer Marketing en línea', '2016-12-11', '10:00:00', 'conf_07', 2, 6),
(64, '¿Con que lenguaje debo empezar?', '2016-12-11', '17:00:00', 'conf_08', 2, 2),
(65, 'Frameworks y librerias Open Source', '2016-12-11', '19:00:00', 'conf_09', 2, 3),
(66, 'Creando una App en Android en una mañana', '2016-12-11', '10:00:00', 'sem_04', 1, 4),
(67, 'Creando una App en iOS en una tarde', '2016-12-11', '17:00:00', 'sem_05', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invitado`
--

CREATE TABLE `invitado` (
  `id_invitado` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish2_ci NOT NULL,
  `url_foto` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `invitado`
--

INSERT INTO `invitado` (`id_invitado`, `nombre`, `apellido`, `descripcion`, `url_foto`) VALUES
(1, 'Rafael', 'Bauista', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. ', 'invitado1.jpg'),
(2, 'Shari ', 'Herrera', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.', 'invitado2.jpg'),
(3, 'Gregorio ', 'Sánchez', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source', 'invitado3.jpg'),
(4, 'Susana', 'Rivera', 'Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 'invitado4.jpg'),
(5, 'Carol', 'Garcia', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 'invitado5.jpg'),
(6, 'Susana', 'Distancia', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.', 'invitado6.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regalo`
--

CREATE TABLE `regalo` (
  `id_regalo` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `regalo`
--

INSERT INTO `regalo` (`id_regalo`, `descripcion`) VALUES
(1, 'Pulseras'),
(2, 'Etiquetas'),
(3, 'Plumas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `id_registro` int(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(60) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fecha` datetime NOT NULL,
  `pases_articulos` json NOT NULL,
  `talleres` json NOT NULL,
  `total_pago` decimal(19,2) NOT NULL,
  `id_regalo` int(11) NOT NULL,
  `pagado` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id_evento`),
  ADD KEY `fk_categoria_evento` (`id_categoria`),
  ADD KEY `fk_invitado_evento` (`id_invitado`);

--
-- Indices de la tabla `invitado`
--
ALTER TABLE `invitado`
  ADD PRIMARY KEY (`id_invitado`);

--
-- Indices de la tabla `regalo`
--
ALTER TABLE `regalo`
  ADD PRIMARY KEY (`id_regalo`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`id_registro`),
  ADD KEY `fk_regalo` (`id_regalo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `id_evento` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT de la tabla `invitado`
--
ALTER TABLE `invitado`
  MODIFY `id_invitado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `regalo`
--
ALTER TABLE `regalo`
  MODIFY `id_regalo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `id_registro` int(20) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `fk_categoria_evento` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`),
  ADD CONSTRAINT `fk_invitado_evento` FOREIGN KEY (`id_invitado`) REFERENCES `invitado` (`id_invitado`);

--
-- Filtros para la tabla `registro`
--
ALTER TABLE `registro`
  ADD CONSTRAINT `fk_regalo` FOREIGN KEY (`id_regalo`) REFERENCES `regalo` (`id_regalo`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
