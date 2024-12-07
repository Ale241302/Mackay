-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-10-2024 a las 16:34:32
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
-- Base de datos: `mackay`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('04c441c0dad48c026e0301b7be5f8c30', 'i:2;', 1727826677),
('04c441c0dad48c026e0301b7be5f8c30:timer', 'i:1727826677;', 1727826677),
('060ed644cf5d8124c933ddc0a176dea3', 'i:1;', 1726529288),
('060ed644cf5d8124c933ddc0a176dea3:timer', 'i:1726529288;', 1726529288),
('316e5e0c9b521cfa70c3d6c823892f51', 'i:1;', 1725623878),
('316e5e0c9b521cfa70c3d6c823892f51:timer', 'i:1725623878;', 1725623878),
('33e9737745c7e0d69def2e12b88781c4', 'i:1;', 1727381486),
('33e9737745c7e0d69def2e12b88781c4:timer', 'i:1727381486;', 1727381486),
('3c4f9e410d1b9c48f0020646f0135cc9', 'i:1;', 1727509431),
('3c4f9e410d1b9c48f0020646f0135cc9:timer', 'i:1727509430;', 1727509430),
('6a18c7c496046ee22a47b000a63c3fae', 'i:1;', 1729002339),
('6a18c7c496046ee22a47b000a63c3fae:timer', 'i:1729002339;', 1729002339),
('933239841d3a939cb0f084be9ffbbc3d', 'i:1;', 1725505751),
('933239841d3a939cb0f084be9ffbbc3d:timer', 'i:1725505751;', 1725505751),
('9cd643c876688aba0117c77ab7df6906', 'i:1;', 1727451097),
('9cd643c876688aba0117c77ab7df6906:timer', 'i:1727451097;', 1727451097),
('9e81d14583073f24ddde418e4ef8dbed', 'i:1;', 1727868150),
('9e81d14583073f24ddde418e4ef8dbed:timer', 'i:1727868150;', 1727868150),
('a56d94cdbe265a2348e86344cb40fb8d', 'i:1;', 1727796597),
('a56d94cdbe265a2348e86344cb40fb8d:timer', 'i:1727796597;', 1727796597),
('a9ac76de4281d6ef2264616fbba6caf4', 'i:1;', 1727809586),
('a9ac76de4281d6ef2264616fbba6caf4:timer', 'i:1727809586;', 1727809586),
('b1ebf7f8a7b2c2a1aa8175f1d813b598', 'i:1;', 1727817305),
('b1ebf7f8a7b2c2a1aa8175f1d813b598:timer', 'i:1727817305;', 1727817305),
('c27c41721d7d95a51e66639aedda3360', 'i:1;', 1725557522),
('c27c41721d7d95a51e66639aedda3360:timer', 'i:1725557522;', 1725557522),
('d89bb843ec696f7a23c1d8154247d730', 'i:1;', 1727792846),
('d89bb843ec696f7a23c1d8154247d730:timer', 'i:1727792846;', 1727792846),
('manuel@reservatodo.cl|190.21.175.254', 'i:2;', 1727826677),
('manuel@reservatodo.cl|190.21.175.254:timer', 'i:1727826677;', 1727826677);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `casos`
--

CREATE TABLE `casos` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `empresa` int(11) DEFAULT NULL,
  `empresa_demandante` varchar(255) DEFAULT NULL,
  `rut_demandante` varchar(255) DEFAULT NULL,
  `email_demandante` varchar(255) DEFAULT NULL,
  `telefono_demandante` varchar(255) DEFAULT NULL,
  `representante_demandante` varchar(255) DEFAULT NULL,
  `domicilio_demandante` varchar(255) DEFAULT NULL,
  `referencia_caso` varchar(255) DEFAULT NULL,
  `descripcion_caso` varchar(255) DEFAULT NULL,
  `asunto_caso` varchar(255) DEFAULT NULL,
  `fechai` date DEFAULT NULL,
  `abogados` varchar(25) DEFAULT NULL,
  `tipo_caso` int(11) DEFAULT NULL,
  `cobrofijo` int(11) DEFAULT NULL,
  `cobrohora` int(11) DEFAULT NULL,
  `cobroporciento` int(11) DEFAULT NULL,
  `rol_caso` varchar(255) DEFAULT NULL,
  `tribunal` varchar(255) DEFAULT NULL,
  `fechait` date DEFAULT NULL,
  `juez_civil` varchar(255) DEFAULT NULL,
  `juez_arbitro` varchar(255) DEFAULT NULL,
  `rol_arbitral` varchar(255) DEFAULT NULL,
  `tipo_moneda` varchar(255) DEFAULT NULL,
  `cuantia` decimal(5,3) DEFAULT NULL,
  `monto_hora` longtext DEFAULT NULL,
  `actividadesData` longtext DEFAULT NULL,
  `documentosData` longtext DEFAULT NULL,
  `estado_caso` varchar(255) DEFAULT NULL,
  `etapa_procesal` varchar(255) DEFAULT NULL,
  `nombre_juicio` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT 'Activo',
  `fecha_fin` date DEFAULT NULL,
  `estado_casoi` varchar(255) DEFAULT NULL,
  `demandante` int(11) DEFAULT NULL,
  `bill` varchar(255) DEFAULT NULL,
  `referencia_demandante` varchar(255) DEFAULT NULL,
  `usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `casos`
--

INSERT INTO `casos` (`id`, `created_at`, `updated_at`, `empresa`, `empresa_demandante`, `rut_demandante`, `email_demandante`, `telefono_demandante`, `representante_demandante`, `domicilio_demandante`, `referencia_caso`, `descripcion_caso`, `asunto_caso`, `fechai`, `abogados`, `tipo_caso`, `cobrofijo`, `cobrohora`, `cobroporciento`, `rol_caso`, `tribunal`, `fechait`, `juez_civil`, `juez_arbitro`, `rol_arbitral`, `tipo_moneda`, `cuantia`, `monto_hora`, `actividadesData`, `documentosData`, `estado_caso`, `etapa_procesal`, `nombre_juicio`, `estado`, `fecha_fin`, `estado_casoi`, `demandante`, `bill`, `referencia_demandante`, `usuario`) VALUES
(16, '2024-10-01 21:57:08', '2024-10-01 21:57:08', 6, 'manuel vicuna', '6561769-2', 'mvicunae@gmail.com', '+56984473090', 'el mismo', 'santiago', '678', 'cobro de saldo', 'vicuna / perez', '2024-10-01', '[\"4\"]', 10, 1, 0, 0, '[null]', '[]', NULL, NULL, NULL, '[null]', 'CLP', 1.000, '1', '\"[]\"', '\"[]\"', 'Iniciada', '12', NULL, 'Activo', NULL, 'Tramitacion', 3, '[null]', '8888', 9),
(17, '2024-10-01 22:14:45', '2024-10-01 22:14:45', 8, 'Remolque', '18699744-1', 'camyn@mailinator.com', '+573046405008', 'Voluptatem velit magni at laboris in aut ex rerum numquam odio fugiat', 'Tempor adipisicing vitae ex modi illum tenetur fugiat', NULL, NULL, NULL, NULL, '[]', 11, 0, 0, 0, '[null]', '[]', NULL, NULL, NULL, '[null]', NULL, NULL, NULL, '\"[]\"', '\"[]\"', 'Iniciada', '2', NULL, 'Activo', NULL, 'Tramitacion', 1, '[null]', NULL, 16),
(18, '2024-10-02 14:13:17', '2024-10-02 14:15:26', 5, 'manuel vicuna', '6561769-2', 'mvicunae@gmail.com', '+56984473090', 'el mismo', 'santiago', '890', 'Pagare', 'UNBC con Vicuna', '2024-10-02', '[\"12\"]', 18, 1, 0, 0, '[null]', '[]', '2024-10-01', 'Patricio Silva', NULL, '[null]', 'CLP', NULL, '1', '\"[]\"', '\"[]\"', 'Iniciada', '5', 'UNB con Vicuna', 'Activo', NULL, 'Tramitacion', 3, '[null]', '345', 9),
(19, '2024-10-02 14:30:59', '2024-10-15 16:26:54', 7, 'Remolque', '18699744-1', 'camyn@mailinator.com', '+573046405008', 'Voluptatem velit magni at laboris in aut ex rerum numquam odio fugiat', 'Tempor adipisicing vitae ex modi illum tenetur fugiat', NULL, 'Polar Shipping', NULL, NULL, '[\"21\"]', 10, 0, 0, 0, '[null]', '[]', NULL, NULL, NULL, '[null]', NULL, NULL, NULL, '\"[]\"', '\"[]\"', 'Iniciada', '19', NULL, 'Activo', NULL, 'Tramitacion', 1, '[null]', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `pais_id` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`id`, `nombre`, `pais_id`, `updated_at`, `created_at`) VALUES
(1, 'Arica', '4', NULL, NULL),
(2, 'Camarones', '4', NULL, NULL),
(3, 'Putre', '4', NULL, NULL),
(4, 'General Lagos', '4', NULL, NULL),
(5, 'Iquique', '4', NULL, NULL),
(6, 'Alto Hospicio', '4', NULL, NULL),
(7, 'Pozo Almonte', '4', NULL, NULL),
(8, 'Camiña', '4', NULL, NULL),
(9, 'Colchane', '4', NULL, NULL),
(10, 'Huara', '4', NULL, NULL),
(11, 'Pica', '4', NULL, NULL),
(12, 'Antofagasta', '4', NULL, NULL),
(13, 'Mejillones', '4', NULL, NULL),
(14, 'Sierra Gorda', '4', NULL, NULL),
(15, 'Taltal', '4', NULL, NULL),
(16, 'Calama', '4', NULL, NULL),
(17, 'Ollagüe', '4', NULL, NULL),
(18, 'San Pedro de Atacama', '4', NULL, NULL),
(19, 'Tocopilla', '4', NULL, NULL),
(20, 'María Elena', '4', NULL, NULL),
(21, 'Copiapó', '4', NULL, NULL),
(22, 'Caldera', '4', NULL, NULL),
(23, 'Tierra Amarilla', '4', NULL, NULL),
(24, 'Chañaral', '4', NULL, NULL),
(25, 'Diego de Almagro', '4', NULL, NULL),
(26, 'Vallenar', '4', NULL, NULL),
(27, 'Alto del Carmen', '4', NULL, NULL),
(28, 'Freirina', '4', NULL, NULL),
(29, 'Huasco', '4', NULL, NULL),
(30, 'La Serena', '4', NULL, NULL),
(31, 'Coquimbo', '4', NULL, NULL),
(32, 'Andacollo', '4', NULL, NULL),
(33, 'La Higuera', '4', NULL, NULL),
(34, 'Paiguano', '4', NULL, NULL),
(35, 'Vicuña', '4', NULL, NULL),
(36, 'Illapel', '4', NULL, NULL),
(37, 'Canela', '4', NULL, NULL),
(38, 'Los Vilos', '4', NULL, NULL),
(39, 'Salamanca', '4', NULL, NULL),
(40, 'Ovalle', '4', NULL, NULL),
(41, 'Combarbalá', '4', NULL, NULL),
(42, 'Monte Patria', '4', NULL, NULL),
(43, 'Punitaqui', '4', NULL, NULL),
(44, 'Río Hurtado', '4', NULL, NULL),
(45, 'Valparaíso', '4', NULL, NULL),
(46, 'Casablanca', '4', NULL, NULL),
(47, 'Concón', '4', NULL, NULL),
(48, 'Juan Fernández', '4', NULL, NULL),
(49, 'Puchuncaví', '4', NULL, NULL),
(50, 'Quintero', '4', NULL, NULL),
(51, 'Viña del Mar', '4', NULL, NULL),
(52, 'Isla de Pascua', '4', NULL, NULL),
(53, 'Los Andes', '4', NULL, NULL),
(54, 'Calle Larga', '4', NULL, NULL),
(55, 'Rinconada', '4', NULL, NULL),
(56, 'San Esteban', '4', NULL, NULL),
(57, 'La Ligua', '4', NULL, NULL),
(58, 'Cabildo', '4', NULL, NULL),
(59, 'Papudo', '4', NULL, NULL),
(60, 'Petorca', '4', NULL, NULL),
(61, 'Zapallar', '4', NULL, NULL),
(62, 'Quillota', '4', NULL, NULL),
(63, 'Calera', '4', NULL, NULL),
(64, 'Hijuelas', '4', NULL, NULL),
(65, 'La Cruz', '4', NULL, NULL),
(66, 'Nogales', '4', NULL, NULL),
(67, 'San Antonio', '4', NULL, NULL),
(68, 'Algarrobo', '4', NULL, NULL),
(69, 'Cartagena', '4', NULL, NULL),
(70, 'El Quisco', '4', NULL, NULL),
(71, 'El Tabo', '4', NULL, NULL),
(72, 'Santo Domingo', '4', NULL, NULL),
(73, 'San Felipe', '4', NULL, NULL),
(74, 'Catemu', '4', NULL, NULL),
(75, 'Llaillay', '4', NULL, NULL),
(76, 'Panquehue', '4', NULL, NULL),
(77, 'Putaendo', '4', NULL, NULL),
(78, 'Santa María', '4', NULL, NULL),
(79, 'Quilpué', '4', NULL, NULL),
(80, 'Limache', '4', NULL, NULL),
(81, 'Olmué', '4', NULL, NULL),
(82, 'Villa Alemana', '4', NULL, NULL),
(83, 'Rancagua', '4', NULL, NULL),
(84, 'Codegua', '4', NULL, NULL),
(85, 'Coinco', '4', NULL, NULL),
(86, 'Coltauco', '4', NULL, NULL),
(87, 'Doñihue', '4', NULL, NULL),
(88, 'Graneros', '4', NULL, NULL),
(89, 'Las Cabras', '4', NULL, NULL),
(90, 'Machalí', '4', NULL, NULL),
(91, 'Malloa', '4', NULL, NULL),
(92, 'Mostazal', '4', NULL, NULL),
(93, 'Olivar', '4', NULL, NULL),
(94, 'Peumo', '4', NULL, NULL),
(95, 'Pichidegua', '4', NULL, NULL),
(96, 'Quinta de Tilcoco', '4', NULL, NULL),
(97, 'Rengo', '4', NULL, NULL),
(98, 'Requínoa', '4', NULL, NULL),
(99, 'San Vicente', '4', NULL, NULL),
(100, 'Pichilemu', '4', NULL, NULL),
(101, 'La Estrella', '4', NULL, NULL),
(102, 'Litueche', '4', NULL, NULL),
(103, 'Marchihue', '4', NULL, NULL),
(104, 'Navidad', '4', NULL, NULL),
(105, 'Paredones', '4', NULL, NULL),
(106, 'San Fernando', '4', NULL, NULL),
(107, 'Chépica', '4', NULL, NULL),
(108, 'Chimbarongo', '4', NULL, NULL),
(109, 'Lolol', '4', NULL, NULL),
(110, 'Nancagua', '4', NULL, NULL),
(111, 'Palmilla', '4', NULL, NULL),
(112, 'Peralillo', '4', NULL, NULL),
(113, 'Placilla', '4', NULL, NULL),
(114, 'Pumanque', '4', NULL, NULL),
(115, 'Santa Cruz', '4', NULL, NULL),
(116, 'Talca', '4', NULL, NULL),
(117, 'Constitución', '4', NULL, NULL),
(118, 'Curepto', '4', NULL, NULL),
(119, 'Empedrado', '4', NULL, NULL),
(120, 'Maule', '4', NULL, NULL),
(121, 'Pelarco', '4', NULL, NULL),
(122, 'Pencahue', '4', NULL, NULL),
(123, 'Río Claro', '4', NULL, NULL),
(124, 'San Clemente', '4', NULL, NULL),
(125, 'San Rafael', '4', NULL, NULL),
(126, 'Cauquenes', '4', NULL, NULL),
(127, 'Chanco', '4', NULL, NULL),
(128, 'Pelluhue', '4', NULL, NULL),
(129, 'Curicó', '4', NULL, NULL),
(130, 'Hualañé', '4', NULL, NULL),
(131, 'Licantén', '4', NULL, NULL),
(132, 'Molina', '4', NULL, NULL),
(133, 'Rauco', '4', NULL, NULL),
(134, 'Romeral', '4', NULL, NULL),
(135, 'Sagrada Familia', '4', NULL, NULL),
(136, 'Teno', '4', NULL, NULL),
(137, 'Vichuquén', '4', NULL, NULL),
(138, 'Linares', '4', NULL, NULL),
(139, 'Colbún', '4', NULL, NULL),
(140, 'Longaví', '4', NULL, NULL),
(141, 'Parral', '4', NULL, NULL),
(142, 'Retiro', '4', NULL, NULL),
(143, 'San Javier', '4', NULL, NULL),
(144, 'Villa Alegre', '4', NULL, NULL),
(145, 'Yerbas Buenas', '4', NULL, NULL),
(146, 'Concepción', '4', NULL, NULL),
(147, 'Coronel', '4', NULL, NULL),
(148, 'Chiguayante', '4', NULL, NULL),
(149, 'Florida', '4', NULL, NULL),
(150, 'Hualqui', '4', NULL, NULL),
(151, 'Lota', '4', NULL, NULL),
(152, 'Penco', '4', NULL, NULL),
(153, 'San Pedro de la Paz', '4', NULL, NULL),
(154, 'Santa Juana', '4', NULL, NULL),
(155, 'Talcahuano', '4', NULL, NULL),
(156, 'Tomé', '4', NULL, NULL),
(157, 'Hualpén', '4', NULL, NULL),
(158, 'Lebu', '4', NULL, NULL),
(159, 'Arauco', '4', NULL, NULL),
(160, 'Cañete', '4', NULL, NULL),
(161, 'Contulmo', '4', NULL, NULL),
(162, 'Curanilahue', '4', NULL, NULL),
(163, 'Los Álamos', '4', NULL, NULL),
(164, 'Tirúa', '4', NULL, NULL),
(165, 'Los Ángeles', '4', NULL, NULL),
(166, 'Antuco', '4', NULL, NULL),
(167, 'Cabrero', '4', NULL, NULL),
(168, 'Laja', '4', NULL, NULL),
(169, 'Mulchén', '4', NULL, NULL),
(170, 'Nacimiento', '4', NULL, NULL),
(171, 'Negrete', '4', NULL, NULL),
(172, 'Quilaco', '4', NULL, NULL),
(173, 'Quilleco', '4', NULL, NULL),
(174, 'San Rosendo', '4', NULL, NULL),
(175, 'Santa Bárbara', '4', NULL, NULL),
(176, 'Tucapel', '4', NULL, NULL),
(177, 'Yumbel', '4', NULL, NULL),
(178, 'Alto Biobío', '4', NULL, NULL),
(179, 'Chillán', '4', NULL, NULL),
(180, 'Bulnes', '4', NULL, NULL),
(181, 'Cobquecura', '4', NULL, NULL),
(182, 'Coelemu', '4', NULL, NULL),
(183, 'Coihueco', '4', NULL, NULL),
(184, 'Chillán Viejo', '4', NULL, NULL),
(185, 'El Carmen', '4', NULL, NULL),
(186, 'Ninhue', '4', NULL, NULL),
(187, 'Ñiquén', '4', NULL, NULL),
(188, 'Pemuco', '4', NULL, NULL),
(189, 'Pinto', '4', NULL, NULL),
(190, 'Portezuelo', '4', NULL, NULL),
(191, 'Quillón', '4', NULL, NULL),
(192, 'Quirihue', '4', NULL, NULL),
(193, 'Ránquil', '4', NULL, NULL),
(194, 'San Carlos', '4', NULL, NULL),
(195, 'San Fabián', '4', NULL, NULL),
(196, 'San Ignacio', '4', NULL, NULL),
(197, 'San Nicolás', '4', NULL, NULL),
(198, 'Treguaco', '4', NULL, NULL),
(199, 'Yungay', '4', NULL, NULL),
(200, 'Temuco', '4', NULL, NULL),
(201, 'Carahue', '4', NULL, NULL),
(202, 'Cunco', '4', NULL, NULL),
(203, 'Curarrehue', '4', NULL, NULL),
(204, 'Freire', '4', NULL, NULL),
(205, 'Galvarino', '4', NULL, NULL),
(206, 'Gorbea', '4', NULL, NULL),
(207, 'Lautaro', '4', NULL, NULL),
(208, 'Loncoche', '4', NULL, NULL),
(209, 'Melipeuco', '4', NULL, NULL),
(210, 'Nueva Imperial', '4', NULL, NULL),
(211, 'Padre las Casas', '4', NULL, NULL),
(212, 'Perquenco', '4', NULL, NULL),
(213, 'Pitrufquén', '4', NULL, NULL),
(214, 'Pucón', '4', NULL, NULL),
(215, 'Saavedra', '4', NULL, NULL),
(216, 'Teodoro Schmidt', '4', NULL, NULL),
(217, 'Toltén', '4', NULL, NULL),
(218, 'Vilcún', '4', NULL, NULL),
(219, 'Villarrica', '4', NULL, NULL),
(220, 'Cholchol', '4', NULL, NULL),
(221, 'Angol', '4', NULL, NULL),
(222, 'Collipulli', '4', NULL, NULL),
(223, 'Curacautín', '4', NULL, NULL),
(224, 'Ercilla', '4', NULL, NULL),
(225, 'Lonquimay', '4', NULL, NULL),
(226, 'Los Sauces', '4', NULL, NULL),
(227, 'Lumaco', '4', NULL, NULL),
(228, 'Purén', '4', NULL, NULL),
(229, 'Renaico', '4', NULL, NULL),
(230, 'Traiguén', '4', NULL, NULL),
(231, 'Victoria', '4', NULL, NULL),
(232, 'Valdivia', '4', NULL, NULL),
(233, 'Corral', '4', NULL, NULL),
(234, 'Lanco', '4', NULL, NULL),
(235, 'Los Lagos', '4', NULL, NULL),
(236, 'Máfil', '4', NULL, NULL),
(237, 'Mariquina', '4', NULL, NULL),
(238, 'Paillaco', '4', NULL, NULL),
(239, 'Panguipulli', '4', NULL, NULL),
(240, 'La Unión', '4', NULL, NULL),
(241, 'Futrono', '4', NULL, NULL),
(242, 'Lago Ranco', '4', NULL, NULL),
(243, 'Río Bueno', '4', NULL, NULL),
(244, 'Puerto Montt', '4', NULL, NULL),
(245, 'Calbuco', '4', NULL, NULL),
(246, 'Cochamó', '4', NULL, NULL),
(247, 'Fresia', '4', NULL, NULL),
(248, 'Frutillar', '4', NULL, NULL),
(249, 'Los Muermos', '4', NULL, NULL),
(250, 'Llanquihue', '4', NULL, NULL),
(251, 'Maullín', '4', NULL, NULL),
(252, 'Puerto Varas', '4', NULL, NULL),
(253, 'Castro', '4', NULL, NULL),
(254, 'Ancud', '4', NULL, NULL),
(255, 'Chonchi', '4', NULL, NULL),
(256, 'Curaco de Vélez', '4', NULL, NULL),
(257, 'Dalcahue', '4', NULL, NULL),
(258, 'Puqueldón', '4', NULL, NULL),
(259, 'Queilén', '4', NULL, NULL),
(260, 'Quellón', '4', NULL, NULL),
(261, 'Quemchi', '4', NULL, NULL),
(262, 'Quinchao', '4', NULL, NULL),
(263, 'Osorno', '4', NULL, NULL),
(264, 'Puerto Octay', '4', NULL, NULL),
(265, 'Purranque', '4', NULL, NULL),
(266, 'Puyehue', '4', NULL, NULL),
(267, 'Río Negro', '4', NULL, NULL),
(268, 'San Juan de la Costa', '4', NULL, NULL),
(269, 'San Pablo', '4', NULL, NULL),
(270, 'Chaitén', '4', NULL, NULL),
(271, 'Futaleufú', '4', NULL, NULL),
(272, 'Hualaihué', '4', NULL, NULL),
(273, 'Palena', '4', NULL, NULL),
(274, 'Coyhaique', '4', NULL, NULL),
(275, 'Lago Verde', '4', NULL, NULL),
(276, 'Aysén', '4', NULL, NULL),
(277, 'Cisnes', '4', NULL, NULL),
(278, 'Guaitecas', '4', NULL, NULL),
(279, 'Cochrane', '4', NULL, NULL),
(280, 'O’Higgins', '4', NULL, NULL),
(281, 'Tortel', '4', NULL, NULL),
(282, 'Chile Chico', '4', NULL, NULL),
(283, 'Río Ibáñez', '4', NULL, NULL),
(284, 'Punta Arenas', '4', NULL, NULL),
(285, 'Laguna Blanca', '4', NULL, NULL),
(286, 'Río Verde', '4', NULL, NULL),
(287, 'San Gregorio', '4', NULL, NULL),
(288, 'Cabo de Hornos', '4', NULL, NULL),
(289, 'Antártica', '4', NULL, NULL),
(290, 'Porvenir', '4', NULL, NULL),
(291, 'Primavera', '4', NULL, NULL),
(292, 'Timaukel', '4', NULL, NULL),
(293, 'Natales', '4', NULL, NULL),
(294, 'Torres del Paine', '4', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empresa` varchar(255) DEFAULT NULL,
  `rut` varchar(255) DEFAULT NULL,
  `domicilio` varchar(255) DEFAULT NULL,
  `pais` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `ciudad` varchar(255) DEFAULT NULL,
  `representante` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `ejecutivo` varchar(255) DEFAULT NULL,
  `email2` varchar(255) DEFAULT NULL,
  `telefono2` varchar(255) DEFAULT NULL,
  `sitio` varchar(255) DEFAULT NULL,
  `asegurador` varchar(255) DEFAULT NULL,
  `daño` varchar(255) DEFAULT NULL,
  `cobrofijo` varchar(255) DEFAULT NULL,
  `casos` varchar(255) DEFAULT NULL,
  `finanzas` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` varchar(255) DEFAULT 'Activo',
  `cobrohora` varchar(255) DEFAULT NULL,
  `cobroporciento` varchar(255) DEFAULT NULL,
  `postal` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `empresa`, `rut`, `domicilio`, `pais`, `direccion`, `ciudad`, `representante`, `email`, `telefono`, `ejecutivo`, `email2`, `telefono2`, `sitio`, `asegurador`, `daño`, `cobrofijo`, `casos`, `finanzas`, `created_at`, `updated_at`, `estado`, `cobrohora`, `cobroporciento`, `postal`) VALUES
(5, 'UNBCorp', '5.574.150-6', 'Praesentium fugit qui eiusmod ab in voluptatum do', '4', 'rosario 470', '3', 'Jose Perez', 'tupaza@mailinator.com', '+573046405009', 'Carlos Molina', 'xybofiteji@mailinator.com', '1168855487', 'https://music.youtube.com.cl', 'Empresa1', 'Prueba 1', '1', NULL, NULL, '2024-09-04 13:58:19', '2024-10-01 15:58:34', 'Activo', '0', '1', '762601'),
(6, 'reservatodo spa', '77476827-0', 'Cerro el Plomo 5359', '4', NULL, NULL, 'Manuel vicuna', 'manuel@reservatodo.cl', '984473090', 'pedro pablo', 'pablo@maritimaunida.com', '984473090', 'reservatodo.cl', NULL, 'perdida contenedor', '1', NULL, NULL, '2024-09-05 14:48:41', '2024-09-12 16:18:41', 'Activo', '1', '0', NULL),
(7, 'Fugiat accusantium blanditiis', '10142035-3', 'Calle 5 #3-56 Piso 02', '4', 'Calle 5 #3-56 Piso 02', '3', 'Victor', 'jojeriza@mailinator.com', '3046405009', 'Manuel', 'muzyr@mailinator.com', '3046405009', 'https://music.youtube.com.cl', NULL, NULL, NULL, NULL, NULL, '2024-09-12 16:16:25', '2024-09-25 18:15:05', 'Activo', NULL, NULL, NULL),
(8, 'SpotVision Spa', '77728474-6', 'Av Manquehue sur 520 of 205', '4', NULL, NULL, 'Saturnino Amestica', 'samestica@msn.com', '+56990999549', 'Saturnino Amestica', NULL, NULL, 'www.spotvision.cl', NULL, NULL, NULL, NULL, NULL, '2024-09-26 21:18:27', '2024-09-26 21:22:31', 'Activo', NULL, NULL, '750000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `demandantes`
--

CREATE TABLE `demandantes` (
  `id` int(11) NOT NULL,
  `empresa_demandante` varchar(255) DEFAULT NULL,
  `rut_demandante` varchar(255) DEFAULT NULL,
  `email_demandante` varchar(255) DEFAULT NULL,
  `telefono_demandante` varchar(255) DEFAULT NULL,
  `representante_demandante` varchar(255) DEFAULT NULL,
  `domicilio_demandante` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `demandantes`
--

INSERT INTO `demandantes` (`id`, `empresa_demandante`, `rut_demandante`, `email_demandante`, `telefono_demandante`, `representante_demandante`, `domicilio_demandante`, `created_at`, `updated_at`) VALUES
(1, 'Remolque', '18699744-1', 'camyn@mailinator.com', '+573046405008', 'Voluptatem velit magni at laboris in aut ex rerum numquam odio fugiat', 'Tempor adipisicing vitae ex modi illum tenetur fugiat', '2024-09-27 00:18:56', '2024-10-01 16:03:29'),
(2, 'Id possimus tenetur debitis r', '15198721-4', 'dusoji@mailinator.com', '+573046405009', 'Sit est vitae et veniam ut sunt eos ipsum dolores et quae facilis esse', 'Fuga Aut error iste quas beatae dolor laboris quidem tempore ratione dolore elit', '2024-09-27 19:10:09', '2024-09-27 19:10:09'),
(3, 'manuel vicuna', '6561769-2', 'mvicunae@gmail.com', '+56984473090', 'el mismo', 'santiago', '2024-10-01 17:57:53', '2024-10-01 17:57:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_08_20_164532_add_two_factor_columns_to_users_table', 1),
(5, '2024_08_20_164601_create_personal_access_tokens_table', 1),
(6, '2024_08_23_131341_create_user_groups_table', 1),
(7, '2024_08_23_131503_create_tipo_documento_table', 1),
(8, '2024_08_23_131710_add_fields_to_users_table', 1),
(9, '2024_08_23_131920_create_permisos_table', 1),
(10, '2024_09_02_153832_create_clientes_table', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monto_hora`
--

CREATE TABLE `monto_hora` (
  `id` int(11) NOT NULL,
  `monto` decimal(8,3) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `monto_hora`
--

INSERT INTO `monto_hora` (`id`, `monto`, `created_at`, `updated_at`) VALUES
(1, 99.999, NULL, NULL),
(2, 100.000, NULL, NULL),
(3, 5.500, '2024-09-26 22:51:28', '2024-09-26 22:52:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`id`, `nombre`) VALUES
(1, 'Argentina'),
(2, 'Bolivia'),
(3, 'Brasil'),
(4, 'Chile'),
(5, 'Colombia'),
(6, 'Costa Rica'),
(7, 'Cuba'),
(8, 'Ecuador'),
(9, 'El Salvador'),
(10, 'Guatemala'),
(11, 'Honduras'),
(12, 'México'),
(13, 'Nicaragua'),
(14, 'Panamá'),
(15, 'Paraguay'),
(16, 'Perú'),
(17, 'República Dominicana'),
(18, 'Uruguay'),
(19, 'Venezuela');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('ale132402@hotmail.com', '$2y$12$Ww/yXcu4hxljjI3Jj/obeOkChorthI/Q9MdO2KudidDnAYLR8SRlK', '2024-08-30 21:08:07'),
('cvd@mackaycia.cl', '$2y$12$DmARLuFDxgs0tNcRjnHhRuJgCZbPovmUBeQt5XZQkRdFCzqRuFaaS', '2024-10-01 16:36:50'),
('faffa@mackaycia.cl', '$2y$12$u2Hg83smSWA06VlgYLFOiOzqOwi02xTc6qXWDlRsWiG/F1jsb8dwO', '2024-09-12 15:29:07'),
('fpg@mackaycia.cl', '$2y$12$e075HKcsZeAEHknadU7sLemyYg7x/TXJptHFXd2raROHbtf41w4XS', '2024-10-01 16:33:57'),
('hectorp5@yopmail.com', '$2y$12$VTv3ZBAKaGShse7mvnFrgeMZInwwdsACpUYNlZf42qZ5uAO1cAVRO', '2024-09-05 19:39:46'),
('irc@mackaycia.cl', '$2y$12$scaG.Z86mni/zS0k6WdV5OKrl140bR3z8bROkZfJ3sjFIjUX20cwK', '2024-09-12 15:22:49'),
('jorjecasanova@gmail.com', '$2y$12$niDjzcAAKGg0viaI7y2P9erQ2FzpBqD0gUgkeQFI1TpbGEj5f.3bu', '2024-09-12 14:51:09'),
('julio22@yopmail.com', '$2y$12$9GMQyMGlechatY8zh1Xi7eydkCi2x954JbAs3w8/aDicTl.vLiGzW', '2024-09-05 19:39:14'),
('lucasg@yopmail.com', '$2y$12$hCUDY8hD4EuGKtnplSpOFOMSTG/1aZRvAj1xLtLOtcs0BvwKqNIsa', '2024-09-05 14:01:27'),
('luism33@yopmail.com', '$2y$12$x0AyTb4dX9417YicUhyYv.1S8K2Z3S//Gdh9uT34svCa78OrxOlJe', '2024-09-05 19:37:53'),
('manuel@reservatodo.cl', '$2y$12$3ODBpU.DRapg5zwF8UHZzOjnCiARJiUxgt4O571gHdaVui8kAqk3O', '2024-10-01 22:57:48'),
('prueba@gmail.com', '$2y$12$Wfq9VCL/Ye8Hfr90BFGmp.87.4Iv4WONDEwQnUpLQCkc7HNIi8ai2', '2024-08-30 20:50:24'),
('pruewbas@gmail.com', '$2y$12$TVnDJeXR8uPTBkM79Tp7ueHV2quEzDjKtPYl1mTjNYZUUlIjoroa6', '2024-08-30 21:39:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `modulo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `nombre`, `created_at`, `updated_at`, `modulo`) VALUES
(1, 'Ver usuarios', NULL, NULL, 'Usuario'),
(2, 'Crear usuarios', NULL, NULL, 'Usuario'),
(3, 'Editar usuarios', NULL, NULL, 'Usuario'),
(4, 'Eliminar usuarios', NULL, NULL, 'Usuario'),
(5, 'Ver Roles', NULL, NULL, 'Administrador'),
(6, 'Crear Roles', NULL, NULL, 'Administrador'),
(7, 'Editar Roles', NULL, NULL, 'Administrador'),
(8, 'Eliminar Roles', NULL, NULL, 'Administrador'),
(9, 'ver cliente', NULL, NULL, 'Cliente'),
(10, 'crear cliente', NULL, NULL, 'Cliente'),
(11, 'editar cliente', NULL, NULL, 'Cliente'),
(12, 'eliminar cliente', NULL, NULL, 'Cliente'),
(13, 'Ver Abogados', NULL, NULL, 'Abogados'),
(14, 'Crear Abogados', NULL, NULL, 'Abogados'),
(15, 'Editar Abogados', NULL, NULL, 'Abogados'),
(16, 'Eliminar Abogados', NULL, NULL, 'Abogados'),
(17, 'Ver Tipo Casos', NULL, NULL, 'Administrador'),
(18, 'Crear Tipo Casos', NULL, NULL, 'Administrador'),
(19, 'Editar Tipo Casos', NULL, NULL, 'Administrador'),
(20, 'Eliminar Tipo Casos', NULL, NULL, 'Administrador'),
(21, 'Ver Actividad', NULL, NULL, 'Administrador'),
(22, 'Crear Actividad', NULL, NULL, 'Administrador'),
(23, 'Editar Actividad', NULL, NULL, 'Administrador'),
(24, 'Eliminar Actividad', NULL, NULL, 'Administrador'),
(25, 'Cargar H', NULL, NULL, 'Casos'),
(26, 'Editar Actividad', NULL, NULL, 'Casos'),
(27, 'Eliminar Actividad', NULL, NULL, 'Casos'),
(28, 'Eliminar Documento', NULL, NULL, 'Casos'),
(29, 'Ver Casos', NULL, NULL, 'Casos'),
(30, 'Crear Casos', NULL, NULL, 'Casos'),
(31, 'Editar Casos', NULL, NULL, 'Casos'),
(32, 'Eliminar Casos', NULL, NULL, 'Casos'),
(33, 'Cargar H', NULL, NULL, 'SubCasos'),
(34, 'Editar Actividad', NULL, NULL, 'SubCasos'),
(35, 'Eliminar Actividad', NULL, NULL, 'SubCasos'),
(36, 'Eliminar Documento', NULL, NULL, 'SubCasos'),
(37, 'Ver Subcasos', NULL, NULL, 'SubCasos'),
(38, 'Crear Subcasos', NULL, NULL, 'SubCasos'),
(39, 'Editar Subcasos', NULL, NULL, 'SubCasos'),
(40, 'Eliminar Subcasos', NULL, NULL, 'SubCasos'),
(41, 'Ver Procesal', NULL, NULL, 'Administrador'),
(42, 'Crear Procesal', NULL, NULL, 'Administrador'),
(43, 'Editar Procesal', NULL, NULL, 'Administrador'),
(44, 'Eliminar Procesal', NULL, NULL, 'Administrador'),
(45, 'Ver Monto Hora', NULL, NULL, 'Administrador'),
(46, 'Crear Monto Hora', NULL, NULL, 'Administrador'),
(47, 'Editar Monto Hora', NULL, NULL, 'Administrador'),
(48, 'Eliminar Monto Hora', NULL, NULL, 'Administrador'),
(49, 'Ver Tribunales', NULL, NULL, 'Administrador'),
(50, 'Crear Tribunales', NULL, NULL, 'Administrador'),
(51, 'Editar Tribunales', NULL, NULL, 'Administrador'),
(52, 'Eliminar Tribunales', NULL, NULL, 'Administrador'),
(53, 'Ver Demandantes', NULL, NULL, 'Administrador'),
(54, 'Crear Demandantes', NULL, NULL, 'Administrador'),
(55, 'Editar Demandantes', NULL, NULL, 'Administrador'),
(56, 'Eliminar Demandantes', NULL, NULL, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('3JSbM8tz1W1MIUUEjLXJujx4x7JRfisctIyTRC1s', NULL, '65.49.1.17', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:108.0) Gecko/20100101 Firefox/108.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMm82ZVE2VTdadE1CTG82UHRxcXNSTEZyN3lDeHRKV3h2UHJWaEh6eiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly8xODEuMTE4LjY5LjYxOjgwNTAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1727872943),
('aUqiiASOsBpt6fVmwNjV9K90Mq4xFNd8vANF6l77', 9, '200.73.244.174', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36 Edg/129.0.0.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoia2VKRnJmbkN2VzhVSEV3b0tsVDQ1YVU5cFVKUnZ1bnpiUVVDbm9GaCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQ1OiJodHRwOi8vMTgxLjExOC42OS42MTo4MDUwL3N1YmNhc29zL2NsaWVudGVzLzYiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo5O3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEyJGk0OEl3RFBDakRVUi9OcjdVOExzZHU5UnNjT0x5N3cuU2hrR3lHeUVOLkFCeEsuZ09TT3ZhIjt9', 1727876798),
('BXGRjzDebitsqqRUkzksUJ0AzwitRTmeheXHKf2k', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoib1RPbVNnMTN2bnY1RFFxSFJTcUNkU2FOanRGZVBuSVl2cE96RXpONyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90cmlidW5hbCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTIkRmltYXRDdmM2bXRjUnBGSS5sbTIuT0phLjYzLkF3enUyWUJVb2IvUGdReC43a21XaVBrQ1ciO30=', 1728561960),
('faZ1nReaZmKqrxwAFzqkVIwODb6ddyA1D0qbuptC', NULL, '200.73.244.174', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR3pDRk84eFFrUG1OTDVlYjNXMDR4SUJacGdUVXJycTd4MDA2elVSciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTM1OiJodHRwOi8vMTgxLjExOC42OS42MTo4MDUwL3Jlc2V0LXBhc3N3b3JkL2NiM2YyZTgxZDgzOTM0NjdlN2NhOTk1MDk4Yzg2NjBiNjVkNTRkYTM0NGRhMDQ2YWM2YzJjNmIwZjg5Zjg5NGE/ZW1haWw9bWFudWVsJTQwcmVzZXJ2YXRvZG8uY2wiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1727878137),
('g5r3YLeHk853zCmcBHRadevcwJvGI7Yaa1cXPP5h', NULL, '65.49.1.13', 'Mozilla/5.0 (X11; Linux x86_64; rv:107.0) Gecko/20100101 Firefox/107.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic3BkUGpQM3k5UEtNekJCQmNhWUp1SkdlSmNqWmdYMWdZN094a3FzZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xODEuMTE4LjY5LjYxOjgwNTAvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1727872952),
('RldwTCmQ85IXnvCwyRBhKuxWls8I96JaxjLnDm9m', NULL, '65.49.1.13', 'Mozilla/5.0 (X11; Linux x86_64; rv:107.0) Gecko/20100101 Firefox/107.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN2JuNEtoSm1lOWU5cjl0bjB3RGl5ME9Ia0hMU05IOUplWFNIVFlkOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly8xODEuMTE4LjY5LjYxOjgwNTAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1727872951),
('rsFippnQpw9hEXrMyJZX4eb0ZDMNliuOyBXi3DbC', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiaHNVamNhcWR2cTdiOFBZZU1yS1k2V3V0MERac0haOVQ4dWQ0RlRMUSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiRGaW1hdEN2YzZtdGNScEZJLmxtMi5PSmEuNjMuQXd6dTJZQlVvYi9QZ1F4LjdrbVdpUGtDVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdWJjYXNvcyI7fX0=', 1729002839);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcasos`
--

CREATE TABLE `subcasos` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `empresa` int(11) DEFAULT NULL,
  `caso` int(11) DEFAULT NULL,
  `empresa_demandante` varchar(255) DEFAULT NULL,
  `rut_demandante` varchar(255) DEFAULT NULL,
  `email_demandante` varchar(255) DEFAULT NULL,
  `telefono_demandante` varchar(255) DEFAULT NULL,
  `representante_demandante` varchar(255) DEFAULT NULL,
  `domicilio_demandante` varchar(255) DEFAULT NULL,
  `referencia_caso` varchar(255) DEFAULT NULL,
  `descripcion_caso` varchar(255) DEFAULT NULL,
  `asunto_caso` varchar(255) DEFAULT NULL,
  `fechai` date DEFAULT NULL,
  `abogados` varchar(25) DEFAULT NULL,
  `tipo_caso` int(11) DEFAULT NULL,
  `cobrofijo` int(11) DEFAULT NULL,
  `cobrohora` int(11) DEFAULT NULL,
  `cobroporciento` int(11) DEFAULT NULL,
  `rol_caso` varchar(255) DEFAULT NULL,
  `tribunal` varchar(255) DEFAULT NULL,
  `fechait` date DEFAULT NULL,
  `juez_civil` varchar(255) DEFAULT NULL,
  `juez_arbitro` varchar(255) DEFAULT NULL,
  `rol_arbitral` varchar(255) DEFAULT NULL,
  `tipo_moneda` varchar(255) DEFAULT NULL,
  `monto_demanda` decimal(8,3) DEFAULT NULL,
  `monto_hora` longtext DEFAULT NULL,
  `actividadesData` longtext DEFAULT NULL,
  `documentosData` longtext DEFAULT NULL,
  `estado_caso` varchar(255) DEFAULT NULL,
  `etapa_procesal` varchar(255) DEFAULT NULL,
  `nombre_juicio` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT 'Activo',
  `fecha_fin` date DEFAULT NULL,
  `estado_casoi` varchar(255) DEFAULT NULL,
  `bill` varchar(255) DEFAULT NULL,
  `demandante` int(11) DEFAULT NULL,
  `referencia_demandante` varchar(255) DEFAULT NULL,
  `usuario` int(11) DEFAULT NULL,
  `refsub` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `subcasos`
--

INSERT INTO `subcasos` (`id`, `created_at`, `updated_at`, `empresa`, `caso`, `empresa_demandante`, `rut_demandante`, `email_demandante`, `telefono_demandante`, `representante_demandante`, `domicilio_demandante`, `referencia_caso`, `descripcion_caso`, `asunto_caso`, `fechai`, `abogados`, `tipo_caso`, `cobrofijo`, `cobrohora`, `cobroporciento`, `rol_caso`, `tribunal`, `fechait`, `juez_civil`, `juez_arbitro`, `rol_arbitral`, `tipo_moneda`, `monto_demanda`, `monto_hora`, `actividadesData`, `documentosData`, `estado_caso`, `etapa_procesal`, `nombre_juicio`, `estado`, `fecha_fin`, `estado_casoi`, `bill`, `demandante`, `referencia_demandante`, `usuario`, `refsub`) VALUES
(7, '2024-10-15 16:33:59', '2024-10-15 16:33:59', NULL, 19, 'Remolque', '18699744-1', 'camyn@mailinator.com', '+573046405008', 'Voluptatem velit magni at laboris in aut ex rerum numquam odio fugiat', 'Tempor adipisicing vitae ex modi illum tenetur fugiat', NULL, 'Polar Shipping', NULL, NULL, '[\"21\"]', 10, 0, 0, 0, '[null]', '[]', NULL, NULL, NULL, '[null]', NULL, NULL, NULL, '\"[]\"', '\"[]\"', NULL, NULL, NULL, 'Activo', NULL, NULL, '[null]', 1, NULL, 1, '19-1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_actividad`
--

CREATE TABLE `tipo_actividad` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `precio` longtext DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_actividad`
--

INSERT INTO `tipo_actividad` (`id`, `nombre`, `precio`, `tipo`, `created_at`, `updated_at`) VALUES
(2, 'Averiguaciones', '20.000', 'Juzgado', '2024-09-17 23:25:58', '2024-09-17 23:25:58'),
(3, 'Envio Correo', '25.000', 'Presencial', '2024-10-01 15:37:19', '2024-10-01 15:37:45'),
(4, 'fgfg', '2', 'Presencial', '2024-10-15 16:24:56', '2024-10-15 16:24:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_caso`
--

CREATE TABLE `tipo_caso` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_caso`
--

INSERT INTO `tipo_caso` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(8, 'Terceria', '2024-09-25 16:34:59', '2024-09-25 16:34:59'),
(9, 'Cobro Pagare', '2024-09-25 18:19:11', '2024-09-25 18:19:11'),
(10, 'Extrajudicial', '2024-10-01 19:49:19', '2024-10-01 19:49:19'),
(11, 'Medida prejudicial', '2024-10-01 19:49:30', '2024-10-01 19:49:30'),
(12, 'Designación árbitro', '2024-10-01 19:49:41', '2024-10-01 19:49:41'),
(13, 'Arbitraje', '2024-10-01 19:49:51', '2024-10-01 19:49:51'),
(14, 'Salvamento', '2024-10-01 19:50:02', '2024-10-01 19:50:02'),
(15, 'Ordinario indemnización', '2024-10-01 19:50:14', '2024-10-01 19:50:14'),
(16, 'Ordinario Recupero', '2024-10-01 19:50:25', '2024-10-01 19:50:25'),
(17, 'Gestión preparatoria ejecutivo', '2024-10-01 19:51:15', '2024-10-01 19:51:15'),
(18, 'Ejecutivo', '2024-10-01 19:51:26', '2024-10-01 19:51:26'),
(19, 'Laboral', '2024-10-01 19:51:40', '2024-10-01 19:51:40'),
(20, 'Laboral monitorio', '2024-10-01 19:51:53', '2024-10-01 19:51:53'),
(21, 'Penal', '2024-10-01 19:52:03', '2024-10-01 19:52:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'RUT', '2024-08-29 23:39:53', '2024-08-29 23:39:53'),
(2, 'Cédula de Extranjería', '2024-08-29 23:39:53', '2024-08-29 23:39:53'),
(3, 'Pasaporte', '2024-08-29 23:39:53', '2024-08-29 23:39:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_procesal`
--

CREATE TABLE `tipo_procesal` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_procesal`
--

INSERT INTO `tipo_procesal` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(4, 'Audiencia', '2024-10-01 19:40:34', '2024-10-01 19:40:34'),
(5, 'Incidente previo y especial', '2024-10-01 19:40:57', '2024-10-01 19:40:57'),
(6, 'Finalizada', '2024-10-01 19:41:24', '2024-10-01 19:41:24'),
(7, 'Discusión', '2024-10-01 19:41:48', '2024-10-01 19:41:48'),
(8, 'Conciliación', '2024-10-01 19:41:59', '2024-10-01 19:41:59'),
(9, 'Probatorio', '2024-10-01 19:42:10', '2024-10-01 19:42:10'),
(10, 'Incidente previo y especial', '2024-10-01 19:42:25', '2024-10-01 19:42:25'),
(11, 'Notificación', '2024-10-01 19:42:52', '2024-10-01 19:42:52'),
(12, 'Título ejecutivo', '2024-10-01 19:43:03', '2024-10-01 19:43:03'),
(13, 'Excepciones', '2024-10-01 19:43:18', '2024-10-01 19:43:18'),
(14, 'Embargo', '2024-10-01 19:43:29', '2024-10-01 19:43:29'),
(15, 'Audiencia preparatoria', '2024-10-01 19:43:46', '2024-10-01 19:43:46'),
(16, 'Audiencia de juicio', '2024-10-01 19:43:57', '2024-10-01 19:43:57'),
(17, 'Demanda', '2024-10-01 19:44:11', '2024-10-01 19:44:11'),
(18, 'Audiencia monitoria', '2024-10-01 19:44:25', '2024-10-01 19:44:25'),
(19, 'Extrajudicial', '2024-10-02 14:29:25', '2024-10-02 14:29:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tribunales`
--

CREATE TABLE `tribunales` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `ciudad` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tribunales`
--

INSERT INTO `tribunales` (`id`, `nombre`, `ciudad`, `created_at`, `updated_at`) VALUES
(1, 'Tribunal 13', '32', '2024-09-26 23:11:35', '2024-10-10 14:06:00'),
(2, 'Tribunal 1', '5', '2024-09-26 23:11:47', '2024-10-01 15:40:45'),
(3, '1° Juzgado de Letras Arica', '1', '2024-10-02 13:51:06', '2024-10-02 13:54:41'),
(4, '2° Juzgado de Letras Arica', '1', '2024-10-02 13:52:01', '2024-10-02 13:54:51'),
(6, '3° Juzgado de Letras Arica', '1', '2024-10-02 13:52:25', '2024-10-02 13:55:02'),
(7, 'Juzgado de Familia Arica', '1', '2024-10-02 13:54:29', '2024-10-02 13:54:29'),
(8, 'Juzgado de Letras del Trabajo', '1', '2024-10-02 13:59:04', '2024-10-02 13:59:04'),
(9, 'Juzgado de Garantia de Arica', '1', '2024-10-02 13:59:53', '2024-10-02 13:59:53'),
(10, 'Juzgado de Garantia de Arica', '1', '2024-10-02 13:59:53', '2024-10-02 13:59:53'),
(11, '1° Juzgado de Letras Iquique', '5', '2024-10-02 14:04:20', '2024-10-02 14:04:20'),
(12, '2° Juzgado de Letras Iquique', '5', '2024-10-02 14:04:20', '2024-10-02 14:06:07'),
(13, '3° Juzgado de Letras Iquique', '5', '2024-10-02 14:06:36', '2024-10-02 14:06:36'),
(14, 'Juzgado de Familia Iquique', '5', '2024-10-02 14:07:21', '2024-10-02 14:07:21'),
(15, 'Juzgado de Letras del Trabajo', '5', '2024-10-02 14:07:57', '2024-10-02 14:07:57'),
(16, 'Juzgado de Garantia de Iquique', '5', '2024-10-02 14:08:44', '2024-10-02 14:08:44'),
(17, '1° Juzgado Civil de Valparaiso', '45', '2024-10-02 14:27:04', '2024-10-02 14:27:04'),
(18, 'fdgfdgdfg', '1', '2024-10-10 14:05:45', '2024-10-10 14:05:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `tipo_documento` varchar(255) DEFAULT NULL,
  `numero_documento` varchar(255) DEFAULT NULL,
  `numero_telefonico` varchar(255) DEFAULT NULL,
  `tipo_usuario` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT 'Activo',
  `fechan` date DEFAULT NULL,
  `iniciales` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `apellido`, `tipo_documento`, `numero_documento`, `numero_telefonico`, `tipo_usuario`, `estado`, `fechan`, `iniciales`) VALUES
(1, 'Jorge', 'jorjecasanova@gmail.com', NULL, '$2y$12$FimatCvc6mtcRpFI.lm2.OJa.63.Awzu2YBUob/PgQx.7kmWiPkCW', NULL, NULL, NULL, NULL, NULL, 'perfil/xUm9H8gHyWYEzLSLPsYNIw1TZcz04DwMnWs7ArRQ.jpg', NULL, '2024-09-06 21:32:58', 'Casierra', '1', '22854164-8', '3046405009', '1', 'Activo', NULL, NULL),
(3, 'Mariana', 'ale132402@hotmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-30 21:08:07', '2024-09-05 13:41:27', 'Vidal', '1', '29623987', '3122057768', '5', 'Activo', NULL, NULL),
(4, 'Azucena', 'pruewbas@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-30 21:39:32', '2024-10-01 16:39:14', 'Casierra', '2', '1006332023', '3046405009', '5', 'Activo', NULL, 'AC'),
(5, 'Paola', 'psoto@unbcorp.cl', NULL, '$2y$12$kSSNbS5pZVtOeTp3JSKo9OC2IDWVtDY4EIaprvkVf2QSQn/.Gy3Xm', NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-04 13:50:33', '2024-10-01 19:02:38', 'Soto', '2', '233544653', '3046405009', '7', 'Activo', NULL, NULL),
(9, 'Manuel', 'mvicunae@mackaycia.cl', NULL, '$2y$12$i48IwDPCjDUR/Nr7U8Lsdu9RscOLy7w.ShkGyGyEN.ABxK.gOSOva', NULL, NULL, NULL, NULL, NULL, 'perfil/fAzWZePpl0r3NBahfS8nWhpZfPTtDezmlUUsIPVp.jpg', '2024-09-04 19:41:33', '2024-09-12 16:11:57', 'Vicuña', '1', '6561769-2', '984473090', '1', 'Activo', NULL, NULL),
(10, 'Lucas', 'lucasg@yopmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-05 14:01:25', '2024-09-05 14:01:25', 'Gonzalez', '1', '98545584', '1168554585', '5', 'Activo', NULL, NULL),
(11, 'Harold', 'hrengifo@unbcorp.cl', NULL, '$2y$12$tF8DxfFhYuYiWP9Wu9s5V.zSPlzn0FkrsMHywXIpdj7slSlW70Ux2', NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-05 14:15:18', '2024-09-05 14:16:08', 'Rengifo', '1', '98554458', '1162558545', '1', 'Activo', NULL, NULL),
(12, 'Alejandro', 'aud@mackaycia.cl', NULL, '$2y$12$O232D9RtuuwGiIuI18CWcuamHYTiz1WasltcyqCDuoXOtBQgMv7pS', NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-05 19:04:39', '2024-10-01 23:17:14', 'Urdangarin', '1', '21597817-6', '992991408', '5', 'Activo', NULL, 'AUD'),
(13, 'Luisa', 'luism33@yopmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-05 19:37:52', '2024-09-05 19:38:40', 'Castillo', '1', '95855458', '1168545711', '6', 'Activo', NULL, NULL),
(14, 'Julio', 'julio22@yopmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-05 19:39:14', '2024-09-05 19:39:14', 'Peña', '1', '1165854585', '1168545712', '7', 'Activo', NULL, NULL),
(15, 'Hector', 'hectorp5@yopmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-05 19:39:46', '2024-09-05 19:39:46', 'Silva', '1', '95855474', '1168554587', '5', 'Activo', NULL, NULL),
(16, 'Jose Manuel', 'jmz@mackaycia.cl', NULL, '$2y$12$gEX2bZxT/FaKaWeZCzazV.vHSl7Y0Vq8i7/E.epWzLltx3RT4xNoC', NULL, NULL, NULL, NULL, NULL, 'perfil/n2lJAFtn4NKXt3dJPjRDmcQsezaYrpf9hX4GPWkb.jpg', '2024-09-06 14:00:44', '2024-09-12 15:25:04', 'Zapico Mackay', '1', '8901155-8', '92357968', '1', 'Activo', NULL, NULL),
(17, 'Ivonne', 'irc@mackaycia.cl', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'perfil/QdmiuNYu7X8JfaGFoOtvSh37YbiYrWf57JZP6S4I.jpg', '2024-09-12 15:22:49', '2024-09-12 15:24:55', 'Riquelme Cabezas', '1', '13.095.123-6', '93201346', '7', 'Activo', NULL, NULL),
(18, 'Andrea', 'aph@mackaycia.cl', NULL, '$2y$12$UWgnshrvLbLcHl58/wMVY.YJ4SWQEQ74NmjRZ3QqicpnLL4IcqEi2', NULL, NULL, NULL, NULL, NULL, 'perfil/kJ3fvI9UWtBoCi5AEQAxIU8hppGSFBeFjUQVZujb.jpg', '2024-09-12 15:28:13', '2024-10-01 20:05:12', 'Peña Herrera', '1', '26508171-1', '78444799', '1', 'Activo', NULL, NULL),
(20, 'Fernanda', 'fpg@mackaycia.cl', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-01 16:33:56', '2024-10-01 23:16:59', 'Poblete', '1', '18855837-2', '56982051079', '5', 'Activo', '1994-07-19', 'FPG'),
(21, 'Catalina', 'cvd@mackaycia.cl', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-01 16:36:50', '2024-10-01 23:17:30', 'Verdaguer', '1', '18022506-4', '56997534005', '5', 'Activo', '1992-03-21', 'CVD'),
(22, 'manuel1', 'manuel@reservatodo.cl', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-01 22:57:48', '2024-10-01 22:57:48', 'vicuna', '1', '6561769-2', '56984473090', '5', 'Activo', '1962-10-02', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_groups`
--

CREATE TABLE `user_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `permisos` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user_groups`
--

INSERT INTO `user_groups` (`id`, `nombre`, `permisos`, `created_at`, `updated_at`) VALUES
(1, 'Super Administrador', '[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\",\"17\",\"18\",\"19\",\"20\",\"21\",\"22\",\"23\",\"24\",\"41\",\"42\",\"43\",\"44\",\"45\",\"46\",\"47\",\"48\",\"49\",\"50\",\"51\",\"52\",\"53\",\"54\",\"55\",\"56\",\"9\",\"10\",\"11\",\"12\",\"13\",\"14\",\"15\",\"16\",\"25\",\"26\",\"27\",\"28\",\"29\",\"30\",\"31\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\"]', NULL, '2024-09-27 17:32:32'),
(5, 'Abogado', '[\"1\",\"5\",\"6\",\"7\",\"8\",\"17\",\"18\",\"19\",\"20\",\"21\",\"22\",\"23\",\"24\",\"41\",\"42\",\"43\",\"44\",\"45\",\"46\",\"47\",\"48\",\"49\",\"50\",\"51\",\"52\",\"53\",\"54\",\"55\",\"56\",\"9\",\"10\",\"11\",\"13\",\"14\",\"15\",\"26\",\"27\",\"28\",\"29\",\"30\",\"31\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\"]', '2024-08-30 21:22:14', '2024-10-01 22:56:46'),
(6, 'Secretaria', '[\"1\",\"3\",\"9\",\"10\",\"11\",\"13\",\"14\",\"15\",\"16\"]', '2024-09-05 19:32:12', '2024-10-01 20:03:05'),
(7, 'Encargado de Administración', '[\"1\",\"2\",\"3\",\"4\",\"17\",\"41\",\"49\",\"53\",\"9\",\"10\",\"11\",\"13\",\"14\",\"28\",\"29\",\"31\",\"37\",\"38\"]', '2024-09-05 19:33:27', '2024-10-01 19:05:07'),
(8, 'Procurador', '[\"9\",\"10\",\"11\",\"13\",\"15\",\"26\",\"29\",\"30\",\"31\",\"34\",\"37\",\"38\",\"39\"]', '2024-10-01 19:07:07', '2024-10-01 19:07:07');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `casos`
--
ALTER TABLE `casos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `demandantes`
--
ALTER TABLE `demandantes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `monto_hora`
--
ALTER TABLE `monto_hora`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `subcasos`
--
ALTER TABLE `subcasos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_actividad`
--
ALTER TABLE `tipo_actividad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_caso`
--
ALTER TABLE `tipo_caso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_procesal`
--
ALTER TABLE `tipo_procesal`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tribunales`
--
ALTER TABLE `tribunales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `casos`
--
ALTER TABLE `casos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=295;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `demandantes`
--
ALTER TABLE `demandantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `monto_hora`
--
ALTER TABLE `monto_hora`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `subcasos`
--
ALTER TABLE `subcasos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tipo_actividad`
--
ALTER TABLE `tipo_actividad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_caso`
--
ALTER TABLE `tipo_caso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_procesal`
--
ALTER TABLE `tipo_procesal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `tribunales`
--
ALTER TABLE `tribunales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
