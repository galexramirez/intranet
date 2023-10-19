CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`ope_accidentes_costo_imagen` (
  `ope_accidentes_costo_imagen_id` INT NOT NULL AUTO_INCREMENT,
  `accidentes_id` VARCHAR(15) NOT NULL,
  `acci_tipo_imagen` VARCHAR(45) NOT NULL,
  `acci_imagen` LONGBLOB NOT NULL,
  `acci_imagen_usuario_id` VARCHAR(8) NOT NULL,
  `acci_imagen_fecha` TIMESTAMP NOT NULL,
  PRIMARY KEY (`ope_accidentes_costo_imagen_id`))
ENGINE = InnoDB