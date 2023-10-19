/* Buses - Registro de buses en el sistema*/
DROP TABLE IF EXISTS `BDLIMABUS`.`Buses`;
CREATE TABLE `BDLIMABUS`.`Buses` (
    `Bus_NroExterno` varchar(11) CHARACTER SET utf8 NOT NULL,
    `Bus_NroVid` varchar(5) CHARACTER SET utf8 NOT NULL,
    `Bus_NroPlaca` varchar(7) CHARACTER SET utf8 NOT NULL,
    `Bus_Operacion` varchar(45) CHARACTER SET utf8 NOT NULL,
    `Bus_Detalle` varchar(60) CHARACTER SET utf8 DEFAULT NULL
    `Bus_Tipo` varchar(50) CHARACTER SET utf8 NOT NULL,
    `Bus_Tipo2` varchar(11) CHARACTER SET utf8 NOT NULL,
    `Bus_Estado` varchar(20) CHARACTER SET utf8 NOT NULL,
    `Bus_Tanques` varchar(10) CHARACTER SET utf8 NOT NULL
PRIMARY KEY (`Bus_NroExterno`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;