CREATE TABLE `BDLIMABUS`.`OPE_AccidentesReparacion` ( 
`OPE_AcciReparacionId`  INT(11) NOT NULL AUTO_INCREMENT ,
`Accidentes_Id` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
`Acci_CodigoColor` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
`Acci_SeccionBus` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
`Acci_DescripcionReparacion` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
PRIMARY KEY (`OPE_AcciReparacionId`)) ENGINE = InnoDB;