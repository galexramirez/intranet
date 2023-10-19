CREATE TABLE `BDLIMABUS`.`OPE_AccidentesDanosTerceros` ( 
`OPE_AcciDanosTercerosId`  INT(11) NOT NULL AUTO_INCREMENT ,
`Accidente_Id` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
`Acci_NombreTercero` VARCHAR(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
`Acci_DniTercero` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`Acci_PlacaTercero` VARCHAR(7) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`Acci_DetalleDanos` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
PRIMARY KEY (`OPE_AcciDanosTercerosId`)) ENGINE = InnoDB;