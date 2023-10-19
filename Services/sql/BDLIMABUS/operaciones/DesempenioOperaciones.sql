/* DesempenioOperaciones - ¿ ... ? */
DROP TABLE IF EXISTS `BDLIMABUS`.`DesempenioOperaciones`;
CREATE TABLE `BDLIMABUS`.`DesempenioOperaciones` (
  `DesempenioOperaciones_id` int NOT NULL AUTO_INCREMENT,
  `DesOpe_FechaEvento` date NOT NULL,
  `DesOpe_PeriodoAplicable` varchar(7) NOT NULL,
  `DesOpe_ColaboradorID` varchar(8) NOT NULL,
  `DesOpe_Evento` varchar(200) NOT NULL,
  `DesOpe_DetalleEvento` varchar(800) NOT NULL,
  `DesOpe_CriterioImpacto` varchar(20) NOT NULL,
  `DesOpe_Peso` int NOT NULL,
  `DesOpe_ColabReporta` varchar(8) NOT NULL,
  PRIMARY KEY (`DesempenioOperaciones_id`),
  KEY `DesOpe_ColaboradorID` (`DesOpe_ColaboradorID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;