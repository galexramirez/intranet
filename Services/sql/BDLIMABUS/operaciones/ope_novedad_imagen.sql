CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`ope_novedad_imagen` (
  `ope_novedad_imagen_id` INT NOT NULL AUTO_INCREMENT,
  `novedad_id` VARCHAR(15) NOT NULL,
  `nove_tipo_imagen` VARCHAR(45) NOT NULL,
  `nove_imagen` LONGBLOB NOT NULL,
  `nove_imagen_usuario_id` VARCHAR(8) NOT NULL,
  `nove_imagen_fecha` TIMESTAMP NOT NULL,
  PRIMARY KEY (`ope_novedad_imagen_id`))
ENGINE = InnoDB