CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`manto_ot_origen` (
  `ot_origen_id` INT NOT NULL AUTO_INCREMENT,
  `or_nombre` VARCHAR(500) NOT NULL,
  `or_tipo_ot` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`ot_origen_id`))
ENGINE = InnoDB;