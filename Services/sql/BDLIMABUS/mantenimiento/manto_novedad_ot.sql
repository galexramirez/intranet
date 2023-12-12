CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`manto_novedad_ot` (
  `novedad_ot_id` INT NOT NULL AUTO_INCREMENT,
  `not_fecha_generacion` DATETIME NULL,
  `not_usuario_genera` VARCHAR(8) NULL,
  `not_estado` VARCHAR(45) NULL,
  `not_ot_tipo` VARCHAR(45) NULL,
  `not_ot_id` INT NULL,
  `not_origen_novedad` VARCHAR(45) NULL,
  `not_tipo_novedad` VARCHAR(45) NULL,
  `not_novedad_id` VARCHAR(45) NULL,
  `not_operacion` VARCHAR(45) NULL,
  `not_bus` VARCHAR(45) NULL,
  PRIMARY KEY (`novedad_ot_id`))
ENGINE = InnoDB;