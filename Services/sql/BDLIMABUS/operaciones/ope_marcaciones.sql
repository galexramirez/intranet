CREATE TABLE `BDLIMABUS`.`ope_marcaciones` ( 
`ope_marcaciones_id`  INT(11) NOT NULL AUTO_INCREMENT ,
`marc_dni` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
`marc_codigo_colaborador` VARCHAR(4) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
`marc_nombre_colaborador` VARCHAR(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
`marc_fecha_operacion` DATE NOT NULL , 
`marc_hora_operacion` time NOT NULL,
`marc_lugar_exacto` varchar(50) NOT NULL,
`marc_latitud` FLOAT(20,17) NOT NULL,
`marc_longitud` FLOAT(20,17) NOT NULL,
`marc_estado` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
PRIMARY KEY (`ope_marcaciones_id`)) ENGINE = InnoDB;