/* inasistencias - Registro de las novedades de accidentes para el calculo de desempeño */
DROP TABLE IF EXISTS `BDLIMABUS`.`inasistencias`;
CREATE TABLE `BDLIMABUS`.`inasistencias` (
  `Inasistencia_id` int NOT NULL AUTO_INCREMENT,
  `Inas_IdNovedad` varchar(20) DEFAULT NULL,
  `Inas_NombreCGO` varchar(25) DEFAULT NULL,
  `Inas_DNI` varchar(8) DEFAULT NULL,
  `Inas_CodPiloto` varchar(4) DEFAULT NULL,
  `Inas_NombrePiloto` varchar(60) DEFAULT NULL,
  `Inas_TipoPiloto` varchar(20) DEFAULT NULL,
  `Inas_FechaDeEvento` date DEFAULT NULL,
  `Inas_HoraInicio` time DEFAULT NULL,
  `Inas_HoraFinal` time DEFAULT NULL,
  `Inas_TotalHoras` time DEFAULT NULL,
  `Inas_Bus` varchar(10) DEFAULT NULL,
  `Inas_TipoBus` varchar(15) DEFAULT NULL,
  `Inas_Tabla` varchar(20) DEFAULT NULL,
  `Inas_Servicio` varchar(40) DEFAULT NULL,
  `Inas_TipoNovedad` varchar(35) DEFAULT NULL,
  `Inas_DetalleNovedad` varchar(40) DEFAULT NULL,
  `Inas_DescripNovedad` varchar(1300) DEFAULT NULL,
  `Inas_FechaCarga` datetime DEFAULT NULL,
  PRIMARY KEY (`Inasistencia_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;