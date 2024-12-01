-- BDLIMABUS.ope_horarios_nomina_carga definition

CREATE TABLE `ope_horarios_nomina_carga` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hnc_anio` int NOT NULL,
  `hnc_periodo` varchar(45) NOT NULL,
  `hnc_tipo_nomina` varchar(45) NOT NULL,
  `hnc_fecha` date NOT NULL,
  `hnc_operacion` varchar(45) NOT NULL,
  `hnc_usuario_crea` varchar(8) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `hnc_fecha_crea` datetime NOT NULL,
  `hnc_usuario_elimina` varchar(8) DEFAULT NULL,
  `hnc_fecha_elimina` datetime DEFAULT NULL,
  `hnc_estado` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;