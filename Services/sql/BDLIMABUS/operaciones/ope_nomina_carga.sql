CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`ope_nomina_carga` (
  `nomina_carga_id` INT NOT NULL AUTO_INCREMENT,
  `ncar_anio` INT NOT NULL,
  `ncar_periodo` VARCHAR(45) NOT NULL,
  `ncar_tipo` VARCHAR(45) NOT NULL,
  `ncar_fecha_inicio` DATE NOT NULL,
  `ncar_fecha_termino` DATE NOT NULL,
  `ncar_usuario_id_crea` VARCHAR(8) NOT NULL,
  `ncar_fecha_crea` DATETIME NOT NULL,
  `ncar_usuario_id_elimina` VARCHAR(8) NULL,
  `ncar_fecha_elimina` DATETIME NULL,
  `ncar_estado` VARCHAR(15) NOT NULL,
  `ncar_archivo` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`nomina_carga_id`))
ENGINE = InnoDB;