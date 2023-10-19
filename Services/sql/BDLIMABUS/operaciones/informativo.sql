/* informativo - Registro de los informativos publicados */
DROP TABLE IF EXISTS `BDLIMABUS`.`informativo`;
CREATE TABLE `BDLIMABUS`.`informativo` (
  `Informativo_Id` int NOT NULL AUTO_INCREMENT,
  `Info_Titulo` varchar(100) DEFAULT NULL,
  `Info_Tipo` varchar(25) NOT NULL,
  `Info_Estado` varchar(45) DEFAULT NULL,
  `Info_RutaImagen` varchar(100) DEFAULT NULL,
  `Info_FechaPublicacion` datetime DEFAULT NULL,
  `Info_FechaEvaluacion` datetime DEFAULT NULL,
  `Info_FechaArchivo` datetime DEFAULT NULL,
  PRIMARY KEY (`Informativo_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3