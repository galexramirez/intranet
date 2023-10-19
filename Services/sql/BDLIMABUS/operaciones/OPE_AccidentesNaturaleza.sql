CREATE TABLE `BDLIMABUS`.`OPE_AccidentesNaturaleza` ( 
`OPE_AcciNaturalezaId`  INT(11) NOT NULL AUTO_INCREMENT ,
`Accidente_Id` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
`Acci_Tipo` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
`Acci_Descripcion` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
`Acci_Nombre` VARCHAR(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL , 
`Acci_Dni` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
`Acci_Edad` INT(2) NULL ,
`Acci_Genero` VARCHAR(1) CHARACTER SET utf8 COLLATE utf8_general_ci NULL , 
`Acci_Placa` VARCHAR(7) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
`Acci_Origen` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
PRIMARY KEY (`OPE_AcciNaturalezaId`)) ENGINE = InnoDB;