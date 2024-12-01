-- BDLIMABUS.ope_horarios_nomina definition

CREATE TABLE `ope_horarios_nomina` (
    `id` int NOT NULL AUTO_INCREMENT,
    `hn_hnc_id` int NOT NULL,
    `hn_anio` int NOT NULL,
    `hn_periodo` varchar(45) NOT NULL,
    `hn_tipo_nomina` varchar(45) NOT NULL,
    `hn_operacion` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
    `hn_fecha` date NOT NULL,
    `hn_dni` varchar(8) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
    `hn_codigo_colaborador` varchar(4) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
    `hn_nombre_colaborador` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
    `hn_hora` time NOT NULL,
    `hn_servicio` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
    `hn_lugar` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
    `hn_tipo_marcacion` varchar(45) NOT NULL,
    `hn_hora_marcacion` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;