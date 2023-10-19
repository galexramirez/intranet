CREATE TABLE `BDLIMABUS2`.`ControlNovedad` ( 
     `ControlNovedad_Id` INT(11) NOT NULL AUTO_INCREMENT ,
     `CNove_ProcesoOrigen` INT(1) NOT NULL ,
     `CNove_ProgramacionId` INT(11) NOT NULL ,
     `CNove_NovedadId` INT(11) NOT NULL ,
     `CNove_Fecha`  TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
     `CNove_UsuarioId` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
      PRIMARY KEY (`ControlNovedad_Id`)) ENGINE = InnoDB;