CREATE TABLE `BDLIMABUS`.`ope_despachoflotaregistrocarga` ( 
    `dfrg_id` INT(11) NOT NULL AUTO_INCREMENT , 
    `dfrg_fecha` DATE NOT NULL , 
    `dfrg_operacion` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `dfrg_turno` varchar(45) NULL,
    `dfrg_horainicio` time NULL,
    `dfrg_horatermino` time NULL,
    `dfrg_fechagenerar`  TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `dfrg_usuarioid_generar` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `dfrg_fechacerrar` TIMESTAMP NULL , 
    `dfrg_usuarioid_cerrar` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NULL , 
    `dfrg_estado` VARCHAR(9) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
PRIMARY KEY (`dfrg_id`)) ENGINE = InnoDB;