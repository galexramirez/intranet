CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`manto_ot_cierre` (
  `ot_cierre_id` INT NOT NULL AUTO_INCREMENT,
  `otc_semana` VARCHAR(45) NOT NULL,
  `otc_fecha_genera` TIMESTAMP NOT NULL,
  `otc_usuario_id_genera` VARCHAR(8) NOT NULL,
  `otc_fecha_abrir` TIMESTAMP NULL,
  `otc_usuario_id_abrir` VARCHAR(8) NULL,
  `otc_estado` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`ot_cierre_id`))
ENGINE = InnoDB