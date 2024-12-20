CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`manto_ots` (
  `ot_id` INT NOT NULL AUTO_INCREMENT,
  `ot_estado` VARCHAR(45) NOT NULL,
  `ot_origen` VARCHAR(100) NOT NULL,
  `ot_tipo` VARCHAR(45) NOT NULL,
  `ot_bus` VARCHAR(11) NOT NULL,
  `ot_ruc_proveedor` VARCHAR(11) NOT NULL,
  `ot_nombre_proveedor` VARCHAR(100) NOT NULL,
  `ot_cgm_id` VARCHAR(8) NOT NULL,
  `ot_fecha_registro` DATETIME NOT NULL,
  `ot_actividad` VARCHAR(500) NULL,
  `ot_actividad_vincular` VARCHAR(500) NULL,
  `ot_kilometraje` INT NULL,
  `ot_sistema` VARCHAR(200) NULL,
  `ot_ejecucion` VARCHAR(5000) NULL,
  `ot_obs_proveedor` VARCHAR(2500) NULL,
  `ot_obs_cgm` VARCHAR(2500) NULL,
  `ot_log` VARCHAR(1000) NULL,
  `ot_semana_cierre` VARCHAR(45) NULL,
  PRIMARY KEY (`ot_id`))
ENGINE = InnoDB;