DROP TABLE IF EXISTS `BDLIMABUS`.`manto_componentes`;
CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`manto_componentes` (
  `componente_id` INT NOT NULL AUTO_INCREMENT,
  `comp_sistema` VARCHAR(20) NOT NULL,
  `comp_tipo_componente` VARCHAR(20) NOT NULL,
  `comp_codigo_patrimonial` VARCHAR(9) NOT NULL,
  `comp_origen` VARCHAR(10) NOT NULL,
  `comp_nro_serie` VARCHAR(100) NOT NULL,
  `comp_nro_parte` VARCHAR(100) NOT NULL,
  `comp_observaciones` VARCHAR(250) NOT NULL,
  `comp_turno` VARCHAR(10) NOT NULL,
  `comp_usuario_id` VARCHAR(8) NOT NULL,
  `comp_fecha` DATETIME NOT NULL,
  `comp_log` VARCHAR(1000) NULL,
  `comp_estado` VARCHAR(15) NULL,
  PRIMARY KEY (`componente_id`))
ENGINE = InnoDB