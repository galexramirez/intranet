/* comunicado - Registro de ubicación de los archivos png de los comunicados */
DROP TABLE IF EXISTS `BDLIMABUS`.`comunicado`;
CREATE TABLE `comunicado` (
  `Comunicado_Id` int NOT NULL AUTO_INCREMENT,
  `Comu_Titulo` varchar(200) DEFAULT NULL,
  `Comu_FechaInicio` date DEFAULT NULL,
  `Comu_FechaFin` date DEFAULT NULL,
  `Comu_Destacado` int DEFAULT NULL,
  `Comu_Archivo` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`Comunicado_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=373 DEFAULT CHARSET=utf8mb3;
