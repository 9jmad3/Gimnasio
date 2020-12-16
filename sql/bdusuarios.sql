-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: database:3306
-- Tiempo de generación: 16-12-2020 a las 22:41:15
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdusuarios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistenciaClases`
--

CREATE TABLE `asistenciaClases` (
  `id` int(11) NOT NULL,
  `idClase` int(11) NOT NULL,
  `idAlumno` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `asistenciaClases`
--

INSERT INTO `asistenciaClases` (`id`, `idClase`, `idAlumno`) VALUES
(3, 2, 33),
(4, 15, 33),
(5, 12, 36),
(6, 22, 36),
(7, 17, 36),
(8, 13, 36);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

CREATE TABLE `clases` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `duracion` varchar(100) DEFAULT NULL,
  `Imagen` varchar(255) DEFAULT NULL,
  `color` varchar(100) DEFAULT 'btn-primary'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clases`
--

INSERT INTO `clases` (`id`, `nombre`, `tipo`, `descripcion`, `duracion`, `Imagen`, `color`) VALUES
(2, 'BodyCombat', 'Resistencia', 'BodyCombat es un programa de entrenamiento grupal de tipo cardiovascular que, desde el aÃ±o 1999, es distribuido por Les Mills International. Consiste en realizar movimientos basados en distintas artes marciales siguiendo el ritmo de una base musical.', NULL, 'BodyCombat.jpg', 'btn-danger'),
(3, 'BodyAttack', 'Resistencia', 'BodyAttack es un programa comercial de ejercicios cardiovasculares inspirado en deportes de fitness grupal que incluye algunos movimientos derivados del deporte, destinados principalmente a desarrollar la aptitud cardiovascular. El programa es creado y distribuido por Les Mills International.', NULL, 'BodyAttack.jpg', 'btn-deep-orange'),
(4, 'Yoga', 'Estiramiento', 'El yoga es una prÃ¡ctica que conecta el cuerpo, la respiraciÃ³n y la mente. Esta prÃ¡ctica utiliza posturas fÃ­sicas, ejercicios de respiraciÃ³n y meditaciÃ³n para mejorar la salud general. Hoy en dÃ­a la mayorÃ­a de las personas en occidente hace yoga como ejercicio y para reducir el estrÃ©s.', NULL, 'Yoga.jpg', 'btn-success'),
(5, 'BodyPump', 'Resistenca-Fuerza', 'BodyPump es un programa grupal de entrenamiento basado en el levantamiento de pesas, creado y distribuido internacionalmente por Les Mills International. Creado en 1991 por Phillip Mills en Auckland, Nueva Zelanda, â€‹ en 2015 estaba disponible en mÃ¡s de 100 paÃ­ses y en 17500 clubes deportivos de todo el mundo.â€‹', NULL, 'BodyPump.jpg', 'btn-default'),
(6, 'Cycling', 'Resistencia', 'Es un ejercicio de piernas principalmente, donde el monitor o profesor puede mediante el cambio de la frecuencia de pedaleo y de la resistencia al movimiento, realizar todo tipo de intensidades. Es una gimnasia muy adaptable al nivel del alumno, pudiendo ser tan sencilla como un paseo tranquilo o agotador hasta para un ciclista profesional.', NULL, 'Cycling.jpg', 'btn-secondary'),
(7, 'Trx', 'Resistenca-Fuerza', 'El TRX es un sistema de entrenamiento basado en la realizaciÃ³n de ejercicios en suspensiÃ³n, donde en las actividades que desempeÃ±a el deportista, las manos o los pies se encuentran sostenidos en un punto de anclaje mientras que la otra parte del cuerpo estÃ¡ apoyada en el suelo.', NULL, 'Trx.jpg', 'btn-yellow'),
(8, 'HIT', 'Resistenca-Fuerza', 'Es un mÃ©todo de entrenamiento de fuerza enfocado principalmente en la calidad de las repeticiones, y un concepto bÃ¡sico en todo lo referente al mundo del culturismo la hipertrofia muscular: el fallo muscular momentÃ¡neo.', NULL, 'hitt.jpg', 'btn-blue-grey'),
(11, 'Zumba', 'Resistencia', 'Zumba es una disciplina deportiva que se imparte en clases dirigidas en la que se realizan ejercicios aerÃ³bicos al ritmo de mÃºsica latina (merengue, samba, reggaeton, cumbia y salsa) con la finalidad de perder peso de forma divertida y mejorar el estado de Ã¡nimo de los deportistas.', NULL, 'porDefecto.jpg', 'btn-primary');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasesExistentes`
--

CREATE TABLE `clasesExistentes` (
  `id` int(11) NOT NULL,
  `idClase` int(11) NOT NULL,
  `Dia` varchar(10) NOT NULL,
  `duracion` int(2) DEFAULT NULL,
  `horaInicio` varchar(5) NOT NULL,
  `horaFin` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clasesExistentes`
--

INSERT INTO `clasesExistentes` (`id`, `idClase`, `Dia`, `duracion`, `horaInicio`, `horaFin`) VALUES
(2, 4, 'Martes', 45, '07:45', '08:30'),
(4, 2, 'Lunes', 30, '09:30', '10:00'),
(8, 7, 'Lunes', NULL, '07:30', '08:30'),
(9, 8, 'Jueves', NULL, '08:00', '08:30'),
(11, 6, 'Sabado', NULL, '07:15', '08:00'),
(12, 4, 'Viernes', NULL, '07:00', '08:00'),
(13, 8, 'Miercoles', NULL, '07:15', '08:30'),
(14, 11, 'Jueves', NULL, '07:00', '07:30'),
(15, 4, 'Jueves', NULL, '07:30', '08:00'),
(16, 3, 'Lunes', NULL, '08:30', '09:00'),
(17, 6, 'Lunes', NULL, '07:00', '07:30'),
(18, 11, 'Martes', NULL, '07:00', '07:45'),
(19, 8, 'Lunes', NULL, '15:00', '16:00'),
(20, 7, 'Jueves', NULL, '18:45', '19:45'),
(21, 6, 'Jueves', NULL, '22:15', '23:00'),
(22, 5, 'Viernes', NULL, '17:00', '18:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id` int(11) NOT NULL,
  `idRemitente` int(11) NOT NULL,
  `idDestinatario` int(10) NOT NULL,
  `contenido` varchar(250) NOT NULL,
  `asunto` varchar(100) DEFAULT NULL,
  `fechaCreacion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id`, `idRemitente`, `idDestinatario`, `contenido`, `asunto`, `fechaCreacion`) VALUES
(28, 32, 33, 'ADMIN\r\nBuenas cridiaz te informamos de que el prÃ³ximo martes el gimnasio permanecerÃ¡ cerrado.\r\nDisculpas las molestias.', 'Clases tematicas', '14/12/2020'),
(29, 33, 33, 'Preguntar por clases de pilates', 'Autorecordatorio', '14/12/2020'),
(30, 34, 32, 'Â¿Es posible cambiar mi contraseÃ±a?', 'ContraseÃ±a', '14/12/2020'),
(36, 32, 34, 'Se han cancelado una o mas clases en las que estaba apuntado. Disculpe las molestias', 'CANCELACION DE CLASES', '14/12/2020'),
(37, 32, 33, 'Se han cancelado una o mas clases en las que estaba apuntado. Disculpe las molestias', 'CANCELACION DE CLASES', '14/12/2020'),
(38, 32, 34, 'Se han cancelado una o mas clases en las que estaba apuntado. Disculpe las molestias', 'CANCELACION DE CLASES', '15/12/2020'),
(39, 32, 40, 'Te recomendamos cambiar la fotografia', 'foto', '16/12/2020');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nif` varchar(9) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido1` varchar(50) DEFAULT NULL,
  `apellido2` varchar(50) DEFAULT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL,
  `email` varchar(100) NOT NULL,
  `imagen` varchar(300) DEFAULT NULL,
  `telefono` int(12) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `rol_id` int(2) DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nif`, `nombre`, `apellido1`, `apellido2`, `usuario`, `password`, `email`, `imagen`, `telefono`, `direccion`, `rol_id`) VALUES
(32, '48946820Z', 'Jose', 'Alejandro', 'Dominguez', 'admin01', '54d32a84304b6f3e3b849f341a1d9ef3cb3b8647', 'admin@admin.admin', 'Captura.PNG', 651651651, 'Plaza Corteconcepcion', 0),
(33, '45157132J', 'cristina', 'diaz', 'morgado', 'cridiaz', '54d32a84304b6f3e3b849f341a1d9ef3cb3b8647', 'cri@cri.cri', 'cri.jpg', 658658658, 'Plaza de la granaina', 1),
(34, '45454545L', 'Juan', 'Dominguez', 'Rodriguez', 'juan70', '54d32a84304b6f3e3b849f341a1d9ef3cb3b8647', 'juan70@gmail.com', 'juan.jpg', 678675657, 'Huelva', 1),
(36, '65656565L', 'Maria', 'Gonzalez', 'Gonzalez', 'maria98', '54d32a84304b6f3e3b849f341a1d9ef3cb3b8647', 'maria98@gmail.com', 'erthr.jpg', 654456543, 'Huelva', 1),
(37, '56565656L', 'Manuel', 'Perez', 'Perez', 'manuel90', '54d32a84304b6f3e3b849f341a1d9ef3cb3b8647', 'manuel90@gmail.com', 'juan.jpg', 657756756, 'Huelva', 1),
(38, NULL, NULL, NULL, NULL, 'adrian07', '54d32a84304b6f3e3b849f341a1d9ef3cb3b8647', 'adrian07@gmail.com', NULL, NULL, NULL, 2),
(39, NULL, NULL, NULL, NULL, 'elvira2001', '54d32a84304b6f3e3b849f341a1d9ef3cb3b8647', 'elvira@hotmail.es', NULL, NULL, NULL, 2),
(40, '65656321S', 'juan', 'alves', 'santos', 'juafrancisco', '54d32a84304b6f3e3b849f341a1d9ef3cb3b8647', 'juanfran@gmail.com', 'e.jpg', 654951235, 'Gibraleon', 1),
(41, NULL, NULL, NULL, NULL, 'darthvader', '54d32a84304b6f3e3b849f341a1d9ef3cb3b8647', 'darthvader@gmail.com', NULL, NULL, NULL, 1),
(42, NULL, NULL, NULL, NULL, 'leia47', '54d32a84304b6f3e3b849f341a1d9ef3cb3b8647', 'leila@gmail.com', NULL, NULL, NULL, 2),
(43, NULL, NULL, NULL, NULL, 'luciaperez', '54d32a84304b6f3e3b849f341a1d9ef3cb3b8647', 'lucia@outllok.com', NULL, NULL, NULL, 2),
(44, NULL, NULL, NULL, NULL, 'criromero', '54d32a84304b6f3e3b849f341a1d9ef3cb3b8647', 'crirom@outlook.com', NULL, NULL, NULL, 2),
(45, NULL, NULL, NULL, NULL, 'admin02', '54d32a84304b6f3e3b849f341a1d9ef3cb3b8647', 'admi02@admin.com', NULL, NULL, NULL, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistenciaClases`
--
ALTER TABLE `asistenciaClases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idClase` (`idClase`),
  ADD KEY `idAlumno` (`idAlumno`);

--
-- Indices de la tabla `clases`
--
ALTER TABLE `clases`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clasesExistentes`
--
ALTER TABLE `clasesExistentes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idClase` (`idClase`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idRemitente` (`idRemitente`),
  ADD KEY `idDestinatario` (`idDestinatario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nif` (`nif`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistenciaClases`
--
ALTER TABLE `asistenciaClases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `clases`
--
ALTER TABLE `clases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `clasesExistentes`
--
ALTER TABLE `clasesExistentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistenciaClases`
--
ALTER TABLE `asistenciaClases`
  ADD CONSTRAINT `asistenciaclases_ibfk_1` FOREIGN KEY (`idClase`) REFERENCES `clasesExistentes` (`id`),
  ADD CONSTRAINT `asistenciaclases_ibfk_2` FOREIGN KEY (`idAlumno`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `clasesExistentes`
--
ALTER TABLE `clasesExistentes`
  ADD CONSTRAINT `clasesexistentes_ibfk_1` FOREIGN KEY (`idClase`) REFERENCES `clases` (`id`);

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `mensajes_ibfk_1` FOREIGN KEY (`idRemitente`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `mensajes_ibfk_2` FOREIGN KEY (`idDestinatario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
