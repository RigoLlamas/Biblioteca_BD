-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-11-2023 a las 06:44:02
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biblioteca`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarInformacionLibro` (IN `new_ISBN` BIGINT(13), IN `new_Titulo` VARCHAR(50), IN `new_Pasillo` SMALLINT(5), IN `new_Fila` SMALLINT(5), IN `new_Edicion` SMALLINT(5), IN `new_Ejemplares` BIGINT(10), IN `new_Editorial` BIGINT(10), IN `new_Autor` BIGINT(10), IN `new_Genero` BIGINT(2))   BEGIN
    UPDATE Libros
    SET
        Titulo = new_Titulo,
        Pasillo = new_Pasillo,
        Fila = new_Fila,
        Edicion = new_Edicion,
        Ejemplares = new_Ejemplares,
        Editorial = new_Editorial,
        Autor = new_Autor,
        Genero = new_Genero
    WHERE ISBN = new_ISBN;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actualiza`
--

CREATE TABLE `actualiza` (
  `NumMov` bigint(20) NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Trabajador` bigint(10) DEFAULT NULL,
  `Libro` bigint(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `actualiza`
--

INSERT INTO `actualiza` (`NumMov`, `Fecha`, `Trabajador`, `Libro`) VALUES
(1, '2023-11-26', 1, 9781234567890),
(3, '2023-11-26', 1, 9783456789012),
(4, '2023-11-26', 1, 9784567890123),
(5, '2023-11-26', 1, 9785678901234),
(6, '2023-11-26', 1, 9786789012345),
(7, '2023-11-26', 2, 9787890123456),
(8, '2023-11-26', 2, 9788901234567),
(9, '2023-11-26', 2, 9789012345678),
(10, '2023-11-26', 2, 9780123456789),
(11, '2023-11-26', 1, 9782345678901);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autor`
--

CREATE TABLE `autor` (
  `Registro` bigint(10) NOT NULL,
  `Nombre` varchar(30) DEFAULT NULL,
  `Apellido` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `autor`
--

INSERT INTO `autor` (`Registro`, `Nombre`, `Apellido`) VALUES
(1, 'Gabriel', 'Garcia Marquez'),
(2, 'Jane', 'Austen'),
(3, 'Haruki', 'Murakami'),
(4, 'J.K.', 'Rowling'),
(5, 'George', 'Orwell'),
(6, 'Agatha', 'Christie'),
(7, 'Ernest', 'Hemingway'),
(8, 'Toni', 'Morrison'),
(9, 'Gabriela', 'Mistral'),
(10, 'F. Scott', 'Fitzgerald');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editorial`
--

CREATE TABLE `editorial` (
  `ID_Editorial` bigint(10) NOT NULL,
  `Nom_Editorial` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `editorial`
--

INSERT INTO `editorial` (`ID_Editorial`, `Nom_Editorial`) VALUES
(1, 'Editorial A'),
(2, 'Editorial B'),
(3, 'Editorial C'),
(4, 'Editorial D'),
(5, 'Editorial E'),
(6, 'Editorial F'),
(7, 'Editorial G'),
(8, 'Editorial H'),
(9, 'Editorial I'),
(10, 'Editorial J');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

CREATE TABLE `genero` (
  `ID_Genero` bigint(2) NOT NULL,
  `Nom_Genero` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`ID_Genero`, `Nom_Genero`) VALUES
(1, 'Ficcion'),
(2, 'Misterio'),
(3, 'Romance'),
(4, 'Ciencia Ficcion'),
(5, 'Aventura'),
(6, 'Fantasia'),
(7, 'Drama'),
(8, 'Biografia'),
(9, 'Historico'),
(10, 'Infantil');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `ISBN` bigint(13) NOT NULL,
  `Titulo` varchar(50) DEFAULT NULL,
  `Pasillo` smallint(5) DEFAULT NULL,
  `Fila` smallint(5) DEFAULT NULL,
  `Edicion` smallint(5) DEFAULT NULL,
  `Editorial` bigint(10) DEFAULT NULL,
  `Autor` bigint(10) DEFAULT NULL,
  `Genero` bigint(2) DEFAULT NULL,
  `Ejemplares` bigint(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`ISBN`, `Titulo`, `Pasillo`, `Fila`, `Edicion`, `Editorial`, `Autor`, `Genero`, `Ejemplares`) VALUES
(9780123456789, 'El gran Gatsby', 10, 4, 1, 10, 10, 1, 8),
(9781234567890, 'Cien anos de soledad', 1, 3, 1, 1, 1, 1, 10),
(9782345678901, 'Orgullo y prejuicio', 6, 7, 2, 2, 2, 3, 10),
(9783456789012, 'Norwegian Wood', 3, 2, 1, 3, 3, 2, 10),
(9784567890123, 'Harry P y la piedra filosofal', 4, 4, 1, 4, 4, 4, 10),
(9785678901234, '1984', 5, 1, 1, 5, 5, 7, 10),
(9786789012345, 'Asesinato en el Orient Express', 6, 2, 1, 5, 2, 2, 8),
(9787890123456, 'El viejo y el mar', 7, 3, 1, 7, 7, 7, 8),
(9788901234567, 'Beloved', 8, 1, 1, 8, 8, 8, 7),
(9789012345678, 'La mujer habitada', 9, 2, 1, 9, 9, 6, 8);

--
-- Disparadores `libros`
--
DELIMITER $$
CREATE TRIGGER `actualiza_libro` AFTER INSERT ON `libros` FOR EACH ROW BEGIN
    INSERT INTO Actualiza (NumMov, Fecha, Trabajador, Libro)
    SELECT NULL, NOW(), Nomina, NEW.ISBN
    FROM Trabajador
    WHERE Usuario = SUBSTRING_INDEX(USER(), '@', 1);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puesto`
--

CREATE TABLE `puesto` (
  `Puesto` bigint(2) NOT NULL,
  `NomPuesto` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `puesto`
--

INSERT INTO `puesto` (`Puesto`, `NomPuesto`) VALUES
(1, 'Gerente'),
(2, 'Asistente de Gerente'),
(3, 'Bibliotecario Principal'),
(4, 'Bibliotecario Asociado'),
(5, 'Asistente de Bibliotecario'),
(6, 'Encargado de Pasillo'),
(7, 'Asistente de Pasillo'),
(8, 'Encargado de Almacen'),
(9, 'Asistente de Almacen'),
(10, 'Personal de Limpieza');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `renta`
--

CREATE TABLE `renta` (
  `Num_Retiro` bigint(20) NOT NULL,
  `Fecha_Salida` date DEFAULT NULL,
  `Fecha_Entrega` date DEFAULT NULL,
  `Intereses` float DEFAULT NULL,
  `Costo` float DEFAULT NULL,
  `Costo_Final` float DEFAULT NULL,
  `Usuario` bigint(20) DEFAULT NULL,
  `Trabajador` bigint(10) DEFAULT NULL,
  `Libro` bigint(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `renta`
--

INSERT INTO `renta` (`Num_Retiro`, `Fecha_Salida`, `Fecha_Entrega`, `Intereses`, `Costo`, `Costo_Final`, `Usuario`, `Trabajador`, `Libro`) VALUES
(1, '2023-11-12', '2023-11-17', 1.5, 10, 11.5, 1, 1, 9786789012345),
(2, '2023-11-12', '2023-11-17', 2, 15, 17, 2, 2, 9787890123456),
(3, '2023-11-12', '2023-11-17', 1, 8, 9, 3, 1, 9788901234567),
(4, '2023-11-12', '2023-11-17', 1.8, 12, 13.8, 4, 2, 9789012345678),
(5, '2023-11-12', '2023-11-17', 2.5, 20, 22.5, 5, 1, 9780123456789),
(6, '2023-11-12', '2023-11-17', 1.2, 9, 10.2, 1, 2, 9786789012345),
(7, '2023-11-12', '2023-11-17', 2.2, 18, 20.2, 2, 2, 9787890123456),
(8, '2023-11-12', '2023-11-17', 1.3, 10, 11.3, 3, 1, 9788901234567),
(9, '2023-11-12', '2023-11-17', 1.7, 14, 15.7, 4, 2, 9789012345678),
(11, '2023-11-27', '2023-11-29', 1.2, 100, 120, 10, 1, 9788901234567);

--
-- Disparadores `renta`
--
DELIMITER $$
CREATE TRIGGER `disminuir_ejemplares` AFTER INSERT ON `renta` FOR EACH ROW BEGIN
    UPDATE Libros
    SET Ejemplares = Ejemplares - 1
    WHERE ISBN = NEW.Libro;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajador`
--

CREATE TABLE `trabajador` (
  `Nomina` bigint(10) NOT NULL,
  `Nombre` varchar(30) DEFAULT NULL,
  `ApeP` varchar(30) DEFAULT NULL,
  `ApeM` varchar(30) DEFAULT NULL,
  `Puesto` bigint(2) DEFAULT NULL,
  `Usuario` varchar(30) DEFAULT NULL,
  `Contrasena` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `trabajador`
--

INSERT INTO `trabajador` (`Nomina`, `Nombre`, `ApeP`, `ApeM`, `Puesto`, `Usuario`, `Contrasena`) VALUES
(1, 'Juan', 'Perez', 'Gomez', 1, 'juan_admin', 'juan_admin'),
(2, 'Maria', 'Lopez', 'Hernandez', 2, 'maria_trabajador', 'maria_trabajador'),
(3, 'Rigo', 'Ramirez', 'Llamas', 1, '21100298', '$2y$10$p1a.KewYdd2ULBadQgj4/Os'),
(4, 'Daniel', 'Gutierrez', 'Sanchez', 1, 'daniel', '$2y$10$/N7wsSkcIxzvZA3Sx/JRVuK'),
(5, 'Felipe', 'Mendes', 'Martines', 3, 'felipe_trabajador', '$2y$10$RTo5nwThrOHxlyX3.fV.tec'),
(6, 'Patricio', 'Estrella', 'Rosada', 6, 'patricio_trabajador', '$2y$10$9GKP82DCBujgNtbvUiJRFe0'),
(7, 'Bob', 'Esponja', 'Pantalones', 7, 'bob_trabajador', '$2y$10$Mb7omgnww6DlzrLuJ9oZ4Ov'),
(8, 'Pepito', 'Ruiz', 'Perez', 8, 'pepito_trabajador', '$2y$10$o46eDba7xgErYac8Jz4R0.D'),
(9, 'Mario', 'De la Cruz', 'Santos', 10, 'mario_trabajador', '$2y$10$1fTD.x8f8ccsPvU1gfNAveU'),
(10, 'Paco', 'Nuñes', 'Gimenes', 5, 'paco_trabajador', '$2y$10$K5VGIhepg61a7U1cHCcTrO5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ID_Usuario` bigint(20) NOT NULL,
  `Nombre` varchar(30) DEFAULT NULL,
  `ApeP` varchar(30) DEFAULT NULL,
  `ApeM` varchar(30) DEFAULT NULL,
  `Domicilio` varchar(50) DEFAULT NULL,
  `Telefono` bigint(10) DEFAULT NULL,
  `Correo` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID_Usuario`, `Nombre`, `ApeP`, `ApeM`, `Domicilio`, `Telefono`, `Correo`) VALUES
(1, 'Juan', 'Perez', 'Gomez', 'Calle 123, Ciudad', 1234567890, 'juan@gmail.com'),
(2, 'Maria', 'Lopez', 'Hernandez', 'Avenida 456, Pueblo', 9876543210, 'maria@gmail.com'),
(3, 'Carlos', 'Garcia', 'Rodriguez', 'Calle Principal, Villa', 5678901234, 'carlos@gmail.com'),
(4, 'Ana', 'Martinez', 'Fernandez', 'Avenida 789, Poblado', 2345678901, 'ana@gmail.com'),
(5, 'David', 'Sanchez', 'Gutierrez', 'Calle Secundaria, Localidad', 6789012345, 'david@gmail.com'),
(6, 'Laura', 'Ramirez', 'Diaz', 'Boulevard 012, Comunidad', 3456789012, 'laura@gmail.com'),
(7, 'Jose', 'Torres', 'Vega', 'Avenida Central, Municipio', 8901234567, 'jose@gmail.com'),
(8, 'Carmen', 'Ruiz', 'Mendoza', 'Calle 456, Aldea', 1234567890, 'carmen@gmail.com'),
(9, 'Francisco', 'Castro', 'Jimenez', 'Boulevard 789, Colonia', 9876543210, 'francisco@gmail.com'),
(10, 'Isabel', 'Herrer', 'Ortega', 'La casa', 3312211221, 'isabel@gmail.com');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vistalibrosdetalles`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vistalibrosdetalles` (
`ISBN` bigint(13)
,`Titulo` varchar(50)
,`Pasillo` smallint(5)
,`Fila` smallint(5)
,`Edicion` smallint(5)
,`Nombre_Autor` varchar(30)
,`Apellido_Autor` varchar(30)
,`Editorial` varchar(30)
,`Genero` varchar(30)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vistaretirosdetalles`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vistaretirosdetalles` (
`Num_Retiro` bigint(20)
,`Fecha_Salida` date
,`Fecha_Entrega` date
,`Intereses` float
,`Costo` float
,`Costo_Final` float
,`UsuarioNombre` varchar(30)
,`Usuario_Apellido_P` varchar(30)
,`Usuario_Apellido_M` varchar(30)
,`Libro_Titulo` varchar(50)
,`Pasillo` smallint(5)
,`Fila` smallint(5)
,`Edicion` smallint(5)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vistalibrosdetalles`
--
DROP TABLE IF EXISTS `vistalibrosdetalles`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vistalibrosdetalles`  AS SELECT `libros`.`ISBN` AS `ISBN`, `libros`.`Titulo` AS `Titulo`, `libros`.`Pasillo` AS `Pasillo`, `libros`.`Fila` AS `Fila`, `libros`.`Edicion` AS `Edicion`, `autor`.`Nombre` AS `Nombre_Autor`, `autor`.`Apellido` AS `Apellido_Autor`, `editorial`.`Nom_Editorial` AS `Editorial`, `genero`.`Nom_Genero` AS `Genero` FROM (((`libros` join `autor` on(`libros`.`Autor` = `autor`.`Registro`)) join `editorial` on(`libros`.`Editorial` = `editorial`.`ID_Editorial`)) join `genero` on(`libros`.`Genero` = `genero`.`ID_Genero`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vistaretirosdetalles`
--
DROP TABLE IF EXISTS `vistaretirosdetalles`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vistaretirosdetalles`  AS SELECT `renta`.`Num_Retiro` AS `Num_Retiro`, `renta`.`Fecha_Salida` AS `Fecha_Salida`, `renta`.`Fecha_Entrega` AS `Fecha_Entrega`, `renta`.`Intereses` AS `Intereses`, `renta`.`Costo` AS `Costo`, `renta`.`Costo_Final` AS `Costo_Final`, `usuario`.`Nombre` AS `UsuarioNombre`, `usuario`.`ApeP` AS `Usuario_Apellido_P`, `usuario`.`ApeM` AS `Usuario_Apellido_M`, `libros`.`Titulo` AS `Libro_Titulo`, `libros`.`Pasillo` AS `Pasillo`, `libros`.`Fila` AS `Fila`, `libros`.`Edicion` AS `Edicion` FROM ((`renta` join `usuario` on(`renta`.`Usuario` = `usuario`.`ID_Usuario`)) join `libros` on(`renta`.`Libro` = `libros`.`ISBN`)) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actualiza`
--
ALTER TABLE `actualiza`
  ADD PRIMARY KEY (`NumMov`),
  ADD KEY `Trabajador` (`Trabajador`),
  ADD KEY `Libro` (`Libro`);

--
-- Indices de la tabla `autor`
--
ALTER TABLE `autor`
  ADD PRIMARY KEY (`Registro`);

--
-- Indices de la tabla `editorial`
--
ALTER TABLE `editorial`
  ADD PRIMARY KEY (`ID_Editorial`);

--
-- Indices de la tabla `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`ID_Genero`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`ISBN`),
  ADD KEY `Editorial` (`Editorial`),
  ADD KEY `Autor` (`Autor`),
  ADD KEY `Genero` (`Genero`);

--
-- Indices de la tabla `puesto`
--
ALTER TABLE `puesto`
  ADD PRIMARY KEY (`Puesto`);

--
-- Indices de la tabla `renta`
--
ALTER TABLE `renta`
  ADD PRIMARY KEY (`Num_Retiro`),
  ADD KEY `Usuario` (`Usuario`),
  ADD KEY `Trabajador` (`Trabajador`),
  ADD KEY `Libro` (`Libro`);

--
-- Indices de la tabla `trabajador`
--
ALTER TABLE `trabajador`
  ADD PRIMARY KEY (`Nomina`),
  ADD KEY `Puesto` (`Puesto`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID_Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actualiza`
--
ALTER TABLE `actualiza`
  MODIFY `NumMov` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `autor`
--
ALTER TABLE `autor`
  MODIFY `Registro` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `editorial`
--
ALTER TABLE `editorial`
  MODIFY `ID_Editorial` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `genero`
--
ALTER TABLE `genero`
  MODIFY `ID_Genero` bigint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `puesto`
--
ALTER TABLE `puesto`
  MODIFY `Puesto` bigint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `renta`
--
ALTER TABLE `renta`
  MODIFY `Num_Retiro` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `trabajador`
--
ALTER TABLE `trabajador`
  MODIFY `Nomina` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID_Usuario` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actualiza`
--
ALTER TABLE `actualiza`
  ADD CONSTRAINT `actualiza_ibfk_1` FOREIGN KEY (`Trabajador`) REFERENCES `trabajador` (`Nomina`),
  ADD CONSTRAINT `actualiza_ibfk_2` FOREIGN KEY (`Libro`) REFERENCES `libros` (`ISBN`);

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`Editorial`) REFERENCES `editorial` (`ID_Editorial`),
  ADD CONSTRAINT `libros_ibfk_2` FOREIGN KEY (`Autor`) REFERENCES `autor` (`Registro`),
  ADD CONSTRAINT `libros_ibfk_3` FOREIGN KEY (`Genero`) REFERENCES `genero` (`ID_Genero`);

--
-- Filtros para la tabla `renta`
--
ALTER TABLE `renta`
  ADD CONSTRAINT `renta_ibfk_1` FOREIGN KEY (`Usuario`) REFERENCES `usuario` (`ID_Usuario`),
  ADD CONSTRAINT `renta_ibfk_2` FOREIGN KEY (`Trabajador`) REFERENCES `trabajador` (`Nomina`),
  ADD CONSTRAINT `renta_ibfk_3` FOREIGN KEY (`Libro`) REFERENCES `libros` (`ISBN`);

--
-- Filtros para la tabla `trabajador`
--
ALTER TABLE `trabajador`
  ADD CONSTRAINT `trabajador_ibfk_1` FOREIGN KEY (`Puesto`) REFERENCES `puesto` (`Puesto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
