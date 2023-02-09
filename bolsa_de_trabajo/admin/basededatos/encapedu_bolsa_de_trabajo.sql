-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 25-05-2022 a las 19:05:13
-- Versión del servidor: 10.3.34-MariaDB-cll-lve
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `encapedu_bolsa_de_trabajo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleos`
--

CREATE TABLE `empleos` (
  `idempleo` int(11) NOT NULL,
  `nombre` varchar(1200) NOT NULL,
  `empresa` varchar(1200) NOT NULL,
  `ubicacion` varchar(200) NOT NULL,
  `nvacantes` varchar(3) NOT NULL,
  `renumeracion` decimal(7,2) NOT NULL,
  `fechainicio` date NOT NULL,
  `fechafin` date NOT NULL,
  `experiencia` varchar(1200) NOT NULL,
  `formacion` varchar(1200) NOT NULL,
  `especializacion` varchar(1200) NOT NULL,
  `conocimiento` varchar(1200) NOT NULL,
  `competencia` varchar(1200) NOT NULL,
  `detalle` varchar(1200) NOT NULL,
  `destacado` varchar(50) NOT NULL,
  `condicion` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleos`
--

INSERT INTO `empleos` (`idempleo`, `nombre`, `empresa`, `ubicacion`, `nvacantes`, `renumeracion`, `fechainicio`, `fechafin`, `experiencia`, `formacion`, `especializacion`, `conocimiento`, `competencia`, `detalle`, `destacado`, `condicion`) VALUES
(2, 'PROFESIONAL DE TECNOLOGÍA MÉDICA PARA CEBE', 'UNIDAD DE GESTION EDUCATIVA LOCAL N°2', 'LIMA - SAN MARTIN DE PORRES', '2', '2000.00', '2022-05-03', '2022-05-09', 'PROFESIONAL DE TECNOLOGÍA MÉDICA PARA CEBEPROFESIONAL DE TECNOLOGÍA MÉDICA PARA CEBEPROFESIONAL DE TECNOLOGÍA MÉDICA PARA CEBEPROFESIONAL DE TECNOLOGÍA MÉDICA PARA CEBE', 'PROFESIONAL DE TECNOLOGÍA MÉDICA PARA CEBEPROFESIONAL DE TECNOLOGÍA MÉDICA PARA CEBE', 'PROFESIONAL DE TECNOLOGÍA MÉDICA dsvsdvsdvsdPARA CEBE', 'PROFESIONAL DE TECNOLOGÍA MÉDICA PARA CEBEPROFESIONAL DE TECNOLOGÍA MÉDICA PARA CEBEPROFESIONAL DE TECNOLOGÍA MÉDICA PARA CEBE', 'PROFESIONAL DE TdsvdsvwsdvECNsadadadOLOGÍA MÉDICA PARA CEBE', 'sdddffd', '0', 1),
(3, 'GESTOR INSTITUCIONAL', 'PROGRAMA NACIONAL ÑPLATAFORMAS DE ACCIÓN PARA LA INCLUSIÓN SOCIAL-PAISÑ', 'HUANCAVELICA - SANTIAGO DE QUIRAHUARA', '2', '3000.00', '2022-05-04', '2022-05-17', 'EXPERIENCIA GENERAL: ¿ DOS (2) AÑOS DE EXPERIENCIA GENERAL EN EL SECTOR PÚBLICO O PRIVADO. EXPERIENCIA ESPECÍFICA: ¿ DOS (02) AÑOS DE EXPERIENCIA ESPECÍFICA EN PUESTOS QUE TRABAJEN DIRECTAMENTE EN BENEFICIO DE LAS COMUNIDADES Y/O POBLACIÓN RURAL EN EL SECTOR PÚBLICO O PRIVADO, DE LOS CUALES, UN (1) AÑO DEBERÁ SER EN EL SECTOR PÚBLICO.', 'BACHILLER UNIVERSITARIO EN CIENCIAS SOCIALES, ADMINISTRATIVAS, ECONÓMICAS, AGRARIAS, FORESTALES, EDUCACIÓN, COMUNICACIONES, SALUD, PSICOLOGÍA, ECOLOGÍA, VETERINARIA, ZOOTECNIA, INDUSTRIAS ALIMENTARIAS O INGENIERÍA AGROPECUARIA.', 'CURSO EN GESTIÓN PÚBLICA O POLÍTICAS PÚBLICAS O SOCIALES O AFINES AL PUESTO.', '¿ CONOCIMIENTO DEL IDIOMA DE LA LOCALIDAD. ¿ CONOCIMIENTO DE LA ZONA GEOGRÁFICA A LA QUE POSTULA. ¿ CONOCIMIENTO DE RELACIONES COMUNITARIAS. ¿ MANEJO DE CONFLICTOS SOCIALES. ¿ DE PREFERENCIA VIVIR EN LA ZONA Y/O TENER DISPONIBILIDAD PARA TRASLADARSE AL ÁMBITO DE INTERVENCIÓN. ¿ CONOCIMIENTO DEL ISO 9001 SISTEMAS DE GESTIÓN DE CALIDAD. ¿ CONOCIMIENTOS DEL ISO 37001 SISTEMA DE GESTIÓN ANTISOBORNO.', '¿ INTERÉS ORGANIZACIONAL ¿ TRABAJO EN EQUIPO ¿ COMUNICACIÓN EFECTIVA', 'https://convocatorias.pais.gob.pe/convocatorias/externo/portal/ConvocatoriasPortal.aspx', '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `idpermiso` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`idpermiso`, `nombre`) VALUES
(1, 'Inicio'),
(2, 'Personal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `idpersonal` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipo_documento` varchar(20) NOT NULL,
  `num_documento` varchar(20) NOT NULL,
  `direccion` varchar(70) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `cargo` varchar(20) DEFAULT NULL,
  `imagen` varchar(50) DEFAULT NULL,
  `condicion` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`idpersonal`, `nombre`, `tipo_documento`, `num_documento`, `direccion`, `telefono`, `email`, `cargo`, `imagen`, `condicion`) VALUES
(1, 'ADMINISTRADOR', 'DNI', '71207697', '', '985394423', '', 'Administrador', '1616610266.png', 1),
(2, 'Editor', 'DNI', '00000000', 'JUNIN', '064555555', '', 'Editor', '1616610222.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `idpersonal` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `clave` varchar(64) NOT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `idpersonal`, `login`, `clave`, `condicion`) VALUES
(1, 1, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 1),
(4, 2, 'editor', '1553cc62ff246044c683a61e203e65541990e7fcd4af9443d22b9557ecc9ac54', 1);

--
-- Disparadores `usuario`
--
DELIMITER $$
CREATE TRIGGER `tr_updCondicionPerso` AFTER INSERT ON `usuario` FOR EACH ROW BEGIN
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_permiso`
--

CREATE TABLE `usuario_permiso` (
  `idusuario_permiso` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idpermiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario_permiso`
--

INSERT INTO `usuario_permiso` (`idusuario_permiso`, `idusuario`, `idpermiso`) VALUES
(8, 1, 1),
(9, 1, 2),
(49, 4, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleos`
--
ALTER TABLE `empleos`
  ADD PRIMARY KEY (`idempleo`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`idpermiso`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`idpersonal`) USING BTREE;

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `login_UNIQUE` (`login`) USING BTREE,
  ADD KEY `fk_usuario_personal1_idx` (`idpersonal`);

--
-- Indices de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD PRIMARY KEY (`idusuario_permiso`),
  ADD KEY `fk_usuario_permiso_permiso_idx` (`idpermiso`),
  ADD KEY `fk_usuario_permiso_usuario_idx` (`idusuario`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empleos`
--
ALTER TABLE `empleos`
  MODIFY `idempleo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `idpermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `idpersonal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  MODIFY `idusuario_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_personal1` FOREIGN KEY (`idpersonal`) REFERENCES `personal` (`idpersonal`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD CONSTRAINT `fk_usuario_permiso_permiso` FOREIGN KEY (`idpermiso`) REFERENCES `permiso` (`idpermiso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_permiso_usuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
