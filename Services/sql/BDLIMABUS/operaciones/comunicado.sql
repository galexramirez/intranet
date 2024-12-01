-- BDLIMABUS.comunicado definition

CREATE TABLE `comunicado` (
  `Comunicado_Id` int NOT NULL AUTO_INCREMENT,
  `Comu_Titulo` varchar(200) DEFAULT NULL,
  `Comu_FechaInicio` date DEFAULT NULL,
  `Comu_FechaFin` date DEFAULT NULL,
  `Comu_Destacado` int DEFAULT NULL,
  `Comu_Imagen` varchar(200) DEFAULT NULL,
  `Comu_Pdf` varchar(200) DEFAULT NULL,
  `Comu_Video` varchar(200) DEFAULT NULL,
  `Comu_Link` varchar(200) DEFAULT NULL,
  `Comu_Categoria` varchar(45) DEFAULT NULL,
  `Comu_Estado` varchar(10) DEFAULT NULL,
  `Comu_Usuario_Creacion` varchar(8) NOT NULL,
  `Comu_Fecha_Creacion`TIMESTAMP NOT NULL,
  `Comu_Usuario_Eliminacion` varchar(8) NULL,
  `Comu_Fecha_Eliminacion`TIMESTAMP NULL,
  PRIMARY KEY (`Comunicado_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=487 DEFAULT CHARSET=utf8mb3;

ALTER TABLE BDLIMABUS.comunicado CHANGE Comu_Archivo Comu_Imagen varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL;
ALTER TABLE BDLIMABUS.comunicado ADD Comu_Usuario_Creacion varchar(8) NOT NULL;
ALTER TABLE BDLIMABUS.comunicado ADD Comu_Fecha_Creacion TIMESTAMP NOT NULL;
ALTER TABLE BDLIMABUS.comunicado ADD Comu_Usuario_Eliminacion varchar(8) NULL;
ALTER TABLE BDLIMABUS.comunicado ADD Comu_Fecha_Eliminacion TIMESTAMP NULL;
