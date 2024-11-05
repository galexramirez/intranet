-- BDLIMABUS.comunicado definition

CREATE TABLE `comunicado` (
  `Comunicado_Id` int NOT NULL AUTO_INCREMENT,
  `Comu_Titulo` varchar(200) DEFAULT NULL,
  `Comu_FechaInicio` date DEFAULT NULL,
  `Comu_FechaFin` date DEFAULT NULL,
  `Comu_Destacado` int DEFAULT NULL,
  `Comu_Archivo` varchar(200) DEFAULT NULL,
  `Comu_Proceso` varchar(45) DEFAULT NULL,
  `Comu_Estado` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`Comunicado_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=487 DEFAULT CHARSET=utf8mb3;

ALTER TABLE BDLIMABUS.comunicado ADD Comu_Proceso varchar(45) NULL;
ALTER TABLE BDLIMABUS.comunicado ADD Comu_Estado varchar(10) NULL;
