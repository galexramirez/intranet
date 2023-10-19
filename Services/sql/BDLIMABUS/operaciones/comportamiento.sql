/* comportamiento - Registro de las novedades de comportamiento para el calculo de desempeño*/
DROP TABLE IF EXISTS `BDLIMABUS`.`comportamiento`;
CREATE TABLE `BDLIMABUS`.`comportamiento` (
  `Comportamiento_Id` int NOT NULL AUTO_INCREMENT,
  `Comp_ID` int DEFAULT NULL,
  `Comp_Nombre CGO` varchar(23) DEFAULT NULL,
  `Comp_FechaEvento` date DEFAULT NULL,
  `Comp_Dni` varchar(8) DEFAULT NULL,
  `Comp_CodPiloto` varchar(4) DEFAULT NULL,
  `Comp_NombrePiloto` varchar(50) DEFAULT NULL,
  `Comp_Bus` varchar(5) DEFAULT NULL,
  `Comp_TipoPiloto` varchar(15) DEFAULT NULL,
  `Comp_Tabla` varchar(20) DEFAULT NULL,
  `Comp_Servicio` varchar(30) DEFAULT NULL,
  `Comp_DetalleNovedad` varchar(35) DEFAULT NULL,
  `Comp_DescripNovedad` varchar(1200) DEFAULT NULL,
  `Comp_AccionDisciplinaria` varchar(1000) DEFAULT NULL,
  `Comp_CodigoDeFalta` varchar(7) DEFAULT NULL,
  `Comp_Monto` decimal(10,2) DEFAULT NULL,
  `Comp_ReconoceResp` varchar(10) DEFAULT NULL,
  `Comp_AfectaPremio` varchar(2) DEFAULT NULL,
  `Comp_TipoDisciplina` varchar(170) DEFAULT NULL,
  `Comp_Observacion` varchar(170) DEFAULT NULL,
  `Comp_FechaCarga` datetime DEFAULT NULL,
  PRIMARY KEY (`Comportamiento_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2305 DEFAULT CHARSET=utf8mb3;