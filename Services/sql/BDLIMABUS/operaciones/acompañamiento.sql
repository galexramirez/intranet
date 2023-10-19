/* Acompañamientoi - Registro de las novedades de acompañamiento para el calculo de desempeño */
DROP TABLE IF EXISTS `BDLIMABUS`.`acompañamiento`;
CREATE TABLE `acompañamiento` (
  `Acompañamiento_id` int NOT NULL AUTO_INCREMENT,
  `Acomp_Num` int DEFAULT NULL,
  `Acomp_Evaluador` varchar(30) DEFAULT NULL,
  `Acomp_IdSeguimiento` varchar(30) DEFAULT NULL,
  `Acomp_Dia` varchar(15) DEFAULT NULL,
  `Acomp_Fecha` date DEFAULT NULL,
  `Acomp_Dni` varchar(8) DEFAULT NULL,
  `Acomp_Codigo` varchar(4) DEFAULT NULL,
  `Acomp_Nombre` varchar(50) DEFAULT NULL,
  `Acomp_Tabla` varchar(5) DEFAULT NULL,
  `Acomp_Inicio` time DEFAULT NULL,
  `Acomp_Fin` time DEFAULT NULL,
  `Acomp_Servicio` varchar(20) DEFAULT NULL,
  `Acomp_Bus` varchar(60) DEFAULT NULL,
  `Acomp_LugarOrigen` varchar(50) DEFAULT NULL,
  `Acomp_LugarDestino` varchar(50) DEFAULT NULL,
  `Acomp_Evento` varchar(50) DEFAULT NULL,
  `Acomp_Fecha2` date DEFAULT NULL,
  `Acomp_Tipo` varchar(50) DEFAULT NULL,
  `Acomp_Observaciones` varchar(65) DEFAULT NULL,
  `Acomp_CalificacionSeguridad` int DEFAULT NULL,
  `Acomp_CalificacionCalidad` int DEFAULT NULL,
  `Acomp_NotaFinal` int DEFAULT NULL,
  `Acomp_CumplimientoPlaneamiento` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Acompañamiento_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8781 DEFAULT CHARSET=utf8mb3;
