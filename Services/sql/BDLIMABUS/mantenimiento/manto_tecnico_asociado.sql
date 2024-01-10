CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`manto_tecnico_asociado` (
  `tecnico_asociado_id` INT NOT NULL AUTO_INCREMENT,
  `ta_dni` VARCHAR(8) NULL,
  `ta_apellidos_nombres` VARCHAR(60) NULL,
  `ta_nombre_corto` VARCHAR(45) NULL,
  `ta_ruc` VARCHAR(11) NULL,
  `ta_razon_social` VARCHAR(100) NULL,
  PRIMARY KEY (`tecnico_asociado_id`))
ENGINE = InnoDB;