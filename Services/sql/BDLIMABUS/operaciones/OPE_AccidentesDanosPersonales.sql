CREATE TABLE `BDLIMABUS`.`OPE_AccidentesDanosPersonales` ( 
`OPE_AcciDanosPersonalesId`  INT(11) NOT NULL AUTO_INCREMENT ,
`Accidente_Id` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
`Acci_NombreLesionado` VARCHAR(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
`Acci_DniLesionado` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`Acci_EdadLesionado` INT(2) NOT NULL ,
`Acci_GeneroLesionado` VARCHAR(1) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
`Acci_DetalleLesiones` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
PRIMARY KEY (`OPE_AcciDanosPersonalesId`)) ENGINE = InnoDB;