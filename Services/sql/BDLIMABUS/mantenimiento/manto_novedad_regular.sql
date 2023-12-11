CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`manto_novedad_regular` (
  `novedad_regular_id` INT NOT NULL AUTO_INCREMENT,
  `nreg_fecha` DATETIME NOT NULL,
  `nreg_usuario_genera` VARCHAR(8) NOT NULL,
  `nreg_tipo` VARCHAR(45) NOT NULL,
  `nreg_descripcion` VARCHAR(500) NOT NULL,
  `nreg_operacion` VARCHAR(45) NOT NULL,
  `nreg_bus` VARCHAR(11) NOT NULL,
  `nreg_componente` VARCHAR(100) NOT NULL,
  `nreg_posicion` VARCHAR(100) NOT NULL,
  `nreg_falla` VARCHAR(45) NOT NULL,
  `nreg_accion` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`novedad_regular_id`))
ENGINE = InnoDB;