CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`manto_novedad_operacion` (
  `novedad_operacion_id` INT NOT NULL AUTO_INCREMENT,
  `nope_fecha` DATETIME NOT NULL,
  `nope_usuario_genera` VARCHAR(8) NOT NULL,
  `nope_tipo_novedad` VARCHAR(45) NOT NULL,
  `nope_novedad_id` VARCHAR(15) NOT NULL,
  `nope_componente` VARCHAR(100) NOT NULL,
  `nope_posicion` VARCHAR(100) NOT NULL,
  `nope_falla` VARCHAR(45) NOT NULL,
  `nope_accion` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`novedad_operacion_id`))
ENGINE = InnoDB;