CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`manto_componentes_movimientos` (
  `componentes_movimientos_id` INT NOT NULL AUTO_INCREMENT,
  `cmov_tipo_movimiento` VARCHAR(20) NOT NULL,
  `cmov_bus` VARCHAR(11) NOT NULL,
  `cmov_ubicacion` VARCHAR(15) NOT NULL,
  `cmov_tipo_componente` VARCHAR(20) NOT NULL,
  `cmov_componente` VARCHAR(20) NOT NULL,
  `cmov_codigo_componente` VARCHAR(9) NOT NULL,
  `cmov_ot_id` INT NOT NULL,
  `cmov_kilometraje` FLOAT NOT NULL,
  `cmov_fecha` DATETIME NOT NULL,
  `cmov_estado` VARCHAR(15) NOT NULL,
  `cmov_usuario_id` VARCHAR(8) NOT NULL,
  `cmov_log` VARCHAR(1000) NULL,
  PRIMARY KEY (`componentes_movimientos_id`))
ENGINE = InnoDB