/* Calendario - Registro de Fechas, Semanas y Años según SAF*/
DROP TABLE IF EXISTS `BDLIMABUS`.`Calendario`;
CREATE TABLE `BDLIMABUS`.`Calendario` ( 
    `Calendario_Id` DATE NOT NULL , 
    `Calendario_Anio` INT(4) NOT NULL , 
    `Calendario_TipoDia` VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `Calendario_Semana` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    PRIMARY KEY (`Calendario_Id`)) ENGINE = InnoDB;